<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salary Calculator Online - Take Home Pay Calculator 2024</title>
    <meta name="description" content="Online salary calculator tool. Calculate your take-home pay, taxes, deductions, and net salary. Accurate calculations for 2024. No registration required!">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="vip-container">
        <header class="vip-header">
            <h1><i class="fas fa-money-check-alt"></i> Salary Calculator</h1>
            <p>Calculate your take-home pay and deductions</p>
        </header>

        <!-- Google Ads Slot -->
        <div class="ad-slot top-ad">
            [AD_TOP_BANNER]
        </div>

        <div class="calculator-container">
            <div class="input-section">
                <h3><i class="fas fa-user-tie"></i> Basic Information</h3>
                <div class="input-row">
                    <div class="input-group">
                        <label for="grossSalary"><i class="fas fa-money-bill-wave"></i> Gross Annual Salary ($)</label>
                        <input type="number" id="grossSalary" placeholder="Your annual salary" min="0" value="75000">
                    </div>

                    <div class="input-group">
                        <label for="payFrequency"><i class="fas fa-calendar"></i> Pay Frequency</label>
                        <select id="payFrequency">
                            <option value="52">Weekly</option>
                            <option value="26">Bi-Weekly</option>
                            <option value="24">Semi-Monthly</option>
                            <option value="12" selected>Monthly</option>
                            <option value="1">Annually</option>
                        </select>
                    </div>
                </div>

                <div class="input-row">
                    <div class="input-group">
                        <label for="filingStatus"><i class="fas fa-users"></i> Filing Status</label>
                        <select id="filingStatus">
                            <option value="single">Single</option>
                            <option value="married_joint" selected>Married Filing Jointly</option>
                            <option value="married_separate">Married Filing Separately</option>
                            <option value="head_household">Head of Household</option>
                        </select>
                    </div>

                    <div class="input-group">
                        <label for="state"><i class="fas fa-map-marker-alt"></i> State</label>
                        <select id="state">
                            <option value="ca">California</option>
                            <option value="ny">New York</option>
                            <option value="tx">Texas</option>
                            <option value="fl">Florida</option>
                            <option value="il">Illinois</option>
                            <option value="pa">Pennsylvania</option>
                            <option value="oh">Ohio</option>
                            <option value="ga">Georgia</option>
                            <option value="nc">North Carolina</option>
                            <option value="mi">Michigan</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="input-section">
                <h3><i class="fas fa-percentage"></i> Deductions & Contributions</h3>
                <div class="input-row">
                    <div class="input-group">
                        <label for="federalAllowances"><i class="fas fa-passport"></i> Federal Allowances</label>
                        <input type="number" id="federalAllowances" placeholder="Number of allowances" min="0" value="2">
                    </div>

                    <div class="input-group">
                        <label for="retirementContribution"><i class="fas fa-piggy-bank"></i> 401(k) Contribution (%)</label>
                        <input type="number" id="retirementContribution" placeholder="Retirement contribution %" min="0" max="100" value="6">
                    </div>
                </div>

                <div class="input-row">
                    <div class="input-group">
                        <label for="healthInsurance"><i class="fas fa-heartbeat"></i> Health Insurance ($/month)</label>
                        <input type="number" id="healthInsurance" placeholder="Monthly premium" min="0" value="300">
                    </div>

                    <div class="input-group">
                        <label for="otherDeductions"><i class="fas fa-list"></i> Other Deductions ($/month)</label>
                        <input type="number" id="otherDeductions" placeholder="Other monthly deductions" min="0" value="100">
                    </div>
                </div>
            </div>

            <div class="checkbox-group">
                <label class="checkbox-label">
                    <input type="checkbox" id="includeBonus" checked>
                    <span class="checkmark"></span>
                    Include Annual Bonus
                </label>
                <label class="checkbox-label">
                    <input type="checkbox" id="includeOvertime">
                    <span class="checkmark"></span>
                    Include Overtime Pay
                </label>
            </div>

            <div class="bonus-section" id="bonusSection">
                <div class="input-row">
                    <div class="input-group">
                        <label for="bonusAmount"><i class="fas fa-gift"></i> Annual Bonus Amount ($)</label>
                        <input type="number" id="bonusAmount" placeholder="Yearly bonus" min="0" value="5000">
                    </div>

                    <div class="input-group">
                        <label for="bonusTaxRate"><i class="fas fa-receipt"></i> Bonus Tax Rate (%)</label>
                        <input type="number" id="bonusTaxRate" placeholder="Bonus tax percentage" min="0" max="50" value="22">
                    </div>
                </div>
            </div>

            <button class="calculate-btn" onclick="calculateSalary()">
                <i class="fas fa-calculator"></i> Calculate Take-Home Pay
            </button>

            <!-- Google Ads Slot -->
            <div class="ad-slot middle-ad">
                [AD_MIDDLE_BANNER]
            </div>

            <div class="result-container" id="resultContainer">
                <h3><i class="fas fa-file-invoice-dollar"></i> Salary Breakdown</h3>
                
                <div class="summary-cards">
                    <div class="summary-card gross">
                        <div class="card-icon">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                        <div class="card-content">
                            <div class="card-label">Gross Pay</div>
                            <div class="card-value" id="grossPay">$0</div>
                        </div>
                    </div>

                    <div class="summary-card tax">
                        <div class="card-icon">
                            <i class="fas fa-receipt"></i>
                        </div>
                        <div class="card-content">
                            <div class="card-label">Total Taxes</div>
                            <div class="card-value" id="totalTaxes">$0</div>
                        </div>
                    </div>

                    <div class="summary-card deductions">
                        <div class="card-icon">
                            <i class="fas fa-hand-holding-usd"></i>
                        </div>
                        <div class="card-content">
                            <div class="card-label">Total Deductions</div>
                            <div class="card-value" id="totalDeductions">$0</div>
                        </div>
                    </div>

                    <div class="summary-card net">
                        <div class="card-icon">
                            <i class="fas fa-wallet"></i>
                        </div>
                        <div class="card-content">
                            <div class="card-label">Net Take-Home</div>
                            <div class="card-value" id="netPay">$0</div>
                        </div>
                    </div>
                </div>

                <div class="breakdown-section">
                    <div class="breakdown-column">
                        <h4><i class="fas fa-chart-pie"></i> Tax Breakdown</h4>
                        <div class="breakdown-list">
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
                                <span>Total Taxes:</span>
                                <span id="totalTaxesBreakdown">$0</span>
                            </div>
                        </div>
                    </div>

                    <div class="breakdown-column">
                        <h4><i class="fas fa-list-alt"></i> Deduction Breakdown</h4>
                        <div class="breakdown-list">
                            <div class="breakdown-item">
                                <span>401(k) Contribution:</span>
                                <span id="retirementDeduction">$0</span>
                            </div>
                            <div class="breakdown-item">
                                <span>Health Insurance:</span>
                                <span id="healthDeduction">$0</span>
                            </div>
                            <div class="breakdown-item">
                                <span>Other Deductions:</span>
                                <span id="otherDeductionsBreakdown">$0</span>
                            </div>
                            <div class="breakdown-item total">
                                <span>Total Deductions:</span>
                                <span id="totalDeductionsBreakdown">$0</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pay-frequency-section">
                    <h4><i class="fas fa-calendar-alt"></i> Pay Frequency Breakdown</h4>
                    <div class="frequency-grid">
                        <div class="frequency-item">
                            <span>Annual</span>
                            <strong id="annualNet">$0</strong>
                        </div>
                        <div class="frequency-item">
                            <span>Monthly</span>
                            <strong id="monthlyNet">$0</strong>
                        </div>
                        <div class="frequency-item">
                            <span>Bi-Weekly</span>
                            <strong id="biweeklyNet">$0</strong>
                        </div>
                        <div class="frequency-item">
                            <span>Weekly</span>
                            <strong id="weeklyNet">$0</strong>
                        </div>
                        <div class="frequency-item">
                            <span>Daily</span>
                            <strong id="dailyNet">$0</strong>
                        </div>
                        <div class="frequency-item">
                            <span>Hourly (40h/week)</span>
                            <strong id="hourlyNet">$0</strong>
                        </div>
                    </div>
                </div>

                <div class="tax-bracket-section">
                    <h4><i class="fas fa-chart-bar"></i> Tax Bracket Information</h4>
                    <div class="bracket-info">
                        <div class="bracket-item">
                            <span>Federal Tax Bracket:</span>
                            <strong id="federalBracket">0%</strong>
                        </div>
                        <div class="bracket-item">
                            <span>State Tax Bracket:</span>
                            <strong id="stateBracket">0%</strong>
                        </div>
                        <div class="bracket-item">
                            <span>Effective Tax Rate:</span>
                            <strong id="effectiveTaxRate">0%</strong>
                        </div>
                    </div>
                </div>

                <div class="salary-tips">
                    <h4><i class="fas fa-lightbulb"></i> Salary Optimization Tips</h4>
                    <div class="tips-grid">
                        <div class="tip-item">
                            <i class="fas fa-piggy-bank"></i>
                            <span>Maximize 401(k) contributions for tax savings</span>
                        </div>
                        <div class="tip-item">
                            <i class="fas fa-heartbeat"></i>
                            <span>Use HSA for additional tax advantages</span>
                        </div>
                        <div class="tip-item">
                            <i class="fas fa-graduation-cap"></i>
                            <span>Explore education and professional development benefits</span>
                        </div>
                        <div class="tip-item">
                            <i class="fas fa-home"></i>
                            <span>Consider remote work for potential state tax benefits</span>
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