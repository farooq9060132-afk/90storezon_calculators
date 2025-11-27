<?php
$country = 'canada';
$country_name = 'Canada';
$currency = 'C$';

// Canada Mortgage calculation
function calculateCanadaMortgage($principal, $interest_rate, $tenure_years, $down_payment = 0) {
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
    'Fixed Rate' => ['rate' => '5.5% - 6.5%', 'term' => 5],
    'Variable Rate' => ['rate' => '5.2% - 6.2%', 'term' => 5],
    'Adjustable Rate' => ['rate' => '5.0% - 6.0%', 'term' => 5],
    'HELOC' => ['rate' => '6.0% - 7.0%', 'term' => 10],
    'Insured Mortgage' => ['rate' => '5.3% - 6.3%', 'term' => 25]
];

$provinces = [
    'Ontario' => 'Largest province by population',
    'British Columbia' => 'Highest property prices',
    'Alberta' => 'No provincial sales tax',
    'Quebec' => 'French-speaking province',
    'Manitoba' => 'Prairie province',
    'Saskatchewan' => 'Agricultural province',
    'Nova Scotia' => 'Maritime province',
    'New Brunswick' => 'Smallest province by area',
    'Newfoundland and Labrador' => 'Easternmost province',
    'Prince Edward Island' => 'Smallest province by population'
];

// Canadian Banks reference rates
$banks = [
    'Royal Bank (RBC)' => '5.5% - 6.5%',
    'TD Canada Trust' => '5.4% - 6.4%',
    'Scotiabank' => '5.6% - 6.6%',
    'Bank of Montreal (BMO)' => '5.5% - 6.5%',
    'CIBC' => '5.4% - 6.4%'
];

// Credit Score Tiers
$credit_score_tiers = [
    'Excellent' => ['min' => 780, 'max' => 900, 'rate_adjustment' => -1.0],
    'Very Good' => ['min' => 720, 'max' => 779, 'rate_adjustment' => -0.5],
    'Good' => ['min' => 650, 'max' => 719, 'rate_adjustment' => 0],
    'Fair' => ['min' => 580, 'max' => 649, 'rate_adjustment' => 1.5],
    'Poor' => ['min' => 300, 'max' => 579, 'rate_adjustment' => 3.0]
];

