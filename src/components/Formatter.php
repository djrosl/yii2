<?php
/**
 */

namespace app\components;


use app\models\Settings;

class Formatter extends \yii\i18n\Formatter
{

    public static function formatPhone() {
        $string = Settings::findOne(['slug'=>'phone'])->content;
        $string = preg_replace('/\s+/', '', $string);
        $start = substr($string, 0, 6);
        $start = substr_replace($start, ' ', 4, 0);
        $start = substr_replace($start, ' ', 7, 0);
        $end = substr($string, 6);
        $end = substr_replace($end, ' ', 3, 0);
        $end = substr_replace($end, ' ', 6, 0);
        return "<span>".$start."</span>".$end;
    }
    
    public static function removeAttributes($text){
        return preg_replace("/<([a-z][a-z0-9]*)[^>]*?(\/?)>/i",'<$1$2>', $text);
    } 

}