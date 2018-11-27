<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Student */
/* @var $group common\models\Group */

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
            'variant',
            'last_name',
            'name',
            'middle_name',
            'teacher'
        ],
    ]) ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            ['attribute' => 'user.username', 'label' => 'Логин'],
            ['attribute' => 'user.email', 'label' => 'Почта']
        ],
    ]) ?>

    <table id="w0" class="table table-striped table-bordered detail-view">
        <tbody>
        <tr>
            <th style="width: 220px">Название</th>
            <th style="width: 100px">Баллы</th>
            <th>Дата прохождения</th>
        </tr>
        <tr>
            <th>Лабораторная работа №1</th>
            <th><?= $model->labs->lab1->balls ?? '' ?></th>
            <th><?= $model->labs->lab1->createdAt ?? '' ?></th>
        </tr>
        <tr>
            <th>Лабораторная работа №2</th>
            <th><?= $model->labs->lab2->balls ?? '' ?></th>
            <th><?= $model->labs->lab2->createdAt ?? '' ?></th>
        </tr>
        <tr>
            <th>Лабораторная работа №3</th>
            <th><?= $model->labs->lab3->balls ?? '' ?></th>
            <th><?= $model->labs->lab3->createdAt ?? '' ?></th>
        </tr>
        <tr>
            <th>Лабораторная работа №4</th>
            <th><?= $model->labs->lab4->balls ?? '' ?></th>
            <th><?= $model->labs->lab4->createdAt ?? '' ?></th>
        </tr>
        <tr>
            <th>Лабораторная работа №5</th>
            <th><?= $model->labs->lab5->balls ?? '' ?></th>
            <th><?= $model->labs->lab5->createdAt ?? '' ?></th>
        </tr>
        <tr>
            <th>Лабораторная работа №6</th>
            <th><?= $model->labs->lab6->balls ?? '' ?></th>
            <th><?= $model->labs->lab6->createdAt ?? '' ?></th>
        </tr>
        <tr>
            <th>Лабораторная работа №7</th>
            <th><?= $model->labs->lab7->balls ?? '' ?></th>
            <th><?= $model->labs->lab7->createdAt ?? '' ?></th>
        </tr>
        <tr>
            <th>Лабораторная работа №8</th>
            <th><?= $model->labs->lab8->balls ?? '' ?></th>
            <th><?= $model->labs->lab8->createdAt ?? '' ?></th>
        </tr>
        </tbody>
    </table>
</div>
