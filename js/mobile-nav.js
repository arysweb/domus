document.addEventListener('DOMContentLoaded', function() {
    const burgerMenu = document.querySelector('.burger-icon');
    const mobileOverlay = document.querySelector('.mobile-nav-overlay');
    const closeOverlay = document.querySelector('.close-overlay');
    const mobileNavLinks = document.querySelectorAll('.mobile-nav-link');
    
    // Toggle mobile overlay when burger is clicked
    burgerMenu.addEventListener('click', function() {
        mobileOverlay.classList.add('open');
        document.body.style.overflow = 'hidden'; // Prevent scrolling when overlay is open
    });
    
    // Close overlay when close button is clicked
    closeOverlay.addEventListener('click', function() {
        mobileOverlay.classList.remove('open');
        document.body.style.overflow = ''; // Re-enable scrolling
    });
    
    // Close overlay when a mobile navigation link is clicked
    mobileNavLinks.forEach(link => {
        link.addEventListener('click', function() {
            mobileOverlay.classList.remove('open');
            document.body.style.overflow = ''; // Re-enable scrolling
        });
    });
    
    // Close overlay when ESC key is pressed
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape' && mobileOverlay.classList.contains('open')) {
            mobileOverlay.classList.remove('open');
            document.body.style.overflow = ''; // Re-enable scrolling
        }
    });
});
