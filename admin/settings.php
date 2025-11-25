<?php
// admin/settings.php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}
?>
<?php include '../header.php'; ?>

<div class="container">
    <div class="admin-header">
        <h1>Site Settings</h1>
        <p>Configure your website settings and preferences</p>
    </div>

    <form class="settings-form" method="POST">
        <div class="settings-section">
            <h2>General Settings</h2>
            <div class="form-group">
                <label for="site_title">Site Title</label>
                <input type="text" id="site_title" name="site_title" value="90storezon" class="form-input">
            </div>
            <div class="form-group">
                <label for="site_description">Site Description</label>
                <textarea id="site_description" name="site_description" class="form-textarea" rows="3">Professional calculator website with 50+ tools for finance, health, math, and more.</textarea>
            </div>
            <div class="form-group">
                <label for="admin_email">Admin Email</label>
                <input type="email" id="admin_email" name="admin_email" value="admin@90storezon.com" class="form-input">
            </div>
        </div>

        <div class="settings-section">
            <h2>SEO Settings</h2>
            <div class="form-group">
                <label for="meta_keywords">Meta Keywords</label>
                <input type="text" id="meta_keywords" name="meta_keywords" value="calculator, finance, health, math, tools" class="form-input">
            </div>
            <div class="form-group">
                <label for="meta_description">Meta Description</label>
                <textarea id="meta_description" name="meta_description" class="form-textarea" rows="3">90storezon offers 50+ free online calculators for finance, health, math, and everyday calculations.</textarea>
            </div>
            <div class="form-group">
                <label for="google_analytics">Google Analytics ID</label>
                <input type="text" id="google_analytics" name="google_analytics" value="UA-XXXXXXXXX-X" class="form-input">
            </div>
        </div>

        <div class="settings-section">
            <h2>Appearance</h2>
            <div class="form-group">
                <label for="default_theme">Default Theme</label>
                <select id="default_theme" name="default_theme" class="form-select">
                    <option value="blue">Blue Theme</option>
                    <option value="orange">Orange Theme</option>
                </select>
            </div>
            <div class="form-group">
                <label for="logo_url">Logo URL</label>
                <input type="text" id="logo_url" name="logo_url" value="/images/logo.png" class="form-input">
            </div>
            <div class="form-group">
                <label class="checkbox-label">
                    <input type="checkbox" name="dark_mode" id="dark_mode">
                    <span class="checkmark"></span>
                    Enable Dark Mode by default
                </label>
            </div>
        </div>

        <div class="settings-section">
            <h2>Security</h2>
            <div class="form-group">
                <label class="checkbox-label">
                    <input type="checkbox" name="maintenance_mode" id="maintenance_mode">
                    <span class="checkmark"></span>
                    Enable Maintenance Mode
                </label>
            </div>
            <div class="form-group">
                <label class="checkbox-label">
                    <input type="checkbox" name="user_registration" id="user_registration" checked>
                    <span class="checkmark"></span>
                    Allow User Registration
                </label>
            </div>
            <div class="form-group">
                <label for="session_timeout">Session Timeout (minutes)</label>
                <input type="number" id="session_timeout" name="session_timeout" value="30" min="5" max="1440" class="form-input">
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Save Settings</button>
            <button type="reset" class="btn btn-secondary">Reset to Defaults</button>
        </div>
    </form>
</div>

<style>
.settings-form {
    background: white;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
}

.settings-section {
    margin-bottom: 40px;
    padding-bottom: 30px;
    border-bottom: 1px solid #f0f0f0;
}

.settings-section:last-child {
    border-bottom: none;
    margin-bottom: 0;
}

.settings-section h2 {
    margin: 0 0 20px 0;
    color: #333;
    font-size: 22px;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
    color: #333;
}

.form-input, .form-textarea, .form-select {
    width: 100%;
    padding: 12px 15px;
    border: 1px solid #e0e0e0;
    border-radius: 6px;
    font-size: 14px;
    transition: border-color 0.3s ease;
}

.form-input:focus, .form-textarea:focus, .form-select:focus {
    outline: none;
    border-color: #007bff;
    box-shadow: 0 0 0 3px rgba(0,123,255,0.1);
}

.form-textarea {
    resize: vertical;
    min-height: 100px;
}

.checkbox-label {
    display: flex;
    align-items: center;
    cursor: pointer;
    font-weight: normal;
}

.checkbox-label input[type="checkbox"] {
    display: none;
}

.checkmark {
    width: 20px;
    height: 20px;
    border: 2px solid #e0e0e0;
    border-radius: 4px;
    margin-right: 10px;
    position: relative;
    transition: all 0.3s ease;
}

.checkbox-label input[type="checkbox"]:checked + .checkmark {
    background: #007bff;
    border-color: #007bff;
}

.checkbox-label input[type="checkbox"]:checked + .checkmark::after {
    content: '✓';
    position: absolute;
    color: white;
    font-size: 14px;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

.form-actions {
    display: flex;
    gap: 15px;
    justify-content: flex-end;
    margin-top: 30px;
    padding-top: 20px;
    border-top: 1px solid #f0f0f0;
}

@media (max-width: 768px) {
    .settings-form {
        padding: 20px;
    }
    
    .form-actions {
        flex-direction: column;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('.settings-form');
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        alert('Settings saved successfully!');
        // In real implementation, this would submit to backend
    });
});
</script>

<?php include '../footer.php'; ?>