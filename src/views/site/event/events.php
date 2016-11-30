<?php
/**
 *
 */
use app\widgets\Filter;
use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\helpers\Url;

$this->title = 'Мероприятия - '.Yii::$app->name;
?>
<section class="page page-events">
    <h2>Мероприятия</h2>
    <?=Filter::widget(['view'=>'cities'])?>
    <div class="wrapper wrapper-items" id="filterOuter">
        <?php foreach($models as $model): ?>
            <div class="item">
                <div class="desc"><?=Html::img($model->getImage()->getUrl('245x290'))?>
                    <h3><?=Html::encode($model->name)?></h3>
                    <?=StringHelper::truncateWords(Html::decode($model->description), 20, '')?>
                </div><?=Html::a('Подробнее', Url::to('event/'.$model->slug), ['class'=>'btn btn-default'])?><?=Html::a('Купить билет', Url::to('event/'.$model->slug.'#event-order'), ['class'=>'btn btn-info'])?>
            </div>
        <?php endforeach; ?>
    </div>
</section>