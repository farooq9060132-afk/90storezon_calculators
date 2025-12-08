<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tax Calculator Online - Income Tax Calculator 2024</title>
    <meta name="description" content="Online tax calculator tool. Calculate your income tax, deductions, and net salary instantly. Accurate tax calculations for 2024. No registration required!">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="vip-container">
        <header class="vip-header">
            <h1><i class="fas fa-calculator"></i> Tax Calculator</h1>
            <p>Calculate your income tax and net salary instantly</p>
        </header>

        <!-- Google Ads Slot -->
        <div class="ad-slot top-ad">
            [AD_TOP_BANNER]
        </div>

        <div class="calculator-container">
            <div class="input-group">
                <label for="country"><i class="fas fa-globe"></i> Country</label>
                <select id="country">
                    <option value="us">United States</option>
                    <option value="uk">United Kingdom</option>
                    <option value="canada">Canada</option>
                    <option value="australia">Australia</option>
                    <option value="germany">Germany</option>
                    <option value="france">France</option>
                    <option value="uae">UAE (No Income Tax)</option>
                    <option value="india">India</option>
                </select>
            </div>

            <div class="input-group">
                <label for="income"><i class="fas fa-money-bill-wave"></i> Annual Gross Income ($)</label>
                <input type="number" id="income" placeholder="Enter your annual income" min="0" value="50000">
            </div>

            <div class="input-row">
                <div class="input-group">
                    <label for="filingStatus"><i class="fas fa-user"></i> Filing Status</label>
                    <select id="filingStatus">
                        <option value="single">Single</option>
                        <option value="married_joint">Married Filing Jointly</option>
                        <option value="married_separate">Married Filing Separately</option>
                        <option value="head_household">Head of Household</option>
                    </select>
                </div>

                <div class="input-group">
                    <label for="age"><i class="fas fa-birthday-cake"></i> Age</label>
                    <input type="number" id="age" placeholder="Your age" min="18" max="100" value="30">
                </div>
            </div>

            <div class="deductions-section">
                <h3><i class="fas fa-percentage"></i> Deductions & Credits</h3>
                
                <div class="input-row">
                    <div class="input-group">
                        <label for="retirementContribution"><i class="fas fa-piggy-bank"></i> Retirement Contribution ($)</label>
                        <input type="number" id="retirementContribution" placeholder="401k/IRA contributions" min="0" value="6000">
                    </div>

                    <div class="input-group">
                        <label for="healthInsurance"><i class="fas fa-heartbeat"></i> Health Insurance ($)</label>
                        <input type="number" id="healthInsurance" placeholder="Annual premium" min="0" value="3000">
                    </div>
                </div>

                <div class="input-row">
                    <div class="input-group">
                        <label for="studentLoan"><i class="fas fa-graduation-cap"></i> Student Loan Interest ($)</label>
                        <input type="number" id="studentLoan" placeholder="Annual interest paid" min="0" value="1000">
                    </div>

                    <div class="input-group">
                        <label for="charity"><i class="fas fa-hand-holding-heart"></i> Charity Donations ($)</label>
                        <input type="number" id="charity" placeholder="Charitable contributions" min="0" value="500">
                    </div>
                </div>

                <div class="checkbox-group">
                    <label class="checkbox-label">
                        <input type="checkbox" id="standardDeduction" checked>
                        <span class="checkmark"></span>
                        Use Standard Deduction
                    </label>
                    <label class="checkbox-label">
                        <input type="checkbox" id="hasChildren">
                        <span class="checkmark"></span>
                        I have dependent children
                    </label>
                </div>
            </div>

            <button class="calculate-btn" onclick="calculateTax()">
                <i class="fas fa-calculator"></i> Calculate Tax
            </button>

            <!-- Google Ads Slot -->
            <div class="ad-slot middle-ad">
                [AD_MIDDLE_BANNER]
            </div>

            <div class="result-container" id="resultContainer">
                <h3><i class="fas fa-chart-pie"></i> Tax Calculation Results</h3>
                
                <div class="summary-cards">
                    <div class="summary-card gross">
                        <div class="card-icon">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                        <div class="card-content">
                            <div class="card-label">Gross Income</div>
                            <div class="card-value" id="grossIncome">$0</div>
                        </div>
                    </div>

                    <div class="summary-card tax">
                        <div class="card-icon">
                            <i class="fas fa-receipt"></i>
                        </div>
                        <div class="card-content">
                            <div class="card-label">Total Tax</div>
                            <div class="card-value" id="totalTax">$0</div>
                        </div>
                    </div>

                    <div class="summary-card net">
                        <div class="card-icon">
                            <i class="fas fa-wallet"></i>
                        </div>
                        <div class="card-content">
                            <div class="card-label">Net Income</div>
                            <div class="card-value" id="netIncome">$0</div>
                        </div>
                    </div>

                    <div class="summary-card effective">
                        <div class="card-icon">
                            <i class="fas fa-percentage"></i>
                        </div>
                        <div class="card-content">
                            <div class="card-label">Effective Tax Rate</div>
                            <div class="card-value" id="effectiveRate">0%</div>
                        </div>
                    </div>
                </div>

                <div class="tax-breakdown">
                    <h4><i class="fas fa-list"></i> Tax Breakdown</h4>
                    <div class="breakdown-grid">
                        <div class="breakdown-item">
                            <span>Federal Income Tax:</span>
                            <span id="federalTax">$0</span>
                        </div>
                        <div class="breakdown-item">
                            <span>State Income Tax:</span>
                            <span id="stateTax">$0</span>
                        </div>
                        <div class="breakdown-item">
                            <span>Social Security Tax:</span>
                            <span id="socialSecurityTax">$0</span>
                        </div>
                        <div class="breakdown-item">
                            <span>Medicare Tax:</span>
                            <span id="medicareTax">$0</span>
                        </div>
                        <div class="breakdown-item total">
                            <span>Total Deductions:</span>
                            <span id="totalDeductions">$0</span>
                        </div>
                    </div>
                </div>

                <div class="monthly-breakdown">
                    <h4><i class="fas fa-calendar-alt"></i> Monthly Breakdown</h4>
                    <div class="monthly-grid">
                        <div class="monthly-item">
                            <span>Gross Monthly:</span>
                            <span id="monthlyGross">$0</span>
                        </div>
                        <div class="monthly-item">
                            <span>Tax Monthly:</span>
                            <span id="monthlyTax">$0</span>
                        </div>
                        <div class="monthly-item">
                            <span>Net Monthly:</span>
                            <span id="monthlyNet">$0</span>
                        </div>
                    </div>
                </div>

                <div class="tax-tips">
                    <h4><i class="fas fa-lightbulb"></i> Tax Saving Tips</h4>
                    <div class="tips-grid">
                        <div class="tip-item">
                            <i class="fas fa-piggy-bank"></i>
                            <span>Maximize retirement contributions</span>
                        </div>
                        <div class="tip-item">
                            <i class="fas fa-home"></i>
                            <span>Consider mortgage interest deduction</span>
                        </div>
                        <div class="tip-item">
                            <i class="fas fa-graduation-cap"></i>
                            <span>Utilize education tax credits</span>
                        </div>
                        <div class="tip-item">
                            <i class="fas fa-heartbeat"></i>
                            <span>Use Health Savings Account (HSA)</span>
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