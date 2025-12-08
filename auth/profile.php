<?php
// Start session
session_start();

// Check if user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: signin.php');
    exit;
}

$pageTitle = "Profile - 90storezon";
$pageDescription = "View and manage your 90storezon account profile.";
$pageKeywords = "profile, account, settings, 90storezon";
?>
<?php include '../header.php'; ?>

<div class="container">
    <div class="profile-container">
        <div class="profile-card">
            <div class="profile-header">
                <h1>My Profile</h1>
                <p>Manage your account information</p>
            </div>

            <div class="profile-content">
                <div class="profile-info">
                    <div class="info-group">
                        <label>Name</label>
                        <div class="info-value"><?php echo htmlspecialchars($_SESSION['user_name'] ?? 'User'); ?></div>
                    </div>
                    
                    <div class="info-group">
                        <label>Email</label>
                        <div class="info-value"><?php echo htmlspecialchars($_SESSION['user_email'] ?? ''); ?></div>
                    </div>
                    
                    <div class="info-group">
                        <label>Member Since</label>
                        <div class="info-value">January 1, 2024</div>
                    </div>
                    
                    <div class="info-group">
                        <label>Login Method</label>
                        <div class="info-value"><?php echo ucfirst($_SESSION['login_method'] ?? 'email'); ?></div>
                    </div>
                </div>

                <div class="profile-actions">
                    <a href="settings.php" class="btn btn-primary">Account Settings</a>
                    <a href="logout.php" class="btn btn-outline">Logout</a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

.profile-container {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 70vh;
    padding: 20px;
}

.profile-card {
    background: white;
    border-radius: 12px;
    padding: 40px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    border: 1px solid #e0e0e0;
    width: 100%;
    max-width: 600px;
}

.profile-header {
    text-align: center;
    margin-bottom: 30px;
}

.profile-header h1 {
    color: #202124;
    font-size: 28px;
    font-weight: 600;
    margin-bottom: 10px;
}

.profile-header p {
    color: #5f6368;
    font-size: 16px;
    margin: 0;
}

.profile-info {
    margin-bottom: 30px;
}

.info-group {
    margin-bottom: 20px;
}

.info-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: 500;
    color: #202124;
    font-size: 14px;
}

.info-value {
    padding: 12px 16px;
    background: #f8f9fa;
    border: 1px solid #dadce0;
    border-radius: 8px;
    font-size: 16px;
    color: #202124;
}

.profile-actions {
    display: flex;
    gap: 15px;
    justify-content: center;
}

.btn {
    display: inline-block;
    padding: 12px 24px;
    border-radius: 6px;
    text-decoration: none;
    font-weight: 500;
    font-size: 16px;
    transition: all 0.3s ease;
    border: 1px solid transparent;
    cursor: pointer;
}

.btn-outline {
    background: transparent;
    color: #0052FF;
    border-color: #0052FF;
}

.btn-outline:hover {
    background: rgba(0, 82, 255, 0.05);
}

.btn-primary {
    background: #0052FF;
    color: white;
}

.btn-primary:hover {
    background: #0041cc;
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(0, 82, 255, 0.2);
}

@media (max-width: 768px) {
    .profile-card {
        padding: 30px 20px;
    }
    
    .profile-actions {
        flex-direction: column;
    }
}
</style>

<?php include '../footer.php'; ?>