<?php
$title = "Free Lorem Ipsum Generator - Generate Dummy Text Online";
$description = "Generate Lorem Ipsum dummy text for your projects. Customize paragraphs, words, sentences and choose from different Lorem Ipsum variants.";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <meta name="description" content="<?php echo $description; ?>">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1><i class="fas fa-text-height"></i> Free Lorem Ipsum Generator</h1>
            <p>Generate professional dummy text for your design and development projects</p>
        </div>

        <div class="calculator">
            <div class="generator-options">
                <h3><i class="fas fa-cogs"></i> Generator Options</h3>
                
                <div class="options-grid">
                    <div class="option-group">
                        <label for="textType"><i class="fas fa-font"></i> Text Type</label>
                        <select id="textType">
                            <option value="paragraphs">Paragraphs</option>
                            <option value="words">Words</option>
                            <option value="sentences">Sentences</option>
                            <option value="list">List Items</option>
                        </select>
                    </div>

                    <div class="option-group">
                        <label for="quantity"><i class="fas fa-hashtag"></i> Quantity</label>
                        <input type="number" id="quantity" min="1" max="100" value="5">
                    </div>

                    <div class="option-group">
                        <label for="loremVariant"><i class="fas fa-book"></i> Lorem Variant</label>
                        <select id="loremVariant">
                            <option value="standard">Standard Lorem Ipsum</option>
                            <option value="classic">Classic Cicero</option>
                            <option value="modern">Modern Corporate</option>
                            <option value="tech">Tech Ipsum</option>
                            <option value="hipster">Hipster Ipsum</option>
                            <option value="cupcake">Cupcake Ipsum</option>
                        </select>
                    </div>

                    <div class="option-group">
                        <label for="startWithLorem"><i class="fas fa-play"></i> Start With</label>
                        <select id="startWithLorem">
                            <option value="yes">"Lorem ipsum dolor sit amet..."</option>
                            <option value="no">Random starting text</option>
                        </select>
                    </div>
                </div>

                <div class="advanced-options">
                    <h4><i class="fas fa-sliders-h"></i> Advanced Options</h4>
                    <div class="advanced-grid">
                        <div class="option-group">
                            <label class="checkbox-label">
                                <input type="checkbox" id="includeLinks" checked> Include links
                            </label>
                        </div>
                        <div class="option-group">
                            <label class="checkbox-label">
                                <input type="checkbox" id="includeFormatting"> Include formatting
                            </label>
                        </div>
                        <div class="option-group">
                            <label class="checkbox-label">
                                <input type="checkbox" id="includeLists"> Include lists
                            </label>
                        </div>
                        <div class="option-group">
                            <label class="checkbox-label">
                                <input type="checkbox" id="autoCopy"> Auto-copy to clipboard
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="actions">
                <button id="generateLorem" class="btn-primary">
                    <i class="fas fa-magic"></i> Generate Lorem Ipsum
                </button>
                <button id="copyText" class="btn-secondary">
                    <i class="fas fa-copy"></i> Copy Text
                </button>
                <button id="clearAll" class="btn-secondary">
                    <i class="fas fa-broom"></i> Clear All
                </button>
            </div>

            <div class="output-section">
                <div class="output-header">
                    <h3><i class="fas fa-file-alt"></i> Generated Text</h3>
                    <div class="output-stats">
                        <span id="wordCount">Words: 0</span>
                        <span id="charCount">Characters: 0</span>
                        <span id="paraCount">Paragraphs: 0</span>
                    </div>
                </div>
                <div class="output-container">
                    <textarea id="outputText" placeholder="Your generated Lorem Ipsum text will appear here..." readonly></textarea>
                </div>
            </div>

            <div class="quick-templates">
                <h4><i class="fas fa-bolt"></i> Quick Templates</h4>
                <div class="templates-grid">
                    <div class="template-item" data-type="paragraphs" data-quantity="3" data-variant="standard">
                        <strong>3 Paragraphs</strong>
                        <span>Standard format</span>
                    </div>
                    <div class="template-item" data-type="words" data-quantity="50" data-variant="standard">
                        <strong>50 Words</strong>
                        <span>Quick word count</span>
                    </div>
                    <div class="template-item" data-type="sentences" data-quantity="10" data-variant="classic">
                        <strong>10 Sentences</strong>
                        <span>Classic Cicero</span>
                    </div>
                    <div class="template-item" data-type="paragraphs" data-quantity="5" data-variant="tech">
                        <strong>5 Tech Paragraphs</strong>
                        <span>Modern tech style</span>
                    </div>
                    <div class="template-item" data-type="list" data-quantity="8" data-variant="modern">
                        <strong>8 List Items</strong>
                        <span>Bullet points</span>
                    </div>
                    <div class="template-item" data-type="paragraphs" data-quantity="2" data-variant="hipster">
                        <strong>2 Hipster Paragraphs</strong>
                        <span>Trendy style</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="lorem-info">
            <h3><i class="fas fa-info-circle"></i> About Lorem Ipsum</h3>
            <div class="info-content">
                <p>Lorem Ipsum is dummy text used by the printing and typesetting industry since the 1500s. It has survived not only five centuries, but also the leap into electronic typesetting.</p>
                
                <div class="variants-grid">
                    <div class="variant-card">
                        <h4><i class="fas fa-scroll"></i> Standard Lorem Ipsum</h4>
                        <p>The classic Latin text from Cicero's "de Finibus Bonorum et Malorum" used since the 1500s.</p>
                    </div>
                    <div class="variant-card">
                        <h4><i class="fas fa-monument"></i> Classic Cicero</h4>
                        <p>Authentic text from Cicero's philosophical work, maintaining historical accuracy.</p>
                    </div>
                    <div class="variant-card">
                        <h4><i class="fas fa-building"></i> Modern Corporate</h4>
                        <p>Contemporary business-focused dummy text with modern vocabulary and tone.</p>
                    </div>
                    <div class="variant-card">
                        <h4><i class="fas fa-laptop-code"></i> Tech Ipsum</h4>
                        <p>Technology-focused dummy text with programming and digital terminology.</p>
                    </div>
                    <div class="variant-card">
                        <h4><i class="fas fa-tshirt"></i> Hipster Ipsum</h4>
                        <p>Trendy, modern dummy text with contemporary slang and cultural references.</p>
                    </div>
                    <div class="variant-card">
                        <h4><i class="fas fa-birthday-cake"></i> Cupcake Ipsum</h4>
                        <p>Sweet and playful dummy text with dessert and baking terminology.</p>
                    </div>
                </div>

                <div class="history-section">
                    <h4><i class="fas fa-history"></i> History of Lorem Ipsum</h4>
                    <p>Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book was a treatise on the theory of ethics, very popular during the Renaissance.</p>
                    
                    <div class="timeline">
                        <div class="timeline-item">
                            <strong>45 BC</strong>
                            <span>Cicero writes "de Finibus Bonorum et Malorum"</span>
                        </div>
                        <div class="timeline-item">
                            <strong>1500s</strong>
                            <span>First known use of scrambled Latin text as dummy text</span>
                        </div>
                        <div class="timeline-item">
                            <strong>1960s</strong>
                            <span>Popularized by Letraset transfer sheets</span>
                        </div>
                        <div class="timeline-item">
                            <strong>1980s</strong>
                            <span>Adopted by Aldus PageMaker including versions of Lorem Ipsum</span>
                        </div>
                        <div class="timeline-item">
                            <strong>Today</strong>
                            <span>Standard dummy text in design and publishing</span>
                        </div>
                    </div>
                </div>

                <div class="usage-tips">
                    <h4><i class="fas fa-lightbulb"></i> Usage Tips</h4>
                    <ul>
                        <li><strong>Web Design:</strong> Use to test layouts and typography</li>
                        <li><strong>Print Design:</strong> Preview how text will flow in documents</li>
                        <li><strong>Development:</strong> Test database fields and text rendering</li>
                        <li><strong>Prototyping:</strong> Create realistic mockups with proper text</li>
                        <li><strong>Presentation:</strong> Fill slides and documents during design phase</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>