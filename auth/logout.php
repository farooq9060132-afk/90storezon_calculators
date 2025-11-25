<?php
// Start session
session_start();

// Destroy session and cookies
if (isset($_SESSION['logged_in'])) {
    // Remove remember me cookie if it exists
    if (isset($_COOKIE['remember_token'])) {
        setcookie('remember_token', '', time() - 3600, '/', '', true, true);
    }
    
    // Clear all session variables
    $_SESSION = array();
    
    // Destroy the session
    session_destroy();
}

// Redirect to home page
header('Location: ../index.php');
exit;
?>