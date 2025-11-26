<?php
$country = 'india';
$country_name = 'India';
$currency = '₹';

// Loan calculation function
function calculateEMI($principal, $interest_rate, $tenure_months) {
    $monthly_rate = ($interest_rate / 12) / 100;
    $emi = $principal * $monthly_rate * pow(1 + $monthly_rate, $tenure_months) / 
           (pow(1 + $monthly_rate, $tenure_months) - 1);
    return round($emi, 2);
}

// India specific loan data
$loan_types = [
    'Home Loan' => [
        'min_amount' => 500000, 
        'max_amount' => 50000000, 
        'min_tenure' => 5, 
        'max_tenure' => 30,
        'interest_range' => '6.5% - 9.5%'
    ],
    'Car Loan' => [
        'min_amount' => 100000, 
        'max_amount' => 5000000, 
        'min_tenure' => 1, 
        'max_tenure' => 7,
        'interest_range' => '7.5% - 12.5%'
    ],
    'Personal Loan' => [
        'min_amount' => 50000, 
        'max_amount' => 4000000, 
        'min_tenure' => 1, 
        'max_tenure' => 5,
        'interest_range' => '10% - 18%'
    ],
    'Gold Loan' => [
        'min_amount' => 10000, 
        'max_amount' => 5000000, 
        'min_tenure' => 3, 
        'max_tenure' => 3,
        'interest_range' => '7% - 15%'
    ],
    'Education Loan' => [
        'min_amount' => 50000, 
        'max_amount' => 20000000, 
        'min_tenure' => 1, 
        'max_tenure' => 15,
        'interest_range' => '8% - 12%'
    ]
];

