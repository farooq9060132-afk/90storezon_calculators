<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    
    if ($action === 'convert_csv') {
        $csv_data = $_POST['csv_data'] ?? '';
        $delimiter = $_POST['delimiter'] ?? ',';
        $has_headers = $_POST['has_headers'] === 'true';
        $output_format = $_POST['output_format'] ?? 'array';
        $quote_char = $_POST['quote_char'] ?? '"';
        
        if (empty($csv_data)) {
            echo json_encode(['error' => 'Please provide CSV data']);
            exit;
        }
        
        try {
            // Handle custom delimiter
            if ($delimiter === 'custom') {
                $delimiter = $_POST['custom_delimiter'] ?? ',';
            }
            
            // Convert escape sequences
            if ($delimiter === '\t') {
                $delimiter = "\t";
            }
            
            // Parse CSV data
            $lines = preg_split('/\r\n|\r|\n/', $csv_data);
            $parsed_data = [];
            
            foreach ($lines as $index => $line) {
                if (trim($line) === '') continue;
                
                // Parse CSV line considering quotes
                $parsed_line = parse_csv_line($line, $delimiter, $quote_char);
                $parsed_data[] = $parsed_line;
            }
            
            if (empty($parsed_data)) {
                throw new Exception('No valid CSV data found');
            }
            
            // Process data based on headers
            if ($has_headers && count($parsed_data) > 0) {
                $headers = array_shift($parsed_data);
                $headers = array_map('trim', $headers);
                
                $result = [];
                foreach ($parsed_data as $row) {
                    $item = [];
                    foreach ($headers as $index => $header) {
                        $value = $row[$index] ?? '';
                        // Convert numeric values
                        if (is_numeric($value)) {
                            $value = strpos($value, '.') !== false ? (float)$value : (int)$value;
                        }
                        $item[$header] = $value;
                    }
                    $result[] = $item;
                }
            } else {
                // No headers - use indexes
                $result = $parsed_data;
            }
            
            // Format output
            $json_options = JSON_UNESCAPED_UNICODE;
            if ($output_format === 'pretty') {
                $json_options |= JSON_PRETTY_PRINT;
            }
            
            $json_output = json_encode($result, $json_options);
            
            if ($json_output === false) {
                throw new Exception('JSON encoding failed: ' . json_last_error_msg());
            }
            
            // Prepare response
            $response = [
                'success' => true,
                'json' => $json_output,
                'stats' => [
                    'rows' => count($result),
                    'columns' => $has_headers ? count($headers) : (count($result) > 0 ? count($result[0]) : 0),
                    'size' => strlen($json_output)
                ]
            ];
            
            echo json_encode($response);
            
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    } else {
        echo json_encode(['error' => 'Invalid action']);
    }
} else {
    echo json_encode(['error' => 'Invalid request method']);
}

function parse_csv_line($line, $delimiter, $quote_char) {
    $result = [];
    $current = '';
    $in_quotes = false;
    $chars = str_split($line);
    
    for ($i = 0; $i < count($chars); $i++) {
        $char = $chars[$i];
        
        if ($char === $quote_char) {
            if ($in_quotes && isset($chars[$i + 1]) && $chars[$i + 1] === $quote_char) {
                // Escaped quote
                $current .= $quote_char;
                $i++; // Skip next quote
            } else {
                $in_quotes = !$in_quotes;
            }
        } else if ($char === $delimiter && !$in_quotes) {
            $result[] = $current;
            $current = '';
        } else {
            $current .= $char;
        }
    }
    
    // Add the last field
    $result[] = $current;
    
    return $result;
}
?>