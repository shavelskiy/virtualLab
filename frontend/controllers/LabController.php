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
                        'actions' => ['index', 'lab'],
                        'allow' => true,
                        'roles' => ['student'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $activeLabs = Student::getActiveLabs(Yii::$app->user->id);
        return $this->render('index',
            [
                'activeLabs' => $activeLabs
            ]);
    }

    public function actionLab($number)
    {
        $variant = Student::getStudentVariant(Yii::$app->user->id);
        return $this->render('lab',
            [
                'number' => $number,
                'variant' => $variant
            ]
        );
    }
}