<?php
/**
 * @project   Nested Set Plus
 * @author    Kirill Gladkiy <kirill.gladkiy@gmail.com>
 * @link      https://github.com/kgladkiy/yii2-nested-set-plus
 * @date      21.01.2015
 * @version   0.2
 */

namespace backend\widgets\nested\widgets;

use common\models\Component;
use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;


class NestedList extends Widget
{

    public $items = null;

    public $maxDepth = 2;

    public $wrapClass = 'nested';

    public $actions = false;

    public $components = [];

    public function run()
    {
        $this->getComponents();
        $this->registerAssets();
        $this->renderInput();
    }

    protected function renderInput()
    {
        echo Html::tag('div', $this->buildList($this->items), ['class' => $this->wrapClass]);
    }

    protected function buildList($items, $parentNum = null, $parentName = null)
    {
        $html = '';

        $html .= Html::beginTag('ul', ['class' => $this->wrapClass . '-list', 'data-count' => count($items)]);
        foreach ($items as $id => $item) {

            if ($parentNum) {
                $content = $this->buildSecondLevelItem($item, $parentNum, $parentName);
            } else {
                $content = $this->buildFirstLevelItem($item);
            }

            $html .= Html::tag('li',
                Html::button('Восстановить', ['class' => 'btn btn-warning restore-item hidden']) .
                Html::tag('div', $content, ['class' => 'item']),
                ['class' => $this->wrapClass . '-item', 'data-num' => $item['num']]
            );
        }

        if ($parentNum) {
            $html .= Html::button('Добавить задание', ['class' => 'btn btn-success mb-3 mt-2 new-item']);
        } else {
            $html .= Html::button('Добавить задание', ['class' => 'btn btn-success mb-3 mt-2 new-task']);
        }

        $html .= Html::endTag('ul');
        return $html;
    }

    protected function buildFirstLevelItem($item)
    {
        $html = '';
        $name = 'task[old][' . $item['id'] . ']';

        $html .= Html::beginTag('h3', ['class' => 'show-label']);
        $html .= Html::tag('b', $item['num'] . '. ', ['class' => 'number']) . $item['name'];
        $html .= Html::endTag('h3');

        $html .= Html::button('Панель редактирования', ['class' => 'btn btn-info mb-3 mt-2 show-settings']);

        // блок изменения данных о работе
        $html .= Html::beginTag('div', ['class' => 'hidden settings']);
        $html .= Html::tag('textarea', $item['name'], ['class' => 'form-control mt-2 new-label-input', 'name' => $name . '[name]']); // имя заголовка

        $html .= Html::button('Предосмотр', ['class' => 'btn btn-primary mb-3 mt-2 preview']);
        $html .= Html::button('Удалить', ['class' => 'btn btn-danger mb-3 mt-2 ml-2 delete-item']);
        $html .= Html::endTag('div');

        if (count($item['children']) > 0) {
            $html .= $this->buildList($item['children'], $item['num'], $name . '[items][old]');
        }

        $html .= Html::tag('hr');

        return $html;
    }

    protected function buildSecondLevelItem($item, $parentNum, $parentName)
    {
        $name = $parentName . '[' . $item['id'] . ']';
        $html = '';

        $html .= Html::beginTag('p', ['class' => 'show-label']);
        $html .= Html::tag('b', $parentNum . '.' . $item['num'] . ' ', ['class' => 'number']) . $item['name'];
        $html .= Html::endTag('p');

        $html .= Html::tag('div', $item['content'], ['class' => 'content']);
        $html .= Html::button('Панель редактирования', ['class' => 'btn btn-info mb-3 mt-2 show-settings']);

        // блок изменения данных о работе
        $html .= Html::beginTag('div', ['class' => 'hidden settings']);
        $html .= Html::tag('textarea', $item['name'], ['class' => 'form-control mt-2 new-label-input', 'name' => $name . '[name]']); // имя заголовка
        $html .= Html::tag('textarea', $item['content'], ['class' => 'form-control mt-2 new-content-input', 'name' => $name . '[content]']); // контент

        // блок с выбором компонента
        $html .= Html::beginTag('select', ['class' => 'form-control mt-2', 'name' => $name . '[component]']);
        $html .= Html::tag('option', '');
        foreach ($this->components as $id => $component) {
            $options = [
                'value' => $id,
            ];
            if ($item['component'] == $component) {
                $options['selected'] = 'selected';
            }
            $html .= Html::tag('option', $component, $options);
        }
        $html .= Html::endTag('select');

        $html .= Html::button('Предосмотр', ['class' => 'btn btn-primary mb-3 mt-2 preview']);
        $html .= Html::button('Удалить', ['class' => 'btn btn-danger mb-3 mt-2 ml-2 delete-item']);
        $html .= Html::endTag('div');

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

    public function getComponents()
    {
        $components = Component::find()->all();
        $this->components = ArrayHelper::map($components, 'id', 'name');
    }
}
