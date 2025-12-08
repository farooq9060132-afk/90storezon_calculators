<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>17-Macro Calculator - Macronutrient Calculator for Fitness</title>
    <meta name="description" content="Macro calculator to calculate your optimal macronutrient ratios for weight loss, muscle gain, or maintenance. Get personalized protein, carbs, and fat targets.">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>17-Macro Calculator</h1>
            <p>Calculate Your Perfect Macronutrient Ratios for Your Fitness Goals</p>
        </div>
    </header>

    <main class="container">
        <section class="intro">
            <h2>Optimize Your Nutrition with Macronutrient Tracking</h2>
            <p>Calculate your ideal protein, carbohydrate, and fat intake based on your body composition and fitness objectives.</p>
        </section>

        <div class="calculator-container">
            <div class="input-section">
                <div class="user-profile">
                    <h3>Your Profile</h3>
                    
                    <div class="input-group">
                        <label for="gender">Gender</label>
                        <select id="gender">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>

                    <div class="input-row">
                        <div class="input-group">
                            <label for="age">Age</label>
                            <input type="number" id="age" placeholder="30" min="15" max="80" required>
                        </div>
                        
                        <div class="input-group">
                            <label for="height">Height (cm)</label>
                            <input type="number" id="height" placeholder="175" min="100" max="250" required>
                        </div>
                    </div>

                    <div class="input-row">
                        <div class="input-group">
                            <label for="weight">Weight (kg)</label>
                            <input type="number" id="weight" placeholder="70" min="30" max="200" required>
                        </div>
                        
                        <div class="input-group">
                            <label for="body-fat">Body Fat % (optional)</label>
                            <input type="number" id="body-fat" placeholder="20" min="5" max="60" step="0.1">
                        </div>
                    </div>
                </div>

                <div class="activity-goals">
                    <h3>Activity & Goals</h3>
                    
                    <div class="input-group">
                        <label for="activity-level">Activity Level</label>
                        <select id="activity-level">
                            <option value="sedentary">Sedentary (Little to no exercise)</option>
                            <option value="light">Lightly Active (Light exercise 1-3 days/week)</option>
                            <option value="moderate" selected>Moderately Active (Moderate exercise 3-5 days/week)</option>
                            <option value="very">Very Active (Hard exercise 6-7 days/week)</option>
                            <option value="extreme">Extremely Active (Athlete training twice daily)</option>
                        </select>
                    </div>

                    <div class="input-group">
                        <label for="goal">Fitness Goal</label>
                        <select id="goal">
                            <option value="weight_loss">Weight Loss</option>
                            <option value="maintenance" selected>Maintenance</option>
                            <option value="muscle_gain">Muscle Gain</option>
                            <option value="extreme_cut">Extreme Cutting</option>
                        </select>
                    </div>

                    <div class="input-group">
                        <label for="diet-type">Diet Preference</label>
                        <select id="diet-type">
                            <option value="balanced" selected>Balanced</option>
                            <option value="high_protein">High Protein</option>
                            <option value="low_carb">Low Carb</option>
                            <option value="keto">Keto</option>
                            <option value="high_carb">High Carb</option>
                        </select>
                    </div>

                    <div class="input-group">
                        <label for="protein-preference">Protein Preference</label>
                        <select id="protein-preference">
                            <option value="moderate" selected>Moderate Protein</option>
                            <option value="high">High Protein</option>
                            <option value="very_high">Very High Protein</option>
                        </select>
                    </div>
                </div>

                <div class="workout-details">
                    <h3>Workout Details</h3>
                    
                    <div class="input-row">
                        <div class="input-group">
                            <label for="workout-days">Workout Days per Week</label>
                            <input type="number" id="workout-days" placeholder="4" min="0" max="7">
                        </div>
                        
                        <div class="input-group">
                            <label for="workout-intensity">Workout Intensity</label>
                            <select id="workout-intensity">
                                <option value="light">Light</option>
                                <option value="moderate" selected>Moderate</option>
                                <option value="intense">Intense</option>
                                <option value="very_intense">Very Intense</option>
                            </select>
                        </div>
                    </div>

                    <div class="input-group">
                        <label for="workout-type">Primary Workout Type</label>
                        <select id="workout-type">
                            <option value="strength">Strength Training</option>
                            <option value="hybrid" selected>Hybrid (Strength & Cardio)</option>
                            <option value="cardio">Cardio/Endurance</option>
                            <option value="bodybuilding">Bodybuilding</option>
                        </select>
                    </div>
                </div>

                <button id="calculate" class="btn-primary">Calculate My Macros</button>
            </div>

            <div class="results-section">
                <h3>Your Macronutrient Results</h3>
                
                <div class="calorie-summary">
                    <div class="summary-card main-calories">
                        <h4>Daily Calorie Target</h4>
                        <div class="calorie-amount" id="calorie-target">--</div>
                        <div class="calorie-note" id="calorie-note"></div>
                    </div>
                </div>

                <div class="macro-breakdown">
                    <h4>Macronutrient Breakdown</h4>
                    <div class="macro-cards">
                        <div class="macro-card protein">
                            <div class="macro-icon">💪</div>
                            <h5>Protein</h5>
                            <div class="macro-amount" id="protein-grams">--</div>
                            <div class="macro-percent" id="protein-percent">--</div>
                            <div class="macro-calories" id="protein-calories">--</div>
                        </div>
                        
                        <div class="macro-card carbs">
                            <div class="macro-icon">🍚</div>
                            <h5>Carbohydrates</h5>
                            <div class="macro-amount" id="carbs-grams">--</div>
                            <div class="macro-percent" id="carbs-percent">--</div>
                            <div class="macro-calories" id="carbs-calories">--</div>
                        </div>
                        
                        <div class="macro-card fats">
                            <div class="macro-icon">🥑</div>
                            <h5>Fats</h5>
                            <div class="macro-amount" id="fats-grams">--</div>
                            <div class="macro-percent" id="fats-percent">--</div>
                            <div class="macro-calories" id="fats-calories">--</div>
                        </div>
                    </div>
                </div>

                <div class="macro-chart">
                    <h4>Macro Ratio Visualization</h4>
                    <div class="chart-container">
                        <canvas id="macro-chart"></canvas>
                    </div>
                </div>

                <div class="meal-planning">
                    <h4>Sample Meal Distribution</h4>
                    <div class="meal-tabs">
                        <button class="meal-tab active" data-meals="3">3 Meals</button>
                        <button class="meal-tab" data-meals="4">4 Meals</button>
                        <button class="meal-tab" data-meals="5">5 Meals</button>
                        <button class="meal-tab" data-meals="6">6 Meals</button>
                    </div>
                    
                    <div class="meal-distribution">
                        <div class="meal" id="meal-1">
                            <span class="meal-name">Breakfast</span>
                            <span class="meal-macros" id="meal-1-macros">--</span>
                        </div>
                        <div class="meal" id="meal-2">
                            <span class="meal-name">Lunch</span>
                            <span class="meal-macros" id="meal-2-macros">--</span>
                        </div>
                        <div class="meal" id="meal-3">
                            <span class="meal-name">Dinner</span>
                            <span class="meal-macros" id="meal-3-macros">--</span>
                        </div>
                        <div class="meal" id="meal-4">
                            <span class="meal-name">Snack 1</span>
                            <span class="meal-macros" id="meal-4-macros">--</span>
                        </div>
                        <div class="meal" id="meal-5">
                            <span class="meal-name">Snack 2</span>
                            <span class="meal-macros" id="meal-5-macros">--</span>
                        </div>
                        <div class="meal" id="meal-6">
                            <span class="meal-name">Snack 3</span>
                            <span class="meal-macros" id="meal-6-macros">--</span>
                        </div>
                    </div>
                </div>

                <div class="food-suggestions">
                    <h4>Food Suggestions</h4>
                    <div class="food-categories">
                        <div class="food-category">
                            <h5>Protein Sources</h5>
                            <ul>
                                <li>Chicken Breast</li>
                                <li>Greek Yogurt</li>
                                <li>Eggs</li>
                                <li>Whey Protein</li>
                                <li>Tofu</li>
                            </ul>
                        </div>
                        <div class="food-category">
                            <h5>Carb Sources</h5>
                            <ul>
                                <li>Brown Rice</li>
                                <li>Sweet Potatoes</li>
                                <li>Oats</li>
                                <li>Quinoa</li>
                                <li>Whole Wheat Bread</li>
                            </ul>
                        </div>
                        <div class="food-category">
                            <h5>Fat Sources</h5>
                            <ul>
                                <li>Avocado</li>
                                <li>Nuts & Seeds</li>
                                <li>Olive Oil</li>
                                <li>Nut Butters</li>
                                <li>Fatty Fish</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="macro-tips">
                    <h4>Macro Tracking Tips</h4>
                    <div class="tips-list">
                        <div class="tip">
                            <span class="tip-icon">📱</span>
                            <span>Use a food tracking app like MyFitnessPal</span>
                        </div>
                        <div class="tip">
                            <span class="tip-icon">⚖️</span>
                            <span>Weigh food for accurate measurements</span>
                        </div>
                        <div class="tip">
                            <span class="tip-icon">📝</span>
                            <span>Plan meals in advance</span>
                        </div>
                        <div class="tip">
                            <span class="tip-icon">🔄</span>
                            <span>Adjust based on progress weekly</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2023 17-Free Macro Calculator. All rights reserved.</p>
            <p>This tool is for educational purposes only. Consult healthcare professionals for medical advice.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="script.js"></script>
</body>
</html>