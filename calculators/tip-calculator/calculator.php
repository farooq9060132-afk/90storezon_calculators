<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $billAmount = floatval($_POST['billAmount'] ?? 0);
    $taxAmount = floatval($_POST['taxAmount'] ?? 0);
    $tipPercentage = floatval($_POST['tipPercentage'] ?? 0);
    $peopleCount = intval($_POST['peopleCount'] ?? 1);
    $roundUp = floatval($_POST['roundUp'] ?? 0);
    $country = $_POST['country'] ?? 'us';

    // Validate inputs
    if ($billAmount <= 0 || $tipPercentage < 0 || $peopleCount <= 0) {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid input values']);
        exit;
    }

    // Calculate subtotal (bill + tax)
    $subtotal = $billAmount + $taxAmount;
    
    // Calculate tip amount
    $tipAmount = $subtotal * ($tipPercentage / 100);
    
    // Calculate total amount
    $totalAmount = $subtotal + $tipAmount;
    
    // Apply rounding if requested
    if ($roundUp > 0) {
        $totalAmount = ceil($totalAmount / $roundUp) * $roundUp;
        $tipAmount = $totalAmount - $subtotal;
    }
    
    // Calculate per person amounts
    $perPerson = $totalAmount / $peopleCount;
    
    // Generate split breakdown
    $splitBreakdown = generateSplitBreakdown($peopleCount, $perPerson, $totalAmount);
    
    // Generate tip suggestions
    $tipSuggestions = generateTipSuggestions($subtotal, $roundUp);
    
    // Get country-specific info
    $countryInfo = getCountryInfo($country);

    // Prepare response
    $response = [
        'success' => true,
        'calculations' => [
            'subtotal' => formatCurrency($subtotal),
            'tax' => formatCurrency($taxAmount),
            'tip' => formatCurrency($tipAmount),
            'total' => formatCurrency($totalAmount),
            'perPerson' => formatCurrency($perPerson),
            'tipPercentage' => $tipPercentage . '%'
        ],
        'split' => [
            'peopleCount' => $peopleCount,
            'breakdown' => $splitBreakdown
        ],
        'suggestions' => $tipSuggestions,
        'country' => $countryInfo
    ];

    echo json_encode($response);
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
}

function formatCurrency($amount) {
    return '$' . number_format($amount, 2);
}

function generateSplitBreakdown($peopleCount, $perPerson, $totalAmount) {
    $breakdown = [];
    
    if ($peopleCount === 1) {
        $breakdown[] = [
            'person' => 'Total',
            'amount' => formatCurrency($totalAmount)
        ];
    } else {
        // Calculate equal split
        $equalAmount = $totalAmount / $peopleCount;
        $equalAmountRounded = round($equalAmount, 2);
        
        // Handle rounding differences
        $adjustedTotal = $equalAmountRounded * $peopleCount;
        $difference = $totalAmount - $adjustedTotal;
        
        for ($i = 1; $i <= $peopleCount; $i++) {
            $amount = $equalAmountRounded;
            
            // Adjust the last person's amount to account for rounding
            if ($i === $peopleCount && abs($difference) > 0.001) {
                $amount += $difference;
                $amount = round($amount, 2);
            }
            
            $breakdown[] = [
                'person' => 'Person ' . $i,
                'amount' => formatCurrency($amount)
            ];
        }
    }
    
    return $breakdown;
}

function generateTipSuggestions($subtotal, $roundUp) {
    $suggestions = [];
    $percentages = [15, 18, 20, 25];
    
    foreach ($percentages as $percentage) {
        $tipAmount = $subtotal * ($percentage / 100);
        $totalAmount = $subtotal + $tipAmount;
        
        if ($roundUp > 0) {
            $totalAmount = ceil($totalAmount / $roundUp) * $roundUp;
            $tipAmount = $totalAmount - $subtotal;
        }
        
        $suggestions[$percentage] = formatCurrency($tipAmount);
    }
    
    return $suggestions;
}

function getCountryInfo($country) {
    $countries = [
        'us' => [
            'name' => 'United States',
            'currency' => 'USD',
            'standardTip' => '15-20%',
            'custom' => 'Tipping is expected in most service industries'
        ],
        'ca' => [
            'name' => 'Canada',
            'currency' => 'CAD',
            'standardTip' => '15-18%',
            'custom' => 'Similar to US, expected in restaurants'
        ],
        'uk' => [
            'name' => 'United Kingdom',
            'currency' => 'GBP',
            'standardTip' => '10-12.5%',
            'custom' => 'Often included as service charge'
        ],
        'au' => [
            'name' => 'Australia',
            'currency' => 'AUD',
            'standardTip' => '10%',
            'custom' => 'Not always expected, for exceptional service'
        ],
        'eu' => [
            'name' => 'European Union',
            'currency' => 'EUR',
            'standardTip' => '5-10%',
            'custom' => 'Service often included, round up'
        ],
        'mx' => [
            'name' => 'Mexico',
            'currency' => 'MXN',
            'standardTip' => '10-15%',
            'custom' => 'Expected in tourist areas'
        ]
    ];
    
    return $countries[$country] ?? $countries['us'];
}
?>