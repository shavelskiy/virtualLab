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

    public static function saveData($data, $schemeId)
    {
        foreach ($data['save'] as $point) {
            if (isset($point['id'])) {
                $schemePoint = SchemePoint::findOne($point['id']);
            } else {
                $schemePoint = new SchemePoint();
                $schemePoint->scheme_id = $schemeId;
            }

            $schemePoint->text = $point['text'];
            $schemePoint->x = $point['x'];
            $schemePoint->y = $point['y'];
            $schemePoint->vertical = $point['vertical'] == 'true';

            if ($schemePoint->validate()) {
                $schemePoint->save();
            }
        }

        foreach ($data['delete'] as $pointId) {
            $schemePoint = SchemePoint::findOne($pointId);
            $schemePoint->delete();
        }
    }
}
