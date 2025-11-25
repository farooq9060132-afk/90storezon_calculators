<?php
/**
 * Plugin Name: Free Tax Calculator
 * Description: Free online tax calculator tool. Calculate your income tax, deductions, and net salary instantly.
 * Version: 1.0
 * Author: Your Name
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

function tax_calculator_enqueue_scripts() {
    wp_enqueue_style('tax-calculator-style', plugins_url('style.css', __FILE__));
    wp_enqueue_script('tax-calculator-script', plugins_url('script.js', __FILE__), array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'tax_calculator_enqueue_scripts');

function tax_calculator_shortcode() {
    ob_start();
    ?>
    <div class="tax-calculator-plugin">
        <div class="input-group">
            <label for="country"><i class="fas fa-globe"></i> Country</label>
            <select id="country">
                <option value="us">United States</option>
                <option value="uk">United Kingdom</option>
                <option value="canada">Canada</option>
                <option value="australia">Australia</option>
            </select>
        </div>

        <div class="input-group">
            <label for="income"><i class="fas fa-money-bill-wave"></i> Annual Gross Income ($)</label>
            <input type="number" id="income" placeholder="Enter your annual income" min="0" value="50000">
        </div>

        <div class="input-row">
            <div class="input-group">
                <label for="filingStatus"><i class="fas fa-user"></i> Filing Status</label>
                <select id="filingStatus">
                    <option value="single">Single</option>
                    <option value="married_joint">Married Filing Jointly</option>
                    <option value="married_separate">Married Filing Separately</option>
                </select>
            </div>

            <div class="input-group">
                <label for="age"><i class="fas fa-birthday-cake"></i> Age</label>
                <input type="number" id="age" placeholder="Your age" min="18" max="100" value="30">
            </div>
        </div>

        <button class="calculate-btn" onclick="calculateTax()">
            <i class="fas fa-calculator"></i> Calculate Tax
        </button>

        <div class="result-container" id="resultContainer">
            <h3><i class="fas fa-chart-pie"></i> Tax Calculation Results</h3>
            
            <div class="summary-cards">
                <div class="summary-card gross">
                    <div class="card-icon">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <div class="card-content">
                        <div class="card-label">Gross Income</div>
                        <div class="card-value" id="grossIncome">$0</div>
                    </div>
                </div>

                <div class="summary-card tax">
                    <div class="card-icon">
                        <i class="fas fa-receipt"></i>
                    </div>
                    <div class="card-content">
                        <div class="card-label">Total Tax</div>
                        <div class="card-value" id="totalTax">$0</div>
                    </div>
                </div>

                <div class="summary-card net">
                    <div class="card-icon">
                        <i class="fas fa-wallet"></i>
                    </div>
                    <div class="card-content">
                        <div class="card-label">Net Income</div>
                        <div class="card-value" id="netIncome">$0</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('tax_calculator', 'tax_calculator_shortcode');
?>