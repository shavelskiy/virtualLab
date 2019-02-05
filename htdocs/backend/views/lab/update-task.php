<?php

use yii\helpers\Html;

/**
 * @var $lab \common\models\Lab
 */

$this->title = 'ЛР №' . $lab->id . '. ' . $lab->name;
$this->params['breadcrumbs'][] = ['label' => 'Лабораторные работы', 'url' => ['lab/index']];
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['lab/update', 'id' => $lab->id]];
$this->params['breadcrumbs'][] = 'Изменение задания';
?>

<form method="post">
    <button type="submit" class="btn btn-primary mb-3 mt-2">Сохранить</button>

    <?= Html:: hiddenInput(\Yii:: $app->getRequest()->csrfParam, \Yii:: $app->getRequest()->getCsrfToken(), []); ?>
    <?= backend\widgets\nested\widgets\NestedList::widget([
        'items' => \common\models\LabItems::find()->tree($lab->id),
        'actions' => false,
    ]); ?>
</form>

