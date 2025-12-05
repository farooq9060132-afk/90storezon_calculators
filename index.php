<?php
session_start();
require_once 'includes/db.php';
require_once 'includes/auth-check.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="90storezon - Free online calculators for finance, health, math, and more. Accurate, fast, and completely free.">
    <meta name="keywords" content="calculator, online calculator, financial calculator, health calculator, math calculator, free calculator">
    <title>90storezon - Free Online Calculators</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/theme-blue.css">
</head>
<body>
    <?php include 'header.php'; ?>
    
    <div class="container">
        <!-- Scientific Calculator -->
        <section class="scientific-calculator">
            <h2 class="section-title">Scientific Calculator</h2>
            <div class="calculator-wrapper">
                <div class="calculator-display">
                    <input type="text" id="calc-display" readonly value="0">
                    <div id="calc-memory">M: 0</div>
                </div>
                <div class="calculator-buttons">
                    <!-- Row 1 -->
                    <button class="calc-btn func-btn" data-action="sin">sin</button>
                    <button class="calc-btn func-btn" data-action="cos">cos</button>
                    <button class="calc-btn func-btn" data-action="tan">tan</button>
                    <button class="calc-btn func-btn" data-action="degRad">Deg/Rad</button>
                    
                    <!-- Row 2 -->
                    <button class="calc-btn func-btn" data-action="sin-1">sin<sup>-1</sup></button>
                    <button class="calc-btn func-btn" data-action="cos-1">cos<sup>-1</sup></button>
                    <button class="calc-btn func-btn" data-action="tan-1">tan<sup>-1</sup></button>
                    <button class="calc-btn func-btn" data-action="pi">π</button>
                    <button class="calc-btn func-btn" data-action="e">e</button>
                    
                    <!-- Row 3 -->
                    <button class="calc-btn func-btn" data-action="xy">x<sup>y</sup></button>
                    <button class="calc-btn func-btn" data-action="x3">x<sup>3</sup></button>
                    <button class="calc-btn func-btn" data-action="x2">x<sup>2</sup></button>
                    <button class="calc-btn func-btn" data-action="ex">e<sup>x</sup></button>
                    <button class="calc-btn func-btn" data-action="10x">10<sup>x</sup></button>
                    
                    <!-- Row 4 -->
                    <button class="calc-btn func-btn" data-action="y√x"><sup>y</sup>√x</button>
                    <button class="calc-btn func-btn" data-action="3√x"><sup>3</sup>√x</button>
                    <button class="calc-btn func-btn" data-action="√x">√x</button>
                    <button class="calc-btn func-btn" data-action="ln">ln</button>
                    <button class="calc-btn func-btn" data-action="log">log</button>
                    
                    <!-- Row 5 -->
                    <button class="calc-btn" data-value="(">(</button>
                    <button class="calc-btn" data-value=")">)</button>
                    <button class="calc-btn func-btn" data-action="1/x">1/x</button>
                    <button class="calc-btn func-btn" data-action="%">%</button>
                    <button class="calc-btn func-btn" data-action="factorial">n!</button>
                    
                    <!-- Row 6 -->
                    <button class="calc-btn num-btn" data-value="7">7</button>
                    <button class="calc-btn num-btn" data-value="8">8</button>
                    <button class="calc-btn num-btn" data-value="9">9</button>
                    <button class="calc-btn op-btn" data-value="+">+</button>
                    <button class="calc-btn func-btn" data-action="back">Back</button>
                    
                    <!-- Row 7 -->
                    <button class="calc-btn num-btn" data-value="4">4</button>
                    <button class="calc-btn num-btn" data-value="5">5</button>
                    <button class="calc-btn num-btn" data-value="6">6</button>
                    <button class="calc-btn op-btn" data-value="-">-</button>
                    <button class="calc-btn func-btn" data-action="ans">Ans</button>
                    
                    <!-- Row 8 -->
                    <button class="calc-btn num-btn" data-value="1">1</button>
                    <button class="calc-btn num-btn" data-value="2">2</button>
                    <button class="calc-btn num-btn" data-value="3">3</button>
                    <button class="calc-btn op-btn" data-value="*">×</button>
                    <button class="calc-btn func-btn" data-action="m+">M+</button>
                    
                    <!-- Row 9 -->
                    <button class="calc-btn num-btn" data-value="0">0</button>
                    <button class="calc-btn" data-value=".">.</button>
                    <button class="calc-btn func-btn" data-action="exp">EXP</button>
                    <button class="calc-btn op-btn" data-value="/">÷</button>
                    <button class="calc-btn func-btn" data-action="m-">M-</button>
                    
                    <!-- Row 10 -->
                    <button class="calc-btn func-btn" data-action="±">±</button>
                    <button class="calc-btn func-btn" data-action="rnd">RND</button>
                    <button class="calc-btn func-btn clear-btn" data-action="ac">AC</button>
                    <button class="calc-btn op-btn equals-btn" data-action="=">=</button>
                    <button class="calc-btn func-btn" data-action="mr">MR</button>
                </div>
            </div>
        </section>

        <!-- Search Section -->
        <section class="search-section">
            <div class="search-container">
                <input type="text" id="calculator-search" placeholder="Search for calculators (e.g., BMI, Loan, Mortgage)">
                <button id="search-btn">Search</button>
            </div>
            <div id="search-results" class="search-results"></div>
        </section>

        <!-- Calculator Categories -->
        <section class="categories-section">
            <h2 class="section-title">Calculator Categories</h2>
            <div class="categories-grid">
                <!-- Financial Calculators -->
                <div class="category-card">
                    <div class="category-icon financial">F</div>
                    <h3>Financial Calculators</h3>
                    <ul class="calculator-list">
                        <li><a href="calculators/mortgage-calculator/">Mortgage Calculator</a></li>
                        <li><a href="calculators/loan-calculator/">Loan Calculator</a></li>
                        <li><a href="calculators/auto-loan-calculator/">Auto Loan Calculator</a></li>
                        <li><a href="calculators/interest-calculator/">Interest Calculator</a></li>
                        <li><a href="calculators/investment-calculator/">Investment Calculator</a></li>
                        <li><a href="calculators/compound-interest-calculator/">Compound Interest</a></li>
                        <li><a href="calculators/tax-calculator/">Tax Calculator</a></li>
                        <li><a href="calculators/retirement-calculator/">Retirement Calculator</a></li>
                    </ul>
                </div>

                <!-- Health & Fitness -->
                <div class="category-card">
                    <div class="category-icon health">H</div>
                    <h3>Health & Fitness</h3>
                    <ul class="calculator-list">
                        <li><a href="calculators/bmi-calculator/">BMI Calculator</a></li>
                        <li><a href="calculators/calorie-calculator/">Calorie Calculator</a></li>
                        <li><a href="calculators/body-fat-calculator/">Body Fat Calculator</a></li>
                        <li><a href="calculators/bmr-calculator/">BMR Calculator</a></li>
                        <li><a href="calculators/ideal-weight-calculator/">Ideal Weight</a></li>
                        <li><a href="calculators/pregnancy-calculator/">Pregnancy Calculator</a></li>
                        <li><a href="calculators/pace-calculator/">Pace Calculator</a></li>
                        <li><a href="calculators/water-intake-calculator/">Water Intake</a></li>
                    </ul>
                </div>

                <!-- Math Calculators -->
                <div class="category-card">
                    <div class="category-icon math">M</div>
                    <h3>Mathematics</h3>
                    <ul class="calculator-list">
                        <li><a href="calculators/fraction-calculator/">Fraction Calculator</a></li>
                        <li><a href="calculators/percentage-calculator/">Percentage Calculator</a></li>
                        <li><a href="calculators/scientific-calculator/">Scientific Calculator</a></li>
                        <li><a href="calculators/algebra-calculator/">Algebra Calculator</a></li>
                        <li><a href="calculators/geometry-calculator/">Geometry Calculator</a></li>
                        <li><a href="calculators/statistics-calculator/">Statistics Calculator</a></li>
                        <li><a href="calculators/trigonometry-calculator/">Trigonometry</a></li>
                        <li><a href="calculators/calculus-calculator/">Calculus Calculator</a></li>
                    </ul>
                </div>

                <!-- Other Calculators -->
                <div class="category-card">
                    <div class="category-icon other">O</div>
                    <h3>Other Tools</h3>
                    <ul class="calculator-list">
                        <li><a href="calculators/age-calculator/">Age Calculator</a></li>
                        <li><a href="calculators/date-calculator/">Date Calculator</a></li>
                        <li><a href="calculators/time-calculator/">Time Calculator</a></li>
                        <li><a href="calculators/conversion-calculator/">Conversion Tool</a></li>
                        <li><a href="calculators/unit-converter/">Unit Converter</a></li>
                        <li><a href="calculators/currency-converter/">Currency Converter</a></li>
                        <li><a href="calculators/tip-calculator/">Tip Calculator</a></li>
                        <li><a href="calculators/discount-calculator/">Discount Calculator</a></li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- Featured Calculators -->
        <section class="featured-section">
            <h2 class="section-title">Popular Calculators</h2>
            <div class="featured-grid">
                <div class="featured-card">
                    <h3><a href="calculators/bmi-calculator/">BMI Calculator</a></h3>
                    <p>Calculate your Body Mass Index and understand your weight status.</p>
                </div>
                <div class="featured-card">
                    <h3><a href="calculators/loan-calculator/">Loan Calculator</a></h3>
                    <p>Calculate monthly payments, total interest, and loan amortization.</p>
                </div>
                <div class="featured-card">
                    <h3><a href="calculators/percentage-calculator/">Percentage Calculator</a></h3>
                    <p>Calculate percentages, increases, decreases, and comparisons.</p>
                </div>
                <div class="featured-card">
                    <h3><a href="calculators/mortgage-calculator/">Mortgage Calculator</a></h3>
                    <p>Plan your home purchase with accurate mortgage calculations.</p>
                </div>
                <div class="featured-card">
                    <h3><a href="calculators/age-calculator/">Age Calculator</a></h3>
                    <p>Calculate exact age in years, months, weeks, and days.</p>
                </div>
                <div class="featured-card">
                    <h3><a href="calculators/calorie-calculator/">Calorie Calculator</a></h3>
                    <p>Estimate daily calorie needs for weight management.</p>
                </div>
            </div>
        </section>

        <!-- About Section -->
        <section class="about-section">
            <h2 class="section-title">About 90storezon Calculators</h2>
            <div class="about-content">
                <p>Welcome to <strong>90storezon</strong>, your premier destination for free online calculators. Our primary mission is to deliver fast, comprehensive, and convenient calculation tools across numerous domains including finance, health, mathematics, and everyday utilities.</p>
                
                <p>Currently, we provide over 200 specialized calculators to help you solve mathematical problems, plan finances, track health metrics, and make informed decisions quickly and accurately. We are continuously expanding our collection to serve your evolving needs.</p>
                
                <p>Our vision is to become the ultimate one-stop resource for individuals who require reliable and immediate calculations. We strongly believe that essential tools and knowledge should be freely accessible to everyone. Consequently, all our calculators and services are completely free, with no registration requirements or hidden fees.</p>
                
                <p>Each calculator on 90storezon is independently coded and rigorously tested to ensure accuracy and reliability. We maintain high standards of quality control, but if you encounter any discrepancies, please notify us immediately—your feedback is invaluable for improvement.</p>
                
                <p>While most of our calculators are designed for global use, some tools may be tailored for specific regions or countries. For instance, certain financial calculators might be optimized for particular economic systems or tax structures. Always verify that the calculator suits your specific requirements.</p>
                
                <p>Thank you for choosing 90storezon. We are committed to enhancing your calculation experience with user-friendly interfaces, accurate results, and diverse toolkits for all your needs.</p>
            </div>
        </section>
    </div>

    <?php include 'footer.php'; ?>
    
    <script src="script.js"></script>
    <script>
        // Calculator functionality
        document.addEventListener('DOMContentLoaded', function() {
            const display = document.getElementById('calc-display');
            let currentInput = '0';
            let previousInput = '';
            let operation = null;
            let memory = 0;
            
            // Update display
            function updateDisplay() {
                display.value = currentInput;
                document.getElementById('calc-memory').textContent = `M: ${memory}`;
            }
            
            // Number buttons
            document.querySelectorAll('.num-btn').forEach(button => {
                button.addEventListener('click', () => {
                    if (currentInput === '0' || operation === '=') {
                        currentInput = button.getAttribute('data-value');
                    } else {
                        currentInput += button.getAttribute('data-value');
                    }
                    operation = null;
                    updateDisplay();
                });
            });
            
            // Operation buttons
            document.querySelectorAll('.op-btn').forEach(button => {
                button.addEventListener('click', () => {
                    previousInput = currentInput;
                    currentInput = '0';
                    operation = button.getAttribute('data-value');
                });
            });
            
            // Function buttons
            document.querySelectorAll('.func-btn').forEach(button => {
                button.addEventListener('click', () => {
                    const action = button.getAttribute('data-action');
                    
                    switch(action) {
                        case 'ac':
                            currentInput = '0';
                            previousInput = '';
                            operation = null;
                            break;
                        case 'back':
                            currentInput = currentInput.length > 1 ? currentInput.slice(0, -1) : '0';
                            break;
                        case '=':
                            if (previousInput && operation) {
                                const prev = parseFloat(previousInput);
                                const current = parseFloat(currentInput);
                                let result = 0;
                                
                                switch(operation) {
                                    case '+': result = prev + current; break;
                                    case '-': result = prev - current; break;
                                    case '*': result = prev * current; break;
                                    case '/': result = prev / current; break;
                                }
                                currentInput = result.toString();
                                previousInput = '';
                                operation = '=';
                            }
                            break;
                        case 'm+':
                            memory += parseFloat(currentInput);
                            break;
                        case 'm-':
                            memory -= parseFloat(currentInput);
                            break;
                        case 'mr':
                            currentInput = memory.toString();
                            break;
                        case '±':
                            currentInput = (-parseFloat(currentInput)).toString();
                            break;
                        case '√x':
                            currentInput = Math.sqrt(parseFloat(currentInput)).toString();
                            break;
                        case 'x2':
                            currentInput = Math.pow(parseFloat(currentInput), 2).toString();
                            break;
                        case '1/x':
                            currentInput = (1 / parseFloat(currentInput)).toString();
                            break;
                        case '%':
                            currentInput = (parseFloat(currentInput) / 100).toString();
                            break;
                    }
                    updateDisplay();
                });
            });
            
            // Search functionality
            const searchInput = document.getElementById('calculator-search');
            const searchResults = document.getElementById('search-results');
            
            searchInput.addEventListener('input', function() {
                const query = this.value.toLowerCase();
                if (query.length < 2) {
                    searchResults.innerHTML = '';
                    searchResults.style.display = 'none';
                    return;
                }
                
                // Mock search results (in real implementation, fetch from server)
                const allCalculators = [
                    'BMI Calculator', 'Loan Calculator', 'Mortgage Calculator',
                    'Percentage Calculator', 'Age Calculator', 'Calorie Calculator',
                    'Interest Calculator', 'Tax Calculator', 'Date Calculator'
                ];
                
                const results = allCalculators.filter(calc => 
                    calc.toLowerCase().includes(query)
                );
                
                if (results.length > 0) {
                    searchResults.innerHTML = results.map(result => 
                        `<div class="search-result-item">
                            <a href="calculators/${result.toLowerCase().replace(' ', '-')}/">${result}</a>
                        </div>`
                    ).join('');
                    searchResults.style.display = 'block';
                } else {
                    searchResults.innerHTML = '<div class="no-results">No calculators found</div>';
                    searchResults.style.display = 'block';
                }
            });
            
            // Initial display update
            updateDisplay();
        });
    </script>
</body>
</html>