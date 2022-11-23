<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\User $model */
/** @var yii\widgets\ActiveForm $form */

$this->title = 'Регистрация';
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
<style>
    .content {
        background-color: #fff;
        border-radius: 20px;
        padding: 20px; 
        box-shadow: rgba(0, 0, 0, 0.3) 0 1px 3px;
    }
    .content:hover {
        background-color: #fff;
        border-radius: 20px;
        padding: 20px; 
        box-shadow: rgba(0, 0, 0, 0.3) 0 2px 5px;
    }
</style>
<div class="content"> 
<div class="site-signup">
    <div class="container">
        <h1><?= Html::encode($this->title) ?></h1>

        <p>Пожалуйста, заполните следующие поля, чтобы зарегистрироваться:</p>

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
            <div class="col-xs-12 col-12 col-md-12 col-lg-12">
                <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-12 col-md-12 col-lg-12">
                <?= $form->field($model, 'password')->passwordInput(['maxlength' => true, 'id' => 'pass']) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-12 col-md-12 col-lg-12">
                <?= $form->field($model, 'passwd')->label('Повторите пароль')->passwordInput(['maxlength' => true, 'id' => 'confpass', 'onKeyUp' => 'checkPassword();']) ?>
            </div>
        </div>
        <div class="message" id='message'></div>

        <div class="form-group">
            <div class="col-xs-3">
                <?= Html::submitButton(Yii::t('app', 'Зарегистрироваться'), ['class' => 'btn btn-primary', 'id' => 'btn', 'disabled' => 'true']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
</div>
