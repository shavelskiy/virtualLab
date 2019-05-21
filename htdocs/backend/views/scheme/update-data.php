<?php

/**
 * @var $scheme \common\models\Scheme
 */

$this->registerJsFile("@web/js/scheme.js");

$this->title = 'ЛР №' . $scheme->lab->id . '. ' . $scheme->lab->name;
$this->params['breadcrumbs'][] = ['label' => 'Лабораторные работы', 'url' => ['lab/index']];
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['lab/update', 'id' => $scheme->lab->id]];
$this->params['breadcrumbs'][] = 'Изменение данных схем для лабораторной работы';
?>

<div class="container-fluid">
    <form method="post" action="<?= \yii\helpers\Url::to(['scheme/save-data']) ?>" class="row">
        <div class="col">
            <canvas id="scheme" width="640" height="360" style="border: 1px solid black"></canvas>
            <div class="form-group">
                <button type="submit" class="btn btn-primary save-data">Сохранить</button>
            </div>
        </div>

        <input type="hidden" name="schemeId" value="<?= $scheme->id ?>">

        <div class="col">
            <div class="panel panel-default">
                <div class="panel-heading">Узлы</div>
                <div class="panel-body pre-scrollable" style="max-height: 700px">
                    <div class="container-fluid">
                        <ul class="list-group">
                            <?php /** @var \common\models\SchemeCircuit $circuit */ ?>
                            <?php foreach ($scheme->schemePoints as $pointOne): ?>
                                <?php foreach ($scheme->schemePoints as $pointTwo): ?>
                                    <?php if (intval($pointTwo->text) > intval($pointOne->text)): ?>
                                        <?php
                                        $key = $pointOne->id . '.' . $pointTwo->id;
                                        $schemeData = \common\models\SchemeData::find()->andWhere(['point1' => $pointOne->id, 'point2' => $pointTwo->id])->one();
                                        ?>

                                        <li class="list-group-item">
                                            <h6><?= $pointOne->text . ' - ' . $pointTwo->text ?></h6>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <?php if ($scheme->lab->signal == \common\models\Lab::SIGNAL_LINEAR): ?>
                                                                <div class="col">
                                                                    <input type="text" name="data[<?= $key ?>][cur_u]"
                                                                           class="form-control" placeholder="U"
                                                                           value="<?= ($schemeData) ? $schemeData->cur_u : '' ?>">
                                                                </div>
                                                                <div class="col">
                                                                    <input type="text" name="data[<?= $key ?>][cur_i]"
                                                                           class="form-control" placeholder="I"
                                                                           value="<?= ($schemeData) ? $schemeData->cur_i : '' ?>">
                                                                </div>
                                                                <div class="col">
                                                                    <input type="text" name="data[<?= $key ?>][cur_r]"
                                                                           class="form-control" placeholder="R"
                                                                           value="<?= ($schemeData) ? $schemeData->cur_r : '' ?>">
                                                                </div>
                                                            <?php elseif ($scheme->lab->signal == \common\models\Lab::SIGNAL_SINUSOIDAL): ?>
                                                                <div class="col">
                                                                    <input type="text" name="data[<?= $key ?>][re]"
                                                                           class="form-control" placeholder="Re"
                                                                           value="<?= ($schemeData) ? $schemeData->re : '' ?>">
                                                                </div>
                                                                <div class="col">
                                                                    <input type="text" name="data[<?= $key ?>][im]"
                                                                           class="form-control" placeholder="Im"
                                                                           value="<?= ($schemeData) ? $schemeData->im : '' ?>">
                                                                </div>
                                                            <?php elseif ($scheme->lab->signal == \common\models\Lab::SIGNAL_RECTANGLE): ?>
                                                                <div class="col">
                                                                    <input type="text" name="data[<?= $key ?>][first_front]"
                                                                           class="form-control" placeholder="Передний фронт"
                                                                           value="<?= ($schemeData) ? $schemeData->first_front : '' ?>">
                                                                </div>
                                                                <div class="col">
                                                                    <input type="text" name="data[<?= $key ?>][second_front]"
                                                                           class="form-control" placeholder="Задний фронт"
                                                                           value="<?= ($schemeData) ? $schemeData->second_front : '' ?>">
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!--для контуров-->
    <ul class="circuits-list hidden">
        <?php /** @var \common\models\SchemeCircuit $circuit */ ?>
        <?php foreach ($scheme->getSchemeCircuitsArray() as $parentId => $circuit): ?>
            <li class="circuits-list-item">
                <ul class="circuit-items">
                    <?php foreach ($circuit as $i => $point): ?>
                        <li>
                            <input type="text" class="circuit-x" value="<?= $point['x'] ?>">
                            <input type="text" class="circuit-y" value="<?= $point['y'] ?>">
                        </li>
                    <?php endforeach; ?>
                </ul>
            </li>
        <?php endforeach; ?>
    </ul>

    <!--для элементов-->
    <ul class="elements-list hidden">
        <?php /** @var \common\models\SchemeItem $schemeItem */ ?>
        <?php foreach ($scheme->schemeItems as $i => $schemeItem): ?>
            <li data-type="<?= $schemeItem->type ?>">
                <input type="text" class="item-name" value="<?= $schemeItem->name ?>">
                <input type="text" class="item-value" value="<?= $schemeItem->value ?>">
                <input type="text" class="item-x" value="<?= $schemeItem->x ?>">
                <input type="text" class="item-y" value="<?= $schemeItem->y ?>">
                <input type="checkbox" class="item-vertical" <?= $schemeItem->vertical ? 'checked' : '' ?>>
            </li>
        <?php endforeach; ?>
    </ul>

    <!--для узлов-->
    <ul class="point-list hidden">
        <?php /** @var \common\models\SchemeCircuit $circuit */ ?>
        <?php foreach ($scheme->schemePoints as $i => $point): ?>
            <li>
                <input type="text" class="point-text" value="<?= $point->text ?>">
                <input type="text" class="point-x" value="<?= $point->x ?>">
                <input type="text" class="point-y" value="<?= $point->y ?>">
                <input type="checkbox" class="point-vertical" <?= $point->vertical ? 'checked' : '' ?>>
                <input type="checkbox" class="point-reverse" <?= $point->reverse ? 'checked' : '' ?>>
            </li>
        <?php endforeach; ?>
    </ul>

    <!--для текста-->
    <ul class="text-list hidden">
        <?php /** @var \common\models\SchemeText $schemeText */ ?>
        <?php foreach ($scheme->schemeTexts as $i => $schemeText): ?>
            <li>
                <input type="text" class="text-value" value="<?= $schemeText->text ?>">
                <input type="text" class="text-x" value="<?= $schemeText->x ?>">
                <input type="text" class="text-y" value="<?= $schemeText->y ?>">
            </li>
        <?php endforeach; ?>
    </ul>
</div>
