<?php

use app\modules\admin\assets\AdminAsset;
use app\modules\admin\assets\MenuAsset;

$params = require(__DIR__ . '/params.php');
$modules = require(__DIR__ . '/modules.php');

$config = [
    'id' => 'app',
    'name' => 'NOTA production',
    'basePath' => dirname(__DIR__),
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'runtimePath' => dirname(dirname(__DIR__)) . '/runtime',
    'bootstrap' => ['log'],
    'components' => [
        'assetManager' => [
            'appendTimestamp' => true,
            /*'bundles' => [
                'yii\bootstrap\BootstrapPluginAsset' => [
                    'js'=>[]
                ],
                'yii\bootstrap\BootstrapAsset' => [
                    'css' => [],
                ],

            ],*/
        ],
        'formatter' => [
            'class' => 'app\components\Formatter',
        ],
        'request' => [
            'cookieValidationKey' => 'RiAveGUdUACvWZppHVevMJRGd5Rij8uh',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'dektrium\user\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => false/*YII_ENV_DEV*/,
            'htmlLayout' => 'layout',
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',
                'username' => 'dubztep45',
                'password' => 'KSEQRB0794',
                'port' => '587',
                'encryption' => 'tls',
            ],
        ],

        'eauth' => [
            'class' => 'nodge\eauth\EAuth',
            'popup' => true, // Use the popup window instead of redirecting.
            'cache' => false, // Cache component name or false to disable cache. Defaults to 'cache' on production environments.
            'cacheExpire' => 0, // Cache lifetime. Defaults to 0 - means unlimited.
            'httpClient' => [
                // uncomment this to use streams in safe_mode
                //'useStreamsFallback' => true,
            ],
            'services' => [ // You can change the providers and their classes.
                'google' => [
                    // register your app here: https://code.google.com/apis/console/
                    'class' => 'nodge\eauth\services\GoogleOAuth2Service',
                    'clientId' => '30216939621-6htiuvcu1fr284hkt6m1te5jvnkf90q9.apps.googleusercontent.com',
                    'clientSecret' => '_yl-Krcil_wRxtJmRJCC_O-5',
                    'title' => 'Google',
                ],
                'vkontakte' => [
                    // register your app here: https://vk.com/editapp?act=create&site=1
                    'class' => 'nodge\eauth\services\VKontakteOAuth2Service',
                    'clientId' => '5643187',
                    'clientSecret' => 'QvbVmUzamw4VQZL4dfQ6',
                ],
                'facebook' => [
                    // register your app here: https://developers.facebook.com/apps/
                    'class' => 'nodge\eauth\services\FacebookOAuth2Service',
                    'clientId' => '310538139302808',
                    'clientSecret' => '978fdca6bb368e5ed0e558bfdd1a439f',
                ],
                'instagram' => [
                    // register your app here: https://instagram.com/developer/register/
                    'class' => 'nodge\eauth\services\InstagramOAuth2Service',
                    'clientId' => 'f63a0b717faf4c09a687cb44fad8c3f1',
                    'clientSecret' => '99041b45c82646968ef2c1e00ffa4832',
                ],
                'twitter' => [
                    // register your app here: https://dev.twitter.com/apps/new
                    'class' => 'nodge\eauth\services\TwitterOAuth1Service',
                    'key' => 'sLMpcSorYOwkTGPEXaiIbaSri',
                    'secret' => 'bJQSybj7b3pFal1Yi7YvXFMgzqHlgbtHgwN8XkCOWqEPgQFUAu',
                ],
                'yandex' => [
                    // register your app here: https://oauth.yandex.ru/client/my
                    'class' => 'nodge\eauth\services\YandexOAuth2Service',
                    'clientId' => '0b1e15e85ce64e40b96e75cdaf410ed1',
                    'clientSecret' => '6cb9578ce09447b58448b0636a9a5e88',
                    'title' => 'Yandex',
                ],
            ],
        ],


        'i18n' => [
            'translations' => [
                '*' => ['class' => 'yii\i18n\PhpMessageSource'],
                'eauth' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@eauth/messages',
                ],
            ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules'=>[
                'artists'=>'site/artists',
                'events'=>'site/events',
                'news'=>'site/news',
                'about'=>'site/about',
                'photo'=>'site/photo',
                'video'=>'site/video',
                'news/<slug>'=>'site/single-news',
                'artist/<slug>'=>'site/artist',
                'event/<slug>'=>'site/event',
            ]
        ],
        'db' => require(__DIR__ . '/db.php'),
    ],
    'modules' => $modules,
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs'=>['46.63.24.252']
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs'=>['46.63.24.252']
    ];
}

return $config;
