<?php

namespace common\models;

/**
 * This is the model class for table "groups".
 *
 * @property int $id
 * @property string $name
 * @property int labs_id
 * @property int teacher1_id
 * @property int teacher2_id
 *
 * @property Teacher $teacher1
 * @property Teacher $teacher2
 * @property GroupLabs $labs
 *
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
            [['teacher1_id', 'teacher2_id', 'labs_id'], 'integer'],
            [['name'], 'unique', 'targetClass' => '\common\models\Group', 'message' => 'Такая группа уже существует'],
            [['name'], 'string', 'max' => 10, 'tooLong' => 'Введите корректную группу']
        ];
    }

    public function __construct(array $config = [])
    {
        parent::__construct($config);

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

    /**
     * Получаем список групп, в которых преподаёт преподаватель
     * @param $teacherId
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getTeacherGroups($teacherId)
    {
        return Group::find()
            ->Where(['teacher1_id' => $teacherId])
            ->orWhere(['teacher2_id' => $teacherId])
            ->all();
    }
}
