<!DOCTYPE html>
<html lang="en">

<head>
    <title><?= $title; ?></title>
    <meta content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="vendor/twbs/bootstrap/dist/css/bootstrap.css" />
</head>

<body>
    <nav class="navbar sticky-top navbar-expand-xl bg-primary">
        <div class="container d-flex justify-content-between">
            <a class="navbar-brand" style="color: white" href="index.php"><?= $title; ?></a>
            <button
                class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>
    <?php include(__DIR__ . '/resources/controllers/session.php'); ?>
    <br>
    <main role="main" class="container">
          <div class="jumbotron">
            <img class="sticky" src="<?= $img; ?>" alt="Logo" style="height: 60px; width: 60px; margin-bottom: 20px;">
            <h1 style="display: inline;"><?= $title; ?></h1>
            <p style="margin-bottom: 0px;"><strong>Client ID: </strong> <?= $clientId; ?></p>
            <p><strong>User Info: </strong> <?= var_export($userInfo, true); ?></p>
            <p class="lead" style="margin-bottom: 0px;">Access Token: </p>
            <input id="access_token" size=70 type="text" readonly style="cursor: text;" value="<?= $accessToken; ?>" />
            <?php if (!empty($refreshToken)) : ?>
            <p class="lead" style="margin-bottom: 0px;">Refresh Token: </p>
            <input id="refresh_token" size=70 type="text" readonly style="cursor: text;" value="<?php echo $refreshToken; ?>" />
            <?php endif; ?>
        </div>
    </main>
    <script src="vendor/components/jquery/jquery.js"></script>
    <script src="vendor/twbs/bootstrap/dist/js/bootstrap.js"></script>
</body>
</html>