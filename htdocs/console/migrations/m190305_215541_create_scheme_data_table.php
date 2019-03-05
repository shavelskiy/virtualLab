<?php

use yii\db\Migration;

/**
 * Handles the creation of table `scheme_data`.
 */
class m190305_215541_create_scheme_data_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('scheme_data', [
            'id' => $this->primaryKey(),
            'point1' => $this->integer()->notNull(),
            'point2' => $this->integer()->notNull(),
            'cur_u' => $this->string(),
            'cur_i' => $this->string(),
            'cur_r' => $this->string()
        ]);

        for ($i = 1; $i <= 2; $i++) {
            $this->addForeignKey(
                'fk-scheme_data-point' . $i,
                'scheme_data',
                'point' . $i,
                'scheme_points',
                'id',
                'CASCADE'
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('scheme_data');
    }
}
