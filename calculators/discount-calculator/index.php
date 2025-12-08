<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Free Discount Calculator | Calculate Savings & Sale Prices</title>
    <meta name="description" content="Free discount calculator to calculate sale prices, percentage discounts, and savings. Perfect for shopping, business pricing, and promotional calculations">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="vip-header">
        <div class="container">
            <div class="logo-section">
                <h1>Discount Calculator</h1>
                <div class="vip-badge">SAVE MORE</div>
            </div>
            <nav class="main-nav">
                <ul>
                    <li><a href="#calculator">Calculator</a></li>
                    <li><a href="#features">Features</a></li>
                    <li><a href="#examples">Examples</a></li>
                    <li><a href="#tips">Shopping Tips</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <section class="hero-section">
            <div class="container">
                <div class="hero-content">
                    <h2>Calculate Discounts & Save Money</h2>
                    <p>Instantly calculate sale prices, percentage discounts, and total savings for any purchase</p>
                    <div class="hero-stats">
                        <div class="stat">
                            <div class="stat-number">$2.5K+</div>
                            <div class="stat-label">Total Savings Calculated</div>
                        </div>
                        <div class="stat">
                            <div class="stat-number">15K+</div>
                            <div class="stat-label">Discounts Calculated</div>
                        </div>
                        <div class="stat">
                            <div class="stat-number">98%</div>
                            <div class="stat-label">Accuracy Rate</div>
                        </div>
                    </div>
                    <a href="#calculator" class="cta-button">Calculate Discount Now</a>
                </div>
                <div class="hero-image">
                    <div class="discount-visual">
                        <div class="price-tag">
                            <div class="original-price">$199.99</div>
                            <div class="discount-badge">-25% OFF</div>
                            <div class="sale-price">$149.99</div>
                            <div class="savings">You save $50.00</div>
                        </div>
                        <div class="shopping-cart">
                            <div class="cart-item">
                                <span>Product</span>
                                <span>$79.99</span>
                            </div>
                            <div class="cart-item discount">
                                <span>Discount (20%)</span>
                                <span>-$16.00</span>
                            </div>
                            <div class="cart-item total">
                                <span>Final Price</span>
                                <span>$63.99</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="calculator" class="calculator-section">
            <div class="container">
                <h2>Discount Calculator</h2>
                <p class="section-subtitle">Calculate final prices, discount amounts, and total savings instantly</p>
                
                <div class="calculator-card">
                    <form id="discountCalculator" action="calculator.php" method="POST">
                        <div class="calculation-modes">
                            <div class="mode-buttons">
                                <button type="button" class="mode-btn active" data-mode="percentage">Percentage Discount</button>
                                <button type="button" class="mode-btn" data-mode="fixed">Fixed Amount Discount</button>
                                <button type="button" class="mode-btn" data-mode="final">Final Price Calculation</button>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="originalPrice">Original Price ($):</label>
                            <input type="number" id="originalPrice" name="originalPrice" min="0" step="0.01" placeholder="100.00" required>
                            <div class="input-hint">Enter the original price before discount</div>
                        </div>

                        <div class="form-row" id="percentageFields">
                            <div class="form-group">
                                <label for="discountPercentage">Discount Percentage (%):</label>
                                <div class="percentage-controls">
                                    <div class="percentage-buttons">
                                        <button type="button" class="percent-btn" data-percent="5">5%</button>
                                        <button type="button" class="percent-btn" data-percent="10">10%</button>
                                        <button type="button" class="percent-btn" data-percent="15">15%</button>
                                        <button type="button" class="percent-btn" data-percent="20">20%</button>
                                        <button type="button" class="percent-btn" data-percent="25">25%</button>
                                        <button type="button" class="percent-btn" data-percent="30">30%</button>
                                        <button type="button" class="percent-btn" data-percent="40">40%</button>
                                        <button type="button" class="percent-btn" data-percent="50">50%</button>
                                    </div>
                                    <div class="custom-percentage">
                                        <input type="number" id="discountPercentage" name="discountPercentage" min="0" max="100" step="0.1" value="20" required>
                                        <span>%</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="discountAmount">Discount Amount ($):</label>
                                <input type="number" id="discountAmount" name="discountAmount" min="0" step="0.01" placeholder="0.00" readonly>
                                <div class="input-hint">Calculated discount amount</div>
                            </div>
                        </div>

                        <div class="form-row" id="fixedFields" style="display: none;">
                            <div class="form-group">
                                <label for="fixedDiscount">Fixed Discount Amount ($):</label>
                                <input type="number" id="fixedDiscount" name="fixedDiscount" min="0" step="0.01" placeholder="25.00">
                            </div>
                            <div class="form-group">
                                <label for="fixedPercentage">Equivalent Percentage (%):</label>
                                <input type="number" id="fixedPercentage" name="fixedPercentage" min="0" max="100" step="0.1" placeholder="0" readonly>
                            </div>
                        </div>

                        <div class="form-row" id="finalFields" style="display: none;">
                            <div class="form-group">
                                <label for="finalPrice">Final Sale Price ($):</label>
                                <input type="number" id="finalPrice" name="finalPrice" min="0" step="0.01" placeholder="75.00">
                            </div>
                            <div class="form-group">
                                <label for="calculatedDiscount">Calculated Discount (%):</label>
                                <input type="number" id="calculatedDiscount" name="calculatedDiscount" min="0" max="100" step="0.1" placeholder="0" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="taxRate">Sales Tax Rate (%):</label>
                            <input type="number" id="taxRate" name="taxRate" min="0" max="50" step="0.1" value="0" placeholder="0">
                            <div class="input-hint">Optional - enter your local sales tax rate</div>
                        </div>

                        <div class="advanced-options">
                            <h4>Additional Options</h4>
                            <div class="options-grid">
                                <div class="option-item">
                                    <input type="checkbox" id="applyTaxAfter" name="applyTaxAfter">
                                    <label for="applyTaxAfter">Apply tax after discount</label>
                                </div>
                                <div class="option-item">
                                    <input type="checkbox" id="roundResult" name="roundResult">
                                    <label for="roundResult">Round to nearest dollar</label>
                                </div>
                                <div class="option-item">
                                    <input type="checkbox" id="multipleItems" name="multipleItems">
                                    <label for="multipleItems">Calculate for multiple items</label>
                                </div>
                            </div>
                        </div>

                        <div class="quantity-section" id="quantitySection" style="display: none;">
                            <div class="form-group">
                                <label for="itemQuantity">Number of Items:</label>
                                <input type="number" id="itemQuantity" name="itemQuantity" min="1" max="1000" value="1">
                            </div>
                        </div>

                        <button type="submit" class="calculate-btn">
                            <span class="btn-text">Calculate Discount</span>
                            <span class="btn-loading" style="display: none;">Calculating...</span>
                        </button>
                    </form>

                    <div id="results" class="results-section" style="display: none;">
                        <h3>Discount Calculation Results</h3>
                        
                        <div class="results-summary">
                            <div class="summary-card">
                                <div class="summary-icon">💰</div>
                                <div class="summary-content">
                                    <h4>Original Price</h4>
                                    <p id="resultOriginalPrice">$0.00</p>
                                    <span>Before discount</span>
                                </div>
                            </div>
                            <div class="summary-card">
                                <div class="summary-icon">🎯</div>
                                <div class="summary-content">
                                    <h4>Discount</h4>
                                    <p id="resultDiscount">0%</p>
                                    <span id="resultDiscountAmount">$0.00</span>
                                </div>
                            </div>
                            <div class="summary-card">
                                <div class="summary-icon">🏷️</div>
                                <div class="summary-content">
                                    <h4>Final Price</h4>
                                    <p id="resultFinalPrice">$0.00</p>
                                    <span>After discount</span>
                                </div>
                            </div>
                            <div class="summary-card">
                                <div class="summary-icon">💸</div>
                                <div class="summary-content">
                                    <h4>You Save</h4>
                                    <p id="resultSavings">$0.00</p>
                                    <span>Total savings</span>
                                </div>
                            </div>
                        </div>

                        <div class="detailed-breakdown">
                            <h4>Price Breakdown</h4>
                            <div class="breakdown-grid">
                                <div class="breakdown-item">
                                    <span class="breakdown-label">Original Price</span>
                                    <span class="breakdown-value" id="breakdownOriginal">$0.00</span>
                                </div>
                                <div class="breakdown-item discount">
                                    <span class="breakdown-label">Discount Applied</span>
                                    <span class="breakdown-value" id="breakdownDiscount">-$0.00</span>
                                </div>
                                <div class="breakdown-item">
                                    <span class="breakdown-label">Subtotal</span>
                                    <span class="breakdown-value" id="breakdownSubtotal">$0.00</span>
                                </div>
                                <div class="breakdown-item tax">
                                    <span class="breakdown-label">Sales Tax</span>
                                    <span class="breakdown-value" id="breakdownTax">$0.00</span>
                                </div>
                                <div class="breakdown-item total">
                                    <span class="breakdown-label">Total Amount</span>
                                    <span class="breakdown-value" id="breakdownTotal">$0.00</span>
                                </div>
                            </div>
                        </div>

                        <div class="savings-comparison">
                            <h4>Savings Comparison</h4>
                            <div class="comparison-chart">
                                <div class="comparison-item">
                                    <span>Original Price</span>
                                    <div class="comparison-bar">
                                        <div class="bar-fill original" id="originalBar" style="width: 100%"></div>
                                    </div>
                                    <span id="comparisonOriginal">$0.00</span>
                                </div>
                                <div class="comparison-item">
                                    <span>You Pay</span>
                                    <div class="comparison-bar">
                                        <div class="bar-fill final" id="finalBar" style="width: 0%"></div>
                                    </div>
                                    <span id="comparisonFinal">$0.00</span>
                                </div>
                                <div class="comparison-item">
                                    <span>You Save</span>
                                    <div class="comparison-bar">
                                        <div class="bar-fill savings" id="savingsBar" style="width: 0%"></div>
                                    </div>
                                    <span id="comparisonSavings">$0.00</span>
                                </div>
                            </div>
                        </div>

                        <div class="multiple-items-results" id="multipleResults" style="display: none;">
                            <h4>Multiple Items Calculation</h4>
                            <div class="multiple-grid">
                                <div class="multiple-card">
                                    <h5>Per Item</h5>
                                    <div class="multiple-price" id="perItemPrice">$0.00</div>
                                    <span>Individual price</span>
                                </div>
                                <div class="multiple-card">
                                    <h5>Total Quantity</h5>
                                    <div class="multiple-quantity" id="totalQuantity">0</div>
                                    <span>Items purchased</span>
                                </div>
                                <div class="multiple-card">
                                    <h5>Total Savings</h5>
                                    <div class="multiple-savings" id="totalSavings">$0.00</div>
                                    <span>Overall discount</span>
                                </div>
                            </div>
                        </div>

                        <div class="discount-suggestions">
                            <h4>Popular Discount Scenarios</h4>
                            <div class="suggestions-grid">
                                <div class="suggestion-card">
                                    <h5>10% Off</h5>
                                    <p class="suggestion-price" id="suggestion10">$0.00</p>
                                    <p class="suggestion-save">Save $0.00</p>
                                </div>
                                <div class="suggestion-card">
                                    <h5>25% Off</h5>
                                    <p class="suggestion-price" id="suggestion25">$0.00</p>
                                    <p class="suggestion-save">Save $0.00</p>
                                </div>
                                <div class="suggestion-card">
                                    <h5>50% Off</h5>
                                    <p class="suggestion-price" id="suggestion50">$0.00</p>
                                    <p class="suggestion-save">Save $0.00</p>
                                </div>
                                <div class="suggestion-card">
                                    <h5>75% Off</h5>
                                    <p class="suggestion-price" id="suggestion75">$0.00</p>
                                    <p class="suggestion-save">Save $0.00</p>
                                </div>
                            </div>
                        </div>

                        <div class="action-buttons">
                            <button class="action-btn" id="newCalculationBtn">New Calculation</button>
                            <button class="action-btn secondary" id="shareResultsBtn">Share Results</button>
                            <button class="action-btn secondary" id="printResultsBtn">Print Results</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="features" class="features-section">
            <div class="container">
                <h2>Why Use Our Discount Calculator?</h2>
                <div class="features-grid">
                    <div class="feature-card">
                        <div class="feature-icon">⚡</div>
                        <h3>Instant Calculations</h3>
                        <p>Get immediate results for any discount scenario with real-time updates</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">🎯</div>
                        <h3>Multiple Modes</h3>
                        <p>Calculate percentage discounts, fixed amounts, or work backwards from sale prices</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">💸</div>
                        <h3>Maximize Savings</h3>
                        <p>Compare different discount scenarios to find the best deals and save money</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">📱</div>
                        <h3>Mobile Friendly</h3>
                        <p>Use it anywhere - perfect for in-store shopping and online deals</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="examples" class="examples-section">
            <div class="container">
                <h2>Common Discount Scenarios</h2>
                <div class="examples-grid">
                    <div class="example-card">
                        <h3>Retail Shopping</h3>
                        <div class="example-calculation">
                            <div class="example-item">
                                <span>Original: $80.00</span>
                                <span>Discount: 25%</span>
                                <span class="example-result">You pay: $60.00</span>
                            </div>
                        </div>
                        <p>Perfect for clothing, electronics, and department store sales</p>
                    </div>
                    <div class="example-card">
                        <h3>Restaurant Deals</h3>
                        <div class="example-calculation">
                            <div class="example-item">
                                <span>Bill: $120.00</span>
                                <span>Coupon: $30 off</span>
                                <span class="example-result">You pay: $90.00</span>
                            </div>
                        </div>
                        <p>Calculate fixed amount discounts and coupon savings</p>
                    </div>
                    <div class="example-card">
                        <h3>Clearance Sales</h3>
                        <div class="example-calculation">
                            <div class="example-item">
                                <span>Price: $200.00</span>
                                <span>Sale: $150.00</span>
                                <span class="example-result">Save: 25%</span>
                            </div>
                        </div>
                        <p>Find the actual discount percentage from sale prices</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="tips" class="tips-section">
            <div class="container">
                <h2>Smart Shopping Tips</h2>
                <div class="tips-grid">
                    <div class="tip-card">
                        <h3>🛍️ Stack Discounts</h3>
                        <p>Combine percentage discounts with fixed amount coupons for maximum savings</p>
                    </div>
                    <div class="tip-card">
                        <h3>📅 Seasonal Sales</h3>
                        <p>Shop during holiday seasons and clearance events for the best discounts</p>
                    </div>
                    <div class="tip-card">
                        <h3>🔔 Price Alerts</h3>
                        <p>Set up notifications for price drops on items you're interested in</p>
                    </div>
                    <div class="tip-card">
                        <h3>💳 Cashback & Rewards</h3>
                        <p>Use credit card rewards and cashback apps for additional savings</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>Discount Calculator</h3>
                    <p>Your trusted tool for smart shopping and money-saving calculations</p>
                </div>
                <div class="footer-section">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="#calculator">Calculator</a></li>
                        <li><a href="#features">Features</a></li>
                        <li><a href="#examples">Examples</a></li>
                        <li><a href="#tips">Shopping Tips</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>Tools</h4>
                    <ul>
                        <li><a href="#">Percentage Calculator</a></li>
                        <li><a href="#">Tax Calculator</a></li>
                        <li><a href="#">Tip Calculator</a></li>
                        <li><a href="#">Currency Converter</a></li>
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
            </div>
            <div class="footer-bottom">
                <p>&copy; 2024 Discount Calculator. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>