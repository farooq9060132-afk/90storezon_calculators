// Tax brackets for different countries (2024 estimates)
const taxBrackets = {
    us: {
        single: [
            { min: 0, max: 11000, rate: 0.10 },
            { min: 11001, max: 44725, rate: 0.12 },
            { min: 44726, max: 95375, rate: 0.22 },
            { min: 95376, max: 182100, rate: 0.24 },
            { min: 182101, max: 231250, rate: 0.32 },
            { min: 231251, max: 578125, rate: 0.35 },
            { min: 578126, max: Infinity, rate: 0.37 }
        ],
        married_joint: [
            { min: 0, max: 22000, rate: 0.10 },
            { min: 22001, max: 89450, rate: 0.12 },
            { min: 89451, max: 190750, rate: 0.22 },
            { min: 190751, max: 364200, rate: 0.24 },
            { min: 364201, max: 462500, rate: 0.32 },
            { min: 462501, max: 693750, rate: 0.35 },
            { min: 693751, max: Infinity, rate: 0.37 }
        ]
    },
    uk: {
        single: [
            { min: 0, max: 12570, rate: 0.00 },
            { min: 12571, max: 50270, rate: 0.20 },
            { min: 50271, max: 125140, rate: 0.40 },
            { min: 125141, max: Infinity, rate: 0.45 }
        ]
    },
    canada: {
        single: [
            { min: 0, max: 53359, rate: 0.15 },
            { min: 53360, max: 106717, rate: 0.205 },
            { min: 106718, max: 165430, rate: 0.26 },
            { min: 165431, max: 235675, rate: 0.29 },
            { min: 235676, max: Infinity, rate: 0.33 }
        ]
    }
};

function calculateTax() {
    const country = document.getElementById('country').value;
    const income = parseFloat(document.getElementById('income').value);
    const filingStatus = document.getElementById('filingStatus').value;
    const age = parseInt(document.getElementById('age').value);
    
    // Deductions
    const retirementContribution = parseFloat(document.getElementById('retirementContribution').value) || 0;
    const healthInsurance = parseFloat(document.getElementById('healthInsurance').value) || 0;
    const studentLoan = parseFloat(document.getElementById('studentLoan').value) || 0;
    const charity = parseFloat(document.getElementById('charity').value) || 0;
    const standardDeduction = document.getElementById('standardDeduction').checked;
    const hasChildren = document.getElementById('hasChildren').checked;

    // Validation
    if (!income || income <= 0) {
        alert('Please enter a valid income amount');
        return;
    }

    // Calculate taxable income
    let taxableIncome = income;
    
    // Apply deductions
    let totalDeductions = 0;
    
    if (standardDeduction) {
        // Standard deduction amounts (US example)
        const standardDeductionAmount = filingStatus === 'single' ? 13850 : 27700;
        totalDeductions += standardDeductionAmount;
    }
    
    totalDeductions += retirementContribution;
    totalDeductions += healthInsurance;
    totalDeductions += studentLoan;
    totalDeductions += charity;
    
    // Child tax credit (US example)
    if (hasChildren) {
        totalDeductions += 2000; // Per child
    }
    
    taxableIncome = Math.max(0, income - totalDeductions);

    // Calculate income tax
    const incomeTax = calculateIncomeTax(taxableIncome, country, filingStatus);
    
    // Calculate other taxes
    const socialSecurityTax = calculateSocialSecurityTax(income, country);
    const medicareTax = calculateMedicareTax(income, country);
    const stateTax = calculateStateTax(income, country);

    const totalTax = incomeTax + socialSecurityTax + medicareTax + stateTax;
    const netIncome = income - totalTax;
    const effectiveTaxRate = (totalTax / income) * 100;

    // Monthly calculations
    const monthlyGross = income / 12;
    const monthlyTax = totalTax / 12;
    const monthlyNet = netIncome / 12;

    // Display results
    displayResults({
        grossIncome: income,
        totalTax: totalTax,
        netIncome: netIncome,
        effectiveRate: effectiveTaxRate,
        federalTax: incomeTax,
        stateTax: stateTax,
        socialSecurityTax: socialSecurityTax,
        medicareTax: medicareTax,
        totalDeductions: totalDeductions,
        monthlyGross: monthlyGross,
        monthlyTax: monthlyTax,
        monthlyNet: monthlyNet
    });

    // Show result container
    const resultContainer = document.getElementById('resultContainer');
    resultContainer.style.display = 'block';
    resultContainer.style.animation = 'fadeIn 0.5s ease-in';
}

function calculateIncomeTax(taxableIncome, country, filingStatus) {
    const brackets = taxBrackets[country]?.[filingStatus] || taxBrackets.us.single;
    let tax = 0;
    let remainingIncome = taxableIncome;

    for (const bracket of brackets) {
        if (remainingIncome <= 0) break;

        const bracketRange = bracket.max === Infinity ? remainingIncome : Math.min(bracket.max - bracket.min, remainingIncome);
        const bracketIncome = Math.max(0, Math.min(bracketRange, remainingIncome));
        
        tax += bracketIncome * bracket.rate;
        remainingIncome -= bracketIncome;
    }

    return tax;
}

function calculateSocialSecurityTax(income, country) {
    // US Social Security tax (2024)
    if (country === 'us') {
        const socialSecurityLimit = 168600;
        const socialSecurityRate = 0.062;
        return Math.min(income, socialSecurityLimit) * socialSecurityRate;
    }
    return 0;
}

function calculateMedicareTax(income, country) {
    // US Medicare tax (2024)
    if (country === 'us') {
        const medicareRate = 0.0145;
        let medicareTax = income * medicareRate;
        
        // Additional Medicare tax for high incomes
        if (income > 200000) {
            medicareTax += (income - 200000) * 0.009;
        }
        
        return medicareTax;
    }
    return 0;
}

function calculateStateTax(income, country) {
    // Simplified state tax calculation (US average)
    if (country === 'us') {
        return income * 0.05; // Average state tax rate
    }
    return 0;
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
    document.getElementById('grossIncome').textContent = formatCurrency(results.grossIncome);
    document.getElementById('totalTax').textContent = formatCurrency(results.totalTax);
    document.getElementById('netIncome').textContent = formatCurrency(results.netIncome);
    document.getElementById('effectiveRate').textContent = results.effectiveRate.toFixed(1) + '%';

    // Update tax breakdown
    document.getElementById('federalTax').textContent = formatCurrency(results.federalTax);
    document.getElementById('stateTax').textContent = formatCurrency(results.stateTax);
    document.getElementById('socialSecurityTax').textContent = formatCurrency(results.socialSecurityTax);
    document.getElementById('medicareTax').textContent = formatCurrency(results.medicareTax);
    document.getElementById('totalDeductions').textContent = formatCurrency(results.totalDeductions);

    // Update monthly breakdown
    document.getElementById('monthlyGross').textContent = formatCurrency(results.monthlyGross);
    document.getElementById('monthlyTax').textContent = formatCurrency(results.monthlyTax);
    document.getElementById('monthlyNet').textContent = formatCurrency(results.monthlyNet);
}

// Auto-calculate when inputs change
document.addEventListener('DOMContentLoaded', function() {
    const inputs = document.querySelectorAll('input, select');
    inputs.forEach(input => {
        input.addEventListener('input', function() {
            const income = document.getElementById('income').value;
            if (income && income > 0) {
                setTimeout(calculateTax, 500);
            }
        });
    });

    // Initial calculation
    calculateTax();
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