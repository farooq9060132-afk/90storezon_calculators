<?php
$country = 'south_africa';
$country_name = 'South Africa';
$currency = 'R';

// South Africa Mortgage calculation
function calculateSAMortgage($principal, $interest_rate, $tenure_years, $down_payment = 0) {
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

// South Africa Mortgage data
$mortgage_types = [
    'Home Loan (Standard)' => ['rate' => '7.5% - 9.5%', 'term' => 20],
    'Fixed Rate (2 years)' => ['rate' => '8.0% - 10.0%', 'term' => 2],
    'Fixed Rate (5 years)' => ['rate' => '8.5% - 10.5%', 'term' => 5],
    'Access Bond' => ['rate' => '7.8% - 9.8%', 'term' => 20],
    '100% Bond' => ['rate' => '9.0% - 11.0%', 'term' => 20]
];

$cities = [
    'Johannesburg' => 'Economic hub - High property demand',
    'Cape Town' => 'Coastal city - Premium properties',
    'Durban' => 'Port city - Moderate prices',
    'Pretoria' => 'Administrative capital - Affordable',
    'Port Elizabeth' => 'Coastal city - Growing market',
    'Bloemfontein' => 'Judicial capital - Low cost'
];

$banks = [
    'Standard Bank' => 'Largest bank in Africa',
    'First National Bank (FNB)' => 'Innovative banking solutions',
    'Nedbank' => 'Green banking focus',
    'Absa Bank' => 'Barclays Africa group',
    'Capitec Bank' => 'Fastest growing bank'
];
?>
<?php include '../../header.php'; ?>

<!-- SEO Elements -->
<link rel="canonical" href="https://90storezon.com/calculators/04-mortgage-calculator/south_africa.php">
<meta name="description" content="Free South Africa home loan calculator with bond registration, transfer costs. Calculate bond repayments for Standard Bank, FNB, Nedbank in R for Johannesburg, Cape Town properties.">
<meta name="keywords" content="South Africa home loan calculator, bond repayment calculator, property bond calculator, South African mortgage calculator, home loan calculator">

<!-- Structured Data -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "FinancialService",
    "name": "South Africa Home Loan Calculator",
    "description": "Free online home loan calculator for South African property buyers including bond registration costs and bank interest rates",
    "url": "https://90storezon.com/calculators/04-mortgage-calculator/south_africa.php",
    "areaServed": "ZA",
    "serviceType": "Home Loan Calculator"
}
</script>

