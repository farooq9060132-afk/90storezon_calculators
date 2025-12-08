let generatedPasswords = [];

// Character sets
const charSets = {
    uppercase: 'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
    lowercase: 'abcdefghijklmnopqrstuvwxyz',
    numbers: '0123456789',
    symbols: '!@#$%^&*()_+-=[]{}|;:,.<>?'
};

function generatePasswords() {
    const length = parseInt(document.getElementById('passwordLength').value);
    const count = parseInt(document.getElementById('passwordCount').value);
    const excludeChars = document.getElementById('excludeChars').value;
    
    // Get selected character types
    const selectedTypes = [];
    if (document.getElementById('uppercase').checked) selectedTypes.push('uppercase');
    if (document.getElementById('lowercase').checked) selectedTypes.push('lowercase');
    if (document.getElementById('numbers').checked) selectedTypes.push('numbers');
    if (document.getElementById('symbols').checked) selectedTypes.push('symbols');
    
    if (selectedTypes.length === 0) {
        alert('Please select at least one character type');
        return;
    }
    
    // Build character pool
    let charPool = '';
    selectedTypes.forEach(type => {
        charPool += charSets[type];
    });
    
    // Remove excluded characters
    if (excludeChars) {
        const excludeRegex = new RegExp(`[${excludeChars.replace(/[.*+?^${}()|[\]\\]/g, '\\$&')}]`, 'g');
        charPool = charPool.replace(excludeRegex, '');
    }
    
    if (charPool.length === 0) {
        alert('No characters available after exclusions. Please adjust your settings.');
        return;
    }
    
    // Generate passwords
    generatedPasswords = [];
    for (let i = 0; i < count; i++) {
        let password = '';
        for (let j = 0; j < length; j++) {
            const randomIndex = Math.floor(Math.random() * charPool.length);
            password += charPool[randomIndex];
        }
        generatedPasswords.push(password);
    }
    
    displayPasswords();
    updatePasswordStats(length, selectedTypes.length, charPool.length);
    
    // Show result container
    const resultContainer = document.getElementById('resultContainer');
    resultContainer.style.display = 'block';
    resultContainer.style.animation = 'fadeIn 0.5s ease-in';
}

function displayPasswords() {
    const passwordsList = document.getElementById('passwordsList');
    passwordsList.innerHTML = '';
    
    generatedPasswords.forEach((password, index) => {
        const strength = calculatePasswordStrength(password);
        const passwordItem = document.createElement('div');
        passwordItem.className = 'password-item';
        passwordItem.innerHTML = `
            <span class="password-number">${index + 1}.</span>
            <input type="text" class="password-text" value="${password}" readonly>
            <button class="copy-btn" onclick="copyPassword(${index})">
                <i class="fas fa-copy"></i> Copy
            </button>
        `;
        passwordsList.appendChild(passwordItem);
    });
    
    updateStrengthMeter();
}

function calculatePasswordStrength(password) {
    let score = 0;
    
    // Length score
    if (password.length >= 8) score += 1;
    if (password.length >= 12) score += 1;
    if (password.length >= 16) score += 1;
    if (password.length >= 20) score += 1;
    
    // Character variety score
    const hasLowercase = /[a-z]/.test(password);
    const hasUppercase = /[A-Z]/.test(password);
    const hasNumbers = /[0-9]/.test(password);
    const hasSymbols = /[^a-zA-Z0-9]/.test(password);
    
    if (hasLowercase) score += 1;
    if (hasUppercase) score += 1;
    if (hasNumbers) score += 1;
    if (hasSymbols) score += 2;
    
    // Entropy calculation
    const charPoolSize = calculateCharPoolSize(password);
    const entropy = password.length * Math.log2(charPoolSize);
    
    if (entropy < 28) return 'weak';
    if (entropy < 36) return 'medium';
    if (entropy < 60) return 'strong';
    return 'very-strong';
}

function calculateCharPoolSize(password) {
    let size = 0;
    if (/[a-z]/.test(password)) size += 26;
    if (/[A-Z]/.test(password)) size += 26;
    if (/[0-9]/.test(password)) size += 10;
    if (/[^a-zA-Z0-9]/.test(password)) size += 32; // Common symbols
    return size;
}

function updateStrengthMeter() {
    if (generatedPasswords.length === 0) return;
    
    const firstPassword = generatedPasswords[0];
    const strength = calculatePasswordStrength(firstPassword);
    
    const strengthText = document.getElementById('strengthText');
    const strengthFill = document.getElementById('strengthFill');
    
    strengthText.textContent = strength.charAt(0).toUpperCase() + strength.slice(1).replace('-', ' ');
    strengthFill.className = 'strength-fill strength-' + strength;
}

function updatePasswordStats(length, typeCount, poolSize) {
    const combinations = Math.pow(poolSize, length);
    const entropy = length * Math.log2(poolSize);
    
    // Calculate crack time (simplified)
    let crackTime = 'Instantly';
    if (combinations > 1e12) crackTime = 'Years';
    else if (combinations > 1e9) crackTime = 'Months';
    else if (combinations > 1e6) crackTime = 'Days';
    else if (combinations > 1e3) crackTime = 'Hours';
    
    document.getElementById('combinationsCount').textContent = combinations.toExponential(2);
    document.getElementById('crackTime').textContent = crackTime;
    document.getElementById('entropyBits').textContent = Math.round(entropy);
}

function copyPassword(index) {
    const password = generatedPasswords[index];
    navigator.clipboard.writeText(password).then(() => {
        showNotification('Password copied to clipboard!');
    });
}

function copyAllPasswords() {
    const allPasswords = generatedPasswords.join('\n');
    navigator.clipboard.writeText(allPasswords).then(() => {
        showNotification('All passwords copied to clipboard!');
    });
}

function downloadPasswords() {
    const content = generatedPasswords.map((pwd, i) => `${i + 1}. ${pwd}`).join('\n');
    const blob = new Blob([content], { type: 'text/plain' });
    const url = URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = `passwords-${Date.now()}.txt`;
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    URL.revokeObjectURL(url);
    showNotification('Passwords downloaded!');
}

function regeneratePasswords() {
    generatePasswords();
}

function showNotification(message) {
    // Create notification element
    const notification = document.createElement('div');
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        background: #27ae60;
        color: white;
        padding: 15px 20px;
        border-radius: 5px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        z-index: 1000;
        font-weight: 600;
    `;
    notification.textContent = message;
    document.body.appendChild(notification);
    
    // Remove after 3 seconds
    setTimeout(() => {
        document.body.removeChild(notification);
    }, 3000);
}

// Update length value display
document.getElementById('passwordLength').addEventListener('input', function() {
    document.getElementById('lengthValue').textContent = this.value + ' characters';
});

// Auto-generate when settings change
document.addEventListener('DOMContentLoaded', function() {
    const inputs = document.querySelectorAll('input, select');
    inputs.forEach(input => {
        input.addEventListener('change', function() {
            if (generatedPasswords.length > 0) {
                setTimeout(generatePasswords, 100);
            }
        });
    });
    
    // Initial generation
    generatePasswords();
});

// Add fadeIn animation
const style = document.createElement('style');
style.textContent = `
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .password-number {
        font-weight: 600;
        min-width: 30px;
    }
`;
document.head.appendChild(style);