<?php

namespace backend\controllers;

use common\models\Lab;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;

class SchemeController extends Controller
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
                        'actions' => ['update-schemes'],
                        'allow' => true,
                        'roles' => ['teacher']
                    ],
                ],
            ],
        ];
    }

    public function actionUpdateSchemes($labId)
    {
        $lab = $this->findLab($labId);


        return $this->render('update', ['lab' => $lab]);
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