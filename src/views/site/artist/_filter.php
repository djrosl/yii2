<?php
/**
 *
 */
use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\helpers\Url;

?>

<?php foreach($models as $model): ?>
    <div class="item">
        <div class="desc"><?=Html::img($model->getImage()->getUrl('245x205'))?>
            <h3><?=Html::encode($model->name)?></h3>
            <p><?=StringHelper::truncateWords(Html::encode(strip_tags(html_entity_decode($model->description))), 20, '')?></p>

        </div><?=Html::a('Подробнее', Url::to('artist/'.$model->slug), ['class'=>'btn btn-default'])?><?=Html::a('Заказать', Url::to('artist/'.$model->slug.'#artist-order'), ['class'=>'btn btn-info'])?>
    </div>
<?php endforeach; ?>
