    <?php include(__DIR__ . '/resources/templates/header.php'); ?>
    <br>
    <main role="main" class="container">
        <div class="jumbotron">
            <img class="sticky" src="<?php echo $img; ?>" alt="Logo" style="height: 60px; width: 60px;margin-bottom: 20px;">
            <h1 style="display: inline;"><?php echo $title; ?></h1>
            <p class="lead"><?php echo $scopeInfo; ?></p>

            <form action="<?php echo $redirectPage; ?>" method="post">
            <ul class="list-group list-group-flush">
                <?php
                foreach ($scopesDefine as $scope => $scopeDetail) {
                    if($scope == 'openid'){
                        echo '<li class="list-group-item">' . $scopeDetail . '<div style="float: right" >Required</div></li>';
                    }
                    else{
                        echo '<li class="list-group-item">' . $scopeDetail . '
                        <input class="checkbox" style="float: right; transform: scale(1.5)" type="checkbox" name="scopesToggle[]" checked="checked" value="' . $scope . '"/></li>';
                    }
                }
                ?>
            </ul>
            <br>
            <input type="submit" value="Authorise" class="btn btn-lg btn-primary" role="button" name="authorise">
            </form>
        </div>
    </main>
    <?php include(__DIR__ . '/resources/templates/footer.php'); ?>