<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var array $teacherList
/* @var $model common\models\Group */

$this->title = 'Изменить группу: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Группы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="group-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'teacherList' => $teacherList,
        'update' => true
    ]) ?>

</div>
