<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\User $model */
/** @var yii\widgets\ActiveForm $form */


?>
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
    
<div class="new-password-form">

    <p>Пожалуйста, заполните следующие поля, чтобы сменить пароль:</p>

    <?php $form = ActiveForm::begin([
        'id' => 'new-password-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{input}\n{error}",
            'labelOptions' => ['class' => 'col-lg-3 col-form-label mr-lg-3'],
            'inputOptions' => ['class' => 'col-lg-3 form-control', 'style' => 'margin-left: 11px;'],
            'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
        ],
    ]); ?>
    <?php // old password?>
    <?= $form->field($model, 'old_passwd')->label('Старый пароль')->passwordInput(['maxlength' => true]) ?>
    <div class="old_message" style='color: red;'> 
    <?php if ($message) {echo $message;} ?>
    </div>
    <?= $form->field($model, 'password')->label('Новый пароль')->passwordInput(['maxlength' => true, 'id' => 'pass']) ?>
    
    <?= $form->field($model, 'passwd')->label('Повторите пароль')->passwordInput(['maxlength' => true, 'id' => 'confpass', 'onKeyUp' => 'checkPassword();']) ?>
    <div class="message" id='message'></div>

    <div class="form-group">
        <div class="col-xs-3">
            <?= Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => 'btn btn-success', 'id' => 'btn', 'disabled' => 'true']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
