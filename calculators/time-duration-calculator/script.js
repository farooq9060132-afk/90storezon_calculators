// ===== VIP TIME DURATION CALCULATOR =====
class TimeDurationCalculator {
    constructor() {
        this.init();
    }

    init() {
        this.setupEventListeners();
        this.setDefaultDates();
        this.setupPresetButtons();
    }

    setupEventListeners() {
        // Form submission
        document.getElementById('timeDurationCalculator').addEventListener('submit', (e) => {
            e.preventDefault();
            this.calculateDuration();
        });

        // Advanced options toggle
        document.querySelector('.toggle-advanced').addEventListener('click', (e) => {
            this.toggleAdvancedOptions(e.target);
        });

        // Clear form
        document.querySelector('.clear-btn').addEventListener('click', () => {
            this.clearForm();
        });

        // Copy results
        document.getElementById('copyResults').addEventListener('click', () => {
            this.copyResults();
        });

        // Export results
        document.getElementById('exportResults').addEventListener('click', () => {
            this.exportResults();
        });

        // Real-time validation
        document.getElementById('startDate').addEventListener('change', () => this.validateDates());
        document.getElementById('endDate').addEventListener('change', () => this.validateDates());
    }

    setDefaultDates() {
        const now = new Date();
        const tomorrow = new Date(now);
        tomorrow.setDate(tomorrow.getDate() + 1);

        // Format for datetime-local input
        const formatDate = (date) => {
            return date.toISOString().slice(0, 16);
        };

        document.getElementById('startDate').value = formatDate(now);
        document.getElementById('endDate').value = formatDate(tomorrow);
    }

