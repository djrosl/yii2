<?php

use yii\db\Migration;

class m160922_215319_audios_table_col extends Migration
{
    public function up()
    {
        $this->addColumn('audio', 'artist_id', $this->integer(11));
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
