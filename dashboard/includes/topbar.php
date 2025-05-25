<?php
/**
 * DomusCarta Dashboard Top Bar
 * This file contains the top bar navigation for the dashboard
 */
?>
<!-- Top Bar -->
<div class="top-bar">
    <!-- Welcome Message -->
    <div class="top-bar-welcome">
        <h1>Bienvenido, <?php echo htmlspecialchars($user['username']); ?></h1>
        <p>Este es el panel de control de DomusCarta.</p>
    </div>
    
    <!-- Search Bar -->
    <div class="top-bar-search">
        <div class="search-container">
            <input type="text" placeholder="Buscar..." class="search-input">
            <button class="search-button"><i class="bi bi-search"></i></button>
        </div>
    </div>
    
    <!-- User Actions -->
    <div class="top-bar-actions">
        <div class="action-icons">
            <div class="notification-dropdown">
                <a href="#" class="action-icon" id="notification-icon">
                    <i class="bi bi-bell"></i>
                    <span class="notification-badge" id="notification-badge"></span>
                </a>
                <div class="dropdown-content" id="notification-dropdown">
                    <div class="dropdown-header">
                        <h3>Notificaciones</h3>
                        <a href="notifications.php" class="view-all">Ver todas</a>
                    </div>
                    <div class="dropdown-notifications" id="dropdown-notifications">
                        <!-- Notifications will be loaded here via AJAX -->
                    </div>
                </div>
            </div>
            <a href="messages.php" class="action-icon"><i class="bi bi-chat-dots"></i></a>
        </div>
        <div class="user-profile">
            <a href="profile.php" class="profile-image">
                <?php if (isset($user['profile_image']) && !empty($user['profile_image'])): ?>
                    <img src="<?php echo htmlspecialchars($user['profile_image']); ?>" alt="<?php echo htmlspecialchars($user['username']); ?>">
                <?php else: ?>
                    <div class="default-profile-image">
                        <i class="bi bi-person"></i>
                    </div>
                <?php endif; ?>
            </a>
        </div>
    </div>
</div>
