<?php
// admin/index.php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}
?>
<?php include '../header.php'; ?>

<div class="container">
    <div class="admin-header">
        <h1>Admin Dashboard</h1>
        <p>Welcome back, Administrator</p>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon">👥</div>
            <div class="stat-info">
                <h3>1,247</h3>
                <p>Total Users</p>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">🧮</div>
            <div class="stat-info">
                <h3>50</h3>
                <p>Calculators</p>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">📊</div>
            <div class="stat-info">
                <h3>12,847</h3>
                <p>Total Visits</p>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">✅</div>
            <div class="stat-info">
                <h3>98%</h3>
                <p>Uptime</p>
            </div>
        </div>
    </div>

    <div class="admin-grid">
        <a href="users.php" class="admin-card">
            <div class="card-icon">👥</div>
            <h3>User Management</h3>
            <p>Manage registered users and permissions</p>
        </a>
        
        <a href="calculators.php" class="admin-card">
            <div class="card-icon">🧮</div>
            <h3>Calculators</h3>
            <p>Manage calculator content and categories</p>
        </a>
        
        <a href="settings.php" class="admin-card">
            <div class="card-icon">⚙️</div>
            <h3>Settings</h3>
            <p>Configure site settings and preferences</p>
        </a>
        
        <a href="themes.php" class="admin-card">
            <div class="card-icon">🎨</div>
            <h3>Themes</h3>
            <p>Manage website themes and appearance</p>
        </a>
        
        <a href="reports.php" class="admin-card">
            <div class="card-icon">📈</div>
            <h3>Reports</h3>
            <p>View analytics and usage reports</p>
        </a>
        
        <a href="logout.php" class="admin-card">
            <div class="card-icon">🚪</div>
            <h3>Logout</h3>
            <p>Sign out from admin panel</p>
        </a>
    </div>

    <div class="recent-activity">
        <h2>Recent Activity</h2>
        <div class="activity-list">
            <div class="activity-item">
                <div class="activity-icon">➕</div>
                <div class="activity-content">
                    <p><strong>New user registered</strong> - john.doe@email.com</p>
                    <span class="activity-time">2 hours ago</span>
                </div>
            </div>
            <div class="activity-item">
                <div class="activity-icon">🔄</div>
                <div class="activity-content">
                    <p><strong>Theme updated</strong> - Blue theme activated</p>
                    <span class="activity-time">5 hours ago</span>
                </div>
            </div>
            <div class="activity-item">
                <div class="activity-icon">📝</div>
                <div class="activity-content">
                    <p><strong>Calculator modified</strong> - BMI Calculator updated</p>
                    <span class="activity-time">1 day ago</span>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.admin-header {
    text-align: center;
    margin-bottom: 40px;
}

.admin-header h1 {
    color: #333;
    margin-bottom: 10px;
}

.admin-header p {
    color: #666;
    font-size: 18px;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin-bottom: 40px;
}

.stat-card {
    background: white;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    display: flex;
    align-items: center;
    gap: 20px;
    transition: transform 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-5px);
}

.stat-icon {
    font-size: 40px;
}

.stat-info h3 {
    font-size: 32px;
    margin: 0;
    color: #333;
}

.stat-info p {
    margin: 5px 0 0 0;
    color: #666;
}

.admin-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 25px;
    margin-bottom: 40px;
}

.admin-card {
    background: white;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    text-decoration: none;
    color: inherit;
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

.admin-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 30px rgba(0,0,0,0.12);
    border-color: #007BFF;
}

.card-icon {
    font-size: 48px;
    margin-bottom: 15px;
}

.admin-card h3 {
    margin: 0 0 10px 0;
    color: #333;
    font-size: 20px;
}

.admin-card p {
    margin: 0;
    color: #666;
    line-height: 1.5;
}

.recent-activity {
    background: white;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
}

.recent-activity h2 {
    margin: 0 0 20px 0;
    color: #333;
}

.activity-list {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.activity-item {
    display: flex;
    align-items: flex-start;
    gap: 15px;
    padding: 15px;
    border-radius: 8px;
    background: #f8f9fa;
}

.activity-icon {
    font-size: 20px;
    margin-top: 2px;
}

.activity-content p {
    margin: 0 0 5px 0;
    color: #333;
}

.activity-time {
    color: #666;
    font-size: 14px;
}

@media (max-width: 768px) {
    .stats-grid {
        grid-template-columns: 1fr;
    }
    
    .admin-grid {
        grid-template-columns: 1fr;
    }
    
    .stat-card, .admin-card {
        padding: 20px;
    }
}
</style>

<?php include '../footer.php'; ?>