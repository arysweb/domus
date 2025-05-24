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
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Dashboard | DomusCarta</title>
    <?php include '../inc/head.php'; ?>
    <link rel="stylesheet" href="../css/global.css">
    <style>
        .dashboard-container {
            padding: 40px 0;
        }
        .dashboard-header {
            margin-bottom: 30px;
        }
        .dashboard-header h1 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 10px;
            color: var(--dracula);
        }
        .dashboard-header p {
            font-size: 1.1rem;
            color: rgba(45, 52, 54, 0.7);
            font-weight: 300;
        }
        .dashboard-card {
            background-color: var(--white);
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            padding: 25px;
            margin-bottom: 25px;
        }
        .dashboard-card h2 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 15px;
            color: var(--dracula);
        }
        .dashboard-card p {
            font-size: 1rem;
            color: rgba(45, 52, 54, 0.7);
            margin-bottom: 15px;
        }
        .dashboard-stats {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 20px;
        }
        .stat-item {
            background-color: rgba(0, 0, 255, 0.05);
            border-radius: 8px;
            padding: 15px;
            flex: 1;
            min-width: 150px;
        }
        .stat-number {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--blue);
            margin-bottom: 5px;
        }
        .stat-label {
            font-size: 0.9rem;
            color: var(--dracula);
        }
        .action-btn {
            display: inline-block;
            background-color: var(--blue);
            color: var(--white);
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }
        .action-btn:hover {
            background-color: var(--dracula);
        }
        .logout-link {
            display: inline-block;
            margin-top: 20px;
            color: var(--dracula);
            text-decoration: none;
            font-size: 0.9rem;
        }
        .logout-link:hover {
            color: var(--blue);
            text-decoration: underline;
        }
        @media (min-width: 750px) {
            .dashboard-grid {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 25px;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <header class="header">
        <div class="container">
            <div class="row">
                <div class="col left">
                    <a href="../index.php" class="logo-link">
                        <img src="../img/logo.svg" alt="DomusCarta Logo" class="logo">
                    </a>
                </div>
                <div class="col right">
                    <nav class="main-nav">
                        <ul class="nav-list">
                            <li class="nav-item"><a href="../index.php" class="nav-link">Inicio</a></li>
                            <li class="nav-item"><a href="#" class="nav-link">Red Social</a></li>
                            <li class="nav-item"><a href="#" class="nav-link">Marketplace</a></li>
                            <li class="nav-item"><a href="#" class="nav-link">Eventos</a></li>
                            <li class="nav-item"><a href="#" class="nav-link">#Colector</a></li>
                            <li class="nav-item"><a href="logout.php" class="btn-empieza">Cerrar Sesión</a></li>
                        </ul>
                    </nav>
                    <div class="burger-menu" id="burgerMenu">
                        <i class="bi bi-list"></i>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Dashboard Content -->
    <main>
        <div class="container dashboard-container">
            <div class="dashboard-header">
                <h1>Bienvenido, <?php echo htmlspecialchars($user['username']); ?></h1>
                <p>Gestiona tu colección, participa en la comunidad y explora el marketplace.</p>
            </div>
            
            <div class="dashboard-grid">
                <!-- Collection Card -->
                <div class="dashboard-card">
                    <h2>Mi Colección</h2>
                    <p>Gestiona tus cartas Pokémon, añade nuevas a tu colección y mantén un registro de su valor.</p>
                    
                    <div class="dashboard-stats">
                        <div class="stat-item">
                            <div class="stat-number">0</div>
                            <div class="stat-label">Cartas en colección</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">0€</div>
                            <div class="stat-label">Valor estimado</div>
                        </div>
                    </div>
                    
                    <div style="margin-top: 20px;">
                        <a href="#" class="action-btn">Ver Colección</a>
                    </div>
                </div>
                
                <!-- Community Card -->
                <div class="dashboard-card">
                    <h2>Comunidad</h2>
                    <p>Conecta con otros coleccionistas, participa en foros y comparte tu pasión por las cartas Pokémon.</p>
                    
                    <div class="dashboard-stats">
                        <div class="stat-item">
                            <div class="stat-number">0</div>
                            <div class="stat-label">Mensajes enviados</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">0</div>
                            <div class="stat-label">Conexiones</div>
                        </div>
                    </div>
                    
                    <div style="margin-top: 20px;">
                        <a href="#" class="action-btn">Explorar Comunidad</a>
                    </div>
                </div>
                
                <!-- Marketplace Card -->
                <div class="dashboard-card">
                    <h2>Marketplace</h2>
                    <p>Compra y vende cartas Pokémon en el marketplace exclusivo para coleccionistas españoles.</p>
                    
                    <div class="dashboard-stats">
                        <div class="stat-item">
                            <div class="stat-number">0</div>
                            <div class="stat-label">Compras realizadas</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">0</div>
                            <div class="stat-label">Ventas completadas</div>
                        </div>
                    </div>
                    
                    <div style="margin-top: 20px;">
                        <a href="#" class="action-btn">Ir al Marketplace</a>
                    </div>
                </div>
                
                <!-- Events Card -->
                <div class="dashboard-card">
                    <h2>Eventos</h2>
                    <p>Descubre torneos y eventos de Pokémon en toda España, y conecta con la comunidad en persona.</p>
                    
                    <div class="dashboard-stats">
                        <div class="stat-item">
                            <div class="stat-number">0</div>
                            <div class="stat-label">Eventos próximos</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">0</div>
                            <div class="stat-label">Eventos asistidos</div>
                        </div>
                    </div>
                    
                    <div style="margin-top: 20px;">
                        <a href="#" class="action-btn">Ver Calendario</a>
                    </div>
                </div>
            </div>
            
            <div style="text-align: center;">
                <a href="logout.php" class="logout-link">Cerrar Sesión</a>
            </div>
        </div>
    </main>
    
    <!-- Scripts -->
    <script src="../js/functions.js"></script>
</body>
</html>
