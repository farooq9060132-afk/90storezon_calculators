<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $fileType = $_POST['fileType'] ?? '';
    $fileSize = $_POST['fileSize'] ?? '';
    $fileCount = intval($_POST['fileCount'] ?? 0);
    $growthRate = floatval($_POST['growthRate'] ?? 0);
    $duration = intval($_POST['duration'] ?? 12);

    // Validate inputs
    if ($fileCount <= 0 || $growthRate < 0 || $duration <= 0) {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid input values']);
        exit;
    }

    // Calculate average file size based on selection
    $avgFileSize = 0;
    switch ($fileSize) {
        case 'small':
            $avgFileSize = 5; // MB
            break;
        case 'medium':
            $avgFileSize = 50; // MB
            break;
        case 'large':
            $avgFileSize = 250; // MB
            break;
        case 'xlarge':
            $avgFileSize = 750; // MB
            break;
        default:
            $avgFileSize = 10; // MB
    }

    // Calculate initial storage (convert MB to GB)
    $initialStorageGB = ($fileCount * $avgFileSize) / 1024;

    // Calculate projected storage with growth
    $projectedStorageGB = $initialStorageGB * pow(1 + ($growthRate / 100), $duration);

    // Determine recommended plan
    if ($projectedStorageGB <= 50) {
        $recommendedPlan = 'Basic';
        $monthlyCost = 5;
    } elseif ($projectedStorageGB <= 500) {
        $recommendedPlan = 'Professional';
        $monthlyCost = 15;
    } else {
        $recommendedPlan = 'Enterprise';
        $monthlyCost = 50;
    }

    // Prepare response
    $response = [
        'success' => true,
        'initialStorage' => round($initialStorageGB, 2) . ' GB',
        'projectedStorage' => round($projectedStorageGB, 2) . ' GB',
        'recommendedPlan' => $recommendedPlan,
        'monthlyCost' => '$' . $monthlyCost,
        'planDescription' => getPlanDescription($recommendedPlan)
    ];

    echo json_encode($response);
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
}

function getPlanDescription($plan) {
    $descriptions = [
        'Basic' => 'Perfect for individuals and small projects with moderate storage needs.',
        'Professional' => 'Ideal for businesses and power users with growing storage requirements.',
        'Enterprise' => 'Best for large organizations with extensive data storage and security needs.'
    ];
    
    return $descriptions[$plan] ?? 'Recommended plan based on your storage requirements.';
}
?>