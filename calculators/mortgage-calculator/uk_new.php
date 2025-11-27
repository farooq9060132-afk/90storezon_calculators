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

<div class="vip-container">
    <header class="vip-header">
        <h1><i class="fas fa-home"></i> UK Mortgage Calculator</h1>
        <p>Calculate your mortgage payments with stamp duty & help to buy schemes</p>
    </header>

    <!-- Google Ads Slot -->
    <div class="ad-slot top-ad">
        [AD_TOP_BANNER]
    </div>

    <div class="calculator-container">
        <?php
        // Mortgage calculation function
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
            'Fixed Rate (5 years)' => ['rate' => '4.3% - 5.3%', 'term' => 5],
            'Tracker Mortgage' => ['rate' => '4.0% - 5.0%', 'term' => 25],
            'Help to Buy' => ['rate' => '3.8% - 4.8%', 'term' => 25],
            'Buy to Let' => ['rate' => '5.0% - 6.0%', 'term' => 25]
        ];

        $regions = [
            'England' => 'Standard rates',
            'Scotland' => 'Land and Buildings Transaction Tax',
            'Wales' => 'Land Transaction Tax',
            'Northern Ireland' => 'Standard rates'
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
            'Excellent' => ['min' => 800, 'max' => 850, 'rate_adjustment' => -0.8],
            'Very Good' => ['min' => 740, 'max' => 799, 'rate_adjustment' => -0.4],
            'Good' => ['min' => 670, 'max' => 739, 'rate_adjustment' => 0],
            'Fair' => ['min' => 580, 'max' => 669, 'rate_adjustment' => 1.2],
            'Poor' => ['min' => 300, 'max' => 579, 'rate_adjustment' => 2.5]
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
            <label for="region">Region</label>
            <select id="region" onchange="updateRegionInfo()">
                <?php foreach($regions as $region => $info): ?>
                    <option value="<?php echo $region; ?>"><?php echo $region; ?></option>
                <?php endforeach; ?>
            </select>
            <div class="limit-info" id="regionInfo"></div>
        </div>

        <div class="input-group">
            <label for="creditScore">Credit Score</label>
            <input type="range" id="creditScore" min="300" max="850" value="700" oninput="updateCreditScore()">
            <div class="limit-info" id="creditScoreInfo">Credit Score: 700</div>
        </div>

        <div class="input-group">
            <label for="homePrice">Home Price (£)</label>
            <input type="number" id="homePrice" placeholder="Enter home price" min="50000" step="1000" value="250000">
            <div class="limit-info" id="priceLimit">Range: £50,000 - £2,000,000</div>
        </div>

        <div class="input-group">
            <label for="downPayment">Deposit (£)</label>
            <input type="number" id="downPayment" placeholder="Enter deposit" min="0" step="1000" value="50000">
            <div class="limit-info" id="downPaymentPercent">20% deposit</div>
        </div>

        <div class="input-group">
            <label for="interestRate">Interest Rate (% APR)</label>
            <input type="number" id="interestRate" placeholder="Enter interest rate" min="0.5" max="20" step="0.1" value="4.5">
            <div class="rate-info" id="interestRange">Typical rates: <span id="typicalRate">4.5% - 5.5%</span></div>
        </div>

        <div class="input-group">
            <label for="loanTerm">Loan Term (Years)</label>
            <input type="number" id="loanTerm" placeholder="Enter loan term" min="5" max="35" step="1" value="25">
            <div class="limit-info" id="tenureLimit">Range: 5 - 35 years</div>
        </div>

        <!-- Additional Costs -->
        <div class="input-group">
            <label for="stampDuty">Stamp Duty (£)</label>
            <input type="number" id="stampDuty" placeholder="Stamp duty" min="0" step="100" value="0">
        </div>

        <div class="input-group">
            <label for="homeInsurance">Home Insurance (£/year)</label>
            <input type="number" id="homeInsurance" placeholder="Home insurance" min="0" step="10" value="200">
        </div>

        <div class="input-group">
            <label for="arrangementFee">Arrangement Fee (£)</label>
            <input type="number" id="arrangementFee" placeholder="Arrangement fee" min="0" step="10" value="0">
        </div>

        <button class="calculate-btn" onclick="calculateUKMortgagePayment()">
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
                        <div class="chart-label">Home Insurance</div>
                        <div class="chart-value" id="breakdownInsurance">-</div>
                        <div class="chart-fill insurance-fill" id="fillInsurance"></div>
                    </div>
                    <div class="chart-bar">
                        <div class="chart-label">Arrangement Fee</div>
                        <div class="chart-value" id="breakdownFee">-</div>
                        <div class="chart-fill fee-fill" id="fillFee"></div>
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
                <a href="/calculators/01-loan-emi-calculator/uk.php" style="background: #3498db; color: white; padding: 12px 20px; border-radius: 30px; text-decoration: none; font-weight: 500; transition: all 0.3s ease;">Loan EMI Calculator</a>
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
    const regions = <?php echo json_encode($regions); ?>;
    const creditTiers = <?php echo json_encode($credit_score_tiers); ?>;
    let currentCreditTier = 'Good';
    let creditAdjustment = 0;

    function updateLoanLimits() {
        const loanType = document.getElementById('loanType').value;
        const limits = mortgageTypes[loanType];
        
        if (limits.term) {
            document.getElementById('loanTerm').value = limits.term;
            document.getElementById('tenureLimit').textContent = `Fixed term: ${limits.term} years`;
        }
        
        document.getElementById('typicalRate').textContent = limits.rate;
    }

    function updateRegionInfo() {
        const region = document.getElementById('region').value;
        document.getElementById('regionInfo').textContent = regions[region];
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
            document.getElementById('downPaymentPercent').textContent = percent + '% deposit';
        }
    }

    function calculateUKMortgagePayment() {
        const homePrice = parseFloat(document.getElementById('homePrice').value);
        let downPayment = parseFloat(document.getElementById('downPayment').value);
        let rate = parseFloat(document.getElementById('interestRate').value);
        const tenure = parseFloat(document.getElementById('loanTerm').value);
        const stampDuty = parseFloat(document.getElementById('stampDuty').value) || 0;
        const homeInsurance = parseFloat(document.getElementById('homeInsurance').value) || 0;
        const arrangementFee = parseFloat(document.getElementById('arrangementFee').value) || 0;
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
        
        // Convert annual insurance to monthly
        const monthlyInsurance = homeInsurance / 12;
        
        // Convert one-time fee to monthly equivalent
        const monthlyFee = arrangementFee / months;
        
        const totalMonthly = monthlyPI + monthlyInsurance + monthlyFee;
        const totalPayment = monthlyPI * months;
        const totalInterest = totalPayment - loanAmount;

        // Update results
        document.getElementById('principalInterest').textContent = 
            '£' + monthlyPI.toLocaleString('en-US', {maximumFractionDigits: 2});
        document.getElementById('monthlyPayment').textContent = 
            '£' + totalMonthly.toLocaleString('en-US', {maximumFractionDigits: 2});
        document.getElementById('totalLoan').textContent = 
            '£' + loanAmount.toLocaleString('en-US', {maximumFractionDigits: 2});
        document.getElementById('totalInterest').textContent = 
            '£' + totalInterest.toLocaleString('en-US', {maximumFractionDigits: 2});

        // Update chart visualization
        const total = totalMonthly;
        document.getElementById('fillPI').style.width = (monthlyPI / total * 100) + '%';
        document.getElementById('fillInsurance').style.width = (monthlyInsurance / total * 100) + '%';
        document.getElementById('fillFee').style.width = (monthlyFee / total * 100) + '%';
        
        // Update breakdown values
        document.getElementById('breakdownPI').textContent = '£' + monthlyPI.toFixed(2);
        document.getElementById('breakdownInsurance').textContent = '£' + monthlyInsurance.toFixed(2);
        document.getElementById('breakdownFee').textContent = '£' + monthlyFee.toFixed(2);

        document.getElementById('resultContainer').style.display = 'block';
    }

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        updateLoanLimits();
        updateRegionInfo();
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