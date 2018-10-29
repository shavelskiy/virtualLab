<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use common\models\User;
use common\models\Student;
use common\models\StudentLabs;

class StudentForm extends Model
{
    public $id;
    public $username;
    public $email;
    public $password;
    public $name;
    public $lastName;
    public $middleName;
    public $variant;
    public $labs_id;
    public $groupId;
    public $teacherId;

    public function rules()
    {
        return [
            [['name', 'lastName', 'username', 'password', 'email', 'variant'], 'required', 'message' => 'Это поле обязательно для заполнения'],
            [['name', 'lastName', 'middleName'], 'string', 'max' => 255],
            [['teacherId'], 'required', 'message' => 'Выберите преподавателя'],
            [['email'], 'email', 'message' => 'Введите корректный email'],
            [['username'], 'unique', 'targetClass' => '\common\models\User', 'message' => 'Этот логин уже занят'],
            [['email'], 'unique', 'targetClass' => '\common\models\User', 'message' => 'Пользователь с таким email уже существует'],
            [['password'], 'string', 'min' => 6, 'tooShort' => 'Пароль должен быть больше 6 символов'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Логин',
            'email' => 'Почта',
            'password' => 'Пароль',
            'name' => 'Имя',
            'lastName' => 'Фамилия',
            'middleName' => 'Отчество',
            'variant' => 'Вариант'
        ];
    }

    /**
     * @param $groupId
     * @throws \Exception
     */
    public function save($groupId)
    {
        $signUpForm = new SignupForm();
        $signUpForm->setAttributes(
            [
                'username' => $this->username,
                'email' => $this->email,
                'password' => $this->password
            ]
        );

        $user = $signUpForm->signup();

        $labs = new StudentLabs();
        $labs->save();

        $student = new Student();
        $student->setAttributes(
            [
                'user_id' => $user->id,
                'name' => $this->name,
                'last_name' => $this->lastName,
                'middle_name' => $this->middleName,
                'variant' => $this->variant,
                'labs_id' => $labs->id,
                'group_id' => $groupId,
                'teacher_id' => $this->teacherId
            ]
        );
        $student->save();
        $this->id = $student->id;

        $auth = Yii::$app->authManager;
        $studentRole = $auth->getRole('student');
        $auth->assign($studentRole, $user->id);
    }

    public function update()
    {
        $student = Student::findOne($this->id);
        $student->setAttributes(
            [
                'variant' => $this->variant,
                'teacher_id' => $this->teacherId,
                'name' => $this->name,
                'last_name' => $this->lastName,
                'middle_name' => $this->middleName,
                'email' => 'email'
            ]
        );
        $student->save();

        $user = User::findOne($student->user_id);
        $user->username = $this->username;
        $user->email = $this->email;

        $user->save();
    }

    /**
     * @param Student $student
     */
    public function loadStudent($student)
    {
        $this->id = $student->id;
        $this->username = $student->user->username;
        $this->email = $student->user->email;
        $this->name = $student->name;
        $this->lastName = $student->last_name;
        $this->middleName = $student->middle_name;
        $this->groupId = $student->group_id;
        $this->variant = $student->variant;
        $this->teacherId = $student->teacher_id;
    }
}