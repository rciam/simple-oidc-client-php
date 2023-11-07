
<?php

namespace SimpleOIDCClientPHP;

include __DIR__ . '/../../vendor/autoload.php';

use Jumbojett\OpenIDConnectClient;

include __DIR__ . '/../../config.php';
include __DIR__ . '/../../src/MitreIdConnectUtils.php';

if (!isset($_SESSION)) {
    session_set_cookie_params(0, '/' . $sessionName);
    session_name($sessionName);
    @session_start();
}

if (empty($clientSecret)) {
    $clientSecret = null;
}

$oidc = new OpenIDConnectClient(
    $issuer,
    $clientId,
    $clientSecret
);
$scopesKeys = array_keys($scopesDefine);

// Required scope for every request
$scopesCore = array('openid');

// Getting form from index.php and filtering unwanted scopes
if(isset($_POST['authorise'])){
    if(!empty($_POST['scopesToggle'])){
        $scopes = array_unique(array_merge($scopesCore,array_values($_POST['scopesToggle'])));
    }
    else{
        $scopes = $scopesCore;
    }
}

// Checking if only supported scopes are requested - "config.php/scopesDifine"
$scopes = array_intersect($scopes, $scopesKeys);

$oidc->addScope($scopes);
$oidc->setRedirectURL($redirectUrl);
$oidc->setResponseTypes(['code']);
if (!empty($pkceCodeChallengeMethod)) {
    $oidc->setCodeChallengeMethod($pkceCodeChallengeMethod);
}

if (isset($_SESSION['sub']) && time() - $_SESSION['CREATED'] < $sessionLifetime) {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'create-refresh-token':
                $_SESSION['action'] = 'create-refresh-token';
                $scopes[] = "offline_access";
                $oidc->addScope($scopes);
                $oidc->addAuthParam(['action' => 'create-refresh-token']);
                $oidc->authenticate();
                break;
            case 'revoke':
                $oidc->revokeToken($_POST['token'], '', $clientId, $clientSecret);
                $_SESSION['action'] = 'revoke';
                if ($_POST['token'] == $_SESSION['refresh_token']) {
                    $_SESSION['refresh_token'] = null;
                }
                break;
            default:
                break;
        }
    }
    if (isset($_SESSION['action']) && $_SESSION['action'] == 'create-refresh-token') {
        $oidc->authenticate();
        $refreshToken = $oidc->getRefreshToken();
        $sub = $oidc->requestUserInfo('sub');
        if ($sub) {
            $accessToken = $_SESSION['access_token'];
            $idToken = $_SESSION['id_token'];
            $_SESSION['refresh_token'] = $refreshToken;
        }
        unset($_SESSION['action']);
    } else {
        $accessToken = $_SESSION['access_token'];
        $idToken = $oidc->getIdToken();
        $refreshToken = $_SESSION['refresh_token'];
        unset($_SESSION['action']);
    }
} else {
    $oidc->authenticate();
    $accessToken = $oidc->getAccessToken();
    $idToken = $oidc->getIdToken();
    $refreshToken = $oidc->getRefreshToken();
    $sub = $oidc->requestUserInfo('sub');
    if ($sub) {
        $_SESSION['sub'] = $sub;
        $_SESSION['access_token'] = $accessToken;
        $_SESSION['id_token'] = $idToken;
        $_SESSION['refresh_token'] = $refreshToken;
        $_SESSION['CREATED'] = time();
    }
}

$openidConfiguration = getMetadata($issuer);
$tokenEndpoint = $openidConfiguration->{'token_endpoint'};
$userInfoEndpoint = $openidConfiguration->{'userinfo_endpoint'};
$introspectionEndpoint = $openidConfiguration->{'introspection_endpoint'};
