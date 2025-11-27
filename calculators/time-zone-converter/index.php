<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Time Zone Converter - Convert Between Time Zones</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <header class="header">
            <div class="header-content">
                <h1><i class="fas fa-globe-americas"></i> Time Zone Converter</h1>
                <p>Convert times between different time zones around the world</p>
            </div>
            <div class="header-stats">
                <div class="stat">
                    <span class="stat-number" id="totalConversions">0</span>
                    <span class="stat-label">Conversions</span>
                </div>
                <div class="stat">
                    <span class="stat-number" id="currentTime">--:--</span>
                    <span class="stat-label">Your Time</span>
                </div>
                <div class="stat">
                    <span class="stat-number" id="timeZonesCount">0</span>
                    <span class="stat-label">Zones</span>
                </div>
            </div>
        </header>

        <div class="main-content">
            <div class="converter-section">
                <div class="converter-card">
                    <div class="converter-header">
                        <h3>Time Zone Converter</h3>
                        <div class="time-display">
                            <span id="currentDateTime">Loading...</span>
                        </div>
                    </div>

                    <div class="converter-form">
                        <div class="input-section">
                            <div class="input-group">
                                <label for="fromTimeZone">From Time Zone</label>
                                <select id="fromTimeZone">
                                    <option value="">Select time zone...</option>
                                    <!-- Time zones will be populated by JavaScript -->
                                </select>
                            </div>

                            <div class="time-inputs">
                                <div class="input-group">
                                    <label for="inputDate">Date</label>
                                    <input type="date" id="inputDate">
                                </div>
                                <div class="input-group">
                                    <label for="inputTime">Time</label>
                                    <input type="time" id="inputTime" step="1">
                                </div>
                                <div class="input-group">
                                    <label for="inputTimestamp">Or Timestamp</label>
                                    <input type="number" id="inputTimestamp" placeholder="Unix timestamp">
                                </div>
                            </div>

                            <div class="quick-times">
                                <button class="quick-time-btn" data-hours="0">Now</button>
                                <button class="quick-time-btn" data-hours="1">+1 Hour</button>
                                <button class="quick-time-btn" data-hours="-1">-1 Hour</button>
                                <button class="quick-time-btn" data-hours="24">Tomorrow</button>
                                <button class="quick-time-btn" data-hours="-24">Yesterday</button>
                            </div>
                        </div>

                        <div class="swap-button">
                            <button id="swapTimeZones" class="swap-btn">
                                <i class="fas fa-exchange-alt"></i>
                            </button>
                        </div>

                        <div class="output-section">
                            <div class="input-group">
                                <label for="toTimeZone">To Time Zone</label>
                                <select id="toTimeZone">
                                    <option value="">Select time zone...</option>
                                    <!-- Time zones will be populated by JavaScript -->
                                </select>
                            </div>

                            <div class="conversion-result">
                                <div class="result-card">
                                    <div class="result-header">
                                        <h4>Converted Time</h4>
                                        <button id="copyResult" class="copy-btn">
                                            <i class="fas fa-copy"></i> Copy
                                        </button>
                                    </div>
                                    <div class="result-display" id="conversionResult">
                                        <div class="result-placeholder">
                                            Select time zones and enter time to convert
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="action-buttons">
                        <button id="convertTime" class="convert-btn">
                            <i class="fas fa-sync-alt"></i> Convert Time
                        </button>
                        <button id="addToFavorites" class="favorite-btn">
                            <i class="far fa-star"></i> Save Conversion
                        </button>
                        <button id="resetConverter" class="reset-btn">
                            <i class="fas fa-redo"></i> Reset
                        </button>
                    </div>
                </div>

                <div class="world-clock-card">
                    <h3>World Clocks</h3>
                    <div class="clocks-grid" id="worldClocks">
                        <!-- World clocks will be populated here -->
                    </div>
                    <div class="clocks-actions">
                        <button id="addWorldClock" class="btn-secondary">
                            <i class="fas fa-plus"></i> Add Clock
                        </button>
                        <button id="manageClocks" class="btn-secondary">
                            <i class="fas fa-cog"></i> Manage
                        </button>
                    </div>
                </div>
            </div>

            <div class="tools-section">
                <div class="tools-grid">
                    <div class="tool-card">
                        <h3><i class="fas fa-clock"></i> Time Difference</h3>
                        <div class="time-difference-calculator">
                            <div class="difference-inputs">
                                <div class="input-group">
                                    <label>First Time Zone</label>
                                    <select id="diffTimeZone1">
                                        <option value="">Select time zone...</option>
                                    </select>
                                </div>
                                <div class="input-group">
                                    <label>Second Time Zone</label>
                                    <select id="diffTimeZone2">
                                        <option value="">Select time zone...</option>
                                    </select>
                                </div>
                            </div>
                            <div class="difference-result" id="timeDifferenceResult">
                                <div class="difference-placeholder">
                                    Select two time zones to see difference
                                </div>
                            </div>
                            <button id="calculateDifference" class="btn-primary">
                                Calculate Difference
                            </button>
                        </div>
                    </div>

                    <div class="tool-card">
                        <h3><i class="fas fa-calendar-alt"></i> Meeting Planner</h3>
                        <div class="meeting-planner">
                            <div class="planner-inputs">
                                <div class="input-group">
                                    <label for="meetingTime">Meeting Time</label>
                                    <input type="datetime-local" id="meetingTime">
                                </div>
                                <div class="input-group">
                                    <label for="meetingDuration">Duration</label>
                                    <select id="meetingDuration">
                                        <option value="30">30 minutes</option>
                                        <option value="60" selected>1 hour</option>
                                        <option value="90">1.5 hours</option>
                                        <option value="120">2 hours</option>
                                        <option value="180">3 hours</option>
                                    </select>
                                </div>
                            </div>
                            <div class="participants-list" id="participantsList">
                                <!-- Participants will be added here -->
                            </div>
                            <div class="planner-actions">
                                <button id="addParticipant" class="btn-secondary">
                                    <i class="fas fa-user-plus"></i> Add Participant
                                </button>
                                <button id="planMeeting" class="btn-primary">
                                    Plan Meeting
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="tool-card">
                        <h3><i class="fas fa-plane"></i> Travel Planner</h3>
                        <div class="travel-planner">
                            <div class="travel-inputs">
                                <div class="input-group">
                                    <label for="departureZone">Departure Time Zone</label>
                                    <select id="departureZone">
                                        <option value="">Select time zone...</option>
                                    </select>
                                </div>
                                <div class="input-group">
                                    <label for="arrivalZone">Arrival Time Zone</label>
                                    <select id="arrivalZone">
                                        <option value="">Select time zone...</option>
                                    </select>
                                </div>
                                <div class="input-group">
                                    <label for="flightDuration">Flight Duration</label>
                                    <input type="text" id="flightDuration" placeholder="HH:MM" value="02:30">
                                </div>
                                <div class="input-group">
                                    <label for="departureTime">Departure Time</label>
                                    <input type="datetime-local" id="departureTime">
                                </div>
                            </div>
                            <div class="travel-result" id="travelResult">
                                <div class="travel-placeholder">
                                    Enter flight details to calculate arrival time
                                </div>
                            </div>
                            <button id="calculateArrival" class="btn-primary">
                                Calculate Arrival
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="timezone-info">
                <div class="info-card">
                    <h3><i class="fas fa-info-circle"></i> Time Zone Information</h3>
                    <div class="info-content">
                        <div class="info-grid">
                            <div class="info-item">
                                <span class="info-label">Current UTC Time</span>
                                <span class="info-value" id="utcTime">--:--:--</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Your Time Zone</span>
                                <span class="info-value" id="userTimeZone">Detecting...</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Daylight Saving</span>
                                <span class="info-value" id="daylightSaving">--</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Timezone Offset</span>
                                <span class="info-value" id="timezoneOffset">--</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="daylight-card">
                    <h3><i class="fas fa-sun"></i> Daylight Saving Time</h3>
                    <div class="daylight-content">
                        <div class="daylight-status" id="daylightStatus">
                            <div class="status-indicator"></div>
                            <span>Checking DST status...</span>
                        </div>
                        <div class="daylight-schedule">
                            <div class="schedule-item">
                                <span>Next DST Change:</span>
                                <span id="nextDstChange">--</span>
                            </div>
                            <div class="schedule-item">
                                <span>Current DST Offset:</span>
                                <span id="currentDstOffset">--</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="favorites-section">
                <div class="section-header">
                    <h3>Saved Conversions</h3>
                    <button id="clearFavorites" class="clear-btn">
                        <i class="fas fa-trash"></i> Clear All
                    </button>
                </div>
                <div class="favorites-grid" id="favoritesGrid">
                    <!-- Favorite conversions will be populated here -->
                </div>
            </div>

            <div class="timezone-map">
                <div class="section-header">
                    <h3>World Time Zones Map</h3>
                    <div class="map-controls">
                        <button id="refreshMap" class="btn-secondary">
                            <i class="fas fa-sync-alt"></i> Refresh
                        </button>
                    </div>
                </div>
                <div class="map-container">
                    <div class="map-placeholder" id="timezoneMap">
                        <div class="map-overlay">
                            <i class="fas fa-globe-americas fa-3x"></i>
                            <p>Interactive Time Zone Map</p>
                            <small>Time zones would be displayed here</small>
                        </div>
                    </div>
                    <div class="map-legend">
                        <div class="legend-item">
                            <div class="legend-color utc"></div>
                            <span>UTC/GMT</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-color positive"></div>
                            <span>UTC+</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-color negative"></div>
                            <span>UTC-</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-color dst"></div>
                            <span>Daylight Saving</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add World Clock Modal -->
    <div class="modal" id="addClockModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Add World Clock</h3>
                <button class="close-modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="modal-form">
                    <div class="input-group">
                        <label for="newClockTimezone">Time Zone</label>
                        <select id="newClockTimezone">
                            <option value="">Select time zone...</option>
                        </select>
                    </div>
                    <div class="input-group">
                        <label for="newClockLabel">Label (Optional)</label>
                        <input type="text" id="newClockLabel" placeholder="e.g., London Office">
                    </div>
                </div>
                <div class="modal-actions">
                    <button id="saveWorldClock" class="btn-primary">Add Clock</button>
                    <button class="btn-secondary close-modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Meeting Participant Modal -->
    <div class="modal" id="addParticipantModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Add Meeting Participant</h3>
                <button class="close-modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="modal-form">
                    <div class="input-group">
                        <label for="participantName">Name</label>
                        <input type="text" id="participantName" placeholder="Participant name">
                    </div>
                    <div class="input-group">
                        <label for="participantTimezone">Time Zone</label>
                        <select id="participantTimezone">
                            <option value="">Select time zone...</option>
                        </select>
                    </div>
                    <div class="input-group">
                        <label for="participantWorkingHours">Working Hours (Optional)</label>
                        <div class="working-hours">
                            <input type="time" id="participantStartTime" value="09:00">
                            <span>to</span>
                            <input type="time" id="participantEndTime" value="17:00">
                        </div>
                    </div>
                </div>
                <div class="modal-actions">
                    <button id="saveParticipant" class="btn-primary">Add Participant</button>
                    <button class="btn-secondary close-modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Time Zone Details Modal -->
    <div class="modal" id="timezoneDetailsModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Time Zone Details</h3>
                <button class="close-modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="timezone-details" id="timezoneDetails">
                    <!-- Details will be populated here -->
                </div>
                <div class="modal-actions">
                    <button class="btn-secondary close-modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>