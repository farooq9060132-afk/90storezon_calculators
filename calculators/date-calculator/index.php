<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Free Date Calculator | Add/Subtract Days, Weeks, Months from Date</title>
    <meta name="description" content="Free online date calculator. Add or subtract days, weeks, months, and years from any date. Calculate future and past dates easily.">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <header class="header">
            <h1><i class="fas fa-calendar-alt"></i> Date Calculator</h1>
            <p>Calculate future or past dates by adding/subtracting days, weeks, months, or years</p>
        </header>

        <main class="calculator-card">
            <form id="dateCalculatorForm" method="POST" action="calculator.php">
                <div class="input-section">
                    <div class="input-group">
                        <label for="start_date"><i class="fas fa-calendar-day"></i> Start Date</label>
                        <input type="date" id="start_date" name="start_date" required value="<?php echo date('Y-m-d'); ?>">
                    </div>

                    <div class="operation-section">
                        <div class="operation-toggle">
                            <button type="button" class="operation-btn active" data-operation="add">Add</button>
                            <button type="button" class="operation-btn" data-operation="subtract">Subtract</button>
                            <input type="hidden" id="operation" name="operation" value="add">
                        </div>

                        <div class="time-inputs">
                            <div class="time-input-group">
                                <label for="years">Years</label>
                                <input type="number" id="years" name="years" min="0" value="0">
                            </div>
                            <div class="time-input-group">
                                <label for="months">Months</label>
                                <input type="number" id="months" name="months" min="0" value="0">
                            </div>
                            <div class="time-input-group">
                                <label for="weeks">Weeks</label>
                                <input type="number" id="weeks" name="weeks" min="0" value="0">
                            </div>
                            <div class="time-input-group">
                                <label for="days">Days</label>
                                <input type="number" id="days" name="days" min="0" value="0">
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="calculate-btn">
                    <i class="fas fa-calculator"></i> Calculate Date
                </button>
            </form>

            <div id="results" class="results-section" style="display: none;">
                <!-- Results will be displayed here -->
            </div>
        </main>

        <section class="features-section">
            <h2>Powerful Date Calculation Features</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <i class="fas fa-plus-circle"></i>
                    <h3>Add Dates</h3>
                    <p>Calculate future dates by adding days, weeks, months, or years to any start date</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-minus-circle"></i>
                    <h3>Subtract Dates</h3>
                    <p>Find past dates by subtracting time periods from any given start date</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-business-time"></i>
                    <h3>Business Days</h3>
                    <p>Calculate business days excluding weekends for project planning</p>
                </div>
            </div>
        </section>

        <section class="examples-section">
            <h2>Common Use Cases</h2>
            <div class="examples-grid">
                <div class="example-card">
                    <h4>Project Deadlines</h4>
                    <p>"What date is 90 days from today?"</p>
                </div>
                <div class="example-card">
                    <h4>Age Calculations</h4>
                    <p>"What date was I 18 years ago?"</p>
                </div>
                <div class="example-card">
                    <h4>Event Planning</h4>
                    <p>"When should I start preparations 6 weeks before the event?"</p>
                </div>
                <div class="example-card">
                    <h4>Subscription Renewals</h4>
                    <p>"When does my 1-year subscription end?"</p>
                </div>
            </div>
        </section>
    </div>

    <script src="script.js"></script>
</body>
</html>