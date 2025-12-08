<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grade Calculator - Calculate GPA & Final Grades</title>
    <meta name="description" content="Online grade calculator. Calculate GPA, final grades, weighted averages, and what you need to score on finals. Perfect for students and teachers.">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <!-- VIP Header Card -->
        <div class="vip-card">
            <div class="vip-badge">STUDENT PRO</div>
            <h1>🎓 Grade Calculator</h1>
            <p class="vip-subtitle">GPA Calculator • Final Grade • Weighted Average • Grade Predictor</p>
            
            <div class="vip-features">
                <div class="feature">
                    <span class="feature-icon">⚡</span>
                    <span>Instant Calculations</span>
                </div>
                <div class="feature">
                    <span class="feature-icon">🎯</span>
                    <span>Multiple Grading Systems</span>
                </div>
                <div class="feature">
                    <span class="feature-icon">🔒</span>
                    <span>100% Private</span>
                </div>
            </div>
        </div>

        <!-- Calculator Tabs -->
        <div class="tabs-container">
            <div class="tabs">
                <button class="tab-button active" data-tab="final-grade">Final Grade Calculator</button>
                <button class="tab-button" data-tab="gpa-calculator">GPA Calculator</button>
                <button class="tab-button" data-tab="grade-needed">Grade Needed</button>
                <button class="tab-button" data-tab="weighted-average">Weighted Average</button>
            </div>

            <!-- Final Grade Calculator Tab -->
            <div class="tab-content active" id="final-grade">
                <div class="calculator-card">
                    <h3>Final Grade Calculator</h3>
                    <p class="tab-description">Calculate what final grade you need to reach your target overall grade</p>
                    
                    <form id="finalGradeForm">
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="currentGrade">Current Grade (%)</label>
                                <input type="number" id="currentGrade" min="0" max="100" step="0.1" placeholder="Enter current grade" required>
                            </div>
                            <div class="form-group">
                                <label for="targetGrade">Target Grade (%)</label>
                                <input type="number" id="targetGrade" min="0" max="100" step="0.1" placeholder="Enter target grade" required>
                            </div>
                            <div class="form-group">
                                <label for="finalWeight">Final Exam Weight (%)</label>
                                <input type="number" id="finalWeight" min="1" max="100" step="0.1" placeholder="Enter final weight" required>
                            </div>
                        </div>
                        <button type="submit" class="calculate-btn">Calculate Final Grade Needed</button>
                    </form>

                    <div id="finalGradeResult" class="results-card" style="display: none;">
                        <h4>📊 Results</h4>
                        <div class="result-grid">
                            <div class="result-item">
                                <span class="result-label">Final Exam Needed</span>
                                <span class="result-value" id="finalNeeded">-</span>
                            </div>
                            <div class="result-item">
                                <span class="result-label">Current Situation</span>
                                <span class="result-value" id="currentSituation">-</span>
                            </div>
                        </div>
                        <div class="grade-breakdown">
                            <h5>Grade Breakdown:</h5>
                            <div class="breakdown-bar">
                                <div class="breakdown-segment current-grade" id="currentGradeBar"></div>
                                <div class="breakdown-segment final-needed" id="finalGradeBar"></div>
                            </div>
                            <div class="breakdown-labels">
                                <span>Current: <span id="currentGradeLabel">-</span></span>
                                <span>Final Needed: <span id="finalNeededLabel">-</span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- GPA Calculator Tab -->
            <div class="tab-content" id="gpa-calculator">
                <div class="calculator-card">
                    <h3>GPA Calculator</h3>
                    <p class="tab-description">Calculate your Grade Point Average on 4.0 scale</p>
                    
                    <div class="courses-container">
                        <div id="coursesList">
                            <div class="course-row">
                                <input type="text" class="course-name" placeholder="Course Name" value="Mathematics">
                                <select class="course-grade">
                                    <option value="4.0">A (90-100%)</option>
                                    <option value="3.7">A- (85-89%)</option>
                                    <option value="3.3">B+ (80-84%)</option>
                                    <option value="3.0">B (75-79%)</option>
                                    <option value="2.7">B- (70-74%)</option>
                                    <option value="2.3">C+ (65-69%)</option>
                                    <option value="2.0">C (60-64%)</option>
                                    <option value="1.7">C- (55-59%)</option>
                                    <option value="1.3">D+ (50-54%)</option>
                                    <option value="1.0">D (40-49%)</option>
                                    <option value="0.0">F (0-39%)</option>
                                </select>
                                <select class="course-credits">
                                    <option value="1">1 Credit</option>
                                    <option value="2">2 Credits</option>
                                    <option value="3" selected>3 Credits</option>
                                    <option value="4">4 Credits</option>
                                    <option value="5">5 Credits</option>
                                </select>
                                <button class="remove-course">🗑️</button>
                            </div>
                        </div>
                        <button type="button" id="addCourse" class="add-course-btn">+ Add Another Course</button>
                    </div>
                    
                    <button id="calculateGPA" class="calculate-btn">Calculate GPA</button>

                    <div id="gpaResult" class="results-card" style="display: none;">
                        <h4>🎓 GPA Results</h4>
                        <div class="result-grid">
                            <div class="result-item">
                                <span class="result-label">Your GPA</span>
                                <span class="result-value" id="gpaValue">-</span>
                            </div>
                            <div class="result-item">
                                <span class="result-label">Total Credits</span>
                                <span class="result-value" id="totalCredits">-</span>
                            </div>
                            <div class="result-item">
                                <span class="result-label">Grade Points</span>
                                <span class="result-value" id="totalPoints">-</span>
                            </div>
                            <div class="result-item">
                                <span class="result-label">Academic Standing</span>
                                <span class="result-value" id="academicStanding">-</span>
                            </div>
                        </div>
                        
                        <div class="gpa-scale">
                            <h5>GPA Scale:</h5>
                            <div class="scale-bar">
                                <div class="scale-marker" id="gpaMarker"></div>
                            </div>
                            <div class="scale-labels">
                                <span>0.0</span>
                                <span>1.0</span>
                                <span>2.0</span>
                                <span>3.0</span>
                                <span>4.0</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Grade Needed Calculator Tab -->
            <div class="tab-content" id="grade-needed">
                <div class="calculator-card">
                    <h3>Grade Needed Calculator</h3>
                    <p class="tab-description">Calculate what grade you need on remaining assignments to reach your target</p>
                    
                    <form id="gradeNeededForm">
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="currentAverage">Current Average (%)</label>
                                <input type="number" id="currentAverage" min="0" max="100" step="0.1" placeholder="Enter current average" required>
                            </div>
                            <div class="form-group">
                                <label for="targetAverage">Target Average (%)</label>
                                <input type="number" id="targetAverage" min="0" max="100" step="0.1" placeholder="Enter target average" required>
                            </div>
                            <div class="form-group">
                                <label for="remainingWeight">Remaining Weight (%)</label>
                                <input type="number" id="remainingWeight" min="1" max="100" step="0.1" placeholder="Enter remaining weight" required>
                            </div>
                        </div>
                        <button type="submit" class="calculate-btn">Calculate Grade Needed</button>
                    </form>

                    <div id="gradeNeededResult" class="results-card" style="display: none;">
                        <h4>📈 Results</h4>
                        <div class="result-grid">
                            <div class="result-item">
                                <span class="result-label">Grade Needed</span>
                                <span class="result-value" id="gradeNeeded">-</span>
                            </div>
                            <div class="result-item">
                                <span class="result-label">Current Status</span>
                                <span class="result-value" id="currentStatus">-</span>
                            </div>
                        </div>
                        <div class="progress-container">
                            <div class="progress-bar">
                                <div class="progress-fill current-progress" id="currentProgress"></div>
                                <div class="progress-fill needed-progress" id="neededProgress"></div>
                            </div>
                            <div class="progress-labels">
                                <span>Current: <span id="currentProgressLabel">-</span></span>
                                <span>Needed: <span id="neededProgressLabel">-</span></span>
                                <span>Target: <span id="targetProgressLabel">-</span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Weighted Average Tab -->
            <div class="tab-content" id="weighted-average">
                <div class="calculator-card">
                    <h3>Weighted Average Calculator</h3>
                    <p class="tab-description">Calculate weighted average for multiple assignments with different weights</p>
                    
                    <div class="assignments-container">
                        <div id="assignmentsList">
                            <div class="assignment-row">
                                <input type="text" class="assignment-name" placeholder="Assignment Name" value="Midterm Exam">
                                <input type="number" class="assignment-grade" min="0" max="100" step="0.1" placeholder="Grade %" value="85">
                                <input type="number" class="assignment-weight" min="1" max="100" step="0.1" placeholder="Weight %" value="30">
                                <button class="remove-assignment">🗑️</button>
                            </div>
                        </div>
                        <button type="button" id="addAssignment" class="add-course-btn">+ Add Another Assignment</button>
                    </div>
                    
                    <button id="calculateWeighted" class="calculate-btn">Calculate Weighted Average</button>

                    <div id="weightedResult" class="results-card" style="display: none;">
                        <h4>⚖️ Weighted Average Results</h4>
                        <div class="result-grid">
                            <div class="result-item">
                                <span class="result-label">Weighted Average</span>
                                <span class="result-value" id="weightedAverage">-</span>
                            </div>
                            <div class="result-item">
                                <span class="result-label">Total Weight</span>
                                <span class="result-value" id="totalWeight">-</span>
                            </div>
                            <div class="result-item">
                                <span class="result-label">Simple Average</span>
                                <span class="result-value" id="simpleAverage">-</span>
                            </div>
                        </div>
                        
                        <div class="assignments-breakdown">
                            <h5>Assignment Breakdown:</h5>
                            <div id="assignmentsBreakdown" class="breakdown-list"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Information Section -->
        <div class="info-grid">
            <div class="info-card">
                <h3>📊 Understanding Grades</h3>
                <div class="grade-scale">
                    <h4>Percentage to GPA Scale:</h4>
                    <div class="scale-item">
                        <span class="grade-letter">A</span>
                        <span class="grade-range">90-100%</span>
                        <span class="grade-points">4.0</span>
                    </div>
                    <div class="scale-item">
                        <span class="grade-letter">B</span>
                        <span class="grade-range">80-89%</span>
                        <span class="grade-points">3.0</span>
                    </div>
                    <div class="scale-item">
                        <span class="grade-letter">C</span>
                        <span class="grade-range">70-79%</span>
                        <span class="grade-points">2.0</span>
                    </div>
                    <div class="scale-item">
                        <span class="grade-letter">D</span>
                        <span class="grade-range">60-69%</span>
                        <span class="grade-points">1.0</span>
                    </div>
                    <div class="scale-item">
                        <span class="grade-letter">F</span>
                        <span class="grade-range">0-59%</span>
                        <span class="grade-points">0.0</span>
                    </div>
                </div>
            </div>

            <div class="info-card">
                <h3>🎯 Study Tips</h3>
                <ul>
                    <li>Start studying early for finals</li>
                    <li>Create a study schedule and stick to it</li>
                    <li>Focus on understanding concepts, not memorization</li>
                    <li>Take regular breaks during study sessions</li>
                    <li>Practice with past papers and sample questions</li>
                    <li>Form study groups for difficult subjects</li>
                    <li>Get enough sleep before exams</li>
                </ul>
            </div>

            <div class="info-card">
                <h3>📚 Calculator Types</h3>
                <ul>
                    <li><strong>Final Grade:</strong> What you need on your final exam</li>
                    <li><strong>GPA Calculator:</strong> Calculate semester GPA</li>
                    <li><strong>Grade Needed:</strong> Required grades on remaining work</li>
                    <li><strong>Weighted Average:</strong> Average with different weights</li>
                </ul>
            </div>

            <div class="info-card">
                <h3>💡 Success Strategies</h3>
                <ul>
                    <li>Set realistic grade targets</li>
                    <li>Track your progress throughout the semester</li>
                    <li>Seek help from professors during office hours</li>
                    <li>Use campus tutoring resources</li>
                    <li>Balance academic work with self-care</li>
                    <li>Celebrate small achievements along the way</li>
                </ul>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>