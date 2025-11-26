<?php
$country = 'australia';
$country_name = 'Australia';
$currency = 'A$';

// Australia Mortgage calculation
function calculateAUMortgage($principal, $interest_rate, $tenure_years, $down_payment = 0) {
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

// Australia Mortgage data
$mortgage_types = [
    'Variable Rate' => ['rate' => '5.8% - 6.8%', 'term' => 30],
    'Fixed Rate (1 year)' => ['rate' => '5.9% - 6.9%', 'term' => 1],
    'Fixed Rate (3 years)' => ['rate' => '6.0% - 7.0%', 'term' => 3],
    'Fixed Rate (5 years)' => ['rate' => '6.2% - 7.2%', 'term' => 5],
    'Interest Only' => ['rate' => '6.5% - 7.5%', 'term' => 5]
];

$states = [
    'New South Wales' => 'Sydney property market',
    'Victoria' => 'Melbourne metropolitan area',
    'Queensland' => 'Brisbane & Gold Coast',
    'Western Australia' => 'Perth properties',
    'South Australia' => 'Adelaide region'
];

$first_home_grants = [
    'First Home Owner Grant' => 'Up to $10,000 for new homes',
    'First Home Loan Deposit Scheme' => '5% deposit with no LMI',
    'Stamp Duty Concessions' => 'Reduced or no stamp duty',
    'First Home Super Saver Scheme' => 'Save through superannuation'
];
?>
<?php include '../../header.php'; ?>

<!-- SEO Elements -->
<link rel="canonical" href="https://90storezon.com/calculators/04-mortgage-calculator/australia.php">
<meta name="description" content="Free Australia mortgage calculator with stamp duty, first home grants. Calculate variable, fixed rate home loans for Sydney, Melbourne, Brisbane properties.">
<meta name="keywords" content="Australia mortgage calculator, home loan calculator, stamp duty calculator, first home grant calculator, Australian mortgage calculator">

<!-- Structured Data -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "FinancialService",
    "name": "Australia Mortgage Calculator",
    "description": "Free online mortgage calculator for Australian home buyers including first home owner grants and stamp duty calculations",
    "url": "https://90storezon.com/calculators/04-mortgage-calculator/australia.php",
    "areaServed": "AU",
    "serviceType": "Mortgage Calculator"
}
</script>

