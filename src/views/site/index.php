<?php
use app\models\Settings;
use app\modules\admin\components\ModelHelper;
use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
$this->title = Yii::$app->name;
?>
<section class="artists">
    <h2>Артисты</h2>
    <div id="artistSlider">
        <?php foreach($artists as $model): ?>
            <div class="item">
                <div class="desc"><?=Html::img($model->getImage()->getUrl('245x205'))?>
                    <h3><?=Html::encode($model->name)?></h3>
                    <p><?=StringHelper::truncateWords(Html::encode(strip_tags(html_entity_decode($model->description))), 20, '')?></p>
                </div><?=Html::a('Подробнее', Url::to('artist/'.$model->slug), ['class'=>'btn btn-default'])?><?=Html::a('Заказать', Url::to('artist/'.$model->slug.'#artist-order'), ['class'=>'btn btn-info'])?>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="text-center"><?=Html::a('Смотреть всех', Url::to(['site/artists']), ['class'=>'btn btn-info'])?></div>
</section>
<section class="events">
    <h2>Мероприятия</h2>
    <div id="eventsSlider">
        <?php foreach($events as $model): ?>
        <div class="item">
            <div class="desc"><?=Html::img($model->getImage()->getUrl('245x290'))?>
                <h3><?=Html::encode($model->name)?></h3>
                <?=StringHelper::truncateWords(Html::decode($model->description), 20, '')?>
            </div><?=Html::a('Подробнее', Url::to('event/'.$model->slug), ['class'=>'btn btn-default'])?><?=Html::a('Купить билет', Url::to('event/'.$model->slug.'#event-order'), ['class'=>'btn btn-info'])?>
        </div>
        <?php endforeach; ?>
    </div>
    <div class="text-center"><?=Html::a('Все мероприятия', Url::to(['site/events']), ['class'=>'btn btn-info'])?></div>
</section>
<section class="about">
    <div class="wrapper">
        <h2>О нас</h2>
        <div class="content">
            <?=Html::decode(Settings::findOne(['slug'=>'about_us'])->content)?>
        </div>
    </div>
</section>
<section class="news">
    <h2>Новости</h2>
    <div class="wrapper">
        <?php foreach($news as $model): ?>
        <div class="item"><?=$model->getImage() ? Html::img($model->getImage()->getUrl('144x138')) : ''?>
            <div class="right">
                <header>
                    <h3><?=$model->name?></h3>
                    <div class="date"><?=DateTime::createFromFormat('Y-m-d H:m:s', $model->date)->format('d.m.Y')?></div>
                </header>
                <?=StringHelper::truncateWords($model->description, 20)?>
                <a href="<?=Url::to(['news/'.$model->slug])?>" class="btn btn-info">Подробнее</a>
            </div>
        </div>
        <?php endforeach; ?>

    </div>
    <div class="text-center"><a href="<?=Url::to(['site/news'])?>" class="btn btn-info">Все новости</a></div>
</section>
<section class="gallery">
    <h2>Фотоотчеты</h2>
    <div id="gallerySlider">
        <?php foreach ($photos as $model): ?>
        <div class="item">
            <div class="img-wrp">
                <?=$model->getImage() ? Html::img($model->getImage()->getUrl('305x206')): ''?>
            </div>
            <h3><?=$model->name?></h3><a href="<?=Url::to(['site/photo', 'id'=>$model->id])?>" class="btn btn-info light-gallery-dynamic">Смотреть</a>
        </div>
        <?php endforeach; ?>
    </div>
</section>
<section class="video">
    <h2>Видео</h2>
    <div class="wrapper light-gallery-wrapper">
        <?php foreach ($videos as $model): ?>
            <a href="<?=$model->video?>" class="item">
                <h3><?=$model->name?></h3><?=Html::img(ModelHelper::formatSingleVideo($model->video))?>
            </a>
        <?php endforeach; ?>
    </div>
    <div class="text-center"><a href="/video.html" class="btn btn-info">Все видео</a></div>
</section>