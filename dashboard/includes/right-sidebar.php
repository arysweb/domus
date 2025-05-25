<?php
/**
 * Right Sidebar Component
 * Contains the collection info card and other sidebar elements
 */
?>
<!-- Right Sidebar -->
<div class="dashboard-sidebar">
    <!-- Collection Info Card -->
    <div class="collection-info">
        <?php 
        // Include user data file
        require_once 'user_data.php';
        
        if ($user_data['has_cards']) { 
        // *** CARD VIEW WHEN USER HAS CARDS *** 
        ?>
        <!-- Card with background image containing all elements -->
        <div class="collection-bg">
            <!-- Title Row -->
            <div class="collection-title">
                <h3>Colección de <?php echo htmlspecialchars($user_data['username']); ?></h3>
            </div>
            
            <!-- Stats Row -->
            <div class="collection-stats-row">
                <div class="collection-stat">
                    <span class="stat-number">347</span>
                    <span class="stat-label">Cartas</span>
                </div>
                <div class="collection-stat">
                    <span class="stat-number">24</span>
                    <span class="stat-label">Expansiones</span>
                </div>
                <div class="collection-stat">
                    <span class="stat-number">1,250€</span>
                    <span class="stat-label">Valor Total</span>
                </div>
            </div>
            
            <!-- Simple Custom Dropdown -->
            <div class="expansion-selector">
                <div class="custom-dropdown" id="customDropdown">
                    <div class="dropdown-selected" id="dropdownSelected">
                        <span>Escarlata y Púrpura - Grieta Paradoja (42/182)</span>
                        <i class="bi bi-chevron-down"></i>
                    </div>
                </div>
            </div>
            
            <!-- Footer -->
            <div class="collection-footer">
                <a href="collection.php">Ver mi colección <i class="bi bi-arrow-right"></i></a>
            </div>
        </div>
        <?php 
        } else { 
        // *** CARD VIEW WHEN USER HAS NO CARDS *** 
        ?>
        <!-- Empty collection state -->
        <div class="collection-bg empty-collection">
            <!-- Title and Description -->
            <div class="empty-collection-content">
                <h3>Sin cartas aún</h3>
                <p>Añade tus primeras cartas para comenzar tu colección de Pokémon.</p>
                <a href="add-cards.php" class="add-cards-btn">
                    <i class="bi bi-plus-circle"></i> Añadir cartas
                </a>
            </div>
        </div>
        <?php } ?>
    </div>
    
    <!-- Social Activity Card -->
    <?php 
    // Check if user has social connections based on data from database
    if ($user_data['has_social_connections']) { 
    // *** SOCIAL CARD VIEW WHEN USER HAS CONNECTIONS *** 
    ?>
    <div class="social-activity-card">
        <!-- Card Header: 2 columns (Title and See All link) -->
        <div class="activity-card-header">
            <div class="activity-card-title">Actividad Social</div>
            <a href="social.php" class="see-all-link">Ver todo <i class="bi bi-arrow-right"></i></a>
        </div>
        
        <!-- Activity List -->
        <div class="activity-list">
            <!-- Activity Item 1: 3 columns (Avatar, Activity, Time) -->
            <div class="activity-item">
                <div class="user-avatar">
                    <img src="img/avatar-placeholder.svg" alt="Avatar">
                </div>
                <div class="activity-details">
                    <div class="user-name">Ana García</div>
                    <div class="activity-text">Ha comprado Charizard VMAX</div>
                </div>
                <div class="activity-time">2h</div>
            </div>
            
            <!-- Activity Item 2 -->
            <div class="activity-item">
                <div class="user-avatar">
                    <img src="img/avatar-placeholder.svg" alt="Avatar">
                </div>
                <div class="activity-details">
                    <div class="user-name">Carlos Martínez</div>
                    <div class="activity-text">Ha vendido Pikachu V</div>
                </div>
                <div class="activity-time">5h</div>
            </div>
            
            <!-- Activity Item 3 -->
            <div class="activity-item">
                <div class="user-avatar">
                    <img src="img/avatar-placeholder.svg" alt="Avatar">
                </div>
                <div class="activity-details">
                    <div class="user-name">Laura Sánchez</div>
                    <div class="activity-text">Ha añadido 15 cartas a su colección</div>
                </div>
                <div class="activity-time">1d</div>
            </div>
            
            <!-- Activity Item 4 -->
            <div class="activity-item">
                <div class="user-avatar">
                    <img src="img/avatar-placeholder.svg" alt="Avatar">
                </div>
                <div class="activity-details">
                    <div class="user-name">Miguel Fernández</div>
                    <div class="activity-text">Ha completado Escarlata y Púrpura—151</div>
                </div>
                <div class="activity-time">2d</div>
            </div>
        </div>
    </div>
    <?php 
    } else { 
    // *** SOCIAL CARD VIEW WHEN USER HAS NO CONNECTIONS *** 
    ?>
    <!-- Empty social state -->
    <div class="social-activity-card">
        <div class="empty-social">
            <!-- Title and Description -->
            <div class="empty-social-content">
                <h3>Comienza a seguir a alguien</h3>
                <p>Sigue a otros coleccionistas o vendedores para ver su actividad en tu página y descubrir nuevas cartas.</p>
                <a href="social.php" class="connect-btn">
                    <i class="bi bi-people"></i> Explorar comunidad
                </a>
            </div>
        </div>
    </div>
    <?php } ?>
    
</div>
