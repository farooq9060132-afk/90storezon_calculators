<?php
$country = 'saudi_arabia';
$country_name = 'Saudi Arabia';
$currency = 'SAR';

// Saudi Arabia Mortgage calculation
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

// Saudi Arabia Mortgage data
$mortgage_types = [
    'Fixed Rate (5 years)' => ['rate' => '3.5% - 4.5%', 'term' => 5],
    'Variable Rate' => ['rate' => '4.0% - 5.0%', 'term' => 25],
    'Islamic Mortgage' => ['rate' => '3.8% - 4.8%', 'term' => 25],
    'Sakani Program' => ['rate' => '2.5% - 3.5%', 'term' => 25],
    'Real Estate Loan' => ['rate' => '4.2% - 5.2%', 'term' => 25]
];

$cities = [
    'Riyadh' => 'Capital city - High demand',
    'Jeddah' => 'Commercial hub - Moderate prices',
    'Dammam' => 'Eastern Province - Affordable',
    'Mecca' => 'Holy city - Special regulations',
    'Medina' => 'Holy city - Special regulations'
];

$government_programs = [
    'Sakani Program' => 'Support for Saudi families',
    'Wafi Program' => 'Real estate development',
    'Muri Program' => 'Rental housing support',
    'Real Estate Refinance' => 'Saudi Real Estate Refinance Company'
];
?>
<?php include '../../header.php'; ?>

<!-- SEO Elements -->
<link rel="canonical" href="https://90storezon.com/calculators/04-mortgage-calculator/saudi_arabia.php">
<meta name="description" content="Free Saudi Arabia mortgage calculator with Sakani program, Islamic financing. Calculate mortgage payments for Riyadh, Jeddah, Dammam properties in SAR.">
<meta name="keywords" content="Saudi Arabia mortgage calculator, Sakani program calculator, Islamic financing calculator, home loan calculator, Saudi property calculator">

<!-- Structured Data -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "FinancialService",
    "name": "Saudi Arabia Mortgage Calculator",
    "description": "Free online mortgage calculator for Saudi Arabia property buyers including Sakani program and Islamic financing options",
    "url": "https://90storezon.com/calculators/04-mortgage-calculator/saudi_arabia.php",
    "areaServed": "SA",
    "serviceType": "Mortgage Calculator"
}
</script>

