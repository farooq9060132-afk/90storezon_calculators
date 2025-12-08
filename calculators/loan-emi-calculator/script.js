// Common utility functions for all loan calculators
class LoanCalculator {
    constructor() {
        this.currentCountry = 'pakistan';
        this.currencySymbols = {
            'pakistan': 'Rs',
            'india': '₹',
            'usa': '$',
            'uk': '£',
            'uae': 'AED',
            'canada': 'C$',
            'australia': 'A$'
        };
        this.init();
    }

    init() {
        this.setupEventListeners();
        this.updateDisplay();
    }

    setupEventListeners() {
        // Input validation
        document.addEventListener('input', this.debounce(this.validateInputs.bind(this), 300));
        
        // Enter key support
        document.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                this.calculateLoan();
            }
        });
    }

    // Debounce function for performance
    debounce(func, wait) {
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

    // Validate input fields
    validateInputs() {
        const inputs = document.querySelectorAll('input[type="number"]');
        inputs.forEach(input => {
            const min = parseFloat(input.min) || 0;
            const max = parseFloat(input.max) || Infinity;
            let value = parseFloat(input.value) || 0;

            if (value < min) {
                input.value = min;
                this.showToast(`Value cannot be less than ${min}`, 'warning');
            } else if (value > max) {
                input.value = max;
                this.showToast(`Value cannot be greater than ${max}`, 'warning');
            }
        });
    }

    // Format currency based on country
    formatCurrency(amount, country = null) {
        const countryCode = country || this.currentCountry;
        const currency = this.currencySymbols[countryCode] || '$';
        const locale = this.getLocale(countryCode);
        
        try {
            return `${currency} ${amount.toLocaleString(locale, {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            })}`;
        } catch (error) {
            return `${currency} ${amount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')}`;
        }
    }

    // Get locale based on country
    getLocale(country) {
        const locales = {
            'pakistan': 'en-PK',
            'india': 'en-IN',
            'usa': 'en-US',
            'uk': 'en-GB',
            'uae': 'en-AE',
            'canada': 'en-CA',
            'australia': 'en-AU'
        };
        return locales[country] || 'en-US';
    }

    // Calculate EMI
    calculateEMI(principal, annualRate, tenureYears) {
        const monthlyRate = annualRate / 12 / 100;
        const tenureMonths = tenureYears * 12;
        
        if (monthlyRate === 0) {
            return principal / tenureMonths;
        }

        const emi = principal * monthlyRate * Math.pow(1 + monthlyRate, tenureMonths) / 
                   (Math.pow(1 + monthlyRate, tenureMonths) - 1);
        
        return Math.round(emi * 100) / 100;
    }

    // Calculate total payment and interest
    calculateTotalPayment(emi, tenureYears) {
        const totalPayment = emi * tenureYears * 12;
        return Math.round(totalPayment * 100) / 100;
    }

    calculateTotalInterest(totalPayment, principal) {
        return Math.round((totalPayment - principal) * 100) / 100;
    }

    // Generate amortization schedule
    generateAmortizationSchedule(principal, annualRate, tenureYears, emi) {
        const monthlyRate = annualRate / 12 / 100;
        const schedule = [];
        let balance = principal;

        for (let month = 1; month <= tenureYears * 12; month++) {
            const interest = balance * monthlyRate;
            const principalPaid = emi - interest;
            balance -= principalPaid;

            schedule.push({
                month: month,
                principal: Math.max(0, principalPaid),
                interest: Math.max(0, interest),
                balance: Math.max(0, balance)
            });

            if (balance <= 0) break;
        }

        return schedule;
    }

    // Update results display
    updateResultsDisplay(results) {
        const {
            monthlyEMI,
            totalPayment,
            totalInterest,
            principal,
            currency,
            amortizationSchedule
        } = results;

        // Update main results
        if (document.getElementById('monthlyEMI')) {
            document.getElementById('monthlyEMI').textContent = 
                this.formatCurrency(monthlyEMI, this.currentCountry);
        }
        
        if (document.getElementById('totalPayment')) {
            document.getElementById('totalPayment').textContent = 
                this.formatCurrency(totalPayment, this.currentCountry);
        }
        
        if (document.getElementById('totalInterest')) {
            document.getElementById('totalInterest').textContent = 
                this.formatCurrency(totalInterest, this.currentCountry);
        }
        
        if (document.getElementById('principalAmount')) {
            document.getElementById('principalAmount').textContent = 
                this.formatCurrency(principal, this.currentCountry);
        }
        
        if (document.getElementById('interestAmount')) {
            document.getElementById('interestAmount').textContent = 
                this.formatCurrency(totalInterest, this.currentCountry);
        }

        // Update chart visualization
        this.updateChartVisualization(principal, totalPayment, totalInterest);

        // Show amortization preview
        if (amortizationSchedule && document.getElementById('amortizationPreview')) {
            this.showAmortizationPreview(amortizationSchedule);
        }

        // Show results container
        const resultsContainer = document.getElementById('results');
        if (resultsContainer) {
            resultsContainer.style.display = 'block';
            resultsContainer.classList.add('fade-in');
        }
    }

    // Update chart visualization
    updateChartVisualization(principal, totalPayment, totalInterest) {
        const principalPercent = (principal / totalPayment * 100).toFixed(1);
        const interestPercent = (totalInterest / totalPayment * 100).toFixed(1);

        const principalFill = document.getElementById('principalFill');
        const interestFill = document.getElementById('interestFill');

        if (principalFill) {
            principalFill.style.width = principalPercent + '%';
        }
        if (interestFill) {
            interestFill.style.width = interestPercent + '%';
        }
    }

    // Show amortization preview
    showAmortizationPreview(schedule) {
        const previewContainer = document.getElementById('amortizationPreview');
        if (!previewContainer) return;

        let previewHTML = '';
        const previewMonths = Math.min(12, schedule.length);

        for (let i = 0; i < previewMonths; i++) {
            const payment = schedule[i];
            previewHTML += `
                <div class="schedule-row">
                    <span>${payment.month}</span>
                    <span>${this.formatCurrency(payment.principal, this.currentCountry)}</span>
                    <span>${this.formatCurrency(payment.interest, this.currentCountry)}</span>
                    <span>${this.formatCurrency(payment.balance, this.currentCountry)}</span>
                </div>
            `;
        }

        previewContainer.innerHTML = previewHTML;
    }

    // Calculate debt-to-income ratio
    calculateDTIRatio(monthlyEMI, monthlyIncome) {
        if (!monthlyIncome || monthlyIncome <= 0) return null;
        return (monthlyEMI / monthlyIncome * 100);
    }

    // Calculate loan-to-value ratio
    calculateLTV(loanAmount, propertyValue) {
        if (!propertyValue || propertyValue <= 0) return null;
        return (loanAmount / propertyValue * 100);
    }

    // Validate loan eligibility
    validateLoanEligibility(loanAmount, annualIncome, monthlyEMI, country) {
        const rules = {
            'pakistan': { maxDTI: 50, minIncome: 30000 },
            'india': { maxDTI: 50, minIncome: 250000 },
            'usa': { maxDTI: 43, minIncome: 30000 },
            'uk': { maxDTI: 45, minIncome: 25000 },
            'uae': { maxDTI: 50, minIncome: 120000 },
            'canada': { maxDTI: 44, minIncome: 35000 },
            'australia': { maxDTI: 45, minIncome: 40000 }
        };

        const rule = rules[country] || rules['usa'];
        const annualEMI = monthlyEMI * 12;
        const dti = (annualEMI / annualIncome * 100);

        return {
            eligible: dti <= rule.maxDTI && annualIncome >= rule.minIncome,
            dtiRatio: dti,
            maxAllowedDTI: rule.maxDTI,
            minRequiredIncome: rule.minIncome
        };
    }

    // Show toast notifications
    showToast(message, type = 'info') {
        // Remove existing toasts
        const existingToasts = document.querySelectorAll('.toast');
        existingToasts.forEach(toast => toast.remove());

        const toast = document.createElement('div');
        toast.className = `toast toast-${type}`;
        toast.innerHTML = `
            <div class="toast-content">
                <span class="toast-message">${message}</span>
                <button class="toast-close">&times;</button>
            </div>
        `;

        // Add styles if not already added
        if (!document.querySelector('#toast-styles')) {
            const styles = document.createElement('style');
            styles.id = 'toast-styles';
            styles.textContent = `
                .toast {
                    position: fixed;
                    top: 20px;
                    right: 20px;
                    background: white;
                    padding: 15px 20px;
                    border-radius: 8px;
                    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
                    border-left: 4px solid #667eea;
                    z-index: 1000;
                    animation: slideInRight 0.3s ease;
                    max-width: 300px;
                }
                .toast-warning { border-left-color: #ffc107; }
                .toast-error { border-left-color: #dc3545; }
                .toast-success { border-left-color: #28a745; }
                .toast-content {
                    display: flex;
                    align-items: center;
                    justify-content: between;
                }
                .toast-message {
                    flex: 1;
                    font-weight: 500;
                }
                .toast-close {
                    background: none;
                    border: none;
                    font-size: 18px;
                    cursor: pointer;
                    margin-left: 10px;
                    color: #666;
                }
                @keyframes slideInRight {
                    from { transform: translateX(100%); opacity: 0; }
                    to { transform: translateX(0); opacity: 1; }
                }
            `;
            document.head.appendChild(styles);
        }

        document.body.appendChild(toast);

        // Auto remove after 5 seconds
        setTimeout(() => {
            toast.remove();
        }, 5000);

        // Close button event
        toast.querySelector('.toast-close').addEventListener('click', () => {
            toast.remove();
        });
    }

    // Export results as PDF
    exportToPDF() {
        this.showToast('PDF export feature will be implemented soon', 'info');
    }

    // Share results
    shareResults() {
        if (navigator.share) {
            navigator.share({
                title: 'Loan Calculation Results',
                text: 'Check out my loan calculation results!',
                url: window.location.href
            }).catch(error => {
                console.log('Error sharing:', error);
            });
        } else {
            this.showToast('Web Share API not supported in your browser', 'warning');
        }
    }

    // Reset calculator
    resetCalculator() {
        const inputs = document.querySelectorAll('input[type="number"], input[type="text"]');
        inputs.forEach(input => {
            input.value = '';
        });

        const checkboxes = document.querySelectorAll('input[type="checkbox"]');
        checkboxes.forEach(checkbox => {
            checkbox.checked = false;
        });

        const resultsContainer = document.getElementById('results');
        if (resultsContainer) {
            resultsContainer.style.display = 'none';
        }

        this.showToast('Calculator has been reset', 'success');
    }

    // Update display based on country
    updateDisplay() {
        // This method can be overridden by country-specific implementations
        console.log('Display updated for:', this.currentCountry);
    }

    // Main calculation function (to be called from HTML)
    calculateLoan() {
        try {
            // Get input values
            const loanAmount = parseFloat(document.getElementById('loanAmount')?.value);
            const interestRate = parseFloat(document.getElementById('interestRate')?.value);
            const loanTenure = parseFloat(document.getElementById('loanTenure')?.value);

            // Validate inputs
            if (!loanAmount || !interestRate || !loanTenure) {
                this.showToast('Please fill in all required fields', 'error');
                return;
            }

            if (loanAmount <= 0 || interestRate <= 0 || loanTenure <= 0) {
                this.showToast('Please enter positive values for all fields', 'error');
                return;
            }

            // Calculate EMI
            const monthlyEMI = this.calculateEMI(loanAmount, interestRate, loanTenure);
            const totalPayment = this.calculateTotalPayment(monthlyEMI, loanTenure);
            const totalInterest = this.calculateTotalInterest(totalPayment, loanAmount);

            // Generate amortization schedule
            const amortizationSchedule = this.generateAmortizationSchedule(
                loanAmount, interestRate, loanTenure, monthlyEMI
            );

            // Update results
            this.updateResultsDisplay({
                monthlyEMI,
                totalPayment,
                totalInterest,
                principal: loanAmount,
                currency: this.currencySymbols[this.currentCountry],
                amortizationSchedule
            });

            this.showToast('Calculation completed successfully!', 'success');

        } catch (error) {
            console.error('Calculation error:', error);
            this.showToast('An error occurred during calculation. Please check your inputs.', 'error');
        }
    }
}

