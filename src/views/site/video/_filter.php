<?php
/**
 *
 * @var array|\yii\db\ActiveRecord[] $models
 */
use app\modules\admin\components\ModelHelper;
use yii\helpers\Html;

?>
<?php foreach ($models as $model): ?>
    <a href="<?=$model->video?>" class="item">
        <h3><?=$model->name?></h3><?=Html::img(ModelHelper::formatSingleVideo($model->video))?>
    </a>
<?php endforeach; ?>
