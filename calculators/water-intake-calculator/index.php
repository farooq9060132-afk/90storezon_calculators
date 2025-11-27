<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>16-Water Intake Calculator - Daily Hydration Needs</title>
    <meta name="description" content="Water intake calculator to determine your daily hydration needs based on weight, activity level, and climate. Stay properly hydrated!">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>16-Water Intake Calculator</h1>
            <p>Calculate your daily hydration needs and stay properly hydrated</p>
        </div>
    </header>

    <main class="container">
        <section class="intro">
            <h2>Stay Hydrated, Stay Healthy</h2>
            <p>Calculate your personalized daily water intake based on your body, activity level, and environment.</p>
        </section>

        <div class="calculator-container">
            <div class="input-section">
                <div class="calculation-methods">
                    <h3>Calculate Your Water Needs</h3>
                    <div class="method-tabs">
                        <button class="method-tab active" data-method="standard">Standard Calculation</button>
                        <button class="method-tab" data-method="advanced">Advanced Calculation</button>
                    </div>
                </div>

                <div class="method-content">
                    <!-- Standard Method -->
                    <div id="standard-method" class="method-form active">
                        <div class="input-group">
                            <label for="weight">Your Weight</label>
                            <div class="weight-input">
                                <input type="number" id="weight" placeholder="70" min="30" max="200" required>
                                <select id="weight-unit">
                                    <option value="kg">kg</option>
                                    <option value="lbs">lbs</option>
                                </select>
                            </div>
                        </div>

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
                    </div>

                    <!-- Advanced Method -->
                    <div id="advanced-method" class="method-form">
                        <div class="input-group">
                            <label for="age">Age</label>
                            <input type="number" id="age" placeholder="30" min="1" max="120">
                        </div>

                        <div class="input-group">
                            <label for="gender">Gender</label>
                            <select id="gender">
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="pregnant">Pregnant</option>
                                <option value="breastfeeding">Breastfeeding</option>
                            </select>
                        </div>

                        <div class="input-group">
                            <label for="advanced-weight">Weight</label>
                            <div class="weight-input">
                                <input type="number" id="advanced-weight" placeholder="70" min="30" max="200">
                                <select id="advanced-weight-unit">
                                    <option value="kg">kg</option>
                                    <option value="lbs">lbs</option>
                                </select>
                            </div>
                        </div>

                        <div class="input-group">
                            <label for="height">Height (optional)</label>
                            <div class="height-input">
                                <input type="number" id="height-cm" placeholder="170" min="100" max="250">
                                <span>cm</span>
                            </div>
                        </div>

                        <div class="input-group">
                            <label for="climate">Climate</label>
                            <select id="climate">
                                <option value="temperate">Temperate</option>
                                <option value="hot">Hot/Humid</option>
                                <option value="dry">Dry/Arid</option>
                                <option value="cold">Cold</option>
                            </select>
                        </div>

                        <div class="input-group">
                            <label for="exercise-duration">Daily Exercise Duration (minutes)</label>
                            <input type="number" id="exercise-duration" placeholder="30" min="0" max="300">
                        </div>

                        <div class="input-group">
                            <label for="health-conditions">Health Conditions</label>
                            <div class="checkbox-group">
                                <label class="checkbox">
                                    <input type="checkbox" name="health-conditions" value="pregnancy"> Pregnancy
                                </label>
                                <label class="checkbox">
                                    <input type="checkbox" name="health-conditions" value="fever"> Fever/Illness
                                </label>
                                <label class="checkbox">
                                    <input type="checkbox" name="health-conditions" value="kidney"> Kidney Issues
                                </label>
                                <label class="checkbox">
                                    <input type="checkbox" name="health-conditions" value="heart"> Heart Conditions
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="hydration-factors">
                    <h4>Additional Factors</h4>
                    <div class="factors-grid">
                        <div class="factor-item">
                            <label class="switch">
                                <input type="checkbox" id="high-altitude">
                                <span class="slider"></span>
                            </label>
                            <span>High Altitude</span>
                        </div>
                        <div class="factor-item">
                            <label class="switch">
                                <input type="checkbox" id="alcohol">
                                <span class="slider"></span>
                            </label>
                            <span>Alcohol Consumption</span>
                        </div>
                        <div class="factor-item">
                            <label class="switch">
                                <input type="checkbox" id="caffeine">
                                <span class="slider"></span>
                            </label>
                            <span>High Caffeine Intake</span>
                        </div>
                        <div class="factor-item">
                            <label class="switch">
                                <input type="checkbox" id="high-protein">
                                <span class="slider"></span>
                            </label>
                            <span>High Protein Diet</span>
                        </div>
                    </div>
                </div>

                <button id="calculate" class="btn-primary">Calculate My Water Needs</button>
            </div>

            <div class="results-section">
                <h3>Your Hydration Results</h3>
                
                <div class="water-summary">
                    <div class="summary-card main-result">
                        <h4>Recommended Daily Water Intake</h4>
                        <div class="water-amount" id="water-amount">--</div>
                        <div class="equivalent" id="water-equivalent">--</div>
                    </div>
                    
                    <div class="summary-cards">
                        <div class="summary-card">
                            <h4>Minimum Intake</h4>
                            <div class="result-value" id="min-intake">--</div>
                        </div>
                        
                        <div class="summary-card">
                            <h4>Maximum Intake</h4>
                            <div class="result-value" id="max-intake">--</div>
                        </div>
                    </div>
                </div>

                <div class="hydration-schedule">
                    <h4>Daily Hydration Schedule</h4>
                    <div class="schedule-container">
                        <div class="time-slots">
                            <div class="time-slot">
                                <span class="time">7:00 AM</span>
                                <span class="amount" id="time-1">--</span>
                            </div>
                            <div class="time-slot">
                                <span class="time">9:00 AM</span>
                                <span class="amount" id="time-2">--</span>
                            </div>
                            <div class="time-slot">
                                <span class="time">11:00 AM</span>
                                <span class="amount" id="time-3">--</span>
                            </div>
                            <div class="time-slot">
                                <span class="time">1:00 PM</span>
                                <span class="amount" id="time-4">--</span>
                            </div>
                            <div class="time-slot">
                                <span class="time">3:00 PM</span>
                                <span class="amount" id="time-5">--</span>
                            </div>
                            <div class="time-slot">
                                <span class="time">5:00 PM</span>
                                <span class="amount" id="time-6">--</span>
                            </div>
                            <div class="time-slot">
                                <span class="time">7:00 PM</span>
                                <span class="amount" id="time-7">--</span>
                            </div>
                            <div class="time-slot">
                                <span class="time">9:00 PM</span>
                                <span class="amount" id="time-8">--</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="hydration-tips">
                    <h4>Hydration Tips</h4>
                    <div class="tips-grid">
                        <div class="tip-card">
                            <div class="tip-icon">💧</div>
                            <h5>Start Your Day Right</h5>
                            <p>Drink a glass of water first thing in the morning to kickstart hydration</p>
                        </div>
                        <div class="tip-card">
                            <div class="tip-icon">⏰</div>
                            <h5>Set Reminders</h5>
                            <p>Use phone alerts or apps to remind you to drink water regularly</p>
                        </div>
                        <div class="tip-card">
                            <div class="tip-icon">🍋</div>
                            <h5>Add Flavor</h5>
                            <p>Infuse water with lemon, cucumber, or mint for better taste</p>
                        </div>
                        <div class="tip-card">
                            <div class="tip-icon">🥤</div>
                            <h5>Carry a Bottle</h5>
                            <p>Keep a water bottle with you throughout the day</p>
                        </div>
                    </div>
                </div>

                <div class="dehydration-signs">
                    <h4>Signs of Dehydration</h4>
                    <div class="signs-list">
                        <div class="sign-item">
                            <span class="sign-icon">💛</span>
                            <span>Dark yellow urine</span>
                        </div>
                        <div class="sign-item">
                            <span class="sign-icon">😴</span>
                            <span>Fatigue or tiredness</span>
                        </div>
                        <div class="sign-item">
                            <span class="sign-icon">🤕</span>
                            <span>Headaches</span>
                        </div>
                        <div class="sign-item">
                            <span class="sign-icon">💡</span>
                            <span>Dry mouth and lips</span>
                        </div>
                        <div class="sign-item">
                            <span class="sign-icon">🎯</span>
                            <span>Difficulty concentrating</span>
                        </div>
                        <div class="sign-item">
                            <span class="sign-icon">🌀</span>
                            <span>Dizziness</span>
                        </div>
                    </div>
                </div>

                <div class="water-sources">
                    <h4>Other Water Sources</h4>
                    <div class="sources-info">
                        <p>Remember that about 20% of your daily water intake comes from food and other beverages:</p>
                        <ul>
                            <li>Fruits and vegetables (watermelon, cucumber, oranges)</li>
                            <li>Soups and broths</li>
                            <li>Herbal teas</li>
                            <li>Milk and juice</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2023 16-Free Water Intake Calculator. All rights reserved.</p>
            <p>This tool is for educational purposes only. Consult healthcare professionals for medical advice.</p>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>