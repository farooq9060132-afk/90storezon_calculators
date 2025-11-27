<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Study Planner - Organize Your Learning</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <header class="header">
            <div class="header-content">
                <h1><i class="fas fa-book-open"></i> Study Planner</h1>
                <p>Organize your studies, track progress, and achieve your goals</p>
            </div>
            <div class="header-stats">
                <div class="stat">
                    <span class="stat-number" id="totalSubjects">0</span>
                    <span class="stat-label">Subjects</span>
                </div>
                <div class="stat">
                    <span class="stat-number" id="totalTasks">0</span>
                    <span class="stat-label">Tasks</span>
                </div>
                <div class="stat">
                    <span class="stat-number" id="completedTasks">0</span>
                    <span class="stat-label">Completed</span>
                </div>
            </div>
        </header>

        <div class="main-content">
            <div class="sidebar">
                <div class="sidebar-section">
                    <h3>Quick Actions</h3>
                    <button class="sidebar-btn active" data-tab="dashboard">
                        <i class="fas fa-home"></i> Dashboard
                    </button>
                    <button class="sidebar-btn" data-tab="subjects">
                        <i class="fas fa-book"></i> Subjects
                    </button>
                    <button class="sidebar-btn" data-tab="schedule">
                        <i class="fas fa-calendar"></i> Schedule
                    </button>
                    <button class="sidebar-btn" data-tab="tasks">
                        <i class="fas fa-tasks"></i> Tasks
                    </button>
                </div>

                <div class="sidebar-section">
                    <h3>Study Sessions</h3>
                    <div class="session-timer">
                        <div class="timer-display" id="timerDisplay">25:00</div>
                        <div class="timer-controls">
                            <button id="startTimer" class="timer-btn start">
                                <i class="fas fa-play"></i>
                            </button>
                            <button id="pauseTimer" class="timer-btn pause">
                                <i class="fas fa-pause"></i>
                            </button>
                            <button id="resetTimer" class="timer-btn reset">
                                <i class="fas fa-redo"></i>
                            </button>
                        </div>
                        <div class="timer-presets">
                            <button class="preset-btn" data-minutes="25">25 min</button>
                            <button class="preset-btn" data-minutes="45">45 min</button>
                            <button class="preset-btn" data-minutes="60">60 min</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content-area">
                <!-- Dashboard Tab -->
                <div class="tab-content active" id="dashboardTab">
                    <div class="tab-header">
                        <h2>Study Dashboard</h2>
                        <p>Overview of your study progress and upcoming tasks</p>
                    </div>

                    <div class="dashboard-grid">
                        <div class="dashboard-card progress-card">
                            <h3>Weekly Progress</h3>
                            <div class="progress-circle">
                                <svg width="120" height="120">
                                    <circle class="progress-bg" cx="60" cy="60" r="54"></circle>
                                    <circle class="progress-bar" cx="60" cy="60" r="54"></circle>
                                </svg>
                                <div class="progress-text">
                                    <span id="progressPercent">0%</span>
                                    <small>Completed</small>
                                </div>
                            </div>
                        </div>

                        <div class="dashboard-card upcoming-card">
                            <h3>Upcoming Tasks</h3>
                            <div class="upcoming-list" id="upcomingList">
                                <!-- Upcoming tasks will be populated here -->
                            </div>
                        </div>

                        <div class="dashboard-card stats-card">
                            <h3>Study Statistics</h3>
                            <div class="stats-list">
                                <div class="stat-item">
                                    <i class="fas fa-clock"></i>
                                    <span>Total Study Time: <strong id="totalStudyTime">0h 0m</strong></span>
                                </div>
                                <div class="stat-item">
                                    <i class="fas fa-check-circle"></i>
                                    <span>Tasks Completed: <strong id="tasksCompleted">0</strong></span>
                                </div>
                                <div class="stat-item">
                                    <i class="fas fa-fire"></i>
                                    <span>Current Streak: <strong id="currentStreak">0 days</strong></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="recent-activity">
                        <h3>Recent Activity</h3>
                        <div class="activity-list" id="activityList">
                            <!-- Activity items will be populated here -->
                        </div>
                    </div>
                </div>

                <!-- Subjects Tab -->
                <div class="tab-content" id="subjectsTab">
                    <div class="tab-header">
                        <h2>My Subjects</h2>
                        <p>Manage your study subjects and courses</p>
                        <button class="add-btn" id="addSubjectBtn">
                            <i class="fas fa-plus"></i> Add Subject
                        </button>
                    </div>

                    <div class="subjects-grid" id="subjectsGrid">
                        <!-- Subjects will be populated here -->
                    </div>
                </div>

                <!-- Schedule Tab -->
                <div class="tab-content" id="scheduleTab">
                    <div class="tab-header">
                        <h2>Study Schedule</h2>
                        <p>Plan your study sessions for the week</p>
                        <button class="add-btn" id="addScheduleBtn">
                            <i class="fas fa-plus"></i> Add Session
                        </button>
                    </div>

                    <div class="schedule-container">
                        <div class="week-navigation">
                            <button id="prevWeek"><i class="fas fa-chevron-left"></i></button>
                            <h3 id="currentWeek">Current Week</h3>
                            <button id="nextWeek"><i class="fas fa-chevron-right"></i></button>
                        </div>
                        <div class="schedule-grid" id="scheduleGrid">
                            <!-- Schedule will be populated here -->
                        </div>
                    </div>
                </div>

                <!-- Tasks Tab -->
                <div class="tab-content" id="tasksTab">
                    <div class="tab-header">
                        <h2>Study Tasks</h2>
                        <p>Manage your study tasks and assignments</p>
                        <button class="add-btn" id="addTaskBtn">
                            <i class="fas fa-plus"></i> Add Task
                        </button>
                    </div>

                    <div class="task-filters">
                        <button class="filter-btn active" data-filter="all">All Tasks</button>
                        <button class="filter-btn" data-filter="pending">Pending</button>
                        <button class="filter-btn" data-filter="completed">Completed</button>
                        <button class="filter-btn" data-filter="high">High Priority</button>
                    </div>

                    <div class="tasks-list" id="tasksList">
                        <!-- Tasks will be populated here -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modals -->
    <div class="modal" id="subjectModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Add New Subject</h3>
                <button class="close-modal">&times;</button>
            </div>
            <form id="subjectForm">
                <div class="form-group">
                    <label for="subjectName">Subject Name</label>
                    <input type="text" id="subjectName" required>
                </div>
                <div class="form-group">
                    <label for="subjectColor">Color</label>
                    <input type="color" id="subjectColor" value="#4f46e5">
                </div>
                <div class="form-group">
                    <label for="subjectGoals">Study Goals</label>
                    <textarea id="subjectGoals" placeholder="Enter your goals for this subject..."></textarea>
                </div>
                <div class="form-actions">
                    <button type="button" class="btn-secondary close-modal">Cancel</button>
                    <button type="submit" class="btn-primary">Save Subject</button>
                </div>
            </form>
        </div>
    </div>

    <div class="modal" id="taskModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Add New Task</h3>
                <button class="close-modal">&times;</button>
            </div>
            <form id="taskForm">
                <div class="form-group">
                    <label for="taskTitle">Task Title</label>
                    <input type="text" id="taskTitle" required>
                </div>
                <div class="form-group">
                    <label for="taskSubject">Subject</label>
                    <select id="taskSubject" required>
                        <option value="">Select Subject</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="taskDueDate">Due Date</label>
                    <input type="date" id="taskDueDate">
                </div>
                <div class="form-group">
                    <label for="taskPriority">Priority</label>
                    <select id="taskPriority">
                        <option value="low">Low</option>
                        <option value="medium" selected>Medium</option>
                        <option value="high">High</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="taskDescription">Description</label>
                    <textarea id="taskDescription" placeholder="Task description..."></textarea>
                </div>
                <div class="form-actions">
                    <button type="button" class="btn-secondary close-modal">Cancel</button>
                    <button type="submit" class="btn-primary">Save Task</button>
                </div>
            </form>
        </div>
    </div>

    <div class="modal" id="scheduleModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Add Study Session</h3>
                <button class="close-modal">&times;</button>
            </div>
            <form id="scheduleForm">
                <div class="form-group">
                    <label for="sessionSubject">Subject</label>
                    <select id="sessionSubject" required>
                        <option value="">Select Subject</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="sessionDay">Day</label>
                    <select id="sessionDay" required>
                        <option value="monday">Monday</option>
                        <option value="tuesday">Tuesday</option>
                        <option value="wednesday">Wednesday</option>
                        <option value="thursday">Thursday</option>
                        <option value="friday">Friday</option>
                        <option value="saturday">Saturday</option>
                        <option value="sunday">Sunday</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="sessionTime">Time</label>
                    <input type="time" id="sessionTime" required>
                </div>
                <div class="form-group">
                    <label for="sessionDuration">Duration (minutes)</label>
                    <input type="number" id="sessionDuration" value="60" min="15" max="240">
                </div>
                <div class="form-actions">
                    <button type="button" class="btn-secondary close-modal">Cancel</button>
                    <button type="submit" class="btn-primary">Save Session</button>
                </div>
            </form>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>