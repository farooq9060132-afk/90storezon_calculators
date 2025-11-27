<?php
$country = 'singapore';
$country_name = 'Singapore';
$currency = 'S$';

// Singapore Mortgage calculation
function calculateSGMortgage($principal, $interest_rate, $tenure_years, $down_payment = 0) {
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

// Singapore Mortgage data
$mortgage_types = [
    'HDB Loan' => ['rate' => '2.6%', 'term' => 25],
    'Bank Loan (Fixed)' => ['rate' => '3.2% - 4.2%', 'term' => 25],
    'Bank Loan (Floating)' => ['rate' => '2.8% - 3.8%', 'term' => 25],
    'BUC Loan' => ['rate' => '3.5% - 4.5%', 'term' => 25],
    'Refinancing' => ['rate' => '2.9% - 3.9%', 'term' => 25]
];

$property_types = [
    'HDB Flat' => 'Public housing - HDB loan eligible',
    'Executive Condominium' => 'Public-private hybrid',
    'Private Condominium' => 'Private development',
    'Landed Property' => 'Houses, bungalows',
    'Commercial' => 'Shop houses, offices'
];

$government_grants = [
    'Enhanced CPF Housing Grant' => 'Up to S$80,000 for first-timers',
    'Family Grant' => 'Up to S$50,000 for families',
    'Proximity Housing Grant' => 'Up to S$30,000 for living near parents',
    'Step-Up CPF Housing Grant' => 'Up to S$15,000 for second-timers'
];
?>
<?php include '../../header.php'; ?>

<!-- SEO Elements -->
<link rel="canonical" href="https://90storezon.com/calculators/04-mortgage-calculator/singapore.php">
<meta name="description" content="Free Singapore mortgage calculator with HDB loans, CPF grants. Calculate mortgage payments for HDB flats, condominiums, landed properties in S$.">
<meta name="keywords" content="Singapore mortgage calculator, HDB loan calculator, CPF housing grant calculator, home loan calculator, Singapore property calculator">

<!-- Structured Data -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "FinancialService",
    "name": "Singapore Mortgage Calculator",
    "description": "Free online mortgage calculator for Singapore property buyers including HDB loans and CPF housing grants",
    "url": "https://90storezon.com/calculators/04-mortgage-calculator/singapore.php",
    "areaServed": "SG",
    "serviceType": "Mortgage Calculator"
}
</script>

