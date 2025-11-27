// script.js - 90storezon Main JavaScript File

// DOM Content Loaded
document.addEventListener('DOMContentLoaded', function() {
    initializeTheme();
    initializeMobileMenu();
    initializeSearch();
    initializeConverters();
    initializeQuickButtons();
});

// Theme Management
function initializeTheme() {
    const themeToggle = document.getElementById('themeToggle');
    const mobileThemeToggle = document.getElementById('mobileThemeToggle');
    const savedTheme = localStorage.getItem('theme') || 'light';
    
    // Set initial theme
    setTheme(savedTheme);
    
    // Desktop theme toggle
    if (themeToggle) {
        themeToggle.addEventListener('click', toggleTheme);
    }
    
    // Mobile theme toggle
    if (mobileThemeToggle) {
        mobileThemeToggle.addEventListener('click', toggleTheme);
    }
}

function setTheme(theme) {
    document.documentElement.setAttribute('data-theme', theme);
    localStorage.setItem('theme', theme);
    
    // Update toggle button text
    const mobileToggle = document.getElementById('mobileThemeToggle');
    if (mobileToggle) {
        const icon = mobileToggle.querySelector('svg');
        const text = mobileToggle.querySelector('span');
        if (text) {
            text.textContent = theme === 'dark' ? 'Light Mode' : 'Dark Mode';
        }
    }
}

function toggleTheme() {
    const currentTheme = document.documentElement.getAttribute('data-theme');
    const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
    setTheme(newTheme);
}

// Mobile Menu Management
function initializeMobileMenu() {
    const mobileMenuToggle = document.getElementById('mobileMenuToggle');
    const mobileNavClose = document.getElementById('mobileNavClose');
    const mobileNav = document.getElementById('mobileNav');
    const navOverlay = document.getElementById('navOverlay');
    
    if (mobileMenuToggle) {
        mobileMenuToggle.addEventListener('click', function() {
            mobileNav.classList.add('active');
            document.body.style.overflow = 'hidden';
        });
    }
    
    if (mobileNavClose) {
        mobileNavClose.addEventListener('click', closeMobileMenu);
    }
    
    if (navOverlay) {
        navOverlay.addEventListener('click', closeMobileMenu);
    }
    
    // Close mobile menu on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeMobileMenu();
        }
    });
}

function closeMobileMenu() {
    const mobileNav = document.getElementById('mobileNav');
    if (mobileNav) {
        mobileNav.classList.remove('active');
        document.body.style.overflow = '';
    }
}

// Search Functionality
function initializeSearch() {
    const searchBtn = document.getElementById('searchBtn');
    const mobileSearchBtn = document.getElementById('mobileSearchBtn');
    const searchInput = document.getElementById('searchInput');
    const mobileSearchInput = document.getElementById('mobileSearchInput');
    
    // Desktop search
    if (searchBtn && searchInput) {
        searchBtn.addEventListener('click', performSearch);
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                performSearch();
            }
        });
    }
    
    // Mobile search
    if (mobileSearchBtn && mobileSearchInput) {
        mobileSearchBtn.addEventListener('click', performMobileSearch);
        mobileSearchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                performMobileSearch();
            }
        });
    }
}

function performSearch() {
    const searchInput = document.getElementById('searchInput');
    if (searchInput && searchInput.value.trim()) {
        const searchTerm = searchInput.value.trim().toLowerCase();
        redirectToCalculator(searchTerm);
    }
}

function performMobileSearch() {
    const mobileSearchInput = document.getElementById('mobileSearchInput');
    if (mobileSearchInput && mobileSearchInput.value.trim()) {
        const searchTerm = mobileSearchInput.value.trim().toLowerCase();
        redirectToCalculator(searchTerm);
        closeMobileMenu();
    }
}

function redirectToCalculator(searchTerm) {
    // Map search terms to specific calculator pages
    const calculatorMap = {
        'unit': 'calculator.php',
        'length': 'calculator.php',
        'weight': 'calculator.php',
        'temperature': 'calculator.php',
        'currency': 'currency-converter.php',
        'bmi': 'bmi-calculator.php',
        'loan': 'loan-calculator.php',
        'scientific': 'scientific-calculator.php',
        'age': 'age-calculator.php',
        'finance': 'finance-calculators.php',
        'health': 'health-calculators.php',
        'math': 'math-calculators.php'
    };
    
    let targetPage = 'calculator.php';
    
    for (const [keyword, page] of Object.entries(calculatorMap)) {
        if (searchTerm.includes(keyword)) {
            targetPage = page;
            break;
        }
    }
    
    window.location.href = `${targetPage}?search=${encodeURIComponent(searchTerm)}`;
}

