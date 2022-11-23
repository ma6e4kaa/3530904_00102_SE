<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\TourStatus $model */

$this->title = Yii::t('app', 'Редактировать статус тура');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Статусы тура'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->tour_status, 'url' => ['view', 'id' => $model->id]];
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
<div class="tour-status-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
</div>
