<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use common\models\User;

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
        $activeLabs = User::findOne(Yii::$app->user->id)->student->group->labs->activeLabs;

        return $this->render('index', [
                'activeLabs' => $activeLabs
            ]);
    }

    public function actionLab($number)
    {
        $variant = User::findOne(Yii::$app->user->id)->student->variant;
        return $this->render('lab', [
                'number' => $number,
                'variant' => $variant
            ]
        );
    }
}