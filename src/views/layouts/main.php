<?php
use app\assets\AppAsset;
use app\components\Formatter;
use app\widgets\MainSlider;
use app\widgets\Modal;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\helpers\VarDumper;
use yii\widgets\Breadcrumbs;
use app\widgets\Eauth;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

    <script>
        var openEmailPopup = '<?=(bool)\Yii::$app->request->cookies['is-email'];?>';
    </script>
</head>
<body>

<?php $this->beginBody() ?>

<header class="main"><a href="/" class="logo"><img src="/template/images/logo.png" alt="NOTA production"></a>
    <div class="social-enter"><?= Eauth::widget(['action' => 'site/login']); ?></div>
    <div class="phone"><?=Formatter::formatPhone()?></div>
    <nav class="header-nav">
        <ul>
            <li><?=Html::a('Артисты', Url::to(['site/artists']))?></li>
            <li><?=Html::a('Мероприятия', Url::to(['site/events']))?></li>
            <li><?=Html::a('Фото', Url::to(['site/photo']))?></li>
            <li><?=Html::a('Видео', Url::to(['site/video']))?></li>
            <li><?=Html::a('Новости', Url::to(['site/news']))?></li>
            <li><?=Html::a('О нас', Url::to(['site/about']))?></li>
        </ul>
    </nav>
</header>


<?=MainSlider::widget([])?>

<?=$content?>

<footer class="main"><a href="" class="logo"><img src="/template/images/logo.png" alt=""></a>
    <div class="social-enter"><?= \app\widgets\Eauth::widget(['action' => 'site/login']); ?></div>
    <div class="phone"><?=Formatter::formatPhone()?></div>
    <nav class="header-nav">
        <ul>
            <li><?=Html::a('Артисты', Url::to(['site/artists']))?></li>
            <li><?=Html::a('Мероприятия', Url::to(['site/events']))?></li>
            <li><?=Html::a('Фото', Url::to(['site/photo']))?></li>
            <li><?=Html::a('Видео', Url::to(['site/video']))?></li>
            <li><?=Html::a('Новости', Url::to(['site/news']))?></li>
            <li><?=Html::a('О нас', Url::to(['site/about']))?></li>
        </ul>
    </nav>
</footer>

<?=Modal::widget([
    'header'=>'Быстрый заказ',
    'sub_header' => 'Заполните форму, наш менеджер свяжется с Вами в ближайшее время.',
    'form_title' => 'Быстрый заказ',
    'fields'=>[
        [
            'type'=>'text',
            'slug'=>'name',
            'label'=>'Ваше имя'
        ],
        [
            'type'=>'text',
            'slug'=>'phone',
            'label'=>'Ваш номер телефона'
        ],
        [
            'type'=>'email',
            'slug'=>'email',
            'label'=>'Ваш email'
        ],
    ],
    'slug'=>'fastorder'
])?>

<?=Modal::widget([
    'header'=>'Не нашли артиста?',
    'sub_header' => 'Заполните форму, наш менеджер свяжется с Вами в ближайшее время.',
    'form_title' => 'Заявка на поиск артиста',
    'fields'=>[
        [
            'type'=>'text',
            'slug'=>'name',
            'label'=>'Ваше имя'
        ],
        [
            'type'=>'tel',
            'slug'=>'phone',
            'label'=>'Ваш номер телефона'
        ],
        [
            'type'=>'email',
            'slug'=>'email',
            'label'=>'Ваш email'
        ],
    ],
    'slug'=>'notfound'
])?>

<?=Modal::widget([
    'header'=>'Форма отправлена!',
    'sub_header' => '',
    'form_title' => '',
    'fields'=>[],
    'slug'=>'success'
])?>

<?=Modal::widget([
    'header'=>'Введите email',
    'sub_header' => 'для завершения регистрации',
    'form_title' => '',
    'fields'=>[
        [
            'type'=>'email',
            'slug'=>'email',
            'label'=>'Ваш email'
        ],
    ],
    'slug'=>'addProfile',
    'action'=>'/site/add-profile',
])?>

<?php $this->endBody() ?>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAMKeK8jUZVET46vb1rwV1WaLTfWZa6XTE&callback=initMap"></script>
</body>
</html>
<?php $this->endPage() ?>
