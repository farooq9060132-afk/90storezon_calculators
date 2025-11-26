<?php
$country = 'uk';
$country_name = 'United Kingdom';
$currency = '£';

// UK Mortgage calculation
function calculateUKMortgage($principal, $interest_rate, $tenure_years, $down_payment = 0) {
    $loan_amount = $principal - $down_payment;
    $monthly_rate = ($interest_rate / 12) / 100;
    $tenure_months = $tenure_years * 12;
    
    $monthly_payment = $loan_amount * $monthly_rate * pow(1 + $monthly_rate, $tenure_months) / 
                      (pow(1 + $monthly_rate, $tenure_months) - 1);
    
    return [
        'monthly_payment' => round($monthly_payment, 2),
        'total_loan' => $loan_amount,
        'total_interest' => round(($monthly_payment * $tenure_months) - $loan_amount, 2)
    ];
}

// UK Mortgage data
$mortgage_types = [
    'Fixed Rate (2 years)' => ['rate' => '4.5% - 5.5%', 'term' => 2],
    'Fixed Rate (5 years)' => ['rate' => '4.8% - 5.8%', 'term' => 5],
    'Tracker Mortgage' => ['rate' => '5.2% - 6.2%', 'term' => 2],
    'Help to Buy' => ['rate' => '3.5% - 4.5%', 'term' => 5],
    'Buy to Let' => ['rate' => '5.5% - 6.5%', 'term' => 5]
];

