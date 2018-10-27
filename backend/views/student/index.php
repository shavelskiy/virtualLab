<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var backend\models\Groups $group */

$this->title = 'Cтуденты группы: ' . $group->name;
$this->params['breadcrumbs'][] = ['label' => 'Группы', 'url' => ['group/index']];
$this->params['breadcrumbs'][] = ['label' => $group->name];
?>

<?php
if (Yii::$app->user->can('deleteStudent')) {
    $buttonsTemplate = '{view} {update} {delete}';
} else {
    $buttonsTemplate = '{view} {update}';
}
?>

<div class="student-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить студента', ['create', 'groupId' => $group->id], ['class' => 'btn btn-success']) ?>
        <?php if (Yii::$app->user->can('deleteGroup')): ?>
            <?= Html::a('Удалить группу', ['group/delete', 'id' => $group->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Вы уверены, что хотите удалить группу и всех студентов в ней?',
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif; ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'variant',
            'name',
            'last_name',
            'middle_name',

            [
                'attribute' => 'lab1.balls',
                'label' => 'Лаб. №1'
            ],
            [
                'attribute' => 'lab2.balls',
                'label' => 'Лаб. №2'
            ],
            [
                'attribute' => 'lab3.balls',
                'label' => 'Лаб. №3'
            ],
            [
                'attribute' => 'lab4.balls',
                'label' => 'Лаб. №4'
            ],
            [
                'attribute' => 'lab5.balls',
                'label' => 'Лаб. №5'
            ],
            [
                'attribute' => 'lab6.balls',
                'label' => 'Лаб. №6'
            ],

            ['class' => 'yii\grid\ActionColumn', 'template' => $buttonsTemplate],
        ],
    ]); ?>
</div>
