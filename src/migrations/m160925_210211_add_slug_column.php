<?php

use yii\db\Migration;

class m160925_210211_add_slug_column extends Migration
{
    public function up()
    {
        $this->addColumn('artist', 'slug', $this->string(255));
        $this->addColumn('event', 'slug', $this->string(255));
        $this->addColumn('news', 'slug', $this->string(255));
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
