<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>18-Heart Rate Calculator - Target HR Zones & Maximum HR</title>
    <meta name="description" content="Heart rate calculator to determine your maximum heart rate, target heart rate zones for exercise, and resting heart rate analysis.">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>18-Heart Rate Calculator</h1>
            <p>Calculate Your Target Heart Rate Zones for Optimal Exercise</p>
        </div>
    </header>

    <main class="container">
        <section class="intro">
            <h2>Optimize Your Workouts with Heart Rate Training</h2>
            <p>Calculate your maximum heart rate, target zones for different exercise intensities, and understand what your heart rate numbers mean.</p>
        </section>

        <div class="calculator-container">
            <div class="input-section">
                <div class="calculation-methods">
                    <h3>Calculate Heart Rate Zones</h3>
                    <div class="method-tabs">
                        <button class="method-tab active" data-method="basic">Basic Calculator</button>
                        <button class="method-tab" data-method="advanced">Advanced Calculator</button>
                        <button class="method-tab" data-method="resting">Resting HR Analysis</button>
                    </div>
                </div>

                <div class="method-content">
                    <!-- Basic Method -->
                    <div id="basic-method" class="method-form active">
                        <div class="input-group">
                            <label for="age">Your Age</label>
                            <input type="number" id="age" placeholder="30" min="15" max="100" required>
                        </div>

                        <div class="input-group">
                            <label for="basic-resting-hr">Resting Heart Rate (optional)</label>
                            <input type="number" id="basic-resting-hr" placeholder="70" min="30" max="120">
                            <small>Beats per minute (bpm)</small>
                        </div>

                        <div class="input-group">
                            <label for="fitness-level">Fitness Level</label>
                            <select id="fitness-level">
                                <option value="beginner">Beginner</option>
                                <option value="intermediate" selected>Intermediate</option>
                                <option value="advanced">Advanced</option>
                                <option value="athlete">Athlete</option>
                            </select>
                        </div>
                    </div>

                    <!-- Advanced Method -->
                    <div id="advanced-method" class="method-form">
                        <div class="input-group">
                            <label for="advanced-age">Age</label>
                            <input type="number" id="advanced-age" placeholder="30" min="15" max="100">
                        </div>

                        <div class="input-group">
                            <label for="advanced-resting-hr">Resting Heart Rate</label>
                            <input type="number" id="advanced-resting-hr" placeholder="70" min="30" max="120" required>
                            <small>Beats per minute (bpm)</small>
                        </div>

                        <div class="input-group">
                            <label for="hr-formula">HR Formula</label>
                            <select id="hr-formula">
                                <option value="karvonen">Karvonen Formula</option>
                                <option value="tanaka">Tanaka Formula</option>
                                <option value="gellish">Gellish Formula</option>
                                <option value="haskell">Haskell & Fox</option>
                            </select>
                        </div>

                        <div class="input-group">
                            <label for="training-goal">Training Goal</label>
                            <select id="training-goal">
                                <option value="fat_burn">Fat Burning</option>
                                <option value="cardio">Cardiovascular</option>
                                <option value="peak">Peak Performance</option>
                                <option value="recovery">Recovery</option>
                            </select>
                        </div>
                    </div>

                    <!-- Resting HR Method -->
                    <div id="resting-method" class="method-form">
                        <div class="input-group">
                            <label for="resting-hr-value">Your Resting Heart Rate</label>
                            <input type="number" id="resting-hr-value" placeholder="70" min="30" max="120" required>
                            <small>Beats per minute (bpm)</small>
                        </div>

                        <div class="input-group">
                            <label for="measurement-time">Measurement Time</label>
                            <select id="measurement-time">
                                <option value="morning">Morning (after waking)</option>
                                <option value="evening">Evening (before bed)</option>
                                <option value="random">Random time</option>
                            </select>
                        </div>

                        <div class="input-group">
                            <label for="health-conditions">Health Factors</label>
                            <div class="checkbox-group">
                                <label class="checkbox">
                                    <input type="checkbox" name="health-conditions" value="hypertension"> High Blood Pressure
                                </label>
                                <label class="checkbox">
                                    <input type="checkbox" name="health-conditions" value="medication"> Heart Medication
                                </label>
                                <label class="checkbox">
                                    <input type="checkbox" name="health-conditions" value="stress"> High Stress
                                </label>
                                <label class="checkbox">
                                    <input type="checkbox" name="health-conditions" value="dehydration"> Dehydration
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="activity-info">
                    <h4>Current Activity Level</h4>
                    <div class="activity-options">
                        <label class="activity-option">
                            <input type="radio" name="activity" value="sedentary" checked>
                            <span>Sedentary</span>
                        </label>
                        <label class="activity-option">
                            <input type="radio" name="activity" value="light">
                            <span>Lightly Active</span>
                        </label>
                        <label class="activity-option">
                            <input type="radio" name="activity" value="moderate">
                            <span>Moderately Active</span>
                        </label>
                        <label class="activity-option">
                            <input type="radio" name="activity" value="very">
                            <span>Very Active</span>
                        </label>
                    </div>
                </div>

                <button id="calculate" class="btn-primary">Calculate Heart Rate Zones</button>
            </div>

            <div class="results-section">
                <h3>Your Heart Rate Analysis</h3>
                
                <div class="hr-summary">
                    <div class="summary-card main-hr">
                        <h4>Maximum Heart Rate</h4>
                        <div class="hr-value" id="max-hr">--</div>
                        <div class="hr-note" id="max-hr-note"></div>
                    </div>
                    
                    <div class="summary-cards">
                        <div class="summary-card">
                            <h4>Resting HR</h4>
                            <div class="result-value" id="resting-hr">--</div>
                            <div class="result-category" id="resting-hr-category">--</div>
                        </div>
                        
                        <div class="summary-card">
                            <h4>Heart Rate Reserve</h4>
                            <div class="result-value" id="hr-reserve">--</div>
                            <div class="result-category">bpm</div>
                        </div>
                    </div>
                </div>

                <div class="zones-breakdown">
                    <h4>Target Heart Rate Zones</h4>
                    <div class="zones-container">
                        <div class="zone-card zone-1">
                            <div class="zone-header">
                                <h5>Zone 1: Very Light</h5>
                                <span class="zone-percent">50-60%</span>
                            </div>
                            <div class="zone-range" id="zone-1-range">--</div>
                            <div class="zone-description">Warm-up, recovery, fat burning</div>
                        </div>
                        
                        <div class="zone-card zone-2">
                            <div class="zone-header">
                                <h5>Zone 2: Light</h5>
                                <span class="zone-percent">60-70%</span>
                            </div>
                            <div class="zone-range" id="zone-2-range">--</div>
                            <div class="zone-description">Aerobic base, endurance training</div>
                        </div>
                        
                        <div class="zone-card zone-3">
                            <div class="zone-header">
                                <h5>Zone 3: Moderate</h5>
                                <span class="zone-percent">70-80%</span>
                            </div>
                            <div class="zone-range" id="zone-3-range">--</div>
                            <div class="zone-description">Aerobic fitness, improved stamina</div>
                        </div>
                        
                        <div class="zone-card zone-4">
                            <div class="zone-header">
                                <h5>Zone 4: Hard</h5>
                                <span class="zone-percent">80-90%</span>
                            </div>
                            <div class="zone-range" id="zone-4-range">--</div>
                            <div class="zone-description">Anaerobic threshold, performance</div>
                        </div>
                        
                        <div class="zone-card zone-5">
                            <div class="zone-header">
                                <h5>Zone 5: Maximum</h5>
                                <span class="zone-percent">90-100%</span>
                            </div>
                            <div class="zone-range" id="zone-5-range">--</div>
                            <div class="zone-description">Peak effort, short bursts only</div>
                        </div>
                    </div>
                </div>

                <div class="training-recommendations">
                    <h4>Training Recommendations</h4>
                    <div class="recommendation-tabs">
                        <button class="rec-tab active" data-goal="fat_burn">Fat Burning</button>
                        <button class="rec-tab" data-goal="cardio">Cardio Fitness</button>
                        <button class="rec-tab" data-goal="endurance">Endurance</button>
                        <button class="rec-tab" data-goal="performance">Performance</button>
                    </div>
                    
                    <div class="recommendation-content">
                        <div id="fat_burn-rec" class="rec-content active">
                            <h5>Fat Burning Zone (60-70% MHR)</h5>
                            <ul>
                                <li>45-60 minutes of moderate cardio</li>
                                <li>Brisk walking, light cycling</li>
                                <li>3-5 times per week</li>
                                <li>Focus on longer duration, lower intensity</li>
                            </ul>
                        </div>
                        <div id="cardio-rec" class="rec-content">
                            <h5>Cardio Fitness Zone (70-80% MHR)</h5>
                            <ul>
                                <li>30-45 minutes of vigorous cardio</li>
                                <li>Running, swimming, cycling</li>
                                <li>4-5 times per week</li>
                                <li>Improves cardiovascular health</li>
                            </ul>
                        </div>
                        <div id="endurance-rec" class="rec-content">
                            <h5>Endurance Zone (80-90% MHR)</h5>
                            <ul>
                                <li>20-30 minutes high intensity</li>
                                <li>Interval training, hill repeats</li>
                                <li>2-3 times per week</li>
                                <li>Builds stamina and performance</li>
                            </ul>
                        </div>
                        <div id="performance-rec" class="rec-content">
                            <h5>Peak Performance Zone (90-100% MHR)</h5>
                            <ul>
                                <li>Short bursts of 1-5 minutes</li>
                                <li>Sprinting, high-intensity intervals</li>
                                <li>1-2 times per week maximum</li>
                                <li>For advanced athletes only</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="heart-rate-chart">
                    <h4>Heart Rate Zone Visualization</h4>
                    <div class="chart-container">
                        <canvas id="hr-chart"></canvas>
                    </div>
                </div>

                <div class="health-insights">
                    <h4>Health Insights</h4>
                    <div class="insights-grid">
                        <div class="insight-card">
                            <div class="insight-icon">❤️</div>
                            <h5>Resting HR Status</h5>
                            <p id="resting-hr-insight">Calculate to see your resting HR analysis</p>
                        </div>
                        <div class="insight-card">
                            <div class="insight-icon">📊</div>
                            <h5>Fitness Level</h5>
                            <p id="fitness-insight">Calculate to see fitness assessment</p>
                        </div>
                        <div class="insight-card">
                            <div class="insight-icon">⚡</div>
                            <h5>Training Potential</h5>
                            <p id="training-insight">Calculate to see training recommendations</p>
                        </div>
                    </div>
                </div>

                <div class="safety-tips">
                    <h4>Heart Rate Safety Tips</h4>
                    <div class="tips-list">
                        <div class="tip">
                            <span class="tip-icon">⚠️</span>
                            <span>Consult doctor before starting new exercise programs</span>
                        </div>
                        <div class="tip">
                            <span class="tip-icon">💧</span>
                            <span>Stay hydrated during exercise</span>
                        </div>
                        <div class="tip">
                            <span class="tip-icon">🌡️</span>
                            <span>Stop if you feel dizzy, nauseous, or have chest pain</span>
                        </div>
                        <div class="tip">
                            <span class="tip-icon">📱</span>
                            <span>Use a heart rate monitor for accurate tracking</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2023 18-Free Heart Rate Calculator. All rights reserved.</p>
            <p>This tool is for educational purposes only. Consult healthcare professionals for medical advice.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="script.js"></script>
</body>
</html>