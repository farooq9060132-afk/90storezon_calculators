<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

class ScientificCalculator {
    private $memory = 0;
    private $lastAnswer = 0;
    
    public function calculate($expression) {
        try {
            // Sanitize the expression
            $expression = $this->sanitizeExpression($expression);
            
            // Replace mathematical symbols with PHP operators
            $expression = $this->normalizeExpression($expression);
            
            // Evaluate the expression
            $result = $this->evaluateExpression($expression);
            
            return [
                'success' => true,
                'result' => $result,
                'expression' => $expression
            ];
            
        } catch (Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }
    
    private function sanitizeExpression($expression) {
        // Remove any potentially dangerous characters
        $expression = preg_replace('/[^0-9+\-*\/\(\)\.\s\^πesincotaglqr!%]/', '', $expression);
        return $expression;
    }
    
    private function normalizeExpression($expression) {
        // Replace mathematical symbols and functions
        $replacements = [
            '×' => '*',
            '÷' => '/',
            '^' => '**',
            'π' => 'pi()',
            'e' => 'exp(1)',
            'sin' => 'sin',
            'cos' => 'cos',
            'tan' => 'tan',
            'log' => 'log10',
            'ln' => 'log',
            'sqrt' => 'sqrt',
            '!' => '!'
        ];
        
        $expression = str_replace(array_keys($replacements), array_values($replacements), $expression);
        
        return $expression;
    }
    
    private function evaluateExpression($expression) {
        // Define mathematical functions and constants
        $pi = pi();
        $e = exp(1);
        
        // Convert factorial notation
        $expression = preg_replace_callback('/(\d+)!/', function($matches) {
            return $this->factorial($matches[1]);
        }, $expression);
        
        // Convert percentage
        $expression = preg_replace_callback('/(\d+(?:\.\d+)?)%/', function($matches) {
            return '(' . $matches[1] . '/100)';
        }, $expression);
        
        // Convert power functions
        $expression = preg_replace_callback('/(\d+(?:\.\d+)?)\*\*(\d+(?:\.\d+)?)/', function($matches) {
            return pow($matches[1], $matches[2]);
        }, $expression);
        
        // Use eval with safety checks (in production, use a proper math parser)
        $result = @eval("return $expression;");
        
        if ($result === false || $result === null) {
            throw new Exception('Invalid mathematical expression');
        }
        
        // Store last answer
        $this->lastAnswer = $result;
        
        return $result;
    }
    
    private function factorial($n) {
        $n = intval($n);
        if ($n < 0) throw new Exception('Factorial of negative number');
        if ($n == 0) return 1;
        
        $result = 1;
        for ($i = 1; $i <= $n; $i++) {
            $result *= $i;
        }
        return $result;
    }
    
    public function memoryClear() {
        $this->memory = 0;
    }
    
    public function memoryRecall() {
        return $this->memory;
    }
    
    public function memoryAdd($value) {
        $this->memory += $value;
    }
    
    public function memorySubtract($value) {
        $this->memory -= $value;
    }
    
    public function getLastAnswer() {
        return $this->lastAnswer;
    }
}

// Handle POST requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $action = $input['action'] ?? '';
    $data = $input['data'] ?? '';
    
    $calculator = new ScientificCalculator();
    $response = [];
    
    switch ($action) {
        case 'calculate':
            $response = $calculator->calculate($data);
            break;
            
        case 'memory_clear':
            $calculator->memoryClear();
            $response = ['success' => true, 'message' => 'Memory cleared'];
            break;
            
        case 'memory_recall':
            $result = $calculator->memoryRecall();
            $response = ['success' => true, 'result' => $result];
            break;
            
        case 'memory_add':
            $calculator->memoryAdd(floatval($data));
            $response = ['success' => true, 'message' => 'Added to memory'];
            break;
            
        case 'memory_subtract':
            $calculator->memorySubtract(floatval($data));
            $response = ['success' => true, 'message' => 'Subtracted from memory'];
            break;
            
        case 'get_last_answer':
            $result = $calculator->getLastAnswer();
            $response = ['success' => true, 'result' => $result];
            break;
            
        default:
            $response = ['success' => false, 'error' => 'Unknown action'];
    }
    
    echo json_encode($response);
    exit;
}
?>