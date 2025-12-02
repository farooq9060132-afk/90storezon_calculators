<?php
// Include your website's header
include '../../header.php';
?>

<style>
/* Mortgage Calculator Styles */
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
    min-width: 180px;
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

.more-options {
    background: #f8f9fa;
    border-radius: 8px;
    padding: 20px;
    margin-top: 20px;
    display: none;
}

.more-options.active {
    display: block;
}

.toggle-options {
    background: none;
    border: none;
    color: #0052FF;
    font-size: 15px;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 5px;
    margin-top: 10px;
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

.payment-breakdown {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 15px;
    margin: 25px 0;
}

.payment-item {
    background: #ffffff;
    border: 1px solid #dadce0;
    border-radius: 6px;
    padding: 15px;
    text-align: center;
}

.payment-label {
    font-size: 14px;
    color: #5f6368;
    margin-bottom: 8px;
}

.payment-value {
    font-size: 16px;
    font-weight: bold;
    color: #202124;
}

.total-values {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 15px;
    margin: 25px 0;
}

.total-item {
    background: #ffffff;
    border: 1px solid #dadce0;
    border-radius: 6px;
    padding: 15px;
    text-align: center;
}

.total-label {
    font-size: 14px;
    color: #5f6368;
    margin-bottom: 8px;
}

.total-value {
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
    background: conic-gradient(#0052FF 70%, #FF6B6B 0 84%, #4CAF50 0 88%, #FFC107 0 100%);
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

.legend-taxes {
    background: #FF6B6B;
}

.legend-insurance {
    background: #4CAF50;
}

.legend-other {
    background: #FFC107;
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

.rates-section {
    background: #e8f0fe;
    border-radius: 8px;
    padding: 20px;
    margin: 20px 0;
}

.rates-section h3 {
    margin-top: 0;
    margin-bottom: 15px;
    color: #202124;
}

.rates-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 15px;
}

.rate-item {
    background: #ffffff;
    border: 1px solid #dadce0;
    border-radius: 6px;
    padding: 15px;
    text-align: center;
}

.rate-label {
    font-size: 14px;
    color: #5f6368;
    margin-bottom: 8px;
}

.rate-value {
    font-size: 16px;
    font-weight: bold;
    color: #0052FF;
}

/* Desktop Styles */
@media (min-width: 769px) {
    .input-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .payment-breakdown {
        grid-template-columns: repeat(5, 1fr);
    }
    
    .total-values {
        grid-template-columns: repeat(5, 1fr);
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
    
    .payment-breakdown {
        grid-template-columns: 1fr 1fr;
    }
    
    .total-values {
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
    
    .payment-breakdown, .total-values {
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
        <span>Mortgage Calculator</span>
    </div>
    
    <h1 class="calculator-title">Mortgage Calculator</h1>
    <button class="print-btn" onclick="window.print()">Print</button>
    
    <div class="calculator-section">
        <p>Modify the values and click the calculate button to use</p>
        
        <div class="input-grid">
            <div class="input-group">
                <label>Home Price</label>
                <div class="input-wrapper">
                    <input type="number" id="home-price" value="400000" min="0" step="1000">
                </div>
            </div>
            
            <div class="input-group">
                <label>Down Payment ?</label>
                <div class="input-wrapper">
                    <input type="number" id="down-payment" value="20" min="0" max="100">
                    <span>%</span>
                </div>
            </div>
            
            <div class="input-group">
                <label>Loan Term ?</label>
                <div class="input-wrapper">
                    <input type="number" id="loan-term" value="30" min="1" max="50">
                    <span>years</span>
                </div>
            </div>
            
            <div class="input-group">
                <label>Interest Rate ?</label>
                <div class="input-wrapper">
                    <input type="number" id="interest-rate" value="6.193" min="0" step="0.001">
                </div>
            </div>
            
            <div class="input-group">
                <label>Start Date</label>
                <div class="input-wrapper">
                    <select id="start-month">
                        <option value="1">Jan</option>
                        <option value="2">Feb</option>
                        <option value="3">Mar</option>
                        <option value="4">Apr</option>
                        <option value="5">May</option>
                        <option value="6">Jun</option>
                        <option value="7">Jul</option>
                        <option value="8">Aug</option>
                        <option value="9">Sep</option>
                        <option value="10">Oct</option>
                        <option value="11">Nov</option>
                        <option value="12" selected>Dec</option>
                    </select>
                    <input type="number" id="start-year" value="2025" min="2020" max="2050">
                </div>
            </div>
        </div>
        
        <button class="toggle-options" onclick="toggleOptions()">
            <span id="toggle-text">+ More Options</span>
        </button>
        
        <div class="more-options" id="more-options">
            <div class="input-grid">
                <div class="input-group">
                    <label>Property Taxes ?</label>
                    <div class="input-wrapper">
                        <input type="number" id="property-taxes" value="1.2" min="0" step="0.1">
                        <span>%</span>
                    </div>
                </div>
                
                <div class="input-group">
                    <label>Home Insurance ?</label>
                    <div class="input-wrapper">
                        <input type="number" id="home-insurance" value="1500" min="0" step="100">
                        <span>$</span>
                    </div>
                </div>
                
                <div class="input-group">
                    <label>PMI Insurance ?</label>
                    <div class="input-wrapper">
                        <input type="number" id="pmi-insurance" value="0" min="0" step="100">
                        <span>$</span>
                    </div>
                </div>
                
                <div class="input-group">
                    <label>HOA Fee ?</label>
                    <div class="input-wrapper">
                        <input type="number" id="hoa-fee" value="0" min="0" step="100">
                        <span>$</span>
                    </div>
                </div>
                
                <div class="input-group">
                    <label>Other Costs ?</label>
                    <div class="input-wrapper">
                        <input type="number" id="other-costs" value="4000" min="0" step="100">
                        <span>$</span>
                    </div>
                </div>
            </div>
        </div>
        
        <button class="calculate-btn" onclick="calculateMortgage()">Calculate</button>
        
        <div id="mortgage-results" class="results-section" style="display: none;">
            <h3 class="result-title">Results</h3>
            <div class="monthly-pay" id="monthly-payment">$1,958.45</div>
            <button class="save-btn">Save this calculation</button>
            
            <h4>Payment Breakdown</h4>
            <div class="payment-breakdown">
                <div class="payment-item">
                    <div class="payment-label">Monthly</div>
                    <div class="payment-value" id="monthly-breakdown">$1,958.45</div>
                </div>
                <div class="payment-item">
                    <div class="payment-label">Total</div>
                    <div class="payment-value" id="total-breakdown">$705,041.07</div>
                </div>
            </div>
            
            <div class="payment-breakdown">
                <div class="payment-item">
                    <div class="payment-label">Mortgage Payment</div>
                    <div class="payment-value" id="mortgage-payment">$1,958.45</div>
                    <div class="payment-value" id="mortgage-total">$705,041.07</div>
                </div>
                <div class="payment-item">
                    <div class="payment-label">Property Tax</div>
                    <div class="payment-value" id="tax-payment">$400.00</div>
                    <div class="payment-value" id="tax-total">$144,000.00</div>
                </div>
                <div class="payment-item">
                    <div class="payment-label">Home Insurance</div>
                    <div class="payment-value" id="insurance-payment">$125.00</div>
                    <div class="payment-value" id="insurance-total">$45,000.00</div>
                </div>
                <div class="payment-item">
                    <div class="payment-label">Other Costs</div>
                    <div class="payment-value" id="other-payment">$333.33</div>
                    <div class="payment-value" id="other-total">$120,000.00</div>
                </div>
                <div class="payment-item">
                    <div class="payment-label">Total Out-of-Pocket</div>
                    <div class="payment-value" id="total-payment">$2,816.78</div>
                    <div class="payment-value" id="total-total">$1,014,041.07</div>
                </div>
            </div>
            
            <div class="chart-container">
                <h4 class="chart-title">Payment Distribution</h4>
                <div class="pie-chart" id="payment-chart"></div>
                <div class="chart-legend">
                    <div class="legend-item">
                        <div class="legend-color legend-principal"></div>
                        <span class="legend-label">Principal & Interest (70%)</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color legend-taxes"></div>
                        <span class="legend-label">Property Taxes (14%)</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color legend-insurance"></div>
                        <span class="legend-label">Home Insurance (4%)</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color legend-other"></div>
                        <span class="legend-label">Other Cost (12%)</span>
                    </div>
                </div>
            </div>
            
            <div class="total-values">
                <div class="total-item">
                    <div class="total-label">House Price</div>
                    <div class="total-value" id="house-price-result">$400,000.00</div>
                </div>
                <div class="total-item">
                    <div class="total-label">Loan Amount</div>
                    <div class="total-value" id="loan-amount-result">$320,000.00</div>
                </div>
                <div class="total-item">
                    <div class="total-label">Down Payment</div>
                    <div class="total-value" id="down-payment-result">$80,000.00</div>
                </div>
                <div class="total-item">
                    <div class="total-label">Total of 360 Mortgage Payments</div>
                    <div class="total-value" id="total-payments-result">$705,041.07</div>
                </div>
                <div class="total-item">
                    <div class="total-label">Total Interest</div>
                    <div class="total-value" id="total-interest-result">$385,041.07</div>
                </div>
            </div>
            
            <div class="total-item">
                <div class="total-label">Mortgage Payoff Date</div>
                <div class="total-value" id="payoff-date">Dec. 2055</div>
            </div>
            
            <div class="rates-section">
                <h3>Latest Mortgage Rates:</h3>
                <div class="rates-grid">
                    <div class="rate-item">
                        <div class="rate-label">30 Years</div>
                        <div class="rate-value">6.193%</div>
                    </div>
                    <div class="rate-item">
                        <div class="rate-label">15 Years</div>
                        <div class="rate-value">5.31%</div>
                    </div>
                    <div class="rate-item">
                        <div class="rate-label">10 Years</div>
                        <div class="rate-value">5.188%</div>
                    </div>
                </div>
                <p style="margin-top: 15px; text-align: center;">
                    <a href="#" style="color: #0052FF; text-decoration: none;">See your local rates</a> | 
                    <a href="#" style="color: #0052FF; text-decoration: none;">Get pre-approval</a>
                </p>
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
                                    <th>Date</th>
                                    <th>Interest</th>
                                    <th>Principal</th>
                                    <th>Ending Balance</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>12/25-11/26</td>
                                    <td>$19,711</td>
                                    <td>$3,790</td>
                                    <td>$316,210</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>12/26-11/27</td>
                                    <td>$19,470</td>
                                    <td>$4,032</td>
                                    <td>$312,178</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>12/27-11/28</td>
                                    <td>$19,213</td>
                                    <td>$4,289</td>
                                    <td>$307,890</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>12/28-11/29</td>
                                    <td>$18,940</td>
                                    <td>$4,562</td>
                                    <td>$303,328</td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>12/29-11/30</td>
                                    <td>$18,649</td>
                                    <td>$4,852</td>
                                    <td>$298,475</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="schedule-content" id="monthly-schedule" style="display: none;">
                        <table class="schedule-table">
                            <thead>
                                <tr>
                                    <th>Month</th>
                                    <th>Date</th>
                                    <th>Payment</th>
                                    <th>Interest</th>
                                    <th>Principal</th>
                                    <th>Ending Balance</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Dec 2025</td>
                                    <td>$1,958.45</td>
                                    <td>$1,651.47</td>
                                    <td>$306.98</td>
                                    <td>$319,693.02</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Jan 2026</td>
                                    <td>$1,958.45</td>
                                    <td>$1,649.89</td>
                                    <td>$308.56</td>
                                    <td>$319,384.46</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Feb 2026</td>
                                    <td>$1,958.45</td>
                                    <td>$1,648.30</td>
                                    <td>$310.15</td>
                                    <td>$319,074.31</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="content-section">
        <h2>The Mortgage Calculator helps estimate the monthly payment due along with other financial costs associated with mortgages. There are options to include extra payments or annual percentage increases of common mortgage-related expenses. The calculator is mainly intended for use by U.S. residents.</h2>
        
        <h3>Mortgages</h3>
        <p>
            A mortgage is a loan secured by property, usually real estate property. Lenders define it as the money borrowed 
            to pay for real estate. In essence, the lender helps the buyer pay the seller of a house, and the buyer agrees 
            to repay the money borrowed over a period of time, usually 15 or 30 years in the U.S. Each month, a payment is 
            made from buyer to lender. A portion of the monthly payment is called the principal, which is the original 
            amount borrowed. The other portion is the interest, which is the cost paid to the lender for using the money. 
            There may be an escrow account involved to cover the cost of property taxes and insurance. The buyer cannot be 
            considered the full owner of the mortgaged property until the last monthly payment is made. In the U.S., the 
            most common mortgage loan is the conventional 30-year fixed-interest loan, which represents 70% to 90% of all 
            mortgages. Mortgages are how most people are able to own homes in the U.S.
        </p>
        
        <h3>Mortgage Calculator Components</h3>
        <p>
            A mortgage usually includes the following key components. These are also the basic components of a mortgage calculator.
        </p>
        
        <ul>
            <li><strong>Loan amount</strong>—the amount borrowed from a lender or bank. In a mortgage, this amounts to the purchase price minus any down payment. The maximum loan amount one can borrow normally correlates with household income or affordability. To estimate an affordable amount, please use our House Affordability Calculator.</li>
            <li><strong>Down payment</strong>—the upfront payment of the purchase, usually a percentage of the total price. This is the portion of the purchase price covered by the borrower. Typically, mortgage lenders want the borrower to put 20% or more as a down payment. In some cases, borrowers may put down as low as 3%. If the borrowers make a down payment of less than 20%, they will be required to pay private mortgage insurance (PMI). Borrowers need to hold this insurance until the loan's remaining principal dropped below 80% of the home's original purchase price. A general rule-of-thumb is that the higher the down payment, the more favorable the interest rate and the more likely the loan will be approved.</li>
            <li><strong>Loan term</strong>—the amount of time over which the loan must be repaid in full. Most fixed-rate mortgages are for 15, 20, or 30-year terms. A shorter period, such as 15 or 20 years, typically includes a lower interest rate.</li>
            <li><strong>Interest rate</strong>—the percentage of the loan charged as a cost of borrowing. Mortgages can charge either fixed-rate mortgages (FRM) or adjustable-rate mortgages (ARM). As the name implies, interest rates remain the same for the term of the FRM loan. The calculator above calculates fixed rates only. For ARMs, interest rates are generally fixed for a period of time, after which they will be periodically adjusted based on market indices. ARMs transfer part of the risk to borrowers. Therefore, the initial interest rates are normally 0.5% to 2% lower than FRM with the same loan term. Mortgage interest rates are normally expressed in Annual Percentage Rate (APR), sometimes called nominal APR or effective APR. It is the interest rate expressed as a periodic rate multiplied by the number of compounding periods in a year. For example, if a mortgage rate is 6% APR, it means the borrower will have to pay 6% divided by twelve, which comes out to 0.5% in interest every month.</li>
        </ul>
        
        <h3>Costs Associated with Home Ownership and Mortgages</h3>
        <p>
            Monthly mortgage payments usually comprise the bulk of the financial costs associated with owning a house, but 
            there are other substantial costs to keep in mind. These costs are separated into two categories, recurring and 
            non-recurring.
        </p>
        
        <h4>Recurring Costs</h4>
        <p>
            Most recurring costs persist throughout and beyond the life of a mortgage. They are a significant financial 
            factor. Property taxes, home insurance, HOA fees, and other costs increase with time as a byproduct of inflation. 
            In the calculator, the recurring costs are under the "Include Options Below" checkbox. There are also optional 
            inputs within the calculator for annual percentage increases under "More Options." Using these can result in 
            more accurate calculations.
        </p>
        
        <ul>
            <li><strong>Property taxes</strong>—a tax that property owners pay to governing authorities. In the U.S., property tax is usually managed by municipal or county governments. All 50 states impose taxes on property at the local level. The annual real estate tax in the U.S. varies by location; on average, Americans pay about 1.1% of their property's value as property tax each year.</li>
            <li><strong>Home insurance</strong>—an insurance policy that protects the owner from accidents that may happen to their real estate properties. Home insurance can also contain personal liability coverage, which protects against lawsuits involving injuries that occur on and off the property. The cost of home insurance varies according to factors such as location, condition of the property, and the coverage amount.</li>
            <li><strong>Private mortgage insurance (PMI)</strong>—protects the mortgage lender if the borrower is unable to repay the loan. In the U.S. specifically, if the down payment is less than 20% of the property's value, the lender will normally require the borrower to purchase PMI until the loan-to-value ratio (LTV) reaches 80% or 78%. PMI price varies according to factors such as down payment, size of the loan, and credit of the borrower. The annual cost typically ranges from 0.3% to 1.9% of the loan amount.</li>
            <li><strong>HOA fee</strong>—a fee imposed on the property owner by a homeowner's association (HOA), which is an organization that maintains and improves the property and environment of the neighborhoods within its purview. Condominiums, townhomes, and some single-family homes commonly require the payment of HOA fees. Annual HOA fees usually amount to less than one percent of the property value.</li>
            <li><strong>Other costs</strong>—includes utilities, home maintenance costs, and anything pertaining to the general upkeep of the property. It is common to spend 1% or more of the property value on annual maintenance alone.</li>
        </ul>
        
        <h4>Non-Recurring Costs</h4>
        <p>
            These costs aren't addressed by the calculator, but they are still important to keep in mind.
        </p>
        
        <ul>
            <li><strong>Closing costs</strong>—the fees paid at the closing of a real estate transaction. These are not recurring fees, but they can be expensive. In the U.S., the closing cost on a mortgage can include an attorney fee, the title service cost, recording fee, survey fee, property transfer tax, brokerage commission, mortgage application fee, points, appraisal fee, inspection fee, home warranty, pre-paid home insurance, pro-rata property taxes, pro-rata homeowner association dues, pro-rata interest, and more. These costs typically fall on the buyer, but it is possible to negotiate a "credit" with the seller or the lender. It is not unusual for a buyer to pay about $10,000 in total closing costs on a $400,000 transaction.</li>
            <li><strong>Initial renovations</strong>—some buyers choose to renovate before moving in. Examples of renovations include changing the flooring, repainting the walls, updating the kitchen, or even overhauling the entire interior or exterior. While these expenses can add up quickly, renovation costs are optional, and owners may choose not to address renovation issues immediately.</li>
            <li><strong>Miscellaneous</strong>—new furniture, new appliances, and moving costs are typical non-recurring costs of a home purchase. This also includes repair costs.</li>
        </ul>
        
        <h3>Early Repayment and Extra Payments</h3>
        <p>
            In many situations, mortgage borrowers may want to pay off mortgages earlier rather than later, either in whole 
            or in part, for reasons including but not limited to interest savings, wanting to sell their home, or refinancing. 
            Our calculator can factor in monthly, annual, or one-time extra payments. However, borrowers need to understand 
            the advantages and disadvantages of paying ahead on the mortgage.
        </p>
        
        <h4>Early Repayment Strategies</h4>
        <p>
            Aside from paying off the mortgage loan entirely, typically, there are three main strategies that can be used to 
            repay a mortgage loan earlier. Borrowers mainly adopt these strategies to save on interest. These methods can be 
            used in combination or individually.
        </p>
        
        <ul>
            <li><strong>Make extra payments</strong>—This is simply an extra payment over and above the monthly payment. On typical long-term mortgage loans, a very big portion of the earlier payments will go towards paying down interest rather than the principal. Any extra payments will decrease the loan balance, thereby decreasing interest and allowing the borrower to pay off the loan earlier in the long run. Some people form the habit of paying extra every month, while others pay extra whenever they can. There are optional inputs in the Mortgage Calculator to include many extra payments, and it can be helpful to compare the results of supplementing mortgages with or without extra payments.</li>
            <li><strong>Biweekly payments</strong>—The borrower pays half the monthly payment every two weeks. With 52 weeks in a year, this amounts to 26 payments or 13 months of mortgage repayments during the year. This method is mainly for those who receive their paycheck biweekly. It is easier for them to form a habit of taking a portion from each paycheck to make mortgage payments. Displayed in the calculated results are biweekly payments for comparison purposes.</li>
            <li><strong>Refinance to a loan with a shorter term</strong>—Refinancing involves taking out a new loan to pay off an existing loan. The new loan may have a lower interest rate or a shorter term. Refinancing can be a good option when interest rates drop significantly or when the borrower's credit improves. However, refinancing comes with costs, including closing costs and fees, which need to be weighed against the potential savings.</li>
        </ul>
    </div>
</div>

<script>
// Toggle more options
function toggleOptions() {
    const moreOptions = document.getElementById('more-options');
    const toggleText = document.getElementById('toggle-text');
    
    moreOptions.classList.toggle('active');
    toggleText.textContent = moreOptions.classList.contains('active') ? '- Fewer Options' : '+ More Options';
}

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

// Mortgage calculation
function calculateMortgage() {
    const homePrice = parseFloat(document.getElementById('home-price').value) || 400000;
    const downPaymentPercent = parseFloat(document.getElementById('down-payment').value) || 20;
    const loanTerm = parseFloat(document.getElementById('loan-term').value) || 30;
    const interestRate = parseFloat(document.getElementById('interest-rate').value) || 6.193;
    const propertyTaxes = parseFloat(document.getElementById('property-taxes').value) || 1.2;
    const homeInsurance = parseFloat(document.getElementById('home-insurance').value) || 1500;
    const pmiInsurance = parseFloat(document.getElementById('pmi-insurance').value) || 0;
    const hoaFee = parseFloat(document.getElementById('hoa-fee').value) || 0;
    const otherCosts = parseFloat(document.getElementById('other-costs').value) || 4000;
    
    // Calculate loan amount
    const downPaymentAmount = homePrice * (downPaymentPercent / 100);
    const loanAmount = homePrice - downPaymentAmount;
    
    // Calculate monthly mortgage payment
    const monthlyRate = interestRate / 100 / 12;
    const numberOfPayments = loanTerm * 12;
    const mortgagePayment = loanAmount * monthlyRate * Math.pow(1 + monthlyRate, numberOfPayments) / 
                           (Math.pow(1 + monthlyRate, numberOfPayments) - 1);
    
    // Calculate other monthly costs
    const monthlyPropertyTax = (homePrice * (propertyTaxes / 100)) / 12;
    const monthlyHomeInsurance = homeInsurance / 12;
    const monthlyPMI = pmiInsurance / 12;
    const monthlyHOA = hoaFee / 12;
    const monthlyOtherCosts = otherCosts / 12;
    
    // Calculate total monthly payment
    const totalMonthlyPayment = mortgagePayment + monthlyPropertyTax + monthlyHomeInsurance + 
                               monthlyPMI + monthlyHOA + monthlyOtherCosts;
    
    // Calculate totals
    const totalMortgagePayment = mortgagePayment * numberOfPayments;
    const totalPropertyTax = monthlyPropertyTax * numberOfPayments;
    const totalHomeInsurance = monthlyHomeInsurance * numberOfPayments;
    const totalOtherCosts = monthlyOtherCosts * numberOfPayments;
    const totalPayment = totalMonthlyPayment * numberOfPayments;
    const totalInterest = totalMortgagePayment - loanAmount;
    
    // Calculate payoff date
    const startYear = parseInt(document.getElementById('start-year').value) || 2025;
    const payoffYear = startYear + loanTerm;
    const startMonth = document.getElementById('start-month').options[document.getElementById('start-month').selectedIndex].text;
    const payoffDate = `${startMonth}. ${payoffYear}`;
    
    // Update results
    document.getElementById('monthly-payment').textContent = `$${totalMonthlyPayment.toFixed(2)}`;
    document.getElementById('monthly-breakdown').textContent = `$${totalMonthlyPayment.toFixed(2)}`;
    document.getElementById('total-breakdown').textContent = `$${totalPayment.toFixed(2)}`;
    
    document.getElementById('mortgage-payment').textContent = `$${mortgagePayment.toFixed(2)}`;
    document.getElementById('mortgage-total').textContent = `$${totalMortgagePayment.toFixed(2)}`;
    document.getElementById('tax-payment').textContent = `$${monthlyPropertyTax.toFixed(2)}`;
    document.getElementById('tax-total').textContent = `$${totalPropertyTax.toFixed(2)}`;
    document.getElementById('insurance-payment').textContent = `$${monthlyHomeInsurance.toFixed(2)}`;
    document.getElementById('insurance-total').textContent = `$${totalHomeInsurance.toFixed(2)}`;
    document.getElementById('other-payment').textContent = `$${(monthlyOtherCosts + monthlyPMI + monthlyHOA).toFixed(2)}`;
    document.getElementById('other-total').textContent = `$${(totalOtherCosts + (pmiInsurance * loanTerm) + (hoaFee * loanTerm)).toFixed(2)}`;
    document.getElementById('total-payment').textContent = `$${totalMonthlyPayment.toFixed(2)}`;
    document.getElementById('total-total').textContent = `$${totalPayment.toFixed(2)}`;
    
    document.getElementById('house-price-result').textContent = `$${homePrice.toLocaleString()}`;
    document.getElementById('loan-amount-result').textContent = `$${loanAmount.toLocaleString()}`;
    document.getElementById('down-payment-result').textContent = `$${downPaymentAmount.toLocaleString()}`;
    document.getElementById('total-payments-result').textContent = `$${totalMortgagePayment.toLocaleString()}`;
    document.getElementById('total-interest-result').textContent = `$${totalInterest.toLocaleString()}`;
    document.getElementById('payoff-date').textContent = payoffDate;
    
    // Show results
    document.getElementById('mortgage-results').style.display = 'block';
}

// Initialize with sample calculation
document.addEventListener('DOMContentLoaded', function() {
    calculateMortgage();
});
</script>

<?php
// Include your website's footer
include '../../footer.php';
?>