<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Free Age Difference Calculator | Calculate Age Gap Between Two People</title>
    <meta name="description" content="Free online age difference calculator. Calculate the exact age gap between two people in years, months, weeks, and days. Perfect for couples and relationships.">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <header class="header">
            <h1><i class="fas fa-heartbeat"></i> Age Difference Calculator</h1>
            <p>Calculate the exact age gap between two people in multiple time units</p>
        </header>

        <main class="calculator-card">
            <form id="ageCalculatorForm" method="POST" action="calculator.php">
                <div class="form-grid">
                    <div class="person-section">
                        <h3><i class="fas fa-user"></i> Person 1</h3>
                        <div class="input-group">
                            <label for="person1_name">Name (Optional)</label>
                            <input type="text" id="person1_name" name="person1_name" placeholder="Enter name">
                        </div>
                        <div class="input-group">
                            <label for="person1_dob">Date of Birth</label>
                            <input type="date" id="person1_dob" name="person1_dob" required>
                        </div>
                    </div>

                    <div class="person-section">
                        <h3><i class="fas fa-user"></i> Person 2</h3>
                        <div class="input-group">
                            <label for="person2_name">Name (Optional)</label>
                            <input type="text" id="person2_name" name="person2_name" placeholder="Enter name">
                        </div>
                        <div class="input-group">
                            <label for="person2_dob">Date of Birth</label>
                            <input type="date" id="person2_dob" name="person2_dob" required>
                        </div>
                    </div>
                </div>

                <button type="submit" class="calculate-btn">
                    <i class="fas fa-calculator"></i> Calculate Age Difference
                </button>
            </form>

            <div id="results" class="results-section" style="display: none;">
                <!-- Results will be displayed here -->
            </div>
        </main>

        <section class="features-section">
            <h2>Why Use Our Age Difference Calculator?</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <i class="fas fa-bolt"></i>
                    <h3>Instant Results</h3>
                    <p>Get immediate age difference calculations in years, months, weeks, and days</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-mobile-alt"></i>
                    <h3>Mobile Friendly</h3>
                    <p>Works perfectly on all devices - desktop, tablet, and mobile</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-shield-alt"></i>
                    <h3>Privacy Protected</h3>
                    <p>Your data is never stored or shared with third parties</p>
                </div>
            </div>
        </section>
    </div>

    <script src="script.js"></script>
</body>
</html>