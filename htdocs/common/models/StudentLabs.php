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

    public function getLab1()
    {
        return LabBalls::findOne($this->lab1_id);
    }

    public function getLab2()
    {
        return LabBalls::findOne($this->lab2_id);
    }

    public function getLab3()
    {
        return LabBalls::findOne($this->lab3_id);
    }

    public function getLab4()
    {
        return LabBalls::findOne($this->lab4_id);
    }

    public function getLab5()
    {
        return LabBalls::findOne($this->lab5_id);
    }

    public function getLab6()
    {
        return LabBalls::findOne($this->lab6_id);
    }

    public function getLab7()
    {
        return LabBalls::findOne($this->lab7_id);
    }

    public function getLab8()
    {
        return LabBalls::findOne($this->lab8_id);
    }

    public function afterDelete()
    {
        $labs = LabBalls::findAll([$this->lab1_id, $this->lab2_id, $this->lab3_id, $this->lab4_id, $this->lab5_id, $this->lab6_id, $this->lab7_id, $this->lab8_id]);
        foreach ($labs as $lab) {
            $lab->delete();
        }
    }
}
