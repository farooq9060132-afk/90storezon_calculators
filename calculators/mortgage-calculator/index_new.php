<?php
// Available countries with their details for mortgage calculator
$countries = [
    'usa' => [
        'name' => 'USA',
        'currency' => '$',
        'flag' => 'https://flagcdn.com/w80/us.png',
        'mortgage_types' => ['30-Year Fixed', '15-Year Fixed', 'FHA Loan', 'VA Loan', 'USDA Loan']
    ],
    'uk' => [
        'name' => 'United Kingdom',
        'currency' => '£',
        'flag' => 'https://flagcdn.com/w80/gb.png',
        'mortgage_types' => ['Fixed Rate (2 years)', 'Fixed Rate (5 years)', 'Tracker Mortgage', 'Help to Buy', 'Buy to Let']
    ],
    'canada' => [
        'name' => 'Canada',
        'currency' => 'C$',
        'flag' => 'https://flagcdn.com/w80/ca.png',
        'mortgage_types' => ['Fixed Rate', 'Variable Rate', 'Adjustable Rate', 'HELOC', 'Insured Mortgage']
    ],
    'australia' => [
        'name' => 'Australia',
        'currency' => 'A$',
        'flag' => 'https://flagcdn.com/w80/au.png',
        'mortgage_types' => ['Fixed Rate', 'Variable Rate', 'Split Loan', 'Line of Credit', 'Interest Only']
    ],
    'india' => [
        'name' => 'India',
        'currency' => '₹',
        'flag' => 'https://flagcdn.com/w80/in.png',
        'mortgage_types' => ['Fixed Rate', 'Floating Rate', 'Hybrid Loan', 'NRI Loan', 'Plot Loan']
    ],
    'uae' => [
        'name' => 'UAE',
        'currency' => 'AED',
        'flag' => 'https://flagcdn.com/w80/ae.png',
        'mortgage_types' => ['Fixed Rate', 'Variable Rate', 'Islamic Financing', 'Off-Plan', 'Refinance']
    ],
    'pakistan' => [
        'name' => 'Pakistan',
        'currency' => 'PKR',
        'flag' => 'https://flagcdn.com/w80/pk.png',
        'mortgage_types' => ['Conventional', 'Islamic Financing', 'Plot Financing', 'Construction Loan', 'Refinance']
    ],
    'saudi_arabia' => [
        'name' => 'Saudi Arabia',
        'currency' => 'SAR',
        'flag' => 'https://flagcdn.com/w80/sa.png',
        'mortgage_types' => ['Fixed Rate', 'Variable Rate', 'Islamic Financing', 'Construction', 'Refinance']
    ],
    'singapore' => [
        'name' => 'Singapore',
        'currency' => 'S$',
        'flag' => 'https://flagcdn.com/w80/sg.png',
        'mortgage_types' => ['Fixed Rate', 'Variable Rate', 'Hybrid Loan', 'HDB Loan', 'Refinance']
    ],
    'south_africa' => [
        'name' => 'South Africa',
        'currency' => 'R',
        'flag' => 'https://flagcdn.com/w80/za.png',
        'mortgage_types' => ['Fixed Rate', 'Variable Rate', 'Access Bond', 'Switch Loan', 'Refinance']
    ],
    'malaysia' => [
        'name' => 'Malaysia',
        'currency' => 'RM',
        'flag' => 'https://flagcdn.com/w80/my.png',
        'mortgage_types' => ['Fixed Rate', 'Variable Rate', 'Islamic Financing', 'Flexi Loan', 'Refinance']
    ]
];
?>
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
            background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
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
            border-color: #3498db;
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
            color: #3498db;
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
            background: #3498db;
            color: white;
            padding: 15px 30px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            margin-top: 20px;
            transition: all 0.3s ease;
        }
        
        .cta-button:hover {
            background: #2980b9;
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
    <?php include '../../header.php'; ?>
    
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-content">
            <h1 class="hero-title">International Mortgage Calculator</h1>
            <p class="hero-subtitle">Calculate your mortgage payments for different countries with accurate currency conversion</p>
            <a href="#countries" class="cta-button">Explore Countries</a>
        </div>
    </section>

    <!-- Countries Section -->
    <section id="countries">
        <div class="countries-grid">
            <?php foreach($countries as $country_code => $country_data): ?>
                <a href="<?php echo $country_code; ?>.php" class="country-card">
                    <div class="country-header">
                        <img src="<?php echo $country_data['flag']; ?>" alt="<?php echo $country_data['name']; ?> Flag" class="country-flag">
                        <div>
                            <div class="country-name"><?php echo $country_data['name']; ?></div>
                            <div class="country-currency">Currency: <?php echo $country_data['currency']; ?></div>
                        </div>
                    </div>
                    <div class="loan-types">
                        <?php foreach($country_data['mortgage_types'] as $mortgage_type): ?>
                            <span class="loan-type"><?php echo $mortgage_type; ?></span>
                        <?php endforeach; ?>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section">
        <h2 style="font-size: 2.5rem; font-weight: 700; color: #333; margin-bottom: 20px;">Why Choose Our Mortgage Calculator?</h2>
        <p style="font-size: 1.2rem; color: #666; max-width: 600px; margin: 0 auto;">Accurate calculations tailored for each country's mortgage system</p>
        
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

    <!-- All Calculators Backlinks -->
    <div class="info-section" style="background: #f8f9fa; padding: 60px 20px; text-align: center;">
        <h2 style="font-size: 2.5rem; font-weight: 700; color: #333; margin-bottom: 20px;">Explore Our Other Calculators</h2>
        <p style="font-size: 1.2rem; color: #666; max-width: 600px; margin: 0 auto 40px;">Check out our collection of 50+ free online calculators</p>
        
        <div class="calculator-links" style="max-width: 1200px; margin: 0 auto; text-align: center;">
            <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 15px; margin-bottom: 20px;">
                <a href="/calculators/01-loan-emi-calculator/" style="background: #3498db; color: white; padding: 12px 20px; border-radius: 30px; text-decoration: none; font-weight: 500; transition: all 0.3s ease;">Loan EMI Calculator</a>
                <a href="/calculators/02-bmi-calculator/" style="background: #2ecc71; color: white; padding: 12px 20px; border-radius: 30px; text-decoration: none; font-weight: 500; transition: all 0.3s ease;">BMI Calculator</a>
                <a href="/calculators/03-currency-converter/" style="background: #9b59b6; color: white; padding: 12px 20px; border-radius: 30px; text-decoration: none; font-weight: 500; transition: all 0.3s ease;">Currency Converter</a>
                <a href="/calculators/05-compound-interest-calculator/" style="background: #e67e22; color: white; padding: 12px 20px; border-radius: 30px; text-decoration: none; font-weight: 500; transition: all 0.3s ease;">Compound Interest</a>
            </div>
            <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 15px; margin-bottom: 20px;">
                <a href="/calculators/06-calorie-calculator/" style="background: #1abc9c; color: white; padding: 12px 20px; border-radius: 30px; text-decoration: none; font-weight: 500; transition: all 0.3s ease;">Calorie Calculator</a>
                <a href="/calculators/07-qr-code-generator/" style="background: #34495e; color: white; padding: 12px 20px; border-radius: 30px; text-decoration: none; font-weight: 500; transition: all 0.3s ease;">QR Code Generator</a>
                <a href="/calculators/08-password-generator/" style="background: #f39c12; color: white; padding: 12px 20px; border-radius: 30px; text-decoration: none; font-weight: 500; transition: all 0.3s ease;">Password Generator</a>
                <a href="/calculators/09-tax-calculator/" style="background: #e74c3c; color: white; padding: 12px 20px; border-radius: 30px; text-decoration: none; font-weight: 500; transition: all 0.3s ease;">Tax Calculator</a>
            </div>
            <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 15px;">
                <a href="/calculators/" style="background: #8e44ad; color: white; padding: 12px 20px; border-radius: 30px; text-decoration: none; font-weight: 500; transition: all 0.3s ease;">View All Calculators</a>
            </div>
        </div>
    </div>

    <?php include '../../footer.php'; ?>
</body>
</html>