<div class="calculator-container">
        <div class="header">
            <h1 class="title">Singapore Mortgage Calculator</h1>
            <div class="country-badge">
                <img src="https://flagcdn.com/w80/sg.png" alt="Singapore Flag - Mortgage Calculator" class="flag">
                <span>Singapore</span>
            </div>
        </div>

        <!-- Internal Links for SEO -->
        <nav class="seo-links">
            <a href="https://90storezon.com/calculators/01-loan-emi-calculator/">Loan Calculator</a> |
            <a href="https://90storezon.com/calculators/01-loan-emi-calculator/malaysia.php">Malaysia Mortgage Calculator</a> |
            <a href="https://90storezon.com/calculators/01-loan-emi-calculator/india.php">India Mortgage Calculator</a> |
            <a href="https://90storezon.com/calculators/01-loan-emi-calculator/australia.php">Australia Mortgage Calculator</a>
        </nav>

        <div class="calculator-card">
            <div class="input-group">
                <label for="propertyValue">Property Value (S$)</label>
                <input type="number" id="propertyValue" placeholder="Enter property value" min="200000" step="10000" value="500000">
            </div>

            <div class="input-group">
                <label for="downPayment">Down Payment (S$)</label>
                <input type="number" id="downPayment" placeholder="Enter down payment" min="0" step="10000" value="50000">
                <div class="limit-info" id="downPaymentPercent">10% down payment</div>
            </div>

            <div class="input-group">
                <label for="propertyType">Property Type</label>
                <select id="propertyType" onchange="updatePropertyType()">
                    <option value="HDB Flat">HDB Flat</option>
                    <option value="Executive Condominium">Executive Condominium</option>
                    <option value="Private Condominium">Private Condominium</option>
                    <option value="Landed Property">Landed Property</option>
                    <option value="Commercial">Commercial Property</option>
                </select>
            </div>

            <div class="input-group">
                <label for="loanType">Loan Type</label>
                <select id="loanType" onchange="updateLoanType()">
                    <option value="HDB Loan">HDB Loan</option>
                    <option value="Bank Loan (Fixed)">Bank Loan (Fixed)</option>
                    <option value="Bank Loan (Floating)">Bank Loan (Floating)</option>
                    <option value="BUC Loan">BUC Loan</option>
                </select>
            </div>

            <div class="input-group">
                <label for="loanTerm">Loan Term</label>
                <select id="loanTerm">
                    <option value="25">25 Years</option>
                    <option value="20">20 Years</option>
                    <option value="15">15 Years</option>
                    <option value="30">30 Years</option>
                </select>
            </div>

            <div class="input-group">
                <label for="interestRate">Interest Rate (%)</label>
                <input type="number" id="interestRate" placeholder="Enter interest rate" min="0.1" max="10" step="0.01" value="2.6">
                <div class="rate-info" id="interestRateInfo">HDB Loan rate: 2.6%</div>
            </div>

            <!-- CPF Information -->
            <div class="cpf-section">
                <h3>CPF Details</h3>
                <div class="input-group">
                    <label for="cpfOa">CPF Ordinary Account (S$)</label>
                    <input type="number" id="cpfOa" placeholder="CPF OA balance" min="0" step="1000" value="50000">
                </div>
                <div class="input-group">
                    <label for="monthlyIncome">Monthly Income (S$)</label>
                    <input type="number" id="monthlyIncome" placeholder="Monthly income" min="0" step="100" value="6000">
                </div>
            </div>

            <!-- Singapore Specific Options -->
            <div class="additional-options">
                <h3>Singapore Housing Grants</h3>
                <label class="checkbox-container">
                    <input type="checkbox" id="firstTimer" onchange="toggleFirstTimer()">
                    <span class="checkmark"></span>
                    First-Time Applicant
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" id="familyGrant" onchange="toggleFamilyGrant()">
                    <span class="checkmark"></span>
                    Family Grant Eligible
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" id="proximityGrant" onchange="toggleProximityGrant()">
                    <span class="checkmark"></span>
                    Proximity Housing Grant
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" id="cpfUsage" onchange="toggleCPFUsage()">
                    <span class="checkmark"></span>
                    Use CPF for Payment
                </label>
            </div>

            <!-- Additional Buyer's Stamp Duty -->
            <div class="absd-calculator">
                <h3>Additional Buyer's Stamp Duty (ABSD)</h3>
                <div id="absdResult" class="absd-result">
                    ABSD: S$0
                </div>
            </div>

            <!-- CPF Usage Calculator -->
            <div class="cpf-usage" id="cpfUsageSection" style="display: none;">
                <h4>CPF Usage for Mortgage</h4>
                <div class="input-group">
                    <label for="cpfMonthly">Monthly CPF Contribution (S$)</label>
                    <input type="number" id="cpfMonthly" placeholder="Monthly CPF" min="0" step="100" value="1200">
                </div>
            </div>

            <button class="calculate-btn" onclick="calculateSGMortgage()">Calculate Mortgage Payment</button>

            <div id="results" class="results-container" style="display: none;">
                <div class="result-header">
                    <h3>Singapore Mortgage Summary</h3>
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
                
                <!-- TDSR Calculation -->
                <div class="tdsr-calculation">
                    <h4>Total Debt Servicing Ratio (TDSR)</h4>
                    <div class="tdsr-meter">
                        <div class="tdsr-fill" id="tdsrFill"></div>
                    </div>
                    <p id="tdsrText" class="tdsr-text"></p>
                </div>

                <!-- CPF Usage Summary -->
                <div class="cpf-summary" id="cpfSummary" style="display: none;">
                    <h4>CPF Usage Summary</h4>
                    <div class="cpf-breakdown">
                        <p>CPF Ordinary Account Balance: <span id="cpfBalance">S$0</span></p>
                        <p>Monthly CPF Contribution: <span id="cpfMonthlyDisplay">S$0</span></p>
                        <p>Cash Top-up Required: <span id="cashTopup">S$0</span></p>
                    </div>
                </div>

                <!-- Housing Grants Summary -->
                <div class="grants-summary" id="grantsSummary" style="display: none;">
                    <h4>Housing Grants Applied</h4>
                    <div class="grants-list">
                        <p id="enhancedGrant">Enhanced CPF Housing Grant: S$0</p>
                        <p id="familyGrantAmount">Family Grant: S$0</p>
                        <p id="proximityGrantAmount">Proximity Housing Grant: S$0</p>
                    </div>
                </div>

                <!-- MSR Calculation (for HDB) -->
                <div class="msr-calculation" id="msrSection" style="display: none;">
                    <h4>Mortgage Servicing Ratio (MSR)</h4>
                    <div class="msr-meter">
                        <div class="msr-fill" id="msrFill"></div>
                    </div>
                    <p id="msrText" class="msr-text"></p>
                </div>
            </div>
        </div>

        <!-- SEO Content Section -->
        <section class="seo-content">
            <h2>Singapore Mortgage Calculator - Calculate HDB & Bank Loan Payments</h2>
            <p>Our comprehensive <strong>Singapore mortgage calculator</strong> helps property buyers estimate monthly payments for <strong>HDB flats, executive condominiums, private condos, and landed properties</strong>. Calculate with <strong>CPF housing grants, ABSD rates, and TDSR requirements</strong> for accurate Singapore-specific calculations in S$.</p>
            
            <h3>Popular Mortgage Types in Singapore</h3>
            <ul>
                <li><strong>HDB Loans</strong> - 2.6% fixed rate from HDB</li>
                <li><strong>Bank Loans (Fixed)</strong> - 2-5 year fixed rates</li>
                <li><strong>Bank Loans (Floating)</strong> - SORA-pegged rates</li>
                <li><strong>BUC Loans</strong> - Building under construction</li>
                <li><strong>Refinancing</strong> - Better rates for existing loans</li>
            </ul>

            <h3>Singapore Mortgage Regulations</h3>
            <p>Singapore mortgages follow <strong>MAS (Monetary Authority of Singapore) regulations</strong> including <strong>TDSR (Total Debt Servicing Ratio) limit of 55%, MSR (Mortgage Servicing Ratio) of 30% for HDB, and ABSD (Additional Buyer's Stamp Duty)</strong> for additional properties.</p>

            <h3>CPF Housing Grants & Schemes</h3>
            <p>Singapore offers various <strong>CPF housing grants</strong> including the <strong>Enhanced CPF Housing Grant (up to S$80,000), Family Grant, Proximity Housing Grant, and Step-Up CPF Housing Grant</strong>. Our calculator helps you maximize these benefits.</p>

            <h3>HDB vs Bank Loans</h3>
            <p><strong>HDB loans</strong> offer stability with fixed 2.6% rates and more flexible eligibility, while <strong>bank loans</strong> may offer lower initial rates but are subject to market fluctuations and stricter TDSR requirements.</p>
        </section>

        <!-- VIP Backlinks Footer -->
        <footer class="seo-footer">
            <div class="footer-links">
                <h4>Asia Mortgage Calculators</h4>
                <a href="https://90storezon.com/calculators/01-loan-emi-calculator/singapore.php">Singapore Mortgage Calculator</a> |
                <a href="https://90storezon.com/calculators/01-loan-emi-calculator/malaysia.php">Malaysia Mortgage Calculator</a> |
                <a href="https://90storezon.com/calculators/01-loan-emi-calculator/india.php">India Mortgage Calculator</a> |
                <a href="https://90storezon.com/calculators/01-loan-emi-calculator/hongkong.php">Hong Kong Mortgage Calculator</a>
            </div>
            
            <div class="external-links">
                <h4>Singapore Mortgage Resources</h4>
                <a href="https://www.hdb.gov.sg" rel="nofollow">HDB Official Website</a> |
                <a href="https://www.mas.gov.sg" rel="nofollow">Monetary Authority of Singapore</a> |
                <a href="https://www.cpf.gov.sg" rel="nofollow">CPF Board</a> |
                <a href="https://www.iras.gov.sg" rel="nofollow">IRAS (Stamp Duty)</a>
            </div>
        </footer>
    </div>

    <script>
    function calculateSGMortgage() {
        const propertyValue = parseFloat(document.getElementById('propertyValue').value);
        const downPayment = parseFloat(document.getElementById('downPayment').value);
        const loanType = document.getElementById('loanType').value;
        const loanTerm = parseInt(document.getElementById('loanTerm').value);
        const interestRate = parseFloat(document.getElementById('interestRate').value);
        const monthlyIncome = parseFloat(document.getElementById('monthlyIncome').value) || 0;
        const cpfOa = parseFloat(document.getElementById('cpfOa').value) || 0;
        const useCPF = document.getElementById('cpfUsage').checked;
        const cpfMonthly = parseFloat(document.getElementById('cpfMonthly').value) || 0;

        if (!propertyValue || !downPayment || !loanTerm || !interestRate) {
            alert('Please fill in all required fields');
            return;
        }

        let loanAmount = propertyValue - downPayment;
        const months = loanTerm * 12;

        // Calculate monthly payment
        const monthlyRate = interestRate / 12 / 100;
        const monthlyPayment = loanAmount * monthlyRate * Math.pow(1 + monthlyRate, months) / 
                              (Math.pow(1 + monthlyRate, months) - 1);

        const totalInterest = (monthlyPayment * months) - loanAmount;
        const ltvRatio = (loanAmount / propertyValue * 100).toFixed(1);

        // Update results
        document.getElementById('monthlyPayment').textContent = 'S$' + monthlyPayment.toFixed(2);
        document.getElementById('totalLoan').textContent = 'S$' + loanAmount.toLocaleString();
        document.getElementById('totalInterest').textContent = 'S$' + totalInterest.toLocaleString();
        document.getElementById('ltvRatio').textContent = ltvRatio + '%';

        // TDSR Calculation (Singapore requirement: max 55%)
        let tdsrRatio = 0;
        if (monthlyIncome > 0) {
            tdsrRatio = (monthlyPayment / monthlyIncome * 100);
        }

        const tdsrFill = document.getElementById('tdsrFill');
        const tdsrText = document.getElementById('tdsrText');
        
        tdsrFill.style.width = Math.min(tdsrRatio, 100) + '%';
        
        if (tdsrRatio <= 45) {
            tdsrFill.style.background = '#28a745';
            tdsrText.textContent = `TDSR: ${tdsrRatio.toFixed(1)}% - Good (Below 45%)`;
        } else if (tdsrRatio <= 55) {
            tdsrFill.style.background = '#ffc107';
            tdsrText.textContent = `TDSR: ${tdsrRatio.toFixed(1)}% - Acceptable (45-55%)`;
        } else {
            tdsrFill.style.background = '#dc3545';
            tdsrText.textContent = `TDSR: ${tdsrRatio.toFixed(1)}% - High (Above 55%)`;
        }

        // MSR Calculation for HDB (max 30%)
        const propertyType = document.getElementById('propertyType').value;
        if (propertyType === 'HDB Flat' || propertyType === 'Executive Condominium') {
            const msrRatio = (monthlyPayment / monthlyIncome * 100);
            const msrFill = document.getElementById('msrFill');
            const msrText = document.getElementById('msrText');
            
            msrFill.style.width = Math.min(msrRatio, 100) + '%';
            
            if (msrRatio <= 25) {
                msrFill.style.background = '#28a745';
                msrText.textContent = `MSR: ${msrRatio.toFixed(1)}% - Good (Below 25%)`;
            } else if (msrRatio <= 30) {
                msrFill.style.background = '#ffc107';
                msrText.textContent = `MSR: ${msrRatio.toFixed(1)}% - Acceptable (25-30%)`;
            } else {
                msrFill.style.background = '#dc3545';
                msrText.textContent = `MSR: ${msrRatio.toFixed(1)}% - High (Above 30%)`;
            }
            document.getElementById('msrSection').style.display = 'block';
        } else {
            document.getElementById('msrSection').style.display = 'none';
        }

        // CPF Usage Summary
        if (useCPF) {
            const cashTopup = Math.max(0, monthlyPayment - cpfMonthly);
            document.getElementById('cpfBalance').textContent = 'S$' + cpfOa.toLocaleString();
            document.getElementById('cpfMonthlyDisplay').textContent = 'S$' + cpfMonthly.toFixed(2);
            document.getElementById('cashTopup').textContent = 'S$' + cashTopup.toFixed(2);
            document.getElementById('cpfSummary').style.display = 'block';
        } else {
            document.getElementById('cpfSummary').style.display = 'none';
        }

        // Housing Grants Summary
        updateGrantsSummary();

        document.getElementById('results').style.display = 'block';
    }

    function updatePropertyType() {
        const propertyType = document.getElementById('propertyType').value;
        updateLoanType();
        calculateABSD();
        
        // Adjust down payment based on property type
        const propertyValue = parseFloat(document.getElementById('propertyValue').value) || 0;
        let downPaymentPercent = 0.10; // Default 10%
        
        if (propertyType === 'HDB Flat') {
            downPaymentPercent = 0.10; // HDB: 10%
        } else if (propertyType === 'Landed Property' || propertyType === 'Commercial') {
            downPaymentPercent = 0.25; // Higher for landed/commercial
        }
        
        document.getElementById('downPayment').value = Math.round(propertyValue * downPaymentPercent);
        updateDownPaymentPercent();
    }

    function updateLoanType() {
        const loanType = document.getElementById('loanType').value;
        const propertyType = document.getElementById('propertyType').value;
        
        let rate = 2.6; // Default HDB rate
        
        if (loanType === 'HDB Loan') {
            rate = 2.6;
            document.getElementById('interestRateInfo').textContent = 'HDB Loan rate: 2.6%';
        } else if (loanType === 'Bank Loan (Fixed)') {
            rate = 3.2;
            document.getElementById('interestRateInfo').textContent = 'Fixed rate: 3.2% - 4.2%';
        } else if (loanType === 'Bank Loan (Floating)') {
            rate = 2.8;
            document.getElementById('interestRateInfo').textContent = 'Floating rate: 2.8% - 3.8%';
        } else if (loanType === 'BUC Loan') {
            rate = 3.5;
            document.getElementById('interestRateInfo').textContent = 'BUC rate: 3.5% - 4.5%';
        }
        
        document.getElementById('interestRate').value = rate;
        
        // HDB loans only for HDB properties
        if (propertyType !== 'HDB Flat' && propertyType !== 'Executive Condominium') {
            document.getElementById('loanType').value = 'Bank Loan (Fixed)';
            updateLoanType(); // Recursive call to update rates
        }
    }

    function toggleFirstTimer() {
        calculateABSD();
        updateGrantsSummary();
    }

    function toggleFamilyGrant() {
        updateGrantsSummary();
    }

    function toggleProximityGrant() {
        updateGrantsSummary();
    }

    function toggleCPFUsage() {
        const useCPF = document.getElementById('cpfUsage').checked;
        document.getElementById('cpfUsageSection').style.display = useCPF ? 'block' : 'none';
    }

    function calculateABSD() {
        const propertyValue = parseFloat(document.getElementById('propertyValue').value) || 0;
        const propertyType = document.getElementById('propertyType').value;
        const isFirstTimer = document.getElementById('firstTimer').checked;
        const isSingaporean = true; // Assuming Singaporean for calculation

        let absdRate = 0;
        
        if (isFirstTimer && isSingaporean) {
            absdRate = 0; // No ABSD for first-time Singaporean buyers
        } else if (propertyType === 'HDB Flat') {
            absdRate = 0; // No ABSD for HDB (subject to conditions)
        } else {
            // ABSD rates for additional properties
            absdRate = 0.17; // 17% for second property
        }

        const absdAmount = propertyValue * absdRate;
        document.getElementById('absdResult').textContent = 
            'ABSD: S$' + absdAmount.toLocaleString('en-SG', {maximumFractionDigits: 0});
    }

    function updateGrantsSummary() {
        const isFirstTimer = document.getElementById('firstTimer').checked;
        const hasFamilyGrant = document.getElementById('familyGrant').checked;
        const hasProximityGrant = document.getElementById('proximityGrant').checked;
        const propertyType = document.getElementById('propertyType').value;

        let enhancedGrant = 0;
        let familyGrant = 0;
        let proximityGrant = 0;

        if (isFirstTimer && (propertyType === 'HDB Flat' || propertyType === 'Executive Condominium')) {
            enhancedGrant = 50000; // S$50,000 enhanced grant
        }

        if (hasFamilyGrant) {
            familyGrant = 50000; // S$50,000 family grant
        }

        if (hasProximityGrant) {
            proximityGrant = 20000; // S$20,000 proximity grant
        }

        document.getElementById('enhancedGrant').textContent = `Enhanced CPF Housing Grant: S$${enhancedGrant.toLocaleString()}`;
        document.getElementById('familyGrantAmount').textContent = `Family Grant: S$${familyGrant.toLocaleString()}`;
        document.getElementById('proximityGrantAmount').textContent = `Proximity Housing Grant: S$${proximityGrant.toLocaleString()}`;

        const totalGrants = enhancedGrant + familyGrant + proximityGrant;
        if (totalGrants > 0) {
            document.getElementById('grantsSummary').style.display = 'block';
        } else {
            document.getElementById('grantsSummary').style.display = 'none';
        }
    }

    // Update down payment percentage and calculations
    document.getElementById('propertyValue').addEventListener('input', updateCalculations);
    document.getElementById('downPayment').addEventListener('input', updateCalculations);

    function updateCalculations() {
        const propertyValue = parseFloat(document.getElementById('propertyValue').value) || 0;
        const downPayment = parseFloat(document.getElementById('downPayment').value) || 0;
        
        if (propertyValue > 0) {
            const percent = (downPayment / propertyValue * 100).toFixed(1);
            document.getElementById('downPaymentPercent').textContent = percent + '% down payment';
            
            calculateABSD();
        }
    }

    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        updateCalculations();
        updateGrantsSummary();
    });
    </script>

    <style>
    .tdsr-calculation, .msr-calculation {
        margin: 20px 0;
        padding: 15px;
        background: #f8f9fa;
        border-radius: 8px;
    }
    .tdsr-meter, .msr-meter {
        width: 100%;
        height: 20px;
        background: #e9ecef;
        border-radius: 10px;
        margin: 10px 0;
        overflow: hidden;
    }
    .tdsr-fill, .msr-fill {
        height: 100%;
        border-radius: 10px;
        transition: all 0.3s ease;
    }
    .cpf-summary, .grants-summary {
        background: #e8f4fd;
        padding: 15px;
        border-radius: 8px;
        margin: 15px 0;
        border-left: 4px solid #17a2b8;
    }
    .absd-calculator {
        background: #fff3cd;
        padding: 15px;
        border-radius: 8px;
        margin: 15px 0;
        border-left: 4px solid #ffc107;
    }
    </style>

<?php include '../../footer.php'; ?>