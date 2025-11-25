<?php
// admin/themes.php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}
?>
<?php include '../header.php'; ?>

<div class="container">
    <div class="admin-header">
        <h1>Theme Management</h1>
        <p>Customize your website appearance with different themes</p>
    </div>

    <div class="themes-grid">
        <div class="theme-card active">
            <div class="theme-preview blue-theme">
                <div class="preview-header">
                    <div class="preview-logo">
                        <span style="color: #000">90</span><span style="color: #007BFF">storezon</span>
                    </div>
                </div>
                <div class="preview-content">
                    <div class="preview-calculator">
                        <div class="preview-display">0</div>
                        <div class="preview-buttons">
                            <div class="preview-btn"></div>
                            <div class="preview-btn operator"></div>
                            <div class="preview-btn"></div>
                            <div class="preview-btn operator"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="theme-info">
                <h3>Blue Theme</h3>
                <p>Professional blue color scheme</p>
                <div class="theme-actions">
                    <button class="btn btn-primary" onclick="activateTheme('blue')">Activate</button>
                    <button class="btn btn-secondary" onclick="previewTheme('blue')">Preview</button>
                </div>
            </div>
        </div>

        <div class="theme-card">
            <div class="theme-preview orange-theme">
                <div class="preview-header">
                    <div class="preview-logo">
                        <span style="color: #000">90</span><span style="color: #FFA500">storezon</span>
                    </div>
                </div>
                <div class="preview-content">
                    <div class="preview-calculator">
                        <div class="preview-display">0</div>
                        <div class="preview-buttons">
                            <div class="preview-btn"></div>
                            <div class="preview-btn operator"></div>
                            <div class="preview-btn"></div>
                            <div class="preview-btn operator"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="theme-info">
                <h3>Orange Theme</h3>
                <p>Warm and energetic orange scheme</p>
                <div class="theme-actions">
                    <button class="btn btn-primary" onclick="activateTheme('orange')">Activate</button>
                    <button class="btn btn-secondary" onclick="previewTheme('orange')">Preview</button>
                </div>
            </div>
        </div>

        <div class="theme-card coming-soon">
            <div class="theme-preview gray-theme">
                <div class="preview-header">
                    <div class="preview-logo">
                        <span style="color: #000">90</span><span style="color: #6c757d">storezon</span>
                    </div>
                </div>
                <div class="preview-content">
                    <div class="preview-calculator">
                        <div class="preview-display">0</div>
                        <div class="preview-buttons">
                            <div class="preview-btn"></div>
                            <div class="preview-btn operator"></div>
                            <div class="preview-btn"></div>
                            <div class="preview-btn operator"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="theme-info">
                <h3>Dark Theme</h3>
                <p>Modern dark mode appearance</p>
                <div class="theme-actions">
                    <button class="btn btn-secondary" disabled>Coming Soon</button>
                </div>
            </div>
        </div>

        <div class="theme-card coming-soon">
            <div class="theme-preview green-theme">
                <div class="preview-header">
                    <div class="preview-logo">
                        <span style="color: #000">90</span><span style="color: #28a745">storezon</span>
                    </div>
                </div>
                <div class="preview-content">
                    <div class="preview-calculator">
                        <div class="preview-display">0</div>
                        <div class="preview-buttons">
                            <div class="preview-btn"></div>
                            <div class="preview-btn operator"></div>
                            <div class="preview-btn"></div>
                            <div class="preview-btn operator"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="theme-info">
                <h3>Green Theme</h3>
                <p>Fresh and natural green scheme</p>
                <div class="theme-actions">
                    <button class="btn btn-secondary" disabled>Coming Soon</button>
                </div>
            </div>
        </div>
    </div>

    <div class="theme-customization">
        <h2>Custom Theme</h2>
        <p>Create your own custom theme (Advanced)</p>
        <button class="btn btn-primary" onclick="customizeTheme()">Customize Theme</button>
    </div>
</div>

<style>
.themes-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 30px;
    margin-bottom: 40px;
}

.theme-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    overflow: hidden;
    transition: all 0.3s ease;
}

.theme-card.active {
    border: 2px solid #007bff;
}

.theme-card.coming-soon {
    opacity: 0.7;
}

.theme-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 30px rgba(0,0,0,0.12);
}

.theme-preview {
    height: 200px;
    border-bottom: 1px solid #f0f0f0;
}

.blue-theme {
    background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
}

.orange-theme {
    background: linear-gradient(135deg, #ffa500 0%, #cc8400 100%);
}

.gray-theme {
    background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
}

.green-theme {
    background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);
}

.preview-header {
    padding: 15px;
    background: rgba(255,255,255,0.1);
}

.preview-logo {
    font-weight: bold;
    font-size: 18px;
}

.preview-content {
    padding: 20px;
    display: flex;
    justify-content: center;
}

.preview-calculator {
    width: 120px;
    background: white;
    border-radius: 8px;
    padding: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.preview-display {
    background: #f8f9fa;
    border: 1px solid #e0e0e0;
    border-radius: 4px;
    padding: 8px;
    text-align: right;
    font-family: monospace;
    margin-bottom: 8px;
}

.preview-buttons {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 4px;
}

.preview-btn {
    height: 20px;
    background: #f8f9fa;
    border: 1px solid #e0e0e0;
    border-radius: 3px;
}

.preview-btn.operator {
    background: #007bff;
}

.orange-theme .preview-btn.operator {
    background: #ffa500;
}

.theme-info {
    padding: 20px;
}

.theme-info h3 {
    margin: 0 0 8px 0;
    color: #333;
}

.theme-info p {
    margin: 0 0 15px 0;
    color: #666;
}

.theme-actions {
    display: flex;
    gap: 10px;
}

.theme-customization {
    background: white;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    text-align: center;
}

.theme-customization h2 {
    margin: 0 0 10px 0;
    color: #333;
}

.theme-customization p {
    margin: 0 0 20px 0;
    color: #666;
}

@media (max-width: 768px) {
    .themes-grid {
        grid-template-columns: 1fr;
    }
    
    .theme-actions {
        flex-direction: column;
    }
}
</style>

<script>
function activateTheme(theme) {
    if (confirm(`Are you sure you want to activate the ${theme} theme?`)) {
        // In real implementation, this would save to database
        alert(`${theme.charAt(0).toUpperCase() + theme.slice(1)} theme activated successfully!`);
        
        // Update active state
        document.querySelectorAll('.theme-card').forEach(card => {
            card.classList.remove('active');
        });
        event.target.closest('.theme-card').classList.add('active');
    }
}

function previewTheme(theme) {
    alert(`Previewing ${theme} theme - this would show a live preview in real implementation`);
}

function customizeTheme() {
    alert('Custom theme editor would open here');
}
</script>

<?php include '../footer.php'; ?>