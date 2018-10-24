<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use common\models\User;

class TeacherForm extends Model
{
    public $id;
    public $username;
    public $email;
    public $password;
    public $name;
    public $lastName;
    public $middleName;
    public $pulpit;

    public function rules()
    {
        return [
            [['name', 'lastName', 'username', 'password', 'email', 'pulpit'], 'required', 'message' => 'Это поле обязательно для заполнения'],
            [['name', 'lastName', 'middleName', 'pulpit'], 'string', 'max' => 255],
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
            'pulpit' => 'Кафедра'
        ];
    }

    /**
     * @throws \Exception
     */
    public function save()
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

        $teacher = new Teacher();
        $teacher->setAttributes(
            [
                'user_id' => $user->id,
                'name' => $this->name,
                'last_name' => $this->lastName,
                'middle_name' => $this->middleName,
                'pulpit' => $this->pulpit
            ]
        );
        $teacher->save();
        $this->id = $teacher->id;

        $auth = Yii::$app->authManager;
        $teacherRole = $auth->getRole('teacher');
        $auth->assign($teacherRole, $user->id);
    }

    /**
     *
     */
    public function update()
    {
        $teacher = Teacher::findOne($this->id);
        $teacher->setAttributes(
            [
                'name' => $this->name,
                'last_name' => $this->lastName,
                'middle_name' => $this->middleName,
                'pulpit' => $this->pulpit
            ]
        );
        $teacher->save();

        $user = User::findOne($teacher->user_id);
        $user->username = $this->username;
        $user->email = $this->email;

        $user->save();
    }

    /**
     * @param  Teacher $teacher
     */
    public function loadTeacher($teacher)
    {
        $this->id = $teacher->id;
        $this->username = $teacher->user->username;
        $this->email = $teacher->user->email;
        $this->name = $teacher->name;
        $this->lastName = $teacher->last_name;
        $this->middleName = $teacher->middle_name;
        $this->pulpit = $teacher->pulpit;
    }
}