<?php
// Set the root path for includes
$rootPath = '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>DomusCarta | Comunidad de Coleccionistas de Cartas Pokémon</title>
    <?php include 'inc/head.php'; ?>
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
                        <li class="nav-item"><a href="auth/login.php" class="btn-empieza">Empieza Ya!</a></li>
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
                    <div class="action-links">
                        <a href="auth/login.php" class="hero-btn">Empieza Ahora</a>
                        <a href="#" class="hero-link">Como Funciona?</a>
                    </div>
                    
                    <!-- Statistics Row -->
                    <div class="stats-row">
                        <div class="stat-col">
                            <span class="stat-number">300k+</span>
                            <span class="stat-label">Usuarios<br>activos</span>
                        </div>
                        <div class="stat-divider"></div>
                        <div class="stat-col">
                            <span class="stat-number">100k+</span>
                            <span class="stat-label">Cartas<br>Vendidas</span>
                        </div>
                        <div class="stat-divider"></div>
                        <div class="stat-col">
                            <span class="stat-number">50+</span>
                            <span class="stat-label">Eventos<br>Mensuales</span>
                        </div>
                    </div>
                </div>
                <!-- Image Column (will be first on mobile) -->
                <div class="hero-col img-col">
                    <img src="img/hero-bg.svg" alt="DomusCarta Hero" class="hero-img">
                </div>
            </div>
        </div>
    </section>
    
    <!-- Two-Column Section (Reusable) -->
    <section class="two-column-section redsocial-section">
        <div class="container">
            <div class="two-column-row">
                <!-- Image Column -->
                <div class="two-column-col img-col">
                    <img src="img/section_bg_1.svg" alt="Feature Image" class="feature-img section-img-1">
                </div>
                <!-- Content Column -->
                <div class="two-column-col content-col">
                    <span class="section-subtitle">@Red Social</span>
                    <h2 class="section-title">Título de la Sección</h2>
                    <p class="section-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in dui mauris. Vivamus hendrerit arcu sed erat molestie vehicula. Sed auctor neque eu tellus rhoncus ut eleifend nibh porttitor.</p>
                    
                    <div class="action-links">
                        <a href="#" class="hero-btn">Saber Más</a>
                        <a href="#" class="hero-link">Explorar Opciones</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Second Two-Column Section with Reversed Layout -->
    <section class="two-column-section">
        <div class="container">
            <div class="two-column-row">
                <!-- Content Column (on the left when inverted) -->
                <div class="two-column-col content-col">
                    <span class="section-subtitle">@Marketplace</span>
                    <h2 class="section-title">Compra y Vende Cartas Pokémon</h2>
                    <p class="section-text">Nuestra plataforma de marketplace te permite comprar y vender cartas Pokémon de forma segura y sencilla. Conectamos coleccionistas de toda España para facilitar el intercambio de cartas.</p>
                    
                    <div class="action-links">
                        <a href="#" class="hero-btn">Explorar Marketplace</a>
                        <a href="#" class="hero-link">Cómo Funciona?</a>
                    </div>
                </div>
                <!-- Image Column (on the right when inverted) -->
                <div class="two-column-col img-col">
                    <img src="img/section_bg_2.svg" alt="Marketplace Image" class="feature-img section-img-2">
                </div>
            </div>
        </div>
    </section>
    
    <!-- Cards Marquee Section -->
    <section class="cards-marquee-section">
        <div class="container">
            <div class="marquee-title-row">
                <span class="section-subtitle">Destaca</span>
                <h2 class="section-title">Vende lo que no necesitas, compra lo que te falta!</h2>
            </div>
            <div class="marquee-container">
                <div class="marquee-track">
                <!-- First set of cards -->
                <div class="marquee-content">
                    <img src="img/cards/SV09_EN_105-2x.png" alt="Pokémon Card" class="card-img">
                    <img src="img/cards/SV09_EN_111-2x.png" alt="Pokémon Card" class="card-img">
                    <img src="img/cards/SV09_EN_117-2x.png" alt="Pokémon Card" class="card-img">
                    <img src="img/cards/SV09_EN_138-2x.png" alt="Pokémon Card" class="card-img">
                    <img src="img/cards/SV09_EN_15-2x.png" alt="Pokémon Card" class="card-img">
                    <img src="img/cards/SV09_EN_158-2x.png" alt="Pokémon Card" class="card-img">
                    <img src="img/cards/SV09_EN_16-2x.png" alt="Pokémon Card" class="card-img">
                    <img src="img/cards/SV09_EN_161-2x.png" alt="Pokémon Card" class="card-img">
                    <img src="img/cards/SV09_EN_162-2x.png" alt="Pokémon Card" class="card-img">
                    <img src="img/cards/SV09_EN_166-2x.png" alt="Pokémon Card" class="card-img">
                </div>
                <!-- Duplicate for seamless looping -->
                <div class="marquee-content">
                    <img src="img/cards/SV09_EN_168-2x.png" alt="Pokémon Card" class="card-img">
                    <img src="img/cards/SV09_EN_173-2x.png" alt="Pokémon Card" class="card-img">
                    <img src="img/cards/SV09_EN_176-2x.png" alt="Pokémon Card" class="card-img">
                    <img src="img/cards/SV09_EN_177-2x.png" alt="Pokémon Card" class="card-img">
                    <img src="img/cards/SV09_EN_180-2x.png" alt="Pokémon Card" class="card-img">
                    <img src="img/cards/SV09_EN_181-2x.png" alt="Pokémon Card" class="card-img">
                    <img src="img/cards/SV09_EN_182-2x.png" alt="Pokémon Card" class="card-img">
                    <img src="img/cards/SV09_EN_184-2x.png" alt="Pokémon Card" class="card-img">
                    <img src="img/cards/SV09_EN_186-2x.png" alt="Pokémon Card" class="card-img">
                    <img src="img/cards/SV09_EN_187-2x.png" alt="Pokémon Card" class="card-img">
                </div>
            </div>
        </div>
    </section>
    
    <!-- Third Two-Column Section (Image Left, Text Right) -->
    <section class="two-column-section comunidad-section">
        <div class="container">
            <div class="two-column-row">
                <!-- Image Column (on the left) -->
                <div class="two-column-col img-col">
                    <img src="img/section_bg_3.svg" alt="Eventos Image" class="feature-img section-img-3">
                </div>
                <!-- Content Column (on the right) -->
                <div class="two-column-col content-col">
                    <span class="section-subtitle">@Comunidad</span>
                    <h2 class="section-title">Participa en Torneos y Eventos</h2>
                    <p class="section-text">Descubre los próximos torneos y eventos de Pokémon en toda España. Conecta con otros coleccionistas, intercambia cartas y demuestra tus habilidades en competiciones oficiales.</p>
                    
                    <div class="action-links">
                        <a href="auth/login.php" class="hero-btn">Ver Eventos</a>
                        <a href="#" class="hero-link">Calendario</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Fourth Two-Column Section (Text Left, Image Right) -->
    <section class="two-column-section">
        <div class="container">
            <div class="two-column-row">
                <!-- Content Column (on the left) -->
                <div class="two-column-col content-col">
                    <span class="section-subtitle">@Coleccionista</span>
                    <h2 class="section-title">Gestiona tu Colección</h2>
                    <p class="section-text">Organiza y gestiona tu colección de cartas Pokémon con nuestras herramientas. Lleva un registro de tus cartas, su valor y las que te faltan para completar tu colección.</p>
                    
                    <div class="action-links">
                        <a href="auth/login.php" class="hero-btn">Mi Colección</a>
                        <a href="#" class="hero-link">Ver Tutorial</a>
                    </div>
                </div>
                <!-- Image Column (on the right) -->
                <div class="two-column-col img-col">
                    <img src="img/section_bg_4.svg" alt="Colección Image" class="feature-img section-img-4">
                </div>
            </div>
        </div>
    </section>
    
    <!-- CTA Signup Section -->
    <section class="signup-cta-section">
        <div class="container">
            <div class="cta-content">
                <h2 class="section-title">¡Únete a la comunidad!</h2>
                <p class="section-text">Conecta con coleccionistas, gestiona tu colección y participa en eventos exclusivos.</p>
                
                <div class="action-links">
                    <a href="auth/signup.php" class="hero-btn">Crear Cuenta</a>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Footer Section -->
    <footer class="footer-section">
        <div class="container">
            <div class="footer-row">
                <!-- Left Column: Logo, Description, Social -->
                <div class="footer-left">
                    <div class="footer-logo">
                        <img src="img/logo.svg" alt="DomusCarta Logo" class="logo">
                    </div>
                    <div class="footer-description">
                        <p>DomusCarta es la comunidad líder de coleccionistas de cartas Pokémon en España. Conectamos a coleccionistas, organizamos eventos y facilitamos la compra-venta de cartas.</p>
                    </div>
                    <div class="footer-social">
                        <a href="#" class="social-icon"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="social-icon"><i class="bi bi-twitter-x"></i></a>
                        <a href="#" class="social-icon"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="social-icon"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>
                
                <!-- Right Column: Navigation Links -->
                <div class="footer-right">
                    <!-- Column 1: Marketplace -->
                    <div class="footer-nav-col">
                        <h4 class="footer-heading">Marketplace</h4>
                        <ul class="footer-links">
                            <li><a href="#">Comprar</a></li>
                            <li><a href="#">Vender</a></li>
                            <li><a href="#">Intercambiar</a></li>
                            <li><a href="#">Cartas Destacadas</a></li>
                        </ul>
                    </div>
                    
                    <!-- Column 2: Comunidad -->
                    <div class="footer-nav-col">
                        <h4 class="footer-heading">Comunidad</h4>
                        <ul class="footer-links">
                            <li><a href="#">Eventos</a></li>
                            <li><a href="#">Torneos</a></li>
                            <li><a href="#">Foros</a></li>
                            <li><a href="#">Blog</a></li>
                        </ul>
                    </div>
                    
                    <!-- Column 3: Cuenta -->
                    <div class="footer-nav-col">
                        <h4 class="footer-heading">Cuenta</h4>
                        <ul class="footer-links">
                            <li><a href="auth/login.php">Iniciar Sesión</a></li>
                            <li><a href="auth/signup.php">Registrarse</a></li>
                            <li><a href="auth/login.php">Mi Colección</a></li>
                            <li><a href="#">Ayuda</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <!-- Copyright Bar -->
            <div class="copyright-bar">
                <p>&copy; 2025 DomusCarta. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>
    
    <!-- Backdrop for blur effect -->
    <div class="backdrop" id="backdrop"></div>
    
    <!-- Back to Top Button -->
    <a href="#" class="back-to-top" id="backToTop">
        <i class="bi bi-arrow-up"></i>
    </a>
    
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
                    <li class="mobile-nav-item"><a href="auth/login.php" class="mobile-nav-link">Inicio</a></li>
                    <li class="mobile-nav-item"><a href="#" class="mobile-nav-link">Red Social</a></li>
                    <li class="mobile-nav-item"><a href="#" class="mobile-nav-link">Marketplace</a></li>
                    <li class="mobile-nav-item"><a href="#" class="mobile-nav-link">Eventos</a></li>
                    <li class="mobile-nav-item"><a href="#" class="mobile-nav-link">#Colector</a></li>
                    <li class="mobile-nav-item"><a href="auth/signup.php" class="mobile-btn-empieza">Empieza Ya!</a></li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>