<?php

use yii\db\Migration;

/**
 * Handles the creation of table `group_labs`.
 */
class m181029_213742_create_group_labs_table extends Migration
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

        $this->createTable('group_labs', [
            'id' => $this->primaryKey(),
            'lab1' => $this->boolean()->notNull(),
            'lab2' => $this->boolean()->notNull(),
            'lab3' => $this->boolean()->notNull(),
            'lab4' => $this->boolean()->notNull(),
            'lab5' => $this->boolean()->notNull(),
            'lab6' => $this->boolean()->notNull(),
            'lab7' => $this->boolean()->notNull(),
            'lab8' => $this->boolean()->notNull(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('group_labs');
    }
}
