<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>21 Percentage Calculator - Accurate Percentage Tools</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <!-- VIP Trust Badge -->
    <div class="vip-badge">
        <div class="vip-card">
            <div class="vip-header">
                <div class="vip-crown">👑</div>
                <h3>PREMIUM VERIFIED</h3>
                <div class="vip-shield">🛡️</div>
            </div>
            <div class="vip-content">
                <div class="vip-badge-icon">⭐</div>
                <h4>TRUSTED CALCULATOR</h4>
                <p>21 Free Tools • 100,000+ Users</p>
                <div class="vip-features">
                    <span>✓ Accurate Results</span>
                    <span>✓ Instant Calculation</span>
                    <span>✓ 100% Free</span>
                </div>
            </div>
            <div class="vip-footer">
                <div class="trust-indicators">
                    <div class="trust-item">
                        <span class="trust-dot live"></span>
                        LIVE CALCULATOR
                    </div>
                    <div class="trust-item">
                        <span class="trust-dot ssl"></span>
                        SECURE TOOL
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Header -->
    <header class="main-header">
        <div class="container">
            <div class="logo-section">
                <h1>📊 21 Percentage Calculator</h1>
                <p>Professional Percentage Tools for Everyone</p>
            </div>
            <nav class="main-nav">
                <a href="#tools">Calculator Tools</a>
                <a href="#features">Features</a>
                <a href="#testimonials">Reviews</a>
                <a href="#contact">Contact</a>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <div class="trust-badges">
                    <div class="badge verified">
                        <span>✅</span> 100% Free Forever
                    </div>
                    <div class="badge accurate">
                        <span>🎯</span> 100% Accurate
                    </div>
                    <div class="badge users">
                        <span>👥</span> 100,000+ Users
                    </div>
                </div>
                <h2>Calculate Percentages with 21 Professional Tools</h2>
                <p>Instant percentage calculations for students, professionals, and businesses</p>
                <div class="cta-buttons">
                    <a href="calculator.php" class="btn btn-primary">Start Calculating Now</a>
                    <a href="#tools" class="btn btn-secondary">View All Tools</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Calculator Section -->
    <section class="main-calculator">
        <div class="container">
            <div class="calculator-grid">
                <!-- Basic Percentage Calculator -->
                <div class="calculator-card">
                    <h3>Basic Percentage Calculator</h3>
                    <div class="calc-form">
                        <div class="input-group">
                            <label>What is <input type="number" id="percent-of" placeholder="25">% of</label>
                            <input type="number" id="percent-number" placeholder="200">
                        </div>
                        <button onclick="calculatePercentage()" class="btn btn-calculate">Calculate</button>
                        <div id="basic-result" class="result"></div>
                    </div>
                </div>

                <!-- Percentage Increase/Decrease -->
                <div class="calculator-card">
                    <h3>Percentage Increase/Decrease</h3>
                    <div class="calc-form">
                        <div class="input-group">
                            <label>From: <input type="number" id="from-value" placeholder="100"></label>
                            <label>To: <input type="number" id="to-value" placeholder="150"></label>
                        </div>
                        <button onclick="calculatePercentageChange()" class="btn btn-calculate">Calculate Change</button>
                        <div id="change-result" class="result"></div>
                    </div>
                </div>

                <!-- Percentage Difference -->
                <div class="calculator-card">
                    <h3>Percentage Difference</h3>
                    <div class="calc-form">
                        <div class="input-group">
                            <label>Value 1: <input type="number" id="value1" placeholder="80"></label>
                            <label>Value 2: <input type="number" id="value2" placeholder="100"></label>
                        </div>
                        <button onclick="calculatePercentageDiff()" class="btn btn-calculate">Calculate Difference</button>
                        <div id="diff-result" class="result"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tools Grid -->
    <section id="tools" class="tools-section">
        <div class="container">
            <h3>21 Free Percentage Calculation Tools</h3>
            <div class="tools-grid">
                <?php
                $tools = [
                    "Basic Percentage Calculator", "Percentage Increase", "Percentage Decrease", 
                    "Percentage Difference", "Percentage Points", "Fraction to Percentage",
                    "Decimal to Percentage", "Ratio to Percentage", "Markup Calculator",
                    "Discount Calculator", "Tax Calculator", "Tip Calculator",
                    "Grade Calculator", "Profit Margin", "Loss Percentage",
                    "Percentage Error", "Percentage Growth", "Compound Percentage",
                    "Percentage of Total", "Reverse Percentage", "Percentage Change Over Time"
                ];
                
                foreach ($tools as $tool) {
                    echo '<div class="tool-card">';
                    echo '   <div class="tool-icon">🧮</div>';
                    echo '   <h4>' . $tool . '</h4>';
                    echo '   <p>Professional tool for accurate calculations</p>';
                    echo '   <a href="calculator.php?tool=' . urlencode($tool) . '" class="tool-link">Use Tool →</a>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section">
        <div class="container">
            <h3>Why Choose Our Percentage Calculators?</h3>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">⚡</div>
                    <h4>Instant Results</h4>
                    <p>Get accurate percentage calculations in real-time</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🎯</div>
                    <h4>100% Accurate</h4>
                    <p>Precise calculations every time with no errors</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🔒</div>
                    <h4>Completely Free</h4>
                    <p>No hidden costs, no registration required</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">📱</div>
                    <h4>Mobile Friendly</h4>
                    <p>Works perfectly on all devices and browsers</p>
                </div>
            </div>
        </div>
    </section>

    <footer class="main-footer">
        <div class="container">
            <p>&copy; 2024 21 Free Percentage Calculator. All rights reserved. | Accurate Calculations Made Easy</p>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>