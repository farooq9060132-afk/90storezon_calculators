<?php
// Include your website's header
include '../../header.php';
?>

<style>
/* Slope Calculator Styles */
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

.tabs {
    display: flex;
    border-bottom: 1px solid #dadce0;
    margin-bottom: 30px;
}

.tab {
    padding: 12px 24px;
    cursor: pointer;
    font-weight: 500;
    color: #5f6368;
    border-bottom: 3px solid transparent;
    transition: all 0.3s ease;
}

.tab.active {
    color: #0052FF;
    border-bottom: 3px solid #0052FF;
}

.tab:hover:not(.active) {
    color: #202124;
    background: #f8f9fa;
}

.tab-content {
    display: none;
}

.tab-content.active {
    display: block;
}

.slope-form {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 25px;
    margin-bottom: 30px;
}

.input-group {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
}

.input-group label {
    min-width: 150px;
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
    border: 1px solid #dadce0;
}

.result-title {
    font-size: 20px;
    color: #202124;
    margin-bottom: 15px;
}

.result-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-top: 20px;
}

.result-item {
    background: #ffffff;
    border: 1px solid #dadce0;
    border-radius: 6px;
    padding: 15px;
    text-align: center;
}

.result-label {
    font-size: 15px;
    color: #5f6368;
    margin-bottom: 8px;
}

