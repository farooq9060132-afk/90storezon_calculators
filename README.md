# 90storezon - Ultimate Calculator Platform

![PHP Version](https://img.shields.io/badge/PHP-%3E%3D7.4-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)
![Version](https://img.shields.io/badge/Version-1.0.0-blue?style=for-the-badge)

## 📖 Table of Contents
- [Project Overview](#-project-overview)
- [✨ Features](#-features)
- [🛠️ Technology Stack](#%EF%B8%8F-technology-stack)
- [🚀 Installation](#-installation)
- [📁 Project Structure](#-project-structure)
- [🧮 Available Calculators](#-available-calculators)
- [📱 Usage](#-usage)
- [🔧 API Documentation](#-api-documentation)
- [🤝 Contributing](#-contributing)
- [🧪 Testing](#-testing)
- [☁️ Deployment](#%EF%B8%8F-deployment)
- [⚙️ Configuration](#%EF%B8%8F-configuration)
- [📸 Screenshots](#-screenshots)
- [🗺️ Roadmap](#%EF%B8%8F-roadmap)
- [📄 License](#-license)
- [📞 Contact](#-contact)
- [🙏 Acknowledgments](#-acknowledgments)
- [❓ FAQ](#-faq)
- [📝 Changelog](#-changelog)

## 🎯 Project Overview

**90storezon** is a comprehensive, web-based calculator platform offering 50+ specialized calculators across various categories including financial, health, mathematics, and more. Built with a clean, intuitive interface inspired by Calculator.net, this platform provides accurate calculations with professional-grade precision.

### What It Does
- Provides 50+ specialized calculators for different use cases
- Offers scientific calculator with advanced functions
- Includes user authentication and calculation history
- Features admin dashboard for user management
- Delivers responsive design for all devices
- Ensures fast, accurate calculations with real-time results

## ✨ Features

### Core Features
1. **Scientific Calculator** - Advanced mathematical functions (sin, cos, tan, log, ln, π, e, etc.)
2. **50+ Specialized Calculators** - Covering finance, health, math, and everyday calculations
3. **User Authentication** - Secure login/registration system with session management
4. **Calculation History** - Save and retrieve previous calculations
5. **Responsive Design** - Fully responsive across mobile, tablet, and desktop
6. **Fast Performance** - Optimized for quick calculations and page loads
7. **Clean UI/UX** - Intuitive interface with Calculator.net inspired design
8. **Dark/Light Mode** - Automatic theme switching based on system preferences
9. **Search Functionality** - Quickly find calculators by name or category
10. **Print Support** - Print calculations and results

### Advanced Features
11. **Admin Dashboard** - Complete user and content management
12. **Calculation Favorites** - Bookmark frequently used calculators
13. **Real-time Calculations** - Instant results as you type
14. **Error Handling** - Comprehensive validation and error messages
15. **Accessibility** - ARIA labels and keyboard navigation support
16. **Cross-browser Compatibility** - Works on Chrome, Firefox, Safari, Edge
17. **SEO Optimized** - Proper meta tags, sitemap, and robots.txt
18. **Security Features** - XSS protection, SQL injection prevention, CSRF tokens
19. **Multi-language Support** - Ready for internationalization
20. **API Ready** - RESTful endpoints for external integration
21. **Export Results** - Export calculations to PDF/CSV
22. **Unit Conversion** - Built-in unit conversion for measurements
23. **Currency Calculator** - Real-time currency conversion (planned)
24. **Graphing Calculator** - Visual graphing capabilities (planned)

## 🛠️ Technology Stack

### Backend
- **PHP 7.4+** - Server-side scripting language
- **MySQL 8.0+** - Database management system
- **Apache/Nginx** - Web server
- **Composer** - PHP dependency manager

### Frontend
- **HTML5** - Semantic markup
- **CSS3** - Styling with CSS Grid and Flexbox
- **JavaScript (ES6+)** - Client-side interactivity
- **AJAX** - Asynchronous data loading

### Development Tools
- **Git** - Version control
- **VS Code** - Code editor
- **XAMPP/MAMP** - Local development environment
- **phpMyAdmin** - Database management
- **Postman** - API testing

## 🚀 Installation

### Prerequisites
- PHP 7.4 or higher
- MySQL 8.0 or higher
- Apache/Nginx web server
- Composer (optional)
- Git

### Step-by-Step Installation Guide

#### 1. Clone the Repository
```bash
git clone https://github.com/90storezon/calculator-website.git
cd calculator-website
```

#### 2. Configure Database
```sql
-- Create database
CREATE DATABASE 90storezon;

-- Create user (optional)
CREATE USER 'storezon_user'@'localhost' IDENTIFIED BY 'secure_password';
GRANT ALL PRIVILEGES ON 90storezon.* TO 'storezon_user'@'localhost';
FLUSH PRIVILEGES;
```

#### 3. Configure Environment
```bash
# Copy configuration file
cp includes/config.example.php includes/config.php

# Edit config.php with your database credentials
# Update: DB_HOST, DB_NAME, DB_USER, DB_PASS
```

#### 4. Import Database Schema
```bash
# Using MySQL command line
mysql -u username -p 90storezon < database/schema.sql

# Or using phpMyAdmin
# Import database/schema.sql file
```

#### 5. Set Permissions
```bash
chmod 755 ./
chmod 644 includes/config.php
chmod 777 data/ (if using file storage)
```

#### 6. Configure Web Server

**For Apache:**
```apache
<VirtualHost *:80>
    ServerName 90storezon.local
    DocumentRoot /path/to/90storezon
    <Directory /path/to/90storezon>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

**For Nginx:**
```nginx
server {
    listen 80;
    server_name 90storezon.local;
    root /path/to/90storezon;
    
    index index.php index.html;
    
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
    
    location ~ \.php$ {
        include fastcgi_params;
        fastcgi_pass unix:/var/run/php/php7.4-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    }
}
```

#### 7. Install Dependencies
```bash
# Install PHP dependencies (if using Composer)
composer install

# Or manually copy required files
# No external dependencies required for basic setup
```

#### 8. Access the Application
1. Open browser and navigate to `http://localhost/90storezon` or `http://90storezon.local`
2. Register a new account or use default admin credentials:
   - Email: `admin@90storezon.com`
   - Password: `admin123` (change immediately)

## 📁 Project Structure

```
90storezon/
├── admin/                     # Admin panel
│   ├── index.php             # Admin dashboard
│   ├── login.php             # Admin login
│   ├── users.php             # User management
│   ├── ads.php               # Ad management
│   └── settings.php          # Site settings
├── auth/                     # Authentication
│   ├── login.php             # User login
│   ├── register.php          # User registration
│   └── logout.php            # Logout handler
├── assets/                   # Static assets
│   ├── icons/                # SVG/icons
│   ├── images/               # Images
│   └── css/                  # Stylesheets
│       ├── style.css         # Main styles
│       └── theme-blue.css    # Blue theme
├── calculators/              # All calculators (50+)
│   ├── scientific/           # Scientific calculator
│   ├── loan-calculator/      # Loan calculator
│   ├── bmi-calculator/       # BMI calculator
│   ├── percentage-calculator/# Percentage calculator
│   ├── triangle-calculator/  # Triangle calculator
│   ├── slope-calculator/     # Slope calculator
│   └── ...                   # 45+ more calculators
├── includes/                 # Core PHP files
│   ├── db.php               # Database connection
│   ├── auth-check.php       # Authentication check
│   ├── functions.php        # Helper functions
│   ├── config.php           # Configuration (gitignored)
│   └── header.php           # Header template
├── pages/                   # Static pages
│   ├── about.php            # About page
│   ├── privacy-policy.php   # Privacy policy
│   ├── terms.php            # Terms of service
│   └── sitemap.php          # Sitemap page
├── data/                    # Data storage
│   └── calculator-data.json # Calculator metadata
├── database/                # Database files
│   ├── schema.sql           # Database schema
│   └── seed-data.sql        # Sample data
├── tests/                   # Test files
│   ├── unit/               # Unit tests
│   ├── integration/        # Integration tests
│   └── browser/            # Browser tests
├── index.php               # Homepage
├── header.php              # Site header
├── footer.php              # Site footer
├── script.js               # Main JavaScript
├── style.css               # Main CSS
├── .htaccess               # Apache configuration
├── robots.txt              # Search engine rules
├── sitemap.xml             # XML sitemap
├── google-ads.txt          # Google Ads file
├── README.md               # This file
├── LICENSE                 # MIT License
├── composer.json           # PHP dependencies
├── package.json            # JavaScript dependencies
├── CHANGELOG.md            # Version history
└── CONTRIBUTING.md         # Contribution guidelines
```

## 🧮 Available Calculators

### 📊 Financial Calculators (15)
1. **Loan Calculator** - Calculate loan payments and interest
2. **Mortgage Calculator** - Home mortgage calculations
3. **Auto Loan Calculator** - Car loan payments
4. **Interest Calculator** - Simple and compound interest
5. **Payment Calculator** - Payment schedule generator
6. **Retirement Calculator** - Retirement savings planning
7. **Amortization Calculator** - Loan amortization schedule
8. **Investment Calculator** - Investment growth projections
9. **Inflation Calculator** - Inflation-adjusted values
10. **Finance Calculator** - General financial calculations
11. **Income Tax Calculator** - Tax estimation
12. **Compound Interest Calculator** - Compound interest calculations
13. **Salary Calculator** - Salary and wage calculations
14. **Interest Rate Calculator** - Interest rate analysis
15. **Sales Tax Calculator** - Sales tax calculations

### 💪 Health & Fitness Calculators (10)
16. **BMI Calculator** - Body Mass Index
17. **Calorie Calculator** - Daily calorie needs
18. **Body Fat Calculator** - Body fat percentage
19. **BMR Calculator** - Basal Metabolic Rate
20. **Ideal Weight Calculator** - Healthy weight range
21. **Pace Calculator** - Running/walking pace
22. **Pregnancy Calculator** - Pregnancy timeline
23. **Pregnancy Conception Calculator** - Conception date
24. **Due Date Calculator** - Pregnancy due date
25. **TDEE Calculator** - Total Daily Energy Expenditure

### 📐 Mathematics Calculators (15)
26. **Scientific Calculator** - Advanced math functions
27. **Fraction Calculator** - Fraction operations
28. **Percentage Calculator** - Percentage calculations
29. **Random Number Generator** - Random number generation
30. **Triangle Calculator** - Triangle properties
31. **Standard Deviation Calculator** - Statistical analysis
32. **Slope Calculator** - Line slope calculations
33. **Algebra Calculator** - Algebraic equations
34. **Geometry Calculator** - Geometric formulas
35. **Statistics Calculator** - Statistical functions
36. **Matrix Calculator** - Matrix operations
37. **Graphing Calculator** - Function graphing
38. **Unit Converter** - Measurement conversions
39. **Binary Calculator** - Binary operations
40. **GCD/LCM Calculator** - Greatest common divisor/least common multiple

### 🎓 Educational Calculators (5)
41. **GPA Calculator** - Grade Point Average
42. **Grade Calculator** - Grade calculations
43. **Test Score Calculator** - Test scoring
44. **Class Average Calculator** - Average grades
45. **Study Time Calculator** - Study planning

### 🛠️ Utility Calculators (5)
46. **Age Calculator** - Age in years/months/days
47. **Date Calculator** - Date differences
48. **Time Calculator** - Time calculations
49. **Hours Calculator** - Work hour calculations
50. **Password Generator** - Secure password generation

### 🌐 Conversion Calculators (5)
51. **Conversion Calculator** - General unit conversion
52. **Currency Converter** - Currency conversion
53. **Temperature Converter** - Temperature scales
54. **Length Converter** - Length measurements
55. **Weight Converter** - Weight measurements

## 📱 Usage

### For Users

#### 1. Accessing Calculators
- Visit the homepage to see featured calculators
- Use the search bar to find specific calculators
- Browse categories from the navigation menu
- Click any calculator card to open it

#### 2. Using Scientific Calculator
1. Click numbers and operators to build expressions
2. Use function buttons (sin, cos, tan, log, ln, etc.)
3. Switch between Deg/Rad modes for trigonometry
4. Use memory functions (M+, M-, MR, MC) for storing values
5. Press equals (=) to calculate result
6. Use backspace (⌫) to correct mistakes
7. Clear (C) resets the calculation

#### 3. User Account Features
- **Register**: Click "Sign Up" in the header
- **Login**: Use credentials to access account
- **Save Calculations**: Log in to save calculation history
- **Favorites**: Bookmark frequently used calculators
- **Profile**: Update account information
- **Logout**: Secure session termination

#### 4. Calculator Features
- **Real-time Calculation**: Results update as you type
- **History**: View previous calculations
- **Copy Results**: Click result to copy to clipboard
- **Print**: Use print button or Ctrl+P
- **Share**: Share calculations via link (planned)

### For Administrators

#### 1. Access Admin Panel
- Navigate to `/admin`
- Login with admin credentials
- Dashboard shows site statistics

#### 2. User Management
- View all registered users
- Edit user information
- Delete users if necessary
- Reset user passwords
- View user activity logs

#### 3. Content Management
- Add new calculators
- Edit existing calculator pages
- Update calculator categories
- Manage featured calculators
- Update static content (About, Privacy, etc.)

#### 4. Site Settings
- Update site title and description
- Configure contact information
- Set up Google Analytics
- Manage advertisements
- Configure email settings
- Backup and restore data

#### 5. Analytics
- View site traffic statistics
- Monitor popular calculators
- Track user engagement
- Generate usage reports
- Export data for analysis

## 🔧 API Documentation

### REST API Endpoints

#### Authentication
```http
POST /api/auth/login
Content-Type: application/json

{
    "email": "user@example.com",
    "password": "password123"
}

Response:
{
    "success": true,
    "token": "jwt_token_here",
    "user": {
        "id": 1,
        "email": "user@example.com",
        "name": "John Doe"
    }
}
```

#### Calculators
```http
GET /api/calculators
Response: List of all calculators

GET /api/calculators/{id}
Response: Calculator details

POST /api/calculators/{id}/calculate
Content-Type: application/json

{
    "input": "expression",
    "variables": {
        "x": 5,
        "y": 10
    }
}

Response:
{
    "success": true,
    "result": 15,
    "expression": "5 + 10"
}
```

#### User History
```http
GET /api/user/history
Headers: Authorization: Bearer {token}
Response: User's calculation history

POST /api/user/history/save
Headers: Authorization: Bearer {token}
Content-Type: application/json

{
    "calculator_id": 1,
    "expression": "2 + 2",
    "result": "4"
}
```

### JavaScript SDK

```javascript
// Initialize SDK
const calculator = new CalculatorSDK({
    apiKey: 'your_api_key',
    endpoint: 'https://api.90storezon.com'
});

// Calculate expression
calculator.calculate('scientific', 'sin(45) + cos(45)')
    .then(result => console.log(result))
    .catch(error => console.error(error));

// Get calculator list
calculator.getCalculators()
    .then(calculators => console.log(calculators));

// User authentication
calculator.login('email@example.com', 'password')
    .then(user => console.log(user));
```

### Webhooks
```http
POST /api/webhooks/calculation-complete
Content-Type: application/json

{
    "event": "calculation.complete",
    "data": {
        "calculator": "scientific",
        "expression": "2 + 2",
        "result": "4",
        "user_id": 123,
        "timestamp": "2024-01-01T00:00:00Z"
    }
}
```

## 🤝 Contributing

We welcome contributions! Please read our [CONTRIBUTING.md](CONTRIBUTING.md) file for details.

### Development Workflow

1. **Fork the repository**
2. **Create a feature branch**
   ```bash
   git checkout -b feature/amazing-feature
   ```
3. **Make your changes**
4. **Commit your changes**
   ```bash
   git commit -m 'Add some amazing feature'
   ```
5. **Push to the branch**
   ```bash
   git push origin feature/amazing-feature
   ```
6. **Open a Pull Request**

### Adding a New Calculator

1. **Create calculator folder**
   ```bash
   mkdir calculators/new-calculator-name
   ```
2. **Create index.php**
   ```php
   <?php
   include '../includes/header.php';
   ?>
   
   <div class="calculator-container">
       <!-- Calculator HTML -->
   </div>
   
   <script>
   // Calculator logic
   </script>
   
   <?php
   include '../includes/footer.php';
   ?>
   ```
3. **Update sitemap.xml**
4. **Add to navigation if needed**
5. **Test thoroughly**

### Coding Standards
- Follow PSR-12 for PHP code
- Use meaningful variable names
- Add comments for complex logic
- Write unit tests for new features
- Update documentation

## 🧪 Testing

### Test Types

#### 1. Unit Tests
```bash
# Run PHP unit tests
composer test

# Run specific test file
vendor/bin/phpunit tests/unit/CalculatorTest.php
```

#### 2. Integration Tests
```bash
# Run integration tests
vendor/bin/phpunit tests/integration/
```

#### 3. Browser Tests
```bash
# Install testing dependencies
npm install

# Run browser tests
npm test
```

### Test Coverage
```bash
# Generate coverage report
vendor/bin/phpunit --coverage-html coverage/
```

### Manual Testing Checklist
- [ ] Calculator accuracy verification
- [ ] Responsive design testing
- [ ] Cross-browser compatibility
- [ ] User authentication flows
- [ ] Form validation
- [ ] Error handling
- [ ] Performance testing
- [ ] Security testing

## ☁️ Deployment

### Deployment Options

#### 1. Shared Hosting (cPanel)
1. **Upload files** via FTP or File Manager
2. **Create database** using MySQL Database Wizard
3. **Import schema** using phpMyAdmin
4. **Update configuration** in `includes/config.php`
5. **Set permissions** for uploads directory
6. **Configure .htaccess** for clean URLs
7. **Test the application**

#### 2. VPS/Dedicated Server
```bash
# Clone repository
git clone https://github.com/90storezon/calculator-website.git /var/www/90storezon

# Set permissions
chown -R www-data:www-data /var/www/90storezon
chmod -R 755 /var/www/90storezon

# Configure Nginx/Apache
# (Refer to installation section)

# Set up SSL (Let's Encrypt)
certbot --nginx -d 90storezon.com

# Configure firewall
ufw allow 'Nginx Full'
```

#### 3. Docker Deployment
```dockerfile
# Dockerfile
FROM php:7.4-apache
COPY . /var/www/html/
RUN docker-php-ext-install pdo pdo_mysql
```

```bash
# Build and run
docker build -t 90storezon .
docker run -p 8080:80 90storezon
```

### Production Checklist
- [ ] Enable SSL/HTTPS
- [ ] Configure proper backups
- [ ] Set up monitoring (UptimeRobot)
- [ ] Implement caching (Varnish/Redis)
- [ ] Configure CDN (Cloudflare)
- [ ] Set up error tracking (Sentry)
- [ ] Implement rate limiting
- [ ] Configure email notifications

### Performance Optimization
1. **Enable Gzip compression**
2. **Minify CSS/JS files**
3. **Implement browser caching**
4. **Optimize images**
5. **Use database indexing**
6. **Implement query caching**
7. **Use CDN for static assets**

## ⚙️ Configuration

### Environment Variables

Create `.env` file in root directory:

```env
# Database Configuration
DB_HOST=localhost
DB_PORT=3306
DB_NAME=90storezon
DB_USER=storezon_user
DB_PASS=secure_password

# Application Settings
APP_NAME=90storezon
APP_ENV=production
APP_DEBUG=false
APP_URL=https://90storezon.com

# Security
APP_KEY=base64:random_string_here
JWT_SECRET=your_jwt_secret_here

# Email Configuration
MAIL_DRIVER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_email@gmail.com
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls

# Google Services
GOOGLE_ANALYTICS_ID=UA-XXXXXXXXX-X
GOOGLE_ADSENSE_ID=ca-pub-XXXXXXXXXXXX

# Third-party APIs
EXCHANGE_RATE_API_KEY=your_api_key
WEATHER_API_KEY=your_api_key
```

### Configuration Files

#### `includes/config.php`
```php
<?php
// Database configuration
define('DB_HOST', getenv('DB_HOST') ?: 'localhost');
define('DB_NAME', getenv('DB_NAME') ?: '90storezon');
define('DB_USER', getenv('DB_USER') ?: 'root');
define('DB_PASS', getenv('DB_PASS') ?: '');

// Site configuration
define('SITE_NAME', '90storezon');
define('SITE_URL', 'https://90storezon.com');
define('CONTACT_EMAIL', 'contact@90storezon.com');

// Security
define('SESSION_TIMEOUT', 3600); // 1 hour
define('MAX_LOGIN_ATTEMPTS', 5);
define('PASSWORD_MIN_LENGTH', 8);
?>
```

### Email Configuration
```php
// For contact form and notifications
$mail_config = [
    'host' => 'smtp.gmail.com',
    'port' => 587,
    'username' => 'noreply@90storezon.com',
    'password' => 'secure_password',
    'encryption' => 'tls',
    'from_email' => 'noreply@90storezon.com',
    'from_name' => '90storezon Calculator'
];
```

## 📸 Screenshots

### Homepage
![Homepage](https://via.placeholder.com/800x450/4285f4/ffffff?text=90storezon+Homepage)

### Scientific Calculator
![Scientific Calculator](https://via.placeholder.com/800x450/34a853/ffffff?text=Scientific+Calculator)

### Calculator Categories
![Categories](https://via.placeholder.com/800x450/ea4335/ffffff?text=Calculator+Categories)

### User Dashboard
![Dashboard](https://via.placeholder.com/800x450/fbbc05/ffffff?text=User+Dashboard)

### Admin Panel
![Admin Panel](https://via.placeholder.com/800x450/4285f4/ffffff?text=Admin+Panel)

### Mobile View
![Mobile](https://via.placeholder.com/400x700/34a853/ffffff?text=Mobile+View)

*Note: Replace placeholder images with actual screenshots*

## 🗺️ Roadmap

### Version 1.1.0 (Q1 2025)
- [ ] Dark mode toggle
- [ ] Calculator favorites
- [ ] Export to PDF/CSV
- [ ] Social sharing
- [ ] User profile avatars
- [ ] Calculator ratings
- [ ] Advanced search filters
- [ ] Bulk calculations
- [ ] Calculation templates
- [ ] Keyboard shortcuts

### Version 1.2.0 (Q2 2025)
- [ ] Multi-language support
- [ ] Graphing calculator
- [ ] Real-time currency converter
- [ ] Unit conversion tool
- [ ] Voice input support
- [ ] Handwriting recognition
- [ ] Mobile app (React Native)
- [ ] Offline mode
- [ ] Cloud sync
- [ ] Team collaboration

### Version 2.0.0 (Q3 2025)
- [ ] AI-powered calculations
- [ ] Natural language input
- [ ] Advanced data visualization
- [ ] Custom calculator builder
- [ ] API marketplace
- [ ] Premium features
- [ ] Enterprise version
- [ ] White-label solution
- [ ] Plugin system
- [ ] Marketplace for calculators

### Future Vision
- **Educational Platform**: Integration with online learning
- **Business Tools**: Advanced financial modeling
- **Health Platform**: Integration with health devices
- **Developer Tools**: API for third-party apps
- **Global Reach**: Support for all major languages

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

```
MIT License

Copyright (c) 2024 90 Store Zone

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
```

### Additional Terms
1. Calculator results are for educational purposes only
2. Professional verification recommended for critical calculations
3. No warranty for accuracy of calculations
4. Commercial use allowed with attribution
5. No redistribution of modified versions without permission

## 📞 Contact

### Project Maintainers
- **Project Lead**: [Your Name](mailto:lead@90storezon.com)
- **Technical Lead**: [Tech Lead](mailto:tech@90storezon.com)
- **Support**: [Support Team](mailto:support@90storezon.com)

### Communication Channels
- **Email**: contact@90storezon.com
- **GitHub Issues**: [Report Bugs](https://github.com/90storezon/calculator-website/issues)
- **Discord**: [Join Community](https://discord.gg/90storezon)
- **Twitter**: [@90storezon](https://twitter.com/90storezon)

### Office Hours
- **Monday - Friday**: 9:00 AM - 5:00 PM (GMT+5)
- **Support Response Time**: 24-48 hours
- **Emergency Contact**: emergency@90storezon.com

## 🙏 Acknowledgments

We would like to thank the following:

### Open Source Projects
- **PHP Community** for the amazing language
- **MySQL Team** for robust database management
- **Calculator.net** for design inspiration
- **Bootstrap** for responsive design patterns
- **Font Awesome** for beautiful icons

### Contributors
- [List of Contributors](https://github.com/90storezon/calculator-website/graphs/contributors)

### Special Thanks
- **Beta Testers** for valuable feedback
- **Open Source Community** for continuous support
- **Users** for making this project meaningful

### Inspiration
This project was inspired by the need for a comprehensive, free calculator platform that combines accuracy, usability, and modern design principles.

## ❓ FAQ

### General Questions

**Q: Is 90storezon completely free?**
A: Yes, all calculators and features are completely free to use. We plan to keep it free forever.

**Q: Do I need to create an account?**
A: No, you can use most calculators without an account. Accounts are only needed for saving calculations and accessing premium features.

**Q: Is my data safe?**
A: Yes, we use industry-standard security practices. Your calculations are private unless you choose to share them.

### Technical Questions

**Q: What browsers are supported?**
A: We support Chrome, Firefox, Safari, Edge, and Opera on desktop and mobile.

**Q: Can I use 90storezon offline?**
A: Currently, an internet connection is required. Offline mode is planned for future versions.

**Q: Are calculations accurate?**
A: We use validated algorithms, but for critical calculations, always verify with professional sources.

### Development Questions

**Q: Can I contribute to the project?**
A: Yes! We welcome contributions. Please read our [CONTRIBUTING.md](CONTRIBUTING.md) guide.

**Q: Can I use this code for my own project?**
A: Yes, under the MIT License. See the [LICENSE](LICENSE) file for details.

**Q: How do I report a bug?**
A: Use the [GitHub Issues](https://github.com/90storezon/calculator-website/issues) page.

### Business Questions

**Q: Can I use 90storezon for commercial purposes?**
A: Yes, both personal and commercial use are allowed under the MIT License.

**Q: Do you offer custom calculator development?**
A: Yes, contact us at enterprise@90storezon.com for custom solutions.

**Q: How do you make money?**
A: Currently through donations and optional premium features. We may include non-intrusive ads in the future.

## 📝 Changelog

All notable changes to this project are documented in the [CHANGELOG.md](CHANGELOG.md) file.

### Recent Updates
- **Version 1.0.0** (December 2024): Initial release with 50+ calculators
- **Version 0.9.0** (November 2024): Beta testing phase
- **Version 0.5.0** (October 2024): Core functionality complete

### View Full Changelog
[CHANGELOG.md](CHANGELOG.md)

---

<div align="center">
  
**Made with ❤️ by the 90storezon Team**

[![Website](https://img.shields.io/badge/Website-90storezon.com-blue?style=for-the-badge)](https://90storezon.com)
[![GitHub](https://img.shields.io/badge/GitHub-Repository-black?style=for-the-badge&logo=github)](https://github.com/90storezon/calculator-website)
[![Twitter](https://img.shields.io/badge/Twitter-@90storezon-1DA1F2?style=for-the-badge&logo=twitter)](https://twitter.com/90storezon)

*If you find this project useful, please consider giving it a ⭐ on GitHub!*

</div>