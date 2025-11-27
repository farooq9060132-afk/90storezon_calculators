<?php
$title = "Free Code Beautifier - Format and Beautify Your Code Online";
$description = "Beautify and format your code with our free online code beautifier. Supports HTML, CSS, JavaScript, PHP, Python, Java, and more. Improve code readability instantly.";
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/theme/monokai.min.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1><i class="fas fa-code"></i> Free Code Beautifier</h1>
            <p>Format and beautify your code for better readability</p>
        </div>

        <div class="calculator">
            <div class="input-group">
                <label for="codeType"><i class="fas fa-file-code"></i> Code Language</label>
                <select id="codeType" class="language-select">
                    <option value="html">HTML</option>
                    <option value="css">CSS</option>
                    <option value="javascript">JavaScript</option>
                    <option value="php">PHP</option>
                    <option value="python">Python</option>
                    <option value="java">Java</option>
                    <option value="json">JSON</option>
                    <option value="xml">XML</option>
                    <option value="sql">SQL</option>
                    <option value="cpp">C++</option>
                    <option value="csharp">C#</option>
                </select>
            </div>

            <div class="editor-container">
                <div class="editor-section">
                    <h3><i class="fas fa-pencil-alt"></i> Input Code</h3>
                    <textarea id="inputCode" placeholder="Paste your messy code here..." rows="15"><!DOCTYPE html>
<html>
<head>
<title>Test Page</title>
<style>
body{font-family:Arial,sans-serif;margin:0;padding:20px;background:#f4f4f4;}
.container{max-width:1200px;margin:0 auto;background:white;padding:20px;border-radius:5px;}
</style>
</head>
<body>
<div class="container"><h1>Welcome</h1><p>This is a test page</p><button onclick="alert('Hello')">Click Me</button></div>
<script>
function test(){var x=10;var y=20;var z=x+y;console.log(z);return z;}
test();
</script>
</body>
</html></textarea>
                </div>

                <div class="editor-section">
                    <h3><i class="fas fa-magic"></i> Beautified Code</h3>
                    <textarea id="outputCode" placeholder="Beautiful formatted code will appear here..." rows="15" readonly></textarea>
                </div>
            </div>

            <div class="format-options">
                <h4><i class="fas fa-cog"></i> Formatting Options</h4>
                <div class="options-grid">
                    <div class="option-group">
                        <label for="indentSize">Indent Size:</label>
                        <select id="indentSize">
                            <option value="2">2 Spaces</option>
                            <option value="4" selected>4 Spaces</option>
                            <option value="8">8 Spaces</option>
                            <option value="tab">Tab</option>
                        </select>
                    </div>
                    <div class="option-group">
                        <label for="quoteStyle">Quote Style:</label>
                        <select id="quoteStyle">
                            <option value="single">Single Quotes</option>
                            <option value="double" selected>Double Quotes</option>
                            <option value="auto">Auto</option>
                        </select>
                    </div>
                    <div class="option-group">
                        <label for="maxLineLength">Max Line Length:</label>
                        <input type="number" id="maxLineLength" value="80" min="40" max="120">
                    </div>
                </div>
            </div>

            <div class="actions">
                <button id="beautifyCode" class="btn-primary">
                    <i class="fas fa-magic"></i> Beautify Code
                </button>
                <button id="copyCode" class="btn-secondary">
                    <i class="fas fa-copy"></i> Copy Beautified Code
                </button>
                <button id="clearAll" class="btn-secondary">
                    <i class="fas fa-broom"></i> Clear All
                </button>
            </div>

            <div id="stats" class="stats-container" style="display: none;">
                <h4><i class="fas fa-chart-bar"></i> Beautification Stats</h4>
                <div class="stats-grid">
                    <div class="stat-item">
                        <span class="stat-label">Original Lines</span>
                        <span class="stat-value" id="originalLines">0</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-label">Formatted Lines</span>
                        <span class="stat-value" id="formattedLines">0</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-label">Characters Saved</span>
                        <span class="stat-value" id="charsSaved">0</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-label">Readability Score</span>
                        <span class="stat-value" id="readabilityScore">0%</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="code-examples">
            <h3><i class="fas fa-lightbulb"></i> Code Examples</h3>
            <div class="examples-grid">
                <div class="example-item" data-type="html" data-code='&lt;div&gt;&lt;h1&gt;Title&lt;/h1&gt;&lt;p&gt;Content&lt;/p&gt;&lt;/div&gt;'>
                    <strong>HTML Example</strong>
                    <code>&lt;div&gt;&lt;h1&gt;Title&lt;/h1&gt;&lt;p&gt;Content&lt;/p&gt;&lt;/div&gt;</code>
                </div>
                <div class="example-item" data-type="css" data-code='body{margin:0;padding:0;}.container{width:100%;}'>
                    <strong>CSS Example</strong>
                    <code>body{margin:0;padding:0;}.container{width:100%;}</code>
                </div>
                <div class="example-item" data-type="javascript" data-code='function test(){var x=10;return x;}'>
                    <strong>JavaScript Example</strong>
                    <code>function test(){var x=10;return x;}</code>
                </div>
                <div class="example-item" data-type="json" data-code='{"name":"John","age":30,"city":"New York"}'>
                    <strong>JSON Example</strong>
                    <code>{"name":"John","age":30,"city":"New York"}</code>
                </div>
            </div>
        </div>

        <div class="info-section">
            <h3><i class="fas fa-info-circle"></i> About Code Beautifier</h3>
            <div class="info-content">
                <p>This free online code beautifier helps you format and organize your code for better readability and maintainability. Properly formatted code is easier to debug, understand, and collaborate on.</p>
                
                <h4>Supported Languages:</h4>
                <ul>
                    <li><strong>HTML</strong> - HyperText Markup Language</li>
                    <li><strong>CSS</strong> - Cascading Style Sheets</li>
                    <li><strong>JavaScript</strong> - Client-side scripting</li>
                    <li><strong>PHP</strong> - Server-side scripting</li>
                    <li><strong>Python</strong> - High-level programming</li>
                    <li><strong>Java</strong> - Object-oriented programming</li>
                    <li><strong>JSON</strong> - Data interchange format</li>
                    <li><strong>XML</strong> - Markup language</li>
                    <li><strong>SQL</strong> - Database queries</li>
                    <li><strong>C++/C#</strong> - System programming</li>
                </ul>

                <h4>Benefits of Code Beautification:</h4>
                <ul>
                    <li>Improved code readability and maintainability</li>
                    <li>Easier debugging and troubleshooting</li>
                    <li>Better collaboration with team members</li>
                    <li>Consistent coding standards</li>
                    <li>Professional code presentation</li>
                </ul>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/mode/xml/xml.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/mode/css/css.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/mode/javascript/javascript.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/mode/php/php.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/mode/python/python.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/mode/clike/clike.min.js"></script>
    <script src="script.js"></script>
</body>
</html>