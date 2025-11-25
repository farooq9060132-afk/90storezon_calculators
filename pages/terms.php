<?php
// pages/terms.php
$pageTitle = "Terms of Service - 90storezon";
$pageDescription = "Read the terms of service for using 90storezon online calculators.";
$pageKeywords = "terms of service, usage rules, 90storezon";
?>
<?php include '../header.php'; ?>

<div class="container">
    <div class="page-header">
        <h1>Terms of Service</h1>
        <p class="page-subtitle">Last updated: January 15, 2024</p>
    </div>

    <div class="terms-content">
        <div class="terms-section">
            <h2>1. Acceptance of Terms</h2>
            <p>By accessing and using 90storezon ("the Website"), you accept and agree to be bound by the terms and provision of this agreement. If you do not agree to abide by these terms, please do not use this site.</p>
        </div>

        <div class="terms-section">
            <h2>2. Use License</h2>
            <p>Permission is granted to temporarily use 90storezon calculators for personal, non-commercial transitory viewing only. This is the grant of a license, not a transfer of title, and under this license you may not:</p>
            <ul>
                <li>Modify or copy the materials</li>
                <li>Use the materials for any commercial purpose</li>
                <li>Attempt to decompile or reverse engineer any software</li>
                <li>Remove any copyright or other proprietary notations</li>
                <li>Transfer the materials to another person or "mirror" the materials</li>
            </ul>
        </div>

        <div class="terms-section">
            <h2>3. Calculator Disclaimer</h2>
            <p>The calculators on 90storezon are provided for informational and educational purposes only. While we strive to ensure accuracy:</p>
            <ul>
                <li>Results are estimates and may not be exact</li>
                <li>We are not liable for decisions made based on calculator results</li>
                <li>For critical financial, health, or legal decisions, consult professionals</li>
                <li>Calculator results should be verified with authoritative sources</li>
            </ul>
        </div>

        <div class="terms-section">
            <h2>4. Limitations</h2>
            <p>In no event shall 90storezon or its suppliers be liable for any damages (including, without limitation, damages for loss of data or profit, or due to business interruption) arising out of the use or inability to use the calculators on 90storezon.</p>
        </div>

        <div class="terms-section">
            <h2>5. Accuracy of Materials</h2>
            <p>The materials appearing on 90storezon could include technical, typographical, or photographic errors. We do not warrant that any of the materials on its website are accurate, complete or current. We may make changes to the materials at any time without notice.</p>
        </div>

        <div class="terms-section">
            <h2>6. Links</h2>
            <p>90storezon has not reviewed all of the sites linked to its website and is not responsible for the contents of any such linked site. The inclusion of any link does not imply endorsement by 90storezon of the site. Use of any such linked website is at the user's own risk.</p>
        </div>

        <div class="terms-section">
            <h2>7. Modifications</h2>
            <p>90storezon may revise these terms of service for its website at any time without notice. By using this website you are agreeing to be bound by the then current version of these terms of service.</p>
        </div>

        <div class="terms-section">
            <h2>8. Governing Law</h2>
            <p>These terms and conditions are governed by and construed in accordance with the laws and you irrevocably submit to the exclusive jurisdiction of the courts in that location.</p>
        </div>

        <div class="terms-section">
            <h2>9. User Conduct</h2>
            <p>You agree not to use the Website:</p>
            <ul>
                <li>In any way that violates any applicable law or regulation</li>
                <li>To engage in any conduct that restricts or inhibits anyone's use of the Website</li>
                <li>To attempt to gain unauthorized access to any portion of the Website</li>
                <li>To use any device or process to interfere with the proper working of the Website</li>
            </ul>
        </div>

        <div class="terms-section">
            <h2>10. Termination</h2>
            <p>We may terminate or suspend access to our Service immediately, without prior notice or liability, for any reason whatsoever, including without limitation if you breach the Terms.</p>
        </div>

        <div class="terms-notice">
            <h3>Important Notice</h3>
            <p>The calculators provided on 90storezon are for informational purposes only. The results should not be considered as professional advice. Always consult with qualified professionals for financial, medical, legal, or other professional advice.</p>
        </div>
    </div>
</div>

<style>
.terms-content {
    max-width: 900px;
    margin: 0 auto;
    background: white;
    padding: 40px;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
}

.terms-section {
    margin-bottom: 35px;
    padding-bottom: 25px;
    border-bottom: 1px solid #f0f0f0;
}

.terms-section:last-child {
    border-bottom: none;
    margin-bottom: 0;
}

.terms-section h2 {
    color: #333;
    margin-bottom: 15px;
    font-size: 1.4rem;
}

.terms-section p {
    line-height: 1.7;
    color: #555;
    margin-bottom: 15px;
}

.terms-section ul {
    color: #555;
    line-height: 1.7;
    padding-left: 20px;
}

.terms-section li {
    margin-bottom: 8px;
}

.terms-notice {
    background: #fff3cd;
    border: 1px solid #ffeaa7;
    padding: 25px;
    border-radius: 8px;
    margin-top: 30px;
}

.terms-notice h3 {
    color: #856404;
    margin-bottom: 15px;
    font-size: 1.3rem;
}

.terms-notice p {
    color: #856404;
    line-height: 1.6;
    margin: 0;
}

@media (max-width: 768px) {
    .terms-content {
        padding: 25px;
    }
    
    .terms-section {
        margin-bottom: 25px;
        padding-bottom: 20px;
    }
    
    .terms-section h2 {
        font-size: 1.2rem;
    }
    
    .terms-notice {
        padding: 20px;
    }
}
</style>

<?php include '../footer.php'; ?>