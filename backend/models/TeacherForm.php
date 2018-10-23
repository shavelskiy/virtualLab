<?php

namespace backend\models;

use Yii;
use yii\base\Model;

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

    public function rules() {
        return [
            [['id', 'name', 'lastName', 'username', 'password'], 'required'],
            [['name', 'lastName', 'middleName', 'pulpit'], 'string', 'max' => 255],
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
            'pulpit' => 'Кафедра'
        ];
    }

    /**
     * @param $id
     * @return TeacherFull
     * @throws NotFoundHttpException
     */
    public static function findTeacherById($id) {
        if (($teacher = Teacher::findOne($id)) !== null) {
            $teacherFull = new TeacherFull();
            $teacherFull->setAttributes(
                [
                    'id' => $teacher->id,
                    'username' => $teacher->user->username,
                    'email' => $teacher->user->email,
                    'name' => $teacher->name,
                    'lastName' => $teacher->last_name,
                    'middleName' => $teacher->middle_name,
                    'pulpit' => $teacher->pulpit
                ]
            );
            return $teacherFull;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     *
     */
    public function save() {
        $user = new User();

        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();

        $user->save();

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
    }

    /**
     *
     */
    public function update() {
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
     * @param $id
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public static function delete($id) {
        $teacher = Teacher::findOne($id);
        $user = User::findOne($teacher->user_id);
        $teacher->delete();
        $user->delete();
    }
}