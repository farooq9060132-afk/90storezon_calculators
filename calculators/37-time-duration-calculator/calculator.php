<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Enhanced error handling
function sendError($message, $code = 400) {
    http_response_code($code);
    echo json_encode([
        'success' => false,
        'error' => $message,
        'timestamp' => time()
    ]);
    exit;
}

function sendSuccess($data) {
    echo json_encode([
        'success' => true,
        'data' => $data,
        'timestamp' => time(),
        'version' => '2.1.0'
    ]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Get and validate input
        $input = json_decode(file_get_contents('php://input'), true);
        
        if (!$input) {
            sendError('Invalid JSON input');
        }

        $startDate = $input['startDate'] ?? '';
        $endDate = $input['endDate'] ?? '';
        $excludeWeekends = filter_var($input['excludeWeekends'] ?? false, FILTER_VALIDATE_BOOLEAN);
        $businessHours = filter_var($input['businessHours'] ?? false, FILTER_VALIDATE_BOOLEAN);
        $includeSeconds = filter_var($input['includeSeconds'] ?? true, FILTER_VALIDATE_BOOLEAN);
        $accountLeap = filter_var($input['accountLeap'] ?? true, FILTER_VALIDATE_BOOLEAN);

        // Validate required fields
        if (empty($startDate) || empty($endDate)) {
            sendError('Start date and end date are required');
        }

        // Create DateTime objects with error handling
        try {
            $startDateTime = new DateTime($startDate);
            $endDateTime = new DateTime($endDate);
        } catch (Exception $e) {
            sendError('Invalid date format: ' . $e->getMessage());
        }

        // Validate date order
        if ($endDateTime < $startDateTime) {
            sendError('End date must be after start date');
        }

        // Calculate basic difference
        $interval = $startDateTime->diff($endDateTime);
        
        // Calculate total units
        $totalSeconds = $endDateTime->getTimestamp() - $startDateTime->getTimestamp();
        $totalMilliseconds = $totalSeconds * 1000;
        
        $totalMinutes = floor($totalSeconds / 60);
        $totalHours = floor($totalSeconds / 3600);
        $totalDays = $interval->days;
        $totalWeeks = floor($totalDays / 7);
        
        // Calculate years and months considering leap years
        $years = $interval->y;
        $months = $interval->m;
        
        if ($accountLeap) {
            // Adjust for leap years in the period
            $leapYears = 0;
            $startYear = (int)$startDateTime->format('Y');
            $endYear = (int)$endDateTime->format('Y');
            
            for ($year = $startYear; $year <= $endYear; $year++) {
                if (date('L', strtotime("$year-01-01"))) {
                    $leapYears++;
                }
            }
            
            // Adjust days for leap years
            $adjustedDays = $totalDays + $leapYears;
        } else {
            $adjustedDays = $totalDays;
        }

        // Calculate business days if requested
        $businessDays = $totalDays;
        if ($excludeWeekends) {
            $businessDays = calculateBusinessDays($startDateTime, $endDateTime);
        }

        // Prepare results
        $results = [
            'basic' => [
                'years' => $years,
                'months' => $months,
                'days' => $interval->d,
                'hours' => $interval->h,
                'minutes' => $interval->i,
                'seconds' => $interval->s
            ],
            'total' => [
                'milliseconds' => $totalMilliseconds,
                'seconds' => $totalSeconds,
                'minutes' => $totalMinutes,
                'hours' => $totalHours,
                'days' => $totalDays,
                'weeks' => $totalWeeks,
                'months' => $years * 12 + $months,
                'years' => $years + $months / 12
            ],
            'adjusted' => [
                'business_days' => $businessDays,
                'adjusted_days' => $adjustedDays,
                'leap_years_count' => $leapYears ?? 0
            ],
            'formatted' => [
                'total_duration' => formatDuration($totalSeconds),
                'exact_time' => gmdate('H:i:s', $totalSeconds),
                'business_days_formatted' => $businessDays . ' days'
            ]
        ];

        // Add percentages for visualization
        $maxUnit = max($results['total']['years'], $results['total']['months'], $results['total']['days']);
        $results['visualization'] = [
            'years_percent' => $maxUnit > 0 ? ($results['total']['years'] / $maxUnit) * 100 : 0,
            'months_percent' => $maxUnit > 0 ? ($results['total']['months'] / $maxUnit) * 100 : 0,
            'days_percent' => $maxUnit > 0 ? ($results['total']['days'] / $maxUnit) * 100 : 0
        ];

        sendSuccess($results);

    } catch (Exception $e) {
        sendError('Server error: ' . $e->getMessage(), 500);
    }
} else {
    sendError('Method not allowed', 405);
}

/**
 * Calculate business days excluding weekends
 */
function calculateBusinessDays($start, $end) {
    $businessDays = 0;
    $current = clone $start;
    
    while ($current <= $end) {
        $dayOfWeek = $current->format('N'); // 1-7 (Monday-Sunday)
        if ($dayOfWeek <= 5) { // Monday-Friday
            $businessDays++;
        }
        $current->modify('+1 day');
    }
    
    return $businessDays;
}

/**
 * Format duration in human readable format
 */
function formatDuration($seconds) {
    $units = [
        'year' => 31536000,
        'month' => 2592000,
        'week' => 604800,
        'day' => 86400,
        'hour' => 3600,
        'minute' => 60,
        'second' => 1
    ];
    
    $parts = [];
    foreach ($units as $name => $divisor) {
        $quot = (int)($seconds / $divisor);
        if ($quot > 0) {
            $parts[] = $quot . ' ' . $name . ($quot > 1 ? 's' : '');
            $seconds %= $divisor;
        }
    }
    
    return implode(', ', $parts);
}
?>
