<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    
    $type = $input['type'] ?? 'paragraphs';
    $quantity = $input['quantity'] ?? 5;
    $variant = $input['variant'] ?? 'standard';
    $startWithLorem = $input['startWithLorem'] ?? true;
    
    $response = [
        'success' => false,
        'text' => '',
        'error' => null,
        'stats' => []
    ];
    
    try {
        if ($quantity < 1 || $quantity > 100) {
            throw new Exception('Quantity must be between 1 and 100');
        }
        
        // Lorem Ipsum word banks for different variants
        $wordBanks = [
            'standard' => ['lorem', 'ipsum', 'dolor', 'sit', 'amet', 'consectetur', 'adipiscing', 'elit'],
            'classic' => ['sed', 'ut', 'perspiciatis', 'unde', 'omnis', 'iste', 'natus', 'error'],
            'modern' => ['leverage', 'agile', 'frameworks', 'provide', 'robust', 'synopsis'],
            'tech' => ['binary', 'algorithm', 'framework', 'interface', 'database', 'cloud'],
            'hipster' => ['artisan', 'craft', 'bespoke', 'sustainable', 'organic', 'locavore'],
            'cupcake' => ['cupcake', 'dessert', 'sweet', 'sugar', 'chocolate', 'vanilla']
        ];
        
        $words = $wordBanks[$variant] ?? $wordBanks['standard'];
        $generatedText = '';
        
        switch ($type) {
            case 'paragraphs':
                $generatedText = $this->generateParagraphs($quantity, $words, $startWithLorem);
                break;
            case 'words':
                $generatedText = $this->generateWords($quantity, $words, $startWithLorem);
                break;
            case 'sentences':
                $generatedText = $this->generateSentences($quantity, $words, $startWithLorem);
                break;
            case 'list':
                $generatedText = $this->generateList($quantity, $words, $startWithLorem);
                break;
            default:
                throw new Exception('Invalid text type');
        }
        
        $wordCount = str_word_count($generatedText);
        $charCount = strlen($generatedText);
        $paraCount = substr_count($generatedText, "\n\n") + 1;
        
        $response['success'] = true;
        $response['text'] = $generatedText;
        $response['stats'] = [
            'words' => $wordCount,
            'characters' => $charCount,
            'paragraphs' => $paraCount
        ];
        
    } catch (Exception $e) {
        $response['error'] = $e->getMessage();
    }
    
    echo json_encode($response);
    exit;
}

function generateParagraphs($count, $words, $startWithLorem) {
    $paragraphs = [];
    
    for ($i = 0; $i < $count; $i++) {
        $sentenceCount = rand(3, 6);
        $paragraph = '';
        
        for ($j = 0; $j < $sentenceCount; $j++) {
            $wordCount = rand(5, 12);
            $sentence = '';
            
            for ($k = 0; $k < $wordCount; $k++) {
                $randomWord = $words[array_rand($words)];
                if ($k === 0) {
                    $sentence .= ucfirst($randomWord);
                } else {
                    $sentence .= ' ' . $randomWord;
                }
            }
            
            $sentence .= '. ';
            $paragraph .= $sentence;
        }
        
        $paragraphs[] = trim($paragraph);
    }
    
    if ($startWithLorem) {
        $paragraphs[0] = "Lorem ipsum dolor sit amet, " . lcfirst($paragraphs[0]);
    }
    
    return implode("\n\n", $paragraphs);
}

function generateWords($count, $words, $startWithLorem) {
    $result = [];
    
    if ($startWithLorem) {
        $result = ['Lorem', 'ipsum', 'dolor', 'sit', 'amet'];
        $count -= 5;
    }
    
    for ($i = 0; $i < $count; $i++) {
        $result[] = $words[array_rand($words)];
    }
    
    return implode(' ', $result);
}

function generateSentences($count, $words, $startWithLorem) {
    $sentences = [];
    
    if ($startWithLorem) {
        $sentences[] = "Lorem ipsum dolor sit amet.";
        $count--;
    }
    
    for ($i = 0; $i < $count; $i++) {
        $wordCount = rand(5, 12);
        $sentence = '';
        
        for ($j = 0; $j < $wordCount; $j++) {
            $randomWord = $words[array_rand($words)];
            if ($j === 0) {
                $sentence .= ucfirst($randomWord);
            } else {
                $sentence .= ' ' . $randomWord;
            }
        }
        
        $sentences[] = $sentence . '.';
    }
    
    return implode(' ', $sentences);
}

function generateList($count, $words, $startWithLorem) {
    $items = [];
    
    for ($i = 0; $i < $count; $i++) {
        $wordCount = rand(3, 8);
        $item = '';
        
        for ($j = 0; $j < $wordCount; $j++) {
            $randomWord = $words[array_rand($words)];
            if ($j === 0) {
                $item .= ucfirst($randomWord);
            } else {
                $item .= ' ' . $randomWord;
            }
        }
        
        $items[] = '• ' . $item . '.';
    }
    
    return implode("\n", $items);
}
?>