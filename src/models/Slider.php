<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "slider".
 *
 * @property integer $id
 * @property string $image
 * @property string $name
 * @property string $content_image
 * @property string $content
 * @property string $link
 * @property integer $order
 */
class Slider extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            'image' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ]
        ];
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'slider';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['order'], 'integer'],
            [['image', 'name', 'content_image', 'link'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'image' => 'Главное изображение',
            'name' => 'Название',
            'content_image' => 'Контентное изображение',
            'content' => 'Текст слайда',
            'link' => 'Ссылка',
            'order' => 'Номер по порядку',
        ];
    }
}
