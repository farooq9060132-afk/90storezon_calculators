<?php
$title = "Free URL Encoder - Encode URLs Online";
$description = "Encode URLs and special characters with our free online URL encoder. Convert text to URL-safe format instantly. Supports URL encoding and decoding.";
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
            <h1><i class="fas fa-link"></i> Free URL Encoder</h1>
            <p>Encode and decode URLs online for safe web transmission</p>
        </div>

        <div class="calculator">
            <div class="input-group">
                <label for="inputText"><i class="fas fa-text-height"></i> Input Text/URL</label>
                <textarea id="inputText" placeholder="Enter text or URL to encode/decode..." rows="6">Hello World! This is a test URL: https://example.com/page?name=John Doe&age=25</textarea>
                <div class="input-help">
                    <small>Enter text or URL to encode special characters for web safety</small>
                </div>
            </div>

            <div class="options-section">
                <h4><i class="fas fa-cog"></i> Encoding Options</h4>
                <div class="options-grid">
                    <div class="option-group">
                        <label for="encodingType">Operation:</label>
                        <select id="encodingType">
                            <option value="encode">URL Encode</option>
                            <option value="decode">URL Decode</option>
                            <option value="encodeComponent">URL Component Encode</option>
                            <option value="decodeComponent">URL Component Decode</option>
                        </select>
                    </div>
                    <div class="option-group">
                        <label for="autoDetect">Auto-detect URLs:</label>
                        <select id="autoDetect">
                            <option value="auto">Auto Detect</option>
                            <option value="force">Force Encoding</option>
                            <option value="none">No Detection</option>
                        </select>
                    </div>
                    <div class="option-group">
                        <label class="checkbox-label">
                            <input type="checkbox" id="autoProcess" checked> Auto-process on input
                        </label>
                    </div>
                </div>
            </div>

            <div class="actions">
                <button id="processUrl" class="btn-primary">
                    <i class="fas fa-cogs"></i> Process URL
                </button>
                <button id="copyResult" class="btn-secondary">
                    <i class="fas fa-copy"></i> Copy Result
                </button>
                <button id="clearAll" class="btn-secondary">
                    <i class="fas fa-broom"></i> Clear All
                </button>
            </div>

            <div id="results" class="results-container">
                <h3><i class="fas fa-chart-bar"></i> URL Encoding Results</h3>
                
                <div class="result-section">
                    <h4>Processed Result</h4>
                    <div class="result-output">
                        <code id="processedResult">Enter text and click Process URL</code>
                        <button id="copyResultBtn" class="btn-copy" title="Copy Result">
                            <i class="fas fa-copy"></i>
                        </button>
                    </div>
                </div>

                <div class="result-section">
                    <h4>Encoding Information</h4>
                    <div class="info-grid">
                        <div class="info-item">
                            <span class="info-label">Operation:</span>
                            <span class="info-value" id="operationType">None</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Original Length:</span>
                            <span class="info-value" id="originalLength">0 characters</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Processed Length:</span>
                            <span class="info-value" id="processedLength">0 characters</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Size Change:</span>
                            <span class="info-value" id="sizeChange">0%</span>
                        </div>
                    </div>
                </div>

                <div class="result-section">
                    <h4>Character Analysis</h4>
                    <div class="analysis-grid">
                        <div class="analysis-item">
                            <strong>Encoded Characters:</strong>
                            <span id="encodedChars">0</span>
                        </div>
                        <div class="analysis-item">
                            <strong>Special Characters:</strong>
                            <span id="specialChars">0</span>
                        </div>
                        <div class="analysis-item">
                            <strong>Spaces:</strong>
                            <span id="spaceCount">0</span>
                        </div>
                        <div class="analysis-item">
                            <strong>Processing Time:</span>
                            <span id="processingTime">0ms</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="comparison-section">
                <h4><i class="fas fa-exchange-alt"></i> Encoding Comparison</h4>
                <div class="comparison-grid">
                    <div class="comparison-item">
                        <strong>Original:</strong>
                        <code id="originalText" class="comparison-code"></code>
                    </div>
                    <div class="comparison-item">
                        <strong>URL Encoded:</strong>
                        <code id="urlEncoded" class="comparison-code"></code>
                    </div>
                    <div class="comparison-item">
                        <strong>Component Encoded:</strong>
                        <code id="componentEncoded" class="comparison-code"></code>
                    </div>
                </div>
            </div>
        </div>

        <div class="url-examples">
            <h3><i class="fas fa-lightbulb"></i> Common URL Examples</h3>
            <div class="examples-grid">
                <div class="example-item" data-text="Hello World!">
                    <strong>Simple Text</strong>
                    <code>Hello World!</code>
                </div>
                <div class="example-item" data-text="https://example.com/path with spaces">
                    <strong>URL with Spaces</strong>
                    <code>https://example.com/path with spaces</code>
                </div>
                <div class="example-item" data-text="query=special chars & symbols @#$">
                    <strong>Special Characters</strong>
                    <code>query=special chars & symbols @#$</code>
                </div>
                <div class="example-item" data-text="user@example.com">
                    <strong>Email Address</strong>
                    <code>user@example.com</code>
                </div>
                <div class="example-item" data-text="name=John Doe&age=30&city=New York">
                    <strong>Query Parameters</strong>
                    <code>name=John Doe&age=30&city=New York</code>
                </div>
                <div class="example-item" data-text="Hello%20World%21">
                    <strong>Encoded Example</strong>
                    <code>Hello%20World%21</code>
                </div>
            </div>
        </div>

        <div class="info-section">
            <h3><i class="fas fa-info-circle"></i> About URL Encoding</h3>
            <div class="info-content">
                <p>URL encoding converts characters into a format that can be safely transmitted over the internet. It replaces unsafe ASCII characters with a "%" followed by two hexadecimal digits.</p>
                
                <h4>Common Encoded Characters:</h4>
                <div class="encoding-table">
                    <div class="table-header">
                        <span>Character</span>
                        <span>URL Encoded</span>
                        <span>Description</span>
                    </div>
                    <div class="table-row">
                        <span>Space</span>
                        <span>%20</span>
                        <span>Whitespace character</span>
                    </div>
                    <div class="table-row">
                        <span>!</span>
                        <span>%21</span>
                        <span>Exclamation mark</span>
                    </div>
                    <div class="table-row">
                        <span>@</span>
                        <span>%40</span>
                        <span>At symbol</span>
                    </div>
                    <div class="table-row">
                        <span>#</span>
                        <span>%23</span>
                        <span>Hash/pound</span>
                    </div>
                    <div class="table-row">
                        <span>$</span>
                        <span>%24</span>
                        <span>Dollar sign</span>
                    </div>
                    <div class="table-row">
                        <span>&</span>
                        <span>%26</span>
                        <span>Ampersand</span>
                    </div>
                    <div class="table-row">
                        <span>=</span>
                        <span>%3D</span>
                        <span>Equals sign</span>
                    </div>
                    <div class="table-row">
                        <span>?</span>
                        <span>%3F</span>
                        <span>Question mark</span>
                    </div>
                </div>

                <h4>URL Encoding vs URL Component Encoding:</h4>
                <ul>
                    <li><strong>URL Encoding:</strong> Used for encoding entire URLs. Preserves characters like /, :, ?, &, =, #</li>
                    <li><strong>URL Component Encoding:</strong> Used for encoding URL components. Encodes more characters including /, :, ?, &, =</li>
                </ul>

                <h4>When to Use URL Encoding:</h4>
                <ul>
                    <li>Query string parameters</li>
                    <li>Form data submission</li>
                    <li>API requests with special characters</li>
                    <li>File paths with spaces</li>
                    <li>Email addresses in URLs</li>
                </ul>

                <div class="security-notice">
                    <h4><i class="fas fa-shield-alt"></i> Security Best Practices</h4>
                    <p>Always encode user input before including it in URLs to prevent injection attacks and ensure proper URL formatting. Use component encoding for individual URL parts and standard encoding for complete URLs.</p>
                </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>