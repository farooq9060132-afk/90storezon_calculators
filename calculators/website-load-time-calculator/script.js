// Website Load Time Calculator JavaScript
document.addEventListener('DOMContentLoaded', function() {
    const calculatorForm = document.getElementById('loadTimeCalculator');
    const resultsSection = document.getElementById('results');
    
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
                showError('Analysis failed. Please try again.');
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
        // Update performance score
        document.getElementById('performanceScore').textContent = data.performance.score;
        document.getElementById('performanceGrade').textContent = data.performance.grade;
        document.getElementById('performanceDescription').textContent = data.performance.description;
        
        // Update key metrics
        document.getElementById('loadTimeValue').textContent = data.performance.loadTime;
        document.getElementById('uxScore').textContent = data.performance.uxScore;
        document.getElementById('seoScore').textContent = data.performance.seoScore;
        
        // Update performance score circle
        updateScoreCircle(data.performance.score);
        
        // Update metric bars
        updateMetricBars(data.performance.score);
        
        // Update core metrics
        updateCoreMetrics(data.coreMetrics);
        
        // Update recommendations
        updateRecommendations(data.recommendations);
        
        // Update comparison chart
        updateComparisonChart(data.comparison);
        
        // Show results section with animation
        resultsSection.style.display = 'block';
        setTimeout(() => {
            resultsSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
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
        } else if (score >= 70) {
            circle.style.stroke = '#f39c12';
        } else if (score >= 60) {
            circle.style.stroke = '#e67e22';
        } else {
            circle.style.stroke = '#e74c3c';
        }
    }
    
    function updateMetricBars(score) {
        const loadTimeBar = document.getElementById('loadTimeBar');
        const uxBar = document.getElementById('uxBar');
        const seoBar = document.getElementById('seoBar');
        
        // Inverse relationship for load time (faster = better)
        const loadTimePercent = Math.max(0, 100 - (score * 0.8));
        const uxPercent = score * 0.9;
        const seoPercent = score * 0.95;
        
        loadTimeBar.style.width = `${loadTimePercent}%`;
        uxBar.style.width = `${uxPercent}%`;
        seoBar.style.width = `${seoPercent}%`;
        
        // Update bar colors
        updateBarColor(loadTimeBar, loadTimePercent);
        updateBarColor(uxBar, uxPercent);
        updateBarColor(seoBar, seoPercent);
    }
    
    function updateBarColor(bar, percent) {
        if (percent >= 80) {
            bar.style.background = 'linear-gradient(45deg, #27ae60, #2ecc71)';
        } else if (percent >= 70) {
            bar.style.background = 'linear-gradient(45deg, #f39c12, #f1c40f)';
        } else if (percent >= 60) {
            bar.style.background = 'linear-gradient(45deg, #e67e22, #d35400)';
        } else {
            bar.style.background = 'linear-gradient(45deg, #e74c3c, #c0392b)';
        }
    }
    
    function updateCoreMetrics(metrics) {
        document.getElementById('fcpMetric').textContent = metrics.fcp;
        document.getElementById('lcpMetric').textContent = metrics.lcp;
        document.getElementById('ttiMetric').textContent = metrics.tti;
        document.getElementById('tbtMetric').textContent = metrics.tbt;
    }
    
    function updateRecommendations(recommendations) {
        const list = document.getElementById('recommendationsList');
        list.innerHTML = '';
        
        recommendations.forEach(rec => {
            const item = document.createElement('div');
            item.className = 'recommendation-item';
            item.textContent = rec;
            list.appendChild(item);
        });
    }
    
    function updateComparisonChart(comparison) {
        const yourSiteBar = document.getElementById('yourSiteBar');
        const yourSiteTime = document.getElementById('yourSiteTime');
        
        // Convert times to percentages for bar widths
        const yourTime = parseFloat(comparison.yourTime);
        const industryTime = parseFloat(comparison.industryAvg);
        const topTime = parseFloat(comparison.topPerformers);
        
        const maxTime = Math.max(yourTime, industryTime, topTime);
        const yourPercent = 100 - (yourTime / maxTime) * 100;
        const industryPercent = 100 - (industryTime / maxTime) * 100;
        const topPercent = 100 - (topTime / maxTime) * 100;
        
        yourSiteBar.style.width = `${yourPercent}%`;
        yourSiteTime.textContent = comparison.yourTime;
        
        // Update bar colors based on performance
        if (yourTime <= 2.0) {
            yourSiteBar.style.background = 'linear-gradient(45deg, #27ae60, #2ecc71)';
        } else if (yourTime <= 3.0) {
            yourSiteBar.style.background = 'linear-gradient(45deg, #f39c12, #f1c40f)';
        } else {
            yourSiteBar.style.background = 'linear-gradient(45deg, #e74c3c, #c0392b)';
        }
    }
    
    // Action buttons functionality
    document.getElementById('detailedReportBtn').addEventListener('click', function() {
        alert('In a real application, this would generate a detailed PDF report with comprehensive analysis and recommendations.');
    });
    
    document.getElementById('shareResultsBtn').addEventListener('click', function() {
        const performanceScore = document.getElementById('performanceScore').textContent;
        const loadTime = document.getElementById('loadTimeValue').textContent;
        
        const shareText = `My website performance score: ${performanceScore}/100 with ${loadTime} load time. Analyzed with Website Load Time Calculator`;
        
        if (navigator.share) {
            navigator.share({
                title: 'Website Performance Analysis',
                text: shareText,
                url: window.location.href
            });
        } else {
            navigator.clipboard.writeText(shareText).then(() => {
                alert('Results copied to clipboard!');
            });
        }
    });
    
    document.getElementById('recalculateBtn').addEventListener('click', function() {
        resultsSection.style.display = 'none';
        calculatorForm.reset();
        document.getElementById('calculator').scrollIntoView({ behavior: 'smooth' });
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
    
    // Tool buttons functionality
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
    document.querySelectorAll('.analysis-card, .tool-card, .resource-card').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        el.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
        observer.observe(el);
    });
    
    // Auto-calculate on significant input changes
    const autoCalculateInputs = ['pageSize', 'imageCount', 'optimizationLevel', 'connectionSpeed'];
    autoCalculateInputs.forEach(inputId => {
        const input = document.getElementById(inputId);
        if (input) {
            input.addEventListener('change', debounce(function() {
                if (document.getElementById('pageSize').value > 0) {
                    calculatorForm.dispatchEvent(new Event('submit'));
                }
            }, 1000));
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