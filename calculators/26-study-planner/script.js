class StudyPlanner {
    constructor() {
        this.currentTab = 'dashboard';
        this.subjects = JSON.parse(localStorage.getItem('studyPlanner_subjects')) || [];
        this.tasks = JSON.parse(localStorage.getItem('studyPlanner_tasks')) || [];
        this.sessions = JSON.parse(localStorage.getItem('studyPlanner_sessions')) || [];
        this.settings = JSON.parse(localStorage.getItem('studyPlanner_settings')) || {
            pomodoroDuration: 25,
            shortBreak: 5,
            longBreak: 15
        };
        
        this.timer = {
            minutes: 25,
            seconds: 0,
            isRunning: false,
            interval: null,
            type: 'pomodoro' // pomodoro, short_break, long_break
        };
        
        this.init();
    }

    init() {
        this.initializeEventListeners();
        this.loadData();
        this.updateDashboard();
        this.showTab('dashboard');
    }

    initializeEventListeners() {
        // Tab navigation
        document.querySelectorAll('.sidebar-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const tab = e.currentTarget.getAttribute('data-tab');
                this.showTab(tab);
            });
        });

        // Timer controls
        document.getElementById('startTimer').addEventListener('click', () => this.startTimer());
        document.getElementById('pauseTimer').addEventListener('click', () => this.pauseTimer());
        document.getElementById('resetTimer').addEventListener('click', () => this.resetTimer());
        
        // Timer presets
        document.querySelectorAll('.preset-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const minutes = parseInt(e.currentTarget.getAttribute('data-minutes'));
                this.setTimer(minutes);
            });
        });

        // Modal controls
        document.getElementById('addSubjectBtn').addEventListener('click', () => this.showModal('subjectModal'));
        document.getElementById('addTaskBtn').addEventListener('click', () => this.showModal('taskModal'));
        document.getElementById('addScheduleBtn').addEventListener('click', () => this.showModal('scheduleModal'));

        // Close modals
        document.querySelectorAll('.close-modal').forEach(btn => {
            btn.addEventListener('click', () => this.hideModals());
        });

        // Form submissions
        document.getElementById('subjectForm').addEventListener('submit', (e) => this.handleSubjectSubmit(e));
        document.getElementById('taskForm').addEventListener('submit', (e) => this.handleTaskSubmit(e));
        document.getElementById('scheduleForm').addEventListener('submit', (e) => this.handleSessionSubmit(e));

        // Task filters
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const filter = e.currentTarget.getAttribute('data-filter');
                this.filterTasks(filter);
            });
        });

        // Week navigation
        document.getElementById('prevWeek').addEventListener('click', () => this.navigateWeek(-1));
        document.getElementById('nextWeek').addEventListener('click', () => this.navigateWeek(1));
    }

    showTab(tabName) {
        // Update active tab button
        document.querySelectorAll('.sidebar-btn').forEach(btn => {
            btn.classList.remove('active');
        });
        document.querySelector(`[data-tab="${tabName}"]`).classList.add('active');

        // Show corresponding tab content
        document.querySelectorAll('.tab-content').forEach(tab => {
            tab.classList.remove('active');
        });
        document.getElementById(`${tabName}Tab`).classList.add('active');

        this.currentTab = tabName;

        // Refresh tab content
        switch(tabName) {
            case 'dashboard':
                this.updateDashboard();
                break;
            case 'subjects':
                this.renderSubjects();
                break;
            case 'schedule':
                this.renderSchedule();
                break;
            case 'tasks':
                this.renderTasks();
                break;
        }
    }

    // Timer Functions
    startTimer() {
        if (!this.timer.isRunning) {
            this.timer.isRunning = true;
            this.timer.interval = setInterval(() => this.updateTimer(), 1000);
            document.getElementById('startTimer').style.display = 'none';
            document.getElementById('pauseTimer').style.display = 'flex';
        }
    }

    pauseTimer() {
        if (this.timer.isRunning) {
            this.timer.isRunning = false;
            clearInterval(this.timer.interval);
            document.getElementById('startTimer').style.display = 'flex';
            document.getElementById('pauseTimer').style.display = 'none';
        }
    }

    resetTimer() {
        this.pauseTimer();
        this.setTimer(this.timer.type === 'pomodoro' ? this.settings.pomodoroDuration : 
                     this.timer.type === 'short_break' ? this.settings.shortBreak : 
                     this.settings.longBreak);
    }

    setTimer(minutes) {
        this.timer.minutes = minutes;
        this.timer.seconds = 0;
        this.updateTimerDisplay();
    }

    updateTimer() {
        if (this.timer.seconds === 0) {
            if (this.timer.minutes === 0) {
                this.timerComplete();
                return;
            }
            this.timer.minutes--;
            this.timer.seconds = 59;
        } else {
            this.timer.seconds--;
        }
        this.updateTimerDisplay();
    }

    updateTimerDisplay() {
        const display = document.getElementById('timerDisplay');
        display.textContent = `${this.timer.minutes.toString().padStart(2, '0')}:${this.timer.seconds.toString().padStart(2, '0')}`;
    }

    timerComplete() {
        this.pauseTimer();
        
        // Show notification
        this.showNotification('Timer completed! Time for a break.', 'success');
        
        // Auto-start break timer
        this.timer.type = this.timer.type === 'pomodoro' ? 'short_break' : 'pomodoro';
        const breakMinutes = this.timer.type === 'short_break' ? this.settings.shortBreak : this.settings.longBreak;
        this.setTimer(breakMinutes);
        
        // Add to study sessions
        this.addStudySession(this.settings.pomodoroDuration);
    }

    addStudySession(duration) {
        const session = {
            id: Date.now(),
            date: new Date().toISOString(),
            duration: duration,
            type: 'pomodoro'
        };
        
        this.sessions.push(session);
        this.saveData();
        this.updateDashboard();
    }

    // Modal Functions
    showModal(modalId) {
        document.querySelectorAll('.modal').forEach(modal => {
            modal.classList.remove('active');
        });
        document.getElementById(modalId).classList.add('active');

        // Populate dropdowns
        if (modalId === 'taskModal' || modalId === 'scheduleModal') {
            this.populateSubjectDropdowns();
        }
    }

    hideModals() {
        document.querySelectorAll('.modal').forEach(modal => {
            modal.classList.remove('active');
        });
    }

    populateSubjectDropdowns() {
        const subjectSelects = document.querySelectorAll('#taskSubject, #sessionSubject');
        subjectSelects.forEach(select => {
            select.innerHTML = '<option value="">Select Subject</option>';
            this.subjects.forEach(subject => {
                const option = document.createElement('option');
                option.value = subject.id;
                option.textContent = subject.name;
                select.appendChild(option);
            });
        });
    }

    // Data Management
    loadData() {
        // Data is loaded in constructor from localStorage
        this.updateStats();
    }

    saveData() {
        localStorage.setItem('studyPlanner_subjects', JSON.stringify(this.subjects));
        localStorage.setItem('studyPlanner_tasks', JSON.stringify(this.tasks));
        localStorage.setItem('studyPlanner_sessions', JSON.stringify(this.sessions));
        localStorage.setItem('studyPlanner_settings', JSON.stringify(this.settings));
        this.updateStats();
    }

    updateStats() {
        const totalSubjects = this.subjects.length;
        const totalTasks = this.tasks.length;
        const completedTasks = this.tasks.filter(task => task.completed).length;
        
        document.getElementById('totalSubjects').textContent = totalSubjects;
        document.getElementById('totalTasks').textContent = totalTasks;
        document.getElementById('completedTasks').textContent = completedTasks;
    }

    // Dashboard Functions
    updateDashboard() {
        this.updateProgressCircle();
        this.renderUpcomingTasks();
        this.renderRecentActivity();
        this.updateStatistics();
    }

    updateProgressCircle() {
        const totalTasks = this.tasks.length;
        const completedTasks = this.tasks.filter(task => task.completed).length;
        const progress = totalTasks > 0 ? (completedTasks / totalTasks) * 100 : 0;
        
        document.getElementById('progressPercent').textContent = `${Math.round(progress)}%`;
        
        const progressBar = document.querySelector('.progress-bar');
        const circumference = 2 * Math.PI * 54;
        const offset = circumference - (progress / 100) * circumference;
        
        progressBar.style.strokeDasharray = `${circumference} ${circumference}`;
        progressBar.style.strokeDashoffset = offset;
    }

    renderUpcomingTasks() {
        const upcomingList = document.getElementById('upcomingList');
        const upcomingTasks = this.getUpcomingTasks();
        
        if (upcomingTasks.length === 0) {
            upcomingList.innerHTML = '<div class="upcoming-item"><p>No upcoming tasks</p></div>';
            return;
        }
        
        upcomingList.innerHTML = upcomingTasks.map(task => `
            <div class="upcoming-item">
                <i class="fas fa-tasks"></i>
                <div class="upcoming-content">
                    <h4>${task.title}</h4>
                    <p>${task.subject} • Due: ${this.formatDate(task.dueDate)}</p>
                </div>
            </div>
        `).join('');
    }

    getUpcomingTasks() {
        const now = new Date();
        return this.tasks
            .filter(task => !task.completed && task.dueDate)
            .sort((a, b) => new Date(a.dueDate) - new Date(b.dueDate))
            .slice(0, 5)
            .map(task => ({
                ...task,
                subject: this.getSubjectName(task.subjectId)
            }));
    }

    renderRecentActivity() {
        const activityList = document.getElementById('activityList');
        const recentActivities = this.getRecentActivities();
        
        if (recentActivities.length === 0) {
            activityList.innerHTML = '<div class="activity-item"><p>No recent activity</p></div>';
            return;
        }
        
        activityList.innerHTML = recentActivities.map(activity => `
            <div class="activity-item">
                <i class="fas ${activity.icon}"></i>
                <div class="activity-content">
                    <h4>${activity.title}</h4>
                    <p>${activity.description} • ${this.formatTime(activity.timestamp)}</p>
                </div>
            </div>
        `).join('');
    }

    getRecentActivities() {
        const activities = [];
        
        // Add recent completed tasks
        this.tasks
            .filter(task => task.completed && task.completedAt)
            .sort((a, b) => new Date(b.completedAt) - new Date(a.completedAt))
            .slice(0, 3)
            .forEach(task => {
                activities.push({
                    icon: 'fa-check-circle',
                    title: 'Task Completed',
                    description: `Completed "${task.title}"`,
                    timestamp: task.completedAt
                });
            });
        
        // Add recent study sessions
        this.sessions
            .sort((a, b) => new Date(b.date) - new Date(a.date))
            .slice(0, 3)
            .forEach(session => {
                activities.push({
                    icon: 'fa-clock',
                    title: 'Study Session',
                    description: `${session.duration} minutes studied`,
                    timestamp: session.date
                });
            });
        
        return activities.sort((a, b) => new Date(b.timestamp) - new Date(a.timestamp)).slice(0, 5);
    }

    updateStatistics() {
        const totalStudyTime = this.sessions.reduce((total, session) => total + session.duration, 0);
        const tasksCompleted = this.tasks.filter(task => task.completed).length;
        const currentStreak = this.calculateStudyStreak();
        
        document.getElementById('totalStudyTime').textContent = `${Math.floor(totalStudyTime / 60)}h ${totalStudyTime % 60}m`;
        document.getElementById('tasksCompleted').textContent = tasksCompleted;
        document.getElementById('currentStreak').textContent = `${currentStreak} days`;
    }

    calculateStudyStreak() {
        if (this.sessions.length === 0) return 0;
        
        const dates = [...new Set(this.sessions.map(s => s.date.split('T')[0]))].sort().reverse();
        let streak = 0;
        let currentDate = new Date();
        
        while (true) {
            const dateStr = currentDate.toISOString().split('T')[0];
            if (dates.includes(dateStr)) {
                streak++;
                currentDate.setDate(currentDate.getDate() - 1);
            } else {
                break;
            }
        }
        
        return streak;
    }

    // Subject Management
    renderSubjects() {
        const subjectsGrid = document.getElementById('subjectsGrid');
        
        if (this.subjects.length === 0) {
            subjectsGrid.innerHTML = `
                <div class="no-data">
                    <i class="fas fa-book fa-3x"></i>
                    <h3>No Subjects Added</h3>
                    <p>Add your first subject to get started with your study planner.</p>
                </div>
            `;
            return;
        }
        
        subjectsGrid.innerHTML = this.subjects.map(subject => `
            <div class="subject-card" style="border-left-color: ${subject.color}">
                <div class="subject-header">
                    <h3 class="subject-title">${subject.name}</h3>
                    <div class="subject-actions">
                        <button class="action-btn" onclick="studyPlanner.editSubject(${subject.id})">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="action-btn" onclick="studyPlanner.deleteSubject(${subject.id})">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
                <div class="subject-goals">
                    ${subject.goals || 'No goals set for this subject.'}
                </div>
            </div>
        `).join('');
    }

    handleSubjectSubmit(e) {
        e.preventDefault();
        
        const formData = new FormData(e.target);
        const subjectData = {
            id: Date.now(),
            name: document.getElementById('subjectName').value,
            color: document.getElementById('subjectColor').value,
            goals: document.getElementById('subjectGoals').value,
            createdAt: new Date().toISOString()
        };
        
        this.subjects.push(subjectData);
        this.saveData();
        this.hideModals();
        this.renderSubjects();
        this.showNotification('Subject added successfully!', 'success');
        
        e.target.reset();
    }

    deleteSubject(subjectId) {
        if (confirm('Are you sure you want to delete this subject? This will also delete associated tasks.')) {
            // Remove subject
            this.subjects = this.subjects.filter(s => s.id !== subjectId);
            
            // Remove associated tasks
            this.tasks = this.tasks.filter(t => t.subjectId !== subjectId);
            
            this.saveData();
            this.renderSubjects();
            this.showNotification('Subject deleted successfully!', 'success');
        }
    }

    // Task Management
    renderTasks(filter = 'all') {
        const tasksList = document.getElementById('tasksList');
        let filteredTasks = this.tasks;
        
        switch (filter) {
            case 'pending':
                filteredTasks = this.tasks.filter(task => !task.completed);
                break;
            case 'completed':
                filteredTasks = this.tasks.filter(task => task.completed);
                break;
            case 'high':
                filteredTasks = this.tasks.filter(task => task.priority === 'high');
                break;
        }
        
        if (filteredTasks.length === 0) {
            tasksList.innerHTML = `
                <div class="no-data">
                    <i class="fas fa-tasks fa-3x"></i>
                    <h3>No Tasks Found</h3>
                    <p>${filter === 'all' ? 'Add your first task to get started.' : 'No tasks match the selected filter.'}</p>
                </div>
            `;
            return;
        }
        
        tasksList.innerHTML = filteredTasks.map(task => {
            const subject = this.subjects.find(s => s.id === task.subjectId);
            const subjectName = subject ? subject.name : 'Unknown Subject';
            const isOverdue = task.dueDate && new Date(task.dueDate) < new Date() && !task.completed;
            
            return `
                <div class="task-item ${task.priority}-priority ${isOverdue ? 'overdue' : ''}">
                    <div class="task-checkbox ${task.completed ? 'checked' : ''}" 
                         onclick="studyPlanner.toggleTask(${task.id})">
                        ${task.completed ? '<i class="fas fa-check"></i>' : ''}
                    </div>
                    <div class="task-content">
                        <div class="task-title ${task.completed ? 'completed' : ''}">
                            ${task.title}
                            ${isOverdue ? '<span class="badge overdue-badge">Overdue</span>' : ''}
                        </div>
                        <div class="task-meta">
                            <span class="task-subject">${subjectName}</span>
                            ${task.dueDate ? `
                                <span class="task-due">
                                    <i class="far fa-calendar"></i>
                                    ${this.formatDate(task.dueDate)}
                                </span>
                            ` : ''}
                            <span class="task-priority">${task.priority} priority</span>
                        </div>
                        ${task.description ? `<p class="task-description">${task.description}</p>` : ''}
                    </div>
                    <div class="task-actions">
                        <button class="action-btn" onclick="studyPlanner.editTask(${task.id})">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="action-btn" onclick="studyPlanner.deleteTask(${task.id})">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            `;
        }).join('');
        
        // Update filter buttons
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.classList.remove('active');
        });
        document.querySelector(`[data-filter="${filter}"]`).classList.add('active');
    }

    filterTasks(filter) {
        this.renderTasks(filter);
    }

    handleTaskSubmit(e) {
        e.preventDefault();
        
        const formData = new FormData(e.target);
        const taskData = {
            id: Date.now(),
            title: document.getElementById('taskTitle').value,
            subjectId: parseInt(document.getElementById('taskSubject').value),
            dueDate: document.getElementById('taskDueDate').value || null,
            priority: document.getElementById('taskPriority').value,
            description: document.getElementById('taskDescription').value,
            completed: false,
            createdAt: new Date().toISOString()
        };
        
        this.tasks.push(taskData);
        this.saveData();
        this.hideModals();
        this.renderTasks();
        this.updateDashboard();
        this.showNotification('Task added successfully!', 'success');
        
        e.target.reset();
    }

    toggleTask(taskId) {
        const task = this.tasks.find(t => t.id === taskId);
        if (task) {
            task.completed = !task.completed;
            task.completedAt = task.completed ? new Date().toISOString() : null;
            this.saveData();
            this.renderTasks();
            this.updateDashboard();
        }
    }

    deleteTask(taskId) {
        if (confirm('Are you sure you want to delete this task?')) {
            this.tasks = this.tasks.filter(t => t.id !== taskId);
            this.saveData();
            this.renderTasks();
            this.updateDashboard();
            this.showNotification('Task deleted successfully!', 'success');
        }
    }

    // Schedule Management
    renderSchedule() {
        const scheduleGrid = document.getElementById('scheduleGrid');
        const days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
        
        scheduleGrid.innerHTML = days.map(day => {
            const daySessions = this.sessions.filter(session => session.day === day);
            
            return `
                <div class="day-column">
                    <div class="day-header">
                        <h4>${this.capitalizeFirstLetter(day)}</h4>
                        <p>${daySessions.length} sessions</p>
                    </div>
                    ${daySessions.map(session => {
                        const subject = this.subjects.find(s => s.id === session.subjectId);
                        return `
                            <div class="session-item" style="border-left-color: ${subject?.color || '#4f46e5'}">
                                <div class="session-time">${session.time}</div>
                                <div class="session-subject">${subject?.name || 'Unknown Subject'}</div>
                                <div class="session-duration">${session.duration} min</div>
                            </div>
                        `;
                    }).join('')}
                </div>
            `;
        }).join('');
    }

    handleSessionSubmit(e) {
        e.preventDefault();
        
        const formData = new FormData(e.target);
        const sessionData = {
            id: Date.now(),
            subjectId: parseInt(document.getElementById('sessionSubject').value),
            day: document.getElementById('sessionDay').value,
            time: document.getElementById('sessionTime').value,
            duration: parseInt(document.getElementById('sessionDuration').value),
            createdAt: new Date().toISOString()
        };
        
        this.sessions.push(sessionData);
        this.saveData();
        this.hideModals();
        this.renderSchedule();
        this.showNotification('Study session added successfully!', 'success');
        
        e.target.reset();
    }

    navigateWeek(direction) {
        // Implementation for week navigation
        this.showNotification('Week navigation would be implemented here', 'info');
    }

    // Utility Functions
    getSubjectName(subjectId) {
        const subject = this.subjects.find(s => s.id === subjectId);
        return subject ? subject.name : 'Unknown Subject';
    }

    formatDate(dateString) {
        if (!dateString) return 'No due date';
        const date = new Date(dateString);
        return date.toLocaleDateString('en-US', { 
            weekday: 'short', 
            month: 'short', 
            day: 'numeric' 
        });
    }

    formatTime(dateString) {
        const date = new Date(dateString);
        return date.toLocaleDateString('en-US', { 
            month: 'short', 
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        });
    }

    capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }

    showNotification(message, type = 'info') {
        // Create notification element
        const notification = document.createElement('div');
        notification.className = `notification ${type}`;
        notification.innerHTML = `
            <div class="notification-content">
                <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : 'info-circle'}"></i>
                <span>${message}</span>
            </div>
        `;
        
        // Add styles
        notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            background: ${type === 'success' ? '#10b981' : type === 'error' ? '#ef4444' : '#3b82f6'};
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
const studyPlanner = new StudyPlanner();

// Make available globally for onclick handlers
window.studyPlanner = studyPlanner;