// Converter Initialization
function initializeConverters() {
    // Main converter
    const convertBtn = document.getElementById('convertBtn');
    if (convertBtn) {
        convertBtn.addEventListener('click', convertUnits);
    }
    
    // Mini converter (homepage)
    const miniConvertBtn = document.getElementById('miniConvertBtn');
    if (miniConvertBtn) {
        miniConvertBtn.addEventListener('click', convertMiniUnits);
    }
    
    // Enter key support for converters
    const inputValue = document.getElementById('inputValue');
    if (inputValue) {
        inputValue.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                convertUnits();
            }
        });
    }
    
    const miniInputValue = document.getElementById('miniInputValue');
    if (miniInputValue) {
        miniInputValue.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                convertMiniUnits();
            }
        });
    }
}

// Quick Buttons Initialization
function initializeQuickButtons() {
    // Quick conversion buttons
    document.querySelectorAll('.quick-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const fromUnit = this.getAttribute('data-from');
            const toUnit = this.getAttribute('data-to');
            
            document.getElementById('fromUnit').value = fromUnit;
            document.getElementById('toUnit').value = toUnit;
            document.getElementById('inputValue').focus();
        });
    });
    
    // Popular conversion buttons (homepage)
    document.querySelectorAll('.popular-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const fromUnit = this.getAttribute('data-from');
            const toUnit = this.getAttribute('data-to');
            
            document.getElementById('miniFromUnit').value = fromUnit;
            document.getElementById('miniToUnit').value = toUnit;
            document.getElementById('miniInputValue').focus();
        });
    });
}

// Unit Conversion Functions
const conversionRates = {
    // Length conversions
    meter: { 
        kilometer: 0.001, 
        centimeter: 100, 
        millimeter: 1000, 
        mile: 0.000621371, 
        yard: 1.09361, 
        foot: 3.28084, 
        inch: 39.3701 
    },
    kilometer: { 
        meter: 1000, 
        centimeter: 100000, 
        millimeter: 1000000,
        mile: 0.621371, 
        yard: 1093.61, 
        foot: 3280.84, 
        inch: 39370.1 
    },
    centimeter: { 
        meter: 0.01, 
        kilometer: 0.00001, 
        millimeter: 10,
        mile: 0.00000621371, 
        yard: 0.0109361, 
        foot: 0.0328084, 
        inch: 0.393701 
    },
    millimeter: { 
        meter: 0.001, 
        kilometer: 0.000001, 
        centimeter: 0.1,
        mile: 6.21371e-7, 
        yard: 0.00109361, 
        foot: 0.00328084, 
        inch: 0.0393701 
    },
    mile: { 
        meter: 1609.34, 
        kilometer: 1.60934, 
        centimeter: 160934,
        yard: 1760, 
        foot: 5280, 
        inch: 63360 
    },
    yard: { 
        meter: 0.9144, 
        kilometer: 0.0009144, 
        centimeter: 91.44,
        mile: 0.000568182, 
        foot: 3, 
        inch: 36 
    },
    foot: { 
        meter: 0.3048, 
        kilometer: 0.0003048, 
        centimeter: 30.48,
        mile: 0.000189394, 
        yard: 0.333333, 
        inch: 12 
    },
    inch: { 
        meter: 0.0254, 
        kilometer: 0.0000254, 
        centimeter: 2.54,
        mile: 0.0000157828, 
        yard: 0.0277778, 
        foot: 0.0833333 
    },
    
    // Weight conversions
    kilogram: { 
        gram: 1000, 
        pound: 2.20462, 
        ounce: 35.274 
    },
    gram: { 
        kilogram: 0.001, 
        pound: 0.00220462, 
        ounce: 0.035274 
    },
    pound: { 
        kilogram: 0.453592, 
        gram: 453.592, 
        ounce: 16 
    },
    ounce: { 
        kilogram: 0.0283495, 
        gram: 28.3495, 
        pound: 0.0625 
    },
    
    // Temperature conversions
    celsius: {
        fahrenheit: function(c) { return (c * 9/5) + 32; },
        kelvin: function(c) { return c + 273.15; }
    },
    fahrenheit: {
        celsius: function(f) { return (f - 32) * 5/9; },
        kelvin: function(f) { return (f - 32) * 5/9 + 273.15; }
    },
    kelvin: {
        celsius: function(k) { return k - 273.15; },
        fahrenheit: function(k) { return (k - 273.15) * 9/5 + 32; }
    }
};

