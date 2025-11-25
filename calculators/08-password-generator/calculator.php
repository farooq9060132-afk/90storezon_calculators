<?php
/**
 * Plugin Name: Free Password Generator
 * Description: Free online password generator tool. Create strong, secure passwords with custom length and character types.
 * Version: 1.0
 * Author: Your Name
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

function password_generator_enqueue_scripts() {
    wp_enqueue_style('password-generator-style', plugins_url('style.css', __FILE__));
    wp_enqueue_script('password-generator-script', plugins_url('script.js', __FILE__), array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'password_generator_enqueue_scripts');

function password_generator_shortcode() {
    ob_start();
    ?>
    <div class="password-generator-plugin">
        <div class="input-group">
            <label for="passwordLength"><i class="fas fa-ruler-horizontal"></i> Password Length</label>
            <div class="slider-container">
                <input type="range" id="passwordLength" min="8" max="50" value="16" class="slider">
                <span id="lengthValue">16 characters</span>
            </div>
        </div>

        <div class="options-grid">
            <div class="option-group">
                <label class="checkbox-label">
                    <input type="checkbox" id="uppercase" checked>
                    <span class="checkmark"></span>
                    <i class="fas fa-font"></i>
                    Uppercase Letters (A-Z)
                </label>
            </div>

            <div class="option-group">
                <label class="checkbox-label">
                    <input type="checkbox" id="lowercase" checked>
                    <span class="checkmark"></span>
                    <i class="fas fa-font"></i>
                    Lowercase Letters (a-z)
                </label>
            </div>

            <div class="option-group">
                <label class="checkbox-label">
                    <input type="checkbox" id="numbers" checked>
                    <span class="checkmark"></span>
                    <i class="fas fa-hashtag"></i>
                    Numbers (0-9)
                </label>
            </div>

            <div class="option-group">
                <label class="checkbox-label">
                    <input type="checkbox" id="symbols" checked>
                    <span class="checkmark"></span>
                    <i class="fas fa-asterisk"></i>
                    Symbols (!@#$%^&*)
                </label>
            </div>
        </div>

        <div class="input-group">
            <label for="passwordCount"><i class="fas fa-copy"></i> Number of Passwords</label>
            <select id="passwordCount">
                <option value="1">1 Password</option>
                <option value="3">3 Passwords</option>
                <option value="5" selected>5 Passwords</option>
                <option value="10">10 Passwords</option>
            </select>
        </div>

        <button class="calculate-btn" onclick="generatePasswords()">
            <i class="fas fa-magic"></i> Generate Passwords
        </button>

        <div class="result-container" id="resultContainer">
            <h3><i class="fas fa-check-circle"></i> Your Secure Passwords</h3>
            
            <div class="strength-meter">
                <div class="strength-label">
                    <span>Password Strength:</span>
                    <strong id="strengthText">Strong</strong>
                </div>
                <div class="strength-bar">
                    <div class="strength-fill" id="strengthFill"></div>
                </div>
            </div>

            <div class="passwords-list" id="passwordsList">
                <!-- Passwords will be generated here -->
            </div>

            <div class="password-actions">
                <button class="action-btn" onclick="copyAllPasswords()">
                    <i class="fas fa-copy"></i> Copy All
                </button>
                <button class="action-btn" onclick="regeneratePasswords()">
                    <i class="fas fa-sync-alt"></i> Regenerate
                </button>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('password_generator', 'password_generator_shortcode');
?>