<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

/** @var yii\web\View $this */
/** @var app\models\Tickets $model */
/** @var yii\widgets\ActiveForm $form */
$statuses = app\models\UserStatus::find()->where(['status' => 'Отменен'])->orderBy('status')->all();
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
        <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'tour_id')->hiddenInput()->label(false); ?>
        <?= $form->field($model, 'tour_date_id')->hiddenInput()->label(false); ?>
        <div class="row">
        <?= $form->field($model, 'guest_id')->hiddenInput()->label(false); ?>
            <div class="col-xs-12 col-12 col-md-12 col-lg-12">
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
