<?php
$country = 'malaysia';
$country_name = 'Malaysia';
$currency = 'RM';

// Malaysia Mortgage calculation
function calculateMYMortgage($principal, $interest_rate, $tenure_years, $down_payment = 0) {
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

// Malaysia Mortgage data
$mortgage_types = [
    'Conventional Home Loan' => ['rate' => '3.8% - 4.8%', 'term' => 35],
    'Islamic Home Financing' => ['rate' => '3.9% - 4.9%', 'term' => 35],
    'Flexi Loan' => ['rate' => '4.0% - 5.0%', 'term' => 35],
    'Semi-Flexi Loan' => ['rate' => '3.9% - 4.9%', 'term' => 35],
    'BLR/Loan' => ['rate' => '4.2% - 5.2%', 'term' => 35]
];

$states = [
    'Kuala Lumpur' => 'Capital city - High property prices',
    'Selangor' => 'Most developed state - Moderate prices',
    'Penang' => 'Island state - Premium properties',
    'Johor' => 'Southern gateway - Affordable',
    'Sabah' => 'East Malaysia - Growing market',
    'Sarawak' => 'East Malaysia - Low cost'
];

$banks = [
    'Maybank' => 'Largest bank in Malaysia',
    'CIMB Bank' => 'Second largest bank',
    'Public Bank' => 'Leading private bank',
    'RHB Bank' => 'Major financial group',
    'Hong Leong Bank' => 'Premium banking services'
];

$government_schemes = [
    'MyFirst Home Scheme' => 'For first-time buyers below 35',
    'PR1MA' => '1Malaysia Housing Programme',
    'Rumah Selangorku' => 'Selangor affordable housing',
    'Skim Rumah Pertamaku' => 'First home scheme by Bank Negara'
];
?>
<?php include '../../header.php'; ?>

<!-- SEO Elements -->
<link rel="canonical" href="https://90storezon.com/calculators/04-mortgage-calculator/malaysia.php">
<meta name="description" content="Free Malaysia home loan calculator with Islamic financing, MyFirst Home Scheme. Calculate housing loan for Maybank, CIMB, Public Bank in RM for KL, Selangor, Penang properties.">
<meta name="keywords" content="Malaysia mortgage calculator, home loan calculator, Islamic financing calculator, MyFirst Home Scheme, Malaysian property finance">

<!-- Structured Data -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "FinancialService",
    "name": "Malaysia Home Loan Calculator",
    "description": "Free online home loan calculator for Malaysian property buyers including Islamic financing and government housing schemes",
    "url": "https://90storezon.com/calculators/04-mortgage-calculator/malaysia.php",
    "areaServed": "MY",
    "serviceType": "Home Loan Calculator"
}
</script>

