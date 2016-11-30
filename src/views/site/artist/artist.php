<?php
/**
 *
 */
use app\components\Formatter;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $model->name.' - '.Yii::$app->name;

?>
<section class="page page-single-artist">
    <h2><?=Html::encode($model->name)?></h2>
    <main class="wrapper wrapper-artist">
        <div class="desc clearfix">
            <div class="content"><?=$model->getImage() ? Html::img($model->getImage()->getUrl('350x')):''?>
                <?=Html::decode(Formatter::removeAttributes($model->description))?>
            </div>
        </div>
        <div id="artistPhotos">
            <?php foreach ($model->getImages() as $image): if($image != $model->getImage()): ?>
            <a href="<?=$image->getUrl()?>" class="photo">
                <?=Html::img($image->getUrl('244x203'))?>
            </a>
            <?php endif; endforeach; ?>
        </div>
        <?php if($model->formatVideo()): ?>
        <div class="video">
            <h3>Видео</h3>
            <div class="light-gallery-wrapper text-left">
                <?php foreach ($model->formatVideo() as $video): ?>
                <a href="<?=$video['url']?>" class="item">
                    <h3><?=$video['title']?></h3><?=Html::img($video['image'])?>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
        <?php if($model->audio): ?>
        <div class="audio-block">
            <h3>Аудио</h3>
            <div class="audio-items">
                <?php foreach($model->audio as $track): ?>
                <div class="audio">
                    <label for=""><?=$track->name?></label>
                    <audio src="<?=$track->path?>" controls></audio>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
        <br><br><br>
        <div class="text-center">
            <a data-modal="fastorder" class="modal-opener btn btn-info"
            data-hidden-fields='[
                {
                    "name":"artist_name",
                    "label":"Имя артиста",
                    "value":"<?=$model->name?>"
                },
                {
                    "name":"artist_link",
                    "label":"Ссылка на артиста",
                    "value":"<?=Yii::$app->urlManager->createAbsoluteUrl(['artist/'.$model->slug])?>"
                }
            ]'">Быстрый заказ</a>
        </div>
        <form id="artist-order" class="artist-order prepare-ajax" action="<?=Yii::$app->urlManager->createAbsoluteUrl(['form/process'])?>">

            <input type="hidden" name="artist_name" value="<?=$model->name?>" data-label="Имя артиста">
            <input type="hidden" name="artist_link" value="<?=Yii::$app->urlManager->createAbsoluteUrl(['artist/'.$model->slug])?>" data-label="Ссылка на артиста">

            <header>Форма заказа</header>
            <div class="input-group">
                <div class="form-group">
                    <label>Дата ивента</label>
                    <input type="date" name="event_date">
                </div>
                <div class="form-group">
                    <label>Страна</label>
                    <input type="text" name="event_country">
                </div>
                <div class="form-group">
                    <label>Город</label>
                    <input type="text" name="event_city">
                </div>
                <div class="form-group">
                    <label>Место проведения</label>
                    <input type="text" name="event_place">
                </div>
                <div class="form-group">
                    <label>Вместительность</label>
                    <input type="number" name="event_roominess">
                </div>
            </div>
            <div class="input-group">
                <div class="form-group">
                    <label>Полное имя</label>
                    <input type="text" name="name" value="<?=!empty($isLogged['name']) ? $isLogged['name'] : ''?>">
                </div>
                <div class="form-group">
                    <label>Название компании</label>
                    <input type="text" name="company">
                </div>
                <div class="form-group">
                    <label>E-mail</label>
                    <input type="email" name="email" value="<?=!empty($isLogged['email']) ? $isLogged['email'] : ''?>">
                </div>
                <div class="form-group">
                    <label>Номер телефона</label>
                    <input type="tel" name="phone">
                </div>  
                <div class="form-group">
                    <label>Цена входа</label>
                    <input type="text" name="event_price">
                </div>
            </div>
            <div class="form-group">
                <label>Краткое описание мероприятия</label>
                <textarea name="event_description"></textarea>
            </div>

            <input type="hidden" name="form_title" value="Заказ артиста" data-label="Форма">
            <div class="text-right">
                <button class="btn btn-info">Отправить</button>
            </div>
        </form>
    </main>
</section>
