<?php
$country = 'pakistan';
$country_name = 'Pakistan';
$currency = '₨';

// Mortgage data for Pakistan
$mortgage_data = [
    'min_home_price' => 500000,
    'max_home_price' => 5000000,
    'down_payment_range' => '10% - 50%',
    'interest_rate_range' => '12.0% - 20.0%',
    'loan_terms' => [10, 15, 20, 25],
    'property_tax_avg' => 2000,
    'home_insurance_avg' => 3000
];

// Pakistani Provinces
$provinces = [
    'Punjab' => 'Lahore market',
    'Sindh' => 'Karachi business hub',
    'Khyber Pakhtunkhwa' => 'Peshawar region',
    'Balochistan' => 'Quetta mineral rich',
    'Gilgit-Baltistan' => 'Northern areas',
    'Azad Kashmir' => 'Muzaffarabad region'
];

// Credit Score Tiers (Pakistan)
$credit_score_tiers = [
    'Excellent' => ['min' => 700, 'max' => 850, 'rate_adjustment' => -1.0],
    'Good' => ['min' => 650, 'max' => 699, 'rate_adjustment' => -0.5],
    'Average' => ['min' => 600, 'max' => 649, 'rate_adjustment' => 0],
    'Below Average' => ['min' => 550, 'max' => 599, 'rate_adjustment' => 1.0],
    'Poor' => ['min' => 300, 'max' => 549, 'rate_adjustment' => 2.0]
];
?>