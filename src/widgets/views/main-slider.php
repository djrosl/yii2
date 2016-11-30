<?php use yii\helpers\Html;
use yii\helpers\StringHelper;

?>
<div id="topSlider">
    <?php foreach($models as $model): ?>
    <div class="item"><?=$model->getImage() ? Html::img($model->getImage()->getUrl('1920x975')) : ''?>
        <div class="info">
            <div class="left">
                <?=$model->getImageByName('content_image') ? Html::img($model->getImageByName('content_image')->getUrl()) : ''?>
            </div>
            <div class="right">
                <h2><?=Html::encode($model->name)?></h2>
                <p>
                    <?=StringHelper::truncateWords(Html::decode($model->content), 90)?>
                </p>
                <?=Html::a('Подробнее', $model->link, ['class'=>'btn btn-info'])?>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>