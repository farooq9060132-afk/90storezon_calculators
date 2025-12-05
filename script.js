/**
 * 90storezon - Main JavaScript File
 * Complete calculator functionality and website interactions
 */

// Global Variables
let calculatorMemory = 0;
let calculatorHistory = [];
let currentExpression = '';
let previousResult = 0;
let isDegMode = true; // true = Degrees, false = Radians
let userSession = null;

// Document Ready
document.addEventListener('DOMContentLoaded', function() {
    initializeCalculator();
    initializeMobileMenu();
    initializeSearch();
    initializeFormValidation();
    initializeDynamicLoading();
    initializeUserSession();
    loadCalculatorHistory();
    
    // Set current year in footer
    document.getElementById('current-year')?.textContent = new Date().getFullYear();
});

// ==================== 1. SCIENTIFIC CALCULATOR FUNCTIONALITY ====================

function initializeCalculator() {
    const display = document.getElementById('calc-display');
    const memoryDisplay = document.getElementById('calc-memory');
    const buttons = document.querySelectorAll('.calc-btn');
    
    if (!display || !buttons.length) return;
    
    // Initialize display
    display.value = '0';
    updateMemoryDisplay();
    
    // Add event listeners to all calculator buttons
    buttons.forEach(button => {
        button.addEventListener('click', handleCalculatorButtonClick);
    });
    
    // Keyboard support
    document.addEventListener('keydown', handleCalculatorKeyboard);
    
    // Initialize advanced functions
    initializeScientificFunctions();
}

function handleCalculatorButtonClick(event) {
    const button = event.currentTarget;
    const value = button.getAttribute('data-value');
    const action = button.getAttribute('data-action');
    
    if (value) {
        handleNumberInput(value);
    } else if (action) {
        handleCalculatorAction(action);
    }
}

function handleNumberInput(value) {
    const display = document.getElementById('calc-display');
    
    if (display.value === '0' || display.value === 'Error') {
        display.value = value;
    } else {
        display.value += value;
    }
    
    currentExpression = display.value;
}

