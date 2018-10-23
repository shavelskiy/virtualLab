<?php

namespace common\models;

use yii\base\Model;
use common\models\Student;
use common\models\User;
use yii\web\NotFoundHttpException;

class StudentFull extends Model {
    public $id;
    public $username;
    public $email;
    public $password;
    public $name;
    public $lastName;
    public $middleName;
    public $groupId;

    public function rules() {
        return [
            [['id', 'name', 'lastName', 'username', 'password', 'groupId'], 'required'],
            [['name', 'lastName', 'middleName'], 'string', 'max' => 255],
            [['email'], 'email'],
            [['username'], 'unique', 'targetClass' => '\common\models\User'],
            [['password'], 'string', 'min' => 6],
        ];
    }

    public function attributeLabels() {
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
     * Получить данные о конкретном студенте
     */
    public static function getStudentById($id) {
        if (($student = Student::findOne($id)) !== null) {
            $studentFull = new StudentFull();
            $studentFull->setAttributes(
                [
                    'id' => $student->id,
                    'username' => $student->user->username,
                    'email' => $student->user->email,
                    'name' => $student->name,
                    'lastName' => $student->last_name,
                    'middleName' => $student->middle_name,
                    'groupId' => $student->group_id
                ]
            );
            return $studentFull;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Модель StudentFull заполнена данными
     * теперь сохраним их по нужным таблицам
     */
    public function save($groupId) {
        $user = new User();

        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();

        $user->save();

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
    }

    /**
     * Изменение нформации о студенте
     */
    public function update() {
        $student = Student::findOne($this->id);
        $student->setAttributes(
            [
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
     * удаление студента
     */
    public static function delete($id) {
        $student = Student::findOne($id);
        $groupId = $student->group_id;
        $user = User::findOne($student->user_id);
        $student->delete();
        $user->delete();
        return $groupId;
    }
}