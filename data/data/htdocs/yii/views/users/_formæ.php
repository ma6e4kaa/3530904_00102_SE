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
<script>
function checkPassword() {
    var password = $("#pass").val();
    var confirmPass = $("#confpass").val();
    let btn = document.querySelector('#btn');
    
    if (password != confirmPass) {
        $(".message").html("Пароль не совпадает!");
        document.getElementById('message').style.color = 'red';
        btn.setAttribute('disabled', true);
    } else {
        $(".message").html("Пароль совпал!");
        document.getElementById('message').style.color = 'green';
        btn.removeAttribute('disabled');
    }
}
</script>
<div class="user-form">
    <?php $form = ActiveForm::begin([
        'id' => 'users-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{input}\n{error}",
            'labelOptions' => ['class' => 'col-lg-3 col-form-label mr-lg-3'],
            'inputOptions' => ['class' => 'col-lg-3 form-control', 'style' => 'margin-left: 11px;'],
            'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
        ],
    ]); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true, 'id' => 'pass']) ?>
    
    <?= $form->field($model, 'passwd')->label('Повторите пароль')->passwordInput(['maxlength' => true, 'id' => 'confpass', 'onKeyUp' => 'checkPassword();']) ?>
    <div class="message" id='message'>
        
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => 'btn btn-success', 'id' => 'btn', 'disabled' => 'true']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
