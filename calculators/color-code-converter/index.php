<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Color Code Converter - Convert Between Color Formats</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <header class="header">
            <div class="header-content">
                <h1><i class="fas fa-palette"></i> Color Code Converter</h1>
                <p>Convert between HEX, RGB, HSL, HSV, CMYK, and color names</p>
            </div>
            <div class="header-stats">
                <div class="stat">
                    <span class="stat-number" id="totalConversions">0</span>
                    <span class="stat-label">Conversions</span>
                </div>
                <div class="stat">
                    <span class="stat-number" id="popularFormat">HEX</span>
                    <span class="stat-label">Most Used</span>
                </div>
                <div class="stat">
                    <span class="stat-number" id="colorHistory">0</span>
                    <span class="stat-label">Colors</span>
                </div>
            </div>
        </header>

        <div class="main-content">
            <div class="converter-section">
                <div class="color-picker-section">
                    <div class="color-picker-card">
                        <h3>Color Picker</h3>
                        <div class="color-picker-container">
                            <div class="color-preview">
                                <div class="color-display" id="colorDisplay" style="background: #3b82f6;"></div>
                                <div class="color-info">
                                    <div class="color-hex" id="currentHex">#3B82F6</div>
                                    <div class="color-rgb" id="currentRgb">RGB(59, 130, 246)</div>
                                </div>
                            </div>
                            <div class="color-controls">
                                <input type="color" id="colorPicker" value="#3b82f6" class="native-color-picker">
                                <div class="manual-inputs">
                                    <div class="input-group">
                                        <label for="manualHex">HEX Color</label>
                                        <input type="text" id="manualHex" value="#3b82f6" placeholder="#RRGGBB">
                                    </div>
                                    <button id="applyColor" class="apply-btn">
                                        <i class="fas fa-check"></i> Apply Color
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="color-formats-card">
                        <h3>Color Formats</h3>
                        <div class="formats-grid">
                            <div class="format-item">
                                <label>HEX</label>
                                <div class="format-value" id="formatHex">#3B82F6</div>
                                <button class="copy-format" data-format="hex">
                                    <i class="fas fa-copy"></i>
                                </button>
                            </div>
                            <div class="format-item">
                                <label>RGB</label>
                                <div class="format-value" id="formatRgb">rgb(59, 130, 246)</div>
                                <button class="copy-format" data-format="rgb">
                                    <i class="fas fa-copy"></i>
                                </button>
                            </div>
                            <div class="format-item">
                                <label>HSL</label>
                                <div class="format-value" id="formatHsl">hsl(217, 92%, 60%)</div>
                                <button class="copy-format" data-format="hsl">
                                    <i class="fas fa-copy"></i>
                                </button>
                            </div>
                            <div class="format-item">
                                <label>HSV</label>
                                <div class="format-value" id="formatHsv">hsv(217, 76%, 96%)</div>
                                <button class="copy-format" data-format="hsv">
                                    <i class="fas fa-copy"></i>
                                </button>
                            </div>
                            <div class="format-item">
                                <label>CMYK</label>
                                <div class="format-value" id="formatCmyk">cmyk(76%, 47%, 0%, 4%)</div>
                                <button class="copy-format" data-format="cmyk">
                                    <i class="fas fa-copy"></i>
                                </button>
                            </div>
                            <div class="format-item">
                                <label>Color Name</label>
                                <div class="format-value" id="formatName">Royal Blue</div>
                                <button class="copy-format" data-format="name">
                                    <i class="fas fa-copy"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="conversion-tools">
                    <div class="tools-card">
                        <h3>Conversion Tools</h3>
                        <div class="tools-grid">
                            <div class="tool-converter">
                                <h4>Convert From</h4>
                                <div class="converter-inputs">
                                    <select id="fromFormat">
                                        <option value="hex">HEX</option>
                                        <option value="rgb">RGB</option>
                                        <option value="hsl">HSL</option>
                                        <option value="hsv">HSV</option>
                                        <option value="cmyk">CMYK</option>
                                        <option value="name">Color Name</option>
                                    </select>
                                    <input type="text" id="fromValue" placeholder="Enter color value">
                                    <button id="convertColor" class="convert-btn">
                                        <i class="fas fa-sync-alt"></i> Convert
                                    </button>
                                </div>
                            </div>
                            <div class="tool-result">
                                <h4>Converted To</h4>
                                <div class="result-display" id="conversionResult">
                                    <div class="result-placeholder">
                                        Select format and enter color to convert
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="color-schemes">
                        <h3>Color Schemes</h3>
                        <div class="schemes-grid">
                            <div class="scheme-type">
                                <h5>Monochromatic</h5>
                                <div class="scheme-colors" id="monochromaticScheme">
                                    <div class="scheme-color" style="background: #1e40af;"></div>
                                    <div class="scheme-color" style="background: #3b82f6;"></div>
                                    <div class="scheme-color" style="background: #60a5fa;"></div>
                                    <div class="scheme-color" style="background: #93c5fd;"></div>
                                    <div class="scheme-color" style="background: #dbeafe;"></div>
                                </div>
                            </div>
                            <div class="scheme-type">
                                <h5>Analogous</h5>
                                <div class="scheme-colors" id="analogousScheme">
                                    <div class="scheme-color" style="background: #3b82f6;"></div>
                                    <div class="scheme-color" style="background: #3b82f6;"></div>
                                    <div class="scheme-color" style="background: #3b82f6;"></div>
                                </div>
                            </div>
                            <div class="scheme-type">
                                <h5>Complementary</h5>
                                <div class="scheme-colors" id="complementaryScheme">
                                    <div class="scheme-color" style="background: #3b82f6;"></div>
                                    <div class="scheme-color" style="background: #f59e0b;"></div>
                                </div>
                            </div>
                            <div class="scheme-type">
                                <h5>Triadic</h5>
                                <div class="scheme-colors" id="triadicScheme">
                                    <div class="scheme-color" style="background: #3b82f6;"></div>
                                    <div class="scheme-color" style="background: #f63b82;"></div>
                                    <div class="scheme-color" style="background: #82f63b;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="color-properties">
                <div class="properties-card">
                    <h3>Color Properties</h3>
                    <div class="properties-grid">
                        <div class="property-item">
                            <div class="property-icon">
                                <i class="fas fa-tint"></i>
                            </div>
                            <div class="property-content">
                                <span class="property-label">Hue</span>
                                <span class="property-value" id="propertyHue">217°</span>
                            </div>
                        </div>
                        <div class="property-item">
                            <div class="property-icon">
                                <i class="fas fa-sun"></i>
                            </div>
                            <div class="property-content">
                                <span class="property-label">Saturation</span>
                                <span class="property-value" id="propertySaturation">92%</span>
                            </div>
                        </div>
                        <div class="property-item">
                            <div class="property-icon">
                                <i class="fas fa-adjust"></i>
                            </div>
                            <div class="property-content">
                                <span class="property-label">Lightness</span>
                                <span class="property-value" id="propertyLightness">60%</span>
                            </div>
                        </div>
                        <div class="property-item">
                            <div class="property-icon">
                                <i class="fas fa-eye"></i>
                            </div>
                            <div class="property-content">
                                <span class="property-label">Luminance</span>
                                <span class="property-value" id="propertyLuminance">36%</span>
                            </div>
                        </div>
                        <div class="property-item">
                            <div class="property-icon">
                                <i class="fas fa-contrast"></i>
                            </div>
                            <div class="property-content">
                                <span class="property-label">Contrast Ratio</span>
                                <span class="property-value" id="propertyContrast">4.63:1</span>
                            </div>
                        </div>
                        <div class="property-item">
                            <div class="property-icon">
                                <i class="fas fa-temperature-high"></i>
                            </div>
                            <div class="property-content">
                                <span class="property-label">Color Temperature</span>
                                <span class="property-value" id="propertyTemperature">Cool</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accessibility-card">
                    <h3>Accessibility</h3>
                    <div class="contrast-tests">
                        <div class="contrast-test">
                            <div class="test-sample" style="background: #000000; color: #3b82f6;">
                                <span>AA Large Text</span>
                                <span class="test-result pass">PASS</span>
                            </div>
                            <div class="test-info">3.02:1 (Requires 3:1)</div>
                        </div>
                        <div class="contrast-test">
                            <div class="test-sample" style="background: #ffffff; color: #3b82f6;">
                                <span>AA Normal Text</span>
                                <span class="test-result pass">PASS</span>
                            </div>
                            <div class="test-info">4.63:1 (Requires 4.5:1)</div>
                        </div>
                        <div class="contrast-test">
                            <div class="test-sample" style="background: #000000; color: #3b82f6;">
                                <span>AAA Large Text</span>
                                <span class="test-result fail">FAIL</span>
                            </div>
                            <div class="test-info">3.02:1 (Requires 4.5:1)</div>
                        </div>
                        <div class="contrast-test">
                            <div class="test-sample" style="background: #ffffff; color: #3b82f6;">
                                <span>AAA Normal Text</span>
                                <span class="test-result fail">FAIL</span>
                            </div>
                            <div class="test-info">4.63:1 (Requires 7:1)</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="color-palettes">
                <div class="section-header">
                    <h3>Color Palettes</h3>
                    <div class="palette-actions">
                        <button id="savePalette" class="btn-primary">
                            <i class="fas fa-save"></i> Save Palette
                        </button>
                        <button id="generatePalette" class="btn-secondary">
                            <i class="fas fa-random"></i> Generate
                        </button>
                    </div>
                </div>
                <div class="palettes-grid" id="palettesGrid">
                    <div class="palette-card">
                        <div class="palette-colors">
                            <div class="palette-color" style="background: #3b82f6;"></div>
                            <div class="palette-color" style="background: #1e40af;"></div>
                            <div class="palette-color" style="background: #60a5fa;"></div>
                            <div class="palette-color" style="background: #93c5fd;"></div>
                            <div class="palette-color" style="background: #dbeafe;"></div>
                        </div>
                        <div class="palette-info">
                            <h4>Blue Spectrum</h4>
                            <p>Monochromatic</p>
                        </div>
                    </div>
                    <div class="palette-card">
                        <div class="palette-colors">
                            <div class="palette-color" style="background: #3b82f6;"></div>
                            <div class="palette-color" style="background: #f59e0b;"></div>
                            <div class="palette-color" style="background: #10b981;"></div>
                            <div class="palette-color" style="background: #ef4444;"></div>
                            <div class="palette-color" style="background: #8b5cf6;"></div>
                        </div>
                        <div class="palette-info">
                            <h4>Vibrant Mix</h4>
                            <p>Complementary</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="color-history">
                <div class="section-header">
                    <h3>Recent Colors</h3>
                    <button id="clearHistory" class="clear-btn">
                        <i class="fas fa-trash"></i> Clear History
                    </button>
                </div>
                <div class="history-grid" id="historyGrid">
                    <!-- History items will be populated here -->
                </div>
            </div>
        </div>
    </div>

    <!-- Color Details Modal -->
    <div class="modal" id="colorDetailsModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Color Details</h3>
                <button class="close-modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="color-detail-preview">
                    <div class="detail-color-display" id="detailColorDisplay"></div>
                    <div class="detail-color-info">
                        <div class="detail-hex" id="detailHex"></div>
                        <div class="detail-rgb" id="detailRgb"></div>
                        <div class="detail-hsl" id="detailHsl"></div>
                    </div>
                </div>
                <div class="color-detail-formats">
                    <h4>All Formats</h4>
                    <div class="detail-formats-grid">
                        <div class="detail-format">
                            <span>HEX</span>
                            <span id="detailFormatHex"></span>
                        </div>
                        <div class="detail-format">
                            <span>RGB</span>
                            <span id="detailFormatRgb"></span>
                        </div>
                        <div class="detail-format">
                            <span>HSL</span>
                            <span id="detailFormatHsl"></span>
                        </div>
                        <div class="detail-format">
                            <span>HSV</span>
                            <span id="detailFormatHsv"></span>
                        </div>
                        <div class="detail-format">
                            <span>CMYK</span>
                            <span id="detailFormatCmyk"></span>
                        </div>
                        <div class="detail-format">
                            <span>CSS</span>
                            <span id="detailFormatCss"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-actions">
                    <button id="useThisColor" class="btn-primary">Use This Color</button>
                    <button class="btn-secondary close-modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Palette Generator Modal -->
    <div class="modal" id="paletteGeneratorModal">
        <div class="modal-content large">
            <div class="modal-header">
                <h3>Palette Generator</h3>
                <button class="close-modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="generator-controls">
                    <div class="control-group">
                        <label for="paletteType">Palette Type</label>
                        <select id="paletteType">
                            <option value="monochromatic">Monochromatic</option>
                            <option value="analogous">Analogous</option>
                            <option value="complementary">Complementary</option>
                            <option value="triadic">Triadic</option>
                            <option value="tetradic">Tetradic</option>
                            <option value="split-complementary">Split Complementary</option>
                            <option value="square">Square</option>
                        </select>
                    </div>
                    <div class="control-group">
                        <label for="paletteColors">Number of Colors</label>
                        <input type="range" id="paletteColors" min="3" max="8" value="5">
                        <span id="paletteCount">5</span>
                    </div>
                    <div class="control-group">
                        <label for="baseColor">Base Color</label>
                        <input type="color" id="baseColor" value="#3b82f6">
                    </div>
                </div>
                <div class="generated-palette">
                    <h4>Generated Palette</h4>
                    <div class="palette-preview" id="palettePreview">
                        <!-- Generated palette will appear here -->
                    </div>
                </div>
                <div class="palette-export">
                    <h4>Export Palette</h4>
                    <div class="export-options">
                        <button id="exportCss" class="export-btn">CSS Variables</button>
                        <button id="exportScss" class="export-btn">SCSS Variables</button>
                        <button id="exportJson" class="export-btn">JSON</button>
                        <button id="copyPalette" class="export-btn">Copy Colors</button>
                    </div>
                </div>
                <div class="modal-actions">
                    <button id="saveGeneratedPalette" class="btn-primary">Save Palette</button>
                    <button class="btn-secondary close-modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>