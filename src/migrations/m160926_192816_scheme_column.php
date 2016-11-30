<?php

use yii\db\Migration;

class m160926_192816_scheme_column extends Migration
{
    public function up()
    {
        $this->addColumn('event', 'scheme', $this->string(255));
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
