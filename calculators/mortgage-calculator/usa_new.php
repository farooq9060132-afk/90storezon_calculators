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

<div class="vip-container">
    <header class="vip-header">
        <h1><i class="fas fa-home"></i> US Mortgage Calculator</h1>
        <p>Calculate your mortgage payments with taxes, insurance & PMI</p>
    </header>

    <!-- Google Ads Slot -->
    <div class="ad-slot top-ad">
        [AD_TOP_BANNER]
    </div>

    <div class="calculator-container">
        <?php
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
            <label for="state">State</label>
            <select id="state" onchange="updateStateInfo()">
                <?php foreach($states as $state => $info): ?>
                    <option value="<?php echo $state; ?>"><?php echo $state; ?></option>
                <?php endforeach; ?>
            </select>
            <div class="limit-info" id="stateInfo"></div>
        </div>

        <div class="input-group">
            <label for="creditScore">Credit Score</label>
            <input type="range" id="creditScore" min="300" max="850" value="700" oninput="updateCreditScore()">
            <div class="limit-info" id="creditScoreInfo">Credit Score: 700</div>
        </div>

        <div class="input-group">
            <label for="homePrice">Home Price ($)</label>
            <input type="number" id="homePrice" placeholder="Enter home price" min="50000" step="1000" value="350000">
            <div class="limit-info" id="priceLimit">Range: $50,000 - $5,000,000</div>
        </div>

        <div class="input-group">
            <label for="downPayment">Down Payment ($)</label>
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

        <button class="calculate-btn" onclick="calculateMortgagePayment()">
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
                        <div class="chart-label">PMI</div>
                        <div class="chart-value" id="breakdownPMI">-</div>
                        <div class="chart-fill pmi-fill" id="fillPMI"></div>
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
                <a href="/calculators/01-loan-emi-calculator/usa.php" style="background: #3498db; color: white; padding: 12px 20px; border-radius: 30px; text-decoration: none; font-weight: 500; transition: all 0.3s ease;">Loan EMI Calculator</a>
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
    const states = <?php echo json_encode($states); ?>;
    const creditTiers = <?php echo json_encode($credit_score_tiers); ?>;
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
    }

    function updateStateInfo() {
        const state = document.getElementById('state').value;
        document.getElementById('stateInfo').textContent = states[state];
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

    function calculateMortgagePayment() {
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

        document.getElementById('resultContainer').style.display = 'block';
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