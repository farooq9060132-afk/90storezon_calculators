<?php
// Include your website's header
include '../../header.php';
?>

<style>
/* Interest Calculator Styles */
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
    min-width: 200px;
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

.results-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 15px;
    margin: 25px 0;
}

.result-item {
    background: #ffffff;
    border: 1px solid #dadce0;
    border-radius: 6px;
    padding: 15px;
    text-align: center;
}

.result-label {
    font-size: 14px;
    color: #5f6368;
    margin-bottom: 8px;
}

.result-value {
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
    background: conic-gradient(#0052FF 37%, #4CAF50 0 83%, #FFC107 0 100%);
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

.legend-investment {
    background: #0052FF;
}

.legend-contributions {
    background: #4CAF50;
}

.legend-interest {
    background: #FFC107;
}

.legend-label {
    font-size: 14px;
    color: #5f6368;
}

.accumulation-section {
    margin-top: 40px;
}

.accumulation-section h3 {
    font-size: 20px;
    color: #202124;
    margin-bottom: 20px;
}

.accumulation-chart {
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
    
    .results-grid {
        grid-template-columns: repeat(4, 1fr);
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
    
    .results-grid {
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
    
    .results-grid {
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
        <span>Interest Calculator</span>
    </div>
    
    <h1 class="calculator-title">Interest Calculator</h1>
    <button class="print-btn" onclick="window.print()">Print</button>
    
    <div class="calculator-section">
        <p>This Compound Interest Calculator can help determine the compound interest accumulation and final balances on both fixed principal amounts and additional periodic contributions. There are also optional factors available for consideration, such as the tax on interest income and inflation.</p>
        
        <p>Modify the values and click the calculate button to use</p>
        
        <div class="input-grid">
            <div class="input-group">
                <label>Initial investment</label>
                <div class="input-wrapper">
                    <input type="number" id="initial-investment" value="20000" min="0" step="1000">
                </div>
            </div>
            
            <div class="input-group">
                <label>Annual contribution</label>
                <div class="input-wrapper">
                    <input type="number" id="annual-contribution" value="5000" min="0" step="100">
                </div>
            </div>
            
            <div class="input-group">
                <label>Monthly contribution</label>
                <div class="input-wrapper">
                    <input type="number" id="monthly-contribution" value="0" min="0" step="100">
                </div>
            </div>
            
            <div class="input-group">
                <label>Contribute at the</label>
                <div class="input-wrapper">
                    <select id="contribute-time">
                        <option value="end">end</option>
                        <option value="beginning">beginning</option>
                    </select>
                    <span>of each compounding period</span>
                </div>
            </div>
            
            <div class="input-group">
                <label>Interest rate</label>
                <div class="input-wrapper">
                    <input type="number" id="interest-rate" value="5" min="0" step="0.01">
                    <span>%</span>
                </div>
            </div>
            
            <div class="input-group">
                <label>Compound</label>
                <div class="input-wrapper">
                    <select id="compound">
                        <option value="annually">annually</option>
                        <option value="semiannually">semiannually</option>
                        <option value="quarterly">quarterly</option>
                        <option value="monthly">monthly</option>
                        <option value="daily">daily</option>
                    </select>
                </div>
            </div>
            
            <div class="input-group">
                <label>Investment length</label>
                <div class="input-wrapper">
                    <input type="number" id="years" value="5" min="0" max="100">
                    <span>years</span>
                    <input type="number" id="months" value="0" min="0" max="11">
                    <span>months</span>
                </div>
            </div>
            
            <div class="input-group">
                <label>Tax rate ?</label>
                <div class="input-wrapper">
                    <input type="number" id="tax-rate" value="0" min="0" max="100">
                    <span>%</span>
                </div>
            </div>
            
            <div class="input-group">
                <label>Inflation rate</label>
                <div class="input-wrapper">
                    <input type="number" id="inflation-rate" value="3" min="0" step="0.1">
                    <span>%</span>
                </div>
            </div>
        </div>
        
        <button class="calculate-btn" onclick="calculateInterest()">Calculate</button>
        
        <div id="interest-results" class="results-section" style="display: none;">
            <h3 class="result-title">Results</h3>
            <button class="save-btn">Save this calculation</button>
            
            <div class="results-grid">
                <div class="result-item">
                    <div class="result-label">Ending balance</div>
                    <div class="result-value" id="ending-balance">$54,535.20</div>
                </div>
                <div class="result-item">
                    <div class="result-label">Total principal</div>
                    <div class="result-value" id="total-principal">$45,000.00</div>
                </div>
                <div class="result-item">
                    <div class="result-label">Total contributions</div>
                    <div class="result-value" id="total-contributions">$25,000.00</div>
                </div>
                <div class="result-item">
                    <div class="result-label">Total interest</div>
                    <div class="result-value" id="total-interest">$9,535.20</div>
                </div>
            </div>
            
            <div class="results-grid">
                <div class="result-item">
                    <div class="result-label">Interest of initial investment</div>
                    <div class="result-value" id="interest-initial">$5,525.63</div>
                </div>
                <div class="result-item">
                    <div class="result-label">Interest of the contributions</div>
                    <div class="result-value" id="interest-contributions">$4,009.56</div>
                </div>
                <div class="result-item">
                    <div class="result-label">Buying power of the end balance after inflation adjustment</div>
                    <div class="result-value" id="inflation-adjusted">$47,042.54</div>
                </div>
            </div>
            
            <div class="chart-container">
                <h4 class="chart-title">Accumulation Breakdown</h4>
                <div class="pie-chart" id="accumulation-chart"></div>
                <div class="chart-legend">
                    <div class="legend-item">
                        <div class="legend-color legend-investment"></div>
                        <span class="legend-label">Initial investment (37%)</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color legend-contributions"></div>
                        <span class="legend-label">Contributions (46%)</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color legend-interest"></div>
                        <span class="legend-label">Interest (17%)</span>
                    </div>
                </div>
            </div>
            
            <div class="accumulation-section">
                <h3>Accumulation Schedule</h3>
                <div class="accumulation-chart">
                    <p style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); color: #5f6368;">
                        Accumulation Chart Visualization
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
                                    <th>Deposit</th>
                                    <th>Interest</th>
                                    <th>Ending balance</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>$25,000.00</td>
                                    <td>$1,250.00</td>
                                    <td>$26,250.00</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>$5,000.00</td>
                                    <td>$1,562.50</td>
                                    <td>$32,812.50</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>$5,000.00</td>
                                    <td>$1,890.63</td>
                                    <td>$39,703.13</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>$5,000.00</td>
                                    <td>$2,235.16</td>
                                    <td>$46,938.28</td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>$5,000.00</td>
                                    <td>$2,596.91</td>
                                    <td>$54,535.20</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="schedule-content" id="monthly-schedule" style="display: none;">
                        <table class="schedule-table">
                            <thead>
                                <tr>
                                    <th>Month</th>
                                    <th>Deposit</th>
                                    <th>Interest</th>
                                    <th>Ending balance</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>$20,000.00</td>
                                    <td>$83.33</td>
                                    <td>$20,083.33</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>$0.00</td>
                                    <td>$83.68</td>
                                    <td>$20,167.01</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>$0.00</td>
                                    <td>$84.03</td>
                                    <td>$20,251.04</td>
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
            <a href="/calculators/investment-calculator/" class="related-link">Investment Calculator</a> | 
            <a href="/calculators/average-return-calculator/" class="related-link">Average Return Calculator</a> | 
            <a href="/calculators/roi-calculator/" class="related-link">ROI Calculator</a>
        </div>
        
        <h2>Interest is the compensation paid by the borrower to the lender for the use of money as a percent or an amount. The concept of interest is the backbone behind most financial instruments in the world.</h2>
        
        <h3>There are two distinct methods of accumulating interest, categorized into simple interest or compound interest.</h3>
        
        <h3>Simple Interest</h3>
        <p>
            The following is a basic example of how interest works. Derek would like to borrow $100 (usually called the principal) 
            from the bank for one year. The bank wants 10% interest on it. To calculate interest:
        </p>
        
        <div class="formula-section">
            <div class="formula">$100 × 10% = $10</div>
        </div>
        
        <p>
            This interest is added to the principal, and the sum becomes Derek's required repayment to the bank one year later.
        </p>
        
        <div class="formula-section">
            <div class="formula">$100 + $10 = $110</div>
        </div>
        
        <p>
            Derek owes the bank $110 a year later, $100 for the principal and $10 as interest.
        </p>
        
        <p>
            Let's assume that Derek wanted to borrow $100 for two years instead of one, and the bank calculates interest annually. 
            He would simply be charged the interest rate twice, once at the end of each year.
        </p>
        
        <div class="formula-section">
            <div class="formula">$100 + $10(year 1) + $10(year 2) = $120</div>
        </div>
        
        <p>
            Derek owes the bank $120 two years later, $100 for the principal and $20 as interest.
        </p>
        
        <p>
            The formula to calculate simple interest is:
        </p>
        
        <div class="formula-section">
            <div class="formula">interest = principal × interest rate × term</div>
        </div>
        
        <p>
            When more complicated frequencies of applying interest are involved, such as monthly or daily, use the formula:
        </p>
        
        <div class="formula-section">
            <div class="formula">interest = principal × interest rate × (term / frequency)</div>
        </div>
        
        <p>
            However, simple interest is very seldom used in the real world. Even when people use the everyday word 'interest,' 
            they are usually referring to interest that compounds.
        </p>
        
        <h3>Compound Interest</h3>
        <p>
            Compounding interest requires more than one period, so let's go back to the example of Derek borrowing $100 from 
            the bank for two years at a 10% interest rate. For the first year, we calculate interest as usual.
        </p>
        
        <div class="formula-section">
            <div class="formula">$100 × 10% = $10</div>
        </div>
        
        <p>
            This interest is added to the principal, and the sum becomes Derek's required repayment to the bank for that 
            present time.
        </p>
        
        <div class="formula-section">
            <div class="formula">$100 + $10 = $110</div>
        </div>
        
        <p>
            However, the year ends, and in comes another period. For compounding interest, rather than the original amount, 
            the principal + any interest accumulated since is used. In Derek's case:
        </p>
        
        <div class="formula-section">
            <div class="formula">$110 × 10% = $11</div>
        </div>
        
        <p>
            Derek's interest charge at the end of year 2 is $11. This is added to what is owed after year 1:
        </p>
        
        <div class="formula-section">
            <div class="formula">$110 + $11 = $121</div>
        </div>
        
        <p>
            When the loan ends, the bank collects $121 from Derek instead of $120 if it were calculated using simple interest 
            instead. This is because interest is also earned on interest.
        </p>
        
        <p>
            The more frequently interest is compounded within a time period, the higher the interest will be earned on an 
            original principal. The following is a graph showing just that, a $1,000 investment at various compounding 
            frequencies earning 20%.
        </p>
        
        <div class="formula-section">
            <p style="text-align: center; font-weight: bold;">interest vs. compounding frequencies</p>
        </div>
        
        <p>
            There is little difference during the beginning between all frequencies, but over time they slowly start to diverge. 
            This is the power of compound interest everyone likes to talk about, illustrated in a concise graph. The continuous 
            compound will always have the highest return due to its use of the mathematical limit of the frequency of compounding 
            that can occur within a specified time period.
        </p>
        
        <h3>The Rule of 72</h3>
        <p>
            Anyone who wants to estimate compound interest in their head may find the rule of 72 very useful. Not for exact 
            calculations as given by financial calculators, but to get ideas for ballpark figures. It states that in order to 
            find the number of years (n) required to double a certain amount of money with any interest rate, simply divide 72 
            by that same rate.
        </p>
        
        <p><strong>Example: How long would it take to double $1,000 with an 8% interest rate?</strong></p>
        
        <div class="formula-section">
            <div class="formula">n = 72 / 8 = 9</div>
        </div>
        
        <p>
            It will take 9 years for the $1,000 to become $2,000 at 8% interest. This formula works best for interest rates 
            between 6 and 10%, but it should also work reasonably well for anything below 20%.
        </p>
        
        <h3>Fixed vs. Floating Interest Rate</h3>
        <p>
            The interest rate of a loan or savings can be "fixed" or "floating." Floating rate loans or savings are normally 
            based on some reference rate, such as the U.S. Federal Reserve (Fed) funds rate or the LIBOR (London Interbank 
            Offered Rate). Normally, the loan rate is a little higher, and the savings rate is a little lower than the 
            reference rate. The difference goes to the profit of the bank. Both the Fed rate and LIBOR are short-term 
            inter-bank interest rates, but the Fed rate is the main tool that the Federal Reserve uses to influence the 
            supply of money in the U.S. economy. LIBOR is a commercial rate calculated from prevailing interest rates between 
            highly credit-worthy institutions. Our Interest Calculator deals with fixed interest rates only.
        </p>
        
        <h3>Contributions</h3>
        <p>
            Our Interest Calculator above allows periodic deposits/contributions. This is useful for those who have the habit 
            of saving a certain amount periodically. An important distinction to make regarding contributions is whether they 
            occur at the beginning or end of compounding periods. Periodic payments that occur at the end have one less interest 
            period total per contribution.
        </p>
        
        <h3>Tax Rate</h3>
        <p>
            Some forms of interest income are subject to taxes, including bonds, savings, and certificate of deposits(CDs). 
            In the U.S., corporate bonds are almost always taxed. Certain types are fully taxed while others are partially 
            taxed; for example, while interest earned on U.S. federal treasury bonds may be taxed at the federal level, they 
            are generally exempt at the state and local level. Taxes can have very big impacts on the end balance. For example, 
            if Derek saves $100 at 6% for 20 years, he will get:
        </p>
        
        <div class="formula-section">
            <div class="formula">$100 × (1 + 6%)²⁰ = $320.71</div>
        </div>
        
        <p>
            This is tax-free. However, if Derek has a marginal tax rate of 25%, he will end up with $239.78 only because the 
            tax rate of 25% applies to each compounding period.
        </p>
        
        <h3>Inflation Rate</h3>
        <p>
            Inflation is defined as a sustained increase in the prices of goods and services over time. As a result, a fixed 
            amount of money will relatively afford less in the future. The average inflation rate in the U.S. in the past 100 
            years has hovered around 3%. As a tool of comparison, the average annual return rate of the S&P 500 (Standard & 
            Poor's) index in the United States is around 10% in the same period. Please refer to our Inflation Calculator for 
            more detailed information about inflation.
        </p>
        
        <p>
            For our Interest Calculator, leave the inflation rate at 0 for quick, generalized results. But for real and 
            accurate numbers, it is possible to input figures in order to account for inflation.
        </p>
        
        <p>
            Tax and inflation combined make it hard to grow the real value of money. For example, in the United States, the 
            middle class has a marginal tax rate of around 25%, and the average inflation rate is 3%. To maintain the value 
            of the money, a stable interest rate or investment return rate of 4% or above needs to be earned, and this is not 
            easy to achieve.
        </p>
    </div>
</div>

<script>
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

// Interest calculation
function calculateInterest() {
    const initialInvestment = parseFloat(document.getElementById('initial-investment').value) || 20000;
    const annualContribution = parseFloat(document.getElementById('annual-contribution').value) || 5000;
    const monthlyContribution = parseFloat(document.getElementById('monthly-contribution').value) || 0;
    const contributeTime = document.getElementById('contribute-time').value;
    const interestRate = parseFloat(document.getElementById('interest-rate').value) || 5;
    const compound = document.getElementById('compound').value;
    const years = parseFloat(document.getElementById('years').value) || 5;
    const months = parseFloat(document.getElementById('months').value) || 0;
    const taxRate = parseFloat(document.getElementById('tax-rate').value) || 0;
    const inflationRate = parseFloat(document.getElementById('inflation-rate').value) || 3;
    
    // Calculate total investment period in years
    const totalYears = years + (months / 12);
    
    // Determine compounding frequency
    let compoundFrequency;
    switch(compound) {
        case 'daily':
            compoundFrequency = 365;
            break;
        case 'monthly':
            compoundFrequency = 12;
            break;
        case 'quarterly':
            compoundFrequency = 4;
            break;
        case 'semiannually':
            compoundFrequency = 2;
            break;
        case 'annually':
        default:
            compoundFrequency = 1;
            break;
    }
    
    // Calculate future value using compound interest formula
    // FV = PV(1 + r/n)^(nt) + PMT × [((1 + r/n)^(nt) - 1) / (r/n)]
    
    const ratePerPeriod = (interestRate / 100) / compoundFrequency;
    const totalPeriods = compoundFrequency * totalYears;
    
    // Future value of initial investment
    const fvInitial = initialInvestment * Math.pow(1 + ratePerPeriod, totalPeriods);
    
    // Future value of contributions
    let fvContributions = 0;
    
    // Annual contributions
    if (annualContribution > 0) {
        // Convert annual contributions to equivalent periodic contributions
        const periodicAnnual = annualContribution / compoundFrequency;
        const periodsPerYear = compoundFrequency;
        
        for (let i = 1; i <= totalPeriods; i++) {
            const yearsElapsed = (totalPeriods - i) / compoundFrequency;
            if (contributeTime === 'beginning') {
                fvContributions += periodicAnnual * Math.pow(1 + ratePerPeriod, totalPeriods - i + 1);
            } else {
                fvContributions += periodicAnnual * Math.pow(1 + ratePerPeriod, totalPeriods - i);
            }
        }
    }
    
    // Monthly contributions
    if (monthlyContribution > 0) {
        const periodicMonthly = monthlyContribution;
        const periodsPerMonth = compoundFrequency / 12;
        
        for (let i = 1; i <= totalPeriods; i++) {
            // Calculate how many months have passed
            const monthsElapsed = (i - 1) / (compoundFrequency / 12);
            if (contributeTime === 'beginning') {
                fvContributions += periodicMonthly * Math.pow(1 + ratePerPeriod, totalPeriods - i + 1);
            } else {
                fvContributions += periodicMonthly * Math.pow(1 + ratePerPeriod, totalPeriods - i);
            }
        }
    }
    
    // Total future value before taxes
    let totalFV = fvInitial + fvContributions;
    
    // Calculate interest earned
    const totalContributions = initialInvestment + (annualContribution * totalYears) + (monthlyContribution * totalYears * 12);
    const totalInterest = totalFV - totalContributions;
    
    // Apply tax rate to interest
    const taxAmount = totalInterest * (taxRate / 100);
    totalFV -= taxAmount;
    const netInterest = totalInterest - taxAmount;
    
    // Adjust for inflation
    const inflationAdjusted = totalFV / Math.pow(1 + (inflationRate / 100), totalYears);
    
    // Calculate breakdown
    const interestInitial = fvInitial - initialInvestment;
    const interestContributions = netInterest - interestInitial;
    
    // Update results
    document.getElementById('ending-balance').textContent = `$${totalFV.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
    document.getElementById('total-principal').textContent = `$${initialInvestment.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
    document.getElementById('total-contributions').textContent = `$${(annualContribution * totalYears + monthlyContribution * totalYears * 12).toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
    document.getElementById('total-interest').textContent = `$${netInterest.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
    document.getElementById('interest-initial').textContent = `$${interestInitial.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
    document.getElementById('interest-contributions').textContent = `$${interestContributions.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
    document.getElementById('inflation-adjusted').textContent = `$${inflationAdjusted.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
    
    // Show results
    document.getElementById('interest-results').style.display = 'block';
}

// Initialize with sample calculation
document.addEventListener('DOMContentLoaded', function() {
    calculateInterest();
});
</script>

<?php
// Include your website's footer
include '../../footer.php';
?>