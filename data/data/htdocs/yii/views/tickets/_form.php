<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

/** @var yii\web\View $this */
/** @var app\models\Tickets $model */
/** @var yii\widgets\ActiveForm $form */
$tours = \app\models\Tour::find()->orderBy('name')->all();
$dates = \app\models\TourDate::find()->orderBy('date_tour')->all();
$guests = app\models\UserAttr::find()->select('user_attr.fio, user.id')->innerJoin('user', '`user`.`id` = `user_attr`.`user_id`')->where(['user.role' => '1'])->orderBy('user_attr.fio')->all();
$statuses = app\models\UserStatus::find()->orderBy('status')->all();
?>
<script>
    function setDate(event) {
        const tour_id = document.getElementById('tickets-tour_id').value;
        $('#tickets-tour_date_id').find('option:not(:first)').remove().end();
        console.log(tour_id);
        $.ajax({
            url: '/tickets/set-date',
            dataType: "json",
            data: 'id='+tour_id,
            success: function (data) {
                for (var key of Object.keys(data)) {
                    console.log(key + ' : ' +data[key]);
                    $("#tickets-tour_date_id").append('<option value="'+key+'">'+data[key]+'</option>');
                };
            }
        });
    }
</script>

<div class="tickets-form">
    <div class="container">
        <?php $form = ActiveForm::begin(['id' => 'tickets-form']); ?>
        <div class="row">
            <div class="col-xs-6 col-6 col-md-6 col-lg-6">
        <?= $form->field($model, 'tour_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map($tours, 'id', 'name'),
            'language' => 'ru',
            'options' => ['placeholder' => 'Не выбрано...', 'class' => 'col', 'onChange' => 'setDate(event);'],
            'pluginOptions' => [
                'allowClear' => false
            ],
        ]); ?>
            </div>
            <div class="col-xs-6 col-6 col-md-6 col-lg-6">
        <?= $form->field($model, 'tour_date_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map($dates, 'id', function($model) {
                return date('d.m.Y', strtotime($model->date_tour));
            }),
            'language' => 'ru',
            'options' => ['placeholder' => 'Не выбрано...', 'class' => 'col'],
            'pluginOptions' => [
                'allowClear' => false
            ],
        ]); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6 col-6 col-md-6 col-lg-6">
        <?= $form->field($model, 'guest_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map($guests, 'id', 'fio'),
            'language' => 'ru',
            'options' => ['placeholder' => 'Не выбрано...', 'class' => 'col'],
            'pluginOptions' => [
                'allowClear' => false
            ],
        ]); ?>
            </div>
            <div class="col-xs-6 col-6 col-md-6 col-lg-6">
        <?= $form->field($model, 'status')->widget(Select2::classname(), [
            'data' => ArrayHelper::map($statuses, 'id', 'status'),
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

        <?php ActiveForm::end(); ?>
    </div>
</div>
