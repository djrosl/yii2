<?php

namespace app\widgets;

use app\models\Email;
use yii\base\Widget;
use yii\helpers\Json;

class Modal extends Widget {

    public $fields = [];

    public $slug = '';

    public $header = '';

    public $sub_header = '';

    public $form_title = '';
    
    public $action = '';

    public function run(){
        if(!$this->action){
            $this->action = \Yii::$app->urlManager->createAbsoluteUrl(['form/process']);
        }
        $isLogged = Json::decode(\Yii::$app->request->cookies->getValue('social-user'));
        if($isLogged){
            if(Email::findOne(['name'=>$isLogged['name']])) {
                $isLogged['email'] = Email::findOne(['name'=>$isLogged['name']])->email;
            }
        }
        return $this->render('modal', [
            'fields' => $this->fields,
            'slug' => $this->slug,
            'header'=>$this->header,
            'sub_header'=>$this->sub_header,
            'form_title'=>$this->form_title,
            'action'=>$this->action,
            'isLogged'=>$isLogged,
        ]);
    }

}
