<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Basic metrics
    $monthly_views = floatval($_POST['monthly_views'] ?? 0);
    $subscribers = intval($_POST['subscribers'] ?? 0);
    $video_count = intval($_POST['video_count'] ?? 0);
    $avg_duration = floatval($_POST['avg_duration'] ?? 0);
    
    // Monetization settings
    $rpm = floatval($_POST['rpm'] ?? 0);
    $cpm = floatval($_POST['cpm'] ?? 0);
    $monetized_views = floatval($_POST['monetized_views'] ?? 0);
    $ads_per_video = floatval($_POST['ads_per_video'] ?? 0);
    
    // Channel niche & performance
    $niche = $_POST['niche'] ?? 'entertainment';
    $audience_region = $_POST['audience_region'] ?? 'us_canada';
    $engagement_rate = floatval($_POST['engagement_rate'] ?? 0);
    $watch_time = floatval($_POST['watch_time'] ?? 0);
    
    // Additional revenue streams
    $channel_memberships = isset($_POST['channel_memberships']);
    $super_chat = isset($_POST['super_chat']);
    $merch_shelf = isset($_POST['merch_shelf']);
    $sponsorships = isset($_POST['sponsorships']);
    
    try {
        // Niche-specific RPM adjustments
        $niche_multipliers = [
            'gaming' => 0.8,
            'tech' => 1.3,
            'vlog' => 1.0,
            'education' => 1.2,
            'entertainment' => 1.0,
            'finance' => 2.5,
            'lifestyle' => 1.1,
            'music' => 0.9,
            'sports' => 1.4,
            'howto' => 1.3
        ];
        
        // Region-specific RPM adjustments
        $region_multipliers = [
            'us_canada' => 1.5,
            'europe' => 1.2,
            'uk' => 1.3,
            'australia' => 1.4,
            'asia' => 0.7,
            'latin_america' => 0.5,
            'other' => 0.6
        ];
        
        // Engagement rate bonus (higher engagement = higher RPM)
        $engagement_bonus = 1.0 + ($engagement_rate / 100 * 0.5);
        
        // Watch time bonus (higher watch time = higher RPM)
        $watch_time_bonus = 1.0 + ($watch_time / 100 * 0.3);
        
        // Calculate adjusted RPM
        $adjusted_rpm = $rpm * 
                       ($niche_multipliers[$niche] ?? 1.0) * 
                       ($region_multipliers[$audience_region] ?? 1.0) * 
                       $engagement_bonus * 
                       $watch_time_bonus;
        
        // Calculate base ad revenue
        $monetized_views_count = $monthly_views * ($monetized_views / 100);
        $base_earnings = ($monetized_views_count / 1000) * $adjusted_rpm;
        
        // Ads per video adjustment
        $ads_adjustment = 1.0 + (($ads_per_video - 3) * 0.1);
        $adjusted_earnings = $base_earnings * $ads_adjustment;
        
        // Additional revenue streams
        $additional_earnings = 0;
        $revenue_streams = [];
        
        if ($channel_memberships) {
            $membership_earnings = $subscribers * 0.005 * 5; // 0.5% of subs pay $5/month
            $additional_earnings += $membership_earnings;
            $revenue_streams[] = [
                'name' => 'Channel Memberships',
                'earnings' => $membership_earnings,
                'percentage' => ($membership_earnings / $adjusted_earnings) * 100
            ];
        }
        
        if ($super_chat) {
            $super_chat_earnings = $subscribers * 0.001 * 20; // 0.1% of subs donate $20/month
            $additional_earnings += $super_chat_earnings;
            $revenue_streams[] = [
                'name' => 'Super Chat & Stickers',
                'earnings' => $super_chat_earnings,
                'percentage' => ($super_chat_earnings / $adjusted_earnings) * 100
            ];
        }
        
        if ($merch_shelf) {
            $merch_earnings = $subscribers * 0.002 * 30; // 0.2% of subs buy $30 merch/month
            $additional_earnings += $merch_earnings;
            $revenue_streams[] = [
                'name' => 'Merchandise',
                'earnings' => $merch_earnings,
                'percentage' => ($merch_earnings / $adjusted_earnings) * 100
            ];
        }
        
        if ($sponsorships) {
            $sponsorship_earnings = calculate_sponsorship_earnings($subscribers, $monthly_views, $niche);
            $additional_earnings += $sponsorship_earnings;
            $revenue_streams[] = [
                'name' => 'Brand Sponsorships',
                'earnings' => $sponsorship_earnings,
                'percentage' => ($sponsorship_earnings / $adjusted_earnings) * 100
            ];
        }
        
        // Total earnings
        $total_monthly = $adjusted_earnings + $additional_earnings;
        $total_yearly = $total_monthly * 12;
        
        // YouTube's cut (45%)
        $youtube_cut = $adjusted_earnings * 0.45;
        $creator_earnings = $adjusted_earnings * 0.55;
        
        // Performance metrics
        $earnings_per_subscriber = $subscribers > 0 ? $total_monthly / $subscribers : 0;
        $earnings_per_video = $video_count > 0 ? $total_monthly / $video_count : 0;
        $earnings_per_view = $monthly_views > 0 ? $total_monthly / $monthly_views : 0;
        
        // Channel growth potential
        $growth_potential = calculate_growth_potential($subscribers, $monthly_views, $engagement_rate);
        
        $response = [
            'success' => true,
            'results' => [
                'earnings' => [
                    'monthly' => round($total_monthly, 2),
                    'yearly' => round($total_yearly, 2),
                    'adjusted_rpm' => round($adjusted_rpm, 2),
                    'base_ad_earnings' => round($adjusted_earnings, 2),
                    'additional_earnings' => round($additional_earnings, 2),
                    'youtube_cut' => round($youtube_cut, 2),
                    'creator_earnings' => round($creator_earnings, 2)
                ],
                'metrics' => [
                    'earnings_per_subscriber' => round($earnings_per_subscriber, 4),
                    'earnings_per_video' => round($earnings_per_video, 2),
                    'earnings_per_view' => round($earnings_per_view, 4),
                    'monetized_views_count' => round($monetized_views_count)
                ],
                'revenue_streams' => $revenue_streams,
                'growth_potential' => $growth_potential,
                'factors' => [
                    'niche_multiplier' => $niche_multipliers[$niche] ?? 1.0,
                    'region_multiplier' => $region_multipliers[$audience_region] ?? 1.0,
                    'engagement_bonus' => $engagement_bonus,
                    'watch_time_bonus' => $watch_time_bonus,
                    'ads_adjustment' => $ads_adjustment
                ]
            ]
        ];
        
        echo json_encode($response);
        
    } catch (Exception $e) {
        echo json_encode(['error' => 'Calculation error: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Invalid request method']);
}

