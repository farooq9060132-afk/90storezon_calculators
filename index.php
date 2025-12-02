<?php
// Include your header
include 'header.php';
?>

<style>
/* Homepage styles */
.hero-section {
    background: linear-gradient(135deg, #f5f7fa 0%, #e4edf9 100%);
    padding: 80px 20px;
    text-align: center;
    margin-bottom: 60px;
}

.hero-content {
    max-width: 800px;
    margin: 0 auto;
}

.hero-title {
    font-size: 48px;
    font-weight: 700;
    color: #0052FF;
    margin-bottom: 20px;
    line-height: 1.2;
}

.hero-subtitle {
    font-size: 20px;
    color: #5f6368;
    margin-bottom: 40px;
    line-height: 1.6;
}

.search-container {
    max-width: 600px;
    margin: 0 auto 30px;
}

.search-box {
    display: flex;
    gap: 10px;
}

.search-input {
    flex: 1;
    padding: 16px 20px;
    border: 1px solid #dadce0;
    border-radius: 8px;
    font-size: 16px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.search-btn {
    background: #0052FF;
    color: white;
    border: none;
    border-radius: 8px;
    padding: 0 24px;
    font-weight: 500;
    cursor: pointer;
    transition: background-color 0.2s ease;
}

.search-btn:hover {
    background: #0041cc;
}

.features-section {
    max-width: 1200px;
    margin: 0 auto 60px;
    padding: 0 20px;
}

.section-title {
    text-align: center;
    font-size: 32px;
    color: #202124;
    margin-bottom: 15px;
    font-weight: 600;
}

.section-subtitle {
    text-align: center;
    color: #5f6368;
    font-size: 18px;
    max-width: 700px;
    margin: 0 auto 40px;
    line-height: 1.6;
}

.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 30px;
}

.feature-card {
    background: #ffffff;
    border: 1px solid #dadce0;
    border-radius: 12px;
    padding: 30px;
    text-align: center;
    transition: all 0.3s ease;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.feature-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    border-color: #0052FF;
}

.feature-icon {
    font-size: 48px;
    margin-bottom: 20px;
    color: #0052FF;
}

.feature-card h3 {
    font-size: 22px;
    color: #202124;
    margin-bottom: 15px;
    font-weight: 600;
}

.feature-card p {
    color: #5f6368;
    line-height: 1.6;
    margin-bottom: 20px;
}

.feature-link {
    color: #0052FF;
    text-decoration: none;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 5px;
}

.feature-link:hover {
    text-decoration: underline;
}

.popular-calculators {
    max-width: 1200px;
    margin: 0 auto 60px;
    padding: 0 20px;
}

.calculators-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 25px;
}

.calculator-card {
    background: #ffffff;
    border: 1px solid #dadce0;
    border-radius: 10px;
    padding: 25px;
    transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}

.calculator-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    border-color: #0052FF;
}

.calculator-card h3 {
    font-size: 18px;
    color: #202124;
    margin-bottom: 12px;
    font-weight: 600;
}

.calculator-card p {
    color: #5f6368;
    font-size: 14px;
    line-height: 1.5;
    margin-bottom: 20px;
}

.calculator-link {
    display: inline-block;
    background: #0052FF;
    color: white;
    text-decoration: none;
    padding: 10px 20px;
    border-radius: 6px;
    font-weight: 500;
    font-size: 14px;
    transition: background-color 0.2s ease;
}

.calculator-link:hover {
    background: #0041cc;
    text-decoration: none;
}

.categories-section {
    background: #f8f9fa;
    padding: 60px 20px;
    margin-bottom: 60px;
}

.categories-container {
    max-width: 1200px;
    margin: 0 auto;
}

.categories-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 25px;
}

.category-box {
    background: #ffffff;
    border: 1px solid #dadce0;
    border-radius: 10px;
    padding: 30px 25px;
    text-align: center;
    transition: all 0.3s ease;
}

.category-box:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    border-color: #0052FF;
}

.category-box h3 {
    font-size: 20px;
    color: #202124;
    margin-bottom: 15px;
    font-weight: 600;
}

.category-box p {
    color: #5f6368;
    font-size: 15px;
    line-height: 1.6;
    margin-bottom: 20px;
}

.category-link {
    color: #0052FF;
    text-decoration: none;
    font-weight: 500;
}

.category-link:hover {
    text-decoration: underline;
}

.stats-section {
    max-width: 1200px;
    margin: 0 auto 60px;
    padding: 0 20px;
    text-align: center;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 30px;
    margin-top: 40px;
}

.stat-item h3 {
    font-size: 48px;
    color: #0052FF;
    margin-bottom: 10px;
    font-weight: 700;
}

.stat-item p {
    color: #5f6368;
    font-size: 18px;
    margin: 0;
}

@media (max-width: 768px) {
    .hero-section {
        padding: 50px 20px;
    }
    
    .hero-title {
        font-size: 36px;
    }
    
    .hero-subtitle {
        font-size: 18px;
    }
    
    .search-box {
        flex-direction: column;
    }
    
    .section-title {
        font-size: 28px;
    }
    
    .section-subtitle {
        font-size: 16px;
    }
    
    .features-grid, .calculators-grid, .categories-grid {
        grid-template-columns: 1fr;
    }
    
    .stats-grid {
        grid-template-columns: 1fr 1fr;
    }
}

