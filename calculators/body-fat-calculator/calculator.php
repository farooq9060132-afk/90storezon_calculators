<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $gender = $_POST['gender'] ?? '';
    $age = floatval($_POST['age'] ?? 0);
    $height = floatval($_POST['height'] ?? 0);
    $weight = floatval($_POST['weight'] ?? 0);
    $waist = floatval($_POST['waist'] ?? 0);
    $neck = floatval($_POST['neck'] ?? 0);
    $hip = floatval($_POST['hip'] ?? 0);

    // Validate inputs
    if (empty($gender) || $age < 18 || $age > 80 || $height < 100 || $weight < 30 || $waist < 50 || $neck < 20) {
        echo json_encode(['error' => 'Please check your inputs and try again.']);
        exit;
    }

    // Calculate body fat using US Navy method
    if ($gender === 'male') {
        $bodyFat = 495 / (1.0324 - 0.19077 * log10($waist - $neck) + 0.15456 * log10($height)) - 450;
    } else {
        if ($hip < 60) {
            echo json_encode(['error' => 'Please provide valid hip measurement.']);
            exit;
        }
        $bodyFat = 495 / (1.29579 - 0.35004 * log10($waist + $hip - $neck) + 0.22100 * log10($height)) - 450;
    }

    // Ensure body fat is within reasonable range
    $bodyFat = max(2, min(50, $bodyFat));
    
    // Calculate fat mass and lean mass
    $fatMass = ($bodyFat / 100) * $weight;
    $leanMass = $weight - $fatMass;

    // Determine category
    $category = getBodyFatCategory($bodyFat, $gender);

    // Health tips based on category
    $healthTips = getHealthTips($category);

    echo json_encode([
        'success' => true,
        'bodyFat' => round($bodyFat, 1),
        'category' => $category,
        'fatMass' => round($fatMass, 1),
        'leanMass' => round($leanMass, 1),
        'healthTips' => $healthTips
    ]);
} else {
    echo json_encode(['error' => 'Invalid request method.']);
}

function getBodyFatCategory($bodyFat, $gender) {
    if ($gender === 'male') {
        if ($bodyFat < 6) return 'Essential Fat';
        if ($bodyFat < 14) return 'Athlete';
        if ($bodyFat < 18) return 'Fitness';
        if ($bodyFat < 25) return 'Average';
        return 'Obese';
    } else {
        if ($bodyFat < 14) return 'Essential Fat';
        if ($bodyFat < 21) return 'Athlete';
        if ($bodyFat < 25) return 'Fitness';
        if ($bodyFat < 32) return 'Average';
        return 'Obese';
    }
}

function getHealthTips($category) {
    $tips = [
        'Essential Fat' => [
            'Maintain current fitness level',
            'Ensure adequate nutrition',
            'Monitor health regularly'
        ],
        'Athlete' => [
            'Excellent! Maintain your routine',
            'Focus on sports-specific training',
            'Ensure proper recovery'
        ],
        'Fitness' => [
            'Great job! Continue current routine',
            'Consider strength training',
            'Maintain balanced diet'
        ],
        'Average' => [
            'Add regular cardio exercise',
            'Focus on balanced nutrition',
            'Aim for 150 mins exercise/week'
        ],
        'Obese' => [
            'Consult healthcare provider',
            'Start with light walking',
            'Focus on sustainable diet changes'
        ]
    ];

    return $tips[$category] ?? ['Maintain healthy lifestyle', 'Regular checkups recommended'];
}
?>