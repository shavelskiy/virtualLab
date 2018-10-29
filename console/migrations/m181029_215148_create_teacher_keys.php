<?php

use yii\db\Migration;

/**
 * Class m181029_215148_create_teacher_keys
 */
class m181029_215148_create_teacher_keys extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'fk-students-teacher_id',
            'students',
            'teacher_id',
            'teachers',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-groups-teacher1_id',
            'groups',
            'teacher1_id',
            'teachers',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-groups-teacher2_id',
            'groups',
            'teacher2_id',
            'teachers',
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
            'fk-students-teacher_id',
            'students'
        );

        $this->dropForeignKey(
            'fk-group-teacher1_id',
            'groups'
        );

        $this->dropForeignKey(
            'fk-group-teacher2_id',
            'groups'
        );
    }
}