<div class="calculator-container">
        <div class="header">
            <h1 class="title">Kalkulator Pinjaman Perumahan Malaysia</h1>
            <div class="country-badge">
                <img src="https://flagcdn.com/w80/my.png" alt="Malaysia Flag - Home Loan Calculator" class="flag">
                <span>Malaysia</span>
            </div>
        </div>

        <!-- Internal Links for SEO -->
        <nav class="seo-links">
            <a href="https://90storezon.com/calculators/01-loan-emi-calculator/">Loan Calculator</a> |
            <a href="https://90storezon.com/calculators/01-loan-emi-calculator/singapore.php">Singapore Mortgage Calculator</a> |
            <a href="https://90storezon.com/calculators/01-loan-emi-calculator/indonesia.php">Indonesia Mortgage Calculator</a> |
            <a href="https://90storezon.com/calculators/01-loan-emi-calculator/thailand.php">Thailand Mortgage Calculator</a>
        </nav>

        <div class="calculator-card">
            <div class="input-group">
                <label for="propertyValue">Harga Hartanah / Property Price (RM)</label>
                <input type="number" id="propertyValue" placeholder="Enter property price" min="100000" step="1000" value="500000">
            </div>

            <div class="input-group">
                <label for="downPayment">Bayaran Pendahuluan / Down Payment (RM)</label>
                <input type="number" id="downPayment" placeholder="Enter down payment" min="0" step="1000" value="50000">
                <div class="limit-info" id="downPaymentPercent">10% down payment</div>
            </div>

            <div class="input-group">
                <label for="state">Negeri / State</label>
                <select id="state">
                    <option value="Kuala Lumpur">Kuala Lumpur (WP)</option>
                    <option value="Selangor">Selangor</option>
                    <option value="Penang">Penang</option>
                    <option value="Johor">Johor</option>
                    <option value="Sabah">Sabah</option>
                    <option value="Sarawak">Sarawak</option>
                    <option value="Perak">Perak</option>
                    <option value="Melaka">Melaka</option>
                </select>
            </div>

            <div class="input-group">
                <label for="bank">Pilih Bank / Select Bank</label>
                <select id="bank" onchange="updateBankRate()">
                    <option value="Maybank">Maybank</option>
                    <option value="CIMB">CIMB Bank</option>
                    <option value="Public Bank">Public Bank</option>
                    <option value="RHB">RHB Bank</option>
                    <option value="Hong Leong">Hong Leong Bank</option>
                    <option value="AmBank">AmBank</option>
                </select>
            </div>

            <div class="input-group">
                <label for="loanType">Jenis Pinjaman / Loan Type</label>
                <select id="loanType" onchange="updateLoanType()">
                    <option value="Conventional">Conventional Home Loan</option>
                    <option value="Islamic">Islamic Home Financing</option>
                    <option value="Flexi">Flexi Loan</option>
                    <option value="Semi-Flexi">Semi-Flexi Loan</option>
                </select>
            </div>

            <div class="input-group">
                <label for="loanTerm">Tempoh Pinjaman / Loan Term</label>
                <select id="loanTerm">
                    <option value="30">30 Years</option>
                    <option value="35">35 Years</option>
                    <option value="25">25 Years</option>
                    <option value="20">20 Years</option>
                </select>
            </div>

            <div class="input-group">
                <label for="interestRate">Kadar Faedah / Interest Rate (%)</label>
                <input type="number" id="interestRate" placeholder="Enter interest rate" min="0.1" max="15" step="0.01" value="3.8">
                <div class="rate-info" id="interestRateInfo">Conventional Loan: 3.8% - 4.8%</div>
            </div>

            <!-- Income Information -->
            <div class="income-section">
                <h3>Maklumat Pendapatan / Income Details</h3>
                <div class="input-group">
                    <label for="grossIncome">Pendapatan Kasar Bulanan / Gross Monthly Income (RM)</label>
                    <input type="number" id="grossIncome" placeholder="Gross monthly income" min="0" step="100" value="6000">
                </div>
                <div class="input-group">
                    <label for="age">Umur / Age</label>
                    <input type="number" id="age" placeholder="Your age" min="18" max="70" value="30">
                </div>
            </div>

            <!-- Malaysia Specific Options -->
            <div class="additional-options">
                <h3>Skim Perumahan Malaysia / Malaysia Housing Schemes</h3>
                <label class="checkbox-container">
                    <input type="checkbox" id="myFirstHome" onchange="toggleMyFirstHome()">
                    <span class="checkmark"></span>
                    Skim MyFirst Home (Bawah 35 tahun / Below 35 years)
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" id="pr1ma" onchange="togglePR1MA()">
                    <span class="checkmark"></span>
                    Perumahan PR1MA
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" id="firstHome" onchange="toggleFirstHome()">
                    <span class="checkmark"></span>
                    Rumah Pertamaku / First Home Buyer
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" id="bumiputera" onchange="toggleBumiputera()">
                    <span class="checkmark"></span>
                    Diskaun Bumiputera / Bumiputera Discount
                </label>
            </div>

            <!-- MyFirst Home Scheme Details -->
            <div class="myfirsthome-scheme" id="myFirstHomeSection" style="display: none;">
                <h4>Skim MyFirst Home Benefits</h4>
                <div class="scheme-benefits">
                    <p>✅ 100% financing available</p>
                    <p>✅ No down payment required</p>
                    <p>✅ Special interest rates</p>
                    <p>✅ For buyers below 35 years old</p>
                </div>
            </div>

            <!-- Islamic Financing Details -->
            <div class="islamic-financing" id="islamicSection" style="display: none;">
                <h4>Islamic Financing Type</h4>
                <select id="islamicType">
                    <option value="Murabahah">Murabahah (Cost-Plus)</option>
                    <option value="Musharakah">Musharakah Mutanaqisah</option>
                    <option value="Ijara">Ijara Thumma Al-Bai'</option>
                    <option value="Tawarruq">Commodity Murabahah</option>
                </select>
                <div class="limit-info">Sharia-compliant financing without interest</div>
            </div>

            <!-- Stamp Duty & Legal Fees Calculator -->
            <div class="stamp-duty-calculator">
                <h3>Duti Setem & Yuran Guaman / Stamp Duty & Legal Fees</h3>
                <div id="stampDutyResult" class="stamp-duty-result">
                    Jumlah Duti Setem / Total Stamp Duty: RM 0
                </div>
            </div>

            <button class="calculate-btn" onclick="calculateMYMortgage()">Kira Bayaran Bulanan / Calculate Monthly Payment</button>

            <div id="results" class="results-container" style="display: none;">
                <div class="result-header">
                    <h3>Ringkasan Pinjaman Perumahan / Home Loan Summary</h3>
                </div>
                <div class="result-grid">
                    <div class="result-card">
                        <h4>Bayaran Bulanan / Monthly Payment</h4>
                        <p id="monthlyPayment" class="result-amount">-</p>
                    </div>
                    <div class="result-card">
                        <h4>Jumlah Pinjaman / Total Loan Amount</h4>
                        <p id="totalLoan" class="result-amount">-</p>
                    </div>
                    <div class="result-card">
                        <h4>Jumlah Faedah / Total Interest</h4>
                        <p id="totalInterest" class="result-amount">-</p>
                    </div>
                    <div class="result-card">
                        <h4>Nisbah Pinjaman kepada Nilai / Loan to Value Ratio</h4>
                        <p id="ltvRatio" class="result-amount">-</p>
                    </div>
                </div>
                
                <!-- DSR Calculation -->
                <div class="dsr-calculation">
                    <h4>Nisbah Perkhidmatan Hutang / Debt Service Ratio (DSR)</h4>
                    <div class="dsr-meter">
                        <div class="dsr-fill" id="dsrFill"></div>
                    </div>
                    <p id="dsrText" class="dsr-text"></p>
                </div>

                <!-- MyFirst Home Benefits -->
                <div class="myfirsthome-benefits" id="myFirstHomeBenefits" style="display: none;">
                    <h4>Skim MyFirst Home Benefits Applied</h4>
                    <div class="benefits-list">
                        <p>✅ 100% financing approved</p>
                        <p>✅ No down payment required</p>
                        <p>✅ Special interest rate applied</p>
                        <p>✅ Extended repayment period</p>
                    </div>
                </div>

                <!-- Islamic Financing Info -->
                <div class="islamic-info" id="islamicInfo" style="display: none;">
                    <h4>Maklumat Pembiayaan Islam / Islamic Financing Details</h4>
                    <p id="islamicDescription">Pembiayaan patuh Syariah tanpa faedah / Sharia-compliant financing without interest.</p>
                </div>

                <!-- Bank Eligibility Check -->
                <div class="eligibility-check">
                    <h4>Semakan Kelayakan Bank / Bank Eligibility Check</h4>
                    <div class="eligibility-result" id="eligibilityResult">
                        Menyemak kelayakan... / Checking eligibility...
                    </div>
                </div>

                <!-- Upfront Costs Breakdown -->
                <div class="upfront-costs">
                    <h4>Kos Permulaan / Upfront Costs</h4>
                    <div class="costs-breakdown">
                        <p>Bayaran Pendahuluan / Down Payment: <span id="costsDownPayment">RM 0</span></p>
                        <p>Duti Setem / Stamp Duty: <span id="costsStampDuty">RM 0</span></p>
                        <p>Yuran Guaman / Legal Fees: <span id="costsLegal">RM 0</span></p>
                        <p>Yuran Penilaian / Valuation Fees: <span id="costsValuation">RM 0</span></p>
                        <p><strong>Jumlah Kos Permulaan / Total Upfront Costs: <span id="totalUpfrontCosts">RM 0</span></strong></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- SEO Content Section -->
        <section class="seo-content">
            <h2>Malaysia Home Loan Calculator - Calculate Housing Loan Repayment</h2>
            <p>Our comprehensive <strong>Malaysia home loan calculator</strong> helps property buyers across <strong>Kuala Lumpur, Selangor, Penang, Johor, and all Malaysian states</strong> estimate their monthly repayments. Calculate with <strong>Islamic financing options, MyFirst Home Scheme, and bank-specific rates</strong> for accurate Malaysian home loan calculations in RM.</p>
            
            <h3>Popular Home Loan Types in Malaysia</h3>
            <ul>
                <li><strong>Conventional Home Loans</strong> - Traditional interest-based loans</li>
                <li><strong>Islamic Home Financing</strong> - Sharia-compliant financing</li>
                <li><strong>Flexi Loans</strong> - Flexible repayment with withdrawal facilities</li>
                <li><strong>Semi-Flexi Loans</strong> - Limited flexibility with lower rates</li>
                <li><strong>BLR/BLR-based Loans</strong> - Base Lending Rate linked</li>
            </ul>

            <h3>Malaysia Home Loan Regulations</h3>
            <p>Malaysian home loans follow <strong>Bank Negara Malaysia (BNM) guidelines</strong> with <strong>DSR (Debt Service Ratio) limits of 60-70%, maximum loan tenure of 35 years, and strict affordability assessments</strong>. Stamp duty and legal fees are significant upfront costs.</p>

            <h3>MyFirst Home Scheme</h3>
            <p>The <strong>MyFirst Home Scheme</strong> helps young Malaysians below 35 years old purchase their first home with <strong>100% financing, no down payment, and special interest rates</strong>. This scheme is particularly beneficial for fresh graduates and young professionals.</p>

            <h3>Islamic Financing in Malaysia</h3>
            <p>Malaysia offers comprehensive <strong>Sharia-compliant financing options</strong> including <strong>Murabahah, Musharakah Mutanaqisah, Ijara, and other Islamic principles</strong>. These financing methods avoid interest (riba) and are based on profit-sharing or cost-plus arrangements.</p>
        </section>

        <!-- VIP Backlinks Footer -->
        <footer class="seo-footer">
            <div class="footer-links">
                <h4>Southeast Asian Mortgage Calculators</h4>
                <a href="https://90storezon.com/calculators/01-loan-emi-calculator/malaysia.php">Malaysia Home Loan Calculator</a> |
                <a href="https://90storezon.com/calculators/01-loan-emi-calculator/singapore.php">Singapore Mortgage Calculator</a> |
                <a href="https://90storezon.com/calculators/01-loan-emi-calculator/indonesia.php">Indonesia Mortgage Calculator</a> |
                <a href="https://90storezon.com/calculators/01-loan-emi-calculator/thailand.php">Thailand Mortgage Calculator</a>
            </div>
            
            <div class="external-links">
                <h4>Malaysian Home Loan Resources</h4>
                <a href="https://www.bnm.gov.my" rel="nofollow">Bank Negara Malaysia</a> |
                <a href="https://www.maybank2u.com.my" rel="nofollow">Maybank Home Loans</a> |
                <a href="https://www.cimb.com.my" rel="nofollow">CIMB Bank</a> |
                <a href="https://www.pbebank.com" rel="nofollow">Public Bank</a>
            </div>
        </footer>
    </div>

    <script>
    function calculateMYMortgage() {
        const propertyValue = parseFloat(document.getElementById('propertyValue').value);
        let downPayment = parseFloat(document.getElementById('downPayment').value);
        const loanTerm = parseInt(document.getElementById('loanTerm').value);
        let interestRate = parseFloat(document.getElementById('interestRate').value);
        const grossIncome = parseFloat(document.getElementById('grossIncome').value) || 0;
        const age = parseInt(document.getElementById('age').value) || 30;
        const isMyFirstHome = document.getElementById('myFirstHome').checked;
        const isIslamic = document.getElementById('loanType').value === 'Islamic';
        const isFirstHome = document.getElementById('firstHome').checked;
        const isBumiputera = document.getElementById('bumiputera').checked;

        if (!propertyValue || !downPayment || !loanTerm || !interestRate) {
            alert('Sila isi semua medan yang diperlukan / Please fill all required fields');
            return;
        }

        // Apply MyFirst Home Scheme benefits
        if (isMyFirstHome && age < 35) {
            downPayment = 0; // No down payment for MyFirst Home
            interestRate -= 0.5; // 0.5% discount
            document.getElementById('myFirstHomeBenefits').style.display = 'block';
        } else {
            document.getElementById('myFirstHomeBenefits').style.display = 'none';
        }

        // Apply Bumiputera discount
        if (isBumiputera) {
            // 5-15% discount on property price (implementation varies)
            document.getElementById('bumiputeraDiscount').style.display = 'block';
        }

        let loanAmount = propertyValue - downPayment;
        const months = loanTerm * 12;
        const monthlyRate = interestRate / 12 / 100;

        // Calculate monthly payment
        const monthlyPayment = loanAmount * monthlyRate * Math.pow(1 + monthlyRate, months) / 
                              (Math.pow(1 + monthlyRate, months) - 1);

        const totalInterest = (monthlyPayment * months) - loanAmount;
        const ltvRatio = (loanAmount / propertyValue * 100).toFixed(1);

        // Update results
        document.getElementById('monthlyPayment').textContent = 'RM ' + monthlyPayment.toFixed(2);
        document.getElementById('totalLoan').textContent = 'RM ' + loanAmount.toLocaleString('en-MY');
        document.getElementById('totalInterest').textContent = 'RM ' + totalInterest.toLocaleString('en-MY');
        document.getElementById('ltvRatio').textContent = ltvRatio + '%';

        // DSR Calculation (Malaysian requirement: typically 60-70%)
        let dsrRatio = 0;
        if (grossIncome > 0) {
            dsrRatio = (monthlyPayment / grossIncome * 100);
        }

        const dsrFill = document.getElementById('dsrFill');
        const dsrText = document.getElementById('dsrText');
        
        dsrFill.style.width = Math.min(dsrRatio, 100) + '%';
        
        if (dsrRatio <= 60) {
            dsrFill.style.background = '#28a745';
            dsrText.textContent = `DSR: ${dsrRatio.toFixed(1)}% - Baik / Good (Below 60%)`;
        } else if (dsrRatio <= 70) {
            dsrFill.style.background = '#ffc107';
            dsrText.textContent = `DSR: ${dsrRatio.toFixed(1)}% - Boleh Diterima / Acceptable (60-70%)`;
        } else {
            dsrFill.style.background = '#dc3545';
            dsrText.textContent = `DSR: ${dsrRatio.toFixed(1)}% - Tinggi / High (Above 70%)`;
        }

        // Islamic Financing Info
        if (isIslamic) {
            const islamicType = document.getElementById('islamicType').value;
            let description = '';
            switch(islamicType) {
                case 'Murabahah':
                    description = 'Pembiayaan kos-tambah berdasarkan prinsip jual beli / Cost-plus financing based on sale principle';
                    break;
                case 'Musharakah':
                    description = 'Perkongsian berkurangan untuk pemilikan harta / Diminishing partnership for property ownership';
                    break;
                case 'Ijara':
                    description = 'Sewa dengan opsyen untuk memiliki / Lease with option to own';
                    break;
                case 'Tawarruq':
                    description = 'Pembiayaan komoditi berdasarkan jual beli / Commodity-based financing through sale';
                    break;
            }
            document.getElementById('islamicDescription').textContent = description;
            document.getElementById('islamicInfo').style.display = 'block';
        } else {
            document.getElementById('islamicInfo').style.display = 'none';
        }

        // Bank Eligibility Check
        updateEligibilityCheck(dsrRatio, ltvRatio, age, grossIncome);

        // Upfront Costs Breakdown
        updateUpfrontCosts(propertyValue, downPayment);

        document.getElementById('results').style.display = 'block';
    }

    function updateBankRate() {
        const bank = document.getElementById('bank').value;
        let rate = 3.8;
        let info = 'Conventional Loan: 3.8% - 4.8%';

        switch(bank) {
            case 'Maybank':
                rate = 3.8;
                info = 'Maybank Home Loan: 3.8% - 4.8%';
                break;
            case 'CIMB':
                rate = 3.85;
                info = 'CIMB Home Loan: 3.85% - 4.85%';
                break;
            case 'Public Bank':
                rate = 3.75;
                info = 'Public Bank Home Loan: 3.75% - 4.75%';
                break;
            case 'RHB':
                rate = 3.9;
                info = 'RHB Home Loan: 3.9% - 4.9%';
                break;
            case 'Hong Leong':
                rate = 3.88;
                info = 'Hong Leong Home Loan: 3.88% - 4.88%';
                break;
            case 'AmBank':
                rate = 3.95;
                info = 'AmBank Home Loan: 3.95% - 4.95%';
                break;
        }

        document.getElementById('interestRate').value = rate;
        document.getElementById('interestRateInfo').textContent = info;
    }

    function updateLoanType() {
        const loanType = document.getElementById('loanType').value;
        const isIslamic = loanType === 'Islamic';
        
        document.getElementById('islamicSection').style.display = isIslamic ? 'block' : 'none';
        
        if (isIslamic) {
            document.getElementById('interestRateInfo').textContent = 'Islamic Financing: 3.9% - 4.9%';
            document.getElementById('interestRate').value = 3.9;
        } else {
            document.getElementById('interestRateInfo').textContent = 'Conventional Loan: 3.8% - 4.8%';
            document.getElementById('interestRate').value = 3.8;
        }
    }

    function updateEligibilityCheck(dsrRatio, ltvRatio, age, grossIncome) {
        const eligibilityResult = document.getElementById('eligibilityResult');
        let eligibility = '';
        let eligibilityClass = '';

        if (dsrRatio > 70) {
            eligibility = '❌ Mungkin tidak memenuhi kriteria kelayakan bank (DSR > 70%) / May not meet bank eligibility criteria (DSR > 70%)';
            eligibilityClass = 'eligibility-fail';
        } else if (age > 65) {
            eligibility = '⚠️ Tempoh pinjaman mungkin terhad disebabkan umur / Loan term may be limited due to age';
            eligibilityClass = 'eligibility-warning';
        } else if (grossIncome < 3000) {
            eligibility = '⚠️ Pendapatan mungkin di bawah keperluan minimum bank / Income may be below bank minimum requirements';
            eligibilityClass = 'eligibility-warning';
        } else {
            eligibility = '✅ Kemungkinan memenuhi kriteria kelayakan bank / Likely meets bank eligibility criteria';
            eligibilityClass = 'eligibility-pass';
        }

        eligibilityResult.textContent = eligibility;
        eligibilityResult.className = 'eligibility-result ' + eligibilityClass;
    }

    function updateUpfrontCosts(propertyValue, downPayment) {
        // Calculate Malaysian stamp duty (progressive rates)
        let stampDuty = 0;
        if (propertyValue <= 100000) {
            stampDuty = propertyValue * 0.01; // 1% for first RM100,000
        } else if (propertyValue <= 500000) {
            stampDuty = 1000 + (propertyValue - 100000) * 0.02; // 2% for next RM400,000
        } else {
            stampDuty = 9000 + (propertyValue - 500000) * 0.03; // 3% for remainder
        }

        // Other costs (simplified)
        const legalFees = Math.max(500, propertyValue * 0.01); // Minimum RM500 or 1%
        const valuationFees = Math.max(300, propertyValue * 0.002); // Minimum RM300 or 0.2%

        const totalUpfront = downPayment + stampDuty + legalFees + valuationFees;

        // Update costs display
        document.getElementById('costsDownPayment').textContent = 'RM ' + downPayment.toLocaleString('en-MY');
        document.getElementById('costsStampDuty').textContent = 'RM ' + Math.round(stampDuty).toLocaleString('en-MY');
        document.getElementById('costsLegal').textContent = 'RM ' + Math.round(legalFees).toLocaleString('en-MY');
        document.getElementById('costsValuation').textContent = 'RM ' + Math.round(valuationFees).toLocaleString('en-MY');
        document.getElementById('totalUpfrontCosts').textContent = 'RM ' + Math.round(totalUpfront).toLocaleString('en-MY');

        // Update stamp duty result
        document.getElementById('stampDutyResult').textContent = 
            'Jumlah Duti Setem / Total Stamp Duty: RM ' + Math.round(stampDuty).toLocaleString('en-MY');
    }

    function toggleMyFirstHome() {
        const isMyFirstHome = document.getElementById('myFirstHome').checked;
        const age = parseInt(document.getElementById('age').value) || 0;
        
        document.getElementById('myFirstHomeSection').style.display = (isMyFirstHome && age < 35) ? 'block' : 'none';
        
        if (isMyFirstHome && age < 35) {
            document.getElementById('downPayment').value = 0;
            updateDownPaymentPercent();
        }
    }

    function togglePR1MA() {
        // PR1MA scheme specific adjustments
        const isPR1MA = document.getElementById('pr1ma').checked;
        if (isPR1MA) {
            // Adjust for affordable housing scheme
            document.getElementById('interestRate').value = 3.5; // Lower rate for PR1MA
            document.getElementById('interestRateInfo').textContent = 'PR1MA Scheme: 3.5% - 4.0%';
        }
    }

    function toggleFirstHome() {
        // First home buyer benefits
        calculateStampDuty();
    }

    function toggleBumiputera() {
        // Bumiputera discount implementation
        calculateStampDuty();
    }

    function calculateStampDuty() {
        const propertyValue = parseFloat(document.getElementById('propertyValue').value) || 0;
        updateUpfrontCosts(propertyValue, parseFloat(document.getElementById('downPayment').value) || 0);
    }

    // Update calculations when inputs change
    document.getElementById('propertyValue').addEventListener('input', updateCalculations);
    document.getElementById('downPayment').addEventListener('input', updateCalculations);
    document.getElementById('age').addEventListener('input', toggleMyFirstHome);

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
    .myfirsthome-benefits {
        background: #e8f5e8;
        padding: 15px;
        border-radius: 8px;
        margin: 15px 0;
        border-left: 4px solid #28a745;
    }
    .upfront-costs {
        background: #e8f4fd;
        padding: 15px;
        border-radius: 8px;
        margin: 15px 0;
        border-left: 4px solid #17a2b8;
    }
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
    .islamic-financing {
        background: #f0f8ff;
        padding: 15px;
        border-radius: 8px;
        margin: 10px 0;
        border-left: 4px solid #007bff;
    }
    </style>
<?php include '../../footer.php'; ?>