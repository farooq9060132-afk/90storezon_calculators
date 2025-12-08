<?php
// auth/signin.php
$pageTitle = "Sign In - 90storezon";
$pageDescription = "Sign in to your 90storezon account to access personalized features and save your calculations.";
$pageKeywords = "sign in, login, 90storezon, account";
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

/* Reuse styles from signup.php */
</style>

<?php include '../footer.php'; ?>