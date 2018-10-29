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

            'lab1active',
            'lab2active',
            'lab3active',
            'lab4active',
            'lab5active',
            'lab6active',
            'lab7active',
            'lab8active',

            [
                'attribute' => 'teachers',
                'format' => 'html',
            ],

            ['class' => 'yii\grid\ActionColumn', 'template' => $buttonTemplate],
        ],
    ]); ?>
</div>
