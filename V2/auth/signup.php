<?php
// Set the root path for includes
$rootPath = '../';

// Include necessary files
require_once '../inc/db_connect.php';
require_once '../inc/session.php';
require_once '../inc/auth_functions.php';

// Redirect if already logged in
redirect_if_logged_in();

// Initialize variables
$username = '';
$email = '';
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
        $username = escape_input($conn, $_POST['username'] ?? '');
        $email = escape_input($conn, $_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $confirm_password = $_POST['confirm_password'] ?? '';
        $terms = isset($_POST['terms']);
        
        // Validate passwords match
        if ($password !== $confirm_password) {
            $result = [
                'status' => 'error',
                'message' => ['Las contraseñas no coinciden']
            ];
        } 
        // Validate terms acceptance
        elseif (!$terms) {
            $result = [
                'status' => 'error',
                'message' => ['Debes aceptar los términos y condiciones']
            ];
        }
        // Register user
        else {
            $result = register_user($username, $email, $password);
            
            // If registration successful, clear form data
            if ($result['status'] === 'success') {
                $username = '';
                $email = '';
                
                // Redirect to login page after 2 seconds
                header("Refresh: 2; URL=login.php");
            }
        }
    }
}

// Generate new CSRF token
$csrf_token = generate_csrf_token();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Registrarse | DomusCarta</title>
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
                    <h1>Crear una cuenta</h1>
                    <p>Crea tu cuenta para catalogar tu colección, conectar con otros coleccionistas y acceder al marketplace exclusivo de España.</p>
                </div>
                
                <!-- Display messages if any -->
                <?php if (!empty($result)): ?>
                    <?php echo display_messages($result['message'], $result['status']); ?>
                <?php endif; ?>
                
                <!-- Signup Form -->
                <form class="auth-form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                    <!-- CSRF Token -->
                    <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                    
                    <div class="form-group">
                        <label for="username">Nombre de Usuario</label>
                        <div class="input-with-icon">
                            <i class="bi bi-person"></i>
                            <input type="text" id="username" name="username" placeholder="Tu nombre de usuario" value="<?php echo htmlspecialchars($username); ?>" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Correo Electrónico</label>
                        <div class="input-with-icon">
                            <i class="bi bi-envelope"></i>
                            <input type="email" id="email" name="email" placeholder="tu@email.com" value="<?php echo htmlspecialchars($email); ?>" required>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group half">
                            <label for="password">Contraseña</label>
                            <div class="input-with-icon">
                                <i class="bi bi-lock"></i>
                                <input type="password" id="password" name="password" placeholder="Mínimo 6 caracteres" required>
                            </div>
                        </div>
                        <div class="form-group half">
                            <label for="confirm_password">Confirmar</label>
                            <div class="input-with-icon">
                                <i class="bi bi-lock"></i>
                                <input type="password" id="confirm_password" name="confirm_password" placeholder="Repite tu contraseña" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-options">
                        <div class="terms-checkbox">
                            <input type="checkbox" id="terms" name="terms" required>
                            <label for="terms">Acepto los <a href="#">Términos y Condiciones</a> y la <a href="#">Política de Privacidad</a></label>
                        </div>
                    </div>
                    
                    <button type="submit" class="auth-btn">Crear Cuenta</button>
                </form>
                
                <!-- Login Link -->
                <div class="auth-footer">
                    <p>¿Ya tienes una cuenta? <a href="login.php">Iniciar Sesión</a></p>
                </div>
            </div>
        </div>
        
        <!-- Right Column - Image -->
        <div class="auth-image-col">
            <div class="auth-image" style="background-image: url('../img/auth/auth-bg-2.svg');">
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
