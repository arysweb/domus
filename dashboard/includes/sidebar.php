<?php
/**
 * DomusCarta Dashboard Sidebar
 * This file contains the sidebar navigation for the dashboard
 */
?>
<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <!-- Sidebar Header -->
    <div class="sidebar-header">
        <img src="../img/logo-icon-black.svg" alt="DomusCarta" class="sidebar-logo sidebar-logo-icon">
        <img src="../img/logo.svg" alt="DomusCarta" class="sidebar-logo sidebar-logo-full">
        <button class="sidebar-toggle" id="sidebarToggle">
            <i class="bi bi-chevron-right"></i>
        </button>
    </div>
    
    <!-- Sidebar Navigation -->
    <div class="sidebar-nav">
        <!-- Main Navigation Section -->
        <div class="nav-section">
            <ul class="nav-items">
                <li class="nav-item">
                    <a href="index.php" class="sidebar-nav-link <?php echo ($active_page == 'dashboard') ? 'active' : ''; ?>">
                        <span class="nav-icon"><i class="bi bi-grid"></i></span>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="profile.php" class="sidebar-nav-link <?php echo ($active_page == 'profile') ? 'active' : ''; ?>">
                        <span class="nav-icon"><i class="bi bi-person"></i></span>
                        <span class="nav-text">Mi Perfil</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="messages.php" class="sidebar-nav-link <?php echo ($active_page == 'messages') ? 'active' : ''; ?>">
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
                    <a href="collection.php" class="sidebar-nav-link <?php echo ($active_page == 'collection') ? 'active' : ''; ?>">
                        <span class="nav-icon"><i class="bi bi-collection"></i></span>
                        <span class="nav-text">Ver Colección</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="add-card.php" class="sidebar-nav-link <?php echo ($active_page == 'add-card') ? 'active' : ''; ?>">
                        <span class="nav-icon"><i class="bi bi-plus-circle"></i></span>
                        <span class="nav-text">Añadir Carta</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="wishlist.php" class="sidebar-nav-link <?php echo ($active_page == 'wishlist') ? 'active' : ''; ?>">
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
                    <a href="marketplace.php" class="sidebar-nav-link <?php echo ($active_page == 'marketplace') ? 'active' : ''; ?>">
                        <span class="nav-icon"><i class="bi bi-shop"></i></span>
                        <span class="nav-text">Explorar</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="my-listings.php" class="sidebar-nav-link <?php echo ($active_page == 'my-listings') ? 'active' : ''; ?>">
                        <span class="nav-icon"><i class="bi bi-tag"></i></span>
                        <span class="nav-text">Mis Anuncios</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="orders.php" class="sidebar-nav-link <?php echo ($active_page == 'orders') ? 'active' : ''; ?>">
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
                    <a href="events.php" class="sidebar-nav-link <?php echo ($active_page == 'events') ? 'active' : ''; ?>">
                        <span class="nav-icon"><i class="bi bi-calendar-event"></i></span>
                        <span class="nav-text">Eventos</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="forum.php" class="sidebar-nav-link <?php echo ($active_page == 'forum') ? 'active' : ''; ?>">
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
                    <a href="settings.php" class="sidebar-nav-link <?php echo ($active_page == 'settings') ? 'active' : ''; ?>">
                        <span class="nav-icon"><i class="bi bi-gear"></i></span>
                        <span class="nav-text">Ajustes</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="logout.php" class="sidebar-nav-link">
                        <span class="nav-icon"><i class="bi bi-box-arrow-right"></i></span>
                        <span class="nav-text">Cerrar Sesión</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
