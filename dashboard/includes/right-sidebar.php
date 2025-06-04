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
            <!-- Description -->
            <div class="empty-collection-content">
                <p>Añade tus primeras cartas para comenzar tu colección.</p>
                <a href="add-cards.php" class="add-cards-btn">
                    <i class="bi bi-plus-circle"></i> Añadir cartas
                </a>
            </div>
        </div>
        <?php } ?>
    </div>

    <!-- Events Card -->
    <div class="events-card">
        <!-- Card Header with Toggle Links -->
        <div class="events-card-header">
            <div class="events-toggle-links">
                <a href="#" class="event-toggle-link <?php echo ($user_data['has_my_events']) ? 'active' : ''; ?>" data-target="my-events">Mis Eventos</a>
                <a href="#" class="event-toggle-link <?php echo (!$user_data['has_my_events']) ? 'active' : ''; ?>" data-target="public-events">Eventos Públicos</a>
            </div>
        </div>
        
        <!-- My Events Section -->
        <div class="events-section my-events <?php echo ($user_data['has_my_events']) ? 'active' : ''; ?>">
            <?php if ($user_data['has_my_events']) { // User has their own events ?>
                <div class="event-item">
                    <div class="event-date">
                        <span class="event-day">15</span>
                        <span class="event-month">JUN</span>
                    </div>
                    <div class="event-details">
                        <div class="event-title">Torneo Local Pokémon TCG</div>
                        <div class="event-location"><i class="bi bi-geo-alt"></i> Centro Comercial Gran Vía</div>
                    </div>
                    <div class="event-status attending">Asistiré</div>
                </div>
                
                <div class="event-item">
                    <div class="event-date">
                        <span class="event-day">22</span>
                        <span class="event-month">JUN</span>
                    </div>
                    <div class="event-details">
                        <div class="event-title">Intercambio de Cartas</div>
                        <div class="event-location"><i class="bi bi-geo-alt"></i> Parque del Retiro</div>
                    </div>
                    <div class="event-status interested">Interesado</div>
                </div>
                
                <!-- See All Events Link -->
                <div class="events-footer">
                    <a href="events.php">Ver todos mis eventos <i class="bi bi-arrow-right"></i></a>
                </div>
            <?php } else { // User has no events yet ?>
                <div class="empty-events-content">
                    <p>Aún no tienes eventos. Participa en eventos para conectar con otros coleccionistas.</p>
                    <a href="events.php" class="find-events-btn">
                        <i class="bi bi-calendar-event"></i> Explorar eventos
                    </a>
                </div>
            <?php } ?>
        </div>
        
        <!-- Public Events Section -->
        <div class="events-section public-events <?php echo (!$user_data['has_my_events']) ? 'active' : ''; ?>">
            <?php if ($user_data['has_public_events']) { // There are public events ?>
                <div class="event-item">
                    <div class="event-date">
                        <span class="event-day">18</span>
                        <span class="event-month">JUN</span>
                    </div>
                    <div class="event-details">
                        <div class="event-title">Campeonato Regional Pokémon</div>
                        <div class="event-location"><i class="bi bi-geo-alt"></i> IFEMA Madrid</div>
                    </div>
                    <div class="event-action"><a href="#" class="event-join-btn">Unirse</a></div>
                </div>
                
                <div class="event-item">
                    <div class="event-date">
                        <span class="event-day">25</span>
                        <span class="event-month">JUN</span>
                    </div>
                    <div class="event-details">
                        <div class="event-title">Lanzamiento Expansión Pokémon</div>
                        <div class="event-location"><i class="bi bi-geo-alt"></i> Tienda Game</div>
                    </div>
                    <div class="event-action"><a href="#" class="event-join-btn">Unirse</a></div>
                </div>
                
                <!-- See All Events Link -->
                <div class="events-footer">
                    <a href="events.php?type=public">Ver todos los eventos <i class="bi bi-arrow-right"></i></a>
                </div>
            <?php } else { // No public events available ?>
                <div class="empty-events-content">
                    <p>No hay eventos públicos disponibles en este momento.</p>
                    <a href="events.php" class="find-events-btn">
                        <i class="bi bi-calendar-plus"></i> Crear evento
                    </a>
                </div>
            <?php } ?>
        </div>
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
            <!-- Description -->
            <div class="empty-social-content">
                <p>Sigue a otros coleccionistas para ver su actividad.</p>
                <a href="find-users.php" class="connect-btn">
                    <i class="bi bi-people"></i> Explorar comunidad
                </a>
            </div>
        </div>
    </div>
    <?php } ?>
    
</div>
