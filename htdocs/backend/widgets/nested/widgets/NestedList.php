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
        echo Html::tag('div', $this->buildList($this->items), ['class' => $this->wrapClass]);
    }

    protected function buildList($items, $parentNum = null)
    {
        $html = '';

        if (count($items) != 0) {
            $html = Html::beginTag('ul', ['class' => $this->wrapClass . '-list', 'data-count' => count($items)]);
            foreach ($items as $id => $item) {
                $html .= Html::tag('li',
                    Html::button('Восстановить', ['class' => 'btn btn-warning restore-item hidden']) .
                    Html::tag('div', $this->buildListItem($item, $parentNum), ['class' => 'item']),
                    ['class' => $this->wrapClass . '-item', 'data-id' => $id, 'data-num' => $item['num']]
                );
            }
        }

        if ($parentNum) {
            $html .= Html::button('Добавить задание', ['class' => 'btn btn-success mb-3 mt-2 new-item']);
        } else {
            $html .= Html::button('Добавить задание', ['class' => 'btn btn-success mb-3 mt-2 new-task']);
        }

        $html .= Html::endTag('ul');
        return $html;
    }

    protected function buildListItem($item, $parentNum = null)
    {
        $html = '';

        if ($item['level'] == 1) {
            $tag = 'h3';
            $num = $item['num'] . '. ';
        } else {
            $tag = 'p';
            $num = $parentNum . '.' . $item['num'] . ' ';
        }
        $num = Html::tag('b', $num . ' ', ['class' => 'number']);

        $html .= Html::tag($tag, $num . $item['name'], ['class' => 'show-label']);

        if ($item['level'] == 2) {
            $html .= Html::tag('div', $item['content'], ['class' => 'content']);
        }

        $html .= Html::button('Панель редактирования', ['class' => 'btn btn-info mb-3 mt-2 show-settings']);

        // блок изменения данных о работе
        $html .= Html::beginTag('div', ['class' => 'hidden settings']);
        $html .= Html::tag('textarea', $item['name'], ['class' => 'form-control mt-2 new-label-input']);
        if ($item['level'] == 2) {
            $html .= Html::tag('textarea', $item['content'], ['class' => 'form-control mt-2 new-content-input']);
        }
        $html .= Html::button('Предосмотр', ['class' => 'btn btn-primary mb-3 mt-2 preview']);
        $html .= Html::button('Удалить', ['class' => 'btn btn-danger mb-3 mt-2 ml-2 delete-item']);

        $html .= Html::endTag('div');

        if (count($item['children']) > 0) {
            $html .= $this->buildList($item['children'], $item['num']);
        }

        if ($item['level'] == 1) {
            $html .= Html::tag('hr');
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
