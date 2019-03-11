<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View
 * @var array $teacherList
 * @var common\models\Student $student
 * @var common\models\User $user
 * @var common\models\Group $group
 */

$this->title = 'Изменить данные о студенте: ' . $student->last_name . ' ' . $student->name . ' ' . $student->middle_name;
$this->params['breadcrumbs'][] = ['label' => 'Группы', 'url' => ['group/index']];
$this->params['breadcrumbs'][] = ['label' => $group->name, 'url' => ['student/index', 'groupId' => $group->id]];
$this->params['breadcrumbs'][] = ['label' => $student->last_name . ' ' . $student->name . ' ' . $student->middle_name, 'url' => ['student/view', 'id' => $student->id]];
$this->params['breadcrumbs'][] = 'Изменение';
?>
<div class="student-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="student-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($student, 'last_name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($student, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($student, 'middle_name')->textInput(['maxlength' => true]) ?>

        <hr>

        <?= $form->field($user, 'username')->textInput() ?>

        <?= $form->field($user, 'email') ?>

        <hr>

        <label>Преподаватель:</label>

        <?= $form->field($student, 'teacher_id')->dropDownList($teacherList, ['prompt' => ''])->label(''); ?>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
