<?php

use yii\db\Migration;

/**
 * Class m181029_214954_create_user_keys
 */
class m181029_214954_create_user_keys extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'fk-teachers-user_id',
            'teachers',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-students-user_id',
            'students',
            'user_id',
            'user',
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
            'fk-teachers-user_id',
            'teachers'
        );

        $this->dropForeignKey(
            'fk-students-user_id',
            'students'
        );
    }
}
