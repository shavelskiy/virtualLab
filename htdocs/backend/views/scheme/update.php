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
        <div class="form-check-inline">
            <label for="point-text" class="col-1 col-form-label text-right">Номер:</label>
            <input type="text" id="point-text" class="form-control col" placeholder="Номер">
            <label for="point-x" class="col col-form-label text-right">Координата по x:</label>
            <input type="text" id="point-x" class="form-control col" placeholder="x">
            <label for="point-y" class="col col-form-label text-right">Координата по y:</label>
            <input type="text" id="point-y" class="form-control col" placeholder="y">
            <label for="point-vertical" class="col col-form-label text-right">Веритикально:</label>
            <input type="checkbox" id="point-vertical" class="form-check-input">
            <label for="point-reverse" class="col col-form-label text-right">Инверсия:</label>
            <input type="checkbox" id="point-reverse" class="form-check-input">
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
            <div class="form-group">
                <button type="button" class="btn btn-primary save">Сохранить</button>
            </div>
        </div>

        <!--для контуров-->
        <div class="col circuits-panel">
            <div class="panel panel-default">
                <div class="panel-heading">Контура</div>
                <div class="panel-body pre-scrollable" style="max-height: 600px">
                    <div class="container-fluid">
                        <ul class="list-group circuits-list">
                            <?php /** @var \common\models\SchemeCircuit $circuit */ ?>
                            <?php foreach ($scheme->getSchemeCircuitsArray() as $parentId => $circuit): ?>
                                <li class="list-group-item circuits-list-item">
                                    <ul class="list-group circuit-items ">
                                        <?php foreach ($circuit as $i => $point): ?>
                                            <li class="list-group-item" data-id="<?= $point['id'] ?>">
                                                <div class="form-group row">
                                                    <label for="circuit-x-<?= $parentId ?>-<?= $i ?>" class="col-sm-1 offset-1 col-form-label mx-2 text-center">X:</label>
                                                    <input type="text" id="circuit-x-<?= $parentId ?>-<?= $i ?>" class="form-control col-sm-4 pl-2 circuit-x" placeholder="x" value="<?= $point['x'] ?>">
                                                    <label for="circuit-y-<?= $parentId ?>-<?= $i ?>" class="col-sm-1 col-form-label mx-2 text-center">Y:</label>
                                                    <input type="text" id="circuit-y-<?= $parentId ?>-<?= $i ?>" class="form-control col-sm-4 pl-2 circuit-y" placeholder="y" value="<?= $point['y'] ?>">
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
                <div class="panel-body pre-scrollable" style="max-height: 480px">
                    <div class="container-fluid">
                        <ul class="list-group elements-list">
                            <?php /** @var \common\models\SchemeItem $schemeItem */ ?>
                            <?php foreach ($scheme->schemeItems as $i => $schemeItem): ?>
                                <li class="list-group-item" data-type="<?= $schemeItem->type ?>">
                                    <div class="row">
                                        <div class="form-group row">
                                            <label for="item-name-<?= $i ?>" class="col-sm-3 col-form-label ml-2 text-center">Название:</label>
                                            <input type="text" id="item-name-<?= $i ?>" class="form-control col-sm-2 item-name" placeholder="Название" value="<?= $schemeItem->name ?>">
                                            <label for="item-value-<?= $i ?>" class="col-sm-3 col-form-label text-center">Значение:</label>
                                            <input type="text" id="item-value-<?= $i ?>" class="form-control col-sm-3 item-value" placeholder="Значение" value="<?= $schemeItem->value ?>">
                                        </div>
                                        <div class="form-check-inline row">
                                            <label for="item-x-<?= $i ?>" class="col-sm-1 ml-4 px-0 col-form-label text-center">X:</label>
                                            <input type="text" id="item-x-<?= $i ?>" class="form-control col-sm-2 item-x" placeholder="x" value="<?= $schemeItem->x ?>">
                                            <label for="item-y-<?= $i ?>" class="col-sm-1 col-form-label text-center">Y:</label>
                                            <input type="text" id="item-y-<?= $i ?>" class="form-control col-sm-2 item-y" placeholder="y" value="<?= $schemeItem->y ?>">
                                            <label for="item-vertical-<?= $i ?>" class="col-sm form-check-label pr-2">Веритикально:</label>
                                            <input type="checkbox" id="item-vertical-<?= $i ?>" class="form-check-input col-sm item-vertical" <?= $schemeItem->vertical ? 'checked' : '' ?>>
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
                <div class="panel-body pre-scrollable" style="max-height: 540px">
                    <div class="container-fluid">
                        <ul class="list-group point-list">
                            <?php /** @var \common\models\SchemeCircuit $circuit */ ?>
                            <?php foreach ($scheme->schemePoints as $i => $point): ?>
                                <li class="list-group-item" data-id="<?= $point->id ?>">
                                    <div class="form-group row">
                                        <label for="point-text-<?= $i ?>" class="col-sm-2 px-0 ml-4 col-form-label text-center">Номер:</label>
                                        <input type="text" id="point-text-<?= $i ?>" class="form-control col-sm-2 point-text" placeholder="Номер" value="<?= $point->text ?>">
                                        <label for="point-x-<?= $i ?>" class="col-sm-1 px-0 ml-3 col-form-label text-center">X:</label>
                                        <input type="text" id="point-x-<?= $i ?>" class="form-control col-sm-2 point-x" placeholder="x" value="<?= $point->x ?>">
                                        <label for="point-y-<?= $i ?>" class="col-sm-1 px-0 ml-3 col-form-label text-center">Y:</label>
                                        <input type="text" id="point-y-<?= $i ?>" class="form-control col-sm-2 point-y" placeholder="y" value="<?= $point->y ?>">
                                    </div>
                                    <div class="form-check-inline row mb-4">
                                        <label for="point-vertical-<?= $i ?>" class="col-sm form-check-label pr-2">Веритикально:</label>
                                        <input type="checkbox" id="point-vertical-<?= $i ?>" class="form-check-input col-sm point-vertical" <?= $point->vertical ? 'checked' : '' ?>>
                                        <label for="point-reverse-<?= $i ?>" class="col-sm form-check-label pr-2">Инверсия:</label>
                                        <input type="checkbox" id="point-reverse-<?= $i ?>" class="form-check-input col-sm point-reverse" <?= $point->reverse ? 'checked' : '' ?>>
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
                <div class="panel-body pre-scrollable" style="max-height: 520px">
                    <div class="container-fluid">
                        <ul class="list-group text-list">
                            <?php /** @var \common\models\SchemeText $schemeText */ ?>
                            <?php foreach ($scheme->schemeTexts as $i => $schemeText): ?>
                                <li class="list-group-item">
                                    <div class="form-group row">
                                        <label for="text-value-<?= $i ?>" class="col-sm-2 px-0 ml-4 col-form-label text-center">Текст:</label>
                                        <input type="text" id="text-value-<?= $i ?>" class="form-control col-sm-2 text-value" placeholder="Текст" value="<?= $schemeText->text ?>">
                                        <label for="text-x-<?= $i ?>" class="col-sm-1 px-0 ml-3 col-form-label text-center">X:</label>
                                        <input type="text" id="text-x-<?= $i ?>" class="form-control col-sm-2 text-x" placeholder="x" value="<?= $schemeText->x ?>">
                                        <label for="text-y-<?= $i ?>" class="col-sm-1 px-0 ml-3 col-form-label text-center">Y:</label>
                                        <input type="text" id="text-y-<?= $i ?>" class="form-control col-sm-2 text-y" placeholder="y" value="<?= $schemeText->y ?>">
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
</div>
