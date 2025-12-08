<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

class FileSizeConverter {
    private $conversionFactors = [
        // Decimal units (Base 10)
        'bytes' => 1,
        'kilobytes' => 1000,
        'megabytes' => 1000000,
        'gigabytes' => 1000000000,
        'terabytes' => 1000000000000,
        'petabytes' => 1000000000000000,
        
        // Binary units (Base 2)
        'kibibytes' => 1024,
        'mebibytes' => 1048576,
        'gibibytes' => 1073741824,
        'tebibytes' => 1099511627776
    ];
    
    private $unitNames = [
        'bytes' => 'Bytes',
        'kilobytes' => 'Kilobytes',
        'megabytes' => 'Megabytes',
        'gigabytes' => 'Gigabytes',
        'terabytes' => 'Terabytes',
        'petabytes' => 'Petabytes',
        'kibibytes' => 'Kibibytes',
        'mebibytes' => 'Mebibytes',
        'gibibytes' => 'Gibibytes',
        'tebibytes' => 'Tebibytes'
    ];
    
    private $unitSymbols = [
        'bytes' => 'B',
        'kilobytes' => 'KB',
        'megabytes' => 'MB',
        'gigabytes' => 'GB',
        'terabytes' => 'TB',
        'petabytes' => 'PB',
        'kibibytes' => 'KiB',
        'mebibytes' => 'MiB',
        'gibibytes' => 'GiB',
        'tebibytes' => 'TiB'
    ];

