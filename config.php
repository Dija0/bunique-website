<?php
define('DB_HOST', 'localhost'); 
define('DB_USERNAME', 'root'); 
define('DB_PASSWORD', ''); 
define('DB_NAME', 'bunique_data'); 
 
// Google API configuration 
define('GOOGLE_CLIENT_ID', '407137670872-ckihfho9np5sjmfuibraoi6rooatiup9.apps.googleusercontent.com'); 
define('GOOGLE_CLIENT_SECRET', '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'); 
define('GOOGLE_OAUTH_SCOPE', 'https://www.googleapis.com/auth/calendar'); 
define('REDIRECT_URI', 'https://localhost/bunique-website/google_calendar_event_sync.php'); //here
 
// Start session 
if(!session_id()) session_start(); //here
 
// Google OAuth URL 
$googleOauthURL = 'https://accounts.google.com/o/oauth2/auth?scope=' . urlencode(GOOGLE_OAUTH_SCOPE) . '&redirect_uri=' . REDIRECT_URI . '&response_type=code&client_id=' . GOOGLE_CLIENT_ID . '&access_type=online'; 







?>