<?php
$country = 'malaysia';
$country_name = 'Malaysia';
$currency = 'RM';

// Mortgage data for Malaysia
$mortgage_data = [
    'min_home_price' => 50000,
    'max_home_price' => 2000000,
    'down_payment_range' => '10% - 50%',
    'interest_rate_range' => '3.5% - 8.0%',
    'loan_terms' => [15, 20, 25, 30],
    'property_tax_avg' => 1500,
    'home_insurance_avg' => 2000
];

// Malaysian States
$states = [
    'Selangor' => 'Klang Valley area',
    'Kuala Lumpur' => 'Federal territory',
    'Penang' => 'George Town island',
    'Johor' => 'Johor Bahru southern',
    'Sabah' => 'East Malaysia Borneo',
    'Sarawak' => 'East Malaysia Borneo',
    'Malacca' => 'Historic state',
    'Negeri Sembilan' => 'Seremban area',
    'Pahang' => 'East coast state',
    'Perak' => 'Ipoh tin mining',
    'Kedah' => 'Langkawi island',
    'Terengganu' => 'East coast',
    'Kelantan' => 'Northeast state',
    'Perlis' => 'Smallest state'
];

// Credit Score Tiers (Malaysia)
$credit_score_tiers = [
    'Excellent' => ['min' => 750, 'max' => 900, 'rate_adjustment' => -1.0],
    'Good' => ['min' => 700, 'max' => 749, 'rate_adjustment' => -0.5],
    'Average' => ['min' => 650, 'max' => 699, 'rate_adjustment' => 0],
    'Below Average' => ['min' => 600, 'max' => 649, 'rate_adjustment' => 1.0],
    'Poor' => ['min' => 300, 'max' => 599, 'rate_adjustment' => 2.0]
];
?>