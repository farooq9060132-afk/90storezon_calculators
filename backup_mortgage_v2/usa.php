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
    'Illinois' => 'Moderate rates',
    'Pennsylvania' => 'Affordable housing',
    'Ohio' => 'Low cost of living',
    'Georgia' => 'Growing market',
    'North Carolina' => 'Tech hub growth',
    'Michigan' => 'Auto industry focus'
];

// US Banks reference rates
$banks = [
    'Chase' => '6.5% - 7.5%',
    'Bank of America' => '6.4% - 7.4%',
    'Wells Fargo' => '6.6% - 7.6%',
    'Citibank' => '6.5% - 7.5%',
    'US Bank' => '6.4% - 7.4%'
];

// Credit Score Tiers
$credit_score_tiers = [
    'Excellent' => ['min' => 800, 'max' => 850, 'rate_adjustment' => -1.0],
    'Very Good' => ['min' => 740, 'max' => 799, 'rate_adjustment' => -0.5],
    'Good' => ['min' => 670, 'max' => 739, 'rate_adjustment' => 0],
    'Fair' => ['min' => 580, 'max' => 669, 'rate_adjustment' => 1.5],
    'Poor' => ['min' => 300, 'max' => 579, 'rate_adjustment' => 3.0]
];

// Government Programs
$government_programs = [
    'FHA Loan' => '3.5% down payment, lower credit scores accepted',
    'VA Loan' => '0% down payment for veterans and military',
    'USDA Loan' => '0% down payment for rural areas',
    'Fannie Mae' => 'Conventional loans, 3% down payment',
    'Freddie Mac' => 'Conventional loans, flexible terms'
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mortgage Calculator - United States</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        .usa-theme {
            --primary-color: #3C3B6E;
            --secondary-color: #B22234;
            --accent-color: #FFFFFF;
        }
        
        .usa-badge {
            background: linear-gradient(90deg, #3C3B6E 33%, #B22234 33%, #B22234 66%, #3C3B6E 66%);
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
            border: 2px solid #3C3B6E;
        }
        
        .bank-rates {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 15px;
            margin: 20px 0;
            border-right: 5px solid #3C3B6E;
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
            border-bottom: 3px solid #3C3B6E;
        }
        
        .scheme-badge {
            background: #B22234;
            color: white;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 0.8rem;
            margin-left: 10px;
        }
        
        .state-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 15px;
            margin-top: 15px;
        }
        
        .state-card {
            background: white;
            padding: 15px;
            border-radius: 10px;
            border-left: 4px solid #3C3B6E;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        .program-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 15px;
            margin-top: 15px;
        }
        
        .program-card {
            background: linear-gradient(135deg, #3C3B6E, #B22234);
            color: white;
            padding: 20px;
            border-radius: 10px;
        }
        
        .credit-score-section {
            background: #e8f4fd;
            padding: 15px;
            border-radius: 10px;
            margin: 15px 0;
            border-left: 4px solid #3C3B6E;
        }
        
        .tax-calculator {
            background: #fff3cd;
            padding: 15px;
            border-radius: 10px;
            margin: 15px 0;
            border-left: 4px solid #ffc107;
        }
        
        .loan-categories {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin: 10px 0;
        }
        
        .loan-category {
            background: #3C3B6E;
            color: white;
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 0.8rem;
        }
        
        .credit-meter {
            width: 100%;
            height: 20px;
            background: #e9ecef;
            border-radius: 10px;
            margin: 10px 0;
            overflow: hidden;
        }
        
        .credit-fill {
            height: 100%;
            border-radius: 10px;
            transition: all 0.3s ease;
        }
    </style>
</head>
<body class="usa-theme">
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
                <span class="usa-badge">United States</span>
            </div>
        </div>

        <!-- Bank Rates Section -->
        <div class="bank-rates">
            <h3 style="margin: 0 0 15px 0; color: #333; text-align: center;">🏦 Current Mortgage Rates</h3>
            <div class="bank-grid">
                <?php foreach($banks as $bank => $rate): ?>
                    <div class="bank-card">
                        <div style="font-weight: 600; color: #3C3B6E;"><?php echo $bank; ?></div>
                        <div style="color: #B22234; font-weight: 500;"><?php echo $rate; ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="calculator-card">
            <div class="loan-type-selector">
                <label for="loanType">Mortgage Type</label>
                <select id="loanType" onchange="updateLoanLimits()">
                    <?php foreach($mortgage_types as $type => $limits): ?>
                        <option value="<?php echo $type; ?>"><?php echo $type; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Loan Categories -->
            <div id="loanCategories" class="loan-categories"></div>

            <div class="input-group">
                <label for="state">State</label>
                <select id="state" onchange="updateStateInfo()">
                    <?php foreach($states as $state => $info): ?>
                        <option value="<?php echo $state; ?>"><?php echo $state; ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="limit-info" id="stateInfo"></div>
            </div>

            <!-- Credit Score Section -->
            <div class="credit-score-section">
                <h4 style="margin: 0 0 10px 0; color: #3C3B6E;">📊 Credit Score Impact</h4>
                <div class="input-group">
                    <label for="creditScore">Credit Score</label>
                    <input type="range" id="creditScore" min="300" max="850" value="700" oninput="updateCreditScore()">
                    <div class="limit-info" id="creditScoreInfo"></div>
                </div>
                <div class="credit-meter">
                    <div class="credit-fill" id="creditFill"></div>
                </div>
                <div id="creditTierInfo" style="font-weight: 600; color: #3C3B6E;"></div>
            </div>

            <div class="input-group">
                <label for="homePrice">Home Price (<?php echo $currency; ?>)</label>
                <input type="number" id="homePrice" placeholder="Enter home price" min="50000" step="1000" value="350000">
                <div class="limit-info" id="priceLimit">Range: $50,000 - $5,000,000</div>
            </div>

            <div class="input-group">
                <label for="downPayment">Down Payment (<?php echo $currency; ?>)</label>
                <input type="number" id="downPayment" placeholder="Enter down payment" min="0" step="1000" value="70000">
                <div class="limit-info" id="downPaymentPercent">20% down payment</div>
            </div>

            <div class="input-group">
                <label for="interestRate">Interest Rate (% APR)</label>
                <input type="number" id="interestRate" placeholder="Enter interest rate" min="0.5" max="20" step="0.1" value="6.5">
                <div class="rate-info" id="interestRange">Typical rates: <span id="typicalRate">6.5% - 7.5%</span></div>
            </div>

            <div class="input-group">
                <label for="loanTerm">Loan Term (Years)</label>
                <input type="number" id="loanTerm" placeholder="Enter loan term" min="10" max="30" step="1" value="30">
                <div class="limit-info" id="tenureLimit">Range: 10 - 30 years</div>
            </div>

            <!-- Additional Costs -->
            <div class="tax-calculator">
                <h4 style="margin: 0 0 10px 0; color: #856404;">🏠 Additional Monthly Costs</h4>
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

            <div class="additional-options">
                <label class="checkbox-container">
                    <input type="checkbox" id="fhaLoan" onchange="toggleFHALoan()">
                    <span class="checkmark"></span>
                    FHA Loan <span class="scheme-badge">Government</span>
                </label>
                
                <label class="checkbox-container">
                    <input type="checkbox" id="vaLoan" onchange="toggleVALoan()">
                    <span class="checkmark"></span>
                    VA Loan <span class="scheme-badge">Veterans</span>
                </label>

                <label class="checkbox-container">
                    <input type="checkbox" id="fixedRate" onchange="toggleFixedRate()">
                    <span class="checkmark"></span>
                    Fixed Rate Mortgage
                </label>

                <label class="checkbox-container">
                    <input type="checkbox" id="firstTimeBuyer" onchange="toggleFirstTimeBuyer()">
                    <span class="checkmark"></span>
                    First-time Buyer
                </label>
            </div>

            <button class="calculate-btn" onclick="calculateMortgage()">Calculate Mortgage Payment</button>

            <div id="results" class="results-container" style="display: none;">
                <div class="result-header">
                    <h3>Mortgage Summary</h3>
                    <p id="schemeInfo" class="scheme-info"></p>
                </div>
                <div class="result-grid">
                    <div class="result-card">
                        <h4>Principal & Interest</h4>
                        <p id="principalInterest" class="result-amount">-</p>
                    </div>
                    <div class="result-card">
                        <h4>Total Monthly Payment</h4>
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
                
                <!-- Debt-to-Income Ratio -->
                <div class="affordability-card">
                    <h4>Debt-to-Income (DTI) Ratio</h4>
                    <div class="affordability-meter">
                        <div class="affordability-fill" id="dtiFill"></div>
                    </div>
                    <p id="dtiText" class="affordability-text"></p>
                </div>
                
                <div class="breakdown-section">
                    <h4>Payment Breakdown</h4>
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

                <!-- Amortization Schedule -->
                <div class="schedule-preview">
                    <h4>First Year Amortization</h4>
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

        <!-- Government Programs -->
        <div class="info-section">
            <h3>US Government Loan Programs</h3>
            <div class="program-grid">
                <?php foreach($government_programs as $program => $details): ?>
                    <div class="program-card">
                        <h4 style="margin: 0 0 10px 0;">🏛️ <?php echo $program; ?></h4>
                        <p style="margin: 0; opacity: 0.9;"><?php echo $details; ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- States Information -->
        <div class="info-section">
            <h3>US States Information</h3>
            <div class="state-grid">
                <?php foreach($states as $state => $info): ?>
                    <div class="state-card">
                        <h4 style="color: #3C3B6E; margin: 0 0 10px 0;">🗽 <?php echo $state; ?></h4>
                        <p style="margin: 0; color: #555;"><?php echo $info; ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- US Specific Information -->
        <div class="info-section">
            <h3>Mortgage Information in United States</h3>
            <div class="info-grid">
                <div class="info-card">
                    <h4>🏠 Mortgages</h4>
                    <p>30-year fixed common</p>
                    <p>FHA: 3.5% down</p>
                    <p>VA: 0% down for veterans</p>
                </div>
                <div class="info-card">
                    <h4>📊 Interest Rates</h4>
                    <p>Currently 6.5-7.5%</p>
                    <p>Credit score based</p>
                    <p>Fixed & variable options</p>
                </div>
                <div class="info-card">
                    <h4>🏛️ Government Programs</h4>
                    <p>FHA, VA, USDA loans</p>
                    <p>Fannie Mae & Freddie Mac</p>
                    <p>First-time buyer assistance</p>
                </div>
                <div class="info-card">
                    <h4>💰 Additional Costs</h4>
                    <p>Property taxes</p>
                    <p>Home insurance</p>
                    <p>PMI (if < 20% down)</p>
                </div>
            </div>
        </div>
        
        <!-- All Calculators Backlinks -->
        <div class="info-section">
            <h3>Explore Our Other Calculators</h3>
            <div class="calculator-links">
                <p>
                    <a href="/calculators/01-loan-emi-calculator/">Loan EMI Calculator</a> |
                    <a href="/calculators/02-bmi-calculator/">BMI Calculator</a> |
                    <a href="/calculators/03-currency-converter/">Currency Converter</a> |
                    <a href="/calculators/05-compound-interest-calculator/">Compound Interest Calculator</a> |
                    <a href="/calculators/06-calorie-calculator/">Calorie Calculator</a>
                </p>
                <p>
                    <a href="/calculators/07-qr-code-generator/">QR Code Generator</a> |
                    <a href="/calculators/08-password-generator/">Password Generator</a> |
                    <a href="/calculators/09-tax-calculator/">Tax Calculator</a> |
                    <a href="/calculators/10-retirement-planner/">Retirement Planner</a> |
                    <a href="/calculators/11-investment-calculator/">Investment Calculator</a>
                </p>
                <p>
                    <a href="/calculators/12-salary-calculator/">Salary Calculator</a> |
                    <a href="/calculators/13-budget-planner/">Budget Planner</a> |
                    <a href="/calculators/14-body-fat-calculator/">Body Fat Calculator</a> |
                    <a href="/calculators/15-pregnancy-calculator/">Pregnancy Calculator</a> |
                    <a href="/calculators/16-water-intake-calculator/">Water Intake Calculator</a>
                </p>
                <p>
                    <a href="/calculators/17-macro-calculator/">Macro Calculator</a> |
                    <a href="/calculators/18-heart-rate-calculator/">Heart Rate Calculator</a> |
                    <a href="/calculators/19-medication-calculator/">Medication Calculator</a> |
                    <a href="/calculators/20-gpa-calculator/">GPA Calculator</a> |
                    <a href="/calculators/21-percentage-calculator/">Percentage Calculator</a>
                </p>
                <p>
                    <a href="/calculators/22-age-calculator/">Age Calculator</a> |
                    <a href="/calculators/23-unit-converter/">Unit Converter</a> |
                    <a href="/calculators/24-scientific-calculator/">Scientific Calculator</a> |
                    <a href="/calculators/25-grade-calculator/">Grade Calculator</a> |
                    <a href="/calculators/26-study-planner/">Study Planner</a>
                </p>
                <p>
                    <a href="/calculators/27-password-strength-checker/">Password Strength Checker</a> |
                    <a href="/calculators/28-file-size-converter/">File Size Converter</a> |
                    <a href="/calculators/29-color-code-converter/">Color Code Converter</a> |
                    <a href="/calculators/30-time-zone-converter/">Time Zone Converter</a> |
                    <a href="/calculators/31-data-storage-calculator/">Data Storage Calculator</a>
                </p>
                <p>
                    <a href="/calculators/32-website-load-time-calculator/">Website Load Time Calculator</a> |
                    <a href="/calculators/33-api-calculator/">API Calculator</a> |
                    <a href="/calculators/34-tip-calculator/">Tip Calculator</a> |
                    <a href="/calculators/35-discount-calculator/">Discount Calculator</a> |
                    <a href="/calculators/36-fuel-cost-calculator/">Fuel Cost Calculator</a>
                </p>
                <p>
                    <a href="/calculators/37-time-duration-calculator/">Time Duration Calculator</a> |
                    <a href="/calculators/38-age-difference-calculator/">Age Difference Calculator</a> |
                    <a href="/calculators/39-date-calculator/">Date Calculator</a> |
                    <a href="/calculators/40-base64-converter/">Base64 Converter</a> |
                    <a href="/calculators/41-json-formatter/">JSON Formatter</a>
                </p>
                <p>
                    <a href="/calculators/42-regex-tester/">Regex Tester</a> |
                    <a href="/calculators/43-code-beautifier/">Code Beautifier</a> |
                    <a href="/calculators/44-md5-generator/">MD5 Generator</a> |
                    <a href="/calculators/45-url-encoder/">URL Encoder</a> |
                    <a href="/calculators/46-character-counter/">Character Counter</a>
                </p>
                <p>
                    <a href="/calculators/47-lorem-ipsum-generator/">Lorem Ipsum Generator</a> |
                    <a href="/calculators/48-csv-to-json-converter/">CSV to JSON Converter</a> |
                    <a href="/calculators/49-carbon-footprint-calculator/">Carbon Footprint Calculator</a> |
                    <a href="/calculators/50-youtube-earnings-calculator/">YouTube Earnings Calculator</a>
                </p>
            </div>
        </div>
    </div>

    <script>
        const mortgageTypes = <?php echo json_encode($mortgage_types); ?>;
        const states = <?php echo json_encode($states); ?>;
        const creditTiers = <?php echo json_encode($credit_score_tiers); ?>;
        let fhaLoan = false;
        let vaLoan = false;
        let fixedRate = false;
        let firstTimeBuyer = false;
        let currentCreditTier = 'Good';
        let creditAdjustment = 0;

        function updateLoanLimits() {
            const loanType = document.getElementById('loanType').value;
            const limits = mortgageTypes[loanType];
            
            document.getElementById('loanTerm').min = limits.term;
            document.getElementById('loanTerm').max = limits.term;
            document.getElementById('loanTerm').value = limits.term;
            
            document.getElementById('tenureLimit').textContent = `Fixed term: ${limits.term} years`;
            document.getElementById('typicalRate').textContent = limits.rate;

            // Update loan categories
            const categoriesContainer = document.getElementById('loanCategories');
            categoriesContainer.innerHTML = '';
            const categoryElement = document.createElement('div');
            categoryElement.className = 'loan-category';
            categoryElement.textContent = loanType;
            categoriesContainer.appendChild(categoryElement);
        }

        function updateStateInfo() {
            const state = document.getElementById('state').value;
            document.getElementById('stateInfo').textContent = states[state];
        }

        function updateCreditScore() {
            const creditScore = parseInt(document.getElementById('creditScore').value);
            document.getElementById('creditScoreInfo').textContent = `Credit Score: ${creditScore}`;
            
            // Update credit meter color
            const creditFill = document.getElementById('creditFill');
            const creditPercentage = ((creditScore - 300) / (850 - 300)) * 100;
            creditFill.style.width = creditPercentage + '%';
            
            // Determine credit tier and adjustment
            for (const [tier, data] of Object.entries(creditTiers)) {
                if (creditScore >= data.min && creditScore <= data.max) {
                    currentCreditTier = tier;
                    creditAdjustment = data.rate_adjustment;
                    break;
                }
            }
            
            // Update credit tier info with color coding
            const tierInfo = document.getElementById('creditTierInfo');
            tierInfo.textContent = `Credit Tier: ${currentCreditTier} (Rate ${creditAdjustment >= 0 ? '+' : ''}${creditAdjustment}%)`;
            
            // Color coding for credit tiers
            const tierColors = {
                'Excellent': '#28a745',
                'Very Good': '#20c997',
                'Good': '#ffc107',
                'Fair': '#fd7e14',
                'Poor': '#dc3545'
            };
            
            creditFill.style.background = tierColors[currentCreditTier];
            tierInfo.style.color = tierColors[currentCreditTier];
        }

        function updateDownPaymentPercent() {
            const homePrice = parseFloat(document.getElementById('homePrice').value) || 0;
            const downPayment = parseFloat(document.getElementById('downPayment').value) || 0;
            
            if (homePrice > 0) {
                const percent = (downPayment / homePrice * 100).toFixed(1);
                document.getElementById('downPaymentPercent').textContent = percent + '% down payment';
            }
        }

        function toggleFHALoan() {
            fhaLoan = document.getElementById('fhaLoan').checked;
            if (fhaLoan) {
                document.getElementById('vaLoan').checked = false;
                vaLoan = false;
            }
        }

        function toggleVALoan() {
            vaLoan = document.getElementById('vaLoan').checked;
            if (vaLoan) {
                document.getElementById('fhaLoan').checked = false;
                fhaLoan = false;
            }
        }

        function toggleFixedRate() {
            fixedRate = document.getElementById('fixedRate').checked;
        }

        function toggleFirstTimeBuyer() {
            firstTimeBuyer = document.getElementById('firstTimeBuyer').checked;
        }

        function calculateMortgage() {
            const homePrice = parseFloat(document.getElementById('homePrice').value);
            let downPayment = parseFloat(document.getElementById('downPayment').value);
            let rate = parseFloat(document.getElementById('interestRate').value);
            const tenure = parseFloat(document.getElementById('loanTerm').value);
            const propertyTax = parseFloat(document.getElementById('propertyTax').value) || 0;
            const homeInsurance = parseFloat(document.getElementById('homeInsurance').value) || 0;
            const pmi = parseFloat(document.getElementById('pmi').value) || 0;
            const creditScore = parseInt(document.getElementById('creditScore').value);
            
            if (!homePrice || !downPayment || !rate || !tenure) {
                alert('Please fill all required fields');
                return;
            }

            // Apply credit score adjustment
            rate += creditAdjustment;

            // Apply government program adjustments
            if (fhaLoan) {
                rate -= 0.5; // FHA typically has lower rates
                // FHA requires 3.5% down payment minimum
                const minDownPayment = homePrice * 0.035;
                if (downPayment < minDownPayment) {
                    downPayment = minDownPayment;
                    document.getElementById('downPayment').value = downPayment.toFixed(2);
                }
            }
            if (vaLoan) {
                rate -= 0.75; // VA loans have the lowest rates
                downPayment = 0; // VA loans can have 0% down payment
                document.getElementById('downPayment').value = 0;
            }
            if (firstTimeBuyer) {
                // First-time buyer benefits
                rate -= 0.25;
            }

            const loanAmount = homePrice - downPayment;
            const monthlyRate = rate / 12 / 100;
            const months = tenure * 12;
            const monthlyPI = loanAmount * monthlyRate * Math.pow(1 + monthlyRate, months) / 
                        (Math.pow(1 + monthlyRate, months) - 1);
            const totalMonthly = monthlyPI + propertyTax + homeInsurance + pmi;
            const totalPayment = monthlyPI * months;
            const totalInterest = totalPayment - loanAmount;

            // Update results
            document.getElementById('principalInterest').textContent = 
                '$' + monthlyPI.toLocaleString('en-US', {maximumFractionDigits: 2});
            document.getElementById('monthlyPayment').textContent = 
                '$' + totalMonthly.toLocaleString('en-US', {maximumFractionDigits: 2});
            document.getElementById('totalLoan').textContent = 
                '$' + loanAmount.toLocaleString('en-US', {maximumFractionDigits: 2});
            document.getElementById('totalInterest').textContent = 
                '$' + totalInterest.toLocaleString('en-US', {maximumFractionDigits: 2});
            
            let rateInfo = rate.toFixed(2) + '% APR';
            if (fhaLoan) rateInfo += ' (FHA)';
            if (vaLoan) rateInfo += ' (VA)';
            if (fixedRate) rateInfo += ' (Fixed)';
            if (firstTimeBuyer) rateInfo += ' (First-time)';
            
            document.getElementById('schemeInfo').textContent = rateInfo;

            // Debt-to-Income Ratio (assuming average US income)
            const averageIncome = 63000;
            const annualEMI = totalMonthly * 12;
            const dtiRatio = (annualEMI / averageIncome * 100);
            const dtiFill = document.getElementById('dtiFill');
            const dtiText = document.getElementById('dtiText');
            
            dtiFill.style.width = Math.min(dtiRatio, 100) + '%';
            
            if (dtiRatio <= 28) {
                dtiFill.style.background = '#28a745';
                dtiText.textContent = `DTI Ratio: ${dtiRatio.toFixed(1)}% - Good (Below 28%)`;
            } else if (dtiRatio <= 36) {
                dtiFill.style.background = '#ffc107';
                dtiText.textContent = `DTI Ratio: ${dtiRatio.toFixed(1)}% - Acceptable (28-36%)`;
            } else {
                dtiFill.style.background = '#dc3545';
                dtiText.textContent = `DTI Ratio: ${dtiRatio.toFixed(1)}% - High (Above 36%)`;
            }

            // Update chart visualization
            const total = totalMonthly;
            document.getElementById('fillPI').style.width = (monthlyPI / total * 100) + '%';
            document.getElementById('fillTax').style.width = (propertyTax / total * 100) + '%';
            document.getElementById('fillInsurance').style.width = (homeInsurance / total * 100) + '%';
            document.getElementById('fillPMI').style.width = (pmi / total * 100) + '%';
            
            // Update breakdown values
            document.getElementById('breakdownPI').textContent = '$' + monthlyPI.toFixed(2);
            document.getElementById('breakdownTax').textContent = '$' + propertyTax.toFixed(2);
            document.getElementById('breakdownInsurance').textContent = '$' + homeInsurance.toFixed(2);
            document.getElementById('breakdownPMI').textContent = '$' + pmi.toFixed(2);

            // Show amortization preview
            showAmortizationPreview(loanAmount, monthlyRate, months, monthlyPI);

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
                        <span>$${principalPaid.toLocaleString('en-US', {maximumFractionDigits: 2})}</span>
                        <span>$${interest.toLocaleString('en-US', {maximumFractionDigits: 2})}</span>
                        <span>$${balance.toLocaleString('en-US', {maximumFractionDigits: 2})}</span>
                    </div>
                `;
            }
            
            document.getElementById('amortizationPreview').innerHTML = previewHTML;
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            updateLoanLimits();
            updateStateInfo();
            updateCreditScore();
            updateDownPaymentPercent();
            
            // Add event listeners for dynamic updates
            document.getElementById('homePrice').addEventListener('input', updateDownPaymentPercent);
            document.getElementById('downPayment').addEventListener('input', updateDownPaymentPercent);
        });
    </script>
    
    <?php include '../../footer.php'; ?>
</body>
</html>