<div class="calculator-container">
        <div class="header">
            <h1 class="title">South Africa Home Loan Calculator</h1>
            <div class="country-badge">
                <img src="https://flagcdn.com/w80/za.png" alt="South Africa Flag - Home Loan Calculator" class="flag">
                <span>South Africa</span>
            </div>
        </div>

        <!-- Internal Links for SEO -->
        <nav class="seo-links">
            <a href="https://90storezon.com/calculators/01-loan-emi-calculator/">Loan Calculator</a> |
            <a href="https://90storezon.com/calculators/01-loan-emi-calculator/malaysia.php">Malaysia Mortgage Calculator</a> |
            <a href="https://90storezon.com/calculators/01-loan-emi-calculator/australia.php">Australia Mortgage Calculator</a> |
            <a href="https://90storezon.com/calculators/01-loan-emi-calculator/uk.php">UK Mortgage Calculator</a>
        </nav>

        <div class="calculator-card">
            <div class="input-group">
                <label for="propertyValue">Property Purchase Price (R)</label>
                <input type="number" id="propertyValue" placeholder="Enter property price" min="500000" step="10000" value="2500000">
            </div>

            <div class="input-group">
                <label for="deposit">Deposit Amount (R)</label>
                <input type="number" id="deposit" placeholder="Enter deposit amount" min="0" step="10000" value="250000">
                <div class="limit-info" id="depositPercent">10% deposit</div>
            </div>

            <div class="input-group">
                <label for="city">City/Province</label>
                <select id="city">
                    <option value="Johannesburg">Johannesburg (Gauteng)</option>
                    <option value="Cape Town">Cape Town (Western Cape)</option>
                    <option value="Durban">Durban (KwaZulu-Natal)</option>
                    <option value="Pretoria">Pretoria (Gauteng)</option>
                    <option value="Port Elizabeth">Port Elizabeth (Eastern Cape)</option>
                    <option value="Bloemfontein">Bloemfontein (Free State)</option>
                </select>
            </div>

            <div class="input-group">
                <label for="bank">Select Bank</label>
                <select id="bank" onchange="updateBankRate()">
                    <option value="Standard Bank">Standard Bank</option>
                    <option value="FNB">First National Bank (FNB)</option>
                    <option value="Nedbank">Nedbank</option>
                    <option value="Absa">Absa Bank</option>
                    <option value="Capitec">Capitec Bank</option>
                </select>
            </div>

            <div class="input-group">
                <label for="loanTerm">Loan Term (Years)</label>
                <select id="loanTerm">
                    <option value="20">20 Years</option>
                    <option value="25">25 Years</option>
                    <option value="15">15 Years</option>
                    <option value="30">30 Years</option>
                </select>
            </div>

            <div class="input-group">
                <label for="interestRate">Interest Rate (Prime +)</label>
                <input type="number" id="interestRate" placeholder="Enter interest rate" min="0.1" max="20" step="0.01" value="8.5">
                <div class="rate-info" id="interestRateInfo">Current Prime Rate: 7.75% | Your rate: Prime + 0.75%</div>
            </div>

            <!-- Income Information -->
            <div class="income-section">
                <h3>Income & Employment Details</h3>
                <div class="input-group">
                    <label for="grossIncome">Gross Monthly Income (R)</label>
                    <input type="number" id="grossIncome" placeholder="Gross monthly income" min="0" step="1000" value="45000">
                </div>
                <div class="input-group">
                    <label for="employmentType">Employment Type</label>
                    <select id="employmentType">
                        <option value="Permanent">Permanent Employment</option>
                        <option value="Contract">Contract Employment</option>
                        <option value="Self-Employed">Self-Employed</option>
                        <option value="Commission">Commission Based</option>
                    </select>
                </div>
            </div>

            <!-- South Africa Specific Options -->
            <div class="additional-options">
                <h3>South African Bond Options</h3>
                <label class="checkbox-container">
                    <input type="checkbox" id="accessBond" onchange="toggleAccessBond()">
                    <span class="checkmark"></span>
                    Access Bond Facility
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" id="fixedRate" onchange="toggleFixedRate()">
                    <span class="checkmark"></span>
                    Fixed Interest Rate Period
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" id="firstHome" onchange="toggleFirstHome()">
                    <span class="checkmark"></span>
                    First-Time Home Buyer
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" id="transferCosts" onchange="toggleTransferCosts()">
                    <span class="checkmark"></span>
                    Include Transfer & Bond Costs in Loan
                </label>
            </div>

            <!-- Fixed Rate Period -->
            <div class="fixed-rate-period" id="fixedRateSection" style="display: none;">
                <h4>Fixed Rate Period</h4>
                <div class="input-group">
                    <label for="fixedTerm">Fixed Rate Term</label>
                    <select id="fixedTerm">
                        <option value="1">1 Year Fixed</option>
                        <option value="2">2 Years Fixed</option>
                        <option value="3">3 Years Fixed</option>
                        <option value="5">5 Years Fixed</option>
                    </select>
                </div>
            </div>

            <!-- Bond & Transfer Costs Calculator -->
            <div class="costs-calculator">
                <h3>Bond Registration & Transfer Costs</h3>
                <div class="costs-breakdown">
                    <p>Transfer Duty: <span id="transferDuty">R 0</span></p>
                    <p>Bond Registration: <span id="bondRegistration">R 0</span></p>
                    <p>Attorney Fees: <span id="attorneyFees">R 0</span></p>
                    <p><strong>Total Costs: <span id="totalCosts">R 0</span></strong></p>
                </div>
            </div>

            <button class="calculate-btn" onclick="calculateSAMortgage()">Calculate Bond Repayment</button>

            <div id="results" class="results-container" style="display: none;">
                <div class="result-header">
                    <h3>South African Bond Summary</h3>
                </div>
                <div class="result-grid">
                    <div class="result-card">
                        <h4>Monthly Bond Repayment</h4>
                        <p id="monthlyRepayment" class="result-amount">-</p>
                    </div>
                    <div class="result-card">
                        <h4>Total Bond Amount</h4>
                        <p id="totalBond" class="result-amount">-</p>
                    </div>
                    <div class="result-card">
                        <h4>Total Interest Payable</h4>
                        <p id="totalInterest" class="result-amount">-</p>
                    </div>
                    <div class="result-card">
                        <h4>Loan-to-Value Ratio</h4>
                        <p id="ltvRatio" class="result-amount">-</p>
                    </div>
                </div>
                
                <!-- Debt Service Ratio -->
                <div class="dsr-calculation">
                    <h4>Debt Service Ratio (DSR)</h4>
                    <div class="dsr-meter">
                        <div class="dsr-fill" id="dsrFill"></div>
                    </div>
                    <p id="dsrText" class="dsr-text"></p>
                </div>

                <!-- Access Bond Features -->
                <div class="access-bond-features" id="accessBondFeatures" style="display: none;">
                    <h4>Access Bond Benefits</h4>
                    <div class="bond-benefits">
                        <p>✅ Access to extra payments as credit</p>
                        <p>✅ No notice period for withdrawals</p>
                        <p>✅ Save on interest by reducing balance</p>
                        <p>✅ Flexible payment options available</p>
                    </div>
                </div>

                <!-- Affordability Assessment -->
                <div class="affordability-assessment">
                    <h4>Bank Affordability Assessment</h4>
                    <div class="assessment-result" id="assessmentResult">
                        Assessing affordability...
                    </div>
                </div>

                <!-- Transfer Cost Breakdown -->
                <div class="transfer-costs-breakdown">
                    <h4>Upfront Costs Breakdown</h4>
                    <div class="costs-details">
                        <p>Property Purchase Price: <span id="breakdownPrice">R 0</span></p>
                        <p>Deposit Paid: <span id="breakdownDeposit">R 0</span></p>
                        <p>Bond Registration Costs: <span id="breakdownBondCosts">R 0</span></p>
                        <p>Transfer Duty & Fees: <span id="breakdownTransferCosts">R 0</span></p>
                        <p><strong>Total Cash Required: <span id="totalCashRequired">R 0</span></strong></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- SEO Content Section -->
        <section class="seo-content">
            <h2>South Africa Home Loan Calculator - Calculate Bond Repayments</h2>
            <p>Our comprehensive <strong>South Africa home loan calculator</strong> helps property buyers across <strong>Johannesburg, Cape Town, Durban, Pretoria, and all major South African cities</strong> estimate their monthly bond repayments. Calculate with <strong>bond registration costs, transfer duty, and bank-specific prime rates</strong> for accurate South African home loan calculations in R.</p>
            
            <h3>Popular Home Loan Types in South Africa</h3>
            <ul>
                <li><strong>Standard Home Loans</strong> - Variable rate linked to prime</li>
                <li><strong>Fixed Rate Bonds</strong> - 1-5 year fixed interest periods</li>
                <li><strong>Access Bonds</strong> - Flexible access to extra payments</li>
                <li><strong>100% Bonds</strong> - No deposit required (higher rates)</li>
                <li><strong>Linked Bonds</strong> - Linked to savings or investment accounts</li>
            </ul>

            <h3>South African Bond Regulations</h3>
            <p>South African home loans follow <strong>NCA (National Credit Act) regulations</strong> with <strong>DSR (Debt Service Ratio) limits typically below 30%, maximum bond terms of 20-30 years, and strict affordability assessments</strong>. Transfer duty and bond registration costs are significant upfront expenses.</p>

            <h3>Prime Rate & Interest Calculations</h3>
            <p>South African home loans are typically priced as <strong>Prime Rate plus a margin</strong>. The current prime rate is set by the South African Reserve Bank and affects all variable rate bonds. Fixed rate bonds offer payment certainty but usually at higher rates.</p>

            <h3>First-Time Home Buyer Benefits</h3>
            <p>First-time home buyers in South Africa enjoy <strong>transfer duty exemptions on properties below R1 million, easier qualification criteria, and special first-home buyer products</strong> from major banks.</p>
        </section>

        <!-- VIP Backlinks Footer -->
        <footer class="seo-footer">
            <div class="footer-links">
                <h4>African Mortgage Calculators</h4>
                <a href="https://90storezon.com/calculators/01-loan-emi-calculator/south_africa.php">South Africa Home Loan Calculator</a> |
                <a href="https://90storezon.com/calculators/01-loan-emi-calculator/egypt.php">Egypt Mortgage Calculator</a> |
                <a href="https://90storezon.com/calculators/01-loan-emi-calculator/nigeria.php">Nigeria Mortgage Calculator</a> |
                <a href="https://90storezon.com/calculators/01-loan-emi-calculator/kenya.php">Kenya Mortgage Calculator</a>
            </div>
            
            <div class="external-links">
                <h4>South African Home Loan Resources</h4>
                <a href="https://www.resbank.co.za" rel="nofollow">South African Reserve Bank</a> |
                <a href="https://www.standardbank.co.za" rel="nofollow">Standard Bank Home Loans</a> |
                <a href="https://www.fnb.co.za" rel="nofollow">First National Bank</a> |
                <a href="https://www.nedbank.co.za" rel="nofollow">Nedbank Home Loans</a>
            </div>
        </footer>
    </div>

    <script>
    // Current South African Prime Rate (update as needed)
    const PRIME_RATE = 7.75;

    function calculateSAMortgage() {
        const propertyValue = parseFloat(document.getElementById('propertyValue').value);
        const deposit = parseFloat(document.getElementById('deposit').value);
        const loanTerm = parseInt(document.getElementById('loanTerm').value);
        const interestRate = parseFloat(document.getElementById('interestRate').value);
        const grossIncome = parseFloat(document.getElementById('grossIncome').value) || 0;
        const includeCosts = document.getElementById('transferCosts').checked;
        const isAccessBond = document.getElementById('accessBond').checked;

        if (!propertyValue || !deposit || !loanTerm || !interestRate) {
            alert('Please fill in all required fields');
            return;
        }

        // Calculate bond and transfer costs
        const costs = calculateBondCosts(propertyValue);
        let bondAmount = propertyValue - deposit;
        
        // Include costs in bond if selected
        if (includeCosts) {
            bondAmount += costs.total;
        }

        const months = loanTerm * 12;
        const monthlyRate = interestRate / 12 / 100;

        // Calculate monthly repayment
        const monthlyRepayment = bondAmount * monthlyRate * Math.pow(1 + monthlyRate, months) / 
                                (Math.pow(1 + monthlyRate, months) - 1);

        const totalInterest = (monthlyRepayment * months) - bondAmount;
        const ltvRatio = (bondAmount / propertyValue * 100).toFixed(1);

        // Update results
        document.getElementById('monthlyRepayment').textContent = 'R ' + monthlyRepayment.toFixed(2);
        document.getElementById('totalBond').textContent = 'R ' + bondAmount.toLocaleString('en-ZA');
        document.getElementById('totalInterest').textContent = 'R ' + totalInterest.toLocaleString('en-ZA');
        document.getElementById('ltvRatio').textContent = ltvRatio + '%';

        // DSR Calculation (South African requirement: typically below 30%)
        let dsrRatio = 0;
        if (grossIncome > 0) {
            dsrRatio = (monthlyRepayment / grossIncome * 100);
        }

        const dsrFill = document.getElementById('dsrFill');
        const dsrText = document.getElementById('dsrText');
        
        dsrFill.style.width = Math.min(dsrRatio, 100) + '%';
        
        if (dsrRatio <= 25) {
            dsrFill.style.background = '#28a745';
            dsrText.textContent = `DSR: ${dsrRatio.toFixed(1)}% - Excellent (Below 25%)`;
        } else if (dsrRatio <= 30) {
            dsrFill.style.background = '#ffc107';
            dsrText.textContent = `DSR: ${dsrRatio.toFixed(1)}% - Acceptable (25-30%)`;
        } else {
            dsrFill.style.background = '#dc3545';
            dsrText.textContent = `DSR: ${dsrRatio.toFixed(1)}% - High (Above 30%)`;
        }

        // Access Bond Features
        if (isAccessBond) {
            document.getElementById('accessBondFeatures').style.display = 'block';
        } else {
            document.getElementById('accessBondFeatures').style.display = 'none';
        }

        // Affordability Assessment
        updateAffordabilityAssessment(dsrRatio, ltvRatio, grossIncome);

        // Transfer Costs Breakdown
        updateCostsBreakdown(propertyValue, deposit, costs);

        document.getElementById('results').style.display = 'block';
    }

    function calculateBondCosts(propertyValue) {
        // Calculate transfer duty (progressive rates in South Africa)
        let transferDuty = 0;
        if (propertyValue <= 1000000) {
            transferDuty = 0; // No transfer duty for properties under R1 million for first-time buyers
        } else if (propertyValue <= 1375000) {
            transferDuty = (propertyValue - 1000000) * 0.03;
        } else if (propertyValue <= 1925000) {
            transferDuty = 11250 + (propertyValue - 1375000) * 0.06;
        } else if (propertyValue <= 2475000) {
            transferDuty = 44250 + (propertyValue - 1925000) * 0.08;
        } else {
            transferDuty = 88250 + (propertyValue - 2475000) * 0.11;
        }

        // Bond registration costs (simplified calculation)
        const bondRegistration = Math.max(1000, propertyValue * 0.01); // Minimum R1000 or 1%
        const attorneyFees = Math.max(5000, propertyValue * 0.015); // Minimum R5000 or 1.5%

        const totalCosts = transferDuty + bondRegistration + attorneyFees;

        // Update costs display
        document.getElementById('transferDuty').textContent = 'R ' + Math.round(transferDuty).toLocaleString('en-ZA');
        document.getElementById('bondRegistration').textContent = 'R ' + Math.round(bondRegistration).toLocaleString('en-ZA');
        document.getElementById('attorneyFees').textContent = 'R ' + Math.round(attorneyFees).toLocaleString('en-ZA');
        document.getElementById('totalCosts').textContent = 'R ' + Math.round(totalCosts).toLocaleString('en-ZA');

        return {
            transferDuty: transferDuty,
            bondRegistration: bondRegistration,
            attorneyFees: attorneyFees,
            total: totalCosts
        };
    }

    function updateBankRate() {
        const bank = document.getElementById('bank').value;
        let margin = 0.75; // Default margin above prime
        let info = `Current Prime Rate: ${PRIME_RATE}% | Your rate: Prime + 0.75%`;

        switch(bank) {
            case 'Standard Bank':
                margin = 0.70;
                break;
            case 'FNB':
                margin = 0.75;
                break;
            case 'Nedbank':
                margin = 0.80;
                break;
            case 'Absa':
                margin = 0.78;
                break;
            case 'Capitec':
                margin = 0.65;
                break;
        }

        const totalRate = PRIME_RATE + margin;
        document.getElementById('interestRate').value = totalRate.toFixed(2);
        document.getElementById('interestRateInfo').textContent = `Current Prime Rate: ${PRIME_RATE}% | Your rate: Prime + ${margin}%`;
    }

    function updateAffordabilityAssessment(dsrRatio, ltvRatio, grossIncome) {
        const assessmentResult = document.getElementById('assessmentResult');
        let assessment = '';
        let assessmentClass = '';

        if (dsrRatio > 30) {
            assessment = '❌ May not meet bank affordability criteria (DSR > 30%)';
            assessmentClass = 'assessment-fail';
        } else if (ltvRatio > 90) {
            assessment = '⚠️ Higher deposit recommended (LTV > 90%)';
            assessmentClass = 'assessment-warning';
        } else if (grossIncome < 15000) {
            assessment = '⚠️ Income may be below bank minimum requirements';
            assessmentClass = 'assessment-warning';
        } else {
            assessment = '✅ Likely meets bank affordability criteria';
            assessmentClass = 'assessment-pass';
        }

        assessmentResult.textContent = assessment;
        assessmentResult.className = 'assessment-result ' + assessmentClass;
    }

    function updateCostsBreakdown(propertyValue, deposit, costs) {
        document.getElementById('breakdownPrice').textContent = 'R ' + propertyValue.toLocaleString('en-ZA');
        document.getElementById('breakdownDeposit').textContent = 'R ' + deposit.toLocaleString('en-ZA');
        document.getElementById('breakdownBondCosts').textContent = 'R ' + Math.round(costs.bondRegistration + costs.attorneyFees).toLocaleString('en-ZA');
        document.getElementById('breakdownTransferCosts').textContent = 'R ' + Math.round(costs.transferDuty).toLocaleString('en-ZA');
        
        const totalCash = deposit + costs.total;
        document.getElementById('totalCashRequired').textContent = 'R ' + Math.round(totalCash).toLocaleString('en-ZA');
    }

    function toggleAccessBond() {
        // Features displayed in results section
    }

    function toggleFixedRate() {
        const isFixed = document.getElementById('fixedRate').checked;
        document.getElementById('fixedRateSection').style.display = isFixed ? 'block' : 'none';
    }

    function toggleFirstHome() {
        // Recalculate transfer duty (exemptions for first-time buyers)
        calculateBondCosts(parseFloat(document.getElementById('propertyValue').value) || 0);
    }

    function toggleTransferCosts() {
        // Handled in main calculation
    }

    // Update calculations when inputs change
    document.getElementById('propertyValue').addEventListener('input', updateCalculations);
    document.getElementById('deposit').addEventListener('input', updateCalculations);
    document.getElementById('city').addEventListener('change', updateCalculations);

    function updateCalculations() {
        const propertyValue = parseFloat(document.getElementById('propertyValue').value) || 0;
        const deposit = parseFloat(document.getElementById('deposit').value) || 0;
        
        if (propertyValue > 0) {
            const percent = (deposit / propertyValue * 100).toFixed(1);
            document.getElementById('depositPercent').textContent = percent + '% deposit';
            
            calculateBondCosts(propertyValue);
        }
    }

    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        updateCalculations();
        updateBankRate();
    });
    </script>

    <style>
    .dsr-calculation {
        margin: 20px 0;
        padding: 15px;
        background: #f8f9fa;
        border-radius: 8px;
    }
    .dsr-meter {
        width: 100%;
        height: 20px;
        background: #e9ecef;
        border-radius: 10px;
        margin: 10px 0;
        overflow: hidden;
    }
    .dsr-fill {
        height: 100%;
        border-radius: 10px;
        transition: all 0.3s ease;
    }
    .access-bond-features {
        background: #e8f5e8;
        padding: 15px;
        border-radius: 8px;
        margin: 15px 0;
        border-left: 4px solid #28a745;
    }
    .costs-calculator {
        background: #fff3cd;
        padding: 15px;
        border-radius: 8px;
        margin: 15px 0;
        border-left: 4px solid #ffc107;
    }
    .transfer-costs-breakdown {
        background: #e8f4fd;
        padding: 15px;
        border-radius: 8px;
        margin: 15px 0;
        border-left: 4px solid #17a2b8;
    }
    .assessment-result {
        padding: 10px;
        border-radius: 5px;
        text-align: center;
        font-weight: bold;
    }
    .assessment-pass {
        background: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }
    .assessment-warning {
        background: #fff3cd;
        color: #856404;
        border: 1px solid #ffeaa7;
    }
    .assessment-fail {
        background: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }
    </style>

<?php include '../../footer.php'; ?>