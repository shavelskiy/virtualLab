<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Преподаватели';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teacher-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->user->can('updateTeacher')) {
        $canCreate = true;
        $buttonTemplate = '{view} {update} {delete}';
    } else {
        $canCreate = false;
        $buttonTemplate = '{view}';
    } ?>

    <?php if ($canCreate): ?>
        <p>
            <?= Html::a('Добавить преподавателя', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?= GridView::widget(
        [
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'name',
                'last_name',
                'middle_name',
                'pulpit',
                [
                    'label' => 'Почта',
                    'attribute' => 'user.email'
                ],

                ['class' => 'yii\grid\ActionColumn', 'template' => $buttonTemplate],
            ]
        ]
    ); ?>
</div>
