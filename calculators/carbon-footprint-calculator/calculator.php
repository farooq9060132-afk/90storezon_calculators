<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Transportation inputs
    $car_mileage = floatval($_POST['car_mileage'] ?? 0);
    $car_type = $_POST['car_type'] ?? 'gasoline';
    $public_transport = floatval($_POST['public_transport'] ?? 0);
    $flights = floatval($_POST['flights'] ?? 0);
    
    // Home energy inputs
    $electricity = floatval($_POST['electricity'] ?? 0);
    $natural_gas = floatval($_POST['natural_gas'] ?? 0);
    $heating_oil = floatval($_POST['heating_oil'] ?? 0);
    $renewable_energy = floatval($_POST['renewable_energy'] ?? 0);
    
    // Diet & lifestyle inputs
    $diet_type = $_POST['diet_type'] ?? 'average';
    $food_waste = $_POST['food_waste'] ?? 'average';
    $shopping_habits = $_POST['shopping_habits'] ?? 'average';
    $recycling = $_POST['recycling'] ?? 'basic';
    
    // Household inputs
    $household_size = intval($_POST['household_size'] ?? 1);
    $house_size = floatval($_POST['house_size'] ?? 0);
    $location = $_POST['location'] ?? 'suburban';
    
    // Emission factors (kg CO2e per unit)
    $emission_factors = [
        'transportation' => [
            'car' => [
                'gasoline' => 0.404,    // kg CO2 per mile
                'hybrid' => 0.227,      // kg CO2 per mile
                'electric' => 0.123,    // kg CO2 per mile (grid average)
                'diesel' => 0.371       // kg CO2 per mile
            ],
            'public_transport' => 0.169, // kg CO2 per mile (average)
            'flights' => 90.0           // kg CO2 per hour (short-haul)
        ],
        'energy' => [
            'electricity' => 0.429,     // kg CO2 per kWh (US average)
            'natural_gas' => 5.3,       // kg CO2 per therm
            'heating_oil' => 10.21      // kg CO2 per gallon
        ],
        'diet' => [
            'meat_heavy' => 3000,       // kg CO2 per year
            'average' => 2400,
            'vegetarian' => 1500,
            'vegan' => 1200
        ],
        'lifestyle' => [
            'food_waste' => [
                'high' => 800,
                'average' => 400,
                'low' => 200,
                'zero' => 50
            ],
            'shopping' => [
                'frequent' => 2000,
                'average' => 1500,
                'minimal' => 800
            ],
            'recycling' => [
                'none' => 500,
                'basic' => 300,
                'comprehensive' => 150,
                'zero_waste' => 50
            ]
        ],
        'household' => [
            'size_factor' => 0.2,       // kg CO2 per sq ft per year
            'location' => [
                'urban' => 0.9,
                'suburban' => 1.0,
                'rural' => 1.1
            ]
        ]
    ];
    
    try {
        // Calculate transportation emissions
        $car_emissions = $car_mileage * 52 * $emission_factors['transportation']['car'][$car_type];
        $public_transport_emissions = $public_transport * 52 * $emission_factors['transportation']['public_transport'];
        $flight_emissions = $flights * $emission_factors['transportation']['flights'];
        $total_transportation = $car_emissions + $public_transport_emissions + $flight_emissions;
        
        // Calculate home energy emissions (adjust for renewable energy)
        $renewable_factor = (100 - $renewable_energy) / 100;
        $electricity_emissions = $electricity * 12 * $emission_factors['energy']['electricity'] * $renewable_factor;
        $natural_gas_emissions = $natural_gas * 12 * $emission_factors['energy']['natural_gas'];
        $heating_oil_emissions = $heating_oil * 12 * $emission_factors['energy']['heating_oil'];
        $total_energy = $electricity_emissions + $natural_gas_emissions + $heating_oil_emissions;
        
        // Calculate diet and lifestyle emissions
        $diet_emissions = $emission_factors['diet'][$diet_type];
        $food_waste_emissions = $emission_factors['lifestyle']['food_waste'][$food_waste];
        $shopping_emissions = $emission_factors['lifestyle']['shopping'][$shopping_habits];
        $recycling_emissions = $emission_factors['lifestyle']['recycling'][$recycling];
        $total_lifestyle = $diet_emissions + $food_waste_emissions + $shopping_emissions + $recycling_emissions;
        
        // Calculate household emissions
        $household_emissions = $house_size * $emission_factors['household']['size_factor'] * $emission_factors['household']['location'][$location];
        
        // Total annual emissions
        $total_emissions = $total_transportation + $total_energy + $total_lifestyle + $household_emissions;
        
        // Per capita emissions
        $per_capita = $total_emissions / max(1, $household_size);
        
        // Compare to averages
        $us_average = 16000; // kg CO2 per person per year
        $global_average = 4000;
        $climate_target = 2000;
        
        // Calculate percentages
        $vs_us = ($per_capita / $us_average) * 100;
        $vs_global = ($per_capita / $global_average) * 100;
        $vs_target = ($per_capita / $climate_target) * 100;
        
        // Determine footprint level
        if ($per_capita <= $climate_target) {
            $footprint_level = 'excellent';
            $level_message = 'Climate Hero!';
            $level_description = 'Your footprint is at or below the climate target. You\'re leading the way!';
        } elseif ($per_capita <= $global_average) {
            $footprint_level = 'good';
            $level_message = 'Better Than Average';
            $level_description = 'Your footprint is below the global average. Great job!';
        } elseif ($per_capita <= $us_average) {
            $footprint_level = 'average';
            $level_message = 'Room for Improvement';
            $level_description = 'Your footprint is around the US average. There are opportunities to reduce.';
        } else {
            $footprint_level = 'high';
            $level_message = 'High Footprint';
            $level_description = 'Your footprint is above average. Consider making some changes.';
        }
        
        // Generate recommendations
        $recommendations = generate_recommendations([
            'transportation' => $total_transportation,
            'energy' => $total_energy,
            'lifestyle' => $total_lifestyle,
            'car_type' => $car_type,
            'renewable_energy' => $renewable_energy,
            'diet_type' => $diet_type,
            'recycling' => $recycling
        ], $per_capita);
        
        $response = [
            'success' => true,
            'results' => [
                'total_emissions' => round($total_emissions),
                'per_capita' => round($per_capita),
                'breakdown' => [
                    'transportation' => round($total_transportation),
                    'energy' => round($total_energy),
                    'lifestyle' => round($total_lifestyle),
                    'household' => round($household_emissions)
                ],
                'comparison' => [
                    'us_average' => $us_average,
                    'global_average' => $global_average,
                    'climate_target' => $climate_target,
                    'vs_us' => round($vs_us, 1),
                    'vs_global' => round($vs_global, 1),
                    'vs_target' => round($vs_target, 1)
                ],
                'footprint_level' => $footprint_level,
                'level_message' => $level_message,
                'level_description' => $level_description,
                'recommendations' => $recommendations
            ]
        ];
        
        echo json_encode($response);
        
    } catch (Exception $e) {
        echo json_encode(['error' => 'Calculation error: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Invalid request method']);
}

