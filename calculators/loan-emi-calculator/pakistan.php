<?php
$country = 'pakistan';
$country_name = 'Pakistan';
$currency = 'Rs';

// Loan calculation function
function calculateEMI($principal, $interest_rate, $tenure_months) {
    $monthly_rate = ($interest_rate / 12) / 100;
    $emi = $principal * $monthly_rate * pow(1 + $monthly_rate, $tenure_months) / 
           (pow(1 + $monthly_rate, $tenure_months) - 1);
    return round($emi, 2);
}

// Pakistan specific loan data
$loan_types = [
    'Home Loan' => [
        'min_amount' => 500000, 
        'max_amount' => 50000000, 
        'min_tenure' => 5, 
        'max_tenure' => 25,
        'interest_range' => '12% - 16%'
    ],
    'Car Loan' => [
        'min_amount' => 300000, 
        'max_amount' => 10000000, 
        'min_tenure' => 1, 
        'max_tenure' => 7,
        'interest_range' => '13% - 18%'
    ],
    'Personal Loan' => [
        'min_amount' => 50000, 
        'max_amount' => 5000000, 
        'min_tenure' => 1, 
        'max_tenure' => 5,
        'interest_range' => '15% - 22%'
    ],
    'Business Loan' => [
        'min_amount' => 100000, 
        'max_amount' => 50000000, 
        'min_tenure' => 1, 
        'max_tenure' => 10,
        'interest_range' => '14% - 20%'
    ],
    'Agricultural Loan' => [
        'min_amount' => 50000, 
        'max_amount' => 5000000, 
        'min_tenure' => 6, 
        'max_tenure' => 5,
        'interest_range' => '8% - 12%'
    ]
];

// Pakistani banks reference rates
$banks = [
    'HBL' => '12% - 15%',
    'UBL' => '12.5% - 15.5%',
    'MCB' => '12.25% - 15.25%',
    'Allied Bank' => '12.75% - 15.75%',
    'Bank Alfalah' => '13% - 16%'
];

