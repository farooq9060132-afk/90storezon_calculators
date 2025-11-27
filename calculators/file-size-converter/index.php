<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Size Converter - Convert Between Units</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <header class="header">
            <div class="header-content">
                <h1><i class="fas fa-file-alt"></i> File Size Converter</h1>
                <p>Convert between bytes, kilobytes, megabytes, gigabytes, and terabytes</p>
            </div>
            <div class="header-stats">
                <div class="stat">
                    <span class="stat-number" id="totalConversions">0</span>
                    <span class="stat-label">Conversions</span>
                </div>
                <div class="stat">
                    <span class="stat-number" id="popularUnit">MB</span>
                    <span class="stat-label">Most Used</span>
                </div>
                <div class="stat">
                    <span class="stat-number" id="accuracyRate">100%</span>
                    <span class="stat-label">Accuracy</span>
                </div>
            </div>
        </header>

        <div class="main-content">
            <div class="converter-container">
                <div class="converter-card">
                    <div class="converter-form">
                        <div class="input-group">
                            <div class="input-wrapper">
                                <label for="inputValue">Enter Size</label>
                                <input type="number" id="inputValue" placeholder="Enter file size..." step="any" min="0">
                            </div>
                            <div class="select-wrapper">
                                <label for="fromUnit">From Unit</label>
                                <select id="fromUnit">
                                    <option value="bytes">Bytes (B)</option>
                                    <option value="kilobytes">Kilobytes (KB)</option>
                                    <option value="megabytes" selected>Megabytes (MB)</option>
                                    <option value="gigabytes">Gigabytes (GB)</option>
                                    <option value="terabytes">Terabytes (TB)</option>
                                    <option value="petabytes">Petabytes (PB)</option>
                                    <option value="kibibytes">Kibibytes (KiB)</option>
                                    <option value="mebibytes">Mebibytes (MiB)</option>
                                    <option value="gibibytes">Gibibytes (GiB)</option>
                                    <option value="tebibytes">Tebibytes (TiB)</option>
                                </select>
                            </div>
                            <div class="swap-button">
                                <button id="swapUnits" class="swap-btn" title="Swap units">
                                    <i class="fas fa-exchange-alt"></i>
                                </button>
                            </div>
                            <div class="select-wrapper">
                                <label for="toUnit">To Unit</label>
                                <select id="toUnit">
                                    <option value="bytes">Bytes (B)</option>
                                    <option value="kilobytes">Kilobytes (KB)</option>
                                    <option value="megabytes">Megabytes (MB)</option>
                                    <option value="gigabytes" selected>Gigabytes (GB)</option>
                                    <option value="terabytes">Terabytes (TB)</option>
                                    <option value="petabytes">Petabytes (PB)</option>
                                    <option value="kibibytes">Kibibytes (KiB)</option>
                                    <option value="mebibytes">Mebibytes (MiB)</option>
                                    <option value="gibibytes">Gibibytes (GiB)</option>
                                    <option value="tebibytes">Tebibytes (TiB)</option>
                                </select>
                            </div>
                        </div>

                        <div class="action-buttons">
                            <button id="convertBtn" class="convert-btn">
                                <i class="fas fa-sync-alt"></i> Convert
                            </button>
                            <button id="resetBtn" class="reset-btn">
                                <i class="fas fa-redo"></i> Reset
                            </button>
                            <button id="copyResult" class="copy-btn" disabled>
                                <i class="fas fa-copy"></i> Copy Result
                            </button>
                        </div>
                    </div>

                    <div class="result-section">
                        <div class="result-card">
                            <div class="result-header">
                                <h3>Conversion Result</h3>
                                <div class="precision-control">
                                    <label for="decimalPlaces">Precision:</label>
                                    <select id="decimalPlaces">
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2" selected>2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="6">6</option>
                                        <option value="8">8</option>
                                    </select>
                                </div>
                            </div>
                            <div class="result-display">
                                <div class="original-value" id="originalValue">-</div>
                                <div class="conversion-arrow">
                                    <i class="fas fa-long-arrow-alt-right"></i>
                                </div>
                                <div class="converted-value" id="convertedValue">-</div>
                            </div>
                            <div class="result-details">
                                <div class="detail-item">
                                    <span class="detail-label">Conversion Formula:</span>
                                    <span class="detail-value" id="conversionFormula">-</span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">Size in Bytes:</span>
                                    <span class="detail-value" id="sizeInBytes">-</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="quick-conversions">
                    <h3>Quick Conversions</h3>
                    <div class="quick-buttons-grid">
                        <button class="quick-btn" data-from="megabytes" data-to="gigabytes">
                            MB → GB
                        </button>
                        <button class="quick-btn" data-from="gigabytes" data-to="megabytes">
                            GB → MB
                        </button>
                        <button class="quick-btn" data-from="kilobytes" data-to="megabytes">
                            KB → MB
                        </button>
                        <button class="quick-btn" data-from="megabytes" data-to="kilobytes">
                            MB → KB
                        </button>
                        <button class="quick-btn" data-from="gigabytes" data-to="terabytes">
                            GB → TB
                        </button>
                        <button class="quick-btn" data-from="terabytes" data-to="gigabytes">
                            TB → GB
                        </button>
                        <button class="quick-btn" data-from="bytes" data-to="kilobytes">
                            B → KB
                        </button>
                        <button class="quick-btn" data-from="kilobytes" data-to="bytes">
                            KB → B
                        </button>
                    </div>
                </div>
            </div>

            <div class="info-grid">
                <div class="info-card">
                    <h3><i class="fas fa-info-circle"></i> About File Sizes</h3>
                    <div class="info-content">
                        <p>File sizes can be represented in different units:</p>
                        <ul>
                            <li><strong>Decimal units</strong> (Base 10): KB, MB, GB, TB, PB</li>
                            <li><strong>Binary units</strong> (Base 2): KiB, MiB, GiB, TiB</li>
                            <li><strong>1 KB</strong> = 1000 Bytes | <strong>1 KiB</strong> = 1024 Bytes</li>
                            <li><strong>1 MB</strong> = 1,000,000 Bytes | <strong>1 MiB</strong> = 1,048,576 Bytes</li>
                        </ul>
                    </div>
                </div>

                <div class="info-card">
                    <h3><i class="fas fa-ruler"></i> Unit Comparison</h3>
                    <div class="comparison-table">
                        <div class="comparison-row header">
                            <span>Unit</span>
                            <span>Bytes</span>
                            <span>Type</span>
                        </div>
                        <div class="comparison-row">
                            <span>1 KB</span>
                            <span>1,000 B</span>
                            <span>Decimal</span>
                        </div>
                        <div class="comparison-row">
                            <span>1 KiB</span>
                            <span>1,024 B</span>
                            <span>Binary</span>
                        </div>
                        <div class="comparison-row">
                            <span>1 MB</span>
                            <span>1,000,000 B</span>
                            <span>Decimal</span>
                        </div>
                        <div class="comparison-row">
                            <span>1 MiB</span>
                            <span>1,048,576 B</span>
                            <span>Binary</span>
                        </div>
                    </div>
                </div>

                <div class="info-card">
                    <h3><i class="fas fa-lightbulb"></i> Common Examples</h3>
                    <div class="examples-list">
                        <div class="example-item">
                            <span class="example-type">Text Document</span>
                            <span class="example-size">~50 KB</span>
                        </div>
                        <div class="example-item">
                            <span class="example-type">High Quality Photo</span>
                            <span class="example-size">~5 MB</span>
                        </div>
                        <div class="example-item">
                            <span class="example-type">MP3 Song</span>
                            <span class="example-size">~4 MB</span>
                        </div>
                        <div class="example-item">
                            <span class="example-type">HD Movie</span>
                            <span class="example-size">~1.5 GB</span>
                        </div>
                        <div class="example-item">
                            <span class="example-type">DVD Quality</span>
                            <span class="example-size">~4.7 GB</span>
                        </div>
                        <div class="example-item">
                            <span class="example-type">Blu-ray Movie</span>
                            <span class="example-size">~25 GB</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="conversion-history">
                <div class="section-header">
                    <h3>Conversion History</h3>
                    <button id="clearHistory" class="clear-btn">
                        <i class="fas fa-trash"></i> Clear History
                    </button>
                </div>
                <div class="history-list" id="historyList">
                    <!-- History items will be populated here -->
                </div>
            </div>

            <div class="tools-section">
                <h3>Additional Tools</h3>
                <div class="tools-grid">
                    <div class="tool-card" id="batchConverterTool">
                        <div class="tool-icon">
                            <i class="fas fa-layer-group"></i>
                        </div>
                        <h4>Batch Converter</h4>
                        <p>Convert multiple file sizes at once with different units</p>
                        <button class="tool-btn">Open Tool</button>
                    </div>
                    <div class="tool-card" id="sizeCalculatorTool">
                        <div class="tool-icon">
                            <i class="fas fa-calculator"></i>
                        </div>
                        <h4>Size Calculator</h4>
                        <p>Calculate total size of multiple files and folders</p>
                        <button class="tool-btn">Open Tool</button>
                    </div>
                    <div class="tool-card" id="bandwidthTool">
                        <div class="tool-icon">
                            <i class="fas fa-tachometer-alt"></i>
                        </div>
                        <h4>Download Time</h4>
                        <p>Calculate download time based on file size and speed</p>
                        <button class="tool-btn">Open Tool</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Batch Converter Modal -->
    <div class="modal" id="batchConverterModal">
        <div class="modal-content large">
            <div class="modal-header">
                <h3>Batch File Size Converter</h3>
                <button class="close-modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="batch-input-section">
                    <div class="batch-controls">
                        <button id="addBatchRow" class="btn-primary">
                            <i class="fas fa-plus"></i> Add Row
                        </button>
                        <button id="clearBatch" class="btn-secondary">
                            <i class="fas fa-broom"></i> Clear All
                        </button>
                    </div>
                    <div class="batch-table-container">
                        <table class="batch-table">
                            <thead>
                                <tr>
                                    <th>Size</th>
                                    <th>From Unit</th>
                                    <th>To Unit</th>
                                    <th>Result</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="batchTableBody">
                                <!-- Batch rows will be added here -->
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="batch-actions">
                    <button id="convertBatch" class="btn-primary">Convert All</button>
                    <button id="copyBatchResults" class="btn-secondary">Copy Results</button>
                    <button class="btn-secondary close-modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Download Time Calculator Modal -->
    <div class="modal" id="downloadTimeModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Download Time Calculator</h3>
                <button class="close-modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="calculator-form">
                    <div class="form-group">
                        <label for="fileSize">File Size</label>
                        <div class="input-with-select">
                            <input type="number" id="fileSize" placeholder="Enter file size" step="any" min="0">
                            <select id="fileSizeUnit">
                                <option value="bytes">B</option>
                                <option value="kilobytes">KB</option>
                                <option value="megabytes" selected>MB</option>
                                <option value="gigabytes">GB</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="downloadSpeed">Download Speed</label>
                        <div class="input-with-select">
                            <input type="number" id="downloadSpeed" placeholder="Enter speed" step="any" min="0" value="10">
                            <select id="speedUnit">
                                <option value="Mbps">Mbps</option>
                                <option value="MBps">MB/s</option>
                                <option value="Kbps">Kbps</option>
                                <option value="KBps">KB/s</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="connectionType">Connection Type (Presets)</label>
                        <select id="connectionType">
                            <option value="custom">Custom Speed</option>
                            <option value="dialup">Dial-up (56 Kbps)</option>
                            <option value="dsl">DSL (1.5 Mbps)</option>
                            <option value="cable">Cable (10 Mbps)</option>
                            <option value="fiber">Fiber (50 Mbps)</option>
                            <option value="gigabit">Gigabit (100 Mbps)</option>
                            <option value="5g">5G Mobile (200 Mbps)</option>
                        </select>
                    </div>
                    <div class="calculator-result">
                        <h4>Estimated Download Time</h4>
                        <div class="time-result" id="downloadTimeResult">-</div>
                    </div>
                </div>
                <div class="modal-actions">
                    <button id="calculateDownloadTime" class="btn-primary">Calculate</button>
                    <button class="btn-secondary close-modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>