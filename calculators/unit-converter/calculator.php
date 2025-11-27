<?php
$pageTitle = "Free Online Calculators - 90storezon";
$pageDescription = "Use our free online calculators for unit conversion, finance, health, and math. Convert length, weight, temperature, currency and more.";
$pageKeywords = "unit converter, calculator, conversion, length, weight, temperature, currency";
$canonicalUrl = "https://90storezon.com/calculator.php";
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
</head>
<body>
    <?php include 'header.php'; ?>

    <main class="main-content">
        <div class="container">
            <div class="page-header">
                <h1>Free Online Calculators</h1>
                <p>Access 50+ specialized calculators for finance, health, education, and more</p>
            </div>

            <!-- Unit Converter Section -->
            <section class="calculator-section">
                <div class="section-header">
                    <h2>Unit Converter</h2>
                    <p>Convert between different units of measurement instantly</p>
                </div>

                <div class="unit-converter">
                    <div class="converter-controls">
                        <div class="input-group">
                            <label for="fromUnit">From:</label>
                            <select id="fromUnit" class="unit-select">
                                <option value="meter">Meter</option>
                                <option value="kilometer">Kilometer</option>
                                <option value="centimeter">Centimeter</option>
                                <option value="millimeter">Millimeter</option>
                                <option value="mile">Mile</option>
                                <option value="yard">Yard</option>
                                <option value="foot">Foot</option>
                                <option value="inch">Inch</option>
                                <option value="kilogram">Kilogram</option>
                                <option value="gram">Gram</option>
                                <option value="pound">Pound</option>
                                <option value="ounce">Ounce</option>
                                <option value="celsius">Celsius</option>
                                <option value="fahrenheit">Fahrenheit</option>
                                <option value="kelvin">Kelvin</option>
                            </select>
                        </div>

                        <div class="input-group">
                            <label for="toUnit">To:</label>
                            <select id="toUnit" class="unit-select">
                                <option value="meter">Meter</option>
                                <option value="kilometer">Kilometer</option>
                                <option value="centimeter">Centimeter</option>
                                <option value="millimeter">Millimeter</option>
                                <option value="mile">Mile</option>
                                <option value="yard">Yard</option>
                                <option value="foot">Foot</option>
                                <option value="inch">Inch</option>
                                <option value="kilogram">Kilogram</option>
                                <option value="gram">Gram</option>
                                <option value="pound">Pound</option>
                                <option value="ounce">Ounce</option>
                                <option value="celsius">Celsius</option>
                                <option value="fahrenheit">Fahrenheit</option>
                                <option value="kelvin">Kelvin</option>
                            </select>
                        </div>

                        <div class="input-group">
                            <label for="inputValue">Value:</label>
                            <input type="number" id="inputValue" class="value-input" placeholder="Enter value" step="any">
                        </div>

                        <button id="convertBtn" class="convert-button">Convert</button>
                    </div>

                    <div class="converter-result">
                        <div id="result" class="result-box">
                            <span class="result-text">Result will appear here</span>
                        </div>
                    </div>

                    <!-- Quick Conversion Buttons -->
                    <div class="quick-conversions">
                        <h3>Quick Conversions</h3>
                        <div class="quick-buttons">
                            <button class="quick-btn" data-from="kilometer" data-to="mile">KM to Miles</button>
                            <button class="quick-btn" data-from="meter" data-to="foot">Meters to Feet</button>
                            <button class="quick-btn" data-from="kilogram" data-to="pound">KG to Pounds</button>
                            <button class="quick-btn" data-from="celsius" data-to="fahrenheit">°C to °F</button>
                            <button class="quick-btn" data-from="inch" data-to="centimeter">Inch to CM</button>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Other Calculators Section -->
            <section class="other-calculators">
                <h2>Other Popular Calculators</h2>
                <div class="calculator-grid">
                    <div class="calc-card">
                        <h3>Scientific Calculator</h3>
                        <p>Advanced math functions and operations</p>
                        <a href="scientific-calculator.php" class="calc-link">Use Calculator</a>
                    </div>
                    <div class="calc-card">
                        <h3>BMI Calculator</h3>
                        <p>Calculate your Body Mass Index</p>
                        <a href="bmi-calculator.php" class="calc-link">Use Calculator</a>
                    </div>
                    <div class="calc-card">
                        <h3>Currency Converter</h3>
                        <p>Convert between world currencies</p>
                        <a href="currency-converter.php" class="calc-link">Use Calculator</a>
                    </div>
                    <div class="calc-card">
                        <h3>Loan Calculator</h3>
                        <p>Calculate loan payments and interest</p>
                        <a href="loan-calculator.php" class="calc-link">Use Calculator</a>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <?php include 'footer.php'; ?>

    <script>
        // Unit Conversion Functions
        const conversionRates = {
            // Length conversions
            meter: { 
                kilometer: 0.001, centimeter: 100, millimeter: 1000, 
                mile: 0.000621371, yard: 1.09361, foot: 3.28084, inch: 39.3701 
            },
            kilometer: { 
                meter: 1000, centimeter: 100000, millimeter: 1000000,
                mile: 0.621371, yard: 1093.61, foot: 3280.84, inch: 39370.1 
            },
            centimeter: { 
                meter: 0.01, kilometer: 0.00001, millimeter: 10,
                mile: 0.00000621371, yard: 0.0109361, foot: 0.0328084, inch: 0.393701 
            },
            millimeter: { 
                meter: 0.001, kilometer: 0.000001, centimeter: 0.1,
                mile: 6.21371e-7, yard: 0.00109361, foot: 0.00328084, inch: 0.0393701 
            },
            mile: { 
                meter: 1609.34, kilometer: 1.60934, centimeter: 160934,
                yard: 1760, foot: 5280, inch: 63360 
            },
            yard: { 
                meter: 0.9144, kilometer: 0.0009144, centimeter: 91.44,
                mile: 0.000568182, foot: 3, inch: 36 
            },
            foot: { 
                meter: 0.3048, kilometer: 0.0003048, centimeter: 30.48,
                mile: 0.000189394, yard: 0.333333, inch: 12 
            },
            inch: { 
                meter: 0.0254, kilometer: 0.0000254, centimeter: 2.54,
                mile: 0.0000157828, yard: 0.0277778, foot: 0.0833333 
            },
            
            // Weight conversions
            kilogram: { gram: 1000, pound: 2.20462, ounce: 35.274 },
            gram: { kilogram: 0.001, pound: 0.00220462, ounce: 0.035274 },
            pound: { kilogram: 0.453592, gram: 453.592, ounce: 16 },
            ounce: { kilogram: 0.0283495, gram: 28.3495, pound: 0.0625 },
            
            // Temperature conversions
            celsius: {
                fahrenheit: function(c) { return (c * 9/5) + 32; },
                kelvin: function(c) { return c + 273.15; }
            },
            fahrenheit: {
                celsius: function(f) { return (f - 32) * 5/9; },
                kelvin: function(f) { return (f - 32) * 5/9 + 273.15; }
            },
            kelvin: {
                celsius: function(k) { return k - 273.15; },
                fahrenheit: function(k) { return (k - 273.15) * 9/5 + 32; }
            }
        };

        document.getElementById('convertBtn').addEventListener('click', convertUnits);
        
        // Quick conversion buttons
        document.querySelectorAll('.quick-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const fromUnit = this.getAttribute('data-from');
                const toUnit = this.getAttribute('data-to');
                
                document.getElementById('fromUnit').value = fromUnit;
                document.getElementById('toUnit').value = toUnit;
                
                // Auto-focus on input
                document.getElementById('inputValue').focus();
            });
        });

        function convertUnits() {
            const fromUnit = document.getElementById('fromUnit').value;
            const toUnit = document.getElementById('toUnit').value;
            const inputValue = parseFloat(document.getElementById('inputValue').value);
            
            if (isNaN(inputValue)) {
                document.getElementById('result').innerHTML = '<span class="error-text">Please enter a valid number</span>';
                return;
            }
            
            let result;
            
            // Handle temperature conversions
            if (['celsius', 'fahrenheit', 'kelvin'].includes(fromUnit) && 
                ['celsius', 'fahrenheit', 'kelvin'].includes(toUnit)) {
                
                if (fromUnit === toUnit) {
                    result = inputValue;
                } else {
                    result = conversionRates[fromUnit][toUnit](inputValue);
                }
                
            } else {
                // Handle regular conversions
                if (fromUnit === toUnit) {
                    result = inputValue;
                } else if (conversionRates[fromUnit] && conversionRates[fromUnit][toUnit]) {
                    result = inputValue * conversionRates[fromUnit][toUnit];
                } else {
                    document.getElementById('result').innerHTML = '<span class="error-text">Conversion not supported</span>';
                    return;
                }
            }
            
            // Format result
            result = Math.round(result * 100000) / 100000;
            
            document.getElementById('result').innerHTML = `
                <span class="result-text">
                    ${inputValue} ${fromUnit} = ${result} ${toUnit}
                </span>
            `;
        }

        // Enter key support
        document.getElementById('inputValue').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                convertUnits();
            }
        });
    </script>
</body>
</html>