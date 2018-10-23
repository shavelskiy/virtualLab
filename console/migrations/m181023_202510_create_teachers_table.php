<?php

use yii\db\Migration;

/**
 * Handles the creation of table `teachers`.
 */
class m181023_202510_create_teachers_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('teachers', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'last_name' => $this->string()->notNull(),
            'middle_name' => $this->string(),
            'pulpit' => $this->string()
        ]);

        $this->addForeignKey(
            'fk-teachers-user_id',
            'teachers',
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
        $this->dropTable('teachers');

        $this->dropForeignKey(
            'fk-teachers-user_id',
            'teachers'
        );
    }
}
