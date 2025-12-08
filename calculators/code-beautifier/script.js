class CodeBeautifier {
    constructor() {
        this.initializeEventListeners();
        this.initializeCodeEditors();
    }

    initializeEventListeners() {
        document.getElementById('beautifyCode').addEventListener('click', () => this.beautifyCode());
        document.getElementById('copyCode').addEventListener('click', () => this.copyBeautifiedCode());
        document.getElementById('clearAll').addEventListener('click', () => this.clearAll());
        
        // Add event listeners to example items
        document.querySelectorAll('.example-item').forEach(item => {
            item.addEventListener('click', () => this.loadExample(item));
        });

        // Real-time beautification on language change
        document.getElementById('codeType').addEventListener('change', () => {
            this.updateEditorMode();
        });

        // Auto-beautify on input with debounce
        let timeout;
        document.getElementById('inputCode').addEventListener('input', () => {
            clearTimeout(timeout);
            timeout = setTimeout(() => {
                if (document.getElementById('inputCode').value.trim()) {
                    this.beautifyCode();
                }
            }, 1000);
        });
    }

    initializeCodeEditors() {
        this.inputEditor = CodeMirror.fromTextArea(document.getElementById('inputCode'), {
            lineNumbers: true,
            mode: 'htmlmixed',
            theme: 'monokai',
            lineWrapping: true,
            autoCloseTags: true,
            matchBrackets: true,
            indentUnit: 4
        });

        this.outputEditor = CodeMirror.fromTextArea(document.getElementById('outputCode'), {
            lineNumbers: true,
            mode: 'htmlmixed',
            theme: 'monokai',
            lineWrapping: true,
            readOnly: true,
            indentUnit: 4
        });

        this.inputEditor.on('change', () => {
            document.getElementById('inputCode').value = this.inputEditor.getValue();
        });
    }

    updateEditorMode() {
        const language = document.getElementById('codeType').value;
        let mode = 'htmlmixed';

        switch (language) {
            case 'html':
                mode = 'htmlmixed';
                break;
            case 'css':
                mode = 'css';
                break;
            case 'javascript':
                mode = 'javascript';
                break;
            case 'php':
                mode = 'php';
                break;
            case 'python':
                mode = 'python';
                break;
            case 'java':
            case 'cpp':
            case 'csharp':
                mode = 'clike';
                break;
            case 'json':
                mode = 'application/json';
                break;
            case 'xml':
                mode = 'xml';
                break;
            case 'sql':
                mode = 'sql';
                break;
        }

        this.inputEditor.setOption('mode', mode);
        this.outputEditor.setOption('mode', mode);
    }

    beautifyCode() {
        const inputCode = this.inputEditor.getValue().trim();
        const language = document.getElementById('codeType').value;
        const indentSize = document.getElementById('indentSize').value;
        const quoteStyle = document.getElementById('quoteStyle').value;
        const maxLineLength = parseInt(document.getElementById('maxLineLength').value);

        if (!inputCode) {
            this.showError('Please enter some code to beautify.');
            return;
        }

        try {
            let beautifiedCode = '';
            const originalLines = inputCode.split('\n').length;
            const originalLength = inputCode.length;

            switch (language) {
                case 'html':
                    beautifiedCode = this.beautifyHTML(inputCode, indentSize);
                    break;
                case 'css':
                    beautifiedCode = this.beautifyCSS(inputCode, indentSize);
                    break;
                case 'javascript':
                    beautifiedCode = this.beautifyJavaScript(inputCode, indentSize, quoteStyle);
                    break;
                case 'php':
                    beautifiedCode = this.beautifyPHP(inputCode, indentSize);
                    break;
                case 'python':
                    beautifiedCode = this.beautifyPython(inputCode, indentSize);
                    break;
                case 'json':
                    beautifiedCode = this.beautifyJSON(inputCode, indentSize);
                    break;
                case 'xml':
                    beautifiedCode = this.beautifyXML(inputCode, indentSize);
                    break;
                case 'sql':
                    beautifiedCode = this.beautifySQL(inputCode, indentSize);
                    break;
                case 'java':
                case 'cpp':
                case 'csharp':
                    beautifiedCode = this.beautifyCLike(inputCode, indentSize, language);
                    break;
                default:
                    beautifiedCode = this.beautifyGeneric(inputCode, indentSize);
            }

            // Apply line length limit
            beautifiedCode = this.limitLineLength(beautifiedCode, maxLineLength);

            this.outputEditor.setValue(beautifiedCode);
            this.showStats(originalLines, beautifiedCode.split('\n').length, originalLength, beautifiedCode.length);
            this.hideError();

        } catch (error) {
            this.showError(`Beautification failed: ${error.message}`);
        }
    }

    beautifyHTML(code, indentSize) {
        let formatted = '';
        let indent = 0;
        const indentStr = indentSize === 'tab' ? '\t' : ' '.repeat(parseInt(indentSize));
        const lines = code.split('\n');
        
        lines.forEach(line => {
            const trimmed = line.trim();
            if (!trimmed) return;

            if (trimmed.startsWith('</')) {
                indent = Math.max(0, indent - 1);
            }

            formatted += indentStr.repeat(indent) + trimmed + '\n';

            if (trimmed.startsWith('<') && !trimmed.startsWith('</') && !trimmed.endsWith('/>') && !trimmed.includes('</')) {
                indent++;
            }
        });

        return formatted;
    }

    beautifyCSS(code, indentSize) {
        let formatted = '';
        let indent = 0;
        const indentStr = indentSize === 'tab' ? '\t' : ' '.repeat(parseInt(indentSize));
        const lines = code.split('}');
        
        lines.forEach((block, index) => {
            const parts = block.split('{');
            if (parts.length === 2) {
                const selector = parts[0].trim();
                const rules = parts[1].split(';').filter(rule => rule.trim());
                
                formatted += indentStr.repeat(indent) + selector + ' {\n';
                indent++;
                
                rules.forEach(rule => {
                    const [property, value] = rule.split(':').map(s => s.trim());
                    if (property && value) {
                        formatted += indentStr.repeat(indent) + property + ': ' + value + ';\n';
                    }
                });
                
                indent--;
                formatted += indentStr.repeat(indent) + '}' + (index < lines.length - 1 ? '\n\n' : '');
            }
        });

        return formatted;
    }

    beautifyJavaScript(code, indentSize, quoteStyle) {
        let formatted = code;
        const indentStr = indentSize === 'tab' ? '\t' : ' '.repeat(parseInt(indentSize));

        // Basic JavaScript formatting
        formatted = formatted
            .replace(/{/g, ' {\n')
            .replace(/}/g, '\n}\n')
            .replace(/;/g, ';\n')
            .replace(/,/g, ', ')
            .replace(/\){/g, ') {');

        // Handle quotes
        if (quoteStyle === 'single') {
            formatted = formatted.replace(/"/g, "'");
        } else if (quoteStyle === 'double') {
            formatted = formatted.replace(/'/g, '"');
        }

        // Indentation logic
        let indent = 0;
        const lines = formatted.split('\n');
        formatted = '';

        lines.forEach(line => {
            const trimmed = line.trim();
            if (!trimmed) return;

            if (trimmed.endsWith('}') || trimmed.endsWith(');')) {
                indent = Math.max(0, indent - 1);
            }

            formatted += indentStr.repeat(indent) + trimmed + '\n';

            if (trimmed.endsWith('{') || trimmed.endsWith('(') || trimmed.includes('function') || trimmed.includes('=>')) {
                indent++;
            }
        });

        return formatted;
    }

    beautifyJSON(code, indentSize) {
        try {
            const parsed = JSON.parse(code);
            const indentStr = indentSize === 'tab' ? '\t' : ' '.repeat(parseInt(indentSize));
            return JSON.stringify(parsed, null, indentStr);
        } catch (error) {
            throw new Error('Invalid JSON format');
        }
    }

    beautifyPHP(code, indentSize) {
        return this.beautifyCLike(code, indentSize, 'php');
    }

    beautifyPython(code, indentSize) {
        // Python-specific formatting
        let formatted = code
            .replace(/:/g, ':\n')
            .replace(/\b(def|class|if|elif|else|for|while|with|try|except|finally)\b/g, '\n$1');

        const indentStr = indentSize === 'tab' ? '\t' : ' '.repeat(parseInt(indentSize));
        let indent = 0;
        const lines = formatted.split('\n');
        formatted = '';

        lines.forEach(line => {
            const trimmed = line.trim();
            if (!trimmed) return;

            if (trimmed.startsWith('except') || trimmed.startsWith('elif') || trimmed.startsWith('else') || trimmed.startsWith('finally')) {
                indent = Math.max(0, indent - 1);
            }

            formatted += indentStr.repeat(indent) + trimmed + '\n';

            if (trimmed.endsWith(':') && !trimmed.startsWith('#')) {
                indent++;
            }
        });

        return formatted;
    }

    beautifyXML(code, indentSize) {
        return this.beautifyHTML(code, indentSize);
    }

    beautifySQL(code, indentSize) {
        const keywords = ['SELECT', 'FROM', 'WHERE', 'INSERT', 'UPDATE', 'DELETE', 'JOIN', 'LEFT', 'RIGHT', 'INNER', 'OUTER', 'GROUP BY', 'ORDER BY', 'HAVING', 'LIMIT', 'OFFSET'];
        let formatted = code.toUpperCase();
        
        keywords.forEach(keyword => {
            const regex = new RegExp(`\\b${keyword}\\b`, 'gi');
            formatted = formatted.replace(regex, `\n${keyword}`);
        });

        const indentStr = indentSize === 'tab' ? '\t' : ' '.repeat(parseInt(indentSize));
        let indent = 0;
        const lines = formatted.split('\n');
        formatted = '';

        lines.forEach(line => {
            const trimmed = line.trim();
            if (!trimmed) return;

            if (trimmed.startsWith('FROM') || trimmed.startsWith('WHERE') || trimmed.startsWith('GROUP BY') || trimmed.startsWith('ORDER BY')) {
                indent = 1;
            } else if (trimmed.startsWith('INSERT') || trimmed.startsWith('UPDATE') || trimmed.startsWith('DELETE')) {
                indent = 0;
            }

            formatted += indentStr.repeat(indent) + trimmed + '\n';
        });

        return formatted;
    }

    beautifyCLike(code, indentSize, language) {
        return this.beautifyJavaScript(code, indentSize, 'double');
    }

    beautifyGeneric(code, indentSize) {
        const indentStr = indentSize === 'tab' ? '\t' : ' '.repeat(parseInt(indentSize));
        return code.split('\n').map(line => indentStr + line.trim()).join('\n');
    }

    limitLineLength(code, maxLength) {
        const lines = code.split('\n');
        const formattedLines = [];

        lines.forEach(line => {
            if (line.length <= maxLength) {
                formattedLines.push(line);
            } else {
                // Simple line breaking (can be enhanced for specific languages)
                let currentLine = '';
                const words = line.split(' ');
                
                words.forEach(word => {
                    if ((currentLine + word).length > maxLength) {
                        if (currentLine) formattedLines.push(currentLine.trim());
                        currentLine = word + ' ';
                    } else {
                        currentLine += word + ' ';
                    }
                });
                
                if (currentLine) formattedLines.push(currentLine.trim());
            }
        });

        return formattedLines.join('\n');
    }

    showStats(originalLines, formattedLines, originalLength, formattedLength) {
        const statsContainer = document.getElementById('stats');
        const charsSaved = originalLength - formattedLength;
        const readabilityScore = Math.min(100, Math.max(0, 50 + ((formattedLines - originalLines) * 2) + (charsSaved > 0 ? 10 : 0)));

        document.getElementById('originalLines').textContent = originalLines;
        document.getElementById('formattedLines').textContent = formattedLines;
        document.getElementById('charsSaved').textContent = charsSaved;
        document.getElementById('readabilityScore').textContent = `${Math.round(readabilityScore)}%`;

        statsContainer.style.display = 'block';
    }

    copyBeautifiedCode() {
        const beautifiedCode = this.outputEditor.getValue();
        
        if (!beautifiedCode) {
            this.showError('No beautified code to copy.');
            return;
        }

        navigator.clipboard.writeText(beautifiedCode).then(() => {
            this.showSuccess('Beautified code copied to clipboard!');
        }).catch(() => {
            this.showError('Failed to copy code to clipboard.');
        });
    }

    loadExample(exampleElement) {
        const type = exampleElement.getAttribute('data-type');
        const code = exampleElement.getAttribute('data-code').replace(/&lt;/g, '<').replace(/&gt;/g, '>');
        
        document.getElementById('codeType').value = type;
        this.updateEditorMode();
        this.inputEditor.setValue(code);
        
        setTimeout(() => this.beautifyCode(), 100);
    }

    clearAll() {
        this.inputEditor.setValue('');
        this.outputEditor.setValue('');
        document.getElementById('stats').style.display = 'none';
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

// Initialize the Code Beautifier when the page loads
document.addEventListener('DOMContentLoaded', () => {
    new CodeBeautifier();
});