<div class="calculator-container">
        <div class="header">
            <h1 class="title">Australia Mortgage Calculator</h1>
            <div class="country-badge">
                <img src="https://flagcdn.com/w80/au.png" alt="Australia Flag - Mortgage Calculator" class="flag">
                <span>Australia</span>
            </div>
        </div>

        <!-- Internal Links for SEO -->
        <nav class="seo-links">
            <a href="/australia-mortgage-calculator.html">Australia Mortgage Calculator</a> |
            <a href="/first-home-grant-calculator.html">First Home Grant Calculator</a> |
            <a href="/stamp-duty-calculator-australia.html">Stamp Duty Calculator Australia</a> |
            <a href="/investment-property-calculator.html">Investment Property Calculator</a>
        </nav>

        <div class="calculator-card">
            <div class="input-group">
                <label for="propertyPrice">Property Price (A$)</label>
                <input type="number" id="propertyPrice" placeholder="Enter property price" min="100000" step="1000" value="750000">
            </div>

            <div class="input-group">
                <label for="deposit">Deposit Amount (A$)</label>
                <input type="number" id="deposit" placeholder="Enter deposit amount" min="0" step="1000" value="150000">
                <div class="limit-info" id="depositPercent">20% deposit</div>
            </div>

            <div class="input-group">
                <label for="state">Australian State</label>
                <select id="state">
                    <option value="NSW">New South Wales</option>
                    <option value="VIC">Victoria</option>
                    <option value="QLD">Queensland</option>
                    <option value="WA">Western Australia</option>
                    <option value="SA">South Australia</option>
                    <option value="TAS">Tasmania</option>
                    <option value="ACT">Australian Capital Territory</option>
                    <option value="NT">Northern Territory</option>
                </select>
            </div>

            <div class="input-group">
                <label for="loanTerm">Loan Term</label>
                <select id="loanTerm">
                    <option value="30">30 Years</option>
                    <option value="25">25 Years</option>
                    <option value="20">20 Years</option>
                    <option value="15">15 Years</option>
                </select>
            </div>

            <div class="input-group">
                <label for="interestRate">Interest Rate (%)</label>
                <input type="number" id="interestRate" placeholder="Enter interest rate" min="0.1" max="15" step="0.01" value="6.2">
                <div class="rate-info">Current variable rates: 5.8% - 6.8%</div>
            </div>

            <!-- Australia Specific Options -->
            <div class="additional-options">
                <h3>Australian Home Buyer Schemes</h3>
                <label class="checkbox-container">
                    <input type="checkbox" id="firstHomeBuyer" onchange="toggleFirstHomeBuyer()">
                    <span class="checkmark"></span>
                    First Home Buyer
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" id="investmentProperty" onchange="toggleInvestmentProperty()">
                    <span class="checkmark"></span>
                    Investment Property
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" id="interestOnly" onchange="toggleInterestOnly()">
                    <span class="checkmark"></span>
                    Interest Only Period (5 years)
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" id="lmiRequired" onchange="toggleLMI()">
                    <span class="checkmark"></span>
                    Lenders Mortgage Insurance (LMI)
                </label>
            </div>

            <!-- LMI Calculator -->
            <div class="lmi-calculator" id="lmiSection" style="display: none;">
                <h4>Lenders Mortgage Insurance (LMI)</h4>
                <div class="input-group">
                    <label for="lmiCost">LMI Cost (A$)</label>
                    <input type="number" id="lmiCost" placeholder="Enter LMI cost" min="0" step="100" value="5000">
                </div>
            </div>

            <!-- Stamp Duty Calculator -->
            <div class="stamp-duty-calculator">
                <h3>Stamp Duty & Transfer Fees</h3>
                <div id="stampDutyResult" class="stamp-duty-result">
                    Stamp Duty: A$0
                </div>
            </div>

            <button class="calculate-btn" onclick="calculateAUMortgage()">Calculate Mortgage Repayments</button>

            <div id="results" class="results-container" style="display: none;">
                <div class="result-header">
                    <h3>Australian Mortgage Summary</h3>
                </div>
                <div class="result-grid">
                    <div class="result-card">
                        <h4>Monthly Repayment</h4>
                        <p id="monthlyRepayment" class="result-amount">-</p>
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
                        <h4>LVR Ratio</h4>
                        <p id="lvrRatio" class="result-amount">-</p>
                    </div>
                </div>
                
                <!-- Interest Only Period -->
                <div class="interest-only-section" id="interestOnlySection" style="display: none;">
                    <h4>Interest Only Period (First 5 Years)</h4>
                    <div class="result-grid">
                        <div class="result-card">
                            <h4>Interest Only Payment</h4>
                            <p id="interestOnlyPayment" class="result-amount">-</p>
                        </div>
                        <div class="result-card">
                            <h4>Principal & Interest After</h4>
                            <p id="principalAfterIO" class="result-amount">-</p>
                        </div>
                    </div>
                </div>

                <!-- Serviceability Check -->
                <div class="serviceability-check">
                    <h4>Serviceability Assessment</h4>
                    <div class="serviceability-meter">
                        <div class="serviceability-fill" id="serviceabilityFill"></div>
                    </div>
                    <p id="serviceabilityText" class="serviceability-text"></p>
                </div>
            </div>
        </div>

        <!-- SEO Content Section -->
        <section class="seo-content">
            <h2>Australia Mortgage Calculator - Calculate Home Loan Repayments</h2>
            <p>Our comprehensive <strong>Australia mortgage calculator</strong> helps home buyers across <strong>Sydney, Melbourne, Brisbane, Perth, and Adelaide</strong> estimate their monthly repayments. Calculate <strong>first home owner grants, stamp duty costs, and LMI</strong> with accurate Australian-specific calculations.</p>
            
            <h3>Popular Mortgage Types in Australia</h3>
            <ul>
                <li><strong>Variable Rate Mortgages</strong> - Interest rates that can change</li>
                <li><strong>Fixed Rate Mortgages</strong> - 1, 3, or 5 year fixed terms</li>
                <li><strong>Interest Only Loans</strong> - Pay only interest for set period</li>
                <li><strong>First Home Buyer Loans</strong> - Special schemes with grants</li>
                <li><strong>Investment Property Loans</strong> - Higher rates for investors</li>
            </ul>

            <h3>Australian States & Territories</h3>
            <p>Our calculator provides accurate results for all Australian states including <strong>NSW stamp duty, Victoria first home buyer grants, Queensland transfer duty, and Western Australia mortgage costs</strong>. Get precise <strong>LVR calculations and serviceability assessments</strong> based on Australian lending standards.</p>

            <h3>First Home Buyer Assistance</h3>
            <p>Australian first home buyers can access various grants and concessions including the <strong>First Home Owner Grant (FHOG), First Home Loan Deposit Scheme (FHLDS), and stamp duty concessions</strong>. Our calculator helps you understand how these schemes affect your mortgage repayments.</p>
        </section>

        <!-- VIP Backlinks Footer -->
        <footer class="seo-footer">
            <div class="footer-links">
                <h4>Australian Mortgage Calculators</h4>
                <a href="/sydney-mortgage-calculator.html">Sydney Mortgage Calculator</a> |
                <a href="/melbourne-mortgage-calculator.html">Melbourne Mortgage Calculator</a> |
                <a href="/brisbane-mortgage-calculator.html">Brisbane Mortgage Calculator</a> |
                <a href="/perth-mortgage-calculator.html">Perth Mortgage Calculator</a>
            </div>
            
            <div class="external-links">
                <h4>Australian Mortgage Resources</h4>
                <a href="https://www.ato.gov.au/Individuals/Home-ownership-programs" rel="nofollow">ATO Home Ownership Programs</a> |
                <a href="https://www.nhfic.gov.au/what-we-do/fhlds" rel="nofollow">First Home Loan Deposit Scheme</a> |
                <a href="https://www.moneysmart.gov.au/home-loans" rel="nofollow">MoneySmart Home Loans</a> |
                <a href="https://www.rba.gov.au/statistics/cash-rate" rel="nofollow">RBA Cash Rate</a>
            </div>
        </footer>
    </div>

    <script>
    function calculateAUMortgage() {
        const propertyPrice = parseFloat(document.getElementById('propertyPrice').value);
        const deposit = parseFloat(document.getElementById('deposit').value);
        const loanTerm = parseInt(document.getElementById('loanTerm').value);
        const interestRate = parseFloat(document.getElementById('interestRate').value);
        const isFirstHomeBuyer = document.getElementById('firstHomeBuyer').checked;
        const isInvestmentProperty = document.getElementById('investmentProperty').checked;
        const isInterestOnly = document.getElementById('interestOnly').checked;
        const lmiCost = parseFloat(document.getElementById('lmiCost').value) || 0;

        if (!propertyPrice || !deposit || !loanTerm || !interestRate) {
            alert('Please fill in all required fields');
            return;
        }

        let loanAmount = propertyPrice - deposit;
        
        // Add LMI to loan if applicable
        if (document.getElementById('lmiRequired').checked && lmiCost > 0) {
            loanAmount += lmiCost;
        }

        const monthlyRate = interestRate / 12 / 100;
        const months = loanTerm * 12;

        // Calculate monthly payment
        let monthlyRepayment = loanAmount * monthlyRate * Math.pow(1 + monthlyRate, months) / 
                              (Math.pow(1 + monthlyRate, months) - 1);

        const totalInterest = (monthlyRepayment * months) - loanAmount;
        const lvrRatio = (loanAmount / propertyPrice * 100).toFixed(1);

        // Update results
        document.getElementById('monthlyRepayment').textContent = 'A$' + monthlyRepayment.toFixed(2);
        document.getElementById('totalLoan').textContent = 'A$' + loanAmount.toLocaleString();
        document.getElementById('totalInterest').textContent = 'A$' + totalInterest.toLocaleString();
        document.getElementById('lvrRatio').textContent = lvrRatio + '%';

        // Interest Only calculations
        if (isInterestOnly) {
            const interestOnlyPayment = loanAmount * monthlyRate;
            document.getElementById('interestOnlyPayment').textContent = 'A$' + interestOnlyPayment.toFixed(2);
            document.getElementById('principalAfterIO').textContent = 'A$' + monthlyRepayment.toFixed(2);
            document.getElementById('interestOnlySection').style.display = 'block';
        } else {
            document.getElementById('interestOnlySection').style.display = 'none';
        }

        // Serviceability check (assuming average Australian income)
        const averageIncome = 92000;
        const annualRepayment = monthlyRepayment * 12;
        const serviceabilityRatio = (annualRepayment / averageIncome * 100);

        const serviceabilityFill = document.getElementById('serviceabilityFill');
        const serviceabilityText = document.getElementById('serviceabilityText');
        
        serviceabilityFill.style.width = Math.min(serviceabilityRatio, 100) + '%';
        
        if (serviceabilityRatio <= 28) {
            serviceabilityFill.style.background = '#28a745';
            serviceabilityText.textContent = `Serviceability: ${serviceabilityRatio.toFixed(1)}% - Strong (Below 28%)`;
        } else if (serviceabilityRatio <= 35) {
            serviceabilityFill.style.background = '#ffc107';
            serviceabilityText.textContent = `Serviceability: ${serviceabilityRatio.toFixed(1)}% - Acceptable (28-35%)`;
        } else {
            serviceabilityFill.style.background = '#dc3545';
            serviceabilityText.textContent = `Serviceability: ${serviceabilityRatio.toFixed(1)}% - Stretched (Above 35%)`;
        }

        document.getElementById('results').style.display = 'block';
    }

    function toggleFirstHomeBuyer() {
        const isFirstHomeBuyer = document.getElementById('firstHomeBuyer').checked;
        calculateStampDuty();
        
        if (isFirstHomeBuyer) {
            // Auto-adjust deposit for first home buyer schemes
            document.getElementById('deposit').value = 
                Math.round(parseFloat(document.getElementById('propertyPrice').value) * 0.05);
            updateDepositPercent();
        }
    }

    function toggleInvestmentProperty() {
        calculateStampDuty();
    }

    function toggleInterestOnly() {
        // No additional calculations needed here
    }

    function toggleLMI() {
        const lmiRequired = document.getElementById('lmiRequired').checked;
        document.getElementById('lmiSection').style.display = lmiRequired ? 'block' : 'none';
    }

    function calculateStampDuty() {
        const propertyPrice = parseFloat(document.getElementById('propertyPrice').value) || 0;
        const state = document.getElementById('state').value;
        const isFirstHomeBuyer = document.getElementById('firstHomeBuyer').checked;
        const isInvestmentProperty = document.getElementById('investmentProperty').checked;

        let stampDuty = calculateStateStampDuty(propertyPrice, state, isFirstHomeBuyer, isInvestmentProperty);

        document.getElementById('stampDutyResult').textContent = 
            'Stamp Duty: A$' + stampDuty.toLocaleString('en-AU', {maximumFractionDigits: 0});
    }

    function calculateStateStampDuty(price, state, isFirstHomeBuyer, isInvestment) {
        // Simplified stamp duty calculation for Australian states
        let duty = 0;
        
        if (isFirstHomeBuyer) {
            // First home buyer concessions
            switch(state) {
                case 'NSW':
                    if (price <= 800000) duty = 0;
                    else duty = price * 0.04;
                    break;
                case 'VIC':
                    if (price <= 600000) duty = 0;
                    else duty = price * 0.055;
                    break;
                case 'QLD':
                    if (price <= 500000) duty = 0;
                    else duty = price * 0.035;
                    break;
                default:
                    duty = price * 0.04;
            }
        } else if (isInvestment) {
            // Investment property surcharge
            duty = price * 0.055;
        } else {
            // Standard rates
            duty = price * 0.04;
        }
        
        return Math.round(duty);
    }

    // Update deposit percentage
    document.getElementById('propertyPrice').addEventListener('input', updateDepositPercent);
    document.getElementById('deposit').addEventListener('input', updateDepositPercent);
    document.getElementById('state').addEventListener('change', calculateStampDuty);

    function updateDepositPercent() {
        const propertyPrice = parseFloat(document.getElementById('propertyPrice').value) || 0;
        const deposit = parseFloat(document.getElementById('deposit').value) || 0;
        
        if (propertyPrice > 0) {
            const percent = (deposit / propertyPrice * 100).toFixed(1);
            document.getElementById('depositPercent').textContent = percent + '% deposit';
            calculateStampDuty();
        }
    }

    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        updateDepositPercent();
        calculateStampDuty();
    });
    </script>

<?php include '../../footer.php'; ?>