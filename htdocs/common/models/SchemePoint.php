<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "scheme_points".
 *
 * @property int $id
 * @property int $scheme_id
 * @property int $x
 * @property int $y
 * @property string $text
 * @property boolean $vertical
 */
class SchemePoint extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'scheme_points';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['scheme_id', 'x', 'y'], 'required'],
            [['scheme_id', 'x', 'y'], 'integer'],
            [['text'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'scheme_id' => 'Scheme ID',
            'x' => 'X',
            'y' => 'Y',
            'text' => 'Text',
        ];
    }
}
