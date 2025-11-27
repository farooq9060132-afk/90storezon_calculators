// Data Storage Calculator JavaScript
document.addEventListener('DOMContentLoaded', function() {
    const calculatorForm = document.getElementById('storageCalculator');
    const resultsSection = document.getElementById('results');
    
    // Form submission handler
    calculatorForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Show loading state
        const submitBtn = calculatorForm.querySelector('.calculate-btn');
        const originalText = submitBtn.textContent;
        submitBtn.textContent = 'Calculating...';
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
            submitBtn.textContent = originalText;
            submitBtn.disabled = false;
        });
    });
    
    // Display calculation results
    function displayResults(data) {
        document.getElementById('initialStorage').textContent = data.initialStorage;
        document.getElementById('projectedStorage').textContent = data.projectedStorage;
        document.getElementById('recommendedPlan').textContent = data.recommendedPlan;
        document.getElementById('monthlyCost').textContent = data.monthlyCost;
        document.getElementById('planDescription').textContent = data.planDescription;
        
        // Show results section with animation
        resultsSection.style.display = 'block';
        resultsSection.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        
        // Add animation class
        setTimeout(() => {
            resultsSection.style.opacity = '0';
            resultsSection.style.transform = 'translateY(20px)';
            resultsSection.style.transition = 'all 0.5s ease';
            
            setTimeout(() => {
                resultsSection.style.opacity = '1';
                resultsSection.style.transform = 'translateY(0)';
            }, 50);
        }, 100);
    }
    
    // Show error message
    function showError(message) {
        alert(message); // In a real application, you might want a better error display
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
    
    // Plan selection buttons
    document.querySelectorAll('.select-plan').forEach(button => {
        button.addEventListener('click', function() {
            const planName = this.closest('.plan-card').querySelector('h3').textContent;
            alert(`Thank you for selecting the ${planName}! This is a demo - in a real application, you would be redirected to a payment page.`);
        });
    });
    
    // Real-time validation for file count
    const fileCountInput = document.getElementById('fileCount');
    fileCountInput.addEventListener('input', function() {
        const value = parseInt(this.value);
        if (value > 100000) {
            this.setCustomValidity('Maximum 100,000 files allowed');
        } else if (value < 1) {
            this.setCustomValidity('Please enter at least 1 file');
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
    document.querySelectorAll('.feature-card, .plan-card').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        el.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
        observer.observe(el);
    });
});