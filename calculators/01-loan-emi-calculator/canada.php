<?php
$country = 'canada';
$country_name = 'Canada';
$currency = 'C$';

// Loan calculation function
function calculateEMI($principal, $interest_rate, $tenure_months) {
    $monthly_rate = ($interest_rate / 12) / 100;
    $emi = $principal * $monthly_rate * pow(1 + $monthly_rate, $tenure_months) / 
           (pow(1 + $monthly_rate, $tenure_months) - 1);
    return round($emi, 2);
}

// Canada specific loan data
$loan_types = [
    'Mortgage' => ['min_amount' => 25000, 'max_amount' => 2500000, 'min_tenure' => 5, 'max_tenure' => 30],
    'Auto Loan' => ['min_amount' => 5000, 'max_amount' => 150000, 'min_tenure' => 1, 'max_tenure' => 8],
    'Personal Loan' => ['min_amount' => 1000, 'max_amount' => 75000, 'min_tenure' => 1, 'max_tenure' => 7],
    'Student Loan' => ['min_amount' => 2000, 'max_amount' => 100000, 'min_tenure' => 5, 'max_tenure' => 15]
];

// Province specific tax rates (for information)
$provinces = [
    'Ontario' => 'HST 13%',
    'Quebec' => 'GST 5% + QST 9.975%',
    'British Columbia' => 'GST 5% + PST 7%',
    'Alberta' => 'GST 5%',
    'Manitoba' => 'GST 5% + PST 7%',
    'Saskatchewan' => 'GST 5% + PST 6%',
    'Nova Scotia' => 'HST 15%',
    'New Brunswick' => 'HST 15%',
    'Newfoundland' => 'HST 15%',
    'PEI' => 'HST 15%'
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Calculator - Canada</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="calculator-container">
        <div class="header">
            <h1 class="title">Canada Loan Calculator</h1>
            <div class="country-badge">
                <img src="https://flagcdn.com/w80/ca.png" alt="Canada Flag" class="flag">
                <span>Canada</span>
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

            <div class="province-selector">
                <label for="province">Province/Territory</label>
                <select id="province">
                    <?php foreach($provinces as $province => $tax): ?>
                        <option value="<?php echo $province; ?>"><?php echo $province; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="input-group">
                <label for="loanAmount">Loan Amount (<?php echo $currency; ?>)</label>
                <input type="number" id="loanAmount" placeholder="Enter loan amount" min="1000" step="1000">
                <div class="limit-info" id="amountLimit"></div>
            </div>

            <div class="input-group">
                <label for="interestRate">Interest Rate (% per year)</label>
                <input type="number" id="interestRate" placeholder="Enter interest rate" min="0.5" max="30" step="0.1" value="4.5">
                <div class="rate-info">Current Prime Rate: 6.95%</div>
            </div>

            <div class="input-group">
                <label for="loanTenure">Loan Tenure (Years)</label>
                <input type="number" id="loanTenure" placeholder="Enter tenure in years" min="1" max="30" step="1">
                <div class="limit-info" id="tenureLimit"></div>
            </div>

            <div class="additional-options">
                <label class="checkbox-container">
                    <input type="checkbox" id="insurance" onchange="toggleInsurance()">
                    <span class="checkmark"></span>
                    Include Loan Insurance (+0.5% interest)
                </label>
            </div>

            <button class="calculate-btn" onclick="calculateLoan()">Calculate EMI</button>

            <div id="results" class="results-container" style="display: none;">
                <div class="result-header">
                    <h3>Loan Summary</h3>
                    <p id="provinceInfo" class="province-info"></p>
                </div>
                <div class="result-grid">
                    <div class="result-card">
                        <h4>Monthly Payment</h4>
                        <p id="monthlyEMI" class="result-amount">-</p>
                    </div>
                    <div class="result-card">
                        <h4>Total Payment</h4>
                        <p id="totalPayment" class="result-amount">-</p>
                    </div>
                    <div class="result-card">
                        <h4>Total Interest</h4>
                        <p id="totalInterest" class="result-amount">-</p>
                    </div>
                    <div class="result-card">
                        <h4>Interest Rate</h4>
                        <p id="effectiveRate" class="result-amount">-</p>
                    </div>
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
            </div>
        </div>

        <div class="info-section">
            <h3>Canada Loan Information</h3>
            <div class="info-grid">
                <div class="info-card">
                    <h4>🏠 Mortgage</h4>
                    <p>Rates: 4.5% - 7.5%</p>
                    <p>Amortization: Up to 30 years</p>
                    <p>CMHC Insurance: 0.6% - 4%</p>
                </div>
                <div class="info-card">
                    <h4>🚗 Auto Loan</h4>
                    <p>Rates: 3.5% - 9.5%</p>
                    <p>Term: 1-8 years</p>
                    <p>New vs Used rates vary</p>
                </div>
                <div class="info-card">
                    <h4>🎓 Student Loan</h4>
                    <p>Federal: Prime + 0%</p>
                    <p>Provincial: Varies</p>
                    <p>Repayment assistance available</p>
                </div>
                <div class="info-card">
                    <h4>💳 Personal Loan</h4>
                    <p>Rates: 6% - 20%</p>
                    <p>Term: 1-7 years</p>
                    <p>Unsecured loans</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        const loanLimits = <?php echo json_encode($loan_types); ?>;
        const provinces = <?php echo json_encode($provinces); ?>;
        let insuranceAdded = false;

        function updateLoanLimits() {
            const loanType = document.getElementById('loanType').value;
            const limits = loanLimits[loanType];
            
            document.getElementById('loanAmount').min = limits.min_amount;
            document.getElementById('loanAmount').max = limits.max_amount;
            document.getElementById('loanTenure').min = limits.min_tenure;
            document.getElementById('loanTenure').max = limits.max_tenure;
            
            document.getElementById('amountLimit').textContent = 
                `Range: ${limits.min_amount.toLocaleString()} - ${limits.max_amount.toLocaleString()} ${'<?php echo $currency; ?>'}`;
            document.getElementById('tenureLimit').textContent = 
                `Range: ${limits.min_tenure} - ${limits.max_tenure} years`;
        }

        function toggleInsurance() {
            insuranceAdded = document.getElementById('insurance').checked;
        }

        function calculateLoan() {
            const amount = parseFloat(document.getElementById('loanAmount').value);
            let rate = parseFloat(document.getElementById('interestRate').value);
            const tenure = parseFloat(document.getElementById('loanTenure').value);
            const province = document.getElementById('province').value;
            
            if (!amount || !rate || !tenure) {
                alert('Please fill all required fields');
                return;
            }

            // Add insurance cost if selected
            if (insuranceAdded) {
                rate += 0.5;
            }

            const monthlyRate = rate / 12 / 100;
            const months = tenure * 12;
            const emi = amount * monthlyRate * Math.pow(1 + monthlyRate, months) / 
                        (Math.pow(1 + monthlyRate, months) - 1);
            const totalPayment = emi * months;
            const totalInterest = totalPayment - amount;

            // Update results
            document.getElementById('monthlyEMI').textContent = 
                'C$' + emi.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
            document.getElementById('totalPayment').textContent = 
                'C$' + totalPayment.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
            document.getElementById('totalInterest').textContent = 
                'C$' + totalInterest.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
            document.getElementById('effectiveRate').textContent = 
                rate.toFixed(2) + '%' + (insuranceAdded ? ' (incl. insurance)' : '');
            document.getElementById('principalAmount').textContent = 
                'C$' + amount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
            document.getElementById('interestAmount').textContent = 
                'C$' + totalInterest.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');

            // Update province info
            document.getElementById('provinceInfo').textContent = 
                province + ' - ' + provinces[province];

            // Update chart visualization
            const principalPercent = (amount / totalPayment * 100).toFixed(1);
            const interestPercent = (totalInterest / totalPayment * 100).toFixed(1);
            
            document.getElementById('principalFill').style.width = principalPercent + '%';
            document.getElementById('interestFill').style.width = interestPercent + '%';

            document.getElementById('results').style.display = 'block';
        }

        // Initialize limits on page load
        document.addEventListener('DOMContentLoaded', function() {
            updateLoanLimits();
        });
    </script>
</body>
</html>