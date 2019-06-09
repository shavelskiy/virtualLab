<?php

namespace api\controllers;

use common\models\Component;
use common\models\Lab;
use common\models\Scheme;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

class SchemeController extends Controller
{
    /**
     * Отдать все схемы для лабораторной на фронт
     * @return array
     */
    public function actionIndex()
    {
        $session = Yii::$app->session;
        $result = [];

        if ($session->has('lab_number')) {
            $lab = Lab::findOne($session->get('lab_number'));

            foreach ($lab->schemes as $scheme) {
                $result[] = [
                    'circuits' => $scheme->getSchemeCircuitsArray(),
                    'elements' => $scheme->getSchemeItemsArray(),
                    'changeable_r' => $scheme->changeable_r,
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
        $components = Component::find()->all();
        $result = ArrayHelper::map($components, 'id', 'name');

        return $result;
    }
}
