<?php

namespace frontend\controllers;

use common\models\Component;
use common\models\Lab;
use common\models\LabItems;
use Yii;
use yii\helpers\ArrayHelper;
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
                        'actions' => [
                            'task',
                            'signal',
                            'components'
                        ],
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
        $session = Yii::$app->session;
        if ($session->has('lab_number')) {
            $session->remove('lab_number');
        }

        $session->set('lab_number', $number);
        return $this->render('lab', ['lab' => Lab::findOne($number)]);
    }

    // получить задание для работы
    public function actionTask()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $session = Yii::$app->session;
        $result = [];

        if ($session->has('lab_number')) {
            $result = LabItems::find()->tree($session->get('lab_number'));
        }

        $result = json_encode($result);

        return $result;
    }

    public function actionSignal()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $session = Yii::$app->session;
        $result = [];

        if ($session->has('lab_number')) {
            $lab = Lab::findOne($session->get('lab_number'));
            $result = $lab->signal;
        }

        $result = json_encode($result);

        return $result;
    }

    public function actionComponents()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $components = Component::find()->all();
        $result = ArrayHelper::map($components, 'id', 'name');

        $result = json_encode($result);

        return $result;
    }
}