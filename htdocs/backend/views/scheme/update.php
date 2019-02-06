<?php

use yii\helpers\Html;

/**
 * @var $lab \common\models\Lab
 */

$this->title = 'ЛР №' . $lab->id . '. ' . $lab->name;
$this->params['breadcrumbs'][] = ['label' => 'Лабораторные работы', 'url' => ['lab/index']];
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['lab/update', 'id' => $lab->id]];
$this->params['breadcrumbs'][] = 'Изменение схем для лабораторной работы';

?>

<div class="container-fluid">
    <?php foreach ($lab->schemes as $scheme): ?>
        <div class="row">
                <canvas></canvas>
            <div class="col-6">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-3">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
