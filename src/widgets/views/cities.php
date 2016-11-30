<?php
/**
 *
 * @var PsiWhiteSpace $models
 */
use yii\helpers\Url;

?>
<form class="wrapper wrapper-filter" id="filterForm" action="<?=Url::current()?>">
    <?php if($cities):
    foreach ($cities as $k => $city): ?>
        <div class="form-group form-group-inline">
            <input type="checkbox" name="cities[]" value="<?=$city?>" id="style<?=$k?>" class="styled">
            <label for="style<?=$k?>" class="styling"></label>
            <label for="style<?=$k?>"><?=$city?></label>
        </div>
    <?php endforeach; endif; ?>
    <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>">
</form>
