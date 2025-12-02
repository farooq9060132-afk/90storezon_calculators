<?php
// Include your header
include '../header.php';
?>

<style>
/* Calculators Page Styles */
.calculators-container {
    max-width: 1200px;
    margin: 30px auto;
    padding: 0 20px;
    font-family: Arial, sans-serif;
}

.page-title {
    font-size: 32px;
    font-weight: bold;
    color: #202124;
    margin-bottom: 20px;
    text-align: center;
}

.page-description {
    font-size: 16px;
    color: #5f6368;
    line-height: 1.6;
    margin-bottom: 30px;
    text-align: center;
    max-width: 800px;
    margin-left: auto;
    margin-right: auto;
}

.categories-filter {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 10px;
    margin-bottom: 30px;
}

.category-btn {
    padding: 8px 16px;
    background: #f1f3f4;
    border: 1px solid #dadce0;
    border-radius: 20px;
    color: #5f6368;
    cursor: pointer;
    font-size: 14px;
    transition: all 0.3s ease;
}

.category-btn:hover, .category-btn.active {
    background: #0052FF;
    color: white;
    border-color: #0052FF;
}

.calculators-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 25px;
    margin-top: 20px;
}

.calculator-card {
    background: #ffffff;
    border: 1px solid #dadce0;
    border-radius: 10px;
    padding: 25px;
    transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    text-align: center;
}

.calculator-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    border-color: #0052FF;
}

.calculator-card h3 {
    font-size: 18px;
    color: #202124;
    margin-bottom: 12px;
    font-weight: 600;
}

.calculator-card p {
    color: #5f6368;
    font-size: 14px;
    line-height: 1.5;
    margin-bottom: 20px;
    min-height: 60px;
}

.calculator-link {
    display: inline-block;
    background: #0052FF;
    color: white;
    text-decoration: none;
    padding: 10px 20px;
    border-radius: 6px;
    font-weight: 500;
    font-size: 14px;
    transition: background-color 0.2s ease;
}

.calculator-link:hover {
    background: #0041cc;
    text-decoration: none;
}

.coming-soon {
    display: inline-block;
    background: #f1f3f4;
    color: #5f6368;
    text-decoration: none;
    padding: 10px 20px;
    border-radius: 6px;
    font-weight: 500;
    font-size: 14px;
    cursor: not-allowed;
}

@media (max-width: 768px) {
    .calculators-container {
        padding: 0 15px;
        margin: 20px auto;
    }
    
    .page-title {
        font-size: 28px;
    }
    
    .calculators-grid {
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 20px;
    }
    
    .calculator-card {
        padding: 20px;
    }
}

@media (max-width: 480px) {
    .calculators-container {
        padding: 0 10px;
        margin: 15px auto;
    }
    
    .page-title {
        font-size: 24px;
    }
    
    .page-description {
        font-size: 14px;
    }
    
    .calculators-grid {
        grid-template-columns: 1fr;
    }
    
    .categories-filter {
        gap: 8px;
    }
    
    .category-btn {
        padding: 6px 12px;
        font-size: 13px;
    }
}
</style>

