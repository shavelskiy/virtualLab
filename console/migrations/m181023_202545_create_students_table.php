<?php

use yii\db\Migration;

/**
 * Handles the creation of table `students`.
 */
class m181023_202545_create_students_table extends Migration
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

        $this->createTable('students', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'last_name' => $this->string()->notNull(),
            'middle_name' => $this->string(),
            'variant' => $this->string()->notNull(),
            'lab1_id' => $this->integer(),
            'lab2_id' => $this->integer(),
            'lab3_id' => $this->integer(),
            'lab4_id' => $this->integer(),
            'lab5_id' => $this->integer(),
            'lab6_id' => $this->integer(),
            'group_id' => $this->integer()->notNull()
        ], $tableOptions);

        $this->addForeignKey(
            'fk-students-user_id',
            'students',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('students');

        $this->dropForeignKey(
            'fk-students-user_id',
            'students'
        );
    }
}
