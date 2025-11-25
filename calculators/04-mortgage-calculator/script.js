function calculateMortgage() {
    const homePrice = parseFloat(document.getElementById('homePrice').value);
    const downPayment = parseFloat(document.getElementById('downPayment').value);
    const loanTerm = parseInt(document.getElementById('loanTerm').value);
    const interestRate = parseFloat(document.getElementById('interestRate').value);
    const propertyTax = parseFloat(document.getElementById('propertyTax').value);
    const homeInsurance = parseFloat(document.getElementById('homeInsurance').value);

    // Validation
    if (!homePrice || !downPayment || !interestRate || !propertyTax || !homeInsurance) {
        alert('Please fill in all fields');
        return;
    }

    if (homePrice <= 0 || downPayment < 0 || interestRate <= 0) {
        alert('Please enter valid positive values');
        return;
    }

    if (downPayment >= homePrice) {
        alert('Down payment cannot be greater than home price');
        return;
    }

    // Calculate loan amount
    const loanAmount = homePrice - downPayment;
    
    // Monthly interest rate
    const monthlyRate = interestRate / 100 / 12;
    
    // Number of payments
    const numberOfPayments = loanTerm * 12;
    
    // Mortgage formula: M = P [ i(1 + i)^n ] / [ (1 + i)^n - 1 ]
    const monthlyMortgage = loanAmount * (monthlyRate * Math.pow(1 + monthlyRate, numberOfPayments)) / 
                           (Math.pow(1 + monthlyRate, numberOfPayments) - 1);
    
    // Additional monthly costs
    const monthlyTax = propertyTax / 12;
    const monthlyInsurance = homeInsurance / 12;
    
    // Total monthly payment
    const totalMonthlyPayment = monthlyMortgage + monthlyTax + monthlyInsurance;
    
    // Total calculations
    const totalInterest = (monthlyMortgage * numberOfPayments) - loanAmount;
    const totalPayments = totalMonthlyPayment * numberOfPayments;

    // Display results
    document.getElementById('monthlyPayment').textContent = formatCurrency(totalMonthlyPayment);
    document.getElementById('principalInterest').textContent = formatCurrency(monthlyMortgage);
    document.getElementById('monthlyTax').textContent = formatCurrency(monthlyTax);
    document.getElementById('monthlyInsurance').textContent = formatCurrency(monthlyInsurance);
    document.getElementById('totalLoan').textContent = formatCurrency(loanAmount);
    document.getElementById('downPaymentResult').textContent = formatCurrency(downPayment);
    document.getElementById('totalInterest').textContent = formatCurrency(totalInterest);
    document.getElementById('totalPayments').textContent = formatCurrency(totalPayments);
    
    // Generate amortization schedule
    generateAmortizationSchedule(loanAmount, monthlyRate, numberOfPayments, monthlyMortgage);
    
    // Show result container
    const resultContainer = document.getElementById('resultContainer');
    resultContainer.style.display = 'block';
    resultContainer.style.animation = 'fadeIn 0.5s ease-in';
}

function generateAmortizationSchedule(loanAmount, monthlyRate, numberOfPayments, monthlyPayment) {
    let balance = loanAmount;
    let html = `
        <table class="amortization-table">
            <thead>
                <tr>
                    <th>Year</th>
                    <th>Interest</th>
                    <th>Principal</th>
                    <th>Balance</th>
                </tr>
            </thead>
            <tbody>
    `;

    let totalInterest = 0;
    let totalPrincipal = 0;

    for (let year = 1; year <= 5; year++) {
        let yearlyInterest = 0;
        let yearlyPrincipal = 0;

        for (let month = 1; month <= 12; month++) {
            const interestPayment = balance * monthlyRate;
            const principalPayment = monthlyPayment - interestPayment;
            
            yearlyInterest += interestPayment;
            yearlyPrincipal += principalPayment;
            balance -= principalPayment;

            if (balance < 0) balance = 0;
        }

        totalInterest += yearlyInterest;
        totalPrincipal += yearlyPrincipal;

        html += `
            <tr>
                <td>Year ${year}</td>
                <td>${formatCurrency(yearlyInterest)}</td>
                <td>${formatCurrency(yearlyPrincipal)}</td>
                <td>${formatCurrency(balance)}</td>
            </tr>
        `;

        if (balance <= 0) break;
    }

    html += `
            </tbody>
        </table>
        <div style="text-align: center; margin-top: 15px; font-style: italic;">
            Showing first 5 years of amortization schedule
        </div>
    `;

    document.getElementById('amortizationChart').innerHTML = html;
}

function formatCurrency(amount) {
    return new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD',
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    }).format(amount);
}

// Add fadeIn animation
const style = document.createElement('style');
style.textContent = `
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
`;
document.head.appendChild(style);

// Auto-calculate when inputs change
document.addEventListener('DOMContentLoaded', function() {
    const inputs = document.querySelectorAll('input, select');
    inputs.forEach(input => {
        input.addEventListener('input', function() {
            const homePrice = document.getElementById('homePrice').value;
            if (homePrice && homePrice > 0) {
                calculateMortgage();
            }
        });
    });
});