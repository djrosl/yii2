<?php

use yii\helpers\Html;
use yii\helpers\VarDumper;
use yii\web\View;

/** @var $this View */
/** @var $id string */
/** @var $services stdClass[] See EAuth::getServices() */
/** @var $action string */
/** @var $popup bool */
/** @var $assetBundle string Alias to AssetBundle */

Yii::createObject(['class' => $assetBundle])->register($this);

// Open the authorization dilalog in popup window.
if ($popup) {
    $options = [];
    foreach ($services as $name => $service) {
        $options[$service->id] = $service->jsArguments;
    }
    $this->registerJs('$("#' . $id . '").eauth(' . json_encode($options) . ');');
}

?>

        <?php if($isLogged): ?>
            Привет, <?=$isLogged['name']?>!
        <?php else: ?>
            <span>Войти через: </span> <span id="<?=$id?>">
        <?php
        foreach ($services as $name => $service) { ?><?= Html::a('', [$action, 'service' => $name], [
                'class' => $service->id,
                'data-eauth-service' => $service->id,
            ]); ?><?php } ?>
        </span>
        <?php endif; ?>
