<?php
$country = 'india';
$country_name = 'India';
$currency = '₹';

// India Mortgage calculation
function calculateINMortgage($principal, $interest_rate, $tenure_years, $down_payment = 0) {
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

// India Mortgage data
$mortgage_types = [
    'Home Loan (SBI)' => ['rate' => '8.4% - 9.2%', 'term' => 30],
    'Home Loan (HDFC)' => ['rate' => '8.5% - 9.3%', 'term' => 30],
    'Home Loan (ICICI)' => ['rate' => '8.6% - 9.4%', 'term' => 30],
    'Pradhan Mantri Awas Yojana' => ['rate' => '6.5% - 7.5%', 'term' => 20],
    'Balance Transfer' => ['rate' => '8.0% - 8.8%', 'term' => 30]
];

$cities = [
    'Mumbai' => 'High property prices',
    'Delhi' => 'Capital city - Moderate prices',
    'Bangalore' => 'IT hub - Growing market',
    'Chennai' => 'Affordable housing',
    'Hyderabad' => 'Developing infrastructure',
    'Kolkata' => 'Traditional market',
    'Pune' => 'Educational hub'
];

$government_schemes = [
    'Pradhan Mantri Awas Yojana' => 'Credit Linked Subsidy Scheme',
    'Housing for All' => '2022 Mission target',
    'Affordable Housing' => 'Subsidized rates',
    'Women Ownership' => 'Lower interest rates'
];
?>
<?php include '../../header.php'; ?>

<!-- SEO Elements -->
<link rel="canonical" href="https://90storezon.com/calculators/04-mortgage-calculator/india.php">
<meta name="description" content="Free India home loan calculator with PMAY subsidy, bank rates. Calculate EMI for SBI, HDFC, ICICI home loans in ₹ for Mumbai, Delhi, Bangalore properties.">
<meta name="keywords" content="India home loan calculator, EMI calculator, PMAY subsidy calculator, Indian mortgage calculator, housing loan calculator">

<!-- Structured Data -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "FinancialService",
    "name": "India Home Loan Calculator",
    "description": "Free online home loan EMI calculator for Indian property buyers including PMAY subsidy and bank interest rates",
    "url": "https://90storezon.com/calculators/04-mortgage-calculator/india.php",
    "areaServed": "IN",
    "serviceType": "Home Loan Calculator"
}
</script>

