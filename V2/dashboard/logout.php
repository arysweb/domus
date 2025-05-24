<?php
// Set the root path for includes
$rootPath = '../';

// Include necessary files
require_once '../inc/db_connect.php';
require_once '../inc/session.php';
require_once '../inc/auth_functions.php';

// Log the user out
logout();

// Redirect to home page
header('Location: ../index.php');
exit;
?>
