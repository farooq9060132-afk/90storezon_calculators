<?php
$country = 'australia';
$country_name = 'Australia';
$currency = 'A$';

// Loan calculation function
function calculateEMI($principal, $interest_rate, $tenure_months) {
    $monthly_rate = ($interest_rate / 12) / 100;
    $emi = $principal * $monthly_rate * pow(1 + $monthly_rate, $tenure_months) / 
           (pow(1 + $monthly_rate, $tenure_months) - 1);
    return round($emi, 2);
}

// Australia specific loan data
$loan_types = [
    'Home Loan' => ['min_amount' => 10000, 'max_amount' => 2000000, 'min_tenure' => 1, 'max_tenure' => 30],
    'Car Loan' => ['min_amount' => 5000, 'max_amount' => 100000, 'min_tenure' => 1, 'max_tenure' => 7],
    'Personal Loan' => ['min_amount' => 1000, 'max_amount' => 50000, 'min_tenure' => 1, 'max_tenure' => 5]
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Calculator - Australia</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="calculator-container">
        <div class="header">
            <h1 class="title">Australia Loan Calculator</h1>
            <div class="country-badge">
                <img src="https://flagcdn.com/w80/au.png" alt="Australia Flag" class="flag">
                <span>Australia</span>
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
                <label for="loanAmount">Loan Amount (<?php echo $currency; ?>)</label>
                <input type="number" id="loanAmount" placeholder="Enter loan amount" min="1000" step="1000">
                <div class="limit-info" id="amountLimit"></div>
            </div>

            <div class="input-group">
                <label for="interestRate">Interest Rate (% per year)</label>
                <input type="number" id="interestRate" placeholder="Enter interest rate" min="1" max="25" step="0.1" value="6.5">
            </div>

            <div class="input-group">
                <label for="loanTenure">Loan Tenure (Years)</label>
                <input type="number" id="loanTenure" placeholder="Enter tenure in years" min="1" max="30" step="1">
                <div class="limit-info" id="tenureLimit"></div>
            </div>

            <button class="calculate-btn" onclick="calculateLoan()">Calculate EMI</button>

            <div id="results" class="results-container" style="display: none;">
                <div class="result-card">
                    <h3>Monthly EMI</h3>
                    <p id="monthlyEMI" class="result-amount">-</p>
                </div>
                <div class="result-card">
                    <h3>Total Payment</h3>
                    <p id="totalPayment" class="result-amount">-</p>
                </div>
                <div class="result-card">
                    <h3>Total Interest</h3>
                    <p id="totalInterest" class="result-amount">-</p>
                </div>
                <div class="breakdown-card">
                    <h4>Payment Breakdown</h4>
                    <div class="breakdown-chart">
                        <div class="chart-principal">
                            <span>Principal</span>
                            <span id="principalAmount">-</span>
                        </div>
                        <div class="chart-interest">
                            <span>Interest</span>
                            <span id="interestAmount">-</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="info-section">
            <h3>Australia Loan Information</h3>
            <div class="info-grid">
                <div class="info-card">
                    <h4>🏠 Home Loans</h4>
                    <p>Typical rates: 5.5% - 7.5%</p>
                    <p>Max tenure: 30 years</p>
                </div>
                <div class="info-card">
                    <h4>🚗 Car Loans</h4>
                    <p>Typical rates: 6% - 12%</p>
                    <p>Max tenure: 7 years</p>
                </div>
                <div class="info-card">
                    <h4>💳 Personal Loans</h4>
                    <p>Typical rates: 8% - 15%</p>
                    <p>Max tenure: 5 years</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        const loanLimits = <?php echo json_encode($loan_types); ?>;

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

        // Initialize limits on page load
        document.addEventListener('DOMContentLoaded', function() {
            updateLoanLimits();
        });

        function calculateLoan() {
            const amount = parseFloat(document.getElementById('loanAmount').value);
            const rate = parseFloat(document.getElementById('interestRate').value);
            const tenure = parseFloat(document.getElementById('loanTenure').value);
            
            if (!amount || !rate || !tenure) {
                alert('Please fill all fields');
                return;
            }

            const monthlyRate = rate / 12 / 100;
            const months = tenure * 12;
            const emi = amount * monthlyRate * Math.pow(1 + monthlyRate, months) / 
                        (Math.pow(1 + monthlyRate, months) - 1);
            const totalPayment = emi * months;
            const totalInterest = totalPayment - amount;

            document.getElementById('monthlyEMI').textContent = 
                'A$' + emi.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
            document.getElementById('totalPayment').textContent = 
                'A$' + totalPayment.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
            document.getElementById('totalInterest').textContent = 
                'A$' + totalInterest.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
            document.getElementById('principalAmount').textContent = 
                'A$' + amount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
            document.getElementById('interestAmount').textContent = 
                'A$' + totalInterest.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');

            document.getElementById('results').style.display = 'block';
        }
    </script>
</body>
</html>