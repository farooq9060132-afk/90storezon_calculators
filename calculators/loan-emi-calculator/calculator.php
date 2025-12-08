<?php
// Get country from URL parameter or set default
$country = isset($_GET['country']) ? $_GET['country'] : 'pakistan';
$country_name = ucfirst($country);

// Set currency based on country
$currencies = [
    'pakistan' => 'PKR',
    'india' => '₹',
    'usa' => '$',
    'uk' => '£',
    'uae' => 'AED',
    'canada' => 'C$',
    'australia' => 'A$'
];

$currency = isset($currencies[$country]) ? $currencies[$country] : '$';

// Loan calculation function
function calculateEMI($principal, $interest_rate, $tenure_months) {
    $monthly_rate = ($interest_rate / 12) / 100;
    $emi = $principal * $monthly_rate * pow(1 + $monthly_rate, $tenure_months) / 
           (pow(1 + $monthly_rate, $tenure_months) - 1);
    return round($emi, 2);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Calculator - <?php echo $country_name; ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="calculator-container">
        <div class="header">
            <h1 class="title">Loan Calculator</h1>
            <div class="country-selector">
                <span>Country: <?php echo $country_name; ?></span>
                <select id="countrySelect" onchange="changeCountry()">
                    <option value="pakistan" <?php echo $country == 'pakistan' ? 'selected' : ''; ?>>Pakistan</option>
                    <option value="india" <?php echo $country == 'india' ? 'selected' : ''; ?>>India</option>
                    <option value="usa" <?php echo $country == 'usa' ? 'selected' : ''; ?>>USA</option>
                    <option value="uk" <?php echo $country == 'uk' ? 'selected' : ''; ?>>UK</option>
                    <option value="uae" <?php echo $country == 'uae' ? 'selected' : ''; ?>>UAE</option>
                    <option value="canada" <?php echo $country == 'canada' ? 'selected' : ''; ?>>Canada</option>
                    <option value="australia" <?php echo $country == 'australia' ? 'selected' : ''; ?>>Australia</option>
                </select>
            </div>
        </div>

        <div class="calculator-card">
            <div class="input-group">
                <label for="loanAmount">Loan Amount (<?php echo $currency; ?>)</label>
                <input type="number" id="loanAmount" placeholder="Enter loan amount" min="1000" step="1000">
            </div>

            <div class="input-group">
                <label for="interestRate">Interest Rate (% per year)</label>
                <input type="number" id="interestRate" placeholder="Enter interest rate" min="1" max="50" step="0.1">
            </div>

            <div class="input-group">
                <label for="loanTenure">Loan Tenure (Years)</label>
                <input type="number" id="loanTenure" placeholder="Enter tenure in years" min="1" max="30" step="1">
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
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>