<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Load Time Calculator | VIP Performance Analysis</title>
    <meta name="description" content="Calculate your website load time and get optimization recommendations. Improve your site speed and user experience with our calculator">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="vip-header">
        <div class="container">
            <div class="logo-section">
                <h1>Website Load Time Calculator</h1>
                <div class="vip-badge">VIP PERFORMANCE</div>
            </div>
            <nav class="main-nav">
                <ul>
                    <li><a href="#calculator">Calculator</a></li>
                    <li><a href="#features">Features</a></li>
                    <li><a href="#tools">Tools</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <section class="hero-section">
            <div class="container">
                <div class="hero-content">
                    <h2>Optimize Your Website Speed</h2>
                    <p>Calculate load times and get actionable recommendations to improve your website performance</p>
                    <div class="hero-stats">
                        <div class="stat">
                            <div class="stat-number">53%</div>
                            <div class="stat-label">of users leave if site takes >3s to load</div>
                        </div>
                        <div class="stat">
                            <div class="stat-number">+20%</div>
                            <div class="stat-label">conversion rate improvement with faster sites</div>
                        </div>
                    </div>
                    <a href="#calculator" class="cta-button">Analyze Your Site</a>
                </div>
                <div class="hero-image">
                    <div class="speed-visual">
                        <div class="gauge">
                            <div class="gauge-fill" style="transform: rotate(120deg);"></div>
                            <div class="gauge-center"></div>
                            <div class="gauge-value">2.3s</div>
                        </div>
                        <div class="loading-bars">
                            <div class="bar" style="--delay: 0s;"></div>
                            <div class="bar" style="--delay: 0.2s;"></div>
                            <div class="bar" style="--delay: 0.4s;"></div>
                            <div class="bar" style="--delay: 0.6s;"></div>
                            <div class="bar" style="--delay: 0.8s;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="calculator" class="calculator-section">
            <div class="container">
                <h2>Website Load Time Calculator</h2>
                <div class="calculator-card">
                    <form id="loadTimeCalculator" action="calculator.php" method="POST">
                        <div class="form-group">
                            <label for="websiteUrl">Website URL:</label>
                            <input type="url" id="websiteUrl" name="websiteUrl" placeholder="https://example.com" required>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="pageSize">Total Page Size (MB):</label>
                                <input type="number" id="pageSize" name="pageSize" min="0.1" max="50" step="0.1" placeholder="2.5" required>
                            </div>
                            <div class="form-group">
                                <label for="imageCount">Number of Images:</label>
                                <input type="number" id="imageCount" name="imageCount" min="0" max="500" value="15" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="serverLocation">Server Location:</label>
                                <select id="serverLocation" name="serverLocation" required>
                                    <option value="">Select location</option>
                                    <option value="us-east">US East</option>
                                    <option value="us-west">US West</option>
                                    <option value="europe">Europe</option>
                                    <option value="asia">Asia</option>
                                    <option value="australia">Australia</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="userLocation">User Location:</label>
                                <select id="userLocation" name="userLocation" required>
                                    <option value="">Select location</option>
                                    <option value="us-east">US East</option>
                                    <option value="us-west">US West</option>
                                    <option value="europe">Europe</option>
                                    <option value="asia">Asia</option>
                                    <option value="australia">Australia</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="connectionSpeed">User Connection Speed:</label>
                            <select id="connectionSpeed" name="connectionSpeed" required>
                                <option value="">Select speed</option>
                                <option value="slow">Slow (3G - 1 Mbps)</option>
                                <option value="medium" selected>Medium (4G - 5 Mbps)</option>
                                <option value="fast">Fast (5G - 20 Mbps)</option>
                                <option value="fiber">Fiber (100+ Mbps)</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="optimizationLevel">Current Optimization Level:</label>
                            <select id="optimizationLevel" name="optimizationLevel" required>
                                <option value="">Select level</option>
                                <option value="none">None (No optimization)</option>
                                <option value="basic">Basic (Minimal optimization)</option>
                                <option value="moderate">Moderate (Some optimization)</option>
                                <option value="advanced">Advanced (Well optimized)</option>
                            </select>
                        </div>

                        <button type="submit" class="calculate-btn">Calculate Load Time</button>
                    </form>

                    <div id="results" class="results-section" style="display: none;">
                        <h3>Performance Analysis</h3>
                        <div class="performance-score">
                            <div class="score-circle">
                                <svg width="120" height="120" viewBox="0 0 120 120">
                                    <circle class="score-bg" cx="60" cy="60" r="54"></circle>
                                    <circle class="score-progress" cx="60" cy="60" r="54" style="stroke-dashoffset: 339.292;"></circle>
                                </svg>
                                <div class="score-text">
                                    <div class="score-number" id="performanceScore">85</div>
                                    <div class="score-label">SCORE</div>
                                </div>
                            </div>
                            <div class="score-details">
                                <h4 id="performanceGrade">Good</h4>
                                <p id="performanceDescription">Your website performance is above average</p>
                            </div>
                        </div>

                        <div class="result-grid">
                            <div class="result-card">
                                <h4>Estimated Load Time</h4>
                                <p id="loadTime">2.3s</p>
                                <div class="result-bar">
                                    <div class="bar-fill" id="loadTimeBar" style="width: 65%;"></div>
                                </div>
                            </div>
                            <div class="result-card">
                                <h4>Performance Grade</h4>
                                <p id="grade">B+</p>
                                <div class="grade-badge" id="gradeBadge">Good</div>
                            </div>
                            <div class="result-card">
                                <h4>User Experience</h4>
                                <p id="userExperience">Good</p>
                                <div class="experience-indicator" id="experienceIndicator"></div>
                            </div>
                            <div class="result-card">
                                <h4>SEO Impact</h4>
                                <p id="seoImpact">Positive</p>
                                <div class="impact-meter" id="impactMeter"></div>
                            </div>
                        </div>

                        <div class="recommendations-section">
                            <h4>Optimization Recommendations</h4>
                            <div class="recommendations-list" id="recommendationsList">
                                <!-- Recommendations will be populated by JavaScript -->
                            </div>
                        </div>

                        <div class="comparison-section">
                            <h4>Industry Comparison</h4>
                            <div class="comparison-chart">
                                <div class="comparison-item">
                                    <span>Your Site</span>
                                    <div class="comparison-bar">
                                        <div class="bar-fill your-site" id="yourSiteBar" style="width: 65%;"></div>
                                    </div>
                                    <span id="yourSiteTime">2.3s</span>
                                </div>
                                <div class="comparison-item">
                                    <span>Industry Average</span>
                                    <div class="comparison-bar">
                                        <div class="bar-fill industry-avg" style="width: 50%;"></div>
                                    </div>
                                    <span>3.2s</span>
                                </div>
                                <div class="comparison-item">
                                    <span>Top 10%</span>
                                    <div class="comparison-bar">
                                        <div class="bar-fill top-performers" style="width: 80%;"></div>
                                    </div>
                                    <span>1.4s</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="features" class="features-section">
            <div class="container">
                <h2>Why Monitor Load Times?</h2>
                <div class="features-grid">
                    <div class="feature-card">
                        <div class="feature-icon">🚀</div>
                        <h3>Better User Experience</h3>
                        <p>Faster sites keep users engaged and reduce bounce rates significantly</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">📈</div>
                        <h3>Higher Conversions</h3>
                        <p>Every 100ms improvement can increase conversion rates by up to 1%</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">🔍</div>
                        <h3>SEO Benefits</h3>
                        <p>Google uses page speed as a ranking factor in search results</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">💰</div>
                        <h3>Cost Effective</h3>
                        <p>Optimizing load times is cheaper than acquiring new visitors</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="tools" class="tools-section">
            <div class="container">
                <h2>Performance Optimization Tools</h2>
                <div class="tools-grid">
                    <div class="tool-card">
                        <h3>Image Optimizer</h3>
                        <p>Compress and optimize images without quality loss</p>
                        <button class="tool-btn">Use Tool</button>
                    </div>
                    <div class="tool-card">
                        <h3>Code Minifier</h3>
                        <p>Minify CSS, JavaScript, and HTML files</p>
                        <button class="tool-btn">Use Tool</button>
                    </div>
                    <div class="tool-card">
                        <h3>CDN Checker</h3>
                        <p>Check if your site uses Content Delivery Network</p>
                        <button class="tool-btn">Use Tool</button>
                    </div>
                    <div class="tool-card">
                        <h3>Caching Analyzer</h3>
                        <p>Analyze and optimize browser caching strategies</p>
                        <button class="tool-btn">Use Tool</button>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer id="contact" class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>Website Load Time Calculator</h3>
                    <p>Your trusted partner for website performance optimization</p>
                </div>
                <div class="footer-section">
                    <h4>Contact Us</h4>
                    <p>Email: performance@websitedemo.com</p>
                    <p>Phone: +1 (555) 123-4567</p>
                </div>
                <div class="footer-section">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="#calculator">Calculator</a></li>
                        <li><a href="#features">Features</a></li>
                        <li><a href="#tools">Tools</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2024 Website Load Time Calculator. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>