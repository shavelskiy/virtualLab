<?php

use yii\db\Migration;

/**
 * Class m181029_215410_create_groups_keys
 */
class m181029_215410_create_groups_keys extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'fk-students-group_id',
            'students',
            'group_id',
            'groups',
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
            'fk-students-group_id',
            'students'
        );
    }
}
