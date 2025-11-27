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
        $response = calculateHeartRate($data);
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

function calculateHeartRate($data) {
    $method = $data['method'] ?? 'basic';
    $result = [];
    
    switch ($method) {
        case 'basic':
            $result = calculateBasicMethod($data);
            break;
        case 'advanced':
            $result = calculateAdvancedMethod($data);
            break;
        case 'resting':
            $result = calculateRestingMethod($data);
            break;
        default:
            $result = ['success' => false, 'message' => 'Invalid method'];
    }
    
    if ($result['success']) {
        $result['health_insights'] = getHealthInsights($data, $result);
        $result['training_recommendations'] = getTrainingRecommendations($data, $result);
    }
    
    return $result;
}

function calculateBasicMethod($data) {
    $age = intval($data['age']);
    $restingHR = isset($data['resting_hr']) ? intval($data['resting_hr']) : 70;
    $fitnessLevel = $data['fitness_level'] ?? 'intermediate';
    
    if (!$age) {
        return ['success' => false, 'message' => 'Age is required'];
    }
    
    // Calculate maximum HR using Haskell & Fox formula
    $maxHR = 220 - $age;
    
    // Calculate HR reserve
    $hrReserve = $maxHR - $restingHR;
    
    // Calculate target zones
    $zones = calculateTargetZones($maxHR, $restingHR, $hrReserve, $fitnessLevel);
    
    return [
        'success' => true,
        'max_hr' => $maxHR,
        'resting_hr' => $restingHR,
        'hr_reserve' => $hrReserve,
        'zones' => $zones,
        'formula_used' => 'Haskell & Fox (220 - age)'
    ];
}

function calculateAdvancedMethod($data) {
    $age = intval($data['age']);
    $restingHR = intval($data['resting_hr']);
    $formula = $data['formula'] ?? 'karvonen';
    $trainingGoal = $data['training_goal'] ?? 'cardio';
    
    if (!$age || !$restingHR) {
        return ['success' => false, 'message' => 'Age and resting HR are required'];
    }
    
    // Calculate maximum HR using selected formula
    $maxHR = calculateMaxHR($age, $formula);
    $hrReserve = $maxHR - $restingHR;
    
    // Calculate zones based on training goal
    $zones = calculateAdvancedZones($maxHR, $restingHR, $hrReserve, $trainingGoal);
    
    $formulaNames = [
        'karvonen' => 'Karvonen Method',
        'tanaka' => 'Tanaka Formula',
        'gellish' => 'Gellish Formula',
        'haskell' => 'Haskell & Fox'
    ];
    
    return [
        'success' => true,
        'max_hr' => $maxHR,
        'resting_hr' => $restingHR,
        'hr_reserve' => $hrReserve,
        'zones' => $zones,
        'formula_used' => $formulaNames[$formula] ?? 'Karvonen Method'
    ];
}

function calculateRestingMethod($data) {
    $restingHR = intval($data['resting_hr']);
    $measurementTime = $data['measurement_time'] ?? 'morning';
    $healthConditions = $data['health_conditions'] ?? [];
    
    if (!$restingHR) {
        return ['success' => false, 'message' => 'Resting HR is required'];
    }
    
    // Adjust resting HR based on measurement time
    $adjustedHR = $restingHR;
    if ($measurementTime === 'evening') {
        $adjustedHR += 5; // Typically higher in evening
    } elseif ($measurementTime === 'random') {
        $adjustedHR += 3; // Slight adjustment for random times
    }
    
    // Adjust for health conditions
    foreach ($healthConditions as $condition) {
        switch ($condition) {
            case 'hypertension':
                $adjustedHR += 5;
                break;
            case 'stress':
                $adjustedHR += 8;
                break;
            case 'dehydration':
                $adjustedHR += 10;
                break;
            case 'medication':
                $adjustedHR -= 5; // Some medications lower HR
                break;
        }
    }
    
    // Calculate estimated max HR (rough estimate)
    $estimatedMaxHR = 220 - 30; // Using average age
    
    return [
        'success' => true,
        'resting_hr' => $restingHR,
        'adjusted_resting_hr' => max(40, min(120, $adjustedHR)),
        'resting_hr_category' => getRestingHRCategory($adjustedHR),
        'estimated_max_hr' => $estimatedMaxHR,
        'analysis' => analyzeRestingHR($adjustedHR)
    ];
}

