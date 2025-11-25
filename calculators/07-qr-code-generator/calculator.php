<?php
/**
 * Plugin Name: Free QR Code Generator
 * Description: Free online QR code generator tool. Create custom QR codes for URLs, text, emails, WiFi, and more.
 * Version: 1.0
 * Author: Your Name
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

function qr_code_generator_enqueue_scripts() {
    wp_enqueue_style('qr-code-generator-style', plugins_url('style.css', __FILE__));
    wp_enqueue_script('qrcode-js', 'https://cdn.jsdelivr.net/npm/qrcode@1.5.3/build/qrcode.min.js', array(), '1.5.3', true);
    wp_enqueue_script('qr-code-generator-script', plugins_url('script.js', __FILE__), array('jquery', 'qrcode-js'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'qr_code_generator_enqueue_scripts');

function qr_code_generator_shortcode() {
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
add_shortcode('qr_code_generator', 'qr_code_generator_shortcode');
?>