$regions = [
    'England' => 'Help to Buy scheme available',
    'Scotland' => 'First Home Fund',
    'Wales' => 'Help to Buy Wales', 
    'Northern Ireland' => 'Co-ownership scheme',
    'London' => 'London Help to Buy'
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UK Mortgage Calculator - Calculate Home Loan Payments | UK Property Finance</title>
    <meta name="description" content="Free UK mortgage calculator with stamp duty, help to buy schemes. Calculate buy to let, fixed rate mortgages for England, Scotland, Wales & Northern Ireland.">
    
    <!-- VIP Backlinks -->
    <link rel="canonical" href="https://yourwebsite.com/uk.php">
    <link rel="preconnect" href="https://gmpg.org">
    <link rel="preconnect" href="https://www.google.co.uk">
    
    <!-- Structured Data -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "FinancialService",
        "name": "UK Mortgage Calculator",
        "description": "Free online mortgage calculator for UK property buyers including England, Scotland, Wales and Northern Ireland",
        "url": "https://yourwebsite.com/uk.php",
        "areaServed": "GB",
        "serviceType": "Mortgage Calculator"
    }
    </script>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="calculator-container">
        <div class="header">
            <h1 class="title">UK Mortgage Calculator</h1>
            <div class="country-badge">
                <img src="https://flagcdn.com/w80/gb.png" alt="UK Flag - Mortgage Calculator" class="flag">
                <span>United Kingdom</span>
            </div>
        </div>

        <!-- Internal Links for SEO -->
        <nav class="seo-links">
            <a href="/uk-mortgage-calculator.html">UK Mortgage Calculator</a> |
            <a href="/help-to-buy-calculator.html">Help to Buy Calculator</a> |
            <a href="/stamp-duty-calculator.html">Stamp Duty Calculator</a> |
            <a href="/buy-to-let-calculator.html">Buy to Let Calculator</a>
        </nav>

        <div class="calculator-card">
            <div class="input-group">
                <label for="propertyValue">Property Value (£)</label>
                <input type="number" id="propertyValue" placeholder="Enter property value" min="50000" step="1000" value="300000">
            </div>

            <div class="input-group">
                <label for="depositAmount">Deposit Amount (£)</label>
                <input type="number" id="depositAmount" placeholder="Enter deposit amount" min="0" step="1000" value="45000">
                <div class="limit-info" id="depositPercent">15% deposit</div>
            </div>

            <div class="input-group">
                <label for="region">UK Region</label>
                <select id="region">
                    <option value="England">England</option>
                    <option value="Scotland">Scotland</option>
                    <option value="Wales">Wales</option>
                    <option value="Northern Ireland">Northern Ireland</option>
                    <option value="London">London</option>
                </select>
            </div>

            <div class="input-group">
                <label for="loanTerm">Mortgage Term</label>
                <select id="loanTerm">
                    <option value="25">25 Years</option>
                    <option value="30">30 Years</option>
                    <option value="20">20 Years</option>
                    <option value="15">15 Years</option>
                    <option value="35">35 Years</option>
                </select>
            </div>

            <div class="input-group">
                <label for="interestRate">Interest Rate (%)</label>
                <input type="number" id="interestRate" placeholder="Enter interest rate" min="0.1" max="15" step="0.01" value="4.8">
                <div class="rate-info">Current average: 4.5% - 5.5%</div>
            </div>

            <!-- UK Specific Options -->
            <div class="additional-options">
                <h3>UK Mortgage Schemes</h3>
                <label class="checkbox-container">
                    <input type="checkbox" id="helpToBuy" onchange="toggleHelpToBuy()">
                    <span class="checkmark"></span>
                    Help to Buy Scheme
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" id="firstTimeBuyer" onchange="calculateStampDuty()">
                    <span class="checkmark"></span>
                    First-time Buyer
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" id="buyToLet" onchange="toggleBuyToLet()">
                    <span class="checkmark"></span>
                    Buy to Let Mortgage
                </label>
            </div>

            <!-- Stamp Duty Calculator -->
            <div class="stamp-duty-calculator">
                <h3>Stamp Duty Land Tax (SDLT)</h3>
                <div id="stampDutyResult" class="stamp-duty-result">
                    Stamp Duty: £0
                </div>
            </div>

            <button class="calculate-btn" onclick="calculateUKMortgage()">Calculate Mortgage Payment</button>

            <div id="results" class="results-container" style="display: none;">
                <div class="result-header">
                    <h3>UK Mortgage Summary</h3>
                </div>
                <div class="result-grid">
                    <div class="result-card">
                        <h4>Monthly Payment</h4>
                        <p id="monthlyPayment" class="result-amount">-</p>
                    </div>
                    <div class="result-card">
                        <h4>Total Mortgage</h4>
                        <p id="totalMortgage" class="result-amount">-</p>
                    </div>
                    <div class="result-card">
                        <h4>Total Interest</h4>
                        <p id="totalInterest" class="result-amount">-</p>
                    </div>
                    <div class="result-card">
                        <h4>Loan to Value</h4>
                        <p id="ltvRatio" class="result-amount">-</p>
                    </div>
                </div>
                
                <!-- Affordability Check -->
                <div class="affordability-check">
                    <h4>Affordability Check</h4>
                    <div class="affordability-meter">
                        <div class="affordability-fill" id="affordabilityFill"></div>
                    </div>
                    <p id="affordabilityText" class="affordability-text"></p>
                </div>
            </div>
        </div>

        <!-- SEO Content Section -->
        <section class="seo-content">
            <h2>UK Mortgage Calculator - Calculate Your Home Loan Payments</h2>
            <p>Our comprehensive <strong>UK mortgage calculator</strong> helps home buyers across <strong>England, Scotland, Wales, and Northern Ireland</strong> estimate their monthly payments. Calculate <strong>Help to Buy schemes, stamp duty costs, and buy to let mortgages</strong> with accurate UK-specific calculations.</p>
            
            <h3>Popular Mortgage Types in United Kingdom</h3>
            <ul>
                <li><strong>Fixed Rate Mortgages</strong> - 2, 5, or 10 year fixed terms</li>
                <li><strong>Tracker Mortgages</strong> - Follows Bank of England base rate</li>
                <li><strong>Help to Buy</strong> - Government equity loan scheme</li>
                <li><strong>Buy to Let</strong> - Investment property mortgages</li>
                <li><strong>First-time Buyer Mortgages</strong> - Special schemes for new buyers</li>
            </ul>

            <h3>UK Regions Mortgage Information</h3>
            <p>Our calculator works for all UK regions including <strong>London properties, Scottish first home fund, Welsh help to buy, and Northern Ireland co-ownership schemes</strong>. Get accurate <strong>stamp duty land tax calculations</strong> based on current UK government rates.</p>
        </section>

        <!-- VIP Backlinks Footer -->
        <footer class="seo-footer">
            <div class="footer-links">
                <h4>UK Mortgage Calculators</h4>
                <a href="/london-mortgage-calculator.html">London Mortgage Calculator</a> |
                <a href="/scotland-mortgage-calculator.html">Scotland Mortgage Calculator</a> |
                <a href="/wales-mortgage-calculator.html">Wales Mortgage Calculator</a> |
                <a href="/first-time-buyer-calculator.html">First Time Buyer Calculator</a>
            </div>
            
            <div class="external-links">
                <h4>UK Mortgage Resources</h4>
                <a href="https://www.helptobuy.gov.uk" rel="nofollow">Help to Buy Official</a> |
                <a href="https://www.gov.uk/stamp-duty-land-tax" rel="nofollow">GOV.UK Stamp Duty</a> |
                <a href="https://www.fca.org.uk" rel="nofollow">Financial Conduct Authority</a> |
                <a href="https://www.moneysavingexpert.com/mortgages" rel="nofollow">Money Saving Expert</a>
            </div>
        </footer>
    </div>

    <script>
    function calculateUKMortgage() {
        const propertyValue = parseFloat(document.getElementById('propertyValue').value);
        const depositAmount = parseFloat(document.getElementById('depositAmount').value);
        const loanTerm = parseInt(document.getElementById('loanTerm').value);
        const interestRate = parseFloat(document.getElementById('interestRate').value);
        const isFirstTimeBuyer = document.getElementById('firstTimeBuyer').checked;
        const isBuyToLet = document.getElementById('buyToLet').checked;

        if (!propertyValue || !depositAmount || !loanTerm || !interestRate) {
            alert('Please fill in all required fields');
            return;
        }

        const loanAmount = propertyValue - depositAmount;
        const monthlyRate = interestRate / 12 / 100;
        const months = loanTerm * 12;

        // Calculate monthly payment
        const monthlyPayment = loanAmount * monthlyRate * Math.pow(1 + monthlyRate, months) / 
                              (Math.pow(1 + monthlyRate, months) - 1);

        const totalInterest = (monthlyPayment * months) - loanAmount;
        const ltvRatio = (loanAmount / propertyValue * 100).toFixed(1);

        // Update results
        document.getElementById('monthlyPayment').textContent = '£' + monthlyPayment.toFixed(2);
        document.getElementById('totalMortgage').textContent = '£' + (loanAmount + totalInterest).toLocaleString();
        document.getElementById('totalInterest').textContent = '£' + totalInterest.toLocaleString();
        document.getElementById('ltvRatio').textContent = ltvRatio + '%';

        // Affordability check (assuming average UK salary)
        const averageSalary = 33000;
        const annualPayment = monthlyPayment * 12;
        const affordabilityRatio = (annualPayment / averageSalary * 100);

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

        document.getElementById('results').style.display = 'block';
    }

    function calculateStampDuty() {
        const propertyValue = parseFloat(document.getElementById('propertyValue').value) || 0;
        const isFirstTimeBuyer = document.getElementById('firstTimeBuyer').checked;
        const isBuyToLet = document.getElementById('buyToLet').checked;

        let stampDuty = 0;

        if (isFirstTimeBuyer) {
            // First-time buyer relief
            if (propertyValue <= 425000) {
                stampDuty = 0;
            } else if (propertyValue <= 625000) {
                stampDuty = (propertyValue - 425000) * 0.05;
            } else {
                stampDuty = calculateStandardStampDuty(propertyValue);
            }
        } else if (isBuyToLet) {
            // Additional 3% surcharge for buy to let
            stampDuty = calculateStandardStampDuty(propertyValue) + (propertyValue * 0.03);
        } else {
            stampDuty = calculateStandardStampDuty(propertyValue);
        }

        document.getElementById('stampDutyResult').textContent = 
            'Stamp Duty: £' + stampDuty.toLocaleString('en-GB', {maximumFractionDigits: 0});
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
        const helpToBuy = document.getElementById('helpToBuy').checked;
        if (helpToBuy) {
            // Adjust calculations for Help to Buy scheme
            document.getElementById('depositAmount').value = 
                Math.round(parseFloat(document.getElementById('propertyValue').value) * 0.05);
            updateDepositPercent();
        }
    }

    function toggleBuyToLet() {
        calculateStampDuty();
    }

    // Update deposit percentage
    document.getElementById('propertyValue').addEventListener('input', updateDepositPercent);
    document.getElementById('depositAmount').addEventListener('input', updateDepositPercent);

    function updateDepositPercent() {
        const propertyValue = parseFloat(document.getElementById('propertyValue').value) || 0;
        const depositAmount = parseFloat(document.getElementById('depositAmount').value) || 0;
        
        if (propertyValue > 0) {
            const percent = (depositAmount / propertyValue * 100).toFixed(1);
            document.getElementById('depositPercent').textContent = percent + '% deposit';
        }
    }

    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        updateDepositPercent();
        calculateStampDuty();
    });
    </script>
</body>
</html>