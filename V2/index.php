<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DomusCarta</title>
    <meta name="description" content="DomusCarta website">
    <!-- Favicon -->
    <link rel="icon" href="img/favicon.svg" type="image/svg+xml">
    <link rel="alternate icon" href="favicon.ico" type="image/x-icon">
    <!-- Google Fonts - Noto Serif (all weights) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <!-- CSS -->
    <link rel="stylesheet" href="css/global.css">
    <!-- JavaScript -->
    <script src="js/functions.js" defer></script>
</head>
<body>
    <div class="container">
        <!-- Navigation Row -->
        <div class="row">
            <div class="col left">
                <!-- Logo -->
                <img src="img/logo.svg" alt="DomusCarta Logo" class="logo">
            </div>
            <div class="col right">
                <!-- Burger Icon (mobile only) -->
                <div class="burger">
                    <i class="bi bi-list"></i>
                </div>
                <!-- Desktop Navigation -->
                <nav class="desktop-nav">
                    <ul class="nav-list">
                        <li class="nav-item"><a href="#" class="nav-link">Inicio</a></li>
                        <li class="nav-item"><a href="#" class="nav-link">Red Social</a></li>
                        <li class="nav-item"><a href="#" class="nav-link">Marketplace</a></li>
                        <li class="nav-item"><a href="#" class="nav-link">Eventos</a></li>
                        <li class="nav-item"><a href="#" class="nav-link">#Colector</a></li>
                        <li class="nav-item"><a href="#" class="btn-empieza">Empieza Ya!</a></li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- End Navigation Row -->
    </div>
    
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="hero-row">
                <!-- Text Column (will be second on mobile) -->
                <div class="hero-col text-col">
                    <h1 class="hero-title">Buscas una comunidad para coleccionistas de cartas Pokémon en España?</h1>
                    <p class="hero-text">Domus es la primera y única plataforma española que integra red social, marketplace y catálogo para coleccionistas de cartas Pokémon.</p>
                    <a href="#" class="hero-btn">Empieza Ahora</a>
                </div>
                <!-- Image Column (will be first on mobile) -->
                <div class="hero-col img-col">
                    <img src="img/hero-bg.svg" alt="DomusCarta Hero" class="hero-img">
                </div>
            </div>
        </div>
    </section>
    
    <!-- Backdrop for blur effect -->
    <div class="backdrop" id="backdrop"></div>
    
    <!-- Mobile Menu Overlay -->
    <div class="mobile-overlay" id="mobileOverlay">
        <div class="container">
            <div class="row">
                <div class="col left">
                    <!-- Empty column -->
                </div>
                <div class="col right">
                    <!-- Close Icon -->
                    <div class="close-icon">
                        <i class="bi bi-x-lg"></i>
                    </div>
                </div>
            </div>
            <!-- Mobile Menu Content -->
            <div class="mobile-menu-content">
                <ul class="mobile-nav-list">
                    <li class="mobile-nav-item"><a href="#" class="mobile-nav-link">Inicio</a></li>
                    <li class="mobile-nav-item"><a href="#" class="mobile-nav-link">Red Social</a></li>
                    <li class="mobile-nav-item"><a href="#" class="mobile-nav-link">Marketplace</a></li>
                    <li class="mobile-nav-item"><a href="#" class="mobile-nav-link">Eventos</a></li>
                    <li class="mobile-nav-item"><a href="#" class="mobile-nav-link">#Colector</a></li>
                    <li class="mobile-nav-item"><a href="#" class="mobile-btn-empieza">Empieza Ya!</a></li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>