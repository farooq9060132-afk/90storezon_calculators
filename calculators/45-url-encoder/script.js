class URLEncoder {
    constructor() {
        this.initializeEventListeners();
        this.initializeAutoProcess();
    }

    initializeEventListeners() {
        document.getElementById('processUrl').addEventListener('click', () => this.processURL());
        document.getElementById('copyResult').addEventListener('click', () => this.copyResult());
        document.getElementById('copyResultBtn').addEventListener('click', () => this.copyResult());
        document.getElementById('clearAll').addEventListener('click', () => this.clearAll());
        
        // Add event listeners to example items
        document.querySelectorAll('.example-item').forEach(item => {
            item.addEventListener('click', () => this.loadExample(item));
        });

        // Enter key to process
        document.getElementById('inputText').addEventListener('keypress', (e) => {
            if (e.key === 'Enter' && e.ctrlKey) {
                e.preventDefault();
                this.processURL();
            }
        });

        // Operation type change
        document.getElementById('encodingType').addEventListener('change', () => {
            if (document.getElementById('autoProcess').checked) {
                this.processURL();
            }
        });
    }

    initializeAutoProcess() {
        const autoProcess = document.getElementById('autoProcess');
        const inputText = document.getElementById('inputText');

        inputText.addEventListener('input', () => {
            if (autoProcess.checked) {
                clearTimeout(this.autoProcessTimeout);
                this.autoProcessTimeout = setTimeout(() => {
                    if (inputText.value.trim()) {
                        this.processURL();
                    }
                }, 500);
            }
        });
    }

    processURL() {
        const startTime = performance.now();
        const inputText = document.getElementById('inputText').value;
        const encodingType = document.getElementById('encodingType').value;
        const autoDetect = document.getElementById('autoDetect').value;

        if (!inputText.trim()) {
            this.showError('Please enter some text or URL to process.');
            return;
        }

        try {
            let result = '';
            let operation = '';

            // Process based on encoding type
            switch (encodingType) {
                case 'encode':
                    result = encodeURI(inputText);
                    operation = 'URL Encoded';
                    break;
                case 'decode':
                    result = decodeURI(inputText);
                    operation = 'URL Decoded';
                    break;
                case 'encodeComponent':
                    result = encodeURIComponent(inputText);
                    operation = 'URL Component Encoded';
                    break;
                case 'decodeComponent':
                    result = decodeURIComponent(inputText);
                    operation = 'URL Component Decoded';
                    break;
            }

            const processingTime = performance.now() - startTime;

            // Display results
            this.displayResults(result, inputText, operation, processingTime);
            this.updateComparison(inputText);
            this.hideError();

        } catch (error) {
            this.showError(`URL processing failed: ${error.message}`);
        }
    }

    displayResults(result, originalText, operation, processingTime) {
        const originalLength = originalText.length;
        const processedLength = result.length;
        const sizeChange = ((processedLength - originalLength) / originalLength * 100).toFixed(1);

        // Update main result display
        const resultElement = document.getElementById('processedResult');
        resultElement.textContent = result;
        resultElement.classList.add('result-animation');
        setTimeout(() => resultElement.classList.remove('result-animation'), 500);

        // Update information
        document.getElementById('operationType').textContent = operation;
        document.getElementById('originalLength').textContent = `${originalLength} characters`;
        document.getElementById('processedLength').textContent = `${processedLength} characters`;
        document.getElementById('sizeChange').textContent = `${sizeChange}%`;
        document.getElementById('processingTime').textContent = `${processingTime.toFixed(2)}ms`;

        // Character analysis
        this.analyzeCharacters(originalText, result);

        // Show results container
        document.getElementById('results').style.display = 'block';
    }

    analyzeCharacters(original, processed) {
        const encodedChars = (processed.match(/%[0-9A-Fa-f]{2}/g) || []).length;
        const specialChars = (original.match(/[^\w\s]/g) || []).length;
        const spaceCount = (original.match(/\s/g) || []).length;

        document.getElementById('encodedChars').textContent = encodedChars;
        document.getElementById('specialChars').textContent = specialChars;
        document.getElementById('spaceCount').textContent = spaceCount;
    }

    updateComparison(originalText) {
        document.getElementById('originalText').textContent = originalText;
        document.getElementById('urlEncoded').textContent = encodeURI(originalText);
        document.getElementById('componentEncoded').textContent = encodeURIComponent(originalText);
    }

    copyResult() {
        const result = document.getElementById('processedResult').textContent;
        
        if (!result || result === 'Enter text and click Process URL') {
            this.showError('No result to copy. Please process some text first.');
            return;
        }

        navigator.clipboard.writeText(result).then(() => {
            this.showSuccess('Result copied to clipboard!');
        }).catch(() => {
            this.showError('Failed to copy result to clipboard.');
        });
    }

    loadExample(exampleElement) {
        const text = exampleElement.getAttribute('data-text');
        document.getElementById('inputText').value = text;
        this.processURL();
    }

    clearAll() {
        document.getElementById('inputText').value = '';
        document.getElementById('results').style.display = 'none';
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

// Initialize the URL Encoder when the page loads
document.addEventListener('DOMContentLoaded', () => {
    new URLEncoder();
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