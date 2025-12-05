<?php
// Check if user is logged in
$isLoggedIn = isset($_SESSION['user_id']);
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
?>
<header class="main-header">
    <div class="header-container">
        <!-- Logo Section -->
        <div class="logo-section">
            <a href="index.php" class="logo-link">
                <div class="logo-icon">
                    <i class="fas fa-calculator"></i>
                </div>
                <div class="logo-text">
                    <span class="logo-primary">90storezon</span>
                    <span class="logo-tagline">Free Online Calculators</span>
                </div>
            </a>
        </div>

            <!-- Desktop Navigation -->
            <nav class="desktop-nav">
                <ul class="nav-menu">
                    <li class="nav-item"><a href="index.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">
                        <i class="fas fa-home"></i> Home
                    </a></li>
                    
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link">
                            <i class="fas fa-calculator"></i> Calculators <i class="fas fa-chevron-down"></i>
                        </a>
                        <div class="dropdown-menu">
                            <div class="dropdown-column">
                                <h4>Financial</h4>
                                <a href="calculators/loan-calculator/">Loan Calculator</a>
                                <a href="calculators/mortgage-calculator/">Mortgage</a>
                                <a href="calculators/interest-calculator/">Interest</a>
                                <a href="calculators/tax-calculator/">Tax Calculator</a>
                            </div>
                            <div class="dropdown-column">
                                <h4>Health</h4>
                                <a href="calculators/bmi-calculator/">BMI Calculator</a>
                                <a href="calculators/calorie-calculator/">Calorie</a>
                                <a href="calculators/body-fat-calculator/">Body Fat</a>
                                <a href="calculators/bmr-calculator/">BMR</a>
                            </div>
                            <div class="dropdown-column">
                                <h4>Math</h4>
                                <a href="calculators/scientific-calculator/">Scientific</a>
                                <a href="calculators/percentage-calculator/">Percentage</a>
                                <a href="calculators/fraction-calculator/">Fraction</a>
                                <a href="calculators/algebra-calculator/">Algebra</a>
                            </div>
                            <div class="dropdown-column">
                                <h4>Tools</h4>
                                <a href="calculators/age-calculator/">Age Calculator</a>
                                <a href="calculators/date-calculator/">Date</a>
                                <a href="calculators/conversion-calculator/">Conversion</a>
                                <a href="calculators/unit-converter/">Unit Converter</a>
                            </div>
                        </div>
                    </li>
                    
                    <li class="nav-item"><a href="pages/about.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'about.php' ? 'active' : ''; ?>">
                        <i class="fas fa-info-circle"></i> About
                    </a></li>
                    
                    <li class="nav-item"><a href="pages/contact.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'contact.php' ? 'active' : ''; ?>">
                        <i class="fas fa-envelope"></i> Contact
                    </a></li>
                </ul>
            </nav>

            <!-- Search Bar -->
            <div class="search-section">
                <div class="search-wrapper">
                    <input type="text" id="header-search" placeholder="Search calculators..." class="search-input">
                    <button type="button" class="search-btn">
                        <i class="fas fa-search"></i>
                    </button>
                    <div class="search-results" id="header-search-results"></div>
                </div>
            </div>

            <!-- User Authentication Section -->
            <div class="auth-section">
                <?php if ($isLoggedIn): ?>
                    <div class="user-dropdown">
                        <button class="user-btn">
                            <i class="fas fa-user-circle"></i>
                            <span class="username"><?php echo htmlspecialchars($username); ?></span>
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <div class="user-menu">
                            <a href="user/dashboard.php" class="user-menu-item">
                                <i class="fas fa-tachometer-alt"></i> Dashboard
                            </a>
                            <a href="user/saved-calculations.php" class="user-menu-item">
                                <i class="fas fa-save"></i> Saved Calculations
                            </a>
                            <a href="user/settings.php" class="user-menu-item">
                                <i class="fas fa-cog"></i> Settings
                            </a>
                            <div class="user-menu-divider"></div>
                            <a href="auth/logout.php" class="user-menu-item logout">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="auth-buttons">
                        <a href="auth/login.php" class="auth-btn login-btn">
                            <i class="fas fa-sign-in-alt"></i> Login
                        </a>
                        <a href="auth/register.php" class="auth-btn signup-btn">
                            <i class="fas fa-user-plus"></i> Sign Up
                        </a>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Mobile Menu Toggle -->
            <button class="mobile-menu-toggle" id="mobileMenuToggle">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>

        <!-- Mobile Navigation Menu -->
        <div class="mobile-nav" id="mobileNav">
            <div class="mobile-nav-header">
                <div class="mobile-logo">90storezon</div>
                <button class="mobile-close-btn" id="mobileCloseBtn">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <div class="mobile-search">
                <input type="text" placeholder="Search calculators..." class="mobile-search-input">
                <button class="mobile-search-btn">
                    <i class="fas fa-search"></i>
                </button>
            </div>
            
            <ul class="mobile-nav-menu">
                <li><a href="index.php" class="mobile-nav-link">
                    <i class="fas fa-home"></i> Home
                </a></li>
                
                <li class="mobile-nav-dropdown">
                    <a href="#" class="mobile-nav-link">
                        <i class="fas fa-calculator"></i> Calculators <i class="fas fa-chevron-right"></i>
                    </a>
                    <div class="mobile-dropdown-content">
                        <a href="calculators/loan-calculator/">Loan Calculator</a>
                        <a href="calculators/mortgage-calculator/">Mortgage Calculator</a>
                        <a href="calculators/bmi-calculator/">BMI Calculator</a>
                        <a href="calculators/percentage-calculator/">Percentage Calculator</a>
                        <a href="calculators/age-calculator/">Age Calculator</a>
                        <a href="calculators/tax-calculator/">Tax Calculator</a>
                        <a href="calculators/scientific-calculator/">Scientific Calculator</a>
                        <a href="calculators/all-calculators.php">View All</a>
                    </div>
                </li>
                
                <li><a href="pages/about.php" class="mobile-nav-link">
                    <i class="fas fa-info-circle"></i> About
                </a></li>
                
                <li><a href="pages/contact.php" class="mobile-nav-link">
                    <i class="fas fa-envelope"></i> Contact
                </a></li>
                
                <li><a href="pages/privacy-policy.php" class="mobile-nav-link">
                    <i class="fas fa-shield-alt"></i> Privacy
                </a></li>
                
                <li><a href="pages/terms.php" class="mobile-nav-link">
                    <i class="fas fa-file-contract"></i> Terms
                </a></li>
            </ul>
            
            <div class="mobile-auth-section">
                <?php if ($isLoggedIn): ?>
                    <a href="user/dashboard.php" class="mobile-auth-btn">
                        <i class="fas fa-user-circle"></i> Dashboard
                    </a>
                    <a href="auth/logout.php" class="mobile-auth-btn logout">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                <?php else: ?>
                    <a href="auth/login.php" class="mobile-auth-btn">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </a>
                    <a href="auth/register.php" class="mobile-auth-btn signup">
                        <i class="fas fa-user-plus"></i> Sign Up
                    </a>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Mobile Overlay -->
        <div class="mobile-overlay" id="mobileOverlay"></div>
    </header>

    <script>
        // Mobile Menu Toggle
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuToggle = document.getElementById('mobileMenuToggle');
            const mobileNav = document.getElementById('mobileNav');
            const mobileOverlay = document.getElementById('mobileOverlay');
            const mobileCloseBtn = document.getElementById('mobileCloseBtn');
            
            // Toggle mobile menu
            function toggleMobileMenu() {
                mobileNav.classList.toggle('active');
                mobileOverlay.classList.toggle('active');
                document.body.classList.toggle('menu-open');
            }
            
            // Event listeners
            mobileMenuToggle.addEventListener('click', toggleMobileMenu);
            mobileCloseBtn.addEventListener('click', toggleMobileMenu);
            mobileOverlay.addEventListener('click', toggleMobileMenu);
            
            // Close mobile menu when clicking on links
            document.querySelectorAll('.mobile-nav-link').forEach(link => {
                link.addEventListener('click', () => {
                    if (!link.classList.contains('dropdown-toggle')) {
                        toggleMobileMenu();
                    }
                });
            });
            
            // Mobile dropdown toggle
            document.querySelectorAll('.mobile-nav-dropdown > a').forEach(dropdownToggle => {
                dropdownToggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    const dropdown = this.parentElement;
                    dropdown.classList.toggle('open');
                    
                    const icon = this.querySelector('.fa-chevron-right');
                    if (dropdown.classList.contains('open')) {
                        icon.classList.replace('fa-chevron-right', 'fa-chevron-down');
                    } else {
                        icon.classList.replace('fa-chevron-down', 'fa-chevron-right');
                    }
                });
            });
            
            // User dropdown for desktop
            const userBtn = document.querySelector('.user-btn');
            if (userBtn) {
                userBtn.addEventListener('click', function() {
                    this.parentElement.classList.toggle('active');
                });
                
                // Close user dropdown when clicking outside
                document.addEventListener('click', function(event) {
                    if (!event.target.closest('.user-dropdown')) {
                        document.querySelector('.user-dropdown')?.classList.remove('active');
                    }
                });
            }
            
            // Header search functionality
            const headerSearch = document.getElementById('header-search');
            const headerSearchResults = document.getElementById('header-search-results');
            
            if (headerSearch) {
                headerSearch.addEventListener('input', function() {
                    const query = this.value.trim().toLowerCase();
                    
                    if (query.length < 2) {
                        headerSearchResults.style.display = 'none';
                        return;
                    }
                    
                    // Mock search data
                    const calculators = [
                        'BMI Calculator', 'Loan Calculator', 'Mortgage Calculator',
                        'Percentage Calculator', 'Age Calculator', 'Tax Calculator',
                        'Scientific Calculator', 'Interest Calculator', 'Calorie Calculator',
                        'Date Calculator', 'Unit Converter', 'Currency Converter'
                    ];
                    
                    const results = calculators.filter(calc => 
                        calc.toLowerCase().includes(query)
                    ).slice(0, 5);
                    
                    if (results.length > 0) {
                        headerSearchResults.innerHTML = results.map(result => `
                            <a href="calculators/${result.toLowerCase().replace(/ /g, '-')}/" class="search-result">
                                <i class="fas fa-calculator"></i> ${result}
                            </a>
                        `).join('');
                        headerSearchResults.style.display = 'block';
                    } else {
                        headerSearchResults.innerHTML = '<div class="no-results">No calculators found</div>';
                        headerSearchResults.style.display = 'block';
                    }
                });
                
                // Hide search results when clicking outside
                document.addEventListener('click', function(event) {
                    if (!event.target.closest('.search-wrapper')) {
                        headerSearchResults.style.display = 'none';
                    }
                });
            }
        });
    </script>

    <style>
        /* Header CSS Styles */
        .main-header {
            background: linear-gradient(135deg, #1a73e8 0%, #0d47a1 100%);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .header-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 70px;
        }

        /* Logo Section */
        .logo-section {
            flex: 0 0 auto;
        }

        .logo-link {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: white;
            gap: 12px;
        }

        .logo-icon {
            font-size: 28px;
            color: white;
        }

        .logo-text {
            display: flex;
            flex-direction: column;
        }

        .logo-primary {
            font-size: 24px;
            font-weight: bold;
            color: white;
            line-height: 1;
        }

        .logo-tagline {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.9);
            margin-top: 2px;
        }

        /* Desktop Navigation */
        .desktop-nav {
            flex: 1;
            margin: 0 30px;
        }

        .nav-menu {
            display: flex;
            list-style: none;
            margin: 0;
            padding: 0;
            gap: 5px;
        }

        .nav-item {
            position: relative;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 12px 18px;
            text-decoration: none;
            color: rgba(255, 255, 255, 0.9);
            font-weight: 500;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .nav-link:hover,
        .nav-link.active {
            background: rgba(255, 255, 255, 0.15);
            color: white;
        }

        .nav-link i {
            font-size: 16px;
        }

        /* Dropdown Menu */
        .dropdown {
            position: relative;
        }

        .dropdown-menu {
            position: absolute;
            top: 100%;
            left: 0;
            background: white;
            border-radius: 8px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            min-width: 600px;
            padding: 20px;
            display: none;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            z-index: 1000;
            margin-top: 10px;
        }

        .dropdown:hover .dropdown-menu {
            display: grid;
        }

        .dropdown-menu::before {
            content: '';
            position: absolute;
            top: -10px;
            left: 30px;
            border-left: 10px solid transparent;
            border-right: 10px solid transparent;
            border-bottom: 10px solid white;
        }

        .dropdown-column h4 {
            color: #1a73e8;
            margin: 0 0 12px 0;
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .dropdown-column a {
            display: block;
            padding: 8px 0;
            color: #444;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s;
        }

        .dropdown-column a:hover {
            color: #1a73e8;
        }

        /* Search Section */
        .search-section {
            flex: 0 1 300px;
            margin-right: 20px;
        }

        .search-wrapper {
            position: relative;
        }

        .search-input {
            width: 100%;
            padding: 10px 40px 10px 15px;
            border: none;
            border-radius: 25px;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            font-size: 14px;
            outline: none;
        }

        .search-input::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        .search-btn {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: white;
            cursor: pointer;
            font-size: 16px;
        }

        .search-results {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            border-radius: 8px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            margin-top: 10px;
            display: none;
            z-index: 1000;
        }

        .search-result {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 15px;
            color: #444;
            text-decoration: none;
            border-bottom: 1px solid #eee;
            transition: background 0.3s;
        }

        .search-result:hover {
            background: #f5f5f5;
        }

        .search-result i {
            color: #1a73e8;
        }

        .no-results {
            padding: 15px;
            color: #666;
            text-align: center;
        }

        /* Auth Section */
        .auth-section {
            flex: 0 0 auto;
        }

        .auth-buttons {
            display: flex;
            gap: 10px;
        }

        .auth-btn {
            padding: 8px 20px;
            border-radius: 20px;
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .login-btn {
            background: transparent;
            border: 2px solid rgba(255, 255, 255, 0.3);
            color: white;
        }

        .login-btn:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: white;
        }

        .signup-btn {
            background: white;
            color: #1a73e8;
            border: 2px solid white;
        }

        .signup-btn:hover {
            background: #f0f0f0;
        }

        /* User Dropdown */
        .user-dropdown {
            position: relative;
        }

        .user-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.1);
            border: none;
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            cursor: pointer;
            font-weight: 500;
            transition: background 0.3s;
        }

        .user-btn:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .user-btn i {
            font-size: 18px;
        }

        .username {
            max-width: 120px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .user-menu {
            position: absolute;
            top: 100%;
            right: 0;
            background: white;
            border-radius: 8px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            min-width: 200px;
            margin-top: 10px;
            display: none;
            z-index: 1000;
        }

        .user-dropdown.active .user-menu {
            display: block;
        }

        .user-menu-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 15px;
            color: #444;
            text-decoration: none;
            border-bottom: 1px solid #eee;
            transition: background 0.3s;
        }

        .user-menu-item:hover {
            background: #f5f5f5;
            color: #1a73e8;
        }

        .user-menu-divider {
            height: 1px;
            background: #eee;
            margin: 5px 0;
        }

        .logout {
            color: #e53935;
        }

        /* Mobile Menu Toggle */
        .mobile-menu-toggle {
            display: none;
            flex-direction: column;
            justify-content: space-between;
            width: 30px;
            height: 21px;
            background: none;
            border: none;
            cursor: pointer;
            padding: 0;
        }

        .mobile-menu-toggle span {
            display: block;
            height: 3px;
            width: 100%;
            background: white;
            border-radius: 3px;
            transition: 0.3s;
        }

        /* Mobile Navigation */
        .mobile-nav {
            position: fixed;
            top: 0;
            right: -320px;
            width: 300px;
            height: 100vh;
            background: white;
            box-shadow: -5px 0 30px rgba(0, 0, 0, 0.1);
            transition: right 0.3s ease;
            z-index: 1001;
            display: flex;
            flex-direction: column;
        }

        .mobile-nav.active {
            right: 0;
        }

        .mobile-nav-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background: #1a73e8;
            color: white;
        }

        .mobile-logo {
            font-size: 20px;
            font-weight: bold;
        }

        .mobile-close-btn {
            background: none;
            border: none;
            color: white;
            font-size: 20px;
            cursor: pointer;
        }

        .mobile-search {
            padding: 15px;
            border-bottom: 1px solid #eee;
        }

        .mobile-search-input {
            width: 100%;
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 25px;
            font-size: 14px;
        }

        .mobile-search-btn {
            display: none;
        }

        .mobile-nav-menu {
            flex: 1;
            overflow-y: auto;
            padding: 0;
            margin: 0;
            list-style: none;
        }

        .mobile-nav-link {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px 20px;
            color: #444;
            text-decoration: none;
            border-bottom: 1px solid #eee;
            font-size: 16px;
        }

        .mobile-nav-link i {
            color: #1a73e8;
            margin-right: 10px;
            width: 20px;
        }

        .mobile-dropdown-content {
            display: none;
            background: #f9f9f9;
            padding: 10px 0;
        }

        .mobile-nav-dropdown.open .mobile-dropdown-content {
            display: block;
        }

        .mobile-dropdown-content a {
            display: block;
            padding: 10px 40px;
            color: #666;
            text-decoration: none;
            font-size: 14px;
        }

        .mobile-dropdown-content a:hover {
            background: #f0f0f0;
            color: #1a73e8;
        }

        .mobile-auth-section {
            padding: 20px;
            border-top: 1px solid #eee;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .mobile-auth-btn {
            padding: 12px;
            border-radius: 6px;
            text-align: center;
            text-decoration: none;
            font-weight: 500;
            color: #1a73e8;
            border: 1px solid #1a73e8;
        }

        .mobile-auth-btn.logout {
            color: #e53935;
            border-color: #e53935;
        }

        .mobile-auth-btn.signup {
            background: #1a73e8;
            color: white;
        }

        /* Mobile Overlay */
        .mobile-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            z-index: 1000;
        }

        .mobile-overlay.active {
            display: block;
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .header-container {
                padding: 0 15px;
            }
            
            .search-section {
                flex: 0 1 250px;
            }
            
            .dropdown-menu {
                min-width: 500px;
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 992px) {
            .desktop-nav {
                display: none;
            }
            
            .mobile-menu-toggle {
                display: flex;
            }
            
            .search-section {
                display: none;
            }
            
            .auth-section {
                margin-left: auto;
                margin-right: 20px;
            }
            
            .dropdown-menu {
                min-width: 400px;
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .header-container {
                height: 60px;
            }
            
            .logo-primary {
                font-size: 20px;
            }
            
            .logo-tagline {
                font-size: 10px;
            }
            
            .auth-buttons .auth-btn span {
                display: none;
            }
            
            .auth-buttons .auth-btn i {
                margin: 0;
            }
            
            .auth-btn {
                padding: 8px;
                width: 40px;
                height: 40px;
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            .mobile-nav {
                width: 100%;
                right: -100%;
            }
            
            .auth-buttons {
                gap: 5px;
            }
        }
    </style>
</header>