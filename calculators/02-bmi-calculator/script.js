function calculateBMI() {
    const height = parseFloat(document.getElementById('height').value);
    const weight = parseFloat(document.getElementById('weight').value);
    const heightUnit = document.getElementById('heightUnit').value;
    const weightUnit = document.getElementById('weightUnit').value;

    // Validation
    if (!height || !weight) {
        alert('Please fill in all fields');
        return;
    }

    if (height <= 0 || weight <= 0) {
        alert('Please enter positive values');
        return;
    }

    // Convert to metric system (kg and meters)
    let heightInMeters = height;
    let weightInKg = weight;

    // Convert height to meters
    if (heightUnit === 'cm') {
        heightInMeters = height / 100;
    } else if (heightUnit === 'feet') {
        heightInMeters = height * 0.3048;
    } else if (heightUnit === 'inches') {
        heightInMeters = height * 0.0254;
    }

    // Convert weight to kg
    if (weightUnit === 'pounds') {
        weightInKg = weight * 0.453592;
    }

    // Calculate BMI: BMI = weight(kg) / (height(m) * height(m))
    const bmi = weightInKg / (heightInMeters * heightInMeters);
    
    // Determine BMI category
    let category = '';
    let categoryClass = '';
    
    if (bmi < 18.5) {
        category = 'Underweight';
        categoryClass = 'category-underweight';
    } else if (bmi >= 18.5 && bmi <= 24.9) {
        category = 'Normal Weight';
        categoryClass = 'category-normal';
    } else if (bmi >= 25 && bmi <= 29.9) {
        category = 'Overweight';
        categoryClass = 'category-overweight';
    } else {
        category = 'Obese';
        categoryClass = 'category-obese';
    }

    // Display results
    document.getElementById('bmiValue').textContent = bmi.toFixed(1);
    document.getElementById('bmiCategory').textContent = category;
    document.getElementById('bmiCategory').className = 'bmi-category ' + categoryClass;
    
    // Show result container with animation
    const resultContainer = document.getElementById('resultContainer');
    // Add class for mobile responsiveness
    resultContainer.classList.add('show');
    resultContainer.style.animation = 'fadeIn 0.5s ease-in';
    
    // Ensure proper display on mobile devices
    setTimeout(function() {
        resultContainer.style.display = 'block';
    }, 100);
}

// Add fadeIn animation
const style = document.createElement('style');
style.textContent = `
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
`;
document.head.appendChild(style);

// Enter key support
document.addEventListener('DOMContentLoaded', function() {
    const inputs = document.querySelectorAll('input');
    inputs.forEach(input => {
        input.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                calculateBMI();
            }
        });
    });
});