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
            
            // Update results display
            updateResultsDisplay(method);
        });
    });
    
    // Calculate button
    document.getElementById('calculate').addEventListener('click', calculateMedication);
    
    // Print and Export buttons
    document.getElementById('print-schedule')?.addEventListener('click', printSchedule);
    document.getElementById('export-schedule')?.addEventListener('click', exportSchedule);
    
    // Initialize with demo values
    initializeDemoValues();
    
    function calculateMedication() {
        const activeMethod = document.querySelector('.method-tab.active').dataset.method;
        let result;
        
        // Verify safety checkboxes
        if (!document.getElementById('verify-prescription').checked) {
            alert('Please confirm you have a valid prescription for this medication');
            return;
        }
        
        switch (activeMethod) {
            case 'dosage':
                result = calculateDosageMethod();
                break;
            case 'interaction':
                result = calculateInteractionMethod();
                break;
            case 'schedule':
                result = calculateScheduleMethod();
                break;
        }
        
        if (result.success) {
            displayResults(result, activeMethod);
            sendToServer(result, activeMethod);
        } else {
            alert(result.message);
        }
    }
    
    function calculateDosageMethod() {
        const weight = parseFloat(document.getElementById('weight').value);
        const weightUnit = document.getElementById('weight-unit').value;
        const age = parseInt(document.getElementById('age').value) || 30;
        const condition = document.getElementById('condition').value;
        const medicationName = document.getElementById('medication-name').value;
        const dosageForm = document.getElementById('dosage-form').value;
        const prescribedDose = document.getElementById('prescribed-dose').value;
        const calcType = document.querySelector('input[name="calc-type"]:checked').value;
        
        if (!weight) {
            return { success: false, message: 'Please enter patient weight' };
        }
        
        if (!medicationName) {
            return { success: false, message: 'Please enter medication name' };
        }
        
        return {
            success: true,
            method: 'dosage',
            weight: weight,
            weight_unit: weightUnit,
            age: age,
            condition: condition,
            medication_name: medicationName,
            dosage_form: dosageForm,
            prescribed_dose: prescribedDose,
            calculation_type: calcType
        };
    }
    
    function calculateInteractionMethod() {
        const currentMedsText = document.getElementById('current-meds').value;
        const newMedication = document.getElementById('new-medication').value;
        
        // Parse current medications from textarea
        const currentMeds = currentMedsText.split('\n')
            .map(line => line.trim())
            .filter(line => line.length > 0);
        
        // Get health conditions
        const healthConditions = [];
        document.querySelectorAll('input[name="health-conditions"]:checked').forEach(checkbox => {
            healthConditions.push(checkbox.value);
        });
        
        const allergies = document.getElementById('allergies').value;
        
        if (currentMeds.length === 0) {
            return { success: false, message: 'Please enter current medications' };
        }
        
        if (!newMedication) {
            return { success: false, message: 'Please enter the new medication to check' };
        }
        
        return {
            success: true,
            method: 'interaction',
            current_medications: currentMeds,
            new_medication: newMedication,
            health_conditions: healthConditions,
            allergies: allergies
        };
    }
    
    function calculateScheduleMethod() {
        const scheduleMedsText = document.getElementById('schedule-meds').value;
        const wakeTime = document.getElementById('wake-time').value;
        const bedTime = document.getElementById('bed-time').value;
        const mealPreference = document.getElementById('meal-preference').value;
        const scheduleDays = document.getElementById('schedule-days').value;
        
        if (!scheduleMedsText) {
            return { success: false, message: 'Please enter medications for scheduling' };
        }
        
        return {
            success: true,
            method: 'schedule',
            medications: scheduleMedsText,
            wake_time: wakeTime,
            bed_time: bedTime,
            meal_preference: mealPreference,
            schedule_days: scheduleDays
        };
    }
    
    function displayResults(result, method) {
        updateResultsDisplay(method);
        
        switch (method) {
            case 'dosage':
                displayDosageResults(result);
                break;
            case 'interaction':
                displayInteractionResults(result);
                break;
            case 'schedule':
                displayScheduleResults(result);
                break;
        }
    }
    
    function displayDosageResults(result) {
        // Simulate dosage calculation (in real app, this would come from server)
        const weight = result.weight;
        const medication = result.medication_name;
        const age = result.age;
        
        // Simple dosage calculation simulation
        let dosage, frequency, duration;
        
        if (medication.toLowerCase().includes('amoxicillin')) {
            dosage = age < 18 ? `${Math.round(weight * 25)} mg` : '500 mg';
            frequency = 'Every 8 hours';
            duration = '7-10 days';
        } else if (medication.toLowerCase().includes('ibuprofen')) {
            dosage = age < 18 ? `${Math.round(weight * 5)} mg` : '400 mg';
            frequency = 'Every 6-8 hours';
            duration = 'As needed';
        } else {
            dosage = 'Consult dosage instructions';
            frequency = 'As prescribed';
            duration = 'As directed';
        }
        
        document.getElementById('calculated-dosage').textContent = dosage;
        document.getElementById('dosage-note').textContent = `For ${medication}`;
        document.getElementById('dosage-frequency').textContent = frequency;
        document.getElementById('treatment-duration').textContent = duration;
        
        // Administration instructions
        document.getElementById('administration-method').textContent = getAdministrationMethod(result.dosage_form);
        document.getElementById('best-time').textContent = getBestTime(result.condition);
        document.getElementById('food-instructions').textContent = getFoodInstructions(result.medication_name);
    }
    
    function displayInteractionResults(result) {
        const currentMeds = result.current_medications;
        const newMed = result.new_medication;
        
        // Simulate interaction check
        const interactions = simulateInteractionCheck(currentMeds, newMed);
        const interactionLevel = getInteractionLevel(interactions);
        
        // Update interaction level display
        const levelElement = document.getElementById('interaction-level');
        levelElement.innerHTML = `<span class="level-badge ${interactionLevel}">${interactionLevel.toUpperCase()}</span>`;
        
        // Update summary text
        document.getElementById('interaction-summary-text').textContent = 
            getInteractionSummary(interactionLevel, interactions.length);
        
        // Populate interaction list
        const interactionList = document.getElementById('interaction-list');
        interactionList.innerHTML = '';
        
        interactions.forEach(interaction => {
            const interactionItem = document.createElement('div');
            interactionItem.className = `interaction-item ${interaction.severity}`;
            interactionItem.innerHTML = `
                <strong>${interaction.med1} + ${interaction.med2}</strong>
                <p>${interaction.description}</p>
                <small>Severity: ${interaction.severity}</small>
            `;
            interactionList.appendChild(interactionItem);
        });
        
        // Update precautions
        const precautionsList = document.getElementById('precautions-list');
        precautionsList.innerHTML = '';
        
        const precautions = generatePrecautions(result.health_conditions, result.allergies, newMed);
        precautions.forEach(precaution => {
            const li = document.createElement('li');
            li.textContent = precaution;
            precautionsList.appendChild(li);
        });
    }
    
    function displayScheduleResults(result) {
        const medicationsText = result.medications;
        const scheduleDays = result.schedule_days;
        
        // Parse medications and generate schedule
        const medications = parseMedications(medicationsText);
        const schedule = generateSchedule(medications);
        
        document.getElementById('schedule-period').textContent = `Next ${scheduleDays} days`;
        
        // Update daily schedule
        document.getElementById('morning-medications').textContent = schedule.morning.join(', ') || 'None';
        document.getElementById('afternoon-medications').textContent = schedule.afternoon.join(', ') || 'None';
        document.getElementById('evening-medications').textContent = schedule.evening.join(', ') || 'None';
        document.getElementById('bedtime-medications').textContent = schedule.bedtime.join(', ') || 'None';
    }
    
    function simulateInteractionCheck(currentMeds, newMed) {
        const interactions = [];
        const interactionDB = {
            'warfarin': ['ibuprofen', 'aspirin', 'omeprazole'],
            'lisinopril': ['ibuprofen', 'naproxen'],
            'metformin': ['contrast dye']
        };
        
        currentMeds.forEach(med => {
            const medKey = med.toLowerCase();
            if (interactionDB[medKey] && interactionDB[medKey].includes(newMed.toLowerCase())) {
                interactions.push({
                    med1: med,
                    med2: newMed,
                    severity: 'high',
                    description: 'Potential significant interaction - consult your doctor'
                });
            }
        });
        
        return interactions;
    }
    
    function getInteractionLevel(interactions) {
        if (interactions.some(i => i.severity === 'high')) return 'high';
        if (interactions.some(i => i.severity === 'moderate')) return 'moderate';
        return 'safe';
    }
    
    function getInteractionSummary(level, count) {
        if (level === 'high') return `❌ ${count} significant interaction(s) detected - consult your doctor immediately`;
        if (level === 'moderate') return `⚠️ ${count} moderate interaction(s) found - discuss with your doctor`;
        if (count > 0) return `ℹ️ ${count} minor interaction(s) noted - monitor carefully`;
        return '✅ No significant interactions detected based on available information';
    }
    
    function generatePrecautions(conditions, allergies, newMed) {
        const precautions = [
            'Monitor for any unusual side effects',
            'Report any new symptoms to your doctor',
            'Keep all healthcare providers informed of all medications'
        ];
        
        if (conditions.includes('kidney')) {
            precautions.push('Monitor kidney function regularly');
        }
        
        if (conditions.includes('liver')) {
            precautions.push('Regular liver function tests recommended');
        }
        
        if (allergies && allergies.toLowerCase().includes(newMed.toLowerCase())) {
            precautions.push('⚠️ Potential allergy risk - avoid this medication');
        }
        
        return precautions;
    }
    
    function parseMedications(medicationsText) {
        return medicationsText.split('\n')
            .map(line => line.trim())
            .filter(line => line.length > 0)
            .map(line => {
                return {
                    name: line.split('-')[0]?.trim() || line,
                    frequency: extractFrequency(line),
                    withFood: line.toLowerCase().includes('with food')
                };
            });
    }
    
    function extractFrequency(line) {
        if (line.toLowerCase().includes('twice')) return 'twice_daily';
        if (line.toLowerCase().includes('three times')) return 'three_times_daily';
        if (line.toLowerCase().includes('four times')) return 'four_times_daily';
        if (line.toLowerCase().includes('as needed')) return 'as_needed';
        return 'once_daily';
    }
    
    function generateSchedule(medications) {
        const schedule = {
            morning: [],
            afternoon: [],
            evening: [],
            bedtime: []
        };
        
        medications.forEach(med => {
            switch (med.frequency) {
                case 'once_daily':
                    schedule.morning.push(med.name);
                    break;
                case 'twice_daily':
                    schedule.morning.push(med.name);
                    schedule.evening.push(med.name);
                    break;
                case 'three_times_daily':
                    schedule.morning.push(med.name);
                    schedule.afternoon.push(med.name);
                    schedule.evening.push(med.name);
                    break;
                case 'four_times_daily':
                    schedule.morning.push(med.name);
                    schedule.afternoon.push(med.name);
                    schedule.evening.push(med.name);
                    schedule.bedtime.push(med.name);
                    break;
                case 'as_needed':
                    // Don't add to regular schedule
                    break;
            }
        });
        
        return schedule;
    }
    
    function getAdministrationMethod(dosageForm) {
        const methods = {
            'tablet': 'Swallow whole with a full glass of water',
            'capsule': 'Swallow whole with water. Do not crush or chew',
            'liquid': 'Shake well before use. Use measuring device provided',
            'injection': 'For healthcare professional administration only',
            'cream': 'Apply thin layer to affected area as directed',
            'inhaler': 'Follow specific inhaler instructions carefully'
        };
        return methods[dosageForm] || 'Follow package instructions carefully';
    }
    
    function getBestTime(condition) {
        if (condition === 'chronic') return 'Take at the same time each day';
        if (condition === 'pain') return 'Take as needed for pain relief';
        return 'Take as directed by your healthcare provider';
    }
    
    function getFoodInstructions(medication) {
        if (medication.toLowerCase().includes('ibuprofen')) {
            return 'Take with food or milk to avoid stomach upset';
        }
        if (medication.toLowerCase().includes('antibiotic')) {
            return 'Some antibiotics should be taken on empty stomach - check instructions';
        }
        return 'Take with food unless otherwise directed';
    }
    
    function updateResultsDisplay(method) {
        // Hide all result sections
        document.getElementById('dosage-results').style.display = 'none';
        document.getElementById('interaction-results').style.display = 'none';
        document.getElementById('schedule-results').style.display = 'none';
        
        // Show the active result section
        document.getElementById(`${method}-results`).style.display = 'block';
    }
    
    function printSchedule() {
        window.print();
    }
    
    function exportSchedule() {
        alert('PDF export functionality would be implemented here');
        // In real implementation, this would generate and download a PDF
    }
    
    function sendToServer(result, method) {
        fetch('calculator.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(result)
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
        document.getElementById('weight').value = 70;
        document.getElementById('age').value = 30;
        document.getElementById('medication-name').value = 'Amoxicillin';
        document.getElementById('medication-strength').value = '500 mg';
        document.getElementById('prescribed-dose').value = '250 mg every 8 hours';
        
        document.getElementById('current-meds').value = 'Lisinopril\nMetformin';
        document.getElementById('new-medication').value = 'Ibuprofen';
        
        document.getElementById('schedule-meds').value = 'Lisinopril - 1 tablet daily\nMetformin - 1 tablet twice daily\nIbuprofen - as needed for pain';
        
        // Check safety verification by default for demo
        document.getElementById('verify-prescription').checked = true;
        document.getElementById('verify-doctor').checked = true;
    }
});