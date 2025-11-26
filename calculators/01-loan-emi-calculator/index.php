<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multi-Country Loan Calculator | Calculate EMI for Home, Car & Personal Loans</title>
    <meta name="description" content="Free online multi-country loan calculator to estimate your monthly EMI payments. Calculate EMIs for home loans, car loans & personal loans in Saudi Arabia, UAE, USA, UK, Canada, China, Pakistan, India, Australia, Germany & Singapore. Get instant results with amortization schedule.">
    <meta name="keywords" content="EMI calculator, loan calculator, monthly payment calculator, home loan EMI, car loan calculator, personal loan EMI, loan interest calculator, loan payment calculator, SAR loan calculator, AED loan calculator, GBP loan calculator, USD loan calculator, CAD loan calculator, CNY loan calculator, PKR loan calculator, INR loan calculator, AUD loan calculator, EUR loan calculator, SGD loan calculator">
    <meta name="author" content="90storezon">
    <meta name="robots" content="index, follow">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://90storezon.com/calculators/01-loan-emi-calculator/">
    <meta property="og:title" content="Multi-Country Loan Calculator | Calculate EMI for Home, Car & Personal Loans">
    <meta property="og:description" content="Free online multi-country loan calculator to estimate your monthly EMI payments. Calculate EMIs for home loans, car loans & personal loans in Saudi Arabia, UAE, USA, UK, Canada, China, Pakistan, India, Australia, Germany & Singapore.">
    <meta property="og:image" content="https://90storezon.com/assets/images/emi-calculator-og.jpg">
    
    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Multi-Country Loan Calculator | Calculate EMI for Home, Car & Personal Loans">
    <meta name="twitter:description" content="Free online multi-country loan calculator to estimate your monthly EMI payments. Calculate EMIs for home loans, car loans & personal loans in 10+ countries.">
    <meta name="twitter:image" content="https://90storezon.com/assets/images/emi-calculator-twitter.jpg">
    
    <link rel="canonical" href="https://90storezon.com/calculators/01-loan-emi-calculator/">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Schema.org for rich snippets -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebPage",
      "name": "Multi-Country Loan Calculator | Calculate EMI for Home, Car & Personal Loans",
      "description": "Free online multi-country loan calculator to estimate your monthly EMI payments. Calculate EMIs for home loans, car loans & personal loans in Saudi Arabia, UAE, USA, UK, Canada, China, Pakistan, India, Australia, Germany & Singapore.",
      "url": "https://www.90storezon.com/calculators/01-loan-emi-calculator/",
      "mainEntity": {
        "@type": "FAQPage",
        "mainEntity": [{
          "@type": "Question",
          "name": "What is an EMI?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "EMI (Equated Monthly Installment) is a fixed payment amount made by a borrower to a lender at a specified date each calendar month."
          }
        }, {
          "@type": "Question",
          "name": "How does the interest rate affect my EMI?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Higher interest rates increase your EMI amount and total interest paid, while lower rates reduce both. Even a 0.5% difference can significantly impact your total payment."
          }
        }, {
          "@type": "Question",
          "name": "How do I calculate loan EMI?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Loan EMI is calculated using the formula: EMI = [P x R x (1+R)^N]/[(1+R)^N-1] where P is principal loan amount, R is monthly interest rate, and N is loan tenure in months."
          }
        }, {
          "@type": "Question",
          "name": "What is the difference between fixed and reducing interest rates?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "In fixed rate loans, the interest rate remains constant throughout the loan tenure. In reducing rate loans, interest is calculated on the outstanding principal amount, which decreases with each EMI payment."
          }
        }, {
          "@type": "Question",
          "name": "Can I use this calculator for different countries?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Yes, our multi-country loan calculator supports 10+ countries including Saudi Arabia, UAE, USA, UK, Canada, China, Pakistan, India, Australia, Germany, and Singapore with country-specific interest rates and currency symbols."
          }
        }, {
          "@type": "Question",
          "name": "What is included in the amortization schedule?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "The amortization schedule shows the breakdown of each EMI payment into principal and interest components, the remaining loan balance after each payment, and the total interest paid over the loan tenure."
          }
        }]
      }
    }
    </script>
