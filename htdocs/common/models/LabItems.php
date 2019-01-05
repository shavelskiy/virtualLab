<?php
/**
 * Created by PhpStorm.
 * User: vladislav
 * Date: 05.01.2019
 * Time: 23:57
 */

namespace common\models;

use Yii;

/**
 * This is the model class for table "lab_balls".
 *
 * @property int $id
 * @property boolean $is_parent
 * @property integer $parent
 * @property integer $number
 * @property string $name
 * @property string $content
 * @property string $component
 *
 * @property LabItems $parentItem
 */
class LabItems extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lab_items';
    }

    /**
     * @return LabItems|null
     */
    public function getParentItem()
    {
        return LabItems::findOne($this->parent);
    }
}