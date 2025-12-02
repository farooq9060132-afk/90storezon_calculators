<?php
// Include your website's header
include '../../header.php';
?>

<style>
/* Percentage Calculator Styles */
.calculator-container {
    max-width: 1200px;
    margin: 30px auto;
    padding: 0 20px;
    font-family: Arial, sans-serif;
}

.breadcrumb {
    font-size: 14px;
    color: #5f6368;
    margin-bottom: 20px;
}

.breadcrumb a {
    color: #0052FF;
    text-decoration: none;
}

.breadcrumb a:hover {
    text-decoration: underline;
}

.breadcrumb span {
    color: #5f6368;
    margin: 0 5px;
}

.calculator-title {
    font-size: 32px;
    font-weight: bold;
    color: #202124;
    margin-bottom: 20px;
}

.calculator-description {
    font-size: 16px;
    color: #5f6368;
    line-height: 1.6;
    margin-bottom: 30px;
}

.calculator-section {
    background: #ffffff;
    border: 1px solid #dadce0;
    border-radius: 8px;
    padding: 30px;
    margin-bottom: 30px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.calculator-section h2 {
    font-size: 24px;
    color: #202124;
    margin-top: 0;
    margin-bottom: 20px;
}

.calculator-section h3 {
    font-size: 20px;
    color: #202124;
    margin-top: 25px;
    margin-bottom: 15px;
}

.formula-section {
    background: #f8f9fa;
    border-radius: 8px;
    padding: 25px;
    margin: 25px 0;
}

.formula-section h3 {
    font-size: 20px;
    color: #202124;
    margin-top: 0;
    margin-bottom: 15px;
}

.formula {
    background: #ffffff;
    border: 1px solid #dadce0;
    border-radius: 6px;
    padding: 15px;
    font-family: monospace;
    font-size: 16px;
    text-align: center;
    margin: 15px 0;
}

.percentage-form {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
    align-items: center;
    margin-bottom: 20px;
}

.input-group {
    display: flex;
    align-items: center;
    gap: 10px;
}

.input-group label {
    font-size: 16px;
    color: #202124;
    min-width: 40px;
}

.input-group input {
    padding: 10px 12px;
    border: 1px solid #dadce0;
    border-radius: 4px;
    font-size: 15px;
    width: 100px;
    text-align: center;
}

.input-group span {
    font-size: 16px;
    color: #202124;
}

.calculate-btn {
    background: #0052FF;
    color: white;
    border: none;
    border-radius: 6px;
    padding: 12px 24px;
    font-size: 16px;
    font-weight: 500;
    cursor: pointer;
    transition: background-color 0.2s ease;
    margin-top: 10px;
}

.calculate-btn:hover {
    background: #0041cc;
}

.result-section {
    background: #e8f0fe;
    border-radius: 8px;
    padding: 20px;
    margin-top: 20px;
    text-align: center;
}

.result-value {
    font-size: 24px;
    font-weight: bold;
    color: #0052FF;
    margin: 10px 0;
}

.tabs {
    display: flex;
    border-bottom: 1px solid #dadce0;
    margin-bottom: 30px;
}

.tab {
    padding: 12px 24px;
    cursor: pointer;
    font-weight: 500;
    color: #5f6368;
    border-bottom: 3px solid transparent;
    transition: all 0.3s ease;
}

.tab.active {
    color: #0052FF;
    border-bottom: 3px solid #0052FF;
}

.tab:hover:not(.active) {
    color: #202124;
    background: #f8f9fa;
}

.tab-content {
    display: none;
}

.tab-content.active {
    display: block;
}

.common-phrases-calculator {
    margin: 20px 0;
}

.phrase-form {
    display: flex;
    flex-direction: column;
    gap: 20px;
    margin-bottom: 20px;
}

.phrase-row {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
}

.phrase-input {
    padding: 10px 12px;
    border: 1px solid #dadce0;
    border-radius: 4px;
    font-size: 15px;
    width: 100px;
    text-align: center;
}

.phrase-text {
    font-size: 16px;
    color: #202124;
}

.content-section {
    background: #ffffff;
    border: 1px solid #dadce0;
    border-radius: 8px;
    padding: 30px;
    margin-bottom: 30px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.content-section h2 {
    font-size: 24px;
    color: #202124;
    margin-top: 0;
    margin-bottom: 20px;
}

.content-section h3 {
    font-size: 20px;
    color: #202124;
    margin-top: 25px;
    margin-bottom: 15px;
}

.content-section p {
    font-size: 16px;
    color: #5f6368;
    line-height: 1.6;
    margin-bottom: 15px;
}

.content-section ul {
    padding-left: 20px;
    margin-bottom: 20px;
}

.content-section li {
    margin-bottom: 10px;
    line-height: 1.5;
}

.related-calculators {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 20px;
    margin-top: 30px;
}

.related-calculator {
    background: #f8f9fa;
    border: 1px solid #dadce0;
    border-radius: 8px;
    padding: 20px;
    transition: all 0.3s ease;
}

.related-calculator:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    border-color: #0052FF;
}

.related-calculator h4 {
    font-size: 16px;
    color: #202124;
    margin-top: 0;
    margin-bottom: 10px;
}

.related-calculator p {
    font-size: 14px;
    color: #5f6368;
    margin-bottom: 15px;
    line-height: 1.5;
}

.related-link {
    color: #0052FF;
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
}

.related-link:hover {
    text-decoration: underline;
}

@media (max-width: 768px) {
    .calculator-container {
        padding: 0 15px;
        margin: 20px auto;
    }
    
    .calculator-title {
        font-size: 28px;
    }
    
    .percentage-form {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .input-group {
        width: 100%;
        justify-content: space-between;
    }
    
    .input-group input {
        width: 120px;
    }
    
    .related-calculators {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 480px) {
    .calculator-container {
        padding: 0 10px;
        margin: 15px auto;
    }
    
    .calculator-title {
        font-size: 24px;
    }
    
    .calculator-section, .content-section {
        padding: 20px;
    }
    
    .input-group {
        flex-direction: column;
        align-items: flex-start;
        gap: 8px;
    }
    
    .input-group input {
        width: 100%;
    }
    
    .phrase-row {
        flex-direction: column;
        align-items: flex-start;
        gap: 8px;
    }
}
</style>

<div class="calculator-container">
    <div class="breadcrumb">
        <a href="/">Home</a>
        <span>/</span>
        <a href="/calculators/">Calculators</a>
        <span>/</span>
        <a href="/calculators/?category=math">Math</a>
        <span>/</span>
        <span>Percentage Calculator</span>
    </div>
    
    <h1 class="calculator-title">Percentage Calculator</h1>
    
    <div class="tabs">
        <div class="tab active" data-tab="basic">Basic Calculator</div>
        <div class="tab" data-tab="phrases">Common Phrases</div>
        <div class="tab" data-tab="difference">Difference</div>
        <div class="tab" data-tab="change">Change</div>
    </div>
    
    <div class="tab-content active" id="basic-tab">
        <div class="calculator-section">
            <h2>Percentage Calculator</h2>
            <p>Please provide any two values below and click the "Calculate" button to get the third value.</p>
            
            <div class="percentage-form">
                <div class="input-group">
                    <input type="number" id="percentage" placeholder="%" step="any">
                </div>
                <span>%</span>
                <div class="input-group">
                    <span>of</span>
                    <input type="number" id="base" placeholder="Base" step="any">
                </div>
                <span>=</span>
                <div class="input-group">
                    <input type="number" id="result" placeholder="Result" step="any">
                </div>
            </div>
            
            <button class="calculate-btn" onclick="calculatePercentage()">Calculate</button>
            
            <div id="percentage-result" class="result-section" style="display: none;">
                <p>Result:</p>
                <div class="result-value" id="percentage-result-value"></div>
            </div>
        </div>
    </div>
    
    <div class="tab-content" id="phrases-tab">
        <div class="calculator-section">
            <h2>Percentage Calculator in Common Phrases</h2>
            
            <div class="common-phrases-calculator">
                <div class="phrase-form">
                    <div class="phrase-row">
                        <span>what is</span>
                        <input type="number" class="phrase-input" id="phrase-percent" placeholder="%" step="any">
                        <span>%</span>
                        <span>of</span>
                        <input type="number" class="phrase-input" id="phrase-of" placeholder="Number" step="any">
                        <button class="calculate-btn" onclick="calculatePhrase1()">Calculate</button>
                    </div>
                    
                    <div class="phrase-row">
                        <input type="number" class="phrase-input" id="phrase-is" placeholder="Number" step="any">
                        <span>is what % of</span>
                        <input type="number" class="phrase-input" id="phrase-base" placeholder="Number" step="any">
                        <button class="calculate-btn" onclick="calculatePhrase2()">Calculate</button>
                    </div>
                    
                    <div class="phrase-row">
                        <input type="number" class="phrase-input" id="phrase-part" placeholder="Number" step="any">
                        <span>is</span>
                        <input type="number" class="phrase-input" id="phrase-whole" placeholder="%" step="any">
                        <span>% of what</span>
                        <button class="calculate-btn" onclick="calculatePhrase3()">Calculate</button>
                    </div>
                </div>
                
                <div id="phrases-result" class="result-section" style="display: none;">
                    <p>Result:</p>
                    <div class="result-value" id="phrases-result-value"></div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="tab-content" id="difference-tab">
        <div class="calculator-section">
            <h2>Percentage Difference Calculator</h2>
            
            <div class="percentage-form">
                <div class="input-group">
                    <span>Value 1:</span>
                    <input type="number" id="value1" placeholder="Value 1" step="any">
                </div>
                
                <div class="input-group">
                    <span>Value 2:</span>
                    <input type="number" id="value2" placeholder="Value 2" step="any">
                </div>
            </div>
            
            <button class="calculate-btn" onclick="calculateDifference()">Calculate</button>
            
            <div id="difference-result" class="result-section" style="display: none;">
                <p>Percentage Difference:</p>
                <div class="result-value" id="difference-result-value"></div>
            </div>
        </div>
    </div>
    
    <div class="tab-content" id="change-tab">
        <div class="calculator-section">
            <h2>Percentage Change Calculator</h2>
            <p>Please provide any two values below and click the "Calculate" button to get the third value.</p>
            
            <div class="percentage-form">
                <div class="input-group">
                    <input type="number" id="initial-value" placeholder="Initial Value" step="any">
                </div>
                
                <div class="input-group">
                    <select id="change-type">
                        <option value="increase">Increase</option>
                        <option value="decrease">Decrease</option>
                    </select>
                </div>
                
                <div class="input-group">
                    <input type="number" id="change-percent" placeholder="%" step="any">
                    <span>%</span>
                </div>
                
                <div class="input-group">
                    <span>=</span>
                    <input type="number" id="final-value" placeholder="Final Value" step="any">
                </div>
            </div>
            
            <button class="calculate-btn" onclick="calculateChange()">Calculate</button>
            
            <div id="change-result" class="result-section" style="display: none;">
                <p>Result:</p>
                <div class="result-value" id="change-result-value"></div>
            </div>
        </div>
    </div>
    
    <div class="content-section">
        <h2>What is a percentage?</h2>
        <p>
            In mathematics, a percentage is a number or ratio that represents a fraction of 100. It is one of the ways to represent 
            a dimensionless relationship between two numbers; other methods include ratios, fractions, and decimals. Percentages are 
            often denoted by the symbol "%" written after the number. They can also be denoted by writing "percent" or "pct" after 
            the number. For example, 35% is equivalent to the decimal 0.35, or the fractions 35/100.
        </p>
        <p>
            Percentages are computed by multiplying the value of a ratio by 100. For example, if 25 out of 50 students in a classroom 
            are male, the ratio is 25/50 = 0.5. The value of the ratio is therefore 0.5, and multiplying this by 100 yields:
        </p>
        
        <div class="formula-section">
            <h3>Example Calculation:</h3>
            <div class="formula">0.5 × 100 = 50</div>
            <p>In other words, the ratio of 25 males to students in the classroom is equivalent to 50% of students in the classroom being male.</p>
        </div>
        
        <h3>Percentage formula</h3>
        <p>
            Although the percentage formula can be written in different forms, it is essentially an algebraic equation involving three values.
        </p>
        
        <div class="formula-section">
            <div class="formula">P × V1 = V2</div>
        </div>
        
        <p>
            P is the percentage, V1 is the first value that the percentage will modify, and V2 is the result of the percentage operating on V1. 
            The calculator provided automatically converts the input percentage into a decimal to compute the solution. However, if solving for 
            the percentage, the value returned will be the actual percentage, not its decimal representation.
        </p>
        
        <div class="formula-section">
            <h3>Example:</h3>
            <div class="formula">P × 30 = 1.5</div>
            <br>
            <div class="formula">P = 1.5/30 = 0.05 × 100 = 5%</div>
        </div>
        
        <p>
            If solving manually, the formula requires the percentage in decimal form, so the solution for P needs to be multiplied by 100 in 
            order to convert it to a percent. This is essentially what the calculator above does, except that it accepts inputs in percent 
            rather than decimal form.
        </p>
        
        <h3>Percentage difference formula</h3>
        <p>
            The percentage difference between two values is calculated by dividing the absolute value of the difference between two numbers 
            by the average of those two numbers. Multiplying the result by 100 will yield the solution in percent, rather than decimal form.
        </p>
        
        <div class="formula-section">
            <div class="formula">Percentage Difference = |V1 - V2| / ((V1 + V2)/2) × 100</div>
        </div>
        
        <div class="formula-section">
            <h3>Example:</h3>
            <div class="formula">|10 - 6| / ((10 + 6)/2) = 4/8 = 0.5 = 50%</div>
        </div>
        
        <h3>Percentage change formula</h3>
        <p>
            Percentage increase and decrease are calculated by computing the difference between two values and comparing that difference to 
            the initial value. Mathematically, this involves using the absolute value of the difference between two values then dividing 
            the result by the initial value, essentially calculating how much the initial value has changed.
        </p>
        <p>
            The percentage increase calculator above computes an increase or decrease of a specific percentage of the input number. It basically 
            involves converting a percent into its decimal equivalent, and either subtracting (decrease) or adding (increase) the decimal 
            equivalent from and to 1, respectively. Multiplying the original number by this value will result in either an increase or 
            decrease of the number by the given percent.
        </p>
        
        <div class="formula-section">
            <h3>Example:</h3>
            <div class="formula">500 increased by 10% (0.1)<br>500 × (1 + 0.1) = 550</div>
            <br>
            <div class="formula">500 decreased by 10%<br>500 × (1 – 0.1) = 450</div>
        </div>
    </div>
</div>

<script>
// Tab switching functionality
document.querySelectorAll('.tab').forEach(tab => {
    tab.addEventListener('click', function() {
        // Remove active class from all tabs
        document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
        // Add active class to clicked tab
        this.classList.add('active');
        
        // Hide all tab contents
        document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));
        
        // Show the selected tab content
        const tabType = this.getAttribute('data-tab');
        document.getElementById(`${tabType}-tab`).classList.add('active');
    });
});

// Basic percentage calculation
function calculatePercentage() {
    const percentage = document.getElementById('percentage').value;
    const base = document.getElementById('base').value;
    const result = document.getElementById('result').value;
    
    let calculatedValue;
    let resultText;
    
    if (percentage === '' && base !== '' && result !== '') {
        // Calculate percentage
        calculatedValue = (parseFloat(result) / parseFloat(base)) * 100;
        resultText = `${calculatedValue.toFixed(2)}%`;
    } else if (base === '' && percentage !== '' && result !== '') {
        // Calculate base
        calculatedValue = parseFloat(result) / (parseFloat(percentage) / 100);
        resultText = calculatedValue.toFixed(2);
    } else if (result === '' && percentage !== '' && base !== '') {
        // Calculate result
        calculatedValue = (parseFloat(percentage) / 100) * parseFloat(base);
        resultText = calculatedValue.toFixed(2);
    } else {
        alert("Please fill in exactly two fields.");
        return;
    }
    
    document.getElementById('percentage-result-value').textContent = resultText;
    document.getElementById('percentage-result').style.display = 'block';
}

// Common phrases calculations
function calculatePhrase1() {
    const percent = document.getElementById('phrase-percent').value;
    const ofValue = document.getElementById('phrase-of').value;
    
    if (percent === '' || ofValue === '') {
        alert("Please fill in both fields.");
        return;
    }
    
    const result = (parseFloat(percent) / 100) * parseFloat(ofValue);
    document.getElementById('phrases-result-value').textContent = `${percent}% of ${ofValue} = ${result.toFixed(2)}`;
    document.getElementById('phrases-result').style.display = 'block';
}

function calculatePhrase2() {
    const isValue = document.getElementById('phrase-is').value;
    const baseValue = document.getElementById('phrase-base').value;
    
    if (isValue === '' || baseValue === '') {
        alert("Please fill in both fields.");
        return;
    }
    
    const result = (parseFloat(isValue) / parseFloat(baseValue)) * 100;
    document.getElementById('phrases-result-value').textContent = `${isValue} is ${result.toFixed(2)}% of ${baseValue}`;
    document.getElementById('phrases-result').style.display = 'block';
}

function calculatePhrase3() {
    const part = document.getElementById('phrase-part').value;
    const whole = document.getElementById('phrase-whole').value;
    
    if (part === '' || whole === '') {
        alert("Please fill in both fields.");
        return;
    }
    
    const result = parseFloat(part) / (parseFloat(whole) / 100);
    document.getElementById('phrases-result-value').textContent = `${part} is ${whole}% of ${result.toFixed(2)}`;
    document.getElementById('phrases-result').style.display = 'block';
}

// Percentage difference calculation
function calculateDifference() {
    const value1 = document.getElementById('value1').value;
    const value2 = document.getElementById('value2').value;
    
    if (value1 === '' || value2 === '') {
        alert("Please fill in both values.");
        return;
    }
    
    const v1 = parseFloat(value1);
    const v2 = parseFloat(value2);
    const difference = Math.abs(v1 - v2);
    const average = (v1 + v2) / 2;
    const percentageDifference = (difference / average) * 100;
    
    document.getElementById('difference-result-value').textContent = `${percentageDifference.toFixed(2)}%`;
    document.getElementById('difference-result').style.display = 'block';
}

// Percentage change calculation
function calculateChange() {
    const initialValue = document.getElementById('initial-value').value;
    const changePercent = document.getElementById('change-percent').value;
    const finalValue = document.getElementById('final-value').value;
    const changeType = document.getElementById('change-type').value;
    
    let calculatedValue;
    let resultText;
    
    if (initialValue === '' && changePercent !== '' && finalValue !== '') {
        // Calculate initial value
        const percentDecimal = parseFloat(changePercent) / 100;
        if (changeType === 'increase') {
            calculatedValue = parseFloat(finalValue) / (1 + percentDecimal);
        } else {
            calculatedValue = parseFloat(finalValue) / (1 - percentDecimal);
        }
        resultText = `Initial Value = ${calculatedValue.toFixed(2)}`;
    } else if (changePercent === '' && initialValue !== '' && finalValue !== '') {
        // Calculate percentage change
        const diff = parseFloat(finalValue) - parseFloat(initialValue);
        const percentChange = (Math.abs(diff) / parseFloat(initialValue)) * 100;
        if (diff >= 0) {
            resultText = `Increase by ${percentChange.toFixed(2)}%`;
        } else {
            resultText = `Decrease by ${percentChange.toFixed(2)}%`;
        }
    } else if (finalValue === '' && initialValue !== '' && changePercent !== '') {
        // Calculate final value
        const percentDecimal = parseFloat(changePercent) / 100;
        if (changeType === 'increase') {
            calculatedValue = parseFloat(initialValue) * (1 + percentDecimal);
        } else {
            calculatedValue = parseFloat(initialValue) * (1 - percentDecimal);
        }
        resultText = `Final Value = ${calculatedValue.toFixed(2)}`;
    } else {
        alert("Please fill in exactly two fields.");
        return;
    }
    
    document.getElementById('change-result-value').textContent = resultText;
    document.getElementById('change-result').style.display = 'block';
}
</script>

<?php
// Include your website's footer
include '../../footer.php';
?>