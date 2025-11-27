class TimeZoneConverter {
    constructor() {
        this.timeZones = {};
        this.userTimeZone = Intl.DateTimeFormat().resolvedOptions().timeZone;
        this.favorites = JSON.parse(localStorage.getItem('timezoneFavorites')) || [];
        this.worldClocks = JSON.parse(localStorage.getItem('worldClocks')) || [];
        this.meetingParticipants = JSON.parse(localStorage.getItem('meetingParticipants')) || [];
        this.stats = JSON.parse(localStorage.getItem('timezoneStats')) || {
            totalConversions: 0,
            mostUsedFrom: '',
            mostUsedTo: ''
        };
        
        this.init();
    }

    init() {
        this.initializeEventListeners();
        this.loadTimeZones();
        this.startClocks();
        this.updateStatsDisplay();
        this.renderFavorites();
        this.renderWorldClocks();
        this.renderMeetingParticipants();
    }

    initializeEventListeners() {
        // Main conversion
        document.getElementById('convertTime').addEventListener('click', () => this.convertTime());
        document.getElementById('swapTimeZones').addEventListener('click', () => this.swapTimeZones());
        document.getElementById('resetConverter').addEventListener('click', () => this.resetConverter());
        document.getElementById('copyResult').addEventListener('click', () => this.copyResult());
        
        // Quick time buttons
        document.querySelectorAll('.quick-time-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const hours = parseInt(e.target.getAttribute('data-hours'));
                this.setQuickTime(hours);
            });
        });

        // Favorites
        document.getElementById('addToFavorites').addEventListener('click', () => this.addToFavorites());
        document.getElementById('clearFavorites').addEventListener('click', () => this.clearFavorites());

        // World clocks
        document.getElementById('addWorldClock').addEventListener('click', () => this.openAddClockModal());
        document.getElementById('manageClocks').addEventListener('click', () => this.manageWorldClocks());

        // Tools
        document.getElementById('calculateDifference').addEventListener('click', () => this.calculateTimeDifference());
        document.getElementById('calculateArrival').addEventListener('click', () => this.calculateArrivalTime());
        document.getElementById('addParticipant').addEventListener('click', () => this.openAddParticipantModal());
        document.getElementById('planMeeting').addEventListener('click', () => this.planMeeting());

        // Modal controls
        document.querySelectorAll('.close-modal').forEach(btn => {
            btn.addEventListener('click', () => this.hideModals());
        });

        document.getElementById('saveWorldClock').addEventListener('click', () => this.saveWorldClock());
        document.getElementById('saveParticipant').addEventListener('click', () => this.saveParticipant());

        // Map
        document.getElementById('refreshMap').addEventListener('click', () => this.refreshMap());

        // Enter key support
        document.getElementById('inputTimestamp').addEventListener('keypress', (e) => {
            if (e.key === 'Enter') this.convertTime();
        });

        // Auto-update on time/date change
        document.getElementById('inputDate').addEventListener('change', () => {
            if (document.getElementById('fromTimeZone').value && document.getElementById('toTimeZone').value) {
                this.convertTime();
            }
        });

        document.getElementById('inputTime').addEventListener('change', () => {
            if (document.getElementById('fromTimeZone').value && document.getElementById('toTimeZone').value) {
                this.convertTime();
            }
        });

        // Timezone select changes
        document.getElementById('fromTimeZone').addEventListener('change', () => {
            if (document.getElementById('fromTimeZone').value && document.getElementById('toTimeZone').value) {
                this.convertTime();
            }
        });

        document.getElementById('toTimeZone').addEventListener('change', () => {
            if (document.getElementById('fromTimeZone').value && document.getElementById('toTimeZone').value) {
                this.convertTime();
            }
        });
    }

    async loadTimeZones() {
        try {
            const response = await fetch('calculator.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    action: 'get_all_timezones'
                })
            });

            const data = await response.json();

            if (data.success) {
                this.timeZones = data.timezones;
                this.populateTimezoneSelects();
                this.setUserTimezone();
            } else {
                this.loadDefaultTimeZones();
            }
        } catch (error) {
            console.error('Error loading timezones:', error);
            this.loadDefaultTimeZones();
        }
    }

    loadDefaultTimeZones() {
        // Fallback timezones
        this.timeZones = {
            'UTC': 'UTC+00:00',
            'Europe/London': 'UTC+00:00',
            'Europe/Paris': 'UTC+01:00',
            'Europe/Berlin': 'UTC+01:00',
            'America/New_York': 'UTC-05:00',
            'America/Chicago': 'UTC-06:00',
            'America/Denver': 'UTC-07:00',
            'America/Los_Angeles': 'UTC-08:00',
            'Asia/Tokyo': 'UTC+09:00',
            'Asia/Shanghai': 'UTC+08:00',
            'Australia/Sydney': 'UTC+10:00'
        };
        this.populateTimezoneSelects();
        this.setUserTimezone();
    }

    populateTimezoneSelects() {
        const selects = [
            'fromTimeZone', 'toTimeZone', 'diffTimeZone1', 'diffTimeZone2',
            'departureZone', 'arrivalZone', 'newClockTimezone', 'participantTimezone'
        ];

        selects.forEach(selectId => {
            const select = document.getElementById(selectId);
            if (select) {
                // Clear existing options except the first one
                while (select.options.length > 1) {
                    select.remove(1);
                }

                // Add timezone options
                Object.entries(this.timeZones).forEach(([tz, offset]) => {
                    const option = document.createElement('option');
                    option.value = tz;
                    option.textContent = `${tz} (${offset})`;
                    select.appendChild(option);
                });
            }
        });
    }

    setUserTimezone() {
        // Try to find user's timezone in our list
        let userTZ = this.userTimeZone;
        if (!this.timeZones[userTZ]) {
            // Find closest match
            for (const tz in this.timeZones) {
                if (tz.includes(userTZ.split('/')[1])) {
                    userTZ = tz;
                    break;
                }
            }
        }

        document.getElementById('fromTimeZone').value = userTZ;
        document.getElementById('userTimeZone').textContent = userTZ;
        
        // Set a common destination timezone (e.g., UTC)
        document.getElementById('toTimeZone').value = 'UTC';
    }

    startClocks() {
        // Update current time every second
        setInterval(() => {
            this.updateCurrentTime();
            this.updateWorldClocks();
        }, 1000);

        this.updateCurrentTime();
    }

    updateCurrentTime() {
        const now = new Date();
        
        // Update header current time
        document.getElementById('currentTime').textContent = now.toLocaleTimeString('en-US', {
            hour12: false,
            hour: '2-digit',
            minute: '2-digit'
        });

        // Update current date time display
        document.getElementById('currentDateTime').textContent = now.toLocaleString('en-US', {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit'
        });

        // Update UTC time
        document.getElementById('utcTime').textContent = now.toUTCString().split(' ')[4];

        // Update input fields with current time if empty
        if (!document.getElementById('inputDate').value) {
            document.getElementById('inputDate').value = now.toISOString().split('T')[0];
        }
        if (!document.getElementById('inputTime').value) {
            document.getElementById('inputTime').value = now.toTimeString().split(' ')[0].substring(0, 5);
        }

        // Update timezone offset
        const offset = -now.getTimezoneOffset() / 60;
        document.getElementById('timezoneOffset').textContent = `UTC${offset >= 0 ? '+' : ''}${offset}`;

        // Update DST info
        this.updateDSTInfo();
    }

    updateDSTInfo() {
        const now = new Date();
        const jan = new Date(now.getFullYear(), 0, 1);
        const jul = new Date(now.getFullYear(), 6, 1);
        const isDST = now.getTimezoneOffset() < Math.max(jan.getTimezoneOffset(), jul.getTimezoneOffset());
        
        document.getElementById('daylightSaving').textContent = isDST ? 'Yes' : 'No';
        
        const statusElement = document.getElementById('daylightStatus');
        statusElement.querySelector('span').textContent = isDST ? 'Daylight Saving Time Active' : 'Standard Time';
        statusElement.querySelector('.status-indicator').className = `status-indicator ${isDST ? '' : 'inactive'}`;
        
        document.getElementById('currentDstOffset').textContent = isDST ? '+1 hour' : 'No offset';
    }

    setQuickTime(hours) {
        const now = new Date();
        
        if (hours === 0) {
            // Now - set current time
            document.getElementById('inputDate').value = now.toISOString().split('T')[0];
            document.getElementById('inputTime').value = now.toTimeString().split(' ')[0].substring(0, 5);
        } else {
            // Add/subtract hours
            const newTime = new Date(now.getTime() + hours * 60 * 60 * 1000);
            document.getElementById('inputDate').value = newTime.toISOString().split('T')[0];
            document.getElementById('inputTime').value = newTime.toTimeString().split(' ')[0].substring(0, 5);
        }

        // Clear timestamp
        document.getElementById('inputTimestamp').value = '';

        // Convert if timezones are selected
        if (document.getElementById('fromTimeZone').value && document.getElementById('toTimeZone').value) {
            this.convertTime();
        }
    }

    async convertTime() {
        const fromZone = document.getElementById('fromTimeZone').value;
        const toZone = document.getElementById('toTimeZone').value;
        const date = document.getElementById('inputDate').value;
        const time = document.getElementById('inputTime').value;
        const timestamp = document.getElementById('inputTimestamp').value || null;

        if (!fromZone || !toZone) {
            this.showNotification('Please select both time zones', 'warning');
            return;
        }

        if (!date || !time) {
            this.showNotification('Please enter a date and time', 'warning');
            return;
        }

        try {
            const response = await fetch('calculator.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    action: 'convert',
                    fromZone: fromZone,
                    toZone: toZone,
                    date: date,
                    time: time,
                    timestamp: timestamp
                })
            });

            const data = await response.json();

            if (data.success) {
                this.displayConversionResult(data);
                this.updateStats(fromZone, toZone);
            } else {
                throw new Error(data.error || 'Conversion failed');
            }
        } catch (error) {
            console.error('Error:', error);
            this.convertTimeClientSide(fromZone, toZone, date, time, timestamp);
        }
    }

    convertTimeClientSide(fromZone, toZone, date, time, timestamp) {
        try {
            let sourceTime;
            
            if (timestamp) {
                sourceTime = new Date(parseInt(timestamp) * 1000);
            } else {
                sourceTime = new Date(`${date}T${time}`);
            }

            // Format for display
            const fromTimeStr = sourceTime.toLocaleString('en-US', {
                timeZone: fromZone,
                weekday: 'short',
                month: 'short',
                day: 'numeric',
                year: 'numeric',
                hour: 'numeric',
                minute: '2-digit',
                hour12: true
            });

            const toTime = new Date(sourceTime.toLocaleString('en-US', { timeZone: toZone }));
            const toTimeStr = toTime.toLocaleString('en-US', {
                timeZone: toZone,
                weekday: 'short',
                month: 'short',
                day: 'numeric',
                year: 'numeric',
                hour: 'numeric',
                minute: '2-digit',
                hour12: true
            });

            // Calculate offset difference
            const fromOffset = -sourceTime.getTimezoneOffset() / 60;
            const toOffset = -toTime.getTimezoneOffset() / 60;
            const difference = toOffset - fromOffset;

            const result = {
                success: true,
                original: {
                    timezone: fromZone,
                    formatted: fromTimeStr,
                    offset: `UTC${fromOffset >= 0 ? '+' : ''}${fromOffset}`
                },
                converted: {
                    timezone: toZone,
                    formatted: toTimeStr,
                    offset: `UTC${toOffset >= 0 ? '+' : ''}${toOffset}`
                },
                difference: {
                    hours: difference,
                    formatted: `UTC${difference >= 0 ? '+' : ''}${difference}`
                }
            };

            this.displayConversionResult(result);
            this.updateStats(fromZone, toZone);
        } catch (error) {
            this.showNotification('Error converting time. Please check your inputs.', 'error');
        }
    }

    displayConversionResult(data) {
        const resultContainer = document.getElementById('conversionResult');
        
        resultContainer.innerHTML = `
            <div class="conversion-success">
                <div class="converted-time">${data.converted.formatted.split(', ')[2]}</div>
                <div class="converted-date">${data.converted.formatted.split(', ').slice(0, 2).join(', ')}</div>
                <div class="timezone-info">
                    <strong>${data.converted.timezone}</strong> (${data.converted.offset})
                </div>
                <div class="time-difference">
                    ${data.difference.hours > 0 ? 'Ahead by' : 'Behind by'} ${Math.abs(data.difference.hours)} hours
                </div>
            </div>
        `;

        // Enable copy button
        document.getElementById('copyResult').disabled = false;
    }

    swapTimeZones() {
        const fromZone = document.getElementById('fromTimeZone');
        const toZone = document.getElementById('toTimeZone');
        
        const tempValue = fromZone.value;
        fromZone.value = toZone.value;
        toZone.value = tempValue;

        // Convert immediately if both timezones are set
        if (fromZone.value && toZone.value) {
            this.convertTime();
        }
    }

    resetConverter() {
        document.getElementById('inputDate').value = '';
        document.getElementById('inputTime').value = '';
        document.getElementById('inputTimestamp').value = '';
        document.getElementById('conversionResult').innerHTML = `
            <div class="result-placeholder">
                Select time zones and enter time to convert
            </div>
        `;
        document.getElementById('copyResult').disabled = true;
    }

    copyResult() {
        const resultText = document.querySelector('.converted-time')?.textContent;
        if (resultText) {
            navigator.clipboard.writeText(resultText).then(() => {
                this.showNotification('Converted time copied to clipboard!', 'success');
            });
        }
    }

    addToFavorites() {
        const fromZone = document.getElementById('fromTimeZone').value;
        const toZone = document.getElementById('toTimeZone').value;
        const date = document.getElementById('inputDate').value;
        const time = document.getElementById('inputTime').value;

        if (!fromZone || !toZone || !date || !time) {
            this.showNotification('Please complete the conversion first', 'warning');
            return;
        }

        const favorite = {
            id: Date.now(),
            fromZone: fromZone,
            toZone: toZone,
            date: date,
            time: time,
            timestamp: new Date().toISOString()
        };

        this.favorites.unshift(favorite);
        
        // Keep only last 20 favorites
        if (this.favorites.length > 20) {
            this.favorites = this.favorites.slice(0, 20);
        }

        this.saveFavorites();
        this.renderFavorites();
        this.showNotification('Conversion saved to favorites!', 'success');
    }

    renderFavorites() {
        const favoritesGrid = document.getElementById('favoritesGrid');
        
        if (this.favorites.length === 0) {
            favoritesGrid.innerHTML = `
                <div class="favorite-item" style="grid-column: 1 / -1; text-align: center; padding: 40px;">
                    <p style="color: var(--text-secondary);">No saved conversions yet</p>
                    <small>Complete a conversion and click "Save Conversion" to add it here</small>
                </div>
            `;
            return;
        }

        favoritesGrid.innerHTML = this.favorites.map(fav => `
            <div class="favorite-item">
                <div class="favorite-conversion">
                    <div class="conversion-from">
                        <span class="conversion-label">From:</span>
                        <span class="conversion-time">${fav.time}</span>
                    </div>
                    <div class="conversion-timezone">${fav.fromZone}</div>
                    
                    <div class="conversion-to">
                        <span class="conversion-label">To:</span>
                        <span class="conversion-time">${fav.time}</span>
                    </div>
                    <div class="conversion-timezone">${fav.toZone}</div>
                </div>
                <div class="favorite-actions">
                    <button class="use-favorite-btn" onclick="timeZoneConverter.useFavorite(${fav.id})">
                        <i class="fas fa-play"></i> Use
                    </button>
                </div>
            </div>
        `).join('');
    }

    useFavorite(favoriteId) {
        const favorite = this.favorites.find(fav => fav.id === favoriteId);
        if (favorite) {
            document.getElementById('fromTimeZone').value = favorite.fromZone;
            document.getElementById('toTimeZone').value = favorite.toZone;
            document.getElementById('inputDate').value = favorite.date;
            document.getElementById('inputTime').value = favorite.time;
            document.getElementById('inputTimestamp').value = '';
            
            this.convertTime();
        }
    }

    clearFavorites() {
        if (this.favorites.length === 0) return;
        
        if (confirm('Are you sure you want to clear all saved conversions?')) {
            this.favorites = [];
            this.saveFavorites();
            this.renderFavorites();
            this.showNotification('Favorites cleared', 'success');
        }
    }

    saveFavorites() {
        localStorage.setItem('timezoneFavorites', JSON.stringify(this.favorites));
    }

    // World Clocks Methods
    openAddClockModal() {
        document.getElementById('addClockModal').classList.add('active');
    }

    async saveWorldClock() {
        const timezone = document.getElementById('newClockTimezone').value;
        const label = document.getElementById('newClockLabel').value;

        if (!timezone) {
            this.showNotification('Please select a time zone', 'warning');
            return;
        }

        const clock = {
            id: Date.now(),
            timezone: timezone,
            label: label || timezone
        };

        this.worldClocks.push(clock);
        this.saveWorldClocks();
        this.renderWorldClocks();
        this.hideModals();
        this.showNotification('World clock added!', 'success');
    }

    renderWorldClocks() {
        const clocksGrid = document.getElementById('worldClocks');
        
        if (this.worldClocks.length === 0) {
            clocksGrid.innerHTML = `
                <div class="clock-item">
                    <div class="clock-info">
                        <div class="clock-time">--:--</div>
                        <div class="clock-date">---</div>
                        <div class="clock-timezone">Add clocks to see world times</div>
                    </div>
                    <div class="clock-offset">--:--</div>
                </div>
            `;
            return;
        }

        // Update clocks with current times
        this.updateWorldClocks();
    }

    updateWorldClocks() {
        const clocksGrid = document.getElementById('worldClocks');
        
        if (this.worldClocks.length === 0) return;

        clocksGrid.innerHTML = this.worldClocks.map(clock => {
            try {
                const now = new Date();
                const options = { 
                    timeZone: clock.timezone,
                    hour12: true,
                    hour: 'numeric',
                    minute: '2-digit'
                };
                
                const time = now.toLocaleTimeString('en-US', options);
                const date = now.toLocaleDateString('en-US', {
                    timeZone: clock.timezone,
                    weekday: 'short',
                    month: 'short',
                    day: 'numeric'
                });
                
                const offset = -now.getTimezoneOffset() / 60;
                
                return `
                    <div class="clock-item">
                        <div class="clock-info">
                            <div class="clock-time">${time}</div>
                            <div class="clock-date">${date}</div>
                            <div class="clock-timezone">${clock.label}</div>
                        </div>
                        <div class="clock-offset">UTC${offset >= 0 ? '+' : ''}${offset}</div>
                    </div>
                `;
            } catch (error) {
                return `
                    <div class="clock-item">
                        <div class="clock-info">
                            <div class="clock-time">--:--</div>
                            <div class="clock-date">---</div>
                            <div class="clock-timezone">Invalid timezone</div>
                        </div>
                        <div class="clock-offset">--:--</div>
                    </div>
                `;
            }
        }).join('');
    }

    manageWorldClocks() {
        // Simple management - just clear all for now
        if (this.worldClocks.length > 0 && confirm('Clear all world clocks?')) {
            this.worldClocks = [];
            this.saveWorldClocks();
            this.renderWorldClocks();
            this.showNotification('World clocks cleared', 'success');
        }
    }

    saveWorldClocks() {
        localStorage.setItem('worldClocks', JSON.stringify(this.worldClocks));
    }

    // Tools Methods
    async calculateTimeDifference() {
        const zone1 = document.getElementById('diffTimeZone1').value;
        const zone2 = document.getElementById('diffTimeZone2').value;

        if (!zone1 || !zone2) {
            this.showNotification('Please select both time zones', 'warning');
            return;
        }

        try {
            const response = await fetch('calculator.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    action: 'time_difference',
                    zone1: zone1,
                    zone2: zone2
                })
            });

            const data = await response.json();

            if (data.success) {
                this.displayTimeDifference(data);
            } else {
                throw new Error(data.error);
            }
        } catch (error) {
            console.error('Error:', error);
            this.calculateTimeDifferenceClientSide(zone1, zone2);
        }
    }

    calculateTimeDifferenceClientSide(zone1, zone2) {
        try {
            const now = new Date();
            const time1 = now.toLocaleString('en-US', { timeZone: zone1 });
            const time2 = now.toLocaleString('en-US', { timeZone: zone2 });
            
            const date1 = new Date(time1);
            const date2 = new Date(time2);
            const difference = (date2 - date1) / (1000 * 60 * 60);

            const result = {
                success: true,
                difference: {
                    hours: difference,
                    formatted: `UTC${difference >= 0 ? '+' : ''}${difference}`,
                    ahead: difference > 0
                }
            };

            this.displayTimeDifference(result);
        } catch (error) {
            this.showNotification('Error calculating time difference', 'error');
        }
    }

    displayTimeDifference(data) {
        const resultContainer = document.getElementById('timeDifferenceResult');
        const absDifference = Math.abs(data.difference.hours);
        
        resultContainer.innerHTML = `
            <div class="difference-info">
                <div class="difference-value">${data.difference.formatted}</div>
                <div class="difference-details">
                    ${data.difference.ahead ? 'Ahead by' : 'Behind by'} ${absDifference} hour${absDifference !== 1 ? 's' : ''}
                </div>
            </div>
        `;
    }

    // Meeting Planner Methods
    openAddParticipantModal() {
        document.getElementById('addParticipantModal').classList.add('active');
    }

    saveParticipant() {
        const name = document.getElementById('participantName').value;
        const timezone = document.getElementById('participantTimezone').value;
        const startTime = document.getElementById('participantStartTime').value;
        const endTime = document.getElementById('participantEndTime').value;

        if (!name || !timezone) {
            this.showNotification('Please enter name and select timezone', 'warning');
            return;
        }

        const participant = {
            id: Date.now(),
            name: name,
            timezone: timezone,
            working_hours: {
                start: startTime,
                end: endTime
            }
        };

        this.meetingParticipants.push(participant);
        this.saveParticipants();
        this.renderMeetingParticipants();
        this.hideModals();
        this.showNotification('Participant added!', 'success');
    }

    renderMeetingParticipants() {
        const participantsList = document.getElementById('participantsList');
        
        if (this.meetingParticipants.length === 0) {
            participantsList.innerHTML = `
                <div class="participant-item">
                    <div class="participant-info">
                        <div class="participant-name">No participants added</div>
                        <div class="participant-timezone">Add participants to plan meeting</div>
                    </div>
                </div>
            `;
            return;
        }

        participantsList.innerHTML = this.meetingParticipants.map(participant => `
            <div class="participant-item">
                <div class="participant-info">
                    <div class="participant-name">${participant.name}</div>
                    <div class="participant-timezone">${participant.timezone}</div>
                </div>
                <div class="participant-actions">
                    <button class="delete-btn" onclick="timeZoneConverter.deleteParticipant(${participant.id})">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        `).join('');
    }

    deleteParticipant(participantId) {
        this.meetingParticipants = this.meetingParticipants.filter(p => p.id !== participantId);
        this.saveParticipants();
        this.renderMeetingParticipants();
    }

    async planMeeting() {
        const meetingTime = document.getElementById('meetingTime').value;
        const duration = document.getElementById('meetingDuration').value;

        if (!meetingTime) {
            this.showNotification('Please select meeting time', 'warning');
            return;
        }

        if (this.meetingParticipants.length === 0) {
            this.showNotification('Please add at least one participant', 'warning');
            return;
        }

        try {
            const response = await fetch('calculator.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    action: 'plan_meeting',
                    meetingTime: meetingTime,
                    duration: parseInt(duration),
                    participants: this.meetingParticipants
                })
            });

            const data = await response.json();

            if (data.success) {
                this.displayMeetingPlan(data);
            } else {
                throw new Error(data.error);
            }
        } catch (error) {
            console.error('Error:', error);
            this.showNotification('Error planning meeting', 'error');
        }
    }

    displayMeetingPlan(data) {
        // This would display the meeting plan in a modal or result area
        console.log('Meeting plan:', data);
        this.showNotification('Meeting planned successfully!', 'success');
    }

    saveParticipants() {
        localStorage.setItem('meetingParticipants', JSON.stringify(this.meetingParticipants));
    }

    // Travel Planner Methods
    async calculateArrivalTime() {
        const departureZone = document.getElementById('departureZone').value;
        const arrivalZone = document.getElementById('arrivalZone').value;
        const departureTime = document.getElementById('departureTime').value;
        const flightDuration = document.getElementById('flightDuration').value;

        if (!departureZone || !arrivalZone || !departureTime || !flightDuration) {
            this.showNotification('Please complete all flight details', 'warning');
            return;
        }

        try {
            const response = await fetch('calculator.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    action: 'calculate_arrival',
                    departureZone: departureZone,
                    arrivalZone: arrivalZone,
                    departureTime: departureTime,
                    flightDuration: flightDuration
                })
            });

            const data = await response.json();

            if (data.success) {
                this.displayArrivalTime(data);
            } else {
                throw new Error(data.error);
            }
        } catch (error) {
            console.error('Error:', error);
            this.calculateArrivalTimeClientSide(departureZone, arrivalZone, departureTime, flightDuration);
        }
    }

    calculateArrivalTimeClientSide(departureZone, arrivalZone, departureTime, flightDuration) {
        try {
            const [hours, minutes] = flightDuration.split(':').map(Number);
            const durationMs = (hours * 60 + minutes) * 60 * 1000;
            
            const departure = new Date(departureTime);
            const arrival = new Date(departure.getTime() + durationMs);
            
            // Convert to arrival timezone for display
            const arrivalTimeStr = arrival.toLocaleString('en-US', {
                timeZone: arrivalZone,
                weekday: 'short',
                month: 'short',
                day: 'numeric',
                hour: 'numeric',
                minute: '2-digit',
                hour12: true
            });

            const result = {
                success: true,
                arrival: {
                    local: arrivalTimeStr.split(', ')[2]
                },
                flight: {
                    duration: flightDuration
                }
            };

            this.displayArrivalTime(result);
        } catch (error) {
            this.showNotification('Error calculating arrival time', 'error');
        }
    }

    displayArrivalTime(data) {
        const resultContainer = document.getElementById('travelResult');
        
        resultContainer.innerHTML = `
            <div class="travel-info">
                <div class="arrival-time">${data.arrival.local}</div>
                <div class="flight-duration">Flight time: ${data.flight.duration}</div>
            </div>
        `;
    }

    // Map Methods
    refreshMap() {
        this.showNotification('Map refreshed', 'info');
        // In a real implementation, this would refresh the timezone map data
    }

    // Stats Methods
    updateStats(fromZone, toZone) {
        this.stats.totalConversions++;
        
        // Track most used timezones
        if (!this.stats.mostUsedFrom) this.stats.mostUsedFrom = {};
        if (!this.stats.mostUsedTo) this.stats.mostUsedTo = {};
        
        this.stats.mostUsedFrom[fromZone] = (this.stats.mostUsedFrom[fromZone] || 0) + 1;
        this.stats.mostUsedTo[toZone] = (this.stats.mostUsedTo[toZone] || 0) + 1;
        
        localStorage.setItem('timezoneStats', JSON.stringify(this.stats));
        this.updateStatsDisplay();
    }

    updateStatsDisplay() {
        document.getElementById('totalConversions').textContent = this.stats.totalConversions;
        document.getElementById('timeZonesCount').textContent = Object.keys(this.timeZones).length;
    }

    // Utility Methods
    hideModals() {
        document.querySelectorAll('.modal').forEach(modal => {
            modal.classList.remove('active');
        });
        
        // Clear modal forms
        document.getElementById('newClockLabel').value = '';
        document.getElementById('participantName').value = '';
    }

    showNotification(message, type = 'info') {
        // Remove existing notifications
        const existingNotification = document.querySelector('.notification');
        if (existingNotification) {
            existingNotification.remove();
        }

        const notification = document.createElement('div');
        notification.className = `notification ${type}`;
        notification.innerHTML = `
            <div class="notification-content">
                <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : type === 'warning' ? 'exclamation-triangle' : 'info-circle'}"></i>
                <span>${message}</span>
            </div>
        `;

        // Add styles
        notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            background: ${type === 'success' ? '#10b981' : type === 'error' ? '#ef4444' : type === 'warning' ? '#f59e0b' : '#3b82f6'};
            color: white;
            padding: 16px 20px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            z-index: 1000;
            transform: translateX(100%);
            transition: transform 0.3s ease;
            max-width: 300px;
        `;

        document.body.appendChild(notification);

        // Animate in
        setTimeout(() => {
            notification.style.transform = 'translateX(0)';
        }, 100);

        // Auto remove after 5 seconds
        setTimeout(() => {
            notification.style.transform = 'translateX(100%)';
            setTimeout(() => notification.remove(), 300);
        }, 5000);
    }
}

// Initialize the application
const timeZoneConverter = new TimeZoneConverter();

// Make available globally for onclick handlers
window.timeZoneConverter = timeZoneConverter;