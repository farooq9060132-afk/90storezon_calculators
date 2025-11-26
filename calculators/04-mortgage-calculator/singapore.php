<?php
$country = 'singapore';
$country_name = 'Singapore';
$currency = 'S$';

// Mortgage data for Singapore
$mortgage_data = [
    'min_home_price' => 100000,
    'max_home_price' => 5000000,
    'down_payment_range' => '5% - 20%',
    'interest_rate_range' => '2.5% - 6.0%',
    'loan_terms' => [15, 20, 25, 30],
    'property_tax_avg' => 1500,
    'home_insurance_avg' => 800
];

// Singapore Regions
$regions = [
    'Central Region' => 'City center',
    'East Region' => 'Coastal area',
    'North Region' => 'Residential area',
    'North-East Region' => 'New developments',
    'West Region' => 'Industrial and residential'
];

// Credit Score Tiers (Singapore)
$credit_score_tiers = [
    'Excellent' => ['min' => 750, 'max' => 850, 'rate_adjustment' => -1.0],
    'Very Good' => ['min' => 700, 'max' => 749, 'rate_adjustment' => -0.5],
    'Good' => ['min' => 650, 'max' => 699, 'rate_adjustment' => 0],
    'Fair' => ['min' => 600, 'max' => 649, 'rate_adjustment' => 1.0],
    'Poor' => ['min' => 300, 'max' => 599, 'rate_adjustment' => 2.0]
];
?>