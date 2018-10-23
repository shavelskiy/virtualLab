<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Groups;

/* @var $this yii\web\View */
/* @var $model common\models\Student */
$this->title = $model->lastName . ' ' . $model->name . ' ' . $model->middleName;
$this->params['breadcrumbs'][] = ['label' => 'Группы', 'url' => ['group/index']];
$this->params['breadcrumbs'][] = ['label' => $group->name, 'url' => ['student/index', 'groupId' => $group->id]];
$this->params['breadcrumbs'][] = ['label' => $this->title];?>

<div class="student-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [

            'name',
            'lastName',
            'middleName'
        ],
    ]) ?>

</div>
