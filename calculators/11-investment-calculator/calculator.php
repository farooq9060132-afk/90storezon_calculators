<?php
/**
 * Plugin Name: Free Investment Calculator
 * Description: Free online investment calculator tool. Calculate investment returns, ROI, and growth projections.
 * Version: 1.0
 * Author: Your Name
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

function investment_calculator_enqueue_scripts() {
    wp_enqueue_style('investment-calculator-style', plugins_url('style.css', __FILE__));
    wp_enqueue_script('investment-calculator-script', plugins_url('script.js', __FILE__), array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'investment_calculator_enqueue_scripts');

function investment_calculator_shortcode() {
    ob_start();
    ?>
    <div class="investment-calculator-plugin">
        <div class="input-row">
            <div class="input-group">
                <label for="initialInvestment"><i class="fas fa-dollar-sign"></i> Initial Investment ($)</label>
                <input type="number" id="initialInvestment" placeholder="Starting amount" min="0" value="10000">
            </div>

            <div class="input-group">
                <label for="monthlyContribution"><i class="fas fa-plus-circle"></i> Monthly Contribution ($)</label>
                <input type="number" id="monthlyContribution" placeholder="Monthly addition" min="0" value="500">
            </div>
        </div>

        <div class="input-row">
            <div class="input-group">
                <label for="investmentPeriod"><i class="fas fa-calendar-alt"></i> Investment Period (Years)</label>
                <input type="number" id="investmentPeriod" placeholder="Number of years" min="1" max="50" value="10">
            </div>

            <div class="input-group">
                <label for="expectedReturn"><i class="fas fa-percentage"></i> Expected Return (%)</label>
                <input type="number" id="expectedReturn" placeholder="Expected return rate" min="1" max="50" step="0.1" value="8">
            </div>
        </div>

        <button class="calculate-btn" onclick="calculateInvestment()">
            <i class="fas fa-calculator"></i> Calculate Investment
        </button>

        <div class="result-container" id="resultContainer">
            <h3><i class="fas fa-rocket"></i> Investment Projection</h3>
            
            <div class="summary-cards">
                <div class="summary-card total">
                    <div class="card-icon">
                        <i class="fas fa-bullseye"></i>
                    </div>
                    <div class="card-content">
                        <div class="card-label">Future Value</div>
                        <div class="card-value" id="futureValue">$0</div>
                    </div>
                </div>

                <div class="summary-card contributions">
                    <div class="card-icon">
                        <i class="fas fa-hand-holding-usd"></i>
                    </div>
                    <div class="card-content">
                        <div class="card-label">Total Contributions</div>
                        <div class="card-value" id="totalContributions">$0</div>
                    </div>
                </div>

                <div class="summary-card interest">
                    <div class="card-icon">
                        <i class="fas fa-coins"></i>
                    </div>
                    <div class="card-content">
                        <div class="card-label">Interest Earned</div>
                        <div class="card-value" id="interestEarned">$0</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('investment_calculator', 'investment_calculator_shortcode');
?>