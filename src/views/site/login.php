<?php
if (Yii::$app->getSession()->hasFlash('error')) {
    echo '<div class="alert alert-danger">'.Yii::$app->getSession()->getFlash('error').'</div>';
}
?>

<?= \app\widgets\Eauth::widget(['action' => 'site/login']); ?>