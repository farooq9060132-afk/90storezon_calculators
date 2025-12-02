<?php
// Include your website's header
include '../../header.php';
?>

<style>
/* Payment Calculator Styles */
.calculator-container {
    max-width: 1200px;
    margin: 30px auto;
    padding: 0 20px;
    font-family: Arial, sans-serif;
}

.breadcrumb {
    font-size: 14px;
    color: #5f6368;
    margin-bottom: 20px;
}

.breadcrumb a {
    color: #0052FF;
    text-decoration: none;
}

.breadcrumb a:hover {
    text-decoration: underline;
}

.breadcrumb span {
    color: #5f6368;
    margin: 0 5px;
}

.calculator-title {
    font-size: 32px;
    font-weight: bold;
    color: #202124;
    margin-bottom: 20px;
}

.print-btn {
    background: #f8f9fa;
    border: 1px solid #dadce0;
    border-radius: 6px;
    padding: 8px 16px;
    font-size: 14px;
    color: #202124;
    cursor: pointer;
    float: right;
    margin-top: 10px;
}

.print-btn:hover {
    background: #e8eaed;
}

.calculator-section {
    background: #ffffff;
    border: 1px solid #dadce0;
    border-radius: 8px;
    padding: 30px;
    margin-bottom: 30px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.tabs {
    display: flex;
    border-bottom: 1px solid #dadce0;
    margin-bottom: 30px;
}

.tab {
    padding: 12px 24px;
    cursor: pointer;
    font-weight: 500;
    color: #5f6368;
    border-bottom: 3px solid transparent;
    transition: all 0.3s ease;
}

.tab.active {
    color: #0052FF;
    border-bottom: 3px solid #0052FF;
}

.tab:hover:not(.active) {
    color: #202124;
    background: #f8f9fa;
}

.tab-content {
    display: none;
}

.tab-content.active {
    display: block;
}

.input-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
    margin-bottom: 25px;
}

.input-group {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
}

.input-group label {
    min-width: 150px;
    font-size: 15px;
    color: #202124;
    margin-right: 15px;
}

.input-wrapper {
    display: flex;
    align-items: center;
    gap: 8px;
}

.input-wrapper input {
    padding: 10px 12px;
    border: 1px solid #dadce0;
    border-radius: 4px;
    font-size: 15px;
    width: 120px;
}

.input-wrapper select {
    padding: 10px 12px;
    border: 1px solid #dadce0;
    border-radius: 4px;
    font-size: 15px;
    width: 120px;
    background: white;
}

.input-wrapper span {
    font-size: 15px;
    color: #5f6368;
}

.calculate-btn {
    background: #0052FF;
    color: white;
    border: none;
    border-radius: 6px;
    padding: 12px 24px;
    font-size: 16px;
    font-weight: 500;
    cursor: pointer;
    transition: background-color 0.2s ease;
    margin-top: 20px;
}

.calculate-btn:hover {
    background: #0041cc;
}

.results-section {
    background: #f8f9fa;
    border-radius: 8px;
    padding: 25px;
    margin-top: 30px;
    border: 1px solid #dadce0;
}

.result-title {
    font-size: 20px;
    color: #202124;
    margin-bottom: 20px;
}

.monthly-pay {
    font-size: 24px;
    font-weight: bold;
    color: #0052FF;
    text-align: center;
    margin: 15px 0;
}

.save-btn {
    background: #0052FF;
    color: white;
    border: none;
    border-radius: 6px;
    padding: 10px 20px;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    display: block;
    margin: 15px auto;
    transition: background-color 0.2s ease;
}

.save-btn:hover {
    background: #0041cc;
}

.payment-summary {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 15px;
    margin: 25px 0;
}

.summary-item {
    background: #ffffff;
    border: 1px solid #dadce0;
    border-radius: 6px;
    padding: 15px;
    text-align: center;
}

.summary-label {
    font-size: 14px;
    color: #5f6368;
    margin-bottom: 8px;
}

.summary-value {
    font-size: 16px;
    font-weight: bold;
    color: #202124;
}

.chart-container {
    margin: 30px 0;
    text-align: center;
}

.chart-title {
    font-size: 18px;
    color: #202124;
    margin-bottom: 20px;
}

