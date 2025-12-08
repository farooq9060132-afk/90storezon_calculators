<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);
    
    if ($data) {
        $response = calculatePregnancy($data);
        echo json_encode($response);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Invalid data received'
        ]);
    }
} else {
    echo json_encode([
        'success' => false, 
        'message' => 'Only POST method allowed'
    ]);
}

function calculatePregnancy($data) {
    $method = $data['method'] ?? 'lmp';
    $result = [];
    
    switch ($method) {
        case 'lmp':
            $result = calculateLMPMethod($data);
            break;
        case 'conception':
            $result = calculateConceptionMethod($data);
            break;
        case 'ultrasound':
            $result = calculateUltrasoundMethod($data);
            break;
        default:
            $result = ['success' => false, 'message' => 'Invalid method'];
    }
    
    if ($result['success']) {
        $result['weekly_info'] = getWeeklyInfo($result['current_week']);
        $result['important_dates'] = calculateImportantDates($result['due_date']);
    }
    
    return $result;
}

function calculateLMPMethod($data) {
    $lmpDate = $data['lmp_date'];
    $cycleLength = intval($data['cycle_length'] ?? 28);
    
    if (empty($lmpDate)) {
        return ['success' => false, 'message' => 'LMP date is required'];
    }
    
    $lmp = new DateTime($lmpDate);
    $dueDate = clone $lmp;
    
    // Naegele's rule: LMP + 280 days (adjusted for cycle length)
    $daysToAdd = 280 + ($cycleLength - 28);
    $dueDate->modify("+{$daysToAdd} days");
    
    return calculatePregnancyDetails($lmp, $dueDate, 'LMP Method');
}

function calculateConceptionMethod($data) {
    $conceptionDate = $data['conception_date'];
    $isIVF = $data['ivf'] === 'yes';
    
    if (empty($conceptionDate)) {
        return ['success' => false, 'message' => 'Conception date is required'];
    }
    
    $conception = new DateTime($conceptionDate);
    $lmp = clone $conception;
    $lmp->modify('-14 days'); // Approximate LMP from conception
    
    $dueDate = clone $lmp;
    $dueDate->modify('+280 days');
    
    if ($isIVF) {
        // For IVF, due date is conception date + 266 days
        $dueDate = clone $conception;
        $dueDate->modify('+266 days');
    }
    
    return calculatePregnancyDetails($lmp, $dueDate, 'Conception Date Method');
}

function calculateUltrasoundMethod($data) {
    $ultrasoundDate = $data['ultrasound_date'];
    $weeks = intval($data['weeks'] ?? 0);
    $days = intval($data['days'] ?? 0);
    
    if (empty($ultrasoundDate) || ($weeks === 0 && $days === 0)) {
        return ['success' => false, 'message' => 'Ultrasound date and gestational age are required'];
    }
    
    $ultrasound = new DateTime($ultrasoundDate);
    $lmp = clone $ultrasound;
    
    // Calculate LMP from ultrasound date and gestational age
    $totalDays = ($weeks * 7) + $days;
    $lmp->modify("-{$totalDays} days");
    
    $dueDate = clone $lmp;
    $dueDate->modify('+280 days');
    
    return calculatePregnancyDetails($lmp, $dueDate, 'Ultrasound Method');
}

function calculatePregnancyDetails($lmp, $dueDate, $method) {
    $today = new DateTime();
    $currentWeek = calculateCurrentWeek($lmp, $today);
    $daysRemaining = calculateDaysRemaining($dueDate, $today);
    $progressPercent = calculateProgressPercent($lmp, $today);
    $trimester = getTrimester($currentWeek);
    
    return [
        'success' => true,
        'due_date' => $dueDate->format('Y-m-d'),
        'due_date_display' => $dueDate->format('F j, Y'),
        'current_week' => $currentWeek,
        'days_remaining' => $daysRemaining,
        'progress_percent' => $progressPercent,
        'trimester' => $trimester,
        'method' => $method,
        'lmp_date' => $lmp->format('Y-m-d')
    ];
}

function calculateCurrentWeek($lmp, $today) {
    $diff = $lmp->diff($today);
    $totalDays = $diff->days;
    $weeks = floor($totalDays / 7);
    $days = $totalDays % 7;
    
    return [
        'week' => $weeks,
        'day' => $days,
        'total_days' => $totalDays
    ];
}

function calculateDaysRemaining($dueDate, $today) {
    $diff = $today->diff($dueDate);
    return $diff->days;
}

