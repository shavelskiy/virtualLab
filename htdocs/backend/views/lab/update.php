<?php

use yii\helpers\Html;
use \yii\helpers\Url;

/**
 * @var $lab \common\models\Lab
 */

$this->title = 'ЛР №' . $lab->id . '. ' . $lab->name;
$this->params['breadcrumbs'][] = ['label' => 'Лабораторные работы', 'url' => ['lab/index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="lab-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <a href="<?= Url::toRoute(['lab/update-task', 'id' => $lab->id]) ?>">Изменить задание</a>
    <br>
    <a href="<?= Url::toRoute(['scheme/update-schemes', 'labId' => $lab->id]) ?>">Изменить схемы</a>
</div>
