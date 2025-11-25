<?php
// pages/privacy.php
$pageTitle = "Privacy Policy - 90storezon";
$pageDescription = "Read the privacy policy for 90storezon, protecting your data and usage.";
$pageKeywords = "privacy policy, data protection, 90storezon";
?>
<?php include '../header.php'; ?>

<div class="container">
    <div class="page-header">
        <h1>Privacy Policy</h1>
        <p class="page-subtitle">Last updated: January 15, 2024</p>
    </div>

    <div class="policy-content">
        <div class="policy-section">
            <h2>1. Information We Collect</h2>
            <p>At 90storezon, we are committed to protecting your privacy. Our calculators are designed to process your data locally in your browser, which means:</p>
            <ul>
                <li>We do not collect personal identification information</li>
                <li>Calculation inputs are processed on your device and not sent to our servers</li>
                <li>We may collect anonymous usage statistics to improve our services</li>
                <li>We use cookies for essential website functionality</li>
            </ul>
        </div>

        <div class="policy-section">
            <h2>2. How We Use Information</h2>
            <p>Any information we collect is used solely to improve your experience:</p>
            <ul>
                <li>To provide and maintain our calculator services</li>
                <li>To understand how users interact with our calculators</li>
                <li>To improve calculator accuracy and performance</li>
                <li>To develop new calculators based on user needs</li>
            </ul>
        </div>

        <div class="policy-section">
            <h2>3. Data Security</h2>
            <p>We implement appropriate security measures to protect your information:</p>
            <ul>
                <li>All data transmission uses HTTPS encryption</li>
                <li>Regular security updates and monitoring</li>
                <li>Limited data retention for anonymous analytics</li>
                <li>No storage of personal calculation data</li>
            </ul>
        </div>

        <div class="policy-section">
            <h2>4. Third-Party Services</h2>
            <p>We may use third-party services that have their own privacy policies:</p>
            <ul>
                <li>Google Analytics for anonymous usage statistics</li>
                <li>Cloudflare for security and performance</li>
                <li>Hosting providers for website operation</li>
            </ul>
            <p>These services may collect information as described in their respective privacy policies.</p>
        </div>

        <div class="policy-section">
            <h2>5. Your Rights</h2>
            <p>You have the right to:</p>
            <ul>
                <li>Access any personal information we hold about you</li>
                <li>Request correction of inaccurate information</li>
                <li>Request deletion of your personal information</li>
                <li>Opt-out of analytics tracking</li>
                <li>Withdraw consent for data processing</li>
            </ul>
        </div>

        <div class="policy-section">
            <h2>6. Cookies</h2>
            <p>We use cookies for essential website functions:</p>
            <ul>
                <li>Session management</li>
                <li>Theme preferences</li>
                <li>Anonymous analytics</li>
            </ul>
            <p>You can disable cookies in your browser settings, though this may affect website functionality.</p>
        </div>

        <div class="policy-section">
            <h2>7. Children's Privacy</h2>
            <p>Our services are suitable for users of all ages. We do not knowingly collect personal information from children under 13. If you believe a child has provided us with personal information, please contact us immediately.</p>
        </div>

        <div class="policy-section">
            <h2>8. Changes to This Policy</h2>
            <p>We may update this privacy policy from time to time. We will notify you of any changes by posting the new policy on this page and updating the "Last updated" date.</p>
        </div>

        <div class="policy-section">
            <h2>9. Contact Us</h2>
            <p>If you have any questions about this Privacy Policy, please contact us:</p>
            <ul>
                <li>Email: privacy@90storezon.com</li>
                <li>Through our contact form</li>
            </ul>
        </div>

        <div class="policy-note">
            <p><strong>Note:</strong> This privacy policy applies only to our online activities and is valid for visitors to our website with regards to the information that they shared and/or collect in 90storezon.</p>
        </div>
    </div>
</div>

<style>
.policy-content {
    max-width: 900px;
    margin: 0 auto;
    background: white;
    padding: 40px;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
}

.policy-section {
    margin-bottom: 40px;
    padding-bottom: 30px;
    border-bottom: 1px solid #f0f0f0;
}

.policy-section:last-child {
    border-bottom: none;
    margin-bottom: 0;
}

.policy-section h2 {
    color: #333;
    margin-bottom: 20px;
    font-size: 1.5rem;
}

.policy-section p {
    line-height: 1.7;
    color: #555;
    margin-bottom: 15px;
}

.policy-section ul {
    color: #555;
    line-height: 1.7;
    padding-left: 20px;
}

.policy-section li {
    margin-bottom: 8px;
}

.policy-note {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 8px;
    border-left: 4px solid #007bff;
    margin-top: 30px;
}

.policy-note p {
    margin: 0;
    color: #666;
    line-height: 1.6;
}

@media (max-width: 768px) {
    .policy-content {
        padding: 25px;
    }
    
    .policy-section {
        margin-bottom: 30px;
        padding-bottom: 20px;
    }
    
    .policy-section h2 {
        font-size: 1.3rem;
    }
}
</style>

<?php include '../footer.php'; ?>