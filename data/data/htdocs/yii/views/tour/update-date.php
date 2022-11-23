<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Tour $model */

$this->title = Yii::t('app', 'Редактировать дату тура: {name}', [
    'name' => date('d.m.Y',strtotime($model->date_tour)),
]);
$name = (\app\models\Tour::find()->where(['id' => $model->tour_id])->one())->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Туры'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $name, 'url' => 'view?id='.$model->tour_id];
$this->params['breadcrumbs'][] = ['label' => 'Дата тура '.date('d.m.Y',strtotime($model->date_tour)), 'url' => ['view-date', 'id' => $model->id]];
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
<div class="tour-date-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form-date', [
        'model' => $model,
    ]) ?>
</div>
</div>
