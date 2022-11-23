<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\TourStatus $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="tour-status-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tour_status')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
