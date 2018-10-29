<?php

namespace common\models;

use common\models\Group;
use common\models\Student;
use common\models\User;
use Yii;

/**
 * This is the model class for table "teachers".
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $last_name
 * @property string $middle_name
 * @property string $pulpit
 *
 * @property Group[] $groups
 * @property Student[] $students
 * @property User $user
 */
class Teacher extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'teachers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'name', 'last_name'], 'required'],
            [['user_id'], 'integer'],
            [['name', 'last_name', 'middle_name', 'pulpit'], 'string', 'max' => 255],
            [['user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'name' => 'Имя',
            'last_name' => 'Фамилия',
            'middle_name' => 'Отчество',
            'pulpit' => 'Кафедра',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function afterDelete()
    {
        $user = User::findOne($this->user_id);
        $user->delete();

        $auth = Yii::$app->authManager;
        $teacher = $auth->getRole('teacher');
        $auth->revoke($teacher, $user->id);
    }

    public function getFullName()
    {
        return $this->last_name . ' ' . $this->name . ' ' . $this->middle_name . ' ' . $this->pulpit;
    }

    public static function getFullNameById($id)
    {
        $teacher = Teacher::findOne($id);
        return $teacher->last_name . ' ' .
            mb_substr($teacher->name, 0, 1, 'UTF-8') . '.' .
            mb_substr($teacher->middle_name, 0, 1, 'UTF-8') . '.';
    }
}
