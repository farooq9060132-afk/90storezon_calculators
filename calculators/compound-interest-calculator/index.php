<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compound Interest Calculator Online - Investment Growth 2024</title>
    <meta name="description" content="Online compound interest calculator tool. Calculate your investment growth with compound interest. See how your money can grow over time. No registration required!">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="vip-container">
        <header class="vip-header">
            <h1><i class="fas fa-chart-line"></i> Compound Interest Calculator</h1>
            <p>Calculate your investment growth with compound interest</p>
        </header>

        <!-- Google Ads Slot -->
        <div class="ad-slot top-ad">
            [AD_TOP_BANNER]
        </div>

        <div class="calculator-container">
            <div class="input-row">
                <div class="input-group">
                    <label for="principal"><i class="fas fa-money-bill-wave"></i> Principal Amount ($)</label>
                    <input type="number" id="principal" placeholder="Enter initial amount" min="0" value="1000">
                </div>

                <div class="input-group">
                    <label for="monthlyContribution"><i class="fas fa-plus-circle"></i> Monthly Contribution ($)</label>
                    <input type="number" id="monthlyContribution" placeholder="Monthly addition" min="0" value="100">
                </div>
            </div>

            <div class="input-row">
                <div class="input-group">
                    <label for="interestRate"><i class="fas fa-percentage"></i> Annual Interest Rate (%)</label>
                    <input type="number" id="interestRate" placeholder="Enter interest rate" min="0" step="0.01" value="7">
                </div>

                <div class="input-group">
                    <label for="years"><i class="fas fa-calendar-alt"></i> Time Period (Years)</label>
                    <input type="number" id="years" placeholder="Enter years" min="1" value="10">
                </div>
            </div>

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

            <button class="calculate-btn" onclick="calculateCompoundInterest()">
                <i class="fas fa-calculator"></i> Calculate Growth
            </button>

            <!-- Google Ads Slot -->
            <div class="ad-slot middle-ad">
                [AD_MIDDLE_BANNER]
            </div>

            <div class="result-container" id="resultContainer">
                <h3><i class="fas fa-rocket"></i> Investment Growth Results</h3>
                
                <div class="results-grid">
                    <div class="result-item main-result">
                        <span>Future Value</span>
                        <strong id="futureValue">$0</strong>
                    </div>
                    <div class="result-item">
                        <span>Total Contributions</span>
                        <span id="totalContributions">$0</span>
                    </div>
                    <div class="result-item">
                        <span>Interest Earned</span>
                        <span id="interestEarned">$0</span>
                    </div>
                    <div class="result-item">
                        <span>ROI</span>
                        <span id="roi">0%</span>
                    </div>
                </div>

                <div class="growth-chart">
                    <h4><i class="fas fa-chart-bar"></i> Growth Over Time</h4>
                    <div class="chart-container">
                        <canvas id="growthChart"></canvas>
                    </div>
                </div>

                <div class="yearly-breakdown">
                    <h4><i class="fas fa-table"></i> Yearly Breakdown</h4>
                    <div class="table-container" id="yearlyTable">
                        <!-- Yearly breakdown will be loaded here -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Google Ads Slot -->
        <div class="ad-slot bottom-ad">
            [AD_BOTTOM_BANNER]
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="script.js"></script>
</body>
</html>