// Country-specific functionality
class CountrySpecificCalculator extends LoanCalculator {
    constructor(country) {
        super();
        this.currentCountry = country;
    }

    // Override specific methods for country-specific calculations
    calculateEMI(principal, annualRate, tenureYears) {
        // Add country-specific adjustments if needed
        return super.calculateEMI(principal, annualRate, tenureYears);
    }

    // Country-specific validation rules
    validateInputs() {
        super.validateInputs();
        
        // Add country-specific validation
        switch (this.currentCountry) {
            case 'pakistan':
                this.validatePakistanInputs();
                break;
            case 'india':
                this.validateIndiaInputs();
                break;
            case 'usa':
                this.validateUSAInputs();
                break;
            // Add more countries as needed
        }
    }

    validatePakistanInputs() {
        // Pakistan-specific validation rules
        const loanAmount = parseFloat(document.getElementById('loanAmount')?.value);
        if (loanAmount > 50000000) {
            this.showToast('Loan amount exceeds maximum limit for Pakistan', 'warning');
        }
    }

    validateIndiaInputs() {
        // India-specific validation rules
        const loanAmount = parseFloat(document.getElementById('loanAmount')?.value);
        if (loanAmount > 50000000) {
            this.showToast('Loan amount exceeds maximum limit for India', 'warning');
        }
    }

