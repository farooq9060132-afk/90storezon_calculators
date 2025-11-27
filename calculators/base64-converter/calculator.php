<?php
// Base64 converter backend for file operations (if needed)
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $data = $_POST['data'] ?? '';
    
    if ($action === 'encode_file') {
        // Handle file encoding
        if (isset($_FILES['file'])) {
            $fileContent = file_get_contents($_FILES['file']['tmp_name']);
            $encoded = base64_encode($fileContent);
            echo json_encode(['success' => true, 'data' => $encoded]);
        } else {
            echo json_encode(['error' => 'No file uploaded']);
        }
    } elseif ($action === 'decode_file') {
        // Handle Base64 to file
        $decoded = base64_decode($data);
        echo json_encode(['success' => true, 'data' => $decoded]);
    } else {
        echo json_encode(['error' => 'Invalid action']);
    }
} else {
    echo json_encode(['error' => 'Invalid request method']);
}
?>