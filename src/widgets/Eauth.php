<?php

namespace app\widgets;

use nodge\eauth\Widget;
use yii\helpers\Json;

class Eauth extends Widget {

    public $assetBundle = 'app\\assets\\eauth\\WidgetAssetBundle';
    
    public function run()
    {

        $isLogged = Json::decode(\Yii::$app->request->cookies->getValue('social-user'));
        
        echo $this->render('eauth', [
            'id' => $this->getId(),
            'services' => $this->services,
            'action' => $this->action,
            'popup' => $this->popup,
            'assetBundle' => $this->assetBundle,
            'isLogged'=>$isLogged,
        ]);
    }
    
}