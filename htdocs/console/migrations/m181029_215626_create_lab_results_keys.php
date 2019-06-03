<?php

use yii\db\Migration;

/**
 * Class m181029_215626_create_lab_balls_keys
 */
class m181029_215626_create_lab_results_keys extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'fk-student_labs-lab1_id',
            'student_labs',
            'lab1_id',
            'lab_results',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-student_labs-lab2_id',
            'student_labs',
            'lab2_id',
            'lab_results',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-student_labs-lab3_id',
            'student_labs',
            'lab3_id',
            'lab_results',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-student_labs-lab4_id',
            'student_labs',
            'lab4_id',
            'lab_results',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-student_labs-lab5_id',
            'student_labs',
            'lab5_id',
            'lab_results',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-student_labs-lab6_id',
            'student_labs',
            'lab6_id',
            'lab_results',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-student_labs-lab7_id',
            'student_labs',
            'lab7_id',
            'lab_results',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-student_labs-lab8_id',
            'student_labs',
            'lab8_id',
            'lab_results',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-student_labs-lab1_id',
            'student_labs'
        );

        $this->dropForeignKey(
            'fk-student_labs-lab2_id',
            'student_labs'
        );

        $this->dropForeignKey(
            'fk-student_labs-lab3_id',
            'student_labs'
        );

        $this->dropForeignKey(
            'fk-student_labs-lab4_id',
            'student_labs'
        );

        $this->dropForeignKey(
            'fk-student_labs-lab5_id',
            'student_labs'
        );

        $this->dropForeignKey(
            'fk-student_labs-lab6_id',
            'student_labs'
        );

        $this->dropForeignKey(
            'fk-student_labs-lab7_id',
            'student_labs'
        );

        $this->dropForeignKey(
            'fk-student_labs-lab8_id',
            'student_labs'
        );
    }
}
