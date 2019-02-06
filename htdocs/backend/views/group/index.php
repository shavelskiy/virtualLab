<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Группы';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
if (Yii::$app->user->can('deleteGroup')) {
    $buttonTemplate = '{update} {delete}';
} else {
    $buttonTemplate = '{update}';
}
?>

<div class="group-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить группу', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'name',
                'format' => 'raw',
                'value' => function ($data) {
                    return Html::a(Html::encode($data->name), Url::toRoute(['student/index', 'groupId' => $data->id]));
                },
            ],

            ['attribute' => 'labs.lab1active', 'label' => 'Лаб. №1'],
            ['attribute' => 'labs.lab2active', 'label' => 'Лаб. №2'],
            ['attribute' => 'labs.lab3active', 'label' => 'Лаб. №3'],
            ['attribute' => 'labs.lab4active', 'label' => 'Лаб. №4'],
            ['attribute' => 'labs.lab5active', 'label' => 'Лаб. №5'],
            ['attribute' => 'labs.lab6active', 'label' => 'Лаб. №6'],
            ['attribute' => 'labs.lab7active', 'label' => 'Лаб. №7'],
            ['attribute' => 'labs.lab8active', 'label' => 'Лабо. №8'],

            [
                'attribute' => 'teachers',
                'format' => 'html',
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => $buttonTemplate,
                'buttons' => [
                    'delete' => function ($url, $model, $key) {
                        return (count($model->students) == 0) ? \backend\widgets\CActionColumn::renderDeleteButton($url) : false;
                    }
                ]
            ],
        ],
    ]); ?>
</div>
