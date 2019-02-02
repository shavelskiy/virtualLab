<?php

namespace frontend\controllers;

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
            $lab = Lab::findOne($session->get('lab_number'));
//        $lab = Lab::findOne(1);

        $schemes = $lab->schemes;

            foreach ($schemes as $scheme) {
                $items = [
                    'circuits' => [],
                    'resistor' => [],
                    'capacitor' => [],
                    'coil' => [],
                    'data' => [],
                    'texts' => []
                ];


                $circuits = [];
                foreach ($scheme->circuits as $circuit) {
                    if ($circuit->is_start) {
                        $circuits[$circuit->id]['start'] = [
                            'x' => $circuit->x,
                            'y' => $circuit->y
                        ];
                    } else {
                        $circuits[$circuit->parent]['points'][$circuit->sort] = [
                            'x' => $circuit->x,
                            'y' => $circuit->y
                        ];
                    }
                }

                $items['circuits'] = $circuits;

                foreach ($scheme->items as $item) {
                    $items[$item->type][$item->name] = [
                        'x' => $item->x,
                        'y' => $item->y,
                        'vertical' => $item->vertical,
                        'direction' => isset($item->vertical) ? $item->vertical : true
                    ];

                    if ($item->value) {
                        $items['data'][$item->name] = $item->value;
                    }
                }

                foreach ($scheme->texts as $text) {
                    $items['texts'][] = [
                        'text' => $text->text,
                        'x' => $text->x,
                        'y' => $text->y
                    ];
                }

                $result[$scheme->number] = $items;
            }
        }
        $result = json_encode($result);
        return $result;
    }
}
