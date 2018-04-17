<!DOCTYPE html>
<html>
<head>
    <?php require 'config.php'; ?>
    <title><?php echo $title; ?></title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="vendor/twbs/bootstrap/dist/css/bootstrap.css" />
</head>
<body>
    <nav class="navbar sticky-top navbar-expand-xl bg-primary">
        <div class="container d-flex justify-content-between">
            <a class="navbar-brand" style="color: white" href="#"><?php echo $title; ?></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>
    <br>
    <main role="main" class="container">
          <div class="jumbotron">
            <img class="sticky" src="<?php echo $img; ?>" alt="Logo" style="height: 60px; width: 60px;margin-bottom: 20px;">
            <h1 style="display: inline;"><?php echo $title; ?></h1>
            <p class="lead"><?php echo $scope_info; ?></p>
            <ul class="list-group list-group-flush">
                <?php
                    foreach($scopesDefine as $scope => $scopeDetail){
                        echo '<li class="list-group-item">'. $scopeDetail . '</li>';
                    }
                ?>
            </ul>
            <br>
            <a class="btn btn-lg btn-primary" href="refreshtoken.php" role="button">Authorise</a>
        </div>
    </main>
    <script src="vendor/components/jquery/jquery.js"></script>
    <script src="vendor/twbs/bootstrap/dist/js/bootstrap.js"></script>
</body>
</html>
