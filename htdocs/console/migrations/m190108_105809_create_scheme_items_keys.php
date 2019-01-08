<?php

use yii\db\Migration;

/**
 * Class m190108_105809_create_sheme_items_keys
 */
class m190108_105809_create_scheme_items_keys extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'fk-scheme_items-scheme_id',
            'scheme_items',
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
            'fk-scheme_items-scheme_idd',
            'lab_items'
        );
    }
}
