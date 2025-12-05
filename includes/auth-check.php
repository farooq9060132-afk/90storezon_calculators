<?php
session_start();

// Check if user is logged in
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Redirect to login page if not logged in
function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: /auth/signin.php');
        exit();
    }
}

// Get current user ID
function getCurrentUserId() {
    return isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
}

// Get current username
function getCurrentUsername() {
    return isset($_SESSION['username']) ? $_SESSION['username'] : null;
}
?>