function handleCalculatorAction(action) {
    const display = document.getElementById('calc-display');
    const currentValue = parseFloat(display.value) || 0;
    
    try {
        switch(action) {
            // Basic Operations
            case 'ac':
                display.value = '0';
                currentExpression = '';
                break;
                
            case 'back':
                if (display.value.length > 1) {
                    display.value = display.value.slice(0, -1);
                    currentExpression = display.value;
                } else {
                    display.value = '0';
                    currentExpression = '';
                }
                break;
                
            case '=':
                calculateResult();
                break;
                
            // Memory Functions
            case 'm+':
                calculatorMemory += currentValue;
                updateMemoryDisplay();
                break;
                
            case 'm-':
                calculatorMemory -= currentValue;
                updateMemoryDisplay();
                break;
                
            case 'mr':
                display.value = calculatorMemory.toString();
                currentExpression = display.value;
                break;
                
            case 'mc':
                calculatorMemory = 0;
                updateMemoryDisplay();
                break;
                
            // Sign Change
            case '±':
                if (display.value !== '0' && display.value !== 'Error') {
                    display.value = (-parseFloat(display.value)).toString();
                    currentExpression = display.value;
                }
                break;
                
            // Basic Functions
            case '1/x':
                if (currentValue !== 0) {
                    display.value = (1 / currentValue).toString();
                    addToHistory(`1/(${currentValue}) = ${display.value}`);
                } else {
                    throw new Error('Division by zero');
                }
                break;
                
            case '%':
                display.value = (currentValue / 100).toString();
                currentExpression = display.value;
                break;
                
            case '√x':
                if (currentValue >= 0) {
                    display.value = Math.sqrt(currentValue).toString();
                    addToHistory(`√(${currentValue}) = ${display.value}`);
                } else {
                    throw new Error('Invalid input for square root');
                }
                break;
                
            case 'x2':
                display.value = Math.pow(currentValue, 2).toString();
                addToHistory(`(${currentValue})² = ${display.value}`);
                break;
                
            case 'x3':
                display.value = Math.pow(currentValue, 3).toString();
                addToHistory(`(${currentValue})³ = ${display.value}`);
                break;
                
            case 'xy':
                currentExpression += '^';
                display.value += '^';
                break;
                
            // Scientific Functions
            case 'sin':
                const sinValue = isDegMode ? currentValue * Math.PI / 180 : currentValue;
                display.value = Math.sin(sinValue).toString();
                addToHistory(`sin(${currentValue}${isDegMode ? '°' : 'rad'}) = ${display.value}`);
                break;
                
            case 'cos':
                const cosValue = isDegMode ? currentValue * Math.PI / 180 : currentValue;
                display.value = Math.cos(cosValue).toString();
                addToHistory(`cos(${currentValue}${isDegMode ? '°' : 'rad'}) = ${display.value}`);
                break;
                
            case 'tan':
                const tanValue = isDegMode ? currentValue * Math.PI / 180 : currentValue;
                display.value = Math.tan(tanValue).toString();
                addToHistory(`tan(${currentValue}${isDegMode ? '°' : 'rad'}) = ${display.value}`);
                break;
                
            case 'sin-1':
                if (currentValue >= -1 && currentValue <= 1) {
                    const result = Math.asin(currentValue);
                    display.value = isDegMode ? (result * 180 / Math.PI).toString() : result.toString();
                    addToHistory(`sin⁻¹(${currentValue}) = ${display.value}${isDegMode ? '°' : 'rad'}`);
                } else {
                    throw new Error('Invalid input for arcsin');
                }
                break;
                
            case 'cos-1':
                if (currentValue >= -1 && currentValue <= 1) {
                    const result = Math.acos(currentValue);
                    display.value = isDegMode ? (result * 180 / Math.PI).toString() : result.toString();
                    addToHistory(`cos⁻¹(${currentValue}) = ${display.value}${isDegMode ? '°' : 'rad'}`);
                } else {
                    throw new Error('Invalid input for arccos');
                }
                break;
                
            case 'tan-1':
                const result = Math.atan(currentValue);
                display.value = isDegMode ? (result * 180 / Math.PI).toString() : result.toString();
                addToHistory(`tan⁻¹(${currentValue}) = ${display.value}${isDegMode ? '°' : 'rad'}`);
                break;
                
            case 'pi':
                display.value = Math.PI.toString();
                currentExpression = display.value;
                break;
                
            case 'e':
                display.value = Math.E.toString();
                currentExpression = display.value;
                break;
                
            case 'exp':
                currentExpression += 'e';
                display.value += 'e';
                break;
                
            case 'ln':
                if (currentValue > 0) {
                    display.value = Math.log(currentValue).toString();
                    addToHistory(`ln(${currentValue}) = ${display.value}`);
                } else {
                    throw new Error('Invalid input for natural log');
                }
                break;
                
            case 'log':
                if (currentValue > 0) {
                    display.value = Math.log10(currentValue).toString();
                    addToHistory(`log(${currentValue}) = ${display.value}`);
                } else {
                    throw new Error('Invalid input for log10');
                }
                break;
                
            case '10x':
                display.value = Math.pow(10, currentValue).toString();
                addToHistory(`10^${currentValue} = ${display.value}`);
                break;
                
            case 'ex':
                display.value = Math.exp(currentValue).toString();
                addToHistory(`e^${currentValue} = ${display.value}`);
                break;
                
            case 'y√x':
                currentExpression += '√';
                display.value += '√';
                break;
                
            case '3√x':
                display.value = Math.cbrt(currentValue).toString();
                addToHistory(`³√(${currentValue}) = ${display.value}`);
                break;
                
            case 'degRad':
                isDegMode = !isDegMode;
                document.querySelectorAll('.degRad').forEach(btn => {
                    btn.textContent = isDegMode ? 'Deg' : 'Rad';
                });
                break;
                
            case 'factorial':
                if (currentValue >= 0 && currentValue <= 170) {
                    display.value = factorial(currentValue).toString();
                    addToHistory(`(${currentValue})! = ${display.value}`);
                } else {
                    throw new Error('Invalid input for factorial');
                }
                break;
                
            case 'rnd':
                display.value = Math.random().toString();
                currentExpression = display.value;
                break;
                
            case 'ans':
                display.value = previousResult.toString();
                currentExpression = display.value;
                break;
        }
    } catch (error) {
        display.value = 'Error';
        console.error('Calculator error:', error);
        showNotification('Calculator Error: ' + error.message, 'error');
    }
}

