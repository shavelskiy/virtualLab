<?php

namespace frontend\controllers;

use common\models\Scheme;
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
                    'texts' => []
                ];

                foreach ($scheme->schemeItems as $schemeItem) {
                    $items['elements'][] = [
                        'type' => $schemeItem->type,
                        'name' => $schemeItem->name,
                        'x' => $schemeItem->x,
                        'y' => $schemeItem->y,
                        'vertical' => $schemeItem->vertical,
                        'direction' => $schemeItem->direction
                    ];
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
