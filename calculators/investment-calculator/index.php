<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Investment Calculator Online - ROI Calculator 2024</title>
    <meta name="description" content="Online investment calculator tool. Calculate investment returns, ROI, and growth projections. Plan your investment strategy. No registration required!">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="vip-container">
        <header class="vip-header">
            <h1><i class="fas fa-chart-line"></i> Investment Calculator</h1>
            <p>Calculate your investment returns and growth</p>
        </header>

        <!-- Google Ads Slot -->
        <div class="ad-slot top-ad">
            [AD_TOP_BANNER]
        </div>

        <div class="calculator-container">
            <div class="input-section">
                <h3><i class="fas fa-money-bill-wave"></i> Investment Details</h3>
                <div class="input-row">
                    <div class="input-group">
                        <label for="initialInvestment"><i class="fas fa-dollar-sign"></i> Initial Investment ($)</label>
                        <input type="number" id="initialInvestment" placeholder="Starting amount" min="0" value="10000">
                    </div>

                    <div class="input-group">
                        <label for="monthlyContribution"><i class="fas fa-plus-circle"></i> Monthly Contribution ($)</label>
                        <input type="number" id="monthlyContribution" placeholder="Monthly addition" min="0" value="500">
                    </div>
                </div>

                <div class="input-row">
                    <div class="input-group">
                        <label for="investmentPeriod"><i class="fas fa-calendar-alt"></i> Investment Period (Years)</label>
                        <input type="number" id="investmentPeriod" placeholder="Number of years" min="1" max="50" value="10">
                    </div>

                    <div class="input-group">
                        <label for="expectedReturn"><i class="fas fa-percentage"></i> Expected Annual Return (%)</label>
                        <input type="number" id="expectedReturn" placeholder="Expected return rate" min="1" max="50" step="0.1" value="8">
                    </div>
                </div>
            </div>

            <div class="input-section">
                <h3><i class="fas fa-cog"></i> Advanced Settings</h3>
                <div class="input-row">
                    <div class="input-group">
                        <label for="inflationRate"><i class="fas fa-chart-bar"></i> Inflation Rate (%)</label>
                        <input type="number" id="inflationRate" placeholder="Annual inflation" min="0" max="10" step="0.1" value="2.5">
                    </div>

                    <div class="input-group">
                        <label for="taxRate"><i class="fas fa-receipt"></i> Tax Rate (%)</label>
                        <input type="number" id="taxRate" placeholder="Investment tax rate" min="0" max="50" step="0.1" value="15">
                    </div>
                </div>

                <div class="input-row">
                    <div class="input-group">
                        <label for="compoundFrequency"><i class="fas fa-sync-alt"></i> Compound Frequency</label>
                        <select id="compoundFrequency">
                            <option value="1">Annually</option>
                            <option value="2">Semi-Annually</option>
                            <option value="4">Quarterly</option>
                            <option value="12" selected>Monthly</option>
                            <option value="365">Daily</option>
                        </select>
                    </div>

                    <div class="input-group">
                        <label for="investmentType"><i class="fas fa-chart-pie"></i> Investment Type</label>
                        <select id="investmentType">
                            <option value="stocks">Stocks</option>
                            <option value="bonds">Bonds</option>
                            <option value="realestate">Real Estate</option>
                            <option value="crypto">Cryptocurrency</option>
                            <option value="mutualfunds">Mutual Funds</option>
                            <option value="etf">ETF</option>
                        </select>
                    </div>
                </div>
            </div>

            <button class="calculate-btn" onclick="calculateInvestment()">
                <i class="fas fa-calculator"></i> Calculate Investment
            </button>

            <!-- Google Ads Slot -->
            <div class="ad-slot middle-ad">
                [AD_MIDDLE_BANNER]
            </div>

            <div class="result-container" id="resultContainer">
                <h3><i class="fas fa-rocket"></i> Investment Projection</h3>
                
                <div class="summary-cards">
                    <div class="summary-card total">
                        <div class="card-icon">
                            <i class="fas fa-bullseye"></i>
                        </div>
                        <div class="card-content">
                            <div class="card-label">Future Value</div>
                            <div class="card-value" id="futureValue">$0</div>
                        </div>
                    </div>

                    <div class="summary-card contributions">
                        <div class="card-icon">
                            <i class="fas fa-hand-holding-usd"></i>
                        </div>
                        <div class="card-content">
                            <div class="card-label">Total Contributions</div>
                            <div class="card-value" id="totalContributions">$0</div>
                        </div>
                    </div>

                    <div class="summary-card interest">
                        <div class="card-icon">
                            <i class="fas fa-coins"></i>
                        </div>
                        <div class="card-content">
                            <div class="card-label">Interest Earned</div>
                            <div class="card-value" id="interestEarned">$0</div>
                        </div>
                    </div>

                    <div class="summary-card roi">
                        <div class="card-icon">
                            <i class="fas fa-percentage"></i>
                        </div>
                        <div class="card-content">
                            <div class="card-label">ROI</div>
                            <div class="card-value" id="roiPercentage">0%</div>
                        </div>
                    </div>
                </div>

                <div class="growth-chart-section">
                    <h4><i class="fas fa-chart-bar"></i> Growth Over Time</h4>
                    <div class="chart-container" id="growthChart">
                        <!-- Chart will be generated here -->
                    </div>
                </div>

                <div class="yearly-breakdown">
                    <h4><i class="fas fa-table"></i> Yearly Breakdown</h4>
                    <div class="breakdown-table" id="yearlyBreakdown">
                        <!-- Yearly data will be generated here -->
                    </div>
                </div>

                <div class="comparison-section">
                    <h4><i class="fas fa-balance-scale"></i> Comparison Scenarios</h4>
                    <div class="scenarios-grid">
                        <div class="scenario-item">
                            <span>No Additional Contributions:</span>
                            <strong id="scenarioNoContributions">$0</strong>
                        </div>
                        <div class="scenario-item">
                            <span>+$100 Monthly:</span>
                            <strong id="scenarioPlus100">$0</strong>
                        </div>
                        <div class="scenario-item">
                            <span>+1% Return:</span>
                            <strong id="scenarioPlus1Percent">$0</strong>
                        </div>
                        <div class="scenario-item">
                            <span>+2 Years:</span>
                            <strong id="scenarioPlus2Years">$0</strong>
                        </div>
                    </div>
                </div>

                <div class="investment-tips">
                    <h4><i class="fas fa-lightbulb"></i> Investment Tips</h4>
                    <div class="tips-grid">
                        <div class="tip-item">
                            <i class="fas fa-check-circle"></i>
                            <span>Start investing early for compound growth</span>
                        </div>
                        <div class="tip-item">
                            <i class="fas fa-check-circle"></i>
                            <span>Diversify your investment portfolio</span>
                        </div>
                        <div class="tip-item">
                            <i class="fas fa-check-circle"></i>
                            <span>Consider tax-advantaged accounts</span>
                        </div>
                        <div class="tip-item">
                            <i class="fas fa-check-circle"></i>
                            <span>Rebalance portfolio periodically</span>
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