// Fuel Cost Calculator JavaScript
document.addEventListener('DOMContentLoaded', function() {
    const calculatorForm = document.getElementById('fuelCalculator');
    const resultsSection = document.getElementById('results');
    let currentMode = 'trip';

    // Mode switching functionality
    document.querySelectorAll('.mode-btn').forEach(button => {
        button.addEventListener('click', function() {
            const mode = this.getAttribute('data-mode');
            switchMode(mode);
            
            // Update active state
            document.querySelectorAll('.mode-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            this.classList.add('active');
        });
    });

    // Advanced options toggles
    document.getElementById('includeTolls').addEventListener('change', function() {
        document.getElementById('tollSection').style.display = this.checked ? 'block' : 'none';
    });

    document.getElementById('includeMaintenance').addEventListener('change', function() {
        document.getElementById('maintenanceSection').style.display = this.checked ? 'block' : 'none';
    });

    document.getElementById('multipleVehicles').addEventListener('change', function() {
        document.getElementById('comparisonSection').style.display = this.checked ? 'block' : 'none';
    });

    // Real-time calculations
    document.getElementById('fuelEfficiency').addEventListener('input', updateEfficiencyEstimate);
    document.getElementById('vehicleType').addEventListener('change', updateEfficiencyEstimate);

    // Form submission handler
    calculatorForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Show loading state
        const submitBtn = calculatorForm.querySelector('.calculate-btn');
        const btnText = submitBtn.querySelector('.btn-text');
        const btnLoading = submitBtn.querySelector('.btn-loading');
        
        btnText.style.display = 'none';
        btnLoading.style.display = 'inline';
        submitBtn.disabled = true;
        
        // Add calculation mode to form data
        const hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.name = 'calculationMode';
        hiddenInput.value = currentMode;
        calculatorForm.appendChild(hiddenInput);
        
        // Collect form data
        const formData = new FormData(calculatorForm);
        
        // Send AJAX request to calculator.php
        fetch('calculator.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                displayResults(data);
            } else {
                showError('Calculation failed. Please try again.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showError('An error occurred. Please try again.');
        })
        .finally(() => {
            // Restore button state
            btnText.style.display = 'inline';
            btnLoading.style.display = 'none';
            submitBtn.disabled = false;
            calculatorForm.removeChild(hiddenInput);
        });
    });

    // Switch calculation mode
    function switchMode(mode) {
        currentMode = mode;
        
        // Hide all fields
        document.getElementById('tripFields').style.display = 'none';
        document.getElementById('monthlyFields').style.display = 'none';
        document.getElementById('efficiencyFields').style.display = 'none';
        
        // Show relevant fields
        switch(mode) {
            case 'trip':
                document.getElementById('tripFields').style.display = 'block';
                break;
            case 'monthly':
                document.getElementById('monthlyFields').style.display = 'block';
                break;
            case 'efficiency':
                document.getElementById('efficiencyFields').style.display = 'block';
                break;
        }
    }

    // Update efficiency estimate based on vehicle type
    function updateEfficiencyEstimate() {
        const vehicleType = document.getElementById('vehicleType').value;
        const efficiencyInput = document.getElementById('fuelEfficiency');
        
        const averageMpg = {
            'sedan': 30,
            'suv': 22,
            'truck': 18,
            'van': 20,
            'hybrid': 45,
            'electric': 100, // MPGe
            'motorcycle': 55
        };
        
        if (!efficiencyInput.value || efficiencyInput.value === '25.5') {
            efficiencyInput.value = averageMpg[vehicleType] || 25;
        }
    }

    // Display calculation results
    function displayResults(data) {
        const results = data.results;
        const environmental = data.environmental;
        
        // Update summary cards
        document.getElementById('resultFuelCost').textContent = formatCurrency(results.fuelCost);
        document.getElementById('resultFuelUsed').textContent = results.fuelUsed + ' gal';
        document.getElementById('resultMpg').textContent = results.mpg + ' MPG';
        document.getElementById('resultCostPerMile').textContent = formatCurrency(results.costPerMile);
        document.getElementById('resultCo2').textContent = environmental.co2Emissions + ' lbs';

        // Update detailed breakdown based on mode
        updateDetailedBreakdown(results, data.mode);

        // Update efficiency analysis
        updateEfficiencyAnalysis(results, data.mode);

        // Update environmental impact
        updateEnvironmentalImpact(environmental);

        // Update vehicle comparison if available
        if (data.comparison && data.comparison.length > 0) {
            updateVehicleComparison(data.comparison);
        }

        // Update fuel saving tips
        updateFuelSavingTips(data.tips);

        // Show results section with animation
        resultsSection.style.display = 'block';
        setTimeout(() => {
            resultsSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }, 100);
    }

    function updateDetailedBreakdown(results, mode) {
        document.getElementById('breakdownDistance').textContent = results.totalDistance + ' miles';
        document.getElementById('breakdownFuelRequired').textContent = results.fuelUsed + ' gallons';
        document.getElementById('breakdownFuelCost').textContent = formatCurrency(results.fuelCost);
        
        // Show/hide additional cost items
        const tollsItem = document.getElementById('breakdownTollsItem');
        const maintenanceItem = document.getElementById('breakdownMaintenanceItem');
        
        if (results.tollCost > 0) {
            tollsItem.style.display = 'flex';
            document.getElementById('breakdownTolls').textContent = formatCurrency(results.tollCost);
        } else {
            tollsItem.style.display = 'none';
        }
        
        if (results.maintenanceCost > 0) {
            maintenanceItem.style.display = 'flex';
            document.getElementById('breakdownMaintenance').textContent = formatCurrency(results.maintenanceCost);
        } else {
            maintenanceItem.style.display = 'none';
        }
        
        document.getElementById('breakdownTotal').textContent = formatCurrency(results.totalCost);
    }

    function updateEfficiencyAnalysis(results, mode) {
        if (mode === 'efficiency') {
            document.getElementById('efficiencyConsumption').textContent = results.lper100km + ' L/100km';
        } else {
            // Calculate liters per 100km from MPG
            const lper100km = 235.214583 / results.mpg;
            document.getElementById('efficiencyConsumption').textContent = lper100km.toFixed(1) + ' L/100km';
        }
        
        // Calculate annual cost (assuming 15,000 miles per year)
        const annualMiles = 15000;
        const annualFuelUsed = annualMiles / results.mpg;
        const annualFuelCost = annualFuelUsed * parseFloat(document.getElementById('fuelPrice').value);
        document.getElementById('efficiencyAnnual').textContent = formatCurrency(annualFuelCost);
        
        // Calculate savings vs average vehicle (25 MPG)
        const avgMpg = 25;
        const avgAnnualFuelUsed = annualMiles / avgMpg;
        const avgAnnualFuelCost = avgAnnualFuelUsed * parseFloat(document.getElementById('fuelPrice').value);
        const savings = avgAnnualFuelCost - annualFuelCost;
        document.getElementById('efficiencySavings').textContent = formatCurrency(savings);
    }

    function updateEnvironmentalImpact(environmental) {
        document.getElementById('impactCo2').textContent = environmental.co2Emissions + ' lbs CO₂';
        document.getElementById('impactTrees').textContent = environmental.treesNeeded + ' trees';
        document.getElementById('impactScore').textContent = environmental.ecoScore + '/100';
        
        // Update progress bars
        document.querySelector('.co2-fill').style.width = Math.min(environmental.co2Emissions / 2, 100) + '%';
        document.querySelector('.eco-fill').style.width = environmental.ecoScore + '%';
    }

    function updateVehicleComparison(comparison) {
        document.getElementById('comparisonResults').style.display = 'block';
        
        // Update comparison table
        for (let i = 0; i < comparison.length; i++) {
            const vehicle = comparison[i];
            document.getElementById('compMpg' + (i + 1)).textContent = vehicle.mpg;
            document.getElementById('compCost' + (i + 1)).textContent = formatCurrency(vehicle.fuelCost);
            
            if (i > 0) {
                document.getElementById('compSavings' + (i + 1)).textContent = formatCurrency(vehicle.annualSavings);
            }
        }
    }

    function updateFuelSavingTips(tips) {
        const list = document.getElementById('suggestionsList');
        list.innerHTML = '';
        
        tips.forEach(tip => {
            const item = document.createElement('div');
            item.className = 'suggestion-item';
            item.textContent = tip;
            list.appendChild(item);
        });
    }

    // Format currency
    function formatCurrency(amount) {
        return '$' + parseFloat(amount).toFixed(2);
    }

    // Action buttons functionality
    document.getElementById('newCalculationBtn').addEventListener('click', function() {
        resultsSection.style.display = 'none';
        calculatorForm.reset();
        switchMode('trip');
        document.querySelector('.mode-btn.active').classList.remove('active');
        document.querySelector('.mode-btn[data-mode="trip"]').classList.add('active');
        document.getElementById('calculator').scrollIntoView({ behavior: 'smooth' });
    });

    document.getElementById('shareResultsBtn').addEventListener('click', function() {
        const fuelCost = document.getElementById('resultFuelCost').textContent;
        const mpg = document.getElementById('resultMpg').textContent;
        const co2 = document.getElementById('resultCo2').textContent;
        
        const shareText = `Fuel Cost Calculation: ${fuelCost} total, ${mpg} efficiency, ${co2} CO₂ emissions. Calculated with Fuel Cost Calculator`;
        
        if (navigator.share) {
            navigator.share({
                title: 'Fuel Cost Analysis',
                text: shareText,
                url: window.location.href
            });
        } else {
            navigator.clipboard.writeText(shareText).then(() => {
                alert('Results copied to clipboard!');
            });
        }
    });

    document.getElementById('saveResultsBtn').addEventListener('click', function() {
        // In a real application, this would save to local storage or generate a PDF
        alert('In a real application, this would save your calculation results for future reference.');
    });

    // Show error message
    function showError(message) {
        alert(message);
    }

    // Smooth scrolling for navigation links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Add interactive animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    // Observe elements for animation
    document.querySelectorAll('.feature-card, .tip-card, .resource-card').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        el.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
        observer.observe(el);
    });

    // Initialize the calculator
    switchMode('trip');
    updateEfficiencyEstimate();
});