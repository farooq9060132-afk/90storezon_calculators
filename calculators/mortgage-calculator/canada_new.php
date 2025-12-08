<?php include '../../header.php'; ?>

<!-- SEO Elements -->
<link rel="canonical" href="https://90storezon.com/calculators/04-mortgage-calculator/canada.php">
<meta name="description" content="Free Canadian mortgage calculator with CMHC insurance, property taxes. Calculate fixed, variable, HELOC loans for all provinces.">
<meta name="keywords" content="Canadian mortgage calculator, Canada mortgage calculator, CMHC calculator, fixed rate mortgage, variable rate mortgage">

<!-- Structured Data -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "FinancialService",
    "name": "Canada Mortgage Calculator",
    "description": "Free online mortgage calculator for Canadian home buyers in all provinces",
    "url": "https://90storezon.com/calculators/04-mortgage-calculator/canada.php",
    "areaServed": "CA",
    "serviceType": "Mortgage Calculator"
}
</script>

<div class="vip-container">
    <header class="vip-header">
        <h1><i class="fas fa-home"></i> Canada Mortgage Calculator</h1>
        <p>Calculate your mortgage payments with CMHC insurance & property taxes</p>
    </header>

    <!-- Google Ads Slot -->
    <div class="ad-slot top-ad">
        [AD_TOP_BANNER]
    </div>

    <div class="calculator-container">
        <?php
        // Mortgage calculation function
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
            'Fixed Rate' => ['rate' => '5.0% - 6.0%', 'term' => 25],
            'Variable Rate' => ['rate' => '4.5% - 5.5%', 'term' => 25],
            'Adjustable Rate' => ['rate' => '4.8% - 5.8%', 'term' => 25],
            'HELOC' => ['rate' => '6.0% - 7.0%', 'term' => 20],
            'Insured Mortgage' => ['rate' => '5.2% - 6.2%', 'term' => 25]
        ];

        $provinces = [
            'Ontario' => 'Average home prices',
            'British Columbia' => 'High cost areas',
            'Alberta' => 'Moderate prices',
            'Quebec' => 'Lower average prices',
            'Manitoba' => 'Affordable housing',
            'Saskatchewan' => 'Low cost of living',
            'Nova Scotia' => 'Coastal province',
            'New Brunswick' => 'Small province',
            'Newfoundland' => 'Eastern province',
            'Prince Edward Island' => 'Smallest province'
        ];

        // Canadian Banks reference rates
        $banks = [
            'Royal Bank (RBC)' => '5.0% - 6.0%',
            'TD Canada Trust' => '4.9% - 5.9%',
            'Scotiabank' => '5.1% - 6.1%',
            'BMO' => '5.0% - 6.0%',
            'CIBC' => '4.9% - 5.9%'
        ];

        // Credit Score Tiers
        $credit_score_tiers = [
            'Excellent' => ['min' => 800, 'max' => 850, 'rate_adjustment' => -0.9],
            'Very Good' => ['min' => 740, 'max' => 799, 'rate_adjustment' => -0.5],
            'Good' => ['min' => 670, 'max' => 739, 'rate_adjustment' => 0],
            'Fair' => ['min' => 580, 'max' => 669, 'rate_adjustment' => 1.3],
            'Poor' => ['min' => 300, 'max' => 579, 'rate_adjustment' => 2.7]
        ];
        ?>

        <div class="input-group">
            <label for="loanType">Mortgage Type</label>
            <select id="loanType" onchange="updateLoanLimits()">
                <?php foreach($mortgage_types as $type => $limits): ?>
                    <option value="<?php echo $type; ?>"><?php echo $type; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="input-group">
            <label for="province">Province</label>
            <select id="province" onchange="updateProvinceInfo()">
                <?php foreach($provinces as $province => $info): ?>
                    <option value="<?php echo $province; ?>"><?php echo $province; ?></option>
                <?php endforeach; ?>
            </select>
            <div class="limit-info" id="provinceInfo"></div>
        </div>

        <div class="input-group">
            <label for="creditScore">Credit Score</label>
            <input type="range" id="creditScore" min="300" max="850" value="700" oninput="updateCreditScore()">
            <div class="limit-info" id="creditScoreInfo">Credit Score: 700</div>
        </div>

        <div class="input-group">
            <label for="homePrice">Home Price (C$)</label>
            <input type="number" id="homePrice" placeholder="Enter home price" min="50000" step="1000" value="450000">
            <div class="limit-info" id="priceLimit">Range: C$50,000 - C$3,000,000</div>
        </div>

        <div class="input-group">
            <label for="downPayment">Down Payment (C$)</label>
            <input type="number" id="downPayment" placeholder="Enter down payment" min="0" step="1000" value="90000">
            <div class="limit-info" id="downPaymentPercent">20% down payment</div>
        </div>

        <div class="input-group">
            <label for="interestRate">Interest Rate (% APR)</label>
            <input type="number" id="interestRate" placeholder="Enter interest rate" min="0.5" max="20" step="0.1" value="5.0">
            <div class="rate-info" id="interestRange">Typical rates: <span id="typicalRate">5.0% - 6.0%</span></div>
        </div>

        <div class="input-group">
            <label for="loanTerm">Loan Term (Years)</label>
            <input type="number" id="loanTerm" placeholder="Enter loan term" min="5" max="30" step="1" value="25">
            <div class="limit-info" id="tenureLimit">Range: 5 - 30 years</div>
        </div>

        <!-- Additional Costs -->
        <div class="input-group">
            <label for="cmhcInsurance">CMHC Insurance (C$)</label>
            <input type="number" id="cmhcInsurance" placeholder="CMHC insurance" min="0" step="100" value="0">
        </div>

        <div class="input-group">
            <label for="propertyTax">Property Tax (C$/year)</label>
            <input type="number" id="propertyTax" placeholder="Property tax" min="0" step="100" value="3000">
        </div>

        <div class="input-group">
            <label for="homeInsurance">Home Insurance (C$/year)</label>
            <input type="number" id="homeInsurance" placeholder="Home insurance" min="0" step="10" value="800">
        </div>

        <button class="calculate-btn" onclick="calculateCanadaMortgagePayment()">
            <i class="fas fa-calculator"></i> Calculate Mortgage Payment
        </button>

        <!-- Google Ads Slot -->
        <div class="ad-slot middle-ad">
            [AD_MIDDLE_BANNER]
        </div>

        <div class="result-container" id="resultContainer" style="display: none;">
            <h3><i class="fas fa-chart-bar"></i> Mortgage Summary</h3>
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
                        <div class="chart-label">CMHC Insurance</div>
                        <div class="chart-value" id="breakdownCMHC">-</div>
                        <div class="chart-fill cmhc-fill" id="fillCMHC"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Google Ads Slot -->
    <div class="ad-slot bottom-ad">
        [AD_BOTTOM_BANNER]
    </div>

    <!-- All Calculators Backlinks -->
    <div class="info-section" style="background: #f8f9fa; padding: 60px 20px; text-align: center; margin-top: 40px;">
        <h2 style="font-size: 2.5rem; font-weight: 700; color: #333; margin-bottom: 20px;">Explore Our Other Calculators</h2>
        <p style="font-size: 1.2rem; color: #666; max-width: 600px; margin: 0 auto 40px;">Check out our collection of 50+ free online calculators</p>
        
        <div class="calculator-links" style="max-width: 1200px; margin: 0 auto; text-align: center;">
            <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 15px; margin-bottom: 20px;">
                <a href="/calculators/01-loan-emi-calculator/canada.php" style="background: #3498db; color: white; padding: 12px 20px; border-radius: 30px; text-decoration: none; font-weight: 500; transition: all 0.3s ease;">Loan EMI Calculator</a>
                <a href="/calculators/02-bmi-calculator/" style="background: #2ecc71; color: white; padding: 12px 20px; border-radius: 30px; text-decoration: none; font-weight: 500; transition: all 0.3s ease;">BMI Calculator</a>
                <a href="/calculators/03-currency-converter/" style="background: #9b59b6; color: white; padding: 12px 20px; border-radius: 30px; text-decoration: none; font-weight: 500; transition: all 0.3s ease;">Currency Converter</a>
                <a href="/calculators/05-compound-interest-calculator/" style="background: #e67e22; color: white; padding: 12px 20px; border-radius: 30px; text-decoration: none; font-weight: 500; transition: all 0.3s ease;">Compound Interest</a>
            </div>
            <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 15px; margin-bottom: 20px;">
                <a href="/calculators/06-calorie-calculator/" style="background: #1abc9c; color: white; padding: 12px 20px; border-radius: 30px; text-decoration: none; font-weight: 500; transition: all 0.3s ease;">Calorie Calculator</a>
                <a href="/calculators/07-qr-code-generator/" style="background: #34495e; color: white; padding: 12px 20px; border-radius: 30px; text-decoration: none; font-weight: 500; transition: all 0.3s ease;">QR Code Generator</a>
                <a href="/calculators/08-password-generator/" style="background: #f39c12; color: white; padding: 12px 20px; border-radius: 30px; text-decoration: none; font-weight: 500; transition: all 0.3s ease;">Password Generator</a>
                <a href="/calculators/09-tax-calculator/" style="background: #e74c3c; color: white; padding: 12px 20px; border-radius: 30px; text-decoration: none; font-weight: 500; transition: all 0.3s ease;">Tax Calculator</a>
            </div>
            <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 15px;">
                <a href="/calculators/" style="background: #8e44ad; color: white; padding: 12px 20px; border-radius: 30px; text-decoration: none; font-weight: 500; transition: all 0.3s ease;">View All Calculators</a>
            </div>
        </div>
    </div>
