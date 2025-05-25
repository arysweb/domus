<?php
/**
 * Get Notifications AJAX Endpoint
 * Returns unread notifications for the current user in JSON format
 */

// Include database connection
require_once '../../inc/db_connect.php';
require_once '../../inc/session.php';

// Require login to access this functionality
require_login();

// Get user ID from session
$user_id = $_SESSION['user_id'];

// Initialize response array
$response = array(
    'success' => false,
    'notifications' => array()
);

// Function to check if user profile is incomplete
function isProfileIncomplete($conn, $user_id) {
    $query = "SELECT profile_picture_url, bio, location FROM users WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();
    
    // Check if any of the profile fields are empty
    return ($user['profile_picture_url'] === NULL || $user['bio'] === NULL || $user['location'] === NULL);
}

// Function to create a profile completion notification if needed
function createProfileNotification($conn, $user_id) {
    // Check if an active (not dismissed) profile notification exists for this user
    $checkQuery = "SELECT n.id FROM notifications n 
                  JOIN user_notifications un ON n.id = un.notification_id 
                  WHERE un.user_id = ? AND n.title = 'Completa tu perfil' AND un.is_dismissed = 0";
    $checkStmt = $conn->prepare($checkQuery);
    $checkStmt->bind_param("i", $user_id);
    $checkStmt->execute();
    $result = $checkStmt->get_result();
    
    // If no active notification exists and profile is incomplete, create it
    if ($result->num_rows == 0 && isProfileIncomplete($conn, $user_id)) {
        // First, clean up any old dismissed profile notifications for this user
        $cleanupQuery = "DELETE n FROM notifications n 
                        JOIN user_notifications un ON n.id = un.notification_id 
                        WHERE un.user_id = ? AND n.title = 'Completa tu perfil' AND un.is_dismissed = 1";
        $cleanupStmt = $conn->prepare($cleanupQuery);
        $cleanupStmt->bind_param("i", $user_id);
        $cleanupStmt->execute();
        $cleanupStmt->close();
        
        // Insert the notification
        $insertQuery = "INSERT INTO notifications (sender_id, recipient_id, title, message) 
                       VALUES (?, ?, 'Completa tu perfil', 'Para acceder a todas las funciones de DomusCarta, completa tu perfil con una foto, biografía y ubicación. Algunas funciones estarán limitadas hasta que completes esta información.')";
        $insertStmt = $conn->prepare($insertQuery);
        $admin_id = 1; // Assuming admin has ID 1
        $insertStmt->bind_param("ii", $admin_id, $user_id);
        $insertStmt->execute();
        $notification_id = $conn->insert_id;
        $insertStmt->close();
        
        // Create the user_notification junction record
        $junctionQuery = "INSERT INTO user_notifications (user_id, notification_id) VALUES (?, ?)";
        $junctionStmt = $conn->prepare($junctionQuery);
        $junctionStmt->bind_param("ii", $user_id, $notification_id);
        $junctionStmt->execute();
        $junctionStmt->close();
    }
    $checkStmt->close();
}

// First, check if the user exists in the users table
$userCheckQuery = "SELECT id FROM users WHERE id = ?";
$userCheckStmt = $conn->prepare($userCheckQuery);
$userCheckStmt->bind_param("i", $user_id);
$userCheckStmt->execute();
$userResult = $userCheckStmt->get_result();

if ($userResult->num_rows > 0) {
    // Check if user needs a profile completion notification
    createProfileNotification($conn, $user_id);
    
    // User exists, now ensure user_notifications entries exist for all applicable notifications
    // This query finds notifications that should be visible to this user but don't have a junction record yet
    $syncQuery = "INSERT INTO user_notifications (user_id, notification_id)
                  SELECT ?, n.id FROM notifications n
                  LEFT JOIN user_notifications un ON n.id = un.notification_id AND un.user_id = ?
                  WHERE (n.recipient_id = ? OR n.recipient_id IS NULL) AND un.id IS NULL";
    
    $syncStmt = $conn->prepare($syncQuery);
    $syncStmt->bind_param("iii", $user_id, $user_id, $user_id);
    $syncStmt->execute();
    $syncStmt->close();
    
    // Now get all notifications for this user that aren't dismissed
    // Add a check to ensure the notification still exists in the notifications table
    $query = "SELECT n.*, un.is_read, un.is_dismissed 
              FROM notifications n
              JOIN user_notifications un ON n.id = un.notification_id
              WHERE un.user_id = ? AND un.is_dismissed = 0 
              AND EXISTS (SELECT 1 FROM notifications WHERE id = n.id)
              ORDER BY n.created_at DESC
              LIMIT 5";
              
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $notifications = array();
    while ($row = $result->fetch_assoc()) {
        $notifications[] = $row;
    }
    
    $stmt->close();
    
    $response['success'] = true;
    $response['notifications'] = $notifications;
}
$userCheckStmt->close();

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
