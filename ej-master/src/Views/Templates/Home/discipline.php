<?php
use Helpers\Html;
?>
<title><?= $title ?></title>
<div class="container mt-5">
    <div class="row justify-content-center mt-3">
        <h1>Журнал</h1>
    </div>
    <div class="row justify-content-center mt-2">
        <div class="col-sm-12">
            <h5 class="text-center">Дата заняття:</h5>
        </div>
        <div class="datecol">
            <form method="post" class="justify-content-center dateform">
                <div class="form-group justify-content-center dateform">
                    <input type="date" name="date" value="<?= @$_POST['date'] ?>" style="border-radius: 5px;">
                </div>
                <button type="submit" class="btn btn-primary">Обрати</button>
            </form>
        </div>
    </div>
    <div class="row mt-5 justify-content-center">
        <table class="table table-hover">
            <thead>
            <tr class="table-primary">
                <th scope="col">№ п/п</th>
                <th scope="col">ПІБ учня</th>
                <th scope="col">Оцінка</th>
            </tr>
            </thead>
            <tbody>
            <?php if (isset($_POST['date'])) : ?>
                <?php for ($i = 0; $i < count($data['pupils']); $i++) : ?>
                    <tr>
                        <th scope="row"><?= $i+1 ?></th>
                        <td><a href="
                        <?= Html::link('home', 'edit') ?>?class_id=<?= $_GET['class_id'] ?>&pupil_id=<?= $data['pupils'][$i]['id'] ?>&disc_id=<?= $_GET['id'] ?>&date=<?= $_POST['date'] ?>"
                               style="color: black; text-decoration:none;">
                                <?= $data['pupils'][$i]['pupil'] ?>
                            </a>
                        </td>
                        <?php
                        for ($j = 0; $j < count($data['grades']); $j++)
                        {
                            if ($data['grades'][$j]['pupil_id'] == $data['pupils'][$i]['id']) : ?>
                                <td><?= $data['grades'][$j]['grade'] ?></td>
                            <?php endif;
                        }
                        ?>
                    </tr>
                <?php endfor; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>