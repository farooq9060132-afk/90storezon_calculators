document.addEventListener('DOMContentLoaded', function() {
    let hrChart = null;
    
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
    
    // Recommendation tab switching
    const recTabs = document.querySelectorAll('.rec-tab');
    const recContents = document.querySelectorAll('.rec-content');
    
    recTabs.forEach(tab => {
        tab.addEventListener('click', function() {
            const goal = this.dataset.goal;
            
            // Update tabs
            recTabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            
            // Update contents
            recContents.forEach(content => {
                content.classList.remove('active');
                if (content.id === `${goal}-rec`) {
                    content.classList.add('active');
                }
            });
        });
    });
    
    // Calculate button
    document.getElementById('calculate').addEventListener('click', calculateHeartRate);
    
    // Initialize with demo values
    initializeDemoValues();
    
    // Calculate initial result
    calculateHeartRate();
    
    function calculateHeartRate() {
        const activeMethod = document.querySelector('.method-tab.active').dataset.method;
        let result;
        
        switch (activeMethod) {
            case 'basic':
                result = calculateBasicMethod();
                break;
            case 'advanced':
                result = calculateAdvancedMethod();
                break;
            case 'resting':
                result = calculateRestingMethod();
                break;
        }
        
        if (result.success) {
            displayResults(result, activeMethod);
            sendToServer(result, activeMethod);
        } else {
            alert(result.message);
        }
    }
    
    function calculateBasicMethod() {
        const age = parseInt(document.getElementById('age').value);
        const restingHR = document.getElementById('basic-resting-hr').value ? 
                         parseInt(document.getElementById('basic-resting-hr').value) : 70;
        const fitnessLevel = document.getElementById('fitness-level').value;
        const activityLevel = document.querySelector('input[name="activity"]:checked').value;
        
        if (!age) {
            return { success: false, message: 'Please enter your age' };
        }
        
        // Calculate maximum HR using Haskell & Fox formula
        const maxHR = 220 - age;
        
        // Calculate HR reserve
        const hrReserve = maxHR - restingHR;
        
        // Calculate target zones
        const zones = calculateTargetZones(maxHR, restingHR, hrReserve, fitnessLevel);
        
        return {
            success: true,
            max_hr: maxHR,
            resting_hr: restingHR,
            hr_reserve: hrReserve,
            zones: zones,
            formula_used: 'Haskell & Fox (220 - age)',
            activity_level: activityLevel,
            fitness_level: fitnessLevel
        };
    }
    
    function calculateAdvancedMethod() {
        const age = parseInt(document.getElementById('advanced-age').value);
        const restingHR = parseInt(document.getElementById('advanced-resting-hr').value);
        const formula = document.getElementById('hr-formula').value;
        const trainingGoal = document.getElementById('training-goal').value;
        const activityLevel = document.querySelector('input[name="activity"]:checked').value;
        
        if (!age || !restingHR) {
            return { success: false, message: 'Please enter age and resting heart rate' };
        }
        
        // Calculate maximum HR using selected formula
        const maxHR = calculateMaxHR(age, formula);
        const hrReserve = maxHR - restingHR;
        
        // Calculate zones based on training goal
        const zones = calculateAdvancedZones(maxHR, restingHR, hrReserve, trainingGoal);
        
        const formulaNames = {
            'karvonen': 'Karvonen Method',
            'tanaka': 'Tanaka Formula',
            'gellish': 'Gellish Formula',
            'haskell': 'Haskell & Fox'
        };
        
        return {
            success: true,
            max_hr: maxHR,
            resting_hr: restingHR,
            hr_reserve: hrReserve,
            zones: zones,
            formula_used: formulaNames[formula] || 'Karvonen Method',
            activity_level: activityLevel,
            training_goal: trainingGoal
        };
    }
    
    function calculateRestingMethod() {
        const restingHR = parseInt(document.getElementById('resting-hr-value').value);
        const measurementTime = document.getElementById('measurement-time').value;
        const activityLevel = document.querySelector('input[name="activity"]:checked').value;
        
        // Get health conditions
        const healthConditions = [];
        document.querySelectorAll('input[name="health-conditions"]:checked').forEach(checkbox => {
            healthConditions.push(checkbox.value);
        });
        
        if (!restingHR) {
            return { success: false, message: 'Please enter your resting heart rate' };
        }
        
        // Adjust resting HR based on measurement time
        let adjustedHR = restingHR;
        if (measurementTime === 'evening') {
            adjustedHR += 5;
        } else if (measurementTime === 'random') {
            adjustedHR += 3;
        }
        
        // Adjust for health conditions
        healthConditions.forEach(condition => {
            switch (condition) {
                case 'hypertension':
                    adjustedHR += 5;
                    break;
                case 'stress':
                    adjustedHR += 8;
                    break;
                case 'dehydration':
                    adjustedHR += 10;
                    break;
                case 'medication':
                    adjustedHR -= 5;
                    break;
            }
        });
        
        // Ensure reasonable bounds
        adjustedHR = Math.max(40, Math.min(120, adjustedHR));
        
        // Calculate estimated max HR
        const estimatedMaxHR = 220 - 30; // Using average age
        
        return {
            success: true,
            resting_hr: restingHR,
            adjusted_resting_hr: adjustedHR,
            resting_hr_category: getRestingHRCategory(adjustedHR),
            estimated_max_hr: estimatedMaxHR,
            analysis: analyzeRestingHR(adjustedHR),
            activity_level: activityLevel,
            health_conditions: healthConditions
        };
    }
    
    function calculateMaxHR(age, formula) {
        switch (formula) {
            case 'tanaka':
                return 208 - (0.7 * age);
            case 'gellish':
                return 206.9 - (0.67 * age);
            case 'haskell':
                return 220 - age;
            case 'karvonen':
            default:
                return 220 - age;
        }
    }
    
    function calculateTargetZones(maxHR, restingHR, hrReserve, fitnessLevel) {
        const zones = {};
        const zonePercentages = getZonePercentages(fitnessLevel);
        
        Object.keys(zonePercentages).forEach(zone => {
            const percentages = zonePercentages[zone];
            const minPercent = percentages.min;
            const maxPercent = percentages.max;
            
            // Using Karvonen method
            const minHR = restingHR + (hrReserve * minPercent / 100);
            const maxHRZone = restingHR + (hrReserve * maxPercent / 100);
            
            zones[zone] = {
                min_bpm: Math.round(minHR),
                max_bpm: Math.round(maxHRZone),
                min_percent: minPercent,
                max_percent: maxPercent,
                description: getZoneDescription(zone)
            };
        });
        
        return zones;
    }
    
    function calculateAdvancedZones(maxHR, restingHR, hrReserve, trainingGoal) {
        const zones = {};
        const zoneFocus = getZoneFocus(trainingGoal);
        
        Object.keys(zoneFocus).forEach(zone => {
            const percentages = zoneFocus[zone];
            const minPercent = percentages.min;
            const maxPercent = percentages.max;
            
            const minHR = restingHR + (hrReserve * minPercent / 100);
            const maxHRZone = restingHR + (hrReserve * maxPercent / 100);
            
            zones[zone] = {
                min_bpm: Math.round(minHR),
                max_bpm: Math.round(maxHRZone),
                min_percent: minPercent,
                max_percent: maxPercent,
                description: getZoneDescription(zone)
            };
        });
        
        return zones;
    }
    
    function getZonePercentages(fitnessLevel) {
        const percentages = {
            zone_1: { min: 50, max: 60 },
            zone_2: { min: 60, max: 70 },
            zone_3: { min: 70, max: 80 },
            zone_4: { min: 80, max: 90 },
            zone_5: { min: 90, max: 100 }
        };
        
        if (fitnessLevel === 'beginner') {
            percentages.zone_1.max = 65;
            percentages.zone_2.min = 65;
            percentages.zone_2.max = 75;
        } else if (fitnessLevel === 'athlete') {
            percentages.zone_4.max = 95;
            percentages.zone_5.min = 95;
        }
        
        return percentages;
    }
    
    function getZoneFocus(trainingGoal) {
        const focus = {
            fat_burn: {
                zone_1: { min: 50, max: 60 },
                zone_2: { min: 60, max: 70 },
                zone_3: { min: 70, max: 80 }
            },
            cardio: {
                zone_2: { min: 60, max: 70 },
                zone_3: { min: 70, max: 80 },
                zone_4: { min: 80, max: 90 }
            },
            peak: {
                zone_4: { min: 80, max: 90 },
                zone_5: { min: 90, max: 100 }
            },
            recovery: {
                zone_1: { min: 50, max: 60 }
            }
        };
        
        return focus[trainingGoal] || focus.cardio;
    }
    
    function getZoneDescription(zone) {
        const descriptions = {
            'zone_1': 'Very Light: Warm-up, recovery, fat burning',
            'zone_2': 'Light: Aerobic base, endurance training',
            'zone_3': 'Moderate: Aerobic fitness, improved stamina',
            'zone_4': 'Hard: Anaerobic threshold, performance',
            'zone_5': 'Maximum: Peak effort, short bursts only'
        };
        
        return descriptions[zone] || 'Training zone';
    }
    
    function getRestingHRCategory(restingHR) {
        if (restingHR < 60) return 'Excellent (Athlete)';
        if (restingHR < 70) return 'Good';
        if (restingHR < 80) return 'Average';
        if (restingHR < 90) return 'Below Average';
        return 'High (Consult Doctor)';
    }
    
    function analyzeRestingHR(restingHR) {
        if (restingHR < 60) {
            return "Your resting heart rate indicates excellent cardiovascular fitness, typical of well-trained athletes.";
        } else if (restingHR < 70) {
            return "Good resting heart rate indicating above average cardiovascular fitness.";
        } else if (restingHR < 80) {
            return "Average resting heart rate. Regular exercise can help improve this.";
        } else {
            return "Higher than average resting heart rate. Consider consulting a healthcare provider and increasing physical activity.";
        }
    }
    
    function displayResults(result, method) {
        if (method !== 'resting') {
            // Display HR summary for basic and advanced methods
            document.getElementById('max-hr').textContent = `${result.max_hr} bpm`;
            document.getElementById('max-hr-note').textContent = `Using ${result.formula_used}`;
            
            document.getElementById('resting-hr').textContent = `${result.resting_hr} bpm`;
            document.getElementById('resting-hr-category').textContent = getRestingHRCategory(result.resting_hr);
            
            document.getElementById('hr-reserve').textContent = result.hr_reserve;
            
            // Display zones
            displayZones(result.zones);
            
            // Update chart
            updateHRChart(result.zones, result.max_hr);
            
            // Update health insights
            updateHealthInsights(result);
        } else {
            // Display resting HR analysis
            document.getElementById('resting-hr').textContent = `${result.resting_hr} bpm`;
            document.getElementById('resting-hr-category').textContent = result.resting_hr_category;
            
            document.getElementById('resting-hr-insight').textContent = result.analysis;
            document.getElementById('fitness-insight').textContent = getFitnessInsight(result);
            document.getElementById('training-insight').textContent = getTrainingInsight(result);
            
            // Hide zones for resting method
            document.querySelector('.zones-breakdown').style.display = 'none';
            document.querySelector('.heart-rate-chart').style.display = 'none';
        }
    }
    
    function displayZones(zones) {
        // Show zones section
        document.querySelector('.zones-breakdown').style.display = 'block';
        document.querySelector('.heart-rate-chart').style.display = 'block';
        
        // Update each zone
        Object.keys(zones).forEach(zone => {
            const zoneData = zones[zone];
            const element = document.getElementById(`${zone}-range`);
            if (element) {
                element.textContent = `${zoneData.min_bpm} - ${zoneData.max_bpm} bpm`;
            }
        });
    }
    
    function updateHRChart(zones, maxHR) {
        const ctx = document.getElementById('hr-chart').getContext('2d');
        
        if (hrChart) {
            hrChart.destroy();
        }
        
        const zoneLabels = [];
        const zoneData = [];
        const backgroundColors = [
            '#27ae60', '#3498db', '#f39c12', '#e74c3c', '#c0392b'
        ];
        
        Object.keys(zones).forEach((zone, index) => {
            const zoneData = zones[zone];
            zoneLabels.push(`Zone ${index + 1}`);
        });
        
        hrChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: zoneLabels,
                datasets: [{
                    label: 'Maximum BPM in Zone',
                    data: Object.values(zones).map(zone => zone.max_bpm),
                    backgroundColor: backgroundColors,
                    borderColor: backgroundColors.map(color => color),
                    borderWidth: 1
                }, {
                    label: 'Minimum BPM in Zone',
                    data: Object.values(zones).map(zone => zone.min_bpm),
                    backgroundColor: backgroundColors.map(color => color + '80'),
                    borderColor: backgroundColors.map(color => color),
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Heart Rate (bpm)'
                        },
                        max: maxHR
                    }
                },
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const zoneIndex = context.dataIndex;
                                const zoneKeys = Object.keys(zones);
                                const zone = zones[zoneKeys[zoneIndex]];
                                return `${context.dataset.label}: ${context.raw} bpm (${zone.min_percent}-${zone.max_percent}%)`;
                            }
                        }
                    }
                }
            }
        });
    }
    
    function updateHealthInsights(result) {
        const restingHR = result.resting_hr;
        const hrReserve = result.hr_reserve;
        const activityLevel = result.activity_level;
        
        // Resting HR insight
        if (restingHR < 60) {
            document.getElementById('resting-hr-insight').textContent = 
                "Excellent! Your resting HR indicates great cardiovascular health.";
        } else if (restingHR > 80) {
            document.getElementById('resting-hr-insight').textContent = 
                "Your resting HR is higher than ideal. Consider more cardio exercise.";
        } else {
            document.getElementById('resting-hr-insight').textContent = 
                "Good resting HR. Maintain your current activity level.";
        }
        
        // Fitness insight
        if (hrReserve > 100) {
            document.getElementById('fitness-insight').textContent = 
                "Good heart rate reserve indicating decent fitness level.";
        } else {
            document.getElementById('fitness-insight').textContent = 
                "Consider building cardiovascular endurance through regular exercise.";
        }
        
        // Training insight
        if (activityLevel === 'sedentary') {
            document.getElementById('training-insight').textContent = 
                "Start with Zone 1-2 training and gradually increase intensity.";
        } else if (activityLevel === 'very') {
            document.getElementById('training-insight').textContent = 
                "You can safely train in higher zones. Focus on Zone 3-4 for best results.";
        } else {
            document.getElementById('training-insight').textContent = 
                "Mix Zone 2-3 training for balanced fitness improvement.";
        }
    }
    
    function getFitnessInsight(result) {
        const restingHR = result.adjusted_resting_hr;
        if (restingHR < 60) {
            return "Your fitness level appears to be excellent based on your low resting heart rate.";
        } else if (restingHR < 70) {
            return "Good fitness level. Continue your current exercise routine.";
        } else {
            return "Consider incorporating more cardiovascular exercise to improve your fitness level.";
        }
    }
    
    function getTrainingInsight(result) {
        const restingHR = result.adjusted_resting_hr;
        const activityLevel = result.activity_level;
        
        if (activityLevel === 'sedentary') {
            return "Start with light cardio 3 times per week and gradually increase intensity.";
        } else if (restingHR < 60) {
            return "You can handle high-intensity training. Consider interval workouts.";
        } else {
            return "Focus on consistent moderate-intensity cardio for best results.";
        }
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
        document.getElementById('age').value = 30;
        document.getElementById('basic-resting-hr').value = 70;
        document.getElementById('advanced-age').value = 30;
        document.getElementById('advanced-resting-hr').value = 70;
        document.getElementById('resting-hr-value').value = 70;
    }
});