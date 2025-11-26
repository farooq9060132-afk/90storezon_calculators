<?php
$country = 'south_africa';
$country_name = 'South Africa';
$currency = 'R';

// Mortgage data for South Africa
$mortgage_data = [
    'min_home_price' => 100000,
    'max_home_price' => 3000000,
    'down_payment_range' => '10% - 50%',
    'interest_rate_range' => '7.0% - 15.0%',
    'loan_terms' => [10, 15, 20, 25, 30],
    'property_tax_avg' => 3000,
    'home_insurance_avg' => 4000
];

// South African Provinces
$provinces = [
    'Gauteng' => 'Johannesburg and Pretoria',
    'Western Cape' => 'Cape Town region',
    'KwaZulu-Natal' => 'Durban coastal',
    'Eastern Cape' => 'Port Elizabeth area',
    'Free State' => 'Bloemfontein central',
    'North West' => 'Rustenburg mining',
    'Northern Cape' => 'Kimberley diamond',
    'Limpopo' => 'Polokwane northern',
    'Mpumalanga' => 'Nelspruit eastern'
];

// Credit Score Tiers (South Africa)
$credit_score_tiers = [
    'Excellent' => ['min' => 750, 'max' => 850, 'rate_adjustment' => -1.0],
    'Good' => ['min' => 700, 'max' => 749, 'rate_adjustment' => -0.5],
    'Average' => ['min' => 650, 'max' => 699, 'rate_adjustment' => 0],
    'Below Average' => ['min' => 600, 'max' => 649, 'rate_adjustment' => 1.0],
    'Poor' => ['min' => 300, 'max' => 599, 'rate_adjustment' => 2.0]
];
?>