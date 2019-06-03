<?php
namespace api\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * Site controller
 */
class SiteController extends Controller
{
    public function actionError()
    {
        var_dump('test');
        die;
        throw new NotFoundHttpException();
    }
}
