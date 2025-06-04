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

// Get all users except the current user
$stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE id != ? ORDER BY username ASC");
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$users_result = mysqli_stmt_get_result($stmt);
$users = [];
while ($row = mysqli_fetch_assoc($users_result)) {
    $users[] = $row;
}
mysqli_stmt_close($stmt);

// Set active page
$active_page = 'find-users';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Buscar Usuarios | DomusCarta</title>
    <?php include '../inc/head.php'; ?>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/notifications.css">
    <link rel="stylesheet" href="css/profile.css">

    <script src="js/dashboard.js" defer></script>
    <script src="js/notifications.js" defer></script>
    <script src="js/find-users.js" defer></script>
</head>
<body>
    <div class="dashboard-container">
        <?php include 'includes/sidebar.php'; ?>
        <div class="main-content">
            <?php include 'includes/topbar.php'; ?>
            <div class="dashboard-content">
                <div class="main-content-area">
                    <!-- Community Section -->
                    <section class="users-search-section">
                        <div class="section-header">
                            <div class="section-title-desc">
                                <h2>Comunidad DomusCarta</h2>
                                <p class="section-description">Conecta con otros coleccionistas, vendedores y compradores de cartas Pokémon. Sigue a usuarios para ver sus actividades, envía mensajes y descubre nuevas colecciones.</p>
                            </div>
                            <div class="search-filter-container">
                                <div class="filter-options">
                                    <select id="userFilterSelect">
                                        <option value="all">Todos</option>
                                        <option value="collectors">Coleccionistas</option>
                                        <option value="sellers">Vendedores</option>
                                        <option value="buyers">Compradores</option>
                                    </select>
                                </div>
                                <div class="view-toggle">
                                    <button class="view-btn active" data-view="grid"><i class="bi bi-grid"></i></button>
                                    <button class="view-btn" data-view="list"><i class="bi bi-list"></i></button>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Users Grid View -->
                    <section class="users-grid-container" id="usersGridView">
                        <?php foreach ($users as $user_item): ?>
                        <div class="user-card">
                            <div class="user-card-content">
                                <div class="user-card-avatar">
                                    <img src="img/profile-avatar-placeholder.jpg" alt="Avatar" class="user-avatar">
                                </div>
                                <div class="user-card-info">
                                    <h3 class="user-card-name"><?php echo htmlspecialchars($user_item['username']); ?></h3>
                                    <p class="user-card-bio">Coleccionista de cartas Pokémon desde 2010. Especializado en cartas raras y ediciones limitadas.</p>
                                    <div class="user-card-stats">
                                        <div class="stat-item">
                                            <span class="stat-number">124</span>
                                            <span class="stat-label">Siguiendo</span>
                                        </div>
                                        <div class="stat-item">
                                            <span class="stat-number">45</span>
                                            <span class="stat-label">Seguidores</span>
                                        </div>
                                    </div>
                                    <div class="user-card-actions">
                                        <button class="btn btn-follow"><i class="bi bi-person-plus"></i> Seguir</button>
                                        <button class="btn btn-profile"><i class="bi bi-person"></i> Ver Perfil</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </section>

                    <!-- Users List View (Hidden by Default) -->
                    <section class="users-list-container" id="usersListView" style="display: none;">
                        <?php foreach ($users as $user_item): ?>
                        <div class="user-list-item">
                            <div class="user-list-avatar">
                                <img src="img/profile-avatar-placeholder.jpg" alt="Avatar">
                            </div>
                            <div class="user-list-info">
                                <div class="user-list-name"><?php echo htmlspecialchars($user_item['username']); ?></div>
                                <div class="user-list-location">Barcelona, España</div>
                                <div class="user-list-bio">Coleccionista de cartas Pokémon desde 2010. Especializado en cartas raras y ediciones limitadas.</div>
                            </div>
                            <div class="user-list-actions">
                                <button class="btn-follow-small"><i class="bi bi-person-plus"></i> Seguir</button>
                                <button class="btn-profile-small"><i class="bi bi-person"></i> Ver Perfil</button>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </section>

                    <!-- Loading Indicator -->
                    <div class="loading-indicator" id="loadingIndicator" style="display: none;">
                        <div class="spinner"></div>
                        <span>Cargando más usuarios...</span>
                    </div>
                </div>
                
                <!-- Include Right Sidebar -->
                <?php include 'includes/right-sidebar.php'; ?>
            </div>
        </div>
    </div>

    <!-- JavaScript is now in external file find-users.js -->
</body>
</html>