.result-value {
    font-size: 18px;
    font-weight: bold;
    color: #0052FF;
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

.formula-section {
    background: #f8f9fa;
    border-radius: 8px;
    padding: 20px;
    margin: 20px 0;
}

.formula {
    font-family: monospace;
    font-size: 18px;
    text-align: center;
    margin: 15px 0;
    padding: 15px;
    background: #ffffff;
    border: 1px solid #dadce0;
    border-radius: 6px;
}

.example-section {
    background: #e8f0fe;
    border-radius: 8px;
    padding: 20px;
    margin: 20px 0;
}

.example-section h4 {
    margin-top: 0;
    margin-bottom: 15px;
    color: #202124;
}

.slope-diagram {
    text-align: center;
    margin: 30px 0;
    padding: 20px;
    background: #f8f9fa;
    border-radius: 8px;
}

.slope-diagram img {
    max-width: 100%;
    height: auto;
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

/* Desktop Styles */
@media (min-width: 769px) {
    .slope-form {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .result-grid {
        grid-template-columns: repeat(4, 1fr);
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
    
    .tabs {
        flex-wrap: wrap;
    }
    
    .tab {
        padding: 10px 15px;
        font-size: 14px;
    }
    
    .slope-form {
        grid-template-columns: 1fr;
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
    
    .input-wrapper input {
        width: 100%;
        flex: 1;
    }
    
    .calculator-section, .content-section {
        padding: 20px;
    }
    
    .result-grid {
        grid-template-columns: 1fr 1fr;
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
    
    .tab {
        padding: 8px 12px;
        font-size: 13px;
    }
    
    .input-group label {
        font-size: 15px;
    }
    
    .input-wrapper input {
        font-size: 15px;
        padding: 10px 12px;
    }
    
    .calculate-btn {
        width: 100%;
        padding: 12px;
        font-size: 15px;
    }
    
    .result-grid {
        grid-template-columns: 1fr;
    }
    
    .formula {
        font-size: 16px;
        padding: 10px;
    }
}
</style>

<div class="calculator-container">
    <div class="breadcrumb">
        <a href="/">Home</a>
        <span>/</span>
        <a href="/calculators/">Calculators</a>
        <span>/</span>
        <a href="/calculators/math/">Math</a>
        <span>/</span>
        <span>Slope Calculator</span>
    </div>
    
    <h1 class="calculator-title">Slope Calculator</h1>
    
    <div class="calculator-section">
        <p>By definition, the slope or gradient of a line describes its steepness, incline, or grade.</p>
        
        <div class="formula-section">
            <div class="formula">m = (y₂ - y₁)/(x₂ - x₁) = tan(θ)</div>
        </div>
        
        <div class="slope-diagram">
            <p><em>slope of a line</em></p>
        </div>
        
        <p>Modify the values and click the calculate button to use</p>
        
        <div class="tabs">
            <div class="tab active" data-tab="points">If the 2 Points are Known</div>
            <div class="tab" data-tab="slope">If 1 Point and the Slope are Known</div>
        </div>
        
        <div class="tab-content active" id="points-tab">
            <h3>If the 2 Points are Known</h3>
            
            <div class="slope-form">
                <div class="input-group">
                    <label>X₁</label>
                    <div class="input-wrapper">
                        <input type="number" id="x1" value="1" step="any">
                    </div>
                </div>
                
                <div class="input-group">
                    <label>Y₁</label>
                    <div class="input-wrapper">
                        <input type="number" id="y1" value="1" step="any">
                    </div>
                </div>
                
                <div class="input-group">
                    <label>X₂</label>
                    <div class="input-wrapper">
                        <input type="number" id="x2" value="2" step="any">
                    </div>
                </div>
                
                <div class="input-group">
                    <label>Y₂</label>
                    <div class="input-wrapper">
                        <input type="number" id="y2" value="2" step="any">
                    </div>
                </div>
            </div>
            
            <button class="calculate-btn" onclick="calculateFromPoints()">Calculate</button>
        </div>
        
        <div class="tab-content" id="slope-tab">
            <h3>If 1 Point and the Slope are Known</h3>
            
            <div class="slope-form">
                <div class="input-group">
                    <label>X₁ =</label>
                    <div class="input-wrapper">
                        <input type="number" id="point-x" value="1" step="any">
                    </div>
                </div>
                
                <div class="input-group">
                    <label>Y₁ =</label>
                    <div class="input-wrapper">
                        <input type="number" id="point-y" value="1" step="any">
                    </div>
                </div>
                
                <div class="input-group">
                    <label>distance (d) =</label>
                    <div class="input-wrapper">
                        <input type="number" id="distance" value="5" step="any">
                    </div>
                </div>
                
                <div class="input-group">
                    <label>slope (m) =</label>
                    <div class="input-wrapper">
                        <input type="number" id="slope" value="0.75" step="any">
                    </div>
                </div>
                
                <div class="input-group">
                    <label>OR angle of incline (θ) =</label>
                    <div class="input-wrapper">
                        <input type="number" id="angle" value="" step="any">
                        <span>°</span>
                    </div>
                </div>
            </div>
            
            <button class="calculate-btn" onclick="calculateFromSlope()">Calculate</button>
        </div>
        
        <div id="slope-results" class="results-section" style="display: none;">
            <h3 class="result-title">Results</h3>
            <div class="result-grid">
                <div class="result-item">
                    <div class="result-label">Slope (m)</div>
                    <div class="result-value" id="result-slope">0.00</div>
                </div>
                <div class="result-item">
                    <div class="result-label">Distance (d)</div>
                    <div class="result-value" id="result-distance">0.00</div>
                </div>
                <div class="result-item">
                    <div class="result-label">Angle (θ)</div>
                    <div class="result-value" id="result-angle">0.00°</div>
                </div>
                <div class="result-item">
                    <div class="result-label">Direction</div>
                    <div class="result-value" id="result-direction">-</div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="content-section">
        <h2>About Slope</h2>
        <p>
            Slope, sometimes referred to as gradient in mathematics, is a number that measures the steepness and direction 
            of a line, or a section of a line connecting two points, and is usually denoted by m. Generally, a line's 
            steepness is measured by the absolute value of its slope, m. The larger the value is, the steeper the line. 
            Given m, it is possible to determine the direction of the line that m describes based on its sign and value:
        </p>
        
        <ul>
            <li>A line is increasing, and goes upwards from left to right when m > 0</li>
            <li>A line is decreasing, and goes downwards from left to right when m < 0</li>
            <li>A line has a constant slope, and is horizontal when m = 0</li>
            <li>A vertical line has an undefined slope, since it would result in a fraction with 0 as the denominator.</li>
        </ul>
        
        <p>
            Slope is essentially the change in height over the change in horizontal distance, and is often referred to as 
            "rise over run." It has applications in gradients in geography as well as civil engineering, such as the building 
            of roads. In the case of a road, the "rise" is the change in altitude, while the "run" is the difference in 
            distance between two fixed points, as long as the distance for the measurement is not large enough that the 
            earth's curvature should be considered as a factor. The slope is represented mathematically as:
        </p>
        
        <div class="formula-section">
            <div class="formula">m = (y₂ - y₁)/(x₂ - x₁)</div>
        </div>
        
        <p>
            In the equation above, y₂ - y₁ = Δy, or vertical change, while x₂ - x₁ = Δx, or horizontal change, as shown 
            in the graph provided. It can also be seen that Δx and Δy are line segments that form a right triangle with 
            hypotenuse d, with d being the distance between the points (x₁, y₁) and (x₂, y₂). Since Δx and Δy form a 
            right triangle, it is possible to calculate d using the Pythagorean theorem. Refer to the Triangle Calculator 
            for more detail on the Pythagorean theorem as well as how to calculate the angle of incline θ provided in the 
            calculator above. Briefly:
        </p>
        
        <div class="formula-section">
            <div class="formula">d = √[(x₂ - x₁)² + (y₂ - y₁)²]</div>
        </div>
        
        <p>
            The above equation is the Pythagorean theorem at its root, where the hypotenuse d has already been solved for, 
            and the other two sides of the triangle are determined by subtracting the two x and y values given by two points. 
            Given two points, it is possible to find θ using the following equation:
        </p>
        
        <div class="formula-section">
            <div class="formula">m = tan(θ)</div>
        </div>
        
        <div class="example-section">
            <h4>Example:</h4>
            <p>Given the points (3,4) and (6,8) find the slope of the line, the distance between the two points, and the angle of incline:</p>
            
            <div class="formula">m = (8 - 4)/(6 - 3) = 4/3</div>
            <div class="formula">d = √[(6 - 3)² + (8 - 4)²] = 5</div>
            <div class="formula">4/3 = tan(θ)<br>θ = tan⁻¹(4/3) = 53.13°</div>
        </div>
        
        <h3>Advanced Applications</h3>
        <p>
            While this is beyond the scope of this calculator, aside from its basic linear use, the concept of a slope is 
            important in differential calculus. For non-linear functions, the rate of change of a curve varies, and the 
            derivative of a function at a given point is the rate of change of the function, represented by the slope of 
            the line tangent to the curve at that point.
        </p>
    </div>
</div>

<script>
// Tab switching functionality
document.querySelectorAll('.tab').forEach(tab => {
    tab.addEventListener('click', function() {
        // Remove active class from all tabs
        document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
        // Add active class to clicked tab
        this.classList.add('active');
        
        // Hide all tab contents
        document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));
        
        // Show the selected tab content
        const tabType = this.getAttribute('data-tab');
        document.getElementById(`${tabType}-tab`).classList.add('active');
    });
});

// Calculate slope from two points
function calculateFromPoints() {
    const x1 = parseFloat(document.getElementById('x1').value);
    const y1 = parseFloat(document.getElementById('y1').value);
    const x2 = parseFloat(document.getElementById('x2').value);
    const y2 = parseFloat(document.getElementById('y2').value);
    
    if (isNaN(x1) || isNaN(y1) || isNaN(x2) || isNaN(y2)) {
        alert("Please enter valid coordinates.");
        return;
    }
    
    // Check for vertical line (undefined slope)
    if (x2 === x1) {
        document.getElementById('result-slope').textContent = 'Undefined';
        document.getElementById('result-direction').textContent = 'Vertical';
    } else {
        // Calculate slope
        const slope = (y2 - y1) / (x2 - x1);
        document.getElementById('result-slope').textContent = slope.toFixed(2);
        
        // Determine direction
        if (slope > 0) {
            document.getElementById('result-direction').textContent = 'Increasing';
        } else if (slope < 0) {
            document.getElementById('result-direction').textContent = 'Decreasing';
        } else {
            document.getElementById('result-direction').textContent = 'Horizontal';
        }
    }
    
    // Calculate distance
    const distance = Math.sqrt(Math.pow(x2 - x1, 2) + Math.pow(y2 - y1, 2));
    document.getElementById('result-distance').textContent = distance.toFixed(2);
    
    // Calculate angle
    const angle = Math.atan2(y2 - y1, x2 - x1) * 180 / Math.PI;
    document.getElementById('result-angle').textContent = angle.toFixed(2) + '°';
    
    // Show results
    document.getElementById('slope-results').style.display = 'block';
}

// Calculate from slope and point
function calculateFromSlope() {
    const pointX = parseFloat(document.getElementById('point-x').value);
    const pointY = parseFloat(document.getElementById('point-y').value);
    const distance = parseFloat(document.getElementById('distance').value);
    const slope = document.getElementById('slope').value !== '' ? parseFloat(document.getElementById('slope').value) : null;
    const angleInput = document.getElementById('angle').value !== '' ? parseFloat(document.getElementById('angle').value) : null;
    
    if (isNaN(pointX) || isNaN(pointY) || isNaN(distance)) {
        alert("Please enter valid values for point coordinates and distance.");
        return;
    }
    
    let angleRad, calculatedSlope;
    
    if (slope !== null) {
        calculatedSlope = slope;
        angleRad = Math.atan(slope);
    } else if (angleInput !== null) {
        angleRad = angleInput * Math.PI / 180;
        calculatedSlope = Math.tan(angleRad);
    } else {
        alert("Please enter either slope or angle.");
        return;
    }
    
    // Display results
    document.getElementById('result-slope').textContent = calculatedSlope.toFixed(2);
    document.getElementById('result-distance').textContent = distance.toFixed(2);
    document.getElementById('result-angle').textContent = (angleRad * 180 / Math.PI).toFixed(2) + '°';
    
    // Determine direction
    if (calculatedSlope > 0) {
        document.getElementById('result-direction').textContent = 'Increasing';
    } else if (calculatedSlope < 0) {
        document.getElementById('result-direction').textContent = 'Decreasing';
    } else {
        document.getElementById('result-direction').textContent = 'Horizontal';
    }
    
    // Show results
    document.getElementById('slope-results').style.display = 'block';
}

// Initialize with sample calculation
document.addEventListener('DOMContentLoaded', function() {
    calculateFromPoints();
});
</script>

<?php
// Include your website's footer
include '../../footer.php';
?>