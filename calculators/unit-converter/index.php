<?php
$pageTitle = "90storezon - Free Online Calculators & Unit Converter";
$pageDescription = "Free online calculators for unit conversion, finance, health, math, and everyday calculations. Convert length, weight, temperature, currency instantly.";
$pageKeywords = "unit converter, calculator, conversion, length, weight, temperature, currency, free calculator";
$canonicalUrl = "https://90storezon.com/";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <meta name="description" content="<?php echo $pageDescription; ?>">
    <meta name="keywords" content="<?php echo $pageKeywords; ?>">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="<?php echo $canonicalUrl; ?>">
    
    <link rel="stylesheet" href="style.css">
    
    <!-- Structured Data for SEO -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "WebApplication",
        "name": "90storezon - Free Online Calculators",
        "description": "Free online calculators for unit conversion, finance, health, math, and everyday calculations",
        "url": "https://90storezon.com/",
        "applicationCategory": "UtilityApplication",
        "operatingSystem": "Any",
        "permissions": "browser",
        "offers": {
            "@type": "Offer",
            "price": "0",
            "priceCurrency": "USD"
        }
    }
    </script>
</head>
<body>
    <?php include 'header.php'; ?>

    <main class="main-content">
        <!-- Hero Section -->
        <section class="hero-section">
            <div class="container">
                <div class="hero-content">
                    <h1 class="hero-title">Free Online Calculators & Unit Converter</h1>
                    <p class="hero-description">Access 50+ specialized calculators for finance, health, education, and more. Simple, fast, and completely free.</p>
                    
                    <div class="hero-features">
                        <div class="feature-item">
                            <span class="feature-icon">✅</span>
                            <span>100% Free</span>
                        </div>
                        <div class="feature-item">
                            <span class="feature-icon">⚡</span>
                            <span>Instant Results</span>
                        </div>
                        <div class="feature-item">
                            <span class="feature-icon">🔒</span>
                            <span>No Registration</span>
                        </div>
                    </div>

                    <!-- Quick Search -->
                    <div class="quick-search">
                        <input type="text" id="homeSearch" placeholder="Search for calculators (e.g., loan, BMI, currency)..." class="search-input-large">
                        <button id="homeSearchBtn" class="search-btn-large">Search</button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Featured Unit Converter -->
        <section class="featured-converter">
            <div class="container">
                <div class="section-header">
                    <h2>Quick Unit Converter</h2>
                    <p>Convert between different units instantly</p>
                </div>

                <div class="mini-converter">
                    <div class="converter-row">
                        <div class="input-group">
                            <input type="number" id="miniInputValue" placeholder="Enter value" class="mini-input">
                        </div>
                        
                        <div class="input-group">
                            <select id="miniFromUnit" class="mini-select">
                                <option value="kilometer">Kilometer</option>
                                <option value="meter">Meter</option>
                                <option value="centimeter">Centimeter</option>
                                <option value="kilogram">Kilogram</option>
                                <option value="pound">Pound</option>
                                <option value="celsius">Celsius</option>
                                <option value="fahrenheit">Fahrenheit</option>
                            </select>
                        </div>

                        <div class="converter-arrow">→</div>

                        <div class="input-group">
                            <select id="miniToUnit" class="mini-select">
                                <option value="mile">Mile</option>
                                <option value="foot">Foot</option>
                                <option value="inch">Inch</option>
                                <option value="pound">Pound</option>
                                <option value="kilogram">Kilogram</option>
                                <option value="fahrenheit">Fahrenheit</option>
                                <option value="celsius">Celsius</option>
                            </select>
                        </div>

                        <button id="miniConvertBtn" class="mini-convert-btn">Convert</button>
                    </div>

                    <div class="mini-result" id="miniResult">
                        <span>Result will appear here</span>
                    </div>

                    <!-- Popular Conversions -->
                    <div class="popular-conversions">
                        <h4>Popular Conversions:</h4>
                        <div class="popular-buttons">
                            <button class="popular-btn" data-from="kilometer" data-to="mile">KM → Miles</button>
                            <button class="popular-btn" data-from="kilogram" data-to="pound">KG → Pounds</button>
                            <button class="popular-btn" data-from="celsius" data-to="fahrenheit">°C → °F</button>
                            <button class="popular-btn" data-from="meter" data-to="foot">Meters → Feet</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Calculator Categories -->
        <section class="categories-section">
            <div class="container">
                <div class="section-header">
                    <h2>Calculator Categories</h2>
                    <p>Choose from our wide range of specialized calculators</p>
                </div>

                <div class="categories-grid">
                    <div class="category-card">
                        <div class="category-icon">📐</div>
                        <h3>Unit Converters</h3>
                        <p>Length, weight, temperature, volume and more</p>
                        <a href="calculator.php" class="category-link">Explore</a>
                    </div>
                    
                    <div class="category-card">
                        <div class="category-icon">💰</div>
                        <h3>Finance</h3>
                        <p>Loan, currency, tax, and investment calculators</p>
                        <a href="finance-calculators.php" class="category-link">Explore</a>
                    </div>
                    
                    <div class="category-card">
                        <div class="category-icon">❤️</div>
                        <h3>Health</h3>
                        <p>BMI, calorie, pregnancy, and health calculators</p>
                        <a href="health-calculators.php" class="category-link">Explore</a>
                    </div>
                    
                    <div class="category-card">
                        <div class="category-icon">🧮</div>
                        <h3>Math & Science</h3>
                        <p>Scientific, algebra, geometry calculators</p>
                        <a href="math-calculators.php" class="category-link">Explore</a>
                    </div>
                    
                    <div class="category-card">
                        <div class="category-icon">🏠</div>
                        <h3>Everyday Life</h3>
                        <p>Cooking, time, date, and utility calculators</p>
                        <a href="everyday-calculators.php" class="category-link">Explore</a>
                    </div>
                    
                    <div class="category-card">
                        <div class="category-icon">💼</div>
                        <h3>Business</h3>
                        <p>Profit, salary, VAT, and business tools</p>
                        <a href="business-calculators.php" class="category-link">Explore</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Popular Calculators -->
        <section class="popular-calculators">
            <div class="container">
                <div class="section-header">
                    <h2>Most Popular Calculators</h2>
                    <p>Quick access to our most used tools</p>
                </div>

                <div class="popular-grid">
                    <a href="calculator.php" class="popular-item">
                        <span class="popular-icon">🔄</span>
                        <span class="popular-text">Unit Converter</span>
                    </a>
                    
                    <a href="bmi-calculator.php" class="popular-item">
                        <span class="popular-icon">⚖️</span>
                        <span class="popular-text">BMI Calculator</span>
                    </a>
                    
                    <a href="currency-converter.php" class="popular-item">
                        <span class="popular-icon">💵</span>
                        <span class="popular-text">Currency Converter</span>
                    </a>
                    
                    <a href="loan-calculator.php" class="popular-item">
                        <span class="popular-icon">🏦</span>
                        <span class="popular-text">Loan Calculator</span>
                    </a>
                    
                    <a href="scientific-calculator.php" class="popular-item">
                        <span class="popular-icon">🔢</span>
                        <span class="popular-text">Scientific Calculator</span>
                    </a>
                    
                    <a href="age-calculator.php" class="popular-item">
                        <span class="popular-icon">🎂</span>
                        <span class="popular-text">Age Calculator</span>
                    </a>
                </div>
            </div>
        </section>

        <!-- SEO Content Section -->
        <section class="seo-content">
            <div class="container">
                <div class="content-box">
                    <h2>Free Online Unit Converter & Calculators</h2>
                    <p>Welcome to <strong>90storezon</strong> - your ultimate destination for free online calculators and unit conversion tools. Our comprehensive collection of calculators helps you solve everyday mathematical problems, convert between different measurement units, and make informed decisions.</p>
                    
                    <h3>Why Choose Our Calculators?</h3>
                    <ul>
                        <li><strong>100% Free:</strong> No hidden costs, no registration required</li>
                        <li><strong>Instant Results:</strong> Get accurate calculations in seconds</li>
                        <li><strong>Mobile Friendly:</strong> Works perfectly on all devices</li>
                        <li><strong>Comprehensive Tools:</strong> From basic arithmetic to advanced scientific calculations</li>
                    </ul>

                    <h3>Featured Unit Conversion Tools</h3>
                    <p>Our unit converter supports conversions between various measurement systems including:</p>
                    <ul>
                        <li><strong>Length:</strong> Meters, Kilometers, Miles, Feet, Inches, Centimeters</li>
                        <li><strong>Weight:</strong> Kilograms, Pounds, Ounces, Grams</li>
                        <li><strong>Temperature:</strong> Celsius, Fahrenheit, Kelvin</li>
                        <li><strong>Volume:</strong> Liters, Gallons, Milliliters, Cubic Meters</li>
                    </ul>

                    <p>Whether you're a student, professional, or just someone who needs quick calculations, 90storezon provides reliable tools that deliver accurate results instantly. Bookmark our site for easy access to all your calculation needs!</p>
                </div>
            </div>
        </section>
    </main>

    <?php include 'footer.php'; ?>

    <script>
        // Mini Converter Functionality
        document.getElementById('miniConvertBtn').addEventListener('click', convertMiniUnits);
        
        // Popular conversion buttons
        document.querySelectorAll('.popular-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const fromUnit = this.getAttribute('data-from');
                const toUnit = this.getAttribute('data-to');
                
                document.getElementById('miniFromUnit').value = fromUnit;
                document.getElementById('miniToUnit').value = toUnit;
                document.getElementById('miniInputValue').focus();
            });
        });

        // Home search functionality
        document.getElementById('homeSearchBtn').addEventListener('click', function() {
            const searchTerm = document.getElementById('homeSearch').value.toLowerCase();
            if (searchTerm) {
                window.location.href = `calculator.php?search=${encodeURIComponent(searchTerm)}`;
            }
        });

        document.getElementById('homeSearch').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                const searchTerm = this.value.toLowerCase();
                if (searchTerm) {
                    window.location.href = `calculator.php?search=${encodeURIComponent(searchTerm)}`;
                }
            }
        });

        function convertMiniUnits() {
            const fromUnit = document.getElementById('miniFromUnit').value;
            const toUnit = document.getElementById('miniToUnit').value;
            const inputValue = parseFloat(document.getElementById('miniInputValue').value);
            
            if (isNaN(inputValue)) {
                document.getElementById('miniResult').innerHTML = '<span class="error-text">Please enter a valid number</span>';
                return;
            }
            
            // Simple conversion rates for demo
            const rates = {
                kilometer: { mile: 0.621371 },
                meter: { foot: 3.28084 },
                centimeter: { inch: 0.393701 },
                kilogram: { pound: 2.20462 },
                pound: { kilogram: 0.453592 },
                celsius: { 
                    fahrenheit: function(c) { return (c * 9/5) + 32; } 
                },
                fahrenheit: { 
                    celsius: function(f) { return (f - 32) * 5/9; } 
                }
            };
            
            let result;
            
            if (fromUnit === toUnit) {
                result = inputValue;
            } else if (rates[fromUnit] && rates[fromUnit][toUnit]) {
                if (typeof rates[fromUnit][toUnit] === 'function') {
                    result = rates[fromUnit][toUnit](inputValue);
                } else {
                    result = inputValue * rates[fromUnit][toUnit];
                }
            } else {
                document.getElementById('miniResult').innerHTML = '<span class="error-text">Conversion not available</span>';
                return;
            }
            
            result = Math.round(result * 1000) / 1000;
            
            document.getElementById('miniResult').innerHTML = `
                <span class="result-text">
                    <strong>${inputValue} ${fromUnit} = ${result} ${toUnit}</strong>
                </span>
            `;
        }

        // Enter key support for mini converter
        document.getElementById('miniInputValue').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                convertMiniUnits();
            }
        });
    </script>
</body>
</html>