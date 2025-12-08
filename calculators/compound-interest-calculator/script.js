let growthChart = null;

function calculateCompoundInterest() {
    const principal = parseFloat(document.getElementById('principal').value);
    const monthlyContribution = parseFloat(document.getElementById('monthlyContribution').value);
    const annualRate = parseFloat(document.getElementById('interestRate').value);
    const years = parseInt(document.getElementById('years').value);
    const compoundFrequency = parseInt(document.getElementById('compoundFrequency').value);

    // Validation
    if (!principal || !annualRate || !years) {
        alert('Please fill in all required fields');
        return;
    }

    if (principal < 0 || annualRate <= 0 || years <= 0) {
        alert('Please enter valid positive values');
        return;
    }

    // Calculate compound interest with regular contributions
    const ratePerPeriod = annualRate / 100 / compoundFrequency;
    const totalPeriods = years * compoundFrequency;
    const contributionPerPeriod = monthlyContribution * (12 / compoundFrequency);

    // Future value formula with regular contributions: FV = P(1 + r)^n + C[((1 + r)^n - 1)/r]
    let futureValue = principal * Math.pow(1 + ratePerPeriod, totalPeriods);
    
    if (contributionPerPeriod > 0) {
        futureValue += contributionPerPeriod * ((Math.pow(1 + ratePerPeriod, totalPeriods) - 1) / ratePerPeriod);
    }

    // Calculate totals
    const totalContributions = principal + (monthlyContribution * 12 * years);
    const interestEarned = futureValue - totalContributions;
    const roi = ((interestEarned / totalContributions) * 100);

    // Display results
    document.getElementById('futureValue').textContent = formatCurrency(futureValue);
    document.getElementById('totalContributions').textContent = formatCurrency(totalContributions);
    document.getElementById('interestEarned').textContent = formatCurrency(interestEarned);
    document.getElementById('roi').textContent = roi.toFixed(1) + '%';

    // Generate growth chart and yearly breakdown
    generateGrowthChart(principal, monthlyContribution, annualRate, years, compoundFrequency);
    generateYearlyBreakdown(principal, monthlyContribution, annualRate, years, compoundFrequency);
    
    // Show result container
    const resultContainer = document.getElementById('resultContainer');
    resultContainer.style.display = 'block';
    resultContainer.style.animation = 'fadeIn 0.5s ease-in';
}

function generateGrowthChart(principal, monthlyContribution, annualRate, years, compoundFrequency) {
    const ctx = document.getElementById('growthChart').getContext('2d');
    
    // Destroy previous chart if exists
    if (growthChart) {
        growthChart.destroy();
    }

    const labels = [];
    const principalData = [];
    const interestData = [];
    const totalData = [];

    let balance = principal;
    const ratePerPeriod = annualRate / 100 / compoundFrequency;
    const periodsPerYear = compoundFrequency;

    for (let year = 0; year <= years; year++) {
        labels.push(`Year ${year}`);
        principalData.push(principal + (monthlyContribution * 12 * year));
        totalData.push(balance);
        interestData.push(balance - (principal + (monthlyContribution * 12 * year)));

        // Calculate balance for next year
        if (year < years) {
            for (let period = 0; period < periodsPerYear; period++) {
                balance = balance * (1 + ratePerPeriod) + (monthlyContribution * (12 / periodsPerYear));
            }
        }
    }

    growthChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Total Value',
                    data: totalData,
                    borderColor: '#667eea',
                    backgroundColor: 'rgba(102, 126, 234, 0.1)',
                    fill: true,
                    tension: 0.4
                },
                {
                    label: 'Total Contributions',
                    data: principalData,
                    borderColor: '#f093fb',
                    backgroundColor: 'rgba(240, 147, 251, 0.1)',
                    fill: true,
                    tension: 0.4
                },
                {
                    label: 'Interest Earned',
                    data: interestData,
                    borderColor: '#f5576c',
                    backgroundColor: 'rgba(245, 87, 108, 0.1)',
                    fill: true,
                    tension: 0.4
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                title: {
                    display: true,
                    text: 'Investment Growth Over Time'
                },
                tooltip: {
                    mode: 'index',
                    intersect: false,
                    callbacks: {
                        label: function(context) {
                            return context.dataset.label + ': ' + formatCurrency(context.parsed.y);
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return '$' + value.toLocaleString();
                        }
                    }
                }
            }
        }
    });
}

function generateYearlyBreakdown(principal, monthlyContribution, annualRate, years, compoundFrequency) {
    let html = `
        <table class="breakdown-table">
            <thead>
                <tr>
                    <th>Year</th>
                    <th>Beginning Balance</th>
                    <th>Contributions</th>
                    <th>Interest Earned</th>
                    <th>Ending Balance</th>
                </tr>
            </thead>
            <tbody>
    `;

    let balance = principal;
    const ratePerPeriod = annualRate / 100 / compoundFrequency;
    const periodsPerYear = compoundFrequency;

    for (let year = 1; year <= years; year++) {
        const beginningBalance = balance;
        let yearlyContributions = 0;
        let yearlyInterest = 0;

        for (let period = 0; period < periodsPerYear; period++) {
            const periodContribution = monthlyContribution * (12 / periodsPerYear);
            const interest = balance * ratePerPeriod;
            
            yearlyContributions += periodContribution;
            yearlyInterest += interest;
            balance = balance + interest + periodContribution;
        }

        html += `
            <tr>
                <td>${year}</td>
                <td>${formatCurrency(beginningBalance)}</td>
                <td>${formatCurrency(yearlyContributions)}</td>
                <td>${formatCurrency(yearlyInterest)}</td>
                <td>${formatCurrency(balance)}</td>
            </tr>
        `;
    }

    // Add total row
    const totalContributions = principal + (monthlyContribution * 12 * years);
    const totalInterest = balance - totalContributions;

    html += `
            </tbody>
            <tfoot>
                <tr>
                    <td><strong>Total</strong></td>
                    <td>-</td>
                    <td><strong>${formatCurrency(totalContributions)}</strong></td>
                    <td><strong>${formatCurrency(totalInterest)}</strong></td>
                    <td><strong>${formatCurrency(balance)}</strong></td>
                </tr>
            </tfoot>
        </table>
    `;

    document.getElementById('yearlyTable').innerHTML = html;
}

function formatCurrency(amount) {
    return new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD',
        minimumFractionDigits: 0,
        maximumFractionDigits: 0
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
            const principal = document.getElementById('principal').value;
            if (principal && principal > 0) {
                calculateCompoundInterest();
            }
        });
    });

    // Initial calculation
    calculateCompoundInterest();
});