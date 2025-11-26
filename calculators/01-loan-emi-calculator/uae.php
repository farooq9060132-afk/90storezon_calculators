<?php
$country = 'uae';
$country_name = 'United Arab Emirates';
$currency = 'AED';

// Loan calculation function
function calculateEMI($principal, $interest_rate, $tenure_months) {
    $monthly_rate = ($interest_rate / 12) / 100;
    $emi = $principal * $monthly_rate * pow(1 + $monthly_rate, $tenure_months) / 
           (pow(1 + $monthly_rate, $tenure_months) - 1);
    return round($emi, 2);
}

// UAE specific loan data
$loan_types = [
    'Home Loan' => [
        'min_amount' => 500000, 
        'max_amount' => 20000000, 
        'min_tenure' => 5, 
        'max_tenure' => 25,
        'interest_range' => '2.5% - 4.5%'
    ],
    'Auto Loan' => [
        'min_amount' => 50000, 
        'max_amount' => 2000000, 
        'min_tenure' => 1, 
        'max_tenure' => 7,
        'interest_range' => '3% - 5%'
    ],
    'Personal Loan' => [
        'min_amount' => 5000, 
        'max_amount' => 2000000, 
        'min_tenure' => 6, 
        'max_tenure' => 4,
        'interest_range' => '5% - 12%'
    ],
    'Business Loan' => [
        'min_amount' => 100000, 
        'max_amount' => 50000000, 
        'min_tenure' => 1, 
        'max_tenure' => 10,
        'interest_range' => '4% - 8%'
    ],
    'Credit Card Loan' => [
        'min_amount' => 1000, 
        'max_amount' => 500000, 
        'min_tenure' => 3, 
        'max_tenure' => 5,
        'interest_range' => '12% - 18%'
    ]
];

// UAE banks reference rates
$banks = [
    'Emirates NBD' => '2.75% - 4.25%',
    'Mashreq Bank' => '2.85% - 4.35%',
    'ADCB' => '2.65% - 4.15%',
    'Dubai Islamic Bank' => '2.9% - 4.4%',
    'RAKBANK' => '3.1% - 4.6%'
];

