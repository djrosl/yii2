<?php

use yii\db\Migration;

class m160921_194009_nota_init extends Migration
{
    public function up()
    {
        $this->createTable('artist', [
            'id' => $this->primaryKey(),
            'name'=> $this->string(255),
            'description' => $this->text(),

            'country'=> $this->string(255),
            'genre'=> $this->string(255),
            'price'=> $this->string(255),

            'image' => $this->string(255),
            'gallery' => $this->string(255),

            'videos' => $this->text(),
            'audios' => $this->text(),
        ]);

        $this->createTable('event', [
            'id' => $this->primaryKey(),
            'name'=> $this->string(255),
            'description' => $this->text(),

            'date'=> $this->dateTime(),
            'place'=> $this->string(255),
            'city'=> $this->string(255),

            'image' => $this->string(255),
            'gallery' => $this->string(255),

            'videos' => $this->text(),
        ]);

        $this->createTable('photo', [
            'id' => $this->primaryKey(),
            'name'=> $this->string(255),

            'city'=> $this->string(255),

            'gallery' => $this->string(255),
        ]);

        $this->createTable('video', [
            'id' => $this->primaryKey(),
            'name'=> $this->string(255),

            'city'=> $this->string(255),

            'video' => $this->string(255),
        ]);

        $this->createTable('news', [
            'id' => $this->primaryKey(),
            'name'=> $this->string(255),
            'description' => $this->text(),

            'date'=> $this->dateTime(),

            'image' => $this->string(255),
        ]);

        $this->createTable('settings', [
            'id'=>$this->primaryKey(),
            'name' =>$this->string(255),
            'slug'=>$this->string(255),
            'content'=>$this->text()
        ]);
    }

    public function down()
    {
        $this->dropTable('artist');
        $this->dropTable('event');
        $this->dropTable('photo');
        $this->dropTable('video');
        $this->dropTable('news');
        $this->dropTable('settings');
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
