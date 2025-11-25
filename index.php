<?php include 'header.php'; ?>

<!-- Main Content -->
<main class="container">
    <h1 class="seo-heading">Free Online Calculators for Finance, Health, Math & More</h1>
    <p class="intro-text">Access 50+ powerful calculators to help with financial planning, health tracking, math problems, and everyday calculations. Get instant, accurate results for free!</p>
    
    <!-- Calculator Section -->
    <section class="calculator-section">
        <div class="calculator-container">
            <div class="calculator-history" id="calculator-history"></div>
            <div class="calculator-display">
                <div id="calculator-output">0</div>
            </div>
            <div class="calculator-buttons">
                <button class="calc-btn" onclick="clearCalculator()">C</button>
                <button class="calc-btn" onclick="appendToCalculator('±')">±</button>
                <button class="calc-btn" onclick="appendToCalculator('%')">%</button>
                <button class="calc-btn operator" onclick="appendToCalculator('/')">÷</button>
                
                <button class="calc-btn" onclick="appendToCalculator('7')">7</button>
                <button class="calc-btn" onclick="appendToCalculator('8')">8</button>
                <button class="calc-btn" onclick="appendToCalculator('9')">9</button>
                <button class="calc-btn operator" onclick="appendToCalculator('*')">×</button>
                
                <button class="calc-btn" onclick="appendToCalculator('4')">4</button>
                <button class="calc-btn" onclick="appendToCalculator('5')">5</button>
                <button class="calc-btn" onclick="appendToCalculator('6')">6</button>
                <button class="calc-btn operator" onclick="appendToCalculator('-')">−</button>
                
                <button class="calc-btn" onclick="appendToCalculator('1')">1</button>
                <button class="calc-btn" onclick="appendToCalculator('2')">2</button>
                <button class="calc-btn" onclick="appendToCalculator('3')">3</button>
                <button class="calc-btn operator" onclick="appendToCalculator('+')">+</button>
                
                <button class="calc-btn zero" onclick="appendToCalculator('0')">0</button>
                <button class="calc-btn" onclick="appendToCalculator('.')">.</button>
                <button class="calc-btn equals" onclick="calculateResult()">=</button>
            </div>
        </div>
    </section>


    <!-- Calculators List -->
    <section class="calculators-section">
        <!-- Financial Calculators -->
        <div class="category">
            <h2>Financial Planning Tools</h2>
            <p>Our financial calculators help you plan your loans, investments, and savings with precision.</p>
            <ul class="calculator-list">
                <li><a href="/calculators/01-loan-emi-calculator/">Loan EMI Calculator</a></li>
                <li><a href="/calculators/04-mortgage-calculator/">Mortgage Calculator</a></li>
                <li><a href="/calculators/05-compound-interest-calculator/">Compound Interest Calculator</a></li>
                <li><a href="/calculators/11-investment-calculator/">Investment Calculator</a></li>
                <li><a href="/calculators/10-retirement-planner/">Retirement Planner</a></li>
                <li><a href="/calculators/09-tax-calculator/">Tax Calculator</a></li>
                <li><a href="/calculators/13-budget-planner/">Budget Planner</a></li>
                <li><a href="/calculators/12-salary-calculator/">Salary Calculator</a></li>
                <li><a href="/calculators/03-currency-converter/">Currency Converter</a></li>
                <li><a href="/calculators/36-fuel-cost-calculator/">Fuel Cost Calculator</a></li>
            </ul>
        </div>

        <!-- Health & Fitness Calculators -->
        <div class="category">
            <h2>Health & Wellness Tools</h2>
            <p>Track your health metrics and fitness goals with our specialized health calculators.</p>
            <ul class="calculator-list">
                <li><a href="/calculators/02-bmi-calculator/">BMI Calculator</a></li>
                <li><a href="/calculators/06-calorie-calculator/">Calorie Calculator</a></li>
                <li><a href="/calculators/14-body-fat-calculator/">Body Fat Calculator</a></li>
                <li><a href="/calculators/17-macro-calculator/">Macro Calculator</a></li>
                <li><a href="/calculators/16-water-intake-calculator/">Water Intake Calculator</a></li>
                <li><a href="/calculators/15-pregnancy-calculator/">Pregnancy Calculator</a></li>
                <li><a href="/calculators/18-heart-rate-calculator/">Heart Rate Calculator</a></li>
                <li><a href="/calculators/19-medication-calculator/">Medication Calculator</a></li>
                <li><a href="/calculators/34-tip-calculator/">Tip Calculator</a></li>
                <li><a href="/calculators/35-discount-calculator/">Discount Calculator</a></li>
            </ul>
        </div>

        <!-- Math Calculators -->
        <div class="category">
            <h2>Math & Education Tools</h2>
            <p>Solve complex math problems and academic calculations with ease.</p>
            <ul class="calculator-list">
                <li><a href="/calculators/21-percentage-calculator/">Percentage Calculator</a></li>
                <li><a href="/calculators/20-gpa-calculator/">GPA Calculator</a></li>
                <li><a href="/calculators/22-age-calculator/">Age Calculator</a></li>
                <li><a href="/calculators/24-scientific-calculator/">Scientific Calculator</a></li>
                <li><a href="/calculators/25-grade-calculator/">Grade Calculator</a></li>
                <li><a href="/calculators/26-study-planner/">Study Planner</a></li>
                <li><a href="/calculators/37-time-duration-calculator/">Time Duration Calculator</a></li>
                <li><a href="/calculators/38-age-difference-calculator/">Age Difference Calculator</a></li>
                <li><a href="/calculators/39-date-calculator/">Date Calculator</a></li>
                <li><a href="/calculators/23-unit-converter/">Unit Converter</a></li>
            </ul>
        </div>

        <!-- Web Tools & Converters -->
        <div class="category">
            <h2>Web Utilities & Converters</h2>
            <p>Essential tools for developers and everyday web users.</p>
            <ul class="calculator-list">
                <li><a href="/calculators/07-qr-code-generator/">QR Code Generator</a></li>
                <li><a href="/calculators/08-password-generator/">Password Generator</a></li>
                <li><a href="/calculators/27-password-strength-checker/">Password Strength Checker</a></li>
                <li><a href="/calculators/28-file-size-converter/">File Size Converter</a></li>
                <li><a href="/calculators/29-color-code-converter/">Color Code Converter</a></li>
                <li><a href="/calculators/30-time-zone-converter/">Time Zone Converter</a></li>
                <li><a href="/calculators/31-data-storage-calculator/">Data Storage Calculator</a></li>
                <li><a href="/calculators/40-base64-converter/">Base64 Converter</a></li>
                <li><a href="/calculators/41-json-formatter/">JSON Formatter</a></li>
                <li><a href="/calculators/42-regex-tester/">Regex Tester</a></li>
            </ul>
        </div>

        <!-- Programming & Development -->
        <div class="category">
            <h2>Developer Tools</h2>
            <p>Essential utilities for programmers and developers.</p>
            <ul class="calculator-list">
                <li><a href="/calculators/43-code-beautifier/">Code Beautifier</a></li>
                <li><a href="/calculators/44-md5-generator/">MD5 Generator</a></li>
                <li><a href="/calculators/45-url-encoder/">URL Encoder</a></li>
                <li><a href="/calculators/46-character-counter/">Character Counter</a></li>
                <li><a href="/calculators/47-lorem-ipsum-generator/">Lorem Ipsum Generator</a></li>
                <li><a href="/calculators/48-csv-to-json-converter/">CSV to JSON Converter</a></li>
                <li><a href="/calculators/32-website-load-time-calculator/">Website Load Time Calculator</a></li>
                <li><a href="/calculators/33-api-calculator/">API Calculator</a></li>
                <li><a href="/calculators/49-carbon-footprint-calculator/">Carbon Footprint Calculator</a></li>
                <li><a href="/calculators/50-youtube-earnings-calculator/">YouTube Earnings Calculator</a></li>
            </ul>
        </div>
    </section>
