<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model \common\models\Student */
/* @var $studentLabs array */


$this->title = 'Личный кабинет'
?>

<h1><?= $this->title ?></h1>

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