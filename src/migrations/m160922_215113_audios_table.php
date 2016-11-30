<?php

use yii\db\Migration;

class m160922_215113_audios_table extends Migration
{
    public function up()
    {
        $this->createTable('audio', [
            'id'=>$this->primaryKey(),
            'name'=>$this->string(255),
            'path'=>$this->string(255)
        ]);
    }

    public function down()
    {
        $this->dropTable('audio');

        return true;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
