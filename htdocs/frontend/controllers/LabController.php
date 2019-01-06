<?php

namespace frontend\controllers;

use common\models\Lab;
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
        if ($session->has('lab_number')) {
            $lab = Lab::findOne($session->get('lab_number'));
            $labItems = $lab->labItems;
            $result = [];

            foreach ($labItems as $item) {
                if ($item->is_parent) {
                    $result[$item->number] = [
                        'name' => $item->name,
                        'task' => []
                    ];
                }
            }

            foreach ($labItems as $item) {
                if (!$item->is_parent) {
                    $result[$item->parentItem->number]['task'][$item->number] = [
                        'name' => $item->name,
                        'content' => $item->content,
                        'component' => $item->component
                    ];
                }
            }

            $result = json_encode($result);
            return $result;
        } else {
            return null;
        }
    }
}