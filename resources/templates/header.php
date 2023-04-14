<!DOCTYPE html>
<html lang="en">

<head>
    <?php require 'config.php'; ?>
    <title><?php echo $title; ?></title>
    <meta content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="vendor/twbs/bootstrap/dist/css/bootstrap.css" />
    <link rel="stylesheet" href="public/css/banner.css" />
    <link rel="stylesheet" href="vendor/components/font-awesome/css/all.css" />
</head>

<body>
    <?php if (!empty($bannerText)) : ?>
        <div id="banner-info-bar" class="banner-top-<?= $bannerType ?> banner-top-global">
            <div>
                <?= $bannerText ?>
            </div>
            <a class="banner-top-close" href="#" onclick="closeBanner(this)">
                <i class="fas fa-times"></i>
            </a>
        </div>
    <?php endif; ?>
    <nav class="navbar sticky-top navbar-expand-xl bg-primary">
        <div class="container d-flex justify-content-between">
            <a class="navbar-brand" style="color: white" href="#"><?php echo $title; ?></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>