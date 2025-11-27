// VIP Card Interactive Effects
document.addEventListener('DOMContentLoaded', function() {
    const vipCard = document.querySelector('.vip-card');
    
    if (vipCard) {
        // Add interactive hover effects
        vipCard.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.05) rotate(2deg)';
            this.style.transition = 'all 0.3s ease';
        });
        
        vipCard.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1) rotate(0deg)';
        });
        
        // Add click effect
        vipCard.addEventListener('click', function() {
            this.style.transform = 'scale(0.95)';
            setTimeout(() => {
                this.style.transform = 'scale(1)';
            }, 150);
        });
    }
    
    // Trust indicator animation
    const trustDots = document.querySelectorAll('.trust-dot');
    trustDots.forEach((dot, index) => {
        dot.style.animationDelay = `${index * 0.5}s`;
    });
    
    // Tool cards animation
    const toolCards = document.querySelectorAll('.tool-card');
    toolCards.forEach((card, index) => {
        card.style.animationDelay = `${index * 0.1}s`;
        card.classList.add('fade-in');
    });
    
    // Security features animation
    const securityItems = document.querySelectorAll('.security-item');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-in');
            }
        });
    }, { threshold: 0.5 });
    
    securityItems.forEach(item => {
        observer.observe(item);
    });
});

// Add CSS animations
const style = document.createElement('style');
style.textContent = `
    .fade-in {
        animation: fadeInUp 0.6s ease-out forwards;
        opacity: 0;
        transform: translateY(30px);
    }
    
    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .security-item {
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.6s ease;
    }
    
    .security-item.animate-in {
        opacity: 1;
        transform: translateY(0);
    }
    
    .trust-dot {
        animation: blink 2s infinite;
    }
    
    @keyframes blink {
        0%, 50% { opacity: 1; }
        51%, 100% { opacity: 0.3; }
    }
`;
document.head.appendChild(style);

// Real-time trust indicators
function updateTrustIndicators() {
    const liveDot = document.querySelector('.trust-dot.live');
    const sslDot = document.querySelector('.trust-dot.ssl');
    
    setInterval(() => {
        // Simulate real-time status updates
        if (liveDot) {
            liveDot.style.animation = 'none';
            setTimeout(() => {
                liveDot.style.animation = 'blink 2s infinite';
            }, 10);
        }
    }, 5000);
}

updateTrustIndicators();

// Page load animations
window.addEventListener('load', function() {
    document.body.classList.add('loaded');
    
    // Add loading animation removal
    setTimeout(() => {
        const loader = document.getElementById('loader');
        if (loader) {
            loader.remove();
        }
    }, 1000);
});

// Enhanced security features display
function displaySecurityFeatures() {
    const features = [
        "🔒 Real-time Encryption Active",
        "🛡️ Firewall Protection Enabled", 
        "📱 Local Data Processing",
        "🚫 No Server Storage",
        "✅ GDPR Compliant",
        "⭐ Premium Security Standards"
    ];
    
    let currentFeature = 0;
    const featureElement = document.createElement('div');
    featureElement.className = 'security-display';
    featureElement.style.cssText = `
        position: fixed;
        bottom: 20px;
        left: 20px;
        background: rgba(0,0,0,0.8);
        color: white;
        padding: 10px 15px;
        border-radius: 10px;
        font-size: 12px;
        z-index: 1000;
        display: none;
    `;
    document.body.appendChild(featureElement);
    
    setInterval(() => {
        featureElement.textContent = features[currentFeature];
        featureElement.style.display = 'block';
        setTimeout(() => {
            featureElement.style.display = 'none';
        }, 2000);
        currentFeature = (currentFeature + 1) % features.length;
    }, 3000);
}

// Uncomment to enable security features display
// displaySecurityFeatures();