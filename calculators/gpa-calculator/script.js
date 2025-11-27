
document.addEventListener('DOMContentLoaded', function() {
    const coursesContainer = document.getElementById('courses-container');
    const addCourseBtn = document.getElementById('add-course');
    const calculateBtn = document.getElementById('calculate-gpa');
    const resultDiv = document.getElementById('result');

    // Add new course row
    addCourseBtn.addEventListener('click', function() {
        const courseEntry = document.createElement('div');
        courseEntry.className = 'course-entry';
        courseEntry.innerHTML = `
            <input type="text" placeholder="Course Name" class="course-name">
            <select class="course-type">
                <option value="regular">Regular</option>
                <option value="honors">Honors (+0.5)</option>
                <option value="ap">AP/IB (+1.0)</option>
            </select>
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
            <input type="number" placeholder="Credits" class="credits" min="1" max="5" value="1">
            <button type="button" class="delete-course">🗑️</button>
        `;
        coursesContainer.appendChild(courseEntry);

        // Add delete functionality
        courseEntry.querySelector('.delete-course').addEventListener('click', function() {
            courseEntry.remove();
        });
    });

    // Calculate Weighted GPA
    calculateBtn.addEventListener('click', function() {
        const courses = document.querySelectorAll('.course-entry');
        let totalWeightedPoints = 0;
        let totalUnweightedPoints = 0;
        let totalCredits = 0;
        let hasError = false;

        courses.forEach(course => {
            const baseGrade = parseFloat(course.querySelector('.grade').value);
            const courseType = course.querySelector('.course-type').value;
            const credits = parseFloat(course.querySelector('.credits').value);
            const courseName = course.querySelector('.course-name').value;

            if (!courseName) {
                alert('Please enter course name for all courses');
                hasError = true;
                return;
            }

            if (isNaN(credits) || credits <= 0) {
                alert('Please enter valid credits for all courses');
                hasError = true;
                return;
            }

            // Calculate weighted grade based on course type
            let weightedGrade = baseGrade;
            if (courseType === 'honors') {
                weightedGrade += 0.5;
            } else if (courseType === 'ap') {
                weightedGrade += 1.0;
            }

            // Cap weighted grade at 4.0 for regular scale
            weightedGrade = Math.min(weightedGrade, 4.0);

            totalWeightedPoints += weightedGrade * credits;
            totalUnweightedPoints += baseGrade * credits;
            totalCredits += credits;
        });

        if (hasError) return;

        if (totalCredits === 0) {
            resultDiv.textContent = 'Please add at least one course';
            resultDiv.className = 'result error';
            resultDiv.style.display = 'block';
            return;
        }

        const weightedGPA = totalWeightedPoints / totalCredits;
        const unweightedGPA = totalUnweightedPoints / totalCredits;

        resultDiv.innerHTML = `
            <div>📊 Your Weighted GPA: <strong>${weightedGPA.toFixed(2)} / 4.0</strong></div>
            <div>📈 Your Unweighted GPA: ${unweightedGPA.toFixed(2)} / 4.0</div>
            <div class="gpa-breakdown">
                * Weighted GPA includes bonus points for Honors/AP courses
            </div>
        `;
        resultDiv.className = 'result success';
        resultDiv.style.display = 'block';
    });
});