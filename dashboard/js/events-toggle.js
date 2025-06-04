/**
 * Events Card Toggle Functionality
 * Handles toggling between "My Events" and "Public Events" sections
 */

document.addEventListener('DOMContentLoaded', function() {
    // Get all toggle links
    const toggleLinks = document.querySelectorAll('.event-toggle-link');
    
    // Add click event listener to each toggle link
    toggleLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Get the target section from data-target attribute
            const targetSection = this.getAttribute('data-target');
            
            // Remove active class from all links and sections
            toggleLinks.forEach(l => l.classList.remove('active'));
            document.querySelectorAll('.events-section').forEach(section => {
                section.classList.remove('active');
            });
            
            // Add active class to clicked link and target section
            this.classList.add('active');
            document.querySelector(`.events-section.${targetSection}`).classList.add('active');
        });
    });
});
