<?php
// calculator.php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the posted data
    $data = json_decode(file_get_contents('php://input'), true);
    
    // Calculate budget
    $income = calculateTotalIncome($data);
    $expenses = calculateTotalExpenses($data);
    $net = $income - $expenses;
    
    // Prepare response
    $response = [
        'success' => true,
        'data' => [
            'total_income' => $income,
            'total_expenses' => $expenses,
            'net_income' => $net,
            'breakdown' => getExpenseBreakdown($data)
        ]
    ];
    
    echo json_encode($response);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}

function calculateTotalIncome($data) {
    $total = 0;
    
    if (isset($data['income'])) {
        foreach ($data['income'] as $amount) {
            $total += floatval($amount);
        }
    }
    
    return $total;
}

function calculateTotalExpenses($data) {
    $total = 0;
    
    if (isset($data['expenses'])) {
        foreach ($data['expenses'] as $amount) {
            $total += floatval($amount);
        }
    }
    
    return $total;
}

function getExpenseBreakdown($data) {
    $breakdown = [];
    
    if (isset($data['expense_categories'])) {
        foreach ($data['expense_categories'] as $category =>