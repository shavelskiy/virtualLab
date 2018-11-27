<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var common\models\Teacher $teacher
 * @var common\models\User $user
 */

$this->title = 'Изменить: ' . $teacher->last_name . ' ' . $teacher->name . ' ' . $teacher->middle_name;
$this->params['breadcrumbs'][] = ['label' => 'Преподаватели', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $teacher->last_name . ' ' . $teacher->name . ' ' . $teacher->middle_name, 'url' => ['view', 'id' => $teacher->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="teacher-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="teacher-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($teacher, 'last_name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($teacher, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($teacher, 'middle_name')->textInput(['maxlength' => true]) ?>

        <hr>

        <?= $form->field($user, 'username')->textInput() ?>

        <?= $form->field($user, 'email') ?>

        <hr>

        <?= $form->field($teacher, 'pulpit')->textInput(['maxlength' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
