<?php
use Helpers\Html;
?>
<title><?= $title ?></title>
<div class="container mt-3">
    <div class="row justify-content-center">
        <h1>Список класів</h1>
    </div>
    <div class="row mt-5">
        <?php for ($i = 0; $i < count($data['classes']); $i++) : ?>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <a href="
                <?= Html::link('home', 'classroom') ?>?id=<?= $data['classes'][$i]['id'] ?>"
                   style="text-decoration: none; color: black;">
                    <div class="media">
                        <div class="media-body">
                            <h1 class="mt-1 text-center">
                                <?= $data['classes'][$i]['number'] . $data['classes'][$i]['letter'] ?>
                            </h1>
                            <p class="text-center">Класний керівник: <?= $data['classes'][$i]['leader'] ?></p>
                        </div>
                    </div>
                </a>
            </div>
        <?php endfor; ?>
    </div>
</div>