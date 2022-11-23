<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\UserAttr $model */
//$this->title = 'Сменить пароль';
$this->title = Yii::t('app', 'Сменить пароль');
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
<div class="user-attr-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_pass', [
            'model' => $model,
            'message' => $message,
        ]); ?>
</div>
</div>