<div class="calculator-container">
        <div class="header">
            <h1 class="title">भारत गृह ऋण कैलकुलेटर</h1>
            <div class="country-badge">
                <img src="https://flagcdn.com/w80/in.png" alt="India Flag - Home Loan Calculator" class="flag">
                <span>India</span>
            </div>
        </div>

        <!-- Internal Links for SEO -->
        <nav class="seo-links">
            <a href="https://90storezon.com/calculators/01-loan-emi-calculator/">Loan Calculator</a> |
            <a href="https://90storezon.com/calculators/01-loan-emi-calculator/pakistan.php">Pakistan Mortgage Calculator</a> |
            <a href="https://90storezon.com/calculators/01-loan-emi-calculator/uae.php">UAE Mortgage Calculator</a> |
            <a href="https://90storezon.com/calculators/01-loan-emi-calculator/usa.php">USA Mortgage Calculator</a>
        </nav>

        <div class="calculator-card">
            <div class="input-group">
                <label for="propertyValue">संपत्ति मूल्य / Property Value (₹)</label>
                <input type="number" id="propertyValue" placeholder="Enter property value" min="500000" step="10000" value="5000000">
            </div>

            <div class="input-group">
                <label for="downPayment">डाउन पेमेंट / Down Payment (₹)</label>
                <input type="number" id="downPayment" placeholder="Enter down payment" min="0" step="10000" value="1000000">
                <div class="limit-info" id="downPaymentPercent">20% down payment</div>
            </div>

            <div class="input-group">
                <label for="city">शहर / City</label>
                <select id="city">
                    <option value="Mumbai">Mumbai</option>
                    <option value="Delhi">Delhi</option>
                    <option value="Bangalore">Bangalore</option>
                    <option value="Chennai">Chennai</option>
                    <option value="Hyderabad">Hyderabad</option>
                    <option value="Kolkata">Kolkata</option>
                    <option value="Pune">Pune</option>
                </select>
            </div>

            <div class="input-group">
                <label for="bank">बैंक चुनें / Select Bank</label>
                <select id="bank" onchange="updateBankRate()">
                    <option value="SBI">State Bank of India (SBI)</option>
                    <option value="HDFC">HDFC Bank</option>
                    <option value="ICICI">ICICI Bank</option>
                    <option value="PNB">Punjab National Bank</option>
                    <option value="Axis">Axis Bank</option>
                    <option value="BOB">Bank of Baroda</option>
                </select>
            </div>

            <div class="input-group">
                <label for="loanTerm">ऋण अवधि / Loan Term</label>
                <select id="loanTerm">
                    <option value="20">20 Years</option>
                    <option value="25">25 Years</option>
                    <option value="30">30 Years</option>
                    <option value="15">15 Years</option>
                </select>
            </div>

            <div class="input-group">
                <label for="interestRate">ब्याज दर / Interest Rate (%)</label>
                <input type="number" id="interestRate" placeholder="Enter interest rate" min="0.1" max="20" step="0.01" value="8.4">
                <div class="rate-info" id="interestRateInfo">SBI Home Loan: 8.4% - 9.2%</div>
            </div>

            <!-- Income Information -->
            <div class="income-section">
                <h3>आय विवरण / Income Details</h3>
                <div class="input-group">
                    <label for="monthlyIncome">मासिक आय / Monthly Income (₹)</label>
                    <input type="number" id="monthlyIncome" placeholder="Enter monthly income" min="0" step="1000" value="75000">
                </div>
            </div>

            <!-- India Specific Options -->
            <div class="additional-options">
                <h3>भारत सरकार की योजनाएं / Government Schemes</h3>
                <label class="checkbox-container">
                    <input type="checkbox" id="pmayScheme" onchange="togglePMAY()">
                    <span class="checkmark"></span>
                    Pradhan Mantri Awas Yojana (PMAY)
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" id="womenApplicant" onchange="toggleWomenApplicant()">
                    <span class="checkmark"></span>
                    Women Applicant (0.25% less)
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" id="salaried" onchange="toggleSalaried()">
                    <span class="checkmark"></span>
                    Salaried Applicant
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" id="affordableHousing" onchange="toggleAffordableHousing()">
                    <span class="checkmark"></span>
                    Affordable Housing Project
                </label>
            </div>

            <!-- PMAY Subsidy Calculator -->
            <div class="pmay-calculator" id="pmaySection" style="display: none;">
                <h4>PMAY Credit Linked Subsidy</h4>
                <div class="input-group">
                    <label for="incomeCategory">आय श्रेणी / Income Category</label>
                    <select id="incomeCategory">
                        <option value="EWS">EWS (₹0-3 Lakh)</option>
                        <option value="LIG">LIG (₹3-6 Lakh)</option>
                        <option value="MIG1">MIG I (₹6-12 Lakh)</option>
                        <option value="MIG2">MIG II (₹12-18 Lakh)</option>
                    </select>
                </div>
                <div class="limit-info" id="subsidyAmount">Subsidy: ₹0</div>
            </div>

            <!-- Stamp Duty & Registration -->
            <div class="stamp-duty-calculator">
                <h3>स्टाम्प ड्यूटी और पंजीकरण / Stamp Duty & Registration</h3>
                <div id="stampDutyResult" class="stamp-duty-result">
                    Stamp Duty: ₹0
                </div>
            </div>

            <button class="calculate-btn" onclick="calculateINMortgage()">EMI की गणना करें / Calculate EMI</button>

            <div id="results" class="results-container" style="display: none;">
                <div class="result-header">
                    <h3>गृह ऋण सारांश / Home Loan Summary</h3>
                </div>
                <div class="result-grid">
                    <div class="result-card">
                        <h4>मासिक किस्त / Monthly EMI</h4>
                        <p id="monthlyEMI" class="result-amount">-</p>
                    </div>
                    <div class="result-card">
                        <h4>कुल ऋण राशि / Total Loan Amount</h4>
                        <p id="totalLoan" class="result-amount">-</p>
                    </div>
                    <div class="result-card">
                        <h4>कुल ब्याज / Total Interest</h4>
                        <p id="totalInterest" class="result-amount">-</p>
                    </div>
                    <div class="result-card">
                        <h4>ऋण-से-मूल्य अनुपात / Loan to Value</h4>
                        <p id="ltvRatio" class="result-amount">-</p>
                    </div>
                </div>
                
                <!-- FOIR Calculation -->
                <div class="foir-calculation">
                    <h4>FOIR (Fixed Obligation to Income Ratio)</h4>
                    <div class="foir-meter">
                        <div class="foir-fill" id="foirFill"></div>
                    </div>
                    <p id="foirText" class="foir-text"></p>
                </div>

                <!-- PMAY Benefits -->
                <div class="pmay-benefits" id="pmayBenefits" style="display: none;">
                    <h4>PMAY Benefits Applied</h4>
                    <div class="benefits-list">
                        <p id="interestSubsidy">Interest Subsidy: ₹0</p>
                        <p id="subsidyTerm">Subsidy Term: 0 years</p>
                        <p>✅ Credit Linked Subsidy Scheme Active</p>
                    </div>
                </div>

                <!-- Bank Specific Offers -->
                <div class="bank-offers">
                    <h4>Bank Specific Offers</h4>
                    <div class="offers-list" id="bankOffers">
                        Checking bank offers...
                    </div>
                </div>

                <!-- Tax Benefits -->
                <div class="tax-benefits">
                    <h4>Tax Benefits Under Section 80C & 24</h4>
                    <div class="tax-breakdown">
                        <p>Principal Repayment (80C): <span id="tax80C">₹1,50,000</span> per year</p>
                        <p>Interest Payment (24): <span id="tax24">₹2,00,000</span> per year</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- SEO Content Section -->
        <section class="seo-content">
            <h2>India Home Loan Calculator - Calculate EMI for Housing Loan</h2>
            <p>Our comprehensive <strong>India home loan calculator</strong> helps property buyers across <strong>Mumbai, Delhi, Bangalore, Chennai, Hyderabad, and all major Indian cities</strong> estimate their monthly EMI. Calculate with <strong>PMAY subsidy, women applicant discounts, and bank-specific rates</strong> for accurate Indian home loan calculations in ₹.</p>
            
            <h3>Popular Home Loan Providers in India</h3>
            <ul>
                <li><strong>State Bank of India (SBI)</strong> - Largest public sector bank</li>
                <li><strong>HDFC Bank</strong> - Leading private sector lender</li>
                <li><strong>ICICI Bank</strong> - Major private bank with competitive rates</li>
                <li><strong>Punjab National Bank (PNB)</strong> - Public sector offers</li>
                <li><strong>Axis Bank</strong> - Private sector home loans</li>
            </ul>

            <h3>Pradhan Mantri Awas Yojana (PMAY)</h3>
            <p>The <strong>PMAY scheme</strong> provides interest subsidy to EWS, LIG, and MIG categories. Benefits include <strong>up to ₹2.67 lakh subsidy, lower interest rates, and longer repayment tenure</strong>. Our calculator automatically applies PMAY benefits for eligible applicants.</p>

            <h3>Indian Home Loan Regulations</h3>
            <p>Indian home loans follow <strong>RBI guidelines</strong> with <strong>FOIR (Fixed Obligation to Income Ratio) limits of 50-60%, LTV ratios up to 90%, and tax benefits under Section 80C and 24</strong>. Stamp duty and registration charges vary by state.</p>

            <h3>Women Applicant Benefits</h3>
            <p>Most Indian banks offer <strong>0.25% lower interest rates for women applicants</strong> and additional benefits under various government schemes to promote women home ownership.</p>
        </section>

        <!-- VIP Backlinks Footer -->
        <footer class="seo-footer">
            <div class="footer-links">
                <h4>Asian Mortgage Calculators</h4>
                <a href="https://90storezon.com/calculators/01-loan-emi-calculator/india.php">India Home Loan Calculator</a> |
                <a href="https://90storezon.com/calculators/01-loan-emi-calculator/pakistan.php">Pakistan Mortgage Calculator</a> |
                <a href="https://90storezon.com/calculators/01-loan-emi-calculator/china.php">China Mortgage Calculator</a> |
                <a href="https://90storezon.com/calculators/01-loan-emi-calculator/singapore.php">Singapore Mortgage Calculator</a>
            </div>
            
            <div class="external-links">
                <h4>Indian Home Loan Resources</h4>
                <a href="https://www.sbi.co.in" rel="nofollow">State Bank of India</a> |
                <a href="https://www.hdfc.com" rel="nofollow">HDFC Home Loans</a> |
                <a href="https://pmaymis.gov.in" rel="nofollow">PMAY Official Portal</a> |
                <a href="https://www.rbi.org.in" rel="nofollow">Reserve Bank of India</a>
            </div>
        </footer>
    </div>

    <script>
    function calculateINMortgage() {
        const propertyValue = parseFloat(document.getElementById('propertyValue').value);
        const downPayment = parseFloat(document.getElementById('downPayment').value);
        const loanTerm = parseInt(document.getElementById('loanTerm').value);
        let interestRate = parseFloat(document.getElementById('interestRate').value);
        const monthlyIncome = parseFloat(document.getElementById('monthlyIncome').value) || 0;
        const isPMAY = document.getElementById('pmayScheme').checked;
        const isWomenApplicant = document.getElementById('womenApplicant').checked;
        const incomeCategory = document.getElementById('incomeCategory').value;

        if (!propertyValue || !downPayment || !loanTerm || !interestRate) {
            alert('कृपया सभी आवश्यक फ़ील्ड भरें / Please fill all required fields');
            return;
        }

        let loanAmount = propertyValue - downPayment;
        
        // Apply women applicant discount
        if (isWomenApplicant) {
            interestRate -= 0.25;
        }

        // Apply PMAY subsidy
        let subsidyAmount = 0;
        let subsidyRate = 0;
        if (isPMAY) {
            switch(incomeCategory) {
                case 'EWS':
                case 'LIG':
                    subsidyRate = 6.5;
                    subsidyAmount = 267000; // Max subsidy for EWS/LIG
                    break;
                case 'MIG1':
                    subsidyRate = 4;
                    subsidyAmount = 235000;
                    break;
                case 'MIG2':
                    subsidyRate = 3;
                    subsidyAmount = 230000;
                    break;
            }
        }

        const months = loanTerm * 12;
        const monthlyRate = interestRate / 12 / 100;

        // Calculate monthly EMI
        const monthlyEMI = loanAmount * monthlyRate * Math.pow(1 + monthlyRate, months) / 
                          (Math.pow(1 + monthlyRate, months) - 1);

        const totalInterest = (monthlyEMI * months) - loanAmount;
        const ltvRatio = (loanAmount / propertyValue * 100).toFixed(1);

        // Update results
        document.getElementById('monthlyEMI').textContent = '₹' + monthlyEMI.toLocaleString('en-IN', {maximumFractionDigits: 2});
        document.getElementById('totalLoan').textContent = '₹' + loanAmount.toLocaleString('en-IN');
        document.getElementById('totalInterest').textContent = '₹' + totalInterest.toLocaleString('en-IN');
        document.getElementById('ltvRatio').textContent = ltvRatio + '%';

        // FOIR Calculation (Indian requirement: max 50-60%)
        let foirRatio = 0;
        if (monthlyIncome > 0) {
            foirRatio = (monthlyEMI / monthlyIncome * 100);
        }

        const foirFill = document.getElementById('foirFill');
        const foirText = document.getElementById('foirText');
        
        foirFill.style.width = Math.min(foirRatio, 100) + '%';
        
        if (foirRatio <= 50) {
            foirFill.style.background = '#28a745';
            foirText.textContent = `FOIR: ${foirRatio.toFixed(1)}% - Good (Below 50%)`;
        } else if (foirRatio <= 60) {
            foirFill.style.background = '#ffc107';
            foirText.textContent = `FOIR: ${foirRatio.toFixed(1)}% - Acceptable (50-60%)`;
        } else {
            foirFill.style.background = '#dc3545';
            foirText.textContent = `FOIR: ${foirRatio.toFixed(1)}% - High (Above 60%)`;
        }

        // PMAY Benefits Display
        if (isPMAY) {
            document.getElementById('interestSubsidy').textContent = `Interest Subsidy: ₹${subsidyAmount.toLocaleString('en-IN')}`;
            document.getElementById('subsidyTerm').textContent = `Subsidy Term: 20 years`;
            document.getElementById('pmayBenefits').style.display = 'block';
        } else {
            document.getElementById('pmayBenefits').style.display = 'none';
        }

        // Bank Offers
        const bank = document.getElementById('bank').value;
        updateBankOffers(bank);

        // Tax Benefits Calculation
        const annualPrincipal = monthlyEMI * 12 * 0.4; // Approx 40% principal
        const annualInterest = monthlyEMI * 12 * 0.6; // Approx 60% interest
        
        document.getElementById('tax80C').textContent = '₹' + Math.min(annualPrincipal, 150000).toLocaleString('en-IN');
        document.getElementById('tax24').textContent = '₹' + Math.min(annualInterest, 200000).toLocaleString('en-IN');

        document.getElementById('results').style.display = 'block';
    }

    function updateBankRate() {
        const bank = document.getElementById('bank').value;
        let rate = 8.4;
        let info = 'SBI Home Loan: 8.4% - 9.2%';

        switch(bank) {
            case 'SBI':
                rate = 8.4;
                info = 'SBI Home Loan: 8.4% - 9.2%';
                break;
            case 'HDFC':
                rate = 8.5;
                info = 'HDFC Home Loan: 8.5% - 9.3%';
                break;
            case 'ICICI':
                rate = 8.6;
                info = 'ICICI Home Loan: 8.6% - 9.4%';
                break;
            case 'PNB':
                rate = 8.3;
                info = 'PNB Home Loan: 8.3% - 9.1%';
                break;
            case 'Axis':
                rate = 8.7;
                info = 'Axis Home Loan: 8.7% - 9.5%';
                break;
            case 'BOB':
                rate = 8.4;
                info = 'Bank of Baroda: 8.4% - 9.2%';
                break;
        }

        document.getElementById('interestRate').value = rate;
        document.getElementById('interestRateInfo').textContent = info;
    }

    function updateBankOffers(bank) {
        const offersList = document.getElementById('bankOffers');
        let offers = '';

        switch(bank) {
            case 'SBI':
                offers = '✅ Max 90% LTV | ✅ PMAY Approved | ✅ Balance Transfer';
                break;
            case 'HDFC':
                offers = '✅ Flexi Loan Facility | ✅ Top-up Loan | ✅ Online Processing';
                break;
            case 'ICICI':
                offers = '✅ Instant Approval | ✅ Home Saver Product | ✅ Part Payment';
                break;
            case 'PNB':
                offers = '✅ Subsidized Rates | ✅ Long Tenure | ✅ Government Scheme';
                break;
            case 'Axis':
                offers = '✅ Quick Disbursal | ✅ Customized Solutions | ✅ Online Tracking';
                break;
            case 'BOB':
                offers = '✅ Affordable Rates | ✅ Women Benefits | ✅ Easy Documentation';
                break;
        }

        offersList.textContent = offers;
    }

    function togglePMAY() {
        const isPMAY = document.getElementById('pmayScheme').checked;
        document.getElementById('pmaySection').style.display = isPMAY ? 'block' : 'none';
        
        if (isPMAY) {
            calculatePMAYSubsidy();
        }
    }

    function toggleWomenApplicant() {
        // Rate adjustment handled in main calculation
    }

    function toggleSalaried() {
        // No additional calculations needed
    }

    function toggleAffordableHousing() {
        calculateStampDuty();
    }

    function calculatePMAYSubsidy() {
        const incomeCategory = document.getElementById('incomeCategory').value;
        let subsidy = 0;

        switch(incomeCategory) {
            case 'EWS':
            case 'LIG':
                subsidy = 267000;
                break;
            case 'MIG1':
                subsidy = 235000;
                break;
            case 'MIG2':
                subsidy = 230000;
                break;
        }

        document.getElementById('subsidyAmount').textContent = `Subsidy: ₹${subsidy.toLocaleString('en-IN')}`;
    }

    function calculateStampDuty() {
        const propertyValue = parseFloat(document.getElementById('propertyValue').value) || 0;
        const city = document.getElementById('city').value;
        const isAffordable = document.getElementById('affordableHousing').checked;

        let stampDuty = calculateCityStampDuty(propertyValue, city, isAffordable);

        document.getElementById('stampDutyResult').textContent = 
            'Stamp Duty: ₹' + stampDuty.toLocaleString('en-IN', {maximumFractionDigits: 0});
    }

    function calculateCityStampDuty(price, city, isAffordable) {
        // Simplified stamp duty calculation for Indian cities
        let duty = 0;
        
        // Base stamp duty (5-7% depending on city)
        switch(city) {
            case 'Mumbai':
                duty = price * 0.06; // 6% in Mumbai
                break;
            case 'Delhi':
                duty = price * 0.06; // 6% in Delhi
                break;
            case 'Bangalore':
                duty = price * 0.05; // 5% in Bangalore
                break;
            default:
                duty = price * 0.06; // 6% average
        }
        
        // Discount for affordable housing
        if (isAffordable) {
            duty *= 0.5; // 50% discount
        }
        
        return Math.round(duty);
    }

    // Update calculations when inputs change
    document.getElementById('propertyValue').addEventListener('input', updateCalculations);
    document.getElementById('downPayment').addEventListener('input', updateCalculations);
    document.getElementById('city').addEventListener('change', calculateStampDuty);
    document.getElementById('incomeCategory').addEventListener('change', calculatePMAYSubsidy);

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
        updateBankOffers('SBI');
    });
    </script>

    <style>
    .foir-calculation {
        margin: 20px 0;
        padding: 15px;
        background: #f8f9fa;
        border-radius: 8px;
    }
    .foir-meter {
        width: 100%;
        height: 20px;
        background: #e9ecef;
        border-radius: 10px;
        margin: 10px 0;
        overflow: hidden;
    }
    .foir-fill {
        height: 100%;
        border-radius: 10px;
        transition: all 0.3s ease;
    }
    .pmay-benefits {
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