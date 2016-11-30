<?php
/**
 *
 */

use yii\helpers\Html;

$this->title = $model->name.' - '.Yii::$app->name;
?>
<section class="page page-single-event">
    <h2><?=$model->name?></h2>
    <main class="wrapper wrapper-event">
        <div class="desc">
            <div class="content"><?=$model->getImage() ? Html::img($model->getImage()->getUrl('x230')):''?>
                <?=Html::decode($model->description)?>
            </div>
            <div class="date text-right"><?=DateTime::createFromFormat('Y-m-d H:m:s', $model->date)->format('d.m.Y')?></div>
        </div>
        <div class="text-center">
            <!-- Put this script tag to the <head> of your page -->
            <script type="text/javascript" src="//vk.com/js/api/openapi.js?130"></script>

            <script type="text/javascript">
                VK.init({apiId: 5643187, onlyWidgets: true});
            </script>

            <!-- Put this div tag to the place, where the Comments block will be -->
            <div id="vk_comments" style="margin: 0 auto;"></div>
            <script type="text/javascript">
                VK.Widgets.Comments("vk_comments", {limit: 20, width: "670", attach: "*"});
            </script>
        </div>
    </main>
</section>
