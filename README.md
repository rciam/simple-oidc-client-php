# simple-oidc-client-php
A simple OpenID Connect (OIDC) client in PHP that uses authorization code flow

## Simple OIDC Client - setup

You can either clone repo from github or download the project from releases.

### Clone repo

First we need to install apache and composer

```
sudo apt-get update
sudo apt-get install apache2
sudo apt-get install curl php5-cli git
php -r "copy('https://getcomposer.org/installer', '/tmp/composer-setup.php');"
sudo php /tmp/composer-setup.php --install-dir=/usr/local/bin --filename=composer
```
More info about composer installation (steps 1-2): https://www.digitalocean.com/community/tutorials/how-to-install-and-use-composer-on-debian-8

Then clone the repo to this directory:

```
cd /var/www/html
git clone https://github.com/rciam/simple-oidc-client-php.git
```

We are going to install the requirements with composer:

```
cd simple-oidc-client-php
composer install
```

### Download from releases

Install Apache

```
sudo apt-get update
sudo apt-get install apache2
```

Download the file from releases and extract it in apache home directory

```
cd /var/www/html
wget https://github.com/rciam/simple-oidc-client-php/releases/download/vX.Y.Z/simple-oidc-client-php-X.Y.Z.tar.gz
tar -zxvf simple-oidc-client-php-X.Y.Z.tar.gz
```

## Simple OIDC Client - authentication

Now that we have everything we need, we can configure our login settings in `config.php`.

```
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
```

Let’s go quickly through the settings:

* `title` required, is the title on the navigation bar
* `img` required, is the source of the logo
* `scope_info` optional, is a message that informs the user for the aplication requirements
* `issuer` required, is the base URL of our IdentityServer instance. This will allow oidc-client to query the metadata endpoint so it can validate the tokens
* `client_id` required, is the id of the client we want to use when hitting the authorization endpoint
* `client_secret` required, a value the offers better security to the message flow
* `redirect_url` required, is the redirect URL where the client and the browser agree to send and receive correspondingly the code
* `scopesDefine` required, defines the scopes the client supports
* `refresh_token_note` optional, info for the refresh token
* `access_token_note` optional, info for the access token
* `manage_token_note` optional, message the informs the user where can manage his tokens
* `manageTokens` optional, URL of the manage tokens service
