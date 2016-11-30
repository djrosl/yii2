<?php

namespace app\widgets;

use app\models\Slider;
use app\modules\admin\components\ModelHelper;
use yii\base\Widget;

class Filter extends Widget {

    public $view = 'artist'; 
    
    public function run() {

        $availableGenres = ModelHelper::getCollection('genres');
        $availableCountries = ModelHelper::getCollection('countries');
        $availableCities = ModelHelper::getCollection('cities');

        //$models = Slider::find()->orderBy('order ASC')->all();
        
        return $this->render($this->view, [
            'genres'=>$availableGenres,
            'countries'=>$availableCountries,
            'cities'=>$availableCities,
        ]);
    }

}