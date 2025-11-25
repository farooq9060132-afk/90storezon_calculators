<?php
/**
 * Plugin Name: Free Compound Interest Calculator
 * Description: Free online compound interest calculator tool. Calculate your investment growth with compound interest.
 * Version: 1.0
 * Author: Your Name
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

function compound_interest_calculator_enqueue_scripts() {
    wp_enqueue_style('compound-interest-calculator-style', plugins_url('style.css', __FILE__));
    wp_enqueue_script('compound-interest-calculator-script', plugins_url('script.js', __FILE__), array('jquery'), '1.0', true);
    wp_enqueue_script('chart-js', 'https://cdn.jsdelivr.net/npm/chart.js', array(), '3.7.0', true);
}
add_action('wp_enqueue_scripts', 'compound_interest_calculator_enqueue_scripts');

function compound_interest_calculator_shortcode() {
    ob_start();
    ?>
    <div class="compound-interest-calculator-plugin">
        <div class="input-row">
            <div class="input-group">
                <label for="principal"><i class="fas fa-money-bill-wave"></i> Principal Amount ($)</label>
                <input type="number" id="principal" placeholder="Enter initial amount" min="0" value="1000">
            </div>

            <div class="input-group">
                <label for="monthlyContribution"><i class="fas fa-plus-circle"></i> Monthly Contribution ($)</label>
                <input type="number" id="monthlyContribution" placeholder="Monthly addition" min="0" value="100">
            </div>
        </div>

        <div class="input-row">
            <div class="input-group">
                <label for="interestRate"><i class="fas fa-percentage"></i> Annual Interest Rate (%)</label>
                <input type="number" id="interestRate" placeholder="Enter interest rate" min="0" step="0.01" value="7">
            </div>

            <div class="input-group">
                <label for="years"><i class="fas fa-calendar-alt"></i> Time Period (Years)</label>
                <input type="number" id="years" placeholder="Enter years" min="1" value="10">
            </div>
        </div>

        <div class="input-group">
            <label for="compoundFrequency"><i class="fas fa-sync-alt"></i> Compound Frequency</label>
            <select id="compoundFrequency">
                <option value="1">Annually</option>
                <option value="2">Semi-Annually</option>
                <option value="4">Quarterly</option>
                <option value="12" selected>Monthly</option>
                <option value="365">Daily</option>
            </select>
        </div>

        <button class="calculate-btn" onclick="calculateCompoundInterest()">
            <i class="fas fa-calculator"></i> Calculate Growth
        </button>

        <div class="result-container" id="resultContainer">
            <h3><i class="fas fa-rocket"></i> Investment Growth Results</h3>
            
            <div class="results-grid">
                <div class="result-item main-result">
                    <span>Future Value</span>
                    <strong id="futureValue">$0</strong>
                </div>
                <div class="result-item">
                    <span>Total Contributions</span>
                    <span id="totalContributions">$0</span>
                </div>
                <div class="result-item">
                    <span>Interest Earned</span>
                    <span id="interestEarned">$0</span>
                </div>
                <div class="result-item">
                    <span>ROI</span>
                    <span id="roi">0%</span>
                </div>
            </div>

            <div class="yearly-breakdown">
                <h4><i class="fas fa-table"></i> Yearly Breakdown</h4>
                <div class="table-container" id="yearlyTable">
                    <!-- Yearly breakdown will be loaded here -->
                </div>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('compound_interest_calculator', 'compound_interest_calculator_shortcode');
?>