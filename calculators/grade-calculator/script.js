// DOM Elements and State
let currentTab = 'final-grade';

// Initialize the application
document.addEventListener('DOMContentLoaded', function() {
    initializeTabs();
    initializeCalculators();
    initializeDynamicForms();
});

// Tab functionality
function initializeTabs() {
    const tabButtons = document.querySelectorAll('.tab-button');
    const tabContents = document.querySelectorAll('.tab-content');

    tabButtons.forEach(button => {
        button.addEventListener('click', function() {
            const tabId = this.getAttribute('data-tab');
            
            // Update active tab button
            tabButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            
            // Update active tab content
            tabContents.forEach(content => content.classList.remove('active'));
            document.getElementById(tabId).classList.add('active');
            
            currentTab = tabId;
        });
    });
}

// Initialize calculator functionality
function initializeCalculators() {
    // Final Grade Calculator
    document.getElementById('finalGradeForm').addEventListener('submit', function(e) {
        e.preventDefault();
        calculateFinalGrade();
    });

    // GPA Calculator
    document.getElementById('calculateGPA').addEventListener('click', calculateGPA);

    // Grade Needed Calculator
    document.getElementById('gradeNeededForm').addEventListener('submit', function(e) {
        e.preventDefault();
        calculateGradeNeeded();
    });

    // Weighted Average Calculator
    document.getElementById('calculateWeighted').addEventListener('click', calculateWeightedAverage);
}

// Dynamic form elements
function initializeDynamicForms() {
    // Add course functionality
    document.getElementById('addCourse').addEventListener('click', addCourse);

    // Add assignment functionality
    document.getElementById('addAssignment').addEventListener('click', addAssignment);

    // Add initial courses and assignments
    addCourse();
    addAssignment();
}

// Final Grade Calculator
function calculateFinalGrade() {
    const currentGrade = parseFloat(document.getElementById('currentGrade').value);
    const targetGrade = parseFloat(document.getElementById('targetGrade').value);
    const finalWeight = parseFloat(document.getElementById('finalWeight').value);

    if (!validateInputs([currentGrade, targetGrade, finalWeight])) return;

    const currentWeight = 100 - finalWeight;
    const finalNeeded = (targetGrade - (currentGrade * currentWeight / 100)) / (finalWeight / 100);

    const resultElement = document.getElementById('finalGradeResult');
    const finalNeededElement = document.getElementById('finalNeeded');
    const currentSituationElement = document.getElementById('currentSituation');

    if (finalNeeded > 100) {
        finalNeededElement.textContent = `${Math.max(0, Math.round(finalNeeded))}%`;
        finalNeededElement.style.color = '#ef4444';
        currentSituationElement.textContent = 'Target not achievable';
        currentSituationElement.style.color = '#ef4444';
    } else if (finalNeeded < 0) {
        finalNeededElement.textContent = '0%';
        finalNeededElement.style.color = '#10b981';
        currentSituationElement.textContent = 'Target already achieved!';
        currentSituationElement.style.color = '#10b981';
    } else {
        finalNeededElement.textContent = `${Math.round(finalNeeded)}%`;
        finalNeededElement.style.color = '#f59e0b';
        currentSituationElement.textContent = 'Target achievable';
        currentSituationElement.style.color = '#f59e0b';
    }

    // Update breakdown visualization
    updateGradeBreakdown(currentGrade, finalNeeded, finalWeight);

    resultElement.style.display = 'block';
    resultElement.classList.add('fade-in');
}

function updateGradeBreakdown(currentGrade, finalNeeded, finalWeight) {
    const currentWeight = 100 - finalWeight;
    
    const currentGradeBar = document.getElementById('currentGradeBar');
    const finalGradeBar = document.getElementById('finalGradeBar');
    const currentGradeLabel = document.getElementById('currentGradeLabel');
    const finalNeededLabel = document.getElementById('finalNeededLabel');

    currentGradeBar.style.width = `${currentWeight}%`;
    finalGradeBar.style.width = `${finalWeight}%`;

    currentGradeLabel.textContent = `${currentGrade}%`;
    finalNeededLabel.textContent = `${Math.max(0, Math.min(100, Math.round(finalNeeded)))}%`;
}

