<?php

use yii\db\Migration;

/**
 * Handles the creation of table `sheme_items`.
 */
class m190108_103525_create_scheme_items_table extends Migration
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

        $this->createTable('scheme_items', [
            'id' => $this->primaryKey(),
            'scheme_id' => $this->integer()->notNull(),
            'type' => $this->string(255)->notNull(),
            'name' => $this->string(255),
            'value' => $this->string(255),
            'x' => $this->integer(),
            'y' => $this->integer(),
            'vertical' => $this->boolean(),
            'direction' => $this->boolean()
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('scheme_items');
    }
}
