<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "schemes".
 *
 * @property int $id
 * @property string $text
 * @property int $x
 * @property int $y
 *
 */
class SchemeText extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'scheme_texts';
    }
}