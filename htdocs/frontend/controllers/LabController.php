<?php

namespace frontend\controllers;

use common\models\Lab;
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
        $variant = User::findOne(Yii::$app->user->id)->student->variant;
        return $this->render('lab', [
                'number' => $number,
                'variant' => $variant
            ]
        );
    }

    public function actionDescription()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $labId = 1;
        $lab = Lab::findOne($labId);
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
    }
}