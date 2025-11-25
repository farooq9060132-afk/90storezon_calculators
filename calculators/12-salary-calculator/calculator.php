<?php
/**
 * Plugin Name: Free Salary Calculator
 * Description: Free online salary calculator tool. Calculate your take-home pay, taxes, deductions, and net salary.
 * Version: 1.0
 * Author: Your Name
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

function salary_calculator_enqueue_scripts() {
    wp_enqueue_style('salary-calculator-style', plugins_url('style.css', __FILE__));
    wp_enqueue_script('salary-calculator-script', plugins_url('script.js', __FILE__), array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'salary_calculator_enqueue_scripts');

function salary_calculator_shortcode() {
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
add_shortcode('salary_calculator', 'salary_calculator_shortcode');
?>