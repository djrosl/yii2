<?php

namespace app\modules\admin;

use nullref\admin\interfaces\IMenuBuilder;
use nullref\core\components\Module as BaseModule;
use nullref\core\interfaces\IAdminModule;
use Yii;
use yii\base\InvalidConfigException;

class Module extends \nullref\admin\Module implements IAdminModule
{
    public static function getAdminMenu()
    {
        return [
            'label' => 'Панель управления',
            'items'=> [
                [
                    'label' => 'Администраторы',
                    'url' => ['/admin/user'],
                ],
                [
                    'label' => 'Слайдер',
                    'url' => ['/admin/slider'],
                    'icon' => '',
                ],
                [
                    'label' => 'Артисты',
                    'url' => ['/admin/artist'],
                    'icon' => '',
                ],
                [
                    'label' => 'Мероприятия',
                    'url' => ['/admin/event'],
                    'icon' => '',
                ],
                [
                    'label' => 'Новости',
                    'url' => ['/admin/news'],
                    'icon' => '',
                ],
                [
                    'label' => 'Фото',
                    'url' => ['/admin/photo'],
                    'icon' => '',
                ],
                [
                    'label' => 'Видео',
                    'url' => ['/admin/video'],
                    'icon' => '',
                ],
                [
                    'label' => 'Настройки',
                    'url' => ['/admin/settings/combine'],
                    'icon' => '',
                ],
                [
                    'label' => 'Рассылка',
                    'url' => ['/admin/mailing'],

                ],
                [
                    'label' => 'Адреса для рассылки',
                    'url' => ['/admin/email'],

                ]
            ]
        ];
    }

    public function init()
    {
        parent::init();
        // инициализация модуля с помощью конфигурации, загруженной из config.php
        \Yii::configure($this, require(__DIR__ . '/config.php'));
    }

}
