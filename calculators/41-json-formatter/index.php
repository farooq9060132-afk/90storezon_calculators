<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Free JSON Formatter - Beautify & Validate JSON Online</title>
    <meta name="description" content="Free online JSON formatter and validator. Beautify, minify, validate JSON data with syntax highlighting. Fast and secure.">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <!-- VIP Header Card -->
        <div class="vip-card">
            <div class="vip-badge">PROFESSIONAL</div>
            <h1>🔧 JSON Formatter & Validator</h1>
            <p class="vip-subtitle">Beautify • Validate • Minify • 100% Client-Side</p>
            
            <div class="vip-features">
                <div class="feature">
                    <span class="feature-icon">⚡</span>
                    <span>Instant Formatting</span>
                </div>
                <div class="feature">
                    <span class="feature-icon">🔒</span>
                    <span>100% Secure - No Server</span>
                </div>
                <div class="feature">
                    <span class="feature-icon">🎯</span>
                    <span>Real-time Validation</span>
                </div>
            </div>
        </div>

        <!-- Main Formatter -->
        <div class="tool-container">
            <div class="input-section">
                <div class="section-header">
                    <h3>Input JSON</h3>
                    <div class="action-buttons">
                        <button id="clearBtn" class="action-btn">🗑️ Clear</button>
                        <button id="exampleBtn" class="action-btn">📋 Example</button>
                        <button id="pasteBtn" class="action-btn">📝 Paste</button>
                    </div>
                </div>
                <textarea id="jsonInput" placeholder='Paste your JSON here or use example...
Example: {"name": "John", "age": 30, "city": "New York"}'></textarea>
                <div class="error-message" id="inputError"></div>
            </div>

            <div class="controls-section">
                <div class="format-options">
                    <label class="option">
                        <input type="radio" name="formatType" value="beautify" checked>
                        <span class="checkmark"></span>
                        Pretty Print (Beautify)
                    </label>
                    <label class="option">
                        <input type="radio" name="formatType" value="minify">
                        <span class="checkmark"></span>
                        Minify (Compress)
                    </label>
                    <label class="option">
                        <input type="radio" name="formatType" value="validate">
                        <span class="checkmark"></span>
                        Validate Only
                    </label>
                </div>

                <div class="advanced-options">
                    <label class="checkbox">
                        <input type="checkbox" id="sortKeys">
                        <span class="checkmark"></span>
                        Sort Keys Alphabetically
                    </label>
                    <label class="checkbox">
                        <input type="checkbox" id="escapeUnicode">
                        <span class="checkmark"></span>
                        Escape Unicode Characters
                    </label>
                </div>

                <button id="formatBtn" class="format-btn">
                    🚀 Format JSON
                </button>
            </div>

            <div class="output-section">
                <div class="section-header">
                    <h3>Formatted Output</h3>
                    <div class="action-buttons">
                        <button id="copyBtn" class="action-btn">📋 Copy</button>
                        <button id="downloadBtn" class="action-btn">💾 Download</button>
                        <button id="toggleView" class="action-btn">👁️ Toggle View</button>
                    </div>
                </div>
                <div class="output-container">
                    <pre id="jsonOutput" class="json-output"></pre>
                    <textarea id="jsonOutputRaw" class="json-output-raw" style="display: none;"></textarea>
                </div>
                <div class="stats" id="outputStats"></div>
            </div>
        </div>

        <!-- Validation Results -->
        <div id="validationResults" class="validation-card" style="display: none;">
            <h3>Validation Results</h3>
            <div class="validation-grid">
                <div class="validation-item">
                    <span class="validation-label">Status</span>
                    <span class="validation-value" id="validationStatus">-</span>
                </div>
                <div class="validation-item">
                    <span class="validation-label">Size</span>
                    <span class="validation-value" id="validationSize">-</span>
                </div>
                <div class="validation-item">
                    <span class="validation-label">Characters</span>
                    <span class="validation-value" id="validationChars">-</span>
                </div>
                <div class="validation-item">
                    <span class="validation-label">Lines</span>
                    <span class="validation-value" id="validationLines">-</span>
                </div>
            </div>
            <div class="error-details" id="errorDetails"></div>
        </div>

        <!-- Information Section -->
        <div class="info-grid">
            <div class="info-card">
                <h3>📖 What is JSON?</h3>
                <p>JSON (JavaScript Object Notation) is a lightweight data format that's easy for humans to read and write, and easy for machines to parse and generate.</p>
                <div class="code-example">
                    <code>
{<br>
&nbsp;&nbsp;"name": "John Doe",<br>
&nbsp;&nbsp;"age": 30,<br>
&nbsp;&nbsp;"isStudent": false,<br>
&nbsp;&nbsp;"hobbies": ["reading", "gaming"]<br>
}
                    </code>
                </div>
            </div>

            <div class="info-card">
                <h3>⚡ Features</h3>
                <ul>
                    <li><strong>Beautify:</strong> Format JSON with proper indentation</li>
                    <li><strong>Minify:</strong> Compress JSON by removing whitespace</li>
                    <li><strong>Validate:</strong> Check JSON syntax for errors</li>
                    <li><strong>Syntax Highlighting:</strong> Color-coded JSON structure</li>
                    <li><strong>Secure:</strong> All processing happens in your browser</li>
                </ul>
            </div>

            <div class="info-card">
                <h3>🔧 Common Uses</h3>
                <ul>
                    <li>API Development & Testing</li>
                    <li>Data Analysis & Processing</li>
                    <li>Web Application Development</li>
                    <li>Configuration Files</li>
                    <li>Data Exchange Between Systems</li>
                </ul>
            </div>

            <div class="info-card">
                <h3>💡 Tips</h3>
                <ul>
                    <li>Use double quotes for all strings</li>
                    <li>Ensure proper comma placement</li>
                    <li>Validate JSON before using in production</li>
                    <li>Use our minifier to reduce file size</li>
                    <li>Check for trailing commas</li>
                </ul>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>