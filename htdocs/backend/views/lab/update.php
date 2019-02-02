<?php

/**
 * @var $lab \common\models\Lab
 */

$this->title = 'ЛР №' . $lab->id . '. ' . $lab->name;
?>

<?= backend\widgets\nested\widgets\NestedList::widget([
    'items' => \common\models\LabItems::find()->tree($lab->id),
    'actions' => false,
]); ?>

