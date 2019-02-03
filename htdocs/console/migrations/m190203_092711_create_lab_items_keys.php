<?php

use yii\db\Migration;

/**
 * Class m190203_092711_create_lab_items_keys
 */
class m190203_092711_create_lab_items_keys extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey('fk-lab_items__component_id',
            'lab_items',
            'component_id',
            'components',
            'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-lab_items__component_id',
            'lab_items'
        );
    }
}
