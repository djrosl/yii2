<?php
/**
 *
 */

use app\components\Formatter;
use app\widgets\Filter;
use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\helpers\Url;

$this->title = 'Артисты - '.Yii::$app->name;
?>

<section class="page page-artists">
    <h2>Артисты</h2>
    
    <?=Filter::widget(['view'=>'artist'])?>
    
    <div class="wrapper wrapper-items" id="filterOuter">
        <?php foreach($models as $model): ?>
        <div class="item">
            <div class="desc"><?=Html::img($model->getImage()->getUrl('245x205'))?>
                <h3><?=Html::encode($model->name)?></h3>
                <p><?=StringHelper::truncateWords(Html::encode(strip_tags(html_entity_decode($model->description))), 20, '')?></p>
            </div><?=Html::a('Подробнее', Url::to('artist/'.$model->slug), ['class'=>'btn btn-default'])?><?=Html::a('Заказать', Url::to('artist/'.$model->slug.'#artist-order'), ['class'=>'btn btn-info'])?>
        </div>
        <?php endforeach; ?>

    </div>
    <div class="text-center content">Не нашли нужного Вам артиста в списке? <a href="" class="modal-opener" data-modal="notfound">Свяжитесь</a> с нами</div>
</section>
