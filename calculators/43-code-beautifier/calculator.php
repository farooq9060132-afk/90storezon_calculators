<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    
    $code = $input['code'] ?? '';
    $language = $input['language'] ?? 'html';
    $indentSize = $input['indentSize'] ?? '4';
    $quoteStyle = $input['quoteStyle'] ?? 'double';
    $maxLineLength = $input['maxLineLength'] ?? 80;
    
    $response = [
        'success' => false,
        'beautifiedCode' => '',
        'error' => null,
        'stats' => []
    ];
    
    try {
        $originalLength = strlen($code);
        $originalLines = substr_count($code, "\n") + 1;
        
        // Server-side beautification logic
        $beautifiedCode = $code; // In a real implementation, you'd use proper beautification libraries
        
        // Basic server-side formatting
        switch ($language) {
            case 'json':
                $decoded = json_decode($code);
                if ($decoded === null && json_last_error() !== JSON_ERROR_NONE) {
                    throw new Exception('Invalid JSON: ' . json_last_error_msg());
                }
                $beautifiedCode = json_encode($decoded, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
                break;
                
            case 'html':
            case 'xml':
                $dom = new DOMDocument();
                $dom->preserveWhiteSpace = false;
                $dom->formatOutput = true;
                if (@$dom->loadXML($code)) {
                    $beautifiedCode = $dom->saveXML();
                }
                break;
        }
        
        $formattedLength = strlen($beautifiedCode);
        $formattedLines = substr_count($beautifiedCode, "\n") + 1;
        $charsSaved = $originalLength - $formattedLength;
        $readabilityScore = min(100, max(0, 50 + (($formattedLines - $originalLines) * 2) + ($charsSaved > 0 ? 10 : 0)));
        
        $response['success'] = true;
        $response['beautifiedCode'] = $beautifiedCode;
        $response['stats'] = [
            'originalLines' => $originalLines,
            'formattedLines' => $formattedLines,
            'charsSaved' => $charsSaved,
            'readabilityScore' => round($readabilityScore)
        ];
        
    } catch (Exception $e) {
        $response['error'] = $e->getMessage();
    }
    
    echo json_encode($response);
    exit;
}
?>