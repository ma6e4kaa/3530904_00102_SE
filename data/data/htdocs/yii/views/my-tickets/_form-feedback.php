<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use kartik\select2\Select2;

/** @var yii\web\View $this */
/** @var app\models\Feedback $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="feedback-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ball')->widget(Select2::classname(), [
        'data' => array('1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5'),
        'language' => 'ru',
        'options' => ['placeholder' => 'Оцените тур', 'class' => 'col'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'feedback')->textarea(['maxlength' => true, 'rows' => 10]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
