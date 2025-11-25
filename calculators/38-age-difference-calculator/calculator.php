<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $person1_dob = $_POST['person1_dob'];
    $person2_dob = $_POST['person2_dob'];
    $person1_name = $_POST['person1_name'] ?: 'Person 1';
    $person2_name = $_POST['person2_name'] ?: 'Person 2';

    // Validate dates
    if (empty($person1_dob) || empty($person2_dob)) {
        echo json_encode(['error' => 'Please select both dates of birth']);
        exit;
    }

    $date1 = new DateTime($person1_dob);
    $date2 = new DateTime($person2_dob);
    $today = new DateTime();

    // Calculate who is older
    if ($date1 < $date2) {
        $older_person = $person1_name;
        $younger_person = $person2_name;
        $older_dob = $date1;
        $younger_dob = $date2;
    } else {
        $older_person = $person2_name;
        $younger_person = $person1_name;
        $older_dob = $date2;
        $younger_dob = $date1;
    }

    // Calculate age difference
    $interval = $younger_dob->diff($older_dob);
    
    // Calculate exact difference in days
    $days_difference = $younger_dob->getTimestamp() - $older_dob->getTimestamp();
    $total_days = floor($days_difference / (60 * 60 * 24));
    $total_weeks = floor($total_days / 7);
    $total_months = ($interval->y * 12) + $interval->m;

    // Calculate current ages
    $age1 = $date1->diff($today);
    $age2 = $date2->diff($today);

    // Prepare response
    $result = [
        'success' => true,
        'person1' => [
            'name' => $person1_name,
            'age' => $age1->y,
            'age_full' => $age1->y . ' years, ' . $age1->m . ' months, ' . $age1->d . ' days'
        ],
        'person2' => [
            'name' => $person2_name,
            'age' => $age2->y,
            'age_full' => $age2->y . ' years, ' . $age2->m . ' months, ' . $age2->d . ' days'
        ],
        'older_person' => $older_person,
        'age_difference' => [
            'years' => $interval->y,
            'months' => $interval->m,
            'days' => $interval->d,
            'total_days' => $total_days,
            'total_weeks' => $total_weeks,
            'total_months' => $total_months,
            'full_string' => $interval->y . ' years, ' . $interval->m . ' months, ' . $interval->d . ' days'
        ],
        'comparison' => [
            'person1_older' => $date1 < $date2,
            'exact_difference' => $total_days . ' days'
        ]
    ];

    echo json_encode($result);
} else {
    echo json_encode(['error' => 'Invalid request method']);
}
?>