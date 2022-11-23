<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Вход';

?>
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
<div class="site-login">
    <div class="container">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Пожалуйста, заполните следующие поля, чтобы войти:</p>
    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{input}\n{error}",
            'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
            'inputOptions' => ['class' => 'col-lg-3 form-control', 'style' => 'margin-left: 11px;'],
            'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
        ],
    ]); ?>
        <div class="row">
            <div class="col-xs-12 col-12 col-md-12 col-lg-12">
        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-12 col-md-12 col-lg-12">
        <?= $form->field($model, 'password')->passwordInput() ?>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-12 col-md-12 col-lg-12">
        <?= $form->field($model, 'rememberMe')->checkbox([
            'template' => "<div class='col-xs-6 custom-control custom-checkbox'>{input} Запомнить меня</div>\n<div class='col-xs-6'>{error}</div>",
        ]) ?>
            </div>
        </div>

        <div class="form-group">
            <div class="col-xs-3">
                <?= Html::submitButton('Войти', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                <?= Html::a('Регистрация', 'signup', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>
    </div>
</div>
</div>
