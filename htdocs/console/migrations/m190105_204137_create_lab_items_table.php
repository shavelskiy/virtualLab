<?php

use yii\db\Migration;

/**
 * Handles the creation of table `lab_item`.
 */
class m190105_204137_create_lab_items_table extends Migration
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

        $this->createTable('lab_items', [
            'id' => $this->primaryKey(),
            'lab_id' => $this->integer()->notNull(),
            'is_parent' => $this->boolean()->notNull(),
            'parent' => $this->integer(),
            'number' => $this->integer()->notNull(),
            'name' => $this->text()->notNull(),
            'content' => $this->text(),
            'component' => $this->string(255),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('lab_items');
    }
}
