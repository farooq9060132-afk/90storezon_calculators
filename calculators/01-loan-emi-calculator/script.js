// Country data
const countryData = {
    'SA': { currency: 'SAR', rate: 7.5, min: 10000, max: 5000000, tenureMin: 12, tenureMax: 360 },
    'AE': { currency: 'AED', rate: 6.5, min: 50000, max: 10000000, tenureMin: 12, tenureMax: 360 },
    'GB': { currency: 'GBP', rate: 4.5, min: 1000, max: 2000000, tenureMin: 12, tenureMax: 360 },
    'US': { currency: 'USD', rate: 5.5, min: 1000, max: 5000000, tenureMin: 12, tenureMax: 360 },
    'CA': { currency: 'CAD', rate: 6.0, min: 1000, max: 3000000, tenureMin: 12, tenureMax: 360 },
    'CN': { currency: 'CNY', rate: 4.8, min: 10000, max: 10000000, tenureMin: 12, tenureMax: 360 },
    'PK': { currency: 'PKR', rate: 15.0, min: 10000, max: 50000000, tenureMin: 12, tenureMax: 360 },
    'IN': { currency: 'INR', rate: 9.5, min: 10000, max: 100000000, tenureMin: 12, tenureMax: 360 },
    'AU': { currency: 'AUD', rate: 6.2, min: 1000, max: 3000000, tenureMin: 12, tenureMax: 360 },
    'DE': { currency: 'EUR', rate: 3.5, min: 1000, max: 2000000, tenureMin: 12, tenureMax: 360 },
    'SG': { currency: 'SGD', rate: 4.0, min: 1000, max: 5000000, tenureMin: 12, tenureMax: 360 }
};

// Currency symbols
const currencySymbols = {
    'SAR': '﷼',
    'AED': 'د.إ',
    'GBP': '£',
    'USD': '$',
    'CAD': 'C$',
    'CNY': '¥',
    'PKR': '₨',
    'INR': '₹',
    'AUD': 'A$',
    'EUR': '€',
    'SGD': 'S$'
};

// Initialize calculator with default country
document.addEventListener('DOMContentLoaded', function() {
    updateCountrySettings();
});

// Update settings based on selected country
function updateCountrySettings() {
    const countrySelect = document.getElementById('country');
    const selectedOption = countrySelect.options[countrySelect.selectedIndex];
    const countryCode = selectedOption.value;
    
    const data = countryData[countryCode];
    
    // Update currency symbol
    document.getElementById('currencySymbol').textContent = currencySymbols[data.currency];
    
    // Update interest rate
    document.getElementById('interestRate').value = data.rate;
    
    // Update loan amount limits
    const loanAmountInput = document.getElementById('loanAmount');
    loanAmountInput.min = data.min;
    loanAmountInput.max = data.max;
    
    // Set placeholder based on limits
    loanAmountInput.placeholder = `Enter amount between ${data.min.toLocaleString()} and ${data.max.toLocaleString()}`;
    
    // Update tenure limits
    const loanTenureInput = document.getElementById('loanTenure');
    const tenureType = document.getElementById('tenureType').value;
    
    // Convert limits based on tenure type
    const minTenure = tenureType === 'months' ? data.tenureMin : Math.ceil(data.tenureMin / 12);
    const maxTenure = tenureType === 'months' ? data.tenureMax : Math.floor(data.tenureMax / 12);
    
    loanTenureInput.min = minTenure;
    loanTenureInput.max = maxTenure;
    loanTenureInput.placeholder = `Enter tenure between ${minTenure} and ${maxTenure}`;
}

// Update tenure limits when tenure type changes
function updateTenureLimits() {
    const countrySelect = document.getElementById('country');
    const selectedOption = countrySelect.options[countrySelect.selectedIndex];
    const countryCode = selectedOption.value;
    
    const data = countryData[countryCode];
    
    const loanTenureInput = document.getElementById('loanTenure');
    const tenureType = document.getElementById('tenureType').value;
    
    // Convert limits based on tenure type
    const minTenure = tenureType === 'months' ? data.tenureMin : Math.ceil(data.tenureMin / 12);
    const maxTenure = tenureType === 'months' ? data.tenureMax : Math.floor(data.tenureMax / 12);
    
    loanTenureInput.min = minTenure;
    loanTenureInput.max = maxTenure;
    loanTenureInput.placeholder = `Enter tenure between ${minTenure} and ${maxTenure}`;
}

// Update tenure limits when tenure type changes
document.getElementById('tenureType').addEventListener('change', updateTenureLimits);

