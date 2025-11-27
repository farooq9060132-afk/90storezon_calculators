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

// UK Banks reference rates
$banks = [
    'Barclays' => '4.5% - 5.5%',
    'HSBC' => '4.4% - 5.4%',
    'Lloyds' => '4.6% - 5.6%',
    'NatWest' => '4.5% - 5.5%',
    'Santander' => '4.4% - 5.4%'
];

// Credit Score Tiers
$credit_score_tiers = [
    'Excellent' => ['min' => 900, 'max' => 999, 'rate_adjustment' => -1.0],
    'Very Good' => ['min' => 800, 'max' => 899, 'rate_adjustment' => -0.5],
    'Good' => ['min' => 700, 'max' => 799, 'rate_adjustment' => 0],
    'Fair' => ['min' => 600, 'max' => 699, 'rate_adjustment' => 1.5],
    'Poor' => ['min' => 0, 'max' => 599, 'rate_adjustment' => 3.0]
];

// Government Programs
$government_programs = [
    'Help to Buy' => 'Equity loan up to 40% in London, 20% elsewhere',
    'Shared Ownership' => 'Buy 25-75% of property, pay rent on remainder',
    'Right to Buy' => 'Council tenants can buy their home at discount',
    'Lifetime ISA' => 'Save for deposit with 25% government bonus',
    'First Homes' => 'New scheme for first-time buyers with discount'
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mortgage Calculator - United Kingdom</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        .uk-theme {
            --primary-color: #012169;
            --secondary-color: #C8102E;
            --accent-color: #FFFFFF;
        }
        
        .uk-badge {
            background: linear-gradient(90deg, #012169 50%, #C8102E 50%);
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
            border: 2px solid #012169;
        }
        
        .bank-rates {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 15px;
            margin: 20px 0;
            border-right: 5px solid #012169;
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
            border-bottom: 3px solid #012169;
        }
        
        .scheme-badge {
            background: #C8102E;
            color: white;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 0.8rem;
            margin-left: 10px;
        }
        
        .region-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 15px;
            margin-top: 15px;
        }
        
        .region-card {
            background: white;
            padding: 15px;
            border-radius: 10px;
            border-left: 4px solid #012169;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        .program-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 15px;
            margin-top: 15px;
        }
        
        .program-card {
            background: linear-gradient(135deg, #012169, #C8102E);
            color: white;
            padding: 20px;
            border-radius: 10px;
        }
        
        .credit-score-section {
            background: #e8f4fd;
            padding: 15px;
            border-radius: 10px;
            margin: 15px 0;
            border-left: 4px solid #012169;
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
            background: #012169;
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
<body class="uk-theme">
    <?php include '../../header.php'; ?>
    
    <!-- SEO Elements -->
    <link rel="canonical" href="https://90storezon.com/calculators/04-mortgage-calculator/uk.php">
    <meta name="description" content="Free UK mortgage calculator with stamp duty, help to buy schemes. Calculate buy to let, fixed rate mortgages for England, Scotland, Wales & Northern Ireland.">
    <meta name="keywords" content="UK mortgage calculator, home loan calculator, Help to Buy calculator, stamp duty calculator, buy to let calculator">
    
    <!-- Structured Data -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "FinancialService",
        "name": "UK Mortgage Calculator",
        "description": "Free online mortgage calculator for UK property buyers including England, Scotland, Wales and Northern Ireland",
        "url": "https://90storezon.com/calculators/04-mortgage-calculator/uk.php",
        "areaServed": "GB",
        "serviceType": "Mortgage Calculator"
    }
    </script>
    
    <div class="calculator-container">
        <div class="header">
            <h1 class="title">UK Mortgage Calculator</h1>
            <div class="country-badge">
                <img src="https://flagcdn.com/w80/gb.png" alt="UK Flag - Mortgage Calculator" class="flag">
                <span class="uk-badge">United Kingdom</span>
            </div>
        </div>

        <!-- Bank Rates Section -->
        <div class="bank-rates">
            <h3 style="margin: 0 0 15px 0; color: #333; text-align: center;">🏦 Current Mortgage Rates</h3>
            <div class="bank-grid">
                <?php foreach($banks as $bank => $rate): ?>
                    <div class="bank-card">
                        <div style="font-weight: 600; color: #012169;"><?php echo $bank; ?></div>
                        <div style="color: #C8102E; font-weight: 500;"><?php echo $rate; ?></div>
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
                <label for="region">UK Region</label>
                <select id="region" onchange="updateRegionInfo()">
                    <?php foreach($regions as $region => $info): ?>
                        <option value="<?php echo $region; ?>"><?php echo $region; ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="limit-info" id="regionInfo"></div>
            </div>

            <!-- Credit Score Section -->
            <div class="credit-score-section">
                <h4 style="margin: 0 0 10px 0; color: #012169;">📊 Credit Score Impact</h4>
                <div class="input-group">
                    <label for="creditScore">Credit Score</label>
                    <input type="range" id="creditScore" min="0" max="999" value="800" oninput="updateCreditScore()">
                    <div class="limit-info" id="creditScoreInfo"></div>
                </div>
                <div class="credit-meter">
                    <div class="credit-fill" id="creditFill"></div>
                </div>
                <div id="creditTierInfo" style="font-weight: 600; color: #012169;"></div>
            </div>

            <div class="input-group">
                <label for="propertyValue">Property Value (<?php echo $currency; ?>)</label>
                <input type="number" id="propertyValue" placeholder="Enter property value" min="50000" step="1000" value="300000">
                <div class="limit-info" id="priceLimit">Range: £50,000 - £5,000,000</div>
            </div>

            <div class="input-group">
                <label for="depositAmount">Deposit Amount (<?php echo $currency; ?>)</label>
                <input type="number" id="depositAmount" placeholder="Enter deposit amount" min="0" step="1000" value="45000">
                <div class="limit-info" id="depositPercent">15% deposit</div>
            </div>

            <div class="input-group">
                <label for="interestRate">Interest Rate (% APR)</label>
                <input type="number" id="interestRate" placeholder="Enter interest rate" min="0.5" max="15" step="0.1" value="4.8">
                <div class="rate-info" id="interestRange">Typical rates: <span id="typicalRate">4.5% - 5.5%</span></div>
            </div>

            <div class="input-group">
                <label for="loanTerm">Loan Term (Years)</label>
                <input type="number" id="loanTerm" placeholder="Enter loan term" min="5" max="35" step="1" value="25">
                <div class="limit-info" id="tenureLimit">Range: 5 - 35 years</div>
            </div>

            <!-- Stamp Duty Calculator -->
            <div class="tax-calculator">
                <h4 style="margin: 0 0 10px 0; color: #856404;">🏠 Stamp Duty Calculator</h4>
                <div class="input-group">
                    <label class="checkbox-container">
                        <input type="checkbox" id="firstTimeBuyer" onchange="calculateStampDuty()">
                        <span class="checkmark"></span>
                        First-time Buyer
                    </label>
                </div>
                <div class="input-group">
                    <label class="checkbox-container">
                        <input type="checkbox" id="buyToLet" onchange="calculateStampDuty()">
                        <span class="checkmark"></span>
                        Buy to Let Property
                    </label>
                </div>
                <div id="stampDutyResult" class="stamp-duty-result">
                    Stamp Duty: £0
                </div>
            </div>

            <div class="additional-options">
                <label class="checkbox-container">
                    <input type="checkbox" id="helpToBuy" onchange="toggleHelpToBuy()">
                    <span class="checkmark"></span>
                    Help to Buy Scheme <span class="scheme-badge">Government</span>
                </label>
                
                <label class="checkbox-container">
                    <input type="checkbox" id="sharedOwnership" onchange="toggleSharedOwnership()">
                    <span class="checkmark"></span>
                    Shared Ownership
                </label>

                <label class="checkbox-container">
                    <input type="checkbox" id="fixedRate" onchange="toggleFixedRate()">
                    <span class="checkmark"></span>
                    Fixed Rate Mortgage
                </label>
            </div>

            <button class="calculate-btn" onclick="calculateUKMortgage()">Calculate Mortgage Payment</button>

            <div id="results" class="results-container" style="display: none;">
                <div class="result-header">
                    <h3>UK Mortgage Summary</h3>
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
                            <div class="chart-label">Stamp Duty</div>
                            <div class="chart-value" id="breakdownStampDuty">-</div>
                            <div class="chart-fill stamp-duty-fill" id="fillStampDuty"></div>
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
            <h3>UK Government Mortgage Programs</h3>
            <div class="program-grid">
                <?php foreach($government_programs as $program => $details): ?>
                    <div class="program-card">
                        <h4 style="margin: 0 0 10px 0;">🏛️ <?php echo $program; ?></h4>
                        <p style="margin: 0; opacity: 0.9;"><?php echo $details; ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Regions Information -->
        <div class="info-section">
            <h3>UK Regions Information</h3>
            <div class="region-grid">
                <?php foreach($regions as $region => $info): ?>
                    <div class="region-card">
                        <h4 style="color: #012169; margin: 0 0 10px 0;">🇬🇧 <?php echo $region; ?></h4>
                        <p style="margin: 0; color: #555;"><?php echo $info; ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- UK Specific Information -->
        <div class="info-section">
            <h3>Mortgage Information in United Kingdom</h3>
            <div class="info-grid">
                <div class="info-card">
                    <h4>🏠 Mortgage Types</h4>
                    <p>Fixed & variable rates</p>
                    <p>Tracker mortgages</p>
                    <p>Offset mortgages</p>
                </div>
                <div class="info-card">
                    <h4>📊 Interest Rates</h4>
                    <p>Currently 4.5-5.5%</p>
                    <p>Credit score based</p>
                    <p>Fixed & tracker options</p>
                </div>
                <div class="info-card">
                    <h4>🏛️ Government Schemes</h4>
                    <p>Help to Buy</p>
                    <p>Shared Ownership</p>
                    <p>Right to Buy</p>
                </div>
                <div class="info-card">
                    <h4>💰 Additional Costs</h4>
                    <p>Stamp duty</p>
                    <p>Legal fees</p>
                    <p>Valuation fees</p>
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
        const regions = <?php echo json_encode($regions); ?>;
        const creditTiers = <?php echo json_encode($credit_score_tiers); ?>;
        let helpToBuy = false;
        let sharedOwnership = false;
        let fixedRate = false;
        let firstTimeBuyer = false;
        let buyToLet = false;
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

        function updateRegionInfo() {
            const region = document.getElementById('region').value;
            document.getElementById('regionInfo').textContent = regions[region];
        }

        function updateCreditScore() {
            const creditScore = parseInt(document.getElementById('creditScore').value);
            document.getElementById('creditScoreInfo').textContent = `Credit Score: ${creditScore}`;
            
            // Update credit meter color
            const creditFill = document.getElementById('creditFill');
            const creditPercentage = (creditScore / 999) * 100;
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

        function updateDepositPercent() {
            const propertyValue = parseFloat(document.getElementById('propertyValue').value) || 0;
            const depositAmount = parseFloat(document.getElementById('depositAmount').value) || 0;
            
            if (propertyValue > 0) {
                const percent = (depositAmount / propertyValue * 100).toFixed(1);
                document.getElementById('depositPercent').textContent = percent + '% deposit';
            }
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
            helpToBuy = document.getElementById('helpToBuy').checked;
        }

        function toggleSharedOwnership() {
            sharedOwnership = document.getElementById('sharedOwnership').checked;
        }

        function toggleFixedRate() {
            fixedRate = document.getElementById('fixedRate').checked;
        }

        function calculateUKMortgage() {
            const propertyValue = parseFloat(document.getElementById('propertyValue').value);
            let depositAmount = parseFloat(document.getElementById('depositAmount').value);
            let rate = parseFloat(document.getElementById('interestRate').value);
            const tenure = parseFloat(document.getElementById('loanTerm').value);
            const creditScore = parseInt(document.getElementById('creditScore').value);
            
            if (!propertyValue || !depositAmount || !rate || !tenure) {
                alert('Please fill all required fields');
                return;
            }

            // Apply credit score adjustment
            rate += creditAdjustment;

            // Apply government program adjustments
            if (helpToBuy) {
                rate -= 0.5; // Help to Buy typically has lower rates
            }
            if (sharedOwnership) {
                rate -= 0.25; // Shared ownership benefits
            }

            const loanAmount = propertyValue - depositAmount;
            const monthlyRate = rate / 12 / 100;
            const months = tenure * 12;
            const monthlyPI = loanAmount * monthlyRate * Math.pow(1 + monthlyRate, months) / 
                        (pow(1 + monthlyRate, months) - 1);
            
            // Calculate stamp duty
            calculateStampDuty();
            const stampDutyText = document.getElementById('stampDutyResult').textContent;
            const stampDuty = parseFloat(stampDutyText.replace('Stamp Duty: £', '').replace(/,/g, '')) || 0;
            
            const totalMonthly = monthlyPI;
            const totalPayment = monthlyPI * months;
            const totalInterest = totalPayment - loanAmount;

            // Update results
            document.getElementById('principalInterest').textContent = 
                '£' + monthlyPI.toLocaleString('en-GB', {maximumFractionDigits: 2});
            document.getElementById('monthlyPayment').textContent = 
                '£' + totalMonthly.toLocaleString('en-GB', {maximumFractionDigits: 2});
            document.getElementById('totalMortgage').textContent = 
                '£' + (loanAmount + totalInterest).toLocaleString('en-GB', {maximumFractionDigits: 2});
            document.getElementById('totalInterest').textContent = 
                '£' + totalInterest.toLocaleString('en-GB', {maximumFractionDigits: 2});
            
            let rateInfo = rate.toFixed(2) + '% APR';
            if (helpToBuy) rateInfo += ' (Help to Buy)';
            if (sharedOwnership) rateInfo += ' (Shared Ownership)';
            if (fixedRate) rateInfo += ' (Fixed)';
            
            document.getElementById('schemeInfo').textContent = rateInfo;

            // Affordability check (assuming average UK salary)
            const averageSalary = 33000;
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
            document.getElementById('fillStampDuty').style.width = (stampDuty / 12 / total * 100) + '%';
            
            // Update breakdown values
            document.getElementById('breakdownPI').textContent = '£' + monthlyPI.toFixed(2);
            document.getElementById('breakdownStampDuty').textContent = '£' + (stampDuty / 12).toFixed(2);

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
                        <span>£${principalPaid.toLocaleString('en-GB', {maximumFractionDigits: 2})}</span>
                        <span>£${interest.toLocaleString('en-GB', {maximumFractionDigits: 2})}</span>
                        <span>£${balance.toLocaleString('en-GB', {maximumFractionDigits: 2})}</span>
                    </div>
                `;
            }
            
            document.getElementById('amortizationPreview').innerHTML = previewHTML;
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            updateLoanLimits();
            updateRegionInfo();
            updateCreditScore();
            updateDepositPercent();
            calculateStampDuty();
            
            // Add event listeners for dynamic updates
            document.getElementById('propertyValue').addEventListener('input', updateDepositPercent);
            document.getElementById('depositAmount').addEventListener('input', updateDepositPercent);
            document.getElementById('firstTimeBuyer').addEventListener('change', calculateStampDuty);
            document.getElementById('buyToLet').addEventListener('change', calculateStampDuty);
        });
    </script>
    
    <?php include '../../footer.php'; ?>
</body>
</html>