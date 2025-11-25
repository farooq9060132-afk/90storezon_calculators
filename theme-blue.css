// ===== DARK/LIGHT MODE FUNCTIONALITY =====
class ThemeManager {
    constructor() {
        this.themeToggle = document.getElementById('themeToggle');
        this.init();
    }

    init() {
        const savedTheme = localStorage.getItem('90storezon-theme');
        if (savedTheme === 'dark') {
            this.enableDarkMode();
        }

        if (this.themeToggle) {
            this.themeToggle.addEventListener('click', () => this.toggleTheme());
        }
    }

    toggleTheme() {
        if (document.body.classList.contains('dark-mode')) {
            this.disableDarkMode();
        } else {
            this.enableDarkMode();
        }
    }

    enableDarkMode() {
        document.body.classList.add('dark-mode');
        localStorage.setItem('90storezon-theme', 'dark');
        this.updateThemeIcon('dark');
    }

    disableDarkMode() {
        document.body.classList.remove('dark-mode');
        localStorage.setItem('90storezon-theme', 'light');
        this.updateThemeIcon('light');
    }

    updateThemeIcon(theme) {
        const themeIcon = document.querySelector('.theme-icon');
        if (themeIcon) {
            themeIcon.textContent = theme === 'dark' ? '☀️' : '🌓';
        }
    }
}

// ===== PROFILE DROPDOWN FUNCTIONALITY =====
class ProfileDropdown {
    constructor() {
        this.profileToggle = document.getElementById('profileToggle');
        this.profileDropdown = document.getElementById('profileDropdown');
        this.init();
    }

    init() {
        if (this.profileToggle && this.profileDropdown) {
            this.profileToggle.addEventListener('click', (e) => {
                e.stopPropagation();
                this.toggleDropdown();
            });

            document.addEventListener('click', () => {
                this.closeDropdown();
            });

            this.profileDropdown.addEventListener('click', (e) => {
                e.stopPropagation();
            });
        }
    }

    toggleDropdown() {
        this.profileDropdown.classList.toggle('show');
    }

    closeDropdown() {
        this.profileDropdown.classList.remove('show');
    }
}

// ===== MOBILE MENU FUNCTIONALITY =====
class MobileMenu {
    constructor() {
        this.menuToggle = document.getElementById('menuToggle');
        this.mobileMenu = document.getElementById('mobileMenu');
        this.hamburgerLines = document.querySelectorAll('.hamburger-line');
        this.init();
    }

    init() {
        if (this.menuToggle && this.mobileMenu) {
            this.menuToggle.addEventListener('click', (e) => {
                e.stopPropagation();
                this.toggleMenu();
            });

            const mobileLinks = document.querySelectorAll('.mobile-nav-link');
            mobileLinks.forEach(link => {
                link.addEventListener('click', () => this.closeMenu());
            });

            document.addEventListener('click', (e) => {
                if (!this.mobileMenu.contains(e.target) && !this.menuToggle.contains(e.target)) {
                    this.closeMenu();
                }
            });
        }
    }

    toggleMenu() {
        const isOpening = !this.mobileMenu.classList.contains('show');
        this.mobileMenu.classList.toggle('show');
        this.animateHamburger(isOpening);
    }

    openMenu() {
        this.mobileMenu.classList.add('show');
        this.animateHamburger(true);
    }

    closeMenu() {
        this.mobileMenu.classList.remove('show');
        this.animateHamburger(false);
    }

    animateHamburger(isOpening) {
        if (isOpening) {
            this.hamburgerLines[0].style.transform = 'rotate(45deg) translate(6px, 6px)';
            this.hamburgerLines[1].style.opacity = '0';
            this.hamburgerLines[2].style.transform = 'rotate(-45deg) translate(6px, -6px)';
        } else {
            this.hamburgerLines[0].style.transform = 'none';
            this.hamburgerLines[1].style.opacity = '1';
            this.hamburgerLines[2].style.transform = 'none';
        }
    }
}

// ===== SEARCH FUNCTIONALITY =====
class SearchManager {
    constructor() {
        this.searchInput = document.getElementById('globalSearch');
        this.calculatorLists = document.querySelectorAll('.calculator-list');
        this.categories = document.querySelectorAll('.category');
        this.init();
    }

