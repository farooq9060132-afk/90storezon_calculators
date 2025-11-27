<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

class PasswordStrengthCalculator {
    private $commonPasswords = [
        'password', '123456', '12345678', '1234', 'qwerty', '12345', 
        'dragon', 'baseball', 'football', 'letmein', 'monkey', 'abc123',
        'mustang', 'michael', 'shadow', 'master', 'jennifer', '111111',
        'superman', 'harley', '1234567', 'freedom', 'whatever', 'admin'
    ];

    public function calculateStrength($password) {
        $score = 0;
        $feedback = [];
        
        // Length check
        $length = strlen($password);
        if ($length >= 8) $score += 1;
        if ($length >= 12) $score += 1;
        if ($length >= 16) $score += 1;
        
        // Character variety
        $hasLower = preg_match('/[a-z]/', $password);
        $hasUpper = preg_match('/[A-Z]/', $password);
        $hasNumber = preg_match('/[0-9]/', $password);
        $hasSymbol = preg_match('/[^a-zA-Z0-9]/', $password);
        
        $charTypes = 0;
        if ($hasLower) { $charTypes++; $score += 1; }
        if ($hasUpper) { $charTypes++; $score += 1; }
        if ($hasNumber) { $charTypes++; $score += 1; }
        if ($hasSymbol) { $charTypes++; $score += 2; }
        
        // Bonus for multiple character types
        if ($charTypes >= 3) $score += 1;
        if ($charTypes >= 4) $score += 2;
        
        // Penalty for common passwords
        if (in_array(strtolower($password), $this->commonPasswords)) {
            $score = max(1, $score - 3);
            $feedback[] = 'This is a very common password';
        }
        
        // Penalty for sequential characters
        if ($this->hasSequentialChars($password)) {
            $score = max(1, $score - 2);
            $feedback[] = 'Avoid sequential characters';
        }
        
        // Penalty for repeated characters
        $repeatCount = $this->countRepeatedChars($password);
        if ($repeatCount > 2) {
            $score = max(1, $score - 1);
        }
        
        // Calculate final score (0-10 scale)
        $finalScore = min(10, max(1, $score));
        
        return [
            'score' => $finalScore,
            'percentage' => $finalScore * 10,
            'length' => $length,
            'hasLower' => $hasLower,
            'hasUpper' => $hasUpper,
            'hasNumber' => $hasNumber,
            'hasSymbol' => $hasSymbol,
            'feedback' => $feedback,
            'entropy' => $this->calculateEntropy($password),
            'crackTime' => $this->estimateCrackTime($password)
        ];
    }
    
    private function hasSequentialChars($password) {
        $sequentialPatterns = [
            '123', '234', '345', '456', '567', '678', '789',
            'abc', 'bcd', 'cde', 'def', 'efg', 'fgh', 'ghi', 'hij', 'ijk', 'jkl', 'klm', 'lmn', 'mno', 'nop', 'opq', 'pqr', 'qrs', 'rst', 'stu', 'tuv', 'uvw', 'vwx', 'wxy', 'xyz',
            'qwe', 'wer', 'ert', 'rty', 'tyu', 'yui', 'uio', 'iop'
        ];
        
        $lowerPassword = strtolower($password);
        foreach ($sequentialPatterns as $pattern) {
            if (strpos($lowerPassword, $pattern) !== false) {
                return true;
            }
        }
        
        return false;
    }
    
    private function countRepeatedChars($password) {
        $count = 0;
        $chars = str_split($password);
        $previous = null;
        
        foreach ($chars as $char) {
            if ($char === $previous) {
                $count++;
            }
            $previous = $char;
        }
        
        return $count;
    }
    
    private function calculateEntropy($password) {
        $length = strlen($password);
        $poolSize = 0;
        
        if (preg_match('/[a-z]/', $password)) $poolSize += 26;
        if (preg_match('/[A-Z]/', $password)) $poolSize += 26;
        if (preg_match('/[0-9]/', $password)) $poolSize += 10;
        if (preg_match('/[^a-zA-Z0-9]/', $password)) $poolSize += 32; // Common symbols
        
        if ($poolSize === 0) return 0;
        
        return round($length * log($poolSize, 2), 1);
    }
    
    private function estimateCrackTime($password) {
        $entropy = $this->calculateEntropy($password);
        
        // Assuming 10,000 guesses per second (moderate attack)
        $guesses = pow(2, $entropy);
        $seconds = $guesses / 10000;
        
        if ($seconds < 1) return 'Instant';
        if ($seconds < 60) return 'Seconds';
        if ($seconds < 3600) return round($seconds / 60) . ' minutes';
        if ($seconds < 86400) return round($seconds / 3600) . ' hours';
        if ($seconds < 31536000) return round($seconds / 86400) . ' days';
        if ($seconds < 3153600000) return round($seconds / 31536000) . ' years';
        
        return 'Centuries';
    }
    
    public function generatePassword($length = 12, $options = []) {
        $defaultOptions = [
            'uppercase' => true,
            'lowercase' => true,
            'numbers' => true,
            'symbols' => true
        ];
        
        $options = array_merge($defaultOptions, $options);
        
        $chars = '';
        if ($options['lowercase']) $chars .= 'abcdefghijklmnopqrstuvwxyz';
        if ($options['uppercase']) $chars .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        if ($options['numbers']) $chars .= '0123456789';
        if ($options['symbols']) $chars .= '!@#$%^&*()_+-=[]{}|;:,.<>?';
        
        if (empty($chars)) {
            $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        }
        
        $password = '';
        $charCount = strlen($chars);
        
        for ($i = 0; $i < $length; $i++) {
            $password .= $chars[random_int(0, $charCount - 1)];
        }
        
        return $password;
    }
}

// Handle API requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $action = $input['action'] ?? '';
    
    $calculator = new PasswordStrengthCalculator();
    $response = [];
    
    switch ($action) {
        case 'check_strength':
            $password = $input['password'] ?? '';
            $result = $calculator->calculateStrength($password);
            $response = ['success' => true, 'result' => $result];
            break;
            
        case 'generate_password':
            $length = $input['length'] ?? 12;
            $options = $input['options'] ?? [];
            $password = $calculator->generatePassword($length, $options);
            $strength = $calculator->calculateStrength($password);
            $response = [
                'success' => true, 
                'password' => $password,
                'strength' => $strength
            ];
            break;
            
        default:
            $response = ['success' => false, 'error' => 'Unknown action'];
    }
    
    echo json_encode($response);
    exit;
}
?>