<?php

namespace backend\controllers;

use common\models\Lab;
use common\models\Scheme;
use common\models\SchemeItem;
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

            foreach ($data['save'] as $element) {
                $schemeItem = new SchemeItem();
                $schemeItem->scheme_id = $schemeId;
                $schemeItem->type = $element['element'];
                $schemeItem->name = $element['name'];
                $schemeItem->value = $element['value'];
                $schemeItem->x = $element['x'];
                $schemeItem->y = $element['y'];
                $schemeItem->vertical = $element['vertical'] == 'true';
                $schemeItem->direction = $element['direction'] == 'true';

                if ($schemeItem->validate()) {
                    $schemeItem->save();
                }
            }

            foreach ($data['delete'] as $itemId) {
                $schemeItem = SchemeItem::findOne($itemId);
                $schemeItem->delete();
            }
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