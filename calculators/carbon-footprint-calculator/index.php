<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Free Carbon Footprint Calculator | Calculate Your Environmental Impact</title>
    <meta name="description" content="Free online carbon footprint calculator. Calculate your CO2 emissions from transportation, energy, diet, and lifestyle. Get personalized tips to reduce your environmental impact.">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <header class="header">
            <h1><i class="fas fa-leaf"></i> Carbon Footprint Calculator</h1>
            <p>Calculate your environmental impact and discover ways to reduce your carbon emissions</p>
        </header>

        <main class="calculator-card">
            <form id="carbonCalculatorForm" method="POST" action="calculator.php">
                <!-- Transportation Section -->
                <div class="section-card">
                    <div class="section-header">
                        <i class="fas fa-car"></i>
                        <h3>Transportation</h3>
                    </div>
                    <div class="input-grid">
                        <div class="input-group">
                            <label for="car_mileage"><i class="fas fa-road"></i> Car Mileage (miles/week)</label>
                            <input type="number" id="car_mileage" name="car_mileage" min="0" value="100" step="10">
                            <small>Average miles driven per week</small>
                        </div>
                        <div class="input-group">
                            <label for="car_type"><i class="fas fa-gas-pump"></i> Car Type</label>
                            <select id="car_type" name="car_type">
                                <option value="gasoline">Gasoline Car</option>
                                <option value="hybrid">Hybrid Car</option>
                                <option value="electric">Electric Car</option>
                                <option value="diesel">Diesel Car</option>
                            </select>
                        </div>
                        <div class="input-group">
                            <label for="public_transport"><i class="fas fa-bus"></i> Public Transport (miles/week)</label>
                            <input type="number" id="public_transport" name="public_transport" min="0" value="20" step="5">
                            <small>Bus, train, subway miles</small>
                        </div>
                        <div class="input-group">
                            <label for="flights"><i class="fas fa-plane"></i> Flights (hours/year)</label>
                            <input type="number" id="flights" name="flights" min="0" value="5" step="1">
                            <small>Total flight hours per year</small>
                        </div>
                    </div>
                </div>

                <!-- Home Energy Section -->
                <div class="section-card">
                    <div class="section-header">
                        <i class="fas fa-home"></i>
                        <h3>Home Energy</h3>
                    </div>
                    <div class="input-grid">
                        <div class="input-group">
                            <label for="electricity"><i class="fas fa-bolt"></i> Electricity (kWh/month)</label>
                            <input type="number" id="electricity" name="electricity" min="0" value="300" step="50">
                            <small>Average monthly consumption</small>
                        </div>
                        <div class="input-group">
                            <label for="natural_gas"><i class="fas fa-fire"></i> Natural Gas (therms/month)</label>
                            <input type="number" id="natural_gas" name="natural_gas" min="0" value="50" step="10">
                            <small>Heating and cooking</small>
                        </div>
                        <div class="input-group">
                            <label for="heating_oil"><i class="fas fa-oil-can"></i> Heating Oil (gallons/month)</label>
                            <input type="number" id="heating_oil" name="heating_oil" min="0" value="0" step="10">
                        </div>
                        <div class="input-group">
                            <label for="renewable_energy"><i class="fas fa-solar-panel"></i> Renewable Energy (%)</label>
                            <input type="range" id="renewable_energy" name="renewable_energy" min="0" max="100" value="20">
                            <div class="range-value">
                                <span id="renewableValue">20%</span>
                                of energy from renewable sources
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Diet & Lifestyle Section -->
                <div class="section-card">
                    <div class="section-header">
                        <i class="fas fa-utensils"></i>
                        <h3>Diet & Lifestyle</h3>
                    </div>
                    <div class="input-grid">
                        <div class="input-group">
                            <label for="diet_type"><i class="fas fa-apple-alt"></i> Diet Type</label>
                            <select id="diet_type" name="diet_type">
                                <option value="meat_heavy">Meat Heavy</option>
                                <option value="average" selected>Average</option>
                                <option value="vegetarian">Vegetarian</option>
                                <option value="vegan">Vegan</option>
                            </select>
                        </div>
                        <div class="input-group">
                            <label for="food_waste"><i class="fas fa-trash"></i> Food Waste</label>
                            <select id="food_waste" name="food_waste">
                                <option value="high">High</option>
                                <option value="average" selected>Average</option>
                                <option value="low">Low</option>
                                <option value="zero">Minimal</option>
                            </select>
                        </div>
                        <div class="input-group">
                            <label for="shopping_habits"><i class="fas fa-shopping-bag"></i> Shopping Habits</label>
                            <select id="shopping_habits" name="shopping_habits">
                                <option value="frequent">Frequent New Items</option>
                                <option value="average" selected>Average</option>
                                <option value="minimal">Minimal/Sustainable</option>
                            </select>
                        </div>
                        <div class="input-group">
                            <label for="recycling"><i class="fas fa-recycle"></i> Recycling Level</label>
                            <select id="recycling" name="recycling">
                                <option value="none">None</option>
                                <option value="basic" selected>Basic</option>
                                <option value="comprehensive">Comprehensive</option>
                                <option value="zero_waste">Zero Waste</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Household Section -->
                <div class="section-card">
                    <div class="section-header">
                        <i class="fas fa-users"></i>
                        <h3>Household Information</h3>
                    </div>
                    <div class="input-grid">
                        <div class="input-group">
                            <label for="household_size"><i class="fas fa-user-friends"></i> Household Size</label>
                            <input type="number" id="household_size" name="household_size" min="1" max="20" value="3" step="1">
                        </div>
                        <div class="input-group">
                            <label for="house_size"><i class="fas fa-building"></i> Home Size (sq ft)</label>
                            <input type="number" id="house_size" name="house_size" min="100" max="10000" value="2000" step="100">
                        </div>
                        <div class="input-group">
                            <label for="location"><i class="fas fa-globe-americas"></i> Location</label>
                            <select id="location" name="location">
                                <option value="urban">Urban Area</option>
                                <option value="suburban" selected>Suburban Area</option>
                                <option value="rural">Rural Area</option>
                            </select>
                        </div>
                    </div>
                </div>

                <button type="submit" class="calculate-btn">
                    <i class="fas fa-calculator"></i> Calculate My Carbon Footprint
                </button>
            </form>

            <div id="results" class="results-section" style="display: none;">
                <!-- Results will be displayed here -->
            </div>
        </main>

        <section class="info-section">
            <h2>Understanding Carbon Footprint</h2>
            <div class="info-grid">
                <div class="info-card">
                    <i class="fas fa-industry"></i>
                    <h3>What is Carbon Footprint?</h3>
                    <p>The total amount of greenhouse gases emitted directly or indirectly by human activities, measured in carbon dioxide equivalent (CO2e).</p>
                </div>
                <div class="info-card">
                    <i class="fas fa-chart-line"></i>
                    <h3>Global Average</h3>
                    <p>The average global carbon footprint is about 4 tons per person per year. The target to combat climate change is 2 tons.</p>
                </div>
                <div class="info-card">
                    <i class="fas fa-tree"></i>
                    <h3>Reduction Tips</h3>
                    <p>Use public transport, switch to renewable energy, reduce meat consumption, and improve home insulation to lower your footprint.</p>
                </div>
            </div>
        </section>
    </div>

    <script src="script.js"></script>
</body>
</html>