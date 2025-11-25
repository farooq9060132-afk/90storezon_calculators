// DOM Elements
const jsonInput = document.getElementById('jsonInput');
const jsonOutput = document.getElementById('jsonOutput');
const jsonOutputRaw = document.getElementById('jsonOutputRaw');
const formatBtn = document.getElementById('formatBtn');
const clearBtn = document.getElementById('clearBtn');
const exampleBtn = document.getElementById('exampleBtn');
const pasteBtn = document.getElementById('pasteBtn');
const copyBtn = document.getElementById('copyBtn');
const downloadBtn = document.getElementById('downloadBtn');
const toggleView = document.getElementById('toggleView');
const validationResults = document.getElementById('validationResults');

// Example JSON
const exampleJSON = {
    "website": "JSON Formatter",
    "version": "1.0",
    "features": ["beautify", "minify", "validate"],
    "stats": {
        "users": 1000,
        "rating": 4.8,
        "active": true
    },
    "supported_types": ["object", "array", "string", "number", "boolean", "null"]
};

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    // Set example JSON
    exampleBtn.addEventListener('click', () => {
        jsonInput.value = JSON.stringify(exampleJSON, null, 2);
        clearError();
    });

    // Clear input
    clearBtn.addEventListener('click', () => {
        jsonInput.value = '';
        clearOutput();
        clearError();
    });

    // Paste from clipboard
    pasteBtn.addEventListener('click', async () => {
        try {
            const text = await navigator.clipboard.readText();
            jsonInput.value = text;
            clearError();
        } catch (err) {
            showError('Failed to read from clipboard. Please paste manually.');
        }
    });

    // Copy to clipboard
    copyBtn.addEventListener('click', async () => {
        const text = jsonOutputRaw.style.display === 'none' 
            ? jsonOutput.textContent 
            : jsonOutputRaw.value;
        
        try {
            await navigator.clipboard.writeText(text);
            showSuccess('Copied to clipboard!');
        } catch (err) {
            showError('Failed to copy to clipboard.');
        }
    });

    // Download JSON
    downloadBtn.addEventListener('click', () => {
        const text = jsonOutputRaw.style.display === 'none' 
            ? jsonOutput.textContent 
            : jsonOutputRaw.value;
        
        const blob = new Blob([text], { type: 'application/json' });
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = 'formatted.json';
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        URL.revokeObjectURL(url);
        
        showSuccess('Download started!');
    });

    // Toggle view
    toggleView.addEventListener('click', () => {
        if (jsonOutput.style.display === 'none') {
            jsonOutput.style.display = 'block';
            jsonOutputRaw.style.display = 'none';
            toggleView.textContent = '👁️ Raw View';
        } else {
            jsonOutput.style.display = 'none';
            jsonOutputRaw.style.display = 'block';
            jsonOutputRaw.value = jsonOutput.textContent;
            toggleView.textContent = '👁️ Pretty View';
        }
    });

    // Format JSON
    formatBtn.addEventListener('click', formatJSON);

    // Auto-format on Ctrl+Enter
    jsonInput.addEventListener('keydown', (e) => {
        if (e.ctrlKey && e.key === 'Enter') {
            formatJSON();
        }
    });

    // Real-time validation
    jsonInput.addEventListener('input', debounce(validateJSON, 500));
});

// Format JSON function (CLIENT-SIDE ONLY)
function formatJSON() {
    const input = jsonInput.value.trim();
    
    if (!input) {
        showError('Please enter JSON data to format.');
        return;
    }

    // Show loading state
    formatBtn.disabled = true;
    formatBtn.innerHTML = '⏳ Processing...';

    try {
        const formatType = document.querySelector('input[name="formatType"]:checked').value;
        const sortKeys = document.getElementById('sortKeys').checked;
        const escapeUnicode = document.getElementById('escapeUnicode').checked;

        // Parse input JSON
        const parsed = JSON.parse(input);
        
        let output;
        let stats;

        switch (formatType) {
            case 'beautify':
                output = formatBeautify(parsed, sortKeys, escapeUnicode);
                break;
            case 'minify':
                output = formatMinify(parsed, escapeUnicode);
                break;
            case 'validate':
                output = input; // Keep original for display
                break;
        }

        stats = calculateStats(input, output, formatType);
        
        displayFormattedJSON(output, stats);
        showValidationResults(stats, true);
        showSuccess('JSON formatted successfully!');

    } catch (error) {
        showError(`JSON Error: ${error.message}`);
        showValidationResults(null, false, error.message);
    } finally {
        // Reset button
        formatBtn.disabled = false;
        formatBtn.innerHTML = '🚀 Format JSON';
    }
}

// Beautify JSON
function formatBeautify(data, sortKeys, escapeUnicode) {
    let processedData = data;
    
    // Sort keys if requested
    if (sortKeys) {
        processedData = sortObjectKeys(data);
    }
    
    // Stringify with pretty print
    const spaces = 2;
    if (escapeUnicode) {
        return JSON.stringify(processedData, null, spaces);
    } else {
        return JSON.stringify(processedData, null, spaces)
            .replace(/\\u[\dA-F]{4}/gi, (match) => {
                return String.fromCharCode(parseInt(match.replace(/\\u/g, ''), 16));
            });
    }
}

// Minify JSON
function formatMinify(data, escapeUnicode) {
    if (escapeUnicode) {
        return JSON.stringify(data);
    } else {
        return JSON.stringify(data)
            .replace(/\\u[\dA-F]{4}/gi, (match) => {
                return String.fromCharCode(parseInt(match.replace(/\\u/g, ''), 16));
            });
    }
}

