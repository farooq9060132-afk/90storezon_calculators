document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('carbonCalculatorForm');
    const resultsSection = document.getElementById('results');
    const calculateBtn = form.querySelector('.calculate-btn');
    const renewableEnergySlider = document.getElementById('renewable_energy');
    const renewableValue = document.getElementById('renewableValue');

    // Update renewable energy value display
    renewableEnergySlider.addEventListener('input', function() {
        renewableValue.textContent = this.value + '%';
    });

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        calculateCarbonFootprint();
    });

    function calculateCarbonFootprint() {
        const formData = new FormData(form);
        const calculateText = calculateBtn.innerHTML;
        
        // Show loading state
        calculateBtn.innerHTML = '<div class="loading"></div> Calculating...';
        calculateBtn.disabled = true;

        fetch('calculator.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                alert(data.error);
                return;
            }
            displayResults(data.results);
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while calculating. Please try again.');
        })
        .finally(() => {
            calculateBtn.innerHTML = calculateText;
            calculateBtn.disabled = false;
        });
    }

    function displayResults(results) {
        const resultsHTML = `
            <div class="result-header">
                <h2><i class="fas fa-chart-pie"></i> Your Carbon Footprint Results</h2>
                <p>Annual CO2 Emissions: <strong>${results.per_capita.toLocaleString()} kg CO2e</strong> per person</p>
            </div>

            <div class="footprint-level ${results.footprint_level}">
                <h3>${results.level_message}</h3>
                <p>${results.level_description}</p>
            </div>

            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-value">${results.total_emissions.toLocaleString()}</div>
                    <div class="stat-label">Total Household Emissions</div>
                    <small>kg CO2e per year</small>
                </div>
                <div class="stat-card">
                    <div class="stat-value">${results.per_capita.toLocaleString()}</div>
                    <div class="stat-label">Per Person Emissions</div>
                    <small>kg CO2e per year</small>
                </div>
                <div class="stat-card">
                    <div class="stat-value">${results.comparison.vs_global}%</div>
                    <div class="stat-label">Of Global Average</div>
                    <small>Global avg: ${results.comparison.global_average.toLocaleString()} kg</small>
                </div>
                <div class="stat-card">
                    <div class="stat-value">${results.comparison.vs_target}%</div>
                    <div class="stat-label">Of Climate Target</div>
                    <small>Target: ${results.comparison.climate_target.toLocaleString()} kg</small>
                </div>
            </div>

            <div class="breakdown-section">
                <h3><i class="fas fa-chart-bar"></i> Emission Breakdown</h3>
                <div class="breakdown-grid">
                    <div class="breakdown-item">
                        <div class="breakdown-icon transport">
                            <i class="fas fa-car"></i>
                        </div>
                        <div class="breakdown-value">${results.breakdown.transportation.toLocaleString()} kg</div>
                        <div class="breakdown-label">Transportation</div>
                        <small>${Math.round(results.breakdown.transportation / results.total_emissions * 100)}% of total</small>
                    </div>
                    <div class="breakdown-item">
                        <div class="breakdown-icon energy">
                            <i class="fas fa-bolt"></i>
                        </div>
                        <div class="breakdown-value">${results.breakdown.energy.toLocaleString()} kg</div>
                        <div class="breakdown-label">Home Energy</div>
                        <small>${Math.round(results.breakdown.energy / results.total_emissions * 100)}% of total</small>
                    </div>
                    <div class="breakdown-item">
                        <div class="breakdown-icon lifestyle">
                            <i class="fas fa-utensils"></i>
                        </div>
                        <div class="breakdown-value">${results.breakdown.lifestyle.toLocaleString()} kg</div>
                        <div class="breakdown-label">Lifestyle</div>
                        <small>${Math.round(results.breakdown.lifestyle / results.total_emissions * 100)}% of total</small>
                    </div>
                    <div class="breakdown-item">
                        <div class="breakdown-icon household">
                            <i class="fas fa-home"></i>
                        </div>
                        <div class="breakdown-value">${results.breakdown.household.toLocaleString()} kg</div>
                        <div class="breakdown-label">Household</div>
                        <small>${Math.round(results.breakdown.household / results.total_emissions * 100)}% of total</small>
                    </div>
                </div>
            </div>

            <div class="comparison-section">
                <h3><i class="fas fa-balance-scale"></i> How You Compare</h3>
                <div class="comparison-bars">
                    <div class="comparison-item">
                        <div class="comparison-label">Your Footprint</div>
                        <div class="comparison-bar">
                            <div class="bar-fill yours" style="width: ${Math.min(results.comparison.vs_target, 100)}%"></div>
                        </div>
                        <div class="comparison-value">${results.per_capita.toLocaleString()} kg</div>
                    </div>
                    <div class="comparison-item">
                        <div class="comparison-label">US Average</div>
                        <div class="comparison-bar">
                            <div class="bar-fill us" style="width: ${Math.min(results.comparison.vs_us, 100)}%"></div>
                        </div>
                        <div class="comparison-value">${results.comparison.us_average.toLocaleString()} kg</div>
                    </div>
                    <div class="comparison-item">
                        <div class="comparison-label">Global Average</div>
                        <div class="comparison-bar">
                            <div class="bar-fill global" style="width: ${Math.min(results.comparison.vs_global, 100)}%"></div>
                        </div>
                        <div class="comparison-value">${results.comparison.global_average.toLocaleString()} kg</div>
                    </div>
                    <div class="comparison-item">
                        <div class="comparison-label">Climate Target</div>
                        <div class="comparison-bar">
                            <div class="bar-fill target" style="width: 100%"></div>
                        </div>
                        <div class="comparison-value">${results.comparison.climate_target.toLocaleString()} kg</div>
                    </div>
                </div>
            </div>

            <div class="recommendations-section">
                <h3><i class="fas fa-lightbulb"></i> Ways to Reduce Your Footprint</h3>
                <div class="recommendations-grid">
                    ${results.recommendations.map(rec => `
                        <div class="recommendation-card">
                            <div class="recommendation-header">
                                <div class="recommendation-icon">
                                    <i class="fas fa-${rec.icon}"></i>
                                </div>
                                <div>
                                    <div class="recommendation-category">${rec.category}</div>
                                    <div class="recommendation-title">${rec.title}</div>
                                </div>
                            </div>
                            <div class="recommendation-description">${rec.description}</div>
                            <div class="recommendation-impact">${rec.impact}</div>
                        </div>
                    `).join('')}
                </div>
            </div>

            <div style="text-align: center; margin-top: 2rem; padding: 1rem; background: #f0fdf4; border-radius: var(--radius); border: 1px solid #bbf7d0;">
                <h4><i class="fas fa-seedling"></i> Share Your Results</h4>
                <p>Help raise awareness about carbon footprints by sharing your results with friends and family.</p>
                <button class="util-btn" onclick="shareResults()" style="margin-top: 0.5rem;">
                    <i class="fas fa-share-alt"></i> Share Results
                </button>
            </div>
        `;

        resultsSection.innerHTML = resultsHTML;
        resultsSection.style.display = 'block';
        
        // Smooth scroll to results
        resultsSection.scrollIntoView({ behavior: 'smooth' });
    }

    // Share results function
    window.shareResults = function() {
        const resultsText = `My carbon footprint is ${document.querySelector('.stat-value').textContent} kg CO2e per year. Calculate yours at ${window.location.href}`;
        
        if (navigator.share) {
            navigator.share({
                title: 'My Carbon Footprint Results',
                text: resultsText,
                url: window.location.href
            });
        } else {
            // Fallback: copy to clipboard
            navigator.clipboard.writeText(resultsText).then(() => {
                alert('Results copied to clipboard!');
            });
        }
    };

    // Add some sample data tips
    const tips = [
        "The average American has a carbon footprint of 16,000 kg CO2e per year",
        "Switching to renewable energy can reduce your home emissions by up to 80%",
        "A vegetarian diet typically has half the carbon footprint of a meat-heavy diet",
        "Electric vehicles produce 50-70% fewer emissions than gasoline cars"
    ];

    // Random tip display
    const randomTip = tips[Math.floor(Math.random() * tips.length)];
    const tipElement = document.createElement('div');
    tipElement.className = 'eco-badge';
    tipElement.innerHTML = `<i class="fas fa-info-circle"></i> ${randomTip}`;
    document.querySelector('.header').appendChild(tipElement);
});