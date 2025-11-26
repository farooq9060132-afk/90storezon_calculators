// script.js - World Calculators Hub Main JavaScript File

// Global variables
let currentTheme = 'light';
let memory = 0;
let calculationHistory = [];

// DOM Content Loaded
document.addEventListener('DOMContentLoaded', function() {
    initializeApp();
    setupEventListeners();
    loadPreferences();
});

// Initialize Application
function initializeApp() {
    console.log('World Calculators Hub initialized');
    
    // Set current year in footer
    const currentYear = new Date().getFullYear();
    const yearElements = document.querySelectorAll('.current-year');
    yearElements.forEach(element => {
        element.textContent = currentYear;
    });
    
    // Initialize theme
    applyTheme(currentTheme);
}

// Setup Event Listeners
function setupEventListeners() {
    // Theme toggle
    const themeToggle = document.getElementById('themeToggle');
    if (themeToggle) {
        themeToggle.addEventListener('click', toggleTheme);
    }
    
    // Mobile menu toggle
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const mobileMenu = document.getElementById('mobileMenu');
    if (mobileMenuBtn && mobileMenu) {
        mobileMenuBtn.addEventListener('click', function() {
            mobileMenu.classList.toggle('active');
        });
    }
    
    // Search functionality
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('input', handleSearch);
    }
    
    // Country card animations
    const countryCards = document.querySelectorAll('.country-card');
    countryCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
        
        card.addEventListener('click', function() {
            this.classList.add('clicked');
            setTimeout(() => {
                this.classList.remove('clicked');
            }, 300);
        });
    });
}

// Theme Management
function toggleTheme() {
    currentTheme = currentTheme === 'light' ? 'dark' : 'light';
    applyTheme(currentTheme);
    savePreference('theme', currentTheme);
}

function applyTheme(theme) {
    document.documentElement.setAttribute('data-theme', theme);
    const themeToggle = document.getElementById('themeToggle');
    if (themeToggle) {
        themeToggle.textContent = theme === 'light' ? '🌙' : '☀️';
    }
}

// Search Functionality
function handleSearch(event) {
    const searchTerm = event.target.value.toLowerCase();
    const countryCards = document.querySelectorAll('.country-card');
    
    countryCards.forEach(card => {
        const countryName = card.querySelector('h3').textContent.toLowerCase();
        const countryDescription = card.querySelector('p').textContent.toLowerCase();
        
        if (countryName.includes(searchTerm) || countryDescription.includes(searchTerm)) {
            card.style.display = 'block';
            card.style.animation = 'fadeIn 0.3s ease-in';
        } else {
            card.style.display = 'none';
        }
    });
}

// Calculator Functions (for calculator.php)
function appendToDisplay(value) {
    const display = document.getElementById('result');
    if (!display) return;
    
    if (display.value === '0' && value !== '.') {
        display.value = value;
    } else {
        display.value += value;
    }
}

function clearDisplay() {
    const display = document.getElementById('result');
    if (display) display.value = '0';
}

function deleteLast() {
    const display = document.getElementById('result');
    if (!display) return;
    
    display.value = display.value.slice(0, -1);
    if (display.value === '') display.value = '0';
}

function calculate() {
    const display = document.getElementById('result');
    if (!display) return;
    
    try {
        const expression = display.value
            .replace(/×/g, '*')
            .replace(/÷/g, '/')
            .replace(/%/g, '/100');
        
        const result = eval(expression);
        
        // Add to history
        addToHistory(display.value, result);
        
        display.value = result;
    } catch (error) {
        display.value = 'Error';
        console.error('Calculation error:', error);
    }
}

// Memory Functions
function addToMemory() {
    const display = document.getElementById('result');
    if (!display) return;
    
    const value = parseFloat(display.value) || 0;
    memory += value;
    showNotification(`Added ${value} to memory`);
}

function recallMemory() {
    const display = document.getElementById('result');
    if (display) display.value = memory;
}

function clearMemory() {
    memory = 0;
    showNotification('Memory cleared');
}

// Scientific Functions
function square() {
    const display = document.getElementById('result');
    if (!display) return;
    
    const value = parseFloat(display.value);
    if (!isNaN(value)) {
        const result = value * value;
        addToHistory(`${value}²`, result);
        display.value = result;
    }
}

function squareRoot() {
    const display = document.getElementById('result');
    if (!display) return;
    
    const value = parseFloat(display.value);
    if (value >= 0 && !isNaN(value)) {
        const result = Math.sqrt(value);
        addToHistory(`√${value}`, result);
        display.value = result;
    } else {
        display.value = 'Error';
    }
}

function power(y) {
    const display = document.getElementById('result');
    if (!display) return;
    
    const value = parseFloat(display.value);
    if (!isNaN(value)) {
        const result = Math.pow(value, y);
        addToHistory(`${value}^${y}`, result);
        display.value = result;
    }
}

// Quick Calculations
function calculatePercentage() {
    const display = document.getElementById('result');
    if (!display) return;
    
    const value = parseFloat(display.value);
    if (!isNaN(value)) {
        const result = value * 0.1;
        addToHistory(`10% of ${value}`, result);
        display.value = result;
    }
}

