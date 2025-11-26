<?php
$country = 'usa';
$country_name = 'United States';
$currency = '$';

// Mortgage data for USA
$mortgage_data = [
    'min_home_price' => 50000,
    'max_home_price' => 2000000,
    'down_payment_range' => '3% - 20%',
    'interest_rate_range' => '3.5% - 8.5%',
    'loan_terms' => [15, 20, 25, 30],
    'property_tax_avg' => 2400,
    'home_insurance_avg' => 1200
];

// US States
$states = [
    'California' => 'High cost areas',
    'Texas' => 'No state income tax',
    'New York' => 'High property taxes',
    'Florida' => 'No state income tax',
    'Illinois' => 'Moderate rates',
    'Pennsylvania' => 'Affordable housing',
    'Ohio' => 'Low cost of living',
    'Georgia' => 'Growing market',
    'North Carolina' => 'Tech hub growth',
    'Michigan' => 'Auto industry focus'
];

// Credit Score Tiers
$credit_score_tiers = [
    'Excellent' => ['min' => 800, 'max' => 850, 'rate_adjustment' => -1.0],
    'Very Good' => ['min' => 740, 'max' => 799, 'rate_adjustment' => -0.5],
    'Good' => ['min' => 670, 'max' => 739, 'rate_adjustment' => 0],
    'Fair' => ['min' => 580, 'max' => 669, 'rate_adjustment' => 1.5],
    'Poor' => ['min' => 300, 'max' => 579, 'rate_adjustment' => 3.0]
];
?>