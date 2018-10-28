<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "groups".
 *
 * @property int $id
 * @property integer $balls
 * @property integer $created_at
 * @property Student[] $students
 */
class Lab extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'labs';
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