<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $originalPrice = floatval($_POST['originalPrice'] ?? 0);
    $discountPercentage = floatval($_POST['discountPercentage'] ?? 0);
    $discountAmount = floatval($_POST['discountAmount'] ?? 0);
    $fixedDiscount = floatval($_POST['fixedDiscount'] ?? 0);
    $finalPrice = floatval($_POST['finalPrice'] ?? 0);
    $calculatedDiscount = floatval($_POST['calculatedDiscount'] ?? 0);
    $taxRate = floatval($_POST['taxRate'] ?? 0);
    $applyTaxAfter = isset($_POST['applyTaxAfter']);
    $roundResult = isset($_POST['roundResult']);
    $multipleItems = isset($_POST['multipleItems']);
    $itemQuantity = intval($_POST['itemQuantity'] ?? 1);

    // Determine calculation mode
    $calculationMode = 'percentage';
    if ($fixedDiscount > 0) {
        $calculationMode = 'fixed';
        $discountAmount = $fixedDiscount;
        $discountPercentage = ($fixedDiscount / $originalPrice) * 100;
    } elseif ($finalPrice > 0) {
        $calculationMode = 'final';
        $discountAmount = $originalPrice - $finalPrice;
        $discountPercentage = ($discountAmount / $originalPrice) * 100;
    } else {
        $discountAmount = $originalPrice * ($discountPercentage / 100);
    }

    // Validate inputs
    if ($originalPrice <= 0) {
        http_response_code(400);
        echo json_encode(['error' => 'Original price must be greater than 0']);
        exit;
    }

    if ($discountPercentage < 0 || $discountPercentage > 100) {
        http_response_code(400);
        echo json_encode(['error' => 'Discount percentage must be between 0 and 100']);
        exit;
    }

    // Calculate final price
    $finalPrice = $originalPrice - $discountAmount;
    
    // Ensure final price is not negative
    if ($finalPrice < 0) {
        $finalPrice = 0;
        $discountAmount = $originalPrice;
        $discountPercentage = 100;
    }

    // Calculate tax
    $taxableAmount = $applyTaxAfter ? $finalPrice : $originalPrice;
    $taxAmount = $taxableAmount * ($taxRate / 100);
    $totalAmount = $finalPrice + $taxAmount;

    // Apply rounding if requested
    if ($roundResult) {
        $finalPrice = round($finalPrice);
        $totalAmount = round($totalAmount);
        $taxAmount = round($taxAmount);
        $discountAmount = round($discountAmount);
    }

    // Calculate multiple items if enabled
    $multipleResults = [];
    if ($multipleItems && $itemQuantity > 1) {
        $multipleResults = [
            'perItemPrice' => $finalPrice,
            'totalQuantity' => $itemQuantity,
            'totalSavings' => $discountAmount * $itemQuantity,
            'totalFinalPrice' => $finalPrice * $itemQuantity
        ];
    }

    // Generate discount suggestions
    $suggestions = generateDiscountSuggestions($originalPrice);

    // Prepare response
    $response = [
        'success' => true,
        'calculation' => [
            'originalPrice' => formatCurrency($originalPrice),
            'discountPercentage' => round($discountPercentage, 1) . '%',
            'discountAmount' => formatCurrency($discountAmount),
            'finalPrice' => formatCurrency($finalPrice),
            'savings' => formatCurrency($discountAmount),
            'taxAmount' => formatCurrency($taxAmount),
            'totalAmount' => formatCurrency($totalAmount),
            'subtotal' => formatCurrency($finalPrice)
        ],
        'breakdown' => [
            'original' => formatCurrency($originalPrice),
            'discount' => formatCurrency($discountAmount),
            'subtotal' => formatCurrency($finalPrice),
            'tax' => formatCurrency($taxAmount),
            'total' => formatCurrency($totalAmount)
        ],
        'comparison' => [
            'original' => formatCurrency($originalPrice),
            'final' => formatCurrency($finalPrice),
            'savings' => formatCurrency($discountAmount)
        ],
        'multiple' => $multipleResults,
        'suggestions' => $suggestions
    ];

    echo json_encode($response);
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
}

function formatCurrency($amount) {
    return '$' . number_format($amount, 2);
}

function generateDiscountSuggestions($originalPrice) {
    $suggestions = [];
    $percentages = [10, 25, 50, 75];
    
    foreach ($percentages as $percentage) {
        $discountAmount = $originalPrice * ($percentage / 100);
        $finalPrice = $originalPrice - $discountAmount;
        
        $suggestions[$percentage] = [
            'finalPrice' => formatCurrency($finalPrice),
            'savings' => formatCurrency($discountAmount)
        ];
    }
    
    return $suggestions;
}
?>