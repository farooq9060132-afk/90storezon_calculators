<?php
$country = 'canada';
$country_name = 'Canada';
$currency = 'C$';

// Canada Mortgage calculation
function calculateCAMortgage($principal, $interest_rate, $tenure_years, $down_payment = 0) {
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

// Canada Mortgage data
$mortgage_types = [
    'Fixed Rate (5 year)' => ['rate' => '4.8% - 5.8%', 'term' => 5],
    'Variable Rate' => ['rate' => '5.2% - 6.2%', 'term' => 5],
    'High-Ratio Mortgage' => ['rate' => '5.5% - 6.5%', 'term' => 25],
    'Conventional Mortgage' => ['rate' => '4.5% - 5.5%', 'term' => 25],
    'CMHC Insured' => ['rate' => '5.0% - 6.0%', 'term' => 25]
];

$provinces = [
    'Ontario' => 'Toronto, Ottawa - High prices',
    'British Columbia' => 'Vancouver - Expensive market',
    'Quebec' => 'Montreal - Moderate prices',
    'Alberta' => 'Calgary, Edmonton - Affordable',
    'Manitoba' => 'Winnipeg - Low cost'
];
?>
<?php include '../../header.php'; ?>

<!-- SEO Elements -->
<link rel="canonical" href="https://90storezon.com/calculators/04-mortgage-calculator/canada.php">
<meta name="description" content="Free Canada mortgage calculator with CMHC insurance, land transfer tax. Calculate mortgage payments for Toronto, Vancouver, Montreal, Calgary properties.">
<meta name="keywords" content="Canada mortgage calculator, home loan calculator, CMHC insurance calculator, land transfer tax calculator, Canadian mortgage calculator">

<!-- Structured Data -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "FinancialService",
    "name": "Canada Mortgage Calculator",
    "description": "Free online mortgage calculator for Canadian home buyers including CMHC insurance and land transfer tax calculations",
    "url": "https://90storezon.com/calculators/04-mortgage-calculator/canada.php",
    "areaServed": "CA",
    "serviceType": "Mortgage Calculator"
}
</script>