function calculateMaxHR($age, $formula) {
    switch ($formula) {
        case 'tanaka':
            return 208 - (0.7 * $age);
        case 'gellish':
            return 206.9 - (0.67 * $age);
        case 'haskell':
            return 220 - $age;
        case 'karvonen':
        default:
            return 220 - $age; // Karvonen uses MHR calculation similar to Haskell
    }
}

function calculateTargetZones($maxHR, $restingHR, $hrReserve, $fitnessLevel) {
    $zones = [];
    
    // Define zone percentages based on fitness level
    $zonePercentages = getZonePercentages($fitnessLevel);
    
    foreach ($zonePercentages as $zone => $percentages) {
        $minPercent = $percentages['min'];
        $maxPercent = $percentages['max'];
        
        // Using Karvonen method for more accurate zones
        $minHR = $restingHR + ($hrReserve * $minPercent / 100);
        $maxHRZone = $restingHR + ($hrReserve * $maxPercent / 100);
        
        $zones[$zone] = [
            'min_bpm' => round($minHR),
            'max_bpm' => round($maxHRZone),
            'min_percent' => $minPercent,
            'max_percent' => $maxPercent,
            'description' => getZoneDescription($zone)
        ];
    }
    
    return $zones;
}

function calculateAdvancedZones($maxHR, $restingHR, $hrReserve, $trainingGoal) {
    $zones = [];
    
    // Different zone focuses based on training goal
    $zoneFocus = getZoneFocus($trainingGoal);
    
    foreach ($zoneFocus as $zone => $percentages) {
        $minPercent = $percentages['min'];
        $maxPercent = $percentages['max'];
        
        $minHR = $restingHR + ($hrReserve * $minPercent / 100);
        $maxHRZone = $restingHR + ($hrReserve * $maxPercent / 100);
        
        $zones[$zone] = [
            'min_bpm' => round($minHR),
            'max_bpm' => round($maxHRZone),
            'min_percent' => $minPercent,
            'max_percent' => $maxPercent,
            'description' => getZoneDescription($zone)
        ];
    }
    
    return $zones;
}

function getZonePercentages($fitnessLevel) {
    $percentages = [
        'zone_1' => ['min' => 50, 'max' => 60],
        'zone_2' => ['min' => 60, 'max' => 70],
        'zone_3' => ['min' => 70, 'max' => 80],
        'zone_4' => ['min' => 80, 'max' => 90],
        'zone_5' => ['min' => 90, 'max' => 100]
    ];
    
    // Adjust for fitness level
    if ($fitnessLevel === 'beginner') {
        $percentages['zone_1']['max'] = 65;
        $percentages['zone_2']['min'] = 65;
        $percentages['zone_2']['max'] = 75;
    } elseif ($fitnessLevel === 'athlete') {
        $percentages['zone_4']['max'] = 95;
        $percentages['zone_5']['min'] = 95;
    }
    
    return $percentages;
}

function getZoneFocus($trainingGoal) {
    $focus = [
        'fat_burn' => [
            'zone_1' => ['min' => 50, 'max' => 60],
            'zone_2' => ['min' => 60, 'max' => 70],
            'zone_3' => ['min' => 70, 'max' => 80]
        ],
        'cardio' => [
            'zone_2' => ['min' => 60, 'max' => 70],
            'zone_3' => ['min' => 70, 'max' => 80],
            'zone_4' => ['min' => 80, 'max' => 90]
        ],
        'peak' => [
            'zone_4' => ['min' => 80, 'max' => 90],
            'zone_5' => ['min' => 90, 'max' => 100]
        ],
        'recovery' => [
            'zone_1' => ['min' => 50, 'max' => 60]
        ]
    ];
    
    return $focus[$trainingGoal] ?? $focus['cardio'];
}

