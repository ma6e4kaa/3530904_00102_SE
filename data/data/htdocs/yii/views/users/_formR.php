<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap5\ActiveForm;
use kartik\select2\Select2;

/** @var yii\web\View $this */
/** @var app\models\User $model */
/** @var yii\widgets\ActiveForm $form */
?>
<style>
    .form-control {
        width: 98%;
    }
    .select2 {
        width:100% !important;
    }
    .row > * {
        padding-right:0 !important;
    }
</style>
<div class="user-form">
<div class="container">
    <?php $form = ActiveForm::begin([
        'id' => 'signup-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{input}\n{error}",
            'labelOptions' => ['class' => 'col-lg-3 col-form-label mr-lg-3'],
            'inputOptions' => ['class' => 'col-lg-3 form-control', 'style' => 'margin-left: 11px;'],
            'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
        ],
    ]); ?>
    <div class="row">
        <div class="col">
            <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col">
        </div>
    </div>
    <div class="row">
        <div class="col">
    <?= $form->field($model, 'role')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(app\models\Role::find()->all(), 'id', 'role'),
        'language' => 'ru',
        'options' => ['placeholder' => 'Выберите роль...', 'class' => 'col'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);?>
        </div>
        <div class="col">
        </div>
    </div>
    

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

</div>