// Sort object keys recursively
function sortObjectKeys(obj) {
    if (typeof obj !== 'object' || obj === null) return obj;
    
    if (Array.isArray(obj)) {
        return obj.map(sortObjectKeys);
    }
    
    const sorted = {};
    Object.keys(obj).sort().forEach(key => {
        sorted[key] = sortObjectKeys(obj[key]);
    });
    
    return sorted;
}

// Calculate statistics
function calculateStats(input, output, action) {
    const inputSize = input.length;
    const outputSize = output.length;
    const inputLines = (input.match(/\n/g) || []).length + 1;
    const outputLines = action === 'minify' ? 1 : (output.match(/\n/g) || []).length + 1;
    
    let reduction = 0;
    if (inputSize > 0) {
        reduction = ((inputSize - outputSize) / inputSize) * 100;
    }

    return {
        input_size: inputSize,
        output_size: outputSize,
        input_lines: inputLines,
        output_lines: outputLines,
        reduction: Math.round(reduction * 100) / 100,
        input_chars: input.length,
        output_chars: output.length
    };
}

// Display formatted JSON with syntax highlighting
function displayFormattedJSON(json, stats) {
    const formatted = typeof json === 'string' ? json : JSON.stringify(json, null, 2);
    
    // Set raw output
    jsonOutputRaw.value = formatted;
    
    // Apply syntax highlighting to pretty output
    jsonOutput.innerHTML = syntaxHighlight(formatted);
    
    // Show stats
    const statsElement = document.getElementById('outputStats');
    if (stats) {
        statsElement.innerHTML = `
            <div class="stat-item">
                Size: <span class="stat-value">${stats.output_size} bytes</span>
            </div>
            <div class="stat-item">
                Lines: <span class="stat-value">${stats.output_lines}</span>
            </div>
            <div class="stat-item">
                Reduction: <span class="stat-value">${stats.reduction}%</span>
            </div>
        `;
    }
}

// Syntax highlighting for JSON
function syntaxHighlight(json) {
    if (typeof json !== 'string') {
        json = JSON.stringify(json, null, 2);
    }
    
    return json.replace(/("(\\u[a-zA-Z0-9]{4}|\\[^u]|[^\\"])*"(\s*:)?|\b(true|false|null)\b|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?)/g, function(match) {
        let cls = 'number';
        if (/^"/.test(match)) {
            if (/:$/.test(match)) {
                cls = 'key';
            } else {
                cls = 'string';
            }
        } else if (/true|false/.test(match)) {
            cls = 'boolean';
        } else if (/null/.test(match)) {
            cls = 'null';
        }
        return '<span class="' + cls + '">' + match + '</span>';
    });
}

// Validate JSON in real-time
function validateJSON() {
    const input = jsonInput.value.trim();
    
    if (!input) {
        clearError();
        return;
    }

    try {
        JSON.parse(input);
        clearError();
    } catch (error) {
        showError(`Validation Error: ${error.message}`);
    }
}

// Show validation results
function showValidationResults(stats, isValid, error = '') {
    if (isValid && stats) {
        validationResults.style.display = 'block';
        validationResults.classList.add('fade-in');
        
        document.getElementById('validationStatus').textContent = 'Valid JSON';
        document.getElementById('validationStatus').className = 'validation-value valid';
        document.getElementById('validationSize').textContent = `${stats.output_size} bytes`;
        document.getElementById('validationChars').textContent = `${stats.output_chars} characters`;
        document.getElementById('validationLines').textContent = `${stats.output_lines} lines`;
        
        document.getElementById('errorDetails').style.display = 'none';
    } else {
        validationResults.style.display = 'block';
        validationResults.classList.add('fade-in');
        
        document.getElementById('validationStatus').textContent = 'Invalid JSON';
        document.getElementById('validationStatus').className = 'validation-value invalid';
        document.getElementById('validationSize').textContent = '-';
        document.getElementById('validationChars').textContent = '-';
        document.getElementById('validationLines').textContent = '-';
        
        const errorDetails = document.getElementById('errorDetails');
        errorDetails.style.display = 'block';
        errorDetails.textContent = error;
    }
}

// Utility functions
function showError(message) {
    const errorElement = document.getElementById('inputError');
    errorElement.textContent = message;
    errorElement.style.display = 'block';
}

function showSuccess(message) {
    // Create temporary success message
    const successElement = document.createElement('div');
    successElement.className = 'success-message';
    successElement.textContent = message;
    successElement.style.position = 'fixed';
    successElement.style.top = '20px';
    successElement.style.right = '20px';
    successElement.style.zIndex = '1000';
    
    document.body.appendChild(successElement);
    
    setTimeout(() => {
        document.body.removeChild(successElement);
    }, 3000);
}

function clearError() {
    const errorElement = document.getElementById('inputError');
    errorElement.textContent = '';
    errorElement.style.display = 'none';
}

function clearOutput() {
    jsonOutput.textContent = '';
    jsonOutputRaw.value = '';
    document.getElementById('outputStats').innerHTML = '';
    validationResults.style.display = 'none';
}

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

// Add some interactive features
document.addEventListener('DOMContentLoaded', function() {
    // Add pulse animation to VIP card
    const vipCard = document.querySelector('.vip-card');
    setInterval(() => {
        vipCard.style.transform = 'scale(1.02)';
        setTimeout(() => {
            vipCard.style.transform = 'scale(1)';
        }, 1000);
    }, 5000);
});