function getZoneDescription($zone) {
    $descriptions = [
        'zone_1' => 'Very Light: Warm-up, recovery, fat burning',
        'zone_2' => 'Light: Aerobic base, endurance training',
        'zone_3' => 'Moderate: Aerobic fitness, improved stamina',
        'zone_4' => 'Hard: Anaerobic threshold, performance',
        'zone_5' => 'Maximum: Peak effort, short bursts only'
    ];
    
    return $descriptions[$zone] ?? 'Training zone';
}

function getRestingHRCategory($restingHR) {
    if ($restingHR < 60) return 'Excellent (Athlete)';
    if ($restingHR < 70) return 'Good';
    if ($restingHR < 80) return 'Average';
    if ($restingHR < 90) return 'Below Average';
    return 'High (Consult Doctor)';
}

function analyzeRestingHR($restingHR) {
    if ($restingHR < 60) {
        return "Your resting heart rate indicates excellent cardiovascular fitness, typical of well-trained athletes.";
    } elseif ($restingHR < 70) {
        return "Good resting heart rate indicating above average cardiovascular fitness.";
    } elseif ($restingHR < 80) {
        return "Average resting heart rate. Regular exercise can help improve this.";
    } else {
        return "Higher than average resting heart rate. Consider consulting a healthcare provider and increasing physical activity.";
    }
}

function getHealthInsights($data, $result) {
    $insights = [];
    
    // Resting HR insight
    $restingHR = $result['resting_hr'];
    if ($restingHR < 60) {
        $insights['resting_hr'] = "Excellent! Your resting HR indicates great cardiovascular health.";
    } elseif ($restingHR > 80) {
        $insights['resting_hr'] = "Your resting HR is higher than ideal. Consider more cardio exercise.";
    } else {
        $insights['resting_hr'] = "Good resting HR. Maintain your current activity level.";
    }
    
    // Fitness insight based on HR reserve
    $hrReserve = $result['hr_reserve'];
    if ($hrReserve > 100) {
        $insights['fitness'] = "Good heart rate reserve indicating decent fitness level.";
    } else {
        $insights['fitness'] = "Consider building cardiovascular endurance through regular exercise.";
    }
    
    // Training insight
    $activityLevel = $data['activity_level'] ?? 'moderate';
    if ($activityLevel === 'sedentary') {
        $insights['training'] = "Start with Zone 1-2 training and gradually increase intensity.";
    } elseif ($activityLevel === 'very') {
        $insights['training'] = "You can safely train in higher zones. Focus on Zone 3-4 for best results.";
    } else {
        $insights['training'] = "Mix Zone 2-3 training for balanced fitness improvement.";
    }
    
    return $insights;
}

function getTrainingRecommendations($data, $result) {
    $recommendations = [];
    $fitnessLevel = $data['fitness_level'] ?? 'intermediate';
    $activityLevel = $data['activity_level'] ?? 'moderate';
    
    if ($fitnessLevel === 'beginner') {
        $recommendations[] = "Start with 20-30 minutes in Zone 1-2, 3 times per week";
        $recommendations[] = "Focus on consistency rather than intensity";
        $recommendations[] = "Gradually increase duration before increasing intensity";
    } elseif ($fitnessLevel === 'advanced' || $fitnessLevel === 'athlete') {
        $recommendations[] = "Incorporate Zone 4-5 training 1-2 times per week";
        $recommendations[] = "Include interval training for performance gains";
        $recommendations[] = "Allow adequate recovery between high-intensity sessions";
    } else {
        $recommendations[] = "Aim for 30-45 minutes in Zone 2-3, 4-5 times per week";
        $recommendations[] = "Include one longer, slower session in Zone 2 weekly";
        $recommendations[] = "Add one higher intensity session in Zone 3-4 weekly";
    }
    
    return $recommendations;
}
?>