<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "scheme_items".
 *
 * @property int $id
 * @property int $scheme_id
 * @property string $type
 * @property string $name
 * @property string $value
 * @property int $x
 * @property int $y
 * @property int $vertical
 * @property int $direction
 *
 * @property Scheme $scheme
 */
class SchemeItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'scheme_items';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['scheme_id', 'type'], 'required'],
            [['scheme_id', 'x', 'y'], 'integer'],
            [['vertical', 'direction'], 'boolean'],
            [['type', 'name', 'value'], 'string', 'max' => 255],
            [['scheme_id'], 'exist', 'skipOnError' => true, 'targetClass' => Scheme::className(), 'targetAttribute' => ['scheme_id' => 'id']],
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
            'type' => 'Type',
            'name' => 'Name',
            'value' => 'Value',
            'x' => 'X',
            'y' => 'Y',
            'vertical' => 'Vertical',
            'direction' => 'Direction',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScheme()
    {
        return $this->hasOne(Scheme::className(), ['id' => 'scheme_id']);
    }

    public static function saveData($data, $schemeId)
    {
        foreach ($data['save'] as $element) {
            $schemeItem = new SchemeItem();
            $schemeItem->scheme_id = $schemeId;
            $schemeItem->type = $element['element'];
            $schemeItem->name = $element['name'];
            $schemeItem->value = $element['value'];
            $schemeItem->x = $element['x'];
            $schemeItem->y = $element['y'];
            $schemeItem->vertical = $element['vertical'] == 'true';
            $schemeItem->direction = $element['direction'] == 'true';

            if ($schemeItem->validate()) {
                $schemeItem->save();
            }
        }

        foreach ($data['delete'] as $itemId) {
            $schemeItem = SchemeItem::findOne($itemId);
            $schemeItem->delete();
        }
    }
}
