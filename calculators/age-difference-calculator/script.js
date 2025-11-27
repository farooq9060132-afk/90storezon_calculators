document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('ageCalculatorForm');
    const resultsSection = document.getElementById('results');
    const calculateBtn = form.querySelector('.calculate-btn');

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        calculateAgeDifference();
    });

    function calculateAgeDifference() {
        const formData = new FormData(form);
        const calculateText = calculateBtn.innerHTML;
        
        // Show loading state
        calculateBtn.innerHTML = '<div class="loading"></div> Calculating...';
        calculateBtn.disabled = true;

        fetch('calculator.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                alert(data.error);
                return;
            }
            displayResults(data);
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while calculating. Please try again.');
        })
        .finally(() => {
            calculateBtn.innerHTML = calculateText;
            calculateBtn.disabled = false;
        });
    }

    function displayResults(data) {
        const resultsHTML = `
            <div class="results-grid">
                <div class="result-card">
                    <h4>Age Difference</h4>
                    <div class="result-value">${data.age_difference.full_string}</div>
                </div>
                <div class="result-card">
                    <h4>Older Person</h4>
                    <div class="result-value">${data.older_person}</div>
                </div>
                <div class="result-card">
                    <h4>Total Days</h4>
                    <div class="result-value">${data.age_difference.total_days.toLocaleString()}</div>
                </div>
                <div class="result-card">
                    <h4>Total Weeks</h4>
                    <div class="result-value">${data.age_difference.total_weeks.toLocaleString()}</div>
                </div>
            </div>

            <div class="detailed-results">
                <h3><i class="fas fa-info-circle"></i> Detailed Analysis</h3>
                
                <div class="age-info">
                    <div class="age-item">
                        <strong>${data.person1.name}</strong><br>
                        Current Age: ${data.person1.age_full}
                    </div>
                    <div class="age-item">
                        <strong>${data.person2.name}</strong><br>
                        Current Age: ${data.person2.age_full}
                    </div>
                </div>

                <div class="breakdown">
                    <h4>Age Difference Breakdown:</h4>
                    <ul>
                        <li><strong>Years:</strong> ${data.age_difference.years} years</li>
                        <li><strong>Months:</strong> ${data.age_difference.months} months</li>
                        <li><strong>Days:</strong> ${data.age_difference.days} days</li>
                        <li><strong>Total Months:</strong> ${data.age_difference.total_months} months</li>
                        <li><strong>Total Weeks:</strong> ${data.age_difference.total_weeks} weeks</li>
                        <li><strong>Total Days:</strong> ${data.age_difference.total_days.toLocaleString()} days</li>
                    </ul>
                </div>
            </div>
        `;

        resultsSection.innerHTML = resultsHTML;
        resultsSection.style.display = 'block';
        
        // Smooth scroll to results
        resultsSection.scrollIntoView({ behavior: 'smooth' });
    }

    // Set max date to today for both date inputs
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('person1_dob').max = today;
    document.getElementById('person2_dob').max = today;
});