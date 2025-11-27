<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GPA Calculator</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>📊 GPA Calculator</h1>
        <div class="calculator">
            <div id="courses-container">
                <div class="course-entry">
                    <input type="text" placeholder="Course Name" class="course-name">
                    <select class="grade">
                        <option value="4.0">A (4.0)</option>
                        <option value="3.7">A- (3.7)</option>
                        <option value="3.3">B+ (3.3)</option>
                        <option value="3.0">B (3.0)</option>
                        <option value="2.7">B- (2.7)</option>
                        <option value="2.3">C+ (2.3)</option>
                        <option value="2.0">C (2.0)</option>
                        <option value="1.7">C- (1.7)</option>
                        <option value="1.3">D+ (1.3)</option>
                        <option value="1.0">D (1.0)</option>
                        <option value="0.0">F (0.0)</option>
                    </select>
                    <input type="number" placeholder="Credits" class="credits" min="1" max="5" value="3">
                </div>
            </div>
            
            <button id="add-course">+ Add Course</button>
            <button id="calculate-gpa">Calculate GPA</button>
            
            <div id="result" class="result"></div>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>