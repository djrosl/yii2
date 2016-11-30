<?php

return array_merge(require(__DIR__ . '/installed_modules.php'), [
   'core' => ['class' => 'nullref\core\Module'],
   'admin' => [
     'class' => 'app\modules\admin\Module',
     'controllerMap' => [  //controllers
         'user' => 'app\modules\admin\controllers\UserController',
         'main' => 'app\modules\admin\controllers\MainController',
     ],
   ],
    'yii2images' => [
        'class' => 'rico\yii2images\Module',
        //be sure, that permissions ok
        //if you cant avoid permission errors you have to create "images" folder in web root manually and set 777 permissions
        'imagesStorePath' => 'files/store', //path to origin images
        'imagesCachePath' => 'files/cache', //path to resized copies
        'graphicsLibrary' => 'GD', //but really its better to use 'Imagick'
        //'placeHolderPath' => '@webroot/files/placeHolder.png', // if you want to get placeholder when image not exists, string will be processed by Yii::getAlias
    ],
    'user' => [
        'class' => 'dektrium\user\Module',
        'modelMap' => [
            'User' => 'app\models\User'
        ],
    ],
]);
