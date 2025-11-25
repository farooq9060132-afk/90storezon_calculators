<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>23 Free Unit Converter - Professional Conversion Tools</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
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
                <div class="vip-badge-icon">⚡</div>
                <h4>TRUSTED CONVERTER</h4>
                <p>23 Free Tools • 200,000+ Users</p>
                <div class="vip-features">
                    <span>✓ Accurate Results</span>
                    <span>✓ Instant Conversion</span>
                    <span>✓ 100% Free</span>
                </div>
            </div>
            <div class="vip-footer">
                <div class="trust-indicators">
                    <div class="trust-item">
                        <span class="trust-dot live"></span>
                        LIVE CONVERTER
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
                <h1><i class="fas fa-exchange-alt"></i> 23 Free Unit Converter</h1>
                <p>Professional Conversion Tools for Everyone</p>
            </div>
            <nav class="main-nav">
                <a href="#tools"><i class="fas fa-tools"></i> Converter Tools</a>
                <a href="#features"><i class="fas fa-star"></i> Features</a>
                <a href="#categories"><i class="fas fa-list"></i> Categories</a>
                <a href="calculator.php"><i class="fas fa-calculator"></i> All Converters</a>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <div class="trust-badges">
                    <div class="badge verified">
                        <i class="fas fa-check-circle"></i> 100% Free Forever
                    </div>
                    <div class="badge accurate">
                        <i class="fas fa-bullseye"></i> 100% Accurate
                    </div>
                    <div class="badge users">
                        <i class="fas fa-users"></i> 200,000+ Users
                    </div>
                </div>
                <h2>Convert Any Unit with 23 Free Professional Tools</h2>
                <p>Instant unit conversions for length, weight, temperature, currency and more</p>
                <div class="cta-buttons">
                    <a href="calculator.php" class="btn btn-primary"><i class="fas fa-bolt"></i> Start Converting Now</a>
                    <a href="#tools" class="btn btn-secondary"><i class="fas fa-eye"></i> View All Tools</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Quick Converter Section -->
    <section class="quick-converter">
        <div class="container">
            <div class="converter-card">
                <h3><i class="fas fa-rocket"></i> Quick Unit Converter</h3>
                <div class="converter-form">
                    <div class="input-group">
                        <input type="number" id="quick-value" placeholder="Enter value" step="any">
                        <select id="quick-from-unit">
                            <option value="meter">Meter</option>
                            <option value="kilometer">Kilometer</option>
                            <option value="centimeter">Centimeter</option>
                            <option value="millimeter">Millimeter</option>
                        </select>
                        <span class="convert-arrow"><i class="fas fa-arrow-right"></i></span>
                        <select id="quick-to-unit">
                            <option value="meter">Meter</option>
                            <option value="kilometer">Kilometer</option>
                            <option value="centimeter">Centimeter</option>
                            <option value="millimeter">Millimeter</option>
                        </select>
                    </div>
                    <button onclick="quickConvert()" class="btn btn-convert"><i class="fas fa-sync-alt"></i> Convert</button>
                    <div id="quick-result" class="result"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tools Grid -->
    <section id="tools" class="tools-section">
        <div class="container">
            <h3><i class="fas fa-tools"></i> 23 Free Unit Conversion Tools</h3>
            <div class="tools-grid">
                <?php
                $tools = [
                    "Length Converter", "Weight Converter", "Temperature Converter", 
                    "Currency Converter", "Area Converter", "Volume Converter",
                    "Speed Converter", "Time Converter", "Digital Storage Converter",
                    "Energy Converter", "Power Converter", "Pressure Converter",
                    "Angle Converter", "Data Transfer Converter", "Cooking Converter",
                    "Shoe Size Converter", "Clothing Size Converter", "Fuel Converter",
                    "Torque Converter", "Density Converter", "Force Converter",
                    "Acceleration Converter", "Number System Converter"
                ];
                
                $icons = [
                    "fas fa-ruler", "fas fa-weight-hanging", "fas fa-thermometer-half",
                    "fas fa-money-bill-wave", "fas fa-vector-square", "fas fa-flask",
                    "fas fa-tachometer-alt", "fas fa-clock", "fas fa-database",
                    "fas fa-bolt", "fas fa-power-off", "fas fa-compress-arrows-alt",
                    "fas fa-protractor", "fas fa-wifi", "fas fa-utensils",
                    "fas fa-shoe-prints", "fas fa-tshirt", "fas fa-gas-pump",
                    "fas fa-cog", "fas fa-vial", "fas fa-hand-rock",
                    "fas fa-running", "fas fa-sort-numeric-up"
                ];
                
                foreach ($tools as $index => $tool) {
                    echo '<div class="tool-card">';
                    echo '   <div class="tool-icon"><i class="' . $icons[$index] . '"></i></div>';
                    echo '   <h4>' . $tool . '</h4>';
                    echo '   <p>Professional tool for accurate unit conversions</p>';
                    echo '   <a href="calculator.php?tool=' . urlencode($tool) . '" class="tool-link">Use Converter <i class="fas fa-arrow-right"></i></a>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section id="categories" class="categories-section">
        <div class="container">
            <h3><i class="fas fa-layer-group"></i> Conversion Categories</h3>
            <div class="categories-grid">
                <div class="category-card">
                    <div class="category-icon"><i class="fas fa-ruler-combined"></i></div>
                    <h4>Length & Distance</h4>
                    <p>Meters, Kilometers, Miles, Feet, Inches, etc.</p>
                </div>
                <div class="category-card">
                    <div class="category-icon"><i class="fas fa-weight-hanging"></i></div>
                    <h4>Weight & Mass</h4>
                    <p>Kilograms, Pounds, Ounces, Grams, Stones, etc.</p>
                </div>
                <div class="category-card">
                    <div class="category-icon"><i class="fas fa-thermometer-half"></i></div>
                    <h4>Temperature</h4>
                    <p>Celsius, Fahrenheit, Kelvin, Rankine, etc.</p>
                </div>
                <div class="category-card">
                    <div class="category-icon"><i class="fas fa-money-bill-wave"></i></div>
                    <h4>Currency</h4>
                    <p>USD, EUR, GBP, JPY, INR, AUD, etc.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section">
        <div class="container">
            <h3><i class="fas fa-star"></i> Why Choose Our Unit Converters?</h3>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-bolt"></i></div>
                    <h4>Instant Results</h4>
                    <p>Get accurate conversions in real-time with no delays</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-bullseye"></i></div>
                    <h4>100% Accurate</h4>
                    <p>Precise calculations based on international standards</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-lock"></i></div>
                    <h4>Completely Free</h4>
                    <p>No hidden costs, no registration required</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-mobile-alt"></i></div>
                    <h4>Mobile Friendly</h4>
                    <p>Works perfectly on all devices and browsers</p>
                </div>
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