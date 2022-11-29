<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

/** @var yii\web\View $this */
/** @var app\models\Showplace $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="showplace-form">

    <?php $form = ActiveForm::begin(['id' => 'showplace-form']); ?>

    <?= $form->field($model, 'showplace')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'city_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(app\models\City::find()->orderBy('city')->all(), 'id', 'city'),
        'language' => 'ru',
        'options' => ['placeholder' => 'Не выбрано...', 'class' => 'col'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
