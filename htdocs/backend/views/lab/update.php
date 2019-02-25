<?php

use yii\helpers\Html;
use \yii\helpers\Url;

/**
 * @var $lab \common\models\Lab
 */

$this->registerJsFile("@web/js/schemePreview.js");

$this->title = 'ЛР №' . $lab->id . '. ' . $lab->name;
$this->params['breadcrumbs'][] = ['label' => 'Лабораторные работы', 'url' => ['lab/index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="lab-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <a href="<?= Url::toRoute(['lab/update-task', 'id' => $lab->id]) ?>">Изменить задание</a>
            </div>
        </div>
        <div class="row">
            <div class="col-5">
                <ul class="list-group mt-3">
                    <?php /** @var \common\models\Scheme $scheme */ ?>
                    <?php foreach ($lab->schemes as $key => $scheme): ?>
                        <li class="list-group-item">
                            <?= $key + 1 ?>.
                            <a class="ml-2" href="<?= Url::toRoute(['scheme/update', 'schemeId' => $scheme->id]) ?>">Изменить схему.</a>
                            <a class="mx-2" href="<?= Url::toRoute(['scheme/update-data', 'schemeId' => $scheme->id]) ?>">Изменить Данные</a>
                            <button type="button" class="btn btn-default ml-2 pull-right delete-scheme" data-id="<?= $scheme->id ?>"><span class="glyphicon glyphicon-remove"></span></button>
                            <button class="btn btn-primary draw-scheme pull-right" data-id="<?= $scheme->id ?>">Показать</button>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <a class="btn btn-primary" href="<?= Url::toRoute(['scheme/update', 'labId' => $lab->id]) ?>">Добавить схему</a>
            </div>
            <div class="col-7">
                <canvas id="scheme" width="640" height="360" style="border: 1px solid black"></canvas>

            </div>
        </div>
    </div>
</div>
