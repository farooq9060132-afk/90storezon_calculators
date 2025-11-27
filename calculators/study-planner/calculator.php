<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

class StudyPlannerCalculator {
    private $dataFile = 'study_data.json';
    
    public function __construct() {
        // Ensure data file exists
        if (!file_exists($this->dataFile)) {
            $this->initializeData();
        }
    }
    
    private function initializeData() {
        $initialData = [
            'subjects' => [],
            'tasks' => [],
            'sessions' => [],
            'settings' => [
                'pomodoro_duration' => 25,
                'short_break' => 5,
                'long_break' => 15
            ],
            'statistics' => [
                'total_study_time' => 0,
                'completed_tasks' => 0,
                'current_streak' => 0,
                'last_study_date' => null
            ]
        ];
        
        file_put_contents($this->dataFile, json_encode($initialData));
    }
    
    private function loadData() {
        return json_decode(file_get_contents($this->dataFile), true);
    }
    
    private function saveData($data) {
        file_put_contents($this->dataFile, json_encode($data, JSON_PRETTY_PRINT));
    }
    
    public function calculateStudyProgress($tasks) {
        $totalTasks = count($tasks);
        $completedTasks = 0;
        
        foreach ($tasks as $task) {
            if ($task['completed'] ?? false) {
                $completedTasks++;
            }
        }
        
        if ($totalTasks === 0) {
            return 0;
        }
        
        return round(($completedTasks / $totalTasks) * 100);
    }
    
    public function calculateWeeklyStudyTime($sessions) {
        $weeklyTime = 0;
        $currentWeek = date('W');
        
        foreach ($sessions as $session) {
            if (date('W', strtotime($session['date'])) == $currentWeek) {
                $weeklyTime += $session['duration'];
            }
        }
        
        return $weeklyTime;
    }
    
    public function calculateTaskPriority($dueDate, $priority) {
        $priorityWeights = [
            'low' => 1,
            'medium' => 2,
            'high' => 3
        ];
        
        $basePriority = $priorityWeights[$priority] ?? 1;
        
        if ($dueDate) {
            $daysUntilDue = floor((strtotime($dueDate) - time()) / (60 * 60 * 24));
            
            if ($daysUntilDue <= 1) {
                $basePriority += 3;
            } elseif ($daysUntilDue <= 3) {
                $basePriority += 2;
            } elseif ($daysUntilDue <= 7) {
                $basePriority += 1;
            }
        }
        
        return min($basePriority, 5); // Max priority of 5
    }
    
    public function getUpcomingTasks($tasks, $limit = 5) {
        $upcoming = [];
        $now = time();
        
        foreach ($tasks as $task) {
            if (!$task['completed'] && (!empty($task['dueDate']) || $task['priority'] === 'high')) {
                $upcoming[] = $task;
            }
        }
        
        // Sort by due date and priority
        usort($upcoming, function($a, $b) {
            $aPriority = $this->calculateTaskPriority($a['dueDate'] ?? null, $a['priority']);
            $bPriority = $this->calculateTaskPriority($b['dueDate'] ?? null, $b['priority']);
            
            return $bPriority - $aPriority;
        });
        
        return array_slice($upcoming, 0, $limit);
    }
    
    public function calculateStudyStreak($sessions) {
        if (empty($sessions)) {
            return 0;
        }
        
        // Sort sessions by date
        usort($sessions, function($a, $b) {
            return strtotime($b['date']) - strtotime($a['date']);
        });
        
        $streak = 0;
        $currentDate = date('Y-m-d');
        $lastDate = null;
        
        foreach ($sessions as $session) {
            $sessionDate = date('Y-m-d', strtotime($session['date']));
            
            if ($lastDate === null) {
                $lastDate = $sessionDate;
                $streak = 1;
                continue;
            }
            
            $daysDiff = (strtotime($lastDate) - strtotime($sessionDate)) / (60 * 60 * 24);
            
            if ($daysDiff === 1) {
                $streak++;
                $lastDate = $sessionDate;
            } else {
                break;
            }
        }
        
        return $streak;
    }
}

// Handle API requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $action = $input['action'] ?? '';
    
    $calculator = new StudyPlannerCalculator();
    $response = [];
    
    switch ($action) {
        case 'calculate_progress':
            $tasks = $input['tasks'] ?? [];
            $progress = $calculator->calculateStudyProgress($tasks);
            $response = ['success' => true, 'progress' => $progress];
            break;
            
        case 'get_upcoming_tasks':
            $tasks = $input['tasks'] ?? [];
            $upcoming = $calculator->getUpcomingTasks($tasks);
            $response = ['success' => true, 'upcoming_tasks' => $upcoming];
            break;
            
        case 'calculate_study_time':
            $sessions = $input['sessions'] ?? [];
            $studyTime = $calculator->calculateWeeklyStudyTime($sessions);
            $response = ['success' => true, 'study_time' => $studyTime];
            break;
            
        case 'calculate_streak':
            $sessions = $input['sessions'] ?? [];
            $streak = $calculator->calculateStudyStreak($sessions);
            $response = ['success' => true, 'streak' => $streak];
            break;
            
        case 'calculate_priority':
            $dueDate = $input['dueDate'] ?? null;
            $priority = $input['priority'] ?? 'medium';
            $calculatedPriority = $calculator->calculateTaskPriority($dueDate, $priority);
            $response = ['success' => true, 'priority_score' => $calculatedPriority];
            break;
            
        default:
            $response = ['success' => false, 'error' => 'Unknown action'];
    }
    
    echo json_encode($response);
    exit;
}
?>