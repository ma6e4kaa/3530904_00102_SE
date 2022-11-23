<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\UserAttr $model */

$this->title = Yii::t('app', 'Редактировать профиль');
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Attrs'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
//$this->params['breadcrumbs'][] = Yii::t('app', 'Редактировать');
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
<div class="user-attr-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <p style="margin-left: 12px;"> 
        <?= Html::a(Yii::t('app', 'Сменить пароль'), ['update', 'id' => $model->user_id], ['class' => 'btn btn-warning']) ?>
    </p>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
</div>