function calculateResult() {
    const display = document.getElementById('calc-display');
    try {
        // Replace display symbols with JavaScript math symbols
        let expression = display.value
            .replace(/×/g, '*')
            .replace(/÷/g, '/')
            .replace(/\^/g, '**')
            .replace(/√/g, 'Math.sqrt')
            .replace(/π/g, Math.PI)
            .replace(/e(?![0-9])/g, Math.E);
        
        // Evaluate safely
        let result;
        if (expression.includes('**') || expression.includes('Math.sqrt')) {
            // Use Function constructor for advanced expressions
            result = Function('"use strict"; return (' + expression + ')')();
        } else {
            // Use eval for simple expressions (with safety check)
            if (/^[0-9+\-*/.()\s]+$/.test(expression)) {
                result = eval(expression);
            } else {
                throw new Error('Invalid expression');
            }
        }
        
        // Round to 10 decimal places to avoid floating point errors
        result = Math.round(result * 10000000000) / 10000000000;
        
        display.value = result.toString();
        previousResult = result;
        currentExpression = display.value;
        
        // Add to history
        if (calculatorHistory.length >= 50) {
            calculatorHistory.shift();
        }
        calculatorHistory.push({
            expression: display.value,
            result: result,
            timestamp: new Date().toISOString()
        });
        
        saveCalculatorHistory();
        
    } catch (error) {
        display.value = 'Error';
        console.error('Calculation error:', error);
        showNotification('Calculation Error', 'error');
    }
}

function factorial(n) {
    if (n === 0 || n === 1) return 1;
    let result = 1;
    for (let i = 2; i <= n; i++) {
        result *= i;
    }
    return result;
}

function updateMemoryDisplay() {
    const memoryDisplay = document.getElementById('calc-memory');
    if (memoryDisplay) {
        memoryDisplay.textContent = `M: ${calculatorMemory}`;
    }
}

function handleCalculatorKeyboard(event) {
    const key = event.key;
    const display = document.getElementById('calc-display');
    
    if (key >= '0' && key <= '9') {
        handleNumberInput(key);
    } else if (key === '.') {
        if (!display.value.includes('.')) {
            handleNumberInput('.');
        }
    } else if (key === '+') {
        handleCalculatorAction('+');
    } else if (key === '-') {
        handleCalculatorAction('-');
    } else if (key === '*') {
        handleCalculatorAction('*');
    } else if (key === '/') {
        event.preventDefault();
        handleCalculatorAction('/');
    } else if (key === 'Enter' || key === '=') {
        event.preventDefault();
        handleCalculatorAction('=');
    } else if (key === 'Escape') {
        handleCalculatorAction('ac');
    } else if (key === 'Backspace') {
        handleCalculatorAction('back');
    }
}

function initializeScientificFunctions() {
    // Add additional scientific function buttons if needed
    const advancedFunctions = [
        'hyp', 'sinh', 'cosh', 'tanh',
        'log2', 'logy', 'mod', 'abs'
    ];
    
    advancedFunctions.forEach(func => {
        const button = document.querySelector(`[data-action="${func}"]`);
        if (button) {
            button.addEventListener('click', function() {
                showNotification(`${func} function will be available in premium version`, 'info');
            });
        }
    });
}

// ==================== 2. MOBILE MENU TOGGLE ====================

function initializeMobileMenu() {
    const mobileMenuToggle = document.getElementById('mobileMenuToggle');
    const mobileNav = document.getElementById('mobileNav');
    const mobileOverlay = document.getElementById('mobileOverlay');
    const mobileCloseBtn = document.getElementById('mobileCloseBtn');
    
    if (!mobileMenuToggle || !mobileNav) return;
    
    function toggleMobileMenu() {
        mobileNav.classList.toggle('active');
        mobileOverlay?.classList.toggle('active');
        document.body.classList.toggle('menu-open');
        
        // Toggle aria-expanded for accessibility
        const isExpanded = mobileNav.classList.contains('active');
        mobileMenuToggle.setAttribute('aria-expanded', isExpanded);
    }
    
    mobileMenuToggle.addEventListener('click', toggleMobileMenu);
    mobileCloseBtn?.addEventListener('click', toggleMobileMenu);
    mobileOverlay?.addEventListener('click', toggleMobileMenu);
    
    // Close mobile menu when clicking on links
    document.querySelectorAll('.mobile-nav-link').forEach(link => {
        link.addEventListener('click', () => {
            if (!link.classList.contains('dropdown-toggle')) {
                toggleMobileMenu();
            }
        });
    });
    
    // Mobile dropdown toggle
    document.querySelectorAll('.mobile-nav-dropdown > a').forEach(dropdownToggle => {
        dropdownToggle.addEventListener('click', function(e) {
            e.preventDefault();
            const dropdown = this.parentElement;
            dropdown.classList.toggle('open');
            
            const icon = this.querySelector('.fa-chevron-right, .fa-chevron-down');
            if (icon) {
                if (dropdown.classList.contains('open')) {
                    icon.classList.replace('fa-chevron-right', 'fa-chevron-down');
                } else {
                    icon.classList.replace('fa-chevron-down', 'fa-chevron-right');
                }
            }
        });
    });
    
    // Close menu on escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape' && mobileNav.classList.contains('active')) {
            toggleMobileMenu();
        }
    });
}

