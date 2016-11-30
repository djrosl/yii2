<?php

use yii\db\Migration;

class m160927_124451_emails_table extends Migration
{
    public function up()
    {
        $this->createTable('email', [
            'id'=>$this->primaryKey(),
            'email'=>$this->string(255),
            'active'=>$this->boolean()->defaultValue(1)
        ]);
    }

    public function down()
    {
        $this->dropTable('email');

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
