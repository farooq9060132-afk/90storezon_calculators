<?php
// pages/contact.php
$pageTitle = "Contact Us - 90storezon";
$pageDescription = "Get in touch with 90storezon team for support or inquiries.";
$pageKeywords = "contact, support, 90storezon, calculators";
?>
<?php include '../header.php'; ?>

<div class="container">
    <div class="page-header">
        <h1>Contact Us</h1>
        <p class="page-subtitle">We'd love to hear from you. Send us a message and we'll respond as soon as possible.</p>
    </div>

    <div class="contact-content">
        <div class="contact-info">
            <div class="info-card">
                <div class="info-icon">📧</div>
                <h3>Email Us</h3>
                <p>support@90storezon.com</p>
                <p>We typically respond within 24 hours</p>
            </div>
            
            <div class="info-card">
                <div class="info-icon">🕒</div>
                <h3>Response Time</h3>
                <p>24-48 Hours</p>
                <p>During business days</p>
            </div>
            
            <div class="info-card">
                <div class="info-icon">🌐</div>
                <h3>Website Issues</h3>
                <p>Report technical problems</p>
                <p>Calculator errors or bugs</p>
            </div>
            
            <div class="info-card">
                <div class="info-icon">💡</div>
                <h3>Suggestions</h3>
                <p>New calculator ideas</p>
                <p>Feature requests welcome</p>
            </div>
        </div>

        <div class="contact-form-container">
            <form class="contact-form" method="POST" action="../submit_contact.php">
                <div class="form-group">
                    <label for="name">Full Name *</label>
                    <input type="text" id="name" name="name" class="form-input" required placeholder="Enter your full name">
                </div>
                
                <div class="form-group">
                    <label for="email">Email Address *</label>
                    <input type="email" id="email" name="email" class="form-input" required placeholder="Enter your email address">
                </div>
                
                <div class="form-group">
                    <label for="subject">Subject *</label>
                    <select id="subject" name="subject" class="form-select" required>
                        <option value="">Select a subject</option>
                        <option value="general">General Inquiry</option>
                        <option value="support">Technical Support</option>
                        <option value="suggestion">Feature Suggestion</option>
                        <option value="bug">Report a Bug</option>
                        <option value="partnership">Partnership Opportunity</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="message">Message *</label>
                    <textarea id="message" name="message" class="form-textarea" required rows="6" placeholder="Please describe your inquiry in detail..."></textarea>
                </div>
                
                <div class="form-group">
                    <label class="checkbox-label">
                        <input type="checkbox" name="newsletter" id="newsletter">
                        <span class="checkmark"></span>
                        Subscribe to our newsletter for updates and new calculator announcements
                    </label>
                </div>
                
                <button type="submit" class="btn btn-primary btn-large">Send Message</button>
            </form>
        </div>
    </div>

    <div class="faq-section">
        <h2>Frequently Asked Questions</h2>
        <div class="faq-list">
            <div class="faq-item">
                <h3>Are your calculators really free to use?</h3>
                <p>Yes, all 50+ calculators on 90storezon are completely free to use. There are no hidden fees, subscriptions, or registration requirements.</p>
            </div>
            
            <div class="faq-item">
                <h3>How accurate are the calculator results?</h3>
                <p>Our calculators use precise algorithms and up-to-date formulas to ensure accurate results. However, for critical financial or health decisions, we recommend consulting with professionals.</p>
            </div>
            
            <div class="faq-item">
                <h3>Can I suggest a new calculator?</h3>
                <p>Absolutely! We're always looking to expand our calculator collection. Use the contact form above to suggest new calculators you'd like to see on our platform.</p>
            </div>
            
            <div class="faq-item">
                <h3>Do you store my personal data?</h3>
                <p>We respect your privacy. Calculator inputs are processed locally in your browser and we don't store personal calculation data on our servers.</p>
            </div>
        </div>
    </div>
</div>

<style>
.contact-content {
    display: grid;
    grid-template-columns: 1fr 1.5fr;
    gap: 50px;
    margin-bottom: 60px;
}

.contact-info {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.info-card {
    background: white;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    text-align: center;
    transition: transform 0.3s ease;
}

.info-card:hover {
    transform: translateY(-5px);
}

.info-icon {
    font-size: 2.5rem;
    margin-bottom: 15px;
}

.info-card h3 {
    color: #333;
    margin-bottom: 10px;
    font-size: 1.2rem;
}

.info-card p {
    color: #666;
    margin: 5px 0;
    line-height: 1.5;
}

.contact-form-container {
    background: white;
    padding: 40px;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
}

.contact-form {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-group label {
    font-weight: 600;
    color: #333;
    margin-bottom: 8px;
}

.form-input, .form-textarea, .form-select {
    padding: 12px 15px;
    border: 1px solid #e0e0e0;
    border-radius: 6px;
    font-size: 14px;
    transition: border-color 0.3s ease;
    font-family: inherit;
}

.form-input:focus, .form-textarea:focus, .form-select:focus {
    outline: none;
    border-color: #007bff;
    box-shadow: 0 0 0 3px rgba(0,123,255,0.1);
}

.form-textarea {
    resize: vertical;
    min-height: 120px;
}

.form-select {
    background: white;
    cursor: pointer;
}

.checkbox-label {
    display: flex;
    align-items: flex-start;
    cursor: pointer;
    font-weight: normal;
    color: #555;
    line-height: 1.5;
}

.checkbox-label input[type="checkbox"] {
    display: none;
}

.checkmark {
    width: 20px;
    height: 20px;
    border: 2px solid #e0e0e0;
    border-radius: 4px;
    margin-right: 10px;
    margin-top: 2px;
    flex-shrink: 0;
    position: relative;
    transition: all 0.3s ease;
}

.checkbox-label input[type="checkbox"]:checked + .checkmark {
    background: #007bff;
    border-color: #007bff;
}

.checkbox-label input[type="checkbox"]:checked + .checkmark::after {
    content: '✓';
    position: absolute;
    color: white;
    font-size: 14px;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

.btn-large {
    padding: 15px 30px;
    font-size: 1.1rem;
    font-weight: 600;
}

.faq-section {
    background: white;
    padding: 40px;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
}

.faq-section h2 {
    text-align: center;
    color: #333;
    margin-bottom: 30px;
    font-size: 1.8rem;
}

.faq-list {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.faq-item {
    border-bottom: 1px solid #f0f0f0;
    padding-bottom: 20px;
}

.faq-item:last-child {
    border-bottom: none;
    padding-bottom: 0;
}

.faq-item h3 {
    color: #333;
    margin-bottom: 10px;
    font-size: 1.2rem;
}

.faq-item p {
    color: #666;
    line-height: 1.6;
    margin: 0;
}

@media (max-width: 768px) {
    .contact-content {
        grid-template-columns: 1fr;
        gap: 30px;
    }
    
    .contact-form-container {
        padding: 25px;
    }
    
    .faq-section {
        padding: 25px;
    }
    
    .info-card {
        padding: 20px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const contactForm = document.querySelector('.contact-form');
    
    contactForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Simple form validation
        const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();
        const subject = document.getElementById('subject').value;
        const message = document.getElementById('message').value.trim();
        
        if (!name || !email || !subject || !message) {
            alert('Please fill in all required fields.');
            return;
        }
        
        // In real implementation, this would submit to backend
        alert('Thank you for your message! We will get back to you soon.');
        contactForm.reset();
    });
});
</script>

<?php include '../footer.php'; ?>