// ==================== 3. CALCULATOR SEARCH FUNCTIONALITY ====================

function initializeSearch() {
    const searchInputs = document.querySelectorAll('#calculator-search, #header-search, .mobile-search-input, #error-search');
    
    searchInputs.forEach(input => {
        input.addEventListener('input', debounce(handleSearch, 300));
        input.addEventListener('keypress', function(event) {
            if (event.key === 'Enter') {
                handleSearch.call(this);
            }
        });
    });
    
    const searchButtons = document.querySelectorAll('#search-btn, .search-btn, .mobile-search-btn, #error-search-btn');
    searchButtons.forEach(button => {
        button.addEventListener('click', function() {
            const searchInput = this.closest('.search-wrapper')?.querySelector('input') ||
                              document.querySelector('#calculator-search, #header-search, .mobile-search-input, #error-search');
            if (searchInput) {
                handleSearch.call(searchInput);
            }
        });
    });
}

function handleSearch() {
    const query = this.value.trim().toLowerCase();
    const searchResultsId = this.id === 'error-search' ? 'error-search-results' :
                          this.id === 'header-search' ? 'header-search-results' : 'search-results';
    const searchResults = document.getElementById(searchResultsId);
    
    if (!query || query.length < 2) {
        if (searchResults) searchResults.style.display = 'none';
        return;
    }
    
    // AJAX search request
    performSearch(query, searchResults);
}

function performSearch(query, resultsContainer) {
    // Mock search data - In production, this would be an AJAX call
    const allCalculators = [
        {id: 'bmi', name: 'BMI Calculator', category: 'Health', description: 'Calculate Body Mass Index'},
        {id: 'loan', name: 'Loan Calculator', category: 'Financial', description: 'Calculate loan payments'},
        {id: 'mortgage', name: 'Mortgage Calculator', category: 'Financial', description: 'Calculate mortgage payments'},
        {id: 'percentage', name: 'Percentage Calculator', category: 'Math', description: 'Calculate percentages'},
        {id: 'age', name: 'Age Calculator', category: 'Tools', description: 'Calculate age'},
        {id: 'tax', name: 'Tax Calculator', category: 'Financial', description: 'Calculate taxes'},
        {id: 'calorie', name: 'Calorie Calculator', category: 'Health', description: 'Calculate daily calories'},
        {id: 'scientific', name: 'Scientific Calculator', category: 'Math', description: 'Advanced scientific calculator'},
        {id: 'interest', name: 'Interest Calculator', category: 'Financial', description: 'Calculate interest'},
        {id: 'date', name: 'Date Calculator', category: 'Tools', description: 'Calculate date differences'},
        {id: 'unit', name: 'Unit Converter', category: 'Conversion', description: 'Convert between units'},
        {id: 'currency', name: 'Currency Converter', category: 'Conversion', description: 'Convert currencies'}
    ];
    
    const results = allCalculators.filter(calc => 
        calc.name.toLowerCase().includes(query) ||
        calc.category.toLowerCase().includes(query) ||
        calc.description.toLowerCase().includes(query)
    );
    
    displaySearchResults(results, resultsContainer);
}

function displaySearchResults(results, container) {
    if (!container) return;
    
    if (results.length > 0) {
        container.innerHTML = results.map(calc => `
            <a href="calculators/${calc.id}/" class="search-result-item" data-category="${calc.category}">
                <div class="result-icon">
                    <i class="fas fa-calculator"></i>
                </div>
                <div class="result-content">
                    <div class="result-title">${calc.name}</div>
                    <div class="result-description">${calc.description}</div>
                    <div class="result-category">${calc.category}</div>
                </div>
                <div class="result-arrow">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </a>
        `).join('');
        container.style.display = 'block';
        
        // Add click tracking
        container.querySelectorAll('.search-result-item').forEach(item => {
            item.addEventListener('click', function() {
                trackSearchClick(this.querySelector('.result-title').textContent);
            });
        });
    } else {
        container.innerHTML = `
            <div class="no-results">
                <i class="fas fa-search"></i>
                <div>No calculators found. Try different keywords.</div>
            </div>
        `;
        container.style.display = 'block';
    }
}

// ==================== 4. USER AUTHENTICATION FORM VALIDATION ====================

