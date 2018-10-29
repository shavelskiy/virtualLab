<?php

use yii\db\Migration;

/**
 * Class m181029_215549_create_student_labs_keys
 */
class m181029_215549_create_student_labs_keys extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
        'fk-students-labs_id',
            'students',
            'labs_id',
            'student_labs',
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
            'fk-students-labs_id',
            'students'
        );
    }
}