</head>
<body>
    <?php include '../../header.php'; ?>
    <div class="vip-container">
        <header class="vip-header">
            <h1><i class="fas fa-calculator"></i> Multi-Country Loan Calculator</h1>
            <p class="subtitle">Calculate your monthly loan payments in 10+ countries with our accurate EMI calculator</p>
        </header>

        <!-- Google Ads Slot -->
        <div class="ad-slot top-ad">
            [AD_TOP_BANNER]
        </div>

        <div class="calculator-container">
            <div class="input-group">
                <label for="country"><i class="fas fa-globe-americas"></i> Select Country</label>
                <div class="country-select-wrapper">
                    <select id="country" onchange="updateCountrySettings()">
                        <option value="SA" data-currency="SAR" data-rate="7.5" data-min="10000" data-max="5000000" data-tenure-min="12" data-tenure-max="360">🇸🇦 Saudi Arabia (SAR)</option>
                        <option value="AE" data-currency="AED" data-rate="6.5" data-min="50000" data-max="10000000" data-tenure-min="12" data-tenure-max="360">🇦🇪 United Arab Emirates (AED)</option>
                        <option value="GB" data-currency="GBP" data-rate="4.5" data-min="1000" data-max="2000000" data-tenure-min="12" data-tenure-max="360">🇬🇧 United Kingdom (GBP)</option>
                        <option value="US" data-currency="USD" data-rate="5.5" data-min="1000" data-max="5000000" data-tenure-min="12" data-tenure-max="360">🇺🇸 United States (USD)</option>
                        <option value="CA" data-currency="CAD" data-rate="6.0" data-min="1000" data-max="3000000" data-tenure-min="12" data-tenure-max="360">🇨🇦 Canada (CAD)</option>
                        <option value="CN" data-currency="CNY" data-rate="4.8" data-min="10000" data-max="10000000" data-tenure-min="12" data-tenure-max="360">🇨🇳 China (CNY)</option>
                        <option value="PK" data-currency="PKR" data-rate="15.0" data-min="10000" data-max="50000000" data-tenure-min="12" data-tenure-max="360">🇵🇰 Pakistan (PKR)</option>
                        <option value="IN" data-currency="INR" data-rate="9.5" data-min="10000" data-max="100000000" data-tenure-min="12" data-tenure-max="360">🇮🇳 India (INR)</option>
                        <option value="AU" data-currency="AUD" data-rate="6.2" data-min="1000" data-max="3000000" data-tenure-min="12" data-tenure-max="360">🇦🇺 Australia (AUD)</option>
                        <option value="DE" data-currency="EUR" data-rate="3.5" data-min="1000" data-max="2000000" data-tenure-min="12" data-tenure-max="360">🇩🇪 Germany (EUR)</option>
                        <option value="SG" data-currency="SGD" data-rate="4.0" data-min="1000" data-max="5000000" data-tenure-min="12" data-tenure-max="360">🇸🇬 Singapore (SGD)</option>
                    </select>
                </div>
            </div>

            <div class="input-group">
                <label for="loanAmount"><i class="fas fa-money-bill-wave"></i> Loan Amount (<span id="currencySymbol">$</span>)</label>
                <input type="number" id="loanAmount" placeholder="Enter loan amount" min="0">
            </div>

            <div class="input-group">
                <label for="interestRate"><i class="fas fa-percentage"></i> Interest Rate (% per year)</label>
                <input type="number" id="interestRate" placeholder="Enter interest rate" min="0" step="0.1">
            </div>

            <div class="input-group">
                <label for="loanTenure"><i class="fas fa-calendar-alt"></i> Loan Tenure</label>
                <div class="tenure-input">
                    <input type="number" id="loanTenure" placeholder="Enter tenure" min="1">
                    <select id="tenureType">
                        <option value="years">Years</option>
                        <option value="months">Months</option>
                    </select>
                </div>
            </div>

            <button class="calculate-btn" onclick="calculateEMI()">
                <i class="fas fa-calculator"></i> Calculate EMI
            </button>

            <div class="result-container" id="resultContainer" style="display: none;">
                <h3><i class="fas fa-chart-bar"></i> Calculation Results</h3>
                <div class="result-item">
                    <span>Monthly EMI:</span>
                    <span id="monthlyEMI">$0</span>
                </div>
                <div class="result-item">
                    <span>Total Interest:</span>
                    <span id="totalInterest">$0</span>
                </div>
                <div class="result-item total-amount">
                    <span>Total Amount:</span>
                    <span id="totalAmount">$0</span>
                </div>
            </div>

            <div class="amortization-container" id="amortizationContainer" style="display: none;">
                <h3><i class="fas fa-table"></i> Amortization Schedule</h3>
                <div class="table-container">
                    <table id="amortizationTable">
                        <thead>
                            <tr>
                                <th>Month</th>
                                <th>EMI</th>
                                <th>Principal</th>
                                <th>Interest</th>
                                <th>Balance</th>
                            </tr>
                        </thead>
                        <tbody id="amortizationBody">
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Google Ads Slot -->
            <div class="ad-slot middle-ad">
                [AD_MIDDLE_BANNER]
            </div>

            <div class="backlink-paragraph">
                <p>Loan calculation for Saudi Arabia, UAE, USA, UK, Canada, China, Pakistan, India, Australia, Germany, and Singapore. Our <a href="/calculators/04-mortgage-calculator/">mortgage calculator</a> helps with home loans, while our <a href="/calculators/05-compound-interest-calculator/">compound interest calculator</a> shows investment growth. For financial planning, use our <a href="/calculators/11-investment-calculator/">investment calculator</a> and <a href="/calculators/10-retirement-planner/">retirement planner</a>. Compare loan options with our <a href="/calculators/01-loan-emi-calculator/">EMI calculator</a>, calculate taxes with our <a href="/calculators/09-tax-calculator/">tax calculator</a>, and manage budgets with our <a href="/calculators/13-budget-planner/">budget planner</a>. For business loans, our <a href="/calculators/01-loan-emi-calculator/">business loan calculator</a> provides accurate estimates. International users can calculate loans in <a href="/calculators/01-loan-emi-calculator/">SAR</a>, <a href="/calculators/01-loan-emi-calculator/">AED</a>, <a href="/calculators/01-loan-emi-calculator/">GBP</a>, <a href="/calculators/01-loan-emi-calculator/">USD</a>, <a href="/calculators/01-loan-emi-calculator/">CAD</a>, <a href="/calculators/01-loan-emi-calculator/">CNY</a>, <a href="/calculators/01-loan-emi-calculator/">PKR</a>, <a href="/calculators/01-loan-emi-calculator/">INR</a>, <a href="/calculators/01-loan-emi-calculator/">AUD</a>, <a href="/calculators/01-loan-emi-calculator/">EUR</a>, and <a href="/calculators/01-loan-emi-calculator/">SGD</a>.</p>
                <p>Backlink: <a href="https://90storezon.com">90storezon</a></p>
            </div>
        </div>

        <!-- Google Ads Slot -->
        <div class="ad-slot bottom-ad">
            [AD_BOTTOM_BANNER]
        </div>
    </div>

    <script src="script.js"></script>
    <style>
        /* Benefits Section */
        .benefits-section {
            max-width: 800px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .benefits-section h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        .benefits-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .benefit-item {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            border: 1px solid #e9ecef;
        }

        .benefit-item h3 {
            margin-bottom: 10px;
            color: #333;
        }

        /* Formula Explanation */
        .formula-section {
            max-width: 800px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .formula-section h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        .formula-box {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 10px;
            border: 1px solid #e9ecef;
        }

        .formula-box h3 {
            margin-bottom: 15px;
            color: #333;
        }

        .formula-box ul {
            margin-top: 15px;
            padding-left: 20px;
        }

        .formula-box li {
            margin-bottom: 8px;
        }

        /* Example Calculation */
        .example-section {
            max-width: 800px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .example-section h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        .example-box {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 10px;
            border: 1px solid #e9ecef;
        }

        .example-box h3 {
            margin-bottom: 15px;
            color: #333;
        }

        .example-result p {
            margin-bottom: 10px;
            font-size: 1.1rem;
        }

        /* FAQ Section */
        .faq-section {
            max-width: 800px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .faq-section h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        .faq-item {
            margin-bottom: 25px;
            padding-bottom: 25px;
            border-bottom: 1px solid #e9ecef;
        }

        .faq-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .faq-item h3 {
            margin-bottom: 10px;
            color: #333;
        }

        /* Related Calculators */
        .related-calculators {
            max-width: 800px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .related-calculators h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        .calculator-links {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            justify-content: center;
        }

        .calculator-link {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 12px 20px;
            background: #333;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .calculator-link:hover {
            background: #000;
            transform: translateY(-2px);
        }

        /* Financial Decisions */
        .financial-decisions {
            max-width: 800px;
            margin: 40px auto;
            padding: 0 20px;
            text-align: center;
        }

        .financial-decisions h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .financial-decisions p {
            font-size: 1.1rem;
            line-height: 1.6;
        }

        /* Amortization Table */
        .amortization-container h3 {
            margin-bottom: 15px;
            color: #333;
        }

        .table-container {
            max-height: 400px;
            overflow-y: auto;
        }

        #amortizationTable {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.9rem;
        }

        #amortizationTable th {
            background: #333333;
            color: white;
            padding: 10px;
            text-align: left;
            position: sticky;
            top: 0;
        }

        #amortizationTable td {
            padding: 8px 10px;
            border-bottom: 1px solid #e0e0e0;
        }

        #amortizationTable tr:nth-child(even) {
            background-color: #f5f5f5;
        }

        #amortizationTable tr:hover {
            background-color: #e0e0e0;
        }

        /* Backlink Paragraph */
        .backlink-paragraph {
            margin-top: 30px;
            padding: 20px;
            background: #f5f5f5;
            border-radius: 10px;
            font-size: 0.9rem;
            line-height: 1.6;
            border: 1px solid #e0e0e0;
        }

        .backlink-paragraph a {
            color: #000000;
            text-decoration: underline;
        }

        .backlink-paragraph a:hover {
            color: #333333;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .benefits-grid {
                grid-template-columns: 1fr;
            }
            
            .calculator-links {
                flex-direction: column;
            }
            
            .calculator-links a {
                text-align: center;
            }
            
            .formula-section, .example-section {
                padding: 1rem;
            }
            
            /* Fix for mobile calculator display */
            .calculator-container {
                margin: 10px;
                padding: 15px;
            }
            
            .result-container {
                width: 100%;
                box-sizing: border-box;
            }
            
            .result-container.show {
                display: block !important;
            }
            
            /* Fix for bold text not appearing properly on mobile */
            .total-amount {
                font-weight: bold !important;
                -webkit-font-smoothing: antialiased;
                -moz-osx-font-smoothing: grayscale;
            }
            
            .result-item {
                font-weight: 500;
                -webkit-font-smoothing: antialiased;
                -moz-osx-font-smoothing: grayscale;
            }
        }
    </style>
    <?php include '../../footer.php'; ?>
</body>
</html>