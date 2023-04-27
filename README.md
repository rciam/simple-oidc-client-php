# simple-oidc-client-php

A simple OpenID Connect (OIDC) client in PHP that uses authorization code flow
and/or [PKCE](https://tools.ietf.org/html/rfc7636)

## Simple OIDC Client - setup

You can either clone repo from github or download the project from releases.
(Instructions have been tested on Debian 10 and PHP 7).

### Clone repo

First you need to install apache and composer

```shell
sudo apt-get update
sudo apt-get install apache2 curl php-cli php-json php-xml git
php -r "copy('https://getcomposer.org/installer', '/tmp/composer-setup.php');"
sudo php /tmp/composer-setup.php --install-dir=/usr/local/bin --filename=composer
```

Click [here](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-macos)
for more info about composer installation

Then clone the repo to this directory:

```shell
cd /var/www/html
git clone https://github.com/rciam/simple-oidc-client-php.git
```

Install the requirements with composer:

```shell
cd simple-oidc-client-php
composer install
```

### Download from releases

Install Apache

```shell
sudo apt-get update
sudo apt-get install apache2
```

Download the file from releases and extract it in apache home directory

```shell
cd /var/www/html
wget https://github.com/rciam/simple-oidc-client-php/releases/download/vX.Y.Z/simple-oidc-client-php-X.Y.Z.tar.gz
tar -zxvf simple-oidc-client-php-X.Y.Z.tar.gz
```

## Simple OIDC Client - authentication

Now that we have everything we need, we can configure our login settings in
`config.php`.

```php
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
$sessionName = "oidc-client";
$sessionLifetime = 60 * 60;  // must be equal to access token validation time in seconds
$allowIntrospection = false;
$enableActiveTokensTable = false;
$showIdToken = false;
```

Let’s go quickly through the settings:

- `title` required, is the title on the navigation bar
- `img` required, is the source of the logo
- `scopeInfo` optional, is a message that informs the user for the application
  requirements
- `issuer` required, is the base URL of our IdentityServer instance. This will
  allow oidc-client to query the metadata endpoint so it can validate the tokens
- `clientId` required, is the id of the client we want to use when hitting the
  authorization endpoint
- `clientSecret` optional, a value the offers better security to the message
  flow
- `pkceCodeChallengeMethod` optional, a string that defines the code challenge
  method for PKCE. Choose between `plain` or `S256`.
- `redirectPage` required, the page to redirect the user. Currently, there are
  available 2 pages for that purpose:
  - `refreshtoken.php`: The users can request Refresh Tokens. Also, they can
    see all the issued active Refresh Tokens for this client.
  - `auth.php`: The users can obtain their user information from the obtained
    Access (and Refresh) Token.
- `redirectUrl` required, is the redirect URL where the client and the browser
  agree to send and receive correspondingly the code.
- `scopesDefine` required, defines the scopes the client supports
- `refreshTokenNote` optional, info for the refresh token
- `accessTokenNote` optional, info for the access token
- `manageTokenNote` optional, message the informs the user where can manage
  his tokens
- `manageTokens` optional, URL of the manage tokens service
- `sessionName` required, define the name of the cookie session
- `sessionLifetime` required, define the duration of the session. This must be
  equal to the validity time of the access token.
- `bannerText` optional, the text that the banner will contain.
- `bannerType` required if `bannerText` is omitted, otherwise is optional,
  define the type (color) of the banner. Options:
  - `info`
  - `error`
  - `success`
  - `warning`
- `allowIntrospection` required, define to show/hide the introspection command
- `enableActiveTokensTable` required, define to show/hide the Active Refresh
  Token table in `refreshtoken.php`
- `showIdToken` required, define to show/hide the ID Token from the dashboard
