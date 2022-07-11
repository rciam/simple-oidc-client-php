    <?php include(__DIR__ . '/resources/templates/header.php'); ?>
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
    <?php include(__DIR__ . '/resources/templates/footer.php'); ?>