function calculateEMI() {
    const countrySelect = document.getElementById('country');
    const selectedOption = countrySelect.options[countrySelect.selectedIndex];
    const countryCode = selectedOption.value;
    const currency = selectedOption.getAttribute('data-currency');
    
    const loanAmount = parseFloat(document.getElementById('loanAmount').value);
    const interestRate = parseFloat(document.getElementById('interestRate').value);
    const loanTenure = parseFloat(document.getElementById('loanTenure').value);
    const tenureType = document.getElementById('tenureType').value;

    // Validation
    if (!loanAmount || !interestRate || !loanTenure) {
        alert('Please fill in all fields');
        return;
    }

    if (loanAmount <= 0 || interestRate <= 0 || loanTenure <= 0) {
        alert('Please enter positive values');
        return;
    }

    // Get country data for validation
    const data = countryData[countryCode];
    
    // Validate loan amount
    if (loanAmount < data.min || loanAmount > data.max) {
        alert(`Loan amount must be between ${data.min.toLocaleString()} and ${data.max.toLocaleString()} ${data.currency}`);
        return;
    }

    // Convert to months if tenure is in years
    const months = tenureType === 'years' ? loanTenure * 12 : loanTenure;
    
    // Validate tenure
    if (months < data.tenureMin || months > data.tenureMax) {
        const minYears = Math.ceil(data.tenureMin / 12);
        const maxYears = Math.floor(data.tenureMax / 12);
        alert(`Loan tenure must be between ${minYears} and ${maxYears} years (${data.tenureMin} and ${data.tenureMax} months)`);
        return;
    }
    
    // Monthly interest rate
    const monthlyRate = interestRate / 12 / 100;
    
    // EMI formula: EMI = [P x R x (1+R)^N]/[(1+R)^N-1]
    const emi = loanAmount * monthlyRate * Math.pow(1 + monthlyRate, months) / 
                (Math.pow(1 + monthlyRate, months) - 1);
    
    const totalAmount = emi * months;
    const totalInterest = totalAmount - loanAmount;

    // Display results with proper currency
    const currencySymbol = currencySymbols[currency];
    document.getElementById('monthlyEMI').textContent = currencySymbol + emi.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    document.getElementById('totalInterest').textContent = currencySymbol + totalInterest.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    document.getElementById('totalAmount').textContent = currencySymbol + totalAmount.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    
    // Generate amortization schedule
    generateAmortizationSchedule(loanAmount, monthlyRate, months, emi, currencySymbol);
    
    // Show result containers with animation
    const resultContainer = document.getElementById('resultContainer');
    const amortizationContainer = document.getElementById('amortizationContainer');
    
    // Add class for mobile responsiveness
    resultContainer.classList.add('show');
    resultContainer.style.animation = 'fadeIn 0.5s ease-in';
    
    amortizationContainer.style.display = 'block';
    amortizationContainer.style.animation = 'fadeIn 0.5s ease-in 0.3s forwards';
    
    // Scroll to results
    resultContainer.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    
    // Ensure proper display on mobile devices
    setTimeout(function() {
        resultContainer.style.display = 'block';
    }, 100);
}

function generateAmortizationSchedule(loanAmount, monthlyRate, months, emi, currencySymbol) {
    const tbody = document.getElementById('amortizationBody');
    tbody.innerHTML = '';
    
    let balance = loanAmount;
    
    // Create table rows for each month
    for (let month = 1; month <= months; month++) {
        const interestPayment = balance * monthlyRate;
        const principalPayment = emi - interestPayment;
        balance -= principalPayment;
        
        // Ensure balance doesn't go negative due to rounding
        if (month === months) {
            balance = 0;
        }
        
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${month}</td>
            <td>${currencySymbol}${emi.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
            <td>${currencySymbol}${principalPayment.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
            <td>${currencySymbol}${interestPayment.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
            <td>${currencySymbol}${balance.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
        `;
        
        tbody.appendChild(row);
        
        // Limit to first 100 rows for performance, show a message if more
        if (month === 100 && months > 100) {
            const summaryRow = document.createElement('tr');
            summaryRow.innerHTML = `
                <td colspan="5" style="text-align: center; font-weight: bold;">
                    Showing first 100 of ${months} months. Download full schedule for complete details.
                </td>
            `;
            tbody.appendChild(summaryRow);
            break;
        }
    }
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

// Enter key support
document.addEventListener('DOMContentLoaded', function() {
    const inputs = document.querySelectorAll('input');
    inputs.forEach(input => {
        input.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                calculateEMI();
            }
        });
    });
});

// Add fade in animation for amortization table
const style = document.createElement('style');
style.textContent = `
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    #amortizationTable {
        animation: fadeIn 0.5s ease-in;
    }
`;
document.head.appendChild(style);