<?php
$country = 'bangladesh';
$country_name = 'Bangladesh';
$currency = '৳';

// Loan calculation function
function calculateEMI($principal, $interest_rate, $tenure_months) {
    $monthly_rate = ($interest_rate / 12) / 100;
    $emi = $principal * $monthly_rate * pow(1 + $monthly_rate, $tenure_months) / 
           (pow(1 + $monthly_rate, $tenure_months) - 1);
    return round($emi, 2);
}

// Bangladesh specific loan data
$loan_types = [
    'Home Loan' => [
        'min_amount' => 100000, 
        'max_amount' => 50000000, 
        'min_tenure' => 5, 
        'max_tenure' => 25,
        'interest_range' => '10% - 15%'
    ],
    'Car Loan' => [
        'min_amount' => 200000, 
        'max_amount' => 10000000, 
        'min_tenure' => 1, 
        'max_tenure' => 7,
        'interest_range' => '12% - 18%'
    ],
    'Personal Loan' => [
        'min_amount' => 50000, 
        'max_amount' => 3000000, 
        'min_tenure' => 1, 
        'max_tenure' => 5,
        'interest_range' => '14% - 20%'
    ],
    'Business Loan' => [
        'min_amount' => 200000, 
        'max_amount' => 30000000, 
        'min_tenure' => 1, 
        'max_tenure' => 10,
        'interest_range' => '13% - 19%'
    ],
    'Agricultural Loan' => [
        'min_amount' => 50000, 
        'max_amount' => 2000000, 
        'min_tenure' => 1, 
        'max_tenure' => 5,
        'interest_range' => '7% - 12%'
    ]
];

// Bangladeshi banks reference rates
$banks = [
    'Sonali Bank' => '10% - 13%',
    'Agrani Bank' => '10.5% - 13.5%',
    'Rupali Bank' => '10.25% - 13.25%',
    'Janata Bank' => '10.75% - 13.75%',
    'Dutch-Bangla Bank' => '11% - 14%'
];

