document.addEventListener('DOMContentLoaded', function() {
    // Method tab switching
    const methodTabs = document.querySelectorAll('.method-tab');
    const methodForms = document.querySelectorAll('.method-form');
    
    methodTabs.forEach(tab => {
        tab.addEventListener('click', function() {
            const method = this.dataset.method;
            
            // Update tabs
            methodTabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            
            // Update forms
            methodForms.forEach(form => {
                form.classList.remove('active');
                if (form.id === `${method}-method`) {
                    form.classList.add('active');
                }
            });
        });
    });
    
    // Calculate button
    document.getElementById('calculate').addEventListener('click', calculateWaterIntake);
    
    // Initialize with demo values
    initializeDemoValues();
    
    // Calculate initial result
    calculateWaterIntake();
    
    function calculateWaterIntake() {
        const activeMethod = document.querySelector('.method-tab.active').dataset.method;
        let result;
        
        switch (activeMethod) {
            case 'standard':
                result = calculateStandardMethod();
                break;
            case 'advanced':
                result = calculateAdvancedMethod();
                break;
        }
        
        if (result.success) {
            displayResults(result);
            sendToServer(result, activeMethod);
        } else {
            alert(result.message);
        }
    }
    
    function calculateStandardMethod() {
        const weight = parseFloat(document.getElementById('weight').value);
        const weightUnit = document.getElementById('weight-unit').value;
        const activityLevel = document.getElementById('activity-level').value;
        
        if (!weight || weight <= 0) {
            return { success: false, message: 'Please enter your weight' };
        }
        
        // Convert weight to kg if in lbs
        let weightKg = weight;
        if (weightUnit === 'lbs') {
            weightKg = weight * 0.453592;
        }
        
        // Base calculation: 30-35 ml per kg of body weight
        let baseIntake = weightKg * 30; // ml
        
        // Adjust for activity level
        const activityMultipliers = {
            'sedentary': 1.0,
            'light': 1.1,
            'moderate': 1.2,
            'very': 1.3,
            'extreme': 1.4
        };
        
        let recommendedIntake = baseIntake * activityMultipliers[activityLevel];
        
        return formatWaterResults(recommendedIntake);
    }
    
    function calculateAdvancedMethod() {
        const weight = parseFloat(document.getElementById('advanced-weight').value);
        const weightUnit = document.getElementById('advanced-weight-unit').value;
        const age = parseInt(document.getElementById('age').value) || 30;
        const gender = document.getElementById('gender').value;
        const climate = document.getElementById('climate').value;
        const exerciseDuration = parseInt(document.getElementById('exercise-duration').value) || 0;
        
        // Get health conditions
        const healthConditions = [];
        document.querySelectorAll('input[name="health-conditions"]:checked').forEach(checkbox => {
            healthConditions.push(checkbox.value);
        });
        
        // Get additional factors
        const additionalFactors = [];
        if (document.getElementById('high-altitude').checked) additionalFactors.push('high-altitude');
        if (document.getElementById('alcohol').checked) additionalFactors.push('alcohol');
        if (document.getElementById('caffeine').checked) additionalFactors.push('caffeine');
        if (document.getElementById('high-protein').checked) additionalFactors.push('high-protein');
        
        if (!weight || weight <= 0) {
            return { success: false, message: 'Please enter your weight' };
        }
        
        // Convert weight to kg if in lbs
        let weightKg = weight;
        if (weightUnit === 'lbs') {
            weightKg = weight * 0.453592;
        }
        
        // Base calculation by age and gender
        let baseIntake = calculateBaseIntake(age, gender, weightKg);
        
        // Adjust for climate
        const climateMultipliers = {
            'temperate': 1.0,
            'hot': 1.2,
            'dry': 1.15,
            'cold': 0.9
        };
        
        let adjustedIntake = baseIntake * climateMultipliers[climate];
        
        // Add exercise adjustment (500ml per hour of exercise)
        const exerciseAdjustment = (exerciseDuration / 60) * 500;
        adjustedIntake += exerciseAdjustment;
        
        // Adjust for health conditions
        healthConditions.forEach(condition => {
            switch (condition) {
                case 'pregnancy':
                    adjustedIntake += 300;
                    break;
                case 'fever':
                    adjustedIntake += 500;
                    break;
                case 'kidney':
                    adjustedIntake = Math.min(adjustedIntake, 2000);
                    break;
                case 'heart':
                    adjustedIntake = Math.min(adjustedIntake, 1500);
                    break;
            }
        });
        
        // Adjust for additional factors
        additionalFactors.forEach(factor => {
            switch (factor) {
                case 'high-altitude':
                    adjustedIntake += 500;
                    break;
                case 'alcohol':
                    adjustedIntake += 500;
                    break;
                case 'caffeine':
                    adjustedIntake += 250;
                    break;
                case 'high-protein':
                    adjustedIntake += 300;
                    break;
            }
        });
        
        return formatWaterResults(adjustedIntake);
    }
    
    function calculateBaseIntake(age, gender, weightKg) {
        if (age <= 18) {
            return weightKg * 40;
        } else if (age <= 30) {
            if (gender === 'male') {
                return weightKg * 35;
            } else {
                return weightKg * 32;
            }
        } else if (age <= 50) {
            if (gender === 'male') {
                return weightKg * 33;
            } else {
                return weightKg * 30;
            }
        } else {
            if (gender === 'male') {
                return weightKg * 30;
            } else {
                return weightKg * 27;
            }
        }
    }
    
    function formatWaterResults(intakeMl) {
        // Ensure reasonable limits
        intakeMl = Math.max(1500, Math.min(5000, intakeMl));
        
        const intakeLiters = intakeMl / 1000;
        const minIntake = intakeMl * 0.8;
        const maxIntake = intakeMl * 1.2;
        
        // Calculate equivalents
        const glasses = Math.round((intakeMl / 250) * 10) / 10;
        const bottles500ml = Math.round((intakeMl / 500) * 10) / 10;
        const bottles1L = Math.round((intakeMl / 1000) * 10) / 10;
        
        return {
            success: true,
            recommended_intake: Math.round(intakeMl),
            recommended_liters: Math.round(intakeLiters * 100) / 100,
            min_intake: Math.round(minIntake),
            max_intake: Math.round(maxIntake),
            equivalent: {
                glasses: glasses,
                bottles_500ml: bottles500ml,
                bottles_1l: bottles1L
            }
        };
    }
    
    function displayResults(result) {
        // Display main result
        document.getElementById('water-amount').textContent = `${result.recommended_liters} L`;
        
        const equivalents = [];
        if (result.equivalent.glasses > 0) {
            equivalents.push(`${result.equivalent.glasses} glasses (250ml)`);
        }
        if (result.equivalent.bottles_500ml > 0) {
            equivalents.push(`${result.equivalent.bottles_500ml} bottles (500ml)`);
        }
        
        document.getElementById('water-equivalent').textContent = `≈ ${equivalents.join(' or ')}`;
        
        // Display min and max intake
        document.getElementById('min-intake').textContent = `${Math.round(result.min_intake / 1000 * 10) / 10} L`;
        document.getElementById('max-intake').textContent = `${Math.round(result.max_intake / 1000 * 10) / 10} L`;
        
        // Update hydration schedule
        updateHydrationSchedule(result.recommended_intake);
    }
    
    function updateHydrationSchedule(totalIntake) {
        const times = [
            'time-1', 'time-2', 'time-3', 'time-4',
            'time-5', 'time-6', 'time-7', 'time-8'
        ];
        
        // Distribute water intake across the day
        const amountPerSlot = Math.round(totalIntake / times.length);
        const glassesPerSlot = Math.round((amountPerSlot / 250) * 10) / 10;
        
        times.forEach((timeId, index) => {
            const element = document.getElementById(timeId);
            element.textContent = `${amountPerSlot}ml (${glassesPerSlot} glasses)`;
        });
    }
    
    function sendToServer(result, method) {
        const data = {
            method: method,
            ...result
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
        // Set demo values for standard method
        document.getElementById('weight').value = 70;
        
        // Set demo values for advanced method
        document.getElementById('age').value = 30;
        document.getElementById('advanced-weight').value = 70;
        document.getElementById('exercise-duration').value = 30;
    }
});