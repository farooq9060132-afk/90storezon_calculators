let currentQRCode = null;

// Dynamic field templates
const fieldTemplates = {
    url: `
        <div class="input-group url-field">
            <label for="url"><i class="fas fa-link"></i> Website URL</label>
            <input type="url" id="url" placeholder="https://example.com" value="https://example.com">
        </div>
    `,
    text: `
        <div class="input-group text-field">
            <label for="text"><i class="fas fa-font"></i> Text Content</label>
            <textarea id="text" placeholder="Enter your text here..." rows="3">Hello World!</textarea>
        </div>
    `,
    email: `
        <div class="input-row">
            <div class="input-group">
                <label for="email"><i class="fas fa-envelope"></i> Email Address</label>
                <input type="email" id="email" placeholder="user@example.com" value="user@example.com">
            </div>
            <div class="input-group">
                <label for="emailSubject"><i class="fas fa-tag"></i> Subject</label>
                <input type="text" id="emailSubject" placeholder="Email subject">
            </div>
        </div>
        <div class="input-group">
            <label for="emailBody"><i class="fas fa-file-alt"></i> Message</label>
            <textarea id="emailBody" placeholder="Email message body..." rows="2"></textarea>
        </div>
    `,
    phone: `
        <div class="input-group phone-field">
            <label for="phone"><i class="fas fa-phone"></i> Phone Number</label>
            <input type="tel" id="phone" placeholder="+1234567890" value="+1234567890">
        </div>
    `,
    sms: `
        <div class="input-row">
            <div class="input-group">
                <label for="smsNumber"><i class="fas fa-phone"></i> Phone Number</label>
                <input type="tel" id="smsNumber" placeholder="+1234567890" value="+1234567890">
            </div>
            <div class="input-group">
                <label for="smsMessage"><i class="fas fa-comment"></i> Message</label>
                <input type="text" id="smsMessage" placeholder="Your message">
            </div>
        </div>
    `,
    wifi: `
        <div class="input-row">
            <div class="input-group">
                <label for="wifiSSID"><i class="fas fa-wifi"></i> Network Name (SSID)</label>
                <input type="text" id="wifiSSID" placeholder="Your WiFi name">
            </div>
            <div class="input-group">
                <label for="wifiPassword"><i class="fas fa-key"></i> Password</label>
                <input type="text" id="wifiPassword" placeholder="WiFi password">
            </div>
        </div>
        <div class="input-group">
            <label for="wifiEncryption"><i class="fas fa-shield-alt"></i> Encryption Type</label>
            <select id="wifiEncryption">
                <option value="WPA">WPA/WPA2</option>
                <option value="WEP">WEP</option>
                <option value="nopass">No Encryption</option>
            </select>
        </div>
    `,
    vcard: `
        <div class="input-row">
            <div class="input-group">
                <label for="vcardName"><i class="fas fa-user"></i> Full Name</label>
                <input type="text" id="vcardName" placeholder="John Doe">
            </div>
            <div class="input-group">
                <label for="vcardPhone"><i class="fas fa-phone"></i> Phone</label>
                <input type="tel" id="vcardPhone" placeholder="+1234567890">
            </div>
        </div>
        <div class="input-row">
            <div class="input-group">
                <label for="vcardEmail"><i class="fas fa-envelope"></i> Email</label>
                <input type="email" id="vcardEmail" placeholder="john@example.com">
            </div>
            <div class="input-group">
                <label for="vcardCompany"><i class="fas fa-building"></i> Company</label>
                <input type="text" id="vcardCompany" placeholder="Company Name">
            </div>
        </div>
        <div class="input-group">
            <label for="vcardWebsite"><i class="fas fa-globe"></i> Website</label>
            <input type="url" id="vcardWebsite" placeholder="https://example.com">
        </div>
    `,
    event: `
        <div class="input-row">
            <div class="input-group">
                <label for="eventTitle"><i class="fas fa-calendar"></i> Event Title</label>
                <input type="text" id="eventTitle" placeholder="Meeting Title">
            </div>
            <div class="input-group">
                <label for="eventLocation"><i class="fas fa-map-marker-alt"></i> Location</label>
                <input type="text" id="eventLocation" placeholder="Event Location">
            </div>
        </div>
        <div class="input-row">
            <div class="input-group">
                <label for="eventStart"><i class="fas fa-play"></i> Start Date & Time</label>
                <input type="datetime-local" id="eventStart">
            </div>
            <div class="input-group">
                <label for="eventEnd"><i class="fas fa-stop"></i> End Date & Time</label>
                <input type="datetime-local" id="eventEnd">
            </div>
        </div>
        <div class="input-group">
            <label for="eventDescription"><i class="fas fa-file-alt"></i> Description</label>
            <textarea id="eventDescription" placeholder="Event description..." rows="2"></textarea>
        </div>
    `
};

