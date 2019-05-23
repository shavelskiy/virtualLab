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
            <th>Дата прохождения</th>
            <th style="width: 100px">Отчет</th>
        </tr>
        <?php for ($i = 1; $i <= 8; $i++): ?>
            <tr>
                <th>Лабораторная работа №<?= $i ?></th>
                <th><?= $model->labs->{"lab$i"} ? date('m.d.Y i:H:s', $model->labs->{"lab$i"}->created_at) : '' ?></th>
                <th><?= $model->labs->{"lab$i"} ? '<a href="' . $model->labs->{"lab$i"}->file_path . '" target="_blank">Отчет</a>' : '' ?></th>
            </tr>
        <?php endfor; ?>
        </tbody>
    </table>
</div>
