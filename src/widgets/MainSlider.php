<?php

namespace app\widgets;

use app\models\Slider;
use yii\base\Widget;

class MainSlider extends Widget {

    public function run() {

        $models = Slider::find()->orderBy('order ASC')->all();

        return $this->render('main-slider', ['models'=>$models]);
    }

}