/**
 * DomusCarta Mobile Navigation
 * Handles mobile sidebar toggle and navigation
 */

document.addEventListener('DOMContentLoaded', function() {
    // Get elements
    const sidebar = document.getElementById('sidebar');
    const mobileMenuToggle = document.getElementById('mobileMenuToggle');
    
    // Function to toggle sidebar
    function toggleSidebar() {
        sidebar.classList.toggle('expanded');
        document.body.classList.toggle('sidebar-open');
    }
    
    // Add click event listener for mobile menu toggle
    if (mobileMenuToggle) {
        mobileMenuToggle.addEventListener('click', function(e) {
            e.preventDefault();
            toggleSidebar();
        });
    }
    
    // Close sidebar when pressing Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && sidebar.classList.contains('expanded')) {
            toggleSidebar();
        }
    });
    
    // Handle window resize
    window.addEventListener('resize', function() {
        // If window width is greater than 1200px and sidebar is open, close it
        if (window.innerWidth > 1200 && sidebar.classList.contains('expanded')) {
            sidebar.classList.remove('expanded');
            sidebarOverlay.classList.remove('active');
            document.body.classList.remove('sidebar-open');
        }
    });
});
