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
        $response = calculateMedication($data);
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

function calculateMedication($data) {
    $method = $data['method'] ?? 'dosage';
    $result = [];
    
    switch ($method) {
        case 'dosage':
            $result = calculateDosage($data);
            break;
        case 'interaction':
            $result = checkInteractions($data);
            break;
        case 'schedule':
            $result = generateSchedule($data);
            break;
        default:
            $result = ['success' => false, 'message' => 'Invalid method'];
    }
    
    if ($result['success']) {
        $result['safety_alerts'] = generateSafetyAlerts($data, $result);
        $result['educational_info'] = getEducationalInfo($data);
    }
    
    return $result;
}

function calculateDosage($data) {
    $weight = floatval($data['weight']);
    $weightUnit = $data['weight_unit'] ?? 'kg';
    $age = intval($data['age'] ?? 30);
    $condition = $data['condition'] ?? 'general';
    $medication = $data['medication_name'] ?? '';
    $dosageForm = $data['dosage_form'] ?? 'tablet';
    $calcType = $data['calculation_type'] ?? 'single';
    
    if (!$weight) {
        return ['success' => false, 'message' => 'Weight is required for dosage calculation'];
    }
    
    // Convert weight to kg if in lbs
    if ($weightUnit === 'lbs') {
        $weight = $weight * 0.453592;
    }
    
    // Calculate dosage based on medication type and condition
    $dosageInfo = calculateMedicationDosage($medication, $weight, $age, $condition, $calcType);
    
    // Generate administration instructions
    $administration = generateAdministrationInstructions($dosageForm, $condition, $age);
    
    return [
        'success' => true,
        'calculated_dosage' => $dosageInfo['dosage'],
        'frequency' => $dosageInfo['frequency'],
        'duration' => $dosageInfo['duration'],
        'max_daily_dose' => $dosageInfo['max_daily'],
        'administration' => $administration,
        'special_instructions' => $dosageInfo['instructions'],
        'weight_used' => round($weight, 1) . ' kg'
    ];
}

function calculateMedicationDosage($medication, $weight, $age, $condition, $calcType) {
    // Common medication dosage guidelines (for educational purposes)
    $medicationGuidelines = [
        'amoxicillin' => [
            'adult_dose' => '250-500 mg',
            'pediatric_dose' => '20-40 mg/kg/day',
            'frequency' => 'every 8 hours',
            'max_daily' => '1500 mg',
            'duration' => '7-10 days'
        ],
        'ibuprofen' => [
            'adult_dose' => '200-400 mg',
            'pediatric_dose' => '5-10 mg/kg',
            'frequency' => 'every 6-8 hours',
            'max_daily' => '1200 mg',
            'duration' => 'As needed'
        ],
        'paracetamol' => [
            'adult_dose' => '500-1000 mg',
            'pediatric_dose' => '10-15 mg/kg',
            'frequency' => 'every 4-6 hours',
            'max_daily' => '4000 mg',
            'duration' => 'As needed'
        ]
    ];
    
    $medKey = strtolower($medication);
    $guideline = $medicationGuidelines[$medKey] ?? $medicationGuidelines['ibuprofen'];
    
    // Determine if pediatric dosage
    $isPediatric = $age < 18;
    
    if ($isPediatric && isset($guideline['pediatric_dose'])) {
        // Calculate pediatric dosage based on weight
        if (strpos($guideline['pediatric_dose'], 'mg/kg') !== false) {
            $dosePerKg = floatval($guideline['pediatric_dose']);
            $calculatedDose = $weight * $dosePerKg;
            $dosage = round($calculatedDose) . ' mg';
        } else {
            $dosage = $guideline['pediatric_dose'];
        }
    } else {
        $dosage = $guideline['adult_dose'];
    }
    
    // Adjust for calculation type
    if ($calcType === 'daily') {
        $dosage = "Total daily: " . $guideline['max_daily'];
    } elseif ($calcType === 'weight') {
        $dosage = "Based on weight: " . $dosage;
    }
    
    return [
        'dosage' => $dosage,
        'frequency' => $guideline['frequency'],
        'duration' => $guideline['duration'],
        'max_daily' => $guideline['max_daily'],
        'instructions' => getDosageInstructions($medKey, $condition)
    ];
}

function getDosageInstructions($medication, $condition) {
    $instructions = [
        'amoxicillin' => 'Take with plenty of water. Complete the full course even if you feel better.',
        'ibuprofen' => 'Take with food or milk to avoid stomach upset. Do not exceed recommended dosage.',
        'paracetamol' => 'Take with water. Avoid alcohol while taking this medication.'
    ];
    
    return $instructions[$medication] ?? 'Follow your healthcare provider\'s instructions carefully.';
}

