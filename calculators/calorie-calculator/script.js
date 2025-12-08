function calculateCalories() {
    const age = parseInt(document.getElementById('age').value);
    const gender = document.getElementById('gender').value;
    const height = parseFloat(document.getElementById('height').value);
    const weight = parseFloat(document.getElementById('weight').value);
    const activity = parseFloat(document.getElementById('activity').value);
    const goal = document.getElementById('goal').value;

    // Validation
    if (!age || !height || !weight) {
        alert('Please fill in all required fields');
        return;
    }

    if (age < 15 || age > 80 || height < 100 || height > 250 || weight < 30 || weight > 200) {
        alert('Please enter values within the valid range');
        return;
    }

    // Calculate BMR (Basal Metabolic Rate) using Mifflin-St Jeor Equation
    let bmr;
    if (gender === 'male') {
        bmr = 10 * weight + 6.25 * height - 5 * age + 5;
    } else {
        bmr = 10 * weight + 6.25 * height - 5 * age - 161;
    }

    // Calculate TDEE (Total Daily Energy Expenditure)
    const maintenanceCalories = Math.round(bmr * activity);
    
    // Calculate goal-based calories
    const lossCalories = Math.round(maintenanceCalories - 500); // 500 calorie deficit for 0.5kg/week loss
    const gainCalories = Math.round(maintenanceCalories + 500); // 500 calorie surplus for 0.5kg/week gain

    // Display results
    document.getElementById('maintenanceCalories').textContent = maintenanceCalories.toLocaleString();
    document.getElementById('lossCalories').textContent = lossCalories.toLocaleString();
    document.getElementById('gainCalories').textContent = gainCalories.toLocaleString();

    // Calculate and display macronutrients based on selected goal
    let targetCalories;
    switch(goal) {
        case 'loss':
            targetCalories = lossCalories;
            break;
        case 'gain':
            targetCalories = gainCalories;
            break;
        default:
            targetCalories = maintenanceCalories;
    }

    calculateMacronutrients(targetCalories);
    generateMealPlan(targetCalories, goal);
    
    // Show result container
    const resultContainer = document.getElementById('resultContainer');
    resultContainer.style.display = 'block';
    resultContainer.style.animation = 'fadeIn 0.5s ease-in';
}

function calculateMacronutrients(calories) {
    // Standard macronutrient distribution
    const proteinPercentage = 0.30; // 30% from protein
    const carbsPercentage = 0.40;   // 40% from carbs
    const fatPercentage = 0.30;     // 30% from fat

    // Calculate grams (protein & carbs: 4 calories/gram, fat: 9 calories/gram)
    const proteinGrams = Math.round((calories * proteinPercentage) / 4);
    const carbsGrams = Math.round((calories * carbsPercentage) / 4);
    const fatGrams = Math.round((calories * fatPercentage) / 9);

    const html = `
        <div class="macro-card protein">
            <div class="macro-name">Protein</div>
            <div class="macro-amount">${proteinGrams}g</div>
            <div class="macro-grams">${Math.round(calories * proteinPercentage)} calories</div>
        </div>
        <div class="macro-card carbs">
            <div class="macro-name">Carbohydrates</div>
            <div class="macro-amount">${carbsGrams}g</div>
            <div class="macro-grams">${Math.round(calories * carbsPercentage)} calories</div>
        </div>
        <div class="macro-card fat">
            <div class="macro-name">Fat</div>
            <div class="macro-amount">${fatGrams}g</div>
            <div class="macro-grams">${Math.round(calories * fatPercentage)} calories</div>
        </div>
    `;

    document.getElementById('macronutrientGrid').innerHTML = html;
}

function generateMealPlan(calories, goal) {
    let mealPlanHTML = '';

    if (goal === 'loss') {
        mealPlanHTML = `
            <div class="meal-item">
                <div class="meal-time">Breakfast (300-400 calories)</div>
                <div class="meal-desc">2 boiled eggs, 1 slice whole grain toast, 1/2 avocado</div>
            </div>
            <div class="meal-item">
                <div class="meal-time">Morning Snack (150-200 calories)</div>
                <div class="meal-desc">Greek yogurt with berries</div>
            </div>
            <div class="meal-item">
                <div class="meal-time">Lunch (400-500 calories)</div>
                <div class="meal-desc">Grilled chicken salad with mixed vegetables</div>
            </div>
            <div class="meal-item">
                <div class="meal-time">Afternoon Snack (100-150 calories)</div>
                <div class="meal-desc">Apple with 1 tbsp peanut butter</div>
            </div>
            <div class="meal-item">
                <div class="meal-time">Dinner (400-500 calories)</div>
                <div class="meal-desc">Baked salmon with quinoa and steamed broccoli</div>
            </div>
        `;
    } else if (goal === 'gain') {
        mealPlanHTML = `
            <div class="meal-item">
                <div class="meal-time">Breakfast (500-600 calories)</div>
                <div class="meal-desc">3-egg omelette with cheese, 2 slices whole grain toast, smoothie</div>
            </div>
            <div class="meal-item">
                <div class="meal-time">Morning Snack (300-400 calories)</div>
                <div class="meal-desc">Protein shake with banana and oats</div>
            </div>
            <div class="meal-item">
                <div class="meal-time">Lunch (600-700 calories)</div>
                <div class="meal-desc">Chicken breast with brown rice and mixed vegetables</div>
            </div>
            <div class="meal-item">
                <div class="meal-time">Afternoon Snack (200-300 calories)</div>
                <div class="meal-desc">Mixed nuts and dried fruits</div>
            </div>
            <div class="meal-item">
                <div class="meal-time">Dinner (600-700 calories)</div>
                <div class="meal-desc">Lean steak with sweet potato and green beans</div>
            </div>
        `;
    } else {
        mealPlanHTML = `
            <div class="meal-item">
                <div class="meal-time">Breakfast (400-500 calories)</div>
                <div class="meal-desc">Oatmeal with fruits and nuts, 2 boiled eggs</div>
            </div>
            <div class="meal-item">
                <div class="meal-time">Morning Snack (200-250 calories)</div>
                <div class="meal-desc">Greek yogurt with honey and almonds</div>
            </div>
            <div class="meal-item">
                <div class="meal-time">Lunch (500-600 calories)</div>
                <div class="meal-desc">Grilled chicken wrap with whole grain tortilla</div>
            </div>
            <div class="meal-item">
                <div class="meal-time">Afternoon Snack (150-200 calories)</div>
                <div class="meal-desc">Fruit and protein bar</div>
            </div>
            <div class="meal-item">
                <div class="meal-time">Dinner (500-600 calories)</div>
                <div class="meal-desc">Fish with quinoa and roasted vegetables</div>
            </div>
        `;
    }

    document.getElementById('mealPlan').innerHTML = mealPlanHTML;
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

// Auto-calculate when inputs change
document.addEventListener('DOMContentLoaded', function() {
    const inputs = document.querySelectorAll('input, select');
    inputs.forEach(input => {
        input.addEventListener('input', function() {
            const age = document.getElementById('age').value;
            if (age && age >= 15) {
                calculateCalories();
            }
        });
    });

    // Initial calculation
    calculateCalories();
});