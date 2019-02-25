<?php

/**
 * @var $scheme \common\models\Scheme
 */

$this->registerJsFile("@web/js/schemeData.js");

$this->title = 'ЛР №' . $scheme->lab->id . '. ' . $scheme->lab->name;
$this->params['breadcrumbs'][] = ['label' => 'Лабораторные работы', 'url' => ['lab/index']];
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['lab/update', 'id' => $scheme->lab->id]];
$this->params['breadcrumbs'][] = 'Изменение данных схем для лабораторной работы';
?>

<div class="container-fluid">

</div>
