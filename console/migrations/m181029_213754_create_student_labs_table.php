<?php

use yii\db\Migration;

/**
 * Handles the creation of table `student_labs`.
 */
class m181029_213754_create_student_labs_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('student_labs', [
            'id' => $this->primaryKey(),
            'lab1_id' => $this->integer(),
            'lab2_id' => $this->integer(),
            'lab3_id' => $this->integer(),
            'lab4_id' => $this->integer(),
            'lab5_id' => $this->integer(),
            'lab6_id' => $this->integer(),
            'lab7_id' => $this->integer(),
            'lab8_id' => $this->integer()
        ], $tableOptions);

        $this->addForeignKey(
            'fk-student-labs_id',
            'student',
            'labs_id',
            'student_labs',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-student_labs-lab1_id',
            'student_labs',
            'lab1_id',
            'lab_balls',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-student_labs-lab2_id',
            'student_labs',
            'lab2_id',
            'lab_balls',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-student_labs-lab3_id',
            'student_labs',
            'lab3_id',
            'lab_balls',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-student_labs-lab4_id',
            'student_labs',
            'lab4_id',
            'lab_balls',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-student_labs-lab5_id',
            'student_labs',
            'lab5_id',
            'lab_balls',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-student_labs-lab6_id',
            'student_labs',
            'lab6_id',
            'lab_balls',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-student_labs-lab7_id',
            'student_labs',
            'lab6_id',
            'lab_balls',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-student_labs-lab8_id',
            'student_labs',
            'lab6_id',
            'lab_balls',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('student_labs');

        $this->dropForeignKey(
            'fk-student_labs-labs_id',
            'student'
        );
    }
}
