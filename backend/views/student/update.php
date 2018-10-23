<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Student */

$this->title = 'Изменить данные о студенте: ' . $model->lastName . ' ' . $model->name . ' ' . $model->middleName;
$this->params['breadcrumbs'][] = ['label' => 'Группы', 'url' => ['group/index']];
$this->params['breadcrumbs'][] = ['label' => $group->name, 'url' => ['student/index', 'groupId' => $group->id]];
$this->params['breadcrumbs'][] = ['label' => $model->lastName . ' ' . $model->name . ' ' . $model->middleName, 'url' => ['student/view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменение';
?>
<div class="student-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'password' => false
    ]) ?>

</div>
