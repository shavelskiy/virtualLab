<?php

namespace console\controllers;

use Yii;
use backend\models\SignupForm;
use yii\console\Controller;

class UserController extends Controller
{
    public $username;
    public $email;
    public $password;

    public function actionCreate()
    {
        $model = new SignupForm();

        $model->setAttributes(
            [
                'username' => $this->username,
                'email' => $this->email,
                'password' => $this->password
            ]
        );

        if ($model->validate()) {
            $user = $model->signup();

            $auth = Yii::$app->authManager;
            $teacher = $auth->getRole('admin');
            $auth->assign($teacher, $user->id);
        } else {
            echo "\n";
            foreach ($model->getErrors() as $input => $errors) {
                echo $input . ":\n";
                foreach ($errors as $error) {
                    echo $error . "\n";
                }
                echo "\n";
            }
        }
    }

    public function options($actionID)
    {
        return [
            'username',
            'email',
            'password'
        ];
    }

    public function optionAliases()
    {
        return [
            'u' => 'username',
            'e' => 'email',
            'p' => 'password'
        ];
    }
}