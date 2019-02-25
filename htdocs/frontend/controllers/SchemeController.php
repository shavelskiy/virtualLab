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
    public function actionGet()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $session = Yii::$app->session;
        $result = [];

        if ($session->has('lab_number')) {
//            $lab = Lab::findOne($session->get('lab_number'));
            $lab = Lab::findOne(1);

            $schemes = $lab->schemes;

            foreach ($schemes as $scheme) {
                $items = [
                    'circuits' => $scheme->schemeCircuits,
                    'elements' => [],
                    'texts' => [],
                    'data' => []
                ];

                foreach ($scheme->schemeItems as $schemeItem) {
                    $items['elements'][] = [
                        'type' => $schemeItem->type,
                        'name' => $schemeItem->name,
                        'x' => $schemeItem->x,
                        'y' => $schemeItem->y,
                        'vertical' => $schemeItem->vertical,
                        'direction' => $schemeItem->direction,
                    ];

                    $items['data'][$schemeItem->name] = $schemeItem->value;
                }

                foreach ($scheme->schemeTexts as $schemeText) {
                    $items['texts'][] = [
                        'text' => $schemeText->text,
                        'x' => $schemeText->x,
                        'y' => $schemeText->y
                    ];
                }

                $result[] = $items;
            }
        }

        return Json::encode($result);
    }

    public function actionInfo($schemeId)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $scheme = Scheme::findOne($schemeId);
        $result = [
            'circuits' => $scheme->schemeCircuits,
            'elements' => [],
            'points' => [],
            'texts' => []
        ];

        foreach ($scheme->schemeItems as $schemeItem) {
            $result['elements'][] = [
                'type' => $schemeItem->type,
                'name' => $schemeItem->name,
                'x' => $schemeItem->x,
                'y' => $schemeItem->y,
                'vertical' => $schemeItem->vertical,
                'direction' => $schemeItem->direction
            ];
        }

        foreach ($scheme->schemePoints as $schemePoint) {
            $result['points'][] = [
                'text' => $schemePoint->text,
                'x' => $schemePoint->x,
                'y' => $schemePoint->y,
                'vertical' => $schemePoint->vertical
            ];
        }

        foreach ($scheme->schemeTexts as $schemeText) {
            $result['texts'][] = [
                'text' => $schemeText->text,
                'x' => $schemeText->x,
                'y' => $schemeText->y
            ];
        }

        return Json::encode($result);
    }
}
