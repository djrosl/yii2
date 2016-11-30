<?php
/**
 *
 * @var PsiWhiteSpace $models
 */
use yii\helpers\Url;

?>
<form class="wrapper wrapper-filter" id="filterForm" action="<?=Url::current()?>">
    <div class="left">
        <div class="form-group">
            <label>Страна</label>
            <select class="form-control" name="country">
                <option value="">Все страны</option>
                <?php if($countries):
                foreach($countries as $country): ?>
                    <option value="<?=$country?>"><?=$country?></option>
                <?php endforeach; endif; ?>
            </select>
        </div>
        <div class="form-group">
            <label>Стоимость</label>
            <div class="slider">
                <input type="text" name="price" class="price-slider">
            </div>
        </div>
    </div>
    <div class="right">
        <?php if($genres):
        foreach ($genres as $k => $genre): if($genre): ?>
            <div class="form-group form-group-inline">
                <input type="checkbox" name="genres[]" value="<?=$genre?>" id="style<?=$k?>" class="styled">
                <label for="style<?=$k?>" class="styling"></label>
                <label for="style<?=$k?>"><?=$genre?></label>
            </div>
        <?php endif; endforeach; endif; ?>
    </div>
    <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>">
</form>
