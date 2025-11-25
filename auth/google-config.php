<?php
// auth/google-config.php

// Google OAuth 2.0 Configuration
$clientID = 'YOUR_GOOGLE_CLIENT_ID';
$clientSecret = 'YOUR_GOOGLE_CLIENT_SECRET';
$redirectUri = 'http://localhost/90storezon/auth/google-callback.php';

// Google OAuth endpoints
$authorizationEndpoint = 'https://accounts.google.com/o/oauth2/auth';
$tokenEndpoint = 'https://accounts.google.com/o/oauth2/token';
$userInfoEndpoint = 'https://www.googleapis.com/oauth2/v1/userinfo';

// Required scopes for user information
$scopes = [
    'https://www.googleapis.com/auth/userinfo.email',
    'https://www.googleapis.com/auth/userinfo.profile'
];

// Generate Google OAuth URL
function getGoogleAuthUrl() {
    global $clientID, $redirectUri, $authorizationEndpoint, $scopes;
    
    $params = [
        'client_id' => $clientID,
        'redirect_uri' => $redirectUri,
        'response_type' => 'code',
        'scope' => implode(' ', $scopes),
        'access_type' => 'offline',
        'prompt' => 'consent'
    ];
    
    return $authorizationEndpoint . '?' . http_build_query($params);
}

// Validate configuration
function validateGoogleConfig() {
    global $clientID, $clientSecret;
    
    if ($clientID === 'YOUR_GOOGLE_CLIENT_ID' || $clientSecret === 'YOUR_GOOGLE_CLIENT_SECRET') {
        error_log('Google OAuth configuration not set. Please update client ID and secret.');
        return false;
    }
    
    return true;
}
?>