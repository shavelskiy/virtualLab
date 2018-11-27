<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var common\models\Teacher $teacher
 * @var backend\models\SignupForm $signUpForm
 */

$this->title = 'Добавить преподавателя';
$this->params['breadcrumbs'][] = ['label' => 'Преподаватели', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teacher-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="teacher-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($teacher, 'last_name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($teacher, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($teacher, 'middle_name')->textInput(['maxlength' => true]) ?>

        <hr>

        <?= $form->field($signUpForm, 'username')->textInput() ?>

        <?= $form->field($signUpForm, 'email') ?>

        <?= $form->field($signUpForm, 'password')->passwordInput(); ?>

        <hr>

        <?= $form->field($teacher, 'pulpit')->textInput(['maxlength' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
