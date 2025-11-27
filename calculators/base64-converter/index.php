<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Free Base64 Converter | Encode/Decode Base64 Online</title>
    <meta name="description" content="Free online Base64 converter. Encode text to Base64 and decode Base64 to text instantly. Support for strings, files, and URLs.">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <header class="header">
            <h1><i class="fas fa-code"></i> Base64 Converter</h1>
            <p>Encode text to Base64 and decode Base64 strings online instantly</p>
        </header>

        <main class="calculator-card">
            <div class="converter-tabs">
                <button class="tab-btn active" data-tab="encode">Encode to Base64</button>
                <button class="tab-btn" data-tab="decode">Decode from Base64</button>
            </div>

            <div class="tab-content active" id="encode-tab">
                <div class="input-group">
                    <label for="encode-input"><i class="fas fa-keyboard"></i> Text to Encode</label>
                    <textarea id="encode-input" placeholder="Enter text to encode to Base64..." rows="6"></textarea>
                </div>
                <button class="action-btn encode-btn">
                    <i class="fas fa-lock"></i> Encode to Base64
                </button>
                <div class="output-group">
                    <label for="encode-output"><i class="fas fa-code"></i> Base64 Result</label>
                    <textarea id="encode-output" readonly placeholder="Encoded result will appear here..." rows="6"></textarea>
                </div>
            </div>

            <div class="tab-content" id="decode-tab">
                <div class="input-group">
                    <label for="decode-input"><i class="fas fa-code"></i> Base64 to Decode</label>
                    <textarea id="decode-input" placeholder="Enter Base64 string to decode..." rows="6"></textarea>
                </div>
                <button class="action-btn decode-btn">
                    <i class="fas fa-unlock"></i> Decode from Base64
                </button>
                <div class="output-group">
                    <label for="decode-output"><i class="fas fa-keyboard"></i> Decoded Text</label>
                    <textarea id="decode-output" readonly placeholder="Decoded result will appear here..." rows="6"></textarea>
                </div>
            </div>

            <div class="utility-buttons">
                <button class="util-btn" id="copyBtn">
                    <i class="fas fa-copy"></i> Copy Result
                </button>
                <button class="util-btn" id="clearBtn">
                    <i class="fas fa-broom"></i> Clear All
                </button>
            </div>
        </main>

        <section class="features-section">
            <h2>Base64 Conversion Features</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <i class="fas fa-bolt"></i>
                    <h3>Instant Conversion</h3>
                    <p>Real-time Base64 encoding and decoding with immediate results</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-shield-alt"></i>
                    <h3>Secure & Private</h3>
                    <p>All conversions happen in your browser - no data sent to servers</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-exchange-alt"></i>
                    <h3>Bidirectional</h3>
                    <p>Encode text to Base64 and decode Base64 back to original text</p>
                </div>
            </div>
        </section>
    </div>

    <script src="script.js"></script>
</body>
</html>