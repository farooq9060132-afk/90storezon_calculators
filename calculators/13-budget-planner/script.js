// script.js
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Chart.js
    const ctx = document.getElementById('budget-chart').getContext('2d');
    let budgetChart = null;
    
    // Calculate button event listener
    document.getElementById('calculate').addEventListener('click', calculateBudget);
    
    // Add income source button
    document.getElementById('add-income').addEventListener('click', function() {
        addCustomInput('income', 'Income Source');
    });
    
    // Add expense category button
    document.getElementById('add-expense').addEventListener('click', function() {
        addCustomInput('expenses', 'Expense Category');
    });
    
    // Initialize with default values for demo
    initializeDemoValues();
    
    function calculateBudget() {
        // Calculate total income
        const salary = parseFloat(document.getElementById('salary').value) || 0;
        const otherIncome = parseFloat(document.getElementById('other-income').value) || 0;
        const customIncomes = document.querySelectorAll('.custom-income input');
        let totalCustomIncome = 0;
        
        customIncomes.forEach(input => {
            totalCustomIncome += parseFloat(input.value) || 0;
        });
        
        const totalIncome = salary + otherIncome + totalCustomIncome;
        
        // Calculate total expenses
        const rent = parseFloat(document.getElementById('rent').value) || 0;
        const utilities = parseFloat(document.getElementById('utilities').value) || 0;
        const carPayment = parseFloat(document.getElementById('car-payment').value) || 0;
        const gas = parseFloat(document.getElementById('gas').value) || 0;
        const groceries = parseFloat(document.getElementById('groceries').value) || 0;
        const dining = parseFloat(document.getElementById('dining').value) || 0;
        const entertainment = parseFloat(document.getElementById('entertainment').value) || 0;
        const personalCare = parseFloat(document.getElementById('personal-care').value) || 0;
        
        const customExpenses = document.querySelectorAll('.custom-expense input');
        let totalCustomExpenses = 0;
        
        customExpenses.forEach(input => {
            totalCustomExpenses += parseFloat(input.value) || 0;
        });
        
        const totalExpenses = rent + utilities + carPayment + gas + groceries + 
                             dining + entertainment + personalCare + totalCustomExpenses;
        
        // Calculate net income
        const netIncome = totalIncome - totalExpenses;
        
        // Update UI
        document.getElementById('total-income').textContent = formatCurrency(totalIncome);
        document.getElementById('total-expenses').textContent = formatCurrency(totalExpenses);
        document.getElementById('net-income').textContent = formatCurrency(netIncome);
        
        // Update chart
        updateChart(totalIncome, totalExpenses, netIncome);
        
        // Update savings progress
        updateSavingsProgress(totalIncome);
    }
    
    function updateChart(income, expenses, net) {
        const chartData = {
            labels: ['Income', 'Expenses', 'Net'],
            datasets: [{
                label: 'Budget Overview',
                data: [income, expenses, net],
                backgroundColor: [
                    'rgba(76, 201, 240, 0.7)',
                    'rgba(247, 37, 133, 0.7)',
                    'rgba(67, 97, 238, 0.7)'
                ],
                borderColor: [
                    'rgb(76, 201, 240)',
                    'rgb(247, 37, 133)',
                    'rgb(67, 97, 238)'
                ],
                borderWidth: 1
            }]
        };
        
        if (budgetChart) {
            budgetChart.destroy();
        }
        
        budgetChart = new Chart(ctx, {
            type: 'bar',
            data: chartData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return '$' + value;
                            }
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': $' + context.raw;
                            }
                        }
                    }
                }
            }
        });
    }
    
    function updateSavingsProgress(totalIncome) {
        const emergencyFund = parseFloat(document.getElementById('emergency-fund').value) || 0;
        const retirement = parseFloat(document.getElementById('retirement').value) || 0;
        
        // Calculate percentages (assuming goals are monthly savings amounts)
        const emergencyPercent = totalIncome > 0 ? Math.min(100, (emergencyFund / totalIncome) * 100) : 0;
        const retirementPercent = totalIncome > 0 ? Math.min(100, (retirement / totalIncome) * 100) : 0;
        
        // Update progress bars
        document.getElementById('emergency-progress').style.width = emergencyPercent + '%';
        document.getElementById('retirement-progress').style.width = retirementPercent + '%';
        
        // Update percentage labels
        document.getElementById('emergency-percent').textContent = Math.round(emergencyPercent) + '%';
        document.getElementById('retirement-percent').textContent = Math.round(retirementPercent) + '%';
    }
    
    function addCustomInput(type, placeholder) {
        const container = document.createElement('div');
        container.className = `input-group custom-${type}`;
        
        const input = document.createElement('input');
        input.type = 'number';
        input.placeholder = placeholder;
        
        const removeBtn = document.createElement('button');
        removeBtn.type = 'button';
        removeBtn.className = 'btn-secondary';
        removeBtn.textContent = 'Remove';
        removeBtn.style.marginLeft = '10px';
        removeBtn.style.padding = '0.5rem';
        
        removeBtn.addEventListener('click', function() {
            container.remove();
        });
        
        container.appendChild(input);
        container.appendChild(removeBtn);
        
        if (type === 'income') {
            document.querySelector('.income-section').insertBefore(container, document.getElementById('add-income'));
        } else {
            document.querySelector('.expenses-section').insertBefore(container, document.getElementById('add-expense'));
        }
    }
    
    function formatCurrency(amount) {
        return '$' + amount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
    }
    
    function initializeDemoValues() {
        // Set some demo values for a better user experience
        document.getElementById('salary').value = 3500;
        document.getElementById('rent').value = 1200;
        document.getElementById('utilities').value = 200;
        document.getElementById('car-payment').value = 300;
        document.getElementById('gas').value = 150;
        document.getElementById('groceries').value = 400;
        document.getElementById('dining').value = 200;
        document.getElementById('entertainment').value = 150;
        document.getElementById('personal-care').value = 100;
        document.getElementById('emergency-fund').value = 350;
        document.getElementById('retirement').value = 300;
        
        // Calculate initial budget
        calculateBudget();
    }
});