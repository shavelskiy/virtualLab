<?php
namespace api\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;

/**
 * Site controller
 */
class SiteController extends Controller
{
    public function actionError()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        Yii::$app->response->statusCode = 404;

        return ['error' => 'page not found'];
    }
}
