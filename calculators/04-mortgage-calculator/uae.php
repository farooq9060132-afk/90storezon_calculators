<?php
$country = 'uae';
$country_name = 'United Arab Emirates';
$currency = 'AED';

// UAE Mortgage calculation
function calculateUAEMortgage($principal, $interest_rate, $tenure_years, $down_payment = 0) {
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

// UAE Mortgage data
$mortgage_types = [
    'Fixed Rate (3 years)' => ['rate' => '3.5% - 4.5%', 'term' => 3],
    'Variable Rate' => ['rate' => '4.0% - 5.0%', 'term' => 25],
    'Islamic Mortgage' => ['rate' => '3.8% - 4.8%', 'term' => 25],
    'Expatriate Mortgage' => ['rate' => '4.2% - 5.2%', 'term' => 25],
    'Off-Plan Payment' => ['rate' => '5.0% - 6.0%', 'term' => 25]
];

$emirates = [
    'Dubai' => 'No salary transfer required',
    'Abu Dhabi' => 'Lower interest rates',
    'Sharjah' => 'Competitive rates',
    'Ajman' => 'Flexible terms',
    'Ras Al Khaimah' => 'Special schemes'
];

$islamic_financing = [
    'Murabaha' => 'Cost-plus financing',
    'Ijara' => 'Lease-to-own',
    'Musharaka' => 'Partnership financing',
    'Diminishing Musharaka' => 'Gradual ownership'
];
?>
<?php include '../../header.php'; ?>

<!-- SEO Elements -->
<link rel="canonical" href="https://90storezon.com/calculators/04-mortgage-calculator/uae.php">
<meta name="description" content="Free UAE mortgage calculator with Islamic financing, salary transfer. Calculate mortgage payments for Dubai, Abu Dhabi, Sharjah properties in AED.">
<meta name="keywords" content="UAE mortgage calculator, Dubai mortgage calculator, Islamic financing calculator, home loan calculator, UAE property calculator">

<!-- Structured Data -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "FinancialService",
    "name": "UAE Mortgage Calculator",
    "description": "Free online mortgage calculator for UAE property buyers including Islamic financing and expatriate mortgage options",
    "url": "https://90storezon.com/calculators/04-mortgage-calculator/uae.php",
    "areaServed": "AE",
    "serviceType": "Mortgage Calculator"
}
</script>

