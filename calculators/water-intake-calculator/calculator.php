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
        $response = calculateWaterIntake($data);
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

function calculateWaterIntake($data) {
    $method = $data['method'] ?? 'standard';
    $result = [];
    
    switch ($method) {
        case 'standard':
            $result = calculateStandardMethod($data);
            break;
        case 'advanced':
            $result = calculateAdvancedMethod($data);
            break;
        default:
            $result = ['success' => false, 'message' => 'Invalid method'];
    }
    
    if ($result['success']) {
        $result['hydration_schedule'] = generateHydrationSchedule($result['recommended_intake']);
        $result['tips'] = getPersonalizedTips($data, $result['recommended_intake']);
    }
    
    return $result;
}

function calculateStandardMethod($data) {
    $weight = floatval($data['weight']);
    $weightUnit = $data['weight_unit'] ?? 'kg';
    $activityLevel = $data['activity_level'] ?? 'moderate';
    
    if ($weight <= 0) {
        return ['success' => false, 'message' => 'Please enter your weight'];
    }
    
    // Convert weight to kg if in lbs
    if ($weightUnit === 'lbs') {
        $weight = $weight * 0.453592;
    }
    
    // Base calculation: 30-35 ml per kg of body weight
    $baseIntake = $weight * 30; // ml
    
    // Adjust for activity level
    $activityMultipliers = [
        'sedentary' => 1.0,
        'light' => 1.1,
        'moderate' => 1.2,
        'very' => 1.3,
        'extreme' => 1.4
    ];
    
    $recommendedIntake = $baseIntake * $activityMultipliers[$activityLevel];
    
    return formatWaterResults($recommendedIntake);
}

function calculateAdvancedMethod($data) {
    $weight = floatval($data['weight']);
    $weightUnit = $data['weight_unit'] ?? 'kg';
    $age = intval($data['age'] ?? 30);
    $gender = $data['gender'] ?? 'male';
    $climate = $data['climate'] ?? 'temperate';
    $exerciseDuration = intval($data['exercise_duration'] ?? 0);
    $healthConditions = $data['health_conditions'] ?? [];
    $additionalFactors = $data['additional_factors'] ?? [];
    
    if ($weight <= 0) {
        return ['success' => false, 'message' => 'Please enter your weight'];
    }
    
    // Convert weight to kg if in lbs
    if ($weightUnit === 'lbs') {
        $weight = $weight * 0.453592;
    }
    
    // Base calculation by age and gender
    $baseIntake = calculateBaseIntake($age, $gender, $weight);
    
    // Adjust for climate
    $climateMultipliers = [
        'temperate' => 1.0,
        'hot' => 1.2,
        'dry' => 1.15,
        'cold' => 0.9
    ];
    
    $adjustedIntake = $baseIntake * $climateMultipliers[$climate];
    
    // Add exercise adjustment (500ml per hour of exercise)
    $exerciseAdjustment = ($exerciseDuration / 60) * 500;
    $adjustedIntake += $exerciseAdjustment;
    
    // Adjust for health conditions
    foreach ($healthConditions as $condition) {
        switch ($condition) {
            case 'pregnancy':
                $adjustedIntake += 300; // ml
                break;
            case 'fever':
                $adjustedIntake += 500; // ml
                break;
            case 'kidney':
                // Consult doctor - might need to limit intake
                $adjustedIntake = min($adjustedIntake, 2000);
                break;
            case 'heart':
                // Consult doctor - might need to limit intake
                $adjustedIntake = min($adjustedIntake, 1500);
                break;
        }
    }
    
    // Adjust for additional factors
    foreach ($additionalFactors as $factor) {
        switch ($factor) {
            case 'high-altitude':
                $adjustedIntake += 500;
                break;
            case 'alcohol':
                $adjustedIntake += 500; // Extra to compensate for dehydration
                break;
            case 'caffeine':
                $adjustedIntake += 250; // Extra to compensate for diuretic effect
                break;
            case 'high-protein':
                $adjustedIntake += 300; // Extra for protein metabolism
                break;
        }
    }
    
    return formatWaterResults($adjustedIntake);
}

