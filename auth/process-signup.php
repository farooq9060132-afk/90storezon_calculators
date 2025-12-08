<?php
// Start session
session_start();

// Include user manager
require_once 'user-manager.php';

// Check if request method is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: signup.php');
    exit;
}

// Get form data
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
$confirmPassword = $_POST['confirm_password'] ?? '';
$terms = isset($_POST['terms']);
$newsletter = isset($_POST['newsletter']);

// Validate input
$errors = [];

if (empty($name)) {
    $errors[] = 'Please enter your full name.';
}

if (empty($email)) {
    $errors[] = 'Please enter your email address.';
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Please enter a valid email address.';
}

if (empty($password)) {
    $errors[] = 'Please create a password.';
} elseif (strlen($password) < 8) {
    $errors[] = 'Password must be at least 8 characters long.';
}

if ($password !== $confirmPassword) {
    $errors[] = 'Passwords do not match.';
}

if (!$terms) {
    $errors[] = 'You must agree to the Terms of Service and Privacy Policy.';
}

// Process signup if no errors
if (empty($errors)) {
    try {
        $userManager = new UserManager();
        
        // Check if email already exists
        if ($userManager->emailExists($email)) {
            $errors[] = 'This email is already registered. Please use a different email or sign in.';
        } else {
            // Create new user
            $user = $userManager->createUser($name, $email, $password, $newsletter);
            
            if ($user) {
                // Set session variables
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['logged_in'] = true;
                $_SESSION['login_method'] = 'email';
                
                // Set a success message
                $_SESSION['success'] = 'Registration successful! Welcome to 90storezon.';
                
                // Redirect to home page
                header('Location: ../index.php');
                exit;
            } else {
                $errors[] = 'Registration failed. Please try again.';
            }
        }
    } catch (Exception $e) {
        error_log('Registration error: ' . $e->getMessage());
        $errors[] = 'An error occurred during registration. Please try again.';
    }
}

// Handle errors
if (!empty($errors)) {
    // Store errors in session and redirect back to signup
    $_SESSION['error'] = implode('<br>', $errors);
    $_SESSION['form_data'] = $_POST;
    header('Location: signup.php');
    exit;
}
?>