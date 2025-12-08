<?php
// auth/forgot-password.php
$pageTitle = "Forgot Password - 90storezon";
$pageDescription = "Reset your 90storezon account password. We'll send you a password reset link to your email.";
$pageKeywords = "forgot password, reset password, 90storezon, account recovery";
?>
<?php include '../header.php'; ?>

<div class="container">
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <h1>Reset Password</h1>
                <p>Enter your email address and we'll send you a password reset link</p>
            </div>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-error">
                    <?php echo htmlspecialchars($_SESSION['error']); ?>
                    <?php unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success">
                    <?php echo htmlspecialchars($_SESSION['success']); ?>
                    <?php unset($_SESSION['success']); ?>
                </div>
            <?php endif; ?>

            <form class="auth-form" method="POST" action="process-forgot-password.php">
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" class="form-input" required 
                           placeholder="Enter your email address" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
                </div>

                <button type="submit" class="btn btn-primary btn-auth">Send Reset Link</button>
            </form>

            <div class="auth-footer">
                <p>Remember your password? <a href="signin.php" class="auth-link">Back to sign in</a></p>
            </div>

            <div class="recovery-info">
                <h3>What happens next?</h3>
                <ul>
                    <li>We'll send a password reset link to your email</li>
                    <li>The link will expire in 1 hour for security</li>
                    <li>Check your spam folder if you don't see the email</li>
                    <li>Contact support if you continue having issues</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<style>
.recovery-info {
    margin-top: 30px;
    padding-top: 20px;
    border-top: 1px solid #f0f0f0;
}

.recovery-info h3 {
    color: #333;
    margin-bottom: 15px;
    font-size: 1.1rem;
}

.recovery-info ul {
    color: #666;
    line-height: 1.6;
    padding-left: 20px;
    margin: 0;
}

.recovery-info li {
    margin-bottom: 8px;
}

/* Reuse styles from signin.php */
</style>

<?php include '../footer.php'; ?>