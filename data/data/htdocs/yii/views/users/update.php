<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\UserAttr $model */

$this->title = Yii::t('app', 'Редактировать пользователя: {name}', [
    'name' => $model->fio,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Пользователи'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->fio, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Редактировать');
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
<div class="user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formR', [
        'model' => $user,
    ]) ?>
</div>
</div>
<div class="content" style="margin-top: 10px;">
<div class="user-attr-update">

    <h1><?= Html::encode('Изменить личную информацию') ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
</div>
