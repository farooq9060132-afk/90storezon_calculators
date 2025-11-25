<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Retirement Planner Online - Retirement Calculator 2024</title>
    <meta name="description" content="Online retirement planner tool. Calculate your retirement savings needs, investment growth, and monthly income. Plan your perfect retirement. No registration required!">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="vip-container">
        <header class="vip-header">
            <h1><i class="fas fa-umbrella-beach"></i> Retirement Planner</h1>
            <p>Plan your perfect retirement</p>
        </header>

        <!-- Google Ads Slot -->
        <div class="ad-slot top-ad">
            [AD_TOP_BANNER]
        </div>

        <div class="calculator-container">
            <div class="input-section">
                <h3><i class="fas fa-user"></i> Personal Information</h3>
                <div class="input-row">
                    <div class="input-group">
                        <label for="currentAge"><i class="fas fa-birthday-cake"></i> Current Age</label>
                        <input type="number" id="currentAge" placeholder="Your current age" min="18" max="65" value="35">
                    </div>

                    <div class="input-group">
                        <label for="retirementAge"><i class="fas fa-calendar-alt"></i> Retirement Age</label>
                        <input type="number" id="retirementAge" placeholder="Planned retirement age" min="55" max="75" value="65">
                    </div>
                </div>

                <div class="input-row">
                    <div class="input-group">
                        <label for="lifeExpectancy"><i class="fas fa-heart"></i> Life Expectancy</label>
                        <input type="number" id="lifeExpectancy" placeholder="Expected lifespan" min="75" max="100" value="85">
                    </div>

                    <div class="input-group">
                        <label for="annualIncome"><i class="fas fa-money-bill-wave"></i> Current Annual Income ($)</label>
                        <input type="number" id="annualIncome" placeholder="Your current income" min="0" value="75000">
                    </div>
                </div>
            </div>

            <div class="input-section">
                <h3><i class="fas fa-piggy-bank"></i> Current Savings & Investments</h3>
                <div class="input-row">
                    <div class="input-group">
                        <label for="currentSavings"><i class="fas fa-wallet"></i> Current Retirement Savings ($)</label>
                        <input type="number" id="currentSavings" placeholder="Existing savings" min="0" value="100000">
                    </div>

                    <div class="input-group">
                        <label for="monthlyContribution"><i class="fas fa-plus-circle"></i> Monthly Contribution ($)</label>
                        <input type="number" id="monthlyContribution" placeholder="Monthly savings" min="0" value="1000">
                    </div>
                </div>

                <div class="input-row">
                    <div class="input-group">
                        <label for="employerMatch"><i class="fas fa-building"></i> Employer Match (%)</label>
                        <input type="number" id="employerMatch" placeholder="Employer contribution" min="0" max="100" step="0.1" value="5">
                    </div>

                    <div class="input-group">
                        <label for="employerMatchLimit"><i class="fas fa-chart-line"></i> Match Limit (% of Salary)</label>
                        <input type="number" id="employerMatchLimit" placeholder="Match limit percentage" min="0" max="100" step="0.1" value="6">
                    </div>
                </div>
            </div>

            <div class="input-section">
                <h3><i class="fas fa-chart-line"></i> Investment & Retirement Goals</h3>
                <div class="input-row">
                    <div class="input-group">
                        <label for="expectedReturn"><i class="fas fa-percentage"></i> Expected Annual Return (%)</label>
                        <input type="number" id="expectedReturn" placeholder="Investment return rate" min="1" max="20" step="0.1" value="7">
                    </div>

                    <div class="input-group">
                        <label for="inflationRate"><i class="fas fa-chart-bar"></i> Expected Inflation Rate (%)</label>
                        <input type="number" id="inflationRate" placeholder="Annual inflation" min="0" max="10" step="0.1" value="2.5">
                    </div>
                </div>

                <div class="input-row">
                    <div class="input-group">
                        <label for="incomeReplacement"><i class="fas fa-exchange-alt"></i> Income Replacement (%)</label>
                        <input type="number" id="incomeReplacement" placeholder="% of income needed" min="50" max="100" value="80">
                    </div>

                    <div class="input-group">
                        <label for="socialSecurity"><i class="fas fa-shield-alt"></i> Expected Social Security ($/month)</label>
                        <input type="number" id="socialSecurity" placeholder="Monthly social security" min="0" value="2000">
                    </div>
                </div>
            </div>

            <button class="calculate-btn" onclick="calculateRetirement()">
                <i class="fas fa-calculator"></i> Calculate Retirement Plan
            </button>

            <!-- Google Ads Slot -->
            <div class="ad-slot middle-ad">
                [AD_MIDDLE_BANNER]
            </div>

            <div class="result-container" id="resultContainer">
                <h3><i class="fas fa-trophy"></i> Your Retirement Plan</h3>
                
                <div class="summary-cards">
                    <div class="summary-card total">
                        <div class="card-icon">
                            <i class="fas fa-bullseye"></i>
                        </div>
                        <div class="card-content">
                            <div class="card-label">Retirement Goal</div>
                            <div class="card-value" id="retirementGoal">$0</div>
                        </div>
                    </div>

                    <div class="summary-card projected">
                        <div class="card-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="card-content">
                            <div class="card-label">Projected Savings</div>
                            <div class="card-value" id="projectedSavings">$0</div>
                        </div>
                    </div>

                    <div class="summary-card gap">
                        <div class="card-icon">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div class="card-content">
                            <div class="card-label">Savings Gap</div>
                            <div class="card-value" id="savingsGap">$0</div>
                        </div>
                    </div>

                    <div class="summary-card monthly">
                        <div class="card-icon">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <div class="card-content">
                            <div class="card-label">Monthly Retirement Income</div>
                            <div class="card-value" id="monthlyIncome">$0</div>
                        </div>
                    </div>
                </div>

                <div class="progress-section">
                    <h4><i class="fas fa-tasks"></i> Progress Towards Goal</h4>
                    <div class="progress-bar">
                        <div class="progress-fill" id="progressFill"></div>
                    </div>
                    <div class="progress-text" id="progressText">0% of goal achieved</div>
                </div>

                <div class="timeline-section">
                    <h4><i class="fas fa-history"></i> Savings Timeline</h4>
                    <div class="timeline-chart" id="timelineChart">
                        <!-- Timeline chart will be generated here -->
                    </div>
                </div>

                <div class="recommendations-section">
                    <h4><i class="fas fa-lightbulb"></i> Recommendations</h4>
                    <div class="recommendations-grid" id="recommendationsGrid">
                        <!-- Recommendations will be generated here -->
                    </div>
                </div>

                <div class="withdrawal-strategy">
                    <h4><i class="fas fa-money-check-alt"></i> Withdrawal Strategy</h4>
                    <div class="strategy-grid">
                        <div class="strategy-item">
                            <span>Safe Withdrawal Rate:</span>
                            <strong>4% per year</strong>
                        </div>
                        <div class="strategy-item">
                            <span>Annual Withdrawal:</span>
                            <strong id="annualWithdrawal">$0</strong>
                        </div>
                        <div class="strategy-item">
                            <span>Portfolio Duration:</span>
                            <strong id="portfolioDuration">0 years</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Google Ads Slot -->
        <div class="ad-slot bottom-ad">
            [AD_BOTTOM_BANNER]
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>