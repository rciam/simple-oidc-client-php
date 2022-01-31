<!DOCTYPE html>
<html>
<head>
    <?php
    require __DIR__ . '/vendor/autoload.php';

    use Jumbojett\OpenIDConnectClient;
    require 'config.php';

    $oidc = new OpenIDConnectClient(
        $issuer,
        $client_id,
        $client_secret
    );
    $scopes = array_keys($scopesDefine);
    $oidc->addScope($scopes);
    $oidc->setRedirectURL($redirect_url);
    $response = array('code');
    $oidc->setResponseTypes($response);
    $oidc->authenticate();
    $refreshToken = $oidc->getRefreshToken();
    $tokenEndpoint = $oidc->getTokenEndpoint();
	  $userInfo = $oidc->requestUserInfo();
    $curl = "curl -X POST -u '${client_id}':'${client_secret}'  -d 'client_id=${client_id}&client_secret=${client_secret}&grant_type=refresh_token&refresh_token=${refreshToken}&scope=openid%20email%20profile' '${tokenEndpoint}' | python -m json.tool;";
    ?>
    <title><?php echo $title; ?></title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="vendor/twbs/bootstrap/dist/css/bootstrap.css" />
</head>
<body>
    <nav class="navbar sticky-top navbar-expand-xl bg-primary">
        <div class="container d-flex justify-content-between">
            <a class="navbar-brand" style="color: white" href="index.php"><?php echo $title; ?></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>
    <br>
    <main role="main" class="container">
          <div class="jumbotron">
            <img class="sticky" src="<?php echo $img; ?>" alt="Logo" style="height: 60px; width: 60px; margin-bottom: 20px;">
            <h1 style="display: inline;"><?php echo $title; ?></h1>
            <p style="margin-bottom: 0px;"><b>Client ID: </b> <?php echo $client_id; ?></p>
            <p><b>User Info: </b> <?php echo var_export($userInfo, true); ?></p>
            <p class="lead" style="margin-bottom: 0px;">Refresh Token: </p>
            <input id="refreshtoken" size=70 type="text" readonly style="cursor: text;" value="<?php echo $refreshToken; ?>" />
        </div>
    </main>
    <script src="vendor/components/jquery/jquery.js"></script>
    <script src="vendor/twbs/bootstrap/dist/js/bootstrap.js"></script>
    <script>
        $('#copy').click(function() {
            $("#refreshtoken").select();
            document.execCommand('copy');
        });
        $('#copy2').click(function() {
            $("#curl").select();
            document.execCommand('copy');
        });
    </script>
</body>
</html>