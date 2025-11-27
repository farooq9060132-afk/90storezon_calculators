<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Universal Calculator - World Calculators Hub</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>🔢 Universal Calculator</h1>
            <p>A general purpose calculator for all your needs</p>
            <nav>
                <a href="index.php">🏠 Home</a>
            </nav>
        </header>

        <div class="calculator-container">
            <div class="calculator">
                <div class="display">
                    <input type="text" id="result" readonly placeholder="0">
                </div>
                
                <div class="buttons">
                    <button onclick="clearDisplay()" class="btn-clear">C</button>
                    <button onclick="deleteLast()" class="btn-clear">⌫</button>
                    <button onclick="appendToDisplay('%')" class="btn-operator">%</button>
                    <button onclick="appendToDisplay('/')" class="btn-operator">/</button>
                    
                    <button onclick="appendToDisplay('7')" class="btn-number">7</button>
                    <button onclick="appendToDisplay('8')" class="btn-number">8</button>
                    <button onclick="appendToDisplay('9')" class="btn-number">9</button>
                    <button onclick="appendToDisplay('*')" class="btn-operator">×</button>
                    
                    <button onclick="appendToDisplay('4')" class="btn-number">4</button>
                    <button onclick="appendToDisplay('5')" class="btn-number">5</button>
                    <button onclick="appendToDisplay('6')" class="btn-number">6</button>
                    <button onclick="appendToDisplay('-')" class="btn-operator">-</button>
                    
                    <button onclick="appendToDisplay('1')" class="btn-number">1</button>
                    <button onclick="appendToDisplay('2')" class="btn-number">2</button>
                    <button onclick="appendToDisplay('3')" class="btn-number">3</button>
                    <button onclick="appendToDisplay('+')" class="btn-operator">+</button>
                    
                    <button onclick="appendToDisplay('0')" class="btn-number btn-zero">0</button>
                    <button onclick="appendToDisplay('.')" class="btn-number">.</button>
                    <button onclick="calculate()" class="btn-equals">=</button>
                </div>
            </div>

            <div class="calculator-features">
                <h3>Additional Features</h3>
                <div class="feature-buttons">
                    <button onclick="square()" class="btn-feature">x²</button>
                    <button onclick="squareRoot()" class="btn-feature">√</button>
                    <button onclick="addToMemory()" class="btn-feature">M+</button>
                    <button onclick="recallMemory()" class="btn-feature">MR</button>
                    <button onclick="clearMemory()" class="btn-feature">MC</button>
                </div>
                
                <div class="quick-calculations">
                    <h4>Quick Calculations</h4>
                    <div class="quick-buttons">
                        <button onclick="calculatePercentage()" class="btn-quick">10% of Amount</button>
                        <button onclick="calculateDiscount()" class="btn-quick">20% Discount</button>
                        <button onclick="calculateTax()" class="btn-quick">Add 15% Tax</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="navigation">
            <a href="index.php" class="nav-btn">← Back to Home</a>
        </div>
    </div>

    <script>
        let memory = 0;
        
        function appendToDisplay(value) {
            const display = document.getElementById('result');
            if (display.value === '0' && value !== '.') {
                display.value = value;
            } else {
                display.value += value;
            }
        }
        
        function clearDisplay() {
            document.getElementById('result').value = '0';
        }
        
        function deleteLast() {
            const display = document.getElementById('result');
            display.value = display.value.slice(0, -1);
            if (display.value === '') display.value = '0';
        }
        
        function calculate() {
            const display = document.getElementById('result');
            try {
                display.value = eval(display.value.replace('×', '*'));
            } catch (error) {
                display.value = 'Error';
            }
        }
        
        function square() {
            const display = document.getElementById('result');
            const value = parseFloat(display.value);
            display.value = value * value;
        }
        
        function squareRoot() {
            const display = document.getElementById('result');
            const value = parseFloat(display.value);
            if (value >= 0) {
                display.value = Math.sqrt(value);
            } else {
                display.value = 'Error';
            }
        }
        
        function addToMemory() {
            const display = document.getElementById('result');
            memory += parseFloat(display.value) || 0;
        }
        
        function recallMemory() {
            document.getElementById('result').value = memory;
        }
        
        function clearMemory() {
            memory = 0;
        }
        
        function calculatePercentage() {
            const display = document.getElementById('result');
            const value = parseFloat(display.value);
            display.value = value * 0.1;
        }
        
        function calculateDiscount() {
            const display = document.getElementById('result');
            const value = parseFloat(display.value);
            display.value = value * 0.8;
        }
        
        function calculateTax() {
            const display = document.getElementById('result');
            const value = parseFloat(display.value);
            display.value = value * 1.15;
        }
        
        // Keyboard support
        document.addEventListener('keydown', function(event) {
            const key = event.key;
            if ('0123456789'.includes(key)) {
                appendToDisplay(key);
            } else if ('+-*/.'.includes(key)) {
                appendToDisplay(key);
            } else if (key === 'Enter' || key === '=') {
                calculate();
            } else if (key === 'Escape' || key === 'c' || key === 'C') {
                clearDisplay();
            } else if (key === 'Backspace') {
                deleteLast();
            }
        });
    </script>
</body>
</html>