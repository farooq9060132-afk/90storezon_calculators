<?php
// auth/forgot-password.php - Simplified version
session_start();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
    
    // Validate input
    if (empty($email)) {
        $error = 'Please enter your email address.';
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Please enter a valid email address.';
    } else {
        // In a real application, you would send a password reset email here
        // For now, we'll just show a success message
        $success = 'If an account exists with this email address, you will receive password reset instructions.';
    }
}
?>

<?php include '../header.php'; ?>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, Helvetica, sans-serif;
    font-size: 14px;
    line-height: 1.5;
    color: #333;
    background-color: #f5f5f5;
}

.container {
    max-width: 1000px;
    margin: 20px auto;
    background: white;
    padding: 20px;
    box-shadow: 0 0 5px rgba(0,0,0,0.1);
}

.breadcrumb {
    font-size: 12px;
    color: #666;
    margin-bottom: 15px;
}

.breadcrumb a {
    color: #0066cc;
    text-decoration: none;
}

.breadcrumb a:hover {
    text-decoration: underline;
}

h1 {
    font-size: 24px;
    font-weight: bold;
    color: #333;
    margin-bottom: 20px;
    text-align: center;
}

.form-container {
    max-width: 400px;
    margin: 30px auto;
    padding: 20px;
    border: 1px solid #ccc;
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
    color: #333;
}

.form-group input {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    font-size: 14px;
}

.btn {
    background: #0066cc;
    color: white;
    border: none;
    padding: 10px 20px;
    font-size: 14px;
    font-weight: bold;
    cursor: pointer;
    width: 100%;
    margin: 10px 0;
}

.btn:hover {
    background: #0055aa;
}

.signin-link {
    text-align: center;
    margin-top: 20px;
    font-size: 14px;
}

.signin-link a {
    color: #0066cc;
    text-decoration: none;
}

.signin-link a:hover {
    text-decoration: underline;
}

.alert {
    padding: 10px;
    margin-bottom: 15px;
}

.alert-error {
    background: #ffebee;
    border: 1px solid #ffcdd2;
    color: #c62828;
}

.alert-success {
    background: #e8f5e9;
    border: 1px solid #c8e6c9;
    color: #2e7d32;
}

.footer-links {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
    margin: 30px 0;
    padding-top: 15px;
    border-top: 1px solid #ccc;
    justify-content: center;
}

.footer-links a {
    color: #0066cc;
    text-decoration: none;
    font-size: 12px;
}

.footer-links a:hover {
    text-decoration: underline;
}

.copyright {
    font-size: 11px;
    color: #666;
    margin-top: 20px;
    padding-top: 10px;
    border-top: 1px solid #ccc;
    text-align: center;
}

@media (max-width: 768px) {
    .container {
        margin: 10px;
        padding: 15px;
    }
    
    .form-container {
        padding: 15px;
    }
}
</style>

<div class="container">
    <div class="breadcrumb">
        <a href="/">home</a> / forgot password
    </div>
    
    <h1>Forgot Password</h1>
    
    <?php if (isset($error)): ?>
    <div class="alert alert-error">
        <?php echo htmlspecialchars($error); ?>
    </div>
    <?php endif; ?>
    
    <?php if (isset($success)): ?>
    <div class="alert alert-success">
        <?php echo htmlspecialchars($success); ?>
    </div>
    <?php endif; ?>
    
    <div class="form-container">
        <form method="POST">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required 
                       value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
            </div>
            
            <button type="submit" class="btn">Reset Password</button>
        </form>
        
        <div class="signin-link">
            <a href="signin.php">Back to Sign In</a>
        </div>
    </div>
    
    <div class="footer-links">
        <a href="#">Search</a>
        <a href="#">about us</a>
        <a href="#">sitemap</a>
        <a href="#">terms of use</a>
        <a href="#">privacy policy</a>
    </div>
    
    <div class="copyright">
        © 2008 - 2025 calculator.net
    </div>
</div>

<?php include '../footer.php'; ?>