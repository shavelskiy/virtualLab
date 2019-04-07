<?php

namespace backend\controllers;

use common\models\Scheme;
use common\models\SchemeCircuit;
use common\models\SchemeData;
use common\models\SchemeItem;
use common\models\SchemePoint;
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
                        'actions' => ['create', 'update', 'update-data', 'delete', 'save-data'],
                        'allow' => true,
                        'roles' => ['teacher']
                    ],
                ],
            ],
        ];
    }

    public function beforeAction($action)
    {
        return true;
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
            } else {
                $scheme = self::findScheme($schemeId);
            }

            $data = Json::decode(Yii::$app->request->getRawBody());

            SchemeCircuit::saveData($data['circuits'], $scheme->id);
            SchemeItem::saveData($data['elements'], $scheme->id);
            SchemePoint::saveData($data['points'], $scheme->id);
            SchemeText::saveData($data['texts'], $scheme->id);
            Scheme::saveChangeableState($data['changeable'], $scheme->id);

            $this->redirect(['lab/update', 'id' => $scheme->lab->id]);
        }

        if ($schemeId) {
            $scheme = $this->findScheme($schemeId);
        } else {
            $scheme = new Scheme();
            $scheme->lab_id = $labId;
        }

        return $this->render('update', ['scheme' => $scheme]);
    }

    /**
     * @param $schemeId
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionUpdateData($schemeId)
    {
        $scheme = $this->findScheme($schemeId);

        return $this->render('update-data', ['scheme' => $scheme]);
    }

    /**
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
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

        $scheme->delete();
        die;
    }

    /**
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionSaveData()
    {
        $data = Yii::$app->request->post('data');
        foreach ($data as $points => $values) {
            $pointsArr = explode('.', $points);
            $pointId1 = $pointsArr[0];
            $pointId2 = $pointsArr[1];

            $schemeData = SchemeData::find()->andWhere(['point1' => $pointId1, 'point2' => $pointId2])->one();

            if (!$schemeData) {
                $schemeData = new SchemeData();
            }

            $schemeData->point1 = $pointId1;
            $schemeData->point2 = $pointId2;

            $schemeData->cur_u = (isset($values['cur_u'])) ? $values['cur_u'] : null;
            $schemeData->cur_i = (isset($values['cur_i'])) ? $values['cur_i'] : null;
            $schemeData->cur_r = (isset($values['cur_r'])) ? $values['cur_r'] : null;

            $schemeData->re = (isset($values['re'])) ? $values['re'] : null;
            $schemeData->im = (isset($values['im'])) ? $values['im'] : null;

            $schemeData->save();
        }

        $scheme = self::findScheme(Yii::$app->request->post('schemeId'));
        return $this->redirect(['lab/update', 'id' => $scheme->lab->id]);
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