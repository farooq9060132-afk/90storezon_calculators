<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>19-Medication Calculator - Dosage & Interaction Checker</title>
    <meta name="description" content="Medication calculator for dosage calculations, drug interactions checking, and medication schedule management. Always consult healthcare professionals.">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>19-Medication Calculator</h1>
            <p>Medication Dosage Calculator & Safety Checker</p>
            <div class="disclaimer-warning">
                ⚠️ <strong>Important:</strong> This tool is for educational purposes only. Always consult healthcare professionals for medical advice.
            </div>
        </div>
    </header>

    <main class="container">
        <section class="intro">
            <h2>Safe Medication Management</h2>
            <p>Calculate proper dosages, check potential interactions, and manage your medication schedule safely.</p>
        </section>

        <div class="calculator-container">
            <div class="input-section">
                <div class="calculation-methods">
                    <h3>Medication Tools</h3>
                    <div class="method-tabs">
                        <button class="method-tab active" data-method="dosage">Dosage Calculator</button>
                        <button class="method-tab" data-method="interaction">Interaction Checker</button>
                        <button class="method-tab" data-method="schedule">Schedule Planner</button>
                    </div>
                </div>

                <div class="method-content">
                    <!-- Dosage Calculator -->
                    <div id="dosage-method" class="method-form active">
                        <div class="patient-info">
                            <h4>Patient Information</h4>
                            <div class="input-row">
                                <div class="input-group">
                                    <label for="weight">Weight</label>
                                    <div class="weight-input">
                                        <input type="number" id="weight" placeholder="70" min="3" max="200" required>
                                        <select id="weight-unit">
                                            <option value="kg">kg</option>
                                            <option value="lbs">lbs</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="input-group">
                                    <label for="age">Age</label>
                                    <input type="number" id="age" placeholder="30" min="0" max="120">
                                </div>
                            </div>

                            <div class="input-group">
                                <label for="condition">Medical Condition</label>
                                <select id="condition">
                                    <option value="general">General</option>
                                    <option value="pain">Pain Management</option>
                                    <option value="infection">Infection</option>
                                    <option value="chronic">Chronic Condition</option>
                                    <option value="pediatric">Pediatric</option>
                                    <option value="geriatric">Geriatric</option>
                                </select>
                            </div>
                        </div>

                        <div class="medication-info">
                            <h4>Medication Information</h4>
                            <div class="input-group">
                                <label for="medication-name">Medication Name</label>
                                <input type="text" id="medication-name" placeholder="e.g., Amoxicillin" list="common-meds">
                                <datalist id="common-meds">
                                    <option value="Amoxicillin">
                                    <option value="Ibuprofen">
                                    <option value="Paracetamol">
                                    <option value="Metformin">
                                    <option value="Lisinopril">
                                    <option value="Atorvastatin">
                                    <option value="Levothyroxine">
                                    <option value="Albuterol">
                                    <option value="Omeprazole">
                                    <option value="Sertraline">
                                </datalist>
                            </div>

                            <div class="input-row">
                                <div class="input-group">
                                    <label for="medication-strength">Medication Strength</label>
                                    <input type="text" id="medication-strength" placeholder="e.g., 500 mg">
                                </div>
                                
                                <div class="input-group">
                                    <label for="dosage-form">Dosage Form</label>
                                    <select id="dosage-form">
                                        <option value="tablet">Tablet</option>
                                        <option value="capsule">Capsule</option>
                                        <option value="liquid">Liquid</option>
                                        <option value="injection">Injection</option>
                                        <option value="cream">Cream/Ointment</option>
                                        <option value="inhaler">Inhaler</option>
                                    </select>
                                </div>
                            </div>

                            <div class="input-group">
                                <label for="prescribed-dose">Prescribed Dose</label>
                                <input type="text" id="prescribed-dose" placeholder="e.g., 250 mg every 8 hours">
                            </div>
                        </div>

                        <div class="calculation-type">
                            <h4>Calculation Type</h4>
                            <div class="radio-group">
                                <label class="radio">
                                    <input type="radio" name="calc-type" value="single" checked>
                                    <span>Single Dose Calculation</span>
                                </label>
                                <label class="radio">
                                    <input type="radio" name="calc-type" value="daily">
                                    <span>Daily Dosage Calculation</span>
                                </label>
                                <label class="radio">
                                    <input type="radio" name="calc-type" value="weight">
                                    <span>Weight-Based Calculation</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Interaction Checker -->
                    <div id="interaction-method" class="method-form">
                        <div class="input-group">
                            <label for="current-meds">Current Medications</label>
                            <textarea id="current-meds" placeholder="Enter medication names, one per line&#10;e.g.:&#10;Lisinopril&#10;Metformin&#10;Ibuprofen" rows="4"></textarea>
                        </div>

                        <div class="input-group">
                            <label for="new-medication">New Medication to Check</label>
                            <input type="text" id="new-medication" placeholder="Enter medication name">
                        </div>

                        <div class="input-group">
                            <label for="health-conditions">Existing Health Conditions</label>
                            <div class="checkbox-group">
                                <label class="checkbox">
                                    <input type="checkbox" name="health-conditions" value="hypertension"> High Blood Pressure
                                </label>
                                <label class="checkbox">
                                    <input type="checkbox" name="health-conditions" value="diabetes"> Diabetes
                                </label>
                                <label class="checkbox">
                                    <input type="checkbox" name="health-conditions" value="kidney"> Kidney Disease
                                </label>
                                <label class="checkbox">
                                    <input type="checkbox" name="health-conditions" value="liver"> Liver Disease
                                </label>
                                <label class="checkbox">
                                    <input type="checkbox" name="health-conditions" value="heart"> Heart Disease
                                </label>
                                <label class="checkbox">
                                    <input type="checkbox" name="health-conditions" value="asthma"> Asthma/COPD
                                </label>
                            </div>
                        </div>

                        <div class="input-group">
                            <label for="allergies">Known Allergies</label>
                            <input type="text" id="allergies" placeholder="List any medication allergies">
                        </div>
                    </div>

                    <!-- Schedule Planner -->
                    <div id="schedule-method" class="method-form">
                        <div class="input-group">
                            <label for="schedule-meds">Medications for Schedule</label>
                            <textarea id="schedule-meds" placeholder="Enter medications with frequencies&#10;e.g.:&#10;Lisinopril - 1 tablet daily&#10;Metformin - 1 tablet twice daily&#10;Ibuprofen - as needed" rows="4"></textarea>
                        </div>

                        <div class="input-row">
                            <div class="input-group">
                                <label for="wake-time">Wake-up Time</label>
                                <input type="time" id="wake-time" value="07:00">
                            </div>
                            
                            <div class="input-group">
                                <label for="bed-time">Bedtime</label>
                                <input type="time" id="bed-time" value="22:00">
                            </div>
                        </div>

                        <div class="input-group">
                            <label for="meal-preference">Meal Preference</label>
                            <select id="meal-preference">
                                <option value="with_food">With Food</option>
                                <option value="empty_stomach">Empty Stomach</option>
                                <option value="either">Either Way</option>
                            </select>
                        </div>

                        <div class="input-group">
                            <label for="schedule-days">Schedule Duration</label>
                            <select id="schedule-days">
                                <option value="7">7 days</option>
                                <option value="14">14 days</option>
                                <option value="30" selected>30 days</option>
                                <option value="90">90 days</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="safety-check">
                    <h4>Safety Verification</h4>
                    <div class="verification-item">
                        <label class="checkbox">
                            <input type="checkbox" id="verify-prescription">
                            <span>I have a valid prescription for this medication</span>
                        </label>
                    </div>
                    <div class="verification-item">
                        <label class="checkbox">
                            <input type="checkbox" id="verify-doctor">
                            <span>I have consulted with a healthcare provider</span>
                        </label>
                    </div>
                </div>

                <button id="calculate" class="btn-primary">Calculate Medication</button>
            </div>

            <div class="results-section">
                <h3>Medication Results</h3>
                
                <div class="results-warning">
                    <div class="warning-icon">⚠️</div>
                    <p><strong>Medical Disclaimer:</strong> These results are for educational purposes only. Always follow your healthcare provider's instructions.</p>
                </div>

                <div class="dosage-results" id="dosage-results">
                    <div class="result-card main-result">
                        <h4>Recommended Dosage</h4>
                        <div class="dosage-amount" id="calculated-dosage">--</div>
                        <div class="dosage-note" id="dosage-note"></div>
                    </div>
                    
                    <div class="result-cards">
                        <div class="result-card">
                            <h4>Frequency</h4>
                            <div class="result-value" id="dosage-frequency">--</div>
                        </div>
                        
                        <div class="result-card">
                            <h4>Duration</h4>
                            <div class="result-value" id="treatment-duration">--</div>
                        </div>
                    </div>

                    <div class="administration-guide">
                        <h4>Administration Guide</h4>
                        <div class="guide-items">
                            <div class="guide-item">
                                <span class="guide-icon">💊</span>
                                <span id="administration-method">--</span>
                            </div>
                            <div class="guide-item">
                                <span class="guide-icon">⏰</span>
                                <span id="best-time">--</span>
                            </div>
                            <div class="guide-item">
                                <span class="guide-icon">🍽️</span>
                                <span id="food-instructions">--</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="interaction-results" id="interaction-results">
                    <div class="interaction-summary">
                        <h4>Interaction Analysis</h4>
                        <div class="interaction-level" id="interaction-level">
                            <span class="level-badge safe">Safe</span>
                        </div>
                        <p id="interaction-summary-text">No significant interactions detected</p>
                    </div>

                    <div class="interaction-details">
                        <h5>Potential Interactions</h5>
                        <div class="interaction-list" id="interaction-list">
                            <!-- Interactions will be populated here -->
                        </div>
                    </div>

                    <div class="precautions">
                        <h5>Precautions & Monitoring</h5>
                        <ul id="precautions-list">
                            <li>Monitor for any unusual side effects</li>
                            <li>Report any new symptoms to your doctor</li>
                        </ul>
                    </div>
                </div>

                <div class="schedule-results" id="schedule-results">
                    <div class="schedule-header">
                        <h4>Medication Schedule</h4>
                        <div class="schedule-period" id="schedule-period">Next 30 days</div>
                    </div>

                    <div class="daily-schedule">
                        <h5>Today's Schedule</h5>
                        <div class="schedule-timeline">
                            <div class="time-slot" id="morning-meds">
                                <span class="time">Morning (7:00 AM)</span>
                                <span class="medications" id="morning-medications">--</span>
                            </div>
                            <div class="time-slot" id="afternoon-meds">
                                <span class="time">Afternoon (12:00 PM)</span>
                                <span class="medications" id="afternoon-medications">--</span>
                            </div>
                            <div class="time-slot" id="evening-meds">
                                <span class="time">Evening (6:00 PM)</span>
                                <span class="medications" id="evening-medications">--</span>
                            </div>
                            <div class="time-slot" id="bedtime-meds">
                                <span class="time">Bedtime (10:00 PM)</span>
                                <span class="medications" id="bedtime-medications">--</span>
                            </div>
                        </div>
                    </div>

                    <div class="schedule-print">
                        <button class="btn-secondary" id="print-schedule">Print Schedule</button>
                        <button class="btn-secondary" id="export-schedule">Export to PDF</button>
                    </div>
                </div>

                <div class="safety-alerts">
                    <h4>Important Safety Alerts</h4>
                    <div class="alerts-list">
                        <div class="alert-item warning">
                            <span class="alert-icon">⚠️</span>
                            <span>Do not exceed recommended dosages</span>
                        </div>
                        <div class="alert-item warning">
                            <span class="alert-icon">⚠️</span>
                            <span>Consult your doctor before making changes</span>
                        </div>
                        <div class="alert-item warning">
                            <span class="alert-icon">⚠️</span>
                            <span>Seek immediate help for severe side effects</span>
                        </div>
                    </div>
                </div>

                <div class="medication-tips">
                    <h4>Medication Safety Tips</h4>
                    <div class="tips-grid">
                        <div class="tip-card">
                            <div class="tip-icon">📝</div>
                            <h5>Keep a Medication List</h5>
                            <p>Maintain an updated list of all medications and supplements</p>
                        </div>
                        <div class="tip-card">
                            <div class="tip-icon">🏥</div>
                            <h5>Regular Check-ups</h5>
                            <p>Schedule regular appointments with your healthcare provider</p>
                        </div>
                        <div class="tip-card">
                            <div class="tip-icon">💊</div>
                            <h5>Proper Storage</h5>
                            <p>Store medications in a cool, dry place away from children</p>
                        </div>
                        <div class="tip-card">
                            <div class="tip-icon">🔄</div>
                            <h5>Review Regularly</h5>
                            <p>Periodically review all medications with your pharmacist</p>
                        </div>
                    </div>
                </div>

                <div class="emergency-info">
                    <h4>Emergency Information</h4>
                    <div class="emergency-contacts">
                        <div class="contact-item">
                            <span class="contact-type">Poison Control</span>
                            <span class="contact-number">1-800-222-1222</span>
                        </div>
                        <div class="contact-item">
                            <span class="contact-type">Emergency Services</span>
                            <span class="contact-number">911</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2023 19-Free Medication Calculator. All rights reserved.</p>
            <p><strong>Important:</strong> This tool provides educational information only and is not a substitute for professional medical advice. Always consult healthcare professionals.</p>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>