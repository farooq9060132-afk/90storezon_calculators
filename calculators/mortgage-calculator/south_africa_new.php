<?php include '../../header.php'; ?>

<!-- SEO Elements -->
<link rel="canonical" href="https://90storezon.com/calculators/04-mortgage-calculator/south_africa.php">
<meta name="description" content="Free South Africa home loan calculator with initiation fees, insurance. Calculate fixed, variable rate loans for all provinces.">
<meta name="keywords" content="South Africa home loan calculator, SA mortgage calculator, property loan calculator, home financing calculator">

<!-- Structured Data -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "FinancialService",
    "name": "South Africa Home Loan Calculator",
    "description": "Free online home loan calculator for South African property buyers in all provinces",
    "url": "https://90storezon.com/calculators/04-mortgage-calculator/south_africa.php",
    "areaServed": "ZA",
    "serviceType": "Home Loan Calculator"
}
</script>

<div class="vip-container">
    <header class="vip-header">
        <h1><i class="fas fa-home"></i> South Africa Home Loan Calculator</h1>
        <p>Calculate your home loan payments with initiation fees & insurance</p>
    </header>

    <!-- Google Ads Slot -->
    <div class="ad-slot top-ad">
        [AD_TOP_BANNER]
    </div>

    <div class="calculator-container">
        <?php
        // Home loan calculation function
        function calculateSAHomeLoan($principal, $interest_rate, $tenure_years, $down_payment = 0) {
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

        // South Africa Home Loan data
        $loan_types = [
            'Fixed Rate' => ['rate' => '9.0% - 12.0%', 'term' => 20],
            'Variable Rate' => ['rate' => '8.5% - 11.5%', 'term' => 20],
            'Access Bond' => ['rate' => '9.5% - 12.5%', 'term' => 25],
            'Switch Loan' => ['rate' => '9.2% - 12.2%', 'term' => 15],
            'Refinance' => ['rate' => '9.3% - 12.3%', 'term' => 20]
        ];

        $provinces = [
            'Gauteng' => 'Economic hub',
            'Western Cape' => 'Coastal province',
            'KwaZulu-Natal' => 'Eastern province',
            'Eastern Cape' => 'Southeastern province',
            'Free State' => 'Central province',
            'North West' => 'Northwestern province',
            'Northern Cape' => 'Northern province',
            'Limpopo' => 'Northern province',
            'Mpumalanga' => 'Eastern province'
        ];

        // South African Banks reference rates
        $banks = [
            'Absa' => '9.0% - 12.0%',
            'Standard Bank' => '8.9% - 11.9%',
            'FNB' => '9.1% - 12.1%',
            'Nedbank' => '9.0% - 12.0%',
            'Capitec' => '8.9% - 11.9%'
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
            <label for="loanType">Loan Type</label>
            <select id="loanType" onchange="updateLoanLimits()">
                <?php foreach($loan_types as $type => $limits): ?>
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
            <label for="homePrice">Property Price (R)</label>
            <input type="number" id="homePrice" placeholder="Enter property price" min="100000" step="10000" value="1500000">
            <div class="limit-info" id="priceLimit">Range: R 100,000 - R 20,000,000</div>
        </div>

        <div class="input-group">
            <label for="downPayment">Down Payment (R)</label>
            <input type="number" id="downPayment" placeholder="Enter down payment" min="0" step="10000" value="300000">
            <div class="limit-info" id="downPaymentPercent">20% down payment</div>
        </div>

        <div class="input-group">
            <label for="interestRate">Interest Rate (% p.a.)</label>
            <input type="number" id="interestRate" placeholder="Enter interest rate" min="7.0" max="20" step="0.1" value="9.0">
            <div class="rate-info" id="interestRange">Typical rates: <span id="typicalRate">9.0% - 12.0%</span></div>
        </div>

        <div class="input-group">
            <label for="loanTerm">Loan Term (Years)</label>
            <input type="number" id="loanTerm" placeholder="Enter loan term" min="5" max="30" step="1" value="20">
            <div class="limit-info" id="tenureLimit">Range: 5 - 30 years</div>
        </div>

        <!-- Additional Costs -->
        <div class="input-group">
            <label for="initiationFee">Initiation Fee (R)</label>
            <input type="number" id="initiationFee" placeholder="Initiation fee" min="0" step="100" value="0">
        </div>

        <div class="input-group">
            <label for="homeInsurance">Home Insurance (R/year)</label>
            <input type="number" id="homeInsurance" placeholder="Home insurance" min="0" step="100" value="5000">
        </div>

        <div class="input-group">
            <label for="deedsOfficeFee">Deeds Office Fee (R)</label>
            <input type="number" id="deedsOfficeFee" placeholder="Deeds office fee" min="0" step="100" value="0">
        </div>

        <button class="calculate-btn" onclick="calculateSAHomeLoanPayment()">
            <i class="fas fa-calculator"></i> Calculate Home Loan Payment
        </button>

        <!-- Google Ads Slot -->
        <div class="ad-slot middle-ad">
            [AD_MIDDLE_BANNER]
        </div>

        <div class="result-container" id="resultContainer" style="display: none;">
            <h3><i class="fas fa-chart-bar"></i> Home Loan Summary</h3>
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
                        <div class="chart-label">Initiation Fee</div>
                        <div class="chart-value" id="breakdownInitiation">-</div>
                        <div class="chart-fill initiation-fill" id="fillInitiation"></div>
                    </div>
                    <div class="chart-bar">
                        <div class="chart-label">Deeds Office Fee</div>
                        <div class="chart-value" id="breakdownDeeds">-</div>
                        <div class="chart-fill deeds-fill" id="fillDeeds"></div>
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
                <a href="/calculators/01-loan-emi-calculator/" style="background: #3498db; color: white; padding: 12px 20px; border-radius: 30px; text-decoration: none; font-weight: 500; transition: all 0.3s ease;">Loan EMI Calculator</a>
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
    const loanTypes = <?php echo json_encode($loan_types); ?>;
    const provinces = <?php echo json_encode($provinces); ?>;
    const creditTiers = <?php echo json_encode($credit_score_tiers); ?>;
    let currentCreditTier = 'Good';
    let creditAdjustment = 0;

    function updateLoanLimits() {
        const loanType = document.getElementById('loanType').value;
        const limits = loanTypes[loanType];
        
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

    function calculateSAHomeLoanPayment() {
        const homePrice = parseFloat(document.getElementById('homePrice').value);
        let downPayment = parseFloat(document.getElementById('downPayment').value);
        let rate = parseFloat(document.getElementById('interestRate').value);
        const tenure = parseFloat(document.getElementById('loanTerm').value);
        const initiationFee = parseFloat(document.getElementById('initiationFee').value) || 0;
        const homeInsurance = parseFloat(document.getElementById('homeInsurance').value) || 0;
        const deedsOfficeFee = parseFloat(document.getElementById('deedsOfficeFee').value) || 0;
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
        
        // Convert one-time fees to monthly equivalent
        const monthlyInitiationFee = initiationFee / months;
        const monthlyDeedsOfficeFee = deedsOfficeFee / months;
        
        const totalMonthly = monthlyPI + monthlyInsurance + monthlyInitiationFee + monthlyDeedsOfficeFee;
        const totalPayment = monthlyPI * months;
        const totalInterest = totalPayment - loanAmount;

        // Update results
        document.getElementById('principalInterest').textContent = 
            'R ' + monthlyPI.toLocaleString('en-US');
        document.getElementById('monthlyPayment').textContent = 
            'R ' + totalMonthly.toLocaleString('en-US');
        document.getElementById('totalLoan').textContent = 
            'R ' + loanAmount.toLocaleString('en-US');
        document.getElementById('totalInterest').textContent = 
            'R ' + totalInterest.toLocaleString('en-US');

        // Update chart visualization
        const total = totalMonthly;
        document.getElementById('fillPI').style.width = (monthlyPI / total * 100) + '%';
        document.getElementById('fillInsurance').style.width = (monthlyInsurance / total * 100) + '%';
        document.getElementById('fillInitiation').style.width = (monthlyInitiationFee / total * 100) + '%';
        document.getElementById('fillDeeds').style.width = (monthlyDeedsOfficeFee / total * 100) + '%';
        
        // Update breakdown values
        document.getElementById('breakdownPI').textContent = 'R ' + monthlyPI.toFixed(2);
        document.getElementById('breakdownInsurance').textContent = 'R ' + monthlyInsurance.toFixed(2);
        document.getElementById('breakdownInitiation').textContent = 'R ' + monthlyInitiationFee.toFixed(2);
        document.getElementById('breakdownDeeds').textContent = 'R ' + monthlyDeedsOfficeFee.toFixed(2);

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