    init() {
        if (this.searchInput) {
            this.searchInput.addEventListener('input', (e) => this.handleSearch(e.target.value));
            this.searchInput.addEventListener('keypress', (e) => {
                if (e.key === 'Enter') this.performSearch(e.target.value);
            });
        }
    }

    handleSearch(searchTerm) {
        const term = searchTerm.toLowerCase().trim();
        this.filterCalculators(term);
    }

    performSearch(searchTerm) {
        const term = searchTerm.toLowerCase().trim();
        this.filterCalculators(term);
        this.closeMobileMenu();
    }

    filterCalculators(searchTerm) {
        let hasAnyResults = false;

        this.categories.forEach(category => {
            const links = category.querySelectorAll('.calculator-list li');
            let categoryHasResults = false;

            links.forEach(link => {
                const linkText = link.textContent.toLowerCase();
                if (searchTerm === '' || linkText.includes(searchTerm)) {
                    link.style.display = 'block';
                    categoryHasResults = true;
                    if (searchTerm !== '') hasAnyResults = true;
                } else {
                    link.style.display = 'none';
                }
            });

            this.toggleCategoryVisibility(category, categoryHasResults, searchTerm);
        });

        this.handleNoResults(hasAnyResults, searchTerm);
    }

    toggleCategoryVisibility(category, hasResults, searchTerm) {
        const noResultsMsg = category.querySelector('.no-results');
        
        if (searchTerm === '') {
            category.style.display = 'block';
            if (noResultsMsg) noResultsMsg.remove();
        } else if (hasResults) {
            category.style.display = 'block';
            if (noResultsMsg) noResultsMsg.remove();
        } else {
            category.style.display = 'none';
        }
    }

    handleNoResults(hasResults, searchTerm) {
        if (!hasResults && searchTerm !== '') {
            this.showNoResultsMessage();
        } else if (searchTerm === '') {
            this.hideNoResultsMessage();
        }
    }

    showNoResultsMessage() {
        document.querySelectorAll('.no-results').forEach(msg => msg.remove());
        
        const firstCategory = this.categories[0];
        if (firstCategory) {
            firstCategory.style.display = 'block';
            const msg = document.createElement('div');
            msg.className = 'no-results';
            msg.textContent = 'No calculators found matching your search';
            firstCategory.querySelector('.calculator-list').innerHTML = '';
            firstCategory.querySelector('.calculator-list').appendChild(msg);
        }
    }

    hideNoResultsMessage() {
        document.querySelectorAll('.no-results').forEach(msg => msg.remove());
        
        this.categories.forEach(category => {
            category.style.display = 'block';
            const links = category.querySelectorAll('.calculator-list li');
            links.forEach(link => link.style.display = 'block');
        });
    }

    closeMobileMenu() {
        const mobileMenu = document.getElementById('mobileMenu');
        if (mobileMenu && mobileMenu.classList.contains('show')) {
            mobileMenu.classList.remove('show');
            const hamburgerLines = document.querySelectorAll('.hamburger-line');
            hamburgerLines[0].style.transform = 'none';
            hamburgerLines[1].style.opacity = '1';
            hamburgerLines[2].style.transform = 'none';
        }
    }
}

// ===== CALCULATOR FUNCTIONALITY =====
class Calculator {
    constructor() {
        this.currentInput = '0';
        this.previousInput = '';
        this.operation = null;
        this.shouldResetScreen = false;
        this.outputElement = document.getElementById('calculator-output');
        this.init();
    }

    init() {
        this.updateDisplay();
        this.setupEventListeners();
    }

    setupEventListeners() {
        document.querySelectorAll('.calc-btn').forEach(button => {
            button.addEventListener('click', () => {
                if (button.classList.contains('operator')) {
                    this.chooseOperation(button.textContent);
                } else if (button.classList.contains('equals')) {
                    this.calculateResult();
                } else {
                    this.handleButtonClick(button.textContent);
                }
            });
        });

        document.addEventListener('keydown', (e) => this.handleKeyboardInput(e));
    }

    handleButtonClick(value) {
        switch (value) {
            case 'C':
                this.clearCalculator();
                break;
            case '±':
                this.toggleSign();
                break;
            case '%':
                this.calculatePercentage();
                break;
            case '.':
                this.appendDecimal();
                break;
            default:
                if (!isNaN(value)) {
                    this.appendNumber(value);
                }
                break;
        }
    }

