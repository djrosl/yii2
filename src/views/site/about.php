<?php
/**
 *
 */
use app\models\Settings;

?>
<section class="page page-about">
    <h2>О нас</h2>
    <main class="wrapper content">
        <?=Settings::findOne(['slug'=>'about_us'])->content?>
        <div class="contacts">
            <div class="mail"><?=Settings::findOne(['slug'=>'email'])->content?></div>
            <div class="phone"><?=Settings::findOne(['slug'=>'phone'])->content?></div>
            <div class="address"><?=Settings::findOne(['slug'=>'address'])->content?></div>
        </div>
    </main>
    <div id="map"></div>
</section>