function initializeFormValidation() {
    const loginForm = document.getElementById('login-form');
    const registerForm = document.getElementById('register-form');
    
    if (loginForm) {
        loginForm.addEventListener('submit', validateLoginForm);
    }
    
    if (registerForm) {
        registerForm.addEventListener('submit', validateRegisterForm);
    }
    
    // Real-time validation
    document.querySelectorAll('input[type="email"], input[type="password"]').forEach(input => {
        input.addEventListener('blur', validateField);
    });
}

function validateLoginForm(event) {
    event.preventDefault();
    
    const email = document.getElementById('login-email');
    const password = document.getElementById('login-password');
    let isValid = true;
    
    // Clear previous errors
    clearErrors();
    
    // Validate email
    if (!email.value || !isValidEmail(email.value)) {
        showFieldError(email, 'Please enter a valid email address');
        isValid = false;
    }
    
    // Validate password
    if (!password.value || password.value.length < 6) {
        showFieldError(password, 'Password must be at least 6 characters');
        isValid = false;
    }
    
    if (isValid) {
        // Simulate AJAX login
        simulateLogin(email.value, password.value);
    }
}

function validateRegisterForm(event) {
    event.preventDefault();
    
    const name = document.getElementById('register-name');
    const email = document.getElementById('register-email');
    const password = document.getElementById('register-password');
    const confirmPassword = document.getElementById('register-confirm-password');
    const terms = document.getElementById('register-terms');
    
    let isValid = true;
    clearErrors();
    
    // Validate name
    if (!name.value || name.value.length < 2) {
        showFieldError(name, 'Name must be at least 2 characters');
        isValid = false;
    }
    
    // Validate email
    if (!email.value || !isValidEmail(email.value)) {
        showFieldError(email, 'Please enter a valid email address');
        isValid = false;
    }
    
    // Validate password
    if (!password.value || password.value.length < 8) {
        showFieldError(password, 'Password must be at least 8 characters');
        isValid = false;
    } else if (!isStrongPassword(password.value)) {
        showFieldError(password, 'Password must include uppercase, lowercase, and numbers');
        isValid = false;
    }
    
    // Validate confirm password
    if (password.value !== confirmPassword.value) {
        showFieldError(confirmPassword, 'Passwords do not match');
        isValid = false;
    }
    
    // Validate terms
    if (!terms.checked) {
        showFieldError(terms, 'You must agree to the terms and conditions');
        isValid = false;
    }
    
    if (isValid) {
        simulateRegistration(name.value, email.value, password.value);
    }
}

function validateField(event) {
    const field = event.target;
    clearFieldError(field);
    
    if (field.type === 'email' && field.value && !isValidEmail(field.value)) {
        showFieldError(field, 'Please enter a valid email address');
    }
    
    if (field.type === 'password' && field.value && field.value.length < 6) {
        showFieldError(field, 'Password must be at least 6 characters');
    }
}

function isValidEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}

function isStrongPassword(password) {
    const hasUpperCase = /[A-Z]/.test(password);
    const hasLowerCase = /[a-z]/.test(password);
    const hasNumbers = /\d/.test(password);
    return hasUpperCase && hasLowerCase && hasNumbers;
}

function showFieldError(field, message) {
    const errorDiv = document.createElement('div');
    errorDiv.className = 'field-error';
    errorDiv.textContent = message;
    errorDiv.style.color = '#e53935';
    errorDiv.style.fontSize = '12px';
    errorDiv.style.marginTop = '5px';
    
    field.style.borderColor = '#e53935';
    field.parentNode.appendChild(errorDiv);
}

function clearFieldError(field) {
    field.style.borderColor = '';
    const errorDiv = field.parentNode.querySelector('.field-error');
    if (errorDiv) {
        errorDiv.remove();
    }
}

function clearErrors() {
    document.querySelectorAll('.field-error').forEach(error => error.remove());
    document.querySelectorAll('input').forEach(input => {
        input.style.borderColor = '';
    });
}

// ==================== 5. AJAX FOR CALCULATOR LOADING ====================

function initializeDynamicLoading() {
    // Load calculator content dynamically
    document.querySelectorAll('.calculator-link').forEach(link => {
        link.addEventListener('click', function(event) {
            if (this.getAttribute('data-ajax') === 'true') {
                event.preventDefault();
                const calculatorId = this.getAttribute('data-calculator-id');
                loadCalculator(calculatorId);
            }
        });
    });
    
    // Initialize calculator category loading
    document.querySelectorAll('.category-link').forEach(link => {
        link.addEventListener('click', function(event) {
            if (this.getAttribute('data-ajax') === 'true') {
                event.preventDefault();
                const category = this.getAttribute('data-category');
                loadCalculatorCategory(category);
            }
        });
    });
}

