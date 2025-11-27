<?php
$title = "Free Character Counter - Count Characters, Words & Sentences Online";
$description = "Count characters, words, sentences, paragraphs and more with our free online character counter. Real-time text analysis with detailed statistics.";
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
            <h1><i class="fas fa-text-width"></i> Free Character Counter</h1>
            <p>Count characters, words, sentences and analyze your text in real-time</p>
        </div>

        <div class="calculator">
            <div class="input-group">
                <label for="inputText"><i class="fas fa-text-height"></i> Enter Your Text</label>
                <textarea id="inputText" placeholder="Type or paste your text here to analyze..." rows="10">Hello! This is a sample text for character counting demonstration.

This tool helps you count:
- Characters (with and without spaces)
- Words and sentences
- Paragraphs and reading time
- And much more!

Try it with your own text and see the detailed analysis.</textarea>
                <div class="input-help">
                    <small>Start typing or paste your text to see real-time character count and analysis</small>
                </div>
            </div>

            <div class="options-section">
                <h4><i class="fas fa-cog"></i> Counting Options</h4>
                <div class="options-grid">
                    <div class="option-group">
                        <label class="checkbox-label">
                            <input type="checkbox" id="countSpaces" checked> Include spaces in character count
                        </label>
                    </div>
                    <div class="option-group">
                        <label class="checkbox-label">
                            <input type="checkbox" id="countPunctuation" checked> Include punctuation in word count
                        </label>
                    </div>
                    <div class="option-group">
                        <label class="checkbox-label">
                            <input type="checkbox" id="autoUpdate" checked> Real-time updates
                        </label>
                    </div>
                </div>
            </div>

            <div class="actions">
                <button id="analyzeText" class="btn-primary">
                    <i class="fas fa-chart-bar"></i> Analyze Text
                </button>
                <button id="clearText" class="btn-secondary">
                    <i class="fas fa-broom"></i> Clear Text
                </button>
                <button id="copyText" class="btn-secondary">
                    <i class="fas fa-copy"></i> Copy Text
                </button>
            </div>

            <div id="results" class="results-container">
                <h3><i class="fas fa-chart-pie"></i> Text Analysis Results</h3>
                
                <div class="stats-grid">
                    <div class="stat-card primary">
                        <div class="stat-icon">
                            <i class="fas fa-font"></i>
                        </div>
                        <div class="stat-content">
                            <span class="stat-value" id="charCountWithSpaces">0</span>
                            <span class="stat-label">Characters (with spaces)</span>
                        </div>
                    </div>
                    
                    <div class="stat-card secondary">
                        <div class="stat-icon">
                            <i class="fas fa-text-width"></i>
                        </div>
                        <div class="stat-content">
                            <span class="stat-value" id="charCountWithoutSpaces">0</span>
                            <span class="stat-label">Characters (no spaces)</span>
                        </div>
                    </div>
                    
                    <div class="stat-card success">
                        <div class="stat-icon">
                            <i class="fas fa-file-word"></i>
                        </div>
                        <div class="stat-content">
                            <span class="stat-value" id="wordCount">0</span>
                            <span class="stat-label">Words</span>
                        </div>
                    </div>
                    
                    <div class="stat-card info">
                        <div class="stat-icon">
                            <i class="fas fa-sentence"></i>
                        </div>
                        <div class="stat-content">
                            <span class="stat-value" id="sentenceCount">0</span>
                            <span class="stat-label">Sentences</span>
                        </div>
                    </div>
                    
                    <div class="stat-card warning">
                        <div class="stat-icon">
                            <i class="fas fa-paragraph"></i>
                        </div>
                        <div class="stat-content">
                            <span class="stat-value" id="paragraphCount">0</span>
                            <span class="stat-label">Paragraphs</span>
                        </div>
                    </div>
                    
                    <div class="stat-card danger">
                        <div class="stat-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="stat-content">
                            <span class="stat-value" id="readingTime">0</span>
                            <span class="stat-label">Reading Time</span>
                        </div>
                    </div>
                </div>

                <div class="detailed-stats">
                    <div class="stat-section">
                        <h4><i class="fas fa-list-ol"></i> Detailed Counts</h4>
                        <div class="detail-grid">
                            <div class="detail-item">
                                <span class="detail-label">Letters:</span>
                                <span class="detail-value" id="letterCount">0</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Digits:</span>
                                <span class="detail-value" id="digitCount">0</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Spaces:</span>
                                <span class="detail-value" id="spaceCount">0</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Punctuation:</span>
                                <span class="detail-value" id="punctuationCount">0</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Special Characters:</span>
                                <span class="detail-value" id="specialCharCount">0</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Lines:</span>
                                <span class="detail-value" id="lineCount">0</span>
                            </div>
                        </div>
                    </div>

                    <div class="stat-section">
                        <h4><i class="fas fa-chart-line"></i> Text Metrics</h4>
                        <div class="metrics-grid">
                            <div class="metric-item">
                                <span class="metric-label">Average Word Length:</span>
                                <span class="metric-value" id="avgWordLength">0</span>
                            </div>
                            <div class="metric-item">
                                <span class="metric-label">Average Sentence Length:</span>
                                <span class="metric-value" id="avgSentenceLength">0</span>
                            </div>
                            <div class="metric-item">
                                <span class="metric-label">Words per Sentence:</span>
                                <span class="metric-value" id="wordsPerSentence">0</span>
                            </div>
                            <div class="metric-item">
                                <span class="metric-label">Characters per Word:</span>
                                <span class="metric-value" id="charsPerWord">0</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="frequency-section">
                    <h4><i class="fas fa-sort-alpha-down"></i> Word Frequency</h4>
                    <div id="wordFrequency" class="frequency-list">
                        <div class="frequency-placeholder">
                            Word frequency analysis will appear here...
                        </div>
                    </div>
                </div>

                <div class="limits-section">
                    <h4><i class="fas fa-ruler"></i> Text Limits</h4>
                    <div class="limits-grid">
                        <div class="limit-item">
                            <label for="charLimit">Character Limit:</label>
                            <input type="number" id="charLimit" placeholder="e.g., 280" min="1" value="280">
                            <div class="limit-progress">
                                <div class="progress-bar">
                                    <div class="progress-fill" id="charProgress"></div>
                                </div>
                                <span class="progress-text" id="charProgressText">0%</span>
                            </div>
                        </div>
                        <div class="limit-item">
                            <label for="wordLimit">Word Limit:</label>
                            <input type="number" id="wordLimit" placeholder="e.g., 500" min="1" value="500">
                            <div class="limit-progress">
                                <div class="progress-bar">
                                    <div class="progress-fill" id="wordProgress"></div>
                                </div>
                                <span class="progress-text" id="wordProgressText">0%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-examples">
            <h3><i class="fas fa-lightbulb"></i> Text Examples</h3>
            <div class="examples-grid">
                <div class="example-item" data-text="This is a short sentence.">
                    <strong>Short Sentence</strong>
                    <code>This is a short sentence.</code>
                </div>
                <div class="example-item" data-text="Hello world! This is a longer piece of text with multiple sentences. It demonstrates how the character counter works with different types of content.">
                    <strong>Multiple Sentences</strong>
                    <code>Hello world! This is a longer piece of text...</code>
                </div>
                <div class="example-item" data-text="First paragraph.

