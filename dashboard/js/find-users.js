/**
 * find-users.js - JavaScript for the find users page
 * Handles grid/list view toggling, filtering, and infinite scroll functionality
 */

document.addEventListener('DOMContentLoaded', function() {
    const gridView = document.getElementById('usersGridView');
    const listView = document.getElementById('usersListView');
    const viewButtons = document.querySelectorAll('.view-btn');
    const searchInput = document.getElementById('userSearchInput');
    const filterSelect = document.getElementById('userFilterSelect');
    const loadingIndicator = document.getElementById('loadingIndicator');
    
    // Current page and loading state
    let currentPage = 1;
    let isLoading = false;
    let hasMoreUsers = true;
    let activeView = 'grid';
    
    // Toggle between grid and list views
    viewButtons.forEach(button => {
        button.addEventListener('click', function() {
            viewButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            
            const viewType = this.getAttribute('data-view');
            activeView = viewType;
            
            if (viewType === 'grid') {
                gridView.style.display = 'grid';
                listView.style.display = 'none';
            } else {
                gridView.style.display = 'none';
                listView.style.display = 'block';
            }
        });
    });
    
    // Search functionality
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        // Reset pagination when searching
        currentPage = 1;
        hasMoreUsers = true;
        filterUsers(searchTerm, filterSelect.value);
    });
    
    // Filter functionality
    filterSelect.addEventListener('change', function() {
        // Reset pagination when filtering
        currentPage = 1;
        hasMoreUsers = true;
        filterUsers(searchInput.value.toLowerCase(), this.value);
    });
    
    function filterUsers(searchTerm, filterType) {
        const userCards = document.querySelectorAll('.user-card');
        const userListItems = document.querySelectorAll('.user-list-item');
        
        // Filter grid view
        userCards.forEach(card => {
            const userName = card.querySelector('.user-card-name').textContent.toLowerCase();
            const badges = card.querySelectorAll('.user-card-badges span');
            let shouldShow = userName.includes(searchTerm);
            
            if (filterType !== 'all') {
                let hasMatchingBadge = false;
                badges.forEach(badge => {
                    if ((filterType === 'collectors' && badge.classList.contains('colecter-badge')) ||
                        (filterType === 'sellers' && badge.classList.contains('seller-badge')) ||
                        (filterType === 'buyers' && badge.classList.contains('comprador-badge'))) {
                        hasMatchingBadge = true;
                    }
                });
                shouldShow = shouldShow && hasMatchingBadge;
            }
            
            card.style.display = shouldShow ? 'block' : 'none';
        });
        
        // Filter list view
        userListItems.forEach(item => {
            const userName = item.querySelector('.user-list-name').textContent.toLowerCase();
            const badges = item.querySelectorAll('.user-list-badges span');
            let shouldShow = userName.includes(searchTerm);
            
            if (filterType !== 'all') {
                let hasMatchingBadge = false;
                badges.forEach(badge => {
                    if ((filterType === 'collectors' && badge.classList.contains('colecter-badge')) ||
                        (filterType === 'sellers' && badge.classList.contains('seller-badge')) ||
                        (filterType === 'buyers' && badge.classList.contains('comprador-badge'))) {
                        hasMatchingBadge = true;
                    }
                });
                shouldShow = shouldShow && hasMatchingBadge;
            }
            
            item.style.display = shouldShow ? 'flex' : 'none';
        });
    }
    
    // Function to load more users
    function loadMoreUsers() {
        if (isLoading || !hasMoreUsers) return;
        
        isLoading = true;
        loadingIndicator.style.display = 'flex';
        
        // Simulate AJAX request with setTimeout
        setTimeout(() => {
            // In a real implementation, this would be an AJAX call to your server
            // fetch(`/api/users?page=${currentPage}&filter=${filterSelect.value}&search=${searchInput.value}`)
            
            // For demo purposes, we'll create dummy users
            const newUsers = generateDummyUsers(10, currentPage);
            
            if (newUsers.length === 0) {
                hasMoreUsers = false;
                loadingIndicator.style.display = 'none';
                isLoading = false;
                return;
            }
            
            // Add new users to the DOM
            appendUsersToDOM(newUsers);
            
            currentPage++;
            isLoading = false;
            loadingIndicator.style.display = 'none';
            
            // If we've loaded 5 pages, simulate no more users for demo
            if (currentPage > 5) {
                hasMoreUsers = false;
            }
        }, 1000); // Simulate network delay
    }
    
    // Function to generate dummy users for demo
    function generateDummyUsers(count, page) {
        const users = [];
        const startIndex = (page - 1) * count;
        
        for (let i = 0; i < count; i++) {
            const index = startIndex + i;
            users.push({
                id: index + 1,
                username: `Usuario${index + 1}`,
                location: 'Barcelona, España',
                badges: ['profile-badge', 'colecter-badge']
            });
        }
        
        return users;
    }
    
    // Function to append users to the DOM
    function appendUsersToDOM(users) {
        users.forEach(user => {
            // Create grid view item
            const gridItem = document.createElement('div');
            gridItem.className = 'user-card';
            gridItem.innerHTML = `
                <div class="user-card-content">
                    <div class="user-card-avatar">
                        <img src="img/profile-avatar-placeholder.jpg" alt="Avatar" class="user-avatar">
                    </div>
                    <div class="user-card-info">
                        <h3 class="user-card-name">${user.username}</h3>
                        <div class="user-card-location">
                            <i class="bi bi-geo-alt-fill"></i>
                            <span>${user.location}</span>
                        </div>
                        <div class="user-card-badges">
                            <span class="profile-badge">
                                <i class="bi bi-award-fill"></i> Oro
                            </span>
                            <span class="colecter-badge">
                                <i class="bi bi-award-fill"></i> Leyenda
                            </span>
                        </div>
                    </div>
                    <div class="user-card-actions">
                        <button class="btn btn-follow"><i class="bi bi-person-plus"></i> Seguir</button>
                        <button class="btn btn-message"><i class="bi bi-chat-dots"></i> Mensaje</button>
                    </div>
                </div>
            `;
            gridView.appendChild(gridItem);
            
            // Create list view item
            const listItem = document.createElement('div');
            listItem.className = 'user-list-item';
            listItem.innerHTML = `
                <div class="user-list-avatar">
                    <img src="img/profile-avatar-placeholder.jpg" alt="Avatar">
                </div>
                <div class="user-list-info">
                    <div class="user-list-name">${user.username}</div>
                    <div class="user-list-location">${user.location}</div>
                    <div class="user-list-badges">
                        <span class="profile-badge">
                            <i class="bi bi-award-fill"></i> Oro
                        </span>
                        <span class="colecter-badge">
                            <i class="bi bi-award-fill"></i> Leyenda
                        </span>
                    </div>
                </div>
                <div class="user-list-actions">
                    <button class="btn-follow-small"><i class="bi bi-person-plus"></i> Seguir</button>
                    <button class="btn-message-small"><i class="bi bi-chat-dots"></i> Mensaje</button>
                </div>
            `;
            listView.appendChild(listItem);
        });
        
        // Apply current filters to new items
        filterUsers(searchInput.value.toLowerCase(), filterSelect.value);
    }
    
    // Infinite scroll implementation
    window.addEventListener('scroll', function() {
        // Check if we're near the bottom of the page
        if (window.innerHeight + window.scrollY >= document.body.offsetHeight - 500) {
            loadMoreUsers();
        }
    });
    
    // Initial load of users
    loadMoreUsers();
});
