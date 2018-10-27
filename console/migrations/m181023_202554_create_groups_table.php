<?php

use yii\db\Migration;

/**
 * Handles the creation of table `groups`.
 */
class m181023_202554_create_groups_table extends Migration
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

        $this->createTable('groups', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'lab1' => $this->boolean()->notNull(),
            'lab2' => $this->boolean()->notNull(),
            'lab3' => $this->boolean()->notNull(),
            'lab4' => $this->boolean()->notNull(),
            'lab5' => $this->boolean()->notNull(),
            'lab6' => $this->boolean()->notNull()
        ], $tableOptions);

        $this->addForeignKey(
            'fk-students-group_id',
            'students',
            'group_id',
            'groups',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('groups');

        $this->dropForeignKey(
            'fk-students-group_id',
            'students'
        );
    }
}
