<?php
$country = 'pakistan';
$country_name = 'Pakistan';
$currency = 'Rs';

// Pakistan Mortgage calculation
function calculatePKMortgage($principal, $interest_rate, $tenure_years, $down_payment = 0) {
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

// Pakistan Mortgage data
$mortgage_types = [
    'Home Loan (HBL)' => ['rate' => '12.5% - 14.5%', 'term' => 20],
    'Home Loan (UBL)' => ['rate' => '12.8% - 14.8%', 'term' => 20],
    'Home Loan (MCB)' => ['rate' => '12.6% - 14.6%', 'term' => 20],
    'Mera Pakistan Mera Ghar' => ['rate' => '5% - 7%', 'term' => 20],
    'Apna Ghar Scheme' => ['rate' => '8% - 10%', 'term' => 20]
];

$cities = [
    'Karachi' => 'Commercial capital - High prices',
    'Lahore' => 'Cultural capital - Moderate prices',
    'Islamabad' => 'Capital city - Premium market',
    'Rawalpindi' => 'Twin city - Affordable',
    'Faisalabad' => 'Industrial city - Low cost',
    'Peshawar' => 'Historical city - Traditional market'
];

$government_schemes = [
    'Mera Pakistan Mera Ghar' => 'State Bank subsidized scheme',
    'Naya Pakistan Housing' => 'Government housing initiative',
    'Apna Ghar Scheme' => 'Affordable housing program',
    'Youth Loan Scheme' => 'Special rates for youth'
];
?>
<?php include '../../header.php'; ?>

<!-- SEO Elements -->
<link rel="canonical" href="https://90storezon.com/calculators/04-mortgage-calculator/pakistan.php">
<meta name="description" content="Free Pakistan home loan calculator with Mera Pakistan Mera Ghar subsidy, bank rates. Calculate EMI for HBL, UBL, MCB home loans in Rs for Karachi, Lahore, Islamabad properties.">
<meta name="keywords" content="Pakistan home loan calculator, EMI calculator, Mera Pakistan Mera Ghar calculator, Pakistani mortgage calculator, housing loan calculator">

<!-- Structured Data -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "FinancialService",
    "name": "Pakistan Home Loan Calculator",
    "description": "Free online home loan EMI calculator for Pakistani property buyers including Mera Pakistan Mera Ghar subsidy and bank interest rates",
    "url": "https://90storezon.com/calculators/04-mortgage-calculator/pakistan.php",
    "areaServed": "PK",
    "serviceType": "Home Loan Calculator"
}
</script>

