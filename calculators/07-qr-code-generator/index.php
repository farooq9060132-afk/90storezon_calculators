<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Generator Online - Create Custom QR Codes 2024</title>
    <meta name="description" content="Online QR code generator tool. Create custom QR codes for URLs, text, emails, WiFi, and more. Download high-quality QR codes instantly. No registration required!">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="vip-container">
        <header class="vip-header">
            <h1><i class="fas fa-qrcode"></i> QR Code Generator</h1>
            <p>Create custom QR codes instantly</p>
        </header>

        <!-- Google Ads Slot -->
        <div class="ad-slot top-ad">
            [AD_TOP_BANNER]
        </div>

        <div class="calculator-container">
            <div class="input-group">
                <label for="qrType"><i class="fas fa-cog"></i> QR Code Type</label>
                <select id="qrType">
                    <option value="url">Website URL</option>
                    <option value="text">Plain Text</option>
                    <option value="email">Email</option>
                    <option value="phone">Phone Number</option>
                    <option value="sms">SMS</option>
                    <option value="wifi">WiFi Network</option>
                    <option value="vcard">Contact Card (vCard)</option>
                    <option value="event">Event</option>
                </select>
            </div>

            <!-- Dynamic content based on QR type -->
            <div id="dynamicFields">
                <!-- URL Field (Default) -->
                <div class="input-group url-field">
                    <label for="url"><i class="fas fa-link"></i> Website URL</label>
                    <input type="url" id="url" placeholder="https://example.com" value="https://example.com">
                </div>
            </div>

            <div class="input-row">
                <div class="input-group">
                    <label for="qrSize"><i class="fas fa-expand-alt"></i> QR Code Size</label>
                    <select id="qrSize">
                        <option value="150">150x150</option>
                        <option value="200" selected>200x200</option>
                        <option value="250">250x250</option>
                        <option value="300">300x300</option>
                        <option value="400">400x400</option>
                    </select>
                </div>

                <div class="input-group">
                    <label for="qrColor"><i class="fas fa-palette"></i> QR Code Color</label>
                    <input type="color" id="qrColor" value="#000000">
                </div>
            </div>

            <div class="input-row">
                <div class="input-group">
                    <label for="bgColor"><i class="fas fa-fill-drip"></i> Background Color</label>
                    <input type="color" id="bgColor" value="#ffffff">
                </div>

                <div class="input-group">
                    <label for="qrMargin"><i class="fas fa-border-all"></i> Margin Size</label>
                    <select id="qrMargin">
                        <option value="0">No Margin</option>
                        <option value="1" selected>Small</option>
                        <option value="2">Medium</option>
                        <option value="4">Large</option>
                    </select>
                </div>
            </div>

            <button class="calculate-btn" onclick="generateQRCode()">
                <i class="fas fa-qrcode"></i> Generate QR Code
            </button>

            <!-- Google Ads Slot -->
            <div class="ad-slot middle-ad">
                [AD_MIDDLE_BANNER]
            </div>

            <div class="result-container" id="resultContainer">
                <h3><i class="fas fa-check-circle"></i> Your QR Code is Ready!</h3>
                
                <div class="qr-preview-section">
                    <div class="qr-code-container">
                        <canvas id="qrCanvas"></canvas>
                    </div>
                    
                    <div class="qr-actions">
                        <button class="download-btn" onclick="downloadQRCode('png')">
                            <i class="fas fa-download"></i> Download PNG
                        </button>
                        <button class="download-btn" onclick="downloadQRCode('jpg')">
                            <i class="fas fa-download"></i> Download JPG
                        </button>
                        <button class="download-btn" onclick="downloadQRCode('svg')">
                            <i class="fas fa-download"></i> Download SVG
                        </button>
                    </div>
                </div>

                <div class="qr-details">
                    <h4><i class="fas fa-info-circle"></i> QR Code Details</h4>
                    <div class="details-grid">
                        <div class="detail-item">
                            <span>Type:</span>
                            <span id="detailType">URL</span>
                        </div>
                        <div class="detail-item">
                            <span>Content:</span>
                            <span id="detailContent">https://example.com</span>
                        </div>
                        <div class="detail-item">
                            <span>Size:</span>
                            <span id="detailSize">200x200 pixels</span>
                        </div>
                        <div class="detail-item">
                            <span>Generated:</span>
                            <span id="detailTime">Just now</span>
                        </div>
                    </div>
                </div>

                <div class="usage-tips">
                    <h4><i class="fas fa-lightbulb"></i> Usage Tips</h4>
                    <div class="tips-grid">
                        <div class="tip-item">
                            <i class="fas fa-print"></i>
                            <span>Print on business cards and flyers</span>
                        </div>
                        <div class="tip-item">
                            <i class="fas fa-mobile-alt"></i>
                            <span>Add to websites and social media</span>
                        </div>
                        <div class="tip-item">
                            <i class="fas fa-store"></i>
                            <span>Use in retail and marketing materials</span>
                        </div>
                        <div class="tip-item">
                            <i class="fas fa-qrcode"></i>
                            <span>Test with any QR code scanner app</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Google Ads Slot -->
        <div class="ad-slot bottom-ad">
            [AD_BOTTOM_BANNER]
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/qrcode@1.5.3/build/qrcode.min.js"></script>
    <script src="script.js"></script>
</body>
</html>