</div>

<script>
    const mortgageTypes = <?php echo json_encode($mortgage_types); ?>;
    const provinces = <?php echo json_encode($provinces); ?>;
    const creditTiers = <?php echo json_encode($credit_score_tiers); ?>;
    let currentCreditTier = 'Good';
    let creditAdjustment = 0;

    function updateLoanLimits() {
        const loanType = document.getElementById('loanType').value;
        const limits = mortgageTypes[loanType];
        
        document.getElementById('loanTerm').value = limits.term;
        document.getElementById('tenureLimit').textContent = `Standard term: ${limits.term} years`;
        document.getElementById('typicalRate').textContent = limits.rate;
    }

    function updateProvinceInfo() {
        const province = document.getElementById('province').value;
        document.getElementById('provinceInfo').textContent = provinces[province];
    }

    function updateCreditScore() {
        const creditScore = parseInt(document.getElementById('creditScore').value);
        document.getElementById('creditScoreInfo').textContent = `Credit Score: ${creditScore}`;
        
        // Determine credit tier and adjustment
        for (const [tier, data] of Object.entries(creditTiers)) {
            if (creditScore >= data.min && creditScore <= data.max) {
                currentCreditTier = tier;
                creditAdjustment = data.rate_adjustment;
                break;
            }
        }
    }

    function updateDownPaymentPercent() {
        const homePrice = parseFloat(document.getElementById('homePrice').value) || 0;
        const downPayment = parseFloat(document.getElementById('downPayment').value) || 0;
        
        if (homePrice > 0) {
            const percent = (downPayment / homePrice * 100).toFixed(1);
            document.getElementById('downPaymentPercent').textContent = percent + '% down payment';
        }
    }

    function calculateCanadaMortgagePayment() {
        const homePrice = parseFloat(document.getElementById('homePrice').value);
        let downPayment = parseFloat(document.getElementById('downPayment').value);
        let rate = parseFloat(document.getElementById('interestRate').value);
        const tenure = parseFloat(document.getElementById('loanTerm').value);
        const cmhcInsurance = parseFloat(document.getElementById('cmhcInsurance').value) || 0;
        const propertyTax = parseFloat(document.getElementById('propertyTax').value) || 0;
        const homeInsurance = parseFloat(document.getElementById('homeInsurance').value) || 0;
        const creditScore = parseInt(document.getElementById('creditScore').value);
        
        if (!homePrice || !downPayment || !rate || !tenure) {
            alert('Please fill all required fields');
            return;
        }

        // Apply credit score adjustment
        rate += creditAdjustment;

        const loanAmount = homePrice - downPayment;
        const monthlyRate = rate / 12 / 100;
        const months = tenure * 12;
        const monthlyPI = loanAmount * monthlyRate * Math.pow(1 + monthlyRate, months) / 
                    (Math.pow(1 + monthlyRate, months) - 1);
        
        // Convert annual costs to monthly
        const monthlyPropertyTax = propertyTax / 12;
        const monthlyHomeInsurance = homeInsurance / 12;
        
        // Convert one-time CMHC to monthly equivalent
        const monthlyCMHC = cmhcInsurance / months;
        
        const totalMonthly = monthlyPI + monthlyPropertyTax + monthlyHomeInsurance + monthlyCMHC;
        const totalPayment = monthlyPI * months;
        const totalInterest = totalPayment - loanAmount;

        // Update results
        document.getElementById('principalInterest').textContent = 
            'C$' + monthlyPI.toLocaleString('en-US', {maximumFractionDigits: 2});
        document.getElementById('monthlyPayment').textContent = 
            'C$' + totalMonthly.toLocaleString('en-US', {maximumFractionDigits: 2});
        document.getElementById('totalLoan').textContent = 
            'C$' + loanAmount.toLocaleString('en-US', {maximumFractionDigits: 2});
        document.getElementById('totalInterest').textContent = 
            'C$' + totalInterest.toLocaleString('en-US', {maximumFractionDigits: 2});

        // Update chart visualization
        const total = totalMonthly;
        document.getElementById('fillPI').style.width = (monthlyPI / total * 100) + '%';
        document.getElementById('fillTax').style.width = (monthlyPropertyTax / total * 100) + '%';
        document.getElementById('fillInsurance').style.width = (monthlyHomeInsurance / total * 100) + '%';
        document.getElementById('fillCMHC').style.width = (monthlyCMHC / total * 100) + '%';
        
        // Update breakdown values
        document.getElementById('breakdownPI').textContent = 'C$' + monthlyPI.toFixed(2);
        document.getElementById('breakdownTax').textContent = 'C$' + monthlyPropertyTax.toFixed(2);
        document.getElementById('breakdownInsurance').textContent = 'C$' + monthlyHomeInsurance.toFixed(2);
        document.getElementById('breakdownCMHC').textContent = 'C$' + monthlyCMHC.toFixed(2);

        document.getElementById('resultContainer').style.display = 'block';
    }

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        updateLoanLimits();
        updateProvinceInfo();
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