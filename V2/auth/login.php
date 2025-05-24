<?php
// Set the root path for includes
$rootPath = '../';

// Include necessary files
require_once '../inc/db_connect.php';
require_once '../inc/session.php';
require_once '../inc/auth_functions.php';

// Check for remember me cookie
if (!is_logged_in() && isset($_COOKIE['domus_remember'])) {
    $user = validate_remember_token();
    if ($user) {
        // User was logged in via remember me token, redirect to dashboard
        header('Location: ../dashboard/');
        exit;
    }
}

// Redirect if already logged in
redirect_if_logged_in();

// Initialize variables
$email_or_username = '';
$result = [];

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate CSRF token
    if (!validate_csrf_token($_POST['csrf_token'] ?? '')) {
        $result = [
            'status' => 'error',
            'message' => ['Error de seguridad. Por favor, recarga la página e inténtalo de nuevo.']
        ];
    } else {
        // Get form data
        $email_or_username = escape_input($conn, $_POST['email_or_username'] ?? '');
        $password = $_POST['password'] ?? '';
        $remember = isset($_POST['remember']);
        
        // Login user
        $result = login_user($email_or_username, $password, $remember);
        
        // If login successful, redirect to dashboard
        if ($result['status'] === 'success') {
            header('Location: ../dashboard/');
            exit;
        }
    }
}

// Generate new CSRF token
$csrf_token = generate_csrf_token();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Iniciar Sesión | DomusCarta</title>
    <?php include '../inc/head.php'; ?>
    <!-- Custom CSS for Auth Pages -->
    <link rel="stylesheet" href="../css/auth.css">
</head>
<body>
    <div class="auth-container">
        <!-- Close button (absolute positioned) -->
        <a href="../index.php" class="mobile-close-btn"><i class="bi bi-x"></i></a>
        
        <!-- Left Column - Form -->
        <div class="auth-form-col">
            <div class="auth-form-wrapper">
                <!-- Logo -->
                <div class="auth-logo">
                    <a href="../index.php">
                        <img src="../img/logo.svg" alt="DomusCarta Logo" class="logo">
                    </a>
                </div>
                
                <!-- Form Header -->
                <div class="auth-header">
                    <h1>Iniciar Sesión</h1>
                    <p>Accede a tu colección digital, mensajes privados y ofertas exclusivas del marketplace de cartas Pokémon más completo de España.</p>
                </div>
                
                <!-- Display messages if any -->
                <?php if (!empty($result)): ?>
                    <?php echo display_messages($result['message'], $result['status']); ?>
                <?php endif; ?>
                
                <!-- Login Form -->
                <form class="auth-form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                    <!-- CSRF Token -->
                    <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                    
                    <div class="form-group">
                        <label for="email_or_username">Correo Electrónico o Usuario</label>
                        <div class="input-with-icon">
                            <i class="bi bi-person"></i>
                            <input type="text" id="email_or_username" name="email_or_username" placeholder="tu@email.com o nombre de usuario" value="<?php echo htmlspecialchars($email_or_username); ?>" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <div class="input-with-icon">
                            <i class="bi bi-lock"></i>
                            <input type="password" id="password" name="password" placeholder="••••••••" required>
                        </div>
                    </div>
                    
                    <div class="form-options">
                        <div class="remember-me">
                            <input type="checkbox" id="remember" name="remember">
                            <label for="remember">Recordarme</label>
                        </div>
                        <a href="reset-password.php" class="forgot-password">¿Olvidaste tu contraseña?</a>
                    </div>
                    
                    <button type="submit" class="auth-btn">Iniciar Sesión</button>
                </form>
                
                <!-- Sign Up Link -->
                <div class="auth-footer">
                    <p>¿No tienes una cuenta? <a href="signup.php">Regístrate</a></p>
                </div>
            </div>
        </div>
        
        <!-- Image Column -->
        <div class="auth-image-col">
            <div class="auth-image" style="background-image: url('../img/auth/auth-bg-1.svg');">
                <div class="auth-image-overlay">
                    <a href="../index.php" class="close-btn"><i class="bi bi-x"></i></a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Scripts -->
    <script src="../js/functions.js"></script>
</body>
</html>
