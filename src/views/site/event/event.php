<?php
/**
 *
 */
use yii\helpers\Html;

$this->title = $model->name.' - '.Yii::$app->name;

?>
<section class="page page-single-event">
    <h2><?=Html::encode($model->name)?></h2>
    <main class="wrapper wrapper-event">
        <div class="desc ">
            <div class="content clearfix"><div class="content"><?=$model->getImage() ? Html::img($model->getImage()->getUrl('250x')):''?>
                    <div class="date">Дата: <?=DateTime::createFromFormat('Y-m-d H:m:s', $model->date)->format('d.m.Y')?></div>
                    <div class="place">Вечеринка в г. <?=$model->city?>, <?=$model->place?></div>
                    <?=Html::decode($model->description)?>
            </div>
        </div>
            <div id="artistPhotos">
                <?php foreach ($model->getImages() as $image): ?>
                    <a href="<?=$image->getUrl()?>" class="photo">
                        <?=Html::img($image->getUrl('244x203'))?>
                    </a>
                <?php endforeach; ?>
            </div>
            <?php if($model->formatVideo()): ?>
            <div class="video">
                <h3>Видео</h3>
                <div class="light-gallery-wrapper">
                    <?php foreach ($model->formatVideo() as $video): ?>
                        <a href="<?=$video['url']?>" class="item">
                            <h3><?=$video['title']?></h3><?=Html::img($video['image'])?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
            <?php if($model->getImageByName('scheme')): ?>
            <div class="scheme">
                <h3>Схема зала</h3>
                <div class="text-center"><?=$model->getImageByName('scheme') ? Html::img($model->getImageByName('scheme')->getUrl()):''?></div>
            </div>
            <?php endif; ?>
        <form id="event-order" class="event-order">
            <header>Купить билет</header>
            <div class="step1">
                <table>
                    <tr>
                        <td>Билет на 3 дня</td>
                        <td class="ticket-count">
                            <button class="btn btn-default">-</button>
                            <input type="text" name="" value="0" data-price="1070">
                            <button class="btn btn-info">+</button>
                        </td>
                        <td class="stripe"></td>
                        <td>1070 грн</td>
                    </tr>
                    <tr>
                        <td>Билет на 28.03</td>
                        <td class="ticket-count">
                            <button class="btn btn-default">-</button>
                            <input type="text" name="" value="0" data-price="270">
                            <button class="btn btn-info">+</button>
                        </td>
                        <td class="stripe"></td>
                        <td>270 грн</td>
                    </tr>
                    <tr>
                        <td>Билет на 29.03</td>
                        <td class="ticket-count">
                            <button class="btn btn-default">-</button>
                            <input type="text" name="" value="0" data-price="370">
                            <button class="btn btn-info">+</button>
                        </td>
                        <td class="stripe"></td>
                        <td>370 грн</td>
                    </tr>
                    <tr>
                        <td>Билет на 30.08</td>
                        <td class="ticket-count">
                            <button class="btn btn-default">-</button>
                            <input type="text" name="" value="0" data-price="570">
                            <button class="btn btn-info">+</button>
                        </td>
                        <td class="stripe"></td>
                        <td>570 грн</td>
                    </tr>
                </table>
                <div class="text-right">Всего <span id="price" class="price">0 грн</span></div>
            </div>
            <div class="step2 hidden">
                <div class="input-group">
                    <div class="form-group">
                        <label>Дата ивента</label>
                        <input type="date" name="">
                    </div>
                    <div class="form-group">
                        <label>Страна</label>
                        <input type="text" name="">
                    </div>
                    <div class="form-group">
                        <label>Город</label>
                        <input type="text" name="">
                    </div>
                    <div class="form-group">
                        <label>Место проведения</label>
                        <input type="text" name="">
                    </div>
                    <div class="form-group">
                        <label>Вместительность</label>
                        <input type="number" name="">
                    </div>
                </div>
                <div class="input-group">
                    <div class="form-group">
                        <label>Полное имя</label>
                        <input type="text" name="">
                    </div>
                    <div class="form-group">
                        <label>Название компании</label>
                        <input type="text" name="">
                    </div>
                    <div class="form-group">
                        <label>E-mail</label>
                        <input type="email" name="">
                    </div>
                    <div class="form-group">
                        <label>Номер телефона</label>
                        <input type="tel" name="">
                    </div>
                    <div class="form-group">
                        <label>Цена входа</label>
                        <input type="text" name="">
                    </div>
                </div>
                <div class="form-group">
                    <label>Краткое описание мероприятия</label>
                    <textarea></textarea>
                </div>
            </div>
            <div class="text-right">
                <button class="btn btn-info">Заказать</button>
            </div>
        </form>
    </main>
</section>