function calculateProgressPercent($lmp, $today) {
    $totalPregnancyDays = 280;
    $daysPassed = $lmp->diff($today)->days;
    return min(100, round(($daysPassed / $totalPregnancyDays) * 100));
}

function getTrimester($currentWeek) {
    $week = $currentWeek['week'];
    if ($week < 13) return 'First Trimester';
    if ($week < 27) return 'Second Trimester';
    return 'Third Trimester';
}

function calculateImportantDates($dueDate) {
    $due = new DateTime($dueDate);
    
    $trimester1End = clone $due;
    $trimester1End->modify('-27 weeks');
    
    $trimester2End = clone $due;
    $trimester2End->modify('-13 weeks');
    
    $viabilityDate = clone $due;
    $viabilityDate->modify('-16 weeks');
    
    return [
        'trimester1_end' => $trimester1End->format('F j, Y'),
        'trimester2_end' => $trimester2End->format('F j, Y'),
        'viability_date' => $viabilityDate->format('F j, Y')
    ];
}

function getWeeklyInfo($currentWeek) {
    $weekNumber = $currentWeek['week'];
    $weekData = [
        'title' => "Week {$weekNumber}",
        'baby_development' => getBabyDevelopment($weekNumber),
        'mother_changes' => getMotherChanges($weekNumber),
        'tips' => getWeeklyTips($weekNumber)
    ];
    
    return $weekData;
}

function getBabyDevelopment($week) {
    $developments = [
        4 => "Baby is now an embryo about the size of a poppy seed. The neural tube is forming, which will become the brain and spinal cord.",
        8 => "Baby is now about the size of a raspberry. All major organs have begun to form, and the heart is beating regularly.",
        12 => "Baby is now about the size of a lime. All vital organs are formed and beginning to function. Fingers and toes are separated.",
        16 => "Baby is now about the size of an avocado. The skeletal system is developing, and muscles are getting stronger.",
        20 => "Baby is now about the size of a banana. You might feel movements! The baby can hear sounds and may respond to your voice.",
        24 => "Baby is now about the size of an ear of corn. The lungs are developing, and the baby practices breathing movements.",
        28 => "Baby is now about the size of an eggplant. Eyes can open and close, and the brain is developing rapidly.",
        32 => "Baby is now about the size of a squash. The baby is gaining weight rapidly and has less room to move around.",
        36 => "Baby is now about the size of a head of romaine lettuce. Most organs are fully developed, and the baby is getting ready for birth.",
        40 => "Baby is now about the size of a small pumpkin! The baby is considered full-term and ready for life outside the womb."
    ];
    
    // Find the closest week with development info
    $closestWeek = $week;
    while ($closestWeek > 0 && !isset($developments[$closestWeek])) {
        $closestWeek--;
    }
    
    return $developments[$closestWeek] ?? "Your baby is growing and developing every day!";
}

function getMotherChanges($week) {
    $changes = [
        4 => "You might experience fatigue, breast tenderness, and nausea. Your body is producing more pregnancy hormones.",
        8 => "Morning sickness may peak this week. You might need more rest and experience food aversions or cravings.",
        12 => "Morning sickness often improves. Your uterus is growing, and you might start showing soon.",
        20 => "You can probably feel the baby moving! Your appetite increases, and you might experience backaches.",
        28 => "You might experience heartburn, shortness of breath, and trouble sleeping as the baby grows larger.",
        36 => "You might feel increased pelvic pressure, Braxton Hicks contractions, and fatigue as you approach delivery."
    ];
    
    // Find the closest week with changes info
    $closestWeek = $week;
    while ($closestWeek > 0 && !isset($changes[$closestWeek])) {
        $closestWeek--;
    }
    
    return $changes[$closestWeek] ?? "Your body is adapting to support your growing baby. Rest when needed and stay hydrated.";
}

function getWeeklyTips($week) {
    $tips = [
        4 => "Start taking prenatal vitamins with folic acid. Schedule your first prenatal appointment.",
        12 => "Consider sharing your pregnancy news. Start thinking about maternity clothes.",
        20 => "Schedule your anatomy scan. Start planning your baby registry.",
        28 => "Begin childbirth education classes. Start preparing your hospital bag.",
        36 => "Finalize your birth plan. Install the car seat and make final preparations."
    ];
    
    $closestWeek = $week;
    while ($closestWeek > 0 && !isset($tips[$closestWeek])) {
        $closestWeek--;
    }
    
    return $tips[$closestWeek] ?? "Continue with regular prenatal care and listen to your body's needs.";
}
?>