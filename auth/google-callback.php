<?php
// auth/google-callback.php
session_start();
require_once 'google-config.php';
require_once 'google-login.php';

// The google-login.php file already handles the callback logic
// This file simply includes the logic file which handles the callback
// The logic file will process the OAuth callback and redirect appropriately
?>