<?php include '../../header.php'; ?>

<!-- SEO Elements -->
<link rel="canonical" href="https://90storezon.com/calculators/04-mortgage-calculator/india.php">
<meta name="description" content="Free Indian home loan calculator with processing fees, prepayment charges. Calculate fixed, floating rate loans for all cities.">
<meta name="keywords" content="Indian home loan calculator, India mortgage calculator, home loan EMI calculator, fixed rate loan, floating rate loan">

<!-- Structured Data -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "FinancialService",
    "name": "India Home Loan Calculator",
    "description": "Free online home loan calculator for Indian home buyers in all cities",
    "url": "https://90storezon.com/calculators/04-mortgage-calculator/india.php",
    "areaServed": "IN",
    "serviceType": "Home Loan Calculator"
}
</script>

<div class="vip-container">
    <header class="vip-header">
        <h1><i class="fas fa-home"></i> India Home Loan Calculator</h1>
        <p>Calculate your home loan EMIs with processing fees & prepayment charges</p>
    </header>

    <!-- Google Ads Slot -->
    <div class="ad-slot top-ad">
        [AD_TOP_BANNER]
    </div>

    <div class="calculator-container">
        <?php
        // Home loan calculation function
        function calculateIndiaHomeLoan($principal, $interest_rate, $tenure_years, $down_payment = 0) {
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

        // India Home Loan data
        $loan_types = [
            'Fixed Rate' => ['rate' => '8.5% - 9.5%', 'term' => 20],
            'Floating Rate' => ['rate' => '8.0% - 9.0%', 'term' => 20],
            'Hybrid Loan' => ['rate' => '8.2% - 9.2%', 'term' => 20],
            'NRI Loan' => ['rate' => '9.0% - 10.0%', 'term' => 15],
            'Plot Loan' => ['rate' => '9.5% - 10.5%', 'term' => 10]
        ];

        $cities = [
            'Mumbai' => 'High cost city',
            'Delhi' => 'National capital',
            'Bangalore' => 'IT hub',
            'Chennai' => 'Southern metropolis',
            'Kolkata' => 'Eastern gateway',
            'Hyderabad' => 'Technology city',
            'Pune' => 'Education hub',
            'Ahmedabad' => 'Western city',
            'Jaipur' => 'Pink city',
            'Lucknow' => 'Capital city'
        ];

        // Indian Banks reference rates
        $banks = [
            'SBI' => '8.5% - 9.5%',
            'HDFC' => '8.4% - 9.4%',
            'ICICI' => '8.6% - 9.6%',
            'Axis Bank' => '8.5% - 9.5%',
            'Kotak Mahindra' => '8.4% - 9.4%'
        ];

        // Credit Score Tiers
        $credit_score_tiers = [
            'Excellent' => ['min' => 800, 'max' => 850, 'rate_adjustment' => -0.7],
            'Very Good' => ['min' => 740, 'max' => 799, 'rate_adjustment' => -0.3],
            'Good' => ['min' => 670, 'max' => 739, 'rate_adjustment' => 0],
            'Fair' => ['min' => 580, 'max' => 669, 'rate_adjustment' => 1.0],
            'Poor' => ['min' => 300, 'max' => 579, 'rate_adjustment' => 2.2]
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
            <label for="city">City</label>
            <select id="city" onchange="updateCityInfo()">
                <?php foreach($cities as $city => $info): ?>
                    <option value="<?php echo $city; ?>"><?php echo $city; ?></option>
                <?php endforeach; ?>
            </select>
            <div class="limit-info" id="cityInfo"></div>
        </div>

        <div class="input-group">
            <label for="creditScore">Credit Score</label>
            <input type="range" id="creditScore" min="300" max="850" value="700" oninput="updateCreditScore()">
            <div class="limit-info" id="creditScoreInfo">Credit Score: 700</div>
        </div>

        <div class="input-group">
            <label for="homePrice">Property Price (₹)</label>
            <input type="number" id="homePrice" placeholder="Enter property price" min="100000" step="10000" value="5000000">
            <div class="limit-info" id="priceLimit">Range: ₹1,00,000 - ₹10,00,00,000</div>
        </div>

        <div class="input-group">
            <label for="downPayment">Down Payment (₹)</label>
            <input type="number" id="downPayment" placeholder="Enter down payment" min="0" step="10000" value="1000000">
            <div class="limit-info" id="downPaymentPercent">20% down payment</div>
        </div>

        <div class="input-group">
            <label for="interestRate">Interest Rate (% p.a.)</label>
            <input type="number" id="interestRate" placeholder="Enter interest rate" min="6.0" max="15" step="0.1" value="8.5">
            <div class="rate-info" id="interestRange">Typical rates: <span id="typicalRate">8.5% - 9.5%</span></div>
        </div>

        <div class="input-group">
            <label for="loanTerm">Loan Term (Years)</label>
            <input type="number" id="loanTerm" placeholder="Enter loan term" min="5" max="30" step="1" value="20">
            <div class="limit-info" id="tenureLimit">Range: 5 - 30 years</div>
        </div>

        <!-- Additional Costs -->
        <div class="input-group">
            <label for="processingFee">Processing Fee (₹)</label>
            <input type="number" id="processingFee" placeholder="Processing fee" min="0" step="100" value="0">
        </div>

        <div class="input-group">
            <label for="prepaymentCharge">Prepayment Charge (₹)</label>
            <input type="number" id="prepaymentCharge" placeholder="Prepayment charge" min="0" step="100" value="0">
        </div>

        <div class="input-group">
            <label for="homeInsurance">Home Insurance (₹/year)</label>
            <input type="number" id="homeInsurance" placeholder="Home insurance" min="0" step="100" value="5000">
        </div>

        <button class="calculate-btn" onclick="calculateIndiaHomeLoanPayment()">
            <i class="fas fa-calculator"></i> Calculate Home Loan EMI
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
                        <div class="chart-label">Processing Fee</div>
                        <div class="chart-value" id="breakdownFee">-</div>
                        <div class="chart-fill fee-fill" id="fillFee"></div>
                    </div>
                    <div class="chart-bar">
                        <div class="chart-label">Prepayment Charge</div>
                        <div class="chart-value" id="breakdownCharge">-</div>
                        <div class="chart-fill charge-fill" id="fillCharge"></div>
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
                <a href="/calculators/01-loan-emi-calculator/india.php" style="background: #3498db; color: white; padding: 12px 20px; border-radius: 30px; text-decoration: none; font-weight: 500; transition: all 0.3s ease;">Loan EMI Calculator</a>
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
    const cities = <?php echo json_encode($cities); ?>;
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

    function updateCityInfo() {
        const city = document.getElementById('city').value;
        document.getElementById('cityInfo').textContent = cities[city];
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

    function calculateIndiaHomeLoanPayment() {
        const homePrice = parseFloat(document.getElementById('homePrice').value);
        let downPayment = parseFloat(document.getElementById('downPayment').value);
        let rate = parseFloat(document.getElementById('interestRate').value);
        const tenure = parseFloat(document.getElementById('loanTerm').value);
        const processingFee = parseFloat(document.getElementById('processingFee').value) || 0;
        const prepaymentCharge = parseFloat(document.getElementById('prepaymentCharge').value) || 0;
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
        
        // Convert annual insurance to monthly
        const monthlyInsurance = homeInsurance / 12;
        
        // Convert one-time fees to monthly equivalent
        const monthlyProcessingFee = processingFee / months;
        const monthlyPrepaymentCharge = prepaymentCharge / months;
        
        const totalMonthly = monthlyPI + monthlyInsurance + monthlyProcessingFee + monthlyPrepaymentCharge;
        const totalPayment = monthlyPI * months;
        const totalInterest = totalPayment - loanAmount;

        // Update results
        document.getElementById('principalInterest').textContent = 
            '₹' + monthlyPI.toLocaleString('en-IN');
        document.getElementById('monthlyPayment').textContent = 
            '₹' + totalMonthly.toLocaleString('en-IN');
        document.getElementById('totalLoan').textContent = 
            '₹' + loanAmount.toLocaleString('en-IN');
        document.getElementById('totalInterest').textContent = 
            '₹' + totalInterest.toLocaleString('en-IN');

        // Update chart visualization
        const total = totalMonthly;
        document.getElementById('fillPI').style.width = (monthlyPI / total * 100) + '%';
        document.getElementById('fillInsurance').style.width = (monthlyInsurance / total * 100) + '%';
        document.getElementById('fillFee').style.width = (monthlyProcessingFee / total * 100) + '%';
        document.getElementById('fillCharge').style.width = (monthlyPrepaymentCharge / total * 100) + '%';
        
        // Update breakdown values
        document.getElementById('breakdownPI').textContent = '₹' + monthlyPI.toFixed(2);
        document.getElementById('breakdownInsurance').textContent = '₹' + monthlyInsurance.toFixed(2);
        document.getElementById('breakdownFee').textContent = '₹' + monthlyProcessingFee.toFixed(2);
        document.getElementById('breakdownCharge').textContent = '₹' + monthlyPrepaymentCharge.toFixed(2);

        document.getElementById('resultContainer').style.display = 'block';
    }

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        updateLoanLimits();
        updateCityInfo();
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