function calculate_sponsorship_earnings($subscribers, $monthly_views, $niche) {
    $sponsorship_rates = [
        'gaming' => 0.02,
        'tech' => 0.03,
        'vlog' => 0.025,
        'education' => 0.028,
        'entertainment' => 0.022,
        'finance' => 0.05,
        'lifestyle' => 0.026,
        'music' => 0.021,
        'sports' => 0.035,
        'howto' => 0.029
    ];
    
    $rate = $sponsorship_rates[$niche] ?? 0.025;
    
    // Assume 1 sponsorship deal per month for smaller channels, more for larger ones
    $deals_per_month = 1;
    if ($subscribers > 50000) $deals_per_month = 2;
    if ($subscribers > 200000) $deals_per_month = 3;
    if ($subscribers > 500000) $deals_per_month = 4;
    if ($subscribers > 1000000) $deals_per_month = 6;
    
    return $monthly_views * $rate * $deals_per_month;
}

function calculate_growth_potential($subscribers, $monthly_views, $engagement_rate) {
    $potential = [
        'level' => 'beginner',
        'message' => 'Great start! Focus on consistency and audience engagement.',
        'next_milestone' => '1,000 subscribers',
        'estimated_time' => '1-3 months',
        'potential_earnings' => 0
    ];
    
    if ($subscribers < 1000) {
        $potential['level'] = 'beginner';
        $potential['message'] = 'Focus on reaching 1,000 subscribers to monetize your channel.';
        $potential['next_milestone'] = '1,000 subscribers';
        $potential['estimated_time'] = '1-3 months';
        $potential['potential_earnings'] = $monthly_views * 0.002;
    } elseif ($subscribers < 10000) {
        $potential['level'] = 'growing';
        $potential['message'] = 'You\'re building momentum! Optimize your content strategy.';
        $potential['next_milestone'] = '10,000 subscribers';
        $potential['estimated_time'] = '3-6 months';
        $potential['potential_earnings'] = $monthly_views * 0.003;
    } elseif ($subscribers < 100000) {
        $potential['level'] = 'established';
        $potential['message'] = 'You have an established audience. Explore multiple revenue streams.';
        $potential['next_milestone'] = '100,000 subscribers';
        $potential['estimated_time'] = '6-12 months';
        $potential['potential_earnings'] = $monthly_views * 0.004;
    } else {
        $potential['level'] = 'professional';
        $potential['message'] = 'You\'re a professional creator! Focus on scaling and brand deals.';
        $potential['next_milestone'] = '1,000,000 subscribers';
        $potential['estimated_time'] = '12+ months';
        $potential['potential_earnings'] = $monthly_views * 0.006;
    }
    
    // Adjust based on engagement rate
    if ($engagement_rate > 12) {
        $potential['potential_earnings'] *= 1.3;
        $potential['message'] .= ' Your high engagement will accelerate growth!';
    }
    
    return $potential;
}
?>