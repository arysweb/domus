/**
 * Notifications JavaScript
 * Handles the notification dropdown functionality and AJAX updates
 */

document.addEventListener('DOMContentLoaded', function() {
    // Elements
    const notificationIcon = document.getElementById('notification-icon');
    const notificationDropdown = document.getElementById('notification-dropdown');
    const notificationBadge = document.getElementById('notification-badge');
    const dropdownNotifications = document.getElementById('dropdown-notifications');
    
    // Toggle dropdown when clicking the notification icon
    notificationIcon.addEventListener('click', function(e) {
        e.preventDefault();
        notificationDropdown.classList.toggle('show');
        
        // If opening the dropdown, load notifications
        if (notificationDropdown.classList.contains('show')) {
            loadNotifications();
        }
    });
    
    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
        if (!notificationIcon.contains(e.target) && !notificationDropdown.contains(e.target)) {
            notificationDropdown.classList.remove('show');
        }
    });
    
    // Load notifications via AJAX
    function loadNotifications() {
        fetch('includes/get_notifications.php')
            .then(response => response.json())
            .then(data => {
                updateNotificationBadge(data.notifications);
                renderNotifications(data.notifications);
            })
            .catch(error => console.error('Error loading notifications:', error));
    }
    
    // Update notification badge
    function updateNotificationBadge(notifications) {
        console.log('Updating badge with', notifications.length, 'notifications');
        const unreadCount = notifications.length;
        
        if (unreadCount > 0) {
            notificationBadge.textContent = unreadCount > 9 ? '9+' : unreadCount;
            notificationBadge.style.display = 'block';
            console.log('Badge should be visible with count:', unreadCount);
        } else {
            notificationBadge.style.display = 'none';
            console.log('Badge should be hidden');
        }
    }
    
    // Render notifications in the dropdown
    function renderNotifications(notifications) {
        dropdownNotifications.innerHTML = '';
        
        if (notifications.length === 0) {
            dropdownNotifications.innerHTML = '<div class="no-notifications">No tienes notificaciones nuevas</div>';
            return;
        }
        
        // Sort notifications by date (newest first)
        notifications.sort((a, b) => {
            return new Date(b.created_at) - new Date(a.created_at);
        });
        
        notifications.forEach(notification => {
            const notificationElement = document.createElement('div');
            notificationElement.className = 'dropdown-notification';
            notificationElement.dataset.notificationId = notification.id;
            
            // Create the message element with appropriate opacity
            const messageStyle = notification.is_read === '1' ? 'opacity: 0.5;' : '';
            
            // Format the time
            const createdAt = new Date(notification.created_at);
            const now = new Date();
            const diffMs = now - createdAt;
            const diffMins = Math.round(diffMs / 60000);
            const diffHours = Math.round(diffMs / 3600000);
            const diffDays = Math.round(diffMs / 86400000);
            
            let timeString;
            if (diffMins < 60) {
                timeString = `${diffMins} min${diffMins !== 1 ? 's' : ''}`;
            } else if (diffHours < 24) {
                timeString = `${diffHours} hora${diffHours !== 1 ? 's' : ''}`;
            } else {
                timeString = `${diffDays} día${diffDays !== 1 ? 's' : ''}`;
            }
            
            // Set notification type to Sistema for all notifications
            let notificationType = 'Sistema';
            let badgeColor = '#0000ff'; // Blue color
            
            notificationElement.innerHTML = `
                <div class="dropdown-notification-header">
                    <div class="notification-type-badge" style="background-color: ${badgeColor}">${notificationType}</div>
                    <div class="notification-time">${timeString}</div>
                </div>
                <div class="dropdown-notification-message" style="${messageStyle}">${notification.message}</div>
                <div class="dropdown-notification-actions">
                    <button class="dropdown-notification-btn read-btn" onclick="markAsRead(${notification.id})">
                        <i class="bi bi-check2"></i> Leído
                    </button>
                    <button class="dropdown-notification-btn dismiss-btn" onclick="dismissNotification(${notification.id})">
                        <i class="bi bi-x"></i> Borrar
                    </button>
                </div>
            `;
            
            dropdownNotifications.appendChild(notificationElement);
        });
    }
    
    // Check for new notifications periodically
    setInterval(function() {
        if (!notificationDropdown.classList.contains('show')) {
            // Only update the badge if dropdown is closed
            fetch('includes/get_notifications.php')
                .then(response => response.json())
                .then(data => {
                    updateNotificationBadge(data.notifications);
                })
                .catch(error => console.error('Error checking notifications:', error));
        }
    }, 60000); // Check every minute
    
    // Initial load of notification count
    loadNotifications();
});

// Mark notification as read
function markAsRead(notificationId) {
    fetch('includes/notification_actions.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'action=mark_read&notification_id=' + notificationId
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Apply read styling to just the message text
            const notification = document.querySelector(`.dropdown-notification[data-notification-id="${notificationId}"]`);
            const messageElement = notification.querySelector('.dropdown-notification-message');
            messageElement.style.opacity = '0.3';
            
            // Update the notification count (only unread count for the badge)
            updateNotificationCount();
        }
    });
}

// Dismiss notification
function dismissNotification(notificationId) {
    fetch('includes/notification_actions.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'action=dismiss&notification_id=' + notificationId
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Remove the notification from the dropdown
            const notification = document.querySelector(`.dropdown-notification[data-notification-id="${notificationId}"]`);
            notification.style.opacity = '0';
            setTimeout(() => {
                notification.remove();
                updateNotificationCount();
            }, 300);
        }
    });
}

// Update notification count after an action
function updateNotificationCount() {
    // We need to fetch the current notification status from the server
    fetch('includes/get_notifications.php')
        .then(response => response.json())
        .then(data => {
            const notificationBadge = document.getElementById('notification-badge');
            // Count unread notifications
            const unreadCount = data.notifications.filter(notification => notification.is_read === '0').length;
            
            if (unreadCount > 0) {
                notificationBadge.textContent = unreadCount > 9 ? '9+' : unreadCount;
                notificationBadge.style.display = 'block';
                console.log('Badge should be visible with count:', unreadCount);
            } else {
                notificationBadge.style.display = 'none';
                console.log('Badge should be hidden');
            }
        })
        .catch(error => console.error('Error updating notification count:', error));
}
