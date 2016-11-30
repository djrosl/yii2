<?php
/**
 *
 */

use app\modules\admin\components\ModelHelper;
use app\widgets\Filter;
use yii\helpers\Html;

$this->title = 'ВИДЕО - '.Yii::$app->name;
?>

<section class="page page-events">
    <h2>Видео</h2>
    <?=Filter::widget(['view'=>'cities'])?>
    <div class="wrapper video light-gallery-wrapper" id="filterOuter">
        <?php foreach ($models as $model): ?>
        <a href="<?=$model->video?>" class="item">
            <h3><?=$model->name?></h3><?=Html::img(ModelHelper::formatSingleVideo($model->video))?>
        </a>
        <?php endforeach; ?>
    </div>  
</section>
