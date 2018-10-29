<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Group */
/* @var array $teacherList
 * /* @var $form yii\widgets\ActiveForm
 */
?>

<div class="group-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php if ($update): ?>
        <?= $form->field($model, 'lab1')->checkbox() ?>

        <?= $form->field($model, 'lab2')->checkbox(['value' => 1]) ?>

        <?= $form->field($model, 'lab3')->checkbox() ?>

        <?= $form->field($model, 'lab4')->checkbox() ?>

        <?= $form->field($model, 'lab5')->checkbox() ?>

        <?= $form->field($model, 'lab6')->checkbox() ?>
    <?php endif; ?>

    <label>Преподаватели:</label>

    <?= $form->field($model, 'teacher1_id')->dropDownList([$teacherList], ['prompt' => ''])->label(''); ?>

    <?= $form->field($model, 'teacher2_id')->dropDownList([$teacherList], ['prompt' => ''])->label(''); ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
