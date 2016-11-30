<?php
/**
 *
 */


use app\models\Email;
use mihaildev\ckeditor\CKEditor;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = 'Почтовая рассылка';
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?=$this->title?></h1>


<div class="news-form">

    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>

    <div class="form-group">
        <label>Тема письма</label>
        <?=Html::textInput('subject')?>
    </div>

    <div class="form-group">
        <label>Текст письма</label>
        <?=CKEditor::widget([
            'name'=>'content'
        ])?>
    </div>


    <div class="form-group">
        <?php $emails = ArrayHelper::map(Email::find()->where(['active'=>1])->all(), 'email', 'email'); ?>
        <label>Выберите адреса для рассылки</label>
        <br>
    <?=Html::dropDownList('receivers[]', null, $emails, [
        'multiple'=>true,
        'options'=>array_map(function($item){
            return ['selected'=>'selected'];
        },$emails)
    ])?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Разослать', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

