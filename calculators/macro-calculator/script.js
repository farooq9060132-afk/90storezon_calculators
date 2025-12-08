document.addEventListener('DOMContentLoaded', function() {
    let macroChart = null;
    
    // Calculate button
    document.getElementById('calculate').addEventListener('click', calculateMacros);
    
    // Meal tab switching
    const mealTabs = document.querySelectorAll('.meal-tab');
    mealTabs.forEach(tab => {
        tab.addEventListener('click', function() {
            const mealCount = parseInt(this.dataset.meals);
            
            // Update tabs
            mealTabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            
            // Update meal distribution if results exist
            if (window.currentResults) {
                updateMealDistribution(window.currentResults.meal_distribution, mealCount);
            }
        });
    });
    
    // Initialize with demo values
    initializeDemoValues();
    
    // Calculate initial result
    calculateMacros();
    
    function calculateMacros() {
        const data = collectFormData();
        
        if (!validateForm(data)) {
            alert('Please fill in all required fields');
            return;
        }
        
        const result = performCalculations(data);
        displayResults(result);
        sendToServer(result);
        
        // Store results for meal tab updates
        window.currentResults = result;
    }
    
    function collectFormData() {
        return {
            gender: document.getElementById('gender').value,
            age: parseInt(document.getElementById('age').value),
            height: parseFloat(document.getElementById('height').value),
            weight: parseFloat(document.getElementById('weight').value),
            body_fat: document.getElementById('body-fat').value ? parseFloat(document.getElementById('body-fat').value) : null,
            activity_level: document.getElementById('activity-level').value,
            goal: document.getElementById('goal').value,
            diet_type: document.getElementById('diet-type').value,
            protein_preference: document.getElementById('protein-preference').value,
            workout_days: parseInt(document.getElementById('workout-days').value) || 4,
            workout_intensity: document.getElementById('workout-intensity').value,
            workout_type: document.getElementById('workout-type').value,
            meal_count: parseInt(document.querySelector('.meal-tab.active').dataset.meals)
        };
    }
    
    function validateForm(data) {
        return data.age && data.height && data.weight;
    }
    
    function performCalculations(data) {
        // Calculate BMR (Mifflin-St Jeor Equation)
        let bmr;
        if (data.gender === 'male') {
            bmr = (10 * data.weight) + (6.25 * data.height) - (5 * data.age) + 5;
        } else {
            bmr = (10 * data.weight) + (6.25 * data.height) - (5 * data.age) - 161;
        }
        
        // Calculate TDEE
        const activityMultipliers = {
            'sedentary': 1.2,
            'light': 1.375,
            'moderate': 1.55,
            'very': 1.725,
            'extreme': 1.9
        };
        
        const tdee = bmr * activityMultipliers[data.activity_level];
        
        // Calculate calorie target based on goal
        const goalAdjustments = {
            'weight_loss': 0.85,
            'maintenance': 1.0,
            'muscle_gain': 1.15,
            'extreme_cut': 0.75
        };
        
        const calorieTarget = tdee * goalAdjustments[data.goal];
        
        // Calculate macronutrients
        const macros = calculateMacronutrientSplit(calorieTarget, data);
        
        // Generate meal distribution
        const mealDistribution = generateMealDistribution(macros, data.meal_count);
        
        return {
            success: true,
            calories: {
                bmr: Math.round(bmr),
                tdee: Math.round(tdee),
                target: Math.round(calorieTarget)
            },
            macros: macros,
            meal_distribution: mealDistribution
        };
    }
    
    function calculateMacronutrientSplit(calories, data) {
        const weight = data.weight;
        const bodyFat = data.body_fat;
        const goal = data.goal;
        const proteinPreference = data.protein_preference;
        const dietType = data.diet_type;
        
        // Calculate protein
        const leanMass = bodyFat ? weight * (1 - (bodyFat / 100)) : weight;
        
        const proteinMultipliers = {
            'moderate': 1.6,
            'high': 2.0,
            'very_high': 2.4
        };
        
        let proteinGrams = leanMass * proteinMultipliers[proteinPreference];
        
        if (goal === 'muscle_gain') {
            proteinGrams *= 1.1;
        } else if (goal === 'extreme_cut') {
            proteinGrams *= 1.2;
        }
        
        proteinGrams = Math.max(50, Math.min(300, proteinGrams));
        const proteinCalories = proteinGrams * 4;
        
        // Calculate fats
        const fatRatios = {
            'balanced': 0.25,
            'high_protein': 0.25,
            'low_carb': 0.35,
            'keto': 0.70,
            'high_carb': 0.20
        };
        
        let fatRatio = fatRatios[dietType];
        if (goal === 'weight_loss' || goal === 'extreme_cut') {
            fatRatio = Math.min(0.30, fatRatio);
        }
        
        const fatCalories = calories * fatRatio;
        const fatGrams = fatCalories / 9;
        
        // Calculate carbs from remaining calories
        const remainingCalories = calories - proteinCalories - fatCalories;
        const carbsGrams = remainingCalories / 4;
        
        // Calculate percentages
        const proteinPercent = (proteinCalories / calories) * 100;
        const carbsPercent = (remainingCalories / calories) * 100;
        const fatPercent = (fatCalories / calories) * 100;
        
        return {
            protein: {
                grams: Math.round(proteinGrams),
                calories: Math.round(proteinCalories),
                percent: Math.round(proteinPercent * 10) / 10
            },
            carbs: {
                grams: Math.round(carbsGrams),
                calories: Math.round(remainingCalories),
                percent: Math.round(carbsPercent * 10) / 10
            },
            fats: {
                grams: Math.round(fatGrams),
                calories: Math.round(fatCalories),
                percent: Math.round(fatPercent * 10) / 10
            }
        };
    }
    
    function generateMealDistribution(macros, mealCount) {
        const mealPatterns = {
            3: [0.30, 0.40, 0.30],
            4: [0.25, 0.30, 0.30, 0.15],
            5: [0.20, 0.25, 0.30, 0.15, 0.10],
            6: [0.20, 0.20, 0.25, 0.15, 0.10, 0.10]
        };
        
        const pattern = mealPatterns[mealCount] || mealPatterns[3];
        const totalCalories = macros.protein.calories + macros.carbs.calories + macros.fats.calories;
        const meals = [];
        
        const mealNames = ['Breakfast', 'Lunch', 'Dinner', 'Snack 1', 'Snack 2', 'Snack 3'];
        
        for (let i = 0; i < mealCount; i++) {
            const ratio = pattern[i];
            const mealCalories = Math.round(totalCalories * ratio);
            
            meals.push({
                name: mealNames[i],
                calories: mealCalories,
                protein: Math.round(macros.protein.grams * ratio),
                carbs: Math.round(macros.carbs.grams * ratio),
                fats: Math.round(macros.fats.grams * ratio)
            });
        }
        
        return meals;
    }
    
    function displayResults(result) {
        // Display calorie target
        document.getElementById('calorie-target').textContent = result.calories.target;
        document.getElementById('calorie-note').textContent = 
            `Based on your TDEE of ${result.calories.tdee} calories`;
        
        // Display macro breakdown
        document.getElementById('protein-grams').textContent = `${result.macros.protein.grams}g`;
        document.getElementById('protein-percent').textContent = `${result.macros.protein.percent}%`;
        document.getElementById('protein-calories').textContent = `${result.macros.protein.calories} kcal`;
        
        document.getElementById('carbs-grams').textContent = `${result.macros.carbs.grams}g`;
        document.getElementById('carbs-percent').textContent = `${result.macros.carbs.percent}%`;
        document.getElementById('carbs-calories').textContent = `${result.macros.carbs.calories} kcal`;
        
        document.getElementById('fats-grams').textContent = `${result.macros.fats.grams}g`;
        document.getElementById('fats-percent').textContent = `${result.macros.fats.percent}%`;
        document.getElementById('fats-calories').textContent = `${result.macros.fats.calories} kcal`;
        
        // Update chart
        updateMacroChart(result.macros);
        
        // Update meal distribution
        const mealCount = parseInt(document.querySelector('.meal-tab.active').dataset.meals);
        updateMealDistribution(result.meal_distribution, mealCount);
    }
    
    function updateMacroChart(macros) {
        const ctx = document.getElementById('macro-chart').getContext('2d');
        
        if (macroChart) {
            macroChart.destroy();
        }
        
        macroChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Protein', 'Carbohydrates', 'Fats'],
                datasets: [{
                    data: [macros.protein.percent, macros.carbs.percent, macros.fats.percent],
                    backgroundColor: [
                        '#ff6b6b',
                        '#4ecdc4',
                        '#45b7d1'
                    ],
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            usePointStyle: true
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.raw || 0;
                                const grams = context.dataIndex === 0 ? macros.protein.grams : 
                                            context.dataIndex === 1 ? macros.carbs.grams : 
                                            macros.fats.grams;
                                return `${label}: ${value}% (${grams}g)`;
                            }
                        }
                    }
                }
            }
        });
    }
    
    function updateMealDistribution(meals, mealCount) {
        // Show/hide meal elements based on count
        for (let i = 1; i <= 6; i++) {
            const mealElement = document.getElementById(`meal-${i}`);
            if (i <= mealCount) {
                mealElement.style.display = 'flex';
                if (meals[i - 1]) {
                    const meal = meals[i - 1];
                    document.getElementById(`meal-${i}-macros`).textContent = 
                        `${meal.protein}P ${meal.carbs}C ${meal.fats}F (${meal.calories} kcal)`;
                }
            } else {
                mealElement.style.display = 'none';
            }
        }
    }
    
    function sendToServer(result) {
        const data = {
            ...result,
            form_data: collectFormData()
        };
        
        fetch('calculator.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
            console.log('Server response:', data);
        })
        .catch(error => {
            console.error('Error sending data to server:', error);
        });
    }
    
    function initializeDemoValues() {
        document.getElementById('age').value = 30;
        document.getElementById('height').value = 175;
        document.getElementById('weight').value = 75;
        document.getElementById('workout-days').value = 4;
    }
});