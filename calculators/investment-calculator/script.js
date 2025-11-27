function calculateInvestment() {
    // Get input values
    const initialInvestment = parseFloat(document.getElementById('initialInvestment').value);
    const monthlyContribution = parseFloat(document.getElementById('monthlyContribution').value);
    const investmentPeriod = parseInt(document.getElementById('investmentPeriod').value);
    const expectedReturn = parseFloat(document.getElementById('expectedReturn').value) / 100;
    const inflationRate = parseFloat(document.getElementById('inflationRate').value) / 100;
    const taxRate = parseFloat(document.getElementById('taxRate').value) / 100;
    const compoundFrequency = parseInt(document.getElementById('compoundFrequency').value);
    const investmentType = document.getElementById('investmentType').value;

    // Validation
    if (!initialInvestment || !investmentPeriod || !expectedReturn) {
        alert('Please fill in all required fields');
        return;
    }

    // Calculate future value with compound interest
    const annualContribution = monthlyContribution * 12;
    const periodsPerYear = compoundFrequency;
    const ratePerPeriod = expectedReturn / periodsPerYear;
    const totalPeriods = investmentPeriod * periodsPerYear;
    
    // Future value of initial investment
    let futureValue = initialInvestment * Math.pow(1 + ratePerPeriod, totalPeriods);
    
    // Future value of regular contributions
    if (monthlyContribution > 0) {
        const contributionPerPeriod = annualContribution / periodsPerYear;
        futureValue += contributionPerPeriod * ((Math.pow(1 + ratePerPeriod, totalPeriods) - 1) / ratePerPeriod);
    }

    // Adjust for taxes
    const totalContributions = initialInvestment + (annualContribution * investmentPeriod);
    const interestEarned = futureValue - totalContributions;
    const taxAmount = interestEarned * taxRate;
    const afterTaxValue = futureValue - taxAmount;

    // Adjust for inflation
    const inflationAdjustedValue = afterTaxValue / Math.pow(1 + inflationRate, investmentPeriod);

    // Calculate ROI
    const roiPercentage = ((afterTaxValue - totalContributions) / totalContributions) * 100;

    // Calculate comparison scenarios
    const scenarioNoContributions = calculateScenario(initialInvestment, 0, investmentPeriod, expectedReturn, taxRate, inflationRate);
    const scenarioPlus100 = calculateScenario(initialInvestment, monthlyContribution + 100, investmentPeriod, expectedReturn, taxRate, inflationRate);
    const scenarioPlus1Percent = calculateScenario(initialInvestment, monthlyContribution, investmentPeriod, expectedReturn + 0.01, taxRate, inflationRate);
    const scenarioPlus2Years = calculateScenario(initialInvestment, monthlyContribution, investmentPeriod + 2, expectedReturn, taxRate, inflationRate);

    // Display results
    displayResults({
        futureValue: inflationAdjustedValue,
        totalContributions: totalContributions,
        interestEarned: interestEarned - taxAmount,
        roiPercentage: roiPercentage,
        scenarioNoContributions: scenarioNoContributions,
        scenarioPlus100: scenarioPlus100,
        scenarioPlus1Percent: scenarioPlus1Percent,
        scenarioPlus2Years: scenarioPlus2Years
    });

    // Generate yearly breakdown
    generateYearlyBreakdown(initialInvestment, monthlyContribution, investmentPeriod, expectedReturn, taxRate, inflationRate);

    // Generate growth chart
    generateGrowthChart(initialInvestment, monthlyContribution, investmentPeriod, expectedReturn);

    // Show result container
    const resultContainer = document.getElementById('resultContainer');
    resultContainer.style.display = 'block';
    resultContainer.style.animation = 'fadeIn 0.5s ease-in';
}

function calculateScenario(initial, monthly, years, returnRate, tax, inflation) {
    const annualContribution = monthly * 12;
    let futureValue = initial * Math.pow(1 + returnRate, years);
    
    if (monthly > 0) {
        futureValue += annualContribution * ((Math.pow(1 + returnRate, years) - 1) / returnRate);
    }
    
    const totalContributions = initial + (annualContribution * years);
    const interestEarned = futureValue - totalContributions;
    const afterTax = futureValue - (interestEarned * tax);
    const inflationAdjusted = afterTax / Math.pow(1 + inflation, years);
    
    return inflationAdjusted;
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
    document.getElementById('futureValue').textContent = formatCurrency(results.futureValue);
    document.getElementById('totalContributions').textContent = formatCurrency(results.totalContributions);
    document.getElementById('interestEarned').textContent = formatCurrency(results.interestEarned);
    document.getElementById('roiPercentage').textContent = results.roiPercentage.toFixed(1) + '%';

    // Update comparison scenarios
    document.getElementById('scenarioNoContributions').textContent = formatCurrency(results.scenarioNoContributions);
    document.getElementById('scenarioPlus100').textContent = formatCurrency(results.scenarioPlus100);
    document.getElementById('scenarioPlus1Percent').textContent = formatCurrency(results.scenarioPlus1Percent);
    document.getElementById('scenarioPlus2Years').textContent = formatCurrency(results.scenarioPlus2Years);
}

