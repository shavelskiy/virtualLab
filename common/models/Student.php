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
 * @property integer $variant
 * @property int $group_id
 * @property int lab1_id
 * @property int lab2_id
 * @property int lab3_id
 * @property int lab4_id
 * @property int lab5_id
 * @property int lab6_id
 * @property int lab7_id
 * @property int lab8_id
 * @property int $teacher_id
 *
 * @property Group $group
 * @property User $user
 * @property Teacher $teacher
 * @property LabBalls $lab1
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
            [['user_id', 'name', 'last_name', 'variant', 'group_id'], 'required'],
            [['user_id', 'variant', 'group_id', 'teacher_id'], 'integer'],
            [['name', 'last_name', 'middle_name'], 'string', 'max' => 255],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => Group::className(), 'targetAttribute' => ['group_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['lab1_id', 'lab2_id', 'lab3_id', 'lab4_id', 'lab5_id', 'lab6_id'], 'integer'],
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
            'variant' => 'Вариант',
            'group_id' => 'Group ID',
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
    public function getLab1()
    {
        return LabBalls::findOne($this->lab1_id);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLab2()
    {
        return LabBalls::findOne($this->lab2_id);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLab3()
    {
        return LabBalls::findOne($this->lab3_id);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLab4()
    {
        return LabBalls::findOne($this->lab4_id);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLab5()
    {
        return LabBalls::findOne($this->lab5_id);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLab6()
    {
        return LabBalls::findOne($this->lab6_id);
    }

    public function afterDelete()
    {
        $user = User::findOne($this->user_id);
        $user->delete();

        $auth = Yii::$app->authManager;
        $student = $auth->getRole('student');
        $auth->revoke($student, $user->id);
    }

    public static function getGroupStudents($groupId)
    {
        return Student::find()
            ->andWhere(['group_id' => $groupId])
            ->all();
    }

    public static function getActiveLabs($userId)
    {
        $student = Student::find()->andWhere(['user_id' => $userId])->one();
        $group = Group::findOne($student->group_id);
        $labs = [];
        if ($lab = self::getLab($group->lab1, 1)) {
            $labs[] = $lab;
        }
        if ($lab = self::getLab($group->lab2, 2)) {
            $labs[] = $lab;
        }
        if ($lab = self::getLab($group->lab3, 3)) {
            $labs[] = $lab;
        }
        if ($lab = self::getLab($group->lab4, 4)) {
            $labs[] = $lab;
        }
        if ($lab = self::getLab($group->lab5, 5)) {
            $labs[] = $lab;
        }
        if ($lab = self::getLab($group->lab6, 6)) {
            $labs[] = $lab;
        }
        if ($lab = self::getLab($group->lab6, 7)) {
            $labs[] = $lab;
        }
        if ($lab = self::getLab($group->lab6, 8)) {
            $labs[] = $lab;
        }
        return $labs;
    }

    public function getLab($activity, $number)
    {
        if ($activity) {
            return Lab::findOne($number);
        }
        return null;
    }

    public static function getStudentVariant($userId)
    {
        $student = Student::find()->andWhere(['user_id' => $userId])->one();
        return $student->variant;
    }

    public function getTeacher()
    {
        return Teacher::getFullNameById($this->teacher_id);
    }

    public static function getTeacherStudents($groupId, $teacherId)
    {
        return Student::find()
            ->where(['group_id' => $groupId])
            ->andWhere(['teacher_id' => $teacherId])
            ->all();
    }
}
