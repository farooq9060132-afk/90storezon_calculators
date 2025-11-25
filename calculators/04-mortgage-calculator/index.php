<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mortgage Calculator Online - Calculate Home Loan Payments 2024</title>
    <meta name="description" content="Online mortgage calculator tool. Calculate your monthly home loan payments, interest, and amortization schedule. Perfect for home buyers. No registration required!">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="vip-container">
        <header class="vip-header">
            <h1><i class="fas fa-home"></i> Mortgage Calculator</h1>
            <p>Calculate your home loan payments instantly</p>
        </header>

        <!-- Google Ads Slot -->
        <div class="ad-slot top-ad">
            [AD_TOP_BANNER]
        </div>

        <div class="calculator-container">
            <div class="input-row">
                <div class="input-group">
                    <label for="homePrice"><i class="fas fa-dollar-sign"></i> Home Price ($)</label>
                    <input type="number" id="homePrice" placeholder="Enter home price" min="0">
                </div>

                <div class="input-group">
                    <label for="downPayment"><i class="fas fa-hand-holding-usd"></i> Down Payment ($)</label>
                    <input type="number" id="downPayment" placeholder="Enter down payment" min="0">
                </div>
            </div>

            <div class="input-row">
                <div class="input-group">
                    <label for="loanTerm"><i class="fas fa-calendar-alt"></i> Loan Term (Years)</label>
                    <select id="loanTerm">
                        <option value="15">15 Years</option>
                        <option value="20">20 Years</option>
                        <option value="25">25 Years</option>
                        <option value="30" selected>30 Years</option>
                    </select>
                </div>

                <div class="input-group">
                    <label for="interestRate"><i class="fas fa-percentage"></i> Interest Rate (%)</label>
                    <input type="number" id="interestRate" placeholder="Enter interest rate" min="0" step="0.01" value="4.5">
                </div>
            </div>

            <div class="input-group">
                <label for="propertyTax"><i class="fas fa-landmark"></i> Annual Property Tax ($)</label>
                <input type="number" id="propertyTax" placeholder="Enter annual tax" min="0" value="2400">
            </div>

            <div class="input-group">
                <label for="homeInsurance"><i class="fas fa-shield-alt"></i> Annual Home Insurance ($)</label>
                <input type="number" id="homeInsurance" placeholder="Enter insurance" min="0" value="1200">
            </div>

            <button class="calculate-btn" onclick="calculateMortgage()">
                <i class="fas fa-calculator"></i> Calculate Mortgage
            </button>

            <!-- Google Ads Slot -->
            <div class="ad-slot middle-ad">
                [AD_MIDDLE_BANNER]
            </div>

            <div class="result-container" id="resultContainer">
                <h3><i class="fas fa-chart-pie"></i> Mortgage Breakdown</h3>
                
                <div class="results-grid">
                    <div class="result-item">
                        <span>Monthly Payment</span>
                        <strong id="monthlyPayment">$0</strong>
                    </div>
                    <div class="result-item">
                        <span>Principal & Interest</span>
                        <span id="principalInterest">$0</span>
                    </div>
                    <div class="result-item">
                        <span>Property Tax</span>
                        <span id="monthlyTax">$0</span>
                    </div>
                    <div class="result-item">
                        <span>Home Insurance</span>
                        <span id="monthlyInsurance">$0</span>
                    </div>
                </div>

                <div class="summary-section">
                    <div class="summary-item">
                        <span>Total Loan Amount</span>
                        <strong id="totalLoan">$0</strong>
                    </div>
                    <div class="summary-item">
                        <span>Down Payment</span>
                        <span id="downPaymentResult">$0</span>
                    </div>
                    <div class="summary-item">
                        <span>Total Interest Paid</span>
                        <span id="totalInterest">$0</span>
                    </div>
                    <div class="summary-item total">
                        <span>Total of 360 Payments</span>
                        <strong id="totalPayments">$0</strong>
                    </div>
                </div>

                <div class="amortization-chart">
                    <h4><i class="fas fa-table"></i> Amortization Schedule (First 5 Years)</h4>
                    <div class="chart-container" id="amortizationChart">
                        <!-- Amortization chart will be loaded here -->
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