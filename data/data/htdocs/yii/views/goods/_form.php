<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Goods $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="goods-form">
    <div classs="container">
        <?php $form = ActiveForm::begin(['id' => 'goods-form']); ?>
        <div class="row">
            <div class="col-xs-12 col-12 col-md-12 col-lg-12">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6 col-6 col-md-6 col-lg-6">
                <?= $form->field($model, 'cost')->textInput() ?>
            </div>
            <div class="col-xs-6 col-6 col-md-6 col-lg-6">
                <?= $form->field($model, 'quantity')->textInput() ?>
            </div>
            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => 'btn btn-success']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
