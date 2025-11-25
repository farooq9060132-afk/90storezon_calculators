<?php
// pages/about.php
$pageTitle = "About Us - 90storezon";
$pageDescription = "Learn about 90storezon, your trusted platform for 50+ free online calculators.";
$pageKeywords = "about, 90storezon, calculators, finance, health, math";
?>
<?php include '../header.php'; ?>

<div class="container">
    <div class="page-header">
        <h1>About 90storezon</h1>
        <p class="page-subtitle">Your trusted platform for professional online calculators</p>
    </div>

    <div class="page-content">
        <div class="content-section">
            <h2>Our Mission</h2>
            <p>At 90storezon, we believe that everyone should have access to powerful, reliable, and easy-to-use calculation tools. Our mission is to provide a comprehensive collection of 50+ specialized calculators that help people make informed decisions in their personal and professional lives.</p>
        </div>

        <div class="content-section">
            <h2>What We Offer</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">🧮</div>
                    <h3>50+ Calculators</h3>
                    <p>Comprehensive collection covering finance, health, math, and everyday calculations</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🎯</div>
                    <h3>Accurate Results</h3>
                    <p>Precision-engineered calculators with reliable algorithms and up-to-date formulas</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">📱</div>
                    <h3>Mobile Friendly</h3>
                    <p>Fully responsive design that works perfectly on all devices and screen sizes</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🆓</div>
                    <h3>Completely Free</h3>
                    <p>All our calculators are free to use with no hidden costs or registration required</p>
                </div>
            </div>
        </div>

        <div class="content-section">
            <h2>Our Categories</h2>
            <div class="categories-list">
                <div class="category-item">
                    <h4>Financial Calculators</h4>
                    <p>Loan EMI, mortgage, compound interest, investment planning, and more financial tools</p>
                </div>
                <div class="category-item">
                    <h4>Health & Fitness</h4>
                    <p>BMI, calorie intake, body fat percentage, protein calculator, and health assessments</p>
                </div>
                <div class="category-item">
                    <h4>Math Calculators</h4>
                    <p>Algebra, geometry, statistics, percentage, fractions, and advanced mathematical tools</p>
                </div>
                <div class="category-item">
                    <h4>Everyday Tools</h4>
                    <p>Age calculator, unit converter, date calculator, and other useful everyday calculators</p>
                </div>
            </div>
        </div>

        <div class="content-section">
            <h2>Why Choose 90storezon?</h2>
            <ul class="benefits-list">
                <li><strong>Professional Quality:</strong> All calculators are built with precision and accuracy</li>
                <li><strong>User-Friendly:</strong> Clean, intuitive interface that's easy for anyone to use</li>
                <li><strong>Regular Updates:</strong> We continuously improve and add new calculators</li>
                <li><strong>No Registration:</strong> Use all features immediately without creating an account</li>
                <li><strong>Privacy Focused:</strong> Your data stays on your device - we don't track personal information</li>
            </ul>
        </div>

        <div class="content-section cta-section">
            <h2>Ready to Start Calculating?</h2>
            <p>Explore our collection of 50+ calculators and find the perfect tool for your needs.</p>
            <a href="../index.php" class="btn btn-primary">Browse All Calculators</a>
        </div>
    </div>
</div>

<style>
.page-header {
    text-align: center;
    margin-bottom: 50px;
    padding: 40px 0;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-radius: 12px;
}

.page-header h1 {
    font-size: 2.5rem;
    color: #333;
    margin-bottom: 10px;
}

.page-subtitle {
    font-size: 1.2rem;
    color: #666;
    max-width: 600px;
    margin: 0 auto;
}

.page-content {
    max-width: 1000px;
    margin: 0 auto;
}

.content-section {
    margin-bottom: 50px;
}

.content-section h2 {
    color: #333;
    margin-bottom: 20px;
    font-size: 1.8rem;
}

.content-section p {
    line-height: 1.7;
    color: #555;
    margin-bottom: 15px;
}

.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 30px;
    margin-top: 30px;
}

.feature-card {
    background: white;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    text-align: center;
    transition: transform 0.3s ease;
}

.feature-card:hover {
    transform: translateY(-5px);
}

.feature-icon {
    font-size: 3rem;
    margin-bottom: 20px;
}

.feature-card h3 {
    color: #333;
    margin-bottom: 15px;
    font-size: 1.3rem;
}

.feature-card p {
    color: #666;
    line-height: 1.6;
}

.categories-list {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.category-item {
    background: white;
    padding: 25px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    border-left: 4px solid #007bff;
}

.category-item h4 {
    color: #333;
    margin-bottom: 10px;
    font-size: 1.2rem;
}

.benefits-list {
    list-style: none;
    padding: 0;
}

.benefits-list li {
    padding: 15px 0;
    border-bottom: 1px solid #f0f0f0;
    color: #555;
    line-height: 1.6;
}

.benefits-list li:last-child {
    border-bottom: none;
}

.benefits-list strong {
    color: #333;
}

.cta-section {
    text-align: center;
    background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
    color: white;
    padding: 50px;
    border-radius: 12px;
    margin-top: 40px;
}

.cta-section h2 {
    color: white;
    margin-bottom: 15px;
}

.cta-section p {
    color: rgba(255,255,255,0.9);
    margin-bottom: 25px;
    font-size: 1.1rem;
}

.cta-section .btn {
    background: white;
    color: #007bff;
    font-weight: 600;
    padding: 12px 30px;
    font-size: 1.1rem;
}

.cta-section .btn:hover {
    background: #f8f9fa;
    transform: translateY(-2px);
}

@media (max-width: 768px) {
    .page-header {
        padding: 30px 20px;
        margin-bottom: 30px;
    }
    
    .page-header h1 {
        font-size: 2rem;
    }
    
    .features-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .feature-card {
        padding: 20px;
    }
    
    .cta-section {
        padding: 30px 20px;
    }
    
    .content-section {
        margin-bottom: 40px;
    }
}
</style>

<?php include '../footer.php'; ?>