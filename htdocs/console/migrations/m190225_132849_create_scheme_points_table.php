<?php

use yii\db\Migration;

/**
 * Handles the creation of table `scheme_points`.
 */
class m190225_132849_create_scheme_points_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('scheme_points', [
            'id' => $this->primaryKey(),
            'scheme_id' => $this->integer()->notNull(),
            'x' => $this->integer()->notNull(),
            'y' => $this->integer()->notNull(),
            'text' => $this->string(),
            'vertical' => $this->boolean(),
            'reverse' => $this->boolean()
        ]);

        $this->addForeignKey(
            'fk-scheme_points-scheme_id',
            'scheme_points',
            'scheme_id',
            'schemes',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('scheme_points');
    }
}
