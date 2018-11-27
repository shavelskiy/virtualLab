<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "lab_balls".
 *
 * @property int $id
 * @property integer $balls
 * @property integer $created_at
 *
 * @property Student $student
 *
 * @property StudentLabs[] $labs
 */
class LabBalls extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lab_balls';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['balls', 'created_at'], 'require']
        ];
    }

    public function attributeLabels()
    {
        return [
            'balls' => 'Баллы',
            'created_at' => 'Дата прохождения'
        ];
    }

    public function getCreatedAt() {
        return date('d.m.Y G:i', $this->created_at);;
    }
}