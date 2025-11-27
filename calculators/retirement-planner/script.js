function calculateRetirement() {
    // Get input values
    const currentAge = parseInt(document.getElementById('currentAge').value);
    const retirementAge = parseInt(document.getElementById('retirementAge').value);
    const lifeExpectancy = parseInt(document.getElementById('lifeExpectancy').value);
    const annualIncome = parseFloat(document.getElementById('annualIncome').value);
    const currentSavings = parseFloat(document.getElementById('currentSavings').value);
    const monthlyContribution = parseFloat(document.getElementById('monthlyContribution').value);
    const employerMatch = parseFloat(document.getElementById('employerMatch').value) / 100;
    const employerMatchLimit = parseFloat(document.getElementById('employerMatchLimit').value) / 100;
    const expectedReturn = parseFloat(document.getElementById('expectedReturn').value) / 100;
    const inflationRate = parseFloat(document.getElementById('inflationRate').value) / 100;
    const incomeReplacement = parseFloat(document.getElementById('incomeReplacement').value) / 100;
    const socialSecurity = parseFloat(document.getElementById('socialSecurity').value) * 12; // Convert to annual

    // Validation
    if (!currentAge || !retirementAge || !annualIncome) {
        alert('Please fill in all required fields');
        return;
    }

    if (currentAge >= retirementAge) {
        alert('Retirement age must be greater than current age');
        return;
    }

    // Calculate years until retirement
    const yearsToRetirement = retirementAge - currentAge;
    const retirementYears = lifeExpectancy - retirementAge;

    // Calculate retirement income needed (adjusted for inflation)
    const desiredAnnualIncome = annualIncome * incomeReplacement;
    const inflationAdjustedIncome = desiredAnnualIncome * Math.pow(1 + inflationRate, yearsToRetirement);

    // Calculate retirement goal (using 4% withdrawal rule)
    const retirementGoal = (inflationAdjustedIncome - socialSecurity) / 0.04;

    // Calculate projected savings with compound interest
    let projectedSavings = currentSavings;
    const annualContribution = monthlyContribution * 12;
    const employerAnnualMatch = Math.min(annualIncome * employerMatchLimit, annualIncome * employerMatch);

    for (let year = 1; year <= yearsToRetirement; year++) {
        // Add contributions and employer match
        projectedSavings += annualContribution + employerAnnualMatch;
        // Apply investment growth
        projectedSavings *= (1 + expectedReturn);
    }

    // Calculate savings gap
    const savingsGap = Math.max(0, retirementGoal - projectedSavings);

    // Calculate monthly retirement income
    const safeWithdrawalRate = 0.04;
    const annualWithdrawal = projectedSavings * safeWithdrawalRate;
    const monthlyRetirementIncome = (annualWithdrawal + socialSecurity) / 12;

    // Calculate progress percentage
    const progressPercentage = Math.min(100, (projectedSavings / retirementGoal) * 100);

    // Display results
    displayResults({
        retirementGoal: retirementGoal,
        projectedSavings: projectedSavings,
        savingsGap: savingsGap,
        monthlyIncome: monthlyRetirementIncome,
        progressPercentage: progressPercentage,
        annualWithdrawal: annualWithdrawal,
        retirementYears: retirementYears
    });

    // Generate recommendations
    generateRecommendations(savingsGap, progressPercentage, yearsToRetirement);

    // Generate timeline chart
    generateTimelineChart(currentAge, retirementAge, currentSavings, annualContribution, employerAnnualMatch, expectedReturn);

    // Show result container
    const resultContainer = document.getElementById('resultContainer');
    resultContainer.style.display = 'block';
    resultContainer.style.animation = 'fadeIn 0.5s ease-in';
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
    document.getElementById('retirementGoal').textContent = formatCurrency(results.retirementGoal);
    document.getElementById('projectedSavings').textContent = formatCurrency(results.projectedSavings);
    document.getElementById('savingsGap').textContent = formatCurrency(results.savingsGap);
    document.getElementById('monthlyIncome').textContent = formatCurrency(results.monthlyIncome);

    // Update progress bar
    const progressFill = document.getElementById('progressFill');
    const progressText = document.getElementById('progressText');
    progressFill.style.width = `${results.progressPercentage}%`;
    progressText.textContent = `${results.progressPercentage.toFixed(1)}% of goal achieved`;

    // Update withdrawal strategy
    document.getElementById('annualWithdrawal').textContent = formatCurrency(results.annualWithdrawal);
    document.getElementById('portfolioDuration').textContent = `${results.retirementYears} years`;
}

function generateRecommendations(savingsGap, progressPercentage, yearsToRetirement) {
    const recommendationsGrid = document.getElementById('recommendationsGrid');
    let recommendations = [];

    if (savingsGap > 0) {
        if (yearsToRetirement > 10) {
            recommendations.push({
                icon: 'fas fa-chart-line',
                text: `Increase monthly contributions by ${formatCurrency(savingsGap / (yearsToRetirement * 12))} to reach your goal`
            });
        }

        if (progressPercentage < 50) {
            recommendations.push({
                icon: 'fas fa-percentage',
                text: 'Consider increasing your investment return by diversifying your portfolio'
            });
        }

        recommendations.push({
            icon: 'fas fa-clock',
            text: `You have ${yearsToRetirement} years to close the savings gap of ${formatCurrency(savingsGap)}`
        });
    } else {
        recommendations.push({
            icon: 'fas fa-check-circle',
            text: 'Great! You are on track to meet your retirement goals'
        });
    }

    recommendations.push({
        icon: 'fas fa-user-plus',
        text: 'Maximize employer matching contributions - it\'s free money'
    });

    recommendations.push({
        icon: 'fas fa-shield-alt',
        text: 'Consider delaying Social Security to increase monthly benefits'
    });

    // Display recommendations
    recommendationsGrid.innerHTML = recommendations.map(rec => `
        <div class="recommendation-item">
            <i class="${rec.icon}"></i>
            <span>${rec.text}</span>
        </div>
    `).join('');
}

function generateTimelineChart(currentAge, retirementAge, currentSavings, annualContribution, employerMatch, expectedReturn) {
    const timelineChart = document.getElementById('timelineChart');
    const yearsToRetirement = retirementAge - currentAge;
    
    let savingsData = [];
    let totalSavings = currentSavings;

    for (let year = 0; year <= yearsToRetirement; year++) {
        savingsData.push({
            age: currentAge + year,
            savings: totalSavings
        });

        if (year < yearsToRetirement) {
            // Add contributions and apply growth
            totalSavings += annualContribution + employerMatch;
            totalSavings *= (1 + expectedReturn);
        }
    }

    // Create simple text-based chart
    const chartHTML = `
        <div style="font-family: monospace; font-size: 12px; line-height: 1.4;">
            <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                <span>Age</span>
                <span>Savings</span>
            </div>
            ${savingsData.map(data => `
                <div style="display: flex; justify-content: space-between; padding: 2px 0;">
                    <span>${data.age} years</span>
                    <span>${formatCurrency(data.savings)}</span>
                </div>
            `).join('')}
        </div>
        <div style="text-align: center; margin-top: 15px; font-style: italic;">
            Projected growth at ${(expectedReturn * 100).toFixed(1)}% annual return
        </div>
    `;

    timelineChart.innerHTML = chartHTML;
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
    const inputs = document.querySelectorAll('input');
    inputs.forEach(input => {
        input.addEventListener('input', function() {
            const currentAge = document.getElementById('currentAge').value;
            if (currentAge && currentAge >= 18) {
                setTimeout(calculateRetirement, 1000);
            }
        });
    });

    // Initial calculation
    calculateRetirement();
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