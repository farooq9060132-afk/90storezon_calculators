<?php
// auth/google-logic.php
session_start();
require_once 'google-config.php';

if (isset($_GET['code'])) {
    try {
        // Exchange authorization code for access token
        $tokenResponse = exchangeCodeForToken($_GET['code']);
        
        if (isset($tokenResponse['access_token'])) {
            // Get user information from Google
            $userInfo = getUserInfo($tokenResponse['access_token']);
            
            if ($userInfo) {
                // Process user login/registration
                processGoogleUser($userInfo);
                
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

function processGoogleUser($userInfo) {
    // Extract user information
    $googleId = $userInfo['id'];
    $email = $userInfo['email'];
    $name = $userInfo['name'] ?? '';
    $picture = $userInfo['picture'] ?? '';
    
    // Check if user exists in database
    $user = findUserByGoogleId($googleId);
    
    if (!$user) {
        // Check if user exists by email
        $user = findUserByEmail($email);
        
        if ($user) {
            // Link Google account to existing user
            linkGoogleAccount($user['id'], $googleId, $picture);
        } else {
            // Create new user
            $user = createUserFromGoogle($name, $email, $googleId, $picture);
        }
    }
    
    // Set session variables
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_email'] = $user['email'];
    $_SESSION['user_name'] = $user['name'];
    $_SESSION['user_picture'] = $user['picture'] ?? '';
    $_SESSION['logged_in'] = true;
    $_SESSION['login_method'] = 'google';
    
    return $user;
}

function findUserByGoogleId($googleId) {
    // Database query to find user by Google ID
    // Return user array or false
    return false; // Placeholder
}

function findUserByEmail($email) {
    // Database query to find user by email
    // Return user array or false
    return false; // Placeholder
}

function linkGoogleAccount($userId, $googleId, $picture) {
    // Database query to link Google account to existing user
    // Update user record with Google ID and picture
}

function createUserFromGoogle($name, $email, $googleId, $picture) {
    // Database query to create new user
    // Return user array
    return [
        'id' => 1, // Placeholder
        'name' => $name,
        'email' => $email,
        'picture' => $picture
    ];
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