// Indian banks reference rates
$banks = [
    'SBI' => '6.80% - 7.30%',
    'HDFC' => '6.90% - 7.60%',
    'ICICI' => '6.90% - 7.65%',
    'PNB' => '6.80% - 7.35%',
    'Axis Bank' => '6.90% - 7.70%'
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Calculator - India</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        .indian-theme {
            --primary-color: #FF9933;
            --secondary-color: #138808;
            --accent-color: #000080;
        }
        
        .tricolor-badge {
            background: linear-gradient(90deg, #FF9933 33%, #FFFFFF 33%, #FFFFFF 66%, #138808 66%);
            color: #000080;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
            border: 2px solid #000080;
        }
        
        .bank-rates {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 15px;
            margin: 20px 0;
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
        }
        
        .scheme-badge {
            background: var(--secondary-color);
            color: white;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 0.8rem;
            margin-left: 10px;
        }
    </style>
</head>
<body class="indian-theme">
    <div class="calculator-container">
        <div class="header">
            <h1 class="title">भारत लोन कैलकुलेटर</h1>
            <div class="country-badge">
                <img src="https://flagcdn.com/w80/in.png" alt="India Flag" class="flag">
                <span class="tricolor-badge">India</span>
            </div>
        </div>

        <!-- Bank Rates Section -->
        <div class="bank-rates">
            <h3 style="margin: 0 0 15px 0; color: #333; text-align: center;">🏦 Current Bank Home Loan Rates</h3>
            <div class="bank-grid">
                <?php foreach($banks as $bank => $rate): ?>
                    <div class="bank-card">
                        <div style="font-weight: 600; color: #000080;"><?php echo $bank; ?></div>
                        <div style="color: #138808; font-weight: 500;"><?php echo $rate; ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="calculator-card">
            <div class="loan-type-selector">
                <label for="loanType">लोन प्रकार / Loan Type</label>
                <select id="loanType" onchange="updateLoanLimits()">
                    <?php foreach($loan_types as $type => $limits): ?>
                        <option value="<?php echo $type; ?>"><?php echo $type; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="input-group">
                <label for="loanAmount">लोन राशि / Loan Amount (<?php echo $currency; ?>)</label>
                <input type="number" id="loanAmount" placeholder="Enter loan amount" min="10000" step="1000">
                <div class="limit-info" id="amountLimit"></div>
            </div>

            <div class="input-group">
                <label for="interestRate">ब्याज दर / Interest Rate (% per year)</label>
                <input type="number" id="interestRate" placeholder="Enter interest rate" min="1" max="25" step="0.1" value="7.5">
                <div class="rate-info" id="interestRange">Typical rates: <span id="typicalRate">-</span></div>
            </div>

            <div class="input-group">
                <label for="loanTenure">लोन अवधि / Loan Tenure (Years)</label>
                <input type="number" id="loanTenure" placeholder="Enter tenure in years" min="1" max="30" step="1">
                <div class="limit-info" id="tenureLimit"></div>
            </div>

            <div class="additional-options">
                <label class="checkbox-container">
                    <input type="checkbox" id="womenDiscount" onchange="toggleWomenDiscount()">
                    <span class="checkmark"></span>
                    Women Interest Discount (0.25% less) <span class="scheme-badge">Scheme</span>
                </label>
                
                <label class="checkbox-container">
                    <input type="checkbox" id="gstIncluded" onchange="toggleGST()">
                    <span class="checkmark"></span>
                    Include GST (18% on processing fee)
                </label>
            </div>

            <button class="calculate-btn" onclick="calculateLoan()">EMI कैलकुलेट करें / Calculate EMI</button>

            <div id="results" class="results-container" style="display: none;">
                <div class="result-header">
                    <h3>लोन सारांश / Loan Summary</h3>
                    <p id="schemeInfo" class="scheme-info"></p>
                </div>
                <div class="result-grid">
                    <div class="result-card">
                        <h4>मासिक किस्त / Monthly EMI</h4>
                        <p id="monthlyEMI" class="result-amount">-</p>
                    </div>
                    <div class="result-card">
                        <h4>कुल भुगतान / Total Payment</h4>
                        <p id="totalPayment" class="result-amount">-</p>
                    </div>
                    <div class="result-card">
                        <h4>कुल ब्याज / Total Interest</h4>
                        <p id="totalInterest" class="result-amount">-</p>
                    </div>
                    <div class="result-card">
                        <h4>प्रभावी दर / Effective Rate</h4>
                        <p id="effectiveRate" class="result-amount">-</p>
                    </div>
                </div>
                
                <div class="breakdown-section">
                    <h4>भुगतान विवरण / Payment Breakdown</h4>
                    <div class="breakdown-chart">
                        <div class="chart-bar">
                            <div class="chart-label">मूल राशि / Principal</div>
                            <div class="chart-value" id="principalAmount">-</div>
                            <div class="chart-fill principal-fill" id="principalFill"></div>
                        </div>
                        <div class="chart-bar">
                            <div class="chart-label">ब्याज / Interest</div>
                            <div class="chart-value" id="interestAmount">-</div>
                            <div class="chart-fill interest-fill" id="interestFill"></div>
                        </div>
                    </div>
                </div>

                <!-- Amortization Schedule Preview -->
                <div class="schedule-preview">
                    <h4>पहले साल का विवरण / First Year Preview</h4>
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

        <!-- Government Schemes Info -->
        <div class="info-section">
            <h3>भारत सरकार की योजनाएं / Government Schemes</h3>
            <div class="info-grid">
                <div class="info-card">
                    <h4>🏠 Pradhan Mantri Awas Yojana</h4>
                    <p>Subsidy up to ₹2.67 lakh</p>
                    <p>Interest subsidy scheme</p>
                    <p>For EWS/LIG categories</p>
                </div>
                <div class="info-card">
                    <h4>🎓 Vidya Lakshmi</h4>
                    <p>Education loan portal</p>
                    <p>Multiple bank options</p>
                    <p>Scheme benefits</p>
                </div>
                <div class="info-card">
                    <h4>🚗 Auto Schemes</h4>
                    <p>Women driver discounts</p>
                    <p>Electric vehicle subsidies</p>
                    <p>Special interest rates</p>
                </div>
                <div class="info-card">
                    <h4>💼 MUDRA Loan</h4>
                    <p>Small business loans</p>
                    <p>Up to ₹10 lakh</p>
                    <p>Shishu/Kishor/Tarun</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        const loanLimits = <?php echo json_encode($loan_types); ?>;
        let womenDiscount = false;
        let gstIncluded = false;

        function updateLoanLimits() {
            const loanType = document.getElementById('loanType').value;
            const limits = loanLimits[loanType];
            
            document.getElementById('loanAmount').min = limits.min_amount;
            document.getElementById('loanAmount').max = limits.max_amount;
            document.getElementById('loanTenure').min = limits.min_tenure;
            document.getElementById('loanTenure').max = limits.max_tenure;
            
            document.getElementById('amountLimit').textContent = 
                `Range: ₹${limits.min_amount.toLocaleString('en-IN')} - ₹${limits.max_amount.toLocaleString('en-IN')}`;
            document.getElementById('tenureLimit').textContent = 
                `Range: ${limits.min_tenure} - ${limits.max_tenure} years`;
            document.getElementById('typicalRate').textContent = limits.interest_range;
        }

        function toggleWomenDiscount() {
            womenDiscount = document.getElementById('womenDiscount').checked;
        }

        function toggleGST() {
            gstIncluded = document.getElementById('gstIncluded').checked;
        }

        function calculateLoan() {
            const amount = parseFloat(document.getElementById('loanAmount').value);
            let rate = parseFloat(document.getElementById('interestRate').value);
            const tenure = parseFloat(document.getElementById('loanTenure').value);
            
            if (!amount || !rate || !tenure) {
                alert('कृपया सभी फ़ील्ड भरें / Please fill all fields');
                return;
            }

            // Apply women discount if selected
            if (womenDiscount) {
                rate -= 0.25;
            }

            const monthlyRate = rate / 12 / 100;
            const months = tenure * 12;
            const emi = amount * monthlyRate * Math.pow(1 + monthlyRate, months) / 
                        (Math.pow(1 + monthlyRate, months) - 1);
            const totalPayment = emi * months;
            const totalInterest = totalPayment - amount;

            // Update results
            document.getElementById('monthlyEMI').textContent = 
                '₹' + emi.toLocaleString('en-IN', {maximumFractionDigits: 2});
            document.getElementById('totalPayment').textContent = 
                '₹' + totalPayment.toLocaleString('en-IN', {maximumFractionDigits: 2});
            document.getElementById('totalInterest').textContent = 
                '₹' + totalInterest.toLocaleString('en-IN', {maximumFractionDigits: 2});
            document.getElementById('effectiveRate').textContent = 
                rate.toFixed(2) + '%' + (womenDiscount ? ' (Women Discount Applied)' : '');
            document.getElementById('principalAmount').textContent = 
                '₹' + amount.toLocaleString('en-IN', {maximumFractionDigits: 2});
            document.getElementById('interestAmount').textContent = 
                '₹' + totalInterest.toLocaleString('en-IN', {maximumFractionDigits: 2});

            // Update scheme info
            let schemeInfo = '';
            if (womenDiscount) {
                schemeInfo += 'Women Discount Applied (0.25% less) • ';
            }
            if (gstIncluded) {
                schemeInfo += 'GST Included • ';
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
                        <span>₹${principalPaid.toLocaleString('en-IN', {maximumFractionDigits: 2})}</span>
                        <span>₹${interest.toLocaleString('en-IN', {maximumFractionDigits: 2})}</span>
                        <span>₹${balance.toLocaleString('en-IN', {maximumFractionDigits: 2})}</span>
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
</body>
</html>