<div class="calculator-container">
        <div class="header">
            <h1 class="title">پاکستان ہوم لون کیلکولیٹر</h1>
            <div class="country-badge">
                <img src="https://flagcdn.com/w80/pk.png" alt="Pakistan Flag - Home Loan Calculator" class="flag">
                <span>Pakistan</span>
            </div>
        </div>

        <!-- Internal Links for SEO -->
        <nav class="seo-links">
            <a href="https://90storezon.com/calculators/01-loan-emi-calculator/">Loan Calculator</a> |
            <a href="https://90storezon.com/calculators/01-loan-emi-calculator/india.php">India Home Loan Calculator</a> |
            <a href="https://90storezon.com/calculators/01-loan-emi-calculator/uae.php">UAE Mortgage Calculator</a> |
            <a href="https://90storezon.com/calculators/01-loan-emi-calculator/saudi_arabia.php">Saudi Mortgage Calculator</a>
        </nav>

        <div class="calculator-card">
            <div class="input-group">
                <label for="propertyValue">پراپرٹی کی قیمت / Property Value (Rs)</label>
                <input type="number" id="propertyValue" placeholder="Enter property value" min="2000000" step="10000" value="10000000">
            </div>

            <div class="input-group">
                <label for="downPayment">ڈاؤن پے منٹ / Down Payment (Rs)</label>
                <input type="number" id="downPayment" placeholder="Enter down payment" min="0" step="10000" value="2000000">
                <div class="limit-info" id="downPaymentPercent">20% down payment</div>
            </div>

            <div class="input-group">
                <label for="city">شہر / City</label>
                <select id="city">
                    <option value="Karachi">Karachi</option>
                    <option value="Lahore">Lahore</option>
                    <option value="Islamabad">Islamabad</option>
                    <option value="Rawalpindi">Rawalpindi</option>
                    <option value="Faisalabad">Faisalabad</option>
                    <option value="Peshawar">Peshawar</option>
                    <option value="Multan">Multan</option>
                    <option value="Quetta">Quetta</option>
                </select>
            </div>

            <div class="input-group">
                <label for="bank">بینک منتخب کریں / Select Bank</label>
                <select id="bank" onchange="updateBankRate()">
                    <option value="HBL">Habib Bank Limited (HBL)</option>
                    <option value="UBL">United Bank Limited (UBL)</option>
                    <option value="MCB">Muslim Commercial Bank (MCB)</option>
                    <option value="ABL">Allied Bank Limited (ABL)</option>
                    <option value="NBP">National Bank of Pakistan (NBP)</option>
                    <option value="Bank Alfalah">Bank Alfalah</option>
                </select>
            </div>

            <div class="input-group">
                <label for="loanTerm">قرض کی مدت / Loan Term</label>
                <select id="loanTerm">
                    <option value="20">20 Years</option>
                    <option value="15">15 Years</option>
                    <option value="10">10 Years</option>
                    <option value="25">25 Years</option>
                </select>
            </div>

            <div class="input-group">
                <label for="interestRate">سود کی شرح / Interest Rate (%)</label>
                <input type="number" id="interestRate" placeholder="Enter interest rate" min="0.1" max="25" step="0.01" value="12.5">
                <div class="rate-info" id="interestRateInfo">HBL Home Loan: 12.5% - 14.5%</div>
            </div>

            <!-- Income Information -->
            <div class="income-section">
                <h3>آمدنی کی تفصیلات / Income Details</h3>
                <div class="input-group">
                    <label for="monthlyIncome">ماہانہ آمدنی / Monthly Income (Rs)</label>
                    <input type="number" id="monthlyIncome" placeholder="Enter monthly income" min="0" step="1000" value="150000">
                </div>
            </div>

            <!-- Pakistan Specific Options -->
            <div class="additional-options">
                <h3>پاکستان سرکاری اسکیمیں / Government Schemes</h3>
                <label class="checkbox-container">
                    <input type="checkbox" id="mpmgScheme" onchange="toggleMPMG()">
                    <span class="checkmark"></span>
                    میرا پاکستان میرا گھر / Mera Pakistan Mera Ghar
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" id="nayaPakistan" onchange="toggleNayaPakistan()">
                    <span class="checkmark"></span>
                    نیا پاکستان ہاؤسنگ / Naya Pakistan Housing
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" id="youthScheme" onchange="toggleYouthScheme()">
                    <span class="checkmark"></span>
                    یوتھ لون اسکیم / Youth Loan Scheme
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" id="lowCostHousing" onchange="toggleLowCostHousing()">
                    <span class="checkmark"></span>
                    لو کاسٹ ہاؤسنگ / Low Cost Housing
                </label>
            </div>

            <!-- MPMG Subsidy Calculator -->
            <div class="mpmg-calculator" id="mpmgSection" style="display: none;">
                <h4>میرا پاکستان میرا گھر سبسڈی / MPMG Subsidy</h4>
                <div class="input-group">
                    <label for="incomeCategory">آمدنی کی قسم / Income Category</label>
                    <select id="incomeCategory">
                        <option value="Low">Low Income (Rs 25,000-60,000)</option>
                        <option value="Middle">Middle Income (Rs 60,000-100,000)</option>
                        <option value="Upper">Upper Middle (Rs 100,000-200,000)</option>
                    </select>
                </div>
                <div class="limit-info" id="subsidyAmount">سبسڈی / Subsidy: Rs 0</div>
            </div>

            <!-- Registration & Stamp Duty -->
            <div class="stamp-duty-calculator">
                <h3>رجسٹریشن اور سٹامپ ڈیوٹی / Registration & Stamp Duty</h3>
                <div id="stampDutyResult" class="stamp-duty-result">
                    سٹامپ ڈیوٹی / Stamp Duty: Rs 0
                </div>
            </div>

            <button class="calculate-btn" onclick="calculatePKMortgage()">EMI حساب کریں / Calculate EMI</button>

            <div id="results" class="results-container" style="display: none;">
                <div class="result-header">
                    <h3>ہوم لون کا خلاصہ / Home Loan Summary</h3>
                </div>
                <div class="result-grid">
                    <div class="result-card">
                        <h4>ماہانہ قسط / Monthly EMI</h4>
                        <p id="monthlyEMI" class="result-amount">-</p>
                    </div>
                    <div class="result-card">
                        <h4>کل قرض کی رقم / Total Loan Amount</h4>
                        <p id="totalLoan" class="result-amount">-</p>
                    </div>
                    <div class="result-card">
                        <h4>کل سود / Total Interest</h4>
                        <p id="totalInterest" class="result-amount">-</p>
                    </div>
                    <div class="result-card">
                        <h4>قرض سے قیمت کا تناسب / Loan to Value</h4>
                        <p id="ltvRatio" class="result-amount">-</p>
                    </div>
                </div>
                
                <!-- DBR Calculation -->
                <div class="dbr-calculation">
                    <h4>DBR (Debt Burden Ratio)</h4>
                    <div class="dbr-meter">
                        <div class="dbr-fill" id="dbrFill"></div>
                    </div>
                    <p id="dbrText" class="dbr-text"></p>
                </div>

                <!-- MPMG Benefits -->
                <div class="mpmg-benefits" id="mpmgBenefits" style="display: none;">
                    <h4>میرا پاکستان میرا گھر فوائد / MPMG Benefits</h4>
                    <div class="benefits-list">
                        <p id="interestSubsidy">سود کی سبسڈی / Interest Subsidy: Rs 0</p>
                        <p id="subsidyDuration">سبسڈی کی مدت / Subsidy Duration: 0 years</p>
                        <p>✅ اسٹیٹ بینک آف پاکستان کی منظور شدہ اسکیم / SBP Approved Scheme</p>
                    </div>
                </div>

                <!-- Bank Specific Offers -->
                <div class="bank-offers">
                    <h4>بینک کی خصوصی پیشکشیں / Bank Specific Offers</h4>
                    <div class="offers-list" id="bankOffers">
                        بینک کی پیشکشیں چیک کی جا رہی ہیں / Checking bank offers...
                    </div>
                </div>

                <!-- Tax Benefits -->
                <div class="tax-benefits">
                    <h4>ٹیکس کی رعایتیں / Tax Benefits</h4>
                    <div class="tax-breakdown">
                        <p>ہوم لون پر ٹیکس رعایت / Home Loan Tax Relief: <span id="taxRelief">Rs 0</span> فی سال / per year</p>
                        <p>پہلے گھر کے لیے خصوصی رعایت / First Home Special Relief</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- SEO Content Section -->
        <section class="seo-content">
            <h2>Pakistan Home Loan Calculator - Calculate EMI for Housing Loan</h2>
            <p>Our comprehensive <strong>Pakistan home loan calculator</strong> helps property buyers across <strong>Karachi, Lahore, Islamabad, Rawalpindi, and all major Pakistani cities</strong> estimate their monthly EMI. Calculate with <strong>Mera Pakistan Mera Ghar subsidy, government schemes, and bank-specific rates</strong> for accurate Pakistani home loan calculations in Rs.</p>
            
            <h3>Popular Home Loan Providers in Pakistan</h3>
            <ul>
                <li><strong>Habib Bank Limited (HBL)</strong> - Largest private sector bank</li>
                <li><strong>United Bank Limited (UBL)</strong> - Leading commercial bank</li>
                <li><strong>Muslim Commercial Bank (MCB)</strong> - Major private bank</li>
                <li><strong>National Bank of Pakistan (NBP)</strong> - Largest public sector bank</li>
                <li><strong>Allied Bank Limited (ABL)</strong> - Established banking services</li>
            </ul>

            <h3>Mera Pakistan Mera Ghar (MPMG) Scheme</h3>
            <p>The <strong>MPMG scheme</strong> by State Bank of Pakistan provides subsidized financing for housing. Benefits include <strong>reduced markup rates, flexible repayment terms, and government subsidies</strong> for low and middle-income groups.</p>

            <h3>Pakistan Home Loan Regulations</h3>
            <p>Pakistani home loans follow <strong>SBP (State Bank of Pakistan) guidelines</strong> with <strong>DBR (Debt Burden Ratio) limits of 40-50%, maximum financing up to 85% of property value, and specific eligibility criteria</strong>. Registration and stamp duty charges vary by province.</p>

            <h3>Naya Pakistan Housing Program</h3>
            <p>The <strong>Naya Pakistan Housing Program</strong> aims to provide affordable housing to citizens through public-private partnerships, offering <strong>subsidized rates, easy installment plans, and developer financing options</strong>.</p>
        </section>

        <!-- VIP Backlinks Footer -->
        <footer class="seo-footer">
            <div class="footer-links">
                <h4>South Asian Mortgage Calculators</h4>
                <a href="https://90storezon.com/calculators/01-loan-emi-calculator/pakistan.php">Pakistan Home Loan Calculator</a> |
                <a href="https://90storezon.com/calculators/01-loan-emi-calculator/india.php">India Home Loan Calculator</a> |
                <a href="https://90storezon.com/calculators/01-loan-emi-calculator/bangladesh.php">Bangladesh Mortgage Calculator</a> |
                <a href="https://90storezon.com/calculators/01-loan-emi-calculator/srilanka.php">Sri Lanka Mortgage Calculator</a>
            </div>
            
            <div class="external-links">
                <h4>Pakistani Home Loan Resources</h4>
                <a href="https://www.sbp.org.pk" rel="nofollow">State Bank of Pakistan</a> |
                <a href="https://www.hbl.com" rel="nofollow">Habib Bank Limited</a> |
                <a href="https://www.ubl.com" rel="nofollow">United Bank Limited</a> |
                <a href="https://nphp.com.pk" rel="nofollow">Naya Pakistan Housing</a>
            </div>
        </footer>
    </div>

    <script>
    function calculatePKMortgage() {
        const propertyValue = parseFloat(document.getElementById('propertyValue').value);
        const downPayment = parseFloat(document.getElementById('downPayment').value);
        const loanTerm = parseInt(document.getElementById('loanTerm').value);
        let interestRate = parseFloat(document.getElementById('interestRate').value);
        const monthlyIncome = parseFloat(document.getElementById('monthlyIncome').value) || 0;
        const isMPMG = document.getElementById('mpmgScheme').checked;
        const isYouth = document.getElementById('youthScheme').checked;
        const incomeCategory = document.getElementById('incomeCategory').value;

        if (!propertyValue || !downPayment || !loanTerm || !interestRate) {
            alert('براہ کرم تمام ضروری فیلڈز پُر کریں / Please fill all required fields');
            return;
        }

        let loanAmount = propertyValue - downPayment;
        
        // Apply MPMG subsidy
        let subsidyAmount = 0;
        if (isMPMG) {
            switch(incomeCategory) {
                case 'Low':
                    interestRate = 5.0; // Subsidized rate for low income
                    subsidyAmount = 1000000; // Rs 10 lakh subsidy
                    break;
                case 'Middle':
                    interestRate = 6.0; // Subsidized rate for middle income
                    subsidyAmount = 500000; // Rs 5 lakh subsidy
                    break;
                case 'Upper':
                    interestRate = 7.0; // Subsidized rate for upper middle
                    subsidyAmount = 300000; // Rs 3 lakh subsidy
                    break;
            }
        }

        // Apply youth scheme discount
        if (isYouth) {
            interestRate -= 1.0; // 1% discount for youth
        }

        const months = loanTerm * 12;
        const monthlyRate = interestRate / 12 / 100;

        // Calculate monthly EMI
        const monthlyEMI = loanAmount * monthlyRate * Math.pow(1 + monthlyRate, months) / 
                          (Math.pow(1 + monthlyRate, months) - 1);

        const totalInterest = (monthlyEMI * months) - loanAmount;
        const ltvRatio = (loanAmount / propertyValue * 100).toFixed(1);

        // Update results
        document.getElementById('monthlyEMI').textContent = 'Rs ' + monthlyEMI.toLocaleString('en-PK', {maximumFractionDigits: 2});
        document.getElementById('totalLoan').textContent = 'Rs ' + loanAmount.toLocaleString('en-PK');
        document.getElementById('totalInterest').textContent = 'Rs ' + totalInterest.toLocaleString('en-PK');
        document.getElementById('ltvRatio').textContent = ltvRatio + '%';

        // DBR Calculation (Pakistani requirement: max 40-50%)
        let dbrRatio = 0;
        if (monthlyIncome > 0) {
            dbrRatio = (monthlyEMI / monthlyIncome * 100);
        }

        const dbrFill = document.getElementById('dbrFill');
        const dbrText = document.getElementById('dbrText');
        
        dbrFill.style.width = Math.min(dbrRatio, 100) + '%';
        
        if (dbrRatio <= 40) {
            dbrFill.style.background = '#28a745';
            dbrText.textContent = `DBR: ${dbrRatio.toFixed(1)}% - اچھا / Good (Below 40%)`;
        } else if (dbrRatio <= 50) {
            dbrFill.style.background = '#ffc107';
            dbrText.textContent = `DBR: ${dbrRatio.toFixed(1)}% - قابل قبول / Acceptable (40-50%)`;
        } else {
            dbrFill.style.background = '#dc3545';
            dbrText.textContent = `DBR: ${dbrRatio.toFixed(1)}% - زیادہ / High (Above 50%)`;
        }

        // MPMG Benefits Display
        if (isMPMG) {
            document.getElementById('interestSubsidy').textContent = `سود کی سبسڈی / Interest Subsidy: Rs ${subsidyAmount.toLocaleString('en-PK')}`;
            document.getElementById('subsidyDuration').textContent = `سبسڈی کی مدت / Subsidy Duration: 10 years`;
            document.getElementById('mpmgBenefits').style.display = 'block';
        } else {
            document.getElementById('mpmgBenefits').style.display = 'none';
        }

        // Bank Offers
        const bank = document.getElementById('bank').value;
        updateBankOffers(bank);

        // Tax Benefits Calculation
        const taxRelief = Math.min(monthlyEMI * 12 * 0.1, 500000); // 10% of annual EMI, max Rs 500,000
        document.getElementById('taxRelief').textContent = 'Rs ' + taxRelief.toLocaleString('en-PK');

        document.getElementById('results').style.display = 'block';
    }

    function updateBankRate() {
        const bank = document.getElementById('bank').value;
        let rate = 12.5;
        let info = 'HBL Home Loan: 12.5% - 14.5%';

        switch(bank) {
            case 'HBL':
                rate = 12.5;
                info = 'HBL Home Loan: 12.5% - 14.5%';
                break;
            case 'UBL':
                rate = 12.8;
                info = 'UBL Home Loan: 12.8% - 14.8%';
                break;
            case 'MCB':
                rate = 12.6;
                info = 'MCB Home Loan: 12.6% - 14.6%';
                break;
            case 'ABL':
                rate = 12.7;
                info = 'ABL Home Loan: 12.7% - 14.7%';
                break;
            case 'NBP':
                rate = 12.4;
                info = 'NBP Home Loan: 12.4% - 14.4%';
                break;
            case 'Bank Alfalah':
                rate = 12.9;
                info = 'Bank Alfalah: 12.9% - 14.9%';
                break;
        }

        document.getElementById('interestRate').value = rate;
        document.getElementById('interestRateInfo').textContent = info;
    }

    function updateBankOffers(bank) {
        const offersList = document.getElementById('bankOffers');
        let offers = '';

        switch(bank) {
            case 'HBL':
                offers = '✅ زیادہ سے زیادہ 85% فنڈنگ | ✅ MPMG منظور شدہ | ✅ آن لائن درخواست';
                break;
            case 'UBL':
                offers = '✅ لچکدار ادائیگی | ✅ ٹاپ اپ لون | ✅ تیز منظوری';
                break;
            case 'MCB':
                offers = '✅ کم پروسیسنگ فیس | ✅ بیمہ سہولت | ✅ آن لائن ٹریکنگ';
                break;
            case 'ABL':
                offers = '✅ مسابقتی شرحیں | ✅ خواتین کے لیے رعایت | ✅ آسان شرائط';
                break;
            case 'NBP':
                offers = '✅ سرکاری اسکیمیں | ✅ طویل مدتی | ✅ کم شرائط';
                break;
            case 'Bank Alfalah':
                offers = '✅ پریمیم سروس | ✅ بینک اوقات کے بعد | ✅ خصوصی پیکجز';
                break;
        }

        offersList.textContent = offers;
    }

    function toggleMPMG() {
        const isMPMG = document.getElementById('mpmgScheme').checked;
        document.getElementById('mpmgSection').style.display = isMPMG ? 'block' : 'none';
        
        if (isMPMG) {
            calculateMPMGSubsidy();
        }
    }

    function toggleNayaPakistan() {
        // Adjustments for Naya Pakistan scheme
        const isNayaPakistan = document.getElementById('nayaPakistan').checked;
        if (isNayaPakistan) {
            document.getElementById('downPayment').value = 
                Math.round(parseFloat(document.getElementById('propertyValue').value) * 0.10); // 10% down payment
            updateDownPaymentPercent();
        }
    }

    function toggleYouthScheme() {
        // Rate adjustment handled in main calculation
    }

    function toggleLowCostHousing() {
        calculateStampDuty();
    }

    function calculateMPMGSubsidy() {
        const incomeCategory = document.getElementById('incomeCategory').value;
        let subsidy = 0;

        switch(incomeCategory) {
            case 'Low':
                subsidy = 1000000;
                break;
            case 'Middle':
                subsidy = 500000;
                break;
            case 'Upper':
                subsidy = 300000;
                break;
        }

        document.getElementById('subsidyAmount').textContent = `سبسڈی / Subsidy: Rs ${subsidy.toLocaleString('en-PK')}`;
    }

    function calculateStampDuty() {
        const propertyValue = parseFloat(document.getElementById('propertyValue').value) || 0;
        const city = document.getElementById('city').value;
        const isLowCost = document.getElementById('lowCostHousing').checked;

        let stampDuty = calculateCityStampDuty(propertyValue, city, isLowCost);

        document.getElementById('stampDutyResult').textContent = 
            'سٹامپ ڈیوٹی / Stamp Duty: Rs ' + stampDuty.toLocaleString('en-PK', {maximumFractionDigits: 0});
    }

    function calculateCityStampDuty(price, city, isLowCost) {
        // Simplified stamp duty calculation for Pakistani cities
        let duty = 0;
        
        // Base stamp duty (2-3% depending on city)
        switch(city) {
            case 'Karachi':
                duty = price * 0.03; // 3% in Karachi
                break;
            case 'Lahore':
                duty = price * 0.025; // 2.5% in Lahore
                break;
            case 'Islamabad':
                duty = price * 0.02; // 2% in Islamabad
                break;
            default:
                duty = price * 0.025; // 2.5% average
        }
        
        // Discount for low cost housing
        if (isLowCost) {
            duty *= 0.5; // 50% discount
        }
        
        return Math.round(duty);
    }

    // Update calculations when inputs change
    document.getElementById('propertyValue').addEventListener('input', updateCalculations);
    document.getElementById('downPayment').addEventListener('input', updateCalculations);
    document.getElementById('city').addEventListener('change', calculateStampDuty);
    document.getElementById('incomeCategory').addEventListener('change', calculateMPMGSubsidy);

    function updateCalculations() {
        const propertyValue = parseFloat(document.getElementById('propertyValue').value) || 0;
        const downPayment = parseFloat(document.getElementById('downPayment').value) || 0;
        
        if (propertyValue > 0) {
            const percent = (downPayment / propertyValue * 100).toFixed(1);
            document.getElementById('downPaymentPercent').textContent = percent + '% down payment';
            
            calculateStampDuty();
        }
    }

    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        updateCalculations();
        updateBankOffers('HBL');
    });
    </script>

    <style>
    .dbr-calculation {
        margin: 20px 0;
        padding: 15px;
        background: #f8f9fa;
        border-radius: 8px;
    }
    .dbr-meter {
        width: 100%;
        height: 20px;
        background: #e9ecef;
        border-radius: 10px;
        margin: 10px 0;
        overflow: hidden;
    }
    .dbr-fill {
        height: 100%;
        border-radius: 10px;
        transition: all 0.3s ease;
    }
    .mpmg-benefits {
        background: #e8f5e8;
        padding: 15px;
        border-radius: 8px;
        margin: 15px 0;
        border-left: 4px solid #28a745;
    }
    .tax-benefits {
        background: #e8f4fd;
        padding: 15px;
        border-radius: 8px;
        margin: 15px 0;
        border-left: 4px solid #17a2b8;
    }
    .bank-offers {
        background: #fff3cd;
        padding: 15px;
        border-radius: 8px;
        margin: 15px 0;
        border-left: 4px solid #ffc107;
    }
    </style>

<?php include '../../footer.php'; ?>