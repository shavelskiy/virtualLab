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
        <hr>
        <?= $form->field($model, 'lab1')->checkbox(['label' => 'Лабораторная работа №1']) ?>

        <?= $form->field($model, 'lab2')->checkbox(['label' => 'Лабораторная работа №2']) ?>

        <?= $form->field($model, 'lab3')->checkbox(['label' => 'Лабораторная работа №3']) ?>

        <?= $form->field($model, 'lab4')->checkbox(['label' => 'Лабораторная работа №4']) ?>

        <?= $form->field($model, 'lab5')->checkbox(['label' => 'Лабораторная работа №5']) ?>

        <?= $form->field($model, 'lab6')->checkbox(['label' => 'Лабораторная работа №6']) ?>

        <?= $form->field($model, 'lab7')->checkbox(['label' => 'Лабораторная работа №7']) ?>

        <?= $form->field($model, 'lab8')->checkbox(['label' => 'Лабораторная работа №8']) ?>
    <?php endif; ?>

    <hr>
    <label>Преподаватели:</label>

    <?= $form->field($model, 'teacher1_id')->dropDownList([$teacherList], ['prompt' => ''])->label(''); ?>

    <?= $form->field($model, 'teacher2_id')->dropDownList([$teacherList], ['prompt' => ''])->label(''); ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
