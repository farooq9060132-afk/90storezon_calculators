
// Website Load Time Calculator JavaScript
document.addEventListener('DOMContentLoaded', function() {
    const calculatorForm = document.getElementById('loadTimeCalculator');
    const resultsSection = document.getElementById('results');
    
    // Form submission handler
    calculatorForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Show loading state
        const submitBtn = calculatorForm.querySelector('.calculate-btn');
        const originalText = submitBtn.textContent;
        submitBtn.textContent = 'Analyzing...';
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
                showError('Analysis failed. Please try again.');
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
        // Update performance score
        document.getElementById('performanceScore').textContent = data.performanceScore;
        document.getElementById('performanceGrade').textContent = data.performanceGrade;
        document.getElementById('performanceDescription').textContent = data.performanceDescription;
        document.getElementById('userExperience').textContent = data.userExperience;
        document.getElementById('seoImpact').textContent = data.seoImpact;
        
        // Update load time
        document.getElementById('loadTime').textContent = data.loadTime;
        
        // Update performance score circle
        updateScoreCircle(data.performanceScore);
        
        // Update load time bar (inverse relationship - faster = more filled)
        const loadTime = parseFloat(data.loadTime);
        const loadTimePercent = Math.max(0, 100 - (loadTime * 20)); // Simple conversion
        document.getElementById('loadTimeBar').style.width = `${loadTimePercent}%`;
        
        // Update grade badge color
        updateGradeBadge(data.performanceGrade);
        
        // Update experience indicator
        updateExperienceIndicator(data.userExperience);
        
        // Update impact meter
        updateImpactMeter(data.seoImpact);
        
        // Update recommendations
        displayRecommendations(data.recommendations);
        
        // Update comparison chart
        updateComparisonChart(loadTime);
        
        // Show results section with animation
        resultsSection.style.display = 'block';
        setTimeout(() => {
            resultsSection.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }, 100);
    }
    
    function updateScoreCircle(score) {
        const circle = document.querySelector('.score-progress');
        const radius = 54;
        const circumference = 2 * Math.PI * radius;
        const offset = circumference - (score / 100) * circumference;
        circle.style.strokeDasharray = `${circumference} ${circumference}`;
        circle.style.strokeDashoffset = offset;
        
        // Update color based on score
        if (score >= 80) {
            circle.style.stroke = '#27ae60';
        } else if (score >= 60) {
            circle.style.stroke = '#f39c12';
        } else {
            circle.style.stroke = '#e74c3c';
        }
    }
    
    function updateGradeBadge(grade) {
        const badge = document.getElementById('gradeBadge');
        badge.textContent = getGradeText(grade);
        
        if (grade.includes('A')) {
            badge.style.background = '#27ae60';
        } else if (grade.includes('B')) {
            badge.style.background = '#f39c12';
        } else if (grade.includes('C')) {
            badge.style.background = '#e67e22';
        } else {
            badge.style.background = '#e74c3c';
        }
    }
    
    function getGradeText(grade) {
        const grades = {
            'A+': 'Excellent',
            'A': 'Very Good',
            'B': 'Good',
            'C': 'Fair',
            'D': 'Poor'
        };
        return grades[grade] || 'Average';
    }
    
    function updateExperienceIndicator(experience) {
        const indicator = document.getElementById('experienceIndicator');
        
        const colors = {
            'Excellent': '#27ae60',
            'Very Good': '#2ecc71',
            'Good': '#f39c12',
            'Fair': '#e67e22',
            'Poor': '#e74c3c'
        };
        
        indicator.style.background = colors[experience] || '#95a5a6';
    }
    
    function updateImpactMeter(impact) {
        const meter = document.getElementById('impactMeter');
        
        const widths = {
            'Very Positive': '100%',
            'Positive': '80%',
            'Moderate': '60%',
            'Neutral': '40%',
            'Negative': '20%'
        };
        
        const colors = {
            'Very Positive': '#27ae60',
            'Positive': '#2ecc71',
            'Moderate': '#f39c12',
            'Neutral': '#95a5a6',
            'Negative': '#e74c3c'
        };
        
        meter.style.width = widths[impact] || '50%';
        meter.style.background = colors[impact] || '#95a5a6';
    }
    
    function displayRecommendations(recommendations) {
        const list = document.getElementById('recommendationsList');
        list.innerHTML = '';
        
        recommendations.forEach(rec => {
            const item = document.createElement('div');
            item.className = 'recommendation-item';
            item.textContent = rec;
            list.appendChild(item);
        });
    }
    
    function updateComparisonChart(loadTime) {
        const yourSiteBar = document.getElementById('yourSiteBar');
        const yourSiteTime = document.getElementById('yourSiteTime');
        
        // Simple calculation for bar width (inverse - faster = longer bar)
        const barWidth = Math.max(10, Math.min(90, 100 - (loadTime * 20)));
        yourSiteBar.style.width = `${barWidth}%`;
        yourSiteTime.textContent = `${loadTime}s`;
        
        // Update bar color based on performance
        if (loadTime <= 2.0) {
            yourSiteBar.style.background = 'linear-gradient(45deg, #27ae60, #2ecc71)';
        } else if (loadTime <= 3.5) {
            yourSiteBar.style.background = 'linear-gradient(45deg, #f39c12, #f1c40f)';
        } else {
            yourSiteBar.style.background = 'linear-gradient(45deg, #e74c3c, #c0392b)';
        }
    }
    
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
    
    // Tool buttons
    document.querySelectorAll('.tool-btn').forEach(button => {
        button.addEventListener('click', function() {
            const toolName = this.closest('.tool-card').querySelector('h3').textContent;
            alert(`The ${toolName} would open in a real application. This is a demo.`);
        });
    });
    
    // Real-time validation
    const websiteUrlInput = document.getElementById('websiteUrl');
    websiteUrlInput.addEventListener('input', function() {
        if (this.value && !this.value.startsWith('http')) {
            this.setCustomValidity('Please enter a valid URL starting with http:// or https://');
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
    document.querySelectorAll('.feature-card, .tool-card').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        el.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
        observer.observe(el);
    });
});