    validateUSAInputs() {
        // USA-specific validation rules
        const creditScore = parseInt(document.getElementById('creditScore')?.value);
        if (creditScore && creditScore < 300) {
            this.showToast('Credit score is too low for most lenders', 'warning');
        }
    }
}

// Initialize calculator when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    // Detect current country from URL or page
    const currentCountry = detectCurrentCountry();
    window.loanCalculator = new CountrySpecificCalculator(currentCountry);

    // Add global event listeners
    addGlobalEventListeners();
});

// Detect current country
function detectCurrentCountry() {
    const url = window.location.href;
    const countryMap = {
        'pakistan.php': 'pakistan',
        'india.php': 'india',
        'usa.php': 'usa',
        'uk.php': 'uk',
        'uae.php': 'uae',
        'canada.php': 'canada',
        'australia.php': 'australia'
    };

    for (const [page, country] of Object.entries(countryMap)) {
        if (url.includes(page)) {
            return country;
        }
    }

    return 'pakistan'; // Default country
}

// Global event listeners
function addGlobalEventListeners() {
    // Print functionality
    document.addEventListener('keydown', function(e) {
        if ((e.ctrlKey || e.metaKey) && e.key === 'p') {
            e.preventDefault();
            window.print();
        }
    });

    // Responsive adjustments
    window.addEventListener('resize', debounce(function() {
        // Adjust layout for mobile
        if (window.innerWidth < 768) {
            document.body.classList.add('mobile-view');
        } else {
            document.body.classList.remove('mobile-view');
        }
    }, 250));

    // Service worker registration for PWA (optional)
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('/sw.js')
            .then(registration => console.log('SW registered'))
            .catch(error => console.log('SW registration failed'));
    }
}

