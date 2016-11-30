<?php

use app\models\Settings;
use app\modules\admin\components\ModelHelper;
use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\SettingsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Настройки';
$this->params['breadcrumbs'][] = $this->title;




?>
<div class="settings-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($models['about_us'], 'content')->widget(CKEditor::className())->label('Текст страницы "О нас"') ?>
    <?= $form->field($models['about_us'], 'slug')->hiddenInput()->label(false)?>
    <div class="form-group">
        <?= Html::submitButton('Обновить', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($models['phone'], 'content')->textInput()->label('Контактный телефон') ?>
    <?= $form->field($models['phone'], 'slug')->hiddenInput()->label(false)?>
    <div class="form-group">
        <?= Html::submitButton('Обновить', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($models['email'], 'content')->textInput()->label('Контактный email') ?>
    <?= $form->field($models['email'], 'slug')->hiddenInput()->label(false)?>
    <div class="form-group">
        <?= Html::submitButton('Обновить', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($models['address'], 'content')->textInput()->label('Физический адрес') ?>
    <?= $form->field($models['address'], 'slug')->hiddenInput()->label(false)?>
    <div class="form-group">
        <?= Html::submitButton('Обновить', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($models['countries'], 'content')->textarea()->label('Страны для фильтра (через кому)')?>
    <?= $form->field($models['countries'], 'slug')->hiddenInput()->label(false)?>
    <div class="form-group">
        <?= Html::submitButton('Обновить', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($models['cities'], 'content')->textarea()->label('Города для фильтра (через кому)')?>
    <?= $form->field($models['cities'], 'slug')->hiddenInput()->label(false)?>
    <div class="form-group">
        <?= Html::submitButton('Обновить', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($models['genres'], 'content')->textarea()->label('Жанры для фильтра (через кому)')?>
    <?= $form->field($models['genres'], 'slug')->hiddenInput()->label(false)?>

    <div class="form-group">
        <?= Html::submitButton('Обновить', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>