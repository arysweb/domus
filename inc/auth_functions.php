<?php
/**
 * Authentication Functions
 * 
 * Handles user registration, login, validation, and related functionality
 */

require_once 'db_connect.php';
require_once 'session.php';

/**
 * Generates CSRF token
 * 
 * @return string The generated token
 */
function generate_csrf_token() {
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * Validates CSRF token
 * 
 * @param string $token The token to validate
 * @return bool True if token is valid
 */
function validate_csrf_token($token) {
    if (!isset($_SESSION['csrf_token']) || $token !== $_SESSION['csrf_token']) {
        return false;
    }
    return true;
}

/**
 * Registers a new user
 * 
 * @param string $username The username
 * @param string $email The email address
 * @param string $password The password
 * @return array Result with status and message
 */
function register_user($username, $email, $password) {
    global $conn;
    
    // Validate input
    $errors = [];
    
    // Validate username
    if (empty($username)) {
        $errors[] = "El nombre de usuario es obligatorio";
    } elseif (!preg_match('/^[a-zA-Z0-9_]{3,30}$/', $username)) {
        $errors[] = "El nombre de usuario solo puede contener letras, números y guiones bajos, y debe tener entre 3 y 30 caracteres";
    } else {
        // Check if username already exists
        $stmt = mysqli_prepare($conn, "SELECT id FROM users WHERE username = ?");
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        
        if (mysqli_stmt_num_rows($stmt) > 0) {
            $errors[] = "Este nombre de usuario ya está en uso";
        }
        mysqli_stmt_close($stmt);
    }
    
    // Validate email
    if (empty($email)) {
        $errors[] = "El correo electrónico es obligatorio";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Por favor, introduce un correo electrónico válido";
    } else {
        // Check if email already exists
        $stmt = mysqli_prepare($conn, "SELECT id FROM users WHERE email = ?");
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        
        if (mysqli_stmt_num_rows($stmt) > 0) {
            $errors[] = "Este correo electrónico ya está registrado";
        }
        mysqli_stmt_close($stmt);
    }
    
    // Validate password
    if (empty($password)) {
        $errors[] = "La contraseña es obligatoria";
    } elseif (strlen($password) < 6) {
        $errors[] = "La contraseña debe tener al menos 6 caracteres";
    } elseif (!preg_match('/[A-Za-z]/', $password) || !preg_match('/[0-9]/', $password)) {
        $errors[] = "La contraseña debe contener al menos una letra y un número";
    }
    
    // Return errors if any
    if (!empty($errors)) {
        return [
            'status' => 'error',
            'message' => $errors
        ];
    }
    
    // Hash the password using Argon2id
    $password_hash = password_hash($password, PASSWORD_ARGON2ID);
    
    // Insert new user
    $stmt = mysqli_prepare($conn, "INSERT INTO users (username, email, password_hash) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sss", $username, $email, $password_hash);
    
    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        return [
            'status' => 'success',
            'message' => 'Registro completado con éxito. Ahora puedes iniciar sesión.'
        ];
    } else {
        mysqli_stmt_close($stmt);
        return [
            'status' => 'error',
            'message' => ['Error al registrar el usuario. Por favor, inténtalo de nuevo.']
        ];
    }
}

/**
 * Authenticates a user
 * 
 * @param string $email_or_username The email or username
 * @param string $password The password
 * @param bool $remember Whether to remember the user
 * @return array Result with status and message
 */
