<?php
use Helpers\Html;
use Models\User;
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="<?= Html::link('home', 'index') ?>">
        <?= Html::icon('book') ?>ЕлДжей
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor01">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="<?= Html::link('home', 'index') ?>">Головна</a>
            </li>
            <?php if (USER !== null) : ?>
                <li class="nav-item active">
                    <a class="nav-link" href="#"><?= User::getUserById(\USER)['name'] ?></a>
                </li>
                <?php if ($user = User::getUserById(\USER)) : ?>
                    <?php if ($user['type'] == 'admin' ) : ?>
                        <li class="nav-item active">
                            <a class="nav-link" href="
                            <?= Html::link('home', 'admin') ?>">
                                Панель адміністратора
                            </a>
                        </li>
                <?php endif; endif; ?>
                <li class="nav-item active">
                    <a class="nav-link" href="<?= Html::link('users', 'signin') ?>?logout">
                        Вихід
                    </a>
                </li>
            <?php else : ?>
                <li class="nav-item active">
                    <a class="nav-link" href="<?= Html::link('users', 'signin') ?>">Вхід</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= Html::link('users', 'signup') ?>">Реєстрація</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>