    appendNumber(number) {
        if (this.currentInput === '0' || this.shouldResetScreen) {
            this.currentInput = number;
            this.shouldResetScreen = false;
        } else {
            this.currentInput += number;
        }
        this.updateDisplay();
    }

    chooseOperation(op) {
        if (this.currentInput === '') return;
        
        if (this.previousInput !== '' && this.operation !== null) {
            this.calculateResult();
        }
        
        this.operation = this.getOperationSymbol(op);
        this.previousInput = this.currentInput;
        this.shouldResetScreen = true;
    }

    getOperationSymbol(op) {
        const operationMap = {
            '÷': '/',
            '×': '*',
            '−': '-',
            '+': '+'
        };
        return operationMap[op] || op;
    }

    clearCalculator() {
        this.currentInput = '0';
        this.previousInput = '';
        this.operation = null;
        this.shouldResetScreen = false;
        this.updateDisplay();
    }

    deleteLast() {
        if (this.currentInput.length > 1) {
            this.currentInput = this.currentInput.slice(0, -1);
        } else {
            this.currentInput = '0';
        }
        this.updateDisplay();
    }

    appendDecimal() {
        if (this.shouldResetScreen) {
            this.currentInput = '0.';
            this.shouldResetScreen = false;
        } else if (!this.currentInput.includes('.')) {
            this.currentInput += '.';
        }
        this.updateDisplay();
    }

    calculatePercentage() {
        this.currentInput = (parseFloat(this.currentInput) / 100).toString();
        this.updateDisplay();
    }

    toggleSign() {
        this.currentInput = this.currentInput.startsWith('-') 
            ? this.currentInput.slice(1) 
            : '-' + this.currentInput;
        this.updateDisplay();
    }

    calculateResult() {
        if (this.operation === null || this.shouldResetScreen) return;

        const prev = parseFloat(this.previousInput);
        const current = parseFloat(this.currentInput);
        
        if (isNaN(prev) || isNaN(current)) return;

        let result;
        switch (this.operation) {
            case '+':
                result = prev + current;
                break;
            case '-':
                result = prev - current;
                break;
            case '*':
                result = prev * current;
                break;
            case '/':
                result = current !== 0 ? prev / current : 'Error';
                break;
            default:
                return;
        }

        this.currentInput = result.toString();
        this.operation = null;
        this.previousInput = '';
        this.shouldResetScreen = true;
        this.updateDisplay();
    }

    handleKeyboardInput(e) {
        if (e.key >= '0' && e.key <= '9') {
            this.appendNumber(e.key);
        } else if (e.key === '.') {
            this.appendDecimal();
        } else if (['+', '-', '*', '/'].includes(e.key)) {
            this.chooseOperation(e.key);
        } else if (e.key === 'Enter' || e.key === '=') {
            e.preventDefault();
            this.calculateResult();
        } else if (e.key === 'Escape') {
            this.clearCalculator();
        } else if (e.key === 'Backspace') {
            this.deleteLast();
        }
    }

    updateDisplay() {
        if (this.outputElement) {
            this.outputElement.textContent = this.currentInput;
        }
    }
}

// ===== CALCULATOR CARD CLICK HANDLER =====
class CalculatorCards {
    constructor() {
        this.init();
    }

    init() {
        document.addEventListener('click', (e) => {
            if (e.target.matches('.calculator-list a')) {
                this.handleCalculatorClick(e);
            }
        });
    }

    handleCalculatorClick(e) {
        const link = e.target;
        const calculatorName = link.textContent;
        console.log('Calculator clicked:', calculatorName, link.href);
        
        // Additional analytics or tracking can be added here
        // The natural link behavior will handle navigation
    }
}

// ===== MAIN APPLICATION INITIALIZATION =====
class App {
    constructor() {
        this.init();
    }

    init() {
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => this.initializeComponents());
        } else {
            this.initializeComponents();
        }
    }

    initializeComponents() {
        this.themeManager = new ThemeManager();
        this.profileDropdown = new ProfileDropdown();
        this.mobileMenu = new MobileMenu();
        this.searchManager = new SearchManager();
        this.calculator = new Calculator();
        this.calculatorCards = new CalculatorCards();

        this.enableSmoothScrolling();
        console.log('90storezon - All components initialized');
    }

    enableSmoothScrolling() {
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    }
}

// ===== GLOBAL EVENT LISTENERS =====
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', (e) => e.preventDefault());
    });
});

// Initialize the application
const app = new App();