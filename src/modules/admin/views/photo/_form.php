<?php

use app\modules\admin\components\ModelHelper;
use kartik\file\FileInput;
use yii\helpers\Html;
use yii\jui\AutoComplete;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Photo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="photo-form">

    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'city')->widget(AutoComplete::className(), [
        'clientOptions' => [
            'source' => ModelHelper::getCollection('cities'),
        ],
        "options"=>['class'=>'form-control']
    ]) ?>

    <?php
    if($model->id){
        $images = array_map(function($item) use ($model){
            if($item->id != $model->getImage()->id) {
                return $item;
            }
        }, $model->getImages());

        foreach($images as $image){
            echo $image ? Html::img( $image->getUrl('105x75')) : '';
        }
    }

    ?>
    <?= $form->field($model, 'gallery[]')->widget(FileInput::classname(), [
        'options' => ['multiple' => true],
        'pluginOptions' => [
            'showUpload'=>false,
        ]
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
