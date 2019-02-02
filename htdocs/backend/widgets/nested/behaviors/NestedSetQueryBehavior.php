<?php
/**
 * @project   Nested Set Plus
 * @author    Kirill Gladkiy <kirill.gladkiy@gmail.com>
 * @link      https://github.com/kgladkiy/yii2-nested-set-plus
 * @date      21.01.2015
 * @version   0.2
 */

namespace backend\widgets\nested\behaviors;

use yii\base\Behavior;
use yii\helpers\ArrayHelper;

class NestedSetQueryBehavior extends Behavior
{

    /**
     * @var ActiveQuery the owner of this behavior.
     */
    public $owner;

    /**
     * Gets root node(s).
     * @return ActiveRecord the owner.
     */
    public function roots($labId)
    {
        /** @var $modelClass ActiveRecord */
        $modelClass = $this->owner->modelClass;
        $model = new $modelClass;
        $this->owner->andWhere(['lab_id' => $labId])->andWhere($modelClass::getDb()->quoteColumnName($model->leftAttribute) . '=1');
        unset($model);
        return $this->owner;
    }

    public function tree($labId, $root = false, $maxLevel = false)
    {
        $tree = [];

        if ($root === false) {
            $ownerClass = $this->owner->modelClass;
            $items = $ownerClass::find()->roots($labId)->all();
        } else {
            if (!$maxLevel || $root->level <= $maxLevel) {
                $items = $root->children()->all();
            } else {
                return $tree;
            }
        }

        $num = 1;
        foreach ($items as $item) {
            $tree[$item->id] = [
                'id' => $item->id,
                'name' => $item->{$item->titleAttribute},
                'content' => $item->{$item->contentAttribute},
                'component' => $item->{$item->componentAttribute},
                'num' => $num,
                'level' => $item->{$item->levelAttribute},
                'children' => (!$maxLevel || $item->level < $maxLevel) ? $this->tree($labId, $item, $maxLevel) : null,
            ];
            $num++;
        }

        return $tree;

    }

    public function options($root = false, $maxLevel = false)
    {

        $tree = $this->tree($root, $maxLevel);

        $map = function($items, $parentName) use (&$map) {
            $results = [];
            foreach ($items as $item) {
                $results[$item['id']] = ($parentName) ? $parentName . ' -> ' . $item['name'] : $item['name'];
                if ($item['children']) {
                    $results += $map($item['children'], $results[$item['id']]);
                }
            }
            return $results;
        };

        return $map($tree, false);

    }
}
