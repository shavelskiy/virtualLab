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

            foreach ($data['old'] as $taskId => $task) {

                $rootItem = LabItems::findOne($taskId);
                $rootItem->name = $task['name'];
                $rootItem->save();

                if (isset($task['items'])) {
                    if (isset($task['items']['old'])) {
                        foreach ($task['items']['old'] as $itemId => $item) {
                            $labItem = LabItems::findOne($itemId);
                            $labItem->name = $item['name'];
                            $labItem->content = $item['content'];
                            $labItem->component_id = $item['component'];
                            $labItem->save();
                        }
                    }

                    if (isset($task['items']['new'])) {
                        foreach ($task['items']['new'] as $itemId => $item) {
                            // обновляем родительский элемент
                            $rgt = $rootItem->rgt;
                            $rootItem->rgt = $rgt + 2;
                            $rootItem->save();

                            $labItem = new LabItems();
                            $labItem->lab_id = $lab->id;
                            $labItem->name = $item['name'];
                            $labItem->content = $item['content'];
                            $labItem->component_id = isset($item['component']) ? $item['component'] : null;
                            $labItem->level = 2;
                            $labItem->root = $rootItem->id;
                            $labItem->lft = $rgt;
                            $labItem->rgt = $rgt + 1;
                            $labItem->save();
                        }
                    }
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