<div class="calculator-container">
        <div class="header">
            <h1 class="title">Canada Mortgage Calculator</h1>
            <div class="country-badge">
                <img src="https://flagcdn.com/w80/ca.png" alt="Canada Flag - Mortgage Calculator" class="flag">
                <span>Canada</span>
            </div>
        </div>

        <!-- Internal Links for SEO -->
        <nav class="seo-links">
            <a href="https://90storezon.com/calculators/01-loan-emi-calculator/">Loan Calculator</a> |
            <a href="https://90storezon.com/calculators/01-loan-emi-calculator/usa.php">USA Mortgage Calculator</a> |
            <a href="https://90storezon.com/calculators/01-loan-emi-calculator/uk.php">UK Mortgage Calculator</a> |
            <a href="https://90storezon.com/calculators/01-loan-emi-calculator/australia.php">Australia Mortgage Calculator</a>
        </nav>

        <div class="calculator-card">
            <div class="input-group">
                <label for="homePrice">Home Price (C$)</label>
                <input type="number" id="homePrice" placeholder="Enter home price" min="100000" step="1000" value="600000">
            </div>

            <div class="input-group">
                <label for="downPayment">Down Payment (C$)</label>
                <input type="number" id="downPayment" placeholder="Enter down payment" min="0" step="1000" value="120000">
                <div class="limit-info" id="downPaymentPercent">20% down payment</div>
            </div>

            <div class="input-group">
                <label for="province">Province</label>
                <select id="province">
                    <option value="Ontario">Ontario</option>
                    <option value="British Columbia">British Columbia</option>
                    <option value="Quebec">Quebec</option>
                    <option value="Alberta">Alberta</option>
                    <option value="Manitoba">Manitoba</option>
                    <option value="Saskatchewan">Saskatchewan</option>
                    <option value="Nova Scotia">Nova Scotia</option>
                    <option value="New Brunswick">New Brunswick</option>
                </select>
            </div>

            <div class="input-group">
                <label for="amortization">Amortization Period</label>
                <select id="amortization">
                    <option value="25">25 Years</option>
                    <option value="30">30 Years</option>
                    <option value="20">20 Years</option>
                    <option value="15">15 Years</option>
                </select>
            </div>

            <div class="input-group">
                <label for="interestRate">Interest Rate (%)</label>
                <input type="number" id="interestRate" placeholder="Enter interest rate" min="0.1" max="15" step="0.01" value="5.2">
                <div class="rate-info">Current fixed rates: 4.8% - 5.8%</div>
            </div>

            <!-- Canada Specific Options -->
            <div class="additional-options">
                <h3>Canadian Mortgage Options</h3>
                <label class="checkbox-container">
                    <input type="checkbox" id="cmhcInsurance" onchange="toggleCMHC()">
                    <span class="checkmark"></span>
                    CMHC Mortgage Insurance
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" id="firstTimeBuyer" onchange="toggleFirstTimeBuyer()">
                    <span class="checkmark"></span>
                    First-Time Home Buyer
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" id="investmentProperty" onchange="toggleInvestmentProperty()">
                    <span class="checkmark"></span>
                    Investment Property
                </label>
            </div>

            <!-- CMHC Insurance Calculator -->
            <div class="cmhc-calculator" id="cmhcSection" style="display: none;">
                <h4>CMHC Insurance Premium</h4>
                <div class="input-group">
                    <label for="cmhcPremium">CMHC Premium (C$)</label>
                    <input type="number" id="cmhcPremium" placeholder="CMHC premium amount" min="0" step="100" value="0">
                </div>
                <div class="limit-info" id="cmhcPremiumPercent">Premium: 0%</div>
            </div>

            <!-- Land Transfer Tax Calculator -->
            <div class="tax-calculator">
                <h3>Land Transfer Tax</h3>
                <div id="landTransferTax" class="tax-result">
                    Land Transfer Tax: C$0
                </div>
            </div>

            <button class="calculate-btn" onclick="calculateCAMortgage()">Calculate Mortgage Payment</button>

            <div id="results" class="results-container" style="display: none;">
                <div class="result-header">
                    <h3>Canadian Mortgage Summary</h3>
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
                
                <!-- Mortgage Stress Test -->
                <div class="stress-test">
                    <h4>Mortgage Stress Test</h4>
                    <div class="stress-test-meter">
                        <div class="stress-test-fill" id="stressTestFill"></div>
                    </div>
                    <p id="stressTestText" class="stress-test-text"></p>
                </div>

                <!-- CMHC Insurance Info -->
                <div class="cmhc-info" id="cmhcInfo" style="display: none;">
                    <h4>CMHC Insured Mortgage</h4>
                    <p>Your mortgage is CMHC insured. This allows for a lower down payment but includes insurance premiums.</p>
                </div>
            </div>
        </div>

        <!-- SEO Content Section -->
        <section class="seo-content">
            <h2>Canada Mortgage Calculator - Calculate Home Loan Payments</h2>
            <p>Our comprehensive <strong>Canada mortgage calculator</strong> helps home buyers across <strong>Toronto, Vancouver, Montreal, Calgary, and all Canadian provinces</strong> estimate their monthly payments. Calculate <strong>CMHC insurance, land transfer tax, and mortgage stress test</strong> requirements with accurate Canadian-specific calculations.</p>
            
            <h3>Popular Mortgage Types in Canada</h3>
            <ul>
                <li><strong>Fixed Rate Mortgages</strong> - 5-year fixed terms most common</li>
                <li><strong>Variable Rate Mortgages</strong> - Prime rate minus discount</li>
                <li><strong>High-Ratio Mortgages</strong> - Less than 20% down payment</li>
                <li><strong>Conventional Mortgages</strong> - 20% or more down payment</li>
                <li><strong>CMHC Insured Mortgages</strong> - Government-backed insurance</li>
            </ul>

            <h3>Canadian Mortgage Regulations</h3>
            <p>Canadian mortgages require a <strong>stress test</strong> at the higher of 5.25% or your contract rate plus 2%. Our calculator includes this requirement and helps you understand <strong>amortization periods, land transfer taxes by province, and CMHC insurance premiums</strong> for high-ratio mortgages.</p>

            <h3>First-Time Home Buyer Programs</h3>
            <p>Canadian first-time home buyers can access programs like the <strong>Home Buyers' Plan (HBP), First-Time Home Buyer Incentive, and land transfer tax rebates</strong>. Our calculator helps you understand how these programs affect your mortgage affordability.</p>
        </section>

        <!-- VIP Backlinks Footer -->
        <footer class="seo-footer">
            <div class="footer-links">
                <h4>International Mortgage Calculators</h4>
                <a href="https://90storezon.com/calculators/01-loan-emi-calculator/usa.php">USA Mortgage Calculator</a> |
                <a href="https://90storezon.com/calculators/01-loan-emi-calculator/uk.php">UK Mortgage Calculator</a> |
                <a href="https://90storezon.com/calculators/01-loan-emi-calculator/australia.php">Australia Mortgage Calculator</a> |
                <a href="https://90storezon.com/calculators/01-loan-emi-calculator/india.php">India Mortgage Calculator</a>
            </div>
            
            <div class="external-links">
                <h4>Canadian Mortgage Resources</h4>
                <a href="https://www.cmhc-schl.gc.ca" rel="nofollow">CMHC Official Site</a> |
                <a href="https://www.canada.ca/en/financial-consumer-agency/services/mortgages.html" rel="nofollow">FCAC Mortgages</a> |
                <a href="https://www.osfi-bsif.gc.ca" rel="nofollow">OSFI Regulations</a> |
                <a href="https://www.rbcroyalbank.com/mortgages/mortgage-calculator.html" rel="nofollow">RBC Mortgage Calculator</a>
            </div>
        </footer>
    </div>

    <script>
    function calculateCAMortgage() {
        const homePrice = parseFloat(document.getElementById('homePrice').value);
        const downPayment = parseFloat(document.getElementById('downPayment').value);
        const amortization = parseInt(document.getElementById('amortization').value);
        const interestRate = parseFloat(document.getElementById('interestRate').value);
        const isCMHC = document.getElementById('cmhcInsurance').checked;
        const cmhcPremium = parseFloat(document.getElementById('cmhcPremium').value) || 0;

        if (!homePrice || !downPayment || !amortization || !interestRate) {
            alert('Please fill in all required fields');
            return;
        }

        let loanAmount = homePrice - downPayment;
        const downPaymentPercent = (downPayment / homePrice * 100);
        
        // Add CMHC premium to loan if applicable
        if (isCMHC && downPaymentPercent < 20) {
            loanAmount += cmhcPremium;
        }

        const monthlyRate = interestRate / 12 / 100;
        const months = amortization * 12;

        // Calculate monthly payment
        const monthlyPayment = loanAmount * monthlyRate * Math.pow(1 + monthlyRate, months) / 
                              (Math.pow(1 + monthlyRate, months) - 1);

        const totalInterest = (monthlyPayment * months) - loanAmount;
        const ltvRatio = (loanAmount / homePrice * 100).toFixed(1);

        // Update results
        document.getElementById('monthlyPayment').textContent = 'C$' + monthlyPayment.toFixed(2);
        document.getElementById('totalMortgage').textContent = 'C$' + (loanAmount + totalInterest).toLocaleString();
        document.getElementById('totalInterest').textContent = 'C$' + totalInterest.toLocaleString();
        document.getElementById('ltvRatio').textContent = ltvRatio + '%';

        // Mortgage Stress Test (Canadian requirement)
        const stressTestRate = Math.max(5.25, interestRate + 2);
        const stressTestPayment = loanAmount * (stressTestRate / 12 / 100) * Math.pow(1 + (stressTestRate / 12 / 100), months) / 
                                 (Math.pow(1 + (stressTestRate / 12 / 100), months) - 1);

        const stressTestRatio = (stressTestPayment / monthlyPayment * 100);
        const stressTestFill = document.getElementById('stressTestFill');
        const stressTestText = document.getElementById('stressTestText');
        
        stressTestFill.style.width = Math.min(stressTestRatio, 150) + '%';
        
        if (stressTestRatio <= 110) {
            stressTestFill.style.background = '#28a745';
            stressTestText.textContent = `Stress Test: ${stressTestRatio.toFixed(1)}% - Passed`;
        } else if (stressTestRatio <= 125) {
            stressTestFill.style.background = '#ffc107';
            stressTestText.textContent = `Stress Test: ${stressTestRatio.toFixed(1)}% - Moderate`;
        } else {
            stressTestFill.style.background = '#dc3545';
            stressTestText.textContent = `Stress Test: ${stressTestRatio.toFixed(1)}% - High`;
        }

        // Show/hide CMHC info
        document.getElementById('cmhcInfo').style.display = isCMHC && downPaymentPercent < 20 ? 'block' : 'none';

        document.getElementById('results').style.display = 'block';
    }

    function toggleCMHC() {
        const isCMHC = document.getElementById('cmhcInsurance').checked;
        const downPaymentPercent = (parseFloat(document.getElementById('downPayment').value) / parseFloat(document.getElementById('homePrice').value) * 100) || 0;
        
        document.getElementById('cmhcSection').style.display = isCMHC && downPaymentPercent < 20 ? 'block' : 'none';
        
        if (isCMHC && downPaymentPercent < 20) {
            calculateCMHCPremium();
        }
    }

    function toggleFirstTimeBuyer() {
        calculateLandTransferTax();
    }

    function toggleInvestmentProperty() {
        calculateLandTransferTax();
    }

    function calculateCMHCPremium() {
        const homePrice = parseFloat(document.getElementById('homePrice').value) || 0;
        const downPayment = parseFloat(document.getElementById('downPayment').value) || 0;
        const downPaymentPercent = (downPayment / homePrice * 100);

        let premiumRate = 0;
        if (downPaymentPercent >= 5 && downPaymentPercent < 10) {
            premiumRate = 4.0;
        } else if (downPaymentPercent >= 10 && downPaymentPercent < 15) {
            premiumRate = 3.1;
        } else if (downPaymentPercent >= 15 && downPaymentPercent < 20) {
            premiumRate = 2.8;
        }

        const premiumAmount = (homePrice - downPayment) * premiumRate / 100;
        document.getElementById('cmhcPremium').value = Math.round(premiumAmount);
        document.getElementById('cmhcPremiumPercent').textContent = `Premium: ${premiumRate}%`;
    }

    function calculateLandTransferTax() {
        const homePrice = parseFloat(document.getElementById('homePrice').value) || 0;
        const province = document.getElementById('province').value;
        const isFirstTimeBuyer = document.getElementById('firstTimeBuyer').checked;
        const isInvestmentProperty = document.getElementById('investmentProperty').checked;

        let tax = calculateProvinceLandTransferTax(homePrice, province, isFirstTimeBuyer, isInvestmentProperty);

        document.getElementById('landTransferTax').textContent = 
            'Land Transfer Tax: C$' + tax.toLocaleString('en-CA', {maximumFractionDigits: 0});
    }

    function calculateProvinceLandTransferTax(price, province, isFirstTimeBuyer, isInvestment) {
        // Simplified land transfer tax calculation for Canadian provinces
        let tax = 0;
        
        if (isFirstTimeBuyer) {
            // First-time buyer rebates
            switch(province) {
                case 'Ontario':
                    tax = Math.max(0, price * 0.02 - 4000);
                    break;
                case 'British Columbia':
                    tax = Math.max(0, price * 0.02 - 8000);
                    break;
                default:
                    tax = price * 0.015;
            }
        } else if (isInvestment) {
            // Investment property surcharge (BC and Ontario)
            tax = price * 0.03;
        } else {
            // Standard rates
            tax = price * 0.02;
        }
        
        return Math.round(tax);
    }

    // Update down payment percentage and CMHC premium
    document.getElementById('homePrice').addEventListener('input', updateCalculations);
    document.getElementById('downPayment').addEventListener('input', updateCalculations);
    document.getElementById('province').addEventListener('change', calculateLandTransferTax);

    function updateCalculations() {
        const homePrice = parseFloat(document.getElementById('homePrice').value) || 0;
        const downPayment = parseFloat(document.getElementById('downPayment').value) || 0;
        
        if (homePrice > 0) {
            const percent = (downPayment / homePrice * 100).toFixed(1);
            document.getElementById('downPaymentPercent').textContent = percent + '% down payment';
            
            calculateLandTransferTax();
            calculateCMHCPremium();
            toggleCMHC();
        }
    }

    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        updateCalculations();
    });
    </script>

<?php include '../../footer.php'; ?>