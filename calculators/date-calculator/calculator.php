<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $start_date = $_POST['start_date'];
    $operation = $_POST['operation'];
    $years = intval($_POST['years']);
    $months = intval($_POST['months']);
    $weeks = intval($_POST['weeks']);
    $days = intval($_POST['days']);

    // Validate start date
    if (empty($start_date)) {
        echo json_encode(['error' => 'Please select a start date']);
        exit;
    }

    try {
        $date = new DateTime($start_date);
        $interval_spec = 'P';

        // Build interval specification
        if ($years > 0) $interval_spec .= $years . 'Y';
        if ($months > 0) $interval_spec .= $months . 'M';
        
        // Convert weeks to days
        $total_days = $days + ($weeks * 7);
        if ($total_days > 0) $interval_spec .= $total_days . 'D';

        $interval = new DateInterval($interval_spec);

        // Perform calculation
        if ($operation === 'add') {
            $date->add($interval);
        } else {
            $date->sub($interval);
        }

        $result_date = $date->format('Y-m-d');
        $formatted_date = $date->format('F j, Y');
        $day_of_week = $date->format('l');

        // Calculate total days difference
        $start_obj = new DateTime($start_date);
        $end_obj = new DateTime($result_date);
        $total_days_diff = $start_obj->diff($end_obj)->days;
        $total_weeks_diff = floor($total_days_diff / 7);
        $remaining_days = $total_days_diff % 7;

        // Determine if it's in future or past
        $today = new DateTime();
        $is_future = $end_obj > $today;
        $is_past = $end_obj < $today;

        // Prepare response
        $result = [
            'success' => true,
            'start_date' => [
                'original' => $start_date,
                'formatted' => (new DateTime($start_date))->format('F j, Y'),
                'day_of_week' => (new DateTime($start_date))->format('l')
            ],
            'result_date' => [
                'iso' => $result_date,
                'formatted' => $formatted_date,
                'day_of_week' => $day_of_week
            ],
            'operation' => $operation,
            'time_added' => [
                'years' => $years,
                'months' => $months,
                'weeks' => $weeks,
                'days' => $days,
                'total_days' => $total_days
            ],
            'summary' => [
                'total_days_difference' => $total_days_diff,
                'total_weeks_difference' => $total_weeks_diff,
                'remaining_days' => $remaining_days,
                'is_future' => $is_future,
                'is_past' => $is_past
            ]
        ];

        echo json_encode($result);

    } catch (Exception $e) {
        echo json_encode(['error' => 'Invalid date calculation: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Invalid request method']);
}
?>