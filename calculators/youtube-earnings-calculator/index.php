<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Free YouTube Earnings Calculator | Estimate Your YouTube Revenue</title>
    <meta name="description" content="Free YouTube earnings calculator. Estimate your potential YouTube revenue based on views, RPM, niche, and engagement. Calculate CPM, monthly, and yearly earnings.">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <header class="header">
            <h1><i class="fab fa-youtube"></i> YouTube Earnings Calculator</h1>
            <p>Calculate your potential YouTube revenue and estimate earnings from your channel</p>
        </header>

        <main class="calculator-card">
            <form id="youtubeCalculatorForm" method="POST" action="calculator.php">
                <!-- Basic Metrics Section -->
                <div class="section-card">
                    <div class="section-header">
                        <i class="fas fa-chart-line"></i>
                        <h3>Channel Metrics</h3>
                    </div>
                    <div class="input-grid">
                        <div class="input-group">
                            <label for="monthly_views"><i class="fas fa-eye"></i> Monthly Views</label>
                            <input type="number" id="monthly_views" name="monthly_views" min="1000" value="10000" step="1000">
                            <small>Total views per month</small>
                        </div>
                        <div class="input-group">
                            <label for="subscribers"><i class="fas fa-users"></i> Subscribers</label>
                            <input type="number" id="subscribers" name="subscribers" min="100" value="1000" step="100">
                            <small>Total channel subscribers</small>
                        </div>
                        <div class="input-group">
                            <label for="video_count"><i class="fas fa-video"></i> Video Count</label>
                            <input type="number" id="video_count" name="video_count" min="1" value="10" step="1">
                            <small>Number of videos on channel</small>
                        </div>
                        <div class="input-group">
                            <label for="avg_duration"><i class="fas fa-clock"></i> Avg Video Duration (minutes)</label>
                            <input type="number" id="avg_duration" name="avg_duration" min="1" max="60" value="10" step="1">
                            <small>Average length of your videos</small>
                        </div>
                    </div>
                </div>

                <!-- Monetization Section -->
                <div class="section-card">
                    <div class="section-header">
                        <i class="fas fa-money-bill-wave"></i>
                        <h3>Monetization Settings</h3>
                    </div>
                    <div class="input-grid">
                        <div class="input-group">
                            <label for="rpm"><i class="fas fa-dollar-sign"></i> RPM Rate ($)</label>
                            <input type="number" id="rpm" name="rpm" min="0.1" max="50" value="2.5" step="0.1">
                            <small>Revenue Per Mille (per 1000 views)</small>
                            <div class="range-labels">
                                <span>Low ($0.5)</span>
                                <span>High ($10+)</span>
                            </div>
                        </div>
                        <div class="input-group">
                            <label for="cpm"><i class="fas fa-ad"></i> Estimated CPM ($)</label>
                            <input type="number" id="cpm" name="cpm" min="0.1" max="50" value="5.0" step="0.1">
                            <small>Cost Per Mille (advertisers pay per 1000 views)</small>
                        </div>
                        <div class="input-group">
                            <label for="monetized_views"><i class="fas fa-percentage"></i> Monetized Views (%)</label>
                            <input type="range" id="monetized_views" name="monetized_views" min="10" max="100" value="70">
                            <div class="range-value">
                                <span id="monetizedValue">70%</span>
                                of views are monetized
                            </div>
                        </div>
                        <div class="input-group">
                            <label for="ads_per_video"><i class="fas fa-adjust"></i> Ads Per Video</label>
                            <input type="range" id="ads_per_video" name="ads_per_video" min="1" max="10" value="3">
                            <div class="range-value">
                                <span id="adsValue">3</span>
                                ads per video on average
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Channel Niche Section -->
                <div class="section-card">
                    <div class="section-header">
                        <i class="fas fa-tags"></i>
                        <h3>Channel Niche & Performance</h3>
                    </div>
                    <div class="input-grid">
                        <div class="input-group">
                            <label for="niche"><i class="fas fa-filter"></i> Channel Niche</label>
                            <select id="niche" name="niche">
                                <option value="gaming">Gaming</option>
                                <option value="tech">Tech Reviews</option>
                                <option value="vlog">Vlogging</option>
                                <option value="education">Education</option>
                                <option value="entertainment" selected>Entertainment</option>
                                <option value="finance">Finance/Business</option>
                                <option value="lifestyle">Lifestyle</option>
                                <option value="music">Music</option>
                                <option value="sports">Sports</option>
                                <option value="howto">How-to/Tutorials</option>
                            </select>
                            <small>Your channel's primary category</small>
                        </div>
                        <div class="input-group">
                            <label for="audience_region"><i class="fas fa-globe"></i> Audience Region</label>
                            <select id="audience_region" name="audience_region">
                                <option value="us_canada" selected>US & Canada</option>
                                <option value="europe">Europe</option>
                                <option value="uk">United Kingdom</option>
                                <option value="australia">Australia/NZ</option>
                                <option value="asia">Asia</option>
                                <option value="latin_america">Latin America</option>
                                <option value="other">Other Regions</option>
                            </select>
                            <small>Primary audience location</small>
                        </div>
                        <div class="input-group">
                            <label for="engagement_rate"><i class="fas fa-heart"></i> Engagement Rate (%)</label>
                            <input type="range" id="engagement_rate" name="engagement_rate" min="1" max="20" value="8">
                            <div class="range-value">
                                <span id="engagementValue">8%</span>
                                likes, comments, shares
                            </div>
                        </div>
                        <div class="input-group">
                            <label for="watch_time"><i class="fas fa-hourglass-half"></i> Average Watch Time (%)</label>
                            <input type="range" id="watch_time" name="watch_time" min="10" max="90" value="45">
                            <div class="range-value">
                                <span id="watchTimeValue">45%</span>
                                of video watched on average
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Additional Revenue Streams -->
                <div class="section-card">
                    <div class="section-header">
                        <i class="fas fa-stream"></i>
                        <h3>Additional Revenue Streams</h3>
                    </div>
                    <div class="input-grid">
                        <div class="input-group">
                            <label for="channel_memberships">
                                <input type="checkbox" id="channel_memberships" name="channel_memberships">
                                <i class="fas fa-crown"></i> Channel Memberships
                            </label>
                            <small>Monthly members paying for perks</small>
                        </div>
                        <div class="input-group">
                            <label for="super_chat">
                                <input type="checkbox" id="super_chat" name="super_chat">
                                <i class="fas fa-comment-dollar"></i> Super Chat & Super Stickers
                            </label>
                            <small>Live stream donations</small>
                        </div>
                        <div class="input-group">
                            <label for="merch_shelf">
                                <input type="checkbox" id="merch_shelf" name="merch_shelf">
                                <i class="fas fa-tshirt"></i> Merchandise Shelf
                            </label>
                            <small>Sell merchandise directly on YouTube</small>
                        </div>
                        <div class="input-group">
                            <label for="sponsorships">
                                <input type="checkbox" id="sponsorships" name="sponsorships">
                                <i class="fas fa-handshake"></i> Brand Sponsorships
                            </label>
                            <small>Paid brand deals and partnerships</small>
                        </div>
                    </div>
                </div>

                <button type="submit" class="calculate-btn">
                    <i class="fas fa-calculator"></i> Calculate YouTube Earnings
                </button>
            </form>

            <div id="results" class="results-section" style="display: none;">
                <!-- Results will be displayed here -->
            </div>
        </main>

        <section class="info-section">
            <h2>Understanding YouTube Earnings</h2>
            <div class="info-grid">
                <div class="info-card">
                    <i class="fas fa-ad"></i>
                    <h3>How YouTube Pays</h3>
                    <p>YouTube shares 55% of ad revenue with creators. Earnings depend on CPM, RPM, view count, and audience demographics.</p>
                </div>
                <div class="info-card">
                    <i class="fas fa-chart-bar"></i>
                    <h3>RPM vs CPM</h3>
                    <p>RPM (Revenue Per Mille) is what you earn per 1000 views. CPM (Cost Per Mille) is what advertisers pay per 1000 impressions.</p>
                </div>
                <div class="info-card">
                    <i class="fas fa-users"></i>
                    <h3>Multiple Revenue Streams</h3>
                    <p>Successful creators combine ad revenue with memberships, sponsorships, merchandise, and Super Chat for higher earnings.</p>
                </div>
            </div>
        </section>

        <section class="examples-section">
            <h2>YouTube Earnings Examples</h2>
            <div class="examples-grid">
                <div class="example-card" data-example="small">
                    <h4>Small Channel</h4>
                    <div class="example-stats">
                        <div>10K views/month</div>
                        <div>1K subscribers</div>
                        <div>$2.5 RPM</div>
                    </div>
                    <div class="example-earning">~$25/month</div>
                </div>
                <div class="example-card" data-example="medium">
                    <h4>Medium Channel</h4>
                    <div class="example-stats">
                        <div>100K views/month</div>
                        <div>10K subscribers</div>
                        <div>$3 RPM</div>
                    </div>
                    <div class="example-earning">~$300/month</div>
                </div>
                <div class="example-card" data-example="large">
                    <h4>Large Channel</h4>
                    <div class="example-stats">
                        <div>1M views/month</div>
                        <div>100K subscribers</div>
                        <div>$4 RPM</div>
                    </div>
                    <div class="example-earning">~$4,000/month</div>
                </div>
                <div class="example-card" data-example="professional">
                    <h4>Professional Channel</h4>
                    <div class="example-stats">
                        <div>5M views/month</div>
                        <div>500K subscribers</div>
                        <div>$6 RPM</div>
                    </div>
                    <div class="example-earning">~$30,000/month</div>
                </div>
            </div>
        </section>
    </div>

    <script src="script.js"></script>
</body>
</html>