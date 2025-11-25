<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $tripDistance = floatval($_POST['tripDistance'] ?? 0);
    $tripType = $_POST['tripType'] ?? 'round-trip';
    $monthlyMiles = floatval($_POST['monthlyMiles'] ?? 0);
    $fuelEfficiency = floatval($_POST['fuelEfficiency'] ?? 0);
    $fuelPrice = floatval($_POST['fuelPrice'] ?? 0);
    $fuelType = $_POST['fuelType'] ?? 'regular';
    $vehicleType = $_POST['vehicleType'] ?? 'sedan';
    $includeTolls = isset($_POST['includeTolls']);
    $includeMaintenance = isset($_POST['includeMaintenance']);
    $multipleVehicles = isset($_POST['multipleVehicles']);
    $tollCost = floatval($_POST['tollCost'] ?? 0);
    $maintenanceCost = floatval($_POST['maintenanceCost'] ?? 0.10);
    $fuelUsed = floatval($_POST['fuelUsed'] ?? 0);
    $distanceDriven = floatval($_POST['distanceDriven'] ?? 0);
    $calculationMode = $_POST['calculationMode'] ?? 'trip';

    // Validate inputs
    if ($fuelEfficiency <= 0 || $fuelPrice <= 0) {
        http_response_code(400);
        echo json_encode(['error' => 'Fuel efficiency and price must be greater than 0']);
        exit;
    }

    // Calculate based on mode
    switch ($calculationMode) {
        case 'trip':
            $results = calculateTripCost($tripDistance, $tripType, $fuelEfficiency, $fuelPrice, $includeTolls, $tollCost, $includeMaintenance, $maintenanceCost);
            break;
        case 'monthly':
            $results = calculateMonthlyCost($monthlyMiles, $fuelEfficiency, $fuelPrice, $includeMaintenance, $maintenanceCost);
            break;
        case 'efficiency':
            $results = calculateEfficiency($fuelUsed, $distanceDriven, $fuelPrice);
            break;
        default:
            $results = calculateTripCost($tripDistance, $tripType, $fuelEfficiency, $fuelPrice, $includeTolls, $tollCost, $includeMaintenance, $maintenanceCost);
    }

    // Calculate environmental impact
    $environmental = calculateEnvironmentalImpact($results['fuelUsed'], $fuelType);

    // Generate fuel saving tips
    $tips = generateFuelSavingTips($fuelEfficiency, $vehicleType);

    // Vehicle comparison if enabled
    $comparison = [];
    if ($multipleVehicles) {
        $vehicle2Mpg = floatval($_POST['vehicle2Mpg'] ?? 0);
        $vehicle3Mpg = floatval($_POST['vehicle3Mpg'] ?? 0);
        $comparison = calculateVehicleComparison($results, $vehicle2Mpg, $vehicle3Mpg, $fuelPrice);
    }

    // Prepare response
    $response = [
        'success' => true,
        'results' => $results,
        'environmental' => $environmental,
        'tips' => $tips,
        'comparison' => $comparison,
        'mode' => $calculationMode
    ];

    echo json_encode($response);
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
}

function calculateTripCost($distance, $tripType, $mpg, $fuelPrice, $includeTolls, $tollCost, $includeMaintenance, $maintenanceCost) {
    // Adjust distance for trip type
    $totalDistance = $tripType === 'round-trip' ? $distance * 2 : $distance;
    
    // Calculate fuel required
    $fuelUsed = $totalDistance / $mpg;
    
    // Calculate fuel cost
    $fuelCost = $fuelUsed * $fuelPrice;
    
    // Calculate additional costs
    $additionalCosts = 0;
    if ($includeTolls) {
        $additionalCosts += $tollCost;
    }
    if ($includeMaintenance) {
        $additionalCosts += $totalDistance * $maintenanceCost;
    }
    
    $totalCost = $fuelCost + $additionalCosts;
    $costPerMile = $totalCost / $totalDistance;

    return [
        'totalDistance' => round($totalDistance, 1),
        'fuelUsed' => round($fuelUsed, 2),
        'fuelCost' => round($fuelCost, 2),
        'additionalCosts' => round($additionalCosts, 2),
        'totalCost' => round($totalCost, 2),
        'costPerMile' => round($costPerMile, 3),
        'mpg' => round($mpg, 1),
        'tollCost' => $tollCost,
        'maintenanceCost' => $includeMaintenance ? round($totalDistance * $maintenanceCost, 2) : 0
    ];
}

