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
 **
 * @property Student $student
 *
 * @property LabResults $lab1
 * @property LabResults $lab2
 * @property LabResults $lab3
 * @property LabResults $lab4
 * @property LabResults $lab5
 * @property LabResults $lab6
 * @property LabResults $lab7
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

    public function getLab1()
    {
        return LabResults::findOne($this->lab1_id);
    }

    public function getLab2()
    {
        return LabResults::findOne($this->lab2_id);
    }

    public function getLab3()
    {
        return LabResults::findOne($this->lab3_id);
    }

    public function getLab4()
    {
        return LabResults::findOne($this->lab4_id);
    }

    public function getLab5()
    {
        return LabResults::findOne($this->lab5_id);
    }

    public function getLab6()
    {
        return LabResults::findOne($this->lab6_id);
    }

    public function getLab7()
    {
        return LabResults::findOne($this->lab7_id);
    }
}