function convertUnits() {
    const fromUnit = document.getElementById('fromUnit').value;
    const toUnit = document.getElementById('toUnit').value;
    const inputValue = parseFloat(document.getElementById('inputValue').value);
    
    if (isNaN(inputValue)) {
        showResult('error', 'Please enter a valid number');
        return;
    }
    
    let result;
    
    // Handle temperature conversions
    if (['celsius', 'fahrenheit', 'kelvin'].includes(fromUnit) && 
        ['celsius', 'fahrenheit', 'kelvin'].includes(toUnit)) {
        
        if (fromUnit === toUnit) {
            result = inputValue;
        } else {
            result = conversionRates[fromUnit][toUnit](inputValue);
        }
        
    } else {
        // Handle regular conversions
        if (fromUnit === toUnit) {
            result = inputValue;
        } else if (conversionRates[fromUnit] && conversionRates[fromUnit][toUnit]) {
            result = inputValue * conversionRates[fromUnit][toUnit];
        } else {
            showResult('error', 'Conversion not supported');
            return;
        }
    }
    
    // Format result
    result = Math.round(result * 100000) / 100000;
    
    showResult('success', `${inputValue} ${fromUnit} = ${result} ${toUnit}`);
}

function convertMiniUnits() {
    const fromUnit = document.getElementById('miniFromUnit').value;
    const toUnit = document.getElementById('miniToUnit').value;
    const inputValue = parseFloat(document.getElementById('miniInputValue').value);
    
    if (isNaN(inputValue)) {
        showMiniResult('error', 'Please enter a valid number');
        return;
    }
    
    let result;
    
    // Handle temperature conversions
    if (['celsius', 'fahrenheit', 'kelvin'].includes(fromUnit) && 
        ['celsius', 'fahrenheit', 'kelvin'].includes(toUnit)) {
        
        if (fromUnit === toUnit) {
            result = inputValue;
        } else {
            result = conversionRates[fromUnit][toUnit](inputValue);
        }
        
    } else {
        // Handle regular conversions
        if (fromUnit === toUnit) {
            result = inputValue;
        } else if (conversionRates[fromUnit] && conversionRates[fromUnit][toUnit]) {
            result = inputValue * conversionRates[fromUnit][toUnit];
        } else {
            showMiniResult('error', 'Conversion not available');
            return;
        }
    }
    
    // Format result
    result = Math.round(result * 1000) / 1000;
    
    showMiniResult('success', `${inputValue} ${fromUnit} = ${result} ${toUnit}`);
}

function showResult(type, message) {
    const resultElement = document.getElementById('result');
    if (resultElement) {
        if (type === 'error') {
            resultElement.innerHTML = `<span class="error-text">${message}</span>`;
        } else {
            resultElement.innerHTML = `<span class="result-text">${message}</span>`;
        }
    }
}

function showMiniResult(type, message) {
    const resultElement = document.getElementById('miniResult');
    if (resultElement) {
        if (type === 'error') {
            resultElement.innerHTML = `<span class="error-text">${message}</span>`;
        } else {
            resultElement.innerHTML = `<span class="result-text"><strong>${message}</strong></span>`;
        }
    }
}

// Utility Functions
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

// Google Analytics (if you add it later)
function trackEvent(category, action, label) {
    if (typeof gtag !== 'undefined') {
        gtag('event', action, {
            'event_category': category,
            'event_label': label
        });
    }
}

// Export for use in other modules (if needed)
if (typeof module !== 'undefined' && module.exports) {
    module.exports = {
        conversionRates,
        convertUnits,
        convertMiniUnits
    };
}