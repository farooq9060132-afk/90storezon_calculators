<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Free Time Duration Calculator | Calculate Time Between Dates & Times</title>
    <meta name="description" content="Professional time duration calculator. Calculate exact time between two dates with milliseconds precision. Free online tool for developers, project managers, and professionals.">
    <meta name="keywords" content="time duration calculator, date calculator, time between dates, age calculator, project timeline, time difference">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- VIP Header -->
    <header class="vip-header">
        <div class="container">
            <div class="logo-section">
                <div class="logo">
                    <span class="logo-icon">⏰</span>
                    <h1>Time Duration Calculator</h1>
                </div>
                <div class="vip-badge">
                    <span class="vip-star">⭐</span>
                    VIP PROFESSIONAL
                    <span class="vip-star">⭐</span>
                </div>
            </div>
            <nav class="main-nav">
                <ul>
                    <li><a href="#calculator" class="nav-link">Calculator</a></li>
                    <li><a href="#features" class="nav-link">Features</a></li>
                    <li><a href="#examples" class="nav-link">Examples</a></li>
                    <li><a href="#enterprise" class="nav-link">Enterprise</a></li>
                    <li><a href="#support" class="nav-link">Support</a></li>
                </ul>
            </nav>
            <div class="header-cta">
                <button class="premium-btn">🚀 Upgrade to Pro</button>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="hero-content">
                <div class="hero-badge">🏆 INDUSTRY LEADER</div>
                <h1>Precision Time Duration Calculator</h1>
                <p class="hero-subtitle">Enterprise-grade time calculations with <span class="highlight">millisecond precision</span>. Trusted by Fortune 500 companies worldwide.</p>
                
                <div class="hero-stats">
                    <div class="stat-card">
                        <div class="stat-number">2.5M+</div>
                        <div class="stat-label">Professional Users</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">99.97%</div>
                        <div class="stat-label">Accuracy Rate</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">24/7</div>
                        <div class="stat-label">Enterprise Support</div>
                    </div>
                </div>

                <div class="hero-features">
                    <div class="feature-tag">⚡ Real-time Calculations</div>
                    <div class="feature-tag">🔒 Bank-level Security</div>
                    <div class="feature-tag">📊 Advanced Analytics</div>
                    <div class="feature-tag">🌐 Multi-timezone</div>
                </div>

                <a href="#calculator" class="cta-button">
                    <span class="cta-icon">🚀</span>
                    Start Calculating Now
                    <span class="cta-arrow">→</span>
                </a>
            </div>
            
            <div class="hero-visual">
                <div class="dashboard-preview">
                    <div class="dashboard-header">
                        <div class="dashboard-title">Time Analytics Dashboard</div>
                        <div class="dashboard-badge">LIVE</div>
                    </div>
                    <div class="time-visualization">
                        <div class="timeline">
                            <div class="timeline-start">
                                <div class="time-label">Start</div>
                                <div class="time-value">Jan 1, 2024</div>
                                <div class="time-detail">10:00:00 AM UTC</div>
                            </div>
                            <div class="timeline-progress">
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: 60%"></div>
                                </div>
                                <div class="progress-stats">
                                    <span>245 days</span>
                                    <span>5,880 hours</span>
                                    <span>352,800 minutes</span>
                                </div>
                            </div>
                            <div class="timeline-end">
                                <div class="time-label">End</div>
                                <div class="time-value">Sep 1, 2024</div>
                                <div class="time-detail">03:45:30 PM UTC</div>
                            </div>
                        </div>
                    </div>
                    <div class="metrics-grid">
                        <div class="metric">
                            <div class="metric-value">245</div>
                            <div class="metric-label">Days</div>
                        </div>
                        <div class="metric">
                            <div class="metric-value">5,880</div>
                            <div class="metric-label">Hours</div>
                        </div>
                        <div class="metric">
                            <div class="metric-value">352,800</div>
                            <div class="metric-label">Minutes</div>
                        </div>
                        <div class="metric">
                            <div class="metric-value">21,168,000</div>
                            <div class="metric-label">Seconds</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Calculator Section -->
    <section id="calculator" class="calculator-section">
        <div class="container">
            <div class="section-header">
                <h2>Professional Time Duration Calculator</h2>
                <p class="section-subtitle">Enterprise-grade precision with advanced business features</p>
            </div>

            <div class="calculator-card">
                <div class="card-header">
                    <h3>🕒 Time Duration Analysis</h3>
                    <div class="card-badges">
                        <span class="badge premium">PREMIUM FEATURES</span>
                        <span class="badge secure">🔒 SECURE</span>
                    </div>
                </div>

                <form id="timeDurationCalculator" action="calculator.php" method="POST" class="calculator-form">
                    <!-- Date Input Section -->
                    <div class="form-section">
                        <div class="section-title">
                            <h4>📅 Date & Time Configuration</h4>
                            <span class="section-help" title="Enter start and end dates with optional time precision">ℹ️</span>
                        </div>
                        
                        <div class="form-grid">
                            <div class="input-group">
                                <label for="startDate" class="input-label">
                                    <span class="label-icon">🟢</span>
                                    Start Date & Time
                                </label>
                                <div class="input-with-presets">
                                    <input type="datetime-local" id="startDate" name="startDate" class="form-input" required>
                                    <div class="input-presets">
                                        <button type="button" class="preset-btn" data-preset="now">Now</button>
                                        <button type="button" class="preset-btn" data-preset="today-start">Today Start</button>
                                        <button type="button" class="preset-btn" data-preset="week-start">Week Start</button>
                                    </div>
                                </div>
                            </div>

                            <div class="input-group">
                                <label for="endDate" class="input-label">
                                    <span class="label-icon">🔴</span>
                                    End Date & Time
                                </label>
                                <div class="input-with-presets">
                                    <input type="datetime-local" id="endDate" name="endDate" class="form-input" required>
                                    <div class="input-presets">
                                        <button type="button" class="preset-btn" data-preset="now">Now</button>
                                        <button type="button" class="preset-btn" data-preset="today-end">Today End</button>
                                        <button type="button" class="preset-btn" data-preset="week-end">Week End</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Advanced Options -->
                    <div class="form-section">
                        <div class="section-title">
                            <h4>⚙️ Advanced Calculation Settings</h4>
                            <button type="button" class="toggle-advanced">Show Advanced</button>
                        </div>

                        <div class="advanced-options" style="display: none;">
                            <div class="options-grid">
                                <div class="option-group">
                                    <label class="option-label">
                                        <input type="checkbox" id="excludeWeekends" name="excludeWeekends">
                                        <span class="checkmark"></span>
                                        Exclude Weekends
                                    </label>
                                    <div class="option-description">Remove Saturdays and Sundays from calculation</div>
                                </div>

                                <div class="option-group">
                                    <label class="option-label">
                                        <input type="checkbox" id="businessHours" name="businessHours">
                                        <span class="checkmark"></span>
                                        Business Hours Only (9 AM - 5 PM)
                                    </label>
                                    <div class="option-description">Calculate only during business hours</div>
                                </div>

                                <div class="option-group">
                                    <label class="option-label">
                                        <input type="checkbox" id="includeSeconds" name="includeSeconds" checked>
                                        <span class="checkmark"></span>
                                        Include Second Precision
                                    </label>
                                    <div class="option-description">Show seconds in results</div>
                                </div>

                                <div class="option-group">
                                    <label class="option-label">
                                        <input type="checkbox" id="accountLeap" name="accountLeap" checked>
                                        <span class="checkmark"></span>
                                        Account for Leap Years
                                    </label>
                                    <div class="option-description">Consider leap years in calculations</div>
                                </div>
                            </div>

                            <div class="timezone-section">
                                <label for="timezone" class="input-label">🌐 Timezone</label>
                                <select id="timezone" name="timezone" class="form-select">
                                    <option value="auto">Auto-detect</option>
                                    <option value="UTC">UTC</option>
                                    <option value="EST">Eastern Time (EST)</option>
                                    <option value="PST">Pacific Time (PST)</option>
                                    <option value="CET">Central European Time (CET)</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="form-actions">
                        <button type="submit" class="calculate-btn">
                            <span class="btn-icon">⚡</span>
                            Calculate Duration
                            <span class="btn-loading" style="display: none;">
                                <span class="spinner"></span>
                                Processing...
                            </span>
                        </button>
                        
                        <button type="button" class="clear-btn">
                            <span class="btn-icon">🔄</span>
                            Clear All
                        </button>
                    </div>
                </form>

                <!-- Results Section -->
                <div id="results" class="results-section" style="display: none;">
                    <div class="results-header">
                        <h3>🎯 Calculation Results</h3>
                        <div class="results-actions">
                            <button id="exportResults" class="action-btn">
                                <span class="btn-icon">📊</span>
                                Export Report
                            </button>
                            <button id="copyResults" class="action-btn">
                                <span class="btn-icon">📋</span>
                                Copy Results
                            </button>
                        </div>
                    </div>

                    <!-- Summary Cards -->
                    <div class="results-summary">
                        <div class="summary-card primary">
                            <div class="summary-icon">⏱️</div>
                            <div class="summary-content">
                                <div class="summary-value" id="totalDuration">0 days</div>
                                <div class="summary-label">Total Duration</div>
                            </div>
                        </div>
                        
                        <div class="summary-card">
                            <div class="summary-icon">📅</div>
                            <div class="summary-content">
                                <div class="summary-value" id="businessDays">0 days</div>
                                <div class="summary-label">Business Days</div>
                            </div>
                        </div>
                        
                        <div class="summary-card">
                            <div class="summary-icon">⚡</div>
                            <div class="summary-content">
                                <div class="summary-value" id="exactTime">0:00:00</div>
                                <div class="summary-label">Exact Time</div>
                            </div>
                        </div>
                    </div>

                    <!-- Detailed Breakdown -->
                    <div class="detailed-breakdown">
                        <h4>Detailed Time Breakdown</h4>
                        <div class="breakdown-grid">
                            <div class="breakdown-item">
                                <span class="breakdown-label">Years</span>
                                <span class="breakdown-value" id="yearsBreakdown">0</span>
                            </div>
                            <div class="breakdown-item">
                                <span class="breakdown-label">Months</span>
                                <span class="breakdown-value" id="monthsBreakdown">0</span>
                            </div>
                            <div class="breakdown-item">
                                <span class="breakdown-label">Weeks</span>
                                <span class="breakdown-value" id="weeksBreakdown">0</span>
                            </div>
                            <div class="breakdown-item">
                                <span class="breakdown-label">Days</span>
                                <span class="breakdown-value" id="daysBreakdown">0</span>
                            </div>
                            <div class="breakdown-item">
                                <span class="breakdown-label">Hours</span>
                                <span class="breakdown-value" id="hoursBreakdown">0</span>
                            </div>
                            <div class="breakdown-item">
                                <span class="breakdown-label">Minutes</span>
                                <span class="breakdown-value" id="minutesBreakdown">0</span>
                            </div>
                            <div class="breakdown-item">
                                <span class="breakdown-label">Seconds</span>
                                <span class="breakdown-value" id="secondsBreakdown">0</span>
                            </div>
                            <div class="breakdown-item">
                                <span class="breakdown-label">Milliseconds</span>
                                <span class="breakdown-value" id="millisecondsBreakdown">0</span>
                            </div>
                        </div>
                    </div>

                    <!-- Visualization -->
                    <div class="time-visualization">
                        <h4>Time Distribution</h4>
                        <div class="visualization-chart">
                            <div class="chart-bar">
                                <div class="bar-label">Years</div>
                                <div class="bar-container">
                                    <div class="bar-fill years-fill" style="width: 0%"></div>
                                </div>
                                <div class="bar-value">0%</div>
                            </div>
                            <div class="chart-bar">
                                <div class="bar-label">Months</div>
                                <div class="bar-container">
                                    <div class="bar-fill months-fill" style="width: 0%"></div>
                                </div>
                                <div class="bar-value">0%</div>
                            </div>
                            <div class="chart-bar">
                                <div class="bar-label">Days</div>
                                <div class="bar-container">
                                    <div class="bar-fill days-fill" style="width: 0%"></div>
                                </div>
                                <div class="bar-value">0%</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="features-section">
        <div class="container">
            <div class="section-header">
                <h2>Enterprise-Grade Features</h2>
                <p class="section-subtitle">Professional tools for precise time calculations</p>
            </div>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">⚡</div>
                    <h3>Millisecond Precision</h3>
                    <p>Calculate time differences with exact millisecond accuracy for critical business operations.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🌐</div>
                    <h3>Multi-Timezone Support</h3>
                    <p>Handle calculations across different timezones with automatic DST adjustments.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🔒</div>
                    <h3>Bank-Level Security</h3>
                    <p>Your data is encrypted and never stored. Enterprise-grade privacy protection.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="vip-footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>Time Duration Calculator</h3>
                    <p>Professional time calculation tools for enterprises and professionals.</p>
                </div>
                <div class="footer-section">
                    <h4>Products</h4>
                    <a href="#">Enterprise Edition</a>
                    <a href="#">API Access</a>
                    <a href="#">Mobile App</a>
                </div>
                <div class="footer-section">
                    <h4>Support</h4>
                    <a href="#">Documentation</a>
                    <a href="#">Enterprise Support</a>
                    <a href="#">Contact Sales</a>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2024 Time Duration Calculator Pro. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>