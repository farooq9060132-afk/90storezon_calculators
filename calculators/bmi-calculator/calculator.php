<?php
/**
 * BMI Calculator
 * Description: Free online BMI calculator tool. Check your body mass index instantly with our accurate calculator.
 */

// Prevent direct access
if (!defined('CALCULATOR_LOADED')) {
    define('CALCULATOR_LOADED', true);
}

function get_bmi_calculator_html() {
    ob_start();
    ?>
    <div class="bmi-calculator-plugin">
        <div class="input-group">
            <label for="height"><i class="fas fa-ruler-vertical"></i> Height</label>
            <div class="height-input">
                <input type="number" id="height" placeholder="Enter height" min="0">
                <select id="heightUnit">
                    <option value="cm">cm</option>
                    <option value="feet">feet</option>
                    <option value="inches">inches</option>
                </select>
            </div>
        </div>

        <div class="input-group">
            <label for="weight"><i class="fas fa-weight"></i> Weight</label>
            <div class="weight-input">
                <input type="number" id="weight" placeholder="Enter weight" min="0">
                <select id="weightUnit">
                    <option value="kg">kg</option>
                    <option value="pounds">pounds</option>
                </select>
            </div>
        </div>

        <button class="calculate-btn" onclick="calculateBMI()">
            <i class="fas fa-calculator"></i> Calculate BMI
        </button>

        <div class="result-container" id="resultContainer">
            <h3><i class="fas fa-chart-line"></i> BMI Results</h3>
            <div class="bmi-value" id="bmiValue">0</div>
            <div class="bmi-category" id="bmiCategory">Underweight</div>
            
            <div class="bmi-chart">
                <div class="chart-item underweight">
                    <span>Underweight</span>
                    <span>&lt; 18.5</span>
                </div>
                <div class="chart-item normal">
                    <span>Normal</span>
                    <span>18.5 - 24.9</span>
                </div>
                <div class="chart-item overweight">
                    <span>Overweight</span>
                    <span>25 - 29.9</span>
                </div>
                <div class="chart-item obese">
                    <span>Obese</span>
                    <span>≥ 30</span>
                </div>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}

// If this file is accessed directly, show the calculator
if (basename($_SERVER['PHP_SELF']) == 'calculator.php') {
    echo get_bmi_calculator_html();
}
?>