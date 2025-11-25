// State tax rates (2024 estimates)
const stateTaxRates = {
    ca: { rate: 0.093, brackets: [] }, // California
    ny: { rate: 0.109, brackets: [] }, // New York
    tx: { rate: 0.000, brackets: [] }, // Texas (no state income tax)
    fl: { rate: 0.000, brackets: [] }, // Florida (no state income tax)
    il: { rate: 0.0495, brackets: [] }, // Illinois
    pa: { rate: 0.0307, brackets: [] }, // Pennsylvania
    oh: { rate: 0.0397, brackets: [] }, // Ohio
    ga: { rate: 0.0575, brackets: [] }, // Georgia
    nc: { rate: 0.0525, brackets: [] }, // North Carolina
    mi: { rate: 0.0425, brackets: [] }  // Michigan
};

// Federal tax brackets 2024
const federalTaxBrackets = {
    single: [
        { min: 0, max: 11600, rate: 0.10 },
        { min: 11601, max: 47150, rate: 0.12 },
        { min: 47151, max: 100525, rate: 0.22 },
        { min: 100526, max: 191950, rate: 0.24 },
        { min: 191951, max: 243725, rate: 0.32 },
        { min: 243726, max: 609350, rate: 0.35 },
        { min: 609351, max: Infinity, rate: 0.37 }
    ],
    married_joint: [
        { min: 0, max: 23200, rate: 0.10 },
        { min: 23201, max: 94300, rate: 0.12 },
        { min: 94301, max: 201050, rate: 0.22 },
        { min: 201051, max: 383900, rate: 0.24 },
        { min: 383901, max: 487450, rate: 0.32 },
        { min: 487451, max: 731200, rate: 0.35 },
        { min: 731201, max: Infinity, rate: 0.37 }
    ],
    married_separate: [
        { min: 0, max: 11600, rate: 0.10 },
        { min: 11601, max: 47150, rate: 0.12 },
        { min: 47151, max: 100525, rate: 0.22 },
        { min: 100526, max: 191950, rate: 0.24 },
        { min: 191951, max: 243725, rate: 0.32 },
        { min: 243726, max: 365600, rate: 0.35 },
        { min: 365601, max: Infinity, rate: 0.37 }
    ],
    head_household: [
        { min: 0, max: 16550, rate: 0.10 },
        { min: 16551, max: 63100, rate: 0.12 },
        { min: 63101, max: 100500, rate: 0.22 },
        { min: 100501, max: 191950, rate: 0.24 },
        { min: 191951, max: 243700, rate: 0.32 },
        { min: 243701, max: 609350, rate: 0.35 },
        { min: 609351, max: Infinity, rate: 0.37 }
    ]
};

function calculateSalary() {
    // Get input values
    const grossSalary = parseFloat(document.getElementById('grossSalary').value);
    const payFrequency = parseInt(document.getElementById('payFrequency').value);
    const filingStatus = document.getElementById('filingStatus').value;
    const state = document.getElementById('state').value;
    const federalAllowances = parseInt(document.getElementById('federalAllowances').value);
    const retirementContribution = parseFloat(document.getElementById('retirementContribution').value) / 100;
    const healthInsurance = parseFloat(document.getElementById('healthInsurance').value) * 12; // Convert to annual
    const otherDeductions = parseFloat(document.getElementById('otherDeductions').value) * 12; // Convert to annual
    const includeBonus = document.getElementById('includeBonus').checked;
    const bonusAmount = includeBonus ? parseFloat(document.getElementById('bonusAmount').value) : 0;
    const bonusTaxRate = parseFloat(document.getElementById('bonusTaxRate').value) / 100;

    // Validation
    if (!grossSalary || grossSalary <= 0) {
        alert('Please enter a valid gross salary');
        return;
    }

    // Calculate retirement contribution
    const retirementDeduction = grossSalary * retirementContribution;
    const taxableIncome = grossSalary - retirementDeduction;

    // Calculate federal tax
    const federalTax = calculateFederalTax(taxableIncome, filingStatus, federalAllowances);

    // Calculate state tax
    const stateTax = calculateStateTax(taxableIncome, state);

    // Calculate FICA taxes
    const socialSecurityTax = calculateSocialSecurityTax(grossSalary);
    const medicareTax = calculateMedicareTax(grossSalary);

    // Calculate bonus tax if included
    const bonusTax = includeBonus ? bonusAmount * bonusTaxRate : 0;
    const netBonus = includeBonus ? bonusAmount - bonusTax : 0;

    // Calculate total taxes and deductions
    const totalTaxes = federalTax + stateTax + socialSecurityTax + medicareTax + bonusTax;
    const totalDeductions = retirementDeduction + healthInsurance + otherDeductions;
    const netSalary = grossSalary + bonusAmount - totalTaxes - totalDeductions;

    // Calculate pay frequency amounts
    const annualNet = netSalary;
    const monthlyNet = annualNet / 12;
    const biweeklyNet = annualNet / 26;
    const weeklyNet = annualNet / 52;
    const dailyNet = annualNet / 260; // Assuming 260 working days
    const hourlyNet = weeklyNet / 40; // Assuming 40-hour work week

    // Calculate effective tax rate
    const effectiveTaxRate = (totalTaxes / (grossSalary + bonusAmount)) * 100;

    // Get tax bracket information
    const federalBracket = getFederalTaxBracket(taxableIncome, filingStatus);
    const stateBracket = stateTaxRates[state].rate * 100;

    // Display results
    displayResults({
        grossSalary: grossSalary + bonusAmount,
        totalTaxes: totalTaxes,
        totalDeductions: totalDeductions,
        netSalary: netSalary,
        federalTax: federalTax,
        stateTax: stateTax,
        socialSecurityTax: socialSecurityTax,
        medicareTax: medicareTax,
        retirementDeduction: retirementDeduction,
        healthDeduction: healthInsurance,
        otherDeductions: otherDeductions,
        annualNet: annualNet,
        monthlyNet: monthlyNet,
        biweeklyNet: biweeklyNet,
        weeklyNet: weeklyNet,
        dailyNet: dailyNet,
        hourlyNet: hourlyNet,
        federalBracket: federalBracket,
        stateBracket: stateBracket,
        effectiveTaxRate: effectiveTaxRate
    });

    // Show result container
    const resultContainer = document.getElementById('resultContainer');
    resultContainer.style.display = 'block';
    resultContainer.style.animation = 'fadeIn 0.5s ease-in';
}

