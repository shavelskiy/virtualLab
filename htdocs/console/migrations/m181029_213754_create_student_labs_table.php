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
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('student_labs');
    }
}