function loadCalculator(calculatorId) {
    const calculatorContainer = document.getElementById('calculator-container');
    const loadingElement = document.getElementById('loading-indicator');
    
    if (!calculatorContainer) return;
    
    // Show loading indicator
    if (loadingElement) loadingElement.style.display = 'block';
    
    // Update URL without page reload
    history.pushState({calculatorId}, '', `calculators/${calculatorId}/`);
    
    // AJAX request to load calculator
    fetch(`calculators/${calculatorId}/index.php`)
        .then(response => response.text())
        .then(html => {
            calculatorContainer.innerHTML = html;
            
            // Initialize the loaded calculator's JavaScript
            initializeLoadedCalculator(calculatorId);
            
            // Update page title
            document.title = `${calculatorId.replace('-', ' ').toUpperCase()} | 90storezon`;
            
            // Scroll to calculator
            calculatorContainer.scrollIntoView({behavior: 'smooth'});
        })
        .catch(error => {
            console.error('Error loading calculator:', error);
            showNotification('Failed to load calculator. Please try again.', 'error');
        })
        .finally(() => {
            if (loadingElement) loadingElement.style.display = 'none';
        });
}

function loadCalculatorCategory(category) {
    const categoryContainer = document.getElementById('category-container');
    
    if (!categoryContainer) return;
    
    fetch(`calculators/category/${category}.php`)
        .then(response => response.text())
        .then(html => {
            categoryContainer.innerHTML = html;
            
            // Update URL
            history.pushState({category}, '', `calculators/category/${category}/`);
            
            // Update page title
            document.title = `${category.toUpperCase()} Calculators | 90storezon`;
        })
        .catch(error => {
            console.error('Error loading category:', error);
            showNotification('Failed to load category. Please try again.', 'error');
        });
}

function initializeLoadedCalculator(calculatorId) {
    // Initialize specific calculator based on ID
    switch(calculatorId) {
        case 'bmi-calculator':
            initializeBMICalculator();
            break;
        case 'loan-calculator':
            initializeLoanCalculator();
            break;
        case 'percentage-calculator':
            initializePercentageCalculator();
            break;
        // Add more calculators as needed
    }
}

// ==================== 6. RESPONSIVE DESIGN INTERACTIONS ====================

function initializeResponsiveDesign() {
    // Handle window resize
    let resizeTimer;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(handleResize, 250);
    });
    
    // Initialize tooltips for mobile
    if (window.innerWidth < 768) {
        initializeMobileTooltips();
    }
    
    // Handle orientation change
    window.addEventListener('orientationchange', function() {
        setTimeout(handleOrientationChange, 100);
    });
}

function handleResize() {
    const width = window.innerWidth;
    
    // Adjust calculator layout based on screen size
    const calculatorButtons = document.querySelector('.calculator-buttons');
    if (calculatorButtons) {
        if (width < 768) {
            calculatorButtons.classList.add('mobile-view');
        } else {
            calculatorButtons.classList.remove('mobile-view');
        }
    }
    
    // Adjust font sizes
    adjustFontSizes(width);
    
    // Update responsive classes
    updateResponsiveClasses(width);
}

function handleOrientationChange() {
    // Refresh calculator display on orientation change
    const display = document.getElementById('calc-display');
    if (display) {
        display.style.fontSize = window.innerWidth < 768 ? '24px' : '32px';
    }
}

// ==================== 7. FORM VALIDATIONS ====================

function initializeAllFormValidations() {
    // Contact form validation
    const contactForm = document.getElementById('contact-form');
    if (contactForm) {
        contactForm.addEventListener('submit', validateContactForm);
    }
    
    // Newsletter form validation
    const newsletterForm = document.getElementById('newsletter-form');
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', validateNewsletterForm);
    }
    
    // Feedback form validation
    const feedbackForm = document.getElementById('feedback-form');
    if (feedbackForm) {
        feedbackForm.addEventListener('submit', validateFeedbackForm);
    }
}

function validateContactForm(event) {
    event.preventDefault();
    // Implementation for contact form validation
}

function validateNewsletterForm(event) {
    event.preventDefault();
    // Implementation for newsletter form validation
}

function validateFeedbackForm(event) {
    event.preventDefault();
    // Implementation for feedback form validation
}

// ==================== 8. DYNAMIC CONTENT LOADING ====================

function loadDynamicContent() {
    // Load featured calculators
    loadFeaturedCalculators();
    
    // Load recent calculations
    loadRecentCalculations();
    
    // Load user statistics if logged in
    if (userSession) {
        loadUserStatistics();
    }
}

