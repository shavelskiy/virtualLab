<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Student */

$this->title = 'Добавить студента';
$this->params['breadcrumbs'][] = ['label' => 'Группы', 'url' => ['group/index']];
$this->params['breadcrumbs'][] = ['label' => $group->name, 'url' => ['student/index', 'groupId' => $group->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'password' => true
    ]) ?>

</div>
