<?php
// auth/signin.php
$pageTitle = "Sign In - 90storezon";
$pageDescription = "Sign in to your 90storezon account to access personalized features and save your calculations.";
$pageKeywords = "sign in, login, 90storezon, account";
require_once 'google-config.php';
?>
<?php include '../header.php'; ?>

<div class="container">
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <h1>Welcome Back</h1>
                <p>Sign in to your 90storezon account</p>
            </div>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-error">
                    <?php echo htmlspecialchars($_SESSION['error']); ?>
                    <?php unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>

            <?php if (validateGoogleConfig()): ?>
            <!-- Google Sign In Button -->
            <div class="social-auth">
                <a href="<?php echo getGoogleAuthUrl(); ?>" class="btn btn-google">
                    <span class="google-icon">G</span>
                    Sign in with Google
                </a>
            </div>

            <div class="divider">
                <span>or</span>
            </div>
            <?php endif; ?>

            <!-- Login Form -->
            <form class="auth-form" method="POST" action="process-signin.php">
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" class="form-input" required 
                           placeholder="Enter your email address" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-input" required 
                           placeholder="Enter your password">
                </div>

                <div class="form-group form-row">
                    <label class="checkbox-label">
                        <input type="checkbox" name="remember" id="remember">
                        <span class="checkmark"></span>
                        Remember me
                    </label>
                    <a href="forgot-password.php" class="forgot-password">Forgot password?</a>
                </div>

                <button type="submit" class="btn btn-primary btn-auth">Sign In</button>
            </form>

            <div class="auth-footer">
                <p>Don't have an account? <a href="signup.php" class="auth-link">Sign up here</a></p>
            </div>
        </div>
    </div>
</div>

<style>
.forgot-password {
    color: #007bff;
    text-decoration: none;
    font-size: 14px;
}

.forgot-password:hover {
    text-decoration: underline;
}

.form-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.auth-form a {
    color: #007bff;
    text-decoration: none;
}

.auth-form a:hover {
    text-decoration: underline;
}

/* Auth Container Styles */
.auth-container {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 70vh;
    padding: 20px;
}

.auth-card {
    background: white;
    border-radius: 12px;
    padding: 40px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    border: 1px solid #e0e0e0;
    width: 100%;
    max-width: 450px;
}

.auth-header {
    text-align: center;
    margin-bottom: 30px;
}

.auth-header h1 {
    color: #202124;
    font-size: 28px;
    font-weight: 600;
    margin-bottom: 10px;
}

.auth-header p {
    color: #5f6368;
    font-size: 16px;
    margin: 0;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: 500;
    color: #202124;
}

.form-input {
    width: 100%;
    padding: 14px 16px;
    border: 1px solid #dadce0;
    border-radius: 8px;
    font-size: 16px;
    transition: all 0.2s ease;
}

.form-input:focus {
    outline: none;
    border-color: #1a73e8;
    box-shadow: 0 0 0 2px rgba(26,115,232,0.2);
}

.checkbox-label {
    display: flex;
    align-items: flex-start;
    cursor: pointer;
}

.checkbox-label input[type="checkbox"] {
    margin-right: 10px;
    margin-top: 4px;
}

.btn-auth {
    width: 100%;
    padding: 16px;
    font-size: 16px;
    font-weight: 500;
}

.social-auth {
    margin-bottom: 24px;
}

.btn-google {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    padding: 14px;
    border: 1px solid #dadce0;
    border-radius: 8px;
    background: white;
    color: #202124;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.2s ease;
}

.btn-google:hover {
    background: #f8f9fa;
    box-shadow: 0 2px 6px rgba(0,0,0,0.05);
}

.google-icon {
    background: #fff;
    border: 1px solid #dadce0;
    border-radius: 4px;
    padding: 2px 6px;
    margin-right: 12px;
    font-weight: bold;
}

.divider {
    text-align: center;
    margin: 24px 0;
    position: relative;
}

.divider span {
    background: white;
    padding: 0 16px;
    color: #5f6368;
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
    background: #dadce0;
    z-index: 0;
}

.auth-footer {
    text-align: center;
    margin-top: 24px;
}

.auth-link {
    color: #1a73e8;
    text-decoration: none;
    font-weight: 500;
}

.auth-link:hover {
    text-decoration: underline;
}
</style>

<?php include '../footer.php'; ?>