<div class="calculator-container">
        <div class="header">
            <h1 class="title">UAE Mortgage Calculator</h1>
            <div class="country-badge">
                <img src="https://flagcdn.com/w80/ae.png" alt="UAE Flag - Mortgage Calculator" class="flag">
                <span>United Arab Emirates</span>
            </div>
        </div>

        <!-- Internal Links for SEO -->
        <nav class="seo-links">
            <a href="https://90storezon.com/calculators/01-loan-emi-calculator/">Loan Calculator</a> |
            <a href="https://90storezon.com/calculators/01-loan-emi-calculator/saudi_arabia.php">Saudi Mortgage Calculator</a> |
            <a href="https://90storezon.com/calculators/01-loan-emi-calculator/usa.php">USA Mortgage Calculator</a> |
            <a href="https://90storezon.com/calculators/01-loan-emi-calculator/uk.php">UK Mortgage Calculator</a>
        </nav>

        <div class="calculator-card">
            <div class="input-group">
                <label for="propertyValue">Property Value (AED)</label>
                <input type="number" id="propertyValue" placeholder="Enter property value" min="500000" step="10000" value="1500000">
            </div>

            <div class="input-group">
                <label for="downPayment">Down Payment (AED)</label>
                <input type="number" id="downPayment" placeholder="Enter down payment" min="0" step="10000" value="300000">
                <div class="limit-info" id="downPaymentPercent">20% down payment</div>
            </div>

            <div class="input-group">
                <label for="emirate">Emirate</label>
                <select id="emirate">
                    <option value="Dubai">Dubai</option>
                    <option value="Abu Dhabi">Abu Dhabi</option>
                    <option value="Sharjah">Sharjah</option>
                    <option value="Ajman">Ajman</option>
                    <option value="Ras Al Khaimah">Ras Al Khaimah</option>
                    <option value="Fujairah">Fujairah</option>
                    <option value="Umm Al Quwain">Umm Al Quwain</option>
                </select>
            </div>

            <div class="input-group">
                <label for="loanTerm">Loan Term</label>
                <select id="loanTerm">
                    <option value="25">25 Years</option>
                    <option value="20">20 Years</option>
                    <option value="15">15 Years</option>
                    <option value="10">10 Years</option>
                </select>
            </div>

            <div class="input-group">
                <label for="interestRate">Interest Rate (%)</label>
                <input type="number" id="interestRate" placeholder="Enter interest rate" min="0.1" max="15" step="0.01" value="4.2">
                <div class="rate-info">Current rates: 3.5% - 4.5%</div>
            </div>

            <!-- Salary Information -->
            <div class="salary-section">
                <h3>Income Details</h3>
                <div class="input-group">
                    <label for="monthlySalary">Monthly Salary (AED)</label>
                    <input type="number" id="monthlySalary" placeholder="Enter monthly salary" min="3000" step="1000" value="20000">
                </div>
            </div>

            <!-- UAE Specific Options -->
            <div class="additional-options">
                <h3>UAE Mortgage Options</h3>
                <label class="checkbox-container">
                    <input type="checkbox" id="salaryTransfer" onchange="toggleSalaryTransfer()">
                    <span class="checkmark"></span>
                    Salary Transfer Required
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" id="islamicFinancing" onchange="toggleIslamicFinancing()">
                    <span class="checkmark"></span>
                    Islamic Financing
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" id="expatriate" onchange="toggleExpatriate()">
                    <span class="checkmark"></span>
                    Expatriate Applicant
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" id="offPlan" onchange="toggleOffPlan()">
                    <span class="checkmark"></span>
                    Off-Plan Property
                </label>
            </div>

            <!-- Islamic Financing Details -->
            <div class="islamic-financing" id="islamicSection" style="display: none;">
                <h4>Islamic Financing Type</h4>
                <select id="islamicType">
                    <option value="Murabaha">Murabaha (Cost-Plus)</option>
                    <option value="Ijara">Ijara (Lease-to-Own)</option>
                    <option value="Musharaka">Musharaka (Partnership)</option>
                </select>
            </div>

            <!-- Registration Fees Calculator -->
            <div class="fees-calculator">
                <h3>Dubai Land Department Fees</h3>
                <div id="registrationFees" class="fees-result">
                    Registration Fees: AED 0
                </div>
            </div>

            <button class="calculate-btn" onclick="calculateUAEMortgage()">Calculate Mortgage Payment</button>

            <div id="results" class="results-container" style="display: none;">
                <div class="result-header">
                    <h3>UAE Mortgage Summary</h3>
                </div>
                <div class="result-grid">
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
                    <div class="result-card">
                        <h4>Loan to Value</h4>
                        <p id="ltvRatio" class="result-amount">-</p>
                    </div>
                </div>
                
                <!-- Debt Burden Ratio -->
                <div class="debt-ratio">
                    <h4>Debt Burden Ratio</h4>
                    <div class="debt-ratio-meter">
                        <div class="debt-ratio-fill" id="debtRatioFill"></div>
                    </div>
                    <p id="debtRatioText" class="debt-ratio-text"></p>
                </div>

                <!-- Islamic Financing Info -->
                <div class="islamic-info" id="islamicInfo" style="display: none;">
                    <h4>Islamic Financing Details</h4>
                    <p id="islamicDescription">Sharia-compliant financing with no interest charges.</p>
                </div>

                <!-- UAE Bank Eligibility -->
                <div class="eligibility-check">
                    <h4>Bank Eligibility Check</h4>
                    <div class="eligibility-result" id="eligibilityResult">
                        Checking eligibility...
                    </div>
                </div>
            </div>
        </div>

        <!-- SEO Content Section -->
        <section class="seo-content">
            <h2>UAE Mortgage Calculator - Calculate Home Loan Payments in Dubai & Abu Dhabi</h2>
            <p>Our comprehensive <strong>UAE mortgage calculator</strong> helps property buyers in <strong>Dubai, Abu Dhabi, Sharjah, and all Emirates</strong> estimate their monthly payments. Calculate <strong>Islamic financing, expatriate mortgages, and off-plan payments</strong> with accurate UAE-specific calculations in AED.</p>
            
            <h3>Popular Mortgage Types in UAE</h3>
            <ul>
                <li><strong>Fixed Rate Mortgages</strong> - 3-5 year fixed terms</li>
                <li><strong>Variable Rate Mortgages</strong> - EIBOR linked rates</li>
                <li><strong>Islamic Financing</strong> - Sharia-compliant options</li>
                <li><strong>Expatriate Mortgages</strong> - Special terms for expats</li>
                <li><strong>Off-Plan Mortgages</strong> - Construction payment plans</li>
            </ul>

            <h3>UAE Mortgage Regulations</h3>
            <p>UAE mortgages require <strong>salary transfer, minimum down payments (20% for expats, 15% for nationals), and debt burden ratio below 50%</strong>. Our calculator includes <strong>Dubai Land Department fees, registration costs, and bank eligibility criteria</strong> for all major UAE banks.</p>

            <h3>Islamic Financing in UAE</h3>
            <p>UAE offers various <strong>Sharia-compliant financing options</strong> including <strong>Murabaha (cost-plus financing), Ijara (lease-to-own), and Musharaka (partnership financing)</strong>. Our calculator helps you compare conventional and Islamic mortgage options.</p>
        </section>

        <!-- VIP Backlinks Footer -->
        <footer class="seo-footer">
            <div class="footer-links">
                <h4>Middle East Mortgage Calculators</h4>
                <a href="https://90storezon.com/calculators/01-loan-emi-calculator/saudi_arabia.php">Saudi Arabia Mortgage Calculator</a> |
                <a href="https://90storezon.com/calculators/01-loan-emi-calculator/uae.php">UAE Mortgage Calculator</a> |
                <a href="https://90storezon.com/calculators/01-loan-emi-calculator/qatar.php">Qatar Mortgage Calculator</a> |
                <a href="https://90storezon.com/calculators/01-loan-emi-calculator/kuwait.php">Kuwait Mortgage Calculator</a>
            </div>
            
            <div class="external-links">
                <h4>UAE Mortgage Resources</h4>
                <a href="https://www.dubailand.gov.ae" rel="nofollow">Dubai Land Department</a> |
                <a href="https://www.cbuae.gov.ae" rel="nofollow">Central Bank of UAE</a> |
                <a href="https://www.emiratesnbd.com" rel="nofollow">Emirates NBD</a> |
                <a href="https://www.adcb.com" rel="nofollow">Abu Dhabi Commercial Bank</a>
            </div>
        </footer>
    </div>

    <script>
    function calculateUAEMortgage() {
        const propertyValue = parseFloat(document.getElementById('propertyValue').value);
        const downPayment = parseFloat(document.getElementById('downPayment').value);
        const loanTerm = parseInt(document.getElementById('loanTerm').value);
        const interestRate = parseFloat(document.getElementById('interestRate').value);
        const monthlySalary = parseFloat(document.getElementById('monthlySalary').value) || 0;
        const isIslamic = document.getElementById('islamicFinancing').checked;
        const isExpatriate = document.getElementById('expatriate').checked;
        const isOffPlan = document.getElementById('offPlan').checked;

        if (!propertyValue || !downPayment || !loanTerm || !interestRate) {
            alert('Please fill in all required fields');
            return;
        }

        let loanAmount = propertyValue - downPayment;
        const monthlyRate = interestRate / 12 / 100;
        const months = loanTerm * 12;

        // Adjust rate for Islamic financing (usually slightly higher)
        let effectiveRate = interestRate;
        if (isIslamic) {
            effectiveRate += 0.3; // Islamic financing typically 0.3-0.5% higher
        }

        // Calculate monthly payment
        const monthlyPayment = loanAmount * (effectiveRate / 12 / 100) * Math.pow(1 + (effectiveRate / 12 / 100), months) / 
                              (Math.pow(1 + (effectiveRate / 12 / 100), months) - 1);

        const totalInterest = (monthlyPayment * months) - loanAmount;
        const ltvRatio = (loanAmount / propertyValue * 100).toFixed(1);

        // Update results
        document.getElementById('monthlyPayment').textContent = 'AED ' + monthlyPayment.toFixed(2);
        document.getElementById('totalLoan').textContent = 'AED ' + loanAmount.toLocaleString();
        document.getElementById('totalInterest').textContent = 'AED ' + totalInterest.toLocaleString();
        document.getElementById('ltvRatio').textContent = ltvRatio + '%';

        // Debt Burden Ratio (UAE requirement: max 50%)
        let debtRatio = 0;
        if (monthlySalary > 0) {
            debtRatio = (monthlyPayment / monthlySalary * 100);
        }

        const debtRatioFill = document.getElementById('debtRatioFill');
        const debtRatioText = document.getElementById('debtRatioText');
        
        debtRatioFill.style.width = Math.min(debtRatio, 100) + '%';
        
        if (debtRatio <= 40) {
            debtRatioFill.style.background = '#28a745';
            debtRatioText.textContent = `Debt Ratio: ${debtRatio.toFixed(1)}% - Good (Below 40%)`;
        } else if (debtRatio <= 50) {
            debtRatioFill.style.background = '#ffc107';
            debtRatioText.textContent = `Debt Ratio: ${debtRatio.toFixed(1)}% - Acceptable (40-50%)`;
        } else {
            debtRatioFill.style.background = '#dc3545';
            debtRatioText.textContent = `Debt Ratio: ${debtRatio.toFixed(1)}% - High (Above 50%)`;
        }

        // Islamic Financing Info
        if (isIslamic) {
            const islamicType = document.getElementById('islamicType').value;
            let description = '';
            switch(islamicType) {
                case 'Murabaha':
                    description = 'Cost-plus financing - bank buys property and sells to you at profit';
                    break;
                case 'Ijara':
                    description = 'Lease-to-own - you pay rent that includes principal repayment';
                    break;
                case 'Musharaka':
                    description = 'Partnership financing - gradual ownership transfer';
                    break;
            }
            document.getElementById('islamicDescription').textContent = description;
            document.getElementById('islamicInfo').style.display = 'block';
        } else {
            document.getElementById('islamicInfo').style.display = 'none';
        }

        // Bank Eligibility Check
        const eligibilityResult = document.getElementById('eligibilityResult');
        let eligibilityMessage = '';
        let eligibilityClass = '';
        
        if (debtRatio > 50) {
            eligibilityMessage = '❌ May not meet bank eligibility (Debt ratio > 50%)';
            eligibilityClass = 'eligibility-fail';
        } else if (ltvRatio > (isExpatriate ? 80 : 85)) {
            eligibilityMessage = '⚠️ Higher down payment required';
            eligibilityClass = 'eligibility-warning';
        } else {
            eligibilityMessage = '✅ Likely meets bank eligibility criteria';
            eligibilityClass = 'eligibility-pass';
        }
        
        eligibilityResult.textContent = eligibilityMessage;
        eligibilityResult.className = 'eligibility-result ' + eligibilityClass;

        document.getElementById('results').style.display = 'block';
    }

    function toggleSalaryTransfer() {
        // No additional calculations needed
    }

    function toggleIslamicFinancing() {
        const isIslamic = document.getElementById('islamicFinancing').checked;
        document.getElementById('islamicSection').style.display = isIslamic ? 'block' : 'none';
    }

    function toggleExpatriate() {
        calculateRegistrationFees();
        
        const isExpatriate = document.getElementById('expatriate').checked;
        if (isExpatriate) {
            // Adjust down payment for expats (min 20%)
            const propertyValue = parseFloat(document.getElementById('propertyValue').value) || 0;
            document.getElementById('downPayment').value = Math.round(propertyValue * 0.20);
            updateDownPaymentPercent();
        }
    }

    function toggleOffPlan() {
        calculateRegistrationFees();
    }

    function calculateRegistrationFees() {
        const propertyValue = parseFloat(document.getElementById('propertyValue').value) || 0;
        const emirate = document.getElementById('emirate').value;
        const isOffPlan = document.getElementById('offPlan').checked;

        let fees = calculateEmirateFees(propertyValue, emirate, isOffPlan);

        document.getElementById('registrationFees').textContent = 
            'Registration Fees: AED ' + fees.toLocaleString('en-AE', {maximumFractionDigits: 0});
    }

    function calculateEmirateFees(price, emirate, isOffPlan) {
        // Simplified registration fees calculation for UAE emirates
        let fees = 0;
        
        if (emirate === 'Dubai') {
            // Dubai Land Department fees
            fees = price * 0.04; // 4% registration fee
            if (isOffPlan) {
                fees += price * 0.01; // Additional 1% for off-plan
            }
        } else if (emirate === 'Abu Dhabi') {
            // Abu Dhabi registration fees
            fees = price * 0.02; // 2% registration fee
        } else {
            // Other emirates
            fees = price * 0.03; // 3% average
        }
        
        return Math.round(fees);
    }

    // Update down payment percentage and fees
    document.getElementById('propertyValue').addEventListener('input', updateCalculations);
    document.getElementById('downPayment').addEventListener('input', updateCalculations);
    document.getElementById('emirate').addEventListener('change', calculateRegistrationFees);

    function updateCalculations() {
        const propertyValue = parseFloat(document.getElementById('propertyValue').value) || 0;
        const downPayment = parseFloat(document.getElementById('downPayment').value) || 0;
        
        if (propertyValue > 0) {
            const percent = (downPayment / propertyValue * 100).toFixed(1);
            document.getElementById('downPaymentPercent').textContent = percent + '% down payment';
            
            calculateRegistrationFees();
        }
    }

    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        updateCalculations();
    });
    </script>

    <style>
    .eligibility-result {
        padding: 10px;
        border-radius: 5px;
        text-align: center;
        font-weight: bold;
    }
    .eligibility-pass {
        background: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }
    .eligibility-warning {
        background: #fff3cd;
        color: #856404;
        border: 1px solid #ffeaa7;
    }
    .eligibility-fail {
        background: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }
    </style>

<?php include '../../footer.php'; ?>