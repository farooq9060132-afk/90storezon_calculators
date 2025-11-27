<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Storage Calculator | VIP Service</title>
    <meta name="description" content="Calculate your data storage needs and choose the best plan. Easy to use">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="vip-header">
        <div class="container">
            <div class="logo-section">
                <h1>Data Storage Calculator</h1>
                <div class="vip-badge">VIP SERVICE</div>
            </div>
            <nav class="main-nav">
                <ul>
                    <li><a href="#calculator">Calculator</a></li>
                    <li><a href="#features">Features</a></li>
                    <li><a href="#plans">Plans</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <section class="hero-section">
            <div class="container">
                <div class="hero-content">
                    <h2>Calculate Your Data Storage Needs</h2>
                    <p>Our free calculator provides accurate estimates to help you choose the best storage plan</p>
                    <a href="#calculator" class="cta-button">Use Calculator</a>
                </div>
                <div class="hero-image">
                    <div class="storage-visual">
                        <div class="cloud-icon">☁️</div>
                        <div class="data-flow"></div>
                    </div>
                </div>
            </div>
        </section>

        <section id="calculator" class="calculator-section">
            <div class="container">
                <h2>Data Storage Calculator</h2>
                <div class="calculator-card">
                    <form id="storageCalculator" action="calculator.php" method="POST">
                        <div class="form-group">
                            <label for="fileType">File Type:</label>
                            <select id="fileType" name="fileType" required>
                                <option value="">Select file type</option>
                                <option value="documents">Documents</option>
                                <option value="images">Images</option>
                                <option value="videos">Videos</option>
                                <option value="audio">Audio Files</option>
                                <option value="backup">System Backup</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="fileSize">Average File Size:</label>
                            <select id="fileSize" name="fileSize" required>
                                <option value="">Select size</option>
                                <option value="small">Small (1-10 MB)</option>
                                <option value="medium">Medium (10-100 MB)</option>
                                <option value="large">Large (100-500 MB)</option>
                                <option value="xlarge">Extra Large (500+ MB)</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="fileCount">Number of Files:</label>
                            <input type="number" id="fileCount" name="fileCount" min="1" max="100000" placeholder="Enter number of files" required>
                        </div>

                        <div class="form-group">
                            <label for="growthRate">Monthly Growth Rate (%):</label>
                            <input type="number" id="growthRate" name="growthRate" min="0" max="100" value="5" step="0.1" required>
                        </div>

                        <div class="form-group">
                            <label for="duration">Storage Duration (months):</label>
                            <input type="number" id="duration" name="duration" min="1" max="120" value="12" required>
                        </div>

                        <button type="submit" class="calculate-btn">Calculate Storage Needs</button>
                    </form>

                    <div id="results" class="results-section" style="display: none;">
                        <h3>Your Storage Analysis</h3>
                        <div class="result-grid">
                            <div class="result-card">
                                <h4>Initial Storage</h4>
                                <p id="initialStorage">0 GB</p>
                            </div>
                            <div class="result-card">
                                <h4>After 12 Months</h4>
                                <p id="projectedStorage">0 GB</p>
                            </div>
                            <div class="result-card">
                                <h4>Recommended Plan</h4>
                                <p id="recommendedPlan">Basic</p>
                            </div>
                            <div class="result-card">
                                <h4>Monthly Cost</h4>
                                <p id="monthlyCost">$0</p>
                            </div>
                        </div>
                        <div class="plan-recommendation">
                            <h4>Recommended For You:</h4>
                            <p id="planDescription">Based on your needs, we recommend our Basic plan</p>
                            <button class="plan-btn">View Plan Details</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="features" class="features-section">
            <div class="container">
                <h2>Why Choose Our Storage Calculator?</h2>
                <div class="features-grid">
                    <div class="feature-card">
                        <div class="feature-icon">⚡</div>
                        <h3>Lightning Fast</h3>
                        <p>Get instant calculations and recommendations</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">🎯</div>
                        <h3>Accurate Results</h3>
                        <p>Precise storage estimates based on your data</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">💰</div>
                        <h3>Cost Effective</h3>
                        <p>Find the most budget-friendly storage solutions</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">🛡️</div>
                        <h3>Secure & Private</h3>
                        <p>Your data remains confidential and secure</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="plans" class="plans-section">
            <div class="container">
                <h2>Storage Plans</h2>
                <div class="plans-grid">
                    <div class="plan-card">
                        <h3>Basic</h3>
                        <div class="price">$5<span>/month</span></div>
                        <ul>
                            <li>50 GB Storage</li>
                            <li>Basic Security</li>
                            <li>Email Support</li>
                            <li>99% Uptime</li>
                        </ul>
                        <button class="select-plan">Select Plan</button>
                    </div>
                    <div class="plan-card popular">
                        <div class="popular-badge">Most Popular</div>
                        <h3>Professional</h3>
                        <div class="price">$15<span>/month</span></div>
                        <ul>
                            <li>500 GB Storage</li>
                            <li>Advanced Security</li>
                            <li>Priority Support</li>
                            <li>99.9% Uptime</li>
                        </ul>
                        <button class="select-plan">Select Plan</button>
                    </div>
                    <div class="plan-card">
                        <h3>Enterprise</h3>
                        <div class="price">$50<span>/month</span></div>
                        <ul>
                            <li>2 TB Storage</li>
                            <li>Maximum Security</li>
                            <li>24/7 Support</li>
                            <li>99.99% Uptime</li>
                        </ul>
                        <button class="select-plan">Select Plan</button>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer id="contact" class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>Data Storage Calculator</h3>
                    <p>Your trusted partner for storage solutions</p>
                </div>
                <div class="footer-section">
                    <h4>Contact Us</h4>
                    <p>Email: info@storagedemo.com</p>
                    <p>Phone: +1 (555) 123-4567</p>
                </div>
                <div class="footer-section">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="#calculator">Calculator</a></li>
                        <li><a href="#features">Features</a></li>
                        <li><a href="#plans">Plans</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2024 Data Storage Calculator. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>