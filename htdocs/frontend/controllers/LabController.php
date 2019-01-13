<?php

namespace frontend\controllers;

use common\models\Lab;
use common\models\LabItems;
use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\web\Response;
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
                    [
                        'actions' => ['description'],
                        'allow' => true,
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
//        $variant = User::findOne(Yii::$app->user->id)->student->variant;

        $session = Yii::$app->session;
        if ($session->has('lab_number')) {
            $session->remove('lab_number');
        }

        $session->set('lab_number', $number);
        return $this->render('lab');
    }

    // получить задание для работы
    public function actionDescription()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $session = Yii::$app->session;
        $result = [];

        if ($session->has('lab_number')) {
            $result = LabItems::find()->tree();
        }

        $result = json_encode($result);

        return $result;
    }
}