function calculateMonthlyCost($monthlyMiles, $mpg, $fuelPrice, $includeMaintenance, $maintenanceCost) {
    $fuelUsed = $monthlyMiles / $mpg;
    $fuelCost = $fuelUsed * $fuelPrice;
    
    $additionalCosts = 0;
    if ($includeMaintenance) {
        $additionalCosts = $monthlyMiles * $maintenanceCost;
    }
    
    $totalCost = $fuelCost + $additionalCosts;
    $annualCost = $totalCost * 12;
    $costPerMile = $totalCost / $monthlyMiles;

    return [
        'monthlyMiles' => round($monthlyMiles, 0),
        'fuelUsed' => round($fuelUsed, 2),
        'fuelCost' => round($fuelCost, 2),
        'additionalCosts' => round($additionalCosts, 2),
        'totalCost' => round($totalCost, 2),
        'annualCost' => round($annualCost, 2),
        'costPerMile' => round($costPerMile, 3),
        'mpg' => round($mpg, 1)
    ];
}

function calculateEfficiency($fuelUsed, $distanceDriven, $fuelPrice) {
    if ($fuelUsed <= 0 || $distanceDriven <= 0) {
        return [
            'mpg' => 0,
            'lper100km' => 0,
            'fuelCost' => 0,
            'costPerMile' => 0
        ];
    }
    
    $mpg = $distanceDriven / $fuelUsed;
    $lper100km = 235.214583 / $mpg; // Conversion from MPG to L/100km
    $fuelCost = $fuelUsed * $fuelPrice;
    $costPerMile = $fuelCost / $distanceDriven;

    return [
        'mpg' => round($mpg, 1),
        'lper100km' => round($lper100km, 1),
        'fuelCost' => round($fuelCost, 2),
        'costPerMile' => round($costPerMile, 3),
        'distanceDriven' => round($distanceDriven, 0),
        'fuelUsed' => round($fuelUsed, 2)
    ];
}

function calculateEnvironmentalImpact($fuelUsed, $fuelType) {
    // CO2 emissions in pounds per gallon (approximate)
    $co2PerGallon = [
        'regular' => 19.6,
        'midgrade' => 20.0,
        'premium' => 20.4,
        'diesel' => 22.4,
        'electric' => 0
    ];
    
    $co2Emissions = $fuelUsed * ($co2PerGallon[$fuelType] ?? 19.6);
    $treesNeeded = $co2Emissions / 48; // Average tree absorbs 48 lbs CO2 per year
    $ecoScore = max(0, 100 - ($co2Emissions / 10)); // Simple eco score

    return [
        'co2Emissions' => round($co2Emissions, 1),
        'treesNeeded' => round($treesNeeded, 1),
        'ecoScore' => min(100, round($ecoScore, 0))
    ];
}

function generateFuelSavingTips($mpg, $vehicleType) {
    $tips = [];
    
    if ($mpg < 20) {
        $tips[] = "Consider carpooling or using public transportation for daily commutes";
        $tips[] = "Plan your routes to avoid traffic and reduce idling time";
    }
    
    if ($mpg < 30) {
        $tips[] = "Check and maintain proper tire pressure - underinflated tires can reduce fuel efficiency";
        $tips[] = "Remove roof racks and carriers when not in use to reduce drag";
    }
    
    $tips[] = "Use cruise control on highways to maintain consistent speed";
    $tips[] = "Avoid rapid acceleration and hard braking - smooth driving saves fuel";
    $tips[] = "Combine errands into one trip to reduce cold starts";
    
    if ($vehicleType === 'suv' || $vehicleType === 'truck') {
        $tips[] = "Consider downsizing to a more fuel-efficient vehicle for daily use";
    }
    
    return array_slice($tips, 0, 5); // Return max 5 tips
}

function calculateVehicleComparison($baseResults, $vehicle2Mpg, $vehicle3Mpg, $fuelPrice) {
    $comparison = [];
    
    // Base vehicle
    $comparison[] = [
        'mpg' => $baseResults['mpg'],
        'fuelCost' => $baseResults['fuelCost'],
        'annualSavings' => 0
    ];
    
    // Vehicle 2
    if ($vehicle2Mpg > 0) {
        $fuelUsed2 = $baseResults['totalDistance'] / $vehicle2Mpg;
        $fuelCost2 = $fuelUsed2 * $fuelPrice;
        $annualSavings2 = ($baseResults['fuelCost'] - $fuelCost2) * 26; // Assuming 26 trips per year
        
        $comparison[] = [
            'mpg' => round($vehicle2Mpg, 1),
            'fuelCost' => round($fuelCost2, 2),
            'annualSavings' => round($annualSavings2, 2)
        ];
    }
    
    // Vehicle 3
    if ($vehicle3Mpg > 0) {
        $fuelUsed3 = $baseResults['totalDistance'] / $vehicle3Mpg;
        $fuelCost3 = $fuelUsed3 * $fuelPrice;
        $annualSavings3 = ($baseResults['fuelCost'] - $fuelCost3) * 26;
        
        $comparison[] = [
            'mpg' => round($vehicle3Mpg, 1),
            'fuelCost' => round($fuelCost3, 2),
            'annualSavings' => round($annualSavings3, 2)
        ];
    }
    
    return $comparison;
}
?>