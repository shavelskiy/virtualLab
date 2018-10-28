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
 *
 * @property Groups $group
 * @property User $user
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
            [['user_id', 'variant', 'group_id'], 'integer'],
            [['name', 'last_name', 'middle_name'], 'string', 'max' => 255],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => Groups::className(), 'targetAttribute' => ['group_id' => 'id']],
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
            'lab1_id' => 'Работа №1',
            'lab2_id' => 'Работа №2',
            'lab3_id' => 'Работа №3',
            'lab4_id' => 'Работа №4',
            'lab5_id' => 'Работа №5',
            'lab6_id' => 'Работа №6'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Groups::className(), ['id' => 'group_id']);
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
        $group = Groups::findOne($student->group_id);
        $labs = [];
        $labs[] = self::getLab($group->lab1, 1);
        $labs[] = self::getLab($group->lab2, 2);
        $labs[] = self::getLab($group->lab3, 3);
        $labs[] = self::getLab($group->lab4, 4);
        $labs[] = self::getLab($group->lab5, 5);
        $labs[] = self::getLab($group->lab6, 6);
        return $labs;
    }

    public function getLab($activity, $number)
    {
        if ($activity) {
            return Lab::findOne($number);
        }
        return null;
    }

    public static function getStudentVariant($userId) {
        $student = Student::find()->andWhere(['user_id' => $userId])->one();
        return $student->variant;
    }
}
