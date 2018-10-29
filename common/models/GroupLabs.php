<?php
/**
 * Created by PhpStorm.
 * User: vladislav
 * Date: 30.10.2018
 * Time: 1:22
 */

namespace common\models;

/**
 * This is the model class for table "group_labs".
 *
 * @property int $id
 * @property boolean $lab1
 * @property boolean $lab2
 * @property boolean $lab3
 * @property boolean $lab4
 * @property boolean $lab5
 * @property boolean $lab6
 * @property boolean $lab7
 * @property boolean $lab8
 **
 * @property Group $group
 */
class GroupLabs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'group_labs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'lab1', 'lab2', 'lab3', 'lab4', 'lab5', 'lab6', 'lab7', 'lab8'], 'required'],
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
        $this->lab7 = false;
        $this->lab8 = false;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'lab1active' => 'Работа №1',
            'lab2active' => 'Работа №2',
            'lab3active' => 'Работа №3',
            'lab4active' => 'Работа №4',
            'lab5active' => 'Работа №5',
            'lab6active' => 'Работа №6',
            'lab7active' => 'Работа №7',
            'lab8active' => 'Работа №8',
        ];
    }

    public function getLab1Active()
    {
        return ($this->lab1) ? 'Да' : 'Нет';
    }

    public function getLab2Active()
    {
        return ($this->lab2) ? 'Да' : 'Нет';
    }

    public function getLab3Active()
    {
        return ($this->lab3) ? 'Да' : 'Нет';
    }

    public function getLab4Active()
    {
        return ($this->lab4) ? 'Да' : 'Нет';
    }

    public function getLab5Active()
    {
        return ($this->lab5) ? 'Да' : 'Нет';
    }

    public function getLab6Active()
    {
        return ($this->lab6) ? 'Да' : 'Нет';
    }

    public function getLab7Active()
    {
        return ($this->lab7) ? 'Да' : 'Нет';
    }

    public function getLab8Active()
    {
        return ($this->lab8) ? 'Да' : 'Нет';
    }
}
