<?php
session_start();
require_once 'includes/db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found | 90storezon</title>
    <meta name="description" content="The page you're looking for doesn't exist. Find calculators for finance, health, math, and more on 90storezon.">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/theme-blue.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <?php include 'header.php'; ?>
    
    <main class="error-page">
        <div class="error-container">
            <!-- Error Illustration (CSS Only) -->
            <div class="error-illustration">
                <div class="error-number">
                    <span class="digit">4</span>
                    <div class="zero">
                        <div class="inner-circle"></div>
                    </div>
                    <span class="digit">4</span>
                </div>
                <div class="error-icon">
                    <i class="fas fa-search"></i>
                </div>
            </div>
            
            <!-- Error Message -->
            <div class="error-content">
                <h1 class="error-title">Oops! Page Not Found</h1>
                <p class="error-message">
                    The page you're looking for might have been removed, had its name changed, 
                    or is temporarily unavailable. Don't worry though, we have plenty of 
                    calculators for you to explore!
                </p>
                
                <!-- Search Box -->
                <div class="error-search">
                    <h3>Find Calculators</h3>
                    <div class="search-wrapper">
                        <input type="text" id="error-search" placeholder="Search for calculators (e.g., BMI, Loan, Tax)">
                        <button type="button" id="error-search-btn">
                            <i class="fas fa-search"></i> Search
                        </button>
                    </div>
                    <div class="search-results" id="error-search-results"></div>
                </div>
                
                <!-- Action Buttons -->
                <div class="error-actions">
                    <a href="index.php" class="btn-primary">
                        <i class="fas fa-home"></i> Back to Homepage
                    </a>
                    <a href="javascript:history.back()" class="btn-secondary">
                        <i class="fas fa-arrow-left"></i> Go Back
                    </a>
                    <a href="pages/contact.php" class="btn-outline">
                        <i class="fas fa-envelope"></i> Contact Support
                    </a>
                </div>
                
                <!-- Popular Categories -->
                <div class="popular-categories">
                    <h3>Popular Calculator Categories</h3>
                    <div class="categories-grid">
                        <a href="calculators/financial-calculators.php" class="category-card">
                            <div class="category-icon">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <div class="category-info">
                                <h4>Financial</h4>
                                <p>Loan, Mortgage, Interest, Tax calculators</p>
                            </div>
                        </a>
                        
                        <a href="calculators/health-calculators.php" class="category-card">
                            <div class="category-icon">
                                <i class="fas fa-heartbeat"></i>
                            </div>
                            <div class="category-info">
                                <h4>Health & Fitness</h4>
                                <p>BMI, Calorie, Body Fat, BMR calculators</p>
                            </div>
                        </a>
                        
                        <a href="calculators/math-calculators.php" class="category-card">
                            <div class="category-icon">
                                <i class="fas fa-square-root-alt"></i>
                            </div>
                            <div class="category-info">
                                <h4>Mathematics</h4>
                                <p>Scientific, Percentage, Algebra, Geometry</p>
                            </div>
                        </a>
                        
                        <a href="calculators/conversion-calculators.php" class="category-card">
                            <div class="category-icon">
                                <i class="fas fa-exchange-alt"></i>
                            </div>
                            <div class="category-info">
                                <h4>Conversion Tools</h4>
                                <p>Unit, Currency, Temperature converters</p>
                            </div>
                        </a>
                    </div>
                </div>
                
                <!-- Quick Links -->
                <div class="quick-links">
                    <h3>Quick Navigation</h3>
                    <div class="links-grid">
                        <div class="link-column">
                            <h4>Most Used Calculators</h4>
                            <ul>
                                <li><a href="calculators/bmi-calculator/"><i class="fas fa-calculator"></i> BMI Calculator</a></li>
                                <li><a href="calculators/loan-calculator/"><i class="fas fa-calculator"></i> Loan Calculator</a></li>
                                <li><a href="calculators/percentage-calculator/"><i class="fas fa-calculator"></i> Percentage Calculator</a></li>
                                <li><a href="calculators/age-calculator/"><i class="fas fa-calculator"></i> Age Calculator</a></li>
                            </ul>
                        </div>
                        
                        <div class="link-column">
                            <h4>Website Pages</h4>
                            <ul>
                                <li><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
                                <li><a href="pages/about.php"><i class="fas fa-info-circle"></i> About Us</a></li>
                                <li><a href="pages/contact.php"><i class="fas fa-envelope"></i> Contact</a></li>
                                <li><a href="pages/privacy-policy.php"><i class="fas fa-shield-alt"></i> Privacy Policy</a></li>
                            </ul>
                        </div>
                        
                        <div class="link-column">
                            <h4>Helpful Resources</h4>
                            <ul>
                                <li><a href="sitemap.xml"><i class="fas fa-sitemap"></i> Sitemap</a></li>
                                <li><a href="pages/faq.php"><i class="fas fa-question-circle"></i> FAQ</a></li>
                                <li><a href="pages/terms.php"><i class="fas fa-file-contract"></i> Terms of Use</a></li>
                                <li><a href="pages/disclaimer.php"><i class="fas fa-exclamation-triangle"></i> Disclaimer</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <!-- Error Report -->
                <div class="error-report">
                    <p>
                        <i class="fas fa-exclamation-circle"></i>
                        If you believe this is an error, please 
                        <a href="pages/contact.php">contact our support team</a> 
                        and let us know what you were looking for.
                    </p>
                </div>
            </div>
        </div>
    </main>

    <?php include 'footer.php'; ?>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Search functionality
            const errorSearch = document.getElementById('error-search');
            const errorSearchBtn = document.getElementById('error-search-btn');
            const errorSearchResults = document.getElementById('error-search-results');
            
            const allCalculators = [
                {name: 'BMI Calculator', path: 'calculators/bmi-calculator/', category: 'Health'},
                {name: 'Loan Calculator', path: 'calculators/loan-calculator/', category: 'Financial'},
                {name: 'Mortgage Calculator', path: 'calculators/mortgage-calculator/', category: 'Financial'},
                {name: 'Percentage Calculator', path: 'calculators/percentage-calculator/', category: 'Math'},
                {name: 'Age Calculator', path: 'calculators/age-calculator/', category: 'Tools'},
                {name: 'Tax Calculator', path: 'calculators/tax-calculator/', category: 'Financial'},
                {name: 'Calorie Calculator', path: 'calculators/calorie-calculator/', category: 'Health'},
                {name: 'Scientific Calculator', path: 'calculators/scientific-calculator/', category: 'Math'},
                {name: 'Interest Calculator', path: 'calculators/interest-calculator/', category: 'Financial'},
                {name: 'Date Calculator', path: 'calculators/date-calculator/', category: 'Tools'},
                {name: 'Unit Converter', path: 'calculators/unit-converter/', category: 'Conversion'},
                {name: 'Currency Converter', path: 'calculators/currency-converter/', category: 'Conversion'}
            ];
            
            function performSearch(query) {
                query = query.toLowerCase().trim();
                
                if (query.length < 2) {
                    errorSearchResults.style.display = 'none';
                    return;
                }
                
                const results = allCalculators.filter(calc => 
                    calc.name.toLowerCase().includes(query) || 
                    calc.category.toLowerCase().includes(query)
                );
                
                if (results.length > 0) {
                    errorSearchResults.innerHTML = results.map(calc => `
                        <a href="${calc.path}" class="search-result-item">
                            <div class="result-icon">
                                <i class="fas fa-calculator"></i>
                            </div>
                            <div class="result-content">
                                <div class="result-title">${calc.name}</div>
                                <div class="result-category">${calc.category}</div>
                            </div>
                            <div class="result-arrow">
                                <i class="fas fa-chevron-right"></i>
                            </div>
                        </a>
                    `).join('');
                    errorSearchResults.style.display = 'block';
                } else {
                    errorSearchResults.innerHTML = `
                        <div class="no-results">
                            <i class="fas fa-search"></i>
                            <div>No calculators found. Try different keywords.</div>
                        </div>
                    `;
                    errorSearchResults.style.display = 'block';
                }
            }
            
            errorSearch.addEventListener('input', function() {
                performSearch(this.value);
            });
            
            errorSearchBtn.addEventListener('click', function() {
                performSearch(errorSearch.value);
            });
            
            errorSearch.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    performSearch(this.value);
                }
            });
            
            // Close search results when clicking outside
            document.addEventListener('click', function(event) {
                if (!event.target.closest('.search-wrapper') && 
                    !event.target.closest('.search-results')) {
                    errorSearchResults.style.display = 'none';
                }
            });
            
            // Animate 404 numbers
            const digits = document.querySelectorAll('.digit');
            digits.forEach((digit, index) => {
                setTimeout(() => {
                    digit.style.transform = 'translateY(0)';
                    digit.style.opacity = '1';
                }, index * 200);
            });
            
            // Animate search icon
            const searchIcon = document.querySelector('.error-icon i');
            setTimeout(() => {
                searchIcon.style.transform = 'rotate(360deg)';
            }, 1000);
        });
    </script>

    <style>
        /* Error Page Styles */
        .error-page {
            min-height: calc(100vh - 140px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
        }

        .error-container {
            max-width: 1000px;
            width: 100%;
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        /* Error Illustration */
        .error-illustration {
            background: linear-gradient(135deg, #1a73e8 0%, #0d47a1 100%);
            padding: 50px 0;
            text-align: center;
            position: relative;
        }

        .error-number {
            display: inline-flex;
            align-items: center;
            gap: 20px;
            position: relative;
        }

        .digit {
            font-size: 120px;
            font-weight: 900;
            color: white;
            text-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            opacity: 0;
            transform: translateY(-30px);
            transition: all 0.5s ease;
        }

        .zero {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: white;
            position: relative;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .inner-circle {
            position: absolute;
            top: 15px;
            left: 15px;
            right: 15px;
            bottom: 15px;
            border-radius: 50%;
            background: linear-gradient(135deg, #1a73e8 0%, #0d47a1 100%);
        }

        .error-icon {
            position: absolute;
            bottom: -25px;
            left: 50%;
            transform: translateX(-50%);
            background: #ff9800;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 30px rgba(255, 152, 0, 0.4);
        }

        .error-icon i {
            font-size: 28px;
            color: white;
            transition: transform 1s ease;
        }

        /* Error Content */
        .error-content {
            padding: 60px 40px 40px;
        }

        .error-title {
            text-align: center;
            color: #1a237e;
            font-size: 36px;
            margin-bottom: 20px;
            font-weight: 700;
        }

        .error-message {
            text-align: center;
            color: #666;
            font-size: 18px;
            line-height: 1.6;
            max-width: 700px;
            margin: 0 auto 40px;
        }

        /* Search Section */
        .error-search {
            max-width: 600px;
            margin: 0 auto 40px;
        }

        .error-search h3 {
            text-align: center;
            color: #1a73e8;
            margin-bottom: 20px;
            font-size: 22px;
        }

        .search-wrapper {
            display: flex;
            gap: 10px;
            margin-bottom: 10px;
        }

        #error-search {
            flex: 1;
            padding: 15px 20px;
            border: 2px solid #e0e0e0;
            border-radius: 50px;
            font-size: 16px;
            outline: none;
            transition: border-color 0.3s;
        }

        #error-search:focus {
            border-color: #1a73e8;
        }

        #error-search-btn {
            background: linear-gradient(135deg, #1a73e8 0%, #0d47a1 100%);
            color: white;
            border: none;
            padding: 0 30px;
            border-radius: 50px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.3s, box-shadow 0.3s;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        #error-search-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(26, 115, 232, 0.3);
        }

        .search-results {
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            display: none;
            max-height: 300px;
            overflow-y: auto;
            border: 1px solid #e0e0e0;
            z-index: 100;
            position: relative;
        }

        .search-result-item {
            display: flex;
            align-items: center;
            padding: 15px 20px;
            border-bottom: 1px solid #f0f0f0;
            text-decoration: none;
            color: #333;
            transition: background 0.3s;
        }

        .search-result-item:hover {
            background: #f8f9fa;
        }

        .result-icon {
            width: 40px;
            height: 40px;
            background: #e3f2fd;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
        }

        .result-icon i {
            color: #1a73e8;
        }

        .result-content {
            flex: 1;
        }

        .result-title {
            font-weight: 600;
            color: #1a237e;
            margin-bottom: 4px;
        }

        .result-category {
            font-size: 12px;
            color: #666;
            background: #f5f5f5;
            padding: 2px 8px;
            border-radius: 10px;
            display: inline-block;
        }

        .result-arrow i {
            color: #999;
        }

        .no-results {
            padding: 30px;
            text-align: center;
            color: #666;
        }

        .no-results i {
            font-size: 40px;
            color: #ddd;
            margin-bottom: 15px;
        }

        /* Action Buttons */
        .error-actions {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 40px;
            flex-wrap: wrap;
        }

        .btn-primary, .btn-secondary, .btn-outline {
            padding: 12px 30px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
        }

        .btn-primary {
            background: linear-gradient(135deg, #1a73e8 0%, #0d47a1 100%);
            color: white;
            border: none;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(26, 115, 232, 0.3);
        }

        .btn-secondary {
            background: #f5f5f5;
            color: #333;
            border: 2px solid #e0e0e0;
        }

        .btn-secondary:hover {
            background: #e0e0e0;
            transform: translateY(-2px);
        }

        .btn-outline {
            background: white;
            color: #1a73e8;
            border: 2px solid #1a73e8;
        }

        .btn-outline:hover {
            background: #1a73e8;
            color: white;
            transform: translateY(-2px);
        }

        /* Popular Categories */
        .popular-categories {
            margin-bottom: 40px;
        }

        .popular-categories h3 {
            text-align: center;
            color: #1a73e8;
            margin-bottom: 30px;
            font-size: 22px;
        }

        .categories-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .category-card {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 20px;
            text-decoration: none;
            color: #333;
            border: 2px solid transparent;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .category-card:hover {
            transform: translateY(-5px);
            border-color: #1a73e8;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .category-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #1a73e8 0%, #0d47a1 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .category-icon i {
            color: white;
            font-size: 22px;
        }

        .category-info h4 {
            margin: 0 0 5px 0;
            color: #1a237e;
            font-size: 16px;
        }

        .category-info p {
            margin: 0;
            color: #666;
            font-size: 13px;
            line-height: 1.4;
        }

        /* Quick Links */
        .quick-links {
            margin-bottom: 40px;
        }

        .quick-links h3 {
            text-align: center;
            color: #1a73e8;
            margin-bottom: 30px;
            font-size: 22px;
        }

        .links-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
        }

        .link-column h4 {
            color: #1a237e;
            margin-bottom: 15px;
            font-size: 18px;
            padding-bottom: 10px;
            border-bottom: 2px solid #e0e0e0;
        }

        .link-column ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .link-column li {
            margin-bottom: 10px;
        }

        .link-column a {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #555;
            text-decoration: none;
            transition: color 0.3s;
        }

        .link-column a:hover {
            color: #1a73e8;
        }

        .link-column a i {
            color: #1a73e8;
            width: 16px;
        }

        /* Error Report */
        .error-report {
            background: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px 20px;
            border-radius: 0 8px 8px 0;
            margin-top: 30px;
        }

        .error-report p {
            margin: 0;
            color: #856404;
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }

        .error-report i {
            color: #ffc107;
            font-size: 18px;
            margin-top: 3px;
        }

        .error-report a {
            color: #1a73e8;
            font-weight: 600;
            text-decoration: none;
        }

        .error-report a:hover {
            text-decoration: underline;
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .categories-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .links-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .error-content {
                padding: 40px 20px;
            }
            
            .error-title {
                font-size: 28px;
            }
            
            .error-message {
                font-size: 16px;
            }
            
            .digit {
                font-size: 80px;
            }
            
            .zero {
                width: 80px;
                height: 80px;
            }
            
            .inner-circle {
                top: 10px;
                left: 10px;
                right: 10px;
                bottom: 10px;
            }
            
            .search-wrapper {
                flex-direction: column;
            }
            
            #error-search-btn {
                justify-content: center;
            }
            
            .error-actions {
                flex-direction: column;
                align-items: center;
            }
            
            .btn-primary, .btn-secondary, .btn-outline {
                width: 100%;
                max-width: 300px;
                justify-content: center;
            }
        }

        @media (max-width: 576px) {
            .categories-grid {
                grid-template-columns: 1fr;
            }
            
            .links-grid {
                grid-template-columns: 1fr;
            }
            
            .error-illustration {
                padding: 30px 0;
            }
            
            .error-icon {
                width: 50px;
                height: 50px;
                bottom: -20px;
            }
            
            .error-icon i {
                font-size: 24px;
            }
        }
    </style>
</body>
</html>