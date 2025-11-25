class VIPCardApp {
    constructor() {
        this.init();
    }

    init() {
        this.initializeEventListeners();
        this.animateCard();
    }

    initializeEventListeners() {
        const form = document.getElementById('vipForm');
        if (form) {
            form.addEventListener('submit', (e) => this.handleFormSubmit(e));
        }

        // Add real-time input effects
        const inputs = document.querySelectorAll('input, select');
        inputs.forEach(input => {
            input.addEventListener('focus', () => this.handleInputFocus(input));
            input.addEventListener('blur', () => this.handleInputBlur(input));
        });
    }

    handleFormSubmit(e) {
        e.preventDefault();
        
        const formData = new FormData(e.target);
        const data = Object.fromEntries(formData);
        
        // Validate form
        if (this.validateForm(data)) {
            this.showLoading();
            this.submitApplication(data);
        }
    }

    validateForm(data) {
        const { fullName, email, phone, membership } = data;
        
        if (!fullName.trim()) {
            this.showError('Please enter your full name');
            return false;
        }

        if (!this.isValidEmail(email)) {
            this.showError('Please enter a valid email address');
            return false;
        }

        if (!this.isValidPhone(phone)) {
            this.showError('Please enter a valid phone number');
            return false;
        }

        if (!membership) {
            this.showError('Please select a membership type');
            return false;
        }

        return true;
    }

    isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    isValidPhone(phone) {
        const phoneRegex = /^[\+]?[1-9][\d]{0,15}$/;
        return phoneRegex.test(phone.replace(/[\s\-\(\)]/g, ''));
    }

    async submitApplication(data) {
        try {
            // Simulate API call
            await new Promise(resolve => setTimeout(resolve, 2000));
            
            this.showSuccess('Application submitted successfully! We will contact you soon.');
            document.getElementById('vipForm').reset();
        } catch (error) {
            this.showError('Failed to submit application. Please try again.');
        } finally {
            this.hideLoading();
        }
    }

    showLoading() {
        const submitBtn = document.querySelector('.submit-btn');
        submitBtn.innerHTML = 'Processing...';
        submitBtn.disabled = true;
    }

    hideLoading() {
        const submitBtn = document.querySelector('.submit-btn');
        submitBtn.innerHTML = 'Apply for VIP Card';
        submitBtn.disabled = false;
    }

    showError(message) {
        this.showNotification(message, 'error');
    }

    showSuccess(message) {
        this.showNotification(message, 'success');
    }

    showNotification(message, type) {
        // Remove existing notifications
        const existingNotification = document.querySelector('.notification');
        if (existingNotification) {
            existingNotification.remove();
        }

        const notification = document.createElement('div');
        notification.className = `notification ${type}`;
        notification.textContent = message;
        notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 15px 20px;
            border-radius: 8px;
            color: white;
            font-weight: 600;
            z-index: 1000;
            transform: translateX(100%);
            transition: transform 0.3s ease;
            background: ${type === 'error' ? '#e74c3c' : '#27ae60'};
        `;

        document.body.appendChild(notification);

        // Animate in
        setTimeout(() => {
            notification.style.transform = 'translateX(0)';
        }, 100);

        // Auto remove after 5 seconds
        setTimeout(() => {
            notification.style.transform = 'translateX(100%)';
            setTimeout(() => notification.remove(), 300);
        }, 5000);
    }

    handleInputFocus(input) {
        input.parentElement.classList.add('focused');
    }

    handleInputBlur(input) {
        if (!input.value) {
            input.parentElement.classList.remove('focused');
        }
    }

    animateCard() {
        const card = document.querySelector('.vip-card');
        if (card) {
            card.style.transform = 'rotateY(0deg)';
            card.style.transition = 'transform 0.6s ease';
            
            // Add hover effect
            card.addEventListener('mouseenter', () => {
                card.style.transform = 'rotateY(10deg) scale(1.05)';
            });
            
            card.addEventListener('mouseleave', () => {
                card.style.transform = 'rotateY(0deg) scale(1)';
            });
        }
    }
}

// Scientific Calculator Functions
class ScientificCalculator {
    constructor() {
        this.currentInput = '0';
        this.previousInput = '';
        this.operation = null;
        this.waitingForNewInput = false;
        this.initCalculator();
    }

    initCalculator() {
        this.updateDisplay();
    }

    inputDigit(digit) {
        if (this.waitingForNewInput) {
            this.currentInput = String(digit);
            this.waitingForNewInput = false;
        } else {
            this.currentInput = this.currentInput === '0' ? String(digit) : this.currentInput + digit;
        }
        this.updateDisplay();
    }

    inputDecimal() {
        if (this.waitingForNewInput) {
            this.currentInput = '0.';
            this.waitingForNewInput = false;
        } else if (this.currentInput.indexOf('.') === -1) {
            this.currentInput += '.';
        }
        this.updateDisplay();
    }

    handleOperation(nextOperation) {
        const inputValue = parseFloat(this.currentInput);

        if (this.previousInput === '') {
            this.previousInput = inputValue;
        } else if (this.operation) {
            const currentValue = this.previousInput || 0;
            const newValue = this.performCalculation(currentValue, inputValue, this.operation);

            this.currentInput = String(newValue);
            this.previousInput = newValue;
        }

        this.waitingForNewInput = true;
        this.operation = nextOperation;
        this.updateDisplay();
    }

    performCalculation(firstOperand, secondOperand, operation) {
        switch (operation) {
            case '+':
                return firstOperand + secondOperand;
            case '-':
                return firstOperand - secondOperand;
            case '*':
                return firstOperand * secondOperand;
            case '/':
                return firstOperand / secondOperand;
            case '^':
                return Math.pow(firstOperand, secondOperand);
            default:
                return secondOperand;
        }
    }

    calculateSquareRoot() {
        const inputValue = parseFloat(this.currentInput);
        if (inputValue < 0) {
            throw new Error('Cannot calculate square root of negative number');
        }
        this.currentInput = String(Math.sqrt(inputValue));
        this.updateDisplay();
    }

    calculatePower(power) {
        const inputValue = parseFloat(this.currentInput);
        this.currentInput = String(Math.pow(inputValue, power));
        this.updateDisplay();
    }

    clear() {
        this.currentInput = '0';
        this.previousInput = '';
        this.operation = null;
        this.waitingForNewInput = false;
        this.updateDisplay();
    }

    updateDisplay() {
        // This would update the calculator display in a real implementation
        console.log('Current display:', this.currentInput);
    }
}

// Initialize the application when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    new VIPCardApp();
    
    // Initialize calculator if on calculator page
    if (document.querySelector('.calculator')) {
        new ScientificCalculator();
    }
});