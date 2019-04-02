<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "scheme_circuits".
 *
 * @property int $id
 * @property int $scheme_id
 * @property int $parent
 * @property int $x
 * @property int $y
 * @property int $sort
 *
 * @property Scheme $scheme
 */
class SchemeCircuit extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'scheme_circuits';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['scheme_id', 'x', 'y'], 'required'],
            [['scheme_id', 'parent', 'x', 'y', 'sort'], 'integer'],
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
            'parent' => 'Parent',
            'x' => 'X',
            'y' => 'Y',
            'sort' => 'Sort',
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
        foreach ($data['save'] as $circuit) {
            $parentId = (isset($circuit['parentId'])) ? $circuit['parentId'] : null;

            foreach ($circuit['points'] as $point) {
                if ($point['id']) {
                    $schemeCircuit = SchemeCircuit::findOne($point['id']);
                } else {
                    $schemeCircuit = new SchemeCircuit();
                    $schemeCircuit->scheme_id = $schemeId;
                    $schemeCircuit->sort = $point['sort'];
                }

                $schemeCircuit->x = $point['x'];
                $schemeCircuit->y = $point['y'];

                if (!$parentId) {
                    $schemeCircuit->save();
                    $parentId = $schemeCircuit->id;
                }

                $schemeCircuit->parent = $parentId;
                $schemeCircuit->save();
            }
        }

        // удаление цепи
        foreach ($data['delete'] as $circuitId) {
            foreach (SchemeCircuit::find()->andWhere(['parent' => $circuitId])->all() as $item) {
                $item->delete();
            }
        }
    }
}
