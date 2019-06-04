<?php

namespace api\controllers;

use common\models\Lab;
use common\models\LabResults;
use common\models\Student;
use Jurosh\PDFMerge\PDFMerger;
use Yii;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\Response;


class LabController extends Controller
{
    public $enableCsrfValidation = false;

    /**
     * возвращает тип сигнала в текущей работе
     * @return array
     */
    public function actionSignal()
    {
        $session = Yii::$app->session;
        $result = [];

        if ($session->has('lab_number')) {
            $lab = Lab::findOne($session->get('lab_number'));
            $result = Lab::SIGNAL_NAMES[$lab->signal];
        }

        return $result;
    }

    /**
     * сохранить отчет по работе
     * @return array|null
     * @throws \Exception
     */
    public function actionResult()
    {
        Yii::$app->response->statusCode = 400;

        $session = Yii::$app->session;
        $request = Json::decode(Yii::$app->getRequest()->getRawBody());


        if ($session->has('lab_number')) {
            $labNumber = $session->get('lab_number');
            $student = Student::find()->andWhere(['user_id' => Yii::$app->user->id])->one();

            if ($student->group->labs->{"lab$labNumber"}) {
                /** @var LabResults $labResult */
                if ($labResult = $student->labs->{"lab$labNumber"}) {

                    if (!$labResult->success) {
                        $lab = Lab::findOne($labNumber);
                        $session->remove('lab_number');

                        if (isset($request['taskPdf']) && isset($request['titlePdf'])) {
                            $fileName = $student->user->username . '_' . $lab->id . '_' . time();

                            $taskPdfBase64 = htmlspecialchars($request['taskPdf']);
                            $titlePdfBase64 = htmlspecialchars($request['titlePdf']);

                            $titlePdf = base64_decode($titlePdfBase64);
                            $taskPdf = base64_decode($taskPdfBase64);

                            $titlePath = __DIR__ . "/tmp/title_$fileName.pdf";
                            $taskPath = __DIR__ . "/tmp/task_$fileName.pdf";

                            $resultPath = $_SERVER['DOCUMENT_ROOT'] . "../../../data/results/$fileName.pdf";

                            file_put_contents($titlePath, $titlePdf);
                            file_put_contents($taskPath, $taskPdf);

                            $pdf = new PDFMerger();

                            $pdf->addPDF($titlePath, 'all', 'vertical')->addPDF($taskPath, 'all', 'vertical');
                            $pdf->merge('file', $resultPath);

                            unlink($titlePath);
                            unlink($taskPath);

                            $labResult->success = true;
                            $labResult->created_at = time();
                            $labResult->file_path = "/data/results/$fileName.pdf";

                            if ($labResult->save()) {
                                Yii::$app->response->statusCode = 200;
                                return [
                                    'date' => date('d.m.Y H:i', $labResult->created_at),
                                    'file_path' => $labResult->file_path,
                                    'attempt' => $labResult->attempts
                                ];
                            } else {
                                return ['error' => 'Произошла ошибка при сохранении отчета'];
                            }
                        } else {
                            return ['error' => 'Произошла ошибка при сохранении отчета'];
                        }
                    } else {
                        return ['error' => 'Работа уже выполнена'];
                    }
                } else {
                    return ['error' => 'Работа не найдена'];
                }
            } else {
                return ['error' => 'Работа недоступна'];
            }
        }

        return null;
    }
}