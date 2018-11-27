<?php

use yii\db\Migration;

/**
 * Class m181029_215612_create_group_labs_keys
 */
class m181029_215612_create_group_labs_keys extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'fk-groups-labs_id',
            'groups',
            'labs_id',
            'group_labs',
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
            'fk-groups-labs_id',
            'groups'
        );
    }
}