function generateQRCode() {
    const qrType = document.getElementById('qrType').value;
    const qrSize = parseInt(document.getElementById('qrSize').value);
    const qrColor = document.getElementById('qrColor').value.replace('#', '');
    const bgColor = document.getElementById('bgColor').value.replace('#', '');
    const qrMargin = parseInt(document.getElementById('qrMargin').value);

    let qrContent = '';

    // Generate content based on QR type
    switch(qrType) {
        case 'url':
            qrContent = document.getElementById('url').value;
            break;
        case 'text':
            qrContent = document.getElementById('text').value;
            break;
        case 'email':
            const email = document.getElementById('email').value;
            const subject = document.getElementById('emailSubject').value;
            const body = document.getElementById('emailBody').value;
            qrContent = `mailto:${email}?subject=${encodeURIComponent(subject)}&body=${encodeURIComponent(body)}`;
            break;
        case 'phone':
            qrContent = `tel:${document.getElementById('phone').value}`;
            break;
        case 'sms':
            const smsNumber = document.getElementById('smsNumber').value;
            const smsMessage = document.getElementById('smsMessage').value;
            qrContent = `sms:${smsNumber}?body=${encodeURIComponent(smsMessage)}`;
            break;
        case 'wifi':
            const ssid = document.getElementById('wifiSSID').value;
            const password = document.getElementById('wifiPassword').value;
            const encryption = document.getElementById('wifiEncryption').value;
            qrContent = `WIFI:S:${ssid};T:${encryption};P:${password};;`;
            break;
        case 'vcard':
            const name = document.getElementById('vcardName').value;
            const phone = document.getElementById('vcardPhone').value;
            const email = document.getElementById('vcardEmail').value;
            const company = document.getElementById('vcardCompany').value;
            const website = document.getElementById('vcardWebsite').value;
            qrContent = `BEGIN:VCARD\nVERSION:3.0\nFN:${name}\nTEL:${phone}\nEMAIL:${email}\nORG:${company}\nURL:${website}\nEND:VCARD`;
            break;
        case 'event':
            const title = document.getElementById('eventTitle').value;
            const location = document.getElementById('eventLocation').value;
            const start = document.getElementById('eventStart').value;
            const end = document.getElementById('eventEnd').value;
            const description = document.getElementById('eventDescription').value;
            qrContent = `BEGIN:VEVENT\nSUMMARY:${title}\nLOCATION:${location}\nDTSTART:${start}\nDTEND:${end}\nDESCRIPTION:${description}\nEND:VEVENT`;
            break;
    }

    if (!qrContent) {
        alert('Please enter content for the QR code');
        return;
    }

    const canvas = document.getElementById('qrCanvas');
    const ctx = canvas.getContext('2d');

    // Clear previous QR code
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    // Generate QR code
    QRCode.toCanvas(canvas, qrContent, {
        width: qrSize,
        margin: qrMargin,
        color: {
            dark: qrColor,
            light: bgColor
        }
    }, function(error) {
        if (error) {
            console.error(error);
            alert('Error generating QR code. Please try again.');
            return;
        }

        // Update details
        document.getElementById('detailType').textContent = document.getElementById('qrType').selectedOptions[0].text;
        document.getElementById('detailContent').textContent = qrContent.length > 50 ? qrContent.substring(0, 50) + '...' : qrContent;
        document.getElementById('detailSize').textContent = `${qrSize}x${qrSize} pixels`;
        document.getElementById('detailTime').textContent = new Date().toLocaleString();

        // Show result container
        const resultContainer = document.getElementById('resultContainer');
        resultContainer.style.display = 'block';
        resultContainer.style.animation = 'fadeIn 0.5s ease-in';

        currentQRCode = {
            canvas: canvas,
            content: qrContent,
            size: qrSize
        };
    });
}

function downloadQRCode(format) {
    if (!currentQRCode) {
        alert('Please generate a QR code first');
        return;
    }

    const canvas = currentQRCode.canvas;
    const link = document.createElement('a');
    
    let filename = `qrcode-${Date.now()}`;
    
    if (format === 'png') {
        link.download = `${filename}.png`;
        link.href = canvas.toDataURL('image/png');
    } else if (format === 'jpg') {
        link.download = `${filename}.jpg`;
        link.href = canvas.toDataURL('image/jpeg', 0.9);
    } else if (format === 'svg') {
        // For SVG, we'd need a more complex implementation
        alert('SVG download requires additional libraries. Please use PNG or JPG format.');
        return;
    }
    
    link.click();
}

// Handle QR type changes
document.getElementById('qrType').addEventListener('change', function() {
    const type = this.value;
    const dynamicFields = document.getElementById('dynamicFields');
    
    if (fieldTemplates[type]) {
        dynamicFields.innerHTML = fieldTemplates[type];
    }
});

// Add fadeIn animation
const style = document.createElement('style');
style.textContent = `
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    textarea {
        width: 100%;
        padding: 12px;
        border: 2px solid #e1e1e1;
        border-radius: 10px;
        font-size: 16px;
        font-family: inherit;
        resize: vertical;
        min-height: 80px;
    }
    
    textarea:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        outline: none;
    }
    
    input[type="datetime-local"] {
        font-family: inherit;
    }
`;
document.head.appendChild(style);

// Initialize with default values
document.addEventListener('DOMContentLoaded', function() {
    // Set current date and time for event fields
    const now = new Date();
    const tomorrow = new Date(now);
    tomorrow.setDate(tomorrow.getDate() + 1);
    
    document.getElementById('eventStart').value = now.toISOString().slice(0, 16);
    document.getElementById('eventEnd').value = tomorrow.toISOString().slice(0, 16);
    
    // Auto-generate QR code when content changes
    const inputs = document.querySelectorAll('input, textarea, select');
    inputs.forEach(input => {
        input.addEventListener('input', function() {
            if (currentQRCode) {
                setTimeout(generateQRCode, 500);
            }
        });
    });
});