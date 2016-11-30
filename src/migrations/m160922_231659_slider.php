<?php

use yii\db\Migration;

class m160922_231659_slider extends Migration
{
    public function up()
    {
        $this->createTable('slider', [
            'id'=>$this->primaryKey(),
            'image'=>$this->string(255),
            'name'=>$this->string(255),
            'content_image'=>$this->string(255),
            'content'=>$this->text(),
            'link'=>$this->string(255),
            'order'=>$this->integer(11)->defaultValue(1)
        ]);
    }

    public function down()
    {
        $this->dropTable('slider');

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
