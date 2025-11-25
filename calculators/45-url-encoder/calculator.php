<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    
    $text = $input['text'] ?? '';
    $operation = $input['operation'] ?? 'encode';
    
    $response = [
        'success' => false,
        'result' => '',
        'error' => null,
        'stats' => []
    ];
    
    try {
        if (empty($text)) {
            throw new Exception('No text provided for URL processing');
        }
        
        $originalLength = strlen($text);
        $result = '';
        
        // Process based on operation type
        switch ($operation) {
            case 'encode':
                $result = urlencode($text);
                break;
            case 'decode':
                $result = urldecode($text);
                break;
            case 'encodeComponent':
                $result = rawurlencode($text);
                break;
            case 'decodeComponent':
                $result = rawurldecode($text);
                break;
            default:
                throw new Exception('Invalid operation type');
        }
        
        $processedLength = strlen($result);
        $sizeChange = (($processedLength - $originalLength) / $originalLength * 100);
        $encodedChars = substr_count($result, '%');
        
        $response['success'] = true;
        $response['result'] = $result;
        $response['stats'] = [
            'originalLength' => $originalLength,
            'processedLength' => $processedLength,
            'sizeChange' => round($sizeChange, 1),
            'encodedChars' => $encodedChars,
            'processingTime' => 0 // Would be calculated in real implementation
        ];
        
    } catch (Exception $e) {
        $response['error'] = $e->getMessage();
    }
    
    echo json_encode($response);
    exit;
}
?>