<?php
/**
 *
 */
use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\helpers\Url;

$this->title = 'НОВОСТИ - '.Yii::$app->name;

?>

<section class="page page-events">
    <h2>Новости</h2>
    <div class="wrapper news text-center">

        <?php foreach($models as $model): ?>
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
</section>
