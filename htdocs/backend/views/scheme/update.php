<?php

/**
 * @var $scheme \common\models\Scheme
 */

$this->registerJsFile("@web/js/scheme.js");

$this->title = 'ЛР №' . $scheme->lab->id . '. ' . $scheme->lab->name;
$this->params['breadcrumbs'][] = ['label' => 'Лабораторные работы', 'url' => ['lab/index']];
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['lab/update', 'id' => $scheme->lab->id]];
$this->params['breadcrumbs'][] = 'Изменение схем для лабораторной работы';
?>

<div class="container-fluid">

    <!--меню-->
    <ul class="nav nav-tabs mb-3">
        <li class="nav-item">
            <a class="active change-tab" data-tab="circuit">Цепь</a>
        </li>
        <li class="nav-item">
            <a class="change-tab" data-tab="element">Элементы</a>
        </li>
        <li class="nav-item">
            <a class="change-tab" data-tab="points">Узлы</a>
        </li>
        <li class="nav-item">
            <a class="change-tab" data-tab="text">Текст</a>
        </li>
    </ul>

    <!--Добавление контура-->
    <div class="circuits-setting">
        <div class="form-group">
            <button type="button" class="btn btn-primary circuit-add">Добавить</button>
        </div>
    </div>

    <!--Добавление элементов-->
    <div class="elements-setting hidden">
        <div class="form-group">
            <div class="row">
                <div class="col">
                    <label for="element-select">Выберите элемент</label>
                    <select id="element-select" class="form-control form-control-lg">
                        <option value="R">Резистор</option>
                        <option value="C">Конденсатор</option>
                        <option value="L">Катушка индуктивности</option>
                    </select>
                </div>
                <div class="col">
                    <label for="element-name">Название</label>
                    <input type="text" id="element-name" class="form-control" placeholder="Название">
                </div>
                <div class="col">
                    <label for="element-value">Значение</label>
                    <input type="text" id="element-value" class="form-control" placeholder="Значение">
                </div>
            </div>
        </div>
        <div class="form-check-inline">
            <label for="x-coordinate" class="col-3 col-form-label text-right">Координата по x:</label>
            <input type="text" id="x-coordinate" class="form-control col-2" placeholder="x">
            <label for="y-coordinate" class="col-3 col-form-label text-right">Координата по y:</label>
            <input type="text" id="y-coordinate" class="form-control col-2" placeholder="y">
            <label for="vertical" class="col-3 col-form-label text-right">Веритикально:</label>
            <input type="checkbox" id="vertical" class="form-check-input col-1">
        </div>
        <div class="form-group">
            <button type="button" class="btn btn-primary element-add">Добавить</button>
        </div>
    </div>

    <!--Добавление узла-->
    <div class="points-setting hidden">
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
                <div class="col">
                    <label for="point-vertical">Веритикально</label>
                    <input type="checkbox" id="point-vertical" class="form-control">
                </div>
                <div class="col">
                    <label for="point-vertical">Инверсия</label>
                    <input type="checkbox" id="point-reverse" class="form-control">
                </div>
            </div>
        </div>
        <div class="form-group">
            <button type="button" class="btn btn-primary point-add">Добавить</button>
        </div>
    </div>

    <!--Добавление текста-->
    <div class="texts-setting hidden">
        <div class="form-group">
            <div class="row">
                <div class="col">
                    <label for="text-value">Текст</label>
                    <input type="text" id="text-value" class="form-control" placeholder="Текст">
                </div>
                <div class="col">
                    <label for="text-x">Координата по x</label>
                    <input type="text" id="text-x" class="form-control" placeholder="x">
                </div>
                <div class="col">
                    <label for="text-y">Координата по y</label>
                    <input type="text" id="text-y" class="form-control" placeholder="y">
                </div>
            </div>
        </div>
        <div class="form-group">
            <button type="button" class="btn btn-primary text-add">Добавить</button>
        </div>
    </div>

    <div class="row">

        <div class="col">
            <canvas id="scheme" width="640" height="360" style="border: 1px solid black"></canvas>
            <button type="button" class="btn btn-primary mb-2 preview">Предосмотр</button>
        </div>

        <!--для контуров-->
        <div class="col circuits-panel">
            <div class="panel panel-default">
                <div class="panel-heading">Контура</div>
                <div class="panel-body">
                    <div class="container-fluid">
                        <ul class="list-group circuits-list">
                            <?php /** @var \common\models\SchemeCircuit $circuit */ ?>
                            <?php foreach ($scheme->getSchemeCircuitsArray() as $parentId => $circuit): ?>
                                <li class="list-group-item circuits-list-item">
                                    <ul class="list-group circuit-items ">
                                        <?php foreach ($circuit as $point): ?>
                                            <li class="list-group-item" data-id="<?= $point['id'] ?>">
                                                <div class="form-group row">
                                                    <label class="col-sm-1 offset-1 col-form-label mx-2 text-center">X:</label>
                                                    <input type="text" id="circuit-x" class="form-control col-sm-4 pl-2" placeholder="x" value="<?= $point['x'] ?>">
                                                    <label class="col-sm-1 col-form-label mx-2 text-center">Y:</label>
                                                    <input type="text" id="circuit-y" class="form-control col-sm-4 pl-2" placeholder="y" value="<?= $point['y'] ?>">
                                                </div>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                    <button type="button" class="btn-sm btn-primary circuit-point-add">Добавить точку</button>
                                    <button type="button" class="btn-sm btn-danger circuit-remove" data-parent-id="<?= $parentId ?>">Удалить</button>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!--для элементов-->
        <div class="col elements-panel hidden">
            <div class="panel panel-default">
                <div class="panel-heading">Элементы</div>
                <div class="panel-body">
                    <div class="container-fluid">
                        <ul class="list-group elements-list">
                            <?php /** @var \common\models\SchemeItem $schemeItem */ ?>
                            <?php foreach ($scheme->schemeItems as $schemeItem): ?>
                                <li class="list-group-item" data-type="<?= $schemeItem->type ?>">
                                    <div class="row">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label ml-2 text-center">Название:</label>
                                            <input type="text" id="item-name" class="form-control col-sm-2" placeholder="Название" value="<?= $schemeItem->name ?>">
                                            <label class="col-sm-3 col-form-label text-center">Значение:</label>
                                            <input type="text" id="item-value" class="form-control col-sm-3" placeholder="Значение" value="<?= $schemeItem->value ?>">
                                        </div>
                                        <div class="form-check-inline row">
                                            <label class="col-sm-1 ml-4 px-0 col-form-label text-center">X:</label>
                                            <input type="text" id="item-x" class="form-control col-sm-2" placeholder="x" value="<?= $schemeItem->x ?>">
                                            <label class="col-sm-1 col-form-label text-center">Y:</label>
                                            <input type="text" id="item-y" class="form-control col-sm-2" placeholder="y" value="<?= $schemeItem->y ?>">
                                            <label class="col-sm form-check-label pr-2">Веритикально:</label>
                                            <input type="checkbox" id="item-vertical" class="form-check-input col-sm" <?= $schemeItem->vertical ? 'checked' : '' ?>
                                        </div>

                                        <button type="button" class="btn-sm btn-danger ml-5 mt-3 element-remove" data-id="<?= $schemeItem->id ?>">Удалить</button>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!--для узлов-->
        <div class="col points-panel hidden">
            <div class="panel panel-default">
                <div class="panel-heading">Узлы</div>
                <div class="panel-body">
                    <div class="container-fluid">
                        <ul class="list-group point-list">
                            <?php /** @var \common\models\SchemeCircuit $circuit */ ?>
                            <?php foreach ($scheme->schemePoints as $point): ?>
                                <li class="list-group-item" data-id="<?= $point->id ?>">
                                    <div class="form-group row">
                                        <label class="col-sm-2 px-0 ml-4 col-form-label text-center">Номер:</label>
                                        <input type="text" id="point-text" class="form-control col-sm-2" placeholder="Номер" value="<?= $point->text ?>">
                                        <label class="col-sm-1 px-0 ml-3 col-form-label text-center">X:</label>
                                        <input type="text" id="point-x" class="form-control col-sm-2" placeholder="x" value="<?= $point->x ?>">
                                        <label class="col-sm-1 px-0 ml-3 col-form-label text-center">Y:</label>
                                        <input type="text" id="point-y" class="form-control col-sm-2" placeholder="y" value="<?= $point->y ?>">
                                    </div>
                                    <div class="form-check-inline row mb-4">
                                        <label class="col-sm form-check-label pr-2">Веритикально:</label>
                                        <input type="checkbox" id="point-vertical" class="form-check-input col-sm" <?= $point->vertical ? 'checked' : '' ?>>
                                        <label class="col-sm form-check-label pr-2">Инверсия:</label>
                                        <input type="checkbox" id="point-reverse" class="form-check-input col-sm" <?= $point->reverse ? 'checked' : '' ?>>
                                    </div>
                                    <button type="button" class="btn-sm btn-danger point-remove" data-id="<?= $point->id ?>">Удалить</button>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!--для текста-->
        <div class="col texts-panel hidden">
            <div class="panel panel-default">
                <div class="panel-heading">Элементы</div>
                <div class="panel-body">
                    <div class="container-fluid">
                        <ul class="list-group text-list">
                            <?php /** @var \common\models\SchemeText $schemeText */ ?>
                            <?php foreach ($scheme->schemeTexts as $schemeText): ?>
                                <li class="list-group-item">
                                    <div class="form-group row">
                                        <label class="col-sm-2 px-0 ml-4 col-form-label text-center">Текст:</label>
                                        <input type="text" id="text-value" class="form-control col-sm-2" placeholder="Текст" value="<?= $schemeText->text ?>">
                                        <label class="col-sm-1 px-0 ml-3 col-form-label text-center">X:</label>
                                        <input type="text" id="text-x" class="form-control col-sm-2" placeholder="x" value="<?= $schemeText->x ?>">
                                        <label class="col-sm-1 px-0 ml-3 col-form-label text-center">Y:</label>
                                        <input type="text" id="text-y" class="form-control col-sm-2" placeholder="y" value="<?= $schemeText->y ?>">
                                    </div>
                                    <button type="button" class="btn-sm btn-danger text-remove" data-id="<?= $schemeText->id ?>">Удалить</button>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <button type="button" class="btn btn-primary save">Сохранить</button>
    </div>
</div>
