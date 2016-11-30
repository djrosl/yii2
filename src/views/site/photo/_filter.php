<?php
/**
 *
 * @var array|\yii\db\ActiveRecord[] $models
 */
use yii\helpers\Html;
use yii\helpers\Url;

?>
<?php foreach($models as $model): ?>
    <div class="item">
        <div class="img-wrp">
            <?=$model->getImage() ? Html::img($model->getImage()->getUrl('x205')): ''?>
        </div>
        <h3><?=$model->name?></h3><a href="<?=Url::to(['site/photo', 'id'=>$model->id])?>" class="btn btn-info light-gallery-dynamic">Смотреть</a>
    </div>
<?php endforeach; ?>
