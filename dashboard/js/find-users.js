/**
 * find-users.js - JavaScript for the find users page
 * Handles grid/list view toggling, filtering, and infinite scroll functionality
 */

document.addEventListener('DOMContentLoaded', function() {
    const gridView = document.getElementById('usersGridView');
    const listView = document.getElementById('usersListView');
    const viewButtons = document.querySelectorAll('.view-btn');
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
    

    
    // Filter functionality
    filterSelect.addEventListener('change', function() {
        // Reset pagination when filtering
        currentPage = 1;
        hasMoreUsers = true;
        filterUsers('', this.value);
    });
    
    function filterUsers(searchTerm, filterType) {
        const userCards = document.querySelectorAll('.user-card');
        const userListItems = document.querySelectorAll('.user-list-item');
        
        // Filter grid view
        userCards.forEach(card => {
            const badges = card.querySelectorAll('.user-card-badges span');
            let shouldShow = true;
            
            if (filterType !== 'all') {
                let hasMatchingBadge = false;
                badges.forEach(badge => {
                    if ((filterType === 'collectors' && badge.classList.contains('colecter-badge')) ||
                        (filterType === 'sellers' && badge.classList.contains('seller-badge')) ||
                        (filterType === 'buyers' && badge.classList.contains('comprador-badge'))) {
                        hasMatchingBadge = true;
                    }
                });
                shouldShow = hasMatchingBadge;
            }
            
            card.style.display = shouldShow ? 'block' : 'none';
        });
        
        // Filter list view
        userListItems.forEach(item => {
            const badges = item.querySelectorAll('.user-list-badges span');
            let shouldShow = true;
            
            if (filterType !== 'all') {
                let hasMatchingBadge = false;
                badges.forEach(badge => {
                    if ((filterType === 'collectors' && badge.classList.contains('colecter-badge')) ||
                        (filterType === 'sellers' && badge.classList.contains('seller-badge')) ||
                        (filterType === 'buyers' && badge.classList.contains('comprador-badge'))) {
                        hasMatchingBadge = true;
                    }
                });
                shouldShow = hasMatchingBadge;
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
                bio: 'Coleccionista de cartas Pokémon desde 2010. Especializado en cartas raras y ediciones limitadas.',
                following: Math.floor(Math.random() * 200) + 50,
                followers: Math.floor(Math.random() * 100) + 10
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
            
            // Create card content container
            const cardContent = document.createElement('div');
            cardContent.className = 'user-card-content';
            
            // Create avatar
            const avatarDiv = document.createElement('div');
            avatarDiv.className = 'user-card-avatar';
            const avatarImg = document.createElement('img');
            avatarImg.src = 'img/profile-avatar-placeholder.jpg';
            avatarImg.alt = 'Avatar';
            avatarImg.className = 'user-avatar';
            avatarDiv.appendChild(avatarImg);
            
            // Create info section
            const infoDiv = document.createElement('div');
            infoDiv.className = 'user-card-info';
            
            // Create username
            const nameHeading = document.createElement('h3');
            nameHeading.className = 'user-card-name';
            nameHeading.textContent = user.username;
            
            // Create bio
            const bioP = document.createElement('p');
            bioP.className = 'user-card-bio';
            bioP.textContent = user.bio;
            
            // Create stats
            const statsDiv = document.createElement('div');
            statsDiv.className = 'user-card-stats';
            
            // Following stat
            const followingDiv = document.createElement('div');
            followingDiv.className = 'stat-item';
            const followingNum = document.createElement('span');
            followingNum.className = 'stat-number';
            followingNum.textContent = user.following;
            const followingLabel = document.createElement('span');
            followingLabel.className = 'stat-label';
            followingLabel.textContent = 'Siguiendo';
            followingDiv.appendChild(followingNum);
            followingDiv.appendChild(followingLabel);
            
            // Followers stat
            const followersDiv = document.createElement('div');
            followersDiv.className = 'stat-item';
            const followersNum = document.createElement('span');
            followersNum.className = 'stat-number';
            followersNum.textContent = user.followers;
            const followersLabel = document.createElement('span');
            followersLabel.className = 'stat-label';
            followersLabel.textContent = 'Seguidores';
            followersDiv.appendChild(followersNum);
            followersDiv.appendChild(followersLabel);
            
            // Add stats to stats container
            statsDiv.appendChild(followingDiv);
            statsDiv.appendChild(followersDiv);
            
            // Create actions
            const actionsDiv = document.createElement('div');
            actionsDiv.className = 'user-card-actions';
            
            // Follow button
            const followBtn = document.createElement('button');
            followBtn.className = 'btn btn-follow';
            const followIcon = document.createElement('i');
            followIcon.className = 'bi bi-person-plus';
            followBtn.appendChild(followIcon);
            followBtn.appendChild(document.createTextNode(' Seguir'));
            
            // Profile button
            const profileBtn = document.createElement('button');
            profileBtn.className = 'btn btn-profile';
            const profileIcon = document.createElement('i');
            profileIcon.className = 'bi bi-person';
            profileBtn.appendChild(profileIcon);
            profileBtn.appendChild(document.createTextNode(' Ver Perfil'));
            
            // Add buttons to actions
            actionsDiv.appendChild(followBtn);
            actionsDiv.appendChild(profileBtn);
            
            // Build the card structure
            infoDiv.appendChild(nameHeading);
            infoDiv.appendChild(bioP);
            infoDiv.appendChild(statsDiv);
            infoDiv.appendChild(actionsDiv);
            
            cardContent.appendChild(avatarDiv);
            cardContent.appendChild(infoDiv);
            gridItem.appendChild(cardContent);
            gridView.appendChild(gridItem);
            
            // Create list view item
            const listItem = document.createElement('div');
            listItem.className = 'user-list-item';
            
            // Create list avatar
            const listAvatarDiv = document.createElement('div');
            listAvatarDiv.className = 'user-list-avatar';
            const listAvatarImg = document.createElement('img');
            listAvatarImg.src = 'img/profile-avatar-placeholder.jpg';
            listAvatarImg.alt = 'Avatar';
            listAvatarDiv.appendChild(listAvatarImg);
            
            // Create list info
            const listInfoDiv = document.createElement('div');
            listInfoDiv.className = 'user-list-info';
            
            // List name
            const listNameDiv = document.createElement('div');
            listNameDiv.className = 'user-list-name';
            listNameDiv.textContent = user.username;
            
            // List location
            const listLocationDiv = document.createElement('div');
            listLocationDiv.className = 'user-list-location';
            listLocationDiv.textContent = user.location;
            
            // List bio
            const listBioDiv = document.createElement('div');
            listBioDiv.className = 'user-list-bio';
            listBioDiv.textContent = user.bio;
            
            // Build list info
            listInfoDiv.appendChild(listNameDiv);
            listInfoDiv.appendChild(listLocationDiv);
            listInfoDiv.appendChild(listBioDiv);
            
            // Create list actions
            const listActionsDiv = document.createElement('div');
            listActionsDiv.className = 'user-list-actions';
            
            // List follow button
            const listFollowBtn = document.createElement('button');
            listFollowBtn.className = 'btn-follow-small';
            const listFollowIcon = document.createElement('i');
            listFollowIcon.className = 'bi bi-person-plus';
            listFollowBtn.appendChild(listFollowIcon);
            listFollowBtn.appendChild(document.createTextNode(' Seguir'));
            
            // List profile button
            const listProfileBtn = document.createElement('button');
            listProfileBtn.className = 'btn-profile-small';
            const listProfileIcon = document.createElement('i');
            listProfileIcon.className = 'bi bi-person';
            listProfileBtn.appendChild(listProfileIcon);
            listProfileBtn.appendChild(document.createTextNode(' Ver Perfil'));
            
            // Add buttons to list actions
            listActionsDiv.appendChild(listFollowBtn);
            listActionsDiv.appendChild(listProfileBtn);
            
            // Build list item
            listItem.appendChild(listAvatarDiv);
            listItem.appendChild(listInfoDiv);
            listItem.appendChild(listActionsDiv);
            listView.appendChild(listItem);
        });
        
        // Apply current filters to new items
        filterUsers('', filterSelect.value);
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