// Provincial schemes
$provincial_schemes = [
    'Punjab' => 'Kissan Card, Youth Loan Scheme',
    'Sindh' => 'Sindh Youth Loan Program',
    'KPK' => 'Khyber Pakhtunkhwa Loan Scheme',
    'Balochistan' => 'Balochistan Entrepreneurship Program'
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Calculator - Pakistan</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        .pakistan-theme {
            --primary-color: #01411C;
            --secondary-color: #FFFFFF;
            --accent-color: #00401A;
        }
        
        .pakistan-badge {
            background: linear-gradient(90deg, #01411C 33%, #FFFFFF 33%, #FFFFFF 66%, #01411C 66%);
            color: #01411C;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
            border: 2px solid #01411C;
        }
        
        .bank-rates {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 15px;
            margin: 20px 0;
            border-right: 5px solid #01411C;
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
            border-bottom: 3px solid #01411C;
        }
        
        .scheme-badge {
            background: #01411C;
            color: white;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 0.8rem;
            margin-left: 10px;
        }
        
        .urdu-text {
            font-family: 'Jameel Noori Nastaleeq', 'Alvi Lahori', 'Urdu Typesetting', serif;
            direction: rtl;
            font-size: 1.1rem;
        }
        
        .province-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 15px;
            margin-top: 15px;
        }
        
        .province-card {
            background: white;
            padding: 15px;
            border-radius: 10px;
            border-left: 4px solid #01411C;
        }
    </style>
</head>
<body class="pakistan-theme">
    <div class="calculator-container">
        <div class="header">
            <h1 class="title">پاکستان لوں کیلکولیٹر</h1>
            <div class="country-badge">
                <img src="https://flagcdn.com/w80/pk.png" alt="Pakistan Flag" class="flag">
                <span class="pakistan-badge">Pakistan</span>
            </div>
        </div>

        <!-- Bank Rates Section -->
        <div class="bank-rates">
            <h3 style="margin: 0 0 15px 0; color: #333; text-align: center;">🏦 موجودہ بینک ہوم لوں ریٹس / Current Bank Home Loan Rates</h3>
            <div class="bank-grid">
                <?php foreach($banks as $bank => $rate): ?>
                    <div class="bank-card">
                        <div style="font-weight: 600; color: #01411C;"><?php echo $bank; ?></div>
                        <div style="color: #01411C; font-weight: 500;"><?php echo $rate; ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="calculator-card">
            <div class="loan-type-selector">
                <label for="loanType">قرض کی قسم / Loan Type</label>
                <select id="loanType" onchange="updateLoanLimits()">
                    <?php foreach($loan_types as $type => $limits): ?>
                        <option value="<?php echo $type; ?>"><?php echo $type; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="input-group">
                <label for="loanAmount">قرض کی رقم / Loan Amount (<?php echo $currency; ?>)</label>
                <input type="number" id="loanAmount" placeholder="Enter loan amount" min="50000" step="1000">
                <div class="limit-info" id="amountLimit"></div>
            </div>

            <div class="input-group">
                <label for="interestRate">سود کی شرح / Interest Rate (% per year)</label>
                <input type="number" id="interestRate" placeholder="Enter interest rate" min="1" max="30" step="0.1" value="13.5">
                <div class="rate-info" id="interestRange">عام شرحیں: <span id="typicalRate">-</span></div>
            </div>

            <div class="input-group">
                <label for="loanTenure">قرض کی مدت / Loan Tenure (Years)</label>
                <input type="number" id="loanTenure" placeholder="Enter tenure in years" min="1" max="25" step="1">
                <div class="limit-info" id="tenureLimit"></div>
            </div>

            <div class="additional-options">
                <label class="checkbox-container">
                    <input type="checkbox" id="youthScheme" onchange="toggleYouthScheme()">
                    <span class="checkmark"></span>
                    Youth Entrepreneurship Scheme (2% less) <span class="scheme-badge">Scheme</span>
                </label>
                
                <label class="checkbox-container">
                    <input type="checkbox" id="womenScheme" onchange="toggleWomenScheme()">
                    <span class="checkmark"></span>
                    Women Business Loan (1.5% less) <span class="scheme-badge">Scheme</span>
                </label>

                <label class="checkbox-container">
                    <input type="checkbox" id="kissanCard" onchange="toggleKissanCard()">
                    <span class="checkmark"></span>
                    Kissan Card Scheme (Agricultural) <span class="scheme-badge">Scheme</span>
                </label>
            </div>

            <button class="calculate-btn" onclick="calculateLoan()">EMI حساب کریں / Calculate EMI</button>

            <div id="results" class="results-container" style="display: none;">
                <div class="result-header">
                    <h3>قرض کا خلاصہ / Loan Summary</h3>
                    <p id="schemeInfo" class="scheme-info"></p>
                </div>
                <div class="result-grid">
                    <div class="result-card">
                        <h4>ماہانہ قسط / Monthly EMI</h4>
                        <p id="monthlyEMI" class="result-amount">-</p>
                    </div>
                    <div class="result-card">
                        <h4>کل ادائیگی / Total Payment</h4>
                        <p id="totalPayment" class="result-amount">-</p>
                    </div>
                    <div class="result-card">
                        <h4>کل سود / Total Interest</h4>
                        <p id="totalInterest" class="result-amount">-</p>
                    </div>
                    <div class="result-card">
                        <h4>موثر شرح / Effective Rate</h4>
                        <p id="effectiveRate" class="result-amount">-</p>
                    </div>
                </div>
                
                <div class="breakdown-section">
                    <h4>ادائیگی کی تفصیل / Payment Breakdown</h4>
                    <div class="breakdown-chart">
                        <div class="chart-bar">
                            <div class="chart-label">اصل رقم / Principal</div>
                            <div class="chart-value" id="principalAmount">-</div>
                            <div class="chart-fill principal-fill" id="principalFill"></div>
                        </div>
                        <div class="chart-bar">
                            <div class="chart-label">سود / Interest</div>
                            <div class="chart-value" id="interestAmount">-</div>
                            <div class="chart-fill interest-fill" id="interestFill"></div>
                        </div>
                    </div>
                </div>

                <!-- Quarterly Preview -->
                <div class="schedule-preview">
                    <h4>پہلے سال کی جھلکی / First Year Preview</h4>
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

        <!-- Provincial Schemes Info -->
        <div class="info-section">
            <h3>صوبائی اسکیمیں / Provincial Schemes</h3>
            <div class="province-grid">
                <?php foreach($provincial_schemes as $province => $schemes): ?>
                    <div class="province-card">
                        <h4 style="color: #01411C; margin: 0 0 10px 0;">🏛️ <?php echo $province; ?></h4>
                        <p style="margin: 0; color: #555;"><?php echo $schemes; ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Additional Pakistan Specific Info -->
        <div class="info-section">
            <h3>پاکستان میں قرض کی معلومات / Loan Information in Pakistan</h3>
            <div class="info-grid">
                <div class="info-card">
                    <h4>🏠 ہاؤس بلڈنگ فنانس</h4>
                    <p>State Bank of Pakistan</p>
                    <p>Markup: 12% - 16%</p>
                    <p>Max tenure: 25 years</p>
                </div>
                <div class="info-card">
                    <h4>🚗 کار لون</h4>
                    <p>New & Used cars</p>
                    <p>Markup: 13% - 18%</p>
                    <p>Max tenure: 7 years</p>
                </div>
                <div class="info-card">
                    <h4>🌾 کسان اسکیمیں</h4>
                    <p>Kissan Card</p>
                    <p>Subsidized rates</p>
                    <p>Agricultural loans</p>
                </div>
                <div class="info-card">
                    <h4>💼 نوجوانوں کے لئے</h4>
                    <p>Youth Loan Scheme</p>
                    <p>Entrepreneurship</p>
                    <p>Special discounts</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        const loanLimits = <?php echo json_encode($loan_types); ?>;
        let youthScheme = false;
        let womenScheme = false;
        let kissanCard = false;

        function updateLoanLimits() {
            const loanType = document.getElementById('loanType').value;
            const limits = loanLimits[loanType];
            
            document.getElementById('loanAmount').min = limits.min_amount;
            document.getElementById('loanAmount').max = limits.max_amount;
            document.getElementById('loanTenure').min = limits.min_tenure;
            document.getElementById('loanTenure').max = limits.max_tenure;
            
            document.getElementById('amountLimit').textContent = 
                `Range: Rs ${limits.min_amount.toLocaleString('en-PK')} - Rs ${limits.max_amount.toLocaleString('en-PK')}`;
            document.getElementById('tenureLimit').textContent = 
                `Range: ${limits.min_tenure} - ${limits.max_tenure} years`;
            document.getElementById('typicalRate').textContent = limits.interest_range;
        }

        function toggleYouthScheme() {
            youthScheme = document.getElementById('youthScheme').checked;
        }

        function toggleWomenScheme() {
            womenScheme = document.getElementById('womenScheme').checked;
        }

        function toggleKissanCard() {
            kissanCard = document.getElementById('kissanCard').checked;
        }

        function calculateLoan() {
            const amount = parseFloat(document.getElementById('loanAmount').value);
            let rate = parseFloat(document.getElementById('interestRate').value);
            const tenure = parseFloat(document.getElementById('loanTenure').value);
            
            if (!amount || !rate || !tenure) {
                alert('براہ کرم تمام فیلڈز پُر کریں / Please fill all fields');
                return;
            }

            // Apply schemes discounts
            if (youthScheme) {
                rate -= 2;
            }
            if (womenScheme) {
                rate -= 1.5;
            }
            if (kissanCard) {
                rate -= 3; // Additional discount for agricultural loans
            }

            const monthlyRate = rate / 12 / 100;
            const months = tenure * 12;
            const emi = amount * monthlyRate * Math.pow(1 + monthlyRate, months) / 
                        (Math.pow(1 + monthlyRate, months) - 1);
            const totalPayment = emi * months;
            const totalInterest = totalPayment - amount;

            // Update results
            document.getElementById('monthlyEMI').textContent = 
                'Rs ' + emi.toLocaleString('en-PK', {maximumFractionDigits: 2});
            document.getElementById('totalPayment').textContent = 
                'Rs ' + totalPayment.toLocaleString('en-PK', {maximumFractionDigits: 2});
            document.getElementById('totalInterest').textContent = 
                'Rs ' + totalInterest.toLocaleString('en-PK', {maximumFractionDigits: 2});
            
            let rateInfo = rate.toFixed(2) + '%';
            if (youthScheme) rateInfo += ' (Youth Scheme)';
            if (womenScheme) rateInfo += ' (Women Scheme)';
            if (kissanCard) rateInfo += ' (Kissan Card)';
            
            document.getElementById('effectiveRate').textContent = rateInfo;
            document.getElementById('principalAmount').textContent = 
                'Rs ' + amount.toLocaleString('en-PK', {maximumFractionDigits: 2});
            document.getElementById('interestAmount').textContent = 
                'Rs ' + totalInterest.toLocaleString('en-PK', {maximumFractionDigits: 2});

            // Update scheme info
            let schemeInfo = '';
            if (youthScheme) {
                schemeInfo += 'Youth Scheme Applied (2% less) • ';
            }
            if (womenScheme) {
                schemeInfo += 'Women Scheme Applied (1.5% less) • ';
            }
            if (kissanCard) {
                schemeInfo += 'Kissan Card Applied (3% less) • ';
            }
            document.getElementById('schemeInfo').textContent = schemeInfo || 'No special schemes applied';

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
                        <span>Rs ${principalPaid.toLocaleString('en-PK', {maximumFractionDigits: 2})}</span>
                        <span>Rs ${interest.toLocaleString('en-PK', {maximumFractionDigits: 2})}</span>
                        <span>Rs ${balance.toLocaleString('en-PK', {maximumFractionDigits: 2})}</span>
                    </div>
                `;
            }
            
            document.getElementById('amortizationPreview').innerHTML = previewHTML;
        }

        // Initialize limits on page load
        document.addEventListener('DOMContentLoaded', function() {
            updateLoanLimits();
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