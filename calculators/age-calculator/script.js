document.addEventListener('DOMContentLoaded', function() {
    // Set default dates
    const today = new Date();
    const defaultBirthDate = new Date();
    defaultBirthDate.setFullYear(1998, 0, 11); // January 11, 1998
    
    // Format dates as YYYY-MM-DD
    const formatDate = (date) => {
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');
        return `${year}-${month}-${day}`;
    };
    
    // Set default values
    document.getElementById('birthDate').value = formatDate(defaultBirthDate);
    document.getElementById('calculationDate').value = formatDate(today);
    
    // Auto-calculate when dates change
    document.getElementById('birthDate').addEventListener('change', calculateAge);
    document.getElementById('calculationDate').addEventListener('change', calculateAge);
    
    // Initial calculation
    setTimeout(calculateAge, 100);
});

function calculateAge() {
    try {
        // Get form values
        const birthDate = document.getElementById('birthDate').value;
        const calculationDate = document.getElementById('calculationDate').value;
        
        // Validate inputs
        if (!birthDate || !calculationDate) {
            hideResults();
            return;
        }
        
        // Parse dates
        const birth = new Date(birthDate);
        const calculation = new Date(calculationDate);
        
        // Validate dates
        if (birth > calculation) {
            showError('Birth date cannot be in the future');
            return;
        }
        
        // Perform calculation
        const result = performAgeCalculation(birth, calculation);
        
        // Display results
        displayResults(result);
        
    } catch (error) {
        showError('Error calculating age: ' + error.message);
    }
}

function performAgeCalculation(birth, calculation) {
    // Calculate differences
    let years = calculation.getFullYear() - birth.getFullYear();
    let months = calculation.getMonth() - birth.getMonth();
    let days = calculation.getDate() - birth.getDate();
    
    // Adjust for negative days
    if (days < 0) {
        months--;
        const lastMonth = new Date(calculation.getFullYear(), calculation.getMonth(), 0);
        days += lastMonth.getDate();
    }
    
    // Adjust for negative months
    if (months < 0) {
        years--;
        months += 12;
    }
    
    // Calculate total days
    const timeDiff = calculation.getTime() - birth.getTime();
    const totalDays = Math.floor(timeDiff / (1000 * 3600 * 24));
    
    // Calculate other units
    const totalWeeks = Math.floor(totalDays / 7);
    const totalMonths = (years * 12) + months;
    const totalHours = totalDays * 24;
    const totalMinutes = totalHours * 60;
    const totalSeconds = totalMinutes * 60;
    
    // Calculate extra days for weeks
    const extraDaysForWeeks = totalDays % 7;
    
    return {
        years: years,
        months: months,
        days: days,
        totalMonths: totalMonths,
        totalWeeks: totalWeeks,
        extraDaysForWeeks: extraDaysForWeeks,
        totalDays: totalDays,
        totalHours: totalHours,
        totalMinutes: totalMinutes,
        totalSeconds: totalSeconds
    };
}

function displayResults(result) {
    // Show loading
    document.getElementById('loading').style.display = 'block';
    document.getElementById('results').style.display = 'none';
    
    // Simulate processing time for better UX
    setTimeout(() => {
        // Hide loading
        document.getElementById('loading').style.display = 'none';
        
        // Set all result values
        document.getElementById('years').textContent = result.years;
        document.getElementById('months').textContent = result.months;
        document.getElementById('days').textContent = result.days;
        document.getElementById('totalMonths').textContent = result.totalMonths;
        document.getElementById('extraDays').textContent = result.days;
        document.getElementById('totalWeeks').textContent = result.totalWeeks;
        document.getElementById('extraDays2').textContent = result.extraDaysForWeeks;
        document.getElementById('totalDays').textContent = result.totalDays.toLocaleString();
        document.getElementById('totalHours').textContent = result.totalHours.toLocaleString();
        document.getElementById('totalMinutes').textContent = result.totalMinutes.toLocaleString();
        document.getElementById('totalSeconds').textContent = result.totalSeconds.toLocaleString();
        
        // Show results
        document.getElementById('results').style.display = 'block';
        
        // Scroll to results
        document.getElementById('results').scrollIntoView({ 
            behavior: 'smooth',
            block: 'nearest'
        });
        
    }, 300);
}

function hideResults() {
    document.getElementById('results').style.display = 'none';
    document.getElementById('loading').style.display = 'none';
}

function showError(message) {
    hideResults();
    alert(message);
}