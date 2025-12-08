
<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

class ColorConverter {
    private $colorNames = [
        'aliceblue' => '#F0F8FF',
        'antiquewhite' => '#FAEBD7',
        'aqua' => '#00FFFF',
        'aquamarine' => '#7FFFD4',
        'azure' => '#F0FFFF',
        'beige' => '#F5F5DC',
        'bisque' => '#FFE4C4',
        'black' => '#000000',
        'blanchedalmond' => '#FFEBCD',
        'blue' => '#0000FF',
        'blueviolet' => '#8A2BE2',
        'brown' => '#A52A2A',
        'burlywood' => '#DEB887',
        'cadetblue' => '#5F9EA0',
        'chartreuse' => '#7FFF00',
        'chocolate' => '#D2691E',
        'coral' => '#FF7F50',
        'cornflowerblue' => '#6495ED',
        'cornsilk' => '#FFF8DC',
        'crimson' => '#DC143C',
        'cyan' => '#00FFFF',
        'darkblue' => '#00008B',
        'darkcyan' => '#008B8B',
        'darkgoldenrod' => '#B8860B',
        'darkgray' => '#A9A9A9',
        'darkgreen' => '#006400',
        'darkkhaki' => '#BDB76B',
        'darkmagenta' => '#8B008B',
        'darkolivegreen' => '#556B2F',
        'darkorange' => '#FF8C00',
        'darkorchid' => '#9932CC',
        'darkred' => '#8B0000',
        'darksalmon' => '#E9967A',
        'darkseagreen' => '#8FBC8F',
        'darkslateblue' => '#483D8B',
        'darkslategray' => '#2F4F4F',
        'darkturquoise' => '#00CED1',
        'darkviolet' => '#9400D3',
        'deeppink' => '#FF1493',
        'deepskyblue' => '#00BFFF',
        'dimgray' => '#696969',
        'dodgerblue' => '#1E90FF',
        'firebrick' => '#B22222',
        'floralwhite' => '#FFFAF0',
        'forestgreen' => '#228B22',
        'fuchsia' => '#FF00FF',
        'gainsboro' => '#DCDCDC',
        'ghostwhite' => '#F8F8FF',
        'gold' => '#FFD700',
        'goldenrod' => '#DAA520',
        'gray' => '#808080',
        'green' => '#008000',
        'greenyellow' => '#ADFF2F',
        'honeydew' => '#F0FFF0',
        'hotpink' => '#FF69B4',
        'indianred' => '#CD5C5C',
        'indigo' => '#4B0082',
        'ivory' => '#FFFFF0',
        'khaki' => '#F0E68C',
        'lavender' => '#E6E6FA',
        'lavenderblush' => '#FFF0F5',
        'lawngreen' => '#7CFC00',
        'lemonchiffon' => '#FFFACD',
        'lightblue' => '#ADD8E6',
        'lightcoral' => '#F08080',
        'lightcyan' => '#E0FFFF',
        'lightgoldenrodyellow' => '#FAFAD2',
        'lightgray' => '#D3D3D3',
        'lightgreen' => '#90EE90',
        'lightpink' => '#FFB6C1',
        'lightsalmon' => '#FFA07A',
        'lightseagreen' => '#20B2AA',
        'lightskyblue' => '#87CEFA',
        'lightslategray' => '#778899',
        'lightsteelblue' => '#B0C4DE',
        'lightyellow' => '#FFFFE0',
        'lime' => '#00FF00',
        'limegreen' => '#32CD32',
        'linen' => '#FAF0E6',
        'magenta' => '#FF00FF',
        'maroon' => '#800000',
        'mediumaquamarine' => '#66CDAA',
        'mediumblue' => '#0000CD',
        'mediumorchid' => '#BA55D3',
        'mediumpurple' => '#9370DB',
        'mediumseagreen' => '#3CB371',
        'mediumslateblue' => '#7B68EE',
        'mediumspringgreen' => '#00FA9A',
        'mediumturquoise' => '#48D1CC',
        'mediumvioletred' => '#C71585',
        'midnightblue' => '#191970',
        'mintcream' => '#F5FFFA',
        'mistyrose' => '#FFE4E1',
        'moccasin' => '#FFE4B5',
        'navajowhite' => '#FFDEAD',
        'navy' => '#000080',
        'oldlace' => '#FDF5E6',
        'olive' => '#808000',
        'olivedrab' => '#6B8E23',
        'orange' => '#FFA500',
        'orangered' => '#FF4500',
        'orchid' => '#DA70D6',
        'palegoldenrod' => '#EEE8AA',
        'palegreen' => '#98FB98',
        'paleturquoise' => '#AFEEEE',
        'palevioletred' => '#DB7093',
        'papayawhip' => '#FFEFD5',
        'peachpuff' => '#FFDAB9',
        'peru' => '#CD853F',
        'pink' => '#FFC0CB',
        'plum' => '#DDA0DD',
        'powderblue' => '#B0E0E6',
        'purple' => '#800080',
        'rebeccapurple' => '#663399',
        'red' => '#FF0000',
        'rosybrown' => '#BC8F8F',
        'royalblue' => '#4169E1',
        'saddlebrown' => '#8B4513',
        'salmon' => '#FA8072',
        'sandybrown' => '#F4A460',
        'seagreen' => '#2E8B57',
        'seashell' => '#FFF5EE',
        'sienna' => '#A0522D',
        'silver' => '#C0C0C0',
        'skyblue' => '#87CEEB',
        'slateblue' => '#6A5ACD',
        'slategray' => '#708090',
        'snow' => '#FFFAFA',
        'springgreen' => '#00FF7F',
        'steelblue' => '#4682B4',
        'tan' => '#D2B48C',
        'teal' => '#008080',
        'thistle' => '#D8BFD8',
        'tomato' => '#FF6347',
        'turquoise' => '#40E0D0',
        'violet' => '#EE82EE',
        'wheat' => '#F5DEB3',
        'white' => '#FFFFFF',
        'whitesmoke' => '#F5F5F5',
        'yellow' => '#FFFF00',
        'yellowgreen' => '#9ACD32'
    ];