function calculateFederalTax(income, filingStatus, allowances) {
    const brackets = federalTaxBrackets[filingStatus];
    let tax = 0;
    let remainingIncome = income;

    // Standard deduction based on filing status
    const standardDeductions = {
        single: 14600,
        married_joint: 29200,
        married_separate: 14600,
        head_household: 21900
    };

    // Apply standard deduction and allowances
    const deduction = standardDeductions[filingStatus] + (allowances * 4650);
    remainingIncome = Math.max(0, income - deduction);

    // Calculate tax using brackets
    for (const bracket of brackets) {
        if (remainingIncome <= 0) break;

        const bracketRange = bracket.max === Infinity ? remainingIncome : Math.min(bracket.max - bracket.min, remainingIncome);
        const bracketIncome = Math.max(0, Math.min(bracketRange, remainingIncome));
        
        tax += bracketIncome * bracket.rate;
        remainingIncome -= bracketIncome;
    }

    return tax;
}

function calculateStateTax(income, state) {
    const stateRate = stateTaxRates[state].rate;
    return income * stateRate;
}

function calculateSocialSecurityTax(income) {
    const socialSecurityLimit = 168600;
    const socialSecurityRate = 0.062;
    return Math.min(income, socialSecurityLimit) * socialSecurityRate;
}

function calculateMedicareTax(income) {
    const medicareRate = 0.0145;
    let medicareTax = income * medicareRate;
    
    // Additional Medicare tax for high incomes
    if (income > 200000) {
        medicareTax += (income - 200000) * 0.009;
    }
    
    return medicareTax;
}

function getFederalTaxBracket(income, filingStatus) {
    const brackets = federalTaxBrackets[filingStatus];
    for (const bracket of brackets) {
        if (income >= bracket.min && income <= bracket.max) {
            return bracket.rate * 100;
        }
    }
    return 37; // Highest bracket
}

function displayResults(results) {
    // Format currency
    const formatCurrency = (amount) => {
        return new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: 'USD',
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        }).format(amount);
    };

    // Update summary cards
    document.getElementById('grossPay').textContent = formatCurrency(results.grossSalary);
    document.getElementById('totalTaxes').textContent = formatCurrency(results.totalTaxes);
    document.getElementById('totalDeductions').textContent = formatCurrency(results.totalDeductions);
    document.getElementById('netPay').textContent = formatCurrency(results.netSalary);

    // Update tax breakdown
    document.getElementById('federalTax').textContent = formatCurrency(results.federalTax);
    document.getElementById('stateTax').textContent = formatCurrency(results.stateTax);
    document.getElementById('socialSecurityTax').textContent = formatCurrency(results.socialSecurityTax);
    document.getElementById('medicareTax').textContent = formatCurrency(results.medicareTax);
    document.getElementById('totalTaxesBreakdown').textContent = formatCurrency(results.totalTaxes);

    // Update deduction breakdown
    document.getElementById('retirementDeduction').textContent = formatCurrency(results.retirementDeduction);
    document.getElementById('healthDeduction').textContent = formatCurrency(results.healthDeduction);
    document.getElementById('otherDeductionsBreakdown').textContent = formatCurrency(results.otherDeductions);
    document.getElementById('totalDeductionsBreakdown').textContent = formatCurrency(results.totalDeductions);

    // Update pay frequency breakdown
    document.getElementById('annualNet').textContent = formatCurrency(results.annualNet);
    document.getElementById('monthlyNet').textContent = formatCurrency(results.monthlyNet);
    document.getElementById('biweeklyNet').textContent = formatCurrency(results.biweeklyNet);
    document.getElementById('weeklyNet').textContent = formatCurrency(results.weeklyNet);
    document.getElementById('dailyNet').textContent = formatCurrency(results.dailyNet);
    document.getElementById('hourlyNet').textContent = formatCurrency(results.hourlyNet);

    // Update tax bracket information
    document.getElementById('federalBracket').textContent = results.federalBracket.toFixed(1) + '%';
    document.getElementById('stateBracket').textContent = results.stateBracket.toFixed(2) + '%';
    document.getElementById('effectiveTaxRate').textContent = results.effectiveTaxRate.toFixed(1) + '%';
}

// Toggle bonus section visibility
document.getElementById('includeBonus').addEventListener('change', function() {
    const bonusSection = document.getElementById('bonusSection');
    bonusSection.style.display = this.checked ? 'block' : 'none';
});

// Auto-calculate when inputs change
document.addEventListener('DOMContentLoaded', function() {
    const inputs = document.querySelectorAll('input, select');
    inputs.forEach(input => {
        input.addEventListener('input', function() {
            const grossSalary = document.getElementById('grossSalary').value;
            if (grossSalary && grossSalary > 0) {
                setTimeout(calculateSalary, 1000);
            }
        });
    });

    // Initial calculation
    calculateSalary();
});

// Add fadeIn animation
const style = document.createElement('style');
style.textContent = `
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
`;
document.head.appendChild(style);