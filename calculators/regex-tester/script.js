class RegexTester {
    constructor() {
        this.initializeEventListeners();
    }

    initializeEventListeners() {
        document.getElementById('testRegex').addEventListener('click', () => this.testRegex());
        document.getElementById('clearAll').addEventListener('click', () => this.clearAll());
        
        // Add event listeners to example items
        document.querySelectorAll('.example-item').forEach(item => {
            item.addEventListener('click', () => this.loadExample(item));
        });

        // Add real-time validation on pattern input
        document.getElementById('regexPattern').addEventListener('input', () => {
            this.validatePattern();
        });

        // Add keyboard shortcut (Ctrl+Enter to test)
        document.addEventListener('keydown', (e) => {
            if (e.ctrlKey && e.key === 'Enter') {
                e.preventDefault();
                this.testRegex();
            }
        });
    }

    validatePattern() {
        const pattern = document.getElementById('regexPattern').value;
        const errorElement = document.getElementById('errorMessage');
        
        if (!pattern) {
            this.hideError();
            return true;
        }

        try {
            // Try to create a regex with the pattern to validate it
            new RegExp(pattern);
            this.hideError();
            return true;
        } catch (error) {
            this.showError(`Invalid regex pattern: ${error.message}`);
            return false;
        }
    }

    testRegex() {
        const startTime = performance.now();
        
        // Hide previous results and errors
        this.hideResults();
        this.hideError();

        // Get input values
        const pattern = document.getElementById('regexPattern').value;
        const testString = document.getElementById('testString').value;
        
        // Validate pattern first
        if (!this.validatePattern()) {
            return;
        }

        if (!pattern || !testString) {
            this.showError('Please enter both a regex pattern and a test string.');
            return;
        }

        try {
            // Get flags
            const flags = this.getFlags();
            const regex = new RegExp(pattern, flags);
            
            // Test the regex
            const matches = this.findAllMatches(regex, testString, flags);
            const executionTime = performance.now() - startTime;

            // Display results
            this.displayResults(matches, testString, executionTime);
            
        } catch (error) {
            this.showError(`Regex execution error: ${error.message}`);
        }
    }

    getFlags() {
        let flags = '';
        if (document.getElementById('flagGlobal').checked) flags += 'g';
        if (document.getElementById('flagIgnoreCase').checked) flags += 'i';
        if (document.getElementById('flagMultiline').checked) flags += 'm';
        return flags;
    }

    findAllMatches(regex, testString, flags) {
        const matches = [];
        let match;
        
        // Reset regex lastIndex for global searches
        regex.lastIndex = 0;

        if (flags.includes('g')) {
            // Global search - find all matches
            while ((match = regex.exec(testString)) !== null) {
                matches.push({
                    match: match[0],
                    index: match.index,
                    groups: match.slice(1),
                    input: match.input
                });
                
                // Prevent infinite loop for zero-width matches
                if (match.index === regex.lastIndex) {
                    regex.lastIndex++;
                }
            }
        } else {
            // Single match search
            match = regex.exec(testString);
            if (match) {
                matches.push({
                    match: match[0],
                    index: match.index,
                    groups: match.slice(1),
                    input: match.input
                });
            }
        }

        return matches;
    }

    displayResults(matches, testString, executionTime) {
        const resultsElement = document.getElementById('results');
        const matchCountElement = document.getElementById('matchCount');
        const matchesListElement = document.getElementById('matchesList');
        const matchDetailsElement = document.getElementById('matchDetails');
        const statTotalMatchesElement = document.getElementById('statTotalMatches');
        const statPatternValidElement = document.getElementById('statPatternValid');
        const statExecTimeElement = document.getElementById('statExecTime');

        // Update match count
        matchCountElement.textContent = matches.length;
        statTotalMatchesElement.textContent = matches.length;
        statPatternValidElement.textContent = 'Yes';
        statExecTimeElement.textContent = `${executionTime.toFixed(2)}ms`;

        // Display matches list
        if (matches.length === 0) {
            matchesListElement.innerHTML = '<div class="match-item">No matches found</div>';
        } else {
            matchesListElement.innerHTML = matches.map((match, index) => `
                <div class="match-item">
                    <strong>Match ${index + 1}:</strong> "${this.escapeHtml(match.match)}"
                    <br><small>Position: ${match.index}</small>
                </div>
            `).join('');
        }

        // Display detailed match information
        if (matches.length > 0) {
            let detailsHtml = '<strong>Detailed Match Information:</strong><br><br>';
            
            matches.forEach((match, index) => {
                detailsHtml += `
                    <div class="match-info">
                        <strong>Match ${index + 1}:</strong><br>
                        • Full match: "${this.escapeHtml(match.match)}"<br>
                        • Start position: ${match.index}<br>
                        • End position: ${match.index + match.match.length}<br>
                        • Length: ${match.match.length} characters<br>
                `;
                
                if (match.groups.length > 0) {
                    detailsHtml += '• Capturing groups:<br>';
                    match.groups.forEach((group, groupIndex) => {
                        if (group !== undefined) {
                            detailsHtml += `  Group ${groupIndex + 1}: "${this.escapeHtml(group)}"<br>`;
                        }
                    });
                } else {
                    detailsHtml += '• No capturing groups<br>';
                }
                
                detailsHtml += '</div>';
            });

            // Show highlighted text
            detailsHtml += '<br><strong>Highlighted Text:</strong><br>';
            detailsHtml += this.highlightMatches(testString, matches);
            
            matchDetailsElement.innerHTML = detailsHtml;
        } else {
            matchDetailsElement.innerHTML = 'No matches to display details for.';
        }

        // Show results container
        resultsElement.style.display = 'block';
    }

    highlightMatches(text, matches) {
        if (matches.length === 0) {
            return `<div style="padding: 10px; background: #f8f9fa; border-radius: 5px;">${this.escapeHtml(text)}</div>`;
        }

        // Sort matches by index in descending order to avoid index shifting during replacement
        const sortedMatches = [...matches].sort((a, b) => b.index - a.index);
        let highlightedText = this.escapeHtml(text);

        sortedMatches.forEach(match => {
            const start = match.index;
            const end = start + match.match.length;
            const matchedText = this.escapeHtml(match.match);
            const highlighted = `<span class="highlight" title="Match: ${matchedText}">${matchedText}</span>`;
            
            highlightedText = highlightedText.slice(0, start) + highlighted + highlightedText.slice(end);
        });

        return `<div style="padding: 10px; background: #f8f9fa; border-radius: 5px; font-family: 'Courier New', monospace; white-space: pre-wrap;">${highlightedText}</div>`;
    }

    escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    loadExample(exampleElement) {
        const pattern = exampleElement.getAttribute('data-pattern');
        const text = exampleElement.getAttribute('data-text');
        
        document.getElementById('regexPattern').value = pattern;
        document.getElementById('testString').value = text;
        
        // Auto-test the example
        setTimeout(() => this.testRegex(), 100);
    }

    clearAll() {
        document.getElementById('regexPattern').value = '';
        document.getElementById('testString').value = '';
        document.getElementById('flagGlobal').checked = true;
        document.getElementById('flagIgnoreCase').checked = false;
        document.getElementById('flagMultiline').checked = false;
        
        this.hideResults();
        this.hideError();
    }

    hideResults() {
        document.getElementById('results').style.display = 'none';
    }

    showError(message) {
        const errorElement = document.getElementById('errorMessage');
        const errorTextElement = document.getElementById('errorText');
        
        errorTextElement.textContent = message;
        errorElement.style.display = 'flex';
    }

    hideError() {
        document.getElementById('errorMessage').style.display = 'none';
    }
}

// Initialize the Regex Tester when the page loads
document.addEventListener('DOMContentLoaded', () => {
    new RegexTester();
});

// Add service worker for offline functionality (optional)
if ('serviceWorker' in navigator) {
    window.addEventListener('load', function() {
        navigator.serviceWorker.register('/sw.js').then(function(registration) {
            console.log('ServiceWorker registration successful');
        }, function(err) {
            console.log('ServiceWorker registration failed: ', err);
        });
    });
}