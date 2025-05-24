<?php
/**
 * Database Connection
 * 
 * Establishes a connection to the MySQL database using mysqli procedural method
 */

// Database configuration
$db_host = 'localhost';
$db_user = 'root';
$db_password = '';
$db_name = 'domus';

// Create connection
$conn = mysqli_connect($db_host, $db_user, $db_password, $db_name);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Set charset to ensure proper handling of special characters
mysqli_set_charset($conn, "utf8mb4");

/**
 * Helper function to safely escape user input
 * 
 * @param string $data The data to be escaped
 * @return string The escaped data
 */
function escape_input($conn, $data) {
    if (is_array($data)) {
        $escaped = [];
        foreach ($data as $key => $value) {
            $escaped[$key] = escape_input($conn, $value);
        }
        return $escaped;
    }
    
    if (is_string($data)) {
        return mysqli_real_escape_string($conn, trim($data));
    }
    
    return $data;
}
