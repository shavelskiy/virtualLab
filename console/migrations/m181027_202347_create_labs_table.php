<?php

use yii\db\Migration;

/**
 * Handles the creation of table `lab`.
 */
class m181027_202347_create_labs_table extends Migration
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

        $this->createTable('labs', [
            'id' => $this->primaryKey(),
            'balls' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey(
            'fk-students-lab1',
            'students',
            'lab1',
            'labs',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-students-lab2',
            'students',
            'lab2',
            'labs',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-students-lab3',
            'students',
            'lab3',
            'labs',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-students-lab4',
            'students',
            'lab4',
            'labs',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-students-lab5',
            'students',
            'lab5',
            'labs',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-students-lab6',
            'students',
            'lab6',
            'labs',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('lab');

        $this->dropForeignKey(
            'fk-students-lab1',
            'students'
        );

        $this->dropForeignKey(
            'fk-students-lab2',
            'students'
        );

        $this->dropForeignKey(
            'fk-students-lab3',
            'students'
        );

        $this->dropForeignKey(
            'fk-students-lab4',
            'students'
        );

        $this->dropForeignKey(
            'fk-students-lab5',
            'students'
        );

        $this->dropForeignKey(
            'fk-students-lab6',
            'students'
        );
    }
}
