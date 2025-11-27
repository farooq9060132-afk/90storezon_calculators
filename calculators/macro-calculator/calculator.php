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
        $response = calculateMacros($data);
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

function calculateMacros($data) {
    // Calculate BMR and TDEE
    $bmr = calculateBMR($data);
    $tdee = calculateTDEE($bmr, $data['activity_level']);
    $calorieTarget = calculateCalorieTarget($tdee, $data['goal']);
    
    // Calculate macronutrients
    $macros = calculateMacronutrients($calorieTarget, $data);
    
    // Generate meal distribution
    $mealDistribution = generateMealDistribution($macros, $data['meal_count'] ?? 3);
    
    return [
        'success' => true,
        'calories' => [
            'bmr' => round($bmr),
            'tdee' => round($tdee),
            'target' => round($calorieTarget)
        ],
        'macros' => $macros,
        'meal_distribution' => $mealDistribution,
        'recommendations' => getMacroRecommendations($data, $macros)
    ];
}

function calculateBMR($data) {
    $weight = floatval($data['weight']);
    $height = floatval($data['height']);
    $age = intval($data['age']);
    $gender = $data['gender'];
    
    // Mifflin-St Jeor Equation
    if ($gender === 'male') {
        $bmr = (10 * $weight) + (6.25 * $height) - (5 * $age) + 5;
    } else {
        $bmr = (10 * $weight) + (6.25 * $height) - (5 * $age) - 161;
    }
    
    return $bmr;
}

function calculateTDEE($bmr, $activityLevel) {
    $activityMultipliers = [
        'sedentary' => 1.2,
        'light' => 1.375,
        'moderate' => 1.55,
        'very' => 1.725,
        'extreme' => 1.9
    ];
    
    return $bmr * $activityMultipliers[$activityLevel];
}

function calculateCalorieTarget($tdee, $goal) {
    $goalAdjustments = [
        'weight_loss' => 0.85,      // 15% deficit
        'maintenance' => 1.0,       // Maintenance
        'muscle_gain' => 1.15,      // 15% surplus
        'extreme_cut' => 0.75       // 25% deficit
    ];
    
    return $tdee * $goalAdjustments[$goal];
}

function calculateMacronutrients($calories, $data) {
    $goal = $data['goal'];
    $dietType = $data['diet_type'];
    $proteinPreference = $data['protein_preference'];
    $weight = floatval($data['weight']);
    $bodyFat = isset($data['body_fat']) ? floatval($data['body_fat']) : null;
    
    // Calculate protein based on preference and goal
    $proteinGrams = calculateProtein($weight, $bodyFat, $goal, $proteinPreference);
    $proteinCalories = $proteinGrams * 4;
    
    // Calculate fats (20-35% of total calories)
    $fatRatio = calculateFatRatio($dietType, $goal);
    $fatCalories = $calories * $fatRatio;
    $fatGrams = $fatCalories / 9;
    
    // Remaining calories go to carbs
    $remainingCalories = $calories - $proteinCalories - $fatCalories;
    $carbsGrams = $remainingCalories / 4;
    
    // Calculate percentages
    $proteinPercent = ($proteinCalories / $calories) * 100;
    $carbsPercent = ($remainingCalories / $calories) * 100;
    $fatPercent = ($fatCalories / $calories) * 100;
    
    return [
        'protein' => [
            'grams' => round($proteinGrams),
            'calories' => round($proteinCalories),
            'percent' => round($proteinPercent, 1)
        ],
        'carbs' => [
            'grams' => round($carbsGrams),
            'calories' => round($remainingCalories),
            'percent' => round($carbsPercent, 1)
        ],
        'fats' => [
            'grams' => round($fatGrams),
            'calories' => round($fatCalories),
            'percent' => round($fatPercent, 1)
        ]
    ];
}

function calculateProtein($weight, $bodyFat, $goal, $preference) {
    $leanMass = $bodyFat ? $weight * (1 - ($bodyFat / 100)) : $weight;
    
    $proteinMultipliers = [
        'moderate' => 1.6,
        'high' => 2.0,
        'very_high' => 2.4
    ];
    
    $baseProtein = $leanMass * $proteinMultipliers[$preference];
    
    // Adjust for goals
    if ($goal === 'muscle_gain') {
        $baseProtein *= 1.1;
    } elseif ($goal === 'extreme_cut') {
        $baseProtein *= 1.2; // Higher protein during cuts to preserve muscle
    }
    
    return max(50, min(300, $baseProtein)); // Reasonable limits
}

function calculateFatRatio($dietType, $goal) {
    $fatRatios = [
        'balanced' => 0.25,
        'high_protein' => 0.25,
        'low_carb' => 0.35,
        'keto' => 0.70,
        'high_carb' => 0.20
    ];
    
    $baseRatio = $fatRatios[$dietType];
    
    // Adjust for goals
    if ($goal === 'weight_loss' || $goal === 'extreme_cut') {
        $baseRatio = min(0.30, $baseRatio); // Lower fat for weight loss
    }
    
    return $baseRatio;
}

function generateMealDistribution($macros, $mealCount) {
    $distribution = [];
    $meals = [];
    
    // Define meal patterns based on number of meals
    $mealPatterns = [
        3 => [0.30, 0.40, 0.30],   // Breakfast, Lunch, Dinner
        4 => [0.25, 0.30, 0.30, 0.15], // Breakfast, Lunch, Dinner, Snack
        5 => [0.20, 0.25, 0.30, 0.15, 0.10], // + 2 snacks
        6 => [0.20, 0.20, 0.25, 0.15, 0.10, 0.10] // + 3 snacks
    ];
    
    $pattern = $mealPatterns[$mealCount] ?? $mealPatterns[3];
    
    $mealNames = [
        'Breakfast', 'Lunch', 'Dinner', 'Snack 1', 'Snack 2', 'Snack 3'
    ];
    
    for ($i = 0; $i < $mealCount; $i++) {
        $ratio = $pattern[$i];
        $mealCalories = round($macros['protein']['calories'] + $macros['carbs']['calories'] + $macros['fats']['calories']) * $ratio;
        
        $meals[] = [
            'name' => $mealNames[$i],
            'calories' => round($mealCalories),
            'protein' => round($macros['protein']['grams'] * $ratio),
            'carbs' => round($macros['carbs']['grams'] * $ratio),
            'fats' => round($macros['fats']['grams'] * $ratio)
        ];
    }
    
    return $meals;
}

function getMacroRecommendations($data, $macros) {
    $recommendations = [];
    
    // Protein recommendations
    if ($macros['protein']['grams'] > 2.2 * $data['weight']) {
        $recommendations[] = "Your protein intake is quite high. Make sure to spread it throughout the day and stay hydrated.";
    }
    
    // Carb recommendations based on activity
    if ($data['activity_level'] === 'very' || $data['activity_level'] === 'extreme') {
        if ($macros['carbs']['percent'] < 45) {
            $recommendations[] = "Consider increasing carbs slightly to support your high activity level.";
        }
    }
    
    // Diet type specific recommendations
    if ($data['diet_type'] === 'keto') {
        $recommendations[] = "For keto, ensure net carbs stay below 20-30g per day.";
    }
    
    if ($data['diet_type'] === 'low_carb') {
        $recommendations[] = "For low carb, focus on getting carbs around workouts for best performance.";
    }
    
    // General recommendations
    $recommendations[] = "Drink at least 2-3 liters of water daily, especially with high protein intake.";
    $recommendations[] = "Track your progress weekly and adjust macros if needed.";
    
    return array_slice($recommendations, 0, 3);
}
?>