<div class="calculator-container">
        <div class="header">
            <h1 class="title">Saudi Arabia Mortgage Calculator</h1>
            <div class="country-badge">
                <img src="https://flagcdn.com/w80/sa.png" alt="Saudi Arabia Flag - Mortgage Calculator" class="flag">
                <span>Saudi Arabia</span>
            </div>
        </div>

        <!-- Internal Links for SEO -->
        <nav class="seo-links">
            <a href="https://90storezon.com/calculators/01-loan-emi-calculator/">Loan Calculator</a> |
            <a href="https://90storezon.com/calculators/01-loan-emi-calculator/uae.php">UAE Mortgage Calculator</a> |
            <a href="https://90storezon.com/calculators/01-loan-emi-calculator/qatar.php">Qatar Mortgage Calculator</a> |
            <a href="https://90storezon.com/calculators/01-loan-emi-calculator/kuwait.php">Kuwait Mortgage Calculator</a>
        </nav>

        <div class="calculator-card">
            <div class="input-group">
                <label for="propertyValue">Property Value (SAR)</label>
                <input type="number" id="propertyValue" placeholder="Enter property value" min="300000" step="10000" value="800000">
            </div>

            <div class="input-group">
                <label for="downPayment">Down Payment (SAR)</label>
                <input type="number" id="downPayment" placeholder="Enter down payment" min="0" step="10000" value="160000">
                <div class="limit-info" id="downPaymentPercent">20% down payment</div>
            </div>

            <div class="input-group">
                <label for="city">City</label>
                <select id="city">
                    <option value="Riyadh">Riyadh</option>
                    <option value="Jeddah">Jeddah</option>
                    <option value="Dammam">Dammam</option>
                    <option value="Mecca">Mecca</option>
                    <option value="Medina">Medina</option>
                    <option value="Khobar">Al Khobar</option>
                    <option value="Tabuk">Tabuk</option>
                    <option value="Abha">Abha</option>
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
                <input type="number" id="interestRate" placeholder="Enter interest rate" min="0.1" max="15" step="0.01" value="4.0">
                <div class="rate-info">Current rates: 3.5% - 4.5%</div>
            </div>

            <!-- Salary Information -->
            <div class="salary-section">
                <h3>Income Details</h3>
                <div class="input-group">
                    <label for="monthlySalary">Monthly Salary (SAR)</label>
                    <input type="number" id="monthlySalary" placeholder="Enter monthly salary" min="3000" step="1000" value="15000">
                </div>
            </div>

            <!-- Saudi Arabia Specific Options -->
            <div class="additional-options">
                <h3>Saudi Mortgage Programs</h3>
                <label class="checkbox-container">
                    <input type="checkbox" id="sakaniProgram" onchange="toggleSakaniProgram()">
                    <span class="checkmark"></span>
                    Sakani Program
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" id="islamicFinancing" onchange="toggleIslamicFinancing()">
                    <span class="checkmark"></span>
                    Islamic Financing
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" id="saudiNational" onchange="toggleSaudiNational()">
                    <span class="checkmark"></span>
                    Saudi National
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" id="firstTimeBuyer" onchange="toggleFirstTimeBuyer()">
                    <span class="checkmark"></span>
                    First-Time Home Buyer
                </label>
            </div>

            <!-- Sakani Program Details -->
            <div class="sakani-program" id="sakaniSection" style="display: none;">
                <h4>Sakani Program Benefits</h4>
                <div class="program-benefits">
                    <p>✅ Subsidized interest rates</p>
                    <p>✅ Lower down payment requirements</p>
                    <p>✅ Government support for Saudi families</p>
                </div>
            </div>

            <!-- Islamic Financing Details -->
            <div class="islamic-financing" id="islamicSection" style="display: none;">
                <h4>Islamic Financing Type</h4>
                <select id="islamicType">
                    <option value="Murabaha">Murabaha (Cost-Plus)</option>
                    <option value="Ijara">Ijara (Lease-to-Own)</option>
                    <option value="Musharaka">Musharaka (Partnership)</option>
                    <option value="Tawarruq">Tawarruq (Commodity Murabaha)</option>
                </select>
            </div>

            <!-- Registration Fees Calculator -->
            <div class="fees-calculator">
                <h3>Registration & Transfer Fees</h3>
                <div id="registrationFees" class="fees-result">
                    Registration Fees: SAR 0
                </div>
            </div>

            <button class="calculate-btn" onclick="calculateSAMortgage()">Calculate Mortgage Payment</button>

            <div id="results" class="results-container" style="display: none;">
                <div class="result-header">
                    <h3>Saudi Arabia Mortgage Summary</h3>
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
                
                <!-- Debt to Income Ratio -->
                <div class="debt-ratio">
                    <h4>Debt to Income Ratio</h4>
                    <div class="debt-ratio-meter">
                        <div class="debt-ratio-fill" id="debtRatioFill"></div>
                    </div>
                    <p id="debtRatioText" class="debt-ratio-text"></p>
                </div>

                <!-- Sakani Program Benefits -->
                <div class="sakani-benefits" id="sakaniBenefits" style="display: none;">
                    <h4>Sakani Program Benefits Applied</h4>
                    <div class="benefits-list">
                        <p>✅ Reduced interest rate applied</p>
                        <p>✅ Lower down payment accepted</p>
                        <p>✅ Government subsidy included</p>
                    </div>
                </div>

                <!-- Islamic Financing Info -->
                <div class="islamic-info" id="islamicInfo" style="display: none;">
                    <h4>Islamic Financing Details</h4>
                    <p id="islamicDescription">Sharia-compliant financing with no interest charges.</p>
                </div>

                <!-- Saudi Bank Eligibility -->
                <div class="eligibility-check">
                    <h4>Saudi Bank Eligibility</h4>
                    <div class="eligibility-result" id="eligibilityResult">
                        Checking eligibility...
                    </div>
                </div>
            </div>
        </div>

        <!-- SEO Content Section -->
        <section class="seo-content">
            <h2>Saudi Arabia Mortgage Calculator - Calculate Home Loan Payments in Riyadh & Jeddah</h2>
            <p>Our comprehensive <strong>Saudi Arabia mortgage calculator</strong> helps property buyers in <strong>Riyadh, Jeddah, Dammam, and all Saudi cities</strong> estimate their monthly payments. Calculate <strong>Sakani program benefits, Islamic financing, and government subsidies</strong> with accurate Saudi-specific calculations in SAR.</p>
            
            <h3>Popular Mortgage Types in Saudi Arabia</h3>
            <ul>
                <li><strong>Fixed Rate Mortgages</strong> - 5-year fixed terms most common</li>
                <li><strong>Variable Rate Mortgages</strong> - SIBOR linked rates</li>
                <li><strong>Islamic Financing</strong> - Sharia-compliant options</li>
                <li><strong>Sakani Program</strong> - Government support for citizens</li>
                <li><strong>Real Estate Loans</strong> - Traditional mortgage products</li>
            </ul>

            <h3>Saudi Mortgage Regulations</h3>
            <p>Saudi Arabia mortgages follow <strong>SAMA (Saudi Arabian Monetary Authority) regulations</strong> with <strong>maximum LTV of 90% for Saudis, debt-to-income ratio below 33%, and age limits up to 70 years</strong>. Our calculator includes <strong>registration fees, transfer costs, and bank eligibility criteria</strong> for all major Saudi banks.</p>

            <h3>Sakani Program - Vision 2030</h3>
            <p>The <strong>Sakani program</strong> is part of Saudi Arabia's Vision 2030 to increase home ownership among citizens. It offers <strong>subsidized interest rates, lower down payments, and various financing solutions</strong> through the Real Estate Development Fund.</p>

            <h3>Islamic Financing in Saudi Arabia</h3>
            <p>Saudi Arabia offers comprehensive <strong>Sharia-compliant financing options</strong> including <strong>Murabaha, Ijara, Musharaka, and Tawarruq</strong>. All major Saudi banks provide Islamic banking services alongside conventional options.</p>
        </section>

        <!-- VIP Backlinks Footer -->
        <footer class="seo-footer">
            <div class="footer-links">
                <h4>GCC Mortgage Calculators</h4>
                <a href="https://90storezon.com/calculators/01-loan-emi-calculator/saudi_arabia.php">Saudi Arabia Mortgage Calculator</a> |
                <a href="https://90storezon.com/calculators/01-loan-emi-calculator/uae.php">UAE Mortgage Calculator</a> |
                <a href="https://90storezon.com/calculators/01-loan-emi-calculator/qatar.php">Qatar Mortgage Calculator</a> |
                <a href="https://90storezon.com/calculators/01-loan-emi-calculator/kuwait.php">Kuwait Mortgage Calculator</a>
            </div>
            
            <div class="external-links">
                <h4>Saudi Mortgage Resources</h4>
                <a href="https://sakani.housing.sa" rel="nofollow">Sakani Program Official</a> |
                <a href="https://www.sama.gov.sa" rel="nofollow">Saudi Arabian Monetary Authority</a> |
                <a href="https://www.redf.gov.sa" rel="nofollow">Real Estate Development Fund</a> |
                <a href="https://www.alahli.com" rel="nofollow">National Commercial Bank</a>
            </div>
        </footer>
    </div>

    <script>
    function calculateSAMortgage() {
        const propertyValue = parseFloat(document.getElementById('propertyValue').value);
        const downPayment = parseFloat(document.getElementById('downPayment').value);
        const loanTerm = parseInt(document.getElementById('loanTerm').value);
        const interestRate = parseFloat(document.getElementById('interestRate').value);
        const monthlySalary = parseFloat(document.getElementById('monthlySalary').value) || 0;
        const isSakani = document.getElementById('sakaniProgram').checked;
        const isIslamic = document.getElementById('islamicFinancing').checked;
        const isSaudiNational = document.getElementById('saudiNational').checked;
        const isFirstTimeBuyer = document.getElementById('firstTimeBuyer').checked;

        if (!propertyValue || !downPayment || !loanTerm || !interestRate) {
            alert('Please fill in all required fields');
            return;
        }

        let loanAmount = propertyValue - downPayment;
        let effectiveRate = interestRate;
        const months = loanTerm * 12;

        // Apply Sakani program benefits
        if (isSakani && isSaudiNational) {
            effectiveRate -= 1.0; // 1% reduction for Sakani program
            document.getElementById('sakaniBenefits').style.display = 'block';
        } else {
            document.getElementById('sakaniBenefits').style.display = 'none';
        }

        // Adjust rate for Islamic financing
        if (isIslamic) {
            effectiveRate += 0.2; // Islamic financing typically 0.2-0.3% higher
        }

        // Calculate monthly payment
        const monthlyRate = effectiveRate / 12 / 100;
        const monthlyPayment = loanAmount * monthlyRate * Math.pow(1 + monthlyRate, months) / 
                              (Math.pow(1 + monthlyRate, months) - 1);

        const totalInterest = (monthlyPayment * months) - loanAmount;
        const ltvRatio = (loanAmount / propertyValue * 100).toFixed(1);

        // Update results
        document.getElementById('monthlyPayment').textContent = 'SAR ' + monthlyPayment.toFixed(2);
        document.getElementById('totalLoan').textContent = 'SAR ' + loanAmount.toLocaleString();
        document.getElementById('totalInterest').textContent = 'SAR ' + totalInterest.toLocaleString();
        document.getElementById('ltvRatio').textContent = ltvRatio + '%';

        // Debt to Income Ratio (Saudi requirement: max 33%)
        let debtRatio = 0;
        if (monthlySalary > 0) {
            debtRatio = (monthlyPayment / monthlySalary * 100);
        }

        const debtRatioFill = document.getElementById('debtRatioFill');
        const debtRatioText = document.getElementById('debtRatioText');
        
        debtRatioFill.style.width = Math.min(debtRatio, 100) + '%';
        
        if (debtRatio <= 25) {
            debtRatioFill.style.background = '#28a745';
            debtRatioText.textContent = `Debt Ratio: ${debtRatio.toFixed(1)}% - Excellent (Below 25%)`;
        } else if (debtRatio <= 33) {
            debtRatioFill.style.background = '#ffc107';
            debtRatioText.textContent = `Debt Ratio: ${debtRatio.toFixed(1)}% - Acceptable (25-33%)`;
        } else {
            debtRatioFill.style.background = '#dc3545';
            debtRatioText.textContent = `Debt Ratio: ${debtRatio.toFixed(1)}% - High (Above 33%)`;
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
                case 'Tawarruq':
                    description = 'Commodity Murabaha - trade-based financing';
                    break;
            }
            document.getElementById('islamicDescription').textContent = description;
            document.getElementById('islamicInfo').style.display = 'block';
        } else {
            document.getElementById('islamicInfo').style.display = 'none';
        }

        // Saudi Bank Eligibility Check
        const eligibilityResult = document.getElementById('eligibilityResult');
        let eligibilityMessage = '';
        let eligibilityClass = '';
        
        if (debtRatio > 33) {
            eligibilityMessage = '❌ May not meet bank eligibility (Debt ratio > 33%)';
            eligibilityClass = 'eligibility-fail';
        } else if (!isSaudiNational && ltvRatio > 70) {
            eligibilityMessage = '⚠️ Lower LTV required for non-Saudis';
            eligibilityClass = 'eligibility-warning';
        } else if (isSakani && isSaudiNational && isFirstTimeBuyer) {
            eligibilityMessage = '✅ Excellent eligibility with Sakani benefits';
            eligibilityClass = 'eligibility-pass';
        } else {
            eligibilityMessage = '✅ Likely meets bank eligibility criteria';
            eligibilityClass = 'eligibility-pass';
        }
        
        eligibilityResult.textContent = eligibilityMessage;
        eligibilityResult.className = 'eligibility-result ' + eligibilityClass;

        document.getElementById('results').style.display = 'block';
    }

    function toggleSakaniProgram() {
        const isSakani = document.getElementById('sakaniProgram').checked;
        const isSaudiNational = document.getElementById('saudiNational').checked;
        
        document.getElementById('sakaniSection').style.display = (isSakani && isSaudiNational) ? 'block' : 'none';
        
        if (isSakani && isSaudiNational) {
            // Adjust down payment for Sakani program
            const propertyValue = parseFloat(document.getElementById('propertyValue').value) || 0;
            document.getElementById('downPayment').value = Math.round(propertyValue * 0.10); // 10% for Sakani
            updateDownPaymentPercent();
        }
    }

    function toggleIslamicFinancing() {
        const isIslamic = document.getElementById('islamicFinancing').checked;
        document.getElementById('islamicSection').style.display = isIslamic ? 'block' : 'none';
    }

    function toggleSaudiNational() {
        calculateRegistrationFees();
        toggleSakaniProgram();
        
        const isSaudiNational = document.getElementById('saudiNational').checked;
        if (!isSaudiNational) {
            // Adjust down payment for non-Saudis (higher requirement)
            const propertyValue = parseFloat(document.getElementById('propertyValue').value) || 0;
            document.getElementById('downPayment').value = Math.round(propertyValue * 0.30); // 30% for non-Saudis
            updateDownPaymentPercent();
        }
    }

    function toggleFirstTimeBuyer() {
        // No additional calculations needed
    }

    function calculateRegistrationFees() {
        const propertyValue = parseFloat(document.getElementById('propertyValue').value) || 0;
        const city = document.getElementById('city').value;
        const isSaudiNational = document.getElementById('saudiNational').checked;

        let fees = calculateCityFees(propertyValue, city, isSaudiNational);

        document.getElementById('registrationFees').textContent = 
            'Registration Fees: SAR ' + fees.toLocaleString('en-SA', {maximumFractionDigits: 0});
    }

    function calculateCityFees(price, city, isSaudiNational) {
        // Simplified registration fees calculation for Saudi cities
        let fees = 0;
        
        // Base registration fee (5% of property value)
        fees = price * 0.05;
        
        // Discount for Saudi nationals
        if (isSaudiNational) {
            fees *= 0.5; // 50% discount for Saudis
        }
        
        // Additional fees for holy cities
        if (city === 'Mecca' || city === 'Medina') {
            fees += price * 0.01; // Additional 1% for holy cities
        }
        
        return Math.round(fees);
    }

    // Update down payment percentage and fees
    document.getElementById('propertyValue').addEventListener('input', updateCalculations);
    document.getElementById('downPayment').addEventListener('input', updateCalculations);
    document.getElementById('city').addEventListener('change', calculateRegistrationFees);

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
    .sakani-benefits {
        background: #e8f5e8;
        padding: 15px;
        border-radius: 8px;
        border-left: 4px solid #28a745;
        margin: 15px 0;
    }
    .program-benefits {
        background: #f8f9fa;
        padding: 10px;
        border-radius: 5px;
        margin: 10px 0;
    }
    </style>

<?php include '../../footer.php'; ?>