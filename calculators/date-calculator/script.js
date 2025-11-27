document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('dateCalculatorForm');
    const resultsSection = document.getElementById('results');
    const calculateBtn = form.querySelector('.calculate-btn');
    const operationBtns = document.querySelectorAll('.operation-btn');
    const operationInput = document.getElementById('operation');

    // Operation toggle functionality
    operationBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            operationBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            operationInput.value = this.dataset.operation;
        });
    });

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        calculateDate();
    });

    function calculateDate() {
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
        const operationText = data.operation === 'add' ? 'after' : 'before';
        const timeAdded = [];
        
        if (data.time_added.years > 0) timeAdded.push(`${data.time_added.years} year${data.time_added.years > 1 ? 's' : ''}`);
        if (data.time_added.months > 0) timeAdded.push(`${data.time_added.months} month${data.time_added.months > 1 ? 's' : ''}`);
        if (data.time_added.weeks > 0) timeAdded.push(`${data.time_added.weeks} week${data.time_added.weeks > 1 ? 's' : ''}`);
        if (data.time_added.days > 0) timeAdded.push(`${data.time_added.days} day${data.time_added.days > 1 ? 's' : ''}`);

        const timeString = timeAdded.join(', ');

        const resultsHTML = `
            <div class="result-header">
                <h2><i class="fas fa-calendar-check"></i> Calculation Result</h2>
                <p class="result-summary">
                    ${timeString} ${operationText} <strong>${data.start_date.formatted}</strong>
                </p>
            </div>

            <div class="result-main">
                <div class="result-card">
                    <h4>Result Date</h4>
                    <div class="result-value">${data.result_date.formatted}</div>
                    <p>${data.result_date.day_of_week}</p>
                </div>
                
                <div class="result-card">
                    <h4>Total Difference</h4>
                    <div class="result-value">${data.summary.total_days_difference} days</div>
                    <p>${data.summary.total_weeks_difference} weeks, ${data.summary.remaining_days} days</p>
                </div>
                
                <div class="result-card">
                    <h4>Time Direction</h4>
                    <div class="result-value ${data.summary.is_future ? 'future-date' : 'past-date'}">
                        ${data.summary.is_future ? 'Future Date' : 'Past Date'}
                    </div>
                    <p>${data.operation === 'add' ? 'Added time' : 'Subtracted time'}</p>
                </div>
            </div>

            <div class="detailed-breakdown">
                <h3><i class="fas fa-list-alt"></i> Detailed Breakdown</h3>
                <div class="breakdown-grid">
                    <div class="breakdown-item">
                        <strong>Start Date</strong><br>
                        ${data.start_date.formatted}<br>
                        <small>${data.start_date.day_of_week}</small>
                    </div>
                    <div class="breakdown-item">
                        <strong>Operation</strong><br>
                        ${data.operation === 'add' ? 'Addition' : 'Subtraction'}<br>
                        <small>${timeString}</small>
                    </div>
                    <div class="breakdown-item">
                        <strong>Result Date</strong><br>
                        ${data.result_date.formatted}<br>
                        <small>${data.result_date.day_of_week}</small>
                    </div>
                    <div class="breakdown-item">
                        <strong>Total Days</strong><br>
                        ${data.summary.total_days_difference}<br>
                        <small>days difference</small>
                    </div>
                </div>
                
                <div style="margin-top: 1.5rem; padding: 1rem; background: var(--bg-secondary); border-radius: var(--radius);">
                    <h4><i class="fas fa-info-circle"></i> Calculation Details</h4>
                    <ul style="list-style: none; padding: 0.5rem 0;">
                        <li>• Years: ${data.time_added.years}</li>
                        <li>• Months: ${data.time_added.months}</li>
                        <li>• Weeks: ${data.time_added.weeks}</li>
                        <li>• Days: ${data.time_added.days}</li>
                        <li>• Total Days Added: ${data.time_added.total_days}</li>
                    </ul>
                </div>
            </div>
        `;

        resultsSection.innerHTML = resultsHTML;
        resultsSection.style.display = 'block';
        
        // Smooth scroll to results
        resultsSection.scrollIntoView({ behavior: 'smooth' });
    }

    // Set min date to reasonable value and max to far future
    const startDateInput = document.getElementById('start_date');
    const today = new Date().toISOString().split('T')[0];
    startDateInput.min = '1900-01-01';
    startDateInput.max = '2100-12-31';
});