.pie-chart {
    width: 200px;
    height: 200px;
    border-radius: 50%;
    margin: 0 auto;
    position: relative;
    background: conic-gradient(#0052FF 66%, #FF6B6B 0 100%);
}

.chart-legend {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 20px;
    margin-top: 20px;
}

.legend-item {
    display: flex;
    align-items: center;
    gap: 8px;
}

.legend-color {
    width: 16px;
    height: 16px;
    border-radius: 4px;
}

.legend-principal {
    background: #0052FF;
}

.legend-interest {
    background: #FF6B6B;
}

.legend-label {
    font-size: 14px;
    color: #5f6368;
}

.amortization-section {
    margin-top: 40px;
}

.amortization-section h3 {
    font-size: 20px;
    color: #202124;
    margin-bottom: 20px;
}

.amortization-chart {
    height: 300px;
    margin: 20px 0;
    position: relative;
    border: 1px solid #dadce0;
    border-radius: 8px;
    background: #f8f9fa;
}

.schedule-section {
    margin-top: 30px;
}

.schedule-section h3 {
    font-size: 20px;
    color: #202124;
    margin-bottom: 20px;
}

.schedule-tabs {
    display: flex;
    border-bottom: 1px solid #dadce0;
    margin-bottom: 20px;
}

.schedule-tab {
    padding: 10px 20px;
    cursor: pointer;
    font-weight: 500;
    color: #5f6368;
    border-bottom: 3px solid transparent;
}

.schedule-tab.active {
    color: #0052FF;
    border-bottom: 3px solid #0052FF;
}

.schedule-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 14px;
}

.schedule-table th {
    background: #f8f9fa;
    padding: 12px 15px;
    text-align: left;
    border: 1px solid #dadce0;
    font-weight: 500;
    color: #202124;
}

.schedule-table td {
    padding: 10px 15px;
    border: 1px solid #dadce0;
    color: #202124;
}

.schedule-table tr:nth-child(even) {
    background: #f8f9fa;
}

