// DOM Elements
const bodyFatForm = document.getElementById('bodyFatForm');
const genderSelect = document.getElementById('gender');
const hipGroup = document.getElementById('hipGroup');
const resultsSection = document.getElementById('results');

// Show/hide hip input based on gender
genderSelect.addEventListener('change', function() {
    if (this.value === 'female') {
        hipGroup.style.display = 'block';
        document.getElementById('hip').required = true;
    } else {
        hipGroup.style.display = 'none';
        document.getElementById('hip').required = false;
        document.getElementById('hip').value = '';
    }
});

// Form submission
bodyFatForm.addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const submitBtn = this.querySelector('.calculate-btn');
    const originalText = submitBtn.innerHTML;
    
    // Show loading state
    submitBtn.innerHTML = '⏳ Calculating...';
    submitBtn.disabled = true;
    
    try {
        const formData = new FormData(this);
        const response = await fetch('calculator.php', {
            method: 'POST',
            body: formData
        });
        
        const data = await response.json();
        
        if (data.success) {
            displayResults(data);
        } else {
            showError(data.error || 'An error occurred. Please try again.');
        }
    } catch (error) {
        showError('Network error. Please check your connection.');
    } finally {
        // Reset button
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
    }
});

// Display results
function displayResults(data) {
    const { bodyFat, category, fatMass, leanMass, healthTips } = data;
    
    // Update result values
    document.getElementById('bfPercentage').textContent = `${bodyFat}%`;
    document.getElementById('bfCategory').textContent = category;
    document.getElementById('fatMass').textContent = `${fatMass} kg`;
    document.getElementById('leanMass').textContent = `${leanMass} kg`;
    
    // Update progress bar
    const progressFill = document.getElementById('progressFill');
    const progressWidth = Math.min(100, (bodyFat / 50) * 100);
    progressFill.style.width = `${progressWidth}%`;
    
    // Update health tips
    const healthTipsElement = document.getElementById('healthTips');
    healthTipsElement.innerHTML = `
        <h4>💡 Health Recommendations</h4>
        <ul>
            ${healthTips.map(tip => `<li>${tip}</li>`).join('')}
        </ul>
    `;
    
    // Show results with animation
    resultsSection.style.display = 'block';
    resultsSection.classList.add('fade-in');
    
    // Scroll to results
    resultsSection.scrollIntoView({ behavior: 'smooth' });
    
    // Add category-based styling
    updateCategoryStyling(category);
}

// Update styling based on category
function updateCategoryStyling(category) {
    const bfPercentage = document.getElementById('bfPercentage');
    const bfCategory = document.getElementById('bfCategory');
    
    // Reset classes
    bfPercentage.className = 'result-value';
    bfCategory.className = 'result-value';
    
    // Add category-based styling
    const categoryClasses = {
        'Essential Fat': 'success',
        'Athlete': 'success',
        'Fitness': 'success',
        'Average': 'warning',
        'Obese': 'danger'
    };
    
    const cssClass = categoryClasses[category] || '';
    if (cssClass) {
        bfPercentage.classList.add(cssClass);
        bfCategory.classList.add(cssClass);
    }
}

// Show error message
function showError(message) {
    // Create or update error message element
    let errorElement = document.querySelector('.error-message');
    if (!errorElement) {
        errorElement = document.createElement('div');
        errorElement.className = 'error-message';
        bodyFatForm.appendChild(errorElement);
    }
    
    errorElement.textContent = message;
    
    // Remove error after 5 seconds
    setTimeout(() => {
        errorElement.remove();
    }, 5000);
}

// Input validation
document.querySelectorAll('input').forEach(input => {
    input.addEventListener('input', function() {
        this.classList.remove('error', 'success');
        
        if (this.checkValidity()) {
            this.classList.add('success');
        } else if (this.value) {
            this.classList.add('error');
        }
    });
});

// Add some interactive features
document.addEventListener('DOMContentLoaded', function() {
    // Add pulse animation to VIP card
    const vipCard = document.querySelector('.vip-card');
    setInterval(() => {
        vipCard.style.transform = 'scale(1.02)';
        setTimeout(() => {
            vipCard.style.transform = 'scale(1)';
        }, 1000);
    }, 5000);
    
    // Add tooltips
    const inputs = document.querySelectorAll('input');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.style.transform = 'translateY(-2px)';
        });
        
        input.addEventListener('blur', function() {
            this.parentElement.style.transform = 'translateY(0)';
        });
    });
});

// Add CSS classes for different categories
const style = document.createElement('style');
style.textContent = `
    .success { color: #10b981 !important; }
    .warning { color: #f59e0b !important; }
    .danger { color: #ef4444 !important; }
`;
document.head.appendChild(style);