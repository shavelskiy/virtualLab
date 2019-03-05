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

        <div class="col">
            <div class="panel panel-default">
                <div class="panel-heading">Узлы</div>
                <div class="panel-body">
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
                                                            <div class="col">
                                                                <input type="text" name="data[<?= $key ?>][cur_u]" class="form-control" placeholder="U" value="<?= ($schemeData) ? $schemeData->cur_u : '' ?>">
                                                            </div>
                                                            <div class="col">
                                                                <input type="text" name="data[<?= $key ?>][cur_i]" class="form-control" placeholder="I" value="<?= ($schemeData) ? $schemeData->cur_i : '' ?>">
                                                            </div>
                                                            <div class="col">
                                                                <input type="text" name="data[<?= $key ?>][cur_r]" class="form-control" placeholder="R" value="<?= ($schemeData) ? $schemeData->cur_r : '' ?>">
                                                            </div>
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
    <ul class="elements-list hidden">
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

    <!--для узлов-->
    <ul class="point-list hidden">
        <?php /** @var \common\models\SchemeCircuit $circuit */ ?>
        <?php foreach ($scheme->schemePoints as $point): ?>
            <li>
                <input type="text" id="point-text" value="<?= $point->text ?>">
                <input type="text" id="point-x" value="<?= $point->x ?>">
                <input type="text" id="point-y" value="<?= $point->y ?>">
                <input type="checkbox" id="point-vertical"<?= $point->vertical ? 'checked' : '' ?>>
            </li>
        <?php endforeach; ?>
    </ul>

    <!--для текста-->
    <ul class="text-list hidden">
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
