<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "lab".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $preview_picture
 */
class Lab extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lab';
    }
}