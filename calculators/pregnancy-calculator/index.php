
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>15-Pregnancy Calculator - Due Date & Pregnancy Timeline</title>
    <meta name="description" content="Pregnancy calculator to determine your due date, track pregnancy progress week by week, and get personalized pregnancy information.">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>15-Pregnancy Calculator</h1>
            <p>Track your pregnancy journey with accurate due date calculation and weekly updates</p>
        </div>
    </header>

    <main class="container">
        <section class="intro">
            <h2>Your Pregnancy Journey Starts Here</h2>
            <p>Calculate your due date, track fetal development week by week, and get personalized pregnancy information.</p>
        </section>

        <div class="calculator-container">
            <div class="input-section">
                <div class="calculation-methods">
                    <h3>Calculate Your Due Date</h3>
                    <div class="method-tabs">
                        <button class="method-tab active" data-method="lmp">Last Menstrual Period</button>
                        <button class="method-tab" data-method="conception">Conception Date</button>
                        <button class="method-tab" data-method="ultrasound">Ultrasound Date</button>
                    </div>
                </div>

                <div class="method-content">
                    <!-- LMP Method -->
                    <div id="lmp-method" class="method-form active">
                        <div class="input-group">
                            <label for="lmp-date">First Day of Last Menstrual Period</label>
                            <input type="date" id="lmp-date" required>
                        </div>
                        <div class="input-group">
                            <label for="cycle-length">Average Cycle Length (days)</label>
                            <select id="cycle-length">
                                <option value="28">28 days (Average)</option>
                                <option value="21">21 days (Short)</option>
                                <option value="25">25 days</option>
                                <option value="30">30 days</option>
                                <option value="35">35 days (Long)</option>
                                <option value="40">40+ days (Very Long)</option>
                            </select>
                        </div>
                    </div>

                    <!-- Conception Date Method -->
                    <div id="conception-method" class="method-form">
                        <div class="input-group">
                            <label for="conception-date">Estimated Conception Date</label>
                            <input type="date" id="conception-date">
                        </div>
                        <div class="input-group">
                            <label for="ivf">IVF/IUI Treatment</label>
                            <select id="ivf">
                                <option value="no">No</option>
                                <option value="yes">Yes</option>
                            </select>
                        </div>
                    </div>

                    <!-- Ultrasound Method -->
                    <div id="ultrasound-method" class="method-form">
                        <div class="input-group">
                            <label for="ultrasound-date">Ultrasound Date</label>
                            <input type="date" id="ultrasound-date">
                        </div>
                        <div class="input-group">
                            <label for="gestational-age">Gestational Age at Ultrasound</label>
                            <div class="age-input">
                                <input type="number" id="weeks" placeholder="Weeks" min="0" max="40">
                                <span>weeks</span>
                                <input type="number" id="days" placeholder="Days" min="0" max="6">
                                <span>days</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="additional-info">
                    <h4>Additional Information</h4>
                    <div class="input-group">
                        <label for="pregnancy-number">Which Pregnancy is This?</label>
                        <select id="pregnancy-number">
                            <option value="1">First Pregnancy</option>
                            <option value="2">Second Pregnancy</option>
                            <option value="3">Third Pregnancy</option>
                            <option value="4">Fourth or More</option>
                        </select>
                    </div>
                </div>

                <button id="calculate" class="btn-primary">Calculate My Due Date</button>
            </div>

            <div class="results-section">
                <h3>Your Pregnancy Results</h3>
                
                <div class="pregnancy-summary">
                    <div class="summary-card">
                        <h4>Estimated Due Date</h4>
                        <div class="result-value" id="due-date">--</div>
                        <div class="result-note" id="due-date-note"></div>
                    </div>
                    
                    <div class="summary-card">
                        <h4>Current Week</h4>
                        <div class="result-value" id="current-week">--</div>
                        <div class="result-note" id="trimester">--</div>
                    </div>
                    
                    <div class="summary-card">
                        <h4>Days to Go</h4>
                        <div class="result-value" id="days-remaining">--</div>
                        <div class="result-note" id="progress-percent">--</div>
                    </div>
                </div>

                <div class="pregnancy-timeline">
                    <h4>Pregnancy Timeline</h4>
                    <div class="timeline-container">
                        <div class="timeline">
                            <div class="timeline-milestones">
                                <div class="milestone" data-week="4">Positive Test</div>
                                <div class="milestone" data-week="8">First Ultrasound</div>
                                <div class="milestone" data-week="12">First Trimester End</div>
                                <div class="milestone" data-week="20">Anatomy Scan</div>
                                <div class="milestone" data-week="28">Third Trimester</div>
                                <div class="milestone" data-week="40">Due Date</div>
                            </div>
                            <div class="timeline-bar">
                                <div class="timeline-progress" id="timeline-progress"></div>
                                <div class="timeline-pointer" id="timeline-pointer"></div>
                            </div>
                            <div class="timeline-weeks">
                                <span>4w</span>
                                <span>12w</span>
                                <span>20w</span>
                                <span>28w</span>
                                <span>40w</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="weekly-update">
                    <h4>This Week's Development</h4>
                    <div class="week-info" id="week-info">
                        <div class="week-header">
                            <h5 id="week-title">Week <span id="week-number">--</span></h5>
                            <p id="week-dates">--</p>
                        </div>
                        <div class="development-details">
                            <div class="baby-development">
                                <h6>Baby's Development</h6>
                                <p id="baby-development">Calculate to see this week's development...</p>
                            </div>
                            <div class="mother-changes">
                                <h6>Changes for Mom</h6>
                                <p id="mother-changes">Calculate to see changes for this week...</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="important-dates">
                    <h4>Important Dates</h4>
                    <div class="dates-list">
                        <div class="date-item">
                            <span class="date-label">First Trimester Ends</span>
                            <span class="date-value" id="trimester1-end">--</span>
                        </div>
                        <div class="date-item">
                            <span class="date-label">Second Trimester Ends</span>
                            <span class="date-value" id="trimester2-end">--</span>
                        </div>
                        <div class="date-item">
                            <span class="date-label">Viability Week (24 weeks)</span>
                            <span class="date-value" id="viability-date">--</span>
                        </div>
                    </div>
                </div>

                <div class="pregnancy-tips">
                    <h4>Pregnancy Tips</h4>
                    <ul>
                        <li>Take prenatal vitamins with folic acid</li>
                        <li>Stay hydrated and eat balanced meals</li>
                        <li>Attend all prenatal appointments</li>
                        <li>Get moderate exercise as approved by your doctor</li>
                    </ul>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2023 15-Free Pregnancy Calculator. All rights reserved.</p>
            <p>This tool is for educational purposes only. Always consult with healthcare providers for medical advice.</p>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>