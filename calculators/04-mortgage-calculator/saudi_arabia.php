<?php
$country = 'saudi_arabia';
$country_name = 'Saudi Arabia';
$currency = 'SAR';

// Mortgage data for Saudi Arabia
$mortgage_data = [
    'min_home_price' => 50000,
    'max_home_price' => 3000000,
    'down_payment_range' => '10% - 50%',
    'interest_rate_range' => '3.0% - 8.0%',
    'loan_terms' => [10, 15, 20, 25, 30],
    'property_tax_avg' => 0,
    'home_insurance_avg' => 1500
];

// Saudi Regions
$regions = [
    'Riyadh' => 'Capital city',
    'Makkah' => 'Holy city',
    'Madinah' => 'Prophet\'s city',
    'Eastern Province' => 'Oil region',
    'Al-Qassim' => 'Agricultural area',
    'Asir' => 'Mountainous region',
    'Tabuk' => 'Northern region',
    'Hail' => 'Central region',
    'Northern Borders' => 'Border area',
    'Jizan' => 'Southern coastal',
    'Najran' => 'Southern region',
    'Al Bahah' => 'Mountain region',
    'Al Jawf' => 'Northwestern region'
];

// Credit Score Tiers (Saudi Arabia)
$credit_score_tiers = [
    'Excellent' => ['min' => 800, 'max' => 900, 'rate_adjustment' => -1.0],
    'Very Good' => ['min' => 700, 'max' => 799, 'rate_adjustment' => -0.5],
    'Good' => ['min' => 600, 'max' => 699, 'rate_adjustment' => 0],
    'Fair' => ['min' => 500, 'max' => 599, 'rate_adjustment' => 1.0],
    'Poor' => ['min' => 300, 'max' => 499, 'rate_adjustment' => 2.0]
];
?>