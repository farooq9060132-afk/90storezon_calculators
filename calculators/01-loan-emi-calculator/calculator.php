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
            <label for="country"><i class="fas fa-globe-americas"></i> Select Country</label>
            <div class="country-select-wrapper">
                <select id="country" onchange="updateCountrySettings()">
                    <option value="SA" data-currency="SAR" data-rate="7.5" data-min="10000" data-max="5000000" data-tenure-min="12" data-tenure-max="360">🇸🇦 Saudi Arabia (SAR)</option>
                    <option value="AE" data-currency="AED" data-rate="6.5" data-min="50000" data-max="10000000" data-tenure-min="12" data-tenure-max="360">🇦🇪 United Arab Emirates (AED)</option>
                    <option value="GB" data-currency="GBP" data-rate="4.5" data-min="1000" data-max="2000000" data-tenure-min="12" data-tenure-max="360">🇬🇧 United Kingdom (GBP)</option>
                    <option value="US" data-currency="USD" data-rate="5.5" data-min="1000" data-max="5000000" data-tenure-min="12" data-tenure-max="360">🇺🇸 United States (USD)</option>
                    <option value="CA" data-currency="CAD" data-rate="6.0" data-min="1000" data-max="3000000" data-tenure-min="12" data-tenure-max="360">🇨🇦 Canada (CAD)</option>
                    <option value="CN" data-currency="CNY" data-rate="4.8" data-min="10000" data-max="10000000" data-tenure-min="12" data-tenure-max="360">🇨🇳 China (CNY)</option>
                    <option value="PK" data-currency="PKR" data-rate="15.0" data-min="10000" data-max="50000000" data-tenure-min="12" data-tenure-max="360">🇵🇰 Pakistan (PKR)</option>
                    <option value="IN" data-currency="INR" data-rate="9.5" data-min="10000" data-max="100000000" data-tenure-min="12" data-tenure-max="360">🇮🇳 India (INR)</option>
                    <option value="AU" data-currency="AUD" data-rate="6.2" data-min="1000" data-max="3000000" data-tenure-min="12" data-tenure-max="360">🇦🇺 Australia (AUD)</option>
                    <option value="DE" data-currency="EUR" data-rate="3.5" data-min="1000" data-max="2000000" data-tenure-min="12" data-tenure-max="360">🇩🇪 Germany (EUR)</option>
                    <option value="SG" data-currency="SGD" data-rate="4.0" data-min="1000" data-max="5000000" data-tenure-min="12" data-tenure-max="360">🇸🇬 Singapore (SGD)</option>
                </select>
            </div>
        </div>
        
        <div class="input-group">
            <label for="loanAmount"><i class="fas fa-money-bill-wave"></i> Loan Amount (<span id="currencySymbol">$</span>)</label>
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
        
        <div class="result-container" id="resultContainer" style="display: none;">
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
        
        <div class="amortization-container" id="amortizationContainer" style="display: none;">
            <h3><i class="fas fa-table"></i> Amortization Schedule</h3>
            <div class="table-container">
                <table id="amortizationTable">
                    <thead>
                        <tr>
                            <th>Month</th>
                            <th>EMI</th>
                            <th>Principal</th>
                            <th>Interest</th>
                            <th>Balance</th>
                        </tr>
                    </thead>
                    <tbody id="amortizationBody">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('emi_calculator', 'loan_emi_calculator_shortcode');
?>