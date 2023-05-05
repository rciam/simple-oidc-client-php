<?php

// index.php interface configuration
$title = "Generate Tokens";
$img = "https://clickhelp.co/images/feeds/blog/2016.05/keys.jpg";
$scopeInfo = "This service requires the following permissions for your account:";

// Client configuration
$issuer = "https://example.com/oidc/";
$clientId = "some-client-id";
$clientSecret = "some-client-secret";  // comment if you are using PKCE
// $pkceCodeChallengeMethod = "S256";   // uncomment to use PKCE
$redirectPage = "refreshtoken.php";  // select between "refreshtoken.php" and "auth.php"
$redirectUrl = "http://localhost/simple-oidc-client-php/" . $redirectPage;
// add scopes as keys and a friendly message of the scope as value
$scopesDefine = array(
    'openid' => 'log in using your identity',
    'email' => 'read your email address',
    'profile' => 'read your basic profile info',
);
// refreshtoken.php interface configuration
$refreshTokenNote = "NOTE: New refresh tokens expire in 12 months.";
$accessTokenNote = "NOTE: New access tokens expire in 1 hour.";
$manageTokenNote = "You can manage your refresh tokens in the following link: ";
$manageTokens = $issuer . "manage/user/services";
$sessionName = "simple-oidc-client-php";  // This value must be the same with the name of the parent directory
$sessionLifetime = 60 * 60;  // must be equal to access token validation time in seconds
$bannerText = "";
$bannerType = "info";  // Select one of "info", "warning", "error" or "success"
$allowIntrospection = false;
$enableActiveTokensTable = false;  // This option works only for MITREid Connect based OPs
$showIdToken = false;
