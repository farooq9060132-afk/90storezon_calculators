<?php
$title = "Free Regex Tester - Test Regular Expressions Online";
$description = "Test and debug your regular expressions online with our free Regex tester. Real-time matching, detailed results, and regex syntax highlighting.";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <meta name="description" content="<?php echo $description; ?>">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1><i class="fas fa-code"></i> Free Regex Tester</h1>
            <p>Test and debug your regular expressions in real-time</p>
        </div>

        <div class="calculator">
            <div class="input-group">
                <label for="regexPattern"><i class="fas fa-search"></i> Regular Expression Pattern</label>
                <input type="text" id="regexPattern" placeholder="Enter regex pattern (e.g., ^[a-zA-Z0-9]+$)" value="\b\w+@\w+\.\w+\b">
                <div class="input-help">
                    <small>Use standard regex syntax. Flags: g (global), i (case-insensitive), m (multiline)</small>
                </div>
            </div>

            <div class="input-group">
                <label for="testString"><i class="fas fa-text-height"></i> Test String</label>
                <textarea id="testString" placeholder="Enter text to test against the regex pattern" rows="6">Contact us at john@example.com or support@company.com for assistance. Invalid emails: user@invalid, @domain.com</textarea>
            </div>

            <div class="input-group">
                <label for="regexFlags"><i class="fas fa-flag"></i> Regex Flags</label>
                <div class="flags-container">
                    <label class="flag-checkbox">
                        <input type="checkbox" id="flagGlobal" checked> Global (g)
                    </label>
                    <label class="flag-checkbox">
                        <input type="checkbox" id="flagIgnoreCase"> Ignore Case (i)
                    </label>
                    <label class="flag-checkbox">
                        <input type="checkbox" id="flagMultiline"> Multiline (m)
                    </label>
                </div>
            </div>

            <div class="actions">
                <button id="testRegex" class="btn-primary">
                    <i class="fas fa-play"></i> Test Regex
                </button>
                <button id="clearAll" class="btn-secondary">
                    <i class="fas fa-broom"></i> Clear All
                </button>
            </div>

            <div id="results" class="results-container" style="display: none;">
                <h3><i class="fas fa-chart-bar"></i> Test Results</h3>
                
                <div class="result-section">
                    <h4>Matches Found: <span id="matchCount">0</span></h4>
                    <div id="matchesList" class="matches-list"></div>
                </div>

                <div class="result-section">
                    <h4>Match Details</h4>
                    <div id="matchDetails" class="match-details"></div>
                </div>

                <div class="result-section">
                    <h4>Test Statistics</h4>
                    <div class="stats-grid">
                        <div class="stat-item">
                            <span class="stat-label">Total Matches</span>
                            <span class="stat-value" id="statTotalMatches">0</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-label">Pattern Valid</span>
                            <span class="stat-value" id="statPatternValid">Yes</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-label">Execution Time</span>
                            <span class="stat-value" id="statExecTime">0ms</span>
                        </div>
                    </div>
                </div>
            </div>

            <div id="errorMessage" class="error-message" style="display: none;">
                <i class="fas fa-exclamation-triangle"></i>
                <span id="errorText"></span>
            </div>
        </div>

        <div class="regex-examples">
            <h3><i class="fas fa-lightbulb"></i> Common Regex Examples</h3>
            <div class="examples-grid">
                <div class="example-item" data-pattern="\b\w+@\w+\.\w+\b" data-text="Contact at email@example.com">
                    <strong>Email Address</strong>
                    <code>\b\w+@\w+\.\w+\b</code>
                </div>
                <div class="example-item" data-pattern="^\d{5}(-\d{4})?$" data-text="12345 or 12345-6789">
                    <strong>US Zip Code</strong>
                    <code>^\d{5}(-\d{4})?$</code>
                </div>
                <div class="example-item" data-pattern="\(\d{3}\) \d{3}-\d{4}" data-text="Call (123) 456-7890">
                    <strong>Phone Number</strong>
                    <code>\(\d{3}\) \d{3}-\d{4}</code>
                </div>
                <div class="example-item" data-pattern="https?://[^\s]+" data-text="Visit https://example.com">
                    <strong>URL</strong>
                    <code>https?://[^\s]+</code>
                </div>
            </div>
        </div>

        <div class="info-section">
            <h3><i class="fas fa-info-circle"></i> About Regex Tester</h3>
            <div class="info-content">
                <p>This free Regex tester allows you to test and debug regular expressions in real-time. Regular expressions are powerful patterns used for string matching and manipulation.</p>
                
                <h4>Common Regex Metacharacters:</h4>
                <ul>
                    <li><code>.</code> - Any single character</li>
                    <li><code>\d</code> - Any digit (0-9)</li>
                    <li><code>\w</code> - Any word character (a-z, A-Z, 0-9, _)</li>
                    <li><code>\s</code> - Any whitespace character</li>
                    <li><code>^</code> - Start of string</li>
                    <li><code>$</code> - End of string</li>
                    <li><code>*</code> - Zero or more occurrences</li>
                    <li><code>+</code> - One or more occurrences</li>
                    <li><code>?</code> - Zero or one occurrence</li>
                    <li><code>{n}</code> - Exactly n occurrences</li>
                    <li><code>[abc]</code> - Any of a, b, or c</li>
                    <li><code>(abc)</code> - Group</li>
                </ul>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>