// Regional schemes
$regional_schemes = [
    'Dhaka' => 'Urban Housing Finance Scheme',
    'Chittagong' => 'Chittagong Development Project',
    'Khulna' => 'Khulna Industrial Development',
    'Rajshahi' => 'Rajshahi Agricultural Support',
    'Barisal' => 'Barisal Rural Development',
    'Sylhet' => 'Sylhet Infrastructure Development',
    'Rangpur' => 'Rangpur Agricultural Loan Program',
    'Mymensingh' => 'Mymensingh Small Business Support'
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Calculator - Bangladesh</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        .bangladesh-theme {
            --primary-color: #006a4e;
            --secondary-color: #f42a41;
            --accent-color: #006a4e;
        }
        
        .bangladesh-badge {
            background: linear-gradient(90deg, #006a4e 50%, #f42a41 50%);
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
            border: 2px solid #006a4e;
        }
        
        .bank-rates {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 15px;
            margin: 20px 0;
            border-right: 5px solid #006a4e;
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
            border-bottom: 3px solid #006a4e;
        }
        
        .scheme-badge {
            background: #006a4e;
            color: white;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 0.8rem;
            margin-left: 10px;
        }
        
        .bengali-text {
            font-family: 'Kalpurush', 'SolaimanLipi', 'Nikosh', sans-serif;
            font-size: 1.1rem;
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
            border-left: 4px solid #006a4e;
        }
    </style>
</head>
<body class="bangladesh-theme">
    <div class="calculator-container">
        <div class="header">
            <h1 class="title">বাংলাদেশ লোন ক্যালকুলেটর</h1>
            <div class="country-badge">
                <img src="https://flagcdn.com/w80/bd.png" alt="Bangladesh Flag" class="flag">
                <span class="bangladesh-badge">Bangladesh</span>
            </div>
        </div>

        <!-- Bank Rates Section -->
        <div class="bank-rates">
            <h3 style="margin: 0 0 15px 0; color: #333; text-align: center;">🏦 বর্তমান ব্যাংক হোম লোন হার / Current Bank Home Loan Rates</h3>
            <div class="bank-grid">
                <?php foreach($banks as $bank => $rate): ?>
                    <div class="bank-card">
                        <div style="font-weight: 600; color: #006a4e;"><?php echo $bank; ?></div>
                        <div style="color: #006a4e; font-weight: 500;"><?php echo $rate; ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="calculator-card">
            <div class="loan-type-selector">
                <label for="loanType">ঋণের ধরণ / Loan Type</label>
                <select id="loanType" onchange="updateLoanLimits()">
                    <?php foreach($loan_types as $type => $limits): ?>
                        <option value="<?php echo $type; ?>"><?php echo $type; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="input-group">
                <label for="loanAmount">ঋণের পরিমাণ / Loan Amount (<?php echo $currency; ?>)</label>
                <input type="number" id="loanAmount" placeholder="Enter loan amount" min="50000" step="1000">
                <div class="limit-info" id="amountLimit"></div>
            </div>

            <div class="input-group">
                <label for="interestRate">সুদের হার / Interest Rate (% per year)</label>
                <input type="number" id="interestRate" placeholder="Enter interest rate" min="1" max="30" step="0.1" value="12.5">
                <div class="rate-info" id="interestRange">সাধারণ হার: <span id="typicalRate">-</span></div>
            </div>

            <div class="input-group">
                <label for="loanTenure">ঋণের মেয়াদ / Loan Tenure (Years)</label>
                <input type="number" id="loanTenure" placeholder="Enter tenure in years" min="1" max="25" step="1">
                <div class="limit-info" id="tenureLimit"></div>
            </div>

            <div class="additional-options">
                <label class="checkbox-container">
                    <input type="checkbox" id="youthScheme" onchange="toggleYouthScheme()">
                    <span class="checkmark"></span>
                    যুব উদ্যোক্তা স্কিম (২% কম) <span class="scheme-badge">স্কিম</span>
                </label>
                
                <label class="checkbox-container">
                    <input type="checkbox" id="womenScheme" onchange="toggleWomenScheme()">
                    <span class="checkmark"></span>
                    নারী ব্যবসা ঋণ (১.৫% কম) <span class="scheme-badge">স্কিম</span>
                </label>

                <label class="checkbox-container">
                    <input type="checkbox" id="agriculturalScheme" onchange="toggleAgriculturalScheme()">
                    <span class="checkmark"></span>
                    কৃষি ঋণ স্কিম <span class="scheme-badge">স্কিম</span>
                </label>
            </div>

            <button class="calculate-btn" onclick="calculateLoan()">EMI হিসাব করুন / Calculate EMI</button>

            <div id="results" class="results-container" style="display: none;">
                <div class="result-header">
                    <h3>ঋণ সারসংক্ষেপ / Loan Summary</h3>
                    <p id="schemeInfo" class="scheme-info"></p>
                </div>
                <div class="result-grid">
                    <div class="result-card">
                        <h4>মাসিক EMI / Monthly EMI</h4>
                        <p id="monthlyEMI" class="result-amount">-</p>
                    </div>
                    <div class="result-card">
                        <h4>মোট পরিশোধ / Total Payment</h4>
                        <p id="totalPayment" class="result-amount">-</p>
                    </div>
                    <div class="result-card">
                        <h4>মোট সুদ / Total Interest</h4>
                        <p id="totalInterest" class="result-amount">-</p>
                    </div>
                    <div class="result-card">
                        <h4>কার্যকর হার / Effective Rate</h4>
                        <p id="effectiveRate" class="result-amount">-</p>
                    </div>
                </div>
                
                <div class="breakdown-section">
                    <h4>পরিশোধের বিবরণ / Payment Breakdown</h4>
                    <div class="breakdown-chart">
                        <div class="chart-bar">
                            <div class="chart-label">মূল টাকা / Principal</div>
                            <div class="chart-value" id="principalAmount">-</div>
                            <div class="chart-fill principal-fill" id="principalFill"></div>
                        </div>
                        <div class="chart-bar">
                            <div class="chart-label">সুদ / Interest</div>
                            <div class="chart-value" id="interestAmount">-</div>
                            <div class="chart-fill interest-fill" id="interestFill"></div>
                        </div>
                    </div>
                </div>

                <!-- Quarterly Preview -->
                <div class="schedule-preview">
                    <h4>প্রথম বছরের পূর্বরূপ / First Year Preview</h4>
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

        <!-- Regional Schemes Info -->
        <div class="info-section">
            <h3>আঞ্চলিক স্কিম / Regional Schemes</h3>
            <div class="region-grid">
                <?php foreach($regional_schemes as $region => $schemes): ?>
                    <div class="region-card">
                        <h4 style="color: #006a4e; margin: 0 0 10px 0;">🏛️ <?php echo $region; ?></h4>
                        <p style="margin: 0; color: #555;"><?php echo $schemes; ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Additional Bangladesh Specific Info -->
        <div class="info-section">
            <h3>বাংলাদেশে ঋণ তথ্য / Loan Information in Bangladesh</h3>
            <div class="info-grid">
                <div class="info-card">
                    <h4>🏠 হাউজিং ফাইন্যান্স</h4>
                    <p>স্টেট ব্যাংক অব বাংলাদেশ</p>
                    <p>মার্কআপ: 10% - 15%</p>
                    <p>সর্বোচ্চ মেয়াদ: 25 বছর</p>
                </div>
                <div class="info-card">
                    <h4>🚗 গাড়ি ঋণ</h4>
                    <p>নতুন ও পুরানো গাড়ি</p>
                    <p>মার্কআপ: 12% - 18%</p>
                    <p>সর্বোচ্চ মেয়াদ: 7 বছর</p>
                </div>
                <div class="info-card">
                    <h4>🌾 কৃষি স্কিম</h4>
                    <p>কৃষি ঋণ</p>
                    <p>সাবসিডিযুক্ত হার</p>
                    <p>কৃষি ঋণ প্রকল্প</p>
                </div>
                <div class="info-card">
                    <h4>💼 যুবকদের জন্য</h4>
                    <p>যুব ঋণ স্কিম</p>
                    <p>উদ্যোক্তা প্রকল্প</p>
                    <p>বিশেষ ছাড়</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        const loanLimits = <?php echo json_encode($loan_types); ?>;
        let youthScheme = false;
        let womenScheme = false;
        let agriculturalScheme = false;

        function updateLoanLimits() {
            const loanType = document.getElementById('loanType').value;
            const limits = loanLimits[loanType];
            
            document.getElementById('loanAmount').min = limits.min_amount;
            document.getElementById('loanAmount').max = limits.max_amount;
            document.getElementById('loanTenure').min = limits.min_tenure;
            document.getElementById('loanTenure').max = limits.max_tenure;
            
            document.getElementById('amountLimit').textContent = 
                `Range: ৳${limits.min_amount.toLocaleString('en-BD')} - ৳${limits.max_amount.toLocaleString('en-BD')}`;
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

        function toggleAgriculturalScheme() {
            agriculturalScheme = document.getElementById('agriculturalScheme').checked;
        }

        function calculateLoan() {
            const amount = parseFloat(document.getElementById('loanAmount').value);
            let rate = parseFloat(document.getElementById('interestRate').value);
            const tenure = parseFloat(document.getElementById('loanTenure').value);
            
            if (!amount || !rate || !tenure) {
                alert('অনুগ্রহ করে সমস্ত ক্ষেত্র পূরণ করুন / Please fill all fields');
                return;
            }

            // Apply schemes discounts
            if (youthScheme) {
                rate -= 2;
            }
            if (womenScheme) {
                rate -= 1.5;
            }
            if (agriculturalScheme) {
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
                '৳' + emi.toLocaleString('en-BD', {maximumFractionDigits: 2});
            document.getElementById('totalPayment').textContent = 
                '৳' + totalPayment.toLocaleString('en-BD', {maximumFractionDigits: 2});
            document.getElementById('totalInterest').textContent = 
                '৳' + totalInterest.toLocaleString('en-BD', {maximumFractionDigits: 2});
            
            let rateInfo = rate.toFixed(2) + '%';
            if (youthScheme) rateInfo += ' (Youth Scheme)';
            if (womenScheme) rateInfo += ' (Women Scheme)';
            if (agriculturalScheme) rateInfo += ' (Agricultural Scheme)';
            
            document.getElementById('effectiveRate').textContent = rateInfo;
            document.getElementById('principalAmount').textContent = 
                '৳' + amount.toLocaleString('en-BD', {maximumFractionDigits: 2});
            document.getElementById('interestAmount').textContent = 
                '৳' + totalInterest.toLocaleString('en-BD', {maximumFractionDigits: 2});

            // Update scheme info
            let schemeInfo = '';
            if (youthScheme) {
                schemeInfo += 'Youth Scheme Applied (2% less) • ';
            }
            if (womenScheme) {
                schemeInfo += 'Women Scheme Applied (1.5% less) • ';
            }
            if (agriculturalScheme) {
                schemeInfo += 'Agricultural Scheme Applied (3% less) • ';
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
                        <span>৳${principalPaid.toLocaleString('en-BD', {maximumFractionDigits: 2})}</span>
                        <span>৳${interest.toLocaleString('en-BD', {maximumFractionDigits: 2})}</span>
                        <span>৳${balance.toLocaleString('en-BD', {maximumFractionDigits: 2})}</span>
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