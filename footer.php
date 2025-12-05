<footer class="main-footer">
    <div class="footer-container">
        <!-- Top Section -->
        <div class="footer-top">
            <div class="footer-brand">
                <div class="footer-logo">
                    <i class="fas fa-calculator"></i>
                    <span class="footer-logo-text">90storezon</span>
                </div>
                    <p class="footer-tagline">
                        Your trusted source for free online calculators. Accurate, fast, and completely free.
                    </p>
                    <div class="social-icons">
                        <a href="#" class="social-icon facebook" title="Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-icon twitter" title="Twitter">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-icon linkedin" title="LinkedIn">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" class="social-icon youtube" title="YouTube">
                            <i class="fab fa-youtube"></i>
                        </a>
                        <a href="#" class="social-icon instagram" title="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="footer-column">
                    <h3 class="footer-heading">Quick Links</h3>
                    <ul class="footer-links">
                        <li><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
                        <li><a href="pages/about.php"><i class="fas fa-info-circle"></i> About Us</a></li>
                        <li><a href="pages/contact.php"><i class="fas fa-envelope"></i> Contact</a></li>
                        <li><a href="pages/privacy-policy.php"><i class="fas fa-shield-alt"></i> Privacy Policy</a></li>
                        <li><a href="pages/terms.php"><i class="fas fa-file-contract"></i> Terms of Use</a></li>
                        <li><a href="sitemap.xml"><i class="fas fa-sitemap"></i> Sitemap</a></li>
                    </ul>
                </div>

                <!-- Calculator Categories -->
                <div class="footer-column">
                    <h3 class="footer-heading">Calculator Categories</h3>
                    <ul class="footer-links">
                        <li><a href="calculators/financial-calculators.php"><i class="fas fa-chart-line"></i> Financial Calculators</a></li>
                        <li><a href="calculators/health-calculators.php"><i class="fas fa-heartbeat"></i> Health & Fitness</a></li>
                        <li><a href="calculators/math-calculators.php"><i class="fas fa-square-root-alt"></i> Mathematics</a></li>
                        <li><a href="calculators/conversion-calculators.php"><i class="fas fa-exchange-alt"></i> Conversion Tools</a></li>
                        <li><a href="calculators/date-time-calculators.php"><i class="fas fa-calendar-alt"></i> Date & Time</a></li>
                        <li><a href="calculators/other-calculators.php"><i class="fas fa-tools"></i> Other Tools</a></li>
                    </ul>
                </div>

                <!-- Popular Calculators -->
                <div class="footer-column">
                    <h3 class="footer-heading">Popular Calculators</h3>
                    <ul class="footer-links">
                        <li><a href="calculators/bmi-calculator/"><i class="fas fa-weight"></i> BMI Calculator</a></li>
                        <li><a href="calculators/loan-calculator/"><i class="fas fa-hand-holding-usd"></i> Loan Calculator</a></li>
                        <li><a href="calculators/percentage-calculator/"><i class="fas fa-percentage"></i> Percentage Calculator</a></li>
                        <li><a href="calculators/mortgage-calculator/"><i class="fas fa-home"></i> Mortgage Calculator</a></li>
                        <li><a href="calculators/age-calculator/"><i class="fas fa-birthday-cake"></i> Age Calculator</a></li>
                        <li><a href="calculators/tax-calculator/"><i class="fas fa-receipt"></i> Tax Calculator</a></li>
                    </ul>
                </div>
            </div>

            <!-- Middle Section - Disclaimer -->
            <div class="footer-middle">
                <div class="disclaimer-box">
                    <h4><i class="fas fa-exclamation-triangle"></i> Important Disclaimer</h4>
                    <p>
                        <strong>90storezon</strong> provides calculator tools for informational and educational purposes only. 
                        All calculations and results should be verified independently and are not guaranteed to be 100% accurate. 
                        We do not accept responsibility for any financial, health, or other decisions made based on calculator results. 
                        Always consult with qualified professionals for important decisions. 
                        Calculator results are estimates and may vary based on individual circumstances.
                    </p>
                </div>
            </div>

            <!-- Bottom Section -->
            <div class="footer-bottom">
                <div class="footer-bottom-content">
                    <div class="copyright">
                        <p>
                            <i class="far fa-copyright"></i> Copyright 2024 <strong>90 Store Zone</strong>. All rights reserved.
                            <span class="separator">|</span>
                            <span class="footer-info">
                                This website is developed and maintained by 90storezon team.
                            </span>
                        </p>
                    </div>
                    
                    <div class="footer-extra">
                        <div class="language-selector">
                            <i class="fas fa-globe"></i>
                            <select class="lang-select">
                                <option value="en">English</option>
                                <option value="ur">اردو</option>
                                <option value="es">Español</option>
                                <option value="fr">Français</option>
                                <option value="de">Deutsch</option>
                            </select>
                        </div>
                        
                        <div class="footer-utils">
                            <a href="#" class="footer-util-link"><i class="fas fa-question-circle"></i> Help</a>
                            <a href="#" class="footer-util-link"><i class="fas fa-rss"></i> RSS</a>
                            <a href="#" class="footer-util-link"><i class="fas fa-arrow-up"></i> Back to Top</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Back to Top functionality
            const backToTopLinks = document.querySelectorAll('.footer-util-link[href="#"]');
            backToTopLinks.forEach(link => {
                if (link.textContent.includes('Back to Top')) {
                    link.addEventListener('click', function(e) {
                        e.preventDefault();
                        window.scrollTo({
                            top: 0,
                            behavior: 'smooth'
                        });
                    });
                }
            });

            // Language selector change
            const langSelect = document.querySelector('.lang-select');
            if (langSelect) {
                langSelect.addEventListener('change', function() {
                    const selectedLang = this.value;
                    // In a real implementation, this would redirect to translated version
                    console.log('Language changed to:', selectedLang);
                    // You would implement language switching logic here
                });
            }

            // Add current year to copyright (optional)
            const copyrightElement = document.querySelector('.copyright p');
            if (copyrightElement) {
                const currentYear = new Date().getFullYear();
                copyrightElement.innerHTML = copyrightElement.innerHTML.replace('2024', currentYear);
            }
        });
    </script>

    <style>
        /* Footer Styles */
        .main-footer {
            background: linear-gradient(135deg, #0d47a1 0%, #1a237e 100%);
            color: white;
            margin-top: 50px;
            border-top: 5px solid #1a73e8;
        }

        .footer-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 40px 20px 20px;
        }

        /* Footer Top Section */
        .footer-top {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 40px;
            margin-bottom: 40px;
            padding-bottom: 40px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .footer-brand {
            display: flex;
            flex-direction: column;
        }

        .footer-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
        }

        .footer-logo i {
            font-size: 32px;
            color: #64b5f6;
        }

        .footer-logo-text {
            font-size: 28px;
            font-weight: bold;
            color: white;
        }

        .footer-tagline {
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 25px;
            line-height: 1.6;
            font-size: 15px;
        }

        .social-icons {
            display: flex;
            gap: 15px;
            margin-top: 10px;
        }

        .social-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 16px;
        }

        .social-icon:hover {
            transform: translateY(-3px);
            background: rgba(255, 255, 255, 0.2);
        }

        .social-icon.facebook:hover { background: #1877f2; }
        .social-icon.twitter:hover { background: #1da1f2; }
        .social-icon.linkedin:hover { background: #0077b5; }
        .social-icon.youtube:hover { background: #ff0000; }
        .social-icon.instagram:hover { background: linear-gradient(45deg, #405de6, #5851db, #833ab4, #c13584, #e1306c, #fd1d1d); }

        /* Footer Columns */
        .footer-column {
            display: flex;
            flex-direction: column;
        }

        .footer-heading {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 20px;
            color: white;
            position: relative;
            padding-bottom: 10px;
        }

        .footer-heading::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 40px;
            height: 3px;
            background: #64b5f6;
        }

        .footer-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-links li {
            margin-bottom: 12px;
        }

        .footer-links a {
            display: flex;
            align-items: center;
            gap: 10px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 14px;
        }

        .footer-links a:hover {
            color: #64b5f6;
            transform: translateX(5px);
        }

        .footer-links a i {
            width: 16px;
            text-align: center;
            font-size: 14px;
        }

        /* Footer Middle - Disclaimer */
        .footer-middle {
            margin-bottom: 30px;
            padding: 25px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 10px;
            border-left: 4px solid #ff9800;
        }

        .disclaimer-box h4 {
            color: #ff9800;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 16px;
        }

        .disclaimer-box p {
            color: rgba(255, 255, 255, 0.8);
            line-height: 1.7;
            font-size: 14px;
            margin: 0;
        }

        /* Footer Bottom */
        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 20px;
        }

        .footer-bottom-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .copyright {
            flex: 1;
            min-width: 300px;
        }

        .copyright p {
            color: rgba(255, 255, 255, 0.7);
            font-size: 14px;
            margin: 0;
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 5px;
        }

        .copyright strong {
            color: white;
            font-weight: 600;
        }

        .separator {
            color: rgba(255, 255, 255, 0.3);
            margin: 0 10px;
        }

        .footer-info {
            color: rgba(255, 255, 255, 0.6);
            font-size: 13px;
        }

        .footer-extra {
            display: flex;
            gap: 30px;
            align-items: center;
        }

        .language-selector {
            display: flex;
            align-items: center;
            gap: 8px;
            color: rgba(255, 255, 255, 0.8);
        }

        .lang-select {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
            outline: none;
        }

        .lang-select option {
            background: #0d47a1;
            color: white;
        }

        .footer-utils {
            display: flex;
            gap: 20px;
        }

        .footer-util-link {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 5px;
            transition: color 0.3s;
        }

        .footer-util-link:hover {
            color: #64b5f6;
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .footer-top {
                gap: 30px;
            }
        }

        @media (max-width: 992px) {
            .footer-top {
                grid-template-columns: repeat(2, 1fr);
                gap: 40px 30px;
            }
            
            .footer-brand {
                grid-column: 1 / -1;
                text-align: center;
                align-items: center;
            }
            
            .footer-logo {
                justify-content: center;
            }
            
            .footer-tagline {
                max-width: 600px;
                text-align: center;
            }
        }

        @media (max-width: 768px) {
            .footer-container {
                padding: 30px 15px 15px;
            }
            
            .footer-top {
                grid-template-columns: 1fr;
                gap: 30px;
            }
            
            .footer-brand {
                grid-column: 1;
            }
            
            .footer-bottom-content {
                flex-direction: column;
                text-align: center;
                gap: 15px;
            }
            
            .copyright {
                min-width: auto;
                order: 2;
            }
            
            .copyright p {
                justify-content: center;
                flex-direction: column;
                gap: 10px;
            }
            
            .separator {
                display: none;
            }
            
            .footer-extra {
                flex-direction: column;
                gap: 15px;
                order: 1;
                width: 100%;
            }
            
            .footer-utils {
                justify-content: center;
                flex-wrap: wrap;
            }
        }

        @media (max-width: 480px) {
            .footer-heading {
                font-size: 16px;
            }
            
            .footer-links a {
                font-size: 13px;
            }
            
            .social-icons {
                justify-content: center;
                flex-wrap: wrap;
            }
            
            .footer-middle {
                padding: 15px;
            }
            
            .disclaimer-box p {
                font-size: 13px;
            }
        }

        /* Print Styles */
        @media print {
            .main-footer {
                display: none;
            }
        }
    </style>
</footer>