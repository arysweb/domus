<?php
/**
 * Notification Actions
 * Handles AJAX requests for notification actions (mark as read, dismiss)
 */

// Include necessary files
require_once '../../inc/db_connect.php';
require_once '../../inc/session.php';

// Require login to access this functionality
require_login();

// Initialize response array
$response = array(
    'success' => false,
    'message' => ''
);

// Check if action and notification_id are set
if (isset($_POST['action']) && isset($_POST['notification_id'])) {
    $action = $_POST['action'];
    $notification_id = (int)$_POST['notification_id'];
    
    // Get user ID from session - already handled by require_login()
    $user_id = $_SESSION['user_id'];
    
    // Handle different actions
    switch ($action) {
        case 'mark_read':
            // Update user_notifications to mark as read for this specific user
            $query = "UPDATE user_notifications SET is_read = 1 WHERE notification_id = ? AND user_id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ii", $notification_id, $user_id);
            
            if ($stmt->execute()) {
                $response['success'] = true;
                $response['message'] = 'Notification marked as read';
            } else {
                $response['message'] = 'Failed to mark notification as read';
            }
            
            $stmt->close();
            break;
            
        case 'dismiss':
            // Update user_notifications to dismiss it for this specific user
            $query = "UPDATE user_notifications SET is_dismissed = 1 WHERE notification_id = ? AND user_id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ii", $notification_id, $user_id);
            
            if ($stmt->execute()) {
                $response['success'] = true;
                $response['message'] = 'Notification dismissed';
            } else {
                $response['message'] = 'Failed to dismiss notification';
            }
            
            $stmt->close();
            break;
            
        default:
            $response['message'] = 'Invalid action';
            break;
    }
} else {
    $response['message'] = 'Missing required parameters';
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