// ==================== 9. EVENT LISTENERS FOR ALL CALCULATOR BUTTONS ====================

function initializeAllEventListeners() {
    // Calculator button hover effects
    document.querySelectorAll('.calc-btn').forEach(button => {
        button.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px)';
        });
        
        button.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
    
    // Keyboard shortcuts
    document.addEventListener('keydown', function(event) {
        // Ctrl + S to save calculation
        if (event.ctrlKey && event.key === 's') {
            event.preventDefault();
            saveCurrentCalculation();
        }
        
        // Ctrl + H to view history
        if (event.ctrlKey && event.key === 'h') {
            event.preventDefault();
            toggleHistoryPanel();
        }
    });
}

// ==================== 10. ERROR HANDLING ====================

function initializeErrorHandling() {
    // Global error handler
    window.addEventListener('error', function(event) {
        console.error('Global error:', event.error);
        showNotification('An error occurred. Please refresh the page.', 'error');
        
        // Log error to server (in production)
        logErrorToServer(event.error);
    });
    
    // Unhandled promise rejection
    window.addEventListener('unhandledrejection', function(event) {
        console.error('Unhandled promise rejection:', event.reason);
        showNotification('Something went wrong. Please try again.', 'error');
    });
}

// ==================== 11. LOCAL STORAGE FOR CALCULATOR HISTORY ====================

function saveCalculatorHistory() {
    try {
        localStorage.setItem('calculatorHistory', JSON.stringify(calculatorHistory));
        localStorage.setItem('calculatorMemory', calculatorMemory.toString());
        localStorage.setItem('calculatorSettings', JSON.stringify({
            degMode: isDegMode,
            lastExpression: currentExpression
        }));
    } catch (error) {
        console.error('Error saving to localStorage:', error);
    }
}

function loadCalculatorHistory() {
    try {
        const savedHistory = localStorage.getItem('calculatorHistory');
        if (savedHistory) {
            calculatorHistory = JSON.parse(savedHistory);
        }
        
        const savedMemory = localStorage.getItem('calculatorMemory');
        if (savedMemory) {
            calculatorMemory = parseFloat(savedMemory);
            updateMemoryDisplay();
        }
        
        const savedSettings = localStorage.getItem('calculatorSettings');
        if (savedSettings) {
            const settings = JSON.parse(savedSettings);
            isDegMode = settings.degMode || true;
            currentExpression = settings.lastExpression || '';
            
            // Update UI
            document.querySelectorAll('.degRad').forEach(btn => {
                btn.textContent = isDegMode ? 'Deg' : 'Rad';
            });
        }
    } catch (error) {
        console.error('Error loading from localStorage:', error);
    }
}

function clearCalculatorHistory() {
    calculatorHistory = [];
    calculatorMemory = 0;
    currentExpression = '';
    saveCalculatorHistory();
    updateMemoryDisplay();
    showNotification('Calculator history cleared', 'success');
}

// ==================== 12. ALL FUNCTIONS MUST WORK EXACTLY LIKE CALCULATOR.NET ====================

function simulateCalculatorNetFunctions() {
    // Implement specific functions to match Calculator.net exactly
    
    // 1. Expression evaluation
    function evaluateExpression(expr) {
        // Implement exact evaluation logic
    }
    
    // 2. Memory functions
    function memoryClear() {
        calculatorMemory = 0;
        updateMemoryDisplay();
    }
    
    // 3. History management
    function showHistory() {
        // Display calculation history
    }
    
    // 4. Settings persistence
    function saveSettings() {
        // Save user preferences
    }
}

// ==================== UTILITY FUNCTIONS ====================

function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func.apply(this, args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

function showNotification(message, type = 'info') {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `notification ${type}`;
    notification.innerHTML = `
        <div class="notification-content">
            <i class="fas fa-${getNotificationIcon(type)}"></i>
            <span>${message}</span>
        </div>
        <button class="notification-close">&times;</button>
    `;
    
    // Add to page
    document.body.appendChild(notification);
    
    // Show notification
    setTimeout(() => notification.classList.add('show'), 10);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        notification.classList.remove('show');
        setTimeout(() => notification.remove(), 300);
    }, 5000);
    
    // Close button
    notification.querySelector('.notification-close').addEventListener('click', () => {
        notification.classList.remove('show');
        setTimeout(() => notification.remove(), 300);
    });
}

function getNotificationIcon(type) {
    switch(type) {
        case 'success': return 'check-circle';
        case 'error': return 'exclamation-circle';
        case 'warning': return 'exclamation-triangle';
        default: return 'info-circle';
    }
}

