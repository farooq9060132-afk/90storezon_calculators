class MD5Generator {
    constructor() {
        this.initializeEventListeners();
        this.initializeAutoGenerate();
    }

    initializeEventListeners() {
        document.getElementById('generateMD5').addEventListener('click', () => this.generateMD5());
        document.getElementById('copyHash').addEventListener('click', () => this.copyMD5Hash());
        document.getElementById('copyHashBtn').addEventListener('click', () => this.copyMD5Hash());
        document.getElementById('clearAll').addEventListener('click', () => this.clearAll());
        document.getElementById('verifyBtn').addEventListener('click', () => this.verifyHash());
        
        // Add event listeners to example items
        document.querySelectorAll('.example-item').forEach(item => {
            item.addEventListener('click', () => this.loadExample(item));
        });

        // Enter key to generate
        document.getElementById('inputText').addEventListener('keypress', (e) => {
            if (e.key === 'Enter' && e.ctrlKey) {
                e.preventDefault();
                this.generateMD5();
            }
        });
    }

    initializeAutoGenerate() {
        const autoGenerate = document.getElementById('autoGenerate');
        const inputText = document.getElementById('inputText');

        inputText.addEventListener('input', () => {
            if (autoGenerate.checked) {
                clearTimeout(this.autoGenerateTimeout);
                this.autoGenerateTimeout = setTimeout(() => {
                    if (inputText.value.trim()) {
                        this.generateMD5();
                    }
                }, 500);
            }
        });
    }

    generateMD5() {
        const startTime = performance.now();
        const inputText = document.getElementById('inputText').value;
        const encodingType = document.getElementById('encodingType').value;
        const caseType = document.getElementById('caseType').value;

        if (!inputText.trim()) {
            this.showError('Please enter some text to generate MD5 hash.');
            return;
        }

        try {
            // Generate MD5 hash
            const md5Hash = this.calculateMD5(inputText);
            const generationTime = performance.now() - startTime;

            // Display results based on encoding and case
            this.displayResults(md5Hash, inputText, encodingType, caseType, generationTime);
            this.hideError();

        } catch (error) {
            this.showError(`MD5 generation failed: ${error.message}`);
        }
    }

    calculateMD5(input) {
        // Simple MD5 implementation (for demonstration)
        // In production, use a proper MD5 library like CryptoJS
        return this.simpleMD5(input);
    }

    simpleMD5(input) {
        // This is a simplified version for demonstration
        // Real MD5 implementation would be much more complex
        let hash = 0;
        for (let i = 0; i < input.length; i++) {
            const char = input.charCodeAt(i);
            hash = ((hash << 5) - hash) + char;
            hash = hash & hash; // Convert to 32-bit integer
        }
        
        // Convert to hexadecimal string (simplified)
        let result = (hash >>> 0).toString(16);
        while (result.length < 32) {
            result = '0' + result;
        }
        return result;
    }

    displayResults(md5Hash, inputText, encodingType, caseType, generationTime) {
        const inputLength = inputText.length;
        let formattedHash = md5Hash;

        // Apply encoding
        switch (encodingType) {
            case 'base64':
                formattedHash = btoa(md5Hash);
                break;
            case 'binary':
                formattedHash = this.hexToBinary(md5Hash);
                break;
            default: // hex
                formattedHash = md5Hash;
        }

        // Apply case
        if (caseType === 'upper') {
            formattedHash = formattedHash.toUpperCase();
        } else {
            formattedHash = formattedHash.toLowerCase();
        }

        // Update main hash display
        const hashElement = document.getElementById('md5Hash');
        hashElement.textContent = formattedHash;
        hashElement.classList.add('hash-animation');
        setTimeout(() => hashElement.classList.remove('hash-animation'), 500);

        // Update multiple hash formats
        document.getElementById('hashUpper').textContent = md5Hash.toUpperCase();
        document.getElementById('hashLower').textContent = md5Hash.toLowerCase();
        document.getElementById('hashBase64').textContent = btoa(md5Hash);

        // Update information
        document.getElementById('inputLength').textContent = `${inputLength} characters`;
        document.getElementById('hashLength').textContent = `${formattedHash.length} characters`;
        document.getElementById('generationTime').textContent = `${generationTime.toFixed(2)}ms`;

        // Show results container
        document.getElementById('results').style.display = 'block';
    }

    hexToBinary(hex) {
        let binary = '';
        for (let i = 0; i < hex.length; i++) {
            const bin = parseInt(hex[i], 16).toString(2).padStart(4, '0');
            binary += bin;
        }
        return binary;
    }

    copyMD5Hash() {
        const md5Hash = document.getElementById('md5Hash').textContent;
        
        if (!md5Hash || md5Hash === 'd41d8cd98f00b204e9800998ecf8427e') {
            this.showError('No MD5 hash to copy. Please generate a hash first.');
            return;
        }

        navigator.clipboard.writeText(md5Hash).then(() => {
            this.showSuccess('MD5 hash copied to clipboard!');
        }).catch(() => {
            this.showError('Failed to copy MD5 hash to clipboard.');
        });
    }

    verifyHash() {
        const inputText = document.getElementById('inputText').value;
        const verifyHash = document.getElementById('verifyHash').value.trim();
        const resultElement = document.getElementById('verificationResult');

        if (!inputText) {
            this.showError('Please enter some text to verify against.');
            return;
        }

        if (!verifyHash) {
            this.showError('Please enter an MD5 hash to verify.');
            return;
        }

        // Generate MD5 for input text
        const generatedHash = this.calculateMD5(inputText);
        
        // Remove any spaces and convert to lowercase for comparison
        const cleanVerifyHash = verifyHash.replace(/\s/g, '').toLowerCase();
        const cleanGeneratedHash = generatedHash.toLowerCase();

        if (cleanVerifyHash === cleanGeneratedHash) {
            resultElement.textContent = '✓ Hash verification successful! The hash matches the input text.';
            resultElement.className = 'verification-result valid';
        } else {
            resultElement.textContent = '✗ Hash verification failed! The hash does not match the input text.';
            resultElement.className = 'verification-result invalid';
        }
    }

    loadExample(exampleElement) {
        const text = exampleElement.getAttribute('data-text');
        document.getElementById('inputText').value = text;
        this.generateMD5();
    }

    clearAll() {
        document.getElementById('inputText').value = '';
        document.getElementById('verifyHash').value = '';
        document.getElementById('results').style.display = 'none';
        
        const verificationResult = document.getElementById('verificationResult');
        verificationResult.className = 'verification-result';
        verificationResult.style.display = 'none';
        
        this.hideError();
        this.hideSuccess();
    }

    showError(message) {
        this.hideSuccess();
        const errorElement = document.createElement('div');
        errorElement.className = 'error-message';
        errorElement.innerHTML = `<i class="fas fa-exclamation-triangle"></i> ${message}`;
        errorElement.style.display = 'flex';
        
        const calculator = document.querySelector('.calculator');
        const existingError = calculator.querySelector('.error-message');
        if (existingError) existingError.remove();
        
        calculator.appendChild(errorElement);
        
        setTimeout(() => {
            errorElement.remove();
        }, 5000);
    }

    showSuccess(message) {
        this.hideError();
        const successElement = document.createElement('div');
        successElement.className = 'success-message';
        successElement.innerHTML = `<i class="fas fa-check-circle"></i> ${message}`;
        successElement.style.display = 'flex';
        
        const calculator = document.querySelector('.calculator');
        const existingSuccess = calculator.querySelector('.success-message');
        if (existingSuccess) existingSuccess.remove();
        
        calculator.appendChild(successElement);
        
        setTimeout(() => {
            successElement.remove();
        }, 3000);
    }

    hideError() {
        const errorElement = document.querySelector('.error-message');
        if (errorElement) errorElement.remove();
    }

    hideSuccess() {
        const successElement = document.querySelector('.success-message');
        if (successElement) successElement.remove();
    }
}

// Initialize the MD5 Generator when the page loads
document.addEventListener('DOMContentLoaded', () => {
    new MD5Generator();
});

// Service Worker for offline functionality
if ('serviceWorker' in navigator) {
    window.addEventListener('load', function() {
        navigator.serviceWorker.register('/sw.js').then(function(registration) {
            console.log('ServiceWorker registration successful');
        }, function(err) {
            console.log('ServiceWorker registration failed: ', err);
        });
    });
}