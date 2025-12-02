<?php
// Include your website's header
include '../../header.php';
?>

<style>
/* BMI Calculator Styles */
.calculator-container {
    max-width: 1200px;
    margin: 30px auto;
    padding: 0 20px;
    font-family: Arial, sans-serif;
}

.breadcrumb {
    font-size: 14px;
    color: #5f6368;
    margin-bottom: 20px;
}

.breadcrumb a {
    color: #0052FF;
    text-decoration: none;
}

.breadcrumb a:hover {
    text-decoration: underline;
}

.breadcrumb span {
    color: #5f6368;
    margin: 0 5px;
}

.calculator-title {
    font-size: 32px;
    font-weight: bold;
    color: #202124;
    margin-bottom: 20px;
}

.calculator-description {
    font-size: 16px;
    color: #5f6368;
    line-height: 1.6;
    margin-bottom: 30px;
}

.calculator-section {
    background: #ffffff;
    border: 1px solid #dadce0;
    border-radius: 8px;
    padding: 30px;
    margin-bottom: 30px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.unit-tabs {
    display: flex;
    border-bottom: 1px solid #dadce0;
    margin-bottom: 25px;
}

.unit-tab {
    padding: 12px 24px;
    cursor: pointer;
    font-weight: 500;
    color: #5f6368;
    border-bottom: 3px solid transparent;
    transition: all 0.3s ease;
}

.unit-tab.active {
    color: #0052FF;
    border-bottom: 3px solid #0052FF;
}

.unit-tab:hover:not(.active) {
    color: #202124;
    background: #f8f9fa;
}

.input-group {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
}

.input-group label {
    min-width: 120px;
    font-size: 16px;
    color: #202124;
    margin-right: 15px;
}

.input-wrapper {
    display: flex;
    align-items: center;
    gap: 10px;
}

.input-wrapper input {
    padding: 12px 15px;
    border: 1px solid #dadce0;
    border-radius: 4px;
    font-size: 16px;
    width: 100px;
}

.input-wrapper select {
    padding: 12px 15px;
    border: 1px solid #dadce0;
    border-radius: 4px;
    font-size: 16px;
    width: 100px;
    background: white;
}

.input-wrapper span {
    font-size: 16px;
    color: #5f6368;
}

.calculate-btn {
    background: #0052FF;
    color: white;
    border: none;
    border-radius: 6px;
    padding: 14px 28px;
    font-size: 16px;
    font-weight: 500;
    cursor: pointer;
    transition: background-color 0.2s ease;
    margin-top: 10px;
}

.calculate-btn:hover {
    background: #0041cc;
}

.results-section {
    background: #f8f9fa;
    border-radius: 8px;
    padding: 25px;
    margin-top: 30px;
    text-align: center;
    border: 1px solid #dadce0;
}

.result-title {
    font-size: 20px;
    color: #202124;
    margin-bottom: 15px;
}

.result-value {
    font-size: 28px;
    font-weight: bold;
    color: #0052FF;
    margin: 15px 0;
}

.result-message {
    font-size: 18px;
    color: #202124;
    margin: 15px 0;
    font-weight: 500;
}

.healthy-range {
    background: #e8f0fe;
    border-radius: 6px;
    padding: 15px;
    margin: 20px 0;
    text-align: center;
}

.healthy-range p {
    margin: 0;
    font-size: 16px;
    color: #202124;
}

.note-section {
    background: #fff8e6;
    border-radius: 8px;
    padding: 20px;
    margin-top: 25px;
    border-left: 4px solid #ffc107;
}

.note-section p {
    margin: 0;
    font-size: 15px;
    color: #5f6368;
    line-height: 1.6;
}

.content-section {
    background: #ffffff;
    border: 1px solid #dadce0;
    border-radius: 8px;
    padding: 30px;
    margin-bottom: 30px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.content-section h2 {
    font-size: 24px;
    color: #202124;
    margin-top: 0;
    margin-bottom: 20px;
}

.content-section h3 {
    font-size: 20px;
    color: #202124;
    margin-top: 25px;
    margin-bottom: 15px;
}

.content-section p {
    font-size: 16px;
    color: #5f6368;
    line-height: 1.6;
    margin-bottom: 15px;
}

.content-section ul {
    padding-left: 20px;
    margin-bottom: 20px;
}

.content-section li {
    margin-bottom: 10px;
    line-height: 1.5;
}

.related-calculators {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
    margin-top: 20px;
}

.related-link {
    color: #0052FF;
    text-decoration: none;
    font-size: 16px;
    font-weight: 500;
}

.related-link:hover {
    text-decoration: underline;
}

.reference-section {
    background: #f8f9fa;
    border-radius: 8px;
    padding: 20px;
    margin-top: 25px;
}

.reference-section h3 {
    font-size: 18px;
    color: #202124;
    margin-top: 0;
    margin-bottom: 15px;
}

.reference-section ol {
    padding-left: 20px;
    margin: 0;
}

.reference-section li {
    margin-bottom: 10px;
    font-size: 15px;
    color: #5f6368;
    line-height: 1.5;
}

.reference-section li:last-child {
    margin-bottom: 0;
}

/* Desktop Styles */
@media (min-width: 769px) {
    .unit-tabs {
        display: flex;
    }
    
    .input-group {
        display: flex;
    }
    
    .input-wrapper input, .input-wrapper select {
        width: 100px;
    }
}

/* Mobile Styles */
@media (max-width: 768px) {
    .calculator-container {
        padding: 0 15px;
        margin: 20px auto;
    }
    
    .calculator-title {
        font-size: 28px;
    }
    
    .unit-tabs {
        flex-wrap: wrap;
    }
    
    .unit-tab {
        padding: 10px 15px;
        font-size: 14px;
    }
    
    .input-group {
        flex-direction: column;
        align-items: flex-start;
        margin-bottom: 25px;
    }
    
    .input-group label {
        margin-bottom: 8px;
        min-width: auto;
    }
    
    .input-wrapper {
        width: 100%;
    }
    
    .input-wrapper input, .input-wrapper select {
        width: 100%;
        flex: 1;
    }
    
    .calculator-section, .content-section {
        padding: 20px;
    }
    
    .results-section {
        padding: 20px;
    }
    
    .result-value {
        font-size: 24px;
    }
    
    .related-calculators {
        flex-direction: column;
        gap: 10px;
    }
}

@media (max-width: 480px) {
    .calculator-container {
        padding: 0 10px;
        margin: 15px auto;
    }
    
    .calculator-title {
        font-size: 24px;
    }
    
    .unit-tab {
        padding: 8px 12px;
        font-size: 13px;
    }
    
    .input-group label {
        font-size: 15px;
    }
    
    .input-wrapper input, .input-wrapper select {
        font-size: 15px;
        padding: 10px 12px;
    }
    
    .calculate-btn {
        width: 100%;
        padding: 12px;
        font-size: 15px;
    }
    
    .result-value {
        font-size: 22px;
    }
}
</style>

<div class="calculator-container">
    <div class="breadcrumb">
        <a href="/">Home</a>
        <span>/</span>
        <a href="/calculators/">Calculators</a>
        <span>/</span>
        <a href="/calculators/?category=health">Health & Fitness</a>
        <span>/</span>
        <span>Anorexic BMI Calculator</span>
    </div>
    
    <h1 class="calculator-title">Anorexic BMI Calculator</h1>
    
    <div class="calculator-section">
        <p>
            Anorexia nervosa, commonly referred to as anorexia, is an eating disorder characterized by low body weight, 
            a distortion of the perception of body image, and an obsessive fear of gaining weight. The disorder primarily 
            affects adolescent females (aged 16-26) and is far less prevalent in males – only approximately 10% of those 
            diagnosed with anorexia are male. Individuals with anorexia tend to control body weight through methods such 
            as voluntary starvation, excessive exercise, or other weight control measures, including the use of diet pills 
            or diuretics.
        </p>
        
        <p>
            There is no single test that can be used to diagnose anorexia, and it is often present in conjunction with 
            other mental health conditions such as depression, anxiety, and obsessive-compulsive disorder. Physical exams, 
            mental health assessments, blood tests, as well as standardized indexes like the body mass index (BMI) are 
            typically used to diagnose anorexia nervosa.
        </p>
        
        <p>
            As previously mentioned, the diagnosis of anorexia often requires multiple approaches, one of which is provided 
            by the BMI Calculator. That being said, a BMI below 17.5 in adults is one of the common physical characteristics 
            used to diagnose anorexia. There are also different tiers of anorexia based on BMI ranging from mild (&lt;17.5), 
            moderate (16-16.99), and severe (15-15.99), to extreme (&lt;15). A BMI below 13.5 can lead to organ failure, 
            while a BMI below 12 can be life-threatening. Note, however, that BMI alone is not enough to make a diagnosis 
            of anorexia and is solely a possible indicator.
        </p>
        
        <h2>Modify the values and click the calculate button to use</h2>
        
        <div class="unit-tabs">
            <div class="unit-tab active" data-unit="metric">Metric Units</div>
            <div class="unit-tab" data-unit="us">US Units</div>
        </div>
        
        <div class="unit-content" id="metric-content">
            <div class="input-group">
                <label>Age</label>
                <div class="input-wrapper">
                    <input type="number" id="age-metric" min="1" max="120" value="20">
                </div>
            </div>
            
            <div class="input-group">
                <label>Gender</label>
                <div class="input-wrapper">
                    <select id="gender-metric">
                        <option value="male">Male</option>
                        <option value="female" selected>Female</option>
                    </select>
                </div>
            </div>
            
            <div class="input-group">
                <label>Height</label>
                <div class="input-wrapper">
                    <input type="number" id="height-metric" min="50" max="250" value="180">
                    <span>cm</span>
                </div>
            </div>
            
            <div class="input-group">
                <label>Weight</label>
                <div class="input-wrapper">
                    <input type="number" id="weight-metric" min="10" max="300" value="60">
                    <span>kg</span>
                </div>
            </div>
            
            <button class="calculate-btn" onclick="calculateBMI('metric')">Calculate</button>
        </div>
        
        <div class="unit-content" id="us-content" style="display: none;">
            <div class="input-group">
                <label>Age</label>
                <div class="input-wrapper">
                    <input type="number" id="age-us" min="1" max="120" value="20">
                </div>
            </div>
            
            <div class="input-group">
                <label>Gender</label>
                <div class="input-wrapper">
                    <select id="gender-us">
                        <option value="male">Male</option>
                        <option value="female" selected>Female</option>
                    </select>
                </div>
            </div>
            
            <div class="input-group">
                <label>Height</label>
                <div class="input-wrapper">
                    <input type="number" id="feet-us" min="1" max="8" value="5">
                    <span>ft</span>
                    <input type="number" id="inches-us" min="0" max="11" value="11">
                    <span>in</span>
                </div>
            </div>
            
            <div class="input-group">
                <label>Weight</label>
                <div class="input-wrapper">
                    <input type="number" id="weight-us" min="20" max="600" value="132">
                    <span>lbs</span>
                </div>
            </div>
            
            <button class="calculate-btn" onclick="calculateBMI('us')">Calculate</button>
        </div>
        
        <div id="bmi-results" class="results-section" style="display: none;">
            <h3 class="result-title">Result</h3>
            <button class="calculate-btn" style="float: right; margin-top: -40px;">Save this calculation</button>
            <div class="result-value" id="bmi-value">BMI = 0.00 kg/m²</div>
            <div class="result-message" id="bmi-message">Your calculated BMI does not suggest anorexia nervosa.</div>
            
            <div class="healthy-range">
                <p>Healthy BMI range: 18.5 - 25 kg/m²</p>
            </div>
            
            <div class="note-section">
                <p><strong>The result above is not a diagnosis</strong></p>
                <p>
                    Low BMI or body weight is just one physical feature of anorexia. Not all low BMI or body weight is related to anorexia. 
                    More information about anorexia is available at <a href="https://en.wikipedia.org/wiki/Anorexia_nervosa" target="_blank">en.wikipedia.org/wiki/Anorexia_nervosa</a>.
                </p>
            </div>
        </div>
    </div>
    
    <div class="content-section">
        <h2>Related</h2>
        <div class="related-calculators">
            <a href="/calculators/anorexic-bmi-calculator/" class="related-link">BMI Calculator</a> |
            <a href="/calculators/" class="related-link">Body Fat Calculator</a> |
            <a href="/calculators/" class="related-link">Ideal Weight Calculator</a>
        </div>
        
        <div class="reference-section">
            <h3>Reference</h3>
            <ol>
                <li>CDC weight chart for boy between age 2 and 20</li>
                <li>CDC weight chart for girl between age 2 and 20</li>
            </ol>
        </div>
    </div>
</div>

<script>
// Unit tab switching functionality
document.querySelectorAll('.unit-tab').forEach(tab => {
    tab.addEventListener('click', function() {
        // Remove active class from all tabs
        document.querySelectorAll('.unit-tab').forEach(t => t.classList.remove('active'));
        // Add active class to clicked tab
        this.classList.add('active');
        
        // Hide all unit contents
        document.getElementById('metric-content').style.display = 'none';
        document.getElementById('us-content').style.display = 'none';
        
        // Show the selected unit content
        const unitType = this.getAttribute('data-unit');
        document.getElementById(`${unitType}-content`).style.display = 'block';
    });
});

// BMI Calculation
function calculateBMI(unit) {
    let height, weight;
    
    if (unit === 'metric') {
        height = parseFloat(document.getElementById('height-metric').value) / 100; // Convert cm to m
        weight = parseFloat(document.getElementById('weight-metric').value);
    } else {
        const feet = parseFloat(document.getElementById('feet-us').value);
        const inches = parseFloat(document.getElementById('inches-us').value);
        weight = parseFloat(document.getElementById('weight-us').value);
        
        // Convert feet and inches to meters
        height = ((feet * 12) + inches) * 0.0254;
        // Convert pounds to kg
        weight = weight * 0.453592;
    }
    
    if (isNaN(height) || isNaN(weight) || height <= 0 || weight <= 0) {
        alert("Please enter valid height and weight values.");
        return;
    }
    
    // Calculate BMI
    const bmi = weight / (height * height);
    
    // Display result
    document.getElementById('bmi-value').textContent = `BMI = ${bmi.toFixed(2)} kg/m²`;
    
    // Determine message based on BMI
    let message;
    if (bmi < 12) {
        message = "A BMI below 12 can be life-threatening. Please seek immediate medical attention.";
    } else if (bmi < 13.5) {
        message = "A BMI below 13.5 can lead to organ failure. Please consult with a healthcare professional.";
    } else if (bmi < 15) {
        message = "Extreme anorexia (BMI < 15). Please consult with a healthcare professional.";
    } else if (bmi < 16) {
        message = "Severe anorexia (BMI 15-15.99). Please consult with a healthcare professional.";
    } else if (bmi < 17.5) {
        message = "Moderate anorexia (BMI 16-16.99). Please consult with a healthcare professional.";
    } else if (bmi < 18.5) {
        message = "Mild anorexia (BMI < 17.5). Please consult with a healthcare professional.";
    } else {
        message = "Your calculated BMI does not suggest anorexia nervosa.";
    }
    
    document.getElementById('bmi-message').textContent = message;
    document.getElementById('bmi-results').style.display = 'block';
}
</script>

<?php
// Include your website's footer
include '../../footer.php';
?>