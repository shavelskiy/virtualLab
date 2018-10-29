<?php

use yii\db\Migration;

/**
 * Handles the creation of table `lab`.
 */
class m181027_202347_create_lab_balls_table extends Migration
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

        $this->createTable('lab_balls', [
            'id' => $this->primaryKey(),
            'balls' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey(
            'fk-students-lab1_id',
            'students',
            'lab1_id',
            'lab_balls',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-students-lab2_id',
            'students',
            'lab2_id',
            'lab_balls',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-students-lab3_id',
            'students',
            'lab3_id',
            'lab_balls',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-students-lab4_id',
            'students',
            'lab4_id',
            'lab_balls',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-students-lab5_id',
            'students',
            'lab5_id',
            'lab_balls',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-students-lab6_id',
            'students',
            'lab6_id',
            'lab_balls',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-students-lab7_id',
            'students',
            'lab6_id',
            'lab_balls',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-students-lab8_id',
            'students',
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
        $this->dropTable('lab_balls');

        $this->dropForeignKey(
            'fk-students-lab1_id',
            'students'
        );

        $this->dropForeignKey(
            'fk-students-lab2_id',
            'students'
        );

        $this->dropForeignKey(
            'fk-students-lab3_id',
            'students'
        );

        $this->dropForeignKey(
            'fk-students-lab4_id',
            'students'
        );

        $this->dropForeignKey(
            'fk-students-lab5_id',
            'students'
        );

        $this->dropForeignKey(
            'fk-students-lab6_id',
            'students'
        );

        $this->dropForeignKey(
            'fk-students-lab7_id',
            'students'
        );

        $this->dropForeignKey(
            'fk-students-lab8_id',
            'students'
        );
    }
}
