<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>13-Budget Planner - Take Control of Your Finances</title>
    <meta name="description" content="Budget planner to track income, expenses, and savings. Create a personalized budget in minutes.">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>13-Budget Planner</h1>
            <p>Take control of your finances with our easy-to-use budgeting tool</p>
        </div>
    </header>

    <main class="container">
        <section class="intro">
            <h2>Create Your Personal Budget in Minutes</h2>
            <p>Track your income, expenses, and savings goals with our comprehensive budget planner. No registration required - completely free!</p>
        </section>

        <div class="budget-planner">
            <div class="input-section">
                <h3>Income & Expenses</h3>
                
                <div class="income-section">
                    <h4>Monthly Income</h4>
                    <div class="input-group">
                        <label for="salary">Salary/Wages</label>
                        <input type="number" id="salary" placeholder="0">
                    </div>
                    <div class="input-group">
                        <label for="other-income">Other Income</label>
                        <input type="number" id="other-income" placeholder="0">
                    </div>
                    <button id="add-income" class="btn-secondary">+ Add Income Source</button>
                </div>

                <div class="expenses-section">
                    <h4>Monthly Expenses</h4>
                    <div class="expense-category">
                        <h5>Housing</h5>
                        <div class="input-group">
                            <label for="rent">Rent/Mortgage</label>
                            <input type="number" id="rent" placeholder="0">
                        </div>
                        <div class="input-group">
                            <label for="utilities">Utilities</label>
                            <input type="number" id="utilities" placeholder="0">
                        </div>
                    </div>

                    <div class="expense-category">
                        <h5>Transportation</h5>
                        <div class="input-group">
                            <label for="car-payment">Car Payment</label>
                            <input type="number" id="car-payment" placeholder="0">
                        </div>
                        <div class="input-group">
                            <label for="gas">Gas/Fuel</label>
                            <input type="number" id="gas" placeholder="0">
                        </div>
                    </div>

                    <div class="expense-category">
                        <h5>Living Expenses</h5>
                        <div class="input-group">
                            <label for="groceries">Groceries</label>
                            <input type="number" id="groceries" placeholder="0">
                        </div>
                        <div class="input-group">
                            <label for="dining">Dining Out</label>
                            <input type="number" id="dining" placeholder="0">
                        </div>
                    </div>

                    <div class="expense-category">
                        <h5>Entertainment & Personal</h5>
                        <div class="input-group">
                            <label for="entertainment">Entertainment</label>
                            <input type="number" id="entertainment" placeholder="0">
                        </div>
                        <div class="input-group">
                            <label for="personal-care">Personal Care</label>
                            <input type="number" id="personal-care" placeholder="0">
                        </div>
                    </div>

                    <button id="add-expense" class="btn-secondary">+ Add Expense Category</button>
                </div>

                <div class="savings-section">
                    <h4>Savings Goals</h4>
                    <div class="input-group">
                        <label for="emergency-fund">Emergency Fund</label>
                        <input type="number" id="emergency-fund" placeholder="0">
                    </div>
                    <div class="input-group">
                        <label for="retirement">Retirement</label>
                        <input type="number" id="retirement" placeholder="0">
                    </div>
                </div>

                <button id="calculate" class="btn-primary">Calculate My Budget</button>
            </div>

            <div class="results-section">
                <h3>Your Budget Summary</h3>
                <div class="summary-cards">
                    <div class="card total-income">
                        <h4>Total Income</h4>
                        <p id="total-income">$0</p>
                    </div>
                    <div class="card total-expenses">
                        <h4>Total Expenses</h4>
                        <p id="total-expenses">$0</p>
                    </div>
                    <div class="card net-income">
                        <h4>Net Income</h4>
                        <p id="net-income">$0</p>
                    </div>
                </div>

                <div class="budget-breakdown">
                    <h4>Budget Breakdown</h4>
                    <div class="breakdown-chart">
                        <canvas id="budget-chart"></canvas>
                    </div>
                </div>

                <div class="savings-goals">
                    <h4>Savings Progress</h4>
                    <div class="progress-bars">
                        <div class="progress-item">
                            <label>Emergency Fund</label>
                            <div class="progress-bar">
                                <div class="progress-fill" id="emergency-progress"></div>
                            </div>
                            <span id="emergency-percent">0%</span>
                        </div>
                        <div class="progress-item">
                            <label>Retirement</label>
                            <div class="progress-bar">
                                <div class="progress-fill" id="retirement-progress"></div>
                            </div>
                            <span id="retirement-percent">0%</span>
                        </div>
                    </div>
                </div>

                <div class="budget-tips">
                    <h4>Budgeting Tips</h4>
                    <ul>
                        <li>Try the 50/30/20 rule: 50% needs, 30% wants, 20% savings</li>
                        <li>Review your budget monthly and adjust as needed</li>
                        <li>Build an emergency fund covering 3-6 months of expenses</li>
                        <li>Automate your savings to make it effortless</li>
                    </ul>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2023 13-Free Budget Planner. All rights reserved.</p>
            <p>This tool is provided for educational purposes only. Consult a financial advisor for personalized advice.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="script.js"></script>
</body>
</html>