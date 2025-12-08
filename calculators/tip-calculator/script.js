// Tip Calculator JavaScript
document.addEventListener('DOMContentLoaded', function() {
    const calculatorForm = document.getElementById('tipCalculator');
    const resultsSection = document.getElementById('results');
    
    // Percentage button functionality
    document.querySelectorAll('.percentage-btn').forEach(button => {
        button.addEventListener('click', function() {
            const percentage = this.getAttribute('data-percentage');
            document.getElementById('tipPercentage').value = percentage;
            
            // Update active state
            document.querySelectorAll('.percentage-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            this.classList.add('active');
        });
    });
    
    // People counter functionality
    document.querySelectorAll('.people-btn').forEach(button => {
        button.addEventListener('click', function() {
            const action = this.getAttribute('data-action');
            const peopleInput = document.getElementById('peopleCount');
            let currentValue = parseInt(peopleInput.value);
            
            if (action === 'increase' && currentValue < 20) {
                peopleInput.value = currentValue + 1;
            } else if (action === 'decrease' && currentValue > 1) {
                peopleInput.value = currentValue - 1;
            }
        });
    });
    
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
    
    // Display calculation results
    function displayResults(data) {
        // Update summary cards
        document.getElementById('tipAmount').textContent = data.calculations.tip;
        document.getElementById('totalBill').textContent = data.calculations.total;
        document.getElementById('perPerson').textContent = data.calculations.perPerson;
        document.getElementById('tipPercentageText').textContent = data.calculations.tipPercentage;
        document.getElementById('peopleText').textContent = data.split.peopleCount + ' person' + (data.split.peopleCount > 1 ? 's' : '');
        
        // Update detailed breakdown
        document.getElementById('subtotalAmount').textContent = data.calculations.subtotal;
        document.getElementById('taxAmountResult').textContent = data.calculations.tax;
        document.getElementById('tipAmountResult').textContent = data.calculations.tip;
        document.getElementById('totalAmount').textContent = data.calculations.total;
        
        // Update split results
        updateSplitResults(data.split.breakdown);
        
        // Update tip suggestions
        updateTipSuggestions(data.suggestions);
        
        // Show results section with animation
        resultsSection.style.display = 'block';
        setTimeout(() => {
            resultsSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }, 100);
    }
    
    function updateSplitResults(breakdown) {
        const splitGrid = document.getElementById('splitGrid');
        splitGrid.innerHTML = '';
        
        breakdown.forEach((item, index) => {
            const splitItem = document.createElement('div');
            splitItem.className = 'split-item';
            splitItem.innerHTML = `
                <div class="split-person">${item.person}</div>
                <div class="split-amount">${item.amount}</div>
            `;
            splitGrid.appendChild(splitItem);
        });
    }
    
    function updateTipSuggestions(suggestions) {
        for (const [percentage, amount] of Object.entries(suggestions)) {
            const element = document.getElementById('suggestion' + percentage);
            if (element) {
                element.textContent = amount;
            }
        }
    }
    
    // Reset button functionality
    document.getElementById('resetBtn').addEventListener('click', function() {
        resultsSection.style.display = 'none';
        calculatorForm.reset();
        
        // Reset percentage buttons
        document.querySelectorAll('.percentage-btn').forEach(btn => {
            btn.classList.remove('active');
        });
        document.querySelector('.percentage-btn[data-percentage="18"]').classList.add('active');
        
        // Scroll back to calculator
        document.getElementById('calculator').scrollIntoView({ behavior: 'smooth' });
    });
    
    // Share button functionality
    document.getElementById('shareBtn').addEventListener('click', function() {
        const tipAmount = document.getElementById('tipAmount').textContent;
        const totalBill = document.getElementById('totalBill').textContent;
        const perPerson = document.getElementById('perPerson').textContent;
        
        const shareText = `Tip Calculation: ${tipAmount} tip, ${totalBill} total, ${perPerson} per person. Calculated with Tip Calculator`;
        
        if (navigator.share) {
            navigator.share({
                title: 'My Tip Calculation',
                text: shareText,
                url: window.location.href
            });
        } else {
            // Fallback: copy to clipboard
            navigator.clipboard.writeText(shareText).then(() => {
                alert('Calculation copied to clipboard!');
            });
        }
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
    
    // Real-time validation
    const billAmountInput = document.getElementById('billAmount');
    billAmountInput.addEventListener('input', function() {
        if (this.value < 0) {
            this.setCustomValidity('Bill amount cannot be negative');
        } else {
            this.setCustomValidity('');
        }
    });
    
    // Add some interactive animations
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
    document.querySelectorAll('.feature-card, .guide-card, .country-card').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        el.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
        observer.observe(el);
    });
    
    // Auto-calculate on input changes for better UX
    const autoCalculateInputs = ['billAmount', 'taxAmount', 'tipPercentage', 'peopleCount'];
    autoCalculateInputs.forEach(inputId => {
        const input = document.getElementById(inputId);
        if (input) {
            input.addEventListener('input', debounce(function() {
                if (document.getElementById('billAmount').value > 0) {
                    calculatorForm.dispatchEvent(new Event('submit'));
                }
            }, 500));
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
});