    setupPresetButtons() {
        document.querySelectorAll('.preset-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const preset = e.target.dataset.preset;
                this.applyPreset(preset, e.target.closest('.input-with-presets'));
            });
        });
    }

    applyPreset(preset, container) {
        const now = new Date();
        let targetDate = new Date();

        switch(preset) {
            case 'now':
                targetDate = new Date();
                break;
            case 'today-start':
                targetDate.setHours(0, 0, 0, 0);
                break;
            case 'today-end':
                targetDate.setHours(23, 59, 59, 999);
                break;
            case 'week-start':
                const day = targetDate.getDay();
                const diff = targetDate.getDate() - day + (day === 0 ? -6 : 1);
                targetDate.setDate(diff);
                targetDate.setHours(0, 0, 0, 0);
                break;
            case 'week-end':
                const endDay = targetDate.getDay();
                const endDiff = targetDate.getDate() - endDay + (endDay === 0 ? 0 : 7);
                targetDate.setDate(endDiff);
                targetDate.setHours(23, 59, 59, 999);
                break;
        }

        const input = container.querySelector('input[type="datetime-local"]');
        input.value = targetDate.toISOString().slice(0, 16);
    }

    toggleAdvancedOptions(button) {
        const options = document.querySelector('.advanced-options');
        const isVisible = options.style.display !== 'none';
        
        options.style.display = isVisible ? 'none' : 'block';
        button.textContent = isVisible ? 'Show Advanced' : 'Hide Advanced';
        
        // Add animation
        if (!isVisible) {
            options.style.opacity = '0';
            options.style.transform = 'translateY(-10px)';
            
            setTimeout(() => {
                options.style.transition = 'all 0.3s ease';
                options.style.opacity = '1';
                options.style.transform = 'translateY(0)';
            }, 10);
        }
    }

    validateDates() {
        const startDate = new Date(document.getElementById('startDate').value);
        const endDate = new Date(document.getElementById('endDate').value);
        
        if (startDate >= endDate) {
            document.getElementById('endDate').style.borderColor = '#e74c3c';
            return false;
        } else {
            document.getElementById('endDate').style.borderColor = '';
            return true;
        }
    }

    async calculateDuration() {
        if (!this.validateDates()) {
            this.showError('End date must be after start date');
            return;
        }

        const form = document.getElementById('timeDurationCalculator');
        const submitBtn = form.querySelector('.calculate-btn');
        const btnText = submitBtn.querySelector('.btn-text');
        const btnLoading = submitBtn.querySelector('.btn-loading');

        // Show loading state
        btnText.style.display = 'none';
        btnLoading.style.display = 'flex';

        try {
            const formData = new FormData(form);
            const data = {
                startDate: formData.get('startDate'),
                endDate: formData.get('endDate'),
                excludeWeekends: formData.get('excludeWeekends') === 'on',
                businessHours: formData.get('businessHours') === 'on',
                includeSeconds: formData.get('includeSeconds') === 'on',
                accountLeap: formData.get('accountLeap') === 'on',
                timezone: formData.get('timezone')
            };

            const response = await fetch('calculator.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data)
            });

            const result = await response.json();

            if (result.success) {
                this.displayResults(result.data);
            } else {
                this.showError(result.error);
            }

        } catch (error) {
            console.error('Error:', error);
            this.showError('Network error. Please try again.');
        } finally {
            // Restore button state
            btnText.style.display = 'flex';
            btnLoading.style.display = 'none';
        }
    }

    displayResults(data) {
        // Update summary cards
        document.getElementById('totalDuration').textContent = data.formatted.total_duration;
        document.getElementById('businessDays').textContent = data.adjusted.business_days_formatted;
        document.getElementById('exactTime').textContent = data.formatted.exact_time;

        // Update detailed breakdown
        document.getElementById('yearsBreakdown').textContent = data.basic.years;
        document.getElementById('monthsBreakdown').textContent = data.basic.months;
        document.getElementById('weeksBreakdown').textContent = data.total.weeks;
        document.getElementById('daysBreakdown').textContent = data.total.days;
        document.getElementById('hoursBreakdown').textContent = data.total.hours;
        document.getElementById('minutesBreakdown').textContent = data.total.minutes;
        document.getElementById('secondsBreakdown').textContent = data.total.seconds;
        document.getElementById('millisecondsBreakdown').textContent = data.total.milliseconds.toLocaleString();

        // Update visualization
        this.updateVisualization(data.visualization);

        // Show results section with animation
        const resultsSection = document.getElementById('results');
        resultsSection.style.display = 'block';
        
        // Animate results appearance
        setTimeout(() => {
            resultsSection.style.opacity = '0';
            resultsSection.style.transform = 'translateY(20px)';
            resultsSection.style.transition = 'all 0.5s ease';
            
            setTimeout(() => {
                resultsSection.style.opacity = '1';
                resultsSection.style.transform = 'translateY(0)';
            }, 50);
        }, 100);

        // Scroll to results
        resultsSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    updateVisualization(visualization) {
        const yearsFill = document.querySelector('.years-fill');
        const monthsFill = document.querySelector('.months-fill');
        const daysFill = document.querySelector('.days-fill');

        yearsFill.style.width = visualization.years_percent + '%';
        monthsFill.style.width = visualization.months_percent + '%';
        daysFill.style.width = visualization.days_percent + '%';

        // Update percentage labels
        document.querySelectorAll('.bar-value').forEach((bar, index) => {
            const values = [
                Math.round(visualization.years_percent) + '%',
                Math.round(visualization.months_percent) + '%',
                Math.round(visualization.days_percent) + '%'
            ];
            bar.textContent = values[index];
        });
    }

    copyResults() {
        const results = this.getFormattedResults();
        navigator.clipboard.writeText(results).then(() => {
            this.showNotification('Results copied to clipboard!', 'success');
        }).catch(() => {
            this.showNotification('Failed to copy results', 'error');
        });
    }

    exportResults() {
        const results = this.getFormattedResults();
        const blob = new Blob([results], { type: 'text/plain' });
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = `time-duration-report-${new Date().toISOString().split('T')[0]}.txt`;
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        URL.revokeObjectURL(url);
        
        this.showNotification('Report exported successfully!', 'success');
    }

    getFormattedResults() {
        const totalDuration = document.getElementById('totalDuration').textContent;
        const businessDays = document.getElementById('businessDays').textContent;
        const exactTime = document.getElementById('exactTime').textContent;
        
        return `TIME DURATION REPORT
Generated: ${new Date().toLocaleString()}

SUMMARY:
Total Duration: ${totalDuration}
Business Days: ${businessDays}
Exact Time: ${exactTime}

DETAILED BREAKDOWN:
Years: ${document.getElementById('yearsBreakdown').textContent}
Months: ${document.getElementById('monthsBreakdown').textContent}
Weeks: ${document.getElementById('weeksBreakdown').textContent}
Days: ${document.getElementById('daysBreakdown').textContent}
Hours: ${document.getElementById('hoursBreakdown').textContent}
Minutes: ${document.getElementById('minutesBreakdown').textContent}
Seconds: ${document.getElementById('secondsBreakdown').textContent}
Milliseconds: ${document.getElementById('millisecondsBreakdown').textContent}

---
Time Duration Calculator Pro
https://timedurationcalculator.com
`;
    }

    clearForm() {
        document.getElementById('timeDurationCalculator').reset();
        this.setDefaultDates();
        document.getElementById('results').style.display = 'none';
        this.showNotification('Form cleared successfully!', 'info');
    }

    showError(message) {
        this.showNotification(message, 'error');
    }

    showNotification(message, type = 'info') {
        // Remove existing notifications
        const existingNotification = document.querySelector('.notification');
        if (existingNotification) {
            existingNotification.remove();
        }

        // Create notification
        const notification = document.createElement('div');
        notification.className = `notification notification-${type}`;
        notification.innerHTML = `
            <div class="notification-content">
                <span class="notification-icon">${this.getNotificationIcon(type)}</span>
                <span class="notification-message">${message}</span>
                <button class="notification-close">&times;</button>
            </div>
        `;

        // Add styles
        notification.style.cssText = `
            position: fixed;
            top: 100px;
            right: 20px;
            background: ${this.getNotificationColor(type)};
            color: white;
            padding: 1rem 1.5rem;
            border-radius: 8px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            z-index: 10000;
            transform: translateX(400px);
            transition: transform 0.3s ease;
            max-width: 400px;
        `;

        document.body.appendChild(notification);

        // Animate in
        setTimeout(() => {
            notification.style.transform = 'translateX(0)';
        }, 100);

        // Close button
        notification.querySelector('.notification-close').addEventListener('click', () => {
            notification.style.transform = 'translateX(400px)';
            setTimeout(() => notification.remove(), 300);
        });

        // Auto remove after 5 seconds
        setTimeout(() => {
            if (notification.parentNode) {
                notification.style.transform = 'translateX(400px)';
                setTimeout(() => notification.remove(), 300);
            }
        }, 5000);
    }

    getNotificationIcon(type) {
        const icons = {
            success: '✅',
            error: '❌',
            info: 'ℹ️',
            warning: '⚠️'
        };
        return icons[type] || 'ℹ️';
    }

    getNotificationColor(type) {
        const colors = {
            success: 'linear-gradient(135deg, #43e97b 0%, #38f9d7 100%)',
            error: 'linear-gradient(135deg, #ff6b6b 0%, #ee5a24 100%)',
            info: 'linear-gradient(135deg, #4facfe 0%, #00f2fe 100%)',
            warning: 'linear-gradient(135deg, #f093fb 0%, #f5576c 100%)'
        };
        return colors[type] || colors.info;
    }
}

// ===== INITIALIZATION =====
document.addEventListener('DOMContentLoaded', () => {
    new TimeDurationCalculator();
});

// ===== ADDITIONAL ENHANCEMENTS =====
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

// Header scroll effect
window.addEventListener('scroll', () => {
    const header = document.querySelector('.vip-header');
    if (window.scrollY > 100) {
        header.style.background = 'rgba(255, 255, 255, 0.98)';
        header.style.backdropFilter = 'blur(20px)';
    } else {
        header.style.background = 'rgba(255, 255, 255, 0.95)';
        header.style.backdropFilter = 'blur(20px)';
    }
});

// Add loading animation for images
document.addEventListener('DOMContentLoaded', () => {
    const images = document.querySelectorAll('img');
    images.forEach(img => {
        img.addEventListener('load', function() {
            this.style.opacity = '1';
        });
        img.style.opacity = '0';
        img.style.transition = 'opacity 0.3s ease';
    });
});