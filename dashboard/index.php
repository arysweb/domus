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
    <link rel="stylesheet" href="css/notifications.css">
    <script src="js/notifications.js" defer></script>
    <script src="js/events-toggle.js" defer></script>
</head>
<body>
    
    <!-- Dashboard Container -->
    <div class="dashboard-container">
        <?php include 'includes/sidebar.php'; ?>
        
        <!-- Main Content -->
        <div class="main-content">
            <?php include 'includes/topbar.php'; ?>
            
            <!-- Dashboard Content -->
            <div class="dashboard-content">
                <!-- Main Content Area -->
                <div class="main-content-area">
                    <!-- Dashboard content will go here -->
                </div>
                
                <!-- Include Right Sidebar -->
                <?php include 'includes/right-sidebar.php'; ?>
            </div>
        </div>
    </div>
    
    <!-- Dropdown Menu (outside of card structure) -->
    <div class="dropdown-menu" id="dropdownMenu">
        <div class="dropdown-item" data-value="sv-paradox-rift">Escarlata y Púrpura—Grieta Paradoja (42/182)</div>
        <div class="dropdown-item" data-value="sv-obsidian-flames">Escarlata y Púrpura—Llamas Obsidiana (35/194)</div>
        <div class="dropdown-item" data-value="sv-151">Escarlata y Púrpura—151 (28/165)</div>
        <div class="dropdown-item" data-value="sv-paldea">Escarlata y Púrpura—Paldea Evolucionado (31/193)</div>
        <div class="dropdown-item" data-value="sv-base">Escarlata y Púrpura—Set Base (39/198)</div>
    </div>
    
    <!-- Include dashboard JavaScript -->
    <script src="js/dashboard.js"></script>
</body>
</html>