// GPA Calculator
function addCourse() {
    const coursesList = document.getElementById('coursesList');
    const courseRow = document.createElement('div');
    courseRow.className = 'course-row';
    courseRow.innerHTML = `
        <input type="text" class="course-name" placeholder="Course Name" value="New Course">
        <select class="course-grade">
            <option value="4.0">A (90-100%)</option>
            <option value="3.7">A- (85-89%)</option>
            <option value="3.3">B+ (80-84%)</option>
            <option value="3.0">B (75-79%)</option>
            <option value="2.7">B- (70-74%)</option>
            <option value="2.3">C+ (65-69%)</option>
            <option value="2.0">C (60-64%)</option>
            <option value="1.7">C- (55-59%)</option>
            <option value="1.3">D+ (50-54%)</option>
            <option value="1.0">D (40-49%)</option>
            <option value="0.0">F (0-39%)</option>
        </select>
        <select class="course-credits">
            <option value="1">1 Credit</option>
            <option value="2">2 Credits</option>
            <option value="3" selected>3 Credits</option>
            <option value="4">4 Credits</option>
            <option value="5">5 Credits</option>
        </select>
        <button class="remove-course">🗑️</button>
    `;

    coursesList.appendChild(courseRow);

    // Add remove functionality
    courseRow.querySelector('.remove-course').addEventListener('click', function() {
        if (coursesList.children.length > 1) {
            courseRow.remove();
        }
    });
}

function calculateGPA() {
    const courseRows = document.querySelectorAll('.course-row');
    let totalPoints = 0;
    let totalCredits = 0;

    courseRows.forEach(row => {
        const grade = parseFloat(row.querySelector('.course-grade').value);
        const credits = parseFloat(row.querySelector('.course-credits').value);
        
        totalPoints += grade * credits;
        totalCredits += credits;
    });

    if (totalCredits === 0) {
        showError('Please add at least one course with credits.');
        return;
    }

    const gpa = totalPoints / totalCredits;
    const resultElement = document.getElementById('gpaResult');

    document.getElementById('gpaValue').textContent = gpa.toFixed(2);
    document.getElementById('totalCredits').textContent = totalCredits;
    document.getElementById('totalPoints').textContent = totalPoints.toFixed(1);

    // Determine academic standing
    const standingElement = document.getElementById('academicStanding');
    if (gpa >= 3.7) {
        standingElement.textContent = 'Excellent';
        standingElement.style.color = '#10b981';
    } else if (gpa >= 3.0) {
        standingElement.textContent = 'Good';
        standingElement.style.color = '#f59e0b';
    } else if (gpa >= 2.0) {
        standingElement.textContent = 'Satisfactory';
        standingElement.style.color = '#f59e0b';
    } else {
        standingElement.textContent = 'Needs Improvement';
        standingElement.style.color = '#ef4444';
    }

    // Update GPA scale visualization
    updateGPAScale(gpa);

    resultElement.style.display = 'block';
    resultElement.classList.add('fade-in');
}

function updateGPAScale(gpa) {
    const marker = document.getElementById('gpaMarker');
    const percentage = (gpa / 4.0) * 100;
    marker.style.left = `${Math.min(100, Math.max(0, percentage))}%`;
}

// Grade Needed Calculator
function calculateGradeNeeded() {
    const currentAverage = parseFloat(document.getElementById('currentAverage').value);
    const targetAverage = parseFloat(document.getElementById('targetAverage').value);
    const remainingWeight = parseFloat(document.getElementById('remainingWeight').value);

    if (!validateInputs([currentAverage, targetAverage, remainingWeight])) return;

    const currentWeight = 100 - remainingWeight;
    const gradeNeeded = (targetAverage - (currentAverage * currentWeight / 100)) / (remainingWeight / 100);

    const resultElement = document.getElementById('gradeNeededResult');
    const gradeNeededElement = document.getElementById('gradeNeeded');
    const currentStatusElement = document.getElementById('currentStatus');

    if (gradeNeeded > 100) {
        gradeNeededElement.textContent = `${Math.max(0, Math.round(gradeNeeded))}%`;
        gradeNeededElement.style.color = '#ef4444';
        currentStatusElement.textContent = 'Target not achievable';
        currentStatusElement.style.color = '#ef4444';
    } else if (gradeNeeded < 0) {
        gradeNeededElement.textContent = '0%';
        gradeNeededElement.style.color = '#10b981';
        currentStatusElement.textContent = 'Target already achieved!';
        currentStatusElement.style.color = '#10b981';
    } else {
        gradeNeededElement.textContent = `${Math.round(gradeNeeded)}%`;
        gradeNeededElement.style.color = '#f59e0b';
        currentStatusElement.textContent = 'Target achievable';
        currentStatusElement.style.color = '#f59e0b';
    }

    // Update progress visualization
    updateProgressVisualization(currentAverage, gradeNeeded, targetAverage, remainingWeight);

    resultElement.style.display = 'block';
    resultElement.classList.add('fade-in');
}

function updateProgressVisualization(currentAverage, gradeNeeded, targetAverage, remainingWeight) {
    const currentProgress = document.getElementById('currentProgress');
    const neededProgress = document.getElementById('neededProgress');
    const currentProgressLabel = document.getElementById('currentProgressLabel');
    const neededProgressLabel = document.getElementById('neededProgressLabel');
    const targetProgressLabel = document.getElementById('targetProgressLabel');

    const currentWeight = 100 - remainingWeight;
    
    currentProgress.style.width = `${currentWeight}%`;
    neededProgress.style.width = `${remainingWeight}%`;

    currentProgressLabel.textContent = `${currentAverage}%`;
    neededProgressLabel.textContent = `${Math.max(0, Math.min(100, Math.round(gradeNeeded)))}%`;
    targetProgressLabel.textContent = `${targetAverage}%`;
}

