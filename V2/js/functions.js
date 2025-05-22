// DomusCarta JavaScript Functions

// Wait for DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function() {
    // Mobile menu toggle functionality
    const burgerIcon = document.querySelector('.burger');
    const mobileOverlay = document.getElementById('mobileOverlay');
    const closeIcon = document.querySelector('.close-icon');
    const backdrop = document.getElementById('backdrop');
    
    if (burgerIcon && mobileOverlay && closeIcon && backdrop) {
        // Open mobile menu when burger icon is clicked
        burgerIcon.addEventListener('click', function() {
            mobileOverlay.style.right = '0';
            backdrop.classList.add('active');
            document.body.style.overflow = 'hidden'; // Prevent scrolling of the main content
        });
        
        // Close mobile menu when close icon is clicked
        closeIcon.addEventListener('click', function() {
            mobileOverlay.style.right = '-100%';
            backdrop.classList.remove('active');
            document.body.style.overflow = ''; // Re-enable scrolling
        });
        
        // Close mobile menu when backdrop is clicked
        backdrop.addEventListener('click', function() {
            mobileOverlay.style.right = '-100%';
            backdrop.classList.remove('active');
            document.body.style.overflow = ''; // Re-enable scrolling
        });
    }
    
    // Close mobile menu when window is resized to desktop size
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 1000 && mobileOverlay && backdrop) {
            mobileOverlay.style.right = '-100%';
            backdrop.classList.remove('active');
            document.body.style.overflow = ''; // Re-enable scrolling
        }
    });
});
