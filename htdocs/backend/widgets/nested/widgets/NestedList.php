<?php
/**
 * @project   Nested Set Plus
 * @author    Kirill Gladkiy <kirill.gladkiy@gmail.com>
 * @link      https://github.com/kgladkiy/yii2-nested-set-plus
 * @date      21.01.2015
 * @version   0.2
 */

namespace backend\widgets\nested\widgets;

use yii\base\Widget;
use yii\helpers\Html;


class NestedList extends Widget
{

    public $items = null;

    public $maxDepth = 4;

    public $wrapClass = 'nested';

    public $actions = true;

    public function run()
    {
        $this->registerAssets();
        $this->renderInput();
    }

    protected function renderInput()
    {
        if (count($this->items) > 0) {
            echo Html::tag('div', $this->buildList($this->items), ['class' => $this->wrapClass]);
        }
    }

    protected function buildList($items, $parentNum = null)
    {
        if (count($items) == 0) {
            return '';
        }
        $html = Html::beginTag('ul', ['class' => $this->wrapClass . '-list']);
        foreach ($items as $id => $item) {
            $html .= Html::tag('li', $this->buildListItem($item, $parentNum), ['class' => $this->wrapClass . '-item', 'data-id' => $id]);
        }
        $html .= Html::endTag('ul');
        return $html;
    }

    protected function buildListItem($item, $parentNum = null)
    {
        $html = '';

        if ($item['level'] == 1) {
            $tag = 'h3';
            $num = $item['num'] . '.';
        } else {
            $tag = 'p';
            $num = Html::tag('b', $parentNum . '.' . $item['num']);
        }
        $html .= Html::tag($tag, $num . ' ' . $item['name']);

        $html .= Html::tag('textarea', $item['name'], ['class' => 'form-control']);
        $html .= Html::button('Предосмотр', ['class' => 'btn btn-primary mb-3 mt-2']);
        if (count($item['children']) > 0) {
            $html .= $this->buildList($item['children'], $item['num']);
        }
        return $html;
    }

    /**
     * Registers the needed assets
     */
    public function registerAssets()
    {

        $view = $this->getView();

        NestedListAsset::register($view);
        $js = "$('." . $this->wrapClass . "').nestable({'maxDepth':" . $this->maxDepth . "});";
        $view->registerJs($js);

    }
}