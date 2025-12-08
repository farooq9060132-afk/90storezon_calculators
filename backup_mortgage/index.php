<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>International Mortgage Calculator</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        .hero-section {
            background: linear-gradient(135deg, #2563eb 0%, #764ba2 100%);
            color: white;
            padding: 80px 20px;
            text-align: center;
        }
        
        .hero-title {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 20px;
            font-family: 'Poppins', sans-serif;
        }
        
        .hero-subtitle {
            font-size: 1.3rem;
            font-weight: 300;
            margin-bottom: 40px;
            opacity: 0.9;
        }
        
        .countries-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 25px;
            padding: 60px 20px;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .country-card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            border: 2px solid transparent;
            text-decoration: none;
            color: inherit;
            display: block;
        }
        
        .country-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
            border-color: #2563eb;
        }
        
        .country-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .country-flag {
            width: 60px;
            height: 40px;
            border-radius: 8px;
            margin-right: 15px;
            object-fit: cover;
        }
        
        .country-name {
            font-size: 1.5rem;
            font-weight: 600;
            color: #333;
        }
        
        .country-currency {
            font-size: 1.1rem;
            color: #2563eb;
            font-weight: 500;
        }
        
        .loan-types {
            margin-top: 15px;
        }
        
        .loan-type {
            display: inline-block;
            background: #f8f9fa;
            padding: 6px 12px;
            margin: 4px;
            border-radius: 20px;
            font-size: 0.85rem;
            color: #555;
        }
        
        .cta-button {
            display: inline-block;
            background: #2563eb;
            color: white;
            padding: 15px 30px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            margin-top: 20px;
            transition: all 0.3s ease;
        }
        
        .cta-button:hover {
            background: #1d4ed8;
            transform: scale(1.05);
        }
        
        .features-section {
            background: #f8f9fa;
            padding: 80px 20px;
            text-align: center;
        }
        
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            max-width: 1000px;
            margin: 50px auto 0;
        }
        
        .feature-card {
            background: white;
            padding: 40px 30px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }
        
        .feature-icon {
            font-size: 3rem;
            margin-bottom: 20px;
        }
        
        .feature-title {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 15px;
            color: #333;
        }
        
        .feature-description {
            color: #666;
            line-height: 1.6;
        }
        
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
            
            .countries-grid {
                grid-template-columns: 1fr;
                padding: 40px 20px;
            }
        }
    </style>
