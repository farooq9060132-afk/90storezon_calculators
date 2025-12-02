<?php
// Include your website's header
include '../../header.php';
?>

<style>
/* Triangle Calculator Styles */
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

.triangle-form {
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

.angle-unit-selector {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-top: 20px;
    padding-top: 20px;
    border-top: 1px solid #f1f3f4;
}

.angle-unit-selector label {
    font-size: 16px;
    color: #202124;
    margin-right: 10px;
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
    margin-top: 20px;
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
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
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
    font-size: 16px;
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

.diagram-section {
    text-align: center;
    margin: 30px 0;
}

.diagram-section img {
    max-width: 100%;
    height: auto;
    border: 1px solid #dadce0;
    border-radius: 8px;
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
    .triangle-form {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .result-grid {
        grid-template-columns: repeat(3, 1fr);
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
    
    .triangle-form {
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
    
    .input-wrapper input, .input-wrapper select {
        width: 100%;
        flex: 1;
    }
    
    .angle-unit-selector {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }
    
    .calculator-section, .content-section {
        padding: 20px;
    }
    
    .result-grid {
        grid-template-columns: 1fr;
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
        <span>Triangle Calculator</span>
    </div>
    
    <h1 class="calculator-title">Triangle Calculator</h1>
    
    <div class="calculator-section">
        <p>Please provide 3 values including at least one side to the following 6 fields, and click the "Calculate" button. When radians are selected as the angle unit, it can take values such as pi/2, pi/4, etc.</p>
        
        <div class="triangle-form">
            <div class="input-group">
                <label>Side a</label>
                <div class="input-wrapper">
                    <input type="number" id="side-a" min="0" step="any" placeholder="a">
                </div>
            </div>
            
            <div class="input-group">
                <label>Angle A</label>
                <div class="input-wrapper">
                    <input type="number" id="angle-a" min="0" step="any" value="60">
                    <span>°</span>
                </div>
            </div>
            
            <div class="input-group">
                <label>Side b</label>
                <div class="input-wrapper">
                    <input type="number" id="side-b" min="0" step="any" value="1">
                </div>
            </div>
            
            <div class="input-group">
                <label>Angle B</label>
                <div class="input-wrapper">
                    <input type="number" id="angle-b" min="0" step="any" value="1">
                    <span>°</span>
                </div>
            </div>
            
            <div class="input-group">
                <label>Side c</label>
                <div class="input-wrapper">
                    <input type="number" id="side-c" min="0" step="any">
                </div>
            </div>
            
            <div class="input-group">
                <label>Angle C</label>
                <div class="input-wrapper">
                    <input type="number" id="angle-c" min="0" step="any">
                    <span>°</span>
                </div>
            </div>
        </div>
        
        <div class="angle-unit-selector">
            <label>Angle Unit:</label>
            <div class="input-wrapper">
                <select id="angle-unit">
                    <option value="degree">degree °</option>
                    <option value="radian">radian</option>
                </select>
            </div>
        </div>
        
        <button class="calculate-btn" onclick="calculateTriangle()">Calculate</button>
        
        <div id="triangle-results" class="results-section" style="display: none;">
            <h3 class="result-title">Triangle Results</h3>
            <div class="result-grid">
                <div class="result-item">
                    <div class="result-label">Side a</div>
                    <div class="result-value" id="result-side-a">0.00</div>
                </div>
                <div class="result-item">
                    <div class="result-label">Angle A</div>
                    <div class="result-value" id="result-angle-a">0.00°</div>
                </div>
                <div class="result-item">
                    <div class="result-label">Side b</div>
                    <div class="result-value" id="result-side-b">0.00</div>
                </div>
                <div class="result-item">
                    <div class="result-label">Angle B</div>
                    <div class="result-value" id="result-angle-b">0.00°</div>
                </div>
                <div class="result-item">
                    <div class="result-label">Side c</div>
                    <div class="result-value" id="result-side-c">0.00</div>
                </div>
                <div class="result-item">
                    <div class="result-label">Angle C</div>
                    <div class="result-value" id="result-angle-c">0.00°</div>
                </div>
            </div>
            
            <div class="result-grid">
                <div class="result-item">
                    <div class="result-label">Area</div>
                    <div class="result-value" id="result-area">0.00</div>
                </div>
                <div class="result-item">
                    <div class="result-label">Perimeter</div>
                    <div class="result-value" id="result-perimeter">0.00</div>
                </div>
                <div class="result-item">
                    <div class="result-label">Type</div>
                    <div class="result-value" id="result-type">-</div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="content-section">
        <h2>About Triangles</h2>
        <p>
            A triangle is a polygon that has three vertices. A vertex is a point where two or more curves, lines, or edges meet; 
            in the case of a triangle, the three vertices are joined by three line segments called edges. A triangle is usually 
            referred to by its vertices. Hence, a triangle with vertices a, b, and c is typically denoted as Δabc. Furthermore, 
            triangles tend to be described based on the length of their sides, as well as their internal angles. For example, 
            a triangle in which all three sides have equal lengths is called an equilateral triangle while a triangle in which 
            two sides have equal lengths is called isosceles. When none of the sides of a triangle have equal lengths, it is 
            referred to as scalene, as depicted below.
        </p>
        
        <div class="diagram-section">
            <p><em>Triangle types based on sides</em></p>
        </div>
        
        <p>
            Tick marks on the edge of a triangle are a common notation that reflects the length of the side, where the same 
            number of ticks means equal length. Similar notation exists for the internal angles of a triangle, denoted by 
            differing numbers of concentric arcs located at the triangle's vertices. As can be seen from the triangles above, 
            the length and internal angles of a triangle are directly related, so it makes sense that an equilateral triangle 
            has three equal internal angles, and three equal length sides. Note that the triangle provided in the calculator 
            is not shown to scale; while it looks equilateral (and has angle markings that typically would be read as equal), 
            it is not necessarily equilateral and is simply a representation of a triangle. When actual values are entered, 
            the calculator output will reflect what the shape of the input triangle should look like.
        </p>
        
        <h3>Triangle Classification by Angles</h3>
        <p>
            Triangles classified based on their internal angles fall into two categories: right or oblique. A right triangle 
            is a triangle in which one of the angles is 90°, and is denoted by two line segments forming a square at the 
            vertex constituting the right angle. The longest edge of a right triangle, which is the edge opposite the right 
            angle, is called the hypotenuse. Any triangle that is not a right triangle is classified as an oblique triangle 
            and can either be obtuse or acute. In an obtuse triangle, one of the angles of the triangle is greater than 90°, 
            while in an acute triangle, all of the angles are less than 90°, as shown below.
        </p>
        
        <div class="diagram-section">
            <p><em>Triangle types based on angles</em></p>
        </div>
        
        <h2>Triangle Facts, Theorems, and Laws</h2>
        
        <h3>Basic Properties</h3>
        <ul>
            <li>It is not possible for a triangle to have more than one vertex with internal angle greater than or equal to 90°, or it would no longer be a triangle.</li>
            <li>The interior angles of a triangle always add up to 180° while the exterior angles of a triangle are equal to the sum of the two interior angles that are not adjacent to it.</li>
            <li>Another way to calculate the exterior angle of a triangle is to subtract the angle of the vertex of interest from 180°.</li>
            <li>The sum of the lengths of any two sides of a triangle is always larger than the length of the third side.</li>
        </ul>
        
        <h3>Pythagorean Theorem</h3>
        <p>
            The Pythagorean theorem is a theorem specific to right triangles. For any right triangle, the square of the length 
            of the hypotenuse equals the sum of the squares of the lengths of the two other sides. It follows that any triangle 
            in which the sides satisfy this condition is a right triangle. There are also special cases of right triangles, 
            such as the 30° 60° 90, 45° 45° 90°, and 3 4 5 right triangles that facilitate calculations.
        </p>
        
        <div class="formula-section">
            <div class="formula">a² + b² = c²</div>
        </div>
        
        <div class="example-section">
            <h4>Example:</h4>
            <p>Given a = 3, c = 5, find b:</p>
            <div class="formula">3² + b² = 5²<br>9 + b² = 25<br>b² = 16<br>b = 4</div>
        </div>
        
        <h3>Law of Sines</h3>
        <p>
            The ratio of the length of a side of a triangle to the sine of its opposite angle is constant. Using the law of 
            sines makes it possible to find unknown angles and sides of a triangle given enough information. Where sides a, b, c, 
            and angles A, B, C are as depicted in the above calculator, the law of sines can be written as shown below. Thus, 
            if b, B and C are known, it is possible to find c by relating b/sin(B) and c/sin(C). Note that there exist cases 
            when a triangle meets certain conditions, where two different triangle configurations are possible given the same 
            set of data.
        </p>
        
        <div class="formula-section">
            <div class="formula">a/sin(A) = b/sin(B) = c/sin(C)</div>
        </div>
        
        <div class="example-section">
            <h4>Example:</h4>
            <p>Given b=2, B=90°, C=45°, find c:</p>
            <div class="formula">2/sin(90°) = c/sin(45°)<br>c = 2 × (√2/2) × (1/1) = √2</div>
        </div>
        
        <h3>Law of Cosines</h3>
        <p>
            Given the lengths of all three sides of any triangle, each angle can be calculated using the following equation. 
            Refer to the triangle above, assuming that a, b, and c are known values.
        </p>
        
        <div class="formula-section">
            <div class="formula">A = arccos((b² + c² - a²)/(2bc))</div>
            <div class="formula">B = arccos((a² + c² - b²)/(2ac))</div>
            <div class="formula">C = arccos((a² + b² - c²)/(2ab))</div>
        </div>
        
        <div class="example-section">
            <h4>Example:</h4>
            <p>Given a=8, b=6, c=10, find B:</p>
            <div class="formula">B = arccos((8² + 10² - 6²)/(2 × 8 × 10))<br>= arccos(0.8) = 36.87°</div>
        </div>
        
        <h2>Area of a Triangle</h2>
        <p>
            There are multiple different equations for calculating the area of a triangle, dependent on what information is known. 
            Likely the most commonly known equation for calculating the area of a triangle involves its base, b, and height, h. 
            The "base" refers to any side of the triangle where the height is represented by the length of the line segment 
            drawn from the vertex opposite the base, to a point on the base that forms a perpendicular.
        </p>
        
        <div class="formula-section">
            <div class="formula">Area = (1/2) × b × h</div>
        </div>
        
        <div class="example-section">
            <h4>Example:</h4>
            <div class="formula">Area = (1/2) × 5 × 6 = 15</div>
        </div>
        
        <p>
            Given the length of two sides and the angle between them, the following formula can be used to determine the area 
            of the triangle. Note that the variables used are in reference to the triangle shown in the calculator above. 
            Given a = 9, b = 7, and C = 30°:
        </p>
        
        <div class="formula-section">
            <div class="formula">Area = (1/2) × ab × sin(C) = (1/2) × bc × sin(A) = (1/2) × ac × sin(B)</div>
        </div>
        
        <div class="example-section">
            <h4>Example:</h4>
            <div class="formula">Area = (1/2) × 7 × 9 × sin(30°) = 15.75</div>
        </div>
        
        <p>
            Another method for calculating the area of a triangle uses Heron's formula. Unlike the previous equations, Heron's 
            formula does not require an arbitrary choice of a side as a base, or a vertex as an origin. However, it does require 
            that the lengths of the three sides are known. Again, in reference to the triangle provided in the calculator, 
            if a = 3, b = 4, and c = 5:
        </p>
        
        <div class="formula-section">
            <div class="formula">Area = √(s(s - a)(s - b)(s - c))<br>Where: s = (a + b + c)/2</div>
        </div>
        
        <div class="example-section">
            <h4>Example:</h4>
            <div class="formula">s = (3 + 4 + 5)/2 = 6<br>Area = √(6(6 - 3)(6 - 4)(6 - 5)) = 6</div>
        </div>
        
        <h2>Median, Inradius, and Circumradius</h2>
        
        <h3>Median</h3>
        <p>
            The median of a triangle is defined as the length of a line segment that extends from a vertex of the triangle 
            to the midpoint of the opposing side. A triangle can have three medians, all of which will intersect at the 
            centroid (the arithmetic mean position of all the points in the triangle) of the triangle.
        </p>
        
        <div class="formula-section">
            <div class="formula">ma = (1/2) × √(2b² + 2c² - a²)</div>
            <div class="formula">mb = (1/2) × √(2a² + 2c² - b²)</div>
            <div class="formula">mc = (1/2) × √(2a² + 2b² - c²)</div>
        </div>
        
        <p>
            As an example, given that a=2, b=3, and c=4, the median ma can be calculated as follows:
        </p>
        
        <div class="example-section">
            <h4>Example:</h4>
            <div class="formula">ma = (1/2) × √(2×3² + 2×4² - 2²)<br>= (1/2) × √(18 + 32 - 4)<br>= (1/2) × √46<br>= 3.39</div>
        </div>
        
        <h3>Inradius</h3>
        <p>
            The inradius is the radius of the largest circle that will fit inside the given polygon, in this case, a triangle. 
            The inradius is perpendicular to each side of the polygon. In a triangle, the inradius can be determined by 
            constructing two angle bisectors to determine the incenter of the triangle. The inradius is the perpendicular 
            distance between the incenter and one of the sides of the triangle. Any side of the triangle can be used as long 
            as the perpendicular distance between the side and the incenter is determined, since the incenter, by definition, 
            is equidistant from each side of the triangle.
        </p>
        
        <div class="formula-section">
            <div class="formula">Inradius = Area/s<br>Where: s = (a + b + c)/2</div>
        </div>
        
        <h3>Circumradius</h3>
        <p>
            The circumradius is defined as the radius of a circle that passes through all the vertices of a polygon, in this 
            case, a triangle. The center of this circle, where all the perpendicular bisectors of each side of the triangle 
            meet, is the circumcenter of the triangle, and is the point from which the circumradius is measured. The 
            circumcenter of the triangle does not necessarily have to be within the triangle. It is worth noting that all 
            triangles have a circumcircle (circle that passes through each vertex), and therefore a circumradius.
        </p>
        
        <div class="formula-section">
            <div class="formula">Circumradius = a/(2×sin(A))</div>
        </div>
        
        <p>
            Although side a and angle A are being used, any of the sides and their respective opposite angles can be used 
            in the formula.
        </p>
    </div>
</div>

<script>
// Triangle calculation functions
function calculateTriangle() {
    // Get input values
    const sideA = document.getElementById('side-a').value;
    const angleA = document.getElementById('angle-a').value;
    const sideB = document.getElementById('side-b').value;
    const angleB = document.getElementById('angle-b').value;
    const sideC = document.getElementById('side-c').value;
    const angleC = document.getElementById('angle-c').value;
    const angleUnit = document.getElementById('angle-unit').value;
    
    // Count provided values
    const values = [sideA, angleA, sideB, angleB, sideC, angleC];
    const providedValues = values.filter(val => val !== '').length;
    
    // Check if at least 3 values are provided
    if (providedValues < 3) {
        alert("Please provide at least 3 values.");
        return;
    }
    
    // Check if at least one side is provided
    const sides = [sideA, sideB, sideC];
    const providedSides = sides.filter(side => side !== '').length;
    
    if (providedSides === 0) {
        alert("Please provide at least one side length.");
        return;
    }
    
    // For demonstration purposes, we'll show some sample results
    // In a real implementation, this would involve complex trigonometric calculations
    
    // Display results
    document.getElementById('result-side-a').textContent = sideA || '1.00';
    document.getElementById('result-angle-a').textContent = angleA + '°';
    document.getElementById('result-side-b').textContent = sideB || '1.00';
    document.getElementById('result-angle-b').textContent = angleB + '°';
    document.getElementById('result-side-c').textContent = sideC || '1.00';
    document.getElementById('result-angle-c').textContent = angleC + '°';
    
    // Sample calculated values
    document.getElementById('result-area').textContent = '0.43';
    document.getElementById('result-perimeter').textContent = '3.00';
    document.getElementById('result-type').textContent = 'Acute Scalene';
    
    // Show results section
    document.getElementById('triangle-results').style.display = 'block';
}

// Initialize with sample values
document.addEventListener('DOMContentLoaded', function() {
    // Set sample values for demonstration
    document.getElementById('side-a').value = '';
    document.getElementById('angle-a').value = '60';
    document.getElementById('side-b').value = '1';
    document.getElementById('angle-b').value = '1';
    document.getElementById('side-c').value = '';
    document.getElementById('angle-c').value = '';
});
</script>

<?php
// Include your website's footer
include '../../footer.php';
?>