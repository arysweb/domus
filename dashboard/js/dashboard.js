/**
 * DomusCarta Dashboard JavaScript
 * Handles sidebar functionality and other dashboard interactions
 */

document.addEventListener('DOMContentLoaded', function() {
    // Sidebar toggle functionality
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.querySelector('.sidebar');
    const mainContent = document.querySelector('.main-content');
    const toggleIcon = document.querySelector('#sidebarToggle i');
    const logoIcon = document.querySelector('.sidebar-logo-icon');
    const logoFull = document.querySelector('.sidebar-logo-full');
    
    if (sidebarToggle && sidebar) {
        sidebarToggle.addEventListener('click', function() {
            sidebar.classList.toggle('expanded');
            mainContent.classList.toggle('sidebar-expanded');
            
            // Toggle icon
            if (sidebar.classList.contains('expanded')) {
                toggleIcon.classList.remove('bi-chevron-right');
                toggleIcon.classList.add('bi-chevron-left');
                logoIcon.style.display = 'none';
                logoFull.style.display = 'block';
            } else {
                toggleIcon.classList.remove('bi-chevron-left');
                toggleIcon.classList.add('bi-chevron-right');
                logoIcon.style.display = 'block';
                logoFull.style.display = 'none';
            }
        });
    }
    
    // Custom dropdown functionality
    const dropdownSelected = document.getElementById('dropdownSelected');
    const dropdownMenu = document.getElementById('dropdownMenu');
    const dropdownItems = document.querySelectorAll('.dropdown-item');
    const customDropdown = document.getElementById('customDropdown');
    
    if (dropdownSelected && dropdownMenu && customDropdown) {
        // Toggle dropdown
        dropdownSelected.addEventListener('click', function(e) {
            e.stopPropagation(); // Prevent event from bubbling up
            
            // Position the dropdown
            const rect = this.getBoundingClientRect();
            dropdownMenu.style.width = rect.width + 'px';
            dropdownMenu.style.top = (rect.bottom + window.scrollY) + 'px';
            dropdownMenu.style.left = (rect.left + window.scrollX) + 'px';
            
            // Toggle visibility
            dropdownMenu.classList.toggle('show');
            this.classList.toggle('active');
        });
        
        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            if (!dropdownSelected.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.classList.remove('show');
                dropdownSelected.classList.remove('active');
            }
        });
        
        // Handle item selection
        dropdownItems.forEach(item => {
            item.addEventListener('click', function() {
                // Get selected text
                const selectedText = this.textContent;
                
                // Update selected display
                dropdownSelected.querySelector('span').textContent = selectedText;
                
                // Close dropdown
                dropdownMenu.classList.remove('show');
                dropdownSelected.classList.remove('active');
            });
        });
    }
    
    // Mobile toggle functionality
    const mobileToggle = document.getElementById('mobileToggle');
    if (mobileToggle && sidebar) {
        mobileToggle.addEventListener('click', function() {
            sidebar.classList.toggle('visible');
        });
    }
});
