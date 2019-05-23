<?php

use yii\db\Migration;

/**
 * Handles the creation of table `lab_results`.
 */
class m181027_202347_create_lab_results_table extends Migration
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

        $this->createTable('lab_results', [
            'id' => $this->primaryKey(),
            'success' => $this->boolean()->notNull()->defaultValue(false),
            'attempts' => $this->integer()->notNull(),
            'created_at' => $this->integer(),
            'file_path' => $this->string()
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('lab_results');
    }
}