function generateYearlyBreakdown(initial, monthly, years, returnRate, taxRate, inflationRate) {
    const breakdownTable = document.getElementById('yearlyBreakdown');
    let html = `
        <table>
            <thead>
                <tr>
                    <th>Year</th>
                    <th>Contributions</th>
                    <th>Interest</th>
                    <th>Total Value</th>
                    <th>After Tax & Inflation</th>
                </tr>
            </thead>
            <tbody>
    `;

    let totalValue = initial;
    let totalContributions = initial;
    const annualContribution = monthly * 12;

    for (let year = 1; year <= years; year++) {
        // Calculate interest for the year
        const yearlyInterest = totalValue * returnRate;
        totalValue += yearlyInterest + annualContribution;
        totalContributions += annualContribution;

        // Calculate after-tax and inflation-adjusted value
        const totalInterest = totalValue - totalContributions;
        const taxAmount = totalInterest * taxRate;
        const afterTaxValue = totalValue - taxAmount;
        const inflationAdjustedValue = afterTaxValue / Math.pow(1 + inflationRate, year);

        html += `
            <tr>
                <td>${year}</td>
                <td>${formatCurrency(totalContributions)}</td>
                <td>${formatCurrency(yearlyInterest)}</td>
                <td>${formatCurrency(totalValue)}</td>
                <td>${formatCurrency(inflationAdjustedValue)}</td>
            </tr>
        `;
    }

    html += `
            </tbody>
        </table>
    `;

    breakdownTable.innerHTML = html;
}

function generateGrowthChart(initial, monthly, years, returnRate) {
    const growthChart = document.getElementById('growthChart');
    let chartData = [];
    
    let totalValue = initial;
    const annualContribution = monthly * 12;

    for (let year = 0; year <= years; year++) {
        if (year > 0) {
            totalValue = totalValue * (1 + returnRate) + annualContribution;
        }
        
        chartData.push({
            year: year,
            value: totalValue
        });
    }

    // Create simple text-based chart
    const maxValue = Math.max(...chartData.map(d => d.value));
    const chartHeight = 150;
    
    let chartHTML = `<div style="position: relative; height: ${chartHeight}px; border-left: 2px solid #333; border-bottom: 2px solid #333; margin-bottom: 20px;">`;
    
    chartData.forEach((data, index) => {
        if (index > 0) {
            const height = (data.value / maxValue) * (chartHeight - 30);
            const width = 20;
            const left = (index / years) * 95;
            
            chartHTML += `
                <div style="position: absolute; bottom: 0; left: ${left}%; width: ${width}px; height: ${height}px; background: #667eea; border-radius: 3px 3px 0 0;"></div>
                <div style="position: absolute; bottom: ${height + 5}px; left: ${left}%; transform: translateX(-50%); font-size: 10px; white-space: nowrap;">
                    ${formatCurrency(data.value)}
                </div>
                <div style="position: absolute; bottom: -25px; left: ${left}%; transform: translateX(-50%); font-size: 10px;">
                    Y${data.year}
                </div>
            `;
        }
    });
    
    chartHTML += `</div>`;
    chartHTML += `<div style="text-align: center; font-style: italic; color: #666;">Investment Growth Over ${years} Years</div>`;
    
    growthChart.innerHTML = chartHTML;
}

function formatCurrency(amount) {
    if (amount >= 1000000) {
        return '$' + (amount / 1000000).toFixed(1) + 'M';
    } else if (amount >= 1000) {
        return '$' + (amount / 1000).toFixed(0) + 'K';
    }
    return new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD',
        minimumFractionDigits: 0,
        maximumFractionDigits: 0
    }).format(amount);
}

// Auto-calculate when inputs change
document.addEventListener('DOMContentLoaded', function() {
    const inputs = document.querySelectorAll('input, select');
    inputs.forEach(input => {
        input.addEventListener('input', function() {
            const initialInvestment = document.getElementById('initialInvestment').value;
            if (initialInvestment && initialInvestment > 0) {
                setTimeout(calculateInvestment, 1000);
            }
        });
    });

    // Initial calculation
    calculateInvestment();
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