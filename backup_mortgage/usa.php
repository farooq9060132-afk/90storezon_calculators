<?php
$country = 'usa';
$country_name = 'United States';
$currency = '$';

// Mortgage calculation function
function calculateMortgage($principal, $interest_rate, $tenure_years, $down_payment = 0) {
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

// US Mortgage data
$mortgage_types = [
    '30-Year Fixed' => ['rate' => '6.5% - 7.5%', 'term' => 30],
    '15-Year Fixed' => ['rate' => '5.8% - 6.8%', 'term' => 15],
    'FHA Loan' => ['rate' => '6.0% - 7.0%', 'term' => 30],
    'VA Loan' => ['rate' => '5.5% - 6.5%', 'term' => 30],
    'USDA Loan' => ['rate' => '6.2% - 7.2%', 'term' => 30]
];

$states = [
    'California' => 'High cost areas',
    'Texas' => 'No state income tax',
    'Florida' => 'No state income tax',
    'New York' => 'High property taxes',
    'Illinois' => 'Moderate rates'
];
?>
<?php include '../../header.php'; ?>

<!-- SEO Elements -->
<link rel="canonical" href="https://90storezon.com/calculators/04-mortgage-calculator/usa.php">
<meta name="description" content="Free US mortgage calculator with PMI, taxes & insurance. Calculate FHA, VA, conventional loan payments. Get instant rates for all 50 states.">
<meta name="keywords" content="US mortgage calculator, home loan calculator, FHA loan calculator, VA loan calculator, mortgage payment calculator">

<!-- Structured Data -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "FinancialService",
    "name": "US Mortgage Calculator",
    "description": "Free online mortgage calculator for United States home buyers",
    "url": "https://90storezon.com/calculators/04-mortgage-calculator/usa.php",
    "areaServed": "US",
    "serviceType": "Mortgage Calculator"
}
</script>

