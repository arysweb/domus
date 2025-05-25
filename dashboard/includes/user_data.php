<?php
/**
 * User Data
 * Retrieves user information, collection stats, and social connections
 */

// Include database connection
require_once '../inc/db_connect.php';

// Set default user ID (in a real app, this would come from the session)
$user_id = 2; // Using PokeSebas user ID from the sample data

// Initialize variables with default values
$user_data = array(
    'username' => 'Guest',
    'email' => '',
    'profile_picture_url' => null,
    'bio' => null,
    'location' => null,
    'has_cards' => false,
    'has_social_connections' => false,
    'following_count' => 0,
    'followers_count' => 0,
    'social_activities' => array()
);

// Get user data from the database
$user_query = "SELECT username, email, profile_picture_url, bio, location FROM users WHERE id = ?";
$stmt = $conn->prepare($user_query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $user_data['username'] = $user['username'];
    $user_data['email'] = $user['email'];
    $user_data['profile_picture_url'] = $user['profile_picture_url'];
    $user_data['bio'] = $user['bio'];
    $user_data['location'] = $user['location'];
    
    // Check if user has cards (this would connect to your cards table)
    // For now, we'll set it to false as a new user
    $user_data['has_cards'] = false;
    
    // Check if user follows anyone
    $following_query = "SELECT COUNT(*) as following_count FROM user_follows WHERE follower_id = ?";
    $stmt = $conn->prepare($following_query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $following_result = $stmt->get_result();
    
    if ($following_result->num_rows > 0) {
        $following_data = $following_result->fetch_assoc();
        $user_data['following_count'] = $following_data['following_count'];
        
        // If user follows at least one person, set has_social_connections to true
        if ($user_data['following_count'] > 0) {
            $user_data['has_social_connections'] = true;
        }
    }
    
    // Get followers count
    $followers_query = "SELECT COUNT(*) as followers_count FROM user_follows WHERE followed_id = ?";
    $stmt = $conn->prepare($followers_query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $followers_result = $stmt->get_result();
    
    if ($followers_result->num_rows > 0) {
        $followers_data = $followers_result->fetch_assoc();
        $user_data['followers_count'] = $followers_data['followers_count'];
    }
    
    // If user has social connections, get recent activities from people they follow
    if ($user_data['has_social_connections']) {
        $activities_query = "SELECT a.*, u.username, u.profile_picture_url 
                           FROM user_activities a 
                           JOIN users u ON a.user_id = u.id 
                           WHERE a.user_id IN (SELECT followed_id FROM user_follows WHERE follower_id = ?) 
                           ORDER BY a.created_at DESC LIMIT 5";
        $stmt = $conn->prepare($activities_query);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $activities_result = $stmt->get_result();
        
        while ($activity = $activities_result->fetch_assoc()) {
            $user_data['social_activities'][] = $activity;
        }
    }
}

// Close statement
$stmt->close();
?>