</div>

<style>
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    /* Calculator Styles */
    .calculator-section {
        background: white;
        border-radius: 12px;
        padding: 30px;
        margin-bottom: 30px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        max-width: 400px;
        margin-left: auto;
        margin-right: auto;
        border: 1px solid #e0e0e0;
    }

    .calculator-history {
        background: #f8f9fa;
        border: 1px solid #dadce0;
        border-radius: 8px 8px 0 0;
        padding: 10px 20px;
        margin-bottom: 0;
        text-align: right;
        font-size: 16px;
        min-height: 20px;
        color: #5f6368;
        border-bottom: none;
    }

    .calculator-display {
        background: #f8f9fa;
        border: 1px solid #dadce0;
        border-radius: 0 0 8px 8px;
        padding: 20px;
        margin-bottom: 15px;
        text-align: right;
        font-size: 28px;
        font-weight: 500;
        min-height: 70px;
        display: flex;
        align-items: center;
        justify-content: flex-end;
        box-shadow: inset 0 1px 3px rgba(0,0,0,0.05);
    }

    .calculator-buttons {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 12px;
    }

    .calc-btn {
        background: white;
        border: 1px solid #dadce0;
        border-radius: 8px;
        padding: 16px;
        font-size: 18px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }

    .calc-btn:hover {
        background: #f8f9fa;
        transform: translateY(-2px);
        box-shadow: 0 3px 6px rgba(0,0,0,0.1);
    }

    .calc-btn:active {
        transform: translateY(0);
    }

    .calc-btn.operator {
        background: #f1f3f4;
        font-weight: 600;
    }

    .calc-btn.equals {
        background: #1a73e8;
        color: white;
        font-weight: 600;
    }

    .calc-btn.equals:hover {
        background: #1558d6;
    }

    .calc-btn.zero {
        grid-column: span 2;
    }

    /* Search Styles */
    .search-section {
        margin-bottom: 30px;
        text-align: center;
    }

    .search-bar {
        width: 100%;
        max-width: 600px;
        padding: 14px 24px;
        border: 1px solid #dadce0;
        border-radius: 30px;
        font-size: 16px;
        outline: none;
        transition: all 0.3s ease;
        box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    }

    .search-bar:focus {
        border-color: #1a73e8;
        box-shadow: 0 0 0 3px rgba(26,115,232,0.2), 0 4px 12px rgba(0,0,0,0.1);
        transform: translateY(-1px);
    }
    
    .search-bar::placeholder {
        color: #5f6368;
    }

    /* Categories Styles */
    .calculators-section {
        display: grid;
        grid-template-columns: 1fr;
        gap: 30px;
    }

    @media (min-width: 768px) {
        .calculators-section {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    
    @media (min-width: 1024px) {
        .calculators-section {
            grid-template-columns: repeat(3, 1fr);
        }
    }
    
    @media (min-width: 1200px) {
        .calculators-section {
            grid-template-columns: repeat(5, 1fr);
        }
    }

    .category {
        background: white;
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        border: 1px solid #e0e0e0;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .category:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.12);
    }

    .category h3 {
        margin: 0 0 20px 0;
        font-size: 20px;
        font-weight: 600;
        color: #202124;
        border-bottom: 2px solid #1a73e8;
        padding-bottom: 12px;
        letter-spacing: -0.3px;
    }

    .calculator-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .calculator-list li {
        margin-bottom: 10px;
        border-radius: 6px;
        transition: background-color 0.2s ease;
    }
    
    .calculator-list li:hover {
        background-color: #f8f9fa;
    }

    .calculator-list a {
        color: #1a73e8;
        text-decoration: none;
        font-size: 15px;
        display: block;
        padding: 8px 12px;
        border-radius: 6px;
        transition: all 0.2s ease;
    }

    .calculator-list a:hover {
        color: #1558d6;
        background-color: #e8f0fe;
        text-decoration: none;
        padding-left: 16px;
    }

    .no-results {
        text-align: center;
        color: #5f6368;
        font-style: italic;
        padding: 20px;
    }
</style>

<script>
    // Calculator functionality
    let currentInput = '0';
    let previousInput = '';
    let operation = null;
    let shouldResetScreen = false;
    let calculationHistory = '';

    function updateDisplay() {
        document.getElementById('calculator-output').textContent = currentInput;
        document.getElementById('calculator-history').textContent = calculationHistory;
    }

    function appendToCalculator(value) {
        // Handle special operations first
        if (value === '±') {
            if (currentInput !== '0') {
                currentInput = currentInput.startsWith('-') ? currentInput.slice(1) : '-' + currentInput;
            }
            updateDisplay();
            return;
        }
        
        if (value === '%') {
            if (currentInput !== '0') {
                currentInput = (parseFloat(currentInput) / 100).toString();
            }
            updateDisplay();
            return;
        }

        // Handle operators
        if (['+', '-', '*', '/'].includes(value)) {
            if (currentInput === '' && previousInput !== '') {
                // Change operation if no current input
                operation = value;
                calculationHistory = previousInput + ' ' + getOperationSymbol(value);
                updateDisplay();
                return;
            }
            
            if (previousInput !== '' && operation !== null && !shouldResetScreen) {
                // Calculate result before applying new operation
                calculateResult();
            }
            
            previousInput = currentInput;
            operation = value;
            shouldResetScreen = true;
            calculationHistory = previousInput + ' ' + getOperationSymbol(value);
            updateDisplay();
            return;
        }

        // Handle numbers and decimal point
        if (shouldResetScreen) {
            if (value === '.') {
                currentInput = '0.';
            } else {
                currentInput = value;
            }
            shouldResetScreen = false;
        } else {
            if (value === '.') {
                if (!currentInput.includes('.')) {
                    currentInput += '.';
                }
            } else {
                if (currentInput === '0') {
                    currentInput = value;
                } else {
                    currentInput += value;
                }
            }
        }
        
        updateDisplay();
    }

    function getOperationSymbol(op) {
        switch(op) {
            case '+': return '+';
            case '-': return '−';
            case '*': return '×';
            case '/': return '÷';
            default: return op;
        }
    }

    function clearCalculator() {
        currentInput = '0';
        previousInput = '';
        operation = null;
        shouldResetScreen = false;
        calculationHistory = '';
        updateDisplay();
    }

    function calculateResult() {
        if (operation === null || shouldResetScreen) return;

        const prev = parseFloat(previousInput);
        const current = parseFloat(currentInput);
        
        if (isNaN(prev) || isNaN(current)) return;

        let result;
        switch (operation) {
            case '+':
                result = prev + current;
                break;
            case '-':
                result = prev - current;
                break;
            case '*':
                result = prev * current;
                break;
            case '/':
                if (current === 0) {
                    result = 'Error';
                } else {
                    result = prev / current;
                }
                break;
            default:
                return;
        }

        // Update history to show the full calculation
        calculationHistory = previousInput + ' ' + getOperationSymbol(operation) + ' ' + currentInput + ' =';
        currentInput = typeof result === 'number' ? result.toString() : result;
        operation = null;
        previousInput = '';
        shouldResetScreen = true;
        updateDisplay();
    }

</script>

<?php include 'footer.php'; ?>