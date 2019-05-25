<?php

namespace frontend\controllers;

use common\models\Lab;
use common\models\LabResults;
use common\models\Student;
use Yii;
use yii\web\NotAcceptableHttpException;

class ProfileController extends \yii\web\Controller
{
    public function actionIndex()
    {
        if (Yii::$app->user->can('viewAdminPage')) {
            throw new NotAcceptableHttpException('У вас нет доступа к этой странице');
        }

        $student = Student::find()->andWhere(['user_id' => Yii::$app->user->id])->one();

        $studentLabs = [];

        foreach (Lab::find()->all() as $lab) {
            $finish = false;

            /** @var LabResults $studentLab */
            if ($studentLab = $student->labs->{'lab' . $lab->id}) {
                $attempts = $studentLab->attempts;
                if ($studentLab->success) {
                    $finish = true;
                    $status = 'Выполнено';
                } else {
                    $status = 'В процессе';
                }
            } else {
                $status = 'Не начато';
                $attempts = 0;
            }

            $studentLabs[] = [
                'lab_id' => $lab->id,
                'status' => $status,
                'date_create' => $finish ? date('d.m.Y H:i', $studentLab->created_at) : null,
                'href' => $finish ? $studentLab->file_path : null,
                'attempts' => $attempts
            ];
        }

        return $this->render('index', [
            'model' => $student,
            'studentLabs' => $studentLabs
        ]);
    }
}
