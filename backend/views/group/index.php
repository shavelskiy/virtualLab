<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

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

            [
                'attribute' => 'lab1',
                'value' => function ($data) {
                    return ($data->lab1) ? 'Да' : 'Нет';
                },
            ],
            [
                'attribute' => 'lab2',
                'value' => function ($data) {
                    return ($data->lab2) ? 'Да' : 'Нет';
                },
            ],
            [
                'attribute' => 'lab3',
                'value' => function ($data) {
                    return ($data->lab3) ? 'Да' : 'Нет';
                },
            ],
            [
                'attribute' => 'lab4',
                'value' => function ($data) {
                    return ($data->lab4) ? 'Да' : 'Нет';
                },
            ],
            [
                'attribute' => 'lab5',
                'value' => function ($data) {
                    return ($data->lab5) ? 'Да' : 'Нет';
                },
            ],
            [
                'attribute' => 'lab6',
                'value' => function ($data) {
                    return ($data->lab6) ? 'Да' : 'Нет';
                },
            ],

            ['class' => 'yii\grid\ActionColumn', 'template' => $buttonTemplate],
        ],
    ]); ?>
</div>
