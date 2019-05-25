<?php

namespace frontend\controllers;

use common\models\Lab;
use common\models\LabResults;
use common\models\Student;
use common\models\User;
use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;


class LabController extends Controller
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
                        'actions' => ['index', 'lab', 'title-info', 'result'],
                        'allow' => true,
                        'roles' => ['student'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Получить список доступных лабораторных работ
     * @return string
     */
    public function actionIndex()
    {
        if (Yii::$app->user->can('viewAdminPage')) {
            $labs = Lab::find()->all();
        } else {
            $student = Student::find()->andWhere(['user_id' => Yii::$app->user->id])->one();

            $labs = [];
            /** @var Lab $activeLab */
            foreach (User::findOne(Yii::$app->user->id)->student->group->labs->activeLabs as $activeLab) {
                if (!(isset($student->labs->{'lab' . $activeLab->id})) || !($student->labs->{'lab' . $activeLab->id}->success)) {
                    $labs[] = $activeLab;
                }
            }
        }

        return $this->render('index', [
            'activeLabs' => $labs
        ]);
    }

    /**
     * @param $number
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionLab($number)
    {
        $session = Yii::$app->session;
        if ($session->has('lab_number')) {
            $session->remove('lab_number');
        }
        $session->set('lab_number', $number);

        if (!Yii::$app->user->can('viewAdminPage')) {
            $student = Student::find()->andWhere(['user_id' => Yii::$app->user->id])->one();

            if (!$student->group->labs->{"lab$number"}) {
                throw new NotFoundHttpException('Лабораторная работа недоступна');
            }

            $studentLabs = $student->labs;

            /** @var LabResults $labResult */
            if ($labResult = $studentLabs->{"lab$number"}) {
                if ($labResult->success) {
                    throw new NotFoundHttpException('Лабораторная работа уже выполнена');
                }

                $labResult->attempts = $labResult->attempts + 1;
                $labResult->save();
            } else {
                $labResult = new LabResults();
                $labResult->attempts = 1;
                $labResult->success = false;
                $labResult->save();
                $studentLabs->{"lab$number" . "_id"} = $labResult->id;
                $studentLabs->save();
            }
        }

        return $this->render('lab', ['lab' => Lab::findOne($number)]);
    }
}