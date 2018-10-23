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
        $this->createTable('students', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'last_name' => $this->string()->notNull(),
            'middle_name' => $this->string(),
            'group_id' => $this->integer()->notNull()
        ]);

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
