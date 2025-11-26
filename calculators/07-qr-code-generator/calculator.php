<?php
/**
 * QR Code Generator
 * Description: Free online QR code generator tool. Create custom QR codes for URLs, text, emails, WiFi, and more.
 */

// Prevent direct access
if (!defined('CALCULATOR_LOADED')) {
    define('CALCULATOR_LOADED', true);
}

function get_qr_code_generator_html() {
    ob_start();
    ?>
    <div class="qr-code-generator-plugin">
        <div class="input-group">
            <label for="qrType"><i class="fas fa-cog"></i> QR Code Type</label>
            <select id="qrType">
                <option value="url">Website URL</option>
                <option value="text">Plain Text</option>
                <option value="email">Email</option>
                <option value="phone">Phone Number</option>
                <option value="sms">SMS</option>
                <option value="wifi">WiFi Network</option>
            </select>
        </div>

        <div id="dynamicFields">
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
                </select>
            </div>

            <div class="input-group">
                <label for="qrColor"><i class="fas fa-palette"></i> QR Code Color</label>
                <input type="color" id="qrColor" value="#000000">
            </div>
        </div>

        <button class="calculate-btn" onclick="generateQRCode()">
            <i class="fas fa-qrcode"></i> Generate QR Code
        </button>

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
                </div>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}

// If this file is accessed directly, show the calculator
if (basename($_SERVER['PHP_SELF']) == 'calculator.php') {
    echo get_qr_code_generator_html();
}
?>