    public function convert($value, $fromUnit, $toUnit, $precision = 2) {
        try {
            // Validate input
            if (!is_numeric($value) || $value < 0) {
                throw new Exception('Invalid input value');
            }
            
            if (!isset($this->conversionFactors[$fromUnit]) || !isset($this->conversionFactors[$toUnit])) {
                throw new Exception('Invalid unit specified');
            }
            
            // Convert to bytes first
            $bytes = $value * $this->conversionFactors[$fromUnit];
            
            // Convert from bytes to target unit
            $result = $bytes / $this->conversionFactors[$toUnit];
            
            // Format result with specified precision
            $formattedResult = round($result, $precision);
            
            // Handle very small numbers
            if ($formattedResult == 0 && $result > 0) {
                $formattedResult = number_format($result, max($precision, 6));
            }
            
            return [
                'success' => true,
                'originalValue' => $value,
                'originalUnit' => $fromUnit,
                'convertedValue' => $formattedResult,
                'targetUnit' => $toUnit,
                'sizeInBytes' => $bytes,
                'formula' => $this->getConversionFormula($value, $fromUnit, $toUnit, $bytes),
                'readable' => $this->formatReadable($formattedResult, $toUnit)
            ];
            
        } catch (Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }
    
    private function getConversionFormula($value, $fromUnit, $toUnit, $bytes) {
        $fromFactor = $this->conversionFactors[$fromUnit];
        $toFactor = $this->conversionFactors[$toUnit];
        
        if ($fromUnit === 'bytes') {
            return "{$value} B × (1 / {$toFactor}) = " . ($value / $toFactor) . " " . $this->unitSymbols[$toUnit];
        } elseif ($toUnit === 'bytes') {
            return "{$value} " . $this->unitSymbols[$fromUnit] . " × {$fromFactor} = {$bytes} B";
        } else {
            return "{$value} " . $this->unitSymbols[$fromUnit] . " × ({$fromFactor} / {$toFactor}) = " . ($value * $fromFactor / $toFactor) . " " . $this->unitSymbols[$toUnit];
        }
    }
    
    private function formatReadable($value, $unit) {
        $symbol = $this->unitSymbols[$unit];
        return number_format($value, 2) . ' ' . $symbol;
    }
    
    public function batchConvert($conversions, $precision = 2) {
        $results = [];
        
        foreach ($conversions as $index => $conversion) {
            $result = $this->convert(
                $conversion['value'],
                $conversion['fromUnit'],
                $conversion['toUnit'],
                $precision
            );
            
            $results[] = array_merge($result, ['index' => $index]);
        }
        
        return $results;
    }
    
    public function calculateDownloadTime($fileSize, $fileUnit, $downloadSpeed, $speedUnit) {
        try {
            // Convert file size to bytes
            if (!isset($this->conversionFactors[$fileUnit])) {
                throw new Exception('Invalid file size unit');
            }
            
            $fileSizeBytes = $fileSize * $this->conversionFactors[$fileUnit];
            
            // Convert speed to bytes per second
            $speedBps = $this->convertSpeedToBytesPerSecond($downloadSpeed, $speedUnit);
            
            if ($speedBps <= 0) {
                throw new Exception('Download speed must be greater than 0');
            }
            
            // Calculate time in seconds
            $timeSeconds = $fileSizeBytes / $speedBps;
            
            return [
                'success' => true,
                'fileSizeBytes' => $fileSizeBytes,
                'speedBps' => $speedBps,
                'timeSeconds' => $timeSeconds,
                'readableTime' => $this->formatTime($timeSeconds)
            ];
            
        } catch (Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }
    
    private function convertSpeedToBytesPerSecond($speed, $unit) {
        switch ($unit) {
            case 'Mbps': // Megabits per second
                return $speed * 125000; // 1 Mbps = 125,000 bytes/sec
            case 'MBps': // Megabytes per second
                return $speed * 1000000;
            case 'Kbps': // Kilobits per second
                return $speed * 125; // 1 Kbps = 125 bytes/sec
            case 'KBps': // Kilobytes per second
                return $speed * 1000;
            default:
                throw new Exception('Invalid speed unit');
        }
    }
    
    private function formatTime($seconds) {
        if ($seconds < 1) {
            return round($seconds * 1000, 2) . ' milliseconds';
        } elseif ($seconds < 60) {
            return round($seconds, 2) . ' seconds';
        } elseif ($seconds < 3600) {
            $minutes = floor($seconds / 60);
            $remainingSeconds = $seconds % 60;
            return $minutes . ' min ' . round($remainingSeconds) . ' sec';
        } elseif ($seconds < 86400) {
            $hours = floor($seconds / 3600);
            $minutes = floor(($seconds % 3600) / 60);
            return $hours . ' hr ' . $minutes . ' min';
        } else {
            $days = floor($seconds / 86400);
            $hours = floor(($seconds % 86400) / 3600);
            return $days . ' days ' . $hours . ' hr';
        }
    }
    
    public function getUnitInfo() {
        return [
            'factors' => $this->conversionFactors,
            'names' => $this->unitNames,
            'symbols' => $this->unitSymbols
        ];
    }
}

// Handle API requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $action = $input['action'] ?? '';
    
    $converter = new FileSizeConverter();
    $response = [];
    
    switch ($action) {
        case 'convert':
            $value = $input['value'] ?? 0;
            $fromUnit = $input['fromUnit'] ?? '';
            $toUnit = $input['toUnit'] ?? '';
            $precision = $input['precision'] ?? 2;
            
            $result = $converter->convert($value, $fromUnit, $toUnit, $precision);
            $response = $result;
            break;
            
        case 'batch_convert':
            $conversions = $input['conversions'] ?? [];
            $precision = $input['precision'] ?? 2;
            
            $results = $converter->batchConvert($conversions, $precision);
            $response = ['success' => true, 'results' => $results];
            break;
            
        case 'calculate_download_time':
            $fileSize = $input['fileSize'] ?? 0;
            $fileUnit = $input['fileUnit'] ?? '';
            $downloadSpeed = $input['downloadSpeed'] ?? 0;
            $speedUnit = $input['speedUnit'] ?? '';
            
            $result = $converter->calculateDownloadTime($fileSize, $fileUnit, $downloadSpeed, $speedUnit);
            $response = $result;
            break;
            
        case 'get_unit_info':
            $info = $converter->getUnitInfo();
            $response = ['success' => true, 'info' => $info];
            break;
            
        default:
            $response = ['success' => false, 'error' => 'Unknown action'];
    }
    
    echo json_encode($response);
    exit;
}
?>