
class FileSizeConverter {
    constructor() {
        this.conversionHistory = JSON.parse(localStorage.getItem('fileSizeConversionHistory')) || [];
        this.stats = JSON.parse(localStorage.getItem('fileSizeStats')) || {
            totalConversions: 0,
            unitUsage: {},
            accuracyRate: 100
        };
        
        this.unitFactors = {
            // Decimal units (Base 10)
            bytes: 1,
            kilobytes: 1000,
            megabytes: 1000000,
            gigabytes: 1000000000,
            terabytes: 1000000000000,
            petabytes: 1000000000000000,
            
            // Binary units (Base 2)
            kibibytes: 1024,
            mebibytes: 1048576,
            gibibytes: 1073741824,
            tebibytes: 1099511627776
        };
        
        this.unitSymbols = {
            bytes: 'B',
            kilobytes: 'KB',
            megabytes: 'MB',
            gigabytes: 'GB',
            terabytes: 'TB',
            petabytes: 'PB',
            kibibytes: 'KiB',
            mebibytes: 'MiB',
            gibibytes: 'GiB',
            tebibytes: 'TiB'
        };
        
        this.init();
    }

    init() {
        this.initializeEventListeners();
        this.updateStatsDisplay();
        this.renderHistory();
        this.setupRealTimeConversion();
    }