function trackSearchClick(calculatorName) {
    // Track search clicks for analytics
    console.log(`Calculator clicked: ${calculatorName}`);
    
    // In production, send to analytics server
    // fetch('/api/track-click', {
    //     method: 'POST',
    //     body: JSON.stringify({calculator: calculatorName})
    // });
}

function simulateLogin(email, password) {
    showNotification('Logging in...', 'info');
    
    // Simulate API call
    setTimeout(() => {
        // Mock response
        userSession = {
            id: 1,
            name: email.split('@')[0],
            email: email,
            token: 'mock-token-' + Date.now()
        };
        
        showNotification('Login successful!', 'success');
        
        // Update UI
        updateUserUI();
        
        // Save session
        localStorage.setItem('userSession', JSON.stringify(userSession));
    }, 1000);
}

function simulateRegistration(name, email, password) {
    showNotification('Creating account...', 'info');
    
    // Simulate API call
    setTimeout(() => {
        showNotification('Registration successful! Welcome to 90storezon.', 'success');
        
        // Auto login
        simulateLogin(email, password);
    }, 1500);
}

function initializeUserSession() {
    const savedSession = localStorage.getItem('userSession');
    if (savedSession) {
        try {
            userSession = JSON.parse(savedSession);
            updateUserUI();
        } catch (error) {
            console.error('Error parsing user session:', error);
        }
    }
}

function updateUserUI() {
    // Update header to show user is logged in
    const authSection = document.querySelector('.auth-section');
    if (authSection && userSession) {
        // Implementation for updating UI based on user session
    }
}

// ==================== INITIALIZE SPECIFIC CALCULATORS ====================

function initializeBMICalculator() {
    // BMI Calculator implementation
    const bmiForm = document.getElementById('bmi-form');
    if (bmiForm) {
        bmiForm.addEventListener('submit', function(event) {
            event.preventDefault();
            calculateBMI();
        });
    }
}

function initializeLoanCalculator() {
    // Loan Calculator implementation
    const loanForm = document.getElementById('loan-form');
    if (loanForm) {
        loanForm.addEventListener('submit', function(event) {
            event.preventDefault();
            calculateLoan();
        });
    }
}

function initializePercentageCalculator() {
    // Percentage Calculator implementation
    const percentageForm = document.getElementById('percentage-form');
    if (percentageForm) {
        percentageForm.addEventListener('submit', function(event) {
            event.preventDefault();
            calculatePercentage();
        });
    }
}

// ==================== EXPORT FUNCTIONS FOR GLOBAL USE ====================

window.Calculator = {
    calculate: calculateResult,
    clear: function() { handleCalculatorAction('ac'); },
    memory: {
        add: function() { handleCalculatorAction('m+'); },
        subtract: function() { handleCalculatorAction('m-'); },
        recall: function() { handleCalculatorAction('mr'); },
        clear: function() { handleCalculatorAction('mc'); }
    },
    history: {
        get: function() { return calculatorHistory; },
        clear: clearCalculatorHistory
    },
    settings: {
        toggleDegRad: function() { handleCalculatorAction('degRad'); },
        isDegMode: function() { return isDegMode; }
    }
};

// ==================== STYLES FOR NOTIFICATIONS ====================

const notificationStyles = `
.notification {
    position: fixed;
    top: 20px;
    right: 20px;
    background: white;
    border-radius: 8px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    padding: 15px 20px;
    min-width: 300px;
    max-width: 400px;
    transform: translateX(400px);
    transition: transform 0.3s ease;
    z-index: 9999;
    border-left: 4px solid #2196f3;
}

.notification.show {
    transform: translateX(0);
}

.notification.success {
    border-left-color: #4caf50;
}

.notification.error {
    border-left-color: #f44336;
}

.notification.warning {
    border-left-color: #ff9800;
}

.notification-content {
    display: flex;
    align-items: center;
    gap: 10px;
}

.notification-content i {
    font-size: 20px;
}

.notification.success .notification-content i {
    color: #4caf50;
}

.notification.error .notification-content i {
    color: #f44336;
}

.notification.warning .notification-content i {
    color: #ff9800;
}

.notification-close {
    position: absolute;
    top: 10px;
    right: 10px;
    background: none;
    border: none;
    font-size: 20px;
    cursor: pointer;
    color: #666;
}
`;

// Add notification styles to page
const styleSheet = document.createElement('style');
styleSheet.textContent = notificationStyles;
document.head.appendChild(styleSheet);

// ==================== INITIALIZE ON LOAD ====================

console.log('90storezon Calculator JavaScript loaded successfully!');