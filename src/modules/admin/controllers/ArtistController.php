<?php

namespace app\modules\admin\controllers;

use app\models\Audio;
use app\modules\admin\components\ModelHelper;
use nullref\admin\components\AccessControl;
use Yii;
use app\models\Artist;
use app\modules\admin\models\ArtistSearch;
use yii\base\Model;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\web\UploadedFile;

/**
 * ArtistController implements the CRUD actions for Artist model.
 */
class ArtistController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
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

    /**
     * Lists all Artist models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ArtistSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Artist model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Artist model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Artist();

        if ($model->load(Yii::$app->request->post())) {

            ModelHelper::setCollection('countries', $model->country);
            ModelHelper::setCollection('genres', $model->genre);
            $model->videos = ModelHelper::parseVideo($model->videos);
            $model->gallery = '';
            $audios = $model->audios;
            $model->audios = '';
            $model->save();
            ModelHelper::parseAudio($audios, $model);
            ModelHelper::saveImage($model);
            ModelHelper::saveGallery($model);

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Artist model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        $model->videos = explode(',', $model->videos);

        if ($model->load(Yii::$app->request->post())) {

            ModelHelper::setCollection('countries', $model->country);
            ModelHelper::setCollection('genres', $model->genre);
            $model->videos = ModelHelper::parseVideo($model->videos);
            ModelHelper::parseAudio($model->audios, $model);
            $model->audios = '';
            ModelHelper::saveImage($model);
            ModelHelper::saveGallery($model);
            $model->gallery = '';
            $model->save();

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Artist model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Artist model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Artist the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Artist::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionSaveAudio($id = 0, $name = ''){

        Yii::$app->response->format = Response::FORMAT_JSON;

        if($id){
            $model = Audio::findOne(['id'=>$id]);
            $model->name = $name;
            $model->save();

            return $name;
        }

        return false;
    }
    
    public function actionRemoveAudio($id = 0){

        Yii::$app->response->format = Response::FORMAT_JSON;

        if($id){
            Audio::findOne(['id'=>$id])->delete();
            
            return true;
        }

        return false;
    }
}
