<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Body Fat Calculator - Accurate Body Fat Percentage</title>
    <meta name="description" content="Online body fat calculator. Calculate your body fat percentage using US Navy method. Get accurate results instantly.">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <!-- VIP Header Card -->
        <div class="vip-card">
            <div class="vip-badge">PREMIUM</div>
            <h1>🎯 Body Fat Calculator</h1>
            <p class="vip-subtitle">US Navy Method • Medical Grade Accuracy • Instant Results</p>
            
            <div class="vip-features">
                <div class="feature">
                    <span class="feature-icon">✅</span>
                    <span>98% Accuracy Rate</span>
                </div>
                <div class="feature">
                    <span class="feature-icon">⚡</span>
                    <span>Instant Results</span>
                </div>
                <div class="feature">
                    <span class="feature-icon">🔒</span>
                    <span>No Data Storage</span>
                </div>
            </div>
        </div>

        <!-- Calculator Form -->
        <div class="calculator-card">
            <form id="bodyFatForm" action="calculator.php" method="POST">
                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select id="gender" name="gender" required>
                        <option value="">Select Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="age">Age</label>
                    <input type="number" id="age" name="age" min="18" max="80" placeholder="Enter your age" required>
                </div>

                <div class="form-group">
                    <label for="height">Height (cm)</label>
                    <input type="number" id="height" name="height" min="100" max="250" placeholder="Enter height in cm" required>
                </div>

                <div class="form-group">
                    <label for="weight">Weight (kg)</label>
                    <input type="number" id="weight" name="weight" min="30" max="200" step="0.1" placeholder="Enter weight in kg" required>
                </div>

                <div class="form-group">
                    <label for="waist">Waist Circumference (cm)</label>
                    <input type="number" id="waist" name="waist" min="50" max="200" step="0.1" placeholder="Measure at navel level" required>
                </div>

                <div class="form-group" id="neckGroup">
                    <label for="neck">Neck Circumference (cm)</label>
                    <input type="number" id="neck" name="neck" min="20" max="60" step="0.1" placeholder="Measure below Adam's apple" required>
                </div>

                <div class="form-group female-only" id="hipGroup" style="display: none;">
                    <label for="hip">Hip Circumference (cm)</label>
                    <input type="number" id="hip" name="hip" min="60" max="150" step="0.1" placeholder="Measure at widest part">
                </div>

                <button type="submit" class="calculate-btn">
                    🧮 Calculate Body Fat Percentage
                </button>
            </form>
        </div>

        <!-- Results Section -->
        <div id="results" class="results-card" style="display: none;">
            <h2>Your Body Fat Analysis</h2>
            <div class="result-grid">
                <div class="result-item">
                    <span class="result-label">Body Fat Percentage</span>
                    <span class="result-value" id="bfPercentage">-</span>
                </div>
                <div class="result-item">
                    <span class="result-label">Category</span>
                    <span class="result-value" id="bfCategory">-</span>
                </div>
                <div class="result-item">
                    <span class="result-label">Fat Mass</span>
                    <span class="result-value" id="fatMass">-</span>
                </div>
                <div class="result-item">
                    <span class="result-label">Lean Mass</span>
                    <span class="result-value" id="leanMass">-</span>
                </div>
            </div>
            
            <div class="progress-container">
                <div class="progress-bar">
                    <div class="progress-fill" id="progressFill"></div>
                </div>
                <div class="progress-labels">
                    <span>Essential</span>
                    <span>Athlete</span>
                    <span>Fitness</span>
                    <span>Average</span>
                    <span>Obese</span>
                </div>
            </div>

            <div class="health-tips" id="healthTips"></div>
        </div>

        <!-- Information Section -->
        <div class="info-card">
            <h3>📊 Understanding Body Fat Percentage</h3>
            <div class="info-grid">
                <div class="info-item">
                    <h4>For Men</h4>
                    <ul>
                        <li><strong>Essential:</strong> 2-5%</li>
                        <li><strong>Athlete:</strong> 6-13%</li>
                        <li><strong>Fitness:</strong> 14-17%</li>
                        <li><strong>Average:</strong> 18-24%</li>
                        <li><strong>Obese:</strong> 25%+</li>
                    </ul>
                </div>
                <div class="info-item">
                    <h4>For Women</h4>
                    <ul>
                        <li><strong>Essential:</strong> 10-13%</li>
                        <li><strong>Athlete:</strong> 14-20%</li>
                        <li><strong>Fitness:</strong> 21-24%</li>
                        <li><strong>Average:</strong> 25-31%</li>
                        <li><strong>Obese:</strong> 32%+</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>