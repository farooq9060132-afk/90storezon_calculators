<?php
$country = 'uk';
$country_name = 'United Kingdom';
$currency = '£';

// Loan calculation function
function calculateEMI($principal, $interest_rate, $tenure_months) {
    $monthly_rate = ($interest_rate / 12) / 100;
    $emi = $principal * $monthly_rate * pow(1 + $monthly_rate, $tenure_months) / 
           (pow(1 + $monthly_rate, $tenure_months) - 1);
    return round($emi, 2);
}

// UK specific loan data
$loan_types = [
    'Mortgage' => [
        'min_amount' => 50000, 
        'max_amount' => 5000000, 
        'min_tenure' => 5, 
        'max_tenure' => 35,
        'interest_range' => '2.5% - 5.5%',
        'ltv_max' => 95
    ],
    'Car Finance' => [
        'min_amount' => 5000, 
        'max_amount' => 100000, 
        'min_tenure' => 1, 
        'max_tenure' => 7,
        'interest_range' => '4% - 10%',
        'ltv_max' => 100
    ],
    'Personal Loan' => [
        'min_amount' => 1000, 
        'max_amount' => 50000, 
        'min_tenure' => 1, 
        'max_tenure' => 7,
        'interest_range' => '3% - 15%',
        'ltv_max' => 100
    ],
    'Student Loan' => [
        'min_amount' => 1000, 
        'max_amount' => 100000, 
        'min_tenure' => 10, 
        'max_tenure' => 30,
        'interest_range' => '4.5% - 7.5%',
        'ltv_max' => 100
    ],
    'Business Loan' => [
        'min_amount' => 5000, 
        'max_amount' => 500000, 
        'min_tenure' => 1, 
        'max_tenure' => 10,
        'interest_range' => '5% - 12%',
        'ltv_max' => 80
    ]
];

// UK banks reference rates
$banks = [
    'HSBC' => '2.75% - 4.25%',
    'Barclays' => '2.85% - 4.35%',
    'Lloyds Bank' => '2.65% - 4.15%',
    'NatWest' => '2.95% - 4.45%',
    'Santander' => '3.05% - 4.55%'
];

// UK Regions
$regions = [
    'England' => 'Help to Buy scheme available',
    'Scotland' => 'First Home Fund',
    'Wales' => 'Help to Buy Wales',
    'Northern Ireland' => 'Co-ownership scheme',
    'London' => 'London Help to Buy'
];