    public function convertColor($color, $fromFormat, $toFormat) {
        try {
            // Normalize input
            $color = strtolower(trim($color));
            
            // Convert to RGB first
            $rgb = $this->toRgb($color, $fromFormat);
            
            if (!$rgb) {
                throw new Exception('Invalid color format or value');
            }
            
            // Convert from RGB to target format
            switch ($toFormat) {
                case 'hex':
                    $result = $this->rgbToHex($rgb);
                    break;
                case 'rgb':
                    $result = "rgb({$rgb['r']}, {$rgb['g']}, {$rgb['b']})";
                    break;
                case 'hsl':
                    $hsl = $this->rgbToHsl($rgb);
                    $result = "hsl({$hsl['h']}, {$hsl['s']}%, {$hsl['l']}%)";
                    break;
                case 'hsv':
                    $hsv = $this->rgbToHsv($rgb);
                    $result = "hsv({$hsv['h']}, {$hsv['s']}%, {$hsv['v']}%)";
                    break;
                case 'cmyk':
                    $cmyk = $this->rgbToCmyk($rgb);
                    $result = "cmyk({$cmyk['c']}%, {$cmyk['m']}%, {$cmyk['y']}%, {$cmyk['k']}%)";
                    break;
                case 'name':
                    $result = $this->rgbToName($rgb);
                    break;
                default:
                    throw new Exception('Unsupported target format');
            }
            
            return [
                'success' => true,
                'result' => $result,
                'rgb' => $rgb,
                'hex' => $this->rgbToHex($rgb),
                'hsl' => $this->rgbToHsl($rgb),
                'hsv' => $this->rgbToHsv($rgb),
                'cmyk' => $this->rgbToCmyk($rgb),
                'name' => $this->rgbToName($rgb)
            ];
            
        } catch (Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }
    
    private function toRgb($color, $format) {
        switch ($format) {
            case 'hex':
                return $this->hexToRgb($color);
            case 'rgb':
                return $this->parseRgb($color);
            case 'hsl':
                return $this->hslToRgb($color);
            case 'hsv':
                return $this->hsvToRgb($color);
            case 'cmyk':
                return $this->cmykToRgb($color);
            case 'name':
                return $this->nameToRgb($color);
            default:
                return null;
        }
    }
    
    private function hexToRgb($hex) {
        // Remove # if present
        $hex = ltrim($hex, '#');
        
        // Handle shorthand hex (#RGB)
        if (strlen($hex) === 3) {
            $hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
        }
        
        // Validate hex
        if (!preg_match('/^[a-f0-9]{6}$/i', $hex)) {
            return null;
        }
        
        return [
            'r' => hexdec(substr($hex, 0, 2)),
            'g' => hexdec(substr($hex, 2, 2)),
            'b' => hexdec(substr($hex, 4, 2))
        ];
    }
    
    private function parseRgb($rgb) {
        // Match rgb(r, g, b) format
        if (preg_match('/rgb\((\d+),\s*(\d+),\s*(\d+)\)/i', $rgb, $matches)) {
            return [
                'r' => min(255, max(0, intval($matches[1]))),
                'g' => min(255, max(0, intval($matches[2]))),
                'b' => min(255, max(0, intval($matches[3])))
            ];
        }
        
        return null;
    }
    
    private function hslToRgb($hsl) {
        // Match hsl(h, s%, l%) format
        if (preg_match('/hsl\((\d+),\s*(\d+)%,\s*(\d+)%\)/i', $hsl, $matches)) {
            $h = $matches[1] / 360;
            $s = $matches[2] / 100;
            $l = $matches[3] / 100;
            
            if ($s == 0) {
                $r = $g = $b = $l;
            } else {
                $q = $l < 0.5 ? $l * (1 + $s) : $l + $s - $l * $s;
                $p = 2 * $l - $q;
                
                $r = $this->hueToRgb($p, $q, $h + 1/3);
                $g = $this->hueToRgb($p, $q, $h);
                $b = $this->hueToRgb($p, $q, $h - 1/3);
            }
            
            return [
                'r' => round($r * 255),
                'g' => round($g * 255),
                'b' => round($b * 255)
            ];
        }
        
        return null;
    }
    
    private function hueToRgb($p, $q, $t) {
        if ($t < 0) $t += 1;
        if ($t > 1) $t -= 1;
        if ($t < 1/6) return $p + ($q - $p) * 6 * $t;
        if ($t < 1/2) return $q;
        if ($t < 2/3) return $p + ($q - $p) * (2/3 - $t) * 6;
        return $p;
    }
    
    private function hsvToRgb($hsv) {
        // Match hsv(h, s%, v%) format
        if (preg_match('/hsv\((\d+),\s*(\d+)%,\s*(\d+)%\)/i', $hsv, $matches)) {
            $h = $matches[1] / 360;
            $s = $matches[2] / 100;
            $v = $matches[3] / 100;
            
            $i = floor($h * 6);
            $f = $h * 6 - $i;
            $p = $v * (1 - $s);
            $q = $v * (1 - $f * $s);
            $t = $v * (1 - (1 - $f) * $s);
            
            switch ($i % 6) {
                case 0: $r = $v; $g = $t; $b = $p; break;
                case 1: $r = $q; $g = $v; $b = $p; break;
                case 2: $r = $p; $g = $v; $b = $t; break;
                case 3: $r = $p; $g = $q; $b = $v; break;
                case 4: $r = $t; $g = $p; $b = $v; break;
                case 5: $r = $v; $g = $p; $b = $q; break;
            }
            
            return [
                'r' => round($r * 255),
                'g' => round($g * 255),
                'b' => round($b * 255)
            ];
        }
        
        return null;
    }
    
    private function cmykToRgb($cmyk) {
        // Match cmyk(c%, m%, y%, k%) format
        if (preg_match('/cmyk\((\d+)%,\s*(\d+)%,\s*(\d+)%,\s*(\d+)%\)/i', $cmyk, $matches)) {
            $c = $matches[1] / 100;
            $m = $matches[2] / 100;
            $y = $matches[3] / 100;
            $k = $matches[4] / 100;
            
            $r = 255 * (1 - $c) * (1 - $k);
            $g = 255 * (1 - $m) * (1 - $k);
            $b = 255 * (1 - $y) * (1 - $k);
            
            return [
                'r' => round($r),
                'g' => round($g),
                'b' => round($b)
            ];
        }
        
        return null;
    }
    
    private function nameToRgb($name) {
        if (isset($this->colorNames[$name])) {
            return $this->hexToRgb($this->colorNames[$name]);
        }
        return null;
    }
    
    private function rgbToHex($rgb) {
        return '#' . sprintf('%02x%02x%02x', $rgb['r'], $rgb['g'], $rgb['b']);
    }
    
    private function rgbToHsl($rgb) {
        $r = $rgb['r'] / 255;
        $g = $rgb['g'] / 255;
        $b = $rgb['b'] / 255;
        
        $max = max($r, $g, $b);
        $min = min($r, $g, $b);
        $h = $s = $l = ($max + $min) / 2;
        
        if ($max == $min) {
            $h = $s = 0; // achromatic
        } else {
            $d = $max - $min;
            $s = $l > 0.5 ? $d / (2 - $max - $min) : $d / ($max + $min);
            
            switch ($max) {
                case $r: $h = ($g - $b) / $d + ($g < $b ? 6 : 0); break;
                case $g: $h = ($b - $r) / $d + 2; break;
                case $b: $h = ($r - $g) / $d + 4; break;
            }
            
            $h /= 6;
        }
        
        return [
            'h' => round($h * 360),
            's' => round($s * 100),
            'l' => round($l * 100)
        ];
    }
    
    private function rgbToHsv($rgb) {
        $r = $rgb['r'] / 255;
        $g = $rgb['g'] / 255;
        $b = $rgb['b'] / 255;
        
        $max = max($r, $g, $b);
        $min = min($r, $g, $b);
        $d = $max - $min;
        
        $h = 0;
        $s = ($max == 0) ? 0 : $d / $max;
        $v = $max;
        
        if ($max == $min) {
            $h = 0; // achromatic
        } else {
            switch ($max) {
                case $r: $h = ($g - $b) / $d + ($g < $b ? 6 : 0); break;
                case $g: $h = ($b - $r) / $d + 2; break;
                case $b: $h = ($r - $g) / $d + 4; break;
            }
            $h /= 6;
        }
        
        return [
            'h' => round($h * 360),
            's' => round($s * 100),
            'v' => round($v * 100)
        ];
    }
    
    private function rgbToCmyk($rgb) {
        $r = $rgb['r'] / 255;
        $g = $rgb['g'] / 255;
        $b = $rgb['b'] / 255;
        
        $k = 1 - max($r, $g, $b);
        
        if ($k == 1) {
            // Black
            return ['c' => 0, 'm' => 0, 'y' => 0, 'k' => 100];
        }
        
        $c = (1 - $r - $k) / (1 - $k);
        $m = (1 - $g - $k) / (1 - $k);
        $y = (1 - $b - $k) / (1 - $k);
        
        return [
            'c' => round($c * 100),
            'm' => round($m * 100),
            'y' => round($y * 100),
            'k' => round($k * 100)
        ];
    }
    
    private function rgbToName($rgb) {
        $hex = $this->rgbToHex($rgb);
        
        foreach ($this->colorNames as $name => $value) {
            if (strtolower($value) === strtolower($hex)) {
                return $name;
            }
        }
        
        return 'Unknown';
    }
    
    public function generateColorScheme($baseColor, $schemeType, $count = 5) {
        $rgb = $this->toRgb($baseColor, 'hex');
        
        if (!$rgb) {
            return ['success' => false, 'error' => 'Invalid base color'];
        }
        
        $hsl = $this->rgbToHsl($rgb);
        $scheme = [];
        
        switch ($schemeType) {
            case 'monochromatic':
                $scheme = $this->generateMonochromatic($hsl, $count);
                break;
            case 'analogous':
                $scheme = $this->generateAnalogous($hsl, $count);
                break;
            case 'complementary':
                $scheme = $this->generateComplementary($hsl);
                break;
            case 'triadic':
                $scheme = $this->generateTriadic($hsl);
                break;
            case 'tetradic':
                $scheme = $this->generateTetradic($hsl);
                break;
            case 'split-complementary':
                $scheme = $this->generateSplitComplementary($hsl);
                break;
            case 'square':
                $scheme = $this->generateSquare($hsl);
                break;
            default:
                return ['success' => false, 'error' => 'Unknown scheme type'];
        }
        
        // Convert scheme to hex
        $hexScheme = array_map(function($color) {
            return $this->rgbToHex($this->hslToRgb("hsl({$color['h']}, {$color['s']}%, {$color['l']}%)"));
        }, $scheme);
        
        return [
            'success' => true,
            'scheme' => $hexScheme,
            'type' => $schemeType
        ];
    }
    
    private function generateMonochromatic($hsl, $count) {
        $scheme = [];
        $step = 100 / ($count - 1);
        
        for ($i = 0; $i < $count; $i++) {
            $lightness = $i * $step;
            $scheme[] = [
                'h' => $hsl['h'],
                's' => $hsl['s'],
                'l' => $lightness
            ];
        }
        
        return $scheme;
    }
    
    private function generateAnalogous($hsl, $count) {
        $scheme = [];
        $angle = 30; // 30 degrees between analogous colors
        
        for ($i = -floor($count / 2); $i <= floor($count / 2); $i++) {
            $newHue = ($hsl['h'] + $i * $angle) % 360;
            if ($newHue < 0) $newHue += 360;
            
            $scheme[] = [
                'h' => $newHue,
                's' => $hsl['s'],
                'l' => $hsl['l']
            ];
        }
        
        return $scheme;
    }
    
    private function generateComplementary($hsl) {
        return [
            $hsl,
            [
                'h' => ($hsl['h'] + 180) % 360,
                's' => $hsl['s'],
                'l' => $hsl['l']
            ]
        ];
    }
    
    private function generateTriadic($hsl) {
        return [
            $hsl,
            [
                'h' => ($hsl['h'] + 120) % 360,
                's' => $hsl['s'],
                'l' => $hsl['l']
            ],
            [
                'h' => ($hsl['h'] + 240) % 360,
                's' => $hsl['s'],
                'l' => $hsl['l']
            ]
        ];
    }
    
    private function generateTetradic($hsl) {
        return [
            $hsl,
            [
                'h' => ($hsl['h'] + 90) % 360,
                's' => $hsl['s'],
                'l' => $hsl['l']
            ],
            [
                'h' => ($hsl['h'] + 180) % 360,
                's' => $hsl['s'],
                'l' => $hsl['l']
            ],
            [
                'h' => ($hsl['h'] + 270) % 360,
                's' => $hsl['s'],
                'l' => $hsl['l']
            ]
        ];
    }
    
    private function generateSplitComplementary($hsl) {
        return [
            $hsl,
            [
                'h' => ($hsl['h'] + 150) % 360,
                's' => $hsl['s'],
                'l' => $hsl['l']
            ],
            [
                'h' => ($hsl['h'] + 210) % 360,
                's' => $hsl['s'],
                'l' => $hsl['l']
            ]
        ];
    }
    
    private function generateSquare($hsl) {
        return [
            $hsl,
            [
                'h' => ($hsl['h'] + 90) % 360,
                's' => $hsl['s'],
                'l' => $hsl['l']
            ],
            [
                'h' => ($hsl['h'] + 180) % 360,
                's' => $hsl['s'],
                'l' => $hsl['l']
            ],
            [
                'h' => ($hsl['h'] + 270) % 360,
                's' => $hsl['s'],
                'l' => $hsl['l']
            ]
        ];
    }
}

// Handle API requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $action = $input['action'] ?? '';
    
