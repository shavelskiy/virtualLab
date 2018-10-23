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
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('teachers', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'last_name' => $this->string()->notNull(),
            'middle_name' => $this->string(),
            'pulpit' => $this->string()
        ], $tableOptions);

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