// Weighted Average Calculator
function addAssignment() {
    const assignmentsList = document.getElementById('assignmentsList');
    const assignmentRow = document.createElement('div');
    assignmentRow.className = 'assignment-row';
    assignmentRow.innerHTML = `
        <input type="text" class="assignment-name" placeholder="Assignment Name" value="New Assignment">
        <input type="number" class="assignment-grade" min="0" max="100" step="0.1" placeholder="Grade %" value="0">
        <input type="number" class="assignment-weight" min="1" max="100" step="0.1" placeholder="Weight %" value="10">
        <button class="remove-assignment">🗑️</button>
    `;

    assignmentsList.appendChild(assignmentRow);

    // Add remove functionality
    assignmentRow.querySelector('.remove-assignment').addEventListener('click', function() {
        if (assignmentsList.children.length > 1) {
            assignmentRow.remove();
        }
    });
}

function calculateWeightedAverage() {
    const assignmentRows = document.querySelectorAll('.assignment-row');
    let totalWeightedScore = 0;
    let totalWeight = 0;
    let simpleTotal = 0;
    let assignmentCount = 0;

    const breakdownList = document.getElementById('assignmentsBreakdown');
    breakdownList.innerHTML = '';

    assignmentRows.forEach(row => {
        const name = row.querySelector('.assignment-name').value || 'Unnamed Assignment';
        const grade = parseFloat(row.querySelector('.assignment-grade').value) || 0;
        const weight = parseFloat(row.querySelector('.assignment-weight').value) || 0;

        totalWeightedScore += grade * (weight / 100);
        totalWeight += weight;
        simpleTotal += grade;
        assignmentCount++;

        // Add to breakdown
        const breakdownItem = document.createElement('div');
        breakdownItem.className = 'breakdown-item';
        breakdownItem.innerHTML = `
            <span class="breakdown-name">${name}</span>
            <span class="breakdown-grade">${grade}%</span>
            <span class="breakdown-weight">${weight}%</span>
        `;
        breakdownList.appendChild(breakdownItem);
    });

    if (totalWeight === 0) {
        showError('Please add at least one assignment with weight.');
        return;
    }

    const weightedAverage = totalWeightedScore;
    const simpleAverage = simpleTotal / assignmentCount;

    const resultElement = document.getElementById('weightedResult');
    document.getElementById('weightedAverage').textContent = `${weightedAverage.toFixed(1)}%`;
    document.getElementById('totalWeight').textContent = `${totalWeight}%`;
    document.getElementById('simpleAverage').textContent = `${simpleAverage.toFixed(1)}%`;

    resultElement.style.display = 'block';
    resultElement.classList.add('fade-in');
}

// Utility Functions
function validateInputs(inputs) {
    for (let input of inputs) {
        if (isNaN(input) || input < 0) {
            showError('Please enter valid positive numbers for all fields.');
            return false;
        }
    }
    return true;
}

function showError(message) {
    // Create temporary error message
    const errorElement = document.createElement('div');
    errorElement.className = 'error-message';
    errorElement.textContent = message;
    errorElement.style.position = 'fixed';
    errorElement.style.top = '20px';
    errorElement.style.right = '20px';
    errorElement.style.zIndex = '1000';
    errorElement.style.background = '#fee2e2';
    errorElement.style.color = '#dc2626';
    errorElement.style.padding = '1rem';
    errorElement.style.borderRadius = '8px';
    errorElement.style.borderLeft = '4px solid #dc2626';
    
    document.body.appendChild(errorElement);
    
    setTimeout(() => {
        document.body.removeChild(errorElement);
    }, 5000);
}

function showSuccess(message) {
    // Create temporary success message
    const successElement = document.createElement('div');
    successElement.className = 'success-message';
    successElement.textContent = message;
    successElement.style.position = 'fixed';
    successElement.style.top = '20px';
    successElement.style.right = '20px';
    successElement.style.zIndex = '1000';
    successElement.style.background = '#d1fae5';
    successElement.style.color = '#059669';
    successElement.style.padding = '1rem';
    successElement.style.borderRadius = '8px';
    successElement.style.borderLeft = '4px solid #10b981';
    
    document.body.appendChild(successElement);
    
    setTimeout(() => {
        document.body.removeChild(successElement);
    }, 3000);
}

// Add some interactive features
document.addEventListener('DOMContentLoaded', function() {
    // Add pulse animation to VIP card
    const vipCard = document.querySelector('.vip-card');
    setInterval(() => {
        vipCard.style.transform = 'scale(1.02)';
        setTimeout(() => {
            vipCard.style.transform = 'scale(1)';
        }, 1000);
    }, 5000);
});