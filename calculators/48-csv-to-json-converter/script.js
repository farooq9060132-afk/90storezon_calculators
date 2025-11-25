document.addEventListener('DOMContentLoaded', function() {
    // Elements
    const tabBtns = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');
    const csvFileInput = document.getElementById('csvFile');
    const csvDataTextarea = document.getElementById('csv-data');
    const convertBtn = document.getElementById('convertBtn');
    const previewBtn = document.getElementById('previewBtn');
    const copyBtn = document.getElementById('copyBtn');
    const downloadBtn = document.getElementById('downloadBtn');
    const clearBtn = document.getElementById('clearBtn');
    const jsonOutput = document.getElementById('json-output');
    const resultsSection = document.getElementById('resultsSection');
    const previewSection = document.getElementById('previewSection');
    const previewTable = document.getElementById('previewTable');
    const resultStats = document.getElementById('resultStats');
    const delimiterSelect = document.getElementById('delimiter');
    const customDelimiter = document.getElementById('customDelimiter');
    const uploadArea = document.getElementById('uploadArea');
    const fileInfo = document.getElementById('fileInfo');

    // Tab functionality
    tabBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const tabId = this.dataset.tab;
            
            // Update tabs
            tabBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            
            // Update content
            tabContents.forEach(content => content.classList.remove('active'));
            document.getElementById(`${tabId}-tab`).classList.add('active');
        });
    });

    // Custom delimiter toggle
    delimiterSelect.addEventListener('change', function() {
        customDelimiter.style.display = this.value === 'custom' ? 'inline-block' : 'none';
    });

    // File upload handling
    csvFileInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            if (!file.name.toLowerCase().endsWith('.csv') && !file.name.toLowerCase().endsWith('.txt')) {
                alert('Please select a CSV or text file');
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                csvDataTextarea.value = e.target.result;
                fileInfo.innerHTML = `
                    <div style="display: flex; align-items: center; justify-content: space-between;">
                        <div>
                            <strong>${file.name}</strong>
                            <div style="font-size: 0.8rem; color: var(--text-light);">
                                ${(file.size / 1024).toFixed(2)} KB
                            </div>
                        </div>
                        <button onclick="clearFile()" style="background: none; border: none; color: var(--text-light); cursor: pointer;">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                `;
                fileInfo.style.display = 'block';
            };
            reader.readAsText(file);
        }
    });

    // Drag and drop functionality
    uploadArea.addEventListener('dragover', function(e) {
        e.preventDefault();
        this.classList.add('drag-over');
    });

    uploadArea.addEventListener('dragleave', function(e) {
        e.preventDefault();
        this.classList.remove('drag-over');
    });

    uploadArea.addEventListener('drop', function(e) {
        e.preventDefault();
        this.classList.remove('drag-over');
        
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            csvFileInput.files = files;
            csvFileInput.dispatchEvent(new Event('change'));
        }
    });

    // Convert to JSON
    convertBtn.addEventListener('click', function() {
        const csvData = csvDataTextarea.value.trim();
        
        if (!csvData) {
            alert('Please provide CSV data');
            return;
        }

        const delimiter = getDelimiter();
        const hasHeaders = document.getElementById('hasHeaders').checked;
        const outputFormat = document.getElementById('outputFormat').value;
        const quoteChar = document.getElementById('quoteChar').value;

        // Show loading state
        const originalText = convertBtn.innerHTML;
        convertBtn.innerHTML = '<div class="loading"></div> Converting...';
        convertBtn.disabled = true;

        // Send to server for processing
        fetch('calculator.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `action=convert_csv&csv_data=${encodeURIComponent(csvData)}&delimiter=${encodeURIComponent(delimiter)}&has_headers=${hasHeaders}&output_format=${outputFormat}&quote_char=${encodeURIComponent(quoteChar)}&custom_delimiter=${encodeURIComponent(customDelimiter.value)}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                alert('Error: ' + data.error);
            } else {
                jsonOutput.innerHTML = syntaxHighlight(data.json);
                resultStats.innerHTML = `
                    <span>Rows: ${data.stats.rows}</span>
                    <span>Columns: ${data.stats.columns}</span>
                    <span>Size: ${(data.stats.size / 1024).toFixed(2)} KB</span>
                `;
                resultsSection.style.display = 'block';
                previewSection.style.display = 'none';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred during conversion');
        })
        .finally(() => {
            convertBtn.innerHTML = originalText;
            convertBtn.disabled = false;
        });
    });

    // Preview CSV
    previewBtn.addEventListener('click', function() {
        const csvData = csvDataTextarea.value.trim();
        
        if (!csvData) {
            alert('Please provide CSV data');
            return;
        }

        const delimiter = getDelimiter();
        const hasHeaders = document.getElementById('hasHeaders').checked;
        
        try {
            const lines = csvData.split('\n').filter(line => line.trim() !== '');
            const tableHead = previewTable.querySelector('thead');
            const tableBody = previewTable.querySelector('tbody');
            
            tableHead.innerHTML = '';
            tableBody.innerHTML = '';
            
            if (lines.length > 0) {
                const headers = parseCSVLine(lines[0], delimiter);
                const headerRow = document.createElement('tr');
                
                if (hasHeaders) {
                    headers.forEach(header => {
                        const th = document.createElement('th');
                        th.textContent = header;
                        headerRow.appendChild(th);
                    });
                } else {
                    headers.forEach((_, index) => {
                        const th = document.createElement('th');
                        th.textContent = `Column ${index + 1}`;
                        headerRow.appendChild(th);
                    });
                }
                
                tableHead.appendChild(headerRow);
                
                // Add data rows
                const startRow = hasHeaders ? 1 : 0;
                for (let i = startRow; i < Math.min(lines.length, 11); i++) {
                    const rowData = parseCSVLine(lines[i], delimiter);
                    const row = document.createElement('tr');
                    
                    rowData.forEach(cell => {
                        const td = document.createElement('td');
                        td.textContent = cell;
                        row.appendChild(td);
                    });
                    
                    tableBody.appendChild(row);
                }
                
                if (lines.length > 11) {
                    const infoRow = document.createElement('tr');
                    const infoCell = document.createElement('td');
                    infoCell.colSpan = headers.length;
                    infoCell.textContent = `... and ${lines.length - 11} more rows`;
                    infoCell.style.textAlign = 'center';
                    infoCell.style.color = 'var(--text-light)';
                    infoRow.appendChild(infoCell);
                    tableBody.appendChild(infoRow);
                }
            }
            
            previewSection.style.display = 'block';
            resultsSection.style.display = 'none';
            
        } catch (error) {
            alert('Error previewing CSV: ' + error.message);
        }
    });

    // Copy JSON
    copyBtn.addEventListener('click', function() {
        const text = jsonOutput.textContent;
        if (!text) {
            alert('No JSON to copy');
            return;
        }

        navigator.clipboard.writeText(text).then(() => {
            const originalText = copyBtn.innerHTML;
            copyBtn.innerHTML = '<i class="fas fa-check"></i> Copied!';
            setTimeout(() => {
                copyBtn.innerHTML = originalText;
            }, 2000);
        });
    });

    // Download JSON
    downloadBtn.addEventListener('click', function() {
        const text = jsonOutput.textContent;
        if (!text) {
            alert('No JSON to download');
            return;
        }

        const blob = new Blob([text], { type: 'application/json' });
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = 'converted.json';
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        URL.revokeObjectURL(url);
    });

    // Clear all
    clearBtn.addEventListener('click', function() {
        csvDataTextarea.value = '';
        jsonOutput.textContent = '';
        resultsSection.style.display = 'none';
        previewSection.style.display = 'none';
        fileInfo.style.display = 'none';
        csvFileInput.value = '';
    });

    // Example cards
    document.querySelectorAll('.example-card').forEach(card => {
        card.addEventListener('click', function() {
            const example = this.querySelector('pre').textContent;
            csvDataTextarea.value = example;
            
            // Set appropriate options based on example type
            const exampleType = this.dataset.example;
            switch (exampleType) {
                case 'semicolon':
                    document.getElementById('delimiter').value = ';';
                    break;
                case 'noheaders':
                    document.getElementById('hasHeaders').checked = false;
                    break;
                default:
                    document.getElementById('delimiter').value = ',';
                    document.getElementById('hasHeaders').checked = true;
            }
        });
    });

    // Helper functions
    function getDelimiter() {
        const selected = delimiterSelect.value;
        if (selected === 'custom') {
            return customDelimiter.value || ',';
        }
        return selected === '\t' ? '\t' : selected;
    }

    function parseCSVLine(line, delimiter) {
        const result = [];
        let current = '';
        let inQuotes = false;
        
        for (let i = 0; i < line.length; i++) {
            const char = line[i];
            
            if (char === '"') {
                if (inQuotes && line[i + 1] === '"') {
                    current += '"';
                    i++;
                } else {
                    inQuotes = !inQuotes;
                }
            } else if (char === delimiter && !inQuotes) {
                result.push(current);
                current = '';
            } else {
                current += char;
            }
        }
        
        result.push(current);
        return result;
    }

    function syntaxHighlight(json) {
        if (!json) return '';
        
        json = json.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
        return json.replace(/("(\\u[a-zA-Z0-9]{4}|\\[^u]|[^\\"])*"(\s*:)?|\b(true|false|null)\b|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?)/g, function (match) {
            let cls = 'json-number';
            if (/^"/.test(match)) {
                if (/:$/.test(match)) {
                    cls = 'json-key';
                } else {
                    cls = 'json-string';
                }
            } else if (/true|false/.test(match)) {
                cls = 'json-boolean';
            } else if (/null/.test(match)) {
                cls = 'json-null';
            }
            return '<span class="' + cls + '">' + match + '</span>';
        });
    }

    // Global function for file clearing
    window.clearFile = function() {
        fileInfo.style.display = 'none';
        csvFileInput.value = '';
        csvDataTextarea.value = '';
    };
});