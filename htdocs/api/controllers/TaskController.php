<?php

namespace api\controllers;

use common\models\Lab;
use common\models\Student;
use common\models\LabItems;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;


class TaskController extends Controller
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
                        'actions' => ['index', 'title-info'],
                        'allow' => true,
                        'roles' => ['student'],
                    ],
                ],
            ],
        ];
    }

    /**
     * получить задание для работы
     * @return array
     */
    public function actionIndex()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $session = Yii::$app->session;
        $result = [];

        if ($session->has('lab_number')) {
            $result = LabItems::find()->tree($session->get('lab_number'));
        }

        return $result;
    }

    public function actionTitleInfo()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $session = Yii::$app->session;
        $result = [];

        if ($session->has('lab_number')) {
            $lab = Lab::findOne($session->get('lab_number'));
            $student = Student::find()->andWhere(['user_id' => Yii::$app->user->id])->one();

            $result = [
                'number' => $lab->id,
                'name' => $lab->name,
                'studentName' => $student->exportName,
                'studentGroup' => $student->group->name,
                'studentVariant' => $student->variant,
                'teacherName' => $student->teacher,
                'year' => date('Y')
            ];
        }

        return $result;
    }
}