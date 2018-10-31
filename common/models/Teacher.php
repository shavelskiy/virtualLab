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
 * @property User $user
 *
 * @property Group[] $groups
 * @property Student[] $students
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
            [['name', 'last_name', 'pulpit'], 'required', 'message' => 'Это поле обязательно для заполнения'],
            [['name', 'last_name', 'middle_name', 'pulpit'], 'string', 'max' => 255],
            [['user_id'], 'integer']
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

    public function getGroups()
    {
        return Group::find()
            ->Where(['teacher1_id' => $this->id])
            ->orWhere(['teacher2_id' => $this->id])
            ->all();
    }

    public function afterDelete()
    {
        $user = User::findOne($this->user_id);
        $user->delete();

        $auth = Yii::$app->authManager;
        $teacher = $auth->getRole('teacher');
        $auth->revoke($teacher, $user->id);
    }

    /**
     * @return string
     */
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
