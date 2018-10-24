<?php

namespace frontend\controllers;

use yii\web\Controller;

class LabController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}