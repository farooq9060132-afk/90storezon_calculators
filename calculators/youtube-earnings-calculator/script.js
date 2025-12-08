document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('youtubeCalculatorForm');
    const resultsSection = document.getElementById('results');
    const calculateBtn = form.querySelector('.calculate-btn');
    const monetizedViewsSlider = document.getElementById('monetized_views');
    const monetizedValue = document.getElementById('monetizedValue');
    const adsPerVideoSlider = document.getElementById('ads_per_video');
    const adsValue = document.getElementById('adsValue');
    const engagementRateSlider = document.getElementById('engagement_rate');
    const engagementValue = document.getElementById('engagementValue');
    const watchTimeSlider = document.getElementById('watch_time');
    const watchTimeValue = document.getElementById('watchTimeValue');

    // Update slider value displays
    monetizedViewsSlider.addEventListener('input', function() {
        monetizedValue.textContent = this.value + '%';
    });

    adsPerVideoSlider.addEventListener('input', function() {
        adsValue.textContent = this.value;
    });

    engagementRateSlider.addEventListener('input', function() {
        engagementValue.textContent = this.value + '%';
    });

    watchTimeSlider.addEventListener('input', function() {
        watchTimeValue.textContent = this.value + '%';
    });

    // Auto-adjust RPM based on niche selection
    document.getElementById('niche').addEventListener('change', function() {
        const nicheRPM = {
            'gaming': 1.5,
            'tech': 3.5,
            'vlog': 2.5,
            'education': 3.0,
            'entertainment': 2.5,
            'finance': 8.0,
            'lifestyle': 2.8,
            'music': 2.0,
            'sports': 4.0,
            'howto': 3.2
        };
        
        const selectedNiche = this.value;
        document.getElementById('rpm').value = nicheRPM[selectedNiche] || 2.5;
    });

    // Auto-adjust RPM based on region selection
    document.getElementById('audience_region').addEventListener('change', function() {
        const regionMultipliers = {
            'us_canada': 1.0,
            'europe': 0.8,
            'uk': 0.9,
            'australia': 0.95,
            'asia': 0.4,
            'latin_america': 0.3,
            'other': 0.35
        };
        
        const baseRPM = 2.5;
        const selectedRegion = this.value;
        const adjustedRPM = baseRPM * (regionMultipliers[selectedRegion] || 1.0);
        document.getElementById('rpm').value = adjustedRPM.toFixed(1);
    });

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        calculateYouTubeEarnings();
    });

    function calculateYouTubeEarnings() {
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
                <h2><i class="fab fa-youtube"></i> Your YouTube Earnings Estimate</h2>
                <p>Based on your channel metrics and settings</p>
            </div>

            <div class="earnings-display">
                <div class="monthly-earnings">$${results.earnings.monthly.toLocaleString()}</div>
                <div class="yearly-earnings">$${results.earnings.yearly.toLocaleString()} per year</div>
                <small>Estimated monthly revenue after YouTube's 45% share</small>
            </div>

            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-value">$${results.earnings.adjusted_rpm}</div>
                    <div class="stat-label">Adjusted RPM</div>
                    <small>Revenue per 1000 views</small>
                </div>
                <div class="stat-card">
                    <div class="stat-value">${results.metrics.monetized_views_count.toLocaleString()}</div>
                    <div class="stat-label">Monetized Views</div>
                    <small>Per month</small>
                </div>
                <div class="stat-card">
                    <div class="stat-value">$${results.metrics.earnings_per_subscriber.toFixed(4)}</div>
                    <div class="stat-label">Per Subscriber</div>
                    <small>Monthly value</small>
                </div>
                <div class="stat-card">
                    <div class="stat-value">$${results.metrics.earnings_per_view.toFixed(4)}</div>
                    <div class="stat-label">Per View</div>
                    <small>Average earnings</small>
                </div>
            </div>

            <div class="revenue-breakdown">
                <h3><i class="fas fa-chart-pie"></i> Revenue Breakdown</h3>
                <div class="revenue-streams">
                    <div class="revenue-item">
                        <div class="revenue-icon">
                            <i class="fas fa-ad"></i>
                        </div>
                        <div class="revenue-details">
                            <div class="revenue-name">Ad Revenue</div>
                            <div class="revenue-amount">$${results.earnings.creator_earnings.toLocaleString()}</div>
                            <div class="revenue-percentage">${Math.round((results.earnings.creator_earnings / results.earnings.monthly) * 100)}% of total</div>
                        </div>
                    </div>
                    ${results.revenue_streams.map(stream => `
                        <div class="revenue-item">
                            <div class="revenue-icon">
                                <i class="fas fa-${getRevenueStreamIcon(stream.name)}"></i>
                            </div>
                            <div class="revenue-details">
                                <div class="revenue-name">${stream.name}</div>
                                <div class="revenue-amount">$${stream.earnings.toLocaleString()}</div>
                                <div class="revenue-percentage">${Math.round(stream.percentage)}% of total</div>
                            </div>
                        </div>
                    `).join('')}
                </div>
                <div style="margin-top: 1rem; padding: 1rem; background: var(--bg-secondary); border-radius: var(--radius);">
                    <strong>Note:</strong> YouTube keeps 45% of ad revenue ($${results.earnings.youtube_cut.toLocaleString()}/month)
                </div>
            </div>

            <div class="growth-insights">
                <div class="insight-level">${results.growth_potential.level.toUpperCase()}</div>
                <h3><i class="fas fa-rocket"></i> Growth Insights</h3>
                <p>${results.growth_potential.message}</p>
                <div style="margin-top: 1rem;">
                    <strong>Next Milestone:</strong> ${results.growth_potential.next_milestone}<br>
                    <strong>Estimated Time:</strong> ${results.growth_potential.estimated_time}<br>
                    <strong>Potential Earnings:</strong> $${results.growth_potential.potential_earnings.toLocaleString()}/month at next level
                </div>
            </div>

            <div class="factors-grid">
                <div class="factor-item">
                    <div class="factor-value">${results.factors.niche_multiplier.toFixed(2)}x</div>
                    <div class="factor-label">Niche Factor</div>
                </div>
                <div class="factor-item">
                    <div class="factor-value">${results.factors.region_multiplier.toFixed(2)}x</div>
                    <div class="factor-label">Region Factor</div>
                </div>
                <div class="factor-item">
                    <div class="factor-value">${results.factors.engagement_bonus.toFixed(2)}x</div>
                    <div class="factor-label">Engagement Bonus</div>
                </div>
                <div class="factor-item">
                    <div class="factor-value">${results.factors.watch_time_bonus.toFixed(2)}x</div>
                    <div class="factor-label">Watch Time Bonus</div>
                </div>
            </div>

            <div style="text-align: center; margin-top: 2rem; padding: 1.5rem; background: #fff3cd; border-radius: var(--radius); border: 1px solid #ffeaa7;">
                <h4><i class="fas fa-lightbulb"></i> Pro Tips to Increase Earnings</h4>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1rem; margin-top: 1rem;">
                    <div style="text-align: left;">
                        <strong>📈 Improve RPM:</strong> Focus on high-value niches like finance, business, or technology
                    </div>
                    <div style="text-align: left;">
                        <strong>🎯 Target Premium Regions:</strong> US, UK, and Canadian audiences generate higher RPM
                    </div>
                    <div style="text-align: left;">
                        <strong>💬 Boost Engagement:</strong> Higher likes, comments, and shares improve your ad rates
                    </div>
                    <div style="text-align: left;">
                        <strong>⏱️ Increase Watch Time:</strong> Create engaging content that keeps viewers watching longer
                    </div>
                </div>
            </div>
        `;

        resultsSection.innerHTML = resultsHTML;
        resultsSection.style.display = 'block';
        
        // Smooth scroll to results
        resultsSection.scrollIntoView({ behavior: 'smooth' });
    }

    function getRevenueStreamIcon(streamName) {
        const icons = {
            'Channel Memberships': 'crown',
            'Super Chat & Stickers': 'comment-dollar',
            'Merchandise': 'tshirt',
            'Brand Sponsorships': 'handshake'
        };
        return icons[streamName] || 'dollar-sign';
    }

    // Example card functionality
    document.querySelectorAll('.example-card').forEach(card => {
        card.addEventListener('click', function() {
            const exampleType = this.dataset.example;
            const examples = {
                'small': {
                    monthly_views: 10000,
                    subscribers: 1000,
                    video_count: 10,
                    rpm: 2.5
                },
                'medium': {
                    monthly_views: 100000,
                    subscribers: 10000,
                    video_count: 50,
                    rpm: 3.0
                },
                'large': {
                    monthly_views: 1000000,
                    subscribers: 100000,
                    video_count: 200,
                    rpm: 4.0
                },
                'professional': {
                    monthly_views: 5000000,
                    subscribers: 500000,
                    video_count: 500,
                    rpm: 6.0
                }
            };

            const example = examples[exampleType];
            if (example) {
                document.getElementById('monthly_views').value = example.monthly_views;
                document.getElementById('subscribers').value = example.subscribers;
                document.getElementById('video_count').value = example.video_count;
                document.getElementById('rpm').value = example.rpm;
                
                // Auto-calculate
                calculateYouTubeEarnings();
            }
        });
    });

    // Add YouTube-specific tips
    const youtubeTips = [
        "RPM varies greatly by niche: Finance channels can earn $10+ RPM while gaming channels average $1-3 RPM",
        "US and Canadian audiences typically generate 3-5x higher RPM than audiences from other regions",
        "YouTube keeps 45% of ad revenue - you get 55% of what advertisers pay",
        "Longer videos with higher watch time percentages typically earn more per view"
    ];

    // Random tip display
    const randomTip = youtubeTips[Math.floor(Math.random() * youtubeTips.length)];
    const tipElement = document.createElement('div');
    tipElement.className = 'youtube-badge';
    tipElement.innerHTML = `<i class="fas fa-info-circle"></i> ${randomTip}`;
    document.querySelector('.header').appendChild(tipElement);
});