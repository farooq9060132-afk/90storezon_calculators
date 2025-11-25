<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scientific Calculator - Advanced Math Tool</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@300;400;500;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <header class="header">
            <h1>🧮 Scientific Calculator</h1>
            <p>Advanced Mathematical Calculator with Scientific Functions</p>
        </header>

        <div class="calculator-container">
            <div class="calculator">
                <div class="display">
                    <div class="previous-operand" id="previousOperand"></div>
                    <div class="current-operand" id="currentOperand">0</div>
                </div>
                
                <div class="buttons-grid">
                    <!-- Scientific Functions Row -->
                    <button class="btn scientific" data-action="sin">sin</button>
                    <button class="btn scientific" data-action="cos">cos</button>
                    <button class="btn scientific" data-action="tan">tan</button>
                    <button class="btn scientific" data-action="log">log</button>
                    <button class="btn scientific" data-action="ln">ln</button>
                    
                    <!-- Memory Functions -->
                    <button class="btn memory" data-action="mc">MC</button>
                    <button class="btn memory" data-action="mr">MR</button>
                    <button class="btn memory" data-action="m-plus">M+</button>
                    <button class="btn memory" data-action="m-minus">M-</button>
                    <button class="btn clear" data-action="clear">C</button>
                    <button class="btn clear" data-action="delete">DEL</button>
                    
                    <!-- Second Row -->
                    <button class="btn scientific" data-action="sqrt">√</button>
                    <button class="btn scientific" data-action="power">x²</button>
                    <button class="btn scientific" data-action="power-y">xʸ</button>
                    <button class="btn scientific" data-action="factorial">x!</button>
                    <button class="btn scientific" data-action="pi">π</button>
                    <button class="btn scientific" data-action="e">e</button>
                    
                    <!-- Number Pad -->
                    <button class="btn number" data-number="7">7</button>
                    <button class="btn number" data-number="8">8</button>
                    <button class="btn number" data-number="9">9</button>
                    <button class="btn operation" data-operation="÷">÷</button>
                    <button class="btn operation" data-operation="%">%</button>
                    
                    <button class="btn number" data-number="4">4</button>
                    <button class="btn number" data-number="5">5</button>
                    <button class="btn number" data-number="6">6</button>
                    <button class="btn operation" data-operation="×">×</button>
                    <button class="btn parenthesis" data-action="(">(</button>
                    
                    <button class="btn number" data-number="1">1</button>
                    <button class="btn number" data-number="2">2</button>
                    <button class="btn number" data-number="3">3</button>
                    <button class="btn operation" data-operation="-">-</button>
                    <button class="btn parenthesis" data-action=")">)</button>
                    
                    <button class="btn number" data-number="0">0</button>
                    <button class="btn decimal" data-action=".">.</button>
                    <button class="btn equals" data-action="=">=</button>
                    <button class="btn operation" data-operation="+">+</button>
                    <button class="btn scientific" data-action="ans">ANS</button>
                </div>
            </div>
            
            <div class="calculator-info">
                <h3>Calculator Features</h3>
                <ul>
                    <li>Basic Arithmetic Operations</li>
                    <li>Trigonometric Functions (sin, cos, tan)</li>
                    <li>Logarithmic Functions (log, ln)</li>
                    <li>Exponential Functions</li>
                    <li>Square Root and Power Functions</li>
                    <li>Memory Functions (MC, MR, M+, M-)</li>
                    <li>Constants (π, e)</li>
                    <li>Parenthesis Support</li>
                </ul>
            </div>
        </div>
        
        <div class="history-section">
            <h3>Calculation History</h3>
            <div class="history-list" id="historyList">
                <!-- History items will be added here -->
            </div>
            <button class="clear-history" id="clearHistory">Clear History</button>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>