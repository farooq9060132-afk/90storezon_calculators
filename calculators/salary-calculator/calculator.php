<?php
/**
 * Salary Calculator
 * Description: Free online salary calculator tool. Calculate your take-home pay, taxes, deductions, and net salary.
 */

// Prevent direct access
if (!defined('CALCULATOR_LOADED')) {
    define('CALCULATOR_LOADED', true);
}

function get_salary_calculator_html() {
    ob_start();
    ?>
    <div class="salary-calculator-plugin">
        <div class="input-row">
            <div class="input-group">
                <label for="grossSalary"><i class="fas fa-money-bill-wave"></i> Gross Annual Salary ($)</label>
                <input type="number" id="grossSalary" placeholder="Your annual salary" min="0" value="75000">
            </div>

            <div class="input-group">
                <label for="payFrequency"><i class="fas fa-calendar"></i> Pay Frequency</label>
                <select id="payFrequency">
                    <option value="52">Weekly</option>
                    <option value="26">Bi-Weekly</option>
                    <option value="12" selected>Monthly</option>
                    <option value="1">Annually</option>
                </select>
            </div>
        </div>

        <div class="input-row">
            <div class="input-group">
                <label for="filingStatus"><i class="fas fa-users"></i> Filing Status</label>
                <select id="filingStatus">
                    <option value="single">Single</option>
                    <option value="married_joint" selected>Married Filing Jointly</option>
                </select>
            </div>

            <div class="input-group">
                <label for="state"><i class="fas fa-map-marker-alt"></i> State</label>
                <select id="state">
                    <option value="ca">California</option>
                    <option value="ny">New York</option>
                    <option value="tx">Texas</option>
                    <option value="fl">Florida</option>
                </select>
            </div>
        </div>

        <button class="calculate-btn" onclick="calculateSalary()">
            <i class="fas fa-calculator"></i> Calculate Salary
        </button>

        <div class="result-container" id="resultContainer">
            <h3><i class="fas fa-file-invoice-dollar"></i> Salary Breakdown</h3>
            
            <div class="summary-cards">
                <div class="summary-card gross">
                    <div class="card-icon">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <div class="card-content">
                        <div class="card-label">Gross Pay</div>
                        <div class="card-value" id="grossPay">$0</div>
                    </div>
                </div>

                <div class="summary-card tax">
                    <div class="card-icon">
                        <i class="fas fa-receipt"></i>
                    </div>
                    <div class="card-content">
                        <div class="card-label">Total Taxes</div>
                        <div class="card-value" id="totalTaxes">$0</div>
                    </div>
                </div>

                <div class="summary-card net">
                    <div class="card-icon">
                        <i class="fas fa-wallet"></i>
                    </div>
                    <div class="card-content">
                        <div class="card-label">Net Take-Home</div>
                        <div class="card-value" id="netPay">$0</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}

// If this file is accessed directly, show the calculator
if (basename($_SERVER['PHP_SELF']) == 'calculator.php') {
    echo get_salary_calculator_html();
}
?>