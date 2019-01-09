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

    protected function buildList($items)
    {
        if (count($items) == 0) {
            return '';
        }
        $html = Html::beginTag('ul', ['class' => $this->wrapClass . '-list']);
        foreach ($items as $id => $item) {
            $html .= Html::tag('li', $this->buildListItem($item), ['class' => $this->wrapClass . '-item', 'data-id' => $id]);
        }
        $html .= Html::endTag('ul');
        return $html;
    }

    protected function buildListItem($item)
    {
        $html = '';
        $html .= Html::tag(($item['level'] == 1) ? 'h3' : 'p', $item['name']);
//        $html .= '<text class="form-control">' . $item['name'] . '</text>';
        if ($this->actions) {
            $html .= $this->buildActionButtons($item['id']);
        }
        if (count($item['children']) > 0) {
            $html .= $this->buildList($item['children']);
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