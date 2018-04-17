<?php
// index.php interface configuration
$title = "Generate Tokens";
$img = "https://clickhelp.co/images/feeds/blog/2016.05/keys.jpg";
$scope_info = "This service requires the following permissions for your account:";

// Client configuration
$issuer = "https://example.com/oidc/";
$client_id = "some-client-id";
$client_secret = "some-client-secret";
$redirect_url = "http://localhost/simple-oidc-client-php/refreshtoken.php";
// add scopes as keys and a friendly message of the scope as value
$scopesDefine = array('openid' => 'log in using your identity',
		'offline_access' => 'access your info while not being logged in',
		'email' => 'read your email address',
		'profile' => 'read your basic profile info');

// refreshtoken.php interface configuration
$refresh_token_note = "NOTE: New refresh tokens expire in 12 months.";
$access_token_note = "NOTE: New access tokens expire in 1 hour.";
$manage_token_note = "You can manage your refresh tokens in the following link: ";
$manageTokens = "https://example.com/oidc/myTokens";

?>
