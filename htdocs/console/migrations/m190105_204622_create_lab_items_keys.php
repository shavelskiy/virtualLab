<?php

use yii\db\Migration;

/**
 * Class m190105_204622_create_lab_items_keys
 */
class m190105_204622_create_lab_items_keys extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'fk-lab_items-lab_id',
            'lab_items',
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
            'fk-lab_items-lab_id',
            'lab_items'
        );
    }
}
