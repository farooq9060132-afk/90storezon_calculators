<?php
$country = 'uk';
$country_name = 'United Kingdom';
$currency = '£';

// Mortgage data for UK
$mortgage_data = [
    'min_home_price' => 30000,
    'max_home_price' => 1500000,
    'down_payment_range' => '5% - 40%',
    'interest_rate_range' => '2.5% - 7.5%',
    'loan_terms' => [15, 20, 25, 30, 35, 40],
    'property_tax_avg' => 2000,
    'home_insurance_avg' => 1500
];

// UK Regions
$regions = [
    'England' => 'Southern regions more expensive',
    'Scotland' => 'Lower property prices',
    'Wales' => 'Affordable housing',
    'Northern Ireland' => 'Lowest property prices'
];

// Credit Score Tiers (UK)
$credit_score_tiers = [
    'Excellent' => ['min' => 900, 'max' => 999, 'rate_adjustment' => -1.0],
    'Good' => ['min' => 800, 'max' => 899, 'rate_adjustment' => -0.5],
    'Fair' => ['min' => 700, 'max' => 799, 'rate_adjustment' => 0],
    'Poor' => ['min' => 500, 'max' => 699, 'rate_adjustment' => 1.5]
];
?>