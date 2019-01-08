<?php

use yii\db\Migration;

/**
 * Handles the creation of table `scheme_texts`.
 */
class m190108_120057_create_scheme_texts_table extends Migration
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

        $this->createTable('scheme_texts', [
            'id' => $this->primaryKey(),
            'scheme_id' => $this->integer()->notNull(),
            'text' => $this->string(255)->notNull(),
            'x' => $this->integer()->notNull(),
            'y' => $this->integer()->notNull(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('scheme_texts');
    }
}
