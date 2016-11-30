<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'template/styles/reset.css',
        'template/assets/owl-carousel/owl.carousel.css',
        'template/assets/owl-carousel/owl.theme.css',
        'template/assets/selectize/dist/css/selectize.css',
        'template/assets/ion.rangeSlider/css/ion.rangeSlider.css',
        'template/assets/ion.rangeSlider/css/ion.rangeSlider.skinFlat.css',
        'template/assets/lightgallery/dist/css/lightgallery.min.css',
        'template/styles/style.css',
        'template/styles/media.css',
        'css/site.css',
    ];
    public $js = [
        'js/tools.js',
        'template/assets/owl-carousel/owl.carousel.min.js',
        'template/assets/selectize/dist/js/standalone/selectize.min.js',
        'template/assets/ion.rangeSlider/js/ion.rangeSlider.min.js',
        'template/assets/lightgallery/dist/js/lightgallery-all.js',
        'template/scripts/main.js',
        'js/scripts.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
