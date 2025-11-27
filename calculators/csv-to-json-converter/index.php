<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Free CSV to JSON Converter | Convert CSV Files to JSON Online</title>
    <meta name="description" content="Free online CSV to JSON converter. Convert CSV files to JSON format instantly. Support for custom delimiters, headers, and nested JSON structures.">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <header class="header">
            <h1><i class="fas fa-exchange-alt"></i> CSV to JSON Converter</h1>
            <p>Convert CSV files and data to JSON format instantly with custom options</p>
        </header>

        <main class="calculator-card">
            <div class="converter-tabs">
                <button class="tab-btn active" data-tab="upload">Upload CSV File</button>
                <button class="tab-btn" data-tab="paste">Paste CSV Data</button>
            </div>

            <!-- File Upload Tab -->
            <div class="tab-content active" id="upload-tab">
                <div class="upload-area" id="uploadArea">
                    <i class="fas fa-cloud-upload-alt"></i>
                    <h3>Upload CSV File</h3>
                    <p>Drag & drop your CSV file here or click to browse</p>
                    <input type="file" id="csvFile" accept=".csv,.txt" style="display: none;">
                    <button class="browse-btn" onclick="document.getElementById('csvFile').click()">
                        <i class="fas fa-folder-open"></i> Browse Files
                    </button>
                    <div class="file-info" id="fileInfo" style="display: none;"></div>
                </div>
            </div>

            <!-- Paste Data Tab -->
            <div class="tab-content" id="paste-tab">
                <div class="input-group">
                    <label for="csv-data"><i class="fas fa-paste"></i> Paste CSV Data</label>
                    <textarea id="csv-data" placeholder="Paste your CSV data here... Example:
name,age,city
John,30,New York
Jane,25,London" rows="8"></textarea>
                </div>
            </div>

            <!-- Conversion Options -->
            <div class="options-section">
                <h3><i class="fas fa-cog"></i> Conversion Options</h3>
                <div class="options-grid">
                    <div class="option-group">
                        <label for="delimiter">Delimiter</label>
                        <select id="delimiter">
                            <option value="," selected>Comma (,)</option>
                            <option value=";">Semicolon (;)</option>
                            <option value="\t">Tab</option>
                            <option value="|">Pipe (|)</option>
                            <option value="custom">Custom</option>
                        </select>
                        <input type="text" id="customDelimiter" placeholder="Enter custom delimiter" style="display: none; max-width: 100px;">
                    </div>

                    <div class="option-group">
                        <label for="hasHeaders">
                            <input type="checkbox" id="hasHeaders" checked>
                            First row contains headers
                        </label>
                    </div>

                    <div class="option-group">
                        <label for="outputFormat">Output Format</label>
                        <select id="outputFormat">
                            <option value="array" selected>Array of Objects</option>
                            <option value="object">Object with Keys</option>
                            <option value="minified">Minified JSON</option>
                            <option value="pretty">Pretty Printed</option>
                        </select>
                    </div>

                    <div class="option-group">
                        <label for="quoteChar">Quote Character</label>
                        <select id="quoteChar">
                            <option value='"' selected>Double Quote (")</option>
                            <option value="'">Single Quote (')</option>
                            <option value="none">None</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="action-buttons">
                <button class="action-btn" id="convertBtn">
                    <i class="fas fa-sync-alt"></i> Convert to JSON
                </button>
                <button class="action-btn secondary" id="previewBtn">
                    <i class="fas fa-eye"></i> Preview CSV
                </button>
            </div>

            <!-- Results Section -->
            <div class="results-section" id="resultsSection" style="display: none;">
                <div class="results-header">
                    <h3><i class="fas fa-code"></i> JSON Output</h3>
                    <div class="result-stats" id="resultStats"></div>
                </div>
                
                <div class="output-container">
                    <pre id="json-output" class="json-output"></pre>
                </div>

                <div class="utility-buttons">
                    <button class="util-btn" id="copyBtn">
                        <i class="fas fa-copy"></i> Copy JSON
                    </button>
                    <button class="util-btn" id="downloadBtn">
                        <i class="fas fa-download"></i> Download JSON
                    </button>
                    <button class="util-btn" id="clearBtn">
                        <i class="fas fa-broom"></i> Clear All
                    </button>
                </div>
            </div>

            <!-- Preview Section -->
            <div class="preview-section" id="previewSection" style="display: none;">
                <h3><i class="fas fa-table"></i> CSV Preview</h3>
                <div class="table-container">
                    <table id="previewTable">
                        <thead></thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </main>

        <section class="features-section">
            <h2>CSV to JSON Conversion Features</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <i class="fas fa-file-upload"></i>
                    <h3>File Upload</h3>
                    <p>Upload CSV files directly or paste CSV data for conversion</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-sliders-h"></i>
                    <h3>Custom Options</h3>
                    <p>Choose delimiters, headers, and output format for precise conversion</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-table"></i>
                    <h3>Data Preview</h3>
                    <p>Preview your CSV data before conversion to ensure accuracy</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-download"></i>
                    <h3>Export Options</h3>
                    <p>Download converted JSON or copy to clipboard with one click</p>
                </div>
            </div>
        </section>

        <section class="examples-section">
            <h2>CSV to JSON Examples</h2>
            <div class="examples-grid">
                <div class="example-card" data-example="simple">
                    <h4>Simple CSV</h4>
                    <pre>name,age,city
John,30,New York
Jane,25,London</pre>
                </div>
                <div class="example-card" data-example="complex">
                    <h4>With Quotes</h4>
                    <pre>id,"full name",salary
1,"John Doe",50000
2,"Jane Smith",60000</pre>
                </div>
                <div class="example-card" data-example="semicolon">
                    <h4>Semicolon Delimited</h4>
                    <pre>name;department;score
Alice;Engineering;95
Bob;Marketing;88</pre>
                </div>
                <div class="example-card" data-example="noheaders">
                    <h4>No Headers</h4>
                    <pre>Apple,1.20,50
Banana,0.50,100
Orange,0.80,75</pre>
                </div>
            </div>
        </section>
    </div>

    <script src="script.js"></script>
</body>
</html>