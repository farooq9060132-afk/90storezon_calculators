<?php
// Include your website's header
include '../../header.php';
?>

<style>
/* Calculator Styles */
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

.calculator-description {
    font-size: 16px;
    color: #5f6368;
    line-height: 1.6;
    margin-bottom: 30px;
}

.definition-list {
    background: #f8f9fa;
    border-radius: 8px;
    padding: 20px;
    margin-bottom: 30px;
}

.definition-list h3 {
    font-size: 20px;
    color: #202124;
    margin-top: 0;
    margin-bottom: 15px;
}

.definition-list ul {
    padding-left: 20px;
    margin-bottom: 0;
}

.definition-list li {
    margin-bottom: 10px;
    line-height: 1.5;
}

.definition-list li:last-child {
    margin-bottom: 0;
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

.calculator-form {
    background: #ffffff;
    border: 1px solid #dadce0;
    border-radius: 8px;
    padding: 30px;
    margin-bottom: 30px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.form-section {
    margin-bottom: 25px;
}

.form-section h3 {
    font-size: 18px;
    color: #202124;
    margin-top: 0;
    margin-bottom: 20px;
}

.input-group {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
}

.input-group:last-child {
    margin-bottom: 0;
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
    flex: 1;
}

.input-wrapper input {
    padding: 10px 12px;
    border: 1px solid #dadce0;
    border-radius: 4px;
    font-size: 15px;
    width: 120px;
    margin-right: 10px;
}

.input-wrapper select {
    padding: 10px 12px;
    border: 1px solid #dadce0;
    border-radius: 4px;
    font-size: 15px;
    width: 150px;
    margin-right: 10px;
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
}

.calculate-btn:hover {
    background: #0041cc;
}

.results-section {
    background: #ffffff;
    border: 1px solid #dadce0;
    border-radius: 8px;
    padding: 30px;
    margin-bottom: 30px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.results-section h3 {
    font-size: 18px;
    color: #202124;
    margin-top: 0;
    margin-bottom: 20px;
}

.result-item {
    display: flex;
    justify-content: space-between;
    padding: 12px 0;
    border-bottom: 1px solid #f1f3f4;
}

.result-item:last-child {
    border-bottom: none;
}

.result-label {
    font-size: 15px;
    color: #202124;
}

.result-value {
    font-size: 15px;
    font-weight: 500;
    color: #202124;
}

.chart-container {
    margin: 25px 0;
    text-align: center;
}

.chart-container h4 {
    font-size: 16px;
    color: #202124;
    margin-bottom: 15px;
}

.pie-chart {
    width: 200px;
    height: 200px;
    border-radius: 50%;
    margin: 0 auto;
    position: relative;
    background: conic-gradient(#0052FF 75%, #FF6B6B 0 100%);
}

.chart-legend {
    display: flex;
    justify-content: center;
    gap: 30px;
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

.amortization-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    font-size: 14px;
}

.amortization-table th {
    background: #f8f9fa;
    padding: 12px 15px;
    text-align: left;
    border: 1px solid #dadce0;
    font-weight: 500;
    color: #202124;
}

.amortization-table td {
    padding: 10px 15px;
    border: 1px solid #dadce0;
    color: #202124;
}

.amortization-table tr:nth-child(even) {
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

.related-calculators {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 20px;
    margin-top: 30px;
}

.related-calculator {
    background: #f8f9fa;
    border: 1px solid #dadce0;
    border-radius: 8px;
    padding: 20px;
    transition: all 0.3s ease;
}

.related-calculator:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    border-color: #0052FF;
}

.related-calculator h4 {
    font-size: 16px;
    color: #202124;
    margin-top: 0;
    margin-bottom: 10px;
}

.related-calculator p {
    font-size: 14px;
    color: #5f6368;
    margin-bottom: 15px;
    line-height: 1.5;
}

.related-link {
    color: #0052FF;
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
}

.related-link:hover {
    text-decoration: underline;
}

@media (max-width: 768px) {
    .calculator-container {
        padding: 0 15px;
        margin: 20px auto;
    }
    
    .calculator-title {
        font-size: 28px;
    }
    
    .tabs {
        flex-wrap: wrap;
    }
    
    .tab {
        padding: 10px 15px;
        font-size: 14px;
    }
    
    .input-group {
        flex-wrap: wrap;
    }
    
    .input-group label {
        min-width: 120px;
    }
    
    .input-wrapper input, .input-wrapper select {
        width: 100px;
        font-size: 14px;
    }
    
    .chart-legend {
        flex-wrap: wrap;
        gap: 15px;
    }
    
    .related-calculators {
        grid-template-columns: 1fr;
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
    
    .calculator-form, .results-section, .content-section {
        padding: 20px;
    }
    
    .input-group {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .input-group label {
        margin-bottom: 8px;
        min-width: auto;
    }
    
    .input-wrapper {
        width: 100%;
    }
    
    .input-wrapper input, .input-wrapper select {
        width: calc(100% - 110px);
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
        <a href="/calculators/?category=financial">Financial</a>
        <span>/</span>
        <span>Loan Calculator</span>
    </div>
    
    <h1 class="calculator-title">Loan Calculator</h1>
    
    <p class="calculator-description">
        A loan is a contract between a borrower and a lender in which the borrower receives an amount of money (principal) 
        that they are obligated to pay back in the future. Most loans can be categorized into one of three categories:
    </p>
    
    <div class="definition-list">
        <h3>Types of Loans:</h3>
        <ul>
            <li><strong>Amortized Loan:</strong> Fixed payments paid periodically until loan maturity</li>
            <li><strong>Deferred Payment Loan:</strong> Single lump sum paid at loan maturity</li>
            <li><strong>Bond:</strong> Predetermined lump sum paid at loan maturity (the face or par value of a bond)</li>
        </ul>
    </div>
    
    <div class="tabs">
        <div class="tab active" data-tab="amortized">Amortized Loan</div>
        <div class="tab" data-tab="deferred">Deferred Payment Loan</div>
        <div class="tab" data-tab="bond">Bond</div>
    </div>
    
    <div class="calculator-form">
        <div class="form-section" id="amortized-form">
            <h3>Amortized Loan: Paying Back a Fixed Amount Periodically</h3>
            <p>Use this calculator for basic calculations of common loan types such as mortgages, auto loans, student loans, or personal loans.</p>
            
            <div class="input-group">
                <label>Loan Amount</label>
                <div class="input-wrapper">
                    <input type="number" id="loan-amount" value="100000" min="0">
                    <span>(USD)</span>
                </div>
            </div>
            
            <div class="input-group">
                <label>Loan Term</label>
                <div class="input-wrapper">
                    <input type="number" id="loan-years" value="10" min="0">
                    <span>years</span>
                    <input type="number" id="loan-months" value="0" min="0" max="11">
                    <span>months</span>
                </div>
            </div>
            
            <div class="input-group">
                <label>Interest Rate</label>
                <div class="input-wrapper">
                    <input type="number" id="interest-rate" value="6" min="0" step="0.01">
                    <span>%</span>
                </div>
            </div>
            
            <div class="input-group">
                <label>Compound</label>
                <div class="input-wrapper">
                    <select id="compound">
                        <option value="monthly">Monthly (APR)</option>
                        <option value="annually">Annually (APY)</option>
                    </select>
                </div>
            </div>
            
            <div class="input-group">
                <label>Pay Back</label>
                <div class="input-wrapper">
                    <select id="pay-back">
                        <option value="month">Every Month</option>
                        <option value="year">Every Year</option>
                    </select>
                </div>
            </div>
            
            <button class="calculate-btn" onclick="calculateAmortized()">Calculate</button>
        </div>
        
        <div class="form-section" id="deferred-form" style="display: none;">
            <h3>Deferred Payment Loan: Paying Back a Lump Sum Due at Maturity</h3>
            
            <div class="input-group">
                <label>Loan Amount</label>
                <div class="input-wrapper">
                    <input type="number" id="deferred-loan-amount" value="100000" min="0">
                    <span>(USD)</span>
                </div>
            </div>
            
            <div class="input-group">
                <label>Loan Term</label>
                <div class="input-wrapper">
                    <input type="number" id="deferred-loan-years" value="10" min="0">
                    <span>years</span>
                    <input type="number" id="deferred-loan-months" value="0" min="0" max="11">
                    <span>months</span>
                </div>
            </div>
            
            <div class="input-group">
                <label>Interest Rate</label>
                <div class="input-wrapper">
                    <input type="number" id="deferred-interest-rate" value="6" min="0" step="0.01">
                    <span>%</span>
                </div>
            </div>
            
            <div class="input-group">
                <label>Compound</label>
                <div class="input-wrapper">
                    <select id="deferred-compound">
                        <option value="annually">Annually (APY)</option>
                        <option value="monthly">Monthly (APR)</option>
                    </select>
                </div>
            </div>
            
            <button class="calculate-btn" onclick="calculateDeferred()">Calculate</button>
        </div>
        
        <div class="form-section" id="bond-form" style="display: none;">
            <h3>Bond: Paying Back a Predetermined Amount Due at Loan Maturity</h3>
            <p>Use this calculator to compute the initial value of a bond/loan based on a predetermined face value to be paid back at bond/loan maturity.</p>
            
            <div class="input-group">
                <label>Predetermined Due Amount</label>
                <div class="input-wrapper">
                    <input type="number" id="bond-due-amount" value="100000" min="0">
                    <span>(USD)</span>
                </div>
            </div>
            
            <div class="input-group">
                <label>Loan Term</label>
                <div class="input-wrapper">
                    <input type="number" id="bond-loan-years" value="10" min="0">
                    <span>years</span>
                    <input type="number" id="bond-loan-months" value="0" min="0" max="11">
                    <span>months</span>
                </div>
            </div>
            
            <div class="input-group">
                <label>Interest Rate</label>
                <div class="input-wrapper">
                    <input type="number" id="bond-interest-rate" value="6" min="0" step="0.01">
                    <span>%</span>
                </div>
            </div>
            
            <div class="input-group">
                <label>Compound</label>
                <div class="input-wrapper">
                    <select id="bond-compound">
                        <option value="annually">Annually (APY)</option>
                        <option value="monthly">Monthly (APR)</option>
                    </select>
                </div>
            </div>
            
            <button class="calculate-btn" onclick="calculateBond()">Calculate</button>
        </div>
    </div>
    
    <div class="results-section">
        <h3>Results:</h3>
        <div id="results-content">
            <p>Modify the values and click the calculate button to use</p>
        </div>
        <div class="chart-container" id="chart-container" style="display: none;">
            <h4>Principal vs Interest</h4>
            <div class="pie-chart" id="pie-chart"></div>
            <div class="chart-legend">
                <div class="legend-item">
                    <div class="legend-color legend-principal"></div>
                    <span class="legend-label">Principal</span>
                </div>
                <div class="legend-item">
                    <div class="legend-color legend-interest"></div>
                    <span class="legend-label">Interest</span>
                </div>
            </div>
        </div>
        <button class="calculate-btn" style="margin-top: 20px;" onclick="saveCalculation()" id="save-btn" style="display: none;">Save this calculation</button>
    </div>
    
    <div class="content-section">
        <h2>Amortized Loan: Fixed Amount Paid Periodically</h2>
        <p>
            Many consumer loans fall into this category of loans that have regular payments that are amortized uniformly over their lifetime. 
            Routine payments are made on principal and interest until the loan reaches maturity (is entirely paid off). Some of the most familiar 
            amortized loans include mortgages, car loans, student loans, and personal loans. The word "loan" will probably refer to this type in 
            everyday conversation, not the type in the second or third calculation. Below are links to calculators related to loans that fall under 
            this category, which can provide more information or allow specific calculations involving each type of loan. Instead of using this 
            Loan Calculator, it may be more useful to use any of the following for each specific need:
        </p>
        
        <div class="related-calculators">
            <div class="related-calculator">
                <h4>Mortgage Calculator</h4>
                <p>Calculate monthly mortgage payments and total interest costs.</p>
                <a href="/calculators/mortgage-calculator/" class="related-link">Calculate Now →</a>
            </div>
            <div class="related-calculator">
                <h4>Auto Loan Calculator</h4>
                <p>Determine car loan payments and total financing costs.</p>
                <a href="/calculators/auto-loan-calculator/" class="related-link">Calculate Now →</a>
            </div>
            <div class="related-calculator">
                <h4>Student Loan Calculator</h4>
                <p>Estimate student loan payments and repayment schedules.</p>
                <a href="/calculators/student-loan-calculator/" class="related-link">Calculate Now →</a>
            </div>
            <div class="related-calculator">
                <h4>Personal Loan Calculator</h4>
                <p>Calculate personal loan payments and total interest.</p>
                <a href="/calculators/payment-calculator/" class="related-link">Calculate Now →</a>
            </div>
        </div>
        
        <h3>Deferred Payment Loan: Single Lump Sum Due at Loan Maturity</h3>
        <p>
            Many commercial loans or short-term loans are in this category. Unlike the first calculation, which is amortized with payments 
            spread uniformly over their lifetimes, these loans have a single, large lump sum due at maturity. Some loans, such as balloon loans, 
            can also have smaller routine payments during their lifetimes, but this calculation only works for loans with a single payment of 
            all principal and interest due at maturity.
        </p>
        
        <h3>Bond: Predetermined Lump Sum Paid at Loan Maturity</h3>
        <p>
            This kind of loan is rarely made except in the form of bonds. Technically, bonds operate differently from more conventional loans 
            in that borrowers make a predetermined payment at maturity. The face, or par value of a bond, is the amount paid by the issuer 
            (borrower) when the bond matures, assuming the borrower doesn't default. Face value denotes the amount received at maturity.
        </p>
        <p>
            Two common bond types are coupon and zero-coupon bonds. With coupon bonds, lenders base coupon interest payments on a percentage 
            of the face value. Coupon interest payments occur at predetermined intervals, usually annually or semi-annually. Zero-coupon bonds 
            do not pay interest directly. Instead, borrowers sell bonds at a deep discount to their face value, then pay the face value when 
            the bond matures. Users should note that the calculator above runs calculations for zero-coupon bonds.
        </p>
        <p>
            After a borrower issues a bond, its value will fluctuate based on interest rates, market forces, and many other factors. While this 
            does not change the bond's value at maturity, a bond's market price can still vary during its lifetime.
        </p>
        
        <h2>Loan Basics for Borrowers</h2>
        
        <h3>Interest Rate</h3>
        <p>
            Nearly all loan structures include interest, which is the profit that banks or lenders make on loans. Interest rate is the percentage 
            of a loan paid by borrowers to lenders. For most loans, interest is paid in addition to principal repayment. Loan interest is usually 
            expressed in APR, or annual percentage rate, which includes both interest and fees. The rate usually published by banks for saving 
            accounts, money market accounts, and CDs is the annual percentage yield, or APY. It is important to understand the difference between 
            APR and APY. Borrowers seeking loans can calculate the actual interest paid to lenders based on their advertised rates by using the 
            Interest Calculator. For more information about or to do calculations involving APR, please visit the APR Calculator.
        </p>
        
        <h3>Compounding Frequency</h3>
        <p>
            Compound interest is interest that is earned not only on the initial principal but also on accumulated interest from previous periods. 
            Generally, the more frequently compounding occurs, the higher the total amount due on the loan. In most loans, compounding occurs 
            monthly. Use the Compound Interest Calculator to learn more about or do calculations involving compound interest.
        </p>
        
        <h3>Loan Term</h3>
        <p>
            A loan term is the duration of the loan, given that required minimum payments are made each month. The term of the loan can affect 
            the structure of the loan in many ways. Generally, the longer the term, the more interest will be accrued over time, raising the 
            total cost of the loan for borrowers, but reducing the periodic payments.
        </p>
        
        <h3>Consumer Loans</h3>
        <p>There are two basic kinds of consumer loans: secured or unsecured.</p>
        
        <h4>Secured Loans</h4>
        <p>
            A secured loan means that the borrower has put up some asset as a form of collateral before being granted a loan. The lender is 
            issued a lien, which is a right to possession of property belonging to another person until a debt is paid. In other words, 
            defaulting on a secured loan will give the loan issuer the legal ability to seize the asset that was put up as collateral. The most 
            common secured loans are mortgages and auto loans. In these examples, the lender holds the deed or title, which is a representation 
            of ownership, until the secured loan is fully paid. Defaulting on a mortgage typically results in the bank foreclosing on a home, 
            while not paying a car loan means that the lender can repossess the car.
        </p>
        <p>
            Lenders are generally hesitant to lend large amounts of money with no guarantee. Secured loans reduce the risk of the borrower 
            defaulting since they risk losing whatever asset they put up as collateral. If the collateral is worth less than the outstanding 
            debt, the borrower can still be liable for the remainder of the debt.
        </p>
        <p>
            Secured loans generally have a higher chance of approval compared to unsecured loans and can be a better option for those who 
            would not qualify for an unsecured loan.
        </p>
        
        <h4>Unsecured Loans</h4>
        <p>
            An unsecured loan is an agreement to pay a loan back without collateral. Because there is no collateral involved, lenders need a 
            way to verify the financial integrity of their borrowers. This can be achieved through the five C's of credit, which is a common 
            methodology used by lenders to gauge the creditworthiness of potential borrowers.
        </p>
        <p>
            Unsecured loans generally feature higher interest rates, lower borrowing limits, and shorter repayment terms than secured loans. 
            Lenders may sometimes require a co-signer (a person who agrees to pay a borrower's debt if they default) for unsecured loans if 
            the lender deems the borrower as risky.
        </p>
        <p>
            If borrowers do not repay unsecured loans, lenders may hire a collection agency. Collection agencies are companies that recover 
            funds for past due payments or accounts in default.
        </p>
        <p>
            Examples of unsecured loans include credit cards, personal loans, and student loans. Please visit our Credit Card Calculator, 
            Personal Loan Calculator, or Student Loan Calculator for more information or to do calculations involving each of them.
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
        
        // Hide all forms
        document.getElementById('amortized-form').style.display = 'none';
        document.getElementById('deferred-form').style.display = 'none';
        document.getElementById('bond-form').style.display = 'none';
        
        // Show the selected form
        const tabType = this.getAttribute('data-tab');
        document.getElementById(`${tabType}-form`).style.display = 'block';
        
        // Reset results
        document.getElementById('results-content').innerHTML = '<p>Modify the values and click the calculate button to use</p>';
        document.getElementById('chart-container').style.display = 'none';
        document.getElementById('save-btn').style.display = 'none';
    });
});

// Amortized Loan Calculation
function calculateAmortized() {
    const loanAmount = parseFloat(document.getElementById('loan-amount').value) || 0;
    const years = parseInt(document.getElementById('loan-years').value) || 0;
    const months = parseInt(document.getElementById('loan-months').value) || 0;
    const annualRate = parseFloat(document.getElementById('interest-rate').value) || 0;
    const compound = document.getElementById('compound').value;
    const payBack = document.getElementById('pay-back').value;
    
    const totalMonths = years * 12 + months;
    if (totalMonths <= 0 || loanAmount <= 0) {
        alert("Please enter valid loan amount and term.");
        return;
    }
    
    let monthlyRate, totalPayments;
    if (compound === 'monthly') {
        monthlyRate = annualRate / 100 / 12;
        totalPayments = totalMonths;
    } else {
        // For annually compounded, convert to equivalent monthly rate
        const annualRateDecimal = annualRate / 100;
        monthlyRate = Math.pow(1 + annualRateDecimal, 1/12) - 1;
        totalPayments = totalMonths;
    }
    
    // Calculate monthly payment
    const payment = (loanAmount * monthlyRate * Math.pow(1 + monthlyRate, totalPayments)) / 
                   (Math.pow(1 + monthlyRate, totalPayments) - 1);
    
    const totalPayment = payment * totalPayments;
    const totalInterest = totalPayment - loanAmount;
    
    // Format currency
    const formatter = new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD',
        minimumFractionDigits: 2
    });
    
    let resultsHTML = `
        <div class="result-item">
            <span class="result-label">Payment Every ${payBack === 'month' ? 'Month' : 'Year'}:</span>
            <span class="result-value">${formatter.format(payment)}</span>
        </div>
        <div class="result-item">
            <span class="result-label">Total of ${totalPayments} Payments:</span>
            <span class="result-value">${formatter.format(totalPayment)}</span>
        </div>
        <div class="result-item">
            <span class="result-label">Total Interest:</span>
            <span class="result-value">${formatter.format(totalInterest)}</span>
        </div>
    `;
    
    document.getElementById('results-content').innerHTML = resultsHTML;
    
    // Update chart
    updateChart(loanAmount, totalInterest);
    
    // Show save button
    document.getElementById('save-btn').style.display = 'inline-block';
}

// Deferred Payment Loan Calculation
function calculateDeferred() {
    const loanAmount = parseFloat(document.getElementById('deferred-loan-amount').value) || 0;
    const years = parseInt(document.getElementById('deferred-loan-years').value) || 0;
    const months = parseInt(document.getElementById('deferred-loan-months').value) || 0;
    const annualRate = parseFloat(document.getElementById('deferred-interest-rate').value) || 0;
    const compound = document.getElementById('deferred-compound').value;
    
    const totalYears = years + months / 12;
    if (totalYears <= 0 || loanAmount <= 0) {
        alert("Please enter valid loan amount and term.");
        return;
    }
    
    let amountDue;
    if (compound === 'annually') {
        amountDue = loanAmount * Math.pow(1 + annualRate / 100, totalYears);
    } else {
        // Monthly compounding
        const monthlyRate = annualRate / 100 / 12;
        const totalMonths = totalYears * 12;
        amountDue = loanAmount * Math.pow(1 + monthlyRate, totalMonths);
    }
    
    const totalInterest = amountDue - loanAmount;
    
    // Format currency
    const formatter = new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD',
        minimumFractionDigits: 2
    });
    
    let resultsHTML = `
        <div class="result-item">
            <span class="result-label">Amount Due at Loan Maturity:</span>
            <span class="result-value">${formatter.format(amountDue)}</span>
        </div>
        <div class="result-item">
            <span class="result-label">Total Interest:</span>
            <span class="result-value">${formatter.format(totalInterest)}</span>
        </div>
    `;
    
    document.getElementById('results-content').innerHTML = resultsHTML;
    
    // Update chart
    updateChart(loanAmount, totalInterest);
    
    // Show save button
    document.getElementById('save-btn').style.display = 'inline-block';
}

// Bond Calculation
function calculateBond() {
    const dueAmount = parseFloat(document.getElementById('bond-due-amount').value) || 0;
    const years = parseInt(document.getElementById('bond-loan-years').value) || 0;
    const months = parseInt(document.getElementById('bond-loan-months').value) || 0;
    const annualRate = parseFloat(document.getElementById('bond-interest-rate').value) || 0;
    const compound = document.getElementById('bond-compound').value;
    
    const totalYears = years + months / 12;
    if (totalYears <= 0 || dueAmount <= 0) {
        alert("Please enter valid due amount and term.");
        return;
    }
    
    let presentValue;
    if (compound === 'annually') {
        presentValue = dueAmount / Math.pow(1 + annualRate / 100, totalYears);
    } else {
        // Monthly compounding
        const monthlyRate = annualRate / 100 / 12;
        const totalMonths = totalYears * 12;
        presentValue = dueAmount / Math.pow(1 + monthlyRate, totalMonths);
    }
    
    const totalInterest = dueAmount - presentValue;
    
    // Format currency
    const formatter = new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD',
        minimumFractionDigits: 2
    });
    
    let resultsHTML = `
        <div class="result-item">
            <span class="result-label">Amount Received When the Loan Starts:</span>
            <span class="result-value">${formatter.format(presentValue)}</span>
        </div>
        <div class="result-item">
            <span class="result-label">Total Interest:</span>
            <span class="result-value">${formatter.format(totalInterest)}</span>
        </div>
    `;
    
    document.getElementById('results-content').innerHTML = resultsHTML;
    
    // Update chart
    updateChart(presentValue, totalInterest);
    
    // Show save button
    document.getElementById('save-btn').style.display = 'inline-block';
}

// Update pie chart
function updateChart(principal, interest) {
    const total = principal + interest;
    const principalPercent = (principal / total) * 100;
    const interestPercent = (interest / total) * 100;
    
    // Create gradient for pie chart
    const pieChart = document.getElementById('pie-chart');
    pieChart.style.background = `conic-gradient(#0052FF 0% ${principalPercent}%, #FF6B6B ${principalPercent}% 100%)`;
    
    // Show chart container
    document.getElementById('chart-container').style.display = 'block';
}

// Save calculation function
function saveCalculation() {
    alert("Calculation saved! (This is a demo function)");
}

// Initialize with amortized loan calculation
document.addEventListener('DOMContentLoaded', function() {
    calculateAmortized();
});
</script>

<?php
// Include your website's footer
include '../../footer.php';
?>