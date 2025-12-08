<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Free Tip Calculator | Calculate Tips & Split Bills Easily</title>
    <meta name="description" content="Free tip calculator to calculate tips, split bills, and manage restaurant payments. Perfect for groups, restaurants, and everyday use">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="vip-header">
        <div class="container">
            <div class="logo-section">
                <h1>Tip Calculator</h1>
                <div class="vip-badge">FREE TOOL</div>
            </div>
            <nav class="main-nav">
                <ul>
                    <li><a href="#calculator">Calculator</a></li>
                    <li><a href="#features">Features</a></li>
                    <li><a href="#guide">Guide</a></li>
                    <li><a href="#countries">Countries</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <section class="hero-section">
            <div class="container">
                <div class="hero-content">
                    <h2>Calculate Tips & Split Bills Fairly</h2>
                    <p>The easiest way to calculate tips, split bills, and manage group payments</p>
                    <div class="hero-stats">
                        <div class="stat">
                            <div class="stat-number">15%</div>
                            <div class="stat-label">Standard Tip Rate</div>
                        </div>
                        <div class="stat">
                            <div class="stat-number">6</div>
                            <div class="stat-label">People Max Split</div>
                        </div>
                        <div class="stat">
                            <div class="stat-number">20+</div>
                            <div class="stat-label">Countries Supported</div>
                        </div>
                    </div>
                    <a href="#calculator" class="cta-button">Calculate Tip Now</a>
                </div>
                <div class="hero-image">
                    <div class="receipt-visual">
                        <div class="receipt">
                            <div class="receipt-header">
                                <h3>Restaurant Bill</h3>
                                <div class="receipt-date">Today</div>
                            </div>
                            <div class="receipt-items">
                                <div class="receipt-item">
                                    <span>Food & Drinks</span>
                                    <span>$85.00</span>
                                </div>
                                <div class="receipt-item">
                                    <span>Tax (8%)</span>
                                    <span>$6.80</span>
                                </div>
                                <div class="receipt-item total">
                                    <span>Subtotal</span>
                                    <span>$91.80</span>
                                </div>
                                <div class="receipt-item tip">
                                    <span>Tip (15%)</span>
                                    <span>$13.77</span>
                                </div>
                                <div class="receipt-item grand-total">
                                    <span>Total</span>
                                    <span>$105.57</span>
                                </div>
                            </div>
                            <div class="receipt-split">
                                <div class="split-info">Split 4 ways: $26.39 each</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="calculator" class="calculator-section">
            <div class="container">
                <h2>Tip Calculator</h2>
                <div class="calculator-card">
                    <form id="tipCalculator" action="calculator.php" method="POST">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="billAmount">Bill Amount ($):</label>
                                <input type="number" id="billAmount" name="billAmount" min="0" step="0.01" placeholder="100.00" required>
                                <div class="input-hint">Enter the total bill amount</div>
                            </div>
                            <div class="form-group">
                                <label for="taxAmount">Tax Amount ($):</label>
                                <input type="number" id="taxAmount" name="taxAmount" min="0" step="0.01" placeholder="8.00">
                                <div class="input-hint">Optional - enter tax if separate</div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="tipPercentage">Tip Percentage:</label>
                            <div class="percentage-buttons">
                                <button type="button" class="percentage-btn" data-percentage="10">10%</button>
                                <button type="button" class="percentage-btn" data-percentage="15">15%</button>
                                <button type="button" class="percentage-btn active" data-percentage="18">18%</button>
                                <button type="button" class="percentage-btn" data-percentage="20">20%</button>
                                <button type="button" class="percentage-btn" data-percentage="25">25%</button>
                                <input type="number" id="tipPercentage" name="tipPercentage" min="0" max="100" step="0.1" value="18" required>
                                <span class="percentage-symbol">%</span>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="peopleCount">Split Between:</label>
                                <div class="people-selector">
                                    <button type="button" class="people-btn" data-action="decrease">-</button>
                                    <input type="number" id="peopleCount" name="peopleCount" min="1" max="20" value="1" required>
                                    <button type="button" class="people-btn" data-action="increase">+</button>
                                    <span class="people-label">people</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="roundUp">Round Up to Nearest:</label>
                                <select id="roundUp" name="roundUp">
                                    <option value="0">Don't Round</option>
                                    <option value="1">$1</option>
                                    <option value="5">$5</option>
                                    <option value="10">$10</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="country">Country/Region:</label>
                            <select id="country" name="country">
                                <option value="us">United States</option>
                                <option value="ca">Canada</option>
                                <option value="uk">United Kingdom</option>
                                <option value="au">Australia</option>
                                <option value="eu">European Union</option>
                                <option value="mx">Mexico</option>
                                <option value="custom">Custom</option>
                            </select>
                        </div>

                        <button type="submit" class="calculate-btn">
                            <span class="btn-text">Calculate Tip</span>
                            <span class="btn-loading" style="display: none;">Calculating...</span>
                        </button>
                    </form>

                    <div id="results" class="results-section" style="display: none;">
                        <h3>Your Bill Summary</h3>
                        
                        <div class="summary-cards">
                            <div class="summary-card">
                                <div class="summary-icon">💰</div>
                                <div class="summary-content">
                                    <h4>Tip Amount</h4>
                                    <p id="tipAmount">$0.00</p>
                                    <span id="tipPercentageText">0%</span>
                                </div>
                            </div>
                            <div class="summary-card">
                                <div class="summary-icon">🧾</div>
                                <div class="summary-content">
                                    <h4>Total Bill</h4>
                                    <p id="totalBill">$0.00</p>
                                    <span>Including tip</span>
                                </div>
                            </div>
                            <div class="summary-card">
                                <div class="summary-icon">👥</div>
                                <div class="summary-content">
                                    <h4>Per Person</h4>
                                    <p id="perPerson">$0.00</p>
                                    <span id="peopleText">1 person</span>
                                </div>
                            </div>
                        </div>

                        <div class="detailed-breakdown">
                            <h4>Bill Breakdown</h4>
                            <div class="breakdown-grid">
                                <div class="breakdown-item">
                                    <span class="breakdown-label">Subtotal</span>
                                    <span class="breakdown-value" id="subtotalAmount">$0.00</span>
                                </div>
                                <div class="breakdown-item">
                                    <span class="breakdown-label">Tax</span>
                                    <span class="breakdown-value" id="taxAmountResult">$0.00</span>
                                </div>
                                <div class="breakdown-item">
                                    <span class="breakdown-label">Tip</span>
                                    <span class="breakdown-value" id="tipAmountResult">$0.00</span>
                                </div>
                                <div class="breakdown-item total">
                                    <span class="breakdown-label">Total Amount</span>
                                    <span class="breakdown-value" id="totalAmount">$0.00</span>
                                </div>
                            </div>
                        </div>

                        <div class="split-results">
                            <h4>Split Bill</h4>
                            <div class="split-grid" id="splitGrid">
                                <!-- Split results will be populated here -->
                            </div>
                        </div>

                        <div class="tip-suggestions">
                            <h4>Tip Suggestions</h4>
                            <div class="suggestions-grid">
                                <div class="suggestion-card">
                                    <h5>Standard Service</h5>
                                    <p class="suggestion-percentage">15%</p>
                                    <p class="suggestion-amount" id="suggestion15">$0.00</p>
                                </div>
                                <div class="suggestion-card">
                                    <h5>Good Service</h5>
                                    <p class="suggestion-percentage">18%</p>
                                    <p class="suggestion-amount" id="suggestion18">$0.00</p>
                                </div>
                                <div class="suggestion-card">
                                    <h5>Excellent Service</h5>
                                    <p class="suggestion-percentage">20%</p>
                                    <p class="suggestion-amount" id="suggestion20">$0.00</p>
                                </div>
                                <div class="suggestion-card">
                                    <h5>Outstanding</h5>
                                    <p class="suggestion-percentage">25%</p>
                                    <p class="suggestion-amount" id="suggestion25">$0.00</p>
                                </div>
                            </div>
                        </div>

                        <div class="action-buttons">
                            <button class="action-btn" id="resetBtn">Calculate Again</button>
                            <button class="action-btn secondary" id="shareBtn">Share Results</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="features" class="features-section">
            <div class="container">
                <h2>Why Use Our Tip Calculator?</h2>
                <div class="features-grid">
                    <div class="feature-card">
                        <div class="feature-icon">⚡</div>
                        <h3>Lightning Fast</h3>
                        <p>Calculate tips instantly with our optimized calculator</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">🎯</div>
                        <h3>Accurate Results</h3>
                        <p>Precise calculations with proper rounding and tax handling</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">👥</div>
                        <h3>Easy Splitting</h3>
                        <p>Split bills fairly among any number of people</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">🌍</div>
                        <h3>Global Support</h3>
                        <p>Works with different currencies and tipping customs</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="guide" class="guide-section">
            <div class="container">
                <h2>Tipping Guide & Etiquette</h2>
                <div class="guide-grid">
                    <div class="guide-card">
                        <h3>United States</h3>
                        <div class="guide-rates">
                            <div class="rate-item">
                                <span>Restaurants</span>
                                <span>15-20%</span>
                            </div>
                            <div class="rate-item">
                                <span>Food Delivery</span>
                                <span>10-15%</span>
                            </div>
                            <div class="rate-item">
                                <span>Taxi/Uber</span>
                                <span>15-20%</span>
                            </div>
                        </div>
                    </div>
                    <div class="guide-card">
                        <h3>Canada</h3>
                        <div class="guide-rates">
                            <div class="rate-item">
                                <span>Restaurants</span>
                                <span>15-18%</span>
                            </div>
                            <div class="rate-item">
                                <span>Delivery</span>
                                <span>10-15%</span>
                            </div>
                        </div>
                    </div>
                    <div class="guide-card">
                        <h3>Europe</h3>
                        <div class="guide-rates">
                            <div class="rate-item">
                                <span>Restaurants</span>
                                <span>5-10%</span>
                            </div>
                            <div class="rate-item">
                                <span>Service Included</span>
                                <span>Round Up</span>
                            </div>
                        </div>
                    </div>
                    <div class="guide-card">
                        <h3>Australia</h3>
                        <div class="guide-rates">
                            <div class="rate-item">
                                <span>Restaurants</span>
                                <span>10%</span>
                            </div>
                            <div class="rate-item">
                                <span>Exceptional</span>
                                <span>15%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="countries" class="countries-section">
            <div class="container">
                <h2>Tipping Customs Worldwide</h2>
                <div class="countries-grid">
                    <div class="country-card">
                        <h4>🇺🇸 USA</h4>
                        <p>Tipping is expected in restaurants, typically 15-20%</p>
                    </div>
                    <div class="country-card">
                        <h4>🇬🇧 UK</h4>
                        <p>10-12.5% in restaurants, often included in bill</p>
                    </div>
                    <div class="country-card">
                        <h4>🇯🇵 Japan</h4>
                        <p>Tipping is not customary and may be refused</p>
                    </div>
                    <div class="country-card">
                        <h4>🇫🇷 France</h4>
                        <p>Service included, round up or leave small change</p>
                    </div>
                    <div class="country-card">
                        <h4>🇨🇦 Canada</h4>
                        <p>Similar to US, 15-18% in restaurants</p>
                    </div>
                    <div class="country-card">
                        <h4>🇦🇺 Australia</h4>
                        <p>10% for good service, not always expected</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>Tip Calculator</h3>
                    <p>Your trusted tool for fair and easy bill splitting</p>
                </div>
                <div class="footer-section">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="#calculator">Calculator</a></li>
                        <li><a href="#features">Features</a></li>
                        <li><a href="#guide">Guide</a></li>
                        <li><a href="#countries">Countries</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>Support</h4>
                    <ul>
                        <li><a href="#">Help Center</a></li>
                        <li><a href="#">Contact Us</a></li>
                        <li><a href="#">Feedback</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>Legal</h4>
                    <ul>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms of Service</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2024 Tip Calculator. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>