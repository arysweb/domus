<?php
// Set the root path for includes
$rootPath = '../';

// Include necessary files
require_once '../inc/db_connect.php';
require_once '../inc/session.php';
require_once '../inc/auth_functions.php';

// Require login to access this page
require_login();

// Get user data
$user_id = $_SESSION['user_id'];
$stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

// Set active page
$active_page = 'dashboard';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Dashboard | DomusCarta</title>
    <?php include '../inc/head.php'; ?>
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>
    
    <!-- Dashboard Container -->
    <div class="dashboard-container">
        <?php include 'includes/sidebar.php'; ?>
        
        <!-- Main Content -->
        <div class="main-content">
            <h1>Bienvenido, <?php echo htmlspecialchars($user['username']); ?></h1>
            <p>Este es el panel de control de DomusCarta.</p>
            
            <!-- Content will go here -->
        </div>
    </div>
    
    <!-- Include dashboard JavaScript -->
    <script src="js/dashboard.js"></script>
</body>
</html>
