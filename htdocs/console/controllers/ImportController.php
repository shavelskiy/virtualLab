<?php

namespace console\controllers;

use yii\console\Controller;
use yii\console\ExitCode;

class ImportController extends Controller
{
    public function actionIndex()
    {
        self::truncateTables();

        foreach (ExportController::EXPORT_DATA as $className => $attributes) {
            $class = "common\\models\\" . $className;

            if (($handle = fopen(__DIR__ . "/files/$className.csv", 'r')) !== false) {
                while (($data = fgetcsv($handle, 1000, ",")) !== false) {

                    $model = new $class;
                    foreach ($attributes as $key => $attribute) {
                        $model->{$attribute} = $data[$key];
                    }

                    $model->save();
                }
                fclose($handle);
            }
        }

        return ExitCode::OK;
    }

    private function truncateTables()
    {
        foreach (array_reverse(array_keys(ExportController::EXPORT_DATA)) as $className) {
            $class = "common\\models\\" . $className;
            foreach ($class::find()->all() as $item) {
                $item->delete();
            }
        }
    }
}
