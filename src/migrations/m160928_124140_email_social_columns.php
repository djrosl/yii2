<?php

use yii\db\Migration;

class m160928_124140_email_social_columns extends Migration
{
    public function up()
    {
        $this->addColumn('email', 'name', $this->string(255));
        $this->addColumn('email', 'profile', $this->string(255));
    }

    public function down()
    {


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
