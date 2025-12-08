class ColorCodeConverter {
    constructor() {
        this.currentColor = '#3b82f6';
        this.colorHistory = JSON.parse(localStorage.getItem('colorHistory')) || [];
        this.stats = JSON.parse(localStorage.getItem('colorStats')) || {
            totalConversions: 0,
            formatUsage: {},
            colorHistory: 0
        };
        
        this.colorNames = {
            // This would be populated with color names from the PHP class
            // For client-side fallback, we'll use a subset
            'aliceblue': '#f0f8ff', 'antiquewhite': '#faebd7', 'aqua': '#00ffff',
            'aquamarine': '#7fffd4', 'azure': '#f0ffff', 'beige': '#f5f5dc',
            // ... more color names would be here
        };
        
        this.init();
    }

    init() {
        this.initializeEventListeners();
        this.updateStatsDisplay();
        this.renderHistory();
        this.updateColorDisplay(this.currentColor);
    }

    initializeEventListeners() {
        // Color picker events
        document.getElementById('colorPicker').addEventListener('input', (e) => {
            this.updateColorDisplay(e.target.value);
        });

        document.getElementById('manualHex').addEventListener('input', (e) => {
            const hex = e.target.value;
            if (this.isValidHex(hex)) {
                this.updateColorDisplay(hex);
            }
        });

        document.getElementById('applyColor').addEventListener('click', () => {
            const hex = document.getElementById('manualHex').value;
            if (this.isValidHex(hex)) {
                this.updateColorDisplay(hex);
            } else {
                this.showNotification('Please enter a valid HEX color', 'error');
            }
        });

        // Format copy buttons
        document.querySelectorAll('.copy-format').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const format = e.currentTarget.getAttribute('data-format');
                this.copyFormat(format);
            });
        });

        // Color conversion
        document.getElementById('convertColor').addEventListener('click', () => {
            this.convertColor();
        });

        // Palette actions
        document.getElementById('savePalette').addEventListener('click', () => {
            this.saveCurrentPalette();
        });

        document.getElementById('generatePalette').addEventListener('click', () => {
            this.openPaletteGenerator();
        });

        // History management
        document.getElementById('clearHistory').addEventListener('click', () => {
            this.clearHistory();
        });

        // Modal controls
        document.querySelectorAll('.close-modal').forEach(btn => {
            btn.addEventListener('click', () => this.hideModals());
        });

        // Palette generator
        document.getElementById('paletteColors').addEventListener('input', (e) => {
            document.getElementById('paletteCount').textContent = e.target.value;
        });

        document.getElementById('baseColor').addEventListener('input', (e) => {
            this.generatePalettePreview();
        });

        document.getElementById('paletteType').addEventListener('change', () => {
            this.generatePalettePreview();
        });

        document.getElementById('saveGeneratedPalette').addEventListener('click', () => {
            this.saveGeneratedPalette();
        });

        // Export buttons
        document.getElementById('exportCss').addEventListener('click', () => this.exportPalette('css'));
        document.getElementById('exportScss').addEventListener('click', () => this.exportPalette('scss'));
        document.getElementById('exportJson').addEventListener('click', () => this.exportPalette('json'));
        document.getElementById('copyPalette').addEventListener('click', () => this.copyPalette());

        // Use color button
        document.getElementById('useThisColor').addEventListener('click', () => {
            this.useColorFromDetails();
        });

        // Enter key support
        document.getElementById('fromValue').addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                this.convertColor();
            }
        });

        document.getElementById('manualHex').addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                this.applyColor();
            }
        });
    }

    async updateColorDisplay(hexColor) {
        this.currentColor = hexColor.toLowerCase();
        
        // Update color picker and manual input
        document.getElementById('colorPicker').value = this.currentColor;
        document.getElementById('manualHex').value = this.currentColor;
        
        // Update color display
        document.getElementById('colorDisplay').style.background = this.currentColor;
        document.getElementById('currentHex').textContent = this.currentColor.toUpperCase();
        
        try {
            // Get color information from server
            const response = await fetch('calculator.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    action: 'get_color_info',
                    color: this.currentColor,
                    format: 'hex'
                })
            });

            const data = await response.json();

            if (data.success) {
                this.updateAllFormats(data);
                this.updateColorProperties(data);
                this.generateColorSchemes(this.currentColor);
                this.updateAccessibility(data);
                this.addToHistory(this.currentColor, data);
            } else {
                throw new Error('Failed to get color info');
            }
        } catch (error) {
            console.error('Error:', error);
            // Fallback to client-side calculation
            this.updateAllFormatsClientSide(this.currentColor);
        }
    }

    updateAllFormats(data) {
        // Update format displays
        document.getElementById('formatHex').textContent = data.hex.toUpperCase();
        document.getElementById('formatRgb').textContent = `rgb(${data.rgb.r}, ${data.rgb.g}, ${data.rgb.b})`;
        document.getElementById('formatHsl').textContent = `hsl(${data.hsl.h}, ${data.hsl.s}%, ${data.hsl.l}%)`;
        document.getElementById('formatHsv').textContent = `hsv(${data.hsv.h}, ${data.hsv.s}%, ${data.hsv.v}%)`;
        document.getElementById('formatCmyk').textContent = `cmyk(${data.cmyk.c}%, ${data.cmyk.m}%, ${data.cmyk.y}%, ${data.cmyk.k}%)`;
        document.getElementById('formatName').textContent = data.name;
        
        // Update current RGB display
        document.getElementById('currentRgb').textContent = `RGB(${data.rgb.r}, ${data.rgb.g}, ${data.rgb.b})`;
    }

    updateAllFormatsClientSide(hexColor) {
        const rgb = this.hexToRgb(hexColor);
        const hsl = this.rgbToHsl(rgb);
        const hsv = this.rgbToHsv(rgb);
        const cmyk = this.rgbToCmyk(rgb);
        const name = this.rgbToName(rgb);

        document.getElementById('formatHex').textContent = hexColor.toUpperCase();
        document.getElementById('formatRgb').textContent = `rgb(${rgb.r}, ${rgb.g}, ${rgb.b})`;
        document.getElementById('formatHsl').textContent = `hsl(${hsl.h}, ${hsl.s}%, ${hsl.l}%)`;
        document.getElementById('formatHsv').textContent = `hsv(${hsv.h}, ${hsv.s}%, ${hsv.v}%)`;
        document.getElementById('formatCmyk').textContent = `cmyk(${cmyk.c}%, ${cmyk.m}%, ${cmyk.y}%, ${cmyk.k}%)`;
        document.getElementById('formatName').textContent = name;
        
        document.getElementById('currentRgb').textContent = `RGB(${rgb.r}, ${rgb.g}, ${rgb.b})`;
    }

    updateColorProperties(data) {
        document.getElementById('propertyHue').textContent = `${data.hsl.h}°`;
        document.getElementById('propertySaturation').textContent = `${data.hsl.s}%`;
        document.getElementById('propertyLightness').textContent = `${data.hsl.l}%`;
        document.getElementById('propertyLuminance').textContent = `${this.calculateLuminance(data.rgb)}%`;
        document.getElementById('propertyContrast').textContent = this.calculateContrastRatio(data.rgb);
        document.getElementById('propertyTemperature').textContent = this.getColorTemperature(data.hsl.h);
    }

    calculateLuminance(rgb) {
        const r = rgb.r / 255;
        const g = rgb.g / 255;
        const b = rgb.b / 255;

        const rs = r <= 0.03928 ? r / 12.92 : Math.pow((r + 0.055) / 1.055, 2.4);
        const gs = g <= 0.03928 ? g / 12.92 : Math.pow((g + 0.055) / 1.055, 2.4);
        const bs = b <= 0.03928 ? b / 12.92 : Math.pow((b + 0.055) / 1.055, 2.4);

        return Math.round((0.2126 * rs + 0.7152 * gs + 0.0722 * bs) * 100);
    }

    calculateContrastRatio(rgb) {
        const luminance = this.calculateLuminance(rgb) / 100;
        const whiteLuminance = 1;
        const blackLuminance = 0;
        
        const contrastWithWhite = (whiteLuminance + 0.05) / (luminance + 0.05);
        const contrastWithBlack = (luminance + 0.05) / (blackLuminance + 0.05);
        
        const maxContrast = Math.max(contrastWithWhite, contrastWithBlack);
        return maxContrast.toFixed(2) + ':1';
    }

    getColorTemperature(hue) {
        if (hue >= 0 && hue < 30) return 'Warm';
        if (hue >= 30 && hue < 90) return 'Neutral Warm';
        if (hue >= 90 && hue < 150) return 'Cool';
        if (hue >= 150 && hue < 210) return 'Neutral Cool';
        if (hue >= 210 && hue < 270) return 'Cool';
        if (hue >= 270 && hue < 330) return 'Neutral Warm';
        return 'Warm';
    }

    updateAccessibility(data) {
        const luminance = this.calculateLuminance(data.rgb) / 100;
        
        // Calculate contrast ratios
        const contrastWhite = (1 + 0.05) / (luminance + 0.05);
        const contrastBlack = (luminance + 0.05) / (0 + 0.05);
        
        // Update contrast tests
        this.updateContrastTest('white', contrastWhite);
        this.updateContrastTest('black', contrastBlack);
    }

    updateContrastTest(background, ratio) {
        const tests = document.querySelectorAll('.contrast-test');
        
        tests.forEach(test => {
            const sample = test.querySelector('.test-sample');
            const result = test.querySelector('.test-result');
            const info = test.querySelector('.test-info');
            
            if (sample.style.background.includes(background)) {
                const requirement = this.getContrastRequirement(test);
                const passes = ratio >= requirement;
                
                result.textContent = passes ? 'PASS' : 'FAIL';
                result.className = `test-result ${passes ? 'pass' : 'fail'}`;
                info.textContent = `${ratio.toFixed(2)}:1 (Requires ${requirement}:1)`;
            }
        });
    }

    getContrastRequirement(test) {
        const text = test.querySelector('span').textContent;
        if (text.includes('AAA')) {
            return text.includes('Large') ? 4.5 : 7;
        } else {
            return text.includes('Large') ? 3 : 4.5;
        }
    }

    async generateColorSchemes(baseColor) {
        const schemes = ['monochromatic', 'analogous', 'complementary', 'triadic'];
        
        for (const scheme of schemes) {
            try {
                const response = await fetch('calculator.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        action: 'generate_scheme',
                        baseColor: baseColor,
                        schemeType: scheme,
                        count: 5
                    })
                });

                const data = await response.json();

                if (data.success) {
                    this.updateSchemeDisplay(scheme, data.scheme);
                } else {
                    this.generateSchemeClientSide(scheme, baseColor);
                }
            } catch (error) {
                console.error('Error:', error);
                this.generateSchemeClientSide(scheme, baseColor);
            }
        }
    }

    generateSchemeClientSide(schemeType, baseColor) {
        const rgb = this.hexToRgb(baseColor);
        const hsl = this.rgbToHsl(rgb);
        let scheme = [];

        switch (schemeType) {
            case 'monochromatic':
                scheme = this.generateMonochromaticClient(hsl, 5);
                break;
            case 'analogous':
                scheme = this.generateAnalogousClient(hsl, 3);
                break;
            case 'complementary':
                scheme = this.generateComplementaryClient(hsl);
                break;
            case 'triadic':
                scheme = this.generateTriadicClient(hsl);
                break;
        }

        this.updateSchemeDisplay(schemeType, scheme);
    }

    updateSchemeDisplay(schemeType, colors) {
        const container = document.getElementById(`${schemeType}Scheme`);
        if (container) {
            container.innerHTML = colors.map(color => 
                `<div class="scheme-color" style="background: ${color};" data-color="${color}"></div>`
            ).join('');
            
            // Add click events to scheme colors
            container.querySelectorAll('.scheme-color').forEach(colorEl => {
                colorEl.addEventListener('click', () => {
                    this.updateColorDisplay(colorEl.getAttribute('data-color'));
                });
            });
        }
    }

    async convertColor() {
        const fromFormat = document.getElementById('fromFormat').value;
        const fromValue = document.getElementById('fromValue').value.trim();
        const toFormat = 'hex'; // Always convert to HEX for display

        if (!fromValue) {
            this.showNotification('Please enter a color value', 'warning');
            return;
        }

        try {
            const response = await fetch('calculator.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    action: 'convert',
                    color: fromValue,
                    fromFormat: fromFormat,
                    toFormat: toFormat
                })
            });

            const data = await response.json();

            if (data.success) {
                this.displayConversionResult(data, fromFormat, fromValue);
                this.updateStats(fromFormat);
            } else {
                throw new Error(data.error || 'Conversion failed');
            }
        } catch (error) {
            console.error('Error:', error);
            this.convertColorClientSide(fromFormat, fromValue, toFormat);
        }
    }

    convertColorClientSide(fromFormat, fromValue, toFormat) {
        try {
            const rgb = this.toRgb(fromValue, fromFormat);
            if (!rgb) {
                throw new Error('Invalid color format');
            }

            const result = this.rgbToHex(rgb);
            const data = {
                success: true,
                result: result,
                rgb: rgb,
                hex: result,
                hsl: this.rgbToHsl(rgb),
                hsv: this.rgbToHsv(rgb),
                cmyk: this.rgbToCmyk(rgb),
                name: this.rgbToName(rgb)
            };

            this.displayConversionResult(data, fromFormat, fromValue);
            this.updateStats(fromFormat);
        } catch (error) {
            this.showNotification('Error converting color', 'error');
        }
    }

    displayConversionResult(data, fromFormat, fromValue) {
        const resultContainer = document.getElementById('conversionResult');
        
        resultContainer.innerHTML = `
            <div class="conversion-success">
                <div class="converted-color-preview" style="background: ${data.hex};"></div>
                <div class="converted-info">
                    <div class="converted-hex">${data.hex.toUpperCase()}</div>
                    <div class="converted-details">
                        <strong>${fromValue}</strong> (${fromFormat.toUpperCase()}) → <strong>${data.hex.toUpperCase()}</strong> (HEX)
                    </div>
                    <button class="use-converted-btn" onclick="colorConverter.useConvertedColor('${data.hex}')">
                        Use This Color
                    </button>
                </div>
            </div>
        `;
    }

    useConvertedColor(hexColor) {
        this.updateColorDisplay(hexColor);
        this.hideModals();
    }

    useColorFromDetails() {
        const hex = document.getElementById('detailHex').textContent;
        this.updateColorDisplay(hex);
        this.hideModals();
    }

    copyFormat(format) {
        const formatElement = document.getElementById(`format${format.charAt(0).toUpperCase() + format.slice(1)}`);
        const text = formatElement.textContent;
        
        navigator.clipboard.writeText(text).then(() => {
            this.showNotification(`${format.toUpperCase()} color copied to clipboard!`, 'success');
        }).catch(() => {
            this.showNotification('Failed to copy color', 'error');
        });
    }

    addToHistory(hexColor, data) {
        // Check if color already exists in history
        const existingIndex = this.colorHistory.findIndex(item => item.hex === hexColor);
        
        if (existingIndex !== -1) {
            // Remove existing entry
            this.colorHistory.splice(existingIndex, 1);
        }
        
        // Add to beginning of history
        this.colorHistory.unshift({
            hex: hexColor,
            rgb: data.rgb,
            timestamp: new Date().toISOString()
        });
        
        // Keep only last 20 items
        if (this.colorHistory.length > 20) {
            this.colorHistory = this.colorHistory.slice(0, 20);
        }
        
        this.saveHistory();
        this.renderHistory();
        this.updateStatsDisplay();
    }

    renderHistory() {
        const historyGrid = document.getElementById('historyGrid');
        
        if (this.colorHistory.length === 0) {
            historyGrid.innerHTML = `
                <div class="history-color" style="grid-column: 1 / -1; text-align: center; padding: 40px;">
                    <p style="color: var(--text-secondary);">No color history yet</p>
                </div>
            `;
            return;
        }

        historyGrid.innerHTML = this.colorHistory.map(item => `
            <div class="history-color" onclick="colorConverter.updateColorDisplay('${item.hex}')">
                <div class="history-color-preview" style="background: ${item.hex};"></div>
                <div class="history-color-hex">${item.hex.toUpperCase()}</div>
            </div>
        `).join('');
    }

    clearHistory() {
        if (this.colorHistory.length === 0) return;
        
        if (confirm('Are you sure you want to clear all color history?')) {
            this.colorHistory = [];
            this.saveHistory();
            this.renderHistory();
            this.showNotification('History cleared', 'success');
        }
    }

    saveHistory() {
        localStorage.setItem('colorHistory', JSON.stringify(this.colorHistory));
        this.stats.colorHistory = this.colorHistory.length;
        localStorage.setItem('colorStats', JSON.stringify(this.stats));
    }

    updateStats(format) {
        this.stats.totalConversions++;
        
        if (!this.stats.formatUsage[format]) {
            this.stats.formatUsage[format] = 0;
        }
        this.stats.formatUsage[format]++;
        
        localStorage.setItem('colorStats', JSON.stringify(this.stats));
        this.updateStatsDisplay();
    }

    updateStatsDisplay() {
        document.getElementById('totalConversions').textContent = this.stats.totalConversions;
        document.getElementById('colorHistory').textContent = this.colorHistory.length;
        
        // Find most used format
        let mostUsedFormat = 'HEX';
        let maxUsage = 0;
        
        Object.entries(this.stats.formatUsage).forEach(([format, count]) => {
            if (count > maxUsage) {
                maxUsage = count;
                mostUsedFormat = format.toUpperCase();
            }
        });
        
        document.getElementById('popularFormat').textContent = mostUsedFormat;
    }

    // Client-side color conversion functions
    isValidHex(hex) {
        return /^#?([0-9A-F]{3}){1,2}$/i.test(hex);
    }

    hexToRgb(hex) {
        hex = hex.replace('#', '');
        
        if (hex.length === 3) {
            hex = hex[0] + hex[0] + hex[1] + hex[1] + hex[2] + hex[2];
        }
        
        const r = parseInt(hex.substring(0, 2), 16);
        const g = parseInt(hex.substring(2, 4), 16);
        const b = parseInt(hex.substring(4, 6), 16);
        
        return { r, g, b };
    }

    rgbToHex(rgb) {
        return '#' + [rgb.r, rgb.g, rgb.b].map(x => {
            const hex = x.toString(16);
            return hex.length === 1 ? '0' + hex : hex;
        }).join('');
    }

    rgbToHsl(rgb) {
        const r = rgb.r / 255;
        const g = rgb.g / 255;
        const b = rgb.b / 255;

        const max = Math.max(r, g, b);
        const min = Math.min(r, g, b);
        let h, s, l = (max + min) / 2;

        if (max === min) {
            h = s = 0;
        } else {
            const d = max - min;
            s = l > 0.5 ? d / (2 - max - min) : d / (max + min);
            
            switch (max) {
                case r: h = (g - b) / d + (g < b ? 6 : 0); break;
                case g: h = (b - r) / d + 2; break;
                case b: h = (r - g) / d + 4; break;
            }
            h /= 6;
        }

        return {
            h: Math.round(h * 360),
            s: Math.round(s * 100),
            l: Math.round(l * 100)
        };
    }

    rgbToHsv(rgb) {
        const r = rgb.r / 255;
        const g = rgb.g / 255;
        const b = rgb.b / 255;

        const max = Math.max(r, g, b);
        const min = Math.min(r, g, b);
        const d = max - min;
        
        let h = 0;
        const s = max === 0 ? 0 : d / max;
        const v = max;

        if (max !== min) {
            switch (max) {
                case r: h = (g - b) / d + (g < b ? 6 : 0); break;
                case g: h = (b - r) / d + 2; break;
                case b: h = (r - g) / d + 4; break;
            }
            h /= 6;
        }

        return {
            h: Math.round(h * 360),
            s: Math.round(s * 100),
            v: Math.round(v * 100)
        };
    }

    rgbToCmyk(rgb) {
        const r = rgb.r / 255;
        const g = rgb.g / 255;
        const b = rgb.b / 255;

        const k = 1 - Math.max(r, g, b);
        
        if (k === 1) {
            return { c: 0, m: 0, y: 0, k: 100 };
        }

        const c = (1 - r - k) / (1 - k);
        const m = (1 - g - k) / (1 - k);
        const y = (1 - b - k) / (1 - k);

        return {
            c: Math.round(c * 100),
            m: Math.round(m * 100),
            y: Math.round(y * 100),
            k: Math.round(k * 100)
        };
    }

    rgbToName(rgb) {
        const hex = this.rgbToHex(rgb);
        for (const [name, value] of Object.entries(this.colorNames)) {
            if (value.toLowerCase() === hex.toLowerCase()) {
                return name;
            }
        }
        return 'Unknown';
    }

    toRgb(color, format) {
        switch (format) {
            case 'hex':
                return this.hexToRgb(color);
            case 'rgb':
                return this.parseRgb(color);
            case 'hsl':
                return this.hslToRgb(color);
            default:
                return null;
        }
    }

    parseRgb(rgbString) {
        const match = rgbString.match(/rgb\((\d+),\s*(\d+),\s*(\d+)\)/i);
        if (match) {
            return {
                r: parseInt(match[1]),
                g: parseInt(match[2]),
                b: parseInt(match[3])
            };
        }
        return null;
    }

    hslToRgb(hslString) {
        const match = hslString.match(/hsl\((\d+),\s*(\d+)%,\s*(\d+)%\)/i);
        if (match) {
            const h = parseInt(match[1]) / 360;
            const s = parseInt(match[2]) / 100;
            const l = parseInt(match[3]) / 100;

            if (s === 0) {
                const value = Math.round(l * 255);
                return { r: value, g: value, b: value };
            }

            const hue2rgb = (p, q, t) => {
                if (t < 0) t += 1;
                if (t > 1) t -= 1;
                if (t < 1/6) return p + (q - p) * 6 * t;
                if (t < 1/2) return q;
                if (t < 2/3) return p + (q - p) * (2/3 - t) * 6;
                return p;
            };

            const q = l < 0.5 ? l * (1 + s) : l + s - l * s;
            const p = 2 * l - q;

            const r = hue2rgb(p, q, h + 1/3);
            const g = hue2rgb(p, q, h);
            const b = hue2rgb(p, q, h - 1/3);

            return {
                r: Math.round(r * 255),
                g: Math.round(g * 255),
                b: Math.round(b * 255)
            };
        }
        return null;
    }

    // Color scheme generation (client-side fallback)
    generateMonochromaticClient(hsl, count) {
        const scheme = [];
        const step = 100 / (count - 1);

        for (let i = 0; i < count; i++) {
            const lightness = i * step;
            const rgb = this.hslToRgb(`hsl(${hsl.h}, ${hsl.s}%, ${lightness}%)`);
            scheme.push(this.rgbToHex(rgb));
        }

        return scheme;
    }

    generateAnalogousClient(hsl, count) {
        const scheme = [];
        const angle = 30;

        for (let i = -1; i <= 1; i++) {
            const newHue = (hsl.h + i * angle + 360) % 360;
            const rgb = this.hslToRgb(`hsl(${newHue}, ${hsl.s}%, ${hsl.l}%)`);
            scheme.push(this.rgbToHex(rgb));
        }

        return scheme;
    }

    generateComplementaryClient(hsl) {
        const compHue = (hsl.h + 180) % 360;
        const rgb1 = this.hslToRgb(`hsl(${hsl.h}, ${hsl.s}%, ${hsl.l}%)`);
        const rgb2 = this.hslToRgb(`hsl(${compHue}, ${hsl.s}%, ${hsl.l}%)`);
        
        return [this.rgbToHex(rgb1), this.rgbToHex(rgb2)];
    }

    generateTriadicClient(hsl) {
        const hues = [hsl.h, (hsl.h + 120) % 360, (hsl.h + 240) % 360];
        return hues.map(hue => {
            const rgb = this.hslToRgb(`hsl(${hue}, ${hsl.s}%, ${hsl.l}%)`);
            return this.rgbToHex(rgb);
        });
    }

    // Palette Generator Methods
    openPaletteGenerator() {
        document.getElementById('paletteGeneratorModal').classList.add('active');
        this.generatePalettePreview();
    }

    generatePalettePreview() {
        const baseColor = document.getElementById('baseColor').value;
        const paletteType = document.getElementById('paletteType').value;
        const colorCount = parseInt(document.getElementById('paletteColors').value);

        this.generateColorSchemeForPalette(baseColor, paletteType, colorCount);
    }

    async generateColorSchemeForPalette(baseColor, schemeType, count) {
        try {
            const response = await fetch('calculator.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    action: 'generate_scheme',
                    baseColor: baseColor,
                    schemeType: schemeType,
                    count: count
                })
            });

            const data = await response.json();

            if (data.success) {
                this.displayGeneratedPalette(data.scheme);
            } else {
                throw new Error('Failed to generate palette');
            }
        } catch (error) {
            console.error('Error:', error);
            // Client-side fallback
            this.generatePaletteClientSide(baseColor, schemeType, count);
        }
    }

    generatePaletteClientSide(baseColor, schemeType, count) {
        const rgb = this.hexToRgb(baseColor);
        const hsl = this.rgbToHsl(rgb);
        let scheme = [];

        switch (schemeType) {
            case 'monochromatic':
                scheme = this.generateMonochromaticClient(hsl, count);
                break;
            case 'analogous':
                scheme = this.generateAnalogousClient(hsl, count);
                break;
            case 'complementary':
                scheme = this.generateComplementaryClient(hsl);
                break;
            case 'triadic':
                scheme = this.generateTriadicClient(hsl);
                break;
            // Add more scheme types as needed
            default:
                scheme = this.generateMonochromaticClient(hsl, count);
        }

        this.displayGeneratedPalette(scheme);
    }

    displayGeneratedPalette(colors) {
        const preview = document.getElementById('palettePreview');
        preview.innerHTML = colors.map(color => 
            `<div class="palette-color" style="background: ${color}; flex: 1;" data-color="${color}"></div>`
        ).join('');

        // Add click events to palette colors
        preview.querySelectorAll('.palette-color').forEach(colorEl => {
            colorEl.addEventListener('click', () => {
                this.updateColorDisplay(colorEl.getAttribute('data-color'));
            });
        });
    }

    saveGeneratedPalette() {
        const colors = Array.from(document.querySelectorAll('#palettePreview .palette-color'))
            .map(el => el.getAttribute('data-color'));
        
        const paletteType = document.getElementById('paletteType').value;
        
        this.savePaletteToHistory(colors, `${paletteType} Palette`);
        this.showNotification('Palette saved to history!', 'success');
    }

    saveCurrentPalette() {
        // For now, save a simple monochromatic palette based on current color
        const rgb = this.hexToRgb(this.currentColor);
        const hsl = this.rgbToHsl(rgb);
        const colors = this.generateMonochromaticClient(hsl, 5);
        
        this.savePaletteToHistory(colors, 'Current Color Palette');
        this.showNotification('Palette saved to history!', 'success');
    }

    savePaletteToHistory(colors, name) {
        // This would typically save to a separate palettes array
        // For now, we'll just show a notification
        console.log('Saving palette:', name, colors);
    }

    exportPalette(format) {
        const colors = Array.from(document.querySelectorAll('#palettePreview .palette-color'))
            .map(el => el.getAttribute('data-color'));
        
        let content = '';
        
        switch (format) {
            case 'css':
                content = this.exportAsCss(colors);
                break;
            case 'scss':
                content = this.exportAsScss(colors);
                break;
            case 'json':
                content = this.exportAsJson(colors);
                break;
        }
        
        navigator.clipboard.writeText(content).then(() => {
            this.showNotification(`Palette exported as ${format.toUpperCase()}!`, 'success');
        });
    }

    exportAsCss(colors) {
        return `:root {\n${colors.map((color, index) => `  --color-${index + 1}: ${color};`).join('\n')}\n}`;
    }

    exportAsScss(colors) {
        return colors.map((color, index) => `$color-${index + 1}: ${color};`).join('\n');
    }

    exportAsJson(colors) {
        return JSON.stringify({ palette: colors }, null, 2);
    }

    copyPalette() {
        const colors = Array.from(document.querySelectorAll('#palettePreview .palette-color'))
            .map(el => el.getAttribute('data-color'));
        
        const text = colors.join(', ');
        navigator.clipboard.writeText(text).then(() => {
            this.showNotification('Palette colors copied!', 'success');
        });
    }

    hideModals() {
        document.querySelectorAll('.modal').forEach(modal => {
            modal.classList.remove('active');
        });
    }

    showNotification(message, type = 'info') {
        // Remove existing notifications
        const existingNotification = document.querySelector('.notification');
        if (existingNotification) {
            existingNotification.remove();
        }

        const notification = document.createElement('div');
        notification.className = `notification ${type}`;
        notification.innerHTML = `
            <div class="notification-content">
                <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : type === 'warning' ? 'exclamation-triangle' : 'info-circle'}"></i>
                <span>${message}</span>
            </div>
        `;

        // Add styles
        notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            background: ${type === 'success' ? '#10b981' : type === 'error' ? '#ef4444' : type === 'warning' ? '#f59e0b' : '#3b82f6'};
            color: white;
            padding: 16px 20px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            z-index: 1000;
            transform: translateX(100%);
            transition: transform 0.3s ease;
            max-width: 300px;
        `;

        document.body.appendChild(notification);

        // Animate in
        setTimeout(() => {
            notification.style.transform = 'translateX(0)';
        }, 100);

        // Auto remove after 5 seconds
        setTimeout(() => {
            notification.style.transform = 'translateX(100%)';
            setTimeout(() => notification.remove(), 300);
        }, 5000);
    }
}

// Initialize the application
const colorConverter = new ColorCodeConverter();

// Make available globally for onclick handlers
window.colorConverter = colorConverter;