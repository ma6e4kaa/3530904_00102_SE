<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

/** @var yii\web\View $this */
/** @var app\models\Tour $model */
/** @var yii\widgets\ActiveForm $form */
$showplaces = app\models\Showplace::find()->orderBy('showplace')->all();
?>
<style>
    .select2-selection__clear {
    padding-right: 8px;
}
</style>
<div class="tour-station-form">
    <div class="container">
        <?php $form = ActiveForm::begin(['id'=>'station-form']); ?>
        <div class="row">
            <div class="col-xs-6 col-6 col-md-6 col-lg-6">
                <?= $form->field($model, 'time_stop')->widget(\yii\widgets\MaskedInput::className(), [
                    'mask' => '99:99'
                ]); ?>
            </div>
            <div class="col-xs-6 col-6 col-md-6 col-lg-6">
                <?= $form->field($model, 'showplace')->widget(Select2::classname(), [
                    'data' => ArrayHelper::map($showplaces, 'id', 'showplace'),
                    'language' => 'ru',
                    'options' => ['placeholder' => 'Не выбрано...', 'class' => 'col'],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ]); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-12 col-md-12 col-lg-12">
                <?= $form->field($model, 'station')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
