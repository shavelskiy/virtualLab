<?php

namespace frontend\controllers;

use yii\web\Controller;
use Yii;
use yii\web\Response;

class SchemeController extends Controller
{
    public function actionGetScheme()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $result = [];

        $result = json_encode($result);
        return $result;
    }
}
