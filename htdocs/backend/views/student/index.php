<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var common\models\Group $group */

$this->title = 'Cтуденты группы: ' . $group->name;
$this->params['breadcrumbs'][] = ['label' => 'Группы', 'url' => ['group/index']];
$this->params['breadcrumbs'][] = ['label' => $group->name];
?>

<?php
if (Yii::$app->user->can('deleteStudent')) {
    $buttonsTemplate = '{update} {delete}';
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
            ['class' => 'yii\grid\ActionColumn', 'template' => '{view}'],

            'last_name',
            'name',
            'middle_name',

            [
                'attribute' => 'labs.lab1.result',
                'label' => 'Лаб. №1',
                'format' => 'html',
            ],
            [
                'attribute' => 'labs.lab2.result',
                'label' => 'Лаб. №2',
                'format' => 'html',
            ],
            [
                'attribute' => 'labs.lab3.result',
                'label' => 'Лаб. №3',
                'format' => 'html',
            ],
            [
                'attribute' => 'labs.lab4.result',
                'label' => 'Лаб. №4',
                'format' => 'html',
            ],
            [
                'attribute' => 'labs.lab5.result',
                'label' => 'Лаб. №5',
                'format' => 'html',
            ],
            [
                'attribute' => 'labs.lab6.result',
                'label' => 'Лаб. №6',
                'format' => 'html',
            ],
            [
                'attribute' => 'labs.lab7.result',
                'label' => 'Лаб. №7',
                'format' => 'html',
            ],
            'teacher',

            ['class' => 'yii\grid\ActionColumn', 'template' => $buttonsTemplate],
        ],
    ]); ?>
</div>