<div class="calculators-container">
    <h1 class="page-title">All Calculators</h1>
    
    <p class="page-description">
        Browse our collection of 50+ free online calculators for finance, health, math, and more. 
        All calculators are completely free with no registration required.
    </p>
    
    <div class="categories-filter">
        <button class="category-btn active" data-category="all">All</button>
        <button class="category-btn" data-category="financial">Financial</button>
        <button class="category-btn" data-category="health">Health & Fitness</button>
        <button class="category-btn" data-category="math">Math & Education</button>
        <button class="category-btn" data-category="other">Other Tools</button>
    </div>
    
    <div class="calculators-grid">
        <!-- Financial Calculators (1-25) -->
        <div class="calculator-card" data-category="financial">
            <h3>Loan Calculator</h3>
            <p>Calculate loan payments, interest, and total costs for various loan types.</p>
            <a href="/calculators/01-loan-calculator/" class="calculator-link">Calculate Now</a>
        </div>
        
        <div class="calculator-card" data-category="health">
            <h3>Anorexic BMI Calculator</h3>
            <p>Calculate BMI to assess if body weight suggests anorexia nervosa.</p>
            <a href="/calculators/02-Anorexic bmi-calculator/" class="calculator-link">Calculate Now</a>
        </div>
        
        <div class="calculator-card" data-category="math">
            <h3>Percentage Calculator</h3>
            <p>Calculate percentages, find percentage increase/decrease, and more.</p>
            <a href="/calculators/03-percentage-calculator/" class="calculator-link">Calculate Now</a>
        </div>
        
        <div class="calculator-card" data-category="math">
            <h3>Triangle Calculator</h3>
            <p>Calculate triangle properties based on sides, angles, or area.</p>
            <a href="/calculators/04-triangle-calculator/" class="calculator-link">Calculate Now</a>
        </div>
        
        <div class="calculator-card" data-category="math">
            <h3>Slope Calculator</h3>
            <p>Calculate slope, distance, and angle of incline between two points.</p>
            <a href="/calculators/05-slope-calculator/" class="calculator-link">Calculate Now</a>
        </div>
        
        <div class="calculator-card" data-category="financial">
            <h3>Mortgage Calculator</h3>
            <p>Calculate monthly mortgage payments, total interest, and amortization.</p>
            <a href="/calculators/06-mortgage-calculator/" class="calculator-link">Calculate Now</a>
        </div>
        
        <div class="calculator-card" data-category="financial">
            <h3>Auto Loan Calculator</h3>
            <p>Calculate auto loan payments, interest, and total costs.</p>
            <a href="/calculators/07-auto-loan-calculator/" class="calculator-link">Calculate Now</a>
        </div>
        
        <div class="calculator-card" data-category="financial">
            <h3>Interest Calculator</h3>
            <p>Calculate compound interest, investment growth, and savings.</p>
            <a href="/calculators/08-interest-calculator/" class="calculator-link">Calculate Now</a>
        </div>
        
        <div class="calculator-card" data-category="financial">
            <h3>Payment Calculator</h3>
            <p>Calculate loan payments or term based on fixed interest rates.</p>
            <a href="/calculators/09-payment-calculator/" class="calculator-link">Calculate Now</a>
        </div>
        
        <div class="calculator-card" data-category="financial">
            <h3>Retirement Calculator</h3>
            <p>Plan your retirement savings and estimate future financial needs.</p>
            <a href="/calculators/10-retirement-calculator/" class="calculator-link">Calculate Now</a>
        </div>
        
        <!-- Coming Soon Calculators (11-50) -->
        <div class="calculator-card" data-category="financial">
            <h3>Amortization Calculator</h3>
            <p>Calculate loan amortization schedules and payment breakdowns.</p>
            <span class="coming-soon">Coming Soon</span>
        </div>
        
        <div class="calculator-card" data-category="financial">
            <h3>Investment Calculator</h3>
            <p>Calculate investment returns, growth, and portfolio performance.</p>
            <span class="coming-soon">Coming Soon</span>
        </div>
        
        <div class="calculator-card" data-category="other">
            <h3>Currency Calculator</h3>
            <p>Convert between different currencies with real-time exchange rates.</p>
            <span class="coming-soon">Coming Soon</span>
        </div>
        
        <div class="calculator-card" data-category="financial">
            <h3>Inflation Calculator</h3>
            <p>Calculate the effect of inflation on purchasing power over time.</p>
            <span class="coming-soon">Coming Soon</span>
        </div>
        
        <div class="calculator-card" data-category="financial">
            <h3>Finance Calculator</h3>
            <p>Perform various financial calculations and analyses.</p>
            <span class="coming-soon">Coming Soon</span>
        </div>
        
        <div class="calculator-card" data-category="financial">
            <h3>Mortgage Payoff Calculator</h3>
            <p>Calculate how to pay off your mortgage early and save on interest.</p>
            <span class="coming-soon">Coming Soon</span>
        </div>
        
        <div class="calculator-card" data-category="financial">
            <h3>Income Tax Calculator</h3>
            <p>Calculate income taxes based on your earnings and deductions.</p>
            <span class="coming-soon">Coming Soon</span>
        </div>
        
        <div class="calculator-card" data-category="financial">
            <h3>Compound Interest Calculator</h3>
            <p>Calculate how your money grows with compound interest over time.</p>
            <span class="coming-soon">Coming Soon</span>
        </div>
        
        <div class="calculator-card" data-category="financial">
            <h3>Salary Calculator</h3>
            <p>Calculate take-home pay, taxes, and benefits from your salary.</p>
            <span class="coming-soon">Coming Soon</span>
        </div>
        
        <div class="calculator-card" data-category="financial">
            <h3>401K Calculator</h3>
            <p>Plan your 401K contributions and estimate retirement savings.</p>
            <span class="coming-soon">Coming Soon</span>
        </div>
        
        <div class="calculator-card" data-category="financial">
            <h3>Interest Rate Calculator</h3>
            <p>Calculate interest rates, APR, and compare loan options.</p>
            <span class="coming-soon">Coming Soon</span>
        </div>
        
        <div class="calculator-card" data-category="financial">
            <h3>Sales Tax Calculator</h3>
            <p>Calculate sales tax on purchases and transactions.</p>
            <span class="coming-soon">Coming Soon</span>
        </div>
        
        <div class="calculator-card" data-category="financial">
            <h3>House Affordability Calculator</h3>
            <p>Determine how much house you can afford based on your finances.</p>
            <span class="coming-soon">Coming Soon</span>
        </div>
        
        <div class="calculator-card" data-category="financial">
            <h3>Savings Calculator</h3>
            <p>Calculate savings growth, interest, and future account balances.</p>
            <span class="coming-soon">Coming Soon</span>
        </div>
        
        <div class="calculator-card" data-category="financial">
            <h3>Rent Calculator</h3>
            <p>Calculate rent affordability and housing expense ratios.</p>
            <span class="coming-soon">Coming Soon</span>
        </div>
        
        <div class="calculator-card" data-category="financial">
            <h3>Marriage Tax Calculator</h3>
            <p>Calculate the marriage tax penalty or bonus for couples.</p>
            <span class="coming-soon">Coming Soon</span>
        </div>
        
        <div class="calculator-card" data-category="financial">
            <h3>Estate Tax Calculator</h3>
            <p>Calculate estate taxes on inherited assets and wealth.</p>
            <span class="coming-soon">Coming Soon</span>
        </div>
        
        <div class="calculator-card" data-category="financial">
            <h3>Pension Calculator</h3>
            <p>Calculate pension benefits and retirement income streams.</p>
            <span class="coming-soon">Coming Soon</span>
        </div>
        
        <div class="calculator-card" data-category="financial">
            <h3>Social Security Calculator</h3>
            <p>Estimate Social Security benefits and retirement income.</p>
            <span class="coming-soon">Coming Soon</span>
        </div>
        
        <div class="calculator-card" data-category="financial">
            <h3>Annuity Calculator</h3>
            <p>Calculate annuity payments, present value, and future value.</p>
            <span class="coming-soon">Coming Soon</span>
        </div>
        
        <div class="calculator-card" data-category="financial">
            <h3>Annuity Payout Calculator</h3>
            <p>Calculate annuity payout amounts and withdrawal strategies.</p>
            <span class="coming-soon">Coming Soon</span>
        </div>
        
        <div class="calculator-card" data-category="financial">
            <h3>Credit Card Calculator</h3>
            <p>Calculate credit card payments, interest, and payoff dates.</p>
            <span class="coming-soon">Coming Soon</span>
        </div>
        
        <div class="calculator-card" data-category="financial">
            <h3>Credit Cards Payoff Calculator</h3>
            <p>Calculate strategies to pay off multiple credit cards faster.</p>
            <span class="coming-soon">Coming Soon</span>
        </div>
        
        <div class="calculator-card" data-category="financial">
            <h3>Debt Payoff Calculator</h3>
            <p>Calculate debt payoff schedules and interest savings.</p>
            <span class="coming-soon">Coming Soon</span>
        </div>
        
        <div class="calculator-card" data-category="financial">
            <h3>Debt Consolidation Calculator</h3>
            <p>Calculate savings from consolidating multiple debts into one.</p>
            <span class="coming-soon">Coming Soon</span>
        </div>
        
        <div class="calculator-card" data-category="financial">
            <h3>Repayment Calculator</h3>
            <p>Calculate loan repayment schedules and payment amounts.</p>
            <span class="coming-soon">Coming Soon</span>
        </div>
        
        <div class="calculator-card" data-category="financial">
            <h3>Student Loan Calculator</h3>
            <p>Calculate student loan payments, interest, and repayment options.</p>
            <span class="coming-soon">Coming Soon</span>
        </div>
        
        <div class="calculator-card" data-category="financial">
            <h3>College Cost Calculator</h3>
            <p>Calculate the total cost of college education and expenses.</p>
            <span class="coming-soon">Coming Soon</span>
        </div>
        
        <div class="calculator-card" data-category="financial">
            <h3>Simple Interest Calculator</h3>
            <p>Calculate simple interest on loans and investments.</p>
            <span class="coming-soon">Coming Soon</span>
        </div>
        
        <div class="calculator-card" data-category="financial">
            <h3>CD Calculator</h3>
            <p>Calculate certificate of deposit (CD) returns and interest.</p>
            <span class="coming-soon">Coming Soon</span>
        </div>
        
        <div class="calculator-card" data-category="financial">
            <h3>Bond Calculator</h3>
            <p>Calculate bond yields, prices, and investment returns.</p>
            <span class="coming-soon">Coming Soon</span>
        </div>
        
        <div class="calculator-card" data-category="financial">
            <h3>Roth IRA Calculator</h3>
            <p>Calculate Roth IRA contributions and retirement savings growth.</p>
            <span class="coming-soon">Coming Soon</span>
        </div>
        
        <div class="calculator-card" data-category="financial">
            <h3>IRA Calculator</h3>
            <p>Calculate traditional IRA contributions and retirement savings.</p>
            <span class="coming-soon">Coming Soon</span>
        </div>
        
        <div class="calculator-card" data-category="financial">
            <h3>RMD Calculator</h3>
            <p>Calculate required minimum distributions from retirement accounts.</p>
            <span class="coming-soon">Coming Soon</span>
        </div>
        
        <div class="calculator-card" data-category="financial">
            <h3>VAT Calculator</h3>
            <p>Calculate value-added tax (VAT) on purchases and sales.</p>
            <span class="coming-soon">Coming Soon</span>
        </div>
        
        <div class="calculator-card" data-category="financial">
            <h3>Cashback Low Interest Calculator</h3>
            <p>Compare cashback offers versus low interest rate financing.</p>
            <span class="coming-soon">Coming Soon</span>
        </div>
        
        <div class="calculator-card" data-category="financial">
            <h3>Auto Lease Calculator</h3>
            <p>Calculate auto lease payments and compare leasing vs buying.</p>
            <span class="coming-soon">Coming Soon</span>
        </div>
        
        <div class="calculator-card" data-category="financial">
            <h3>Depreciation Calculator</h3>
            <p>Calculate asset depreciation using various methods.</p>
            <span class="coming-soon">Coming Soon</span>
        </div>
        
        <div class="calculator-card" data-category="financial">
            <h3>Average Return Calculator</h3>
            <p>Calculate average returns on investments and portfolios.</p>
            <span class="coming-soon">Coming Soon</span>
        </div>
        
        <div class="calculator-card" data-category="financial">
            <h3>Margin Calculator</h3>
            <p>Calculate profit margins, markups, and business profitability.</p>
            <span class="coming-soon">Coming Soon</span>
        </div>
    </div>
</div>

<script>
// Category filtering functionality
document.addEventListener('DOMContentLoaded', function() {
    const categoryButtons = document.querySelectorAll('.category-btn');
    const calculatorCards = document.querySelectorAll('.calculator-card');
    
    categoryButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Remove active class from all buttons
            categoryButtons.forEach(btn => btn.classList.remove('active'));
            
            // Add active class to clicked button
            this.classList.add('active');
            
            const category = this.getAttribute('data-category');
            
            // Filter calculators
            calculatorCards.forEach(card => {
                if (category === 'all' || card.getAttribute('data-category') === category) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
});
</script>

<?php
// Include your footer
include '../footer.php';
?>