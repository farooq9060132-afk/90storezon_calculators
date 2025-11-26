<?php
$country = 'india';
$country_name = 'India';
$currency = '₹';

// Mortgage data for India
$mortgage_data = [
    'min_home_price' => 500000,
    'max_home_price' => 10000000,
    'down_payment_range' => '10% - 50%',
    'interest_rate_range' => '6.5% - 12.0%',
    'loan_terms' => [10, 15, 20, 25, 30],
    'property_tax_avg' => 10000,
    'home_insurance_avg' => 5000
];

// Indian States
$states = [
    'Maharashtra' => 'Mumbai market',
    'Delhi' => 'National Capital',
    'Karnataka' => 'Bangalore tech hub',
    'Tamil Nadu' => 'Chennai industrial',
    'Telangana' => 'Hyderabad IT',
    'Gujarat' => 'Ahmedabad business',
    'West Bengal' => 'Kolkata eastern',
    'Uttar Pradesh' => 'Lucknow largest state',
    'Rajasthan' => 'Jaipur royal state',
    'Andhra Pradesh' => 'Amaravati capital'
];

// Credit Score Tiers (India)
$credit_score_tiers = [
    'Excellent' => ['min' => 750, 'max' => 900, 'rate_adjustment' => -1.0],
    'Good' => ['min' => 700, 'max' => 749, 'rate_adjustment' => -0.5],
    'Average' => ['min' => 650, 'max' => 699, 'rate_adjustment' => 0],
    'Below Average' => ['min' => 600, 'max' => 649, 'rate_adjustment' => 1.0],
    'Poor' => ['min' => 300, 'max' => 599, 'rate_adjustment' => 2.0]
];
?>