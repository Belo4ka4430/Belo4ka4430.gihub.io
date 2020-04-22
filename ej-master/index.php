<?php
require __DIR__ . '/config/app.php';
use Helpers\Html;
?>
<!doctype html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?= Html::css('bootstrap.min') ?>
    <?= Html::css('https://fonts.googleapis.com/icon?family=Material+Icons') ?>
    <?= Html::css('style') ?>
</head>
<body>
<?php Html::element('navbar') ?>
<?php System\App::run() ?>
<?= Html::script('https://code.jquery.com/jquery-3.4.1.slim.min.js') ?>
<?= Html::script('https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js') ?>
<?= Html::script('https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js') ?>
</body>
</html>
