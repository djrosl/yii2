<?php

use app\modules\admin\components\ModelHelper;
use kartik\file\FileInput;
use mihaildev\ckeditor\CKEditor;
use unclead\widgets\MultipleInput;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\jui\AutoComplete;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Artist */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="artist-form">

    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->widget(CKEditor::className()) ?>

    <?= $form->field($model, 'country')->widget(AutoComplete::className(), [
        'clientOptions' => [
            'source' => ModelHelper::getCollection('countries'),
        ],
        "options"=>['class'=>'form-control']
    ]) ?>

    <?= $form->field($model, 'genre')->widget(AutoComplete::className(), [
        'clientOptions' => [
            'source' => ModelHelper::getCollection('genres'),
        ],
        "options"=>['class'=>'form-control']
    ]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>


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
            if($model->getImage()) {
                if($item->id != $model->getImage()->id) {
                    return $item;
                }
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

    <table class="table">
    <?php
        foreach($model->audio as $audio){
            if($audio){
                echo '<tr class="audio-wrap" style="vertical-align:middle">';
                echo '<td><audio src="'.$audio->path.'" controls="controls"></audio></td>';
                echo '<td><input type="text" class="form-control" value="'.$audio->name.'"></td>';
                echo '<td>';
                echo Html::a(' (сохранить) ', ['artist/save-audio?id='.$audio->id], ['class'=>'save-audio']);
                echo Html::a(' (удалить) ', ['artist/remove-audio?id='.$audio->id], ['class'=>'remove-audio']);
                echo '</td>';
                echo '</tr>';
            }
        }
    ?>
    </table>

    <?= $form->field($model, 'audios')->widget(MultipleInput::className(), [
        "columns"=>[
            [
                'name'  => 'name',
                'type'  => 'textInput',
                'title' => 'Название трека',
            ],
            [
                'name'  => 'file',
                'type'  => 'fileInput',
                'title' => 'Файл (mp3)',
            ],
        ]
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
