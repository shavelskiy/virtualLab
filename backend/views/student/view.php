<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Groups;

/* @var $this yii\web\View */
/* @var $model common\models\Student */
/* @var $group common\models\Groups */

$this->title = $model->last_name . ' ' . $model->name . ' ' . $model->middle_name;
$this->params['breadcrumbs'][] = ['label' => 'Группы', 'url' => ['group/index']];
$this->params['breadcrumbs'][] = ['label' => $group->name, 'url' => ['student/index', 'groupId' => $group->id]];
$this->params['breadcrumbs'][] = ['label' => $this->title]; ?>

<div class="student-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php if (Yii::$app->user->can('deleteStudent')): ?>
            <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Вы уверены, что хотите удалить этого студента?',
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif; ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'last_name',
            'middle_name',
            'user.username',
            'user.email'
        ],
    ]) ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => 'Работа №1',
                'attribute' => 'lab1.balls'
            ],
            [
                'label' => 'Время прохождения',
                'attribute' => 'lab1.createdAt'
            ],
            [
                'label' => 'Работа №2',
                'attribute' => 'lab2.balls'
            ],
            [
                'label' => 'Время прохождения',
                'attribute' => 'lab2.createdAt'
            ],
            [
                'label' => 'Работа №3',
                'attribute' => 'lab3.balls'
            ],
            [
                'label' => 'Время прохождения',
                'attribute' => 'lab3.createdAt'
            ],
            [
                'label' => 'Работа №4',
                'attribute' => 'lab4.balls'
            ],
            [
                'label' => 'Время прохождения',
                'attribute' => 'lab4.createdAt'
            ],
            [
                'label' => 'Работа №5',
                'attribute' => 'lab5.balls'
            ],
            [
                'label' => 'Время прохождения',
                'attribute' => 'lab5.createdAt'
            ],
            [
                'label' => 'Работа №6',
                'attribute' => 'lab6.balls'
            ],
            [
                'label' => 'Время прохождения',
                'attribute' => 'lab6.createdAt'
            ],
        ],
    ]) ?>

</div>
