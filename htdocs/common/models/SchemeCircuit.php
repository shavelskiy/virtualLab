<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "schemes".
 *
 * @property int $id
 * @property boolean $is_start
 * @property int $parent
 * @property int $x
 * @property int $y
 * @property int $sort
 */
class SchemeCircuit extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'scheme_circuits';
    }
}