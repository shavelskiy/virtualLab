<?php

/**
 * @var $lab \common\models\Lab
 */

$result = [];

$labItems = $lab->items;

foreach ($labItems as $item) {
    if ($item->is_parent) {
        $result[$item->number] = [
            'name' => $item->name,
            'task' => []
        ];
    }
}

foreach ($labItems as $item) {
    if (!$item->is_parent) {
        $result[$item->parentItem->number]['task'][$item->number] = [
            'name' => $item->name,
            'content' => $item->content,
            'component' => $item->component
        ];
    }
}
?>
<?php foreach ($result as $task): ?>
    <div class="container mb-5">
        <h3><?= $task['name']; ?></h3>
<!--        --><?// var_dump($task); ?>
    </div>
<?php endforeach; ?>
