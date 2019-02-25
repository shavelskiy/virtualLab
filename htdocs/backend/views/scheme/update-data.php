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

    <!--Добавление текста-->
    <div class="points-setting">
        <div class="form-group">
            <div class="row">
                <div class="col">
                    <label for="text-value">Текст</label>
                    <input type="text" id="point-text" class="form-control" placeholder="Текст">
                </div>
                <div class="col">
                    <label for="text-x">Координата по x</label>
                    <input type="text" id="point-x" class="form-control" placeholder="x">
                </div>
                <div class="col">
                    <label for="text-y">Координата по y</label>
                    <input type="text" id="point-y" class="form-control" placeholder="y">
                </div>
            </div>
        </div>
        <div class="form-group">
            <button type="button" class="btn btn-primary point-add">Добавить</button>
            <button type="button" class="btn-sm btn-primary preview">Предосмотр</button>
        </div>
    </div>

    <div class="row">

        <div class="col">
            <canvas id="scheme" width="640" height="360" style="border: 1px solid black"></canvas>
        </div>

        <!--для узлов-->
        <div class="col point-panel">
            <div class="panel panel-default">
                <div class="panel-heading">Узлы</div>
                <div class="panel-body">
                    <div class="container-fluid">
                        <ul class="list-group point-list">
                            <?php /** @var \common\models\SchemeCircuit $circuit */ ?>
                            <?php foreach ($scheme->schemePoints as $point): ?>
                                <li class="list-group-item" data-id="<?= $point->id ?>">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" id="point-text" class="form-control" placeholder="x" value="<?= $point->text ?>">
                                            </div>
                                            <div class="col">
                                                <input type="text" id="point-x" class="form-control" placeholder="y" value="<?= $point->x ?>">
                                            </div>
                                            <div class="col">
                                                <input type="text" id="point-y" class="form-control" placeholder="y" value="<?= $point->y ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn-sm btn-danger point-remove" data-id="<?= $point->id ?>">Удалить</button>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!--для контуров-->
        <ul class="hidden circuits-list">
            <?php /** @var \common\models\SchemeCircuit $circuit */ ?>
            <?php foreach ($scheme->schemeCircuits as $parentId => $circuit): ?>
                <li class="circuits-list-item">
                    <ul class="circuit-items">
                        <?php foreach ($circuit as $point): ?>
                            <li>
                                <input type="text" id="circuit-x" value="<?= $point['x'] ?>">
                                <input type="text" id="circuit-y" value="<?= $point['y'] ?>">
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
            <?php endforeach; ?>
        </ul>

        <!--для элементов-->
        <ul class="hidden elements-list">
            <?php /** @var \common\models\SchemeItem $schemeItem */ ?>
            <?php foreach ($scheme->schemeItems as $schemeItem): ?>
                <li
                    data-type="<?= $schemeItem->type ?>"
                    data-name="<?= $schemeItem->name ?>"
                    data-value="<?= $schemeItem->value ?>"
                    data-x="<?= $schemeItem->x ?>"
                    data-y="<?= $schemeItem->y ?>"
                    data-vertical="<?= $schemeItem->vertical ? 'true' : 'false' ?>"
                    data-direction="<?= $schemeItem->direction ? 'true' : 'false' ?>">
                </li>
            <?php endforeach; ?>
        </ul>

        <!--текст-->
        <ul class="hidden text-list">
            <?php /** @var \common\models\SchemeText $schemeText */ ?>
            <?php foreach ($scheme->schemeTexts as $schemeText): ?>
                <li
                    data-value="<?= $schemeText->text ?>"
                    data-x="<?= $schemeText->x ?>"
                    data-y="<?= $schemeText->y ?>">
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="form-group">
        <button type="button" class="btn btn-primary save">Сохранить</button>
    </div>
</div>
