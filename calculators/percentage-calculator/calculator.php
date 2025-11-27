                                
                                <?php
$tool = isset($_GET['tool']) ? $_GET['tool'] : 'Basic Percentage Calculator';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($tool); ?> - 21 Free Percentage Calculator</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <!-- VIP Trust Badge -->
    <div class="vip-badge">
        <div class="vip-card">
            <div class="vip-header">
                <div class="vip-crown">👑</div>
                <h3>ACTIVE TOOL</h3>
                <div class="vip-shield">🛡️</div>
            </div>
            <div class="vip-content">
                <div class="vip-badge-icon">🧮</div>
                <h4><?php echo htmlspecialchars($tool); ?></h4>
                <p>Live Calculator • Real-time Results</p>
                <div class="vip-features">
                    <span>✓ Instant Calculation</span>
                    <span>✓ 100% Accurate</span>
                    <span>✓ Professional Tool</span>
                </div>
            </div>
            <div class="vip-footer">
                <div class="trust-indicators">
                    <div class="trust-item">
                        <span class="trust-dot live"></span>
                        CALCULATING
                    </div>
                    <div class="trust-item">
                        <span class="trust-dot ssl"></span>
                        SECURE
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Header -->
    <header class="main-header">
        <div class="container">
            <div class="logo-section">
                <h1>🧮 <?php echo htmlspecialchars($tool); ?></h1>
                <p>Professional Percentage Calculator</p>
            </div>
            <nav class="main-nav">
                <a href="index.php">Home</a>
                <a href="index.php#tools">All Tools</a>
                <a href="#contact">Help</a>
            </nav>
        </div>
    </header>

    <!-- Calculator Section -->
    <section class="calculator-detail">
        <div class="container">
            <div class="calculator-main">
                <h2><?php echo htmlspecialchars($tool); ?></h2>
                <p>Use this professional tool for accurate percentage calculations</p>
                
                <div class="calculator-interface">
                    <?php
                    // Different calculator interfaces based on the tool
                    switch($tool) {
                        case 'Discount Calculator':
                            echo '
                                <div class="calc-form">
                                    <div class="input-group">
                                        <label>Original Price: $<input type="number" id="original-price" placeholder="100"></label>
                                        <label>Discount Percentage: <input type="number" id="discount-percent" placeholder="20">%</label>
                                    </div>
                                    <button onclick="calculateDiscount()" class="btn btn-calculate">Calculate Discount</button>
                                    <div id="discount-result" class="result"></div>
                                </div>
                            ';
                            break;
                            
                        case 'Tax Calculator':
                            echo '
                                <div class="calc-form">
                                    <div class="input-group">
                                        <label>Amount Before Tax: $<input type="number" id="pre-tax-amount" placeholder="100"></label>
                                        <label>Tax Rate: <input type="number" id="tax-rate" placeholder="8.25">%</label>
                                    </div>
                                    <button onclick="calculateTax()" class="btn btn-calculate">Calculate Tax</button>
                                    <div id="tax-result" class="result"></div>
                                </div>
                            ';
                            break;
                            
                        case 'Tip Calculator':
                            echo '
                                <div class="calc-form">
                                    <div class="input-group">
                                        <label>Bill Amount: $<input type="number" id="bill-amount" placeholder="50"></label>
                                        <label>Tip Percentage: <input type="number" id="tip-percent" placeholder="15">%</label>
                                        <label>Number of People: <input type="number" id="people-count" placeholder="2"></label>
                                    </div>
                                    <button onclick="calculateTip()" class="btn btn-calculate">Calculate Tip</button>
                                    <div id="tip-result" class="result"></div>
                                </div>
                            ';
                            break;
                            
                        default:
                            echo '
                                <div class="calc-form">
                                    <div class="input-group">
                                        <label>What is <input type="number" id="percent-of" placeholder="25">% of</label>
                                        <input type="number" id="percent-number" placeholder="200">
                                    </div>
                                    <button onclick="calculatePercentage()" class="btn btn-calculate">Calculate</button>
                                    <div id="basic-result" class="result"></div>
                                </div>
                            ';
                    }
                    ?>
                </div>
                
                <div class="calculator-info">
                    <h4>About This Calculator</h4>
                    <p>This professional percentage calculator provides instant, accurate results for all your calculation needs. Perfect for students, teachers, professionals, and businesses.</p>
                    
                    <div class="features-list">
                        <div class="feature">⚡ Instant calculations</div>
                        <div class="feature">🎯 100% accurate results</div>
                        <div class="feature">🔒 No data stored</div>
                        <div class="feature">📱 Mobile-friendly</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Other Tools Section -->
    <section class="other-tools">
        <div class="container">
            <h3>Other Percentage Calculators</h3>
            <div class="tools-quick">
                <a href="calculator.php?tool=Discount Calculator" class="tool-quick-link">Discount Calculator</a>
                <a href="calculator.php?tool=Tax Calculator" class="tool-quick-link">Tax Calculator</a>
                <a href="calculator.php?tool=Tip Calculator" class="tool-quick-link">Tip Calculator</a>
                <a href="calculator.php?tool=Grade Calculator" class="tool-quick-link">Grade Calculator</a>
                <a href="calculator.php?tool=Profit Margin" class="tool-quick-link">Profit Margin</a>
            </div>
        </div>
    </section>

    <footer class="main-footer">
        <div class="container">
            <p>&copy; 2024 21 Free Percentage Calculator. All rights reserved. | Professional Calculation Tools</p>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>