<div class="calculator-container">
        <div class="header">
            <h1 class="title">US Mortgage Calculator</h1>
            <div class="country-badge">
                <img src="https://flagcdn.com/w80/us.png" alt="USA Flag - Mortgage Calculator" class="flag">
                <span>United States</span>
            </div>
        </div>

        <!-- Internal Links for SEO -->
        <nav class="seo-links">
            <a href="/mortgage-calculator.html">Mortgage Calculator</a> |
            <a href="/home-loan-calculator.html">Home Loan Calculator</a> |
            <a href="/fha-loan-calculator.html">FHA Loan Calculator</a> |
            <a href="/va-loan-calculator.html">VA Loan Calculator</a>
        </nav>

        <div class="calculator-card">
            <div class="input-group">
                <label for="homePrice">Home Price ($)</label>
                <input type="number" id="homePrice" placeholder="Enter home price" min="50000" step="1000" value="350000">
            </div>

            <div class="input-group">
                <label for="downPayment">Down Payment ($)</label>
                <input type="number" id="downPayment" placeholder="Enter down payment" min="0" step="1000" value="70000">
                <div class="limit-info" id="downPaymentPercent">20% down payment</div>
            </div>

            <div class="input-group">
                <label for="loanTerm">Loan Term</label>
                <select id="loanTerm">
                    <option value="30">30 Years Fixed</option>
                    <option value="15">15 Years Fixed</option>
                    <option value="20">20 Years Fixed</option>
                    <option value="10">10 Years Fixed</option>
                </select>
            </div>

            <div class="input-group">
                <label for="interestRate">Interest Rate (%)</label>
                <input type="number" id="interestRate" placeholder="Enter interest rate" min="0.1" max="20" step="0.01" value="6.5">
                <div class="rate-info">Current average: 6.5% - 7.5%</div>
            </div>

            <!-- Additional Costs -->
            <div class="additional-costs">
                <h3>Additional Monthly Costs</h3>
                <div class="input-group">
                    <label for="propertyTax">Property Tax ($/month)</label>
                    <input type="number" id="propertyTax" placeholder="Property tax" min="0" step="10" value="300">
                </div>
                <div class="input-group">
                    <label for="homeInsurance">Home Insurance ($/month)</label>
                    <input type="number" id="homeInsurance" placeholder="Home insurance" min="0" step="10" value="100">
                </div>
                <div class="input-group">
                    <label for="pmi">PMI ($/month)</label>
                    <input type="number" id="pmi" placeholder="PMI insurance" min="0" step="10" value="0">
                </div>
            </div>

            <button class="calculate-btn" onclick="calculateMortgage()">Calculate Mortgage Payment</button>

            <div id="results" class="results-container" style="display: none;">
                <div class="result-header">
                    <h3>Mortgage Payment Summary</h3>
                </div>
                <div class="result-grid">
                    <div class="result-card">
                        <h4>Principal & Interest</h4>
                        <p id="principalInterest" class="result-amount">-</p>
                    </div>
                    <div class="result-card">
                        <h4>Monthly Payment</h4>
                        <p id="monthlyPayment" class="result-amount">-</p>
                    </div>
                    <div class="result-card">
                        <h4>Total Loan Amount</h4>
                        <p id="totalLoan" class="result-amount">-</p>
                    </div>
                    <div class="result-card">
                        <h4>Total Interest</h4>
                        <p id="totalInterest" class="result-amount">-</p>
                    </div>
                </div>
                
                <!-- Payment Breakdown -->
                <div class="breakdown-section">
                    <h4>Monthly Payment Breakdown</h4>
                    <div class="breakdown-chart">
                        <div class="chart-bar">
                            <div class="chart-label">Principal & Interest</div>
                            <div class="chart-value" id="breakdownPI">-</div>
                            <div class="chart-fill principal-fill" id="fillPI"></div>
                        </div>
                        <div class="chart-bar">
                            <div class="chart-label">Property Tax</div>
                            <div class="chart-value" id="breakdownTax">-</div>
                            <div class="chart-fill tax-fill" id="fillTax"></div>
                        </div>
                        <div class="chart-bar">
                            <div class="chart-label">Home Insurance</div>
                            <div class="chart-value" id="breakdownInsurance">-</div>
                            <div class="chart-fill insurance-fill" id="fillInsurance"></div>
                        </div>
                        <div class="chart-bar">
                            <div class="chart-label">PMI</div>
                            <div class="chart-value" id="breakdownPMI">-</div>
                            <div class="chart-fill pmi-fill" id="fillPMI"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- SEO Content Section -->
        <section class="seo-content">
            <h2>US Mortgage Calculator - Calculate Your Home Loan Payments</h2>
            <p>Our <strong>US mortgage calculator</strong> helps you estimate monthly payments for <strong>FHA loans, VA loans, conventional mortgages</strong> and other home financing options. Calculate with accurate <strong>property taxes, home insurance, and PMI</strong> costs included.</p>
            
            <h3>Popular Mortgage Types in United States</h3>
            <ul>
                <li><strong>30-Year Fixed Mortgage</strong> - Most popular with stable payments</li>
                <li><strong>15-Year Fixed Mortgage</strong> - Faster payoff with lower interest</li>
                <li><strong>FHA Loans</strong> - Lower down payments for first-time buyers</li>
                <li><strong>VA Loans</strong> - Zero down payment for veterans</li>
                <li><strong>USDA Loans</strong> - Rural development programs</li>
            </ul>

            <h3>Mortgage Calculator Features</h3>
            <p>Our advanced <strong>home loan calculator</strong> includes all major cost components: principal, interest, property taxes, homeowners insurance, and private mortgage insurance (PMI). Get accurate estimates for <strong>California, Texas, Florida, New York</strong> and all 50 states.</p>
        </section>

    </div>

    <script>
    function calculateMortgage() {
        const homePrice = parseFloat(document.getElementById('homePrice').value);
        const downPayment = parseFloat(document.getElementById('downPayment').value);
        const loanTerm = parseInt(document.getElementById('loanTerm').value);
        const interestRate = parseFloat(document.getElementById('interestRate').value);
        const propertyTax = parseFloat(document.getElementById('propertyTax').value) || 0;
        const homeInsurance = parseFloat(document.getElementById('homeInsurance').value) || 0;
        const pmi = parseFloat(document.getElementById('pmi').value) || 0;

        if (!homePrice || !downPayment || !loanTerm || !interestRate) {
            alert('Please fill in all required fields');
            return;
        }

        const loanAmount = homePrice - downPayment;
        const monthlyRate = interestRate / 12 / 100;
        const months = loanTerm * 12;

        // Calculate principal and interest
        const monthlyPI = loanAmount * monthlyRate * Math.pow(1 + monthlyRate, months) / 
                         (Math.pow(1 + monthlyRate, months) - 1);

        const totalMonthly = monthlyPI + propertyTax + homeInsurance + pmi;
        const totalInterest = (monthlyPI * months) - loanAmount;

        // Update results
        document.getElementById('principalInterest').textContent = '$' + monthlyPI.toFixed(2);
        document.getElementById('monthlyPayment').textContent = '$' + totalMonthly.toFixed(2);
        document.getElementById('totalLoan').textContent = '$' + loanAmount.toLocaleString();
        document.getElementById('totalInterest').textContent = '$' + totalInterest.toLocaleString();

        // Update breakdown
        document.getElementById('breakdownPI').textContent = '$' + monthlyPI.toFixed(2);
        document.getElementById('breakdownTax').textContent = '$' + propertyTax.toFixed(2);
        document.getElementById('breakdownInsurance').textContent = '$' + homeInsurance.toFixed(2);
        document.getElementById('breakdownPMI').textContent = '$' + pmi.toFixed(2);

        // Update chart
        const total = totalMonthly;
        document.getElementById('fillPI').style.width = (monthlyPI / total * 100) + '%';
        document.getElementById('fillTax').style.width = (propertyTax / total * 100) + '%';
        document.getElementById('fillInsurance').style.width = (homeInsurance / total * 100) + '%';
        document.getElementById('fillPMI').style.width = (pmi / total * 100) + '%';

        document.getElementById('results').style.display = 'block';
    }

    // Update down payment percentage
    document.getElementById('homePrice').addEventListener('input', updateDownPaymentPercent);
    document.getElementById('downPayment').addEventListener('input', updateDownPaymentPercent);

    function updateDownPaymentPercent() {
        const homePrice = parseFloat(document.getElementById('homePrice').value) || 0;
        const downPayment = parseFloat(document.getElementById('downPayment').value) || 0;
        
        if (homePrice > 0) {
            const percent = (downPayment / homePrice * 100).toFixed(1);
            document.getElementById('downPaymentPercent').textContent = percent + '% down payment';
        }
    }

    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        updateDownPaymentPercent();
    });
    </script>

<?php include '../../footer.php'; ?>