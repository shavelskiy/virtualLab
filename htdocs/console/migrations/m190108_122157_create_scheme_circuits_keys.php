<?php

use yii\db\Migration;

/**
 * Class m190108_122157_create_scheme_circuits_keys
 */
class m190108_122157_create_scheme_circuits_keys extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'fk-scheme_circuits-scheme_id',
            'scheme_circuits',
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
        $this->dropForeignKey(
            'fk-scheme_circuits-scheme_id',
            'scheme_circuits'
        );
    }
}
