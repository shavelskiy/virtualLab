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
            'lab_id' => $this->integer(),
            'root' => $this->integer(),
            'lft' => $this->integer(),
            'rgt' => $this->integer(),
            'level' => $this->integer(),
            'name' => $this->text(),
            'content' => $this->text(),
            'component_id' => $this->integer(),
        ], $tableOptions);

        $this->addForeignKey('fk-lab_items__lab_id',
            'lab_items',
            'lab_id',
            'labs',
            'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('lab_items');
    }
}