    $converter = new ColorConverter();
    $response = [];
    
    switch ($action) {
        case 'convert':
            $color = $input['color'] ?? '';
            $fromFormat = $input['fromFormat'] ?? '';
            $toFormat = $input['toFormat'] ?? '';
            
            $result = $converter->convertColor($color, $fromFormat, $toFormat);
            $response = $result;
            break;
            
        case 'generate_scheme':
            $baseColor = $input['baseColor'] ?? '';
            $schemeType = $input['schemeType'] ?? '';
            $count = $input['count'] ?? 5;
            
            $result = $converter->generateColorScheme($baseColor, $schemeType, $count);
            $response = $result;
            break;
            
        case 'get_color_info':
            $color = $input['color'] ?? '';
            $format = $input['format'] ?? 'hex';
            
            $rgb = $converter->toRgb($color, $format);
            if ($rgb) {
                $response = [
                    'success' => true,
                    'hex' => $converter->rgbToHex($rgb),
                    'rgb' => $rgb,
                    'hsl' => $converter->rgbToHsl($rgb),
                    'hsv' => $converter->rgbToHsv($rgb),
                    'cmyk' => $converter->rgbToCmyk($rgb),
                    'name' => $converter->rgbToName($rgb)
                ];
            } else {
                $response = ['success' => false, 'error' => 'Invalid color'];
            }
            break;
            
        default:
            $response = ['success' => false, 'error' => 'Unknown action'];
    }
    
    echo json_encode($response);
    exit;
}
?>