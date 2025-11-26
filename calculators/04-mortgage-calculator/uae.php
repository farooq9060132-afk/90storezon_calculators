<?php
$country = 'uae';
$country_name = 'United Arab Emirates';
$currency = 'AED';

// Mortgage data for UAE
$mortgage_data = [
    'min_home_price' => 100000,
    'max_home_price' => 5000000,
    'down_payment_range' => '20% - 50%',
    'interest_rate_range' => '3.5% - 8.5%',
    'loan_terms' => [10, 15, 20, 25, 30],
    'property_tax_avg' => 0,
    'home_insurance_avg' => 2000
];

// UAE Emirates
$emirates = [
    'Dubai' => 'Luxury properties',
    'Abu Dhabi' => 'Capital city',
    'Sharjah' => 'Affordable option',
    'Ajman' => 'Smallest emirate',
    'Fujairah' => 'Coastal area',
    'Ras Al Khaimah' => 'Northern emirate',
    'Umm Al Quwain' => 'Least populated'
];

// Credit Score Tiers (UAE)
$credit_score_tiers = [
    'Excellent' => ['min' => 700, 'max' => 900, 'rate_adjustment' => -1.0],
    'Good' => ['min' => 600, 'max' => 699, 'rate_adjustment' => -0.5],
    'Average' => ['min' => 500, 'max' => 599, 'rate_adjustment' => 0],
    'Below Average' => ['min' => 300, 'max' => 499, 'rate_adjustment' => 1.5]
];
?>