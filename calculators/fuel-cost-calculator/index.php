<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Free Fuel Cost Calculator | Calculate Gas & Trip Expenses</title>
    <meta name="description" content="Free fuel cost calculator to calculate gas expenses, trip costs, and fuel efficiency. Plan your journey and save money on fuel costs">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="vip-header">
        <div class="container">
            <div class="logo-section">
                <h1>Fuel Cost Calculator</h1>
                <div class="vip-badge">FUEL SAVER</div>
            </div>
            <nav class="main-nav">
                <ul>
                    <li><a href="#calculator">Calculator</a></li>
                    <li><a href="#features">Features</a></li>
                    <li><a href="#tips">Fuel Tips</a></li>
                    <li><a href="#resources">Resources</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <section class="hero-section">
            <div class="container">
                <div class="hero-content">
                    <h2>Calculate Your Fuel Costs & Save Money</h2>
                    <p>Plan your trips, optimize fuel efficiency, and manage your vehicle expenses with our comprehensive fuel calculator</p>
                    <div class="hero-stats">
                        <div class="stat">
                            <div class="stat-number">$1.2M+</div>
                            <div class="stat-label">Fuel Costs Calculated</div>
                        </div>
                        <div class="stat">
                            <div class="stat-number">45K+</div>
                            <div class="stat-label">Trips Planned</div>
                        </div>
                        <div class="stat">
                            <div class="stat-number">27%</div>
                            <div class="stat-label">Average Savings</div>
                        </div>
                    </div>
                    <a href="#calculator" class="cta-button">Calculate Fuel Costs</a>
                </div>
                <div class="hero-image">
                    <div class="fuel-visual">
                        <div class="car-animation">
                            <div class="car">🚗</div>
                            <div class="road">
                                <div class="road-line"></div>
                            </div>
                        </div>
                        <div class="fuel-gauge">
                            <div class="gauge">
                                <div class="gauge-fill" style="height: 65%"></div>
                                <div class="gauge-text">65%</div>
                            </div>
                            <div class="gauge-label">Fuel Level</div>
                        </div>
                        <div class="price-display">
                            <div class="price-item">
                                <span>Fuel Price</span>
                                <span>$3.45/gal</span>
                            </div>
                            <div class="price-item">
                                <span>Trip Cost</span>
                                <span>$42.50</span>
                            </div>
                            <div class="price-item">
                                <span>MPG</span>
                                <span>28.5</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="calculator" class="calculator-section">
            <div class="container">
                <h2>Fuel Cost Calculator</h2>
                <p class="section-subtitle">Calculate trip expenses, fuel efficiency, and optimize your travel budget</p>
                
                <div class="calculator-card">
                    <form id="fuelCalculator" action="calculator.php" method="POST">
                        <div class="calculation-modes">
                            <div class="mode-buttons">
                                <button type="button" class="mode-btn active" data-mode="trip">Trip Calculation</button>
                                <button type="button" class="mode-btn" data-mode="monthly">Monthly Cost</button>
                                <button type="button" class="mode-btn" data-mode="efficiency">Fuel Efficiency</button>
                            </div>
                        </div>

                        <div class="form-section" id="tripFields">
                            <h4>Trip Information</h4>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="tripDistance">Trip Distance (miles):</label>
                                    <input type="number" id="tripDistance" name="tripDistance" min="1" max="10000" placeholder="250" required>
                                    <div class="input-hint">One-way or round trip distance</div>
                                </div>
                                <div class="form-group">
                                    <label for="tripType">Trip Type:</label>
                                    <select id="tripType" name="tripType" required>
                                        <option value="one-way">One Way</option>
                                        <option value="round-trip" selected>Round Trip</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-section" id="monthlyFields" style="display: none;">
                            <h4>Monthly Driving</h4>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="monthlyMiles">Monthly Miles:</label>
                                    <input type="number" id="monthlyMiles" name="monthlyMiles" min="1" max="50000" placeholder="1200">
                                </div>
                                <div class="form-group">
                                    <label for="workDays">Work Days/Week:</label>
                                    <input type="number" id="workDays" name="workDays" min="1" max="7" value="5">
                                </div>
                            </div>
                        </div>

                        <div class="form-section" id="efficiencyFields" style="display: none;">
                            <h4>Efficiency Analysis</h4>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="fuelUsed">Fuel Used (gallons):</label>
                                    <input type="number" id="fuelUsed" name="fuelUsed" min="0.1" step="0.1" placeholder="15.5">
                                </div>
                                <div class="form-group">
                                    <label for="distanceDriven">Distance Driven (miles):</label>
                                    <input type="number" id="distanceDriven" name="distanceDriven" min="1" placeholder="350">
                                </div>
                            </div>
                        </div>

                        <div class="form-section">
                            <h4>Vehicle & Fuel Information</h4>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="fuelEfficiency">Fuel Efficiency (MPG):</label>
                                    <input type="number" id="fuelEfficiency" name="fuelEfficiency" min="1" max="200" step="0.1" placeholder="25.5" required>
                                    <div class="input-hint">Miles per gallon - check your vehicle specs</div>
                                </div>
                                <div class="form-group">
                                    <label for="fuelPrice">Fuel Price ($/gallon):</label>
                                    <input type="number" id="fuelPrice" name="fuelPrice" min="0.1" max="20" step="0.01" placeholder="3.45" required>
                                    <div class="input-hint">Current price per gallon</div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="fuelType">Fuel Type:</label>
                                    <select id="fuelType" name="fuelType" required>
                                        <option value="regular">Regular Unleaded</option>
                                        <option value="midgrade">Mid-Grade</option>
                                        <option value="premium">Premium</option>
                                        <option value="diesel">Diesel</option>
                                        <option value="electric">Electric</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="vehicleType">Vehicle Type:</label>
                                    <select id="vehicleType" name="vehicleType" required>
                                        <option value="sedan">Sedan</option>
                                        <option value="suv">SUV</option>
                                        <option value="truck">Truck</option>
                                        <option value="van">Van</option>
                                        <option value="hybrid">Hybrid</option>
                                        <option value="electric">Electric Vehicle</option>
                                        <option value="motorcycle">Motorcycle</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="advanced-options">
                            <h4>Additional Options</h4>
                            <div class="options-grid">
                                <div class="option-item">
                                    <input type="checkbox" id="includeTolls" name="includeTolls">
                                    <label for="includeTolls">Include toll costs</label>
                                </div>
                                <div class="option-item">
                                    <input type="checkbox" id="includeMaintenance" name="includeMaintenance">
                                    <label for="includeMaintenance">Include maintenance cost</label>
                                </div>
                                <div class="option-item">
                                    <input type="checkbox" id="multipleVehicles" name="multipleVehicles">
                                    <label for="multipleVehicles">Compare multiple vehicles</label>
                                </div>
                            </div>
                        </div>

                        <div class="additional-costs" id="tollSection" style="display: none;">
                            <div class="form-group">
                                <label for="tollCost">Estimated Toll Costs ($):</label>
                                <input type="number" id="tollCost" name="tollCost" min="0" step="0.01" placeholder="0.00">
                            </div>
                        </div>

                        <div class="additional-costs" id="maintenanceSection" style="display: none;">
                            <div class="form-group">
                                <label for="maintenanceCost">Maintenance Cost per Mile ($):</label>
                                <input type="number" id="maintenanceCost" name="maintenanceCost" min="0" step="0.001" placeholder="0.10" value="0.10">
                                <div class="input-hint">Average maintenance cost per mile</div>
                            </div>
                        </div>

                        <div class="vehicle-comparison" id="comparisonSection" style="display: none;">
                            <h4>Vehicle Comparison</h4>
                            <div class="comparison-grid">
                                <div class="comparison-vehicle">
                                    <h5>Vehicle 2</h5>
                                    <div class="form-group">
                                        <label>MPG:</label>
                                        <input type="number" name="vehicle2Mpg" min="1" max="200" step="0.1" placeholder="30.0">
                                    </div>
                                    <div class="form-group">
                                        <label>Fuel Type:</label>
                                        <select name="vehicle2FuelType">
                                            <option value="regular">Regular</option>
                                            <option value="premium">Premium</option>
                                            <option value="diesel">Diesel</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="comparison-vehicle">
                                    <h5>Vehicle 3</h5>
                                    <div class="form-group">
                                        <label>MPG:</label>
                                        <input type="number" name="vehicle3Mpg" min="1" max="200" step="0.1" placeholder="35.0">
                                    </div>
                                    <div class="form-group">
                                        <label>Fuel Type:</label>
                                        <select name="vehicle3FuelType">
                                            <option value="regular">Regular</option>
                                            <option value="hybrid">Hybrid</option>
                                            <option value="electric">Electric</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="calculate-btn">
                            <span class="btn-text">Calculate Fuel Cost</span>
                            <span class="btn-loading" style="display: none;">Calculating...</span>
                        </button>
                    </form>

                    <div id="results" class="results-section" style="display: none;">
                        <h3>Fuel Cost Analysis</h3>
                        
                        <div class="results-summary">
                            <div class="summary-card">
                                <div class="summary-icon">⛽</div>
                                <div class="summary-content">
                                    <h4>Fuel Cost</h4>
                                    <p id="resultFuelCost">$0.00</p>
                                    <span id="resultFuelUsed">0 gal</span>
                                </div>
                            </div>
                            <div class="summary-card">
                                <div class="summary-icon">📊</div>
                                <div class="summary-content">
                                    <h4>Fuel Efficiency</h4>
                                    <p id="resultMpg">0 MPG</p>
                                    <span>Miles per gallon</span>
                                </div>
                            </div>
                            <div class="summary-card">
                                <div class="summary-icon">💰</div>
                                <div class="summary-content">
                                    <h4>Cost per Mile</h4>
                                    <p id="resultCostPerMile">$0.00</p>
                                    <span>Operating cost</span>
                                </div>
                            </div>
                            <div class="summary-card">
                                <div class="summary-icon">🌍</div>
                                <div class="summary-content">
                                    <h4>CO2 Emissions</h4>
                                    <p id="resultCo2">0 lbs</p>
                                    <span>Carbon footprint</span>
                                </div>
                            </div>
                        </div>

                        <div class="detailed-breakdown">
                            <h4>Trip Cost Breakdown</h4>
                            <div class="breakdown-grid">
                                <div class="breakdown-item">
                                    <span class="breakdown-label">Total Distance</span>
                                    <span class="breakdown-value" id="breakdownDistance">0 miles</span>
                                </div>
                                <div class="breakdown-item">
                                    <span class="breakdown-label">Fuel Required</span>
                                    <span class="breakdown-value" id="breakdownFuelRequired">0 gallons</span>
                                </div>
                                <div class="breakdown-item">
                                    <span class="breakdown-label">Fuel Cost</span>
                                    <span class="breakdown-value" id="breakdownFuelCost">$0.00</span>
                                </div>
                                <div class="breakdown-item" id="breakdownTollsItem" style="display: none;">
                                    <span class="breakdown-label">Toll Costs</span>
                                    <span class="breakdown-value" id="breakdownTolls">$0.00</span>
                                </div>
                                <div class="breakdown-item" id="breakdownMaintenanceItem" style="display: none;">
                                    <span class="breakdown-label">Maintenance</span>
                                    <span class="breakdown-value" id="breakdownMaintenance">$0.00</span>
                                </div>
                                <div class="breakdown-item total">
                                    <span class="breakdown-label">Total Cost</span>
                                    <span class="breakdown-value" id="breakdownTotal">$0.00</span>
                                </div>
                            </div>
                        </div>

                        <div class="efficiency-analysis">
                            <h4>Efficiency Analysis</h4>
                            <div class="efficiency-grid">
                                <div class="efficiency-card">
                                    <h5>Fuel Consumption</h5>
                                    <div class="efficiency-value" id="efficiencyConsumption">0 L/100km</div>
                                    <span>Liters per 100km</span>
                                </div>
                                <div class="efficiency-card">
                                    <h5>Annual Cost</h5>
                                    <div class="efficiency-value" id="efficiencyAnnual">$0.00</div>
                                    <span>Based on 15,000 miles</span>
                                </div>
                                <div class="efficiency-card">
                                    <h5>Fuel Savings</h5>
                                    <div class="efficiency-value" id="efficiencySavings">$0.00</div>
                                    <span>vs. average vehicle</span>
                                </div>
                            </div>
                        </div>

                        <div class="vehicle-comparison-results" id="comparisonResults" style="display: none;">
                            <h4>Vehicle Comparison</h4>
                            <div class="comparison-table">
                                <div class="table-header">
                                    <span>Vehicle</span>
                                    <span>MPG</span>
                                    <span>Fuel Cost</span>
                                    <span>Annual Savings</span>
                                </div>
                                <div class="table-row" id="comparisonRow1">
                                    <span>Your Vehicle</span>
                                    <span id="compMpg1">0</span>
                                    <span id="compCost1">$0.00</span>
                                    <span id="compSavings1">-</span>
                                </div>
                                <div class="table-row" id="comparisonRow2">
                                    <span>Vehicle 2</span>
                                    <span id="compMpg2">0</span>
                                    <span id="compCost2">$0.00</span>
                                    <span id="compSavings2">$0.00</span>
                                </div>
                                <div class="table-row" id="comparisonRow3">
                                    <span>Vehicle 3</span>
                                    <span id="compMpg3">0</span>
                                    <span id="compCost3">$0.00</span>
                                    <span id="compSavings3">$0.00</span>
                                </div>
                            </div>
                        </div>

                        <div class="environmental-impact">
                            <h4>Environmental Impact</h4>
                            <div class="impact-grid">
                                <div class="impact-card">
                                    <h5>Carbon Footprint</h5>
                                    <div class="impact-value" id="impactCo2">0 lbs CO₂</div>
                                    <div class="impact-bar">
                                        <div class="bar-fill co2-fill" style="width: 0%"></div>
                                    </div>
                                </div>
                                <div class="impact-card">
                                    <h5>Equivalent Trees</h5>
                                    <div class="impact-value" id="impactTrees">0 trees</div>
                                    <span>Needed to offset</span>
                                </div>
                                <div class="impact-card">
                                    <h5>Eco Score</h5>
                                    <div class="impact-value" id="impactScore">0/100</div>
                                    <div class="impact-bar">
                                        <div class="bar-fill eco-fill" style="width: 0%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="fuel-suggestions">
                            <h4>Fuel Saving Tips</h4>
                            <div class="suggestions-list" id="suggestionsList">
                                <!-- Tips will be populated here -->
                            </div>
                        </div>

                        <div class="action-buttons">
                            <button class="action-btn" id="newCalculationBtn">New Calculation</button>
                            <button class="action-btn secondary" id="shareResultsBtn">Share Results</button>
                            <button class="action-btn secondary" id="saveResultsBtn">Save Results</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="features" class="features-section">
            <div class="container">
                <h2>Why Use Our Fuel Calculator?</h2>
                <div class="features-grid">
                    <div class="feature-card">
                        <div class="feature-icon">💰</div>
                        <h3>Cost Savings</h3>
                        <p>Identify opportunities to reduce fuel expenses and optimize your travel budget</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">🌱</div>
                        <h3>Eco-Friendly</h3>
                        <p>Calculate your carbon footprint and make environmentally conscious driving choices</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">📊</div>
                        <h3>Multiple Modes</h3>
                        <p>Trip planning, monthly budgeting, and fuel efficiency analysis in one tool</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">🚗</div>
                        <h3>Vehicle Comparison</h3>
                        <p>Compare different vehicles to find the most fuel-efficient option for your needs</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="tips" class="tips-section">
            <div class="container">
                <h2>Fuel Saving Tips</h2>
                <div class="tips-grid">
                    <div class="tip-card">
                        <h3>🚀 Smooth Acceleration</h3>
                        <p>Avoid rapid acceleration and hard braking to improve fuel efficiency by up to 30%</p>
                    </div>
                    <div class="tip-card">
                        <h3>🛣️ Maintain Speed</h3>
                        <p>Use cruise control on highways to maintain consistent speed and save fuel</p>
                    </div>
                    <div class="tip-card">
                        <h3>🚗 Proper Maintenance</h3>
                        <p>Regular maintenance can improve gas mileage by an average of 4%</p>
                    </div>
                    <div class="tip-card">
                        <h3>🧳 Reduce Weight</h3>
                        <p>Remove unnecessary items from your vehicle - every 100 lbs reduces MPG by 1%</p>
                    </div>
                    <div class="tip-card">
                        <h3>🌀 Tire Pressure</h3>
                        <p>Keep tires properly inflated to improve gas mileage by up to 3%</p>
                    </div>
                    <div class="tip-card">
                        <h3>⛽ Smart Refueling</h3>
                        <p>Fill up your tank in the morning when fuel is densest for better value</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="resources" class="resources-section">
            <div class="container">
                <h2>Fuel Resources & Tools</h2>
                <div class="resources-grid">
                    <div class="resource-card">
                        <h3>Fuel Price Tracker</h3>
                        <p>Track real-time fuel prices in your area and find the best deals</p>
                        <a href="#" class="resource-link">View Prices →</a>
                    </div>
                    <div class="resource-card">
                        <h3>Route Planner</h3>
                        <p>Plan the most fuel-efficient routes for your journeys</p>
                        <a href="#" class="resource-link">Plan Route →</a>
                    </div>
                    <div class="resource-card">
                        <h3>Vehicle MPG Database</h3>
                        <p>Compare fuel efficiency ratings for different vehicle models</p>
                        <a href="#" class="resource-link">Browse Database →</a>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>Fuel Cost Calculator</h3>
                    <p>Your trusted partner for fuel cost management and trip planning</p>
                </div>
                <div class="footer-section">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="#calculator">Calculator</a></li>
                        <li><a href="#features">Features</a></li>
                        <li><a href="#tips">Fuel Tips</a></li>
                        <li><a href="#resources">Resources</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>Tools</h4>
                    <ul>
                        <li><a href="#">Trip Planner</a></li>
                        <li><a href="#">MPG Calculator</a></li>
                        <li><a href="#">Carbon Calculator</a></li>
                        <li><a href="#">Fuel Log</a></li>
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
                <p>&copy; 2024 Fuel Cost Calculator. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>