function generate_recommendations($data, $per_capita) {
    $recommendations = [];
    
    // Transportation recommendations
    if ($data['transportation'] > 3000) {
        $recommendations[] = [
            'icon' => 'car',
            'category' => 'Transportation',
            'title' => 'Reduce Car Usage',
            'description' => 'Consider carpooling, using public transport, or switching to an electric vehicle.',
            'impact' => 'High impact'
        ];
    }
    
    if ($data['car_type'] !== 'electric' && $data['car_type'] !== 'hybrid') {
        $recommendations[] = [
            'icon' => 'bolt',
            'category' => 'Transportation',
            'title' => 'Consider Electric Vehicle',
            'description' => 'Switching to an electric vehicle can reduce your transportation emissions by 50-70%.',
            'impact' => 'High impact'
        ];
    }
    
    // Energy recommendations
    if ($data['energy'] > 4000) {
        $recommendations[] = [
            'icon' => 'solar-panel',
            'category' => 'Home Energy',
            'title' => 'Improve Home Efficiency',
            'description' => 'Upgrade insulation, use energy-efficient appliances, and consider solar panels.',
            'impact' => 'High impact'
        ];
    }
    
    if ($data['renewable_energy'] < 50) {
        $recommendations[] = [
            'icon' => 'wind',
            'category' => 'Home Energy',
            'title' => 'Switch to Renewable Energy',
            'description' => 'Choose a green energy provider or install renewable energy systems.',
            'impact' => 'Medium impact'
        ];
    }
    
    // Lifestyle recommendations
    if ($data['diet_type'] === 'meat_heavy') {
        $recommendations[] = [
            'icon' => 'leaf',
            'category' => 'Diet',
            'title' => 'Reduce Meat Consumption',
            'description' => 'Try meat-free days or switch to plant-based alternatives.',
            'impact' => 'High impact'
        ];
    }
    
    if ($data['recycling'] === 'none' || $data['recycling'] === 'basic') {
        $recommendations[] = [
            'icon' => 'recycle',
            'category' => 'Lifestyle',
            'title' => 'Improve Recycling',
            'description' => 'Set up comprehensive recycling and composting systems at home.',
            'impact' => 'Medium impact'
        ];
    }
    
    // General recommendations based on overall footprint
    if ($per_capita > 8000) {
        $recommendations[] = [
            'icon' => 'home',
            'category' => 'General',
            'title' => 'Home Energy Audit',
            'description' => 'Get a professional energy audit to identify efficiency improvements.',
            'impact' => 'High impact'
        ];
    }
    
    if ($per_capita > 12000) {
        $recommendations[] = [
            'icon' => 'plane-slash',
            'category' => 'Travel',
            'title' => 'Reduce Air Travel',
            'description' => 'Consider video conferencing instead of business flights when possible.',
            'impact' => 'High impact'
        ];
    }
    
    return array_slice($recommendations, 0, 6); // Return top 6 recommendations
}
?>