function login_user($email_or_username, $password, $remember = false) {
    global $conn;
    
    // Validate input
    $errors = [];
    
    if (empty($email_or_username)) {
        $errors[] = "Por favor, introduce tu correo electrónico o nombre de usuario";
    }
    
    if (empty($password)) {
        $errors[] = "Por favor, introduce tu contraseña";
    }
    
    // Return errors if any
    if (!empty($errors)) {
        return [
            'status' => 'error',
            'message' => $errors
        ];
    }
    
    // Check if input is email or username
    $is_email = filter_var($email_or_username, FILTER_VALIDATE_EMAIL);
    
    // Prepare query based on input type
    if ($is_email) {
        $stmt = mysqli_prepare($conn, "SELECT id, uuid, username, email, password_hash, is_admin, is_seller, banned FROM users WHERE email = ?");
    } else {
        $stmt = mysqli_prepare($conn, "SELECT id, uuid, username, email, password_hash, is_admin, is_seller, banned FROM users WHERE username = ?");
    }
    
    mysqli_stmt_bind_param($stmt, "s", $email_or_username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if ($user = mysqli_fetch_assoc($result)) {
        // Check if user is banned
        if ($user['banned'] == 1) {
            mysqli_stmt_close($stmt);
            return [
                'status' => 'error',
                'message' => ['Esta cuenta ha sido suspendida. Por favor, contacta con el administrador.']
            ];
        }
        
        // Verify password
        if (password_verify($password, $user['password_hash'])) {
            // Update last login time
            $update_stmt = mysqli_prepare($conn, "UPDATE users SET last_login_at = NOW() WHERE id = ?");
            mysqli_stmt_bind_param($update_stmt, "i", $user['id']);
            mysqli_stmt_execute($update_stmt);
            mysqli_stmt_close($update_stmt);
            
            // Create user session
            create_user_session($user, $remember);
            
            mysqli_stmt_close($stmt);
            return [
                'status' => 'success',
                'message' => 'Inicio de sesión exitoso',
                'user' => $user
            ];
        } else {
            mysqli_stmt_close($stmt);
            return [
                'status' => 'error',
                'message' => ['Contraseña incorrecta']
            ];
        }
    } else {
        mysqli_stmt_close($stmt);
        return [
            'status' => 'error',
            'message' => ['Usuario no encontrado']
        ];
    }
}

/**
 * Stores a remember me token in the database
 * 
 * @param int $user_id The user ID
 * @param string $selector The token selector
 * @param string $hashed_validator The hashed validator
 * @param int $expiry The expiration timestamp
 * @return bool True if successful
 */
function store_remember_token($user_id, $selector, $hashed_validator, $expiry) {
    global $conn;
    
    // First delete any existing tokens for this user
    $delete_stmt = mysqli_prepare($conn, "DELETE FROM auth_tokens WHERE user_id = ?");
    mysqli_stmt_bind_param($delete_stmt, "i", $user_id);
    mysqli_stmt_execute($delete_stmt);
    mysqli_stmt_close($delete_stmt);
    
    // Insert new token
    $stmt = mysqli_prepare($conn, "INSERT INTO auth_tokens (user_id, selector, hashed_validator, expires) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "issi", $user_id, $selector, $hashed_validator, $expiry);
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    
    return $result;
}

/**
 * Validates a remember me token
 * 
 * @return bool|array False if invalid, user data if valid
 */
function validate_remember_token() {
    global $conn;
    
    if (!isset($_COOKIE['domus_remember'])) {
        return false;
    }
    
    // Extract selector and validator
    list($selector, $validator) = explode(':', $_COOKIE['domus_remember']);
    
    // Look up the token
    $stmt = mysqli_prepare($conn, "SELECT t.user_id, t.hashed_validator, u.id, u.uuid, u.username, u.email, u.is_admin, u.is_seller, u.banned 
                                   FROM auth_tokens t 
                                   JOIN users u ON t.user_id = u.id 
                                   WHERE t.selector = ? AND t.expires > ?");
    $now = time();
    mysqli_stmt_bind_param($stmt, "si", $selector, $now);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if ($token = mysqli_fetch_assoc($result)) {
        // Check if user is banned
        if ($token['banned'] == 1) {
            delete_remember_token($selector);
            mysqli_stmt_close($stmt);
            return false;
        }
        
        // Verify the validator
        if (password_verify($validator, $token['hashed_validator'])) {
            // Update last login time
            $update_stmt = mysqli_prepare($conn, "UPDATE users SET last_login_at = NOW() WHERE id = ?");
            mysqli_stmt_bind_param($update_stmt, "i", $token['id']);
            mysqli_stmt_execute($update_stmt);
            mysqli_stmt_close($update_stmt);
            
            // Create a new user session
            $user = [
                'id' => $token['id'],
                'uuid' => $token['uuid'],
                'username' => $token['username'],
                'email' => $token['email'],
                'is_admin' => $token['is_admin'],
                'is_seller' => $token['is_seller']
            ];
            
            create_user_session($user, true);
            
            mysqli_stmt_close($stmt);
            return $user;
        }
    }
    
    mysqli_stmt_close($stmt);
    return false;
}

/**
 * Deletes a remember me token
 * 
 * @param string $selector The token selector
 * @return bool True if successful
 */
function delete_remember_token($selector) {
    global $conn;
    
    $stmt = mysqli_prepare($conn, "DELETE FROM auth_tokens WHERE selector = ?");
    mysqli_stmt_bind_param($stmt, "s", $selector);
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    
    return $result;
}

/**
 * Displays error or success messages
 * 
 * @param array $messages The messages to display
 * @param string $type The message type (error or success)
 * @return string HTML for displaying messages
 */
function display_messages($messages, $type = 'error') {
    if (empty($messages)) {
        return '';
    }
    
    $class = ($type == 'error') ? 'auth-error' : 'auth-success';
    $icon = ($type == 'error') ? 'bi-exclamation-circle' : 'bi-check-circle';
    
    $html = '<div class="' . $class . '">';
    
    if (is_array($messages)) {
        if (count($messages) == 1) {
            $html .= '<p><i class="bi ' . $icon . '"></i> ' . $messages[0] . '</p>';
        } else {
            $html .= '<ul>';
            foreach ($messages as $message) {
                $html .= '<li><i class="bi ' . $icon . '"></i> ' . $message . '</li>';
            }
            $html .= '</ul>';
        }
    } else {
        $html .= '<p><i class="bi ' . $icon . '"></i> ' . $messages . '</p>';
    }
    
    $html .= '</div>';
    
    return $html;
}