function generateAdministrationInstructions($dosageForm, $condition, $age) {
    $instructions = [
        'method' => '',
        'best_time' => '',
        'food_instructions' => ''
    ];
    
    switch ($dosageForm) {
        case 'tablet':
            $instructions['method'] = 'Swallow whole with a full glass of water';
            break;
        case 'capsule':
            $instructions['method'] = 'Swallow whole with water. Do not crush or chew';
            break;
        case 'liquid':
            $instructions['method'] = 'Shake well before use. Use the measuring device provided';
            break;
        case 'injection':
            $instructions['method'] = 'For healthcare professional administration only';
            break;
        default:
            $instructions['method'] = 'Follow package instructions carefully';
    }
    
    // Best time recommendations
    if ($condition === 'chronic') {
        $instructions['best_time'] = 'Take at the same time each day';
    } else {
        $instructions['best_time'] = 'Take as directed by your healthcare provider';
    }
    
    // Food instructions
    $instructions['food_instructions'] = 'Take with food unless otherwise directed';
    
    return $instructions;
}

function checkInteractions($data) {
    $currentMeds = $data['current_medications'] ?? [];
    $newMedication = $data['new_medication'] ?? '';
    $healthConditions = $data['health_conditions'] ?? [];
    $allergies = $data['allergies'] ?? '';
    
    if (empty($currentMeds) || empty($newMedication)) {
        return ['success' => false, 'message' => 'Please provide current medications and the new medication to check'];
    }
    
    // Common drug interactions database (educational purposes)
    $interactionDatabase = [
        'warfarin' => [
            'interacts_with' => ['ibuprofen', 'aspirin', 'omeprazole'],
            'severity' => 'high',
            'description' => 'Increased risk of bleeding'
        ],
        'lisinopril' => [
            'interacts_with' => ['ibuprofen', 'naproxen'],
            'severity' => 'moderate',
            'description' => 'May reduce blood pressure control and affect kidney function'
        ],
        'metformin' => [
            'interacts_with' => ['contrast_dye'],
            'severity' => 'high',
            'description' => 'Risk of lactic acidosis'
        ]
    ];
    
    $interactions = [];
    $maxSeverity = 'none';
    
    foreach ($currentMeds as $currentMed) {
        $currentMedKey = strtolower($currentMed);
        $newMedKey = strtolower($newMedication);
        
        // Check if interaction exists
        if (isset($interactionDatabase[$currentMedKey])) {
            $medInteractions = $interactionDatabase[$currentMedKey];
            if (in_array($newMedKey, $medInteractions['interacts_with'])) {
                $interactions[] = [
                    'medication1' => $currentMed,
                    'medication2' => $newMedication,
                    'severity' => $medInteractions['severity'],
                    'description' => $medInteractions['description']
                ];
                
                // Update max severity
                if ($medInteractions['severity'] === 'high') {
                    $maxSeverity = 'high';
                } elseif ($medInteractions['severity'] === 'moderate' && $maxSeverity !== 'high') {
                    $maxSeverity = 'moderate';
                }
            }
        }
    }
    
    // Check for condition-based precautions
    $precautions = checkConditionPrecautions($newMedication, $healthConditions, $allergies);
    
    return [
        'success' => true,
        'interaction_level' => $maxSeverity,
        'interactions' => $interactions,
        'precautions' => $precautions,
        'summary' => generateInteractionSummary($maxSeverity, count($interactions))
    ];
}

function checkConditionPrecautions($medication, $conditions, $allergies) {
    $precautions = [];
    
    $conditionPrecautions = [
        'hypertension' => [
            'medications' => ['decongestants', 'nsaids'],
            'precaution' => 'May increase blood pressure'
        ],
        'kidney' => [
            'medications' => ['nsaids', 'contrast_dye'],
            'precaution' => 'May affect kidney function'
        ],
        'liver' => [
            'medications' => ['paracetamol', 'statins'],
            'precaution' => 'May require dosage adjustment'
        ]
    ];
    
    $medKey = strtolower($medication);
    
    foreach ($conditions as $condition) {
        if (isset($conditionPrecautions[$condition])) {
            $precautionInfo = $conditionPrecautions[$condition];
            if (in_array($medKey, $precautionInfo['medications'])) {
                $precautions[] = $precautionInfo['precaution'] . " (due to $condition)";
            }
        }
    }
    
    // Check for allergies
    if ($allergies && stripos($allergies, $medKey) !== false) {
        $precautions[] = "Potential allergy risk - avoid this medication";
    }
    
    return $precautions;
}

function generateInteractionSummary($severity, $interactionCount) {
    if ($severity === 'high') {
        return "Significant interactions detected. Consult your healthcare provider immediately.";
    } elseif ($severity === 'moderate') {
        return "Moderate interactions found. Discuss with your healthcare provider.";
    } elseif ($interactionCount > 0) {
        return "Minor interactions noted. Monitor carefully.";
    } else {
        return "No significant interactions detected based on available information.";
    }
}

