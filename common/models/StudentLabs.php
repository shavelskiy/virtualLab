<?php
/**
 * Created by PhpStorm.
 * User: vladislav
 * Date: 30.10.2018
 * Time: 1:22
 */

namespace common\models;

/**
 * This is the model class for table "student_labs".
 *
 * @property int $id
 * @property int $lab1_id
 * @property int $lab2_id
 * @property int $lab3_id
 * @property int $lab4_id
 * @property int $lab5_id
 * @property int $lab6_id
 * @property int $lab7_id
 * @property int $lab8_id
 **
 * @property Student $student
 *
 * @property LabBalls $lab1
 * @property LabBalls $lab2
 * @property LabBalls $lab3
 * @property LabBalls $lab4
 * @property LabBalls $lab5
 * @property LabBalls $lab6
 * @property LabBalls $lab7
 * @property LabBalls $lab8
 */
class StudentLabs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'student_labs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required', 'message' => 'Введите группу'],
        ];
    }

}
