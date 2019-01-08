<?php

use yii\db\Migration;

/**
 * Class m190108_120108_create_scheme_texts_keys
 */
class m190108_120108_create_scheme_texts_keys extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'fk-scheme_texts-scheme_id',
            'scheme_texts',
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
            'fk-scheme_texts-scheme_id',
            'scheme_texts'
        );
    }
}
