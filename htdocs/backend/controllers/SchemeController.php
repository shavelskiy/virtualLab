<?php

namespace backend\controllers;

use common\models\Lab;
use common\models\Scheme;
use common\models\SchemeCircuit;
use common\models\SchemeItem;
use common\models\SchemeText;
use yii\helpers\Json;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use Yii;

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

    /**
     * Изменение элементов схемы
     * @param $schemeId
     * @return string
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionUpdateSchemes($schemeId)
    {
        if (Yii::$app->request->isAjax) {
            $data = Json::decode(Yii::$app->request->getRawBody());

            SchemeCircuit::saveData($data['circuits'], $schemeId);
            SchemeItem::saveData($data['elements'], $schemeId);
            SchemeText::saveData($data['texts'], $schemeId);

            $this->redirect(['lab/index']);
        }

        $scheme = $this->findScheme($schemeId);

        return $this->render('update', ['scheme' => $scheme]);
    }

    /**
     * @param $id
     * @return Scheme|null
     * @throws NotFoundHttpException
     */
    protected function findScheme($id)
    {
        if (($model = Scheme::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}