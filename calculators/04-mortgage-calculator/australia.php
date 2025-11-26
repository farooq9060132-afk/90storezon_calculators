<?php
$country = 'australia';
$country_name = 'Australia';
$currency = 'AU$';

// Mortgage data for Australia
$mortgage_data = [
    'min_home_price' => 50000,
    'max_home_price' => 2500000,
    'down_payment_range' => '5% - 20%',
    'interest_rate_range' => '2.5% - 8.0%',
    'loan_terms' => [15, 20, 25, 30],
    'property_tax_avg' => 3000,
    'home_insurance_avg' => 1800
];

// Australian States
$states = [
    'New South Wales' => 'Sydney market',
    'Victoria' => 'Melbourne market',
    'Queensland' => 'Brisbane growth',
    'Western Australia' => 'Perth mining sector',
    'South Australia' => 'Adelaide affordability',
    'Tasmania' => 'Lowest property prices',
    'Australian Capital Territory' => 'Canberra government sector',
    'Northern Territory' => 'Darwin tropical region'
];

// Credit Score Tiers (Australia)
$credit_score_tiers = [
    'Excellent' => ['min' => 800, 'max' => 1200, 'rate_adjustment' => -1.0],
    'Very Good' => ['min' => 700, 'max' => 799, 'rate_adjustment' => -0.5],
    'Good' => ['min' => 600, 'max' => 699, 'rate_adjustment' => 0],
    'Average' => ['min' => 500, 'max' => 599, 'rate_adjustment' => 1.0],
    'Below Average' => ['min' => 0, 'max' => 499, 'rate_adjustment' => 2.0]
];
?>