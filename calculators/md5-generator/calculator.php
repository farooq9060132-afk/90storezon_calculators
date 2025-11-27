<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    
    $text = $input['text'] ?? '';
    $encoding = $input['encoding'] ?? 'hex';
    $case = $input['case'] ?? 'upper';
    
    $response = [
        'success' => false,
        'md5Hash' => '',
        'error' => null,
        'hashes' => [],
        'stats' => []
    ];
    
    try {
        if (empty($text)) {
            throw new Exception('No text provided for MD5 generation');
        }
        
        // Generate MD5 hash
        $md5Hash = md5($text);
        $inputLength = strlen($text);
        
        // Apply encoding
        switch ($encoding) {
            case 'base64':
                $formattedHash = base64_encode(hex2bin($md5Hash));
                break;
            case 'binary':
                $formattedHash = $this->hexToBinary($md5Hash);
                break;
            default: // hex
                $formattedHash = $md5Hash;
        }
        
        // Apply case
        if ($case === 'upper') {
            $formattedHash = strtoupper($formattedHash);
        } else {
            $formattedHash = strtolower($formattedHash);
        }
        
        $response['success'] = true;
        $response['md5Hash'] = $formattedHash;
        $response['hashes'] = [
            'upper' => strtoupper($md5Hash),
            'lower' => strtolower($md5Hash),
            'base64' => base64_encode(hex2bin($md5Hash))
        ];
        $response['stats'] = [
            'inputLength' => $inputLength,
            'hashLength' => strlen($formattedHash),
            'generationTime' => 0 // Would be calculated in real implementation
        ];
        
    } catch (Exception $e) {
        $response['error'] = $e->getMessage();
    }
    
    echo json_encode($response);
    exit;
}

function hexToBinary($hex) {
    $binary = '';
    for ($i = 0; $i < strlen($hex); $i++) {
        $bin = base_convert($hex[$i], 16, 2);
        $binary .= str_pad($bin, 4, '0', STR_PAD_LEFT);
    }
    return $binary;
}
?>