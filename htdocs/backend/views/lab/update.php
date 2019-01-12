<?php

/**
 * @var $lab \common\models\Lab
 */
?>

<?= backend\widgets\nested\widgets\NestedList::widget([
    'items' => \common\models\LabItems::find()->tree(),
    'actions' => false,
]); ?>

