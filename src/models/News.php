<?php

namespace app\models;

use Yii;
use zabachok\behaviors\SluggableBehavior;

/**
 * This is the model class for table "news".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $date
 * @property string $image
 */
class News extends \yii\db\ActiveRecord
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
        return 'news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['date'], 'safe'],
            [['name', 'image', 'slug'], 'string', 'max' => 255],
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
            'description' => 'Полный текст',
            'date' => 'Дата',
            'image' => 'Изображение',
        ];
    }
}
