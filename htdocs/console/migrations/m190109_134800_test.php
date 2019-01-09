<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m190109_134800_test
 */
class m190109_134800_test extends Migration
{
    public function up()
    {

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('test', [
            'id' => Schema::TYPE_PK,
            'root' => Schema::TYPE_INTEGER . ' UNSIGNED NULL DEFAULT NULL',
            'lft' => Schema::TYPE_INTEGER . ' UNSIGNED NOT NULL',
            'rgt' => Schema::TYPE_INTEGER . ' UNSIGNED NOT NULL',
            'level' => Schema::TYPE_SMALLINT . '(5) UNSIGNED NOT NULL',
            'name' => Schema::TYPE_STRING . '(64) NOT NULL',
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('test');
    }
}