function calculateBaseIntake($age, $gender, $weight) {
    // Base intake in ml
    if ($age <= 18) {
        return $weight * 40; // Higher for younger individuals
    } elseif ($age <= 30) {
        if ($gender === 'male') {
            return $weight * 35;
        } else {
            return $weight * 32;
        }
    } elseif ($age <= 50) {
        if ($gender === 'male') {
            return $weight * 33;
        } else {
            return $weight * 30;
        }
    } else {
        if ($gender === 'male') {
            return $weight * 30;
        } else {
            return $weight * 27;
        }
    }
}

function formatWaterResults($intakeMl) {
    // Ensure reasonable limits
    $intakeMl = max(1500, min(5000, $intakeMl));
    
    $intakeLiters = $intakeMl / 1000;
    $minIntake = $intakeMl * 0.8; // 80% of recommended
    $maxIntake = $intakeMl * 1.2; // 120% of recommended
    
    // Calculate equivalent in glasses (assuming 250ml per glass)
    $glasses = round($intakeMl / 250, 1);
    $bottles500ml = round($intakeMl / 500, 1);
    $bottles1L = round($intakeMl / 1000, 1);
    
    return [
        'success' => true,
        'recommended_intake' => round($intakeMl),
        'recommended_liters' => round($intakeLiters, 2),
        'min_intake' => round($minIntake),
        'max_intake' => round($maxIntake),
        'equivalent' => [
            'glasses' => $glasses,
            'bottles_500ml' => $bottles500ml,
            'bottles_1l' => $bottles1L
        ]
    ];
}

function generateHydrationSchedule($totalIntake) {
    $schedule = [];
    $times = ['7:00 AM', '9:00 AM', '11:00 AM', '1:00 PM', '3:00 PM', '5:00 PM', '7:00 PM', '9:00 PM'];
    
    // Distribute water intake across the day
    $amountPerSlot = round($totalIntake / count($times));
    
    foreach ($times as $time) {
        $schedule[] = [
            'time' => $time,
            'amount_ml' => $amountPerSlot,
            'amount_glasses' => round($amountPerSlot / 250, 1)
        ];
    }
    
    return $schedule;
}

function getPersonalizedTips($data, $intake) {
    $tips = [];
    
    // Activity level tips
    if (($data['activity_level'] ?? 'moderate') === 'sedentary') {
        $tips[] = "Set reminders to drink water since you may not feel naturally thirsty while sedentary";
    }
    
    if (($data['activity_level'] ?? 'moderate') === 'very' || ($data['activity_level'] ?? 'moderate') === 'extreme') {
        $tips[] = "Drink extra water before, during, and after exercise to maintain performance";
    }
    
    // Climate tips
    if (($data['climate'] ?? 'temperate') === 'hot' || ($data['climate'] ?? 'temperate') === 'dry') {
        $tips[] = "In hot/dry climates, carry water with you and drink small amounts frequently";
    }
    
    // Health condition tips
    $healthConditions = $data['health_conditions'] ?? [];
    if (in_array('pregnancy', $healthConditions)) {
        $tips[] = "As a pregnant individual, stay well-hydrated to support your baby's development";
    }
    
    if (in_array('kidney', $healthConditions) || in_array('heart', $healthConditions)) {
        $tips[] = "Consult your doctor about the appropriate water intake for your specific condition";
    }
    
    // General tips
    $tips[] = "Drink a glass of water 30 minutes before meals to aid digestion";
    $tips[] = "Monitor your urine color - pale yellow indicates good hydration";
    $tips[] = "Increase water intake if you consume alcohol or caffeine";
    
    return array_slice($tips, 0, 5); // Return top 5 tips
}
?>