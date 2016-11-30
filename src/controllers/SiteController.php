<?php

namespace app\controllers;

use app\models\Artist;
use app\models\Email;
use app\models\Event;
use app\models\News;
use app\models\Photo;
use app\models\Settings;
use app\models\User;
use app\models\Video;
use app\modules\admin\components\ModelHelper;
use Yii;
use yii\base\ErrorException;
use yii\db\Expression;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\helpers\VarDumper;
use yii\httpclient\Response;
use yii\web\Controller;
use yii\web\NotFoundHttpException;


class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                    'artists' => ['get', 'post'],
                ],
            ],
            'eauth' => [
                // required to disable csrf validation on OpenID requests
                'class' => \nodge\eauth\openid\ControllerBehavior::className(),
                'only' => ['login', 'index'],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        $artists = Artist::find()->orderBy(new Expression('rand()'))->limit(10)->all();
        $events = Event::find()->limit(10)->all();
        $photos = Photo::find()->limit(10)->all();
        $videos = Video::find()->limit(4)->all();
        $news = News::find()->limit(4)->all();

        return $this->render('index', [
            'artists' => $artists,
            'events' => $events,
            'photos' => $photos,
            'videos' => $videos,
            'news' => $news,
        ]);
    }

    public function actionArtists()
    {
        $request = Yii::$app->request;

        $models = Artist::find()->orderBy(new Expression('rand()'));

        if ($request->isAjax){
            $post = Yii::$app->request->post();
            $prices = explode(';', $post['price']);

            $models->andWhere(['between', 'price', (int)$prices[0], (int)$prices[1]]);

            if(!empty($post['country'])) {
                $models->andWhere(['like','country',$post['country']]);
            }
            if(!empty($post['genres'])) {
                foreach($post['genres'] as $k=>$genre) {
                    if(!$k){
                        $models->andWhere(['like', 'genre', $genre]);

                    } else {
                        $models->orWhere(['like', 'genre', $genre]);
                    }
                }
            }

            //Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return $this->renderAjax('artist/_filter', [
                'models'=>$models->all()
            ]);
        }

        return $this->render('artist/artists', [
            'models'=>$models->all(),
        ]);
    }

    public function actionEvents()
    {
        $request = Yii::$app->request;

        $models = Event::find();

        if ($request->isAjax){
            $post = Yii::$app->request->post();

            if(!empty($post['cities'])) {
                $models->andWhere(['in', 'city', $post['cities']]);
            }

            //Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return $this->renderAjax('event/_filter', [
                'models'=>$models->all()
            ]);
        }
        
        return $this->render('event/events', [
            'models'=>$models->all(),
        ]);
    }

    public function actionPhoto($id = 0)
    {
        if($id) {
            $models = Photo::findOne(['id' => $id])->getImages();
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return array_map(function($item){
                return [
                    'src' => $item->getUrl(),
                    'thumb' => $item->getUrl('100x100'),
                ];
            }, $models);
        }

        $request = Yii::$app->request;

        $models = Photo::find();

        if ($request->isAjax){
            $post = Yii::$app->request->post();

            if(!empty($post['cities'])) {
                $models->andWhere(['in', 'city', $post['cities']]);
            }

            //Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return $this->renderAjax('photo/_filter', [
                'models'=>$models->all()
            ]);
        }
        
        return $this->render('photo/photos', [
            'models'=>$models->all()
        ]);
    }

    public function actionVideo()
    {
        $request = Yii::$app->request;

        $models = Video::find();

        if ($request->isAjax){
            $post = Yii::$app->request->post();

            if(!empty($post['cities'])) {
                $models->andWhere(['in', 'city', $post['cities']]);
            }

            //Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return $this->renderAjax('video/_filter', [
                'models'=>$models->all()
            ]);
        }
        
        return $this->render('video/video', [
            'models'=>$models->all()
        ]);
    }

    public function actionNews()
    {
        $models = News::find()->all();
        return $this->render('news', [
            'models'=>$models
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionArtist($slug)
    {
        $model = Artist::findOne(['slug'=>$slug]);

        $isLogged = Json::decode(\Yii::$app->request->cookies->getValue('social-user'));
        if($isLogged){
            $isLogged['email'] = Email::findOne(['name'=>$isLogged['name']])->email;
        }

        return $this->render('artist/artist', [
            'model'=>$model,
            'isLogged'=>$isLogged,
        ]);
    }

    public function actionEvent($slug)
    {
        $model = Event::findOne(['slug'=>$slug]);

        return $this->render('event/event', [
            'model'=>$model
        ]);
    }

    public function actionSingleNews($slug)
    {
        $model = News::findOne(['slug'=>$slug]);
        if(!$model){
            throw new NotFoundHttpException();
        }

        return $this->render('single-news', ['model'=>$model]);
    }

    public function actionLogin() {
        $serviceName = Yii::$app->getRequest()->getQueryParam('service');
        if (isset($serviceName)) {
            /** @var $eauth \nodge\eauth\ServiceBase */
            $eauth = Yii::$app->get('eauth')->getIdentity($serviceName);
            $eauth->setRedirectUrl(Yii::$app->getUser()->getReturnUrl());
            $eauth->setCancelUrl(Yii::$app->getUrlManager()->createAbsoluteUrl('site/login'));

            try {
                if ($eauth->authenticate()) {
                    //var_dump($eauth->getIsAuthenticated(), $eauth->getAttributes()); exit;

                    $identity = User::findByEAuth($eauth);

                    //var_dump($identity->profile);exit;

                    if (!isset(Yii::$app->request->cookies['social-user'])) {
                        Yii::$app->response->cookies->add(new \yii\web\Cookie([
                            'name' => 'social-user',
                            'value' => Json::encode($identity->profile),
                            'expire' => time() + 86400 * 365
                        ]));
                    }
                    if(!Email::findOne(['name'=>$identity->profile['name']])){
                        if (!isset(Yii::$app->request->cookies['is-email'])) {
                            Yii::$app->response->cookies->add(new \yii\web\Cookie([
                                'name' => 'is-email',
                                'value' => 0
                            ]));
                        }
                    }

                    Yii::$app->getUser()->login($identity);

                    // special redirect with closing popup window
                    $eauth->redirect();
                }
                else {
                    // close popup window and redirect to cancelUrl
                    $eauth->cancel();
                }
            }
            catch (\nodge\eauth\ErrorException $e) {
                // save error to show it later
                Yii::$app->getSession()->setFlash('error', 'EAuthException: '.$e->getMessage());

                // close popup window and redirect to cancelUrl
//              $eauth->cancel();
                $eauth->redirect($eauth->getCancelUrl());
            }
        }

        // default authorization code through login/password ..
        
        return $this->render('login');
    }

    public function actionAddProfile(){
        $post = array_map(function($item){
            return [$item['name']=>$item['value']];
        }, Json::decode(Yii::$app->request->post()['str']));
        $profile = Json::decode(Yii::$app->request->cookies['social-user']);

        $model = Email::findOne(['email'=>$post[0]['email']]);
        if(!$model){
            $model = new Email();
        }

        $model->email = $post[0]['email'];
        $model->name = $profile['name'] ? $profile['name'] : '';
        $model->profile = $profile['url'] ? $profile['url'] : '';
        
        if($model->save()) {
            Yii::$app->response->cookies->remove('is-email');
            return true;
        }
    }

}
