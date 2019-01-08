<?php

use yii\db\Migration;

/**
 * Class m190108_102922_create_shemes_keys
 */
class m190108_102922_create_schemes_keys extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'fk-schemes-lab_id',
            'schemes',
            'lab_id',
            'labs',
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
            'fk-schemes-lab_id',
            'lab_items'
        );
    }
}
