<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "groups".
 *
 * @property int $id
 * @property integer $ball
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
            [['name'], 'required', 'message' => 'Введите группу'],
            [['name'], 'unique', 'targetClass' => '\backend\models\Groups', 'message' => 'Такая группа уже существует'],
            [['name'], 'string', 'max' => 10, 'tooLong' => 'Введите корректную группу']
        ];
    }
}