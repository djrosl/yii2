<?php

namespace app\models;

use app\modules\admin\components\ModelHelper;
use Yii;
use zabachok\behaviors\SluggableBehavior;

/**
 * This is the model class for table "event".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $date
 * @property string $place
 * @property string $city
 * @property string $image
 * @property string $gallery
 * @property string $videos
 */
class Event extends \yii\db\ActiveRecord
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
        return 'event';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description', 'videos'], 'string'],
            [['date'], 'safe'],
            [['name', 'place', 'city', 'image', 'gallery', 'slug', 'scheme'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'description' => 'Описание',
            'date' => 'Дата',
            'place' => 'Место проведения',
            'city' => 'Город',
            'image' => 'Афиша',
            'gallery' => 'Галерея',
            'videos' => 'Ссылки на видео (youtube)',
        ];
    }


    public function formatVideo() {
        return ModelHelper::formatVideo($this->videos);
    }
}
