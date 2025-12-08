document.addEventListener('DOMContentLoaded', function() {
    const tabBtns = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');
    const encodeBtn = document.querySelector('.encode-btn');
    const decodeBtn = document.querySelector('.decode-btn');
    const copyBtn = document.getElementById('copyBtn');
    const clearBtn = document.getElementById('clearBtn');

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

    // Encode to Base64
    encodeBtn.addEventListener('click', function() {
        const input = document.getElementById('encode-input').value.trim();
        const output = document.getElementById('encode-output');
        
        if (!input) {
            alert('Please enter text to encode');
            return;
        }
        
        try {
            const encoded = btoa(unescape(encodeURIComponent(input)));
            output.value = encoded;
        } catch (error) {
            alert('Error encoding text: ' + error.message);
        }
    });

    // Decode from Base64
    decodeBtn.addEventListener('click', function() {
        const input = document.getElementById('decode-input').value.trim();
        const output = document.getElementById('decode-output');
        
        if (!input) {
            alert('Please enter Base64 string to decode');
            return;
        }
        
        try {
            // Remove data URL prefix if present
            const cleanInput = input.replace(/^data:[^;]+;base64,/, '');
            const decoded = decodeURIComponent(escape(atob(cleanInput)));
            output.value = decoded;
        } catch (error) {
            alert('Error decoding Base64: ' + error.message);
        }
    });

    // Copy result
    copyBtn.addEventListener('click', function() {
        const activeTab = document.querySelector('.tab-content.active');
        const output = activeTab.querySelector('textarea[readonly]');
        
        if (!output.value) {
            alert('No result to copy');
            return;
        }
        
        output.select();
        document.execCommand('copy');
        
        // Show feedback
        const originalText = copyBtn.innerHTML;
        copyBtn.innerHTML = '<i class="fas fa-check"></i> Copied!';
        setTimeout(() => {
            copyBtn.innerHTML = originalText;
        }, 2000);
    });

    // Clear all
    clearBtn.addEventListener('click', function() {
        const textareas = document.querySelectorAll('textarea');
        textareas.forEach(ta => ta.value = '');
    });

    // Auto-detect and switch tabs for Base64 input
    document.getElementById('decode-input').addEventListener('input', function(e) {
        const value = e.target.value.trim();
        if (value && /^[A-Za-z0-9+/]*={0,2}$/.test(value) && value.length % 4 === 0) {
            // Valid Base64 detected
            e.target.style.borderColor = '#43e97b';
        } else if (value) {
            e.target.style.borderColor = '#fa709a';
        } else {
            e.target.style.borderColor = '';
        }
    });
});