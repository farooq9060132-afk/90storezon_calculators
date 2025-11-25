<?php
$title = "Free MD5 Generator - Generate MD5 Hashes Online";
$description = "Generate MD5 hashes online for free. Convert text, passwords, and strings to MD5 hash format instantly. Secure and fast MD5 encryption tool.";
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
            <h1><i class="fas fa-lock"></i> Free MD5 Generator</h1>
            <p>Generate MD5 hashes for text, passwords, and strings instantly</p>
        </div>

        <div class="calculator">
            <div class="input-group">
                <label for="inputText"><i class="fas fa-text-height"></i> Input Text</label>
                <textarea id="inputText" placeholder="Enter text to generate MD5 hash..." rows="6">Hello World! This is a test message for MD5 hash generation.</textarea>
                <div class="input-help">
                    <small>Enter any text, password, or string to generate its MD5 hash</small>
                </div>
            </div>

            <div class="options-section">
                <h4><i class="fas fa-cog"></i> Generation Options</h4>
                <div class="options-grid">
                    <div class="option-group">
                        <label for="encodingType">Output Encoding:</label>
                        <select id="encodingType">
                            <option value="hex">Hexadecimal (Standard)</option>
                            <option value="base64">Base64</option>
                            <option value="binary">Binary</option>
                        </select>
                    </div>
                    <div class="option-group">
                        <label for="caseType">Case:</label>
                        <select id="caseType">
                            <option value="lower">Lowercase</option>
                            <option value="upper" selected>Uppercase</option>
                        </select>
                    </div>
                    <div class="option-group">
                        <label class="checkbox-label">
                            <input type="checkbox" id="autoGenerate" checked> Auto-generate on input
                        </label>
                    </div>
                </div>
            </div>

            <div class="actions">
                <button id="generateMD5" class="btn-primary">
                    <i class="fas fa-bolt"></i> Generate MD5 Hash
                </button>
                <button id="copyHash" class="btn-secondary">
                    <i class="fas fa-copy"></i> Copy MD5 Hash
                </button>
                <button id="clearAll" class="btn-secondary">
                    <i class="fas fa-broom"></i> Clear All
                </button>
            </div>

            <div id="results" class="results-container">
                <h3><i class="fas fa-chart-bar"></i> MD5 Hash Results</h3>
                
                <div class="result-section">
                    <h4>Generated MD5 Hash</h4>
                    <div class="hash-output">
                        <code id="md5Hash">d41d8cd98f00b204e9800998ecf8427e</code>
                        <button id="copyHashBtn" class="btn-copy" title="Copy Hash">
                            <i class="fas fa-copy"></i>
                        </button>
                    </div>
                </div>

                <div class="result-section">
                    <h4>Hash Information</h4>
                    <div class="info-grid">
                        <div class="info-item">
                            <span class="info-label">Hash Type:</span>
                            <span class="info-value">MD5 (Message-Digest Algorithm 5)</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Hash Length:</span>
                            <span class="info-value" id="hashLength">32 characters</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Input Length:</span>
                            <span class="info-value" id="inputLength">0 characters</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Generation Time:</span>
                            <span class="info-value" id="generationTime">0ms</span>
                        </div>
                    </div>
                </div>

                <div class="result-section">
                    <h4>Multiple Hashes</h4>
                    <div class="hashes-grid">
                        <div class="hash-item">
                            <strong>Uppercase:</strong>
                            <code id="hashUpper" class="hash-code">D41D8CD98F00B204E9800998ECF8427E</code>
                        </div>
                        <div class="hash-item">
                            <strong>Lowercase:</strong>
                            <code id="hashLower" class="hash-code">d41d8cd98f00b204e9800998ecf8427e</code>
                        </div>
                        <div class="hash-item">
                            <strong>Base64:</strong>
                            <code id="hashBase64" class="hash-code">1B2M2Y8AsgTpgAmY7PhCfg==</code>
                        </div>
                    </div>
                </div>
            </div>

            <div class="verification-section">
                <h4><i class="fas fa-check-circle"></i> MD5 Verification</h4>
                <div class="verification-grid">
                    <div class="input-group">
                        <label for="verifyHash">MD5 Hash to Verify:</label>
                        <input type="text" id="verifyHash" placeholder="Enter MD5 hash to verify against original text">
                    </div>
                    <button id="verifyBtn" class="btn-secondary">
                        <i class="fas fa-check"></i> Verify Hash
                    </button>
                    <div id="verificationResult" class="verification-result"></div>
                </div>
            </div>
        </div>

        <div class="hash-examples">
            <h3><i class="fas fa-lightbulb"></i> Common MD5 Examples</h3>
            <div class="examples-grid">
                <div class="example-item" data-text="">
                    <strong>Empty String</strong>
                    <code>d41d8cd98f00b204e9800998ecf8427e</code>
                </div>
                <div class="example-item" data-text="hello">
                    <strong>"hello"</strong>
                    <code>5d41402abc4b2a76b9719d911017c592</code>
                </div>
                <div class="example-item" data-text="password">
                    <strong>"password"</strong>
                    <code>5f4dcc3b5aa765d61d8327deb882cf99</code>
                </div>
                <div class="example-item" data-text="admin">
                    <strong>"admin"</strong>
                    <code>21232f297a57a5a743894a0e4a801fc3</code>
                </div>
                <div class="example-item" data-text="123456">
                    <strong>"123456"</strong>
                    <code>e10adc3949ba59abbe56e057f20f883e</code>
                </div>
                <div class="example-item" data-text="Hello World!">
                    <strong>"Hello World!"</strong>
                    <code>ed076287532e86365e841e92bfc50d8c</code>
                </div>
            </div>
        </div>

        <div class="info-section">
            <h3><i class="fas fa-info-circle"></i> About MD5 Hashing</h3>
            <div class="info-content">
                <p>MD5 (Message-Digest Algorithm 5) is a widely used cryptographic hash function that produces a 128-bit (16-byte) hash value. It's commonly used to verify data integrity.</p>
                
                <h4>MD5 Characteristics:</h4>
                <ul>
                    <li><strong>Hash Length:</strong> 128 bits (32 hexadecimal characters)</li>
                    <li><strong>Algorithm Type:</strong> Cryptographic hash function</li>
                    <li><strong>Developed:</strong> 1991 by Ronald Rivest</li>
                    <li><strong>Common Uses:</strong> Checksums, data integrity verification</li>
                </ul>

                <h4>Technical Details:</h4>
                <ul>
                    <li>Processes input in 512-bit blocks</li>
                    <li>Produces fixed-length output regardless of input size</li>
                    <li>One-way function (cannot be reversed)</li>
                    <li>Small changes in input produce completely different hashes</li>
                </ul>

                <div class="security-notice">
                    <h4><i class="fas fa-shield-alt"></i> Security Notice</h4>
                    <p><strong>MD5 is considered cryptographically broken and unsuitable for further use</strong> in security-sensitive applications due to vulnerability to collision attacks. For secure password hashing, consider using bcrypt, Argon2, or PBKDF2.</p>
                </div>

                <h4>Common Applications:</h4>
                <ul>
                    <li>File integrity verification</li>
                    <li>Checksums for downloads</li>
                    <li>Database indexing</li>
                    <li>Digital signatures (with caution)</li>
                    <li>Non-cryptographic uses</li>
                </ul>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>