@media (max-width: 480px) {
    .hero-title {
        font-size: 32px;
    }
    
    .stats-grid {
        grid-template-columns: 1fr;
    }
    
    .stat-item h3 {
        font-size: 36px;
    }
}
</style>

<div class="hero-section">
    <div class="hero-content">
        <h1 class="hero-title">50+ Free Online Calculators</h1>
        <p class="hero-subtitle">Accurate, fast, and easy-to-use calculators for finance, health, math, and more. All completely free with no registration required.</p>
        
        <div class="search-container">
            <div class="search-box">
                <input type="text" class="search-input" placeholder="Search for a calculator...">
                <button class="search-btn">Search</button>
            </div>
        </div>
    </div>
</div>

<div class="features-section">
    <h2 class="section-title">Why Choose Our Calculators</h2>
    <p class="section-subtitle">We provide accurate calculations with a clean, simple interface that makes complex math easy.</p>
    
    <div class="features-grid">
        <div class="feature-card">
            <div class="feature-icon">⚡</div>
            <h3>Lightning Fast</h3>
            <p>Get instant results with our optimized calculation algorithms. No waiting, no delays.</p>
            <a href="/calculators/" class="feature-link">Browse Calculators →</a>
        </div>
        
        <div class="feature-card">
            <div class="feature-icon">📱</div>
            <h3>Mobile Friendly</h3>
            <p>Works perfectly on all devices - desktop, tablet, or smartphone.</p>
            <a href="/calculators/" class="feature-link">See All Tools →</a>
        </div>
        
        <div class="feature-card">
            <div class="feature-icon">🔒</div>
            <h3>Privacy Focused</h3>
            <p>We don't store any of your data. Your calculations stay private.</p>
            <a href="/pages/privacy.php" class="feature-link">Privacy Policy →</a>
        </div>
    </div>
</div>

<div class="popular-calculators">
    <h2 class="section-title">Popular Calculators</h2>
    <p class="section-subtitle">Our most-used tools for everyday calculations.</p>
    
    <div class="calculators-grid">
        <div class="calculator-card">
            <h3>Loan EMI Calculator</h3>
            <p>Calculate your monthly loan payments with interest rates and tenure.</p>
            <a href="/calculators/loan-calculator/" class="calculator-link">Calculate Now</a>
        </div>
        
        <div class="calculator-card">
            <h3>Anorexic BMI Calculator</h3>
            <p>Calculate BMI to assess if body weight suggests anorexia nervosa.</p>
            <a href="/calculators/anorexic-bmi-calculator/" class="calculator-link">Calculate Now</a>
        </div>
        
        <div class="calculator-card">
            <h3>Interest Calculator</h3>
            <p>Calculate compound interest, investment growth, and savings.</p>
            <a href="/calculators/interest-calculator/" class="calculator-link">Calculate Now</a>
        </div>
        
        <div class="calculator-card">
            <h3>Currency Calculator</h3>
            <p>Convert between different currencies with real-time exchange rates.</p>
            <a href="/calculators/currency-calculator/" class="calculator-link">Calculate Now</a>
        </div>
    </div>
</div>

<div class="categories-section">
    <div class="categories-container">
        <h2 class="section-title">Calculator Categories</h2>
        <p class="section-subtitle">Browse our calculators organized by category.</p>
        
        <div class="categories-grid">
            <div class="category-box">
                <h3>Financial Tools</h3>
                <p>Loan calculators, investment tools, budget planners, and more.</p>
                <a href="/calculators/?category=financial" class="category-link">View Calculators</a>
            </div>
            
            <div class="category-box">
                <h3>Health & Fitness</h3>
                <p>BMI calculator, calorie counter, heart rate zone calculator.</p>
                <a href="/calculators/?category=health" class="category-link">View Calculators</a>
            </div>
            
            <div class="category-box">
                <h3>Math & Education</h3>
                <p>Scientific calculators, grade calculators, GPA tools.</p>
                <a href="/calculators/?category=math" class="category-link">View Calculators</a>
            </div>
            
            <div class="category-box">
                <h3>Other Tools</h3>
                <p>Unit converters, file size tools, color code converters.</p>
                <a href="/calculators/?category=other" class="category-link">View Calculators</a>
            </div>
        </div>
    </div>
</div>

<div class="stats-section">
    <h2 class="section-title">Trusted by Thousands</h2>
    <p class="section-subtitle">Join our community of users who rely on our calculators daily.</p>
    
    <div class="stats-grid">
        <div class="stat-item">
            <h3>50+</h3>
            <p>Calculators</p>
        </div>
        
        <div class="stat-item">
            <h3>100K+</h3>
            <p>Monthly Users</p>
        </div>
        
        <div class="stat-item">
            <h3>1M+</h3>
            <p>Calculations</p>
        </div>
        
        <div class="stat-item">
            <h3>100%</h3>
            <p>Free</p>
        </div>
    </div>
</div>

<?php
// Include your footer
include 'footer.php';
?>