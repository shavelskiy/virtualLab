<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "students".
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $last_name
 * @property string $middle_name
 * @property int $variant
 * @property int $group_id
 * @property int labs_id
 * @property int $teacher_id
 *
 * @property Group $group
 * @property User $user
 * @property Teacher $teacher
 * @property StudentLabs $labs
 */
class Student extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'students';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'last_name', 'variant'], 'required', 'message' => 'Это поле обязательно для заполнения'],
            [['name', 'last_name', 'middle_name'], 'string', 'max' => 255],
            [['teacher_id'], 'required', 'message' => 'Выберите преподавателя'],
            ['variant', 'integer', 'message' => 'Вариант должен являться целым цислом'],
            ['labs_id', 'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Имя',
            'last_name' => 'Фамилия',
            'middle_name' => 'Отчество',
            'variant' => 'Вариант',
            'teacher' => 'Преподаватель'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Group::className(), ['id' => 'group_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLabs()
    {
        return StudentLabs::findOne($this->labs_id);
    }

    /**
     * Создаём лабораторные работы перед сохранение студента
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        $labs = new StudentLabs();
        $labs->save();
        $this->labs_id = $labs->id;
        return parent::beforeSave($insert);
    }

    /**
     * После сохранения присваиваем роль студента
     * @param bool $insert
     * @param array $changedAttributes
     * @throws \Exception
     */
    public function afterSave($insert, $changedAttributes)
    {
        $auth = Yii::$app->authManager;
        $studentRole = $auth->getRole('student');
        $auth->assign($studentRole, $this->user_id);
        parent::afterSave($insert, $changedAttributes);
    }

    /**
     *
     * @param $activity
     * @param $number
     * @return Lab|null
     */
    public function getLab($activity, $number)
    {
        if ($activity) {
            return Lab::findOne($number);
        }
        return null;
    }

    /**
     * получить полное имя преподавателя студента
     * @return string
     */
    public function getTeacher()
    {
        return Teacher::getFullNameById($this->teacher_id);
    }

    public function afterDelete()
    {
        StudentLabs::findOne($this->labs_id)->delete();
        $user = User::findOne($this->user_id);
        $user->delete();

        $auth = Yii::$app->authManager;
        $student = $auth->getRole('student');
        $auth->revoke($student, $user->id);
    }
}