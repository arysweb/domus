/**
 * DomusCarta Dashboard JavaScript
 * Handles sidebar functionality and other dashboard interactions
 */

document.addEventListener('DOMContentLoaded', function() {
    // Sidebar toggle functionality
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('sidebar');
    const mobileToggle = document.getElementById('mobileToggle');
    
    if (sidebarToggle && sidebar) {
        sidebarToggle.addEventListener('click', function() {
            sidebar.classList.toggle('expanded');
            
            // Change icon based on sidebar state
            const icon = this.querySelector('i');
            if (sidebar.classList.contains('expanded')) {
                icon.classList.remove('bi-chevron-right');
                icon.classList.add('bi-chevron-left');
            } else {
                icon.classList.remove('bi-chevron-left');
                icon.classList.add('bi-chevron-right');
            }
        });
    }
    
    // Mobile toggle functionality
    if (mobileToggle && sidebar) {
        mobileToggle.addEventListener('click', function() {
            sidebar.classList.toggle('visible');
        });
    }
});
