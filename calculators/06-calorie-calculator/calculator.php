<?php
/**
 * Plugin Name: Free Calorie Calculator
 * Description: Free online calorie calculator tool. Calculate your daily calorie needs for weight loss, maintenance, or muscle gain.
 * Version: 1.0
 * Author: Your Name
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

function calorie_calculator_enqueue_scripts() {
    wp_enqueue_style('calorie-calculator-style', plugins_url('style.css', __FILE__));
    wp_enqueue_script('calorie-calculator-script', plugins_url('script.js', __FILE__), array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'calorie_calculator_enqueue_scripts');

function calorie_calculator_shortcode() {
    ob_start();
    ?>
    <div class="calorie-calculator-plugin">
        <div class="input-row">
            <div class="input-group">
                <label for="age"><i class="fas fa-birthday-cake"></i> Age (Years)</label>
                <input type="number" id="age" placeholder="Enter your age" min="15" max="80" value="30">
            </div>

            <div class="input-group">
                <label for="gender"><i class="fas fa-venus-mars"></i> Gender</label>
                <select id="gender">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>
        </div>

        <div class="input-row">
            <div class="input-group">
                <label for="height"><i class="fas fa-ruler-vertical"></i> Height (cm)</label>
                <input type="number" id="height" placeholder="Enter height" min="100" max="250" value="170">
            </div>

            <div class="input-group">
                <label for="weight"><i class="fas fa-weight"></i> Weight (kg)</label>
                <input type="number" id="weight" placeholder="Enter weight" min="30" max="200" value="70">
            </div>
        </div>

        <div class="input-group">
            <label for="activity"><i class="fas fa-running"></i> Activity Level</label>
            <select id="activity">
                <option value="1.2">Sedentary (little or no exercise)</option>
                <option value="1.375">Lightly Active (light exercise 1-3 days/week)</option>
                <option value="1.55" selected>Moderately Active (moderate exercise 3-5 days/week)</option>
                <option value="1.725">Very Active (hard exercise 6-7 days/week)</option>
                <option value="1.9">Extremely Active (very hard exercise, physical job)</option>
            </select>
        </div>

        <div class="input-group">
            <label for="goal"><i class="fas fa-bullseye"></i> Fitness Goal</label>
            <select id="goal">
                <option value="loss">Weight Loss</option>
                <option value="maintain" selected>Maintain Weight</option>
                <option value="gain">Weight Gain</option>
            </select>
        </div>

        <button class="calculate-btn" onclick="calculateCalories()">
            <i class="fas fa-calculator"></i> Calculate Calories
        </button>

        <div class="result-container" id="resultContainer">
            <h3><i class="fas fa-chart-pie"></i> Your Daily Calorie Needs</h3>
            
            <div class="calorie-results">
                <div class="calorie-card maintenance">
                    <div class="calorie-header">
                        <i class="fas fa-balance-scale"></i>
                        <h4>Maintenance</h4>
                    </div>
                    <div class="calorie-value" id="maintenanceCalories">0</div>
                    <div class="calorie-desc">Calories to maintain current weight</div>
                </div>

                <div class="calorie-card loss">
                    <div class="calorie-header">
                        <i class="fas fa-arrow-down"></i>
                        <h4>Weight Loss</h4>
                    </div>
                    <div class="calorie-value" id="lossCalories">0</div>
                    <div class="calorie-desc">Calories for weight loss (0.5kg/week)</div>
                </div>

                <div class="calorie-card gain">
                    <div class="calorie-header">
                        <i class="fas fa-arrow-up"></i>
                        <h4>Weight Gain</h4>
                    </div>
                    <div class="calorie-value" id="gainCalories">0</div>
                    <div class="calorie-desc">Calories for weight gain (0.5kg/week)</div>
                </div>
            </div>

            <div class="macronutrient-section">
                <h4><i class="fas fa-utensils"></i> Recommended Macronutrients</h4>
                <div class="macronutrient-grid" id="macronutrientGrid">
                    <!-- Macronutrient data will be loaded here -->
                </div>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('calorie_calculator', 'calorie_calculator_shortcode');
?>