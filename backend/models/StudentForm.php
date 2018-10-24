<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use common\models\User;

class StudentForm extends Model
{
    public $id;
    public $username;
    public $email;
    public $password;
    public $name;
    public $lastName;
    public $middleName;
    public $groupId;

    public function rules()
    {
        return [
            [['name', 'lastName', 'username', 'password', 'email'], 'required', 'message' => 'Это поле обязательно для заполнения'],
            [['name', 'lastName', 'middleName'], 'string', 'max' => 255],
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

        $student = new Student();
        $student->setAttributes(
            [
                'user_id' => $user->id,
                'name' => $this->name,
                'last_name' => $this->lastName,
                'middle_name' => $this->middleName,
                'group_id' => $groupId
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
//        $student = Student::findOne($this->id);
//        $student->setAttributes(
//            [
//                'name' => $this->name,
//                'last_name' => $this->lastName,
//                'middle_name' => $this->middleName,
//                'email' => 'email'
//            ]
//        );
//        $student->save();
//
//        $user = User::findOne($student->user_id);
//        $user->username = $this->username;
//        $user->email = $this->email;
//
//        $user->save();
    }

    public static function delete($id)
    {
//        $student = Student::findOne($id);
//        $groupId = $student->group_id;
//        $user = User::findOne($student->user_id);
//        $student->delete();
//        $user->delete();
//        return $groupId;
    }
}