<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "groups".
 *
 * @property int $id
 * @property string $name
 * @property boolean $lab1
 * @property boolean $lab2
 * @property boolean $lab3
 * @property boolean $lab4
 * @property boolean $lab5
 * @property boolean $lab6
 * @property Student[] $students
 */
class Groups extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'groups';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required', 'message' => 'Введите группу'],
            [['name'], 'unique', 'targetClass' => '\common\models\Groups', 'message' => 'Такая группа уже существует'],
            [['name'], 'string', 'max' => 10, 'tooLong' => 'Введите корректную группу'],
            [['lab1', 'lab2', 'lab3', 'lab4', 'lab5', 'lab6'], 'safe']
        ];
    }

    public function __construct(array $config = [])
    {
        parent::__construct($config);
        $this->lab1 = false;
        $this->lab2 = false;
        $this->lab3 = false;
        $this->lab4 = false;
        $this->lab5 = false;
        $this->lab6 = false;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Группа',
            'lab1' => 'Работа №1',
            'lab2' => 'Работа №2',
            'lab3' => 'Работа №3',
            'lab4' => 'Работа №4',
            'lab5' => 'Работа №5',
            'lab6' => 'Работа №6',

        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudents()
    {
        return $this->hasMany(Students::className(), ['group_id' => 'id']);
    }
}