.content-section {
    background: #ffffff;
    border: 1px solid #dadce0;
    border-radius: 8px;
    padding: 30px;
    margin-bottom: 30px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.content-section h2 {
    font-size: 24px;
    color: #202124;
    margin-top: 0;
    margin-bottom: 20px;
}

.content-section h3 {
    font-size: 20px;
    color: #202124;
    margin-top: 25px;
    margin-bottom: 15px;
}

.content-section p {
    font-size: 16px;
    color: #5f6368;
    line-height: 1.6;
    margin-bottom: 15px;
}

.content-section ul {
    padding-left: 20px;
    margin-bottom: 20px;
}

.content-section li {
    margin-bottom: 10px;
    line-height: 1.5;
}

.formula-section {
    background: #f8f9fa;
    border-radius: 8px;
    padding: 20px;
    margin: 20px 0;
}

.formula {
    font-family: monospace;
    font-size: 16px;
    text-align: center;
    margin: 15px 0;
    padding: 15px;
    background: #ffffff;
    border: 1px solid #dadce0;
    border-radius: 6px;
}

.related-calculators {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
    margin-top: 20px;
}

.related-link {
    color: #0052FF;
    text-decoration: none;
    font-size: 16px;
    font-weight: 500;
}

.related-link:hover {
    text-decoration: underline;
}

/* Desktop Styles */
@media (min-width: 769px) {
    .input-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .payment-summary {
        grid-template-columns: repeat(3, 1fr);
    }
}

/* Mobile Styles */
@media (max-width: 768px) {
    .calculator-container {
        padding: 0 15px;
        margin: 20px auto;
    }
    
    .calculator-title {
        font-size: 28px;
    }
    
    .print-btn {
        float: none;
        margin-top: 0;
        margin-bottom: 15px;
    }
    
    .tabs {
        flex-wrap: wrap;
    }
    
    .tab {
        padding: 10px 15px;
        font-size: 14px;
    }
    
    .input-grid {
        grid-template-columns: 1fr;
    }
    
    .input-group {
        flex-direction: column;
        align-items: flex-start;
        margin-bottom: 20px;
    }
    
    .input-group label {
        margin-bottom: 8px;
        min-width: auto;
    }
    
    .input-wrapper {
        width: 100%;
    }
    
    .input-wrapper input, .input-wrapper select {
        width: 100%;
        flex: 1;
    }
    
    .calculator-section, .content-section {
        padding: 20px;
    }
    
    .payment-summary {
        grid-template-columns: 1fr 1fr;
    }
    
    .chart-legend {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }
    
    .schedule-tabs {
        flex-wrap: wrap;
    }
    
    .schedule-tab {
        padding: 8px 12px;
        font-size: 14px;
    }
}

@media (max-width: 480px) {
    .calculator-container {
        padding: 0 10px;
        margin: 15px auto;
    }
    
    .calculator-title {
        font-size: 24px;
    }
    
    .input-group label {
        font-size: 14px;
    }
    
    .input-wrapper input, .input-wrapper select {
        font-size: 14px;
        padding: 8px 10px;
    }
    
    .calculate-btn, .save-btn {
        width: 100%;
        padding: 12px;
        font-size: 15px;
    }
    
    .payment-summary {
        grid-template-columns: 1fr;
    }
    
    .pie-chart {
        width: 150px;
        height: 150px;
    }
}
</style>

<div class="calculator-container">
    <div class="breadcrumb">
        <a href="/">Home</a>
        <span>/</span>
        <a href="/calculators/">Calculators</a>
        <span>/</span>
        <a href="/calculators/financial/">Financial</a>
        <span>/</span>
        <span>Payment Calculator</span>
    </div>
    
    <h1 class="calculator-title">Payment Calculator</h1>
    <button class="print-btn" onclick="window.print()">Print</button>
    
    <div class="calculator-section">
        <p>The Payment Calculator can determine the monthly payment amount or loan term for a fixed interest loan. Use the "Fixed Term" tab to calculate the monthly payment of a fixed-term loan. Use the "Fixed Payments" tab to calculate the time to pay off a loan with a fixed monthly payment. For more information about or to do calculations specifically for car payments, please use the Auto Loan Calculator. To find net payment of salary after taxes and deductions, use the Take-Home-Pay Calculator.</p>
        
        <p>Modify the values and click the calculate button to use</p>
        
        <div class="tabs">
            <div class="tab active" data-tab="fixed-term">Fixed Term</div>
            <div class="tab" data-tab="fixed-payments">Fixed Payments</div>
        </div>
        
        <div class="tab-content active" id="fixed-term-tab">
            <div class="input-grid">
                <div class="input-group">
                    <label>Loan Amount</label>
                    <div class="input-wrapper">
                        <input type="number" id="loan-amount-term" value="200000" min="0" step="1000">
                    </div>
                </div>
                
                <div class="input-group">
                    <label>Loan Term</label>
                    <div class="input-wrapper">
                        <input type="number" id="loan-term" value="15" min="1" max="50">
                        <span>years</span>
                    </div>
                </div>
                
                <div class="input-group">
                    <label>Interest Rate</label>
                    <div class="input-wrapper">
                        <input type="number" id="interest-rate-term" value="6" min="0" step="0.01">
                        <span>%</span>
                    </div>
                </div>
            </div>
            
            <button class="calculate-btn" onclick="calculateFixedTerm()">Calculate</button>
        </div>
        
        <div class="tab-content" id="fixed-payments-tab">
            <div class="input-grid">
                <div class="input-group">
                    <label>Loan Amount</label>
                    <div class="input-wrapper">
                        <input type="number" id="loan-amount-payment" value="200000" min="0" step="1000">
                    </div>
                </div>
                
                <div class="input-group">
                    <label>Monthly Payment</label>
                    <div class="input-wrapper">
                        <input type="number" id="monthly-payment" value="1687.71" min="0" step="1">
                    </div>
                </div>
                
                <div class="input-group">
                    <label>Interest Rate</label>
                    <div class="input-wrapper">
                        <input type="number" id="interest-rate-payment" value="6" min="0" step="0.01">
                        <span>%</span>
                    </div>
                </div>
            </div>
            
            <button class="calculate-btn" onclick="calculateFixedPayments()">Calculate</button>
        </div>
        
        <div id="payment-results" class="results-section" style="display: none;">
            <h3 class="result-title">Results</h3>
            <div class="monthly-pay" id="monthly-payment-result">$1,687.71</div>
            <button class="save-btn">Save this calculation</button>
            
            <p id="payment-description">You will need to pay $1,687.71 every month for 15 years to payoff the debt.</p>
            
            <div class="payment-summary">
                <div class="summary-item">
                    <div class="summary-label">Total of 180 Payments</div>
                    <div class="summary-value" id="total-payments">$303,788.46</div>
                </div>
                <div class="summary-item">
                    <div class="summary-label">Total Interest</div>
                    <div class="summary-value" id="total-interest">$103,788.46</div>
                </div>
            </div>
            
            <div class="chart-container">
                <h4 class="chart-title">Payment Breakdown</h4>
                <div class="pie-chart" id="payment-chart"></div>
                <div class="chart-legend">
                    <div class="legend-item">
                        <div class="legend-color legend-principal"></div>
                        <span class="legend-label">Principal (66%)</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color legend-interest"></div>
                        <span class="legend-label">Interest (34%)</span>
                    </div>
                </div>
            </div>
            
            <div class="amortization-section">
                <h3>Amortization schedule</h3>
                <div class="amortization-chart">
                    <p style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); color: #5f6368;">
                        Amortization Chart Visualization
                    </p>
                </div>
                
                <div class="schedule-section">
                    <div class="schedule-tabs">
                        <div class="schedule-tab active" data-tab="annual">Annual Schedule</div>
                        <div class="schedule-tab" data-tab="monthly">Monthly Schedule</div>
                    </div>
                    
                    <div class="schedule-content active" id="annual-schedule">
                        <table class="schedule-table">
                            <thead>
                                <tr>
                                    <th>Year</th>
                                    <th>Interest</th>
                                    <th>Principal</th>
                                    <th>Ending Balance</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>$11,769.23</td>
                                    <td>$8,483.33</td>
                                    <td>$191,516.67</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>$11,246.00</td>
                                    <td>$9,006.57</td>
                                    <td>$182,510.10</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>$10,690.49</td>
                                    <td>$9,562.07</td>
                                    <td>$172,948.02</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>$10,100.72</td>
                                    <td>$10,151.84</td>
                                    <td>$162,796.18</td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>$9,474.58</td>
                                    <td>$10,777.98</td>
                                    <td>$152,018.20</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="schedule-content" id="monthly-schedule" style="display: none;">
                        <table class="schedule-table">
                            <thead>
                                <tr>
                                    <th>Month</th>
                                    <th>Payment</th>
                                    <th>Interest</th>
                                    <th>Principal</th>
                                    <th>Ending Balance</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>$1,687.71</td>
                                    <td>$1,000.00</td>
                                    <td>$687.71</td>
                                    <td>$199,312.29</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>$1,687.71</td>
                                    <td>$996.56</td>
                                    <td>$691.15</td>
                                    <td>$198,621.14</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>$1,687.71</td>
                                    <td>$993.11</td>
                                    <td>$694.60</td>
                                    <td>$197,926.54</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="content-section">
        <h2>Related</h2>
        <div class="related-calculators">
            <a href="/calculators/loan-calculator/" class="related-link">Loan Calculator</a> | 
            <a href="/calculators/auto-loan-calculator/" class="related-link">Auto Loan Calculator</a>
        </div>
        
        <h2>A loan is a contract between a borrower and a lender in which the borrower receives an amount of money (principal) that they are obligated to pay back in the future. Loans can be customized based on various factors. The number of available options can be overwhelming. Two of the most common deciding factors are the term and monthly payment amount, which are separated by tabs in the calculator above.</h2>
        
        <h3>Fixed Term</h3>
        <p>
            Mortgages, auto, and many other loans tend to use the time limit approach to the repayment of loans. For mortgages, 
            in particular, choosing to have routine monthly payments between 30 years or 15 years or other terms can be a very 
            important decision because how long a debt obligation lasts can affect a person's long-term financial goals. Some 
            examples include:
        </p>
        
        <ul>
            <li>Choosing a shorter mortgage term because of the uncertainty of long-term job security or preference for a lower interest rate while there is a sizable amount in savings</li>
            <li>Choosing a longer mortgage term in order to time it correctly with the release of Social Security retirement benefits, which can be used to pay off the mortgage</li>
        </ul>
        
        <p>
            The Payment Calculator can help sort out the fine details of such considerations. It can also be used when deciding 
            between financing options for a car, which can range from 12 months to 96 months periods. Even though many car buyers 
            will be tempted to take the longest option that results in the lowest monthly payment, the shortest term typically 
            results in the lowest total paid for the car (interest + principal). Car buyers should experiment with the variables 
            to see which term is best accommodated by their budget and situation. For additional information about or to do 
            calculations involving mortgages or auto loans, please visit the Mortgage Calculator or Auto Loan Calculator.
        </p>
        
        <h3>Fixed Monthly Payment Amount</h3>
        <p>
            This method helps determine the time required to pay off a loan and is often used to find how fast the debt on a 
            credit card can be repaid. This calculator can also estimate how early a person who has some extra money at the end 
            of each month can pay off their loan. Simply add the extra into the "Monthly Pay" section of the calculator.
        </p>
        
        <p>
            It is possible that a calculation may result in a certain monthly payment that is not enough to repay the principal 
            and interest on a loan. This means that interest will accrue at such a pace that repayment of the loan at the given 
            "Monthly Pay" cannot keep up. If so, simply adjust one of the three inputs until a viable result is calculated. 
            Either "Loan Amount" needs to be lower, "Monthly Pay" needs to be higher, or "Interest Rate" needs to be lower.
        </p>
        
        <h3>Interest Rate (APR)</h3>
        <p>
            When using a figure for this input, it is important to make the distinction between interest rate and annual 
            percentage rate (APR). Especially when very large loans are involved, such as mortgages, the difference can be up 
            to thousands of dollars. By definition, the interest rate is simply the cost of borrowing the principal loan amount. 
            On the other hand, APR is a broader measure of the cost of a loan, which rolls in other costs such as broker fees, 
            discount points, closing costs, and administrative fees. In other words, instead of upfront payments, these 
            additional costs are added onto the cost of borrowing the loan and prorated over the life of the loan instead. If 
            there are no fees associated with a loan, then the interest rate equals the APR. For more information about or to 
            do calculations involving APR or Interest Rate, please visit the APR Calculator or Interest Rate Calculator.
        </p>
        
        <p>
            Borrowers can input both interest rate and APR (if they know them) into the calculator to see the different results. 
            Use interest rate in order to determine loan details without the addition of other costs. To find the total cost of 
            the loan, use APR. The advertised APR generally provides more accurate loan details.
        </p>
        
        <h3>Variable vs. Fixed</h3>
        <p>
            When it comes to loans, there are generally two available interest options to choose from: variable (sometimes 
            called adjustable or floating) or fixed. The majority of loans have fixed interest rates, such as conventionally 
            amortized loans like mortgages, auto loans, or student loans. Examples of variable loans include adjustable-rate 
            mortgages, home equity lines of credit (HELOC), and some personal and student loans. For more information about or 
            to do calculations involving any of these other loans, please visit the Mortgage Calculator, Auto Loan Calculator, 
            Student Loan Calculator, or Personal Loan Calculator.
        </p>
        
        <h3>Variable Rate Information</h3>
        <p>
            In variable rate loans, the interest rate may change based on indices such as inflation or the central bank rate 
            (all of which are usually in movement with the economy). The most common financial index that lenders reference for 
            variable rates is the key index rate set by the U.S. Federal Reserve or the London Interbank Offered Rate (Libor).
        </p>
        
        <p>
            Because rates of variable loans vary over time, fluctuations in rates will alter routine payment amounts; the rate 
            change in one month changes the monthly payment due for that month as well as the total expected interest owed over 
            the life of the loan. Some lenders may place caps on variable loan rates, which are maximum limits on the interest 
            rate charged, regardless of how much the index interest rate changes. Lenders only update interest rates periodically 
            at a frequency agreed to by the borrower, most likely disclosed in a loan contract. As a result, a change to an 
            indexed interest rate does not necessarily mean an immediate change to a variable loan's interest rate. Broadly 
            speaking, variable rates are more favorable to the borrower when indexed interest rates are trending downward.
        </p>
        
        <p>
            Credit card rates can be fixed or variable. Credit card issuers aren't required to give advanced notice of an 
            interest rate increase for credit cards with variable interest rates. It is possible for borrowers with excellent 
            credit to request more favorable rates on their variable loans or credit cards. For more information or to perform 
            calculations that involve paying off a credit card, use the Credit Card Calculator or use the Credit Cards Payoff 
            Calculator for paying off multiple credit cards.
        </p>
    </div>