    initializeEventListeners() {
        // Main conversion
        document.getElementById('convertBtn').addEventListener('click', () => this.convert());
        document.getElementById('resetBtn').addEventListener('click', () => this.reset());
        document.getElementById('copyResult').addEventListener('click', () => this.copyResult());
        document.getElementById('swapUnits').addEventListener('click', () => this.swapUnits());
        
        // Quick conversions
        document.querySelectorAll('.quick-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const fromUnit = e.target.getAttribute('data-from');
                const toUnit = e.target.getAttribute('data-to');
                this.setQuickConversion(fromUnit, toUnit);
            });
        });

        // Precision control
        document.getElementById('decimalPlaces').addEventListener('change', () => {
            if (document.getElementById('inputValue').value) {
                this.convert();
            }
        });

        // History management
        document.getElementById('clearHistory').addEventListener('click', () => this.clearHistory());

        // Tool buttons
        document.getElementById('batchConverterTool').addEventListener('click', () => this.openBatchConverter());
        document.getElementById('bandwidthTool').addEventListener('click', () => this.openDownloadTimeCalculator());

        // Modal controls
        document.querySelectorAll('.close-modal').forEach(btn => {
            btn.addEventListener('click', () => this.hideModals());
        });

        // Batch converter
        document.getElementById('addBatchRow').addEventListener('click', () => this.addBatchRow());
        document.getElementById('clearBatch').addEventListener('click', () => this.clearBatch());
        document.getElementById('convertBatch').addEventListener('click', () => this.convertBatch());
        document.getElementById('copyBatchResults').addEventListener('click', () => this.copyBatchResults());

        // Download time calculator
        document.getElementById('calculateDownloadTime').addEventListener('click', () => this.calculateDownloadTime());
        document.getElementById('connectionType').addEventListener('change', (e) => this.setConnectionPreset(e.target.value));

        // Enter key support
        document.getElementById('inputValue').addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                this.convert();
            }
        });
    }

    setupRealTimeConversion() {
        const inputValue = document.getElementById('inputValue');
        let conversionTimeout;

        inputValue.addEventListener('input', (e) => {
            clearTimeout(conversionTimeout);
            const value = e.target.value;

            if (value && !isNaN(value) && value > 0) {
                conversionTimeout = setTimeout(() => {
                    this.convert();
                }, 500);
            } else {
                this.resetResultDisplay();
            }
        });
    }

    async convert() {
        const inputValue = parseFloat(document.getElementById('inputValue').value);
        const fromUnit = document.getElementById('fromUnit').value;
        const toUnit = document.getElementById('toUnit').value;
        const precision = parseInt(document.getElementById('decimalPlaces').value);

        if (!inputValue || isNaN(inputValue) || inputValue < 0) {
            this.showNotification('Please enter a valid positive number', 'warning');
            return;
        }

        try {
            this.setLoadingState(true);

            const response = await fetch('calculator.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    action: 'convert',
                    value: inputValue,
                    fromUnit: fromUnit,
                    toUnit: toUnit,
                    precision: precision
                })
            });

            const data = await response.json();

            if (data.success) {
                this.displayResult(data);
                this.addToHistory(data);
                this.updateStats(fromUnit, toUnit);
            } else {
                throw new Error(data.error || 'Conversion failed');
            }
        } catch (error) {
            console.error('Error:', error);
            this.showNotification('Error performing conversion', 'error');
            this.displayClientSideConversion(inputValue, fromUnit, toUnit, precision);
        } finally {
            this.setLoadingState(false);
        }
    }

    displayClientSideConversion(value, fromUnit, toUnit, precision) {
        try {
            const bytes = value * this.unitFactors[fromUnit];
            const result = bytes / this.unitFactors[toUnit];
            const formattedResult = this.formatNumber(result, precision);

            const resultData = {
                originalValue: value,
                originalUnit: fromUnit,
                convertedValue: formattedResult,
                targetUnit: toUnit,
                sizeInBytes: bytes,
                formula: this.getConversionFormula(value, fromUnit, toUnit, bytes),
                readable: this.formatReadable(formattedResult, toUnit)
            };

            this.displayResult(resultData);
            this.addToHistory(resultData);
            this.updateStats(fromUnit, toUnit);
        } catch (error) {
            this.showNotification('Error performing conversion', 'error');
        }
    }

    displayResult(data) {
        const originalValue = document.getElementById('originalValue');
        const convertedValue = document.getElementById('convertedValue');
        const conversionFormula = document.getElementById('conversionFormula');
        const sizeInBytes = document.getElementById('sizeInBytes');
        const copyBtn = document.getElementById('copyResult');

        originalValue.textContent = this.formatReadable(data.originalValue, data.originalUnit);
        convertedValue.textContent = data.readable;
        conversionFormula.textContent = data.formula;
        sizeInBytes.textContent = this.formatBytes(data.sizeInBytes);

        copyBtn.disabled = false;

        // Add animation
        convertedValue.style.animation = 'none';
        setTimeout(() => {
            convertedValue.style.animation = 'pulse 0.5s ease-in-out';
        }, 10);
    }

    formatNumber(number, precision) {
        if (number === 0) return 0;
        
        let formatted = number.toFixed(precision);
        
        // Remove trailing zeros and decimal point if not needed
        if (precision > 0) {
            formatted = formatted.replace(/\.?0+$/, '');
        }
        
        return parseFloat(formatted);
    }

    formatReadable(value, unit) {
        const symbol = this.unitSymbols[unit];
        return this.formatNumber(value, 6) + ' ' + symbol;
    }

    formatBytes(bytes) {
        if (bytes === 0) return '0 B';
        
        const sizes = ['B', 'KB', 'MB', 'GB', 'TB'];
        const i = Math.floor(Math.log(bytes) / Math.log(1024));
        
        if (i === 0) return bytes + ' B';
        
        return (bytes / Math.pow(1024, i)).toFixed(2) + ' ' + sizes[i];
    }

    getConversionFormula(value, fromUnit, toUnit, bytes) {
        const fromFactor = this.unitFactors[fromUnit];
        const toFactor = this.unitFactors[toUnit];
        
        if (fromUnit === 'bytes') {
            return `${value} B × (1 / ${toFactor}) = ${value / toFactor} ${this.unitSymbols[toUnit]}`;
        } else if (toUnit === 'bytes') {
            return `${value} ${this.unitSymbols[fromUnit]} × ${fromFactor} = ${bytes} B`;
        } else {
            return `${value} ${this.unitSymbols[fromUnit]} × (${fromFactor} / ${toFactor}) = ${value * fromFactor / toFactor} ${this.unitSymbols[toUnit]}`;
        }
    }

    reset() {
        document.getElementById('inputValue').value = '';
        this.resetResultDisplay();
        document.getElementById('inputValue').focus();
    }

    resetResultDisplay() {
        document.getElementById('originalValue').textContent = '-';
        document.getElementById('convertedValue').textContent = '-';
        document.getElementById('conversionFormula').textContent = '-';
        document.getElementById('sizeInBytes').textContent = '-';
        document.getElementById('copyResult').disabled = true;
    }

    swapUnits() {
        const fromUnit = document.getElementById('fromUnit');
        const toUnit = document.getElementById('toUnit');
        
        const tempValue = fromUnit.value;
        fromUnit.value = toUnit.value;
        toUnit.value = tempValue;

        // If there's a value in the input, convert immediately
        if (document.getElementById('inputValue').value) {
            this.convert();
        }
    }

    setQuickConversion(fromUnit, toUnit) {
        document.getElementById('fromUnit').value = fromUnit;
        document.getElementById('toUnit').value = toUnit;
        
        // Focus on input and convert if there's a value
        const input = document.getElementById('inputValue');
        input.focus();
        
        if (input.value) {
            this.convert();
        }
    }

    copyResult() {
        const convertedValue = document.getElementById('convertedValue').textContent;
        navigator.clipboard.writeText(convertedValue).then(() => {
            this.showNotification('Result copied to clipboard!', 'success');
        }).catch(() => {
            this.showNotification('Failed to copy result', 'error');
        });
    }

    addToHistory(data) {
        const historyItem = {
            id: Date.now(),
            timestamp: new Date().toISOString(),
            fromValue: data.originalValue,
            fromUnit: data.originalUnit,
            toValue: data.convertedValue,
            toUnit: data.targetUnit,
            readable: `${this.formatReadable(data.originalValue, data.originalUnit)} → ${data.readable}`
        };

        this.conversionHistory.unshift(historyItem);
        
        // Keep only last 50 items
        if (this.conversionHistory.length > 50) {
            this.conversionHistory = this.conversionHistory.slice(0, 50);
        }

        this.saveHistory();
        this.renderHistory();
    }

    renderHistory() {
        const historyList = document.getElementById('historyList');
        
        if (this.conversionHistory.length === 0) {
            historyList.innerHTML = `
                <div class="history-item">
                    <p style="color: var(--text-secondary); text-align: center; width: 100%;">
                        No conversion history yet
                    </p>
                </div>
            `;
            return;
        }

        historyList.innerHTML = this.conversionHistory.map(item => `
            <div class="history-item">
                <div class="history-conversion">
                    <span class="history-from">${this.formatReadable(item.fromValue, item.fromUnit)}</span>
                    <span class="history-arrow">→</span>
                    <span class="history-to">${this.formatReadable(item.toValue, item.toUnit)}</span>
                </div>
                <div class="history-timestamp">
                    ${new Date(item.timestamp).toLocaleTimeString()}
                </div>
            </div>
        `).join('');
    }

    clearHistory() {
        if (this.conversionHistory.length === 0) return;
        
        if (confirm('Are you sure you want to clear all conversion history?')) {
            this.conversionHistory = [];
            this.saveHistory();
            this.renderHistory();
            this.showNotification('History cleared', 'success');
        }
    }

    saveHistory() {
        localStorage.setItem('fileSizeConversionHistory', JSON.stringify(this.conversionHistory));
    }

    updateStats(fromUnit, toUnit) {
        this.stats.totalConversions++;
        
        // Track unit usage
        if (!this.stats.unitUsage[fromUnit]) {
            this.stats.unitUsage[fromUnit] = 0;
        }
        if (!this.stats.unitUsage[toUnit]) {
            this.stats.unitUsage[toUnit] = 0;
        }
        
        this.stats.unitUsage[fromUnit]++;
        this.stats.unitUsage[toUnit]++;
        
        localStorage.setItem('fileSizeStats', JSON.stringify(this.stats));
        this.updateStatsDisplay();
    }

    updateStatsDisplay() {
        document.getElementById('totalConversions').textContent = this.stats.totalConversions;
        
        // Find most used unit
        let mostUsedUnit = 'MB';
        let maxUsage = 0;
        
        Object.entries(this.stats.unitUsage).forEach(([unit, count]) => {
            if (count > maxUsage) {
                maxUsage = count;
                mostUsedUnit = this.unitSymbols[unit];
            }
        });
        
        document.getElementById('popularUnit').textContent = mostUsedUnit;
        document.getElementById('accuracyRate').textContent = this.stats.accuracyRate + '%';
    }

    // Batch Converter Methods
    openBatchConverter() {
        document.getElementById('batchConverterModal').classList.add('active');
        this.initializeBatchTable();
    }

    initializeBatchTable() {
        const tableBody = document.getElementById('batchTableBody');
        tableBody.innerHTML = '';
        
        // Add 3 initial rows
        for (let i = 0; i < 3; i++) {
            this.addBatchRow();
        }
    }

    addBatchRow() {
        const tableBody = document.getElementById('batchTableBody');
        const rowId = Date.now() + Math.random();
        
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>
                <input type="number" class="batch-value" placeholder="Enter size" step="any" min="0">
            </td>
            <td>
                <select class="batch-from-unit">
                    ${this.getUnitOptions()}
                </select>
            </td>
            <td>
                <select class="batch-to-unit">
                    ${this.getUnitOptions()}
                </select>
            </td>
            <td class="batch-result">-</td>
            <td>
                <button class="remove-row-btn" onclick="fileSizeConverter.removeBatchRow(this)">
                    <i class="fas fa-trash"></i>
                </button>
            </td>
        `;
        
        tableBody.appendChild(row);
    }

    removeBatchRow(button) {
        const row = button.closest('tr');
        row.remove();
    }

    clearBatch() {
        const tableBody = document.getElementById('batchTableBody');
        if (tableBody.children.length > 0 && confirm('Clear all rows?')) {
            tableBody.innerHTML = '';
        }
    }

    getUnitOptions() {
        return Object.entries(this.unitSymbols).map(([value, symbol]) => 
            `<option value="${value}">${symbol}</option>`
        ).join('');
    }

    async convertBatch() {
        const rows = document.querySelectorAll('#batchTableBody tr');
        const conversions = [];
        
        // Collect conversion data
        rows.forEach((row, index) => {
            const valueInput = row.querySelector('.batch-value');
            const fromUnit = row.querySelector('.batch-from-unit').value;
            const toUnit = row.querySelector('.batch-to-unit').value;
            const value = parseFloat(valueInput.value);
            
            if (value && !isNaN(value) && value > 0) {
                conversions.push({
                    index: index,
                    value: value,
                    fromUnit: fromUnit,
                    toUnit: toUnit
                });
            }
        });
        
        if (conversions.length === 0) {
            this.showNotification('Please enter valid values in at least one row', 'warning');
            return;
        }
        
        try {
            const response = await fetch('calculator.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    action: 'batch_convert',
                    conversions: conversions,
                    precision: parseInt(document.getElementById('decimalPlaces').value)
                })
            });
            
            const data = await response.json();
            
            if (data.success) {
                this.displayBatchResults(data.results);
            } else {
                throw new Error('Batch conversion failed');
            }
        } catch (error) {
            console.error('Error:', error);
            this.showNotification('Error performing batch conversion', 'error');
        }
    }

    displayBatchResults(results) {
        results.forEach(result => {
            const row = document.querySelectorAll('#batchTableBody tr')[result.index];
            if (row) {
                const resultCell = row.querySelector('.batch-result');
                resultCell.textContent = this.formatReadable(result.convertedValue, result.targetUnit);
                resultCell.style.color = 'var(--success-color)';
                resultCell.style.fontWeight = '600';
            }
        });
        
        this.showNotification(`Converted ${results.length} entries successfully`, 'success');
    }

    copyBatchResults() {
        const rows = document.querySelectorAll('#batchTableBody tr');
        let resultsText = '';
        
        rows.forEach(row => {
            const value = row.querySelector('.batch-value').value;
            const fromUnit = row.querySelector('.batch-from-unit').value;
            const toUnit = row.querySelector('.batch-to-unit').value;
            const result = row.querySelector('.batch-result').textContent;
            
            if (value && result !== '-') {
                resultsText += `${value} ${this.unitSymbols[fromUnit]} = ${result}\n`;
            }
        });
        
        if (resultsText) {
            navigator.clipboard.writeText(resultsText).then(() => {
                this.showNotification('Batch results copied to clipboard!', 'success');
            });
        } else {
            this.showNotification('No results to copy', 'warning');
        }
    }

    // Download Time Calculator Methods
    openDownloadTimeCalculator() {
        document.getElementById('downloadTimeModal').classList.add('active');
    }

    setConnectionPreset(preset) {
        const speedInput = document.getElementById('downloadSpeed');
        const speedUnit = document.getElementById('speedUnit');
        
        const presets = {
            dialup: { speed: 56, unit: 'Kbps' },
            dsl: { speed: 1.5, unit: 'Mbps' },
            cable: { speed: 10, unit: 'Mbps' },
            fiber: { speed: 50, unit: 'Mbps' },
            gigabit: { speed: 100, unit: 'Mbps' },
            '5g': { speed: 200, unit: 'Mbps' },
            custom: { speed: 10, unit: 'Mbps' }
        };
        
        const presetData = presets[preset];
        if (presetData && preset !== 'custom') {
            speedInput.value = presetData.speed;
            speedUnit.value = presetData.unit;
        }
    }

    async calculateDownloadTime() {
        const fileSize = parseFloat(document.getElementById('fileSize').value);
        const fileUnit = document.getElementById('fileSizeUnit').value;
        const downloadSpeed = parseFloat(document.getElementById('downloadSpeed').value);
        const speedUnit = document.getElementById('speedUnit').value;
        
        if (!fileSize || !downloadSpeed || isNaN(fileSize) || isNaN(downloadSpeed) || fileSize <= 0 || downloadSpeed <= 0) {
            this.showNotification('Please enter valid file size and download speed', 'warning');
            return;
        }
        
        try {
            const response = await fetch('calculator.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    action: 'calculate_download_time',
                    fileSize: fileSize,
                    fileUnit: fileUnit,
                    downloadSpeed: downloadSpeed,
                    speedUnit: speedUnit
                })
            });
            
            const data = await response.json();
            
            if (data.success) {
                document.getElementById('downloadTimeResult').textContent = data.readableTime;
            } else {
                throw new Error(data.error);
            }
        } catch (error) {
            console.error('Error:', error);
            this.showNotification('Error calculating download time', 'error');
        }
    }

    hideModals() {
        document.querySelectorAll('.modal').forEach(modal => {
            modal.classList.remove('active');
        });
    }

    setLoadingState(loading) {
        const convertBtn = document.getElementById('convertBtn');
        if (loading) {
            convertBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Converting...';
            convertBtn.disabled = true;
        } else {
            convertBtn.innerHTML = '<i class="fas fa-sync-alt"></i> Convert';
            convertBtn.disabled = false;
        }
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
const fileSizeConverter = new FileSizeConverter();

// Make available globally for onclick handlers
window.fileSizeConverter = fileSizeConverter;

// Add CSS animation for pulse effect
const style = document.createElement('style');
style.textContent = `
    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }
`;
document.head.appendChild(style);