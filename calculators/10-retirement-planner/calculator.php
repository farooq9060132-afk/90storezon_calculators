<?php
/**
 * Plugin Name: Free Retirement Planner
 * Description: Free online retirement planner tool. Calculate your retirement savings needs, investment growth, and monthly income.
 * Version: 1.0
 * Author: Your Name
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

function retirement_planner_enqueue_scripts() {
    wp_enqueue_style('retirement-planner-style', plugins_url('style.css', __FILE__));
    wp_enqueue_script('retirement-planner-script', plugins_url('script.js', __FILE__), array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'retirement_planner_enqueue_scripts');

function retirement_planner_shortcode() {
    ob_start();
    ?>
    <div class="retirement-planner-plugin">
        <div class="input-row">
            <div class="input-group">
                <label for="currentAge"><i class="fas fa-birthday-cake"></i> Current Age</label>
                <input type="number" id="currentAge" placeholder="Your current age" min="18" max="65" value="35">
            </div>

            <div class="input-group">
                <label for="retirementAge"><i class="fas fa-calendar-alt"></i> Retirement Age</label>
                <input type="number" id="retirementAge" placeholder="Planned retirement age" min="55" max="75" value="65">
            </div>
        </div>

        <div class="input-row">
            <div class="input-group">
                <label for="currentSavings"><i class="fas fa-wallet"></i> Current Savings ($)</label>
                <input type="number" id="currentSavings" placeholder="Existing savings" min="0" value="100000">
            </div>

            <div class="input-group">
                <label for="monthlyContribution"><i class="fas fa-plus-circle"></i> Monthly Contribution ($)</label>
                <input type="number" id="monthlyContribution" placeholder="Monthly savings" min="0" value="1000">
            </div>
        </div>

        <div class="input-row">
            <div class="input-group">
                <label for="expectedReturn"><i class="fas fa-percentage"></i> Expected Return (%)</label>
                <input type="number" id="expectedReturn" placeholder="Investment return" min="1" max="20" step="0.1" value="7">
            </div>

            <div class="input-group">
                <label for="annualIncome"><i class="fas fa-money-bill-wave"></i> Annual Income ($)</label>
                <input type="number" id="annualIncome" placeholder="Your income" min="0" value="75000">
            </div>
        </div>

        <button class="calculate-btn" onclick="calculateRetirement()">
            <i class="fas fa-calculator"></i> Calculate Retirement
        </button>

        <div class="result-container" id="resultContainer">
            <h3><i class="fas fa-trophy"></i> Your Retirement Plan</h3>
            
            <div class="summary-cards">
                <div class="summary-card total">
                    <div class="card-icon">
                        <i class="fas fa-bullseye"></i>
                    </div>
                    <div class="card-content">
                        <div class="card-label">Retirement Goal</div>
                        <div class="card-value" id="retirementGoal">$0</div>
                    </div>
                </div>

                <div class="summary-card projected">
                    <div class="card-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="card-content">
                        <div class="card-label">Projected Savings</div>
                        <div class="card-value" id="projectedSavings">$0</div>
                    </div>
                </div>

                <div class="summary-card monthly">
                    <div class="card-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div class="card-content">
                        <div class="card-label">Monthly Income</div>
                        <div class="card-value" id="monthlyIncome">$0</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('retirement_planner', 'retirement_planner_shortcode');
?>