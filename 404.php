<?php
$pageTitle = "404 - Page Not Found | 90storezon";
$pageDescription = "Oops! The page you are looking for does not exist.";
$pageKeywords = "404, page not found, error, 90storezon";

include 'header.php';
?>

<div class="container">
    <div class="error-page">
        <div class="error-content">
            <div class="error-icon">
                <svg width="120" height="120" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="#007BFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M15 9L9 15" stroke="#007BFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M9 9L15 15" stroke="#007BFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            
            <div class="error-number">404</div>
            
            <h1 class="error-title">Page Not Found</h1>
            
            <p class="error-subtitle">This Page Does Not Exist</p>
            
            <p class="error-description">
                Sorry, the page you are looking for could not be found. 
                It's just an accident that was not intentional.
            </p>
            
            <div class="error-actions">
                <a href="index.php" class="btn btn-primary">
                    <span class="btn-icon">←</span>
                    Back to Homepage
                </a>
                <a href="javascript:history.back()" class="btn btn-secondary">
                    Go Back
                </a>
            </div>
            
            <div class="error-suggestions">
                <h3>You might be looking for:</h3>
                <div class="suggestion-links">
                    <a href="index.php">Homepage</a>
                    <a href="pages/calculators.php">All Calculators</a>
                    <a href="pages/about.php">About Us</a>
                    <a href="pages/contact.php">Contact</a>
                </div>
            </div>
        </div>
        
        <div class="error-illustration">
            <div class="illustration-container">
                <div class="search-icon">🔍</div>
                <div class="floating-elements">
                    <div class="floating-element element-1">?</div>
                    <div class="floating-element element-2">!</div>
                    <div class="floating-element element-3">404</div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.error-page {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 60px;
    align-items: center;
    min-height: 70vh;
    padding: 60px 0;
}

.error-content {
    text-align: left;
}

.error-icon {
    margin-bottom: 30px;
}

.error-icon svg {
    width: 80px;
    height: 80px;
}

.error-number {
    font-size: 6rem;
    font-weight: 800;
    color: #007BFF;
    margin-bottom: 10px;
    line-height: 1;
}

.error-title {
    font-size: 2.5rem;
    color: #333;
    margin-bottom: 10px;
    font-weight: 700;
}

.error-subtitle {
    font-size: 1.3rem;
    color: #666;
    margin-bottom: 25px;
    font-weight: 500;
}

.error-description {
    font-size: 1.1rem;
    color: #555;
    line-height: 1.7;
    margin-bottom: 40px;
    max-width: 500px;
}

.error-actions {
    display: flex;
    gap: 15px;
    margin-bottom: 50px;
    flex-wrap: wrap;
}

.btn {
    display: inline-flex;
    align-items: center;
    padding: 12px 24px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    font-size: 1rem;
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

.btn-primary {
    background: #007BFF;
    color: white;
}

.btn-primary:hover {
    background: #0056b3;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,123,255,0.3);
}

.btn-secondary {
    background: white;
    color: #333;
    border-color: #e0e0e0;
}

.btn-secondary:hover {
    background: #f8f9fa;
    border-color: #ccc;
    transform: translateY(-2px);
}

.btn-icon {
    margin-right: 8px;
    font-size: 1.1rem;
}

.error-suggestions {
    border-top: 1px solid #f0f0f0;
    padding-top: 30px;
}

.error-suggestions h3 {
    color: #333;
    margin-bottom: 15px;
    font-size: 1.2rem;
}

.suggestion-links {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
}

.suggestion-links a {
    color: #007BFF;
    text-decoration: none;
    padding: 8px 16px;
    border: 1px solid #e0e0e0;
    border-radius: 6px;
    transition: all 0.3s ease;
    font-size: 0.9rem;
}

.suggestion-links a:hover {
    background: #007BFF;
    color: white;
    border-color: #007BFF;
    transform: translateY(-1px);
}

.error-illustration {
    display: flex;
    justify-content: center;
    align-items: center;
}

.illustration-container {
    position: relative;
    width: 300px;
    height: 300px;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.search-icon {
    font-size: 4rem;
    opacity: 0.7;
}

.floating-elements {
    position: absolute;
    width: 100%;
    height: 100%;
}

.floating-element {
    position: absolute;
    background: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    color: #007BFF;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    animation: float 3s ease-in-out infinite;
}

.element-1 {
    width: 50px;
    height: 50px;
    top: 20%;
    left: 10%;
    font-size: 1.2rem;
    animation-delay: 0s;
}

.element-2 {
    width: 40px;
    height: 40px;
    top: 60%;
    right: 15%;
    font-size: 1rem;
    animation-delay: 1s;
}

.element-3 {
    width: 60px;
    height: 60px;
    bottom: 20%;
    left: 20%;
    font-size: 0.9rem;
    animation-delay: 2s;
}

@keyframes float {
    0%, 100% {
        transform: translateY(0) rotate(0deg);
    }
    50% {
        transform: translateY(-10px) rotate(5deg);
    }
}

/* Responsive Design */
@media (max-width: 968px) {
    .error-page {
        grid-template-columns: 1fr;
        gap: 40px;
        text-align: center;
    }
    
    .error-content {
        text-align: center;
    }
    
    .error-description {
        margin-left: auto;
        margin-right: auto;
    }
    
    .error-actions {
        justify-content: center;
    }
    
    .suggestion-links {
        justify-content: center;
    }
    
    .illustration-container {
        width: 250px;
        height: 250px;
    }
}

@media (max-width: 768px) {
    .error-page {
        padding: 40px 0;
    }
    
    .error-number {
        font-size: 4rem;
    }
    
    .error-title {
        font-size: 2rem;
    }
    
    .error-subtitle {
        font-size: 1.1rem;
    }
    
    .error-actions {
        flex-direction: column;
        align-items: center;
    }
    
    .btn {
        width: 200px;
        justify-content: center;
    }
    
    .illustration-container {
        width: 200px;
        height: 200px;
    }
    
    .search-icon {
        font-size: 3rem;
    }
    
    .element-1 {
        width: 40px;
        height: 40px;
        font-size: 1rem;
    }
    
    .element-2 {
        width: 35px;
        height: 35px;
        font-size: 0.9rem;
    }
    
    .element-3 {
        width: 50px;
        height: 50px;
        font-size: 0.8rem;
    }
}

@media (max-width: 480px) {
    .error-page {
        padding: 30px 0;
    }
    
    .error-number {
        font-size: 3rem;
    }
    
    .error-title {
        font-size: 1.7rem;
    }
    
    .error-description {
        font-size: 1rem;
    }
    
    .suggestion-links {
        flex-direction: column;
        align-items: center;
    }
    
    .suggestion-links a {
        width: 200px;
        text-align: center;
    }
}
</style>

<?php include 'footer.php'; ?>