function generateSchedule($data) {
    $medications = $data['medications'] ?? [];
    $wakeTime = $data['wake_time'] ?? '07:00';
    $bedTime = $data['bed_time'] ?? '22:00';
    $mealPreference = $data['meal_preference'] ?? 'with_food';
    $scheduleDays = intval($data['schedule_days'] ?? 30);
    
    if (empty($medications)) {
        return ['success' => false, 'message' => 'Please provide medications for scheduling'];
    }
    
    // Parse medications and frequencies
    $parsedMeds = parseMedications($medications);
    
    // Generate daily schedule
    $dailySchedule = generateDailySchedule($parsedMeds, $wakeTime, $bedTime, $mealPreference);
    
    // Generate calendar for the specified duration
    $calendar = generateMedicationCalendar($parsedMeds, $scheduleDays);
    
    return [
        'success' => true,
        'daily_schedule' => $dailySchedule,
        'calendar' => $calendar,
        'schedule_period' => "Next $scheduleDays days",
        'medication_count' => count($parsedMeds)
    ];
}

function parseMedications($medicationsText) {
    $medications = [];
    $lines = explode("\n", $medicationsText);
    
    foreach ($lines as $line) {
        $line = trim($line);
        if (!empty($line)) {
            // Simple parsing - in real application, this would be more sophisticated
            $medications[] = [
                'name' => $line,
                'frequency' => extractFrequency($line),
                'with_food' => shouldTakeWithFood($line)
            ];
        }
    }
    
    return $medications;
}

function extractFrequency($medicationLine) {
    if (stripos($medicationLine, 'daily') !== false) return 'once_daily';
    if (stripos($medicationLine, 'twice') !== false) return 'twice_daily';
    if (stripos($medicationLine, 'three times') !== false) return 'three_times_daily';
    if (stripos($medicationLine, 'four times') !== false) return 'four_times_daily';
    return 'once_daily';
}

function shouldTakeWithFood($medicationLine) {
    // Simple logic - in real app, this would use a medication database
    return stripos($medicationLine, 'with food') !== false;
}

function generateDailySchedule($medications, $wakeTime, $bedTime, $mealPreference) {
    $schedule = [
        'morning' => [],
        'afternoon' => [],
        'evening' => [],
        'bedtime' => []
    ];
    
    foreach ($medications as $med) {
        switch ($med['frequency']) {
            case 'once_daily':
                $schedule['morning'][] = $med['name'];
                break;
            case 'twice_daily':
                $schedule['morning'][] = $med['name'];
                $schedule['evening'][] = $med['name'];
                break;
            case 'three_times_daily':
                $schedule['morning'][] = $med['name'];
                $schedule['afternoon'][] = $med['name'];
                $schedule['evening'][] = $med['name'];
                break;
            case 'four_times_daily':
                $schedule['morning'][] = $med['name'];
                $schedule['afternoon'][] = $med['name'];
                $schedule['evening'][] = $med['name'];
                $schedule['bedtime'][] = $med['name'];
                break;
        }
    }
    
    return $schedule;
}

function generateMedicationCalendar($medications, $days) {
    // Generate a simple calendar structure
    $calendar = [];
    $startDate = new DateTime();
    
    for ($i = 0; $i < $days; $i++) {
        $currentDate = clone $startDate;
        $currentDate->modify("+$i days");
        
        $calendar[] = [
            'date' => $currentDate->format('Y-m-d'),
            'day_name' => $currentDate->format('l'),
            'medications' => $medications // In real app, this would track taken/not taken
        ];
    }
    
    return $calendar;
}

function generateSafetyAlerts($data, $result) {
    $alerts = [];
    
    // Always include general safety alerts
    $alerts[] = "Do not exceed recommended dosages";
    $alerts[] = "Consult your doctor before making any medication changes";
    $alerts[] = "Seek immediate medical attention for severe side effects";
    
    // Method-specific alerts
    if ($data['method'] === 'dosage') {
        if ($data['age'] < 18) {
            $alerts[] = "Pediatric dosing requires careful calculation and medical supervision";
        }
        if ($data['age'] > 65) {
            $alerts[] = "Geriatric patients may require dosage adjustments";
        }
    }
    
    if ($data['method'] === 'interaction' && $result['interaction_level'] === 'high') {
        $alerts[] = "HIGH RISK: Significant drug interactions detected - contact your doctor immediately";
    }
    
    return $alerts;
}

function getEducationalInfo($data) {
    return [
        'importance' => "Always use medications as prescribed by your healthcare provider",
        'storage' => "Store medications in a cool, dry place away from children",
        'disposal' => "Dispose of unused medications properly at pharmacy take-back programs",
        'monitoring' => "Monitor for side effects and report any concerns to your doctor"
    ];
}
?>