</div>

<script>
// Tab switching functionality
document.querySelectorAll('.tab').forEach(tab => {
    tab.addEventListener('click', function() {
        // Remove active class from all tabs
        document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
        // Add active class to clicked tab
        this.classList.add('active');
        
        // Hide all tab contents
        document.getElementById('fixed-term-tab').style.display = 'none';
        document.getElementById('fixed-payments-tab').style.display = 'none';
        
        // Show the selected tab content
        const tabType = this.getAttribute('data-tab');
        document.getElementById(`${tabType}-tab`).style.display = 'block';
    });
});

// Schedule tab switching
document.querySelectorAll('.schedule-tab').forEach(tab => {
    tab.addEventListener('click', function() {
        // Remove active class from all tabs
        document.querySelectorAll('.schedule-tab').forEach(t => t.classList.remove('active'));
        // Add active class to clicked tab
        this.classList.add('active');
        
        // Hide all schedule contents
        document.getElementById('annual-schedule').style.display = 'none';
        document.getElementById('monthly-schedule').style.display = 'none';
        
        // Show the selected schedule content
        const tabType = this.getAttribute('data-tab');
        document.getElementById(`${tabType}-schedule`).style.display = 'block';
    });
});

// Fixed term calculation
function calculateFixedTerm() {
    const loanAmount = parseFloat(document.getElementById('loan-amount-term').value) || 200000;
    const loanTerm = parseFloat(document.getElementById('loan-term').value) || 15;
    const interestRate = parseFloat(document.getElementById('interest-rate-term').value) || 6;
    
    // Calculate monthly payment
    const monthlyRate = interestRate / 100 / 12;
    const numberOfPayments = loanTerm * 12;
    const monthlyPayment = loanAmount * monthlyRate * Math.pow(1 + monthlyRate, numberOfPayments) / 
                          (Math.pow(1 + monthlyRate, numberOfPayments) - 1);
    
    // Calculate totals
    const totalPayments = monthlyPayment * numberOfPayments;
    const totalInterest = totalPayments - loanAmount;
    
    // Update results
    document.getElementById('monthly-payment-result').textContent = `$${monthlyPayment.toFixed(2)}`;
    document.getElementById('payment-description').textContent = `You will need to pay $${monthlyPayment.toFixed(2)} every month for ${loanTerm} years to payoff the debt.`;
    document.getElementById('total-payments').textContent = `$${totalPayments.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
    document.getElementById('total-interest').textContent = `$${totalInterest.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
    
    // Show results
    document.getElementById('payment-results').style.display = 'block';
}

// Fixed payments calculation
function calculateFixedPayments() {
    const loanAmount = parseFloat(document.getElementById('loan-amount-payment').value) || 200000;
    const monthlyPayment = parseFloat(document.getElementById('monthly-payment').value) || 1687.71;
    const interestRate = parseFloat(document.getElementById('interest-rate-payment').value) || 6;
    
    // Calculate loan term
    const monthlyRate = interestRate / 100 / 12;
    
    // Check if payment is sufficient to pay off loan
    if (monthlyPayment <= loanAmount * monthlyRate) {
        alert("Monthly payment is not sufficient to pay off the loan. Please increase the payment amount or decrease the loan amount/interest rate.");
        return;
    }
    
    // Calculate number of payments using formula: n = -log(1 - (P * r) / A) / log(1 + r)
    const numberOfPayments = -Math.log(1 - (monthlyPayment * monthlyRate) / loanAmount) / Math.log(1 + monthlyRate);
    const loanTerm = numberOfPayments / 12;
    const years = Math.floor(loanTerm);
    const months = Math.round((loanTerm - years) * 12);
    
    // Calculate totals
    const totalPayments = monthlyPayment * numberOfPayments;
    const totalInterest = totalPayments - loanAmount;
    
    // Update results
    document.getElementById('monthly-payment-result').textContent = `$${monthlyPayment.toFixed(2)}`;
    document.getElementById('payment-description').textContent = `You will need to pay $${monthlyPayment.toFixed(2)} every month for ${years} years and ${months} months to payoff the debt.`;
    document.getElementById('total-payments').textContent = `$${totalPayments.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
    document.getElementById('total-interest').textContent = `$${totalInterest.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
    
    // Show results
    document.getElementById('payment-results').style.display = 'block';
}

// Initialize with sample calculation
document.addEventListener('DOMContentLoaded', function() {
    calculateFixedTerm();
});
</script>

<?php
// Include your website's footer
include '../../footer.php';
?>