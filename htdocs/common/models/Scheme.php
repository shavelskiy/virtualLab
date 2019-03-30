<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "schemes".
 *
 * @property int $id
 * @property int $lab_id
 * @property boolean $changeable_r
 * @property boolean $changeable_c
 *
 * @property SchemeCircuit[] $schemeCircuits
 * @property SchemeItem[] $schemeItems
 * @property SchemeText[] $schemeTexts
 * @property SchemePoint[] $schemePoints
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
            [['lab_id'], 'exist', 'skipOnError' => true, 'targetClass' => Lab::className(), 'targetAttribute' => ['lab_id' => 'id']],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSchemeCircuits()
    {
        return $this->hasMany(SchemeCircuit::className(), ['scheme_id' => 'id']);
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
    public function getSchemePoints()
    {
        return $this->hasMany(SchemePoint::className(), ['scheme_id' => 'id'])->orderBy(['text' => SORT_ASC]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLab()
    {
        return $this->hasOne(Lab::className(), ['id' => 'lab_id']);
    }

    /**
     * @return array
     */
    public function getSchemeCircuitsArray()
    {
        $circuits = [];
        foreach ($this->schemeCircuits as $item) {
            $circuits[$item->parent][$item->sort] = [
                'id' => $item->id,
                'x' => $item->x,
                'y' => $item->y
            ];
        }
        return $circuits;
    }

    /**
     * @return array
     */
    public function getSchemeItemsArray()
    {
        $result = [];
        foreach ($this->schemeItems as $schemeItem) {
            $result[] = [
                'type' => $schemeItem->type,
                'name' => $schemeItem->name,
                'x' => $schemeItem->x,
                'y' => $schemeItem->y,
                'vertical' => $schemeItem->vertical,
            ];
        }

        return $result;
    }

    /**
     * @return array
     */
    public function getSchemeDataArray()
    {
        $result = [];
        foreach ($this->schemeItems as $schemeItem) {
            if ($schemeItem->value) {
                $result[] = [
                    'name' => $schemeItem->name,
                    'value' => $schemeItem->value
                ];
            }
        }

        return $result;
    }

    /**
     * @return array
     */
    public function getSchemeTextsArray()
    {
        $result = [];
        foreach ($this->schemeTexts as $schemeText) {
            $result[] = [
                'text' => $schemeText->text,
                'x' => $schemeText->x,
                'y' => $schemeText->y
            ];
        }
        return $result;
    }

    /**
     * @return array
     */
    public function getSchemePointsArray()
    {
        $result = [];
        foreach ($this->schemePoints as $schemePoint) {
            $result[] = [
                'id' => $schemePoint->id,
                'text' => $schemePoint->text,
                'x' => $schemePoint->x,
                'y' => $schemePoint->y,
                'vertical' => $schemePoint->vertical,
                'reverse' => $schemePoint->reverse
            ];
        }
        return $result;
    }

    /**
     * @return array
     */
    public function getSchemeValuesArray()
    {
        $result = [];
        foreach ($this->schemePoints as $pointOne) {
            foreach ($this->schemePoints as $pointTwo) {
                if (intval($pointTwo->text) > intval($pointOne->text)) {
                    $value = SchemeData::find()->andWhere(['point1' => $pointOne->id, 'point2' => $pointTwo->id])->one();
                    $result[$pointOne->id . '.' . $pointTwo->id] = [
                        'cur_u' => $value->cur_u ?? 0,
                        'cur_i' => $value->cur_i ?? 0,
                        'cur_r' => $value->cur_r ?? 0,
                    ];
                }
            }
        }
        return $result;
    }

    /**
     * @param $data
     * @param $id
     * @return bool
     */
    public static function saveChangeableState($data, $id)
    {
        $scheme = Scheme::findOne($id);
        $scheme->changeable_r = $data['r'];
        $scheme->changeable_c = $data['c'];
        $scheme->save();

        return true;
    }
}
