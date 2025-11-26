<?php
// auth/process-signin.php (Additional file for form processing)
session_start();

// Include user manager
require_once 'user-manager.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'] ?? '';
    $remember = isset($_POST['remember']);
    
    // Validate input
    if (empty($email) || empty($password)) {
        $_SESSION['error'] = 'Please fill in all required fields.';
        header('Location: signin.php');
        exit;
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = 'Please enter a valid email address.';
        header('Location: signin.php');
        exit;
    }
    
    // Verify user credentials
    $userManager = new UserManager();
    $user = $userManager->verifyUserCredentials($email, $password);
    
    if ($user) {
        // Set session variables
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['logged_in'] = true;
        $_SESSION['login_method'] = 'email';
        
        // Set remember me cookie if requested
        if ($remember) {
            setRememberMeCookie($user['id'], $userManager);
        }
        
        // Redirect to appropriate page
        if (isset($_SESSION['redirect_url'])) {
            $redirectUrl = $_SESSION['redirect_url'];
            unset($_SESSION['redirect_url']);
            header('Location: ' . $redirectUrl);
        } else {
            header('Location: ../index.php');
        }
        exit;
    } else {
        $_SESSION['error'] = 'Invalid email or password.';
        header('Location: signin.php');
        exit;
    }
} else {
    header('Location: signin.php');
    exit;
}

function setRememberMeCookie($userId, $userManager) {
    // Generate and set remember me token
    $token = bin2hex(random_bytes(32));
    $expiry = time() + (30 * 24 * 60 * 60); // 30 days
    
    // Store token
    $userManager->storeRememberToken($userId, $token, $expiry);
    
    // Set cookie
    setcookie('remember_token', $token, $expiry, '/', '', true, true);
}
?>