// UAE Emirates
$emirates = [
    'Dubai' => 'No salary transfer required',
    'Abu Dhabi' => 'Lower interest rates',
    'Sharjah' => 'Competitive rates',
    'Ajman' => 'Flexible terms',
    'Ras Al Khaimah' => 'Special schemes',
    'Fujairah' => 'Business friendly',
    'Umm Al Quwain' => 'Easy processing'
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Calculator - UAE</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        .uae-theme {
            --primary-color: #FF0000;
            --secondary-color: #000000;
            --accent-color: #009639;
        }
        
        .uae-badge {
            background: linear-gradient(90deg, #FF0000 33%, #009639 33%, #009639 66%, #000000 66%);
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
            border: 2px solid #FF0000;
        }
        
        .bank-rates {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 15px;
            margin: 20px 0;
            border-right: 5px solid #FF0000;
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
            border-bottom: 3px solid #FF0000;
        }
        
        .scheme-badge {
            background: #FF0000;
            color: white;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 0.8rem;
            margin-left: 10px;
        }
        
        .emirate-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 15px;
            margin-top: 15px;
        }
        
        .emirate-card {
            background: white;
            padding: 15px;
            border-radius: 10px;
            border-left: 4px solid #FF0000;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        .salary-group {
            margin: 15px 0;
        }
        
        .islamic-banking {
            background: linear-gradient(135deg, #009639, #006400);
            color: white;
            padding: 15px;
            border-radius: 10px;
            margin: 15px 0;
        }
    </style>
</head>
<body class="uae-theme">
    <div class="calculator-container">
        <div class="header">
            <h1 class="title">حاسبة القروض - الإمارات</h1>
            <div class="country-badge">
                <img src="https://flagcdn.com/w80/ae.png" alt="UAE Flag" class="flag">
                <span class="uae-badge">UAE</span>
            </div>
        </div>

        <!-- Bank Rates Section -->
        <div class="bank-rates">
            <h3 style="margin: 0 0 15px 0; color: #333; text-align: center;">🏦 أسعار القروض العقارية الحالية / Current Mortgage Rates</h3>
            <div class="bank-grid">
                <?php foreach($banks as $bank => $rate): ?>
                    <div class="bank-card">
                        <div style="font-weight: 600; color: #FF0000;"><?php echo $bank; ?></div>
                        <div style="color: #009639; font-weight: 500;"><?php echo $rate; ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="calculator-card">
            <div class="loan-type-selector">
                <label for="loanType">نوع القرض / Loan Type</label>
                <select id="loanType" onchange="updateLoanLimits()">
                    <?php foreach($loan_types as $type => $limits): ?>
                        <option value="<?php echo $type; ?>"><?php echo $type; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="input-group">
                <label for="emirate">الإمارة / Emirate</label>
                <select id="emirate" onchange="updateEmirateInfo()">
                    <?php foreach($emirates as $emirate => $info): ?>
                        <option value="<?php echo $emirate; ?>"><?php echo $emirate; ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="limit-info" id="emirateInfo"></div>
            </div>

            <div class="input-group">
                <label for="loanAmount">مبلغ القرض / Loan Amount (<?php echo $currency; ?>)</label>
                <input type="number" id="loanAmount" placeholder="Enter loan amount" min="5000" step="1000">
                <div class="limit-info" id="amountLimit"></div>
            </div>

            <div class="salary-group">
                <label for="salary">الراتب الشهري / Monthly Salary (<?php echo $currency; ?>)</label>
                <input type="number" id="salary" placeholder="Enter monthly salary" min="3000" step="1000">
                <div class="limit-info" id="salaryLimit"></div>
            </div>

            <div class="input-group">
                <label for="interestRate">سعر الفائدة / Interest Rate (% per year)</label>
                <input type="number" id="interestRate" placeholder="Enter interest rate" min="1" max="20" step="0.1" value="3.5">
                <div class="rate-info" id="interestRange">الأسعار النموذجية: <span id="typicalRate">-</span></div>
            </div>

            <div class="input-group">
                <label for="loanTenure">مدة القرض / Loan Tenure (Years)</label>
                <input type="number" id="loanTenure" placeholder="Enter tenure in years" min="1" max="25" step="1">
                <div class="limit-info" id="tenureLimit"></div>
            </div>

            <div class="additional-options">
                <label class="checkbox-container">
                    <input type="checkbox" id="salaryTransfer" onchange="toggleSalaryTransfer()">
                    <span class="checkmark"></span>
                    Salary Transfer Required <span class="scheme-badge">UAE</span>
                </label>
                
                <label class="checkbox-container">
                    <input type="checkbox" id="islamicBanking" onchange="toggleIslamicBanking()">
                    <span class="checkmark"></span>
                    Islamic Banking (Murabaha) <span class="scheme-badge">Sharia</span>
                </label>

                <label class="checkbox-container">
                    <input type="checkbox" id="expatDiscount" onchange="toggleExpatDiscount()">
                    <span class="checkmark"></span>
                    Expatriate Special Rate (0.25% less) <span class="scheme-badge">Offer</span>
                </label>
            </div>

            <!-- Islamic Banking Info -->
            <div id="islamicInfo" class="islamic-banking" style="display: none;">
                <h4>🌙 Islamic Banking Information</h4>
                <p>Murabaha financing: No interest, profit margin instead</p>
                <p>Sharia compliant financing solutions</p>
            </div>

            <button class="calculate-btn" onclick="calculateLoan()">احسب القسط الشهري / Calculate EMI</button>

            <div id="results" class="results-container" style="display: none;">
                <div class="result-header">
                    <h3>ملخص القرض / Loan Summary</h3>
                    <p id="schemeInfo" class="scheme-info"></p>
                </div>
                <div class="result-grid">
                    <div class="result-card">
                        <h4>القسط الشهري / Monthly EMI</h4>
                        <p id="monthlyEMI" class="result-amount">-</p>
                    </div>
                    <div class="result-card">
                        <h4>إجمالي السداد / Total Payment</h4>
                        <p id="totalPayment" class="result-amount">-</p>
                    </div>
                    <div class="result-card">
                        <h4>إجمالي الفائدة / Total Interest</h4>
                        <p id="totalInterest" class="result-amount">-</p>
                    </div>
                    <div class="result-card">
                        <h4>معدل الفائدة الفعلي / Effective Rate</h4>
                        <p id="effectiveRate" class="result-amount">-</p>
                    </div>
                </div>
                
                <!-- Debt Burden Ratio -->
                <div class="debt-ratio-card">
                    <h4>نسبة عبء الديون / Debt Burden Ratio</h4>
                    <div class="ratio-meter">
                        <div class="ratio-fill" id="debtRatioFill"></div>
                    </div>
                    <p id="debtRatioText" class="ratio-text"></p>
                </div>
                
                <div class="breakdown-section">
                    <h4>تفاصيل السداد / Payment Breakdown</h4>
                    <div class="breakdown-chart">
                        <div class="chart-bar">
                            <div class="chart-label">أصل المبلغ / Principal</div>
                            <div class="chart-value" id="principalAmount">-</div>
                            <div class="chart-fill principal-fill" id="principalFill"></div>
                        </div>
                        <div class="chart-bar">
                            <div class="chart-label">الفائدة / Interest</div>
                            <div class="chart-value" id="interestAmount">-</div>
                            <div class="chart-fill interest-fill" id="interestFill"></div>
                        </div>
                    </div>
                </div>

                <!-- Quarterly Preview -->
                <div class="schedule-preview">
                    <h4>معاينة السنة الأولى / First Year Preview</h4>
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

        <!-- Emirates Information -->
        <div class="info-section">
            <h3>معلومات الإمارات / Emirates Information</h3>
            <div class="emirate-grid">
                <?php foreach($emirates as $emirate => $info): ?>
                    <div class="emirate-card">
                        <h4 style="color: #FF0000; margin: 0 0 10px 0;">🏙️ <?php echo $emirate; ?></h4>
                        <p style="margin: 0; color: #555;"><?php echo $info; ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- UAE Specific Information -->
        <div class="info-section">
            <h3>معلومات القروض في الإمارات / Loan Information in UAE</h3>
            <div class="info-grid">
                <div class="info-card">
                    <h4>🏠 القروض العقارية</h4>
                    <p>LTV Ratio: 75-80%</p>
                    <p>Max tenure: 25 years</p>
                    <p>Salary transfer required</p>
                </div>
                <div class="info-card">
                    <h4>🚗 قروض السيارات</h4>
                    <p>New cars: 80% financing</p>
                    <p>Used cars: 70% financing</p>
                    <p>Islamic financing available</p>
                </div>
                <div class="info-card">
                    <h4>💳 القروض الشخصية</h4>
                    <p>20 times salary</p>
                    <p>Max 4 years tenure</p>
                    <p>Credit score based</p>
                </div>
                <div class="info-card">
                    <h4>🏢 القروض التجارية</h4>
                    <p>For businesses</p>
                    <p>Higher amounts</p>
                    <p>Flexible terms</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        const loanLimits = <?php echo json_encode($loan_types); ?>;
        const emirates = <?php echo json_encode($emirates); ?>;
        let salaryTransfer = false;
        let islamicBanking = false;
        let expatDiscount = false;

        function updateLoanLimits() {
            const loanType = document.getElementById('loanType').value;
            const limits = loanLimits[loanType];
            
            document.getElementById('loanAmount').min = limits.min_amount;
            document.getElementById('loanAmount').max = limits.max_amount;
            document.getElementById('loanTenure').min = limits.min_tenure;
            document.getElementById('loanTenure').max = limits.max_tenure;
            
            document.getElementById('amountLimit').textContent = 
                `Range: AED ${limits.min_amount.toLocaleString('en-AE')} - AED ${limits.max_amount.toLocaleString('en-AE')}`;
            document.getElementById('tenureLimit').textContent = 
                `Range: ${limits.min_tenure} - ${limits.max_tenure} years`;
            document.getElementById('typicalRate').textContent = limits.interest_range;
        }

        function updateEmirateInfo() {
            const emirate = document.getElementById('emirate').value;
            document.getElementById('emirateInfo').textContent = emirates[emirate];
        }

        function toggleSalaryTransfer() {
            salaryTransfer = document.getElementById('salaryTransfer').checked;
        }

        function toggleIslamicBanking() {
            islamicBanking = document.getElementById('islamicBanking').checked;
            document.getElementById('islamicInfo').style.display = islamicBanking ? 'block' : 'none';
        }

        function toggleExpatDiscount() {
            expatDiscount = document.getElementById('expatDiscount').checked;
        }

        function calculateLoan() {
            const amount = parseFloat(document.getElementById('loanAmount').value);
            let rate = parseFloat(document.getElementById('interestRate').value);
            const tenure = parseFloat(document.getElementById('loanTenure').value);
            const salary = parseFloat(document.getElementById('salary').value) || 0;
            const emirate = document.getElementById('emirate').value;
            
            if (!amount || !rate || !tenure) {
                alert('يرجى ملء جميع الحقول الإلزامية / Please fill all required fields');
                return;
            }

            // Apply expat discount if selected
            if (expatDiscount) {
                rate -= 0.25;
            }

            // Adjust rate for Islamic banking (usually slightly higher)
            if (islamicBanking) {
                rate += 0.5; // Murabaha profit margin
            }

            const monthlyRate = rate / 12 / 100;
            const months = tenure * 12;
            const emi = amount * monthlyRate * Math.pow(1 + monthlyRate, months) / 
                        (Math.pow(1 + monthlyRate, months) - 1);
            const totalPayment = emi * months;
            const totalInterest = totalPayment - amount;

            // Update results
            document.getElementById('monthlyEMI').textContent = 
                'AED ' + emi.toLocaleString('en-AE', {maximumFractionDigits: 2});
            document.getElementById('totalPayment').textContent = 
                'AED ' + totalPayment.toLocaleString('en-AE', {maximumFractionDigits: 2});
            document.getElementById('totalInterest').textContent = 
                'AED ' + totalInterest.toLocaleString('en-AE', {maximumFractionDigits: 2});
            
            let rateInfo = rate.toFixed(2) + '%';
            if (islamicBanking) rateInfo += ' (Islamic)';
            if (expatDiscount) rateInfo += ' (Expat Discount)';
            
            document.getElementById('effectiveRate').textContent = rateInfo;
            document.getElementById('principalAmount').textContent = 
                'AED ' + amount.toLocaleString('en-AE', {maximumFractionDigits: 2});
            document.getElementById('interestAmount').textContent = 
                'AED ' + totalInterest.toLocaleString('en-AE', {maximumFractionDigits: 2});

            // Update scheme info
            let schemeInfo = '';
            if (salaryTransfer) {
                schemeInfo += 'Salary Transfer Required • ';
            }
            if (islamicBanking) {
                schemeInfo += 'Islamic Banking • ';
            }
            if (expatDiscount) {
                schemeInfo += 'Expat Discount Applied • ';
            }
            document.getElementById('schemeInfo').textContent = schemeInfo || 'Standard loan terms';

            // Calculate and display debt burden ratio
            if (salary > 0) {
                const debtRatio = (emi / salary * 100);
                const debtRatioFill = document.getElementById('debtRatioFill');
                const debtRatioText = document.getElementById('debtRatioText');
                
                debtRatioFill.style.width = Math.min(debtRatio, 100) + '%';
                
                if (debtRatio <= 50) {
                    debtRatioFill.style.background = '#009639';
                    debtRatioText.textContent = `Debt Burden Ratio: ${debtRatio.toFixed(1)}% - Good (Below 50%)`;
                } else if (debtRatio <= 60) {
                    debtRatioFill.style.background = '#FFA500';
                    debtRatioText.textContent = `Debt Burden Ratio: ${debtRatio.toFixed(1)}% - Acceptable (50-60%)`;
                } else {
                    debtRatioFill.style.background = '#FF0000';
                    debtRatioText.textContent = `Debt Burden Ratio: ${debtRatio.toFixed(1)}% - High (Above 60%)`;
                }
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
                        <span>AED ${principalPaid.toLocaleString('en-AE', {maximumFractionDigits: 2})}</span>
                        <span>AED ${interest.toLocaleString('en-AE', {maximumFractionDigits: 2})}</span>
                        <span>AED ${balance.toLocaleString('en-AE', {maximumFractionDigits: 2})}</span>
                    </div>
                `;
            }
            
            document.getElementById('amortizationPreview').innerHTML = previewHTML;
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            updateLoanLimits();
            updateEmirateInfo();
        });
    </script>
    
    <!-- Footer -->
    <footer style="background: #333; color: white; text-align: center; padding: 40px 20px; margin-top: 40px;">
        <p style="margin: 0; font-size: 1rem;">&copy; 2024 90storezon. All rights reserved.</p>
        <p style="margin: 10px 0 0 0; font-size: 0.9rem;">
            <a href="/pages/about.php" style="color: #ccc; text-decoration: none; margin: 0 10px;">About</a>
            <a href="/pages/contact.php" style="color: #ccc; text-decoration: none; margin: 0 10px;">Contact</a>
            <a href="/pages/privacy.php" style="color: #ccc; text-decoration: none; margin: 0 10px;">Privacy Policy</a>
            <a href="/pages/terms.php" style="color: #ccc; text-decoration: none; margin: 0 10px;">Terms of Service</a>
        </p>
        <p style="margin: 20px 0 0 0; font-size: 0.8rem; color: #999;">
            <a href="/" style="color: #999; text-decoration: none;">Back to Home</a> |
            <a href="/calculators/01-loan-emi-calculator/" style="color: #999; text-decoration: none;">Back to Loan Calculator</a>
        </p>
    </footer>
</body>
</html>