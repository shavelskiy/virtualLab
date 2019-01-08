<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "schemes".
 *
 * @property int $id
 * @property int $number
 * @property int $variant
 *
 * @property SchemeItem[] $items
 * @property SchemeText[] $texts
 * @property SchemeCircuit[] $circuits
 */
class Scheme extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'schemes';
    }

    public function getItems()
    {
        return SchemeItem::find()->where(['scheme_id' => $this->id])->all();
    }

    public function getTexts()
    {
        return SchemeText::find()->where(['scheme_id' => $this->id])->all();
    }

    public function getCircuits()
    {
        return SchemeCircuit::find()->where(['scheme_id' => $this->id])->all();
    }
}