// UK Government Schemes
$government_schemes = [
    'Help to Buy' => 'Equity loan up to 20% (40% in London)',
    'Shared Ownership' => 'Buy 25%-75% of home, rent the rest',
    'Right to Buy' => 'Council tenants buy their home',
    'Lifetime ISA' => '25% government bonus for first homes',
    'First Homes' => '30-50% discount for first-time buyers'
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Calculator - United Kingdom</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        .uk-theme {
            --primary-color: #012169;
            --secondary-color: #C8102E;
            --accent-color: #FFFFFF;
        }
        
        .uk-badge {
            background: linear-gradient(90deg, #012169 33%, #C8102E 33%, #C8102E 66%, #012169 66%);
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
            border: 2px solid #012169;
        }
        
        .bank-rates {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 15px;
            margin: 20px 0;
            border-right: 5px solid #012169;
        }
        
        .bank-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-top: 15px;
        }
        
        .bank-card {
            background: white;
            padding: 15px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            border-bottom: 3px solid #012169;
        }
        
        .scheme-badge {
            background: #C8102E;
            color: white;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 0.8rem;
            margin-left: 10px;
        }
        
        .region-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 15px;
            margin-top: 15px;
        }
        
        .region-card {
            background: white;
            padding: 15px;
            border-radius: 10px;
            border-left: 4px solid #012169;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        .scheme-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 15px;
            margin-top: 15px;
        }
        
        .scheme-card {
            background: linear-gradient(135deg, #012169, #C8102E);
            color: white;
            padding: 20px;
            border-radius: 10px;
        }
        
        .ltv-calculator {
            background: #e8f4fd;
            padding: 15px;
            border-radius: 10px;
            margin: 15px 0;
            border-left: 4px solid #012169;
        }
        
        .stamp-duty {
            background: #fff3cd;
            padding: 15px;
            border-radius: 10px;
            margin: 15px 0;
            border-left: 4px solid #ffc107;
        }
    </style>
</head>
<body class="uk-theme">
    <div class="calculator-container">
        <div class="header">
            <h1 class="title">UK Loan Calculator</h1>
            <div class="country-badge">
                <img src="https://flagcdn.com/w80/gb.png" alt="UK Flag" class="flag">
                <span class="uk-badge">United Kingdom</span>
            </div>
        </div>

        <!-- Bank Rates Section -->
        <div class="bank-rates">
            <h3 style="margin: 0 0 15px 0; color: #333; text-align: center;">🏦 Current Mortgage Rates</h3>
            <div class="bank-grid">
                <?php foreach($banks as $bank => $rate): ?>
                    <div class="bank-card">
                        <div style="font-weight: 600; color: #012169;"><?php echo $bank; ?></div>
                        <div style="color: #C8102E; font-weight: 500;"><?php echo $rate; ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="calculator-card">
            <div class="loan-type-selector">
                <label for="loanType">Loan Type</label>
                <select id="loanType" onchange="updateLoanLimits()">
                    <?php foreach($loan_types as $type => $limits): ?>
                        <option value="<?php echo $type; ?>"><?php echo $type; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="input-group">
                <label for="region">Region</label>
                <select id="region" onchange="updateRegionInfo()">
                    <?php foreach($regions as $region => $info): ?>
                        <option value="<?php echo $region; ?>"><?php echo $region; ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="limit-info" id="regionInfo"></div>
            </div>

            <!-- LTV Calculator -->
            <div class="ltv-calculator">
                <h4 style="margin: 0 0 10px 0; color: #012169;">🏠 Loan-to-Value (LTV) Calculator</h4>
                <div class="input-group">
                    <label for="propertyValue">Property Value (£)</label>
                    <input type="number" id="propertyValue" placeholder="Enter property value" min="50000" step="1000" oninput="calculateLTV()">
                </div>
                <div class="input-group">
                    <label for="depositAmount">Deposit Amount (£)</label>
                    <input type="number" id="depositAmount" placeholder="Enter deposit amount" min="5000" step="1000" oninput="calculateLTV()">
                </div>
                <div id="ltvResult" style="margin-top: 10px; font-weight: 600; color: #012169;"></div>
            </div>

            <div class="input-group">
                <label for="loanAmount">Loan Amount (<?php echo $currency; ?>)</label>
                <input type="number" id="loanAmount" placeholder="Enter loan amount" min="1000" step="1000">
                <div class="limit-info" id="amountLimit"></div>
            </div>

            <div class="input-group">
                <label for="interestRate">Interest Rate (% per year)</label>
                <input type="number" id="interestRate" placeholder="Enter interest rate" min="0.5" max="20" step="0.1" value="4.2">
                <div class="rate-info" id="interestRange">Typical rates: <span id="typicalRate">-</span></div>
            </div>

            <div class="input-group">
                <label for="loanTenure">Loan Tenure (Years)</label>
                <input type="number" id="loanTenure" placeholder="Enter tenure in years" min="1" max="35" step="1">
                <div class="limit-info" id="tenureLimit"></div>
            </div>

            <!-- Stamp Duty Calculator -->
            <div class="stamp-duty">
                <h4 style="margin: 0 0 10px 0; color: #856404;">🏛️ Stamp Duty Land Tax (SDLT)</h4>
                <label class="checkbox-container">
                    <input type="checkbox" id="firstTimeBuyer" onchange="calculateStampDuty()">
                    <span class="checkmark"></span>
                    First-time Buyer
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" id="additionalProperty" onchange="calculateStampDuty()">
                    <span class="checkmark"></span>
                    Additional Property
                </label>
                <div id="stampDutyResult" style="margin-top: 10px; font-weight: 600; color: #856404;"></div>
            </div>

            <div class="additional-options">
                <label class="checkbox-container">
                    <input type="checkbox" id="helpToBuy" onchange="toggleHelpToBuy()">
                    <span class="checkmark"></span>
                    Help to Buy Scheme <span class="scheme-badge">Government</span>
                </label>
                
                <label class="checkbox-container">
                    <input type="checkbox" id="fixedRate" onchange="toggleFixedRate()">
                    <span class="checkmark"></span>
                    Fixed Rate Period (2-5 years)
                </label>

                <label class="checkbox-container">
                    <input type="checkbox" id="studentLoanPlan" onchange="toggleStudentLoanPlan()">
                    <span class="checkmark"></span>
                    Student Loan Plan 2 <span class="scheme-badge">Plan 2</span>
                </label>
            </div>

            <button class="calculate-btn" onclick="calculateLoan()">Calculate Monthly Payment</button>

            <div id="results" class="results-container" style="display: none;">
                <div class="result-header">
                    <h3>Loan Summary</h3>
                    <p id="schemeInfo" class="scheme-info"></p>
                </div>
                <div class="result-grid">
                    <div class="result-card">
                        <h4>Monthly Payment</h4>
                        <p id="monthlyEMI" class="result-amount">-</p>
                    </div>
                    <div class="result-card">
                        <h4>Total Repayment</h4>
                        <p id="totalPayment" class="result-amount">-</p>
                    </div>
                    <div class="result-card">
                        <h4>Total Interest</h4>
                        <p id="totalInterest" class="result-amount">-</p>
                    </div>
                    <div class="result-card">
                        <h4>Effective Rate</h4>
                        <p id="effectiveRate" class="result-amount">-</p>
                    </div>
                </div>
                
                <!-- Affordability Calculator -->
                <div class="affordability-card">
                    <h4>Affordability Check</h4>
                    <div class="affordability-meter">
                        <div class="affordability-fill" id="affordabilityFill"></div>
                    </div>
                    <p id="affordabilityText" class="affordability-text"></p>
                </div>
                
                <div class="breakdown-section">
                    <h4>Payment Breakdown</h4>
                    <div class="breakdown-chart">
                        <div class="chart-bar">
                            <div class="chart-label">Principal</div>
                            <div class="chart-value" id="principalAmount">-</div>
                            <div class="chart-fill principal-fill" id="principalFill"></div>
                        </div>
                        <div class="chart-bar">
                            <div class="chart-label">Interest</div>
                            <div class="chart-value" id="interestAmount">-</div>
                            <div class="chart-fill interest-fill" id="interestFill"></div>
                        </div>
                    </div>
                </div>

                <!-- First Year Preview -->
                <div class="schedule-preview">
                    <h4>First Year Amortization</h4>
                    <div class="schedule-grid">
                        <div class="schedule-header">
                            <span>Month</span>
                            <span>Principal</span>
                            <span>Interest</span>
                            <span>Balance</span>
                        </div>
                        <div id="amortizationPreview"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Government Schemes -->
        <div class="info-section">
            <h3>UK Government Schemes</h3>
            <div class="scheme-grid">
                <?php foreach($government_schemes as $scheme => $details): ?>
                    <div class="scheme-card">
                        <h4 style="margin: 0 0 10px 0;">🏛️ <?php echo $scheme; ?></h4>
                        <p style="margin: 0; opacity: 0.9;"><?php echo $details; ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Regions Information -->
        <div class="info-section">
            <h3>UK Regions Information</h3>
            <div class="region-grid">
                <?php foreach($regions as $region => $info): ?>
                    <div class="region-card">
                        <h4 style="color: #012169; margin: 0 0 10px 0;">🏴󠁧󠁢󠁥󠁮󠁧󠁿 <?php echo $region; ?></h4>
                        <p style="margin: 0; color: #555;"><?php echo $info; ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- UK Specific Information -->
        <div class="info-section">
            <h3>Loan Information in United Kingdom</h3>
            <div class="info-grid">
                <div class="info-card">
                    <h4>🏠 Mortgages</h4>
                    <p>Max LTV: 95%</p>
                    <p>Term: Up to 35 years</p>
                    <p>Help to Buy available</p>
                </div>
                <div class="info-card">
                    <h4>🚗 Car Finance</h4>
                    <p>PCP & HP options</p>
                    <p>Max term: 7 years</p>
                    <p>Balloon payments</p>
                </div>
                <div class="info-card">
                    <h4>🎓 Student Loans</h4>
                    <p>Plan 1 & Plan 2</p>
                    <p>Income contingent</p>
                    <p>9% over threshold</p>
                </div>
                <div class="info-card">
                    <h4>💼 Personal Loans</h4>
                    <p>Unsecured loans</p>
                    <p>APR regulations</p>
                    <p>Credit score based</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        const loanLimits = <?php echo json_encode($loan_types); ?>;
        const regions = <?php echo json_encode($regions); ?>;
        let helpToBuy = false;
        let fixedRate = false;
        let studentLoanPlan = false;
        let firstTimeBuyer = false;
        let additionalProperty = false;

        function updateLoanLimits() {
            const loanType = document.getElementById('loanType').value;
            const limits = loanLimits[loanType];
            
            document.getElementById('loanAmount').min = limits.min_amount;
            document.getElementById('loanAmount').max = limits.max_amount;
            document.getElementById('loanTenure').min = limits.min_tenure;
            document.getElementById('loanTenure').max = limits.max_tenure;
            
            document.getElementById('amountLimit').textContent = 
                `Range: £${limits.min_amount.toLocaleString('en-GB')} - £${limits.max_amount.toLocaleString('en-GB')} (Max LTV: ${limits.ltv_max}%)`;
            document.getElementById('tenureLimit').textContent = 
                `Range: ${limits.min_tenure} - ${limits.max_tenure} years`;
            document.getElementById('typicalRate').textContent = limits.interest_range;
        }

        function updateRegionInfo() {
            const region = document.getElementById('region').value;
            document.getElementById('regionInfo').textContent = regions[region];
        }

        function calculateLTV() {
            const propertyValue = parseFloat(document.getElementById('propertyValue').value) || 0;
            const depositAmount = parseFloat(document.getElementById('depositAmount').value) || 0;
            
            if (propertyValue > 0 && depositAmount > 0) {
                const loanAmount = propertyValue - depositAmount;
                const ltv = (loanAmount / propertyValue * 100);
                
                document.getElementById('loanAmount').value = loanAmount;
                document.getElementById('ltvResult').textContent = 
                    `LTV: ${ltv.toFixed(1)}% | Loan Amount: £${loanAmount.toLocaleString('en-GB')}`;
                
                // Color code based on LTV
                if (ltv <= 60) {
                    document.getElementById('ltvResult').style.color = '#28a745';
                } else if (ltv <= 80) {
                    document.getElementById('ltvResult').style.color = '#ffc107';
                } else {
                    document.getElementById('ltvResult').style.color = '#dc3545';
                }
            }
        }

        function calculateStampDuty() {
            firstTimeBuyer = document.getElementById('firstTimeBuyer').checked;
            additionalProperty = document.getElementById('additionalProperty').checked;
            const propertyValue = parseFloat(document.getElementById('propertyValue').value) || 0;
            
            if (propertyValue > 0) {
                let stampDuty = 0;
                
                if (firstTimeBuyer) {
                    // First-time buyer relief
                    if (propertyValue <= 425000) {
                        stampDuty = 0;
                    } else if (propertyValue <= 625000) {
                        stampDuty = (propertyValue - 425000) * 0.05;
                    } else {
                        stampDuty = calculateStandardStampDuty(propertyValue);
                    }
                } else if (additionalProperty) {
                    // Additional 3% surcharge
                    stampDuty = calculateStandardStampDuty(propertyValue) + (propertyValue * 0.03);
                } else {
                    stampDuty = calculateStandardStampDuty(propertyValue);
                }
                
                document.getElementById('stampDutyResult').textContent = 
                    `Stamp Duty: £${stampDuty.toLocaleString('en-GB', {maximumFractionDigits: 0})}`;
            }
        }

        function calculateStandardStampDuty(propertyValue) {
            let duty = 0;
            if (propertyValue > 250000) {
                duty += (Math.min(propertyValue, 925000) - 250000) * 0.05;
            }
            if (propertyValue > 925000) {
                duty += (Math.min(propertyValue, 1500000) - 925000) * 0.1;
            }
            if (propertyValue > 1500000) {
                duty += (propertyValue - 1500000) * 0.12;
            }
            return duty;
        }

        function toggleHelpToBuy() {
            helpToBuy = document.getElementById('helpToBuy').checked;
        }

        function toggleFixedRate() {
            fixedRate = document.getElementById('fixedRate').checked;
        }

        function toggleStudentLoanPlan() {
            studentLoanPlan = document.getElementById('studentLoanPlan').checked;
        }

        function calculateLoan() {
            const amount = parseFloat(document.getElementById('loanAmount').value);
            let rate = parseFloat(document.getElementById('interestRate').value);
            const tenure = parseFloat(document.getElementById('loanTenure').value);
            const propertyValue = parseFloat(document.getElementById('propertyValue').value) || amount;
            
            if (!amount || !rate || !tenure) {
                alert('Please fill all required fields');
                return;
            }

            // Adjust rate for fixed rate period
            if (fixedRate) {
                rate += 0.2; // Slightly higher for fixed rates
            }

            const monthlyRate = rate / 12 / 100;
            const months = tenure * 12;
            const emi = amount * monthlyRate * Math.pow(1 + monthlyRate, months) / 
                        (Math.pow(1 + monthlyRate, months) - 1);
            const totalPayment = emi * months;
            const totalInterest = totalPayment - amount;

            // Update results
            document.getElementById('monthlyEMI').textContent = 
                '£' + emi.toLocaleString('en-GB', {maximumFractionDigits: 2});
            document.getElementById('totalPayment').textContent = 
                '£' + totalPayment.toLocaleString('en-GB', {maximumFractionDigits: 2});
            document.getElementById('totalInterest').textContent = 
                '£' + totalInterest.toLocaleString('en-GB', {maximumFractionDigits: 2});
            
            let rateInfo = rate.toFixed(2) + '%';
            if (fixedRate) rateInfo += ' (Fixed)';
            if (helpToBuy) rateInfo += ' (Help to Buy)';
            
            document.getElementById('effectiveRate').textContent = rateInfo;
            document.getElementById('principalAmount').textContent = 
                '£' + amount.toLocaleString('en-GB', {maximumFractionDigits: 2});
            document.getElementById('interestAmount').textContent = 
                '£' + totalInterest.toLocaleString('en-GB', {maximumFractionDigits: 2});

            // Update scheme info
            let schemeInfo = '';
            if (helpToBuy) {
                schemeInfo += 'Help to Buy Scheme • ';
            }
            if (fixedRate) {
                schemeInfo += 'Fixed Rate Period • ';
            }
            if (studentLoanPlan) {
                schemeInfo += 'Student Loan Plan 2 • ';
            }
            document.getElementById('schemeInfo').textContent = schemeInfo || 'Standard loan terms';

            // Affordability check (assuming average UK salary)
            const averageSalary = 33000;
            const annualEMI = emi * 12;
            const affordabilityRatio = (annualEMI / averageSalary * 100);
            const affordabilityFill = document.getElementById('affordabilityFill');
            const affordabilityText = document.getElementById('affordabilityText');
            
            affordabilityFill.style.width = Math.min(affordabilityRatio, 100) + '%';
            
            if (affordabilityRatio <= 30) {
                affordabilityFill.style.background = '#28a745';
                affordabilityText.textContent = `Affordability: ${affordabilityRatio.toFixed(1)}% - Good (Below 30%)`;
            } else if (affordabilityRatio <= 40) {
                affordabilityFill.style.background = '#ffc107';
                affordabilityText.textContent = `Affordability: ${affordabilityRatio.toFixed(1)}% - Acceptable (30-40%)`;
            } else {
                affordabilityFill.style.background = '#dc3545';
                affordabilityText.textContent = `Affordability: ${affordabilityRatio.toFixed(1)}% - Stretched (Above 40%)`;
            }

            // Update chart visualization
            const principalPercent = (amount / totalPayment * 100).toFixed(1);
            const interestPercent = (totalInterest / totalPayment * 100).toFixed(1);
            
            document.getElementById('principalFill').style.width = principalPercent + '%';
            document.getElementById('interestFill').style.width = interestPercent + '%';

            // Show amortization preview
            showAmortizationPreview(amount, monthlyRate, months, emi);

            document.getElementById('results').style.display = 'block';
        }

        function showAmortizationPreview(principal, monthlyRate, months, emi) {
            let balance = principal;
            let previewHTML = '';
            
            for (let month = 1; month <= Math.min(12, months); month++) {
                const interest = balance * monthlyRate;
                const principalPaid = emi - interest;
                balance -= principalPaid;
                
                previewHTML += `
                    <div class="schedule-row">
                        <span>${month}</span>
                        <span>£${principalPaid.toLocaleString('en-GB', {maximumFractionDigits: 2})}</span>
                        <span>£${interest.toLocaleString('en-GB', {maximumFractionDigits: 2})}</span>
                        <span>£${balance.toLocaleString('en-GB', {maximumFractionDigits: 2})}</span>
                    </div>
                `;
            }
            
            document.getElementById('amortizationPreview').innerHTML = previewHTML;
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            updateLoanLimits();
            updateRegionInfo();
        });
    </script>
</body>
</html>