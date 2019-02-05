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

            if (isset($data['old'])) {
                foreach ($data['old'] as $taskId => $task) {
                    $rootItem = LabItems::findOne($taskId);
                    $rootItem->name = $task['name'];

                    if (isset($task['items'])) {
                        if (isset($task['items']['old'])) {
                            foreach ($task['items']['old'] as $itemId => $item) {
                                $labItem = LabItems::findOne($itemId);
                                $labItem->name = $item['name'];
                                $labItem->content = $item['content'];
                                $labItem->component_id = $item['component'];
                            }
                        }

                        if (isset($task['items']['new'])) {
                            foreach ($task['items']['new'] as $itemId => $item) {
                                // обновляем родительский элемент
                                $rgt = $rootItem->rgt;
                                $rootItem->rgt = $rgt + 2;

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
                    $rootItem->save();
                }
            }

            if (isset($data['new'])) {
                foreach ($data['new'] as $task) {
                    $rootItem = new LabItems();
                    $rootItem->lab_id = $lab->id;
                    $rootItem->name = isset($task['name']) ? $task['name'] : '';
                    $rootItem->level = 1;
                    $rootItem->lft = 1;
                    $rootItem->rgt = 2;

                    $rootItem->save();
                    $rootItem->root = $rootItem->id;

                    if (isset($task['items']['new'])) {
                        foreach ($task['items']['new'] as $item) {
                            // обновляем родительский элемент
                            $rgt = $rootItem->rgt;
                            $rootItem->rgt = $rgt + 2;

                            $labItem = new LabItems();
                            $labItem->lab_id = $lab->id;
                            $labItem->name = isset($item['name']) ? $item['name'] : ' ';
                            $labItem->content = isset($item['content']) ? $item['content'] : ' ';
                            $labItem->component_id = isset($item['component']) ? $item['component'] : null;
                            $labItem->level = 2;
                            $labItem->root = $rootItem->id;
                            $labItem->lft = $rgt;
                            $labItem->rgt = $rgt + 1;
                            $labItem->save();
                        }
                    }

                    $rootItem->save();
                }
            }

            if (isset($data['delete'])) {
                foreach ($data['delete'] as $taskId => $deleteData) {
                    $taskItem = LabItems::findOne($taskId);

                    if ($deleteData['delete']) {
                        $taskItems = LabItems::find()
                            ->andWhere(['root' => $taskItem->id])
                            ->andWhere(['>', 'lft', $taskItem->lft])
                            ->andWhere(['<', 'rgt', $taskItem->rgt])
                            ->all();

                        foreach ($taskItems as $item) {
                            $item->delete();
                        }

                        $taskItem->delete();
                    } else {
                        if (isset($deleteData['items'])) {
                            foreach ($deleteData['items'] as $itemId => $delete) {
                                if ($delete) {
                                    $item = LabItems::findOne($itemId);

                                    $otherItems = LabItems::find()
                                        ->andWhere(['root' => $taskItem->id])
                                        ->andWhere(['>', 'lft', $item->rgt])
                                        ->andWhere(['<', 'rgt', $taskItem->rgt])
                                        ->all();

                                    foreach ($otherItems as $otherItem) {
                                        $otherItem->lft = $otherItem->lft - 2;
                                        $otherItem->rgt = $otherItem->rgt - 2;

                                        $otherItem->save();
                                    }

                                    $taskItem->rgt = $taskItem->rgt - 2;
                                    $taskItem->save();

                                    $item->delete();
                                }
                            }
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
     * @return Lab|null
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