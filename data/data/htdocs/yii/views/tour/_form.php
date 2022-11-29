<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Tour $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="tour-form">
    <div class="container">
        <?php $form = ActiveForm::begin(['id' => 'tour-form']); ?>
        <div class="row">
            <div class="col-xs-12 col-12 col-md-12 col-lg-12">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-4 col-4 col-md-4 col-lg-4">
                <?= $form->field($model, 'start_time')->widget(\yii\widgets\MaskedInput::className(), [
                    'mask' => '99:99'
                ]); ?>
            </div>
            <div class="col-xs-4 col-4 col-md-4 col-lg-4">
                <?= $form->field($model, 'end_time')->widget(\yii\widgets\MaskedInput::className(), [
                    'mask' => '99:99'
                ]); ?>
            </div>
            <div class="col-xs-4 col-4 col-md-4 col-lg-4">
                <?= $form->field($model, 'price')->textInput() ?>
            </div>
        </div>
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
