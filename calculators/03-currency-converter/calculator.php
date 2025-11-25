<?php
/**
 * Plugin Name: Free Currency Converter
 * Description: Free online currency converter with live exchange rates. Convert 150+ currencies instantly.
 * Version: 1.0
 * Author: Your Name
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

function currency_converter_enqueue_scripts() {
    wp_enqueue_style('currency-converter-style', plugins_url('style.css', __FILE__));
    wp_enqueue_script('currency-converter-script', plugins_url('script.js', __FILE__), array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'currency_converter_enqueue_scripts');

function currency_converter_shortcode() {
    ob_start();
    ?>
    <div class="currency-converter-plugin">
        <div class="input-group">
            <label for="amount"><i class="fas fa-money-bill-wave"></i> Amount</label>
            <input type="number" id="amount" placeholder="Enter amount" min="0" step="0.01">
        </div>

        <div class="currency-row">
            <div class="input-group">
                <label for="fromCurrency"><i class="fas fa-arrow-right"></i> From Currency</label>
                <select id="fromCurrency">
                    <option value="USD">USD - US Dollar</option>
                    <option value="EUR">EUR - Euro</option>
                    <option value="GBP">GBP - British Pound</option>
                    <option value="JPY">JPY - Japanese Yen</option>
                    <option value="CAD">CAD - Canadian Dollar</option>
                    <option value="AUD">AUD - Australian Dollar</option>
                    <option value="CHF">CHF - Swiss Franc</option>
                    <option value="CNY">CNY - Chinese Yuan</option>
                    <option value="INR">INR - Indian Rupee</option>
                    <option value="PKR">PKR - Pakistani Rupee</option>
                </select>
            </div>

            <div class="swap-button">
                <button onclick="swapCurrencies()"><i class="fas fa-exchange-alt"></i></button>
            </div>

            <div class="input-group">
                <label for="toCurrency"><i class="fas fa-arrow-left"></i> To Currency</label>
                <select id="toCurrency">
                    <option value="EUR">EUR - Euro</option>
                    <option value="USD">USD - US Dollar</option>
                    <option value="GBP">GBP - British Pound</option>
                    <option value="JPY">JPY - Japanese Yen</option>
                    <option value="CAD">CAD - Canadian Dollar</option>
                    <option value="AUD">AUD - Australian Dollar</option>
                    <option value="CHF">CHF - Swiss Franc</option>
                    <option value="CNY">CNY - Chinese Yuan</option>
                    <option value="INR">INR - Indian Rupee</option>
                    <option value="PKR">PKR - Pakistani Rupee</option>
                </select>
            </div>
        </div>

        <button class="calculate-btn" onclick="convertCurrency()">
            <i class="fas fa-sync-alt"></i> Convert Currency
        </button>

        <div class="result-container" id="resultContainer">
            <h3><i class="fas fa-chart-line"></i> Conversion Result</h3>
            <div class="conversion-result">
                <div class="from-amount" id="fromAmount">0 USD</div>
                <div class="equals">=</div>
                <div class="to-amount" id="toAmount">0 EUR</div>
            </div>
            <div class="exchange-rate" id="exchangeRate">
                Exchange Rate: 1 USD = 0 EUR
            </div>
            
            <div class="popular-currencies">
                <h4>Popular Conversions</h4>
                <div class="currency-grid" id="popularConversions">
                    <!-- Popular currencies will be loaded here -->
                </div>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('currency_converter', 'currency_converter_shortcode');
?>