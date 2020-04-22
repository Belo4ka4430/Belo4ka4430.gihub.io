<?php
use Helpers\Html;
use Models\User;
use Models\Classroom;
use Models\Pupil;
use Models\Discipline;
use System\App;
?>
<title><?= $title ?></title>
<div class="container admin mt-3">
    <div class="row justify-content-center">
        <h1 class="text-center">Адміністратор</h1>
    </div>
    <a class="btn btn-primary mt-2" href="
    <?= Html::link('home', 'admin') ?>?do=add&entity=teacher">
        Додати викладача</a>
    <a class="btn btn-primary mt-2" href="
    <?= Html::link('home', 'admin') ?>?do=add&entity=class">
        Додати клас</a>
    <a class="btn btn-primary mt-2" href="
    <?= Html::link('home', 'admin') ?>?do=add&entity=pupil">
        Додати учня</a>
    <a class="btn btn-primary mt-2" href="
    <?= Html::link('home', 'admin') ?>?do=add&entity=discipline">
        Додати дисципліну</a>

    <a class="btn btn-primary mt-4" href="
    <?= Html::link('home', 'admin') ?>?do=delete&entity=teacher">
        Видалити викладача</a>
    <a class="btn btn-primary mt-2" href="
    <?= Html::link('home', 'admin') ?>?do=delete&entity=class">
        Видалити клас</a>
    <a class="btn btn-primary mt-2" href="
    <?= Html::link('home', 'admin') ?>?do=delete&entity=pupil">
        Видалити учня</a>
    <a class="btn btn-primary mt-2" href="
    <?= Html::link('home', 'admin') ?>?do=delete&entity=discipline">
        Видалити дисципліну</a>
</div>

<?php if (isset($_GET['delete'])) : ?>
<div class="container">
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">№ п/п</th>
            <th scope="col">Об'єкт</th>
        </tr>
        </thead>
        <tbody>
        <?php
        switch ($_GET['delete'])
        {
            case 'teacher':
                if (isset($_GET['id']))
                {
                    User::deleteById($_GET['id']);
                    App::redirect('home', 'admin');
                }
                $vars = User::getUsersByType('teacher');
                $index = 'name';
                break;
            case 'class':
                if (isset($_GET['id']))
                {
                    Classroom::deleteById($_GET['id']);
                    App::redirect('home', 'admin');
                }
                $vars = Classroom::getAllClasses();
                $index = 'number';
                break;
            case 'pupil':
                if (isset($_GET['id']))
                {
                    Pupil::deleteById($_GET['id']);
                    App::redirect('home', 'admin');
                }
                $vars = Pupil::getAllPupils();
                $index = 'pupil';
                break;
            case 'discipline':
                if (isset($_GET['id']))
                {
                    Discipline::deleteById($_GET['id']);
                    App::redirect('home', 'admin');
                }
                $vars = Discipline::getAllDisciplines();
                $index = 'title';
                break;
        }
        ?>
            <?php for ($i = 0; $i < count($vars); $i++) : ?>
                <tr>
                    <th scope="row"><?= $i+1 ?></th>
                    <td><a href="
                    <?= Html::link('home', 'admin') ?>?delete=<?= $_GET['delete'] ?>&id=<?= $vars[$i]['id'] ?>"
                           style="color: black; text-decoration:none;">
                            <?php
                            if ($_GET['delete'] == 'class')
                            {
                                 echo $vars[$i]["$index"] . $vars[$i]['letter'];
                            } else
                            {
                                echo $vars[$i]["$index"];
                            }
                            ?>
                        </a>
                    </td>
                </tr>
            <?php endfor; ?>
        </tbody>
    </table>
</div>
<?php endif; ?>