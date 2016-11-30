<?php

use app\modules\admin\components\ModelHelper;
use kartik\file\FileInput;
use mihaildev\ckeditor\CKEditor;
use unclead\widgets\MultipleInput;
use yii\helpers\Html;
use yii\jui\AutoComplete;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Event */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="event-form">

    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->widget(CKEditor::className()) ?>

    <?= $form->field($model, 'date')->widget(DatePicker::className(), [
        'options'=>[
            'class'=>'form-control',
        ],
        'dateFormat' => 'php:Y-m-d',
    ]) ?>

    <?= $form->field($model, 'place')->widget(AutoComplete::className(), [
        'clientOptions' => [
            'source' => ModelHelper::getCollection('places'),
        ],
        "options"=>['class'=>'form-control']
    ]) ?>

    <?= $form->field($model, 'city')->widget(AutoComplete::className(), [
        'clientOptions' => [
            'source' => ModelHelper::getCollection('cities'),
        ],
        "options"=>['class'=>'form-control']
    ]) ?>

    <?=$model->getImage() ? Html::img($model->getImage()->getUrl('250x230')) : ""?>
    <?= $form->field($model, 'image')->widget(FileInput::classname(), [
        'options' => ['accept' => 'image/*',],
        'pluginOptions' => [
            'showUpload'=>false,
        ]
    ]) ?>

    <?php
    if($model->id){
        $images = array_map(function($item) use ($model){
            if($item->id != $model->getImage()->id) {
                return $item;
            }
        }, $model->getImages());

        //$images = $model->getImages();

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

    <?= $form->field($model, 'videos')->widget(MultipleInput::className()) ?>

    <?=$model->getImageByName('scheme') ? Html::img($model->getImageByName('scheme')->getUrl('250x230')) : ""?>
    <?= $form->field($model, 'scheme')->widget(FileInput::classname(), [
        'options' => ['accept' => 'image/*',],
        'pluginOptions' => [
            'showUpload'=>false,
        ]
    ])->label('Схема зала') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
