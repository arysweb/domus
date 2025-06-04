<?php
/**
 * DomusCarta Mobile Navigation
 * Mobile bottom navigation bar for responsive design
 */
?>
<!-- Mobile Bottom Navigation -->
<div class="mobile-bottom-nav">
    <div class="mobile-nav-items">
        <a href="index.php" class="mobile-nav-item <?php echo ($active_page == 'dashboard') ? 'active' : ''; ?>">
            <i class="bi bi-grid"></i>
        </a>
        <a href="collection.php" class="mobile-nav-item <?php echo ($active_page == 'collection') ? 'active' : ''; ?>">
            <i class="bi bi-collection"></i>
        </a>
        
        <!-- Center Plus Button -->
        <a href="add-card.php" class="mobile-nav-item mobile-nav-plus">
            <div class="plus-button-circle">
                <i class="bi bi-plus"></i>
            </div>
        </a>
        
        <a href="find-users.php" class="mobile-nav-item <?php echo ($active_page == 'find-users') ? 'active' : ''; ?>">
            <i class="bi bi-people"></i>
        </a>
        <a href="#" class="mobile-nav-item" id="mobileMenuToggle">
            <i class="bi bi-list"></i>
        </a>
    </div>
</div>

<!-- Floating menu button removed as it's redundant with the bottom nav menu button -->

<!-- Sidebar Overlay moved to index.php -->
