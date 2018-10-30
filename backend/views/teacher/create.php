<?php

use yii\helpers\Html;


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

    <?= $this->render('_form', [
        'signUpForm' => $signUpForm,
        'teacher' => $teacher,
        'password' => true
    ]) ?>

</div>
