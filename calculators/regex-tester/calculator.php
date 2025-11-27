<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    
    $pattern = $input['pattern'] ?? '';
    $testString = $input['testString'] ?? '';
    $flags = $input['flags'] ?? '';
    
    $response = [
        'success' => false,
        'matches' => [],
        'error' => null,
        'stats' => []
    ];
    
    try {
        // Validate pattern
        if (@preg_match($pattern, null) === false) {
            $error = error_get_last();
            throw new Exception($error['message'] ?? 'Invalid regex pattern');
        }
        
        // Perform regex matching
        $startTime = microtime(true);
        $matchCount = preg_match_all($pattern, $testString, $matches, PREG_OFFSET_CAPTURE | PREG_SET_ORDER);
        $executionTime = (microtime(true) - $startTime) * 1000; // Convert to milliseconds
        
        if ($matchCount === false) {
            throw new Exception('Error executing regex pattern');
        }
        
        $formattedMatches = [];
        foreach ($matches as $match) {
            $formattedMatch = [
                'fullMatch' => $match[0][0],
                'start' => $match[0][1],
                'end' => $match[0][1] + strlen($match[0][0])
            ];
            
            // Add capturing groups
            if (count($match) > 1) {
                $formattedMatch['groups'] = [];
                for ($i = 1; $i < count($match); $i++) {
                    $formattedMatch['groups'][] = [
                        'text' => $match[$i][0],
                        'start' => $match[$i][1],
                        'end' => $match[$i][1] + strlen($match[$i][0])
                    ];
                }
            }
            
            $formattedMatches[] = $formattedMatch;
        }
        
        $response['success'] = true;
        $response['matches'] = $formattedMatches;
        $response['stats'] = [
            'totalMatches' => $matchCount,
            'executionTime' => round($executionTime, 2),
            'patternValid' => true
        ];
        
    } catch (Exception $e) {
        $response['error'] = $e->getMessage();
        $response['stats'] = [
            'totalMatches' => 0,
            'executionTime' => 0,
            'patternValid' => false
        ];
    }
    
    echo json_encode($response);
    exit;
}
?>