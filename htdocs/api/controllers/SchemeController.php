<?php

namespace api\controllers;

use common\models\Component;
use common\models\Lab;
use common\models\Scheme;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\Response;

class SchemeController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['index', 'info', 'components'],
                        'allow' => true,
                        'roles' => ['student'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Отдать все схемы для лабораторной на фронт
     * @return array
     */
    public function actionIndex()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $session = Yii::$app->session;
        $result = [];

        if ($session->has('lab_number')) {
            $lab = Lab::findOne($session->get('lab_number'));

            foreach ($lab->schemes as $scheme) {
                $result[] = [
                    'circuits' => $scheme->getSchemeCircuitsArray(),
                    'elements' => $scheme->getSchemeItemsArray(),
                    'changeable_r' => $scheme->changeable_r,
                    'changeable_c' => $scheme->changeable_c,
                    'points' => $scheme->getSchemePointsArray(),
                    'texts' => $scheme->getSchemeTextsArray(),
                    'data' => $scheme->getSchemeDataArray(),
                    'values' => $scheme->getSchemeValuesArray()
                ];
            }
        }

        return $result;
    }

    /**
     * Получить для предосмотра в админке
     * @param $schemeId
     * @return array
     */
    public function actionInfo($schemeId)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $scheme = Scheme::findOne($schemeId);
        $result = [
            'circuits' => $scheme->getSchemeCircuitsArray(),
            'elements' => $scheme->getSchemeItemsArray(),
            'points' => $scheme->getSchemePointsArray(),
            'texts' => $scheme->getSchemeTextsArray()
        ];

        return $result;
    }

    /**
     * Получить списко всех доступных компонентов
     * @return array
     */
    public function actionComponents()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $components = Component::find()->all();
        $result = ArrayHelper::map($components, 'id', 'name');

        return $result;
    }
}
