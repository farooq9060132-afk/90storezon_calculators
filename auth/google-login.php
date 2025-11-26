<?php
// auth/google-logic.php
session_start();
require_once 'google-config.php';
require_once 'user-manager.php';

if (isset($_GET['code'])) {
    try {
        // Exchange authorization code for access token
        $tokenResponse = exchangeCodeForToken($_GET['code']);
        
        if (isset($tokenResponse['access_token'])) {
            // Get user information from Google
            $userInfo = getUserInfo($tokenResponse['access_token']);
            
            if ($userInfo) {
                // Process user login/registration
                $userManager = new UserManager();
                processGoogleUser($userInfo, $userManager);
                
                // Redirect to appropriate page
                redirectAfterLogin();
            }
        }
    } catch (Exception $e) {
        error_log('Google OAuth error: ' . $e->getMessage());
        $_SESSION['error'] = 'Google login failed. Please try again.';
        header('Location: ../auth/signin.php');
        exit;
    }
} else {
    $_SESSION['error'] = 'Invalid authentication request.';
    header('Location: ../auth/signin.php');
    exit;
}

function exchangeCodeForToken($code) {
    global $clientID, $clientSecret, $redirectUri, $tokenEndpoint;
    
    $postData = [
        'code' => $code,
        'client_id' => $clientID,
        'client_secret' => $clientSecret,
        'redirect_uri' => $redirectUri,
        'grant_type' => 'authorization_code'
    ];
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $tokenEndpoint);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    if ($httpCode !== 200) {
        throw new Exception('Token exchange failed with HTTP code: ' . $httpCode);
    }
    
    return json_decode($response, true);
}

function getUserInfo($accessToken) {
    global $userInfoEndpoint;
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $userInfoEndpoint . '?access_token=' . $accessToken);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: Bearer ' . $accessToken]);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    if ($httpCode !== 200) {
        throw new Exception('User info request failed with HTTP code: ' . $httpCode);
    }
    
    return json_decode($response, true);
}

function processGoogleUser($userInfo, $userManager) {
    // Extract user information
    $googleId = $userInfo['id'];
    $email = $userInfo['email'];
    $name = $userInfo['name'] ?? '';
    $picture = $userInfo['picture'] ?? '';
    
    // Check if user exists by email
    $user = $userManager->getUserByEmail($email);
    
    if (!$user) {
        // Create new user from Google data
        // For simplicity, we'll use a placeholder password since this is Google login
        $user = $userManager->createUser($name, $email, uniqid(), false);
    }
    
    // Set session variables
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_email'] = $user['email'];
    $_SESSION['user_name'] = $user['name'];
    $_SESSION['user_picture'] = $picture;
    $_SESSION['logged_in'] = true;
    $_SESSION['login_method'] = 'google';
    
    return $user;
}

function redirectAfterLogin() {
    // Redirect to previous page or dashboard
    if (isset($_SESSION['redirect_url']) && !empty($_SESSION['redirect_url'])) {
        $redirectUrl = $_SESSION['redirect_url'];
        unset($_SESSION['redirect_url']);
        header('Location: ' . $redirectUrl);
    } else {
        header('Location: ../index.php');
    }
    exit;
}
?>