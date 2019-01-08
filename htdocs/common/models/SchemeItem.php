<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "schemes".
 *
 * @property int $id
 * @property string $type
 * @property string $name
 * @property string $value
 * @property int $x
 * @property int $y
 * @property boolean $vertical
 * @property boolean $direction
 *
 */
class SchemeItem extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'scheme_items';
    }
}