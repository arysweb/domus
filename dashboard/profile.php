<?php
// Set the root path for includes
$rootPath = '../';

require_once '../inc/db_connect.php';
require_once '../inc/session.php';
require_once '../inc/auth_functions.php';
require_login();

// Get user data
$user_id = $_SESSION['user_id'];
$stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

$active_page = 'profile';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Mi Perfil | DomusCarta</title>
    <?php include '../inc/head.php'; ?>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/notifications.css">
    <link rel="stylesheet" href="css/profile.css">

    <script src="js/dashboard.js" defer></script>
    <script src="js/notifications.js" defer></script>
</head>
<body>
    <div class="dashboard-container">
        <?php include 'includes/sidebar.php'; ?>
        <div class="main-content">
            <?php include 'includes/topbar.php'; ?>
            <div class="dashboard-content">
                <div class="main-content-area">
                    <!-- User Profile Card -->
                    <section class="user-profile-card">
                        <!-- Top Row: Cover Image -->
                        <div class="profile-cover-row">
                            <img src="img/profile-cover-placeholder.jpg" alt="Portada del usuario" class="profile-cover-img">
                        </div>
                        <!-- Bottom Row: 3 Columns -->
                        <div class="profile-main-row">
                            <!-- Left Column: Profile Image -->
                            <div class="profile-col profile-col-left">
                                <div class="profile-img-wrapper">
                                    <img src="img/profile-avatar-placeholder.jpg" alt="Avatar" class="profile-avatar">
                                </div>
                            </div>
                            <!-- Middle Column: User Info -->
                            <div class="profile-col profile-col-middle">
                                <div class="profile-info-row">
                                    <h2 class="profile-username" style="font-size:2.3rem;color:var(--dracula);margin-bottom:6px;">
                                        <?php echo htmlspecialchars($user['username']); ?>
                                    </h2>
                                </div>
                                <div class="profile-info-row profile-info-small">
                                    <span class="profile-value">Coleccionista</span>
                                </div>
                                <div class="profile-info-row profile-info-small">
                                    <span class="profile-value">Barcelona, España</span>
                                </div>
                                <div class="profile-info-row profile-info-small">
                                    <span class="profile-badge">
                                        <i class="bi bi-award-fill"></i> Oro
                                    </span>
                                    <span class="colecter-badge">
                                        <i class="bi bi-award-fill"></i> Leyenda
                                    </span>
                                    <span class="seller-badge">
                                        <i class="bi bi-award-fill"></i> Estrella
                                    </span>
                                    <span class="comprador-badge">
                                        <i class="bi bi-award-fill"></i> Premium
                                    </span>
                                </div>
                            </div>
                            <!-- Right Column: Buttons -->
                            <div class="profile-col profile-col-right">
                                <div class="profile-actions-vertical">
                                    <button class="btn btn-follow"><i class="bi bi-person-plus"></i> Seguir</button>
                                    <button class="btn btn-message"><i class="bi bi-chat-dots"></i> Mensaje</button>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <?php include 'includes/right-sidebar-profile.php'; ?>
            </div>
        </div>
    </div>
</body>
</html>
