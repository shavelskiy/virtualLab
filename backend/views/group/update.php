<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var array $teacherList
 * @var common\models\Group $group
 * @var common\models\GroupLabs $labs
 */

$this->title = 'Изменить группу: ' . $group->name;
$this->params['breadcrumbs'][] = ['label' => 'Группы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $group->name, 'url' => ['view', 'id' => $group->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="group-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'group' => $group,
        'labs' => $labs,
        'teacherList' => $teacherList,
        'update' => true
    ]) ?>

</div>
