<?php
// auth/profile.php - Simplified version
session_start();

// Check if user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: signin.php');
    exit;
}

// Get user data
$user_name = $_SESSION['user_name'] ?? 'User';
$user_email = $_SESSION['user_email'] ?? '';
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

.profile-container {
    max-width: 600px;
    margin: 30px auto;
    padding: 20px;
    border: 1px solid #ccc;
}

.profile-info {
    margin-bottom: 20px;
}

.profile-info h2 {
    font-size: 20px;
    margin-bottom: 15px;
    color: #333;
}

.info-item {
    display: flex;
    margin-bottom: 10px;
}

.info-label {
    font-weight: bold;
    width: 150px;
    color: #333;
}

.info-value {
    flex: 1;
    color: #666;
}

.btn {
    background: #0066cc;
    color: white;
    border: none;
    padding: 10px 20px;
    font-size: 14px;
    font-weight: bold;
    cursor: pointer;
    text-decoration: none;
    display: inline-block;
    margin: 5px;
}

.btn:hover {
    background: #0055aa;
}

.btn-danger {
    background: #dc3545;
}

.btn-danger:hover {
    background: #c82333;
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
    
    .profile-container {
        padding: 15px;
    }
    
    .info-item {
        flex-direction: column;
    }
    
    .info-label {
        width: auto;
        margin-bottom: 5px;
    }
}
</style>

<div class="container">
    <div class="breadcrumb">
        <a href="/">home</a> / profile
    </div>
    
    <h1>User Profile</h1>
    
    <div class="profile-container">
        <div class="profile-info">
            <h2>Account Information</h2>
            <div class="info-item">
                <div class="info-label">Name:</div>
                <div class="info-value"><?php echo htmlspecialchars($user_name); ?></div>
            </div>
            <div class="info-item">
                <div class="info-label">Email:</div>
                <div class="info-value"><?php echo htmlspecialchars($user_email); ?></div>
            </div>
        </div>
        
        <div style="text-align: center; margin-top: 30px;">
            <a href="settings.php" class="btn">Account Settings</a>
            <a href="logout.php" class="btn btn-danger">Sign Out</a>
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