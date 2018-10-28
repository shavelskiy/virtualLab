<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use common\models\Student;

class LabController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['student'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $student = Student::getActiveLabs(Yii::$app->user->id);
        echo '<pre>';var_dump($student);die;
        return $this->render('index');
    }

    public function actionLab()
    {
        return $this->render('lab');
    }
}