</head>
<body>
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-content">
            <h1 class="hero-title">International Mortgage Calculator</h1>
            <p class="hero-subtitle">Calculate your home loan payments for different countries with accurate currency conversion</p>
            <a href="#countries" class="cta-button">Explore Countries</a>
        </div>
    </section>

    <!-- Countries Section -->
    <section id="countries">
        <div class="countries-grid">
            <a href="usa.php" class="country-card">
                <div class="country-header">
                    <img src="https://flagcdn.com/w80/us.png" alt="USA Flag" class="country-flag">
                    <div>
                        <div class="country-name">United States</div>
                        <div class="country-currency">Currency: $</div>
                    </div>
                </div>
                <div class="loan-types">
                    <span class="loan-type">30-Year Fixed</span>
                    <span class="loan-type">15-Year Fixed</span>
                    <span class="loan-type">FHA Loan</span>
                    <span class="loan-type">VA Loan</span>
                </div>
            </a>
            
            <a href="uk.php" class="country-card">
                <div class="country-header">
                    <img src="https://flagcdn.com/w80/gb.png" alt="UK Flag" class="country-flag">
                    <div>
                        <div class="country-name">United Kingdom</div>
                        <div class="country-currency">Currency: £</div>
                    </div>
                </div>
                <div class="loan-types">
                    <span class="loan-type">Fixed Rate</span>
                    <span class="loan-type">Tracker Mortgage</span>
                    <span class="loan-type">Help to Buy</span>
                    <span class="loan-type">Buy to Let</span>
                </div>
            </a>
            
            <a href="australia.php" class="country-card">
                <div class="country-header">
                    <img src="https://flagcdn.com/w80/au.png" alt="Australia Flag" class="country-flag">
                    <div>
                        <div class="country-name">Australia</div>
                        <div class="country-currency">Currency: A$</div>
                    </div>
                </div>
                <div class="loan-types">
                    <span class="loan-type">Standard Variable</span>
                    <span class="loan-type">Fixed Rate</span>
                    <span class="loan-type">Interest Only</span>
                    <span class="loan-type">Line of Credit</span>
                </div>
            </a>
            
            <a href="canada.php" class="country-card">
                <div class="country-header">
                    <img src="https://flagcdn.com/w80/ca.png" alt="Canada Flag" class="country-flag">
                    <div>
                        <div class="country-name">Canada</div>
                        <div class="country-currency">Currency: C$</div>
                    </div>
                </div>
                <div class="loan-types">
                    <span class="loan-type">Fixed Rate</span>
                    <span class="loan-type">Variable Rate</span>
                    <span class="loan-type">HELOC</span>
                    <span class="loan-type">CMHC Insured</span>
                </div>
            </a>
            
            <a href="uae.php" class="country-card">
                <div class="country-header">
                    <img src="https://flagcdn.com/w80/ae.png" alt="UAE Flag" class="country-flag">
                    <div>
                        <div class="country-name">UAE</div>
                        <div class="country-currency">Currency: AED</div>
                    </div>
                </div>
                <div class="loan-types">
                    <span class="loan-type">Fixed Rate</span>
                    <span class="loan-type">Variable Rate</span>
                    <span class="loan-type">Islamic Finance</span>
                    <span class="loan-type">Developer Finance</span>
                </div>
            </a>
            
            <a href="saudi_arabia.php" class="country-card">
                <div class="country-header">
                    <img src="https://flagcdn.com/w80/sa.png" alt="Saudi Arabia Flag" class="country-flag">
                    <div>
                        <div class="country-name">Saudi Arabia</div>
                        <div class="country-currency">Currency: SAR</div>
                    </div>
                </div>
                <div class="loan-types">
                    <span class="loan-type">Fixed Rate</span>
                    <span class="loan-type">Murabaha</span>
                    <span class="loan-type">Ijara</span>
                    <span class="loan-type">Musharaka</span>
                </div>
            </a>
            
            <a href="singapore.php" class="country-card">
                <div class="country-header">
                    <img src="https://flagcdn.com/w80/sg.png" alt="Singapore Flag" class="country-flag">
                    <div>
                        <div class="country-name">Singapore</div>
                        <div class="country-currency">Currency: S$</div>
                    </div>
                </div>
                <div class="loan-types">
                    <span class="loan-type">Fixed Rate</span>
                    <span class="loan-type">Floating Rate</span>
                    <span class="loan-type">HDB Loan</span>
                    <span class="loan-type">Bank Loan</span>
                </div>
            </a>
            
            <a href="india.php" class="country-card">
                <div class="country-header">
                    <img src="https://flagcdn.com/w80/in.png" alt="India Flag" class="country-flag">
                    <div>
                        <div class="country-name">India</div>
                        <div class="country-currency">Currency: ₹</div>
                    </div>
                </div>
                <div class="loan-types">
                    <span class="loan-type">Fixed Rate</span>
                    <span class="loan-type">Floating Rate</span>
                    <span class="loan-type">Home Extension</span>
                    <span class="loan-type">Plot Loan</span>
                </div>
            </a>
            
            <a href="pakistan.php" class="country-card">
                <div class="country-header">
                    <img src="https://flagcdn.com/w80/pk.png" alt="Pakistan Flag" class="country-flag">
                    <div>
                        <div class="country-name">Pakistan</div>
                        <div class="country-currency">Currency: Rs</div>
                    </div>
                </div>
                <div class="loan-types">
                    <span class="loan-type">Fixed Rate</span>
                    <span class="loan-type">Variable Rate</span>
                    <span class="loan-type">Home Construction</span>
                    <span class="loan-type">Plot Purchase</span>
                </div>
            </a>
            
            <a href="south_africa.php" class="country-card">
                <div class="country-header">
                    <img src="https://flagcdn.com/w80/za.png" alt="South Africa Flag" class="country-flag">
                    <div>
                        <div class="country-name">South Africa</div>
                        <div class="country-currency">Currency: R</div>
                    </div>
                </div>
                <div class="loan-types">
                    <span class="loan-type">Fixed Rate</span>
                    <span class="loan-type">Variable Rate</span>
                    <span class="loan-type">Access Bond</span>
                    <span class="loan-type">Switch Loan</span>
                </div>
            </a>
            
            <a href="malaysia.php" class="country-card">
                <div class="country-header">
                    <img src="https://flagcdn.com/w80/my.png" alt="Malaysia Flag" class="country-flag">
                    <div>
                        <div class="country-name">Malaysia</div>
                        <div class="country-currency">Currency: RM</div>
                    </div>
                </div>
                <div class="loan-types">
                    <span class="loan-type">Fixed Rate</span>
                    <span class="loan-type">Variable Rate</span>
                    <span class="loan-type">Islamic Finance</span>
                    <span class="loan-type">Overdraft</span>
                </div>
            </a>
            
            <a href="calculator.php" class="country-card">
                <div class="country-header">
                    <div>
                        <div class="country-name">🔢 Universal Calculator</div>
                        <div class="country-currency">General Purpose</div>
                    </div>
                </div>
                <div class="loan-types">
                    <span class="loan-type">Basic Calculator</span>
                    <span class="loan-type">Scientific Functions</span>
                    <span class="loan-type">History</span>
                    <span class="loan-type">Memory</span>
                </div>
            </a>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section">
        <h2 style="font-size: 2.5rem; font-weight: 700; color: #333; margin-bottom: 20px;">Why Choose Our Calculator?</h2>
        <p style="font-size: 1.2rem; color: #666; max-width: 600px; margin: 0 auto;">Accurate calculations tailored for each country's financial system</p>
        
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">🌍</div>
                <h3 class="feature-title">Multi-Country Support</h3>
                <p class="feature-description">Calculate mortgages for multiple countries with their specific currencies and regulations</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">📱</div>
                <h3 class="feature-title">Mobile Friendly</h3>
                <p class="feature-description">Fully responsive design that works perfectly on all devices and screen sizes</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">⚡</div>
                <h3 class="feature-title">Fast & Accurate</h3>
                <p class="feature-description">Instant calculations with precise results based on current financial standards</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">🎯</div>
                <h3 class="feature-title">Country Specific</h3>
                <p class="feature-description">Tailored calculations for each country's mortgage types and interest rates</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer style="background: #333; color: white; text-align: center; padding: 40px 20px;">
        <p style="margin: 0; font-size: 1rem;">&copy; 2024 International Mortgage Calculator. All rights reserved.</p>
    </footer>

    <script src="script.js"></script>
</body>
</html>