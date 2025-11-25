<?php
// Start session
session_start();

// auth/signup.php
$pageTitle = "Sign Up - 90storezon";

// Debug information
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    error_log('Form submitted to signup.php');
    error_log('POST data: ' . print_r($_POST, true));
}

if (isset($_SESSION['error'])) {
    error_log('Session error: ' . $_SESSION['error']);
}
$pageDescription = "Create a new 90storezon account to access personalized features and save your calculations.";
$pageKeywords = "sign up, register, 90storezon, account";
require_once 'google-config.php';
?>
<?php include '../header.php'; ?>

<div class="container">
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <h1>Create Account</h1>
                <p>Join 90storezon to save your calculations and preferences</p>
            </div>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-error">
                    <?php echo htmlspecialchars($_SESSION['error']); ?>
                    <?php unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>

            <?php if (validateGoogleConfig()): ?>
            <!-- Google Sign Up Button -->
            <div class="social-auth">
                <a href="<?php echo getGoogleAuthUrl(); ?>" class="btn btn-google">
                    <span class="google-icon">G</span>
                    Sign up with Google
                </a>
            </div>

            <div class="divider">
                <span>or</span>
            </div>
            <?php endif; ?>

            <!-- Registration Form -->
            <form class="auth-form" method="POST" action="process-signup.php">
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" class="form-input" required 
                           placeholder="Enter your full name" value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>">
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" class="form-input" required 
                           placeholder="Enter your email address" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-input" required 
                           placeholder="Create a password" minlength="8">
                    <div class="password-requirements">
                        <small>Must be at least 8 characters long</small>
                    </div>
                </div>

                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" class="form-input" required 
                           placeholder="Confirm your password">
                </div>

                <div class="form-group">
                    <label class="checkbox-label">
                        <input type="checkbox" name="terms" id="terms" required>
                        <span class="checkmark"></span>
                        I agree to the <a href="../pages/terms.php" target="_blank">Terms of Service</a> and <a href="../pages/privacy.php" target="_blank">Privacy Policy</a>
                    </label>
                </div>

                <div class="form-group">
                    <label class="checkbox-label">
                        <input type="checkbox" name="newsletter" id="newsletter">
                        <span class="checkmark"></span>
                        Send me updates about new calculators and features
                    </label>
                </div>

                <button type="submit" class="btn btn-primary btn-auth">Create Account</button>
            </form>

            <div class="auth-footer">
                <p>Already have an account? <a href="signin.php" class="auth-link">Sign in here</a></p>
            </div>
        </div>
    </div>
</div>

<style>
.password-requirements {
    margin-top: 5px;
}

.password-requirements small {
    color: #666;
    font-size: 12px;
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('confirm_password');
    
    function validatePassword() {
        if (password.value !== confirmPassword.value) {
            confirmPassword.setCustomValidity('Passwords do not match');
        } else {
            confirmPassword.setCustomValidity('');
        }
    }
    
    password.addEventListener('change', validatePassword);
    confirmPassword.addEventListener('keyup', validatePassword);
});
</script>

<?php include '../footer.php'; ?>