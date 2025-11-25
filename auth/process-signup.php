<?php
// Start session
session_start();

// Include database connection
require_once 'db.php';

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

// Check if email already exists in database
if (empty($errors)) {
    try {
        // Check if email already exists
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        
        if ($stmt->rowCount() > 0) {
            $errors[] = 'This email is already registered. Please use a different email or sign in.';
        } else {
            // Hash the password
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            
            // Insert new user into database
            $stmt = $pdo->prepare("INSERT INTO users (name, email, password_hash, newsletter) VALUES (?, ?, ?, ?)");
            $result = $stmt->execute([$name, $email, $password_hash, $newsletter ? 1 : 0]);
            
            if ($result) {
                // Get the new user's ID
                $userId = $pdo->lastInsertId();
                
                // Set session variables
                $_SESSION['user_id'] = $userId;
                $_SESSION['user_name'] = $name;
                $_SESSION['user_email'] = $email;
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
    } catch (PDOException $e) {
        error_log('Database error: ' . $e->getMessage());
        $errors[] = 'A database error occurred. Please try again.';
    }
} else {
    // Store errors in session and redirect back to signup
    $_SESSION['error'] = implode('<br>', $errors);
    $_SESSION['form_data'] = $_POST;
    header('Location: signup.php');
    exit;
}
?>