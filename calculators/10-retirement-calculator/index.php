<?php
// Include your website's header
include '../../header.php';
?>

<style>
/* Retirement Calculator Styles */
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

.calculator-section {
    background: #ffffff;
    border: 1px solid #dadce0;
    border-radius: 8px;
    padding: 30px;
    margin-bottom: 30px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.section-title {
    font-size: 20px;
    font-weight: bold;
    color: #202124;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 1px solid #f1f3f4;
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
    min-width: 220px;
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

.result-grid {
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
    font-size: 18px;
    font-weight: bold;
    color: #0052FF;
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
    background: conic-gradient(#0052FF 70%, #4CAF50 0 85%, #FFC107 0 100%);
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

.legend-current {
    background: #0052FF;
}

.legend-savings {
    background: #4CAF50;
}

.legend-withdrawal {
    background: #FFC107;
}

.legend-label {
    font-size: 14px;
    color: #5f6368;
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
    
    .result-grid {
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
    
    .result-grid {
        grid-template-columns: 1fr 1fr;
    }
    
    .chart-legend {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
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
    
    .calculate-btn {
        width: 100%;
        padding: 12px;
        font-size: 15px;
    }
    
    .result-grid {
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
        <span>Retirement Calculator</span>
    </div>
    
    <h1 class="calculator-title">Retirement Calculator</h1>
    
    <div class="calculator-section">
        <p>Modify the values and click the calculate button to use</p>
        <p><strong>How much do you need to retire?</strong></p>
        <p>This calculator can help with planning the financial aspects of your retirement, such as providing an idea where you stand in terms of retirement savings, how much to save to reach your target, and what your retrievals will look like in retirement.</p>
        
        <div class="input-grid">
            <div class="input-group">
                <label>Your current age</label>
                <div class="input-wrapper">
                    <input type="number" id="current-age" value="35" min="18" max="100">
                </div>
            </div>
            
            <div class="input-group">
                <label>Your planned retirement age</label>
                <div class="input-wrapper">
                    <input type="number" id="retirement-age" value="67" min="50" max="80">
                </div>
            </div>
            
            <div class="input-group">
                <label>Your life expectancy ?</label>
                <div class="input-wrapper">
                    <input type="number" id="life-expectancy" value="85" min="70" max="120">
                    <span>years</span>
                </div>
            </div>
            
            <div class="input-group">
                <label>Your current pre-tax income</label>
                <div class="input-wrapper">
                    <input type="number" id="current-income" value="70000" min="0" step="1000">
                    <span>/year</span>
                </div>
            </div>
            
            <div class="input-group">
                <label>Your current income increase</label>
                <div class="input-wrapper">
                    <input type="number" id="income-increase" value="3" min="0" step="0.1">
                    <span>%/year</span>
                </div>
            </div>
            
            <div class="input-group">
                <label>Income needed after retirement ?</label>
                <div class="input-wrapper">
                    <input type="number" id="income-needed" value="75" min="0" max="100">
                    <span>% of current income</span>
                </div>
            </div>
            
            <div class="input-group">
                <label>Average investment return</label>
                <div class="input-wrapper">
                    <input type="number" id="investment-return" value="6" min="0" step="0.1">
                    <span>%/year</span>
                </div>
            </div>
            
            <div class="input-group">
                <label>Inflation rate ?</label>
                <div class="input-wrapper">
                    <input type="number" id="inflation-rate" value="3" min="0" step="0.1">
                    <span>%/year</span>
                </div>
            </div>
            
            <div class="input-group">
                <label>Other income after retirement ?</label>
                <div class="input-wrapper">
                    <input type="number" id="other-income" value="0" min="0" step="100">
                    <span>/month (social security, pension, etc)</span>
                </div>
            </div>
            
            <div class="input-group">
                <label>Your current retirement savings</label>
                <div class="input-wrapper">
                    <input type="number" id="current-savings" value="30000" min="0" step="1000">
                </div>
            </div>
            
            <div class="input-group">
                <label>Future retirement savings</label>
                <div class="input-wrapper">
                    <input type="number" id="future-savings" value="10" min="0" max="100">
                    <span>% of income</span>
                </div>
            </div>
        </div>
        
        <button class="calculate-btn" onclick="calculateRetirement()">Calculate</button>
        
        <div id="retirement-results" class="results-section" style="display: none;">
            <h3 class="result-title">Retirement Planning Results</h3>
            
            <div class="result-grid">
                <div class="result-item">
                    <div class="result-label">Years Until Retirement</div>
                    <div class="result-value" id="years-until-retirement">32</div>
                </div>
                <div class="result-item">
                    <div class="result-label">Retirement Savings Needed</div>
                    <div class="result-value" id="savings-needed">$600,000</div>
                </div>
                <div class="result-item">
                    <div class="result-label">Current Savings</div>
                    <div class="result-value" id="current-savings-display">$30,000</div>
                </div>
            </div>
            
            <div class="result-grid">
                <div class="result-item">
                    <div class="result-label">Monthly Savings Required</div>
                    <div class="result-value" id="monthly-savings-required">$500</div>
                </div>
                <div class="result-item">
                    <div class="result-label">Annual Withdrawal Amount</div>
                    <div class="result-value" id="annual-withdrawal">$42,000</div>
                </div>
                <div class="result-item">
                    <div class="result-label">Monthly Withdrawal Amount</div>
                    <div class="result-value" id="monthly-withdrawal">$3,500</div>
                </div>
            </div>
            
            <div class="chart-container">
                <h4 class="chart-title">Retirement Savings Projection</h4>
                <div class="pie-chart" id="retirement-chart"></div>
                <div class="chart-legend">
                    <div class="legend-item">
                        <div class="legend-color legend-current"></div>
                        <span class="legend-label">Current Savings (5%)</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color legend-savings"></div>
                        <span class="legend-label">Future Savings (65%)</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color legend-withdrawal"></div>
                        <span class="legend-label">Withdrawals (30%)</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="calculator-section">
        <h3 class="section-title">How can you save for retirement?</h3>
        <p>This calculation presents potential savings plans based on desired savings at retirement.</p>
        
        <div class="input-grid">
            <div class="input-group">
                <label>Your age now</label>
                <div class="input-wrapper">
                    <input type="number" id="savings-age-now" value="35" min="18" max="100">
                </div>
            </div>
            
            <div class="input-group">
                <label>Your planned retirement age</label>
                <div class="input-wrapper">
                    <input type="number" id="savings-retirement-age" value="67" min="50" max="80">
                </div>
            </div>
            
            <div class="input-group">
                <label>Amount needed at the retirement age</label>
                <div class="input-wrapper">
                    <input type="number" id="savings-needed" value="600000" min="0" step="1000">
                </div>
            </div>
            
            <div class="input-group">
                <label>Your retirement savings now</label>
                <div class="input-wrapper">
                    <input type="number" id="savings-current" value="30000" min="0" step="1000">
                </div>
            </div>
            
            <div class="input-group">
                <label>Average investment return</label>
                <div class="input-wrapper">
                    <input type="number" id="savings-return" value="6" min="0" step="0.1">
                    <span>%</span>
                </div>
            </div>
        </div>
        
        <button class="calculate-btn" onclick="calculateSavingsPlan()">Calculate Savings Plan</button>
    </div>
    
    <div class="calculator-section">
        <h3 class="section-title">How much can you withdraw after retirement?</h3>
        <p>This calculation estimates the amount a person can withdraw every month in retirement.</p>
        
        <div class="input-grid">
            <div class="input-group">
                <label>Your age now</label>
                <div class="input-wrapper">
                    <input type="number" id="withdraw-age-now" value="35" min="18" max="100">
                </div>
            </div>
            
            <div class="input-group">
                <label>Your planned retirement age</label>
                <div class="input-wrapper">
                    <input type="number" id="withdraw-retirement-age" value="67" min="50" max="80">
                </div>
            </div>
            
            <div class="input-group">
                <label>Your life expectancy</label>
                <div class="input-wrapper">
                    <input type="number" id="withdraw-life-expectancy" value="85" min="70" max="120">
                </div>
            </div>
            
            <div class="input-group">
                <label>Your retirement savings today</label>
                <div class="input-wrapper">
                    <input type="number" id="withdraw-savings" value="30000" min="0" step="1000">
                </div>
            </div>
            
            <div class="input-group">
                <label>Annual contribution</label>
                <div class="input-wrapper">
                    <input type="number" id="annual-contribution" value="0" min="0" step="100">
                </div>
            </div>
            
            <div class="input-group">
                <label>Monthly contribution</label>
                <div class="input-wrapper">
                    <input type="number" id="monthly-contribution" value="500" min="0" step="100">
                </div>
            </div>
            
            <div class="input-group">
                <label>Average investment return</label>
                <div class="input-wrapper">
                    <input type="number" id="withdraw-return" value="6" min="0" step="0.1">
                    <span>%</span>
                </div>
            </div>
            
            <div class="input-group">
                <label>Inflation rate (annual)</label>
                <div class="input-wrapper">
                    <input type="number" id="withdraw-inflation" value="3" min="0" step="0.1">
                    <span>%</span>
                </div>
            </div>
        </div>
        
        <button class="calculate-btn" onclick="calculateWithdrawal()">Calculate Withdrawal</button>
    </div>
    
    <div class="calculator-section">
        <h3 class="section-title">How long can your money last?</h3>
        <p>This calculator estimates how long your savings can last at a given withdrawal rate.</p>
        
        <div class="input-grid">
            <div class="input-group">
                <label>The amount you have</label>
                <div class="input-wrapper">
                    <input type="number" id="money-amount" value="600000" min="0" step="1000">
                </div>
            </div>
            
            <div class="input-group">
                <label>You plan to withdraw</label>
                <div class="input-wrapper">
                    <input type="number" id="withdrawal-amount" value="5000" min="0" step="100">
                    <span>/month</span>
                </div>
            </div>
            
            <div class="input-group">
                <label>Average investment return</label>
                <div class="input-wrapper">
                    <input type="number" id="money-return" value="6" min="0" step="0.1">
                    <span>%</span>
                </div>
            </div>
        </div>
        
        <button class="calculate-btn" onclick="calculateMoneyDuration()">Calculate Duration</button>
    </div>
    
    <div class="content-section">
        <h2>Related</h2>
        <div class="related-calculators">
            <a href="/calculators/401k-calculator/" class="related-link">401K Calculator</a> | 
            <a href="/calculators/roth-ira-calculator/" class="related-link">Roth IRA Calculator</a> | 
            <a href="/calculators/investment-calculator/" class="related-link">Investment Calculator</a>
        </div>
        
        <h2>What is Retirement?</h2>
        <p>
            To retire is to withdraw from active working life, and for most retirees, retirement lasts the rest of their lives.
        </p>
        
        <h3>Why Retire?</h3>
        <p>
            There are many factors at play that ultimately affect a person's decision to retire. Physical or mental health can 
            affect a person's decision to retire; if a worker is not physically strong enough, succumbs to a disability, or has 
            mentally declined too much to perform the duties of their job, they should probably consider retiring, or at the very 
            least try to find a new occupation that better accommodates their health. Also, stressors associated with an 
            occupation can become too unbearable, leading to a decline in satisfaction with work. Age is also a factor that 
            affects a person's decision to retire. Theoretically, retirement can happen during any normal working year. Some may 
            choose to "semi-retire" by gradually decreasing their work hours as they approach retirement. Some announce 
            retirement and enter it short-term, just to rejoin the workforce again. However, it generally occurs between the 
            ages of 55 and 70.
        </p>
        
        <p>
            One of the most important factors that affect a person's decision to retire is whether it is even financially 
            possible in the first place. While it is somewhat possible to retire with nothing in savings and to rely solely on 
            Social Security (which an unfortunately significant number of Americans in the U.S. do), it is generally a bad idea 
            for most due to the sheer difference between a working income as opposed to the Social Security benefits. In the 
            U.S., Social Security benefits are only designed to replace about 40% of the average worker's wages during retirement.
        </p>
        
        <p>
            Retirement is an important consideration for everyone, and when not forced to retire due to various reasons such as 
            illness or disability, most people choose to retire when they are ready and comfortable with the decision.
        </p>
        
        <h3>How Much to Save for Retirement</h3>
        <p>
            Naturally, the next question becomes: how much should a person save for retirement? Simply put, it's an extremely 
            loaded question with very few definite answers. Similar to the answer to the question of whether to retire or not, 
            it will depend on each person, and factors such as how much income will be needed, entitlement for Social Security 
            retirement benefits, health and life expectancy, personal preferences regarding inheritances, and many other things.
        </p>
        
        <p><strong>Below are some general guidelines.</strong></p>
        
        <h4>10% Rule</h4>
        <p>
            This rule suggests that a person save 10% to 15% of their pre-tax income per year during their working years. For 
            instance, a person who makes $50,000 a year would put away anywhere from $5,000 to $7,500 for that year. Roughly 
            speaking, by saving 10% starting at age 25, a $1 million nest egg by the time of retirement is possible.
        </p>
        
        <h4>80% Rule</h4>
        <p>
            Another popular rule suggests that an income of 70% to 80% of a worker's pre-retirement income can maintain a 
            retiree's standard of living after retirement. For example, if a person made roughly $100,000 a year on average 
            during his working life, this person can have a similar standard of living with $70,000 - $80,000 a year of income 
            after retirement. This 70% - 80% figure can vary greatly depending on how people envision their retirements. Some 
            retirees want to sail a yacht around the world, while others want to live in a simple cabin in the woods.
        </p>
        
        <h4>4% Rule</h4>
        <p>
            People who have a good estimate of how much they will require a year in retirement can divide this number by 4% to 
            determine the nest egg required to enable their lifestyle. For instance, if a retiree estimates they need $100,000 
            a year, according to the 4% rule, the nest egg required is $100,000 / 4% = $2.5 million.
        </p>
        
        <p>
            Some experts claim that savings of 15 to 25 times of a person's current annual income are enough to last them 
            throughout their retirement. Of course, there are other ways to determine how much to save for retirement. The 
            calculations here can be helpful, as can many other retirement calculators out there. It also can be helpful to 
            speak with licensed professionals who help people plan their retirements.
        </p>
        
        <h3>Impact of Inflation on Retirement Savings</h3>
        <p>
            Inflation is the general increase in prices and a fall in the purchasing power of money over time. The average 
            inflation rate in the United States for the past 30 years has been around 2.6% per year, which means that the 
            purchasing power of one dollar now is not only less than one dollar 30 years ago but less than 50 cents! Inflation 
            is one of the reasons why people tend to underestimate how much they need to save for retirement.
        </p>
        
        <p>
            Although inflation does have an impact on retirement savings, it is unpredictable and mostly out of a person's 
            control. As a result, people generally do not center their retirement planning or investments around inflation and 
            instead focus mainly on achieving as large and steady a total return on investment as possible. For people 
            interested in mitigating inflation, there are investments in the U.S. that are specifically designed to counter 
            inflation called Treasury Inflation-Protected Securities (TIPs) and similar investments in other countries that go 
            by different names. Also, gold and other commodities are traditionally favored as protection against inflation, as 
            are dividend-paying stocks as opposed to short-term bonds.
        </p>
        
        <p>
            Our Retirement Calculator can help by considering inflation in several calculations. Please visit the Inflation 
            Calculator for more information about inflation or to do calculations involving inflation.
        </p>
        
        <h3>Common Sources of Retirement Funds</h3>
        <p>
            People in the U.S. generally rely on the following sources for financial support after retirement.
        </p>
        
        <h4>Social Security</h4>
        <p>
            Social Security is a social insurance program run by the government to provide protection against poverty, old age, 
            and disability. People in the U.S. who have contributed to the Federal Insurance Contributions Act (FICA) tax as 
            withholdings from payroll will receive some of their income in the form of Social Security benefits during 
            retirement. In the U.S., Social Security was designed to replace approximately 40% of a person's working income. 
            Yet, approximately one-third of the working population and 50% of retirees expect Social Security to be their major 
            source of income after retirement.
        </p>
        
        <p>
            Future proceeds from Social Security are only loosely based on past income levels. For example, a person earning 
            $20,000 per year would receive approximately $800 per month in benefits. A person earning $100,000 per year would 
            receive around $2,000 per month in benefits. As can be seen, while a person who earns more does receive more in 
            benefits as their income increases, the increase in benefits is not proportional. What this translates to is that 
            low income-earners have more to gain from their initial investments into Social Security relative to higher-income 
            earners. For more information or to do calculations involving Social Security, please visit our Social Security 
            Calculator.
        </p>
        
        <h4>Pensions, 401(k)s, Individual Retirement Accounts (IRA), and Other Savings Plans</h4>
        <h5>401(k), 403(b), 457 Plan</h5>
        <p>
            In the U.S., two of the most popular ways to save for retirement include Employer Matching Programs such as the 
            401(k) and their offshoot, the 403(b) (nonprofit, religious organizations, school districts, governmental 
            organizations). 401(k)s vary from company to company, but many employers offer a matching contribution up to a 
            certain percentage of the gross income of the employee. For example, an employer may match up to 3% of an employee's 
            contribution to their 401(k); if this employee earned $60,000, the employer would contribute a maximum of $1,800 to 
            the employee's 401(k) that year. Only 6% of companies that offer 401(k)s don't make some sort of employer 
            contribution. It is generally recommended to at least contribute the maximum amount that an employer will match.
        </p>
        
        <p>
            Employer matching program contributions are made using pre-tax dollars. Funds are essentially allowed to grow 
            tax-free until distributed. Only distributions are taxed as ordinary income in retirement, during which retirees 
            most likely fall within a lower tax bracket. Please visit our 401K Calculator for more information about 401(k)s.
        </p>
        
        <h5>IRA and Roth IRA</h5>
        <p>
            In the U.S., the traditional IRA (Individual Retirement Account) and Roth IRA are also popular forms of retirement 
            savings. Just like 401(k)s and other employer matching programs, there are specific tax shields in place that make 
            them both appealing. The big difference between traditional IRAs and Roth IRAs is when taxation is applied. The 
            former's contributions go in pre-tax (usually taken from gross pay, very similar to 401(k)s) but are taxed upon 
            withdrawal. In contrast, Roth IRA contributions are deposited using after-tax dollars and are not taxed when 
            withdrawn during retirement. For more information about traditional IRAs or Roth IRAs, please visit our IRA 
            Calculator or Roth IRA Calculator.
        </p>
        
        <h5>Pension Plans</h5>
        <p>
            Pension plans are retirement funds that employers pool together and manage for their employees until they retire. 
            Most public servants in the United States are covered by pension programs rather than Social Security. Some private 
            employers may also provide pension benefits. Upon retirement, each employee can then choose to have fixed payouts 
            from their share of the pension pot or sell them as a lump sum to an insurance company. They can then choose to 
            receive income in the form of an annuity.
        </p>
        
        <p>
            In the U.S., pension plans were a popular form of saving for retirement in the past, but they have since fallen out 
            of favor, largely due to increasing longevity; there are fewer workers for each retired person. However, they can 
            still be found in the public sector or traditional corporations.
        </p>
        
        <p>
            For more information about or to do calculations involving pensions, please visit the Pension Calculator.
        </p>
        
        <h5>Investments and CDs</h5>
        <p>
            In the U.S., while pensions, 401(k)s, and IRAs are great ways to save for retirement due to their tax benefits, 
            they all have annual investment limits that can vary based on income or other
        </p>
    </div>
</div>

<script>
// Retirement calculation
function calculateRetirement() {
    const currentAge = parseInt(document.getElementById('current-age').value) || 35;
    const retirementAge = parseInt(document.getElementById('retirement-age').value) || 67;
    const lifeExpectancy = parseInt(document.getElementById('life-expectancy').value) || 85;
    const currentIncome = parseFloat(document.getElementById('current-income').value) || 70000;
    const incomeIncrease = parseFloat(document.getElementById('income-increase').value) || 3;
    const incomeNeeded = parseFloat(document.getElementById('income-needed').value) || 75;
    const investmentReturn = parseFloat(document.getElementById('investment-return').value) || 6;
    const inflationRate = parseFloat(document.getElementById('inflation-rate').value) || 3;
    const otherIncome = parseFloat(document.getElementById('other-income').value) || 0;
    const currentSavings = parseFloat(document.getElementById('current-savings').value) || 30000;
    const futureSavings = parseFloat(document.getElementById('future-savings').value) || 10;
    
    const yearsUntilRetirement = retirementAge - currentAge;
    const retirementYears = lifeExpectancy - retirementAge;
    
    // Calculate income needed at retirement (adjusted for inflation)
    const incomeAtRetirement = currentIncome * Math.pow(1 + (inflationRate / 100), yearsUntilRetirement);
    const annualIncomeNeeded = incomeAtRetirement * (incomeNeeded / 100);
    const monthlyIncomeNeeded = annualIncomeNeeded / 12;
    
    // Calculate savings needed at retirement (using 4% rule)
    const savingsNeeded = annualIncomeNeeded / 0.04;
    
    // Calculate future value of current savings
    const futureValueOfSavings = currentSavings * Math.pow(1 + (investmentReturn / 100), yearsUntilRetirement);
    
    // Calculate additional savings needed
    const additionalSavingsNeeded = savingsNeeded - futureValueOfSavings;
    
    // Calculate annual savings required
    if (additionalSavingsNeeded > 0) {
        // Using future value of annuity formula
        const annualSavingsRequired = additionalSavingsNeeded / 
            ((Math.pow(1 + (investmentReturn / 100), yearsUntilRetirement) - 1) / (investmentReturn / 100));
        const monthlySavingsRequired = annualSavingsRequired / 12;
    } else {
        const monthlySavingsRequired = 0;
    }
    
    // Update results
    document.getElementById('years-until-retirement').textContent = yearsUntilRetirement;
    document.getElementById('savings-needed').textContent = `$${savingsNeeded.toLocaleString(undefined, {maximumFractionDigits: 0})}`;
    document.getElementById('current-savings-display').textContent = `$${currentSavings.toLocaleString(undefined, {maximumFractionDigits: 0})}`;
    document.getElementById('monthly-savings-required').textContent = `$${(monthlySavingsRequired || 0).toLocaleString(undefined, {maximumFractionDigits: 0})}`;
    document.getElementById('annual-withdrawal').textContent = `$${annualIncomeNeeded.toLocaleString(undefined, {maximumFractionDigits: 0})}`;
    document.getElementById('monthly-withdrawal').textContent = `$${monthlyIncomeNeeded.toLocaleString(undefined, {maximumFractionDigits: 0})}`;
    
    // Show results
    document.getElementById('retirement-results').style.display = 'block';
}

// Savings plan calculation
function calculateSavingsPlan() {
    const ageNow = parseInt(document.getElementById('savings-age-now').value) || 35;
    const retirementAge = parseInt(document.getElementById('savings-retirement-age').value) || 67;
    const savingsNeeded = parseFloat(document.getElementById('savings-needed').value) || 600000;
    const currentSavings = parseFloat(document.getElementById('savings-current').value) || 30000;
    const avgReturn = parseFloat(document.getElementById('savings-return').value) || 6;
    
    const years = retirementAge - ageNow;
    
    // Calculate future value of current savings
    const futureValue = currentSavings * Math.pow(1 + (avgReturn / 100), years);
    
    // Calculate additional savings needed
    const additionalNeeded = savingsNeeded - futureValue;
    
    if (additionalNeeded > 0) {
        // Calculate monthly savings required using future value of annuity formula
        const monthlyRate = (avgReturn / 100) / 12;
        const months = years * 12;
        const monthlySavings = additionalNeeded / (((Math.pow(1 + monthlyRate, months)) - 1) / monthlyRate);
        
        alert(`To reach your retirement goal of $${savingsNeeded.toLocaleString()}, you need to save $${monthlySavings.toLocaleString(undefined, {maximumFractionDigits: 2})} per month.`);
    } else {
        alert(`Your current savings of $${currentSavings.toLocaleString()} will grow to $${futureValue.toLocaleString(undefined, {maximumFractionDigits: 2})} by retirement, which exceeds your goal of $${savingsNeeded.toLocaleString()}.`);
    }
}

// Withdrawal calculation
function calculateWithdrawal() {
    const ageNow = parseInt(document.getElementById('withdraw-age-now').value) || 35;
    const retirementAge = parseInt(document.getElementById('withdraw-retirement-age').value) || 67;
    const lifeExpectancy = parseInt(document.getElementById('withdraw-life-expectancy').value) || 85;
    const currentSavings = parseFloat(document.getElementById('withdraw-savings').value) || 30000;
    const annualContribution = parseFloat(document.getElementById('annual-contribution').value) || 0;
    const monthlyContribution = parseFloat(document.getElementById('monthly-contribution').value) || 500;
    const avgReturn = parseFloat(document.getElementById('withdraw-return').value) || 6;
    const inflationRate = parseFloat(document.getElementById('withdraw-inflation').value) || 3;
    
    const yearsUntilRetirement = retirementAge - ageNow;
    const retirementYears = lifeExpectancy - retirementAge;
    
    // Calculate future value of current savings plus contributions
    let futureSavings = currentSavings;
    for (let i = 0; i < yearsUntilRetirement; i++) {
        futureSavings = futureSavings * (1 + (avgReturn / 100)) + annualContribution + (monthlyContribution * 12);
    }
    
    // Calculate sustainable withdrawal using 4% rule
    const annualWithdrawal = futureSavings * 0.04;
    const monthlyWithdrawal = annualWithdrawal / 12;
    
    alert(`At retirement, your savings will be approximately $${futureSavings.toLocaleString(undefined, {maximumFractionDigits: 2})}. You can safely withdraw about $${monthlyWithdrawal.toLocaleString(undefined, {maximumFractionDigits: 2})} per month.`);
}

// Money duration calculation
function calculateMoneyDuration() {
    const amount = parseFloat(document.getElementById('money-amount').value) || 600000;
    const withdrawal = parseFloat(document.getElementById('withdrawal-amount').value) || 5000;
    const avgReturn = parseFloat(document.getElementById('money-return').value) || 6;
    
    // Calculate how long money will last
    const monthlyRate = (avgReturn / 100) / 12;
    const months = Math.log(1 - (monthlyRate * amount) / withdrawal) / Math.log(1 + monthlyRate);
    const years = months / 12;
    
    if (months > 0) {
        const wholeYears = Math.floor(years);
        const remainingMonths = Math.round((years - wholeYears) * 12);
        alert(`With $${amount.toLocaleString()} and withdrawing $${withdrawal.toLocaleString()} per month at ${avgReturn}% annual return, your money will last approximately ${wholeYears} years and ${remainingMonths} months.`);
    } else {
        alert(`Your withdrawal amount is too high for the given return rate. The money will not last indefinitely.`);
    }
}

// Initialize with sample calculation
document.addEventListener('DOMContentLoaded', function() {
    calculateRetirement();
});
</script>

<?php
// Include your website's footer
include '../../footer.php';
?>