
// Discount Calculator JavaScript
document.addEventListener('DOMContentLoaded', function() {
    const calculatorForm = document.getElementById('discountCalculator');
    const resultsSection = document.getElementById('results');
    let currentMode = 'percentage';

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

    // Percentage buttons functionality
    document.querySelectorAll('.percent-btn').forEach(button => {
        button.addEventListener('click', function() {
            const percent = this.getAttribute('data-percent');
            document.getElementById('discountPercentage').value = percent;
            updateDiscountAmount();
        });
    });

    // Multiple items checkbox
    document.getElementById('multipleItems').addEventListener('change', function() {
        const quantitySection = document.getElementById('quantitySection');
        quantitySection.style.display = this.checked ? 'block' : 'none';
    });

    // Real-time calculations
    document.getElementById('originalPrice').addEventListener('input', updateDiscountAmount);
    document.getElementById('discountPercentage').addEventListener('input', updateDiscountAmount);
    document.getElementById('fixedDiscount').addEventListener('input', updateFixedDiscount);
    document.getElementById('finalPrice').addEventListener('input', updateFinalPriceCalculation);

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
        });
    });

    // Switch calculation mode
    function switchMode(mode) {
        currentMode = mode;
        
        // Hide all fields
        document.getElementById('percentageFields').style.display = 'none';
        document.getElementById('fixedFields').style.display = 'none';
        document.getElementById('finalFields').style.display = 'none';
        
        // Show relevant fields
        switch(mode) {
            case 'percentage':
                document.getElementById('percentageFields').style.display = 'grid';
                break;
            case 'fixed':
                document.getElementById('fixedFields').style.display = 'grid';
                break;
            case 'final':
                document.getElementById('finalFields').style.display = 'grid';
                break;
        }
    }

    // Update discount amount based on percentage
    function updateDiscountAmount() {
        const originalPrice = parseFloat(document.getElementById('originalPrice').value) || 0;
        const discountPercentage = parseFloat(document.getElementById('discountPercentage').value) || 0;
        
        if (originalPrice > 0 && discountPercentage >= 0) {
            const discountAmount = originalPrice * (discountPercentage / 100);
            document.getElementById('discountAmount').value = discountAmount.toFixed(2);
        }
    }

    // Update percentage based on fixed discount
    function updateFixedDiscount() {
        const originalPrice = parseFloat(document.getElementById('originalPrice').value) || 0;
        const fixedDiscount = parseFloat(document.getElementById('fixedDiscount').value) || 0;
        
        if (originalPrice > 0 && fixedDiscount >= 0) {
            const percentage = (fixedDiscount / originalPrice) * 100;
            document.getElementById('fixedPercentage').value = percentage.toFixed(1);
        }
    }

    // Calculate discount percentage from final price
    function updateFinalPriceCalculation() {
        const originalPrice = parseFloat(document.getElementById('originalPrice').value) || 0;
        const finalPrice = parseFloat(document.getElementById('finalPrice').value) || 0;
        
        if (originalPrice > 0 && finalPrice >= 0 && finalPrice <= originalPrice) {
            const discountAmount = originalPrice - finalPrice;
            const percentage = (discountAmount / originalPrice) * 100;
            document.getElementById('calculatedDiscount').value = percentage.toFixed(1);
        }
    }

    // Display calculation results
    function displayResults(data) {
        // Update summary cards
        document.getElementById('resultOriginalPrice').textContent = data.calculation.originalPrice;
        document.getElementById('resultDiscount').textContent = data.calculation.discountPercentage;
        document.getElementById('resultDiscountAmount').textContent = data.calculation.discountAmount;
        document.getElementById('resultFinalPrice').textContent = data.calculation.finalPrice;
        document.getElementById('resultSavings').textContent = data.calculation.savings;

        // Update detailed breakdown
        document.getElementById('breakdownOriginal').textContent = data.breakdown.original;
        document.getElementById('breakdownDiscount').textContent = '-' + data.calculation.discountAmount;
        document.getElementById('breakdownSubtotal').textContent = data.breakdown.subtotal;
        document.getElementById('breakdownTax').textContent = data.breakdown.tax;
        document.getElementById('breakdownTotal').textContent = data.breakdown.total;

        // Update comparison chart
        updateComparisonChart(data.comparison);

        // Update multiple items results if applicable
        if (data.multiple && Object.keys(data.multiple).length > 0) {
            document.getElementById('multipleResults').style.display = 'block';
            document.getElementById('perItemPrice').textContent = '$' + data.multiple.perItemPrice.toFixed(2);
            document.getElementById('totalQuantity').textContent = data.multiple.totalQuantity;
            document.getElementById('totalSavings').textContent = '$' + data.multiple.totalSavings.toFixed(2);
        } else {
            document.getElementById('multipleResults').style.display = 'none';
        }

        // Update discount suggestions
        updateDiscountSuggestions(data.suggestions);

        // Show results section with animation
        resultsSection.style.display = 'block';
        setTimeout(() => {
            resultsSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }, 100);
    }

    function updateComparisonChart(comparison) {
        const originalPrice = parseFloat(comparison.original.replace('$', ''));
        const finalPrice = parseFloat(comparison.final.replace('$', ''));
        const savings = parseFloat(comparison.savings.replace('$', ''));
        
        document.getElementById('comparisonOriginal').textContent = comparison.original;
        document.getElementById('comparisonFinal').textContent = comparison.final;
        document.getElementById('comparisonSavings').textContent = comparison.savings;

        // Calculate bar widths
        const finalPercent = (finalPrice / originalPrice) * 100;
        const savingsPercent = (savings / originalPrice) * 100;

        document.getElementById('finalBar').style.width = `${finalPercent}%`;
        document.getElementById('savingsBar').style.width = `${savingsPercent}%`;
    }

    function updateDiscountSuggestions(suggestions) {
        for (const [percentage, data] of Object.entries(suggestions)) {
            const element = document.getElementById('suggestion' + percentage);
            if (element) {
                element.textContent = data.finalPrice;
            }
            
            const saveElement = document.querySelector(`#suggestion${percentage} + .suggestion-save`);
            if (saveElement) {
                saveElement.textContent = 'Save ' + data.savings;
            }
        }
    }

    // Action buttons functionality
    document.getElementById('newCalculationBtn').addEventListener('click', function() {
        resultsSection.style.display = 'none';
        calculatorForm.reset();
        switchMode('percentage');
        document.querySelector('.mode-btn.active').classList.remove('active');
        document.querySelector('.mode-btn[data-mode="percentage"]').classList.add('active');
        document.getElementById('calculator').scrollIntoView({ behavior: 'smooth' });
    });

    document.getElementById('shareResultsBtn').addEventListener('click', function() {
        const originalPrice = document.getElementById('resultOriginalPrice').textContent;
        const discount = document.getElementById('resultDiscount').textContent;
        const finalPrice = document.getElementById('resultFinalPrice').textContent;
        const savings = document.getElementById('resultSavings').textContent;
        
        const shareText = `Discount Calculation: ${originalPrice} → ${finalPrice} (${discount} off) - You save ${savings}. Calculated with Discount Calculator`;
        
        if (navigator.share) {
            navigator.share({
                title: 'Discount Calculation Results',
                text: shareText,
                url: window.location.href
            });
        } else {
            navigator.clipboard.writeText(shareText).then(() => {
                alert('Results copied to clipboard!');
            });
        }
    });

    document.getElementById('printResultsBtn').addEventListener('click', function() {
        window.print();
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
    document.querySelectorAll('.feature-card, .example-card, .tip-card').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        el.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
        observer.observe(el);
    });

    // Auto-calculate on input changes
    const autoCalculateInputs = ['originalPrice', 'discountPercentage', 'fixedDiscount', 'finalPrice'];
    autoCalculateInputs.forEach(inputId => {
        const input = document.getElementById(inputId);
        if (input) {
            input.addEventListener('input', debounce(function() {
                if (document.getElementById('originalPrice').value > 0) {
                    updateDiscountAmount();
                    updateFixedDiscount();
                    updateFinalPriceCalculation();
                }
            }, 300));
        }
    });

    // Debounce function for performance
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    // Initialize the calculator
    switchMode('percentage');
});