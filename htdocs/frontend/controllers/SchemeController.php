<?php

namespace frontend\controllers;

use common\models\Scheme;
use phpDocumentor\Reflection\DocBlock\Tags\Property;
use yii\helpers\Json;
use yii\web\Controller;
use Yii;
use yii\web\Response;
use common\models\Lab;

class SchemeController extends Controller
{
    /**
     * Отдать все схемы для лабораторной на фронт
     * @return array
     */
    public function actionGet()
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
}
