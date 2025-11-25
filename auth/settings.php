<?php
// Start session
session_start();

// Check if user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: signin.php');
    exit;
}

$pageTitle = "Account Settings - 90storezon";
$pageDescription = "Manage your 90storezon account settings and preferences.";
$pageKeywords = "settings, account, preferences, 90storezon";
?>
<?php include '../header.php'; ?>

<div class="container">
    <div class="settings-container">
        <div class="settings-card">
            <div class="settings-header">
                <h1>Account Settings</h1>
                <p>Manage your account preferences and security</p>
            </div>

            <div class="settings-tabs">
                <button class="tab-btn active" data-tab="profile">Profile</button>
                <button class="tab-btn" data-tab="security">Security</button>
                <button class="tab-btn" data-tab="notifications">Notifications</button>
            </div>

            <div class="tab-content">
                <!-- Profile Tab -->
                <div class="tab-pane active" id="profile-tab">
                    <form class="settings-form">
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" id="name" name="name" class="form-input" 
                                   value="<?php echo htmlspecialchars($_SESSION['user_name'] ?? ''); ?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" class="form-input" 
                                   value="<?php echo htmlspecialchars($_SESSION['user_email'] ?? ''); ?>" readonly>
                            <p class="form-help">Email cannot be changed</p>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>

                <!-- Security Tab -->
                <div class="tab-pane" id="security-tab">
                    <form class="settings-form">
                        <div class="form-group">
                            <label for="current-password">Current Password</label>
                            <input type="password" id="current-password" name="current_password" class="form-input" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="new-password">New Password</label>
                            <input type="password" id="new-password" name="new_password" class="form-input" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="confirm-password">Confirm New Password</label>
                            <input type="password" id="confirm-password" name="confirm_password" class="form-input" required>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Change Password</button>
                    </form>
                </div>

                <!-- Notifications Tab -->
                <div class="tab-pane" id="notifications-tab">
                    <form class="settings-form">
                        <div class="form-group checkbox-group">
                            <label class="checkbox-label">
                                <input type="checkbox" name="email_notifications" id="email-notifications" checked>
                                <span class="checkmark"></span>
                                Email notifications
                            </label>
                        </div>
                        
                        <div class="form-group checkbox-group">
                            <label class="checkbox-label">
                                <input type="checkbox" name="newsletter" id="newsletter" checked>
                                <span class="checkmark"></span>
                                Newsletter subscription
                            </label>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Save Preferences</button>
                    </form>
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

.settings-container {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 70vh;
    padding: 20px;
}

.settings-card {
    background: white;
    border-radius: 12px;
    padding: 40px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    border: 1px solid #e0e0e0;
    width: 100%;
    max-width: 700px;
}

.settings-header {
    text-align: center;
    margin-bottom: 30px;
}

.settings-header h1 {
    color: #202124;
    font-size: 28px;
    font-weight: 600;
    margin-bottom: 10px;
}

.settings-header p {
    color: #5f6368;
    font-size: 16px;
    margin: 0;
}

.settings-tabs {
    display: flex;
    border-bottom: 1px solid #dadce0;
    margin-bottom: 30px;
}

.tab-btn {
    padding: 12px 24px;
    background: transparent;
    border: none;
    font-size: 16px;
    font-weight: 500;
    color: #5f6368;
    cursor: pointer;
    border-bottom: 3px solid transparent;
    transition: all 0.3s ease;
}

.tab-btn:hover {
    color: #202124;
}

.tab-btn.active {
    color: #0052FF;
    border-bottom-color: #0052FF;
}

.tab-pane {
    display: none;
}

.tab-pane.active {
    display: block;
}

.settings-form {
    max-width: 500px;
    margin: 0 auto;
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

.form-help {
    font-size: 14px;
    color: #5f6368;
    margin-top: 5px;
}

.checkbox-group {
    margin: 25px 0;
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

.checkmark {
    display: inline-block;
    width: 18px;
    height: 18px;
    border: 1px solid #dadce0;
    border-radius: 3px;
    position: relative;
}

.checkbox-label input[type="checkbox"]:checked + .checkmark:after {
    content: '';
    position: absolute;
    left: 5px;
    top: 1px;
    width: 5px;
    height: 10px;
    border: solid #0052FF;
    border-width: 0 2px 2px 0;
    transform: rotate(45deg);
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

.btn-primary {
    background: #0052FF;
    color: white;
    width: 100%;
}

.btn-primary:hover {
    background: #0041cc;
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(0, 82, 255, 0.2);
}

@media (max-width: 768px) {
    .settings-card {
        padding: 30px 20px;
    }
    
    .settings-tabs {
        flex-direction: column;
    }
    
    .tab-btn {
        text-align: left;
        border-bottom: 1px solid #dadce0;
        border-left: 3px solid transparent;
    }
    
    .tab-btn.active {
        border-bottom-color: #dadce0;
        border-left-color: #0052FF;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tab switching functionality
    const tabBtns = document.querySelectorAll('.tab-btn');
    const tabPanes = document.querySelectorAll('.tab-pane');
    
    tabBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            // Remove active class from all buttons and panes
            tabBtns.forEach(b => b.classList.remove('active'));
            tabPanes.forEach(p => p.classList.remove('active'));
            
            // Add active class to clicked button
            this.classList.add('active');
            
            // Show corresponding pane
            const tabId = this.getAttribute('data-tab') + '-tab';
            document.getElementById(tabId).classList.add('active');
        });
    });
});
</script>

<?php include '../footer.php'; ?>