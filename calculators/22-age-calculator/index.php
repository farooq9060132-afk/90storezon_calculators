<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Age Calculator - Calculate Your Exact Age in Seconds</title>
    <meta name="description" content="Calculate your exact age in years, months, weeks, days, hours, minutes and seconds. Online age calculator with beautiful design. Works on mobile and desktop.">
    <meta name="keywords" content="age calculator, birthday calculator, age in seconds, how old am I, date calculator, time calculator">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <!-- Header Section -->
        <header class="calculator-header">
            <div class="header-content">
                <div class="header-icon">
                    <i class="fas fa-birthday-cake"></i>
                </div>
                <div class="header-text">
                    <h1>Age Calculator</h1>
                    <p>Discover your exact age down to the second!</p>
                </div>
            </div>
        </header>

        <!-- Calculator Card -->
        <main class="calculator-card">
            <!-- Description -->
            <div class="calculator-description">
                <p>Your Birth Date</p>
            </div>

            <!-- Calculator Form -->
            <form id="ageCalculatorForm" class="calculator-form">
                <!-- Date Inputs -->
                <div class="date-inputs">
                    <div class="input-group">
                        <div class="input-wrapper">
                            <input type="date" id="birthDate" class="date-input" required>
                            <button type="button" class="calendar-btn" onclick="document.getElementById('birthDate').showPicker?.() || document.getElementById('birthDate').focus()">
                                <i class="fas fa-calendar"></i>
                            </button>
                        </div>
                    </div>

                    <div class="calculator-description">
                        <p>Calculate Age As Of (Optional)</p>
                    </div>

                    <div class="input-group">
                        <div class="input-wrapper">
                            <input type="date" id="calculationDate" class="date-input" required>
                            <button type="button" class="calendar-btn" onclick="document.getElementById('calculationDate').showPicker?.() || document.getElementById('calculationDate').focus()">
                                <i class="fas fa-calendar"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Calculate Button -->
                <button type="button" id="calculateButton" class="calculate-btn">
                    <i class="fas fa-calculator"></i>
                    Calculate My Age
                </button>
            </form>

            <!-- Results Section -->
            <div id="results" class="results-section" style="display: none;">
                <div class="age-display">
                    <div class="age-main">
                        <span id="years">--</span> Years 
                        <span id="months">--</span> Months 
                        <span id="days">--</span> Days
                    </div>
                    <div class="age-breakdown">
                        or <span id="totalMonths">--</span> months <span id="extraDays">--</span> days
                    </div>
                    <div class="age-breakdown">
                        or <span id="totalWeeks">--</span> weeks <span id="extraDays2">--</span> days
                    </div>
                    <div class="age-breakdown">
                        or <span id="totalDays">--</span> days
                    </div>
                    <div class="age-breakdown">
                        or <span id="totalHours">--</span> hours
                    </div>
                    <div class="age-breakdown">
                        or <span id="totalMinutes">--</span> minutes
                    </div>
                    <div class="age-breakdown">
                        or <span id="totalSeconds">--</span> seconds
                    </div>
                </div>
            </div>

            <!-- Loading Spinner -->
            <div id="loading" class="loading-spinner" style="display: none;">
                <div class="spinner"></div>
                <p>Calculating your age...</p>
            </div>
        </main>

        <!-- Features Section -->
        <section class="features-section">
            <h2>Why Use Our Age Calculator?</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <h3>Lightning Fast</h3>
                    <p>Get instant results with our optimized calculation engine</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3>100% Secure</h3>
                    <p>Your data never leaves your browser - complete privacy</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <h3>Mobile Friendly</h3>
                    <p>Works perfectly on all devices and screen sizes</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                    <h3>Detailed Analysis</h3>
                    <p>Comprehensive breakdown with fun facts and insights</p>
                </div>
            </div>
        </section>
    </div>

    <script src="script.js"></script>
    <script>
        // Ensure the button click handler is properly attached
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('calculateButton').addEventListener('click', function() {
                calculateAge();
            });
        });
    </script>
</body>
</html>