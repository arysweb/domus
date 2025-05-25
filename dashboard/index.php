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
    <!-- Mobile Toggle Button (visible only on mobile) -->
    <button class="mobile-toggle" id="mobileToggle">
        <i class="bi bi-list"></i>
    </button>
    
    <!-- Dashboard Container -->
    <div class="dashboard-container">
        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <!-- Sidebar Header -->
            <div class="sidebar-header">
                <img src="../img/logo-white.svg" alt="DomusCarta" class="sidebar-logo">
                <span class="sidebar-title">DomusCarta</span>
                <button class="sidebar-toggle" id="sidebarToggle">
                    <i class="bi bi-chevron-right"></i>
                </button>
            </div>
            
            <!-- Sidebar Navigation -->
            <div class="sidebar-nav">
                <!-- Main Navigation Section -->
                <div class="nav-section">
                    <div class="nav-section-header">Principal</div>
                    <ul class="nav-items">
                        <li class="nav-item">
                            <a href="index.php" class="nav-link <?php echo ($active_page == 'dashboard') ? 'active' : ''; ?>">
                                <span class="nav-icon"><i class="bi bi-grid"></i></span>
                                <span class="nav-text">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="profile.php" class="nav-link <?php echo ($active_page == 'profile') ? 'active' : ''; ?>">
                                <span class="nav-icon"><i class="bi bi-person"></i></span>
                                <span class="nav-text">Mi Perfil</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="messages.php" class="nav-link <?php echo ($active_page == 'messages') ? 'active' : ''; ?>">
                                <span class="nav-icon"><i class="bi bi-chat"></i></span>
                                <span class="nav-text">Mensajes</span>
                            </a>
                        </li>
                    </ul>
                </div>
                
                <!-- Collection Section -->
                <div class="nav-section">
                    <div class="nav-section-header">Mi Colección</div>
                    <ul class="nav-items">
                        <li class="nav-item">
                            <a href="collection.php" class="nav-link <?php echo ($active_page == 'collection') ? 'active' : ''; ?>">
                                <span class="nav-icon"><i class="bi bi-collection"></i></span>
                                <span class="nav-text">Ver Colección</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="add-card.php" class="nav-link <?php echo ($active_page == 'add-card') ? 'active' : ''; ?>">
                                <span class="nav-icon"><i class="bi bi-plus-circle"></i></span>
                                <span class="nav-text">Añadir Carta</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="wishlist.php" class="nav-link <?php echo ($active_page == 'wishlist') ? 'active' : ''; ?>">
                                <span class="nav-icon"><i class="bi bi-bookmark-heart"></i></span>
                                <span class="nav-text">Lista de Deseos</span>
                            </a>
                        </li>
                    </ul>
                </div>
                
                <!-- Marketplace Section -->
                <div class="nav-section">
                    <div class="nav-section-header">Marketplace</div>
                    <ul class="nav-items">
                        <li class="nav-item">
                            <a href="marketplace.php" class="nav-link <?php echo ($active_page == 'marketplace') ? 'active' : ''; ?>">
                                <span class="nav-icon"><i class="bi bi-shop"></i></span>
                                <span class="nav-text">Explorar</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="my-listings.php" class="nav-link <?php echo ($active_page == 'my-listings') ? 'active' : ''; ?>">
                                <span class="nav-icon"><i class="bi bi-tag"></i></span>
                                <span class="nav-text">Mis Anuncios</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="orders.php" class="nav-link <?php echo ($active_page == 'orders') ? 'active' : ''; ?>">
                                <span class="nav-icon"><i class="bi bi-bag"></i></span>
                                <span class="nav-text">Pedidos</span>
                            </a>
                        </li>
                    </ul>
                </div>
                
                <!-- Community Section -->
                <div class="nav-section">
                    <div class="nav-section-header">Comunidad</div>
                    <ul class="nav-items">
                        <li class="nav-item">
                            <a href="events.php" class="nav-link <?php echo ($active_page == 'events') ? 'active' : ''; ?>">
                                <span class="nav-icon"><i class="bi bi-calendar-event"></i></span>
                                <span class="nav-text">Eventos</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="forum.php" class="nav-link <?php echo ($active_page == 'forum') ? 'active' : ''; ?>">
                                <span class="nav-icon"><i class="bi bi-chat-square-text"></i></span>
                                <span class="nav-text">Foro</span>
                            </a>
                        </li>
                    </ul>
                </div>
                
                <!-- Settings Section -->
                <div class="nav-section">
                    <div class="nav-section-header">Configuración</div>
                    <ul class="nav-items">
                        <li class="nav-item">
                            <a href="settings.php" class="nav-link <?php echo ($active_page == 'settings') ? 'active' : ''; ?>">
                                <span class="nav-icon"><i class="bi bi-gear"></i></span>
                                <span class="nav-text">Ajustes</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="logout.php" class="nav-link">
                                <span class="nav-icon"><i class="bi bi-box-arrow-right"></i></span>
                                <span class="nav-text">Cerrar Sesión</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="main-content">
            <h1>Bienvenido, <?php echo htmlspecialchars($user['username']); ?></h1>
            <p>Este es el panel de control de DomusCarta.</p>
            
            <!-- Content will go here -->
        </div>
    </div>
    
    <!-- JavaScript for sidebar toggle -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Sidebar toggle functionality
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebar = document.getElementById('sidebar');
            const mobileToggle = document.getElementById('mobileToggle');
            
            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('expanded');
                
                // Change icon based on sidebar state
                const icon = this.querySelector('i');
                if (sidebar.classList.contains('expanded')) {
                    icon.classList.remove('bi-chevron-right');
                    icon.classList.add('bi-chevron-left');
                } else {
                    icon.classList.remove('bi-chevron-left');
                    icon.classList.add('bi-chevron-right');
                }
            });
            
            // Mobile toggle functionality
            if (mobileToggle) {
                mobileToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('visible');
                });
            }
        });
    </script>
</body>
</html>
