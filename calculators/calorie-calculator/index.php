<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calorie Calculator Online - Daily Calorie Needs 2024</title>
    <meta name="description" content="Online calorie calculator tool. Calculate your daily calorie needs for weight loss, maintenance, or muscle gain. Personalized results based on your goals. No registration required!">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="vip-container">
        <header class="vip-header">
            <h1><i class="fas fa-apple-alt"></i> Calorie Calculator</h1>
            <p>Calculate your daily calorie needs for your fitness goals</p>
        </header>

        <!-- Google Ads Slot -->
        <div class="ad-slot top-ad">
            [AD_TOP_BANNER]
        </div>

        <div class="calculator-container">
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

            <!-- Google Ads Slot -->
            <div class="ad-slot middle-ad">
                [AD_MIDDLE_BANNER]
            </div>

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

                <div class="meal-plan-suggestions">
                    <h4><i class="fas fa-clipboard-list"></i> Sample Meal Plan</h4>
                    <div class="meal-plan" id="mealPlan">
                        <!-- Meal plan will be loaded here -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Google Ads Slot -->
        <div class="ad-slot bottom-ad">
            [AD_BOTTOM_BANNER]
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>