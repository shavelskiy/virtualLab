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
                        'actions' => ['create', 'update', 'delete'],
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
    public function actionUpdate($schemeId = null, $labId = null)
    {
        if (Yii::$app->request->isAjax) {

            if ($labId) {
                $scheme = new Scheme();
                $scheme->lab_id = $labId;
                $scheme->save();
            }

            $data = Json::decode(Yii::$app->request->getRawBody());

            SchemeCircuit::saveData($data['circuits'], $schemeId);
            SchemeItem::saveData($data['elements'], $schemeId);
            SchemeText::saveData($data['texts'], $schemeId);

            $this->redirect(['lab/update', 'id' => ($schemeId) ? $schemeId : $scheme->lab->id]);
        }

        if ($schemeId) {
            $scheme = $this->findScheme($schemeId);
        } else {
            $scheme = new Scheme();
            $scheme->lab_id = $labId;
        }

        return $this->render('update', ['scheme' => $scheme]);
    }

    public function actionDelete()
    {
        $scheme = Scheme::findOne(Yii::$app->request->post('schemeId'));

        foreach (SchemeCircuit::find()->andWhere(['scheme_id' => $scheme->id])->all() as $circuit) {
            $circuit->delete();
        }

        foreach ($scheme->schemeItems as $item) {
            $item->delete();
        }

        foreach ($scheme->schemeTexts as $text) {
            $text->delete();
        }

        $scheme->delete(); die;
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