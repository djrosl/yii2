<?php

namespace app\modules\admin\controllers;

use nullref\admin\components\AccessControl;
use yii\web\Controller;
use Yii;

class MailingController extends Controller {
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules'=>[
                    [
                        'allow'=>true,
                        'roles' => ['@'],
                    ]
                ],
            ],
        ];
    }
    
    public function actionIndex(){

        if(Yii::$app->request->post()){
            $post = Yii::$app->request->post();
            $messages = [];
            foreach($post['receivers'] as $email) {
                $messages[] = Yii::$app->mailer->compose('mailing', ['content'=>$post['content']])
                    ->setFrom('noreply@notaproduction.com')
                    ->setSubject($post['subject'])
                    ->setTo($email);
            }
            Yii::$app->mailer->sendMultiple($messages);
        }
        
        return $this->render('index');
    }
}