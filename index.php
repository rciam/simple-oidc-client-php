    <?php include(__DIR__ . '/resources/templates/header.php'); ?>
    <br>
    <main role="main" class="container">
          <div class="jumbotron">
            <img class="sticky" src="<?php echo $img; ?>" alt="Logo" style="height: 60px; width: 60px;margin-bottom: 20px;">
            <h1 style="display: inline;"><?php echo $title; ?></h1>
            <p class="lead"><?php echo $scopeInfo; ?></p>
            <ul class="list-group list-group-flush">
                <?php
                foreach ($scopesDefine as $scope => $scopeDetail) {
                    echo '<li class="list-group-item">' . $scopeDetail . '</li>';
                }
                ?>
            </ul>
            <br>
            <a class="btn btn-lg btn-primary" href="<?php echo $redirectPage; ?>" role="button">Authorise</a>
        </div>
    </main>
    <script src="vendor/components/jquery/jquery.js"></script>
    <script src="vendor/twbs/bootstrap/dist/js/bootstrap.js"></script>
</body>
</html>
