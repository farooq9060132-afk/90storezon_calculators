<?php
/**
 * Plugin Name: Free Loan EMI Calculator
 * Description: Free online EMI calculator tool. Calculate monthly loan payments with our easy-to-use calculator.
 * Version: 1.0
 * Author: Your Name
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

function loan_emi_calculator_enqueue_scripts() {
    wp_enqueue_style('emi-calculator-style', plugins_url('style.css', __FILE__));
    wp_enqueue_script('emi-calculator-script', plugins_url('script.js', __FILE__), array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'loan_emi_calculator_enqueue_scripts');

function loan_emi_calculator_shortcode() {
    ob_start();
    ?>
    <div class="emi-calculator-plugin">
        <div class="input-group">
            <label for="loanAmount"><i class="fas fa-money-bill-wave"></i> Loan Amount ($)</label>
            <input type="number" id="loanAmount" placeholder="Enter loan amount" min="0">
        </div>
        <div class="input-group">
            <label for="interestRate"><i class="fas fa-percentage"></i> Interest Rate (% per year)</label>
            <input type="number" id="interestRate" placeholder="Enter interest rate" min="0" step="0.1">
        </div>
        <div class="input-group">
            <label for="loanTenure"><i class="fas fa-calendar-alt"></i> Loan Tenure</label>
            <div class="tenure-input">
                <input type="number" id="loanTenure" placeholder="Enter tenure" min="1">
                <select id="tenureType">
                    <option value="years">Years</option>
                    <option value="months">Months</option>
                </select>
            </div>
        </div>
        <button class="calculate-btn" onclick="calculateEMI()">
            <i class="fas fa-calculator"></i> Calculate EMI
        </button>
        <div class="result-container" id="resultContainer">
            <h3><i class="fas fa-chart-bar"></i> Calculation Results</h3>
            <div class="result-item">
                <span>Monthly EMI:</span>
                <span id="monthlyEMI">$0</span>
            </div>
            <div class="result-item">
                <span>Total Interest:</span>
                <span id="totalInterest">$0</span>
            </div>
            <div class="result-item total-amount">
                <span>Total Amount:</span>
                <span id="totalAmount">$0</span>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('emi_calculator', 'loan_emi_calculator_shortcode');
?>