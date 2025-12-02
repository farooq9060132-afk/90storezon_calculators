<?php
// Include your website's header
include '../../header.php';
?>

<style>
/* Auto Loan Calculator Styles */
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

.loan-summary {
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
    background: conic-gradient(#0052FF 88%, #FF6B6B 0 100%);
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
    
    .loan-summary {
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
    
    .loan-summary {
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
    
    .loan-summary {
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
        <span>Auto Loan Calculator</span>
    </div>
    
    <h1 class="calculator-title">Auto Loan Calculator</h1>
    <button class="print-btn" onclick="window.print()">Print</button>
    
    <div class="calculator-section">
        <p>Modify the values and click the calculate button to use</p>
        
        <div class="input-grid">
            <div class="input-group">
                <label>Auto Price</label>
                <div class="input-wrapper">
                    <input type="number" id="auto-price" value="50000" min="0" step="1000">
                </div>
            </div>
            
            <div class="input-group">
                <label>Loan Term</label>
                <div class="input-wrapper">
                    <input type="number" id="loan-term" value="60" min="1" max="120">
                    <span>months</span>
                </div>
            </div>
            
            <div class="input-group">
                <label>Interest Rate</label>
                <div class="input-wrapper">
                    <input type="number" id="interest-rate" value="5" min="0" step="0.01">
                    <span>%</span>
                </div>
            </div>
            
            <div class="input-group">
                <label>Cash Incentives ?</label>
                <div class="input-wrapper">
                    <input type="number" id="cash-incentives" value="0" min="0" step="100">
                </div>
            </div>
            
            <div class="input-group">
                <label>Down Payment ?</label>
                <div class="input-wrapper">
                    <input type="number" id="down-payment" value="10000" min="0" step="100">
                </div>
            </div>
            
            <div class="input-group">
                <label>Trade-in Value ?</label>
                <div class="input-wrapper">
                    <input type="number" id="trade-in-value" value="0" min="0" step="100">
                </div>
            </div>
            
            <div class="input-group">
                <label>Amount Owed on Trade-in ?</label>
                <div class="input-wrapper">
                    <input type="number" id="amount-owed" value="0" min="0" step="100">
                </div>
            </div>
            
            <div class="input-group">
                <label>Your State</label>
                <div class="input-wrapper">
                    <select id="state">
                        <option value="">-- Select --</option>
                        <option value="AL">Alabama</option>
                        <option value="AK">Alaska</option>
                        <option value="AZ">Arizona</option>
                        <option value="AR">Arkansas</option>
                        <option value="CA">California</option>
                        <option value="CO">Colorado</option>
                        <option value="CT">Connecticut</option>
                        <option value="DE">Delaware</option>
                        <option value="FL">Florida</option>
                        <option value="GA">Georgia</option>
                        <option value="HI">Hawaii</option>
                        <option value="ID">Idaho</option>
                        <option value="IL">Illinois</option>
                        <option value="IN">Indiana</option>
                        <option value="IA">Iowa</option>
                        <option value="KS">Kansas</option>
                        <option value="KY">Kentucky</option>
                        <option value="LA">Louisiana</option>
                        <option value="ME">Maine</option>
                        <option value="MD">Maryland</option>
                        <option value="MA">Massachusetts</option>
                        <option value="MI">Michigan</option>
                        <option value="MN">Minnesota</option>
                        <option value="MS">Mississippi</option>
                        <option value="MO">Missouri</option>
                        <option value="MT">Montana</option>
                        <option value="NE">Nebraska</option>
                        <option value="NV">Nevada</option>
                        <option value="NH">New Hampshire</option>
                        <option value="NJ">New Jersey</option>
                        <option value="NM">New Mexico</option>
                        <option value="NY">New York</option>
                        <option value="NC">North Carolina</option>
                        <option value="ND">North Dakota</option>
                        <option value="OH">Ohio</option>
                        <option value="OK">Oklahoma</option>
                        <option value="OR">Oregon</option>
                        <option value="PA">Pennsylvania</option>
                        <option value="RI">Rhode Island</option>
                        <option value="SC">South Carolina</option>
                        <option value="SD">South Dakota</option>
                        <option value="TN">Tennessee</option>
                        <option value="TX">Texas</option>
                        <option value="UT">Utah</option>
                        <option value="VT">Vermont</option>
                        <option value="VA">Virginia</option>
                        <option value="WA">Washington</option>
                        <option value="WV">West Virginia</option>
                        <option value="WI">Wisconsin</option>
                        <option value="WY">Wyoming</option>
                    </select>
                </div>
            </div>
            
            <div class="input-group">
                <label>Sales Tax ?</label>
                <div class="input-wrapper">
                    <input type="number" id="sales-tax" value="7" min="0" step="0.1">
                    <span>%</span>
                </div>
            </div>
            
            <div class="input-group">
                <label>Title, Registration and Other Fees ?</label>
                <div class="input-wrapper">
                    <input type="number" id="fees" value="2000" min="0" step="100">
                </div>
            </div>
        </div>
        
        <button class="calculate-btn" onclick="calculateAutoLoan()">Calculate</button>
        
        <div id="auto-loan-results" class="results-section" style="display: none;">
            <h3 class="result-title">Results</h3>
            <div class="monthly-pay" id="monthly-payment">$754.85</div>
            <button class="save-btn">Save this calculation</button>
            
            <div class="loan-summary">
                <div class="summary-item">
                    <div class="summary-label">Total Loan Amount</div>
                    <div class="summary-value" id="loan-amount">$40,000.00</div>
                </div>
                <div class="summary-item">
                    <div class="summary-label">Sale Tax</div>
                    <div class="summary-value" id="sale-tax">$3,500.00</div>
                </div>
                <div class="summary-item">
                    <div class="summary-label">Upfront Payment ?</div>
                    <div class="summary-value" id="upfront-payment">$15,500.00</div>
                </div>
                <div class="summary-item">
                    <div class="summary-label">Total of 60 Loan Payments</div>
                    <div class="summary-value" id="total-payments">$45,290.96</div>
                </div>
            </div>
            
            <div class="loan-summary">
                <div class="summary-item">
                    <div class="summary-label">Total Loan Interest</div>
                    <div class="summary-value" id="total-interest">$5,290.96</div>
                </div>
                <div class="summary-item">
                    <div class="summary-label">Total Cost (price, interest, tax, fees)</div>
                    <div class="summary-value" id="total-cost">$60,790.96</div>
                </div>
            </div>
            
            <div class="chart-container">
                <h4 class="chart-title">Loan Breakdown</h4>
                <div class="pie-chart" id="loan-chart"></div>
                <div class="chart-legend">
                    <div class="legend-item">
                        <div class="legend-color legend-principal"></div>
                        <span class="legend-label">Principal (88%)</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color legend-interest"></div>
                        <span class="legend-label">Interest (12%)</span>
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
                                    <td>$1,835.98</td>
                                    <td>$7,222.21</td>
                                    <td>$32,777.79</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>$1,466.48</td>
                                    <td>$7,591.71</td>
                                    <td>$25,186.08</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>$1,078.07</td>
                                    <td>$7,980.12</td>
                                    <td>$17,205.96</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>$669.80</td>
                                    <td>$8,388.40</td>
                                    <td>$8,817.56</td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>$240.63</td>
                                    <td>$8,817.56</td>
                                    <td>$0.00</td>
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
                                    <td>$754.85</td>
                                    <td>$166.67</td>
                                    <td>$588.18</td>
                                    <td>$39,411.82</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>$754.85</td>
                                    <td>$164.22</td>
                                    <td>$590.63</td>
                                    <td>$38,821.19</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>$754.85</td>
                                    <td>$161.75</td>
                                    <td>$593.10</td>
                                    <td>$38,228.09</td>
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
            <a href="/calculators/cash-back-low-interest-calculator/" class="related-link">Cash Back or Low Interest Calculator</a> | 
            <a href="/calculators/auto-lease-calculator/" class="related-link">Auto Lease Calculator</a>
        </div>
        
        <h2>The Auto Loan Calculator is mainly intended for car purchases within the U.S. People outside the U.S. may still use the calculator, but please adjust accordingly. If only the monthly payment for any auto loan is given, use the Monthly Payments tab (reverse auto loan) to calculate the actual vehicle purchase price and other auto loan information.</h2>
        
        <h3>Auto Loans</h3>
        <p>
            Most people turn to auto loans during a vehicle purchase. They work as any generic, secured loan from a financial 
            institution does with a typical term of 36, 60, 72, or 84 months in the U.S. Each month, repayment of principal 
            and interest must be made from borrowers to auto loan lenders. Money borrowed from a lender that isn't paid back 
            can result in the car being legally repossessed.
        </p>
        
        <h3>Dealership Financing vs. Direct Lending</h3>
        <p>
            Generally, there are two main financing options available when it comes to auto loans: direct lending or 
            dealership financing. The former comes in the form of a typical loan originating from a bank, credit union, or 
            financial institution. Once a contract has been entered with a car dealer to buy a vehicle, the loan is used 
            from the direct lender to pay for the new car. Dealership financing is somewhat similar except that the auto 
            loan, and thus paperwork, is initiated and completed through the dealership instead. Auto loans via dealers are 
            usually serviced by captive lenders that are often associated with each car make. The contract is retained by 
            the dealer but is often sold to a bank, or other financial institution called an assignee that ultimately 
            services the loan.
        </p>
        
        <p>
            Direct lending provides more leverage for buyers to walk into a car dealer with most of the financing done on 
            their terms, as it places further stress on the car dealer to compete with a better rate. Getting pre-approved 
            doesn't tie car buyers down to any one dealership, and their propensity to simply walk away is much higher. 
            With dealer financing, the potential car buyer has fewer choices when it comes to interest rate shopping, though 
            it's there for convenience for anyone who doesn't want to spend time shopping or cannot get an auto loan through 
            direct lending.
        </p>
        
        <p>
            Often, to promote auto sales, car manufacturers offer good financing deals via dealers. Consumers in the market 
            for a new car should start their search for financing with car manufacturers. It is not rare to get low interest 
            rates like 0%, 0.9%, 1.9%, or 2.9% from car manufacturers.
        </p>
        
        <h3>Vehicle Rebates</h3>
        <p>
            Car manufacturers may offer vehicle rebates to further incentivize buyers. Depending on the state, the rebate 
            may or may not be taxed accordingly. For example, purchasing a vehicle at $50,000 with a cash rebate of $2,000 
            will have sales tax calculated based on the original price of $50,000, not $48,000. Luckily, a good portion of 
            states do not do this and don't tax cash rebates. They are Alaska, Arizona, Delaware, Iowa, Kansas, Kentucky, 
            Louisiana, Massachusetts, Minnesota, Missouri, Montana, Nebraska, New Hampshire, Oklahoma, Oregon, Pennsylvania, 
            Rhode Island, Texas, Utah, Vermont, and Wyoming.
        </p>
        
        <p>
            Generally, rebates are only offered for new cars. While some used car dealers do offer cash rebates, this is 
            rare due to the difficulty involved in determining the true value of the vehicle.
        </p>
        
        <h3>Fees</h3>
        <p>
            A car purchase comes with costs other than the purchase price, the majority of which are fees that can normally 
            be rolled into the financing of the auto loan or paid upfront. However, car buyers with low credit scores might 
            be forced into paying fees upfront. The following is a list of common fees associated with car purchases in the U.S.
        </p>
        
        <ul>
            <li><strong>Sales Tax</strong>—Most states in the U.S. collect sales tax for auto purchases. It is possible to finance the cost of sales tax with the price of the car, depending on the state the car was purchased in. Alaska, Delaware, Montana, New Hampshire, and Oregon are the five states that don't charge sales tax.</li>
            <li><strong>Document Fees</strong>—This is a fee collected by the dealer for processing documents like title and registration.</li>
            <li><strong>Title and Registration Fees</strong>—This is the fee collected by states for vehicle title and registration.</li>
            <li><strong>Advertising Fees</strong>—This is a fee that the regional dealer pays for promoting the manufacturer's automobile in the dealer's area. If not charged separately, advertising fees are included in the auto price. A typical price tag for this fee is a few hundred dollars.</li>
            <li><strong>Destination Fee</strong>—This is a fee that covers the shipment of the vehicle from the plant to the dealer's office. This fee is usually between $900 and $1,500.</li>
            <li><strong>Insurance</strong>—In the U.S., auto insurance is strictly mandatory to be regarded as a legal driver on public roads and is usually required before dealers can process paperwork. When a car is purchased via loan and not cash, full coverage insurance is often mandatory. Auto insurance can possibly run more than $1,000 a year for full coverage. Most auto dealers can provide short-term (1 or 2 months) insurance for paperwork processing so new car owners can deal with proper insurance later.</li>
        </ul>
        
        <p>
            If the taxes and fees are bundled into the auto loan, remember to check the box 'Include taxes and fees in loan' 
            in the calculator. If they are paid upfront instead, leave it unchecked. Should an auto dealer package any 
            mysterious special charges into a car purchase, it would be wise to demand justification and thorough explanations 
            for their inclusion.
        </p>
        
        <h3>Auto Loan Strategies</h3>
        <h4>Preparation</h4>
        <p>
            Probably the most important strategy to get a great auto loan is to be well-prepared. This means determining 
            what is affordable before heading to a dealership first. Knowing what kind of vehicle is desired will make it 
            easier to research and find the best deals to suit your individual needs. Once a particular make and model is 
            chosen, it is generally useful to have some typical going rates in mind to enable effective negotiations with a 
            car salesman. This includes talking to more than one lender and getting quotes from several different places. 
            Car dealers, like many businesses, want to make as much money as possible from a sale, but often, given enough 
            negotiation, are willing to sell a car for significantly less than the price they initially offer. Getting a 
            preapproval for an auto loan through direct lending can aid negotiations.
        </p>
        
        <h4>Credit</h4>
        <p>
            Credit, and to a lesser extent, income, generally determines approval for auto loans, whether through dealership 
            financing or direct lending. In addition, borrowers with excellent credit will most likely receive lower interest 
            rates, which will result in paying less for a car overall. Borrowers can improve their chances to negotiate the 
            best deals by taking steps towards achieving better credit scores before taking out a loan to purchase a car.
        </p>
        
        <h4>Cash Back vs. Low Interest</h4>
        <p>
            When purchasing a vehicle, many times, auto manufacturers may offer either a cash vehicle rebate or a lower 
            interest rate. A cash rebate instantly reduces the purchasing price of the car, but a lower rate can potentially 
            result in savings in interest payments. The choice between the two will be different for everyone. For more 
            information about or to do calculations involving this decision, please go to the Cash Back vs. Low Interest Calculator.
        </p>
        
        <h4>Early Payoff</h4>
        <p>
            Paying off an auto loan earlier than usual not only shortens the length of the loan but can also result in 
            interest savings. However, some lenders have an early payoff penalty or terms restricting early payoff. It is 
            important to examine the details carefully before signing an auto loan contract.
        </p>
        
        <h4>Consider Other Options</h4>
        <p>
            Although the allure of a new car can be strong, buying a pre-owned car even if only a few years removed from 
            new can usually result in significant savings; new cars depreciate as soon as they are driven off the lot, 
            sometimes by more than 10% of their values; this is called off-the-lot depreciation, and is an alternative 
            option for prospective car buyers to consider.
        </p>
        
        <p>
            People who just want a new car for the enjoyment of driving a new car may also consider a lease, which is, in 
            essence, a long-term rental that normally costs less upfront than a full purchase. For more information about 
            or to do calculations involving auto leases, please visit the Auto Lease Calculator.
        </p>
        
        <p>
            In some cases, a car might not even be needed! If possible, consider public transportation, carpool with other 
            people, bike, or walk instead.
        </p>
        
        <h3>Buying a Car with Cash Instead</h3>
        <p>
            Although most car purchases are made with auto loans in the U.S., there are benefits to buying a car outright 
            with cash.
        </p>
        
        <ul>
            <li><strong>Avoid Monthly Payments</strong>—Paying with cash relinquishes a person of the responsibility of making monthly payments. This can be a huge emotional benefit for anyone who would prefer not to have a large loan looming over their head for the next few years. In addition, the possibility of late fees for late monthly payments no longer exists.</li>
            <li><strong>Avoid Interest</strong>—No financing involved in the purchase of a car means there will be no interest charged, which will result in a lower overall cost to own the car. As a very simple example, borrowing $32,000 for five years at 6% will require a payment of $618.65 per month, with a total interest payment of $5,118.98 over the life of the loan. In this scenario, paying in cash will save $5,118.98.</li>
            <li><strong>Future Flexibility</strong>—Because ownership of a car is 100% after paying in full. There aren't any restrictions on the car, such as the right to sell it after several months, use less expensive insurance coverage, and make certain modifications to the car.</li>
            <li><strong>Avoid Overbuying</strong>—Paying in full with a single amount will limit car buyers to what is within their immediate, calculated budget. On the other hand, financed purchases are less concrete and have the potential to result in car buyers buying more than what they can afford long term; it's easy to be tempted to add a few extra dollars to a monthly payment to stretch the loan length out for a more expensive car. To complicate matters, car salesmen tend to use tactics such as fees and intricate financing in order to get buyers to buy out of their realm. All of this can be avoided by paying in cash.</li>
            <li><strong>Discounts</strong>—In some cases, car purchases can come with the option of either an immediate rebate or low-interest financing. Certain rebates are only offered to cash purchases.</li>
            <li><strong>Avoid Underwater Loan</strong>—When it comes to financing a depreciating asset, there is the chance that the loan goes underwater, which means more is owed on the asset than its current worth. Auto loans are no different, and paying in full avoids this scenario completely.</li>
        </ul>
        
        <p>
            There are a lot of benefits to paying with cash for a car purchase, but that doesn't mean everyone should do it. 
            Situations exist where financing with an auto loan can make more sense to a car buyer, e
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

// Auto loan calculation
function calculateAutoLoan() {
    const autoPrice = parseFloat(document.getElementById('auto-price').value) || 50000;
    const loanTerm = parseFloat(document.getElementById('loan-term').value) || 60;
    const interestRate = parseFloat(document.getElementById('interest-rate').value) || 5;
    const cashIncentives = parseFloat(document.getElementById('cash-incentives').value) || 0;
    const downPayment = parseFloat(document.getElementById('down-payment').value) || 10000;
    const tradeInValue = parseFloat(document.getElementById('trade-in-value').value) || 0;
    const amountOwed = parseFloat(document.getElementById('amount-owed').value) || 0;
    const salesTax = parseFloat(document.getElementById('sales-tax').value) || 7;
    const fees = parseFloat(document.getElementById('fees').value) || 2000;
    
    // Calculate loan amount
    const netTradeIn = tradeInValue - amountOwed;
    const adjustedPrice = autoPrice - cashIncentives - netTradeIn;
    const saleTaxAmount = adjustedPrice * (salesTax / 100);
    const loanAmount = adjustedPrice + saleTaxAmount + fees - downPayment;
    
    // Calculate monthly payment
    const monthlyRate = interestRate / 100 / 12;
    const numberOfPayments = loanTerm;
    const monthlyPayment = loanAmount * monthlyRate * Math.pow(1 + monthlyRate, numberOfPayments) / 
                          (Math.pow(1 + monthlyRate, numberOfPayments) - 1);
    
    // Calculate totals
    const totalPayments = monthlyPayment * numberOfPayments;
    const totalInterest = totalPayments - loanAmount;
    const totalCost = autoPrice + totalInterest + saleTaxAmount + fees - cashIncentives;
    const upfrontPayment = downPayment + (netTradeIn > 0 ? netTradeIn : 0);
    
    // Update results
    document.getElementById('monthly-payment').textContent = `$${monthlyPayment.toFixed(2)}`;
    document.getElementById('loan-amount').textContent = `$${loanAmount.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
    document.getElementById('sale-tax').textContent = `$${saleTaxAmount.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
    document.getElementById('upfront-payment').textContent = `$${upfrontPayment.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
    document.getElementById('total-payments').textContent = `$${totalPayments.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
    document.getElementById('total-interest').textContent = `$${totalInterest.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
    document.getElementById('total-cost').textContent = `$${totalCost.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
    
    // Show results
    document.getElementById('auto-loan-results').style.display = 'block';
}

// Initialize with sample calculation
document.addEventListener('DOMContentLoaded', function() {
    calculateAutoLoan();
});
</script>

<?php
// Include your website's footer
include '../../footer.php';
?>