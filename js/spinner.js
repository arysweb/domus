// Preloader functionality
document.addEventListener('DOMContentLoaded', function() {
    // Variables
    const preloader = document.getElementById('preloader');
    
    // Hide preloader when page is fully loaded
    window.addEventListener('load', function() {
        // Add a small delay to ensure everything is loaded
        setTimeout(function() {
            preloader.classList.add('hidden');
            
            // Remove preloader from DOM after transition completes
            setTimeout(function() {
                preloader.style.display = 'none';
            }, 500); // Match this to the transition duration in CSS
        }, 300); // Small delay before hiding
    });
});
