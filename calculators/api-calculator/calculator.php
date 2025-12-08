
<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $apiEndpoint = $_POST['apiEndpoint'] ?? '';
    $responseSize = floatval($_POST['responseSize'] ?? 0);
    $requestCount = intval($_POST['requestCount'] ?? 1);
    $serverLocation = $_POST['serverLocation'] ?? '';
    $userLocation = $_POST['userLocation'] ?? '';
    $connectionSpeed = $_POST['connectionSpeed'] ?? '';
    $optimizationLevel = $_POST['optimizationLevel'] ?? '';

    // Validate inputs
    if ($responseSize <= 0) {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid input values']);
        exit;
    }

    // Calculate base response time (simplified calculation)
    $baseResponseTime = calculateBaseResponseTime($responseSize, $requestCount, $optimizationLevel);
    
    // Adjust for network conditions
    $networkFactor = getNetworkFactor($connectionSpeed);
    $adjustedResponseTime = $baseResponseTime * $networkFactor;
    
    // Adjust for server load
    $serverLoadFactor = getServerLoadFactor($serverLocation, $userLocation);
    $finalResponseTime = $adjustedResponseTime * $serverLoadFactor;

    // Calculate performance score (0-100)
    $performanceScore = calculatePerformanceScore($finalResponseTime);
    
    // Get performance grade
    $performanceGrade = getPerformanceGrade($performanceScore);
    
    // Get recommendations
    $recommendations = generateRecommendations($finalResponseTime, $optimizationLevel, $responseSize, $requestCount);

    // Prepare response
    $response = [
        'success' => true,
        'responseTime' => round($finalResponseTime, 2) . 's',
        'performanceScore' => $performanceScore,
        'performanceGrade' => $performanceGrade['grade'],
        'performanceDescription' => $performanceGrade['description'],
        'userExperience' => $performanceGrade['experience'],
        'seoImpact' => $performanceGrade['seoImpact'],
        'recommendations' => $recommendations
    ];

    echo json_encode($response);
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
}

function calculateBaseResponseTime($responseSize, $requestCount, $optimizationLevel) {
    $baseTime = $responseSize * 0.05; // Base time based on response size
    
    // Add time for requests
    $requestTime = $requestCount * 0.02;
    
    // Apply optimization factor
    $optimizationFactors = [
        'none' => 1.5,
        'basic' => 1.2,
        'moderate' => 0.8,
        'advanced' => 0.5
    ];
    
    $factor = $optimizationFactors[$optimizationLevel] ?? 1.0;
    
    return ($baseTime + $requestTime) * $factor;
}

function getNetworkFactor($speed) {
    $factors = [
        'slow' => 2.5,
        'medium' => 1.0,
        'fast' => 0.6,
        'fiber' => 0.3
    ];
    
    return $factors[$speed] ?? 1.0;
}

function getServerLoadFactor($serverLoc, $userLoc) {
    if ($serverLoc === $userLoc) {
        return 1.0;
    }
    
    // Simple distance calculation
    $locations = ['us-east', 'us-west', 'europe', 'asia', 'australia'];
    $serverIndex = array_search($serverLoc, $locations);
    $userIndex = array_search($userLoc, $locations);
    
    $distance = abs($serverIndex - $userIndex);
    
    return 1.0 + ($distance * 0.1);
}

function calculatePerformanceScore($loadTime) {
    if ($loadTime <= 1.0) return 100;
    if ($loadTime <= 2.0) return 90;
    if ($loadTime <= 3.0) return 75;
    if ($loadTime <= 4.0) return 60;
    if ($loadTime <= 5.0) return 40;
    return 20;
}

function getPerformanceGrade($score) {
    if ($score >= 90) {
        return [
            'grade' => 'A+',
            'description' => 'Excellent performance! Your website loads very fast.',
            'experience' => 'Excellent',
            'seoImpact' => 'Very Positive'
        ];
    } elseif ($score >= 80) {
        return [
            'grade' => 'A',
            'description' => 'Good performance. Your website loads quickly.',
            'experience' => 'Very Good',
            'seoImpact' => 'Positive'
        ];
    } elseif ($score >= 70) {
        return [
            'grade' => 'B',
            'description' => 'Average performance. There is room for improvement.',
            'experience' => 'Good',
            'seoImpact' => 'Moderate'
        ];
    } elseif ($score >= 60) {
        return [
            'grade' => 'C',
            'description' => 'Below average performance. Optimization recommended.',
            'experience' => 'Fair',
            'seoImpact' => 'Neutral'
        ];
    } else {
        return [
            'grade' => 'D',
            'description' => 'Poor performance. Immediate optimization required.',
            'experience' => 'Poor',
            'seoImpact' => 'Negative'
        ];
    }
}

function generateRecommendations($loadTime, $optimizationLevel, $pageSize, $imageCount) {
    $recommendations = [];
    
    if ($loadTime > 3.0) {
        $recommendations[] = "Enable browser caching to reduce load times for returning visitors";
    }
    
    if ($pageSize > 500) {
        $recommendations[] = "Compress and optimize images to reduce page size";
    }
    
    if ($imageCount > 50) {
        $recommendations[] = "Implement lazy loading for images below the fold";
    }
    
    if ($optimizationLevel === 'none' || $optimizationLevel === 'basic') {
        $recommendations[] = "Minify CSS and JavaScript files to reduce file sizes";
        $recommendations[] = "Use a Content Delivery Network (CDN) for global reach";
    }
    
    if ($loadTime > 2.0) {
        $recommendations[] = "Reduce server response time by optimizing backend code";
        $recommendations[] = "Eliminate render-blocking resources";
    }
    
    // Ensure we have at least 3 recommendations
    while (count($recommendations) < 3) {
        $recommendations[] = "Monitor performance regularly with tools like Google PageSpeed Insights";
    }
    
    return array_slice($recommendations, 0, 5); // Return max 5 recommendations
}
?>