// Utility function for debouncing
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

// Export functions for global use
window.changeCountry = function() {
    const countrySelect = document.getElementById('countrySelect');
    if (countrySelect) {
        const country = countrySelect.value;
        window.location.href = `${country}.php`;
    }
};

window.calculateLoan = function() {
    if (window.loanCalculator) {
        window.loanCalculator.calculateLoan();
    }
};

window.resetCalculator = function() {
    if (window.loanCalculator) {
        window.loanCalculator.resetCalculator();
    }
};

window.exportToPDF = function() {
    if (window.loanCalculator) {
        window.loanCalculator.exportToPDF();
    }
};

window.shareResults = function() {
    if (window.loanCalculator) {
        window.loanCalculator.shareResults();
    }
};

// Common helper functions
function formatNumber(number) {
    return new Intl.NumberFormat().format(number);
}

function parseFormattedNumber(formattedNumber) {
    return parseFloat(formattedNumber.replace(/[^\d.-]/g, ''));
}

function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}

function validatePhone(phone) {
    const re = /^[\+]?[1-9][\d]{0,15}$/;
    return re.test(phone.replace(/[\s\-\(\)]/g, ''));
}

// Performance monitoring
if (typeof PerformanceObserver !== 'undefined') {
    const observer = new PerformanceObserver((list) => {
        for (const entry of list.getEntries()) {
            if (entry.entryType === 'measure') {
                console.log(`${entry.name}: ${entry.duration}ms`);
            }
        }
    });
    observer.observe({ entryTypes: ['measure'] });
}