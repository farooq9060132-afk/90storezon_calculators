<?php
$country = 'canada';
$country_name = 'Canada';
$currency = 'CA$';

// Mortgage data for Canada
$mortgage_data = [
    'min_home_price' => 40000,
    'max_home_price' => 2000000,
    'down_payment_range' => '5% - 20%',
    'interest_rate_range' => '3.0% - 8.0%',
    'loan_terms' => [15, 20, 25, 30],
    'property_tax_avg' => 2500,
    'home_insurance_avg' => 1300
];

// Canadian Provinces
$provinces = [
    'Ontario' => 'Toronto market',
    'British Columbia' => 'Vancouver market',
    'Alberta' => 'Calgary and Edmonton',
    'Quebec' => 'Montreal market',
    'Manitoba' => 'Winnipeg affordability',
    'Saskatchewan' => 'Regina and Saskatoon',
    'Nova Scotia' => 'Halifax maritime region',
    'New Brunswick' => 'Fredericton and Moncton',
    'Newfoundland and Labrador' => 'St. John\'s',
    'Prince Edward Island' => 'Charlottetown'
];

// Credit Score Tiers (Canada)
$credit_score_tiers = [
    'Excellent' => ['min' => 800, 'max' => 900, 'rate_adjustment' => -1.0],
    'Very Good' => ['min' => 750, 'max' => 799, 'rate_adjustment' => -0.5],
    'Good' => ['min' => 700, 'max' => 749, 'rate_adjustment' => 0],
    'Fair' => ['min' => 650, 'max' => 699, 'rate_adjustment' => 1.0],
    'Poor' => ['min' => 300, 'max' => 649, 'rate_adjustment' => 2.5]
];
?>