<?php

namespace app\models;

use app\modules\admin\components\ModelHelper;
use Yii;
use zabachok\behaviors\SluggableBehavior;

/**
 * This is the model class for table "artist".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $country
 * @property string $genre
 * @property string $price
 * @property string $image
 * @property string $gallery
 * @property string $videos
 * @property string $audios
 */
class Artist extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            'image' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ],
            'slug' => [
                'class' => SluggableBehavior::className(),
                'attribute' => 'name',
                'slugAttribute' => 'slug',
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'artist';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description', 'videos', 'audios', 'name', 'country', 'genre', 'price', 'image', 'gallery', 'slug'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'description' => 'Инфо',
            'country' => 'Страна',
            'genre' => 'Жанр',
            'price' => 'Цена',
            'image' => 'Фото главное',
            'gallery' => 'Другие фото',
            'videos' => 'Ссылки на видео (youtube)',
            'audios' => 'Аудио',
        ];
    }

    public function getGalleryArray($sizes = '100x100') {
        $out = [];
        foreach($this->getImages() as $image){
            if($image){
                $out[] = $image->getUrl($sizes);
            }
        }

        return $out;
    }

    public function getAudio() {
        return $this->hasMany(Audio::className(), ['artist_id'=>'id']);
    }
    
    public function formatVideo() {
        return ModelHelper::formatVideo($this->videos);
    }

}
