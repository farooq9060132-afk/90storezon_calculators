<?php
// auth/signin.php - Simplified version
session_start();
require_once 'google-config.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'] ?? '';
    $remember = isset($_POST['remember']);
    
    // Validate input
    if (empty($email) || empty($password)) {
        $error = 'Please fill in all required fields.';
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Please enter a valid email address.';
    } else {
        // Verify user credentials
        require_once 'user-manager.php';
        $userManager = new UserManager();
        $user = $userManager->verifyUserCredentials($email, $password);
        
        if ($user) {
            // Set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['logged_in'] = true;
            $_SESSION['login_method'] = 'email';
            
            // Redirect to home
            header('Location: ../index.php');
            exit;
        } else {
            $error = 'Invalid email or password.';
        }
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

.checkbox-group {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
}

.checkbox-group label {
    display: flex;
    align-items: center;
    font-weight: normal;
}

.checkbox-group input {
    width: auto;
    margin-right: 5px;
}

.forgot-password {
    color: #0066cc;
    text-decoration: none;
    font-size: 12px;
}

.forgot-password:hover {
    text-decoration: underline;
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

.divider {
    text-align: center;
    margin: 20px 0;
    position: relative;
}

.divider span {
    background: white;
    padding: 0 10px;
    position: relative;
    z-index: 1;
}

.divider::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    height: 1px;
    background: #ccc;
    z-index: 0;
}

.google-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    background: white;
    color: #333;
    border: 1px solid #ccc;
    padding: 10px;
    text-decoration: none;
    font-weight: bold;
}

.google-btn:hover {
    background: #f0f0f0;
}

.signup-link {
    text-align: center;
    margin-top: 20px;
    font-size: 14px;
}

.signup-link a {
    color: #0066cc;
    text-decoration: none;
}

.signup-link a:hover {
    text-decoration: underline;
}

.alert {
    padding: 10px;
    margin-bottom: 15px;
    background: #ffebee;
    border: 1px solid #ffcdd2;
    color: #c62828;
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
        <a href="/">home</a> / sign in
    </div>
    
    <h1>Sign In</h1>
    
    <?php if (isset($error)): ?>
    <div class="alert">
        <?php echo htmlspecialchars($error); ?>
    </div>
    <?php endif; ?>
    
    <div class="form-container">
        <form method="POST">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required 
                       value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
            </div>
            
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <div class="checkbox-group">
                <label>
                    <input type="checkbox" name="remember" id="remember">
                    stay signed in
                </label>
                <a href="forgot-password.php" class="forgot-password">Forget password?</a>
            </div>
            
            <button type="submit" class="btn">Sign In</button>
        </form>
        
        <div class="divider">
            <span>or</span>
        </div>
        
        <?php if (validateGoogleConfig()): ?>
        <a href="<?php echo getGoogleAuthUrl(); ?>" class="google-btn">
            Sign in with Google
        </a>
        <?php endif; ?>
        
        <div class="signup-link">
            New user? <a href="signup.php">Create a free account</a>
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