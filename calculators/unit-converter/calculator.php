
<?php
$tool = isset($_GET['tool']) ? $_GET['tool'] : 'Length Converter';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($tool); ?> - 23 Free Unit Converter</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <!-- VIP Trust Badge -->
    <div class="vip-badge">
        <div class="vip-card">
            <div class="vip-header">
                <div class="vip-crown">👑</div>
                <h3>ACTIVE CONVERTER</h3>
                <div class="vip-shield">🛡️</div>
            </div>
            <div class="vip-content">
                <div class="vip-badge-icon">🔄</div>
                <h4><?php echo htmlspecialchars($tool); ?></h4>
                <p>Live Converter • Real-time Results</p>
                <div class="vip-features">
                    <span>✓ Instant Conversion</span>
                    <span>✓ 100% Accurate</span>
                    <span>✓ Professional Tool</span>
                </div>
            </div>
            <div class="vip-footer">
                <div class="trust-indicators">
                    <div class="trust-item">
                        <span class="trust-dot live"></span>
                        CONVERTING
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
                <h1><i class="fas fa-exchange-alt"></i> <?php echo htmlspecialchars($tool); ?></h1>
                <p>Professional Unit Converter</p>
            </div>
            <nav class="main-nav">
                <a href="index.php"><i class="fas fa-home"></i> Home</a>
                <a href="index.php#tools"><i class="fas fa-tools"></i> All Tools</a>
                <a href="#help"><i class="fas fa-question-circle"></i> Help</a>
            </nav>
        </div>
    </header>

    <!-- Calculator Section -->
    <section class="calculator-detail">
        <div class="container">
            <div class="calculator-main">
                <h2><i class="fas fa-exchange-alt"></i> <?php echo htmlspecialchars($tool); ?></h2>
                <p>Use this professional tool for accurate unit conversions</p>
                
                <div class="calculator-interface">
                    <?php
                    // Different converter interfaces based on the tool
                    switch($tool) {
                        case 'Length Converter':
                            echo '
                                <div class="converter-form">
                                    <div class="input-group">
                                        <input type="number" id="convert-value" placeholder="Enter value" step="any">
                                        <select id="from-unit">
                                            <option value="meter">Meter</option>
                                            <option value="kilometer">Kilometer</option>
                                            <option value="centimeter">Centimeter</option>
                                            <option value="millimeter">Millimeter</option>
                                            <option value="mile">Mile</option>
                                            <option value="yard">Yard</option>
                                            <option value="foot">Foot</option>
                                            <option value="inch">Inch</option>
                                        </select>
                                        <span class="convert-arrow"><i class="fas fa-arrow-right"></i></span>
                                        <select id="to-unit">
                                            <option value="meter">Meter</option>
                                            <option value="kilometer">Kilometer</option>
                                            <option value="centimeter">Centimeter</option>
                                            <option value="millimeter">Millimeter</option>
                                            <option value="mile">Mile</option>
                                            <option value="yard">Yard</option>
                                            <option value="foot">Foot</option>
                                            <option value="inch">Inch</option>
                                        </select>
                                    </div>
                                    <button onclick="convertLength()" class="btn btn-convert"><i class="fas fa-sync-alt"></i> Convert Length</button>
                                    <div id="conversion-result" class="result"></div>
                                </div>
                            ';
                            break;
                            
                        case 'Temperature Converter':
                            echo '
                                <div class="converter-form">
                                    <div class="input-group">
                                        <input type="number" id="temp-value" placeholder="Enter temperature" step="any">
                                        <select id="from-temp">
                                            <option value="celsius">Celsius</option>
                                            <option value="fahrenheit">Fahrenheit</option>
                                            <option value="kelvin">Kelvin</option>
                                        </select>
                                        <span class="convert-arrow"><i class="fas fa-arrow-right"></i></span>
                                        <select id="to-temp">
                                            <option value="celsius">Celsius</option>
                                            <option value="fahrenheit">Fahrenheit</option>
                                            <option value="kelvin">Kelvin</option>
                                        </select>
                                    </div>
                                    <button onclick="convertTemperature()" class="btn btn-convert"><i class="fas fa-sync-alt"></i> Convert Temperature</button>
                                    <div id="temp-result" class="result"></div>
                                </div>
                            ';
                            break;
                            
                        case 'Weight Converter':
                            echo '
                                <div class="converter-form">
                                    <div class="input-group">
                                        <input type="number" id="weight-value" placeholder="Enter weight" step="any">
                                        <select id="from-weight">
                                            <option value="kilogram">Kilogram</option>
                                            <option value="gram">Gram</option>
                                            <option value="pound">Pound</option>
                                            <option value="ounce">Ounce</option>
                                            <option value="stone">Stone</option>
                                        </select>
                                        <span class="convert-arrow"><i class="fas fa-arrow-right"></i></span>
                                        <select id="to-weight">
                                            <option value="kilogram">Kilogram</option>
                                            <option value="gram">Gram</option>
                                            <option value="pound">Pound</option>
                                            <option value="ounce">Ounce</option>
                                            <option value="stone">Stone</option>
                                        </select>
                                    </div>
                                    <button onclick="convertWeight()" class="btn btn-convert"><i class="fas fa-sync-alt"></i> Convert Weight</button>
                                    <div id="weight-result" class="result"></div>
                                </div>
                            ';
                            break;
                            
                        default:
                            echo '
                                <div class="converter-form">
                                    <div class="input-group">
                                        <input type="number" id="convert-value" placeholder="Enter value" step="any">
                                        <select id="from-unit">
                                            <option value="meter">Meter</option>
                                            <option value="kilometer">Kilometer</option>
                                            <option value="centimeter">Centimeter</option>
                                            <option value="millimeter">Millimeter</option>
                                        </select>
                                        <span class="convert-arrow"><i class="fas fa-arrow-right"></i></span>
                                        <select id="to-unit">
                                            <option value="meter">Meter</option>
                                            <option value="kilometer">Kilometer</option>
                                            <option value="centimeter">Centimeter</option>
                                            <option value="millimeter">Millimeter</option>
                                        </select>
                                    </div>
                                    <button onclick="convertLength()" class="btn btn-convert"><i class="fas fa-sync-alt"></i> Convert</button>
                                    <div id="conversion-result" class="result"></div>
                                </div>
                            ';
                    }
                    ?>
                </div>
                
                <div class="calculator-info">
                    <h4><i class="fas fa-info-circle"></i> About This Converter</h4>
                    <p>This professional unit converter provides instant, accurate results for all your conversion needs. Perfect for students, engineers, scientists, and professionals.</p>
                    
                    <div class="features-list">
                        <div class="feature"><i class="fas fa-bolt"></i> Instant conversions</div>
                        <div class="feature"><i class="fas fa-bullseye"></i> 100% accurate results</div>
                        <div class="feature"><i class="fas fa-lock"></i> No data stored</div>
                        <div class="feature"><i class="fas fa-mobile-alt"></i> Mobile-friendly</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Other Tools Section -->
    <section class="other-tools">
        <div class="container">
            <h3><i class="fas fa-random"></i> Other Unit Converters</h3>
            <div class="tools-quick">
                <a href="calculator.php?tool=Length Converter" class="tool-quick-link"><i class="fas fa-ruler"></i> Length</a>
                <a href="calculator.php?tool=Weight Converter" class="tool-quick-link"><i class="fas fa-weight-hanging"></i> Weight</a>
                <a href="calculator.php?tool=Temperature Converter" class="tool-quick-link"><i class="fas fa-thermometer-half"></i> Temperature</a>
                <a href="calculator.php?tool=Currency Converter" class="tool-quick-link"><i class="fas fa-money-bill-wave"></i> Currency</a>
                <a href="calculator.php?tool=Area Converter" class="tool-quick-link"><i class="fas fa-vector-square"></i> Area</a>
            </div>
        </div>
    </section>

    <footer class="main-footer">
        <div class="container">
            <p>&copy; 2024 23 Free Unit Converter. All rights reserved. | Professional Conversion Tools</p>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>