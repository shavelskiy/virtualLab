<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var array $groupStudents */
/* @var $model common\models\Teacher */

$this->title = $model->last_name . ' ' . $model->name . ' ' . $model->middle_name;
$this->params['breadcrumbs'][] = ['label' => 'Преподаватели', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teacher-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->user->can('updateTeacher')): ?>
        <p>
            <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Вы уверены, что хотите удалить этого преподавателя?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>
    <?php endif; ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'last_name',
            'name',
            'middle_name',
            'pulpit',
            ['attribute' => 'user.email', 'label' => 'Почта']
        ],
    ]) ?>

    <h2>Студенты:</h2>
    <?php foreach ($groupStudents as $group => $students): ?>
        <table id="w0" class="table table-striped table-bordered detail-view">
            <?php if (!empty($students)): ?>
                <tbody>
                <tr>
                    <th style="width: 80px">Вариант</th>
                    <th><?= $group ?></th>
                </tr>
                <?php foreach ($students as $student): ?>
                    <tr>
                        <td><?= $student->variant; ?></td>
                        <td><?= Html::a(Html::encode($student->last_name . ' ' . $student->name . ' ' . $student->middle_name), Url::toRoute(['student/view', 'id' => $student->id])); ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            <?php else: ?>
                <tbody>
                <tr>
                    <th><?= $group ?></th>
                </tr>
                <tr>
                    <td>В этой группе нет ни одного студента у этого преподавателя</td>
                </tr>
                </tbody>
            <?php endif; ?>
        </table>

    <?php endforeach; ?>
</div>
