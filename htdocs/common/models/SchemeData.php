<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "scheme_data".
 *
 * @property int $id
 * @property int $point1
 * @property int $point2
 * @property string $cur_u
 * @property string $cur_i
 * @property string $cur_r
 * @property string $re
 * @property string $im
 * @property string first_front
 * @property string second_front
 *
 * @property SchemePoint $point20
 * @property SchemePoint $point10
 */
class SchemeData extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'scheme_data';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['point1', 'point2'], 'required'],
            [['point1', 'point2'], 'integer'],
            [['cur_u', 'cur_i', 'cur_r', 're', 'im', 'first_front', 'second_front'], 'string', 'max' => 255],
            [['point2'], 'exist', 'skipOnError' => true, 'targetClass' => SchemePoint::class, 'targetAttribute' => ['point2' => 'id']],
            [['point1'], 'exist', 'skipOnError' => true, 'targetClass' => SchemePoint::class, 'targetAttribute' => ['point1' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'point1' => 'Point1',
            'point2' => 'Point2',
            'cur_u' => 'Cur U',
            'cur_i' => 'Cur I',
            'cur_r' => 'Cur R',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPoint20()
    {
        return $this->hasOne(SchemePoint::class, ['id' => 'point2']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPoint10()
    {
        return $this->hasOne(SchemePoint::class, ['id' => 'point1']);
    }
}
