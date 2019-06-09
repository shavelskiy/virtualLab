<?php

namespace console\controllers;

use yii\console\Controller;
use yii\console\ExitCode;

class ExportController extends Controller
{
    public const EXPORT_DATA = [
        'Lab' => [
            'id', 'name', 'description', 'preview_picture', 'signal'
        ],
        'Component' => [
            'id', 'name'
        ],
        'LabItems' => [
            'id', 'lab_id', 'root', 'lft', 'rgt', 'level', 'name', 'content', 'component_id'
        ],
        'Scheme' => [
            'id', 'lab_id', 'changeable_r'
        ],
        'SchemeCircuit' => [
            'id', 'scheme_id', 'parent', 'x', 'y', 'sort'
        ],
        'SchemeItem' => [
            'id', 'scheme_id', 'type', 'name', 'value', 'x', 'y', 'vertical'
        ],
        'SchemePoint' => [
            'id', 'scheme_id', 'x', 'y', 'text', 'vertical', 'reverse'
        ],
        'SchemeText' => [
            'id', 'scheme_id', 'text', 'x', 'y'
        ],
        'SchemeData' => [
            'id', 'point1', 'point2', 'cur_u', 'cur_i', 'cur_r', 're', 'im', 'first_front', 'second_front'
        ],
    ];

    public function actionIndex()
    {
        foreach (self::EXPORT_DATA as $className => $attributes) {
            $fp = fopen(__DIR__ . "/files/$className.csv", 'w');

            $class = "common\\models\\" . $className;

            foreach ($class::find()->all() as $item) {
                $field = [];

                foreach ($attributes as $attribute) {
                    $field[] = $item->{$attribute};
                }

                fputcsv($fp, $field);
            }

            fclose($fp);
        }

        return ExitCode::OK;
    }
}
