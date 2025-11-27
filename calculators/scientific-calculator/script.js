class ScientificCalculator {
    constructor() {
        this.currentOperand = '0';
        this.previousOperand = '';
        this.operation = null;
        this.waitingForNewOperand = false;
        this.memory = 0;
        this.lastAnswer = 0;
        this.history = [];
        
        this.initializeElements();
        this.attachEventListeners();
        this.updateDisplay();
    }

    initializeElements() {
        this.previousOperandElement = document.getElementById('previousOperand');
        this.currentOperandElement = document.getElementById('currentOperand');
        this.historyListElement = document.getElementById('historyList');
        this.clearHistoryButton = document.getElementById('clearHistory');
    }

    attachEventListeners() {
        // Number buttons
        document.querySelectorAll('.btn.number').forEach(button => {
            button.addEventListener('click', () => {
                this.inputNumber(button.getAttribute('data-number'));
            });
        });

        // Operation buttons
        document.querySelectorAll('.btn.operation').forEach(button => {
            button.addEventListener('click', () => {
                this.inputOperation(button.getAttribute('data-operation'));
            });
        });

        // Scientific function buttons
        document.querySelectorAll('.btn.scientific').forEach(button => {
            button.addEventListener('click', () => {
                this.inputScientific(button.getAttribute('data-action'));
            });
        });

        // Memory buttons
        document.querySelectorAll('.btn.memory').forEach(button => {
            button.addEventListener('click', () => {
                this.inputMemory(button.getAttribute('data-action'));
            });
        });

        // Other buttons
        document.querySelectorAll('.btn.clear').forEach(button => {
            button.addEventListener('click', () => {
                const action = button.getAttribute('data-action');
                if (action === 'clear') {
                    this.clear();
                } else if (action === 'delete') {
                    this.delete();
                }
            });
        });

        document.querySelectorAll('.btn.decimal').forEach(button => {
            button.addEventListener('click', () => {
                this.inputDecimal();
            });
        });

        document.querySelectorAll('.btn.equals').forEach(button => {
            button.addEventListener('click', () => {
                this.calculate();
            });
        });

        document.querySelectorAll('.btn.parenthesis').forEach(button => {
            button.addEventListener('click', () => {
                this.inputParenthesis(button.getAttribute('data-action'));
            });
        });

        // Clear history
        this.clearHistoryButton.addEventListener('click', () => {
            this.clearHistory();
        });

        // Keyboard support
        document.addEventListener('keydown', (event) => {
            this.handleKeyboardInput(event);
        });
    }

    inputNumber(number) {
        if (this.waitingForNewOperand) {
            this.currentOperand = number;
            this.waitingForNewOperand = false;
        } else {
            this.currentOperand = this.currentOperand === '0' ? number : this.currentOperand + number;
        }
        this.updateDisplay();
    }

    inputOperation(operation) {
        if (this.waitingForNewOperand) {
            this.operation = operation;
            this.updateDisplay();
            return;
        }

        if (this.operation !== null) {
            this.calculate();
        }

        this.operation = operation;
        this.previousOperand = this.currentOperand;
        this.waitingForNewOperand = true;
        this.updateDisplay();
    }

    inputScientific(functionName) {
        let result;
        const currentValue = parseFloat(this.currentOperand);

        switch (functionName) {
            case 'sin':
                result = Math.sin(currentValue * Math.PI / 180);
                break;
            case 'cos':
                result = Math.cos(currentValue * Math.PI / 180);
                break;
            case 'tan':
                result = Math.tan(currentValue * Math.PI / 180);
                break;
            case 'log':
                result = Math.log10(currentValue);
                break;
            case 'ln':
                result = Math.log(currentValue);
                break;
            case 'sqrt':
                result = Math.sqrt(currentValue);
                break;
            case 'power':
                result = Math.pow(currentValue, 2);
                break;
            case 'power-y':
                this.inputOperation('^');
                return;
            case 'factorial':
                result = this.factorial(currentValue);
                break;
            case 'pi':
                result = Math.PI;
                break;
            case 'e':
                result = Math.E;
                break;
            case 'ans':
                result = this.lastAnswer;
                break;
            default:
                return;
        }

        this.addToHistory(`${functionName}(${currentValue}) = ${result}`);
        this.currentOperand = result.toString();
        this.updateDisplay();
    }

    inputMemory(action) {
        const currentValue = parseFloat(this.currentOperand);

        switch (action) {
            case 'mc':
                this.memory = 0;
                break;
            case 'mr':
                this.currentOperand = this.memory.toString();
                this.updateDisplay();
                break;
            case 'm-plus':
                this.memory += currentValue;
                break;
            case 'm-minus':
                this.memory -= currentValue;
                break;
        }
    }

    inputDecimal() {
        if (this.waitingForNewOperand) {
            this.currentOperand = '0.';
            this.waitingForNewOperand = false;
        } else if (this.currentOperand.indexOf('.') === -1) {
            this.currentOperand += '.';
        }
        this.updateDisplay();
    }

    inputParenthesis(parenthesis) {
        if (this.waitingForNewOperand) {
            this.currentOperand = parenthesis;
            this.waitingForNewOperand = false;
        } else {
            this.currentOperand += parenthesis;
        }
        this.updateDisplay();
    }

    calculate() {
        if (this.operation === null || this.waitingForNewOperand) {
            return;
        }

        const prev = parseFloat(this.previousOperand);
        const current = parseFloat(this.currentOperand);
        let result;

        switch (this.operation) {
            case '+':
                result = prev + current;
                break;
            case '-':
                result = prev - current;
                break;
            case '×':
                result = prev * current;
                break;
            case '÷':
                result = prev / current;
                break;
            case '%':
                result = prev % current;
                break;
            case '^':
                result = Math.pow(prev, current);
                break;
            default:
                return;
        }

        this.addToHistory(`${prev} ${this.operation} ${current} = ${result}`);
        this.lastAnswer = result;
        this.currentOperand = result.toString();
        this.operation = null;
        this.previousOperand = '';
        this.waitingForNewOperand = true;
        this.updateDisplay();
    }

    clear() {
        this.currentOperand = '0';
        this.previousOperand = '';
        this.operation = null;
        this.waitingForNewOperand = false;
        this.updateDisplay();
    }

    delete() {
        if (this.currentOperand.length > 1) {
            this.currentOperand = this.currentOperand.slice(0, -1);
        } else {
            this.currentOperand = '0';
        }
        this.updateDisplay();
    }

    factorial(n) {
        if (n < 0) throw new Error('Factorial of negative number');
        if (n === 0 || n === 1) return 1;
        
        let result = 1;
        for (let i = 2; i <= n; i++) {
            result *= i;
        }
        return result;
    }

    addToHistory(entry) {
        this.history.unshift(entry);
        if (this.history.length > 10) {
            this.history.pop();
        }
        this.updateHistory();
    }

    clearHistory() {
        this.history = [];
        this.updateHistory();
    }

    updateHistory() {
        this.historyListElement.innerHTML = this.history
            .map(entry => `<div class="history-item">${entry}</div>`)
            .join('');
    }

    updateDisplay() {
        this.currentOperandElement.textContent = this.currentOperand;
        
        if (this.operation !== null) {
            this.previousOperandElement.textContent = `${this.previousOperand} ${this.operation}`;
        } else {
            this.previousOperandElement.textContent = this.previousOperand;
        }
    }

    handleKeyboardInput(event) {
        if (event.key >= '0' && event.key <= '9') {
            this.inputNumber(event.key);
        } else if (event.key === '.') {
            this.inputDecimal();
        } else if (event.key === '+' || event.key === '-' || event.key === '*' || event.key === '/') {
            const operations = {
                '+': '+',
                '-': '-',
                '*': '×',
                '/': '÷'
            };
            this.inputOperation(operations[event.key]);
        } else if (event.key === 'Enter' || event.key === '=') {
            event.preventDefault();
            this.calculate();
        } else if (event.key === 'Escape') {
            this.clear();
        } else if (event.key === 'Backspace') {
            this.delete();
        }
    }
}

// Initialize calculator when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    new ScientificCalculator();
});