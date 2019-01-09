<?php

/**
 * @var $lab \common\models\Lab
 */

//$result = [];
//
//$labItems = $lab->items;
//
//foreach ($labItems as $item) {
//    if ($item->is_parent) {
//        $result[$item->number] = [
//            'name' => $item->name,
//            'task' => []
//        ];
//    }
//}
//
//foreach ($labItems as $item) {
//    if (!$item->is_parent) {
//        $result[$item->parentItem->number]['task'][$item->number] = [
//            'name' => $item->name,
//            'content' => $item->content,
//            'component' => $item->component
//        ];
//    }
//}
?>

<?= backend\widgets\nested\widgets\NestedList::widget([
    'items' => \common\models\Test::find()->tree(),
    'actions' => false,
]); ?>

