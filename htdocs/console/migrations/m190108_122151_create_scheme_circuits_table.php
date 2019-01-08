<?php

use yii\db\Migration;

/**
 * Handles the creation of table `scheme_circuits`.
 */
class m190108_122151_create_scheme_circuits_table extends Migration
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

        $this->createTable('scheme_circuits', [
            'id' => $this->primaryKey(),
            'scheme_id' => $this->integer()->notNull(),
            'is_start' => $this->boolean()->notNull(),
            'parent' => $this->integer(),
            'x' => $this->integer()->notNull(),
            'y' => $this->integer()->notNull(),
            'sort'=> $this->integer()
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('scheme_circuits');
    }
}
