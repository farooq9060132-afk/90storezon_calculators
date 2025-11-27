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
    document.getElementById('calculate').addEventListener('click', calculatePregnancy);
    
    // Set default date to today for LMP
    const today = new Date();
    const threeMonthsAgo = new Date(today);
    threeMonthsAgo.setMonth(today.getMonth() - 3);
    
    document.getElementById('lmp-date').value = formatDate(threeMonthsAgo);
    document.getElementById('conception-date').value = formatDate(today);
    document.getElementById('ultrasound-date').value = formatDate(today);
    
    // Calculate initial result
    calculatePregnancy();
    
    function calculatePregnancy() {
        const activeMethod = document.querySelector('.method-tab.active').dataset.method;
        let result;
        
        switch (activeMethod) {
            case 'lmp':
                result = calculateLMPMethod();
                break;
            case 'conception':
                result = calculateConceptionMethod();
                break;
            case 'ultrasound':
                result = calculateUltrasoundMethod();
                break;
        }
        
        if (result.success) {
            displayResults(result);
            sendToServer(result, activeMethod);
        } else {
            alert(result.message);
        }
    }
    
    function calculateLMPMethod() {
        const lmpDate = document.getElementById('lmp-date').value;
        const cycleLength = document.getElementById('cycle-length').value;
        
        if (!lmpDate) {
            return { success: false, message: 'Please select the first day of your last menstrual period' };
        }
        
        const lmp = new Date(lmpDate);
        const dueDate = new Date(lmp);
        
        // Naegele's rule: LMP + 280 days (adjusted for cycle length)
        const daysToAdd = 280 + (parseInt(cycleLength) - 28);
        dueDate.setDate(dueDate.getDate() + daysToAdd);
        
        return calculatePregnancyDetails(lmp, dueDate, 'LMP Method');
    }
    
    function calculateConceptionMethod() {
        const conceptionDate = document.getElementById('conception-date').value;
        const isIVF = document.getElementById('ivf').value === 'yes';
        
        if (!conceptionDate) {
            return { success: false, message: 'Please select the estimated conception date' };
        }
        
        const conception = new Date(conceptionDate);
        const lmp = new Date(conception);
        lmp.setDate(lmp.getDate() - 14); // Approximate LMP from conception
        
        const dueDate = new Date(lmp);
        dueDate.setDate(dueDate.getDate() + 280);
        
        if (isIVF) {
            // For IVF, due date is conception date + 266 days
            dueDate.setTime(conception.getTime());
            dueDate.setDate(dueDate.getDate() + 266);
        }
        
        return calculatePregnancyDetails(lmp, dueDate, 'Conception Date Method');
    }
    
    function calculateUltrasoundMethod() {
        const ultrasoundDate = document.getElementById('ultrasound-date').value;
        const weeks = parseInt(document.getElementById('weeks').value) || 0;
        const days = parseInt(document.getElementById('days').value) || 0;
        
        if (!ultrasoundDate || (weeks === 0 && days === 0)) {
            return { success: false, message: 'Please provide ultrasound date and gestational age' };
        }
        
        const ultrasound = new Date(ultrasoundDate);
        const lmp = new Date(ultrasound);
        
        // Calculate LMP from ultrasound date and gestational age
        const totalDays = (weeks * 7) + days;
        lmp.setDate(lmp.getDate() - totalDays);
        
        const dueDate = new Date(lmp);
        dueDate.setDate(dueDate.getDate() + 280);
        
        return calculatePregnancyDetails(lmp, dueDate, 'Ultrasound Method');
    }
    
    function calculatePregnancyDetails(lmp, dueDate, method) {
        const today = new Date();
        const currentWeek = calculateCurrentWeek(lmp, today);
        const daysRemaining = calculateDaysRemaining(dueDate, today);
        const progressPercent = calculateProgressPercent(lmp, today);
        const trimester = getTrimester(currentWeek.week);
        
        return {
            success: true,
            due_date: dueDate.toISOString().split('T')[0],
            due_date_display: formatDisplayDate(dueDate),
            current_week: currentWeek,
            days_remaining: daysRemaining,
            progress_percent: progressPercent,
            trimester: trimester,
            method: method,
            lmp_date: lmp.toISOString().split('T')[0]
        };
    }
    
    function calculateCurrentWeek(lmp, today) {
        const diffTime = today - lmp;
        const diffDays = Math.floor(diffTime / (1000 * 60 * 60 * 24));
        const weeks = Math.floor(diffDays / 7);
        const days = diffDays % 7;
        
        return {
            week: weeks,
            day: days,
            total_days: diffDays
        };
    }
    
    function calculateDaysRemaining(dueDate, today) {
        const diffTime = dueDate - today;
        return Math.max(0, Math.floor(diffTime / (1000 * 60 * 60 * 24)));
    }
    
    function calculateProgressPercent(lmp, today) {
        const totalPregnancyDays = 280;
        const diffTime = today - lmp;
        const daysPassed = Math.floor(diffTime / (1000 * 60 * 60 * 24));
        return Math.min(100, Math.round((daysPassed / totalPregnancyDays) * 100));
    }
    
    function getTrimester(week) {
        if (week < 13) return 'First Trimester';
        if (week < 27) return 'Second Trimester';
        return 'Third Trimester';
    }
    
    function displayResults(result) {
        document.getElementById('due-date').textContent = result.due_date_display;
        document.getElementById('due-date-note').textContent = `Based on ${result.method}`;
        
        document.getElementById('current-week').textContent = `Week ${result.current_week.week}+${result.current_week.day}`;
        document.getElementById('trimester').textContent = result.trimester;
        
        document.getElementById('days-remaining').textContent = `${result.days_remaining} days`;
        document.getElementById('progress-percent').textContent = `${result.progress_percent}% complete`;
        
        updateTimeline(result.current_week.week);
        updateWeeklyInfo(result.current_week.week);
        updateImportantDates(result.due_date);
    }
    
    function updateTimeline(currentWeek) {
        const progressPercent = Math.min(100, (currentWeek / 40) * 100);
        const pointerPosition = Math.min(100, (currentWeek / 40) * 100);
        
        document.getElementById('timeline-progress').style.width = progressPercent + '%';
        document.getElementById('timeline-pointer').style.left = pointerPosition + '%';
        
        // Highlight current milestone
        document.querySelectorAll('.milestone').forEach(milestone => {
            const milestoneWeek = parseInt(milestone.dataset.week);
            milestone.style.fontWeight = currentWeek >= milestoneWeek ? 'bold' : 'normal';
            milestone.style.color = currentWeek >= milestoneWeek ? 'var(--primary)' : 'var(--gray)';
        });
    }
    
    function updateWeeklyInfo(currentWeek) {
        document.getElementById('week-number').textContent = currentWeek;
        
        // Calculate week dates
        const lmp = new Date(document.getElementById('lmp-date').value);
        const weekStart = new Date(lmp);
        weekStart.setDate(weekStart.getDate() + (currentWeek * 7));
        const weekEnd = new Date(weekStart);
        weekEnd.setDate(weekEnd.getDate() + 6);
        
        document.getElementById('week-dates').textContent = 
            `${formatDisplayDate(weekStart)} - ${formatDisplayDate(weekEnd)}`;
        
        // Update development information
        document.getElementById('baby-development').textContent = getBabyDevelopment(currentWeek);
        document.getElementById('mother-changes').textContent = getMotherChanges(currentWeek);
    }
    
    function updateImportantDates(dueDate) {
        const due = new Date(dueDate);
        
        const trimester1End = new Date(due);
        trimester1End.setDate(trimester1End.getDate() - (27 * 7));
        
        const trimester2End = new Date(due);
        trimester2End.setDate(trimester2End.getDate() - (13 * 7));
        
        const viabilityDate = new Date(due);
        viabilityDate.setDate(viabilityDate.getDate() - (16 * 7));
        
        document.getElementById('trimester1-end').textContent = formatDisplayDate(trimester1End);
        document.getElementById('trimester2-end').textContent = formatDisplayDate(trimester2End);
        document.getElementById('viability-date').textContent = formatDisplayDate(viabilityDate);
    }
    
    function getBabyDevelopment(week) {
        const developments = {
            4: "Baby is now an embryo about the size of a poppy seed. The neural tube is forming, which will become the brain and spinal cord.",
            8: "Baby is now about the size of a raspberry. All major organs have begun to form, and the heart is beating regularly.",
            12: "Baby is now about the size of a lime. All vital organs are formed and beginning to function. Fingers and toes are separated.",
            16: "Baby is now about the size of an avocado. The skeletal system is developing, and muscles are getting stronger.",
            20: "Baby is now about the size of a banana. You might feel movements! The baby can hear sounds and may respond to your voice.",
            24: "Baby is now about the size of an ear of corn. The lungs are developing, and the baby practices breathing movements.",
            28: "Baby is now about the size of an eggplant. Eyes can open and close, and the brain is developing rapidly.",
            32: "Baby is now about the size of a squash. The baby is gaining weight rapidly and has less room to move around.",
            36: "Baby is now about the size of a head of romaine lettuce. Most organs are fully developed, and the baby is getting ready for birth.",
            40: "Baby is now about the size of a small pumpkin! The baby is considered full-term and ready for life outside the womb."
        };
        
        let closestWeek = week;
        while (closestWeek > 0 && !developments[closestWeek]) {
            closestWeek--;
        }
        
        return developments[closestWeek] || "Your baby is growing and developing every day! This week, important developmental milestones are being reached.";
    }
    
    function getMotherChanges(week) {
        const changes = {
            4: "You might experience fatigue, breast tenderness, and nausea. Your body is producing more pregnancy hormones.",
            8: "Morning sickness may peak this week. You might need more rest and experience food aversions or cravings.",
            12: "Morning sickness often improves. Your uterus is growing, and you might start showing soon.",
            20: "You can probably feel the baby moving! Your appetite increases, and you might experience backaches.",
            28: "You might experience heartburn, shortness of breath, and trouble sleeping as the baby grows larger.",
            36: "You might feel increased pelvic pressure, Braxton Hicks contractions, and fatigue as you approach delivery."
        };
        
        let closestWeek = week;
        while (closestWeek > 0 && !changes[closestWeek]) {
            closestWeek--;
        }
        
        return changes[closestWeek] || "Your body is adapting to support your growing baby. You might notice various changes as your pregnancy progresses.";
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
    
    function formatDate(date) {
        return date.toISOString().split('T')[0];
    }
    
    function formatDisplayDate(date) {
        return date.toLocaleDateString('en-US', { 
            month: 'long', 
            day: 'numeric', 
            year: 'numeric' 
        });
    }
});