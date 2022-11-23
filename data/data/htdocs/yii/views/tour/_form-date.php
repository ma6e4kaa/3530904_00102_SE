<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

/** @var yii\web\View $this */
/** @var app\models\Tour $model */
/** @var yii\widgets\ActiveForm $form */
$guides = app\models\UserAttr::find()->select('user_attr.fio, user.id')->innerJoin('user', '`user`.`id` = `user_attr`.`user_id`')->where(['user.role' => '2'])->orderBy('user_attr.fio')->all();
$statuses = \app\models\TourStatus::find()->orderBy('tour_status')->all();
?>

<div class="tour-date-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-6 col-md-6 col-lg-6">
                <?= $form->field($model, 'date_tour')->widget(DatePicker::className(),[
                    'name' => 'date_tour',
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd'
                    ],
                    'pickerIcon' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">   <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"/>   <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/> </svg>',
                    'removeIcon' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square" viewBox="0 0 16 16"> <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/><path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/> </svg>',
                ]); ?>
            </div>
            <div class="col-xs-6 col-6 col-md-6 col-lg-6">
                <?= $form->field($model, 'seats')->textInput() ?>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6 col-6 col-md-6 col-lg-6">
                <?= $form->field($model, 'status')->widget(Select2::classname(), [
                    'data' => ArrayHelper::map($statuses, 'id', 'tour_status'),
                    'language' => 'ru',
                    'options' => ['placeholder' => 'Не выбрано...', 'class' => 'col'],
                    'pluginOptions' => [
                        'allowClear' => false
                    ],
                ]); ?>
            </div>
            <div class="col-xs-6 col-6 col-md-6 col-lg-6">
                <?= $form->field($model, 'guide')->widget(Select2::classname(), [
                    'data' => ArrayHelper::map($guides, 'id', 'fio'),
                    'language' => 'ru',
                    'options' => ['placeholder' => 'Не выбрано...', 'class' => 'col'],
                    'pluginOptions' => [
                        'allowClear' => false
                    ],
                ]); ?>
            </div>
        </div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => 'btn btn-success']) ?>
    </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
