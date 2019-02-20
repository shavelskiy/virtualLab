<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "schemes".
 *
 * @property int $id
 * @property int $lab_id
 * @property int $number
 *
 * @property SchemeCircuit[] $schemeCircuits
 * @property SchemeItem[] $schemeItems
 * @property SchemeText[] $schemeTexts
 * @property Lab $lab
 */
class Scheme extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'schemes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lab_id', 'number'], 'required'],
            [['lab_id', 'number'], 'integer'],
            [['lab_id'], 'exist', 'skipOnError' => true, 'targetClass' => Lab::className(), 'targetAttribute' => ['lab_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'lab_id' => 'Lab ID',
            'number' => 'Number',
        ];
    }

    /**
     * @return array
     */
    public function getSchemeCircuits()
    {
        $circuits = [];
        /** @var SchemeCircuit $item */
        foreach ($this->hasMany(SchemeCircuit::className(), ['scheme_id' => 'id'])->all() as $item) {
            $circuits[$item->parent][$item->sort] = [
                'id' => $item->id,
                'x' => $item->x,
                'y' => $item->y
            ];
        }
        return $circuits;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSchemeItems()
    {
        return $this->hasMany(SchemeItem::className(), ['scheme_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSchemeTexts()
    {
        return $this->hasMany(SchemeText::className(), ['scheme_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLab()
    {
        return $this->hasOne(Lab::className(), ['id' => 'lab_id']);
    }
}