Second paragraph with more content.

Third paragraph with even more detailed information and examples.">
                    <strong>Multiple Paragraphs</strong>
                    <code>First paragraph. Second paragraph...</code>
                </div>
                <div class="example-item" data-text="Contact: john@example.com | Phone: (555) 123-4567 | Website: https://example.com">
                    <strong>Contact Information</strong>
                    <code>Contact: john@example.com | Phone...</code>
                </div>
                <div class="example-item" data-text="The quick brown fox jumps over the lazy dog. 1234567890">
                    <strong>Classic Example</strong>
                    <code>The quick brown fox jumps over...</code>
                </div>
            </div>
        </div>

        <div class="info-section">
            <h3><i class="fas fa-info-circle"></i> About Character Counter</h3>
            <div class="info-content">
                <p>This character counter provides comprehensive text analysis with real-time statistics. It's perfect for writers, students, social media managers, and anyone who needs to monitor text length and composition.</p>
                
                <h4>What We Count:</h4>
                <ul>
                    <li><strong>Characters:</strong> Total characters with and without spaces</li>
                    <li><strong>Words:</strong> Individual words separated by spaces</li>
                    <li><strong>Sentences:</strong> Text segments ending with . ! or ?</li>
                    <li><strong>Paragraphs:</strong> Text blocks separated by line breaks</li>
                    <li><strong>Reading Time:</strong> Estimated time to read the text</li>
                    <li><strong>Character Types:</strong> Letters, digits, spaces, punctuation</li>
                </ul>

                <h4>Common Use Cases:</h4>
                <ul>
                    <li>Social media posts (Twitter, Facebook, Instagram)</li>
                    <li>Academic papers and essays</li>
                    <li>Email and message composition</li>
                    <li>SEO meta descriptions</li>
                    <li>Code comments and documentation</li>
                    <li>Translation and localization</li>
                </ul>

                <h4>Reading Time Calculation:</h4>
                <p>Reading time is calculated based on an average reading speed of 200-250 words per minute. This provides a realistic estimate for most readers.</p>

                <div class="limits-info">
                    <h4><i class="fas fa-exclamation-triangle"></i> Common Text Limits</h4>
                    <ul>
                        <li><strong>Twitter:</strong> 280 characters</li>
                        <li><strong>Facebook:</strong> 63,206 characters</li>
                        <li><strong>Instagram:</strong> 2,200 characters</li>
                        <li><strong>LinkedIn:</strong> 3,000 characters</li>
                        <li><strong>SMS:</strong> 160 characters</li>
                        <li><strong>Email Subject:</strong> 50-60 characters recommended</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>