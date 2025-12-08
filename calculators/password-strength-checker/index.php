<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Strength Checker - Secure Your Accounts</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <header class="header">
            <div class="header-content">
                <h1><i class="fas fa-shield-alt"></i> Password Strength Checker</h1>
                <p>Test your password security and get instant feedback</p>
            </div>
            <div class="header-stats">
                <div class="stat">
                    <span class="stat-number" id="totalChecks">0</span>
                    <span class="stat-label">Checks</span>
                </div>
                <div class="stat">
                    <span class="stat-number" id="strongPasswords">0</span>
                    <span class="stat-label">Strong</span>
                </div>
                <div class="stat">
                    <span class="stat-number" id="weakPasswords">0</span>
                    <span class="stat-label">Weak</span>
                </div>
            </div>
        </header>

        <div class="main-content">
            <div class="checker-container">
                <div class="checker-card">
                    <div class="password-input-group">
                        <div class="input-wrapper">
                            <input type="password" id="passwordInput" placeholder="Enter your password to check strength..." autocomplete="off">
                            <button type="button" id="toggleVisibility" class="visibility-toggle">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <button id="checkPassword" class="check-btn">
                            <i class="fas fa-search"></i> Check Strength
                        </button>
                    </div>

                    <div class="strength-meter">
                        <div class="meter-labels">
                            <span>Very Weak</span>
                            <span>Weak</span>
                            <span>Fair</span>
                            <span>Strong</span>
                            <span>Very Strong</span>
                        </div>
                        <div class="meter-bar">
                            <div class="meter-fill" id="meterFill"></div>
                        </div>
                    </div>

                    <div class="strength-result">
                        <div class="result-header">
                            <h3 id="strengthText">Password Strength</h3>
                            <div class="score" id="strengthScore">0%</div>
                        </div>
                        <p id="strengthDescription">Enter a password to check its strength</p>
                    </div>

                    <div class="requirements">
                        <h4>Password Requirements</h4>
                        <div class="requirement-list">
                            <div class="requirement" data-requirement="length">
                                <i class="fas fa-times"></i>
                                <span>At least 8 characters</span>
                            </div>
                            <div class="requirement" data-requirement="lowercase">
                                <i class="fas fa-times"></i>
                                <span>Contains lowercase letters</span>
                            </div>
                            <div class="requirement" data-requirement="uppercase">
                                <i class="fas fa-times"></i>
                                <span>Contains uppercase letters</span>
                            </div>
                            <div class="requirement" data-requirement="numbers">
                                <i class="fas fa-times"></i>
                                <span>Contains numbers</span>
                            </div>
                            <div class="requirement" data-requirement="symbols">
                                <i class="fas fa-times"></i>
                                <span>Contains symbols</span>
                            </div>
                            <div class="requirement" data-requirement="common">
                                <i class="fas fa-times"></i>
                                <span>Not a common password</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="analysis-card">
                    <h3>Password Analysis</h3>
                    <div class="analysis-grid">
                        <div class="analysis-item">
                            <div class="analysis-icon">
                                <i class="fas fa-ruler-horizontal"></i>
                            </div>
                            <div class="analysis-content">
                                <span class="analysis-label">Length</span>
                                <span class="analysis-value" id="lengthValue">0</span>
                            </div>
                        </div>
                        <div class="analysis-item">
                            <div class="analysis-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="analysis-content">
                                <span class="analysis-label">Crack Time</span>
                                <span class="analysis-value" id="crackTime">Instant</span>
                            </div>
                        </div>
                        <div class="analysis-item">
                            <div class="analysis-icon">
                                <i class="fas fa-database"></i>
                            </div>
                            <div class="analysis-content">
                                <span class="analysis-label">Entropy</span>
                                <span class="analysis-value" id="entropyValue">0 bits</span>
                            </div>
                        </div>
                        <div class="analysis-item">
                            <div class="analysis-icon">
                                <i class="fas fa-balance-scale"></i>
                            </div>
                            <div class="analysis-content">
                                <span class="analysis-label">Complexity</span>
                                <span class="analysis-value" id="complexityValue">Low</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <h4>Instant Analysis</h4>
                    <p>Get real-time feedback on password strength as you type</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-shield-check"></i>
                    </div>
                    <h4>Security Metrics</h4>
                    <p>Detailed analysis including entropy and crack time estimates</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-lightbulb"></i>
                    </div>
                    <h4>Smart Suggestions</h4>
                    <p>Receive tips to improve your password security</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-history"></i>
                    </div>
                    <h4>Check History</h4>
                    <p>Track your password checks and improvement over time</p>
                </div>
            </div>

            <div class="password-tips">
                <h3>Password Security Tips</h3>
                <div class="tips-grid">
                    <div class="tip-card">
                        <i class="fas fa-long-arrow-alt-right"></i>
                        <h4>Use Long Passwords</h4>
                        <p>Longer passwords are harder to crack. Aim for at least 12 characters.</p>
                    </div>
                    <div class="tip-card">
                        <i class="fas fa-random"></i>
                        <h4>Mix Character Types</h4>
                        <p>Combine uppercase, lowercase, numbers, and symbols for better security.</p>
                    </div>
                    <div class="tip-card">
                        <i class="fas fa-user-secret"></i>
                        <h4>Avoid Personal Info</h4>
                        <p>Don't use names, birthdays, or common words in your passwords.</p>
                    </div>
                    <div class="tip-card">
                        <i class="fas fa-sync-alt"></i>
                        <h4>Use Unique Passwords</h4>
                        <p>Never reuse passwords across different accounts and services.</p>
                    </div>
                    <div class="tip-card">
                        <i class="fas fa-key"></i>
                        <h4>Consider a Passphrase</h4>
                        <p>Use a memorable phrase with variations for strong, easy-to-remember passwords.</p>
                    </div>
                    <div class="tip-card">
                        <i class="fas fa-tools"></i>
                        <h4>Use Password Manager</h4>
                        <p>Consider using a reputable password manager to generate and store strong passwords.</p>
                    </div>
                </div>
            </div>

            <div class="history-section">
                <div class="section-header">
                    <h3>Check History</h3>
                    <button id="clearHistory" class="clear-btn">
                        <i class="fas fa-trash"></i> Clear History
                    </button>
                </div>
                <div class="history-list" id="historyList">
                    <!-- History items will be populated here -->
                </div>
            </div>
        </div>
    </div>

    <!-- Password Generator Modal -->
    <div class="modal" id="generatorModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Password Generator</h3>
                <button class="close-modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="generator-controls">
                    <div class="control-group">
                        <label for="passwordLength">Length: <span id="lengthValueDisplay">12</span></label>
                        <input type="range" id="passwordLength" min="8" max="32" value="12">
                    </div>
                    <div class="control-group">
                        <label>
                            <input type="checkbox" id="includeUppercase" checked>
                            Include Uppercase Letters
                        </label>
                    </div>
                    <div class="control-group">
                        <label>
                            <input type="checkbox" id="includeLowercase" checked>
                            Include Lowercase Letters
                        </label>
                    </div>
                    <div class="control-group">
                        <label>
                            <input type="checkbox" id="includeNumbers" checked>
                            Include Numbers
                        </label>
                    </div>
                    <div class="control-group">
                        <label>
                            <input type="checkbox" id="includeSymbols" checked>
                            Include Symbols
                        </label>
                    </div>
                </div>
                <div class="generated-password">
                    <input type="text" id="generatedPassword" readonly>
                    <button id="copyPassword" class="copy-btn">
                        <i class="fas fa-copy"></i>
                    </button>
                    <button id="regeneratePassword" class="regenerate-btn">
                        <i class="fas fa-sync-alt"></i>
                    </button>
                </div>
                <div class="modal-actions">
                    <button id="usePassword" class="btn-primary">Use This Password</button>
                    <button class="btn-secondary close-modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>