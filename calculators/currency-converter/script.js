// Exchange rates data (sample rates - in real app, use API)
const exchangeRates = {
    USD: { EUR: 0.85, GBP: 0.73, JPY: 110.25, CAD: 1.25, AUD: 1.35, CHF: 0.92, CNY: 6.45, INR: 74.50, PKR: 175.50 },
    EUR: { USD: 1.18, GBP: 0.86, JPY: 129.75, CAD: 1.47, AUD: 1.59, CHF: 1.08, CNY: 7.59, INR: 87.65, PKR: 206.45 },
    GBP: { USD: 1.37, EUR: 1.16, JPY: 151.25, CAD: 1.71, AUD: 1.85, CHF: 1.26, CNY: 8.85, INR: 102.15, PKR: 240.65 },
    JPY: { USD: 0.0091, EUR: 0.0077, GBP: 0.0066, CAD: 0.011, AUD: 0.012, CHF: 0.0083, CNY: 0.058, INR: 0.68, PKR: 1.59 },
    CAD: { USD: 0.80, EUR: 0.68, GBP: 0.58, JPY: 90.75, AUD: 1.08, CHF: 0.74, CNY: 5.16, INR: 59.60, PKR: 140.40 },
    AUD: { USD: 0.74, EUR: 0.63, GBP: 0.54, JPY: 83.25, CAD: 0.93, CHF: 0.68, CNY: 4.78, INR: 55.20, PKR: 130.05 },
    CHF: { USD: 1.09, EUR: 0.93, GBP: 0.79, JPY: 120.75, CAD: 1.35, AUD: 1.47, CNY: 7.01, INR: 81.00, PKR: 190.85 },
    CNY: { USD: 0.155, EUR: 0.132, GBP: 0.113, JPY: 17.25, CAD: 0.194, AUD: 0.209, CHF: 0.143, INR: 11.55, PKR: 27.20 },
    INR: { USD: 0.0134, EUR: 0.0114, GBP: 0.0098, JPY: 1.47, CAD: 0.0168, AUD: 0.0181, CHF: 0.0123, CNY: 0.0865, PKR: 2.35 },
    PKR: { USD: 0.0057, EUR: 0.0048, GBP: 0.0042, JPY: 0.63, CAD: 0.0071, AUD: 0.0077, CHF: 0.0052, CNY: 0.0368, INR: 0.426 }
};

function convertCurrency() {
    const amount = parseFloat(document.getElementById('amount').value);
    const fromCurrency = document.getElementById('fromCurrency').value;
    const toCurrency = document.getElementById('toCurrency').value;

    // Validation
    if (!amount || amount <= 0) {
        alert('Please enter a valid amount');
        return;
    }

    if (fromCurrency === toCurrency) {
        alert('Please select different currencies');
        return;
    }

    // Get exchange rate
    const rate = exchangeRates[fromCurrency][toCurrency];
    const convertedAmount = amount * rate;

    // Display results
    document.getElementById('fromAmount').textContent = `${formatCurrency(amount, fromCurrency)}`;
    document.getElementById('toAmount').textContent = `${formatCurrency(convertedAmount, toCurrency)}`;
    document.getElementById('exchangeRate').textContent = `Exchange Rate: 1 ${fromCurrency} = ${rate.toFixed(4)} ${toCurrency}`;
    
    // Show popular conversions
    showPopularConversions(fromCurrency);
    
    // Show result container
    const resultContainer = document.getElementById('resultContainer');
    // Add class for mobile responsiveness
    resultContainer.classList.add('show');
    resultContainer.style.animation = 'fadeIn 0.5s ease-in';
    
    // Ensure proper display on mobile devices
    setTimeout(function() {
        resultContainer.style.display = 'block';
    }, 100);
}

function swapCurrencies() {
    const fromCurrency = document.getElementById('fromCurrency');
    const toCurrency = document.getElementById('toCurrency');
    
    const temp = fromCurrency.value;
    fromCurrency.value = toCurrency.value;
    toCurrency.value = temp;
    
    // If there's an amount, convert immediately
    const amount = document.getElementById('amount').value;
    if (amount) {
        convertCurrency();
    }
}

function formatCurrency(amount, currency) {
    return new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: currency,
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    }).format(amount);
}

function showPopularConversions(baseCurrency) {
    const popularCurrencies = ['USD', 'EUR', 'GBP', 'JPY', 'CAD', 'AUD'];
    const popularGrid = document.getElementById('popularConversions');
    const baseAmount = parseFloat(document.getElementById('amount').value) || 1;
    
    let html = '';
    popularCurrencies.forEach(currency => {
        if (currency !== baseCurrency) {
            const rate = exchangeRates[baseCurrency][currency];
            const converted = baseAmount * rate;
            html += `
                <div class="currency-item">
                    ${formatCurrency(baseAmount, baseCurrency)} = ${formatCurrency(converted, currency)}
                </div>
            `;
        }
    });
    
    popularGrid.innerHTML = html;
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

// Enter key support and auto-convert
document.addEventListener('DOMContentLoaded', function() {
    const amountInput = document.getElementById('amount');
    amountInput.addEventListener('input', function() {
        if (this.value && this.value > 0) {
            convertCurrency();
        }
    });
    
    // Auto-convert when currency selection changes
    const currencySelects = document.querySelectorAll('select');
    currencySelects.forEach(select => {
        select.addEventListener('change', function() {
            if (amountInput.value && amountInput.value > 0) {
                convertCurrency();
            }
        });
    });
});