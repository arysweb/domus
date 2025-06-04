<?php
/**
 * Session Management
 * 
 * Handles secure session initialization, validation, and management
 */

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    // Set secure session parameters
    ini_set('session.use_only_cookies', 1);
    ini_set('session.use_strict_mode', 1);
    
    $cookieParams = session_get_cookie_params();
    session_set_cookie_params([
        'lifetime' => 86400, // 24 hours default lifetime
        'path' => '/',
        'domain' => '',
        'secure' => true, // Only transmit cookie over HTTPS
        'httponly' => true, // Prevent JavaScript access to session cookie
        'samesite' => 'Lax' // Prevents CSRF attacks
    ]);
    
    session_name('domus_session');
    session_start();
    
    // Regenerate session ID periodically to prevent session fixation
    if (!isset($_SESSION['last_regeneration'])) {
        regenerate_session_id();
    } else {
        // Regenerate session ID every 30 minutes
        $interval = 30 * 60;
        if (time() - $_SESSION['last_regeneration'] >= $interval) {
            regenerate_session_id();
        }
    }
}

/**
 * Regenerates the session ID
 */
function regenerate_session_id() {
    // Save current session data
    $old_session_data = $_SESSION;
    
    // Generate new session ID
    session_regenerate_id(true);
    
    // Restore session data
    $_SESSION = $old_session_data;
    
    // Update regeneration time
    $_SESSION['last_regeneration'] = time();
}

/**
 * Creates a new user session after successful login
 * 
 * @param array $user User data from database
 * @param bool $remember Whether to set a remember me cookie
 */
function create_user_session($user, $remember = false) {
    // Basic session data
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_uuid'] = $user['uuid'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['is_admin'] = $user['is_admin'];
    $_SESSION['is_seller'] = $user['is_seller'];
    $_SESSION['logged_in'] = true;
    $_SESSION['last_activity'] = time();
    
    // Set remember me cookie if requested
    if ($remember) {
        // Generate a secure token
        $selector = bin2hex(random_bytes(16));
        $validator = bin2hex(random_bytes(32));
        
        // Hash the validator for storage
        $hashed_validator = password_hash($validator, PASSWORD_DEFAULT);
        
        // Set expiration (30 days)
        $expiry = time() + (30 * 24 * 60 * 60);
        
        // Store token in database (implementation in auth_functions.php)
        store_remember_token($user['id'], $selector, $hashed_validator, $expiry);
        
        // Set cookie with selector and validator
        $cookie_value = $selector . ':' . $validator;
        setcookie(
            'domus_remember',
            $cookie_value,
            [
                'expires' => $expiry,
                'path' => '/',
                'domain' => '',
                'secure' => true,
                'httponly' => true,
                'samesite' => 'Lax'
            ]
        );
    }
}

/**
 * Checks if user is logged in
 * 
 * @return bool True if user is logged in
 */
function is_logged_in() {
    return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
}

/**
 * Checks if current user is an admin
 * 
 * @return bool True if user is an admin
 */
function is_admin() {
    return is_logged_in() && isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === 1;
}

/**
 * Checks if current user is a seller
 * 
 * @return bool True if user is a seller
 */
function is_seller() {
    return is_logged_in() && isset($_SESSION['is_seller']) && $_SESSION['is_seller'] === 1;
}

/**
 * Destroys the current session and clears cookies
 */
function logout() {
    // Clear remember me token if it exists
    if (isset($_COOKIE['domus_remember'])) {
        list($selector, $validator) = explode(':', $_COOKIE['domus_remember']);
        delete_remember_token($selector);
        
        // Delete the cookie
        setcookie('domus_remember', '', time() - 3600, '/', '', true, true);
    }
    
    // Destroy session
    session_unset();
    session_destroy();
    
    // Force the session cookie to expire
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 3600,
        $params['path'],
        $params['domain'],
        $params['secure'],
        $params['httponly']
    );
}

/**
 * Redirects to login page if user is not logged in
 */
function require_login() {
    if (!is_logged_in()) {
        header('Location: ../auth/login.php');
        exit;
    }
}

/**
 * Redirects to homepage if user is already logged in
 */
function redirect_if_logged_in() {
    if (is_logged_in()) {
        // Go up one directory level from /auth/ to root, then to /dashboard/
        header('Location: ../dashboard/find-users.php');
        exit;
    }
}
