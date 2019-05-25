<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Student */
/* @var $group common\models\Group */
/* @var $studentLabs array */

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

    <table class="table table-striped table-bordered detail-view">
        <tbody>
        <tr>
            <th class="text-center" style="width: 220px">Название</th>
            <th class="text-center" style="width: 220px">Статус</th>
            <th class="text-center" style="width: 220px">Дата прохождения</th>
            <th class="text-center" style="width: 220px">Количество попыток</th>
            <th class="text-center" style="width: 100px"></th>
        </tr>
        <?php foreach ($studentLabs as $studentLab): ?>
            <tr>
                <th class="text-center">Лабораторная работа №<?= $studentLab['lab_id'] ?></th>
                <th class="text-center"><?= $studentLab['status'] ?></th>
                <th class="text-center"><?= $studentLab['date_create'] ?? '-' ?></th>
                <th class="text-center"><?= $studentLab['attempts'] ?></th>
                <th class="text-center"><?= $studentLab['href'] ? '<a href="' . $studentLab['href'] . '" target="_blank">Отчет</a>' : '-' ?></th>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