// Government Programs
$government_programs = [
    'CMHC Insurance' => 'Mortgage default insurance for down payments < 20%',
    'Genworth Insurance' => 'Alternative mortgage insurance provider',
    'Canada Mortgage Bond' => 'Government-backed mortgage funding',
    'First-Time Home Buyer' => 'Tax-free savings account for home buyers',
    'Home Buyers\' Plan' => 'Withdraw from RRSP for down payment'
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mortgage Calculator - Canada</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        .canada-theme {
            --primary-color: #D80621;
            --secondary-color: #000000;
            --accent-color: #FFFFFF;
        }
        
        .canada-badge {
            background: linear-gradient(90deg, #D80621 33%, #FFFFFF 33%, #FFFFFF 66%, #D80621 66%);
            color: #D80621;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
            border: 2px solid #D80621;
        }
        
        .bank-rates {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 15px;
            margin: 20px 0;
            border-right: 5px solid #D80621;
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
            border-bottom: 3px solid #D80621;
        }
        
        .scheme-badge {
            background: #D80621;
            color: white;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 0.8rem;
            margin-left: 10px;
        }
        
        .province-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 15px;
            margin-top: 15px;
        }
        
        .province-card {
            background: white;
            padding: 15px;
            border-radius: 10px;
            border-left: 4px solid #D80621;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        .program-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 15px;
            margin-top: 15px;
        }
        
        .program-card {
            background: linear-gradient(135deg, #D80621, #000000);
            color: white;
            padding: 20px;
            border-radius: 10px;
        }
        
        .credit-score-section {
            background: #e8f4fd;
            padding: 15px;
            border-radius: 10px;
            margin: 15px 0;
            border-left: 4px solid #D80621;
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
            background: #D80621;
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
<body class="canada-theme">
    <?php include '../../header.php'; ?>
    
    <!-- SEO Elements -->
    <link rel="canonical" href="https://90storezon.com/calculators/04-mortgage-calculator/canada.php">
    <meta name="description" content="Free Canada mortgage calculator with CMHC insurance, property taxes. Calculate fixed, variable rate mortgages for all provinces including Ontario, BC, Alberta.">
    <meta name="keywords" content="Canada mortgage calculator, home loan calculator, CMHC insurance calculator, Canadian mortgage rates, Ontario mortgage calculator">
    
    <!-- Structured Data -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "FinancialService",
        "name": "Canada Mortgage Calculator",
        "description": "Free online mortgage calculator for Canadian home buyers including all provinces and territories",
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
                <span class="canada-badge">Canada</span>
            </div>
        </div>

        <!-- Bank Rates Section -->
        <div class="bank-rates">
            <h3 style="margin: 0 0 15px 0; color: #333; text-align: center;">🏦 Current Mortgage Rates</h3>
            <div class="bank-grid">
                <?php foreach($banks as $bank => $rate): ?>
                    <div class="bank-card">
                        <div style="font-weight: 600; color: #D80621;"><?php echo $bank; ?></div>
                        <div style="color: #000000; font-weight: 500;"><?php echo $rate; ?></div>
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
                <label for="province">Province</label>
                <select id="province" onchange="updateProvinceInfo()">
                    <?php foreach($provinces as $province => $info): ?>
                        <option value="<?php echo $province; ?>"><?php echo $province; ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="limit-info" id="provinceInfo"></div>
            </div>

            <!-- Credit Score Section -->
            <div class="credit-score-section">
                <h4 style="margin: 0 0 10px 0; color: #D80621;">📊 Credit Score Impact</h4>
                <div class="input-group">
                    <label for="creditScore">Credit Score</label>
                    <input type="range" id="creditScore" min="300" max="900" value="700" oninput="updateCreditScore()">
                    <div class="limit-info" id="creditScoreInfo"></div>
                </div>
                <div class="credit-meter">
                    <div class="credit-fill" id="creditFill"></div>
                </div>
                <div id="creditTierInfo" style="font-weight: 600; color: #D80621;"></div>
            </div>

            <div class="input-group">
                <label for="propertyValue">Property Value (<?php echo $currency; ?>)</label>
                <input type="number" id="propertyValue" placeholder="Enter property value" min="50000" step="1000" value="500000">
                <div class="limit-info" id="priceLimit">Range: C$50,000 - C$5,000,000</div>
            </div>

            <div class="input-group">
                <label for="downPayment">Down Payment (<?php echo $currency; ?>)</label>
                <input type="number" id="downPayment" placeholder="Enter down payment" min="0" step="1000" value="100000">
                <div class="limit-info" id="downPaymentPercent">20% down payment</div>
            </div>

            <div class="input-group">
                <label for="interestRate">Interest Rate (% APR)</label>
                <input type="number" id="interestRate" placeholder="Enter interest rate" min="0.5" max="15" step="0.1" value="5.5">
                <div class="rate-info" id="interestRange">Typical rates: <span id="typicalRate">5.5% - 6.5%</span></div>
            </div>

            <div class="input-group">
                <label for="loanTerm">Loan Term (Years)</label>
                <input type="number" id="loanTerm" placeholder="Enter loan term" min="5" max="25" step="1" value="25">
                <div class="limit-info" id="tenureLimit">Range: 5 - 25 years</div>
            </div>

            <!-- Insurance Calculator -->
            <div class="tax-calculator">
                <h4 style="margin: 0 0 10px 0; color: #856404;">🏠 Mortgage Insurance Calculator</h4>
                <div class="input-group">
                    <label class="checkbox-container">
                        <input type="checkbox" id="cmhcInsurance" onchange="calculateInsurance()">
                        <span class="checkmark"></span>
                        CMHC Insurance
                    </label>
                </div>
                <div class="input-group">
                    <label class="checkbox-container">
                        <input type="checkbox" id="firstTimeBuyer" onchange="calculateInsurance()">
                        <span class="checkmark"></span>
                        First-time Buyer
                    </label>
                </div>
                <div id="insuranceResult" class="insurance-result">
                    Insurance: C$0
                </div>
            </div>

            <div class="additional-options">
                <label class="checkbox-container">
                    <input type="checkbox" id="fixedRate" onchange="toggleFixedRate()">
                    <span class="checkmark"></span>
                    Fixed Rate Mortgage
                </label>
                
                <label class="checkbox-container">
                    <input type="checkbox" id="variableRate" onchange="toggleVariableRate()">
                    <span class="checkmark"></span>
                    Variable Rate Mortgage
                </label>

                <label class="checkbox-container">
                    <input type="checkbox" id="heloc" onchange="toggleHELOC()">
                    <span class="checkmark"></span>
                    HELOC (Home Equity Line of Credit)
                </label>
            </div>

            <button class="calculate-btn" onclick="calculateCanadaMortgage()">Calculate Mortgage Payment</button>

            <div id="results" class="results-container" style="display: none;">
                <div class="result-header">
                    <h3>Canada Mortgage Summary</h3>
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
                        <h4>Total Mortgage</h4>
                        <p id="totalMortgage" class="result-amount">-</p>
                    </div>
                    <div class="result-card">
                        <h4>Total Interest</h4>
                        <p id="totalInterest" class="result-amount">-</p>
                    </div>
                </div>
                
                <!-- Affordability Check -->
                <div class="affordability-card">
                    <h4>Affordability Check</h4>
                    <div class="affordability-meter">
                        <div class="affordability-fill" id="affordabilityFill"></div>
                    </div>
                    <p id="affordabilityText" class="affordability-text"></p>
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
                            <div class="chart-label">Mortgage Insurance</div>
                            <div class="chart-value" id="breakdownInsurance">-</div>
                            <div class="chart-fill insurance-fill" id="fillInsurance"></div>
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
            <h3>Canadian Government Mortgage Programs</h3>
            <div class="program-grid">
                <?php foreach($government_programs as $program => $details): ?>
                    <div class="program-card">
                        <h4 style="margin: 0 0 10px 0;">🏛️ <?php echo $program; ?></h4>
                        <p style="margin: 0; opacity: 0.9;"><?php echo $details; ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Provinces Information -->
        <div class="info-section">
            <h3>Canadian Provinces Information</h3>
            <div class="province-grid">
                <?php foreach($provinces as $province => $info): ?>
                    <div class="province-card">
                        <h4 style="color: #D80621; margin: 0 0 10px 0;">🇨🇦 <?php echo $province; ?></h4>
                        <p style="margin: 0; color: #555;"><?php echo $info; ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Canada Specific Information -->
        <div class="info-section">
            <h3>Mortgage Information in Canada</h3>
            <div class="info-grid">
                <div class="info-card">
                    <h4>🏠 Mortgage Types</h4>
                    <p>Fixed & variable rates</p>
                    <p>Insured mortgages</p>
                    <p>HELOC options</p>
                </div>
                <div class="info-card">
                    <h4>📊 Interest Rates</h4>
                    <p>Currently 5.5-6.5%</p>
                    <p>Bank of Canada rate</p>
                    <p>Prime rate + spread</p>
                </div>
                <div class="info-card">
                    <h4>🏛️ Government Insurance</h4>
                    <p>CMHC Insurance</p>
                    <p>Genworth Insurance</p>
                    <p>Canada Guaranty</p>
                </div>
                <div class="info-card">
                    <h4>💰 Additional Costs</h4>
                    <p>Mortgage insurance</p>
                    <p>Land transfer tax</p>
                    <p>Legal fees</p>
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
        const provinces = <?php echo json_encode($provinces); ?>;
        const creditTiers = <?php echo json_encode($credit_score_tiers); ?>;
        let fixedRate = false;
        let variableRate = false;
        let heloc = false;
        let cmhcInsurance = false;
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

        function updateProvinceInfo() {
            const province = document.getElementById('province').value;
            document.getElementById('provinceInfo').textContent = provinces[province];
        }

        function updateCreditScore() {
            const creditScore = parseInt(document.getElementById('creditScore').value);
            document.getElementById('creditScoreInfo').textContent = `Credit Score: ${creditScore}`;
            
            // Update credit meter color
            const creditFill = document.getElementById('creditFill');
            const creditPercentage = ((creditScore - 300) / (900 - 300)) * 100;
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
            const propertyValue = parseFloat(document.getElementById('propertyValue').value) || 0;
            const downPayment = parseFloat(document.getElementById('downPayment').value) || 0;
            
            if (propertyValue > 0) {
                const percent = (downPayment / propertyValue * 100).toFixed(1);
                document.getElementById('downPaymentPercent').textContent = percent + '% down payment';
            }
        }

        function calculateInsurance() {
            const propertyValue = parseFloat(document.getElementById('propertyValue').value) || 0;
            const downPayment = parseFloat(document.getElementById('downPayment').value) || 0;
            const isCMHC = document.getElementById('cmhcInsurance').checked;
            const isFirstTime = document.getElementById('firstTimeBuyer').checked;

            let insurance = 0;
            const loanAmount = propertyValue - downPayment;
            const downPaymentPercent = (downPayment / propertyValue) * 100;

            if (isCMHC && downPaymentPercent < 20) {
                // CMHC insurance rates
                if (downPaymentPercent >= 5 && downPaymentPercent < 10) {
                    insurance = loanAmount * 0.04;
                } else if (downPaymentPercent >= 10 && downPaymentPercent < 15) {
                    insurance = loanAmount * 0.031;
                } else if (downPaymentPercent >= 15 && downPaymentPercent < 20) {
                    insurance = loanAmount * 0.028;
                }
            }

            if (isFirstTime) {
                // First-time buyer benefits
                insurance *= 0.9; // 10% discount
            }

            document.getElementById('insuranceResult').textContent = 
                'Insurance: C$' + insurance.toLocaleString('en-CA', {maximumFractionDigits: 0});
        }

        function toggleFixedRate() {
            fixedRate = document.getElementById('fixedRate').checked;
        }

        function toggleVariableRate() {
            variableRate = document.getElementById('variableRate').checked;
        }

        function toggleHELOC() {
            heloc = document.getElementById('heloc').checked;
        }

        function calculateCanadaMortgage() {
            const propertyValue = parseFloat(document.getElementById('propertyValue').value);
            let downPayment = parseFloat(document.getElementById('downPayment').value);
            let rate = parseFloat(document.getElementById('interestRate').value);
            const tenure = parseFloat(document.getElementById('loanTerm').value);
            const creditScore = parseInt(document.getElementById('creditScore').value);
            
            if (!propertyValue || !downPayment || !rate || !tenure) {
                alert('Please fill all required fields');
                return;
            }

            // Apply credit score adjustment
            rate += creditAdjustment;

            // Apply mortgage type adjustments
            if (fixedRate) {
                rate -= 0.25; // Fixed rate benefit
            }
            if (variableRate) {
                rate += 0.5; // Variable rate risk premium
            }
            if (heloc) {
                rate += 0.75; // HELOC typically has higher rates
            }

            const loanAmount = propertyValue - downPayment;
            const monthlyRate = rate / 12 / 100;
            const months = tenure * 12;
            const monthlyPI = loanAmount * monthlyRate * Math.pow(1 + monthlyRate, months) / 
                        (pow(1 + monthlyRate, months) - 1);
            
            // Calculate insurance
            calculateInsurance();
            const insuranceText = document.getElementById('insuranceResult').textContent;
            const insurance = parseFloat(insuranceText.replace('Insurance: C$', '').replace(/,/g, '')) || 0;
            const monthlyInsurance = insurance / months;
            
            const totalMonthly = monthlyPI + monthlyInsurance;
            const totalPayment = monthlyPI * months;
            const totalInterest = totalPayment - loanAmount;

            // Update results
            document.getElementById('principalInterest').textContent = 
                'C$' + monthlyPI.toLocaleString('en-CA', {maximumFractionDigits: 2});
            document.getElementById('monthlyPayment').textContent = 
                'C$' + totalMonthly.toLocaleString('en-CA', {maximumFractionDigits: 2});
            document.getElementById('totalMortgage').textContent = 
                'C$' + (loanAmount + totalInterest).toLocaleString('en-CA', {maximumFractionDigits: 2});
            document.getElementById('totalInterest').textContent = 
                'C$' + totalInterest.toLocaleString('en-CA', {maximumFractionDigits: 2});
            
            let rateInfo = rate.toFixed(2) + '% APR';
            if (fixedRate) rateInfo += ' (Fixed)';
            if (variableRate) rateInfo += ' (Variable)';
            if (heloc) rateInfo += ' (HELOC)';
            
            document.getElementById('schemeInfo').textContent = rateInfo;

            // Affordability check (assuming average Canadian salary)
            const averageSalary = 55000;
            const annualPayment = totalMonthly * 12;
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

            // Update chart visualization
            const total = totalMonthly;
            document.getElementById('fillPI').style.width = (monthlyPI / total * 100) + '%';
            document.getElementById('fillInsurance').style.width = (monthlyInsurance / total * 100) + '%';
            
            // Update breakdown values
            document.getElementById('breakdownPI').textContent = 'C$' + monthlyPI.toFixed(2);
            document.getElementById('breakdownInsurance').textContent = 'C$' + monthlyInsurance.toFixed(2);

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
                        <span>C$${principalPaid.toLocaleString('en-CA', {maximumFractionDigits: 2})}</span>
                        <span>C$${interest.toLocaleString('en-CA', {maximumFractionDigits: 2})}</span>
                        <span>C$${balance.toLocaleString('en-CA', {maximumFractionDigits: 2})}</span>
                    </div>
                `;
            }
            
            document.getElementById('amortizationPreview').innerHTML = previewHTML;
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            updateLoanLimits();
            updateProvinceInfo();
            updateCreditScore();
            updateDownPaymentPercent();
            calculateInsurance();
            
            // Add event listeners for dynamic updates
            document.getElementById('propertyValue').addEventListener('input', updateDownPaymentPercent);
            document.getElementById('downPayment').addEventListener('input', updateDownPaymentPercent);
            document.getElementById('cmhcInsurance').addEventListener('change', calculateInsurance);
            document.getElementById('firstTimeBuyer').addEventListener('change', calculateInsurance);
        });
    </script>
    
    <?php include '../../footer.php'; ?>
</body>
</html>