function calculateDiscount() {
    const display = document.getElementById('result');
    if (!display) return;
    
    const value = parseFloat(display.value);
    if (!isNaN(value)) {
        const result = value * 0.8;
        addToHistory(`20% discount on ${value}`, result);
        display.value = result;
    }
}

function calculateTax() {
    const display = document.getElementById('result');
    if (!display) return;
    
    const value = parseFloat(display.value);
    if (!isNaN(value)) {
        const result = value * 1.15;
        addToHistory(`15% tax on ${value}`, result);
        display.value = result;
    }
}

// Calculation History
function addToHistory(expression, result) {
    calculationHistory.unshift({
        expression: expression,
        result: result,
        timestamp: new Date().toLocaleString()
    });
    
    // Keep only last 10 calculations
    if (calculationHistory.length > 10) {
        calculationHistory.pop();
    }
    
    savePreference('calculationHistory', calculationHistory);
    updateHistoryDisplay();
}

function updateHistoryDisplay() {
    const historyContainer = document.getElementById('calculationHistory');
    if (!historyContainer) return;
    
    historyContainer.innerHTML = '';
    calculationHistory.forEach((item, index) => {
        const historyItem = document.createElement('div');
        historyItem.className = 'history-item';
        historyItem.innerHTML = `
            <div class="history-expression">${item.expression}</div>
            <div class="history-result">= ${item.result}</div>
            <div class="history-time">${item.timestamp}</div>
        `;
        
        historyItem.addEventListener('click', function() {
            const display = document.getElementById('result');
            if (display) display.value = item.result;
        });
        
        historyContainer.appendChild(historyItem);
    });
}

// Utility Functions
function showNotification(message, duration = 3000) {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = 'notification';
    notification.textContent = message;
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        background: var(--primary-color);
        color: white;
        padding: 12px 20px;
        border-radius: 5px;
        z-index: 1000;
        animation: slideInRight 0.3s ease-out;
    `;
    
    document.body.appendChild(notification);
    
    // Remove notification after duration
    setTimeout(() => {
        notification.style.animation = 'slideOutRight 0.3s ease-in';
        setTimeout(() => {
            if (notification.parentNode) {
                notification.parentNode.removeChild(notification);
            }
        }, 300);
    }, duration);
}

// Local Storage Functions
function savePreference(key, value) {
    try {
        localStorage.setItem(`calculatorHub_${key}`, JSON.stringify(value));
    } catch (error) {
        console.error('Error saving preference:', error);
    }
}

function loadPreference(key, defaultValue = null) {
    try {
        const item = localStorage.getItem(`calculatorHub_${key}`);
        return item ? JSON.parse(item) : defaultValue;
    } catch (error) {
        console.error('Error loading preference:', error);
        return defaultValue;
    }
}

function loadPreferences() {
    // Load theme
    const savedTheme = loadPreference('theme', 'light');
    currentTheme = savedTheme;
    applyTheme(currentTheme);
    
    // Load calculation history
    const savedHistory = loadPreference('calculationHistory', []);
    calculationHistory = savedHistory;
    updateHistoryDisplay();
    
    // Load memory
    const savedMemory = loadPreference('memory', 0);
    memory = savedMemory;
}

// Keyboard Support for Calculator
document.addEventListener('keydown', function(event) {
    const key = event.key;
    const display = document.getElementById('result');
    
    if (!display) return;
    
    if ('0123456789'.includes(key)) {
        appendToDisplay(key);
    } else if ('+-*/.'.includes(key)) {
        appendToDisplay(key);
    } else if (key === 'Enter' || key === '=') {
        event.preventDefault();
        calculate();
    } else if (key === 'Escape' || key === 'c' || key === 'C') {
        clearDisplay();
    } else if (key === 'Backspace') {
        event.preventDefault();
        deleteLast();
    } else if (key === 'm' || key === 'M') {
        if (event.ctrlKey) {
            event.preventDefault();
            addToMemory();
        }
    } else if (key === 'r' || key === 'R') {
        if (event.ctrlKey) {
            event.preventDefault();
            recallMemory();
        }
    }
});

// Animation keyframes
const style = document.createElement('style');
style.textContent = `
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    @keyframes slideInRight {
        from { transform: translateX(100%); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }
    
    @keyframes slideOutRight {
        from { transform: translateX(0); opacity: 1; }
        to { transform: translateX(100%); opacity: 0; }
    }
    
    .country-card {
        transition: all 0.3s ease;
    }
    
    .country-card.clicked {
        animation: clickAnimation 0.3s ease;
    }
    
    @keyframes clickAnimation {
        0% { transform: scale(1); }
        50% { transform: scale(0.95); }
        100% { transform: scale(1); }
    }
    
    .history-item {
        transition: background-color 0.2s ease;
        cursor: pointer;
        padding: 8px;
        border-radius: 4px;
        margin-bottom: 5px;
    }
    
    .history-item:hover {
        background-color: var(--hover-color);
    }
`;
document.head.appendChild(style);

// Export functions for global access (if needed)
window.CalculatorHub = {
    appendToDisplay,
    clearDisplay,
    calculate,
    toggleTheme,
    showNotification,
    addToMemory,
    recallMemory,
    clearMemory
};

console.log('script.js loaded successfully');