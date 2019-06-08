<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View
 * @var bool $update
 * @var array $teacherList
 * @var $form yii\widgets\ActiveForm
 * @var common\models\Group $group
 * @var common\models\GroupLabs $labs
 */
?>

<div class="group-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($group, 'name')->textInput(['maxlength' => true]) ?>

    <?php if ($update): ?>
        <hr>
        <?= $form->field($labs, 'lab1')->checkbox(['label' => 'Лабораторная работа №1']) ?>

        <?= $form->field($labs, 'lab2')->checkbox(['label' => 'Лабораторная работа №2']) ?>

        <?= $form->field($labs, 'lab3')->checkbox(['label' => 'Лабораторная работа №3']) ?>

        <?= $form->field($labs, 'lab4')->checkbox(['label' => 'Лабораторная работа №4']) ?>

        <?= $form->field($labs, 'lab5')->checkbox(['label' => 'Лабораторная работа №5']) ?>

        <?= $form->field($labs, 'lab6')->checkbox(['label' => 'Лабораторная работа №6']) ?>

        <?= $form->field($labs, 'lab7')->checkbox(['label' => 'Лабораторная работа №7']) ?>
    <?php endif; ?>

    <hr>
    <label>Преподаватели:</label>

    <?= $form->field($group, 'teacher1_id')->dropDownList($teacherList, ['prompt' => '', 'label' => 'sfd'])->label('') ?>

    <?= $form->field($group, 'teacher2_id')->dropDownList($teacherList, ['prompt' => ''])->label(''); ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
