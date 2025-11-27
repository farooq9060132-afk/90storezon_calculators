<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Generator Online - Strong & Secure Passwords 2024</title>
    <meta name="description" content="Online password generator tool. Create strong, secure passwords with custom length and character types. Enhance your online security instantly. No registration required!">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="vip-container">
        <header class="vip-header">
            <h1><i class="fas fa-key"></i> Password Generator</h1>
            <p>Create strong, secure passwords instantly</p>
        </header>

        <!-- Google Ads Slot -->
        <div class="ad-slot top-ad">
            [AD_TOP_BANNER]
        </div>

        <div class="calculator-container">
            <div class="input-group">
                <label for="passwordLength"><i class="fas fa-ruler-horizontal"></i> Password Length</label>
                <div class="slider-container">
                    <input type="range" id="passwordLength" min="8" max="50" value="16" class="slider">
                    <span id="lengthValue">16 characters</span>
                </div>
            </div>

            <div class="options-grid">
                <div class="option-group">
                    <label class="checkbox-label">
                        <input type="checkbox" id="uppercase" checked>
                        <span class="checkmark"></span>
                        <i class="fas fa-font"></i>
                        Uppercase Letters (A-Z)
                    </label>
                </div>

                <div class="option-group">
                    <label class="checkbox-label">
                        <input type="checkbox" id="lowercase" checked>
                        <span class="checkmark"></span>
                        <i class="fas fa-font"></i>
                        Lowercase Letters (a-z)
                    </label>
                </div>

                <div class="option-group">
                    <label class="checkbox-label">
                        <input type="checkbox" id="numbers" checked>
                        <span class="checkmark"></span>
                        <i class="fas fa-hashtag"></i>
                        Numbers (0-9)
                    </label>
                </div>

                <div class="option-group">
                    <label class="checkbox-label">
                        <input type="checkbox" id="symbols" checked>
                        <span class="checkmark"></span>
                        <i class="fas fa-asterisk"></i>
                        Symbols (!@#$%^&*)
                    </label>
                </div>
            </div>

            <div class="input-group">
                <label for="excludeChars"><i class="fas fa-ban"></i> Exclude Characters (Optional)</label>
                <input type="text" id="excludeChars" placeholder="Characters to exclude (e.g., 0O1l)">
            </div>

            <div class="input-row">
                <div class="input-group">
                    <label for="passwordCount"><i class="fas fa-copy"></i> Number of Passwords</label>
                    <select id="passwordCount">
                        <option value="1">1 Password</option>
                        <option value="3">3 Passwords</option>
                        <option value="5" selected>5 Passwords</option>
                        <option value="10">10 Passwords</option>
                    </select>
                </div>

                <div class="input-group">
                    <label for="passwordStrength"><i class="fas fa-shield-alt"></i> Strength Level</label>
                    <select id="passwordStrength">
                        <option value="weak">Weak</option>
                        <option value="medium">Medium</option>
                        <option value="strong" selected>Strong</option>
                        <option value="very-strong">Very Strong</option>
                    </select>
                </div>
            </div>

            <button class="calculate-btn" onclick="generatePasswords()">
                <i class="fas fa-magic"></i> Generate Passwords
            </button>

            <!-- Google Ads Slot -->
            <div class="ad-slot middle-ad">
                [AD_MIDDLE_BANNER]
            </div>

            <div class="result-container" id="resultContainer">
                <h3><i class="fas fa-check-circle"></i> Your Secure Passwords</h3>
                
                <div class="strength-meter">
                    <div class="strength-label">
                        <span>Password Strength:</span>
                        <strong id="strengthText">Strong</strong>
                    </div>
                    <div class="strength-bar">
                        <div class="strength-fill" id="strengthFill"></div>
                    </div>
                </div>

                <div class="passwords-list" id="passwordsList">
                    <!-- Passwords will be generated here -->
                </div>

                <div class="password-actions">
                    <button class="action-btn" onclick="copyAllPasswords()">
                        <i class="fas fa-copy"></i> Copy All
                    </button>
                    <button class="action-btn" onclick="downloadPasswords()">
                        <i class="fas fa-download"></i> Download as TXT
                    </button>
                    <button class="action-btn" onclick="regeneratePasswords()">
                        <i class="fas fa-sync-alt"></i> Regenerate
                    </button>
                </div>

                <div class="security-tips">
                    <h4><i class="fas fa-lightbulb"></i> Password Security Tips</h4>
                    <div class="tips-grid">
                        <div class="tip-item">
                            <i class="fas fa-check-circle"></i>
                            <span>Use at least 12 characters</span>
                        </div>
                        <div class="tip-item">
                            <i class="fas fa-check-circle"></i>
                            <span>Include numbers and symbols</span>
                        </div>
                        <div class="tip-item">
                            <i class="fas fa-check-circle"></i>
                            <span>Avoid dictionary words</span>
                        </div>
                        <div class="tip-item">
                            <i class="fas fa-check-circle"></i>
                            <span>Don't reuse passwords</span>
                        </div>
                        <div class="tip-item">
                            <i class="fas fa-check-circle"></i>
                            <span>Use a password manager</span>
                        </div>
                        <div class="tip-item">
                            <i class="fas fa-check-circle"></i>
                            <span>Enable two-factor authentication</span>
                        </div>
                    </div>
                </div>

                <div class="password-stats">
                    <h4><i class="fas fa-chart-bar"></i> Password Statistics</h4>
                    <div class="stats-grid">
                        <div class="stat-item">
                            <span>Possible Combinations:</span>
                            <strong id="combinationsCount">0</strong>
                        </div>
                        <div class="stat-item">
                            <span>Time to Crack (Online):</span>
                            <strong id="crackTime">Instantly</strong>
                        </div>
                        <div class="stat-item">
                            <span>Entropy Bits:</span>
                            <strong id="entropyBits">0</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Google Ads Slot -->
        <div class="ad-slot bottom-ad">
            [AD_BOTTOM_BANNER]
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>