<?php

namespace backend\controllers;

use common\models\Lab;
use common\models\LabItems;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

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
                        'actions' => ['index', 'view', 'create', 'update'],
                        'allow' => true,
                        'roles' => ['teacher']
                    ],
                    [
                        'actions' => ['delete'],
                        'allow' => true,
                        'roles' => ['admin']
                    ]
                ],
            ],
        ];
    }

    /**
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Lab::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $lab = $this->findLab($id);

        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post('task');

            foreach ($data['old'] as $taskId => $oldTask) {

                $item = LabItems::findOne($taskId);
                $item->name = $oldTask['name'];
                $item->save();

                foreach ($oldTask['items']['old'] as $oldItemId => $oldItem) {
                    $item = LabItems::findOne($oldItemId);
                    $item->name = $oldItem['name'];
                    $item->content = $oldItem['content'];
                    $item->component_id = $oldItem['component'];
                    $item->save();
                }
            }
        }

        return $this->render('update', [
            'lab' => $lab,
        ]);
    }

    /**
     * @param $id
     * @return Group|null
     * @throws NotFoundHttpException
     */
    protected function findLab($id)
    {
        if (($model = Lab::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}