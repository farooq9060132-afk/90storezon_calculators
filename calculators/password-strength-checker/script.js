class PasswordStrengthChecker {
    constructor() {
        this.checkHistory = JSON.parse(localStorage.getItem('passwordCheckHistory')) || [];
        this.stats = JSON.parse(localStorage.getItem('passwordStats')) || {
            totalChecks: 0,
            strongPasswords: 0,
            weakPasswords: 0
        };
        
        this.init();
    }

    init() {
        this.initializeEventListeners();
        this.updateStatsDisplay();
        this.renderHistory();
        this.setupRealTimeChecking();
    }

    initializeEventListeners() {
        // Password checking
        document.getElementById('checkPassword').addEventListener('click', () => this.checkPasswordStrength());
        document.getElementById('toggleVisibility').addEventListener('click', () => this.togglePasswordVisibility());
        
        // Password input events
        const passwordInput = document.getElementById('passwordInput');
        passwordInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                this.checkPasswordStrength();
            }
        });

        // History management
        document.getElementById('clearHistory').addEventListener('click', () => this.clearHistory());

        // Modal controls
        document.querySelectorAll('.close-modal').forEach(btn => {
            btn.addEventListener('click', () => this.hideModals());
        });

        // Password generator
        document.getElementById('passwordLength').addEventListener('input', (e) => {
            document.getElementById('lengthValueDisplay').textContent = e.target.value;
        });

        document.getElementById('regeneratePassword').addEventListener('click', () => this.generatePassword());
        document.getElementById('copyPassword').addEventListener('click', () => this.copyGeneratedPassword());
        document.getElementById('usePassword').addEventListener('click', () => this.useGeneratedPassword());

        // Initial password generation
        this.generatePassword();
    }

    setupRealTimeChecking() {
        const passwordInput = document.getElementById('passwordInput');
        let checkTimeout;

        passwordInput.addEventListener('input', (e) => {
            clearTimeout(checkTimeout);
            const password = e.target.value;

            if (password.length === 0) {
                this.resetDisplay();
                return;
            }

            // Debounce real-time checking
            checkTimeout = setTimeout(() => {
                this.performRealTimeCheck(password);
            }, 300);
        });
    }

    performRealTimeCheck(password) {
        const requirements = this.checkRequirements(password);
        this.updateRequirementsDisplay(requirements);
        
        // Only show partial strength for real-time
        if (password.length > 0) {
            const partialScore = this.calculatePartialScore(password, requirements);
            this.updateStrengthDisplay(partialScore, password, true);
        }
    }

    calculatePartialScore(password, requirements) {
        let score = 0;
        const metRequirements = Object.values(requirements).filter(Boolean).length;
        const totalRequirements = Object.keys(requirements).length;

        // Base score from requirements met
        score += (metRequirements / totalRequirements) * 6;

        // Length bonus
        if (password.length >= 12) score += 2;
        else if (password.length >= 8) score += 1;

        // Character variety bonus
        const charTypes = this.countCharacterTypes(password);
        if (charTypes >= 3) score += 1;
        if (charTypes >= 4) score += 1;

        return Math.min(10, score);
    }

    countCharacterTypes(password) {
        let types = 0;
        if (/[a-z]/.test(password)) types++;
        if (/[A-Z]/.test(password)) types++;
        if (/[0-9]/.test(password)) types++;
        if (/[^a-zA-Z0-9]/.test(password)) types++;
        return types;
    }

    async checkPasswordStrength() {
        const password = document.getElementById('passwordInput').value.trim();
        
        if (!password) {
            this.showNotification('Please enter a password to check', 'warning');
            return;
        }

        try {
            // Show loading state
            this.setLoadingState(true);

            const response = await fetch('calculator.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    action: 'check_strength',
                    password: password
                })
            });

            const data = await response.json();

            if (data.success) {
                this.displayResults(data.result, password);
                this.addToHistory(password, data.result);
                this.updateStats(data.result.score);
            } else {
                throw new Error(data.error || 'Failed to check password strength');
            }
        } catch (error) {
            console.error('Error:', error);
            this.showNotification('Error checking password strength', 'error');
        } finally {
            this.setLoadingState(false);
        }
    }

    displayResults(result, password) {
        this.updateStrengthDisplay(result.score, password);
        this.updateRequirementsDisplay({
            length: result.length >= 8,
            lowercase: result.hasLower,
            uppercase: result.hasUpper,
            numbers: result.hasNumber,
            symbols: result.hasSymbol,
            common: !result.feedback.includes('This is a very common password')
        });
        this.updateAnalysis(result);
    }

    updateStrengthDisplay(score, password, isRealTime = false) {
        const strengthText = document.getElementById('strengthText');
        const strengthScore = document.getElementById('strengthScore');
        const strengthDescription = document.getElementById('strengthDescription');
        const meterFill = document.getElementById('meterFill');

        let strengthLevel, description, meterClass;

        if (score >= 9) {
            strengthLevel = 'Very Strong';
            description = 'Excellent! This password is very secure.';
            meterClass = 'very-strong';
        } else if (score >= 7) {
            strengthLevel = 'Strong';
            description = 'Good! This password is secure.';
            meterClass = 'strong';
        } else if (score >= 5) {
            strengthLevel = 'Fair';
            description = 'Fair. Consider adding more character types.';
            meterClass = 'fair';
        } else if (score >= 3) {
            strengthLevel = 'Weak';
            description = 'Weak. This password could be easily guessed.';
            meterClass = 'weak';
        } else {
            strengthLevel = 'Very Weak';
            description = 'Very weak. You should choose a better password.';
            meterClass = 'very-weak';
        }

        strengthText.textContent = strengthLevel;
        strengthScore.textContent = isRealTime ? '...' : `${score * 10}%`;
        strengthDescription.textContent = isRealTime ? 'Checking...' : description;

        // Update meter
        meterFill.className = 'meter-fill';
        meterFill.classList.add(meterClass);

        // Update score color
        strengthScore.style.background = this.getScoreColor(score);
    }

    getScoreColor(score) {
        if (score >= 9) return 'rgba(16, 185, 129, 0.1)';
        if (score >= 7) return 'rgba(132, 204, 22, 0.1)';
        if (score >= 5) return 'rgba(245, 158, 11, 0.1)';
        if (score >= 3) return 'rgba(249, 115, 22, 0.1)';
        return 'rgba(239, 68, 68, 0.1)';
    }

    checkRequirements(password) {
        return {
            length: password.length >= 8,
            lowercase: /[a-z]/.test(password),
            uppercase: /[A-Z]/.test(password),
            numbers: /[0-9]/.test(password),
            symbols: /[^a-zA-Z0-9]/.test(password),
            common: !this.isCommonPassword(password)
        };
    }

    isCommonPassword(password) {
        const commonPasswords = [
            'password', '123456', '12345678', '1234', 'qwerty', '12345'
        ];
        return commonPasswords.includes(password.toLowerCase());
    }

    updateRequirementsDisplay(requirements) {
        Object.entries(requirements).forEach(([key, met]) => {
            const requirementElement = document.querySelector(`[data-requirement="${key}"]`);
            if (requirementElement) {
                requirementElement.classList.toggle('met', met);
                requirementElement.querySelector('i').className = met ? 'fas fa-check' : 'fas fa-times';
            }
        });
    }

    updateAnalysis(result) {
        document.getElementById('lengthValue').textContent = result.length;
        document.getElementById('crackTime').textContent = result.crackTime;
        document.getElementById('entropyValue').textContent = `${result.entropy} bits`;
        
        const complexity = result.entropy >= 80 ? 'Very High' :
                          result.entropy >= 60 ? 'High' :
                          result.entropy >= 40 ? 'Medium' : 'Low';
        document.getElementById('complexityValue').textContent = complexity;
    }

    addToHistory(password, result) {
        const historyItem = {
            id: Date.now(),
            password: this.maskPassword(password),
            originalPassword: password,
            timestamp: new Date().toISOString(),
            score: result.score,
            strength: this.getStrengthLevel(result.score)
        };

        this.checkHistory.unshift(historyItem);
        
        // Keep only last 20 items
        if (this.checkHistory.length > 20) {
            this.checkHistory = this.checkHistory.slice(0, 20);
        }

        this.saveHistory();
        this.renderHistory();
    }

    maskPassword(password) {
        if (password.length <= 4) {
            return '*'.repeat(password.length);
        }
        return password.substring(0, 2) + '*'.repeat(password.length - 4) + password.substring(password.length - 2);
    }

    getStrengthLevel(score) {
        if (score >= 9) return 'very-strong';
        if (score >= 7) return 'strong';
        if (score >= 5) return 'fair';
        if (score >= 3) return 'weak';
        return 'very-weak';
    }

    renderHistory() {
        const historyList = document.getElementById('historyList');
        
        if (this.checkHistory.length === 0) {
            historyList.innerHTML = `
                <div class="history-item">
                    <p style="color: var(--text-secondary); text-align: center; width: 100%;">
                        No password checks yet
                    </p>
                </div>
            `;
            return;
        }

        historyList.innerHTML = this.checkHistory.map(item => `
            <div class="history-item">
                <div class="history-password">${item.password}</div>
                <div class="history-strength">
                    <span class="strength-badge ${item.strength}">
                        ${item.strength.replace('-', ' ').toUpperCase()}
                    </span>
                    <small style="color: var(--text-secondary);">
                        ${new Date(item.timestamp).toLocaleTimeString()}
                    </small>
                </div>
            </div>
        `).join('');
    }

    clearHistory() {
        if (this.checkHistory.length === 0) return;
        
        if (confirm('Are you sure you want to clear all check history?')) {
            this.checkHistory = [];
            this.saveHistory();
            this.renderHistory();
            this.showNotification('History cleared', 'success');
        }
    }

    saveHistory() {
        localStorage.setItem('passwordCheckHistory', JSON.stringify(this.checkHistory));
    }

    updateStats(score) {
        this.stats.totalChecks++;
        if (score >= 7) {
            this.stats.strongPasswords++;
        } else if (score <= 3) {
            this.stats.weakPasswords++;
        }
        
        localStorage.setItem('passwordStats', JSON.stringify(this.stats));
        this.updateStatsDisplay();
    }

    updateStatsDisplay() {
        document.getElementById('totalChecks').textContent = this.stats.totalChecks;
        document.getElementById('strongPasswords').textContent = this.stats.strongPasswords;
        document.getElementById('weakPasswords').textContent = this.stats.weakPasswords;
    }

    togglePasswordVisibility() {
        const passwordInput = document.getElementById('passwordInput');
        const toggleButton = document.getElementById('toggleVisibility');
        const icon = toggleButton.querySelector('i');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.className = 'fas fa-eye-slash';
        } else {
            passwordInput.type = 'password';
            icon.className = 'fas fa-eye';
        }
    }

    async generatePassword() {
        const length = parseInt(document.getElementById('passwordLength').value);
        const options = {
            uppercase: document.getElementById('includeUppercase').checked,
            lowercase: document.getElementById('includeLowercase').checked,
            numbers: document.getElementById('includeNumbers').checked,
            symbols: document.getElementById('includeSymbols').checked
        };

        try {
            const response = await fetch('calculator.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    action: 'generate_password',
                    length: length,
                    options: options
                })
            });

            const data = await response.json();

            if (data.success) {
                document.getElementById('generatedPassword').value = data.password;
            } else {
                throw new Error('Failed to generate password');
            }
        } catch (error) {
            console.error('Error:', error);
            // Fallback to client-side generation
            this.generatePasswordClientSide(length, options);
        }
    }

    generatePasswordClientSide(length, options) {
        let chars = '';
        if (options.lowercase) chars += 'abcdefghijklmnopqrstuvwxyz';
        if (options.uppercase) chars += 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        if (options.numbers) chars += '0123456789';
        if (options.symbols) chars += '!@#$%^&*()_+-=[]{}|;:,.<>?';

        if (chars === '') chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

        let password = '';
        for (let i = 0; i < length; i++) {
            password += chars.charAt(Math.floor(Math.random() * chars.length));
        }

        document.getElementById('generatedPassword').value = password;
    }

    copyGeneratedPassword() {
        const passwordField = document.getElementById('generatedPassword');
        passwordField.select();
        document.execCommand('copy');
        
        this.showNotification('Password copied to clipboard!', 'success');
    }

    useGeneratedPassword() {
        const generatedPassword = document.getElementById('generatedPassword').value;
        document.getElementById('passwordInput').value = generatedPassword;
        this.hideModals();
        this.checkPasswordStrength();
    }

    hideModals() {
        document.querySelectorAll('.modal').forEach(modal => {
            modal.classList.remove('active');
        });
    }

    resetDisplay() {
        document.getElementById('strengthText').textContent = 'Password Strength';
        document.getElementById('strengthScore').textContent = '0%';
        document.getElementById('strengthDescription').textContent = 'Enter a password to check its strength';
        document.getElementById('meterFill').className = 'meter-fill';
        document.getElementById('meterFill').style.width = '0%';

        // Reset requirements
        document.querySelectorAll('.requirement').forEach(req => {
            req.classList.remove('met');
            req.querySelector('i').className = 'fas fa-times';
        });

        // Reset analysis
        document.getElementById('lengthValue').textContent = '0';
        document.getElementById('crackTime').textContent = 'Instant';
        document.getElementById('entropyValue').textContent = '0 bits';
        document.getElementById('complexityValue').textContent = 'Low';
    }

    setLoadingState(loading) {
        const checkBtn = document.getElementById('checkPassword');
        if (loading) {
            checkBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Checking...';
            checkBtn.disabled = true;
        } else {
            checkBtn.innerHTML = '<i class="fas fa-search"></i> Check Strength';
            checkBtn.disabled = false;
        }
    }

    showNotification(message, type = 'info') {
        // Remove existing notifications
        const existingNotification = document.querySelector('.notification');
        if (existingNotification) {
            existingNotification.remove();
        }

        const notification = document.createElement('div');
        notification.className = `notification ${type}`;
        notification.innerHTML = `
            <div class="notification-content">
                <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : type === 'warning' ? 'exclamation-triangle' : 'info-circle'}"></i>
                <span>${message}</span>
            </div>
        `;

        // Add styles
        notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            background: ${type === 'success' ? '#10b981' : type === 'error' ? '#ef4444' : type === 'warning' ? '#f59e0b' : '#3b82f6'};
            color: white;
            padding: 16px 20px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            z-index: 1000;
            transform: translateX(100%);
            transition: transform 0.3s ease;
            max-width: 300px;
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
}

// Initialize the application
const passwordChecker = new PasswordStrengthChecker();

// Make available globally for any potential extensions
window.passwordChecker = passwordChecker;