<?php

namespace common\models;

use backend\models\Teacher;

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
 * @property boolean $lab7
 * @property boolean $lab8
 * @property integer teacher1_id
 * @property integer teacher2_id
 *
 * @property Teacher $teacher1
 * @property Teacher $teacher2
 * @property Student[] $students
 *
 * @property array $teachers
 */
class Group extends \yii\db\ActiveRecord
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
            [['teacher1_id'], 'required', 'message' => 'Выберите преподавателя'],
            [['teacher1_id', 'teacher2_id'], 'integer'],
            [['name'], 'unique', 'targetClass' => '\common\models\Group', 'message' => 'Такая группа уже существует'],
            [['name'], 'string', 'max' => 10, 'tooLong' => 'Введите корректную группу'],
            [['lab1', 'lab2', 'lab3', 'lab4', 'lab5', 'lab6', 'lab7', 'lab8'], 'safe']
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
            'name' => 'Группа',
            'lab1active' => 'Работа №1',
            'lab2active' => 'Работа №2',
            'lab3active' => 'Работа №3',
            'lab4active' => 'Работа №4',
            'lab5active' => 'Работа №5',
            'lab6active' => 'Работа №6',
            'lab7active' => 'Работа №7',
            'lab8active' => 'Работа №8',
            'teachers' => 'Преподаватели'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudents()
    {
        return $this->hasMany(Students::className(), ['group_id' => 'id']);
    }

    /**
     * @return string
     */
    public function getTeacher1()
    {
        return Teacher::getFullNameById($this->teacher1_id);
    }

    /**
     * @return string
     */
    public function getTeacher2()
    {
        return Teacher::getFullNameById($this->teacher2_id);
    }

    /**
     * Получить двух преподавалетелей в две строки
     * @return string
     */
    public function getTeachers()
    {
        return $this->teacher1 . '<br>' . $this->teacher2;
    }

    public function getLab1Active() {
        return ($this->lab1) ? 'Да' : 'Нет';
    }

    public function getLab2Active() {
        return ($this->lab2) ? 'Да' : 'Нет';
    }

    public function getLab3Active() {
        return ($this->lab3) ? 'Да' : 'Нет';
    }

    public function getLab4Active() {
        return ($this->lab4) ? 'Да' : 'Нет';
    }

    public function getLab5Active() {
        return ($this->lab5) ? 'Да' : 'Нет';
    }

    public function getLab6Active() {
        return ($this->lab6) ? 'Да' : 'Нет';
    }

    public function getLab7Active() {
        return ($this->lab7) ? 'Да' : 'Нет';
    }

    public function getLab8Active() {
        return ($this->lab8) ? 'Да' : 'Нет';
    }
}
