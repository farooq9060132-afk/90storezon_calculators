<?php
/**
 * Plugin Name: Free Mortgage Calculator
 * Description: Free online mortgage calculator tool. Calculate your monthly home loan payments, interest, and amortization schedule.
 * Version: 1.0
 * Author: Your Name
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

function mortgage_calculator_enqueue_scripts() {
    wp_enqueue_style('mortgage-calculator-style', plugins_url('style.css', __FILE__));
    wp_enqueue_script('mortgage-calculator-script', plugins_url('script.js', __FILE__), array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'mortgage_calculator_enqueue_scripts');

function mortgage_calculator_shortcode() {
    ob_start();
    ?>
    <div class="mortgage-calculator-plugin">
        <div class="input-row">
            <div class="input-group">
                <label for="homePrice"><i class="fas fa-dollar-sign"></i> Home Price ($)</label>
                <input type="number" id="homePrice" placeholder="Enter home price" min="0">
            </div>

            <div class="input-group">
                <label for="downPayment"><i class="fas fa-hand-holding-usd"></i> Down Payment ($)</label>
                <input type="number" id="downPayment" placeholder="Enter down payment" min="0">
            </div>
        </div>

        <div class="input-row">
            <div class="input-group">
                <label for="loanTerm"><i class="fas fa-calendar-alt"></i> Loan Term (Years)</label>
                <select id="loanTerm">
                    <option value="15">15 Years</option>
                    <option value="20">20 Years</option>
                    <option value="25">25 Years</option>
                    <option value="30" selected>30 Years</option>
                </select>
            </div>

            <div class="input-group">
                <label for="interestRate"><i class="fas fa-percentage"></i> Interest Rate (%)</label>
                <input type="number" id="interestRate" placeholder="Enter interest rate" min="0" step="0.01" value="4.5">
            </div>
        </div>

        <div class="input-group">
            <label for="propertyTax"><i class="fas fa-landmark"></i> Annual Property Tax ($)</label>
            <input type="number" id="propertyTax" placeholder="Enter annual tax" min="0" value="2400">
        </div>

        <div class="input-group">
            <label for="homeInsurance"><i class="fas fa-shield-alt"></i> Annual Home Insurance ($)</label>
            <input type="number" id="homeInsurance" placeholder="Enter insurance" min="0" value="1200">
        </div>

        <button class="calculate-btn" onclick="calculateMortgage()">
            <i class="fas fa-calculator"></i> Calculate Mortgage
        </button>

        <div class="result-container" id="resultContainer">
            <h3><i class="fas fa-chart-pie"></i> Mortgage Breakdown</h3>
            
            <div class="results-grid">
                <div class="result-item">
                    <span>Monthly Payment</span>
                    <strong id="monthlyPayment">$0</strong>
                </div>
                <div class="result-item">
                    <span>Principal & Interest</span>
                    <span id="principalInterest">$0</span>
                </div>
                <div class="result-item">
                    <span>Property Tax</span>
                    <span id="monthlyTax">$0</span>
                </div>
                <div class="result-item">
                    <span>Home Insurance</span>
                    <span id="monthlyInsurance">$0</span>
                </div>
            </div>

            <div class="summary-section">
                <div class="summary-item">
                    <span>Total Loan Amount</span>
                    <strong id="totalLoan">$0</strong>
                </div>
                <div class="summary-item">
                    <span>Down Payment</span>
                    <span id="downPaymentResult">$0</span>
                </div>
                <div class="summary-item">
                    <span>Total Interest Paid</span>
                    <span id="totalInterest">$0</span>
                </div>
                <div class="summary-item total">
                    <span>Total of 360 Payments</span>
                    <strong id="totalPayments">$0</strong>
                </div>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('mortgage_calculator', 'mortgage_calculator_shortcode');
?>