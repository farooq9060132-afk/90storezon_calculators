class CharacterCounter {
    constructor() {
        this.initializeEventListeners();
        this.initializeRealTimeUpdates();
        this.initializeProgressBars();
    }

    initializeEventListeners() {
        document.getElementById('analyzeText').addEventListener('click', () => this.analyzeText());
        document.getElementById('clearText').addEventListener('click', () => this.clearText());
        document.getElementById('copyText').addEventListener('click', () => this.copyText());
        
        // Add event listeners to example items
        document.querySelectorAll('.example-item').forEach(item => {
            item.addEventListener('click', () => this.loadExample(item));
        });

        // Progress bar inputs
        document.getElementById('charLimit').addEventListener('input', () => this.updateProgressBars());
        document.getElementById('wordLimit').addEventListener('input', () => this.updateProgressBars());
    }

    initializeRealTimeUpdates() {
        const inputText = document.getElementById('inputText');
        const autoUpdate = document.getElementById('autoUpdate');

        inputText.addEventListener('input', () => {
            if (autoUpdate.checked) {
                clearTimeout(this.updateTimeout);
                this.updateTimeout = setTimeout(() => {
                    if (inputText.value.trim()) {
                        this.analyzeText();
                    }
                }, 300);
            }
        });
    }

    initializeProgressBars() {
        // Initialize progress bars with default values
        this.updateProgressBars();
    }

    analyzeText() {
        const startTime = performance.now();
        const inputText = document.getElementById('inputText').value;
        const countSpaces = document.getElementById('countSpaces').checked;
        const countPunctuation = document.getElementById('countPunctuation').checked;

        if (!inputText.trim()) {
            this.showError('Please enter some text to analyze.');
            return;
        }

        try {
            // Basic counts
            const charCountWithSpaces = inputText.length;
            const charCountWithoutSpaces = inputText.replace(/\s/g, '').length;
            
            // Word count (handles punctuation based on setting)
            let wordCountText = inputText;
            if (!countPunctuation) {
                wordCountText = inputText.replace(/[^\w\s]/g, ' ');
            }
            const wordCount = wordCountText.trim().split(/\s+/).filter(word => word.length > 0).length;
            
            // Sentence count
            const sentenceCount = inputText.split(/[.!?]+/).filter(sentence => sentence.trim().length > 0).length;
            
            // Paragraph count
            const paragraphCount = inputText.split(/\n+/).filter(paragraph => paragraph.trim().length > 0).length;
            
            // Reading time (average 200 words per minute)
            const readingTimeMinutes = wordCount / 200;
            const readingTime = readingTimeMinutes < 1 ? 
                '< 1 min' : 
                `${Math.ceil(readingTimeMinutes)} min`;
            
            // Detailed character analysis
            const letterCount = (inputText.match(/[a-zA-Z]/g) || []).length;
            const digitCount = (inputText.match(/\d/g) || []).length;
            const spaceCount = (inputText.match(/\s/g) || []).length;
            const punctuationCount = (inputText.match(/[^\w\s]/g) || []).length;
            const specialCharCount = (inputText.match(/[^a-zA-Z0-9\s]/g) || []).length;
            const lineCount = (inputText.match(/\n/g) || []).length + 1;
            
            // Text metrics
            const avgWordLength = wordCount > 0 ? (charCountWithoutSpaces / wordCount).toFixed(1) : '0';
            const avgSentenceLength = sentenceCount > 0 ? (wordCount / sentenceCount).toFixed(1) : '0';
            const wordsPerSentence = sentenceCount > 0 ? (wordCount / sentenceCount).toFixed(1) : '0';
            const charsPerWord = wordCount > 0 ? (charCountWithSpaces / wordCount).toFixed(1) : '0';
            
            const processingTime = performance.now() - startTime;

            // Display results
            this.displayResults({
                charCountWithSpaces,
                charCountWithoutSpaces,
                wordCount,
                sentenceCount,
                paragraphCount,
                readingTime,
                letterCount,
                digitCount,
                spaceCount,
                punctuationCount,
                specialCharCount,
                lineCount,
                avgWordLength,
                avgSentenceLength,
                wordsPerSentence,
                charsPerWord,
                processingTime
            });

            // Update word frequency
            this.updateWordFrequency(inputText);
            
            // Update progress bars
            this.updateProgressBars();
            
            this.hideError();

        } catch (error) {
            this.showError(`Text analysis failed: ${error.message}`);
        }
    }

    displayResults(results) {
        // Update main statistics
        document.getElementById('charCountWithSpaces').textContent = results.charCountWithSpaces.toLocaleString();
        document.getElementById('charCountWithoutSpaces').textContent = results.charCountWithoutSpaces.toLocaleString();
        document.getElementById('wordCount').textContent = results.wordCount.toLocaleString();
        document.getElementById('sentenceCount').textContent = results.sentenceCount.toLocaleString();
        document.getElementById('paragraphCount').textContent = results.paragraphCount.toLocaleString();
        document.getElementById('readingTime').textContent = results.readingTime;

        // Update detailed counts
        document.getElementById('letterCount').textContent = results.letterCount.toLocaleString();
        document.getElementById('digitCount').textContent = results.digitCount.toLocaleString();
        document.getElementById('spaceCount').textContent = results.spaceCount.toLocaleString();
        document.getElementById('punctuationCount').textContent = results.punctuationCount.toLocaleString();
        document.getElementById('specialCharCount').textContent = results.specialCharCount.toLocaleString();
        document.getElementById('lineCount').textContent = results.lineCount.toLocaleString();

        // Update text metrics
        document.getElementById('avgWordLength').textContent = results.avgWordLength;
        document.getElementById('avgSentenceLength').textContent = results.avgSentenceLength;
        document.getElementById('wordsPerSentence').textContent = results.wordsPerSentence;
        document.getElementById('charsPerWord').textContent = results.charsPerWord;

        // Add animation
        const textarea = document.getElementById('inputText');
        textarea.classList.add('text-updating');
        setTimeout(() => textarea.classList.remove('text-updating'), 500);

        // Show results container
        document.getElementById('results').style.display = 'block';
    }

    updateWordFrequency(text) {
        // Clean text and split into words
        const words = text.toLowerCase()
            .replace(/[^\w\s]/g, ' ')
            .split(/\s+/)
            .filter(word => word.length > 2); // Only words with 3+ characters

        // Count frequency
        const frequency = {};
        words.forEach(word => {
            frequency[word] = (frequency[word] || 0) + 1;
        });

        // Convert to array and sort by frequency
        const sortedWords = Object.entries(frequency)
            .sort((a, b) => b[1] - a[1])
            .slice(0, 10); // Top 10 words

        // Display frequency
        const frequencyElement = document.getElementById('wordFrequency');
        
        if (sortedWords.length === 0) {
            frequencyElement.innerHTML = '<div class="frequency-placeholder">No significant words found for frequency analysis</div>';
            return;
        }

        frequencyElement.innerHTML = sortedWords.map(([word, count]) => `
            <div class="frequency-item">
                <span class="frequency-word">${this.escapeHtml(word)}</span>
                <span class="frequency-count">${count}</span>
            </div>
        `).join('');
    }

    updateProgressBars() {
        const inputText = document.getElementById('inputText').value;
        const charLimit = parseInt(document.getElementById('charLimit').value) || 0;
        const wordLimit = parseInt(document.getElementById('wordLimit').value) || 0;

        const charCount = inputText.length;
        const words = inputText.trim().split(/\s+/).filter(word => word.length > 0);
        const wordCount = words.length;

        // Character progress
        const charProgress = charLimit > 0 ? Math.min((charCount / charLimit) * 100, 100) : 0;
        const charProgressElement = document.getElementById('charProgress');
        const charProgressText = document.getElementById('charProgressText');
        
        charProgressElement.style.width = `${charProgress}%`;
        charProgressText.textContent = `${Math.round(charProgress)}%`;
        
        // Update progress bar color based on percentage
        charProgressElement.parentElement.className = 'progress-bar';
        if (charProgress > 90) {
            charProgressElement.parentElement.classList.add('progress-danger');
        } else if (charProgress > 75) {
            charProgressElement.parentElement.classList.add('progress-warning');
        }

        // Word progress
        const wordProgress = wordLimit > 0 ? Math.min((wordCount / wordLimit) * 100, 100) : 0;
        const wordProgressElement = document.getElementById('wordProgress');
        const wordProgressText = document.getElementById('wordProgressText');
        
        wordProgressElement.style.width = `${wordProgress}%`;
        wordProgressText.textContent = `${Math.round(wordProgress)}%`;
        
        // Update progress bar color based on percentage
        wordProgressElement.parentElement.className = 'progress-bar';
        if (wordProgress > 90) {
            wordProgressElement.parentElement.classList.add('progress-danger');
        } else if (wordProgress > 75) {
            wordProgressElement.parentElement.classList.add('progress-warning');
        }
    }

    copyText() {
        const inputText = document.getElementById('inputText');
        
        if (!inputText.value.trim()) {
            this.showError('No text to copy. Please enter some text first.');
            return;
        }

        inputText.select();
        navigator.clipboard.writeText(inputText.value).then(() => {
            this.showSuccess('Text copied to clipboard!');
        }).catch(() => {
            this.showError('Failed to copy text to clipboard.');
        });
    }

    loadExample(exampleElement) {
        const text = exampleElement.getAttribute('data-text');
        document.getElementById('inputText').value = text;
        this.analyzeText();
    }

    clearText() {
        document.getElementById('inputText').value = '';
        document.getElementById('results').style.display = 'none';
        this.hideError();
        this.hideSuccess();
    }

    escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
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

// Initialize the Character Counter when the page loads
document.addEventListener('DOMContentLoaded', () => {
    new CharacterCounter();
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