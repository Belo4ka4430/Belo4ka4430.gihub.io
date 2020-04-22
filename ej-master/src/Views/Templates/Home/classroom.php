<?php
use Helpers\Html;
?>
<title><?= $title ?></title>
<div class="container mt-3">
    <div class="row justify-content-center">
        <h1>Список дисциплін</h1>
    </div>
    <div class="row mt-5">
        <?php for ($i = 0; $i < count($data['disciplines']); $i++) : ?>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <a href="
                <?= Html::link('home',
                    'discipline') ?>?id=<?= $data['disciplines'][$i]['id'] ?>&class_id=<?= $_GET['id'] ?>"
                   style="text-decoration: none; color: black;">
                    <div class="media">
                        <div class="media-body">
                            <h1 class="mt-1 text-center">
                                <?= $data['disciplines'][$i]['title'] ?>
                            </h1>
                            <p class="text-center">Викладач: <?= $data['disciplines'][$i]['leader'] ?></p>
                        </div>
                    </div>
                </a>
            </div>
        <?php endfor; ?>
    </div>
</div>