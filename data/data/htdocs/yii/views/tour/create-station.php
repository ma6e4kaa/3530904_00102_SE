<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Tour $model */
$name = (\app\models\Tour::find()->where(['id' => $model->tour_id])->one())->name;
$this->title = Yii::t('app', 'Добавить остановку');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Туры'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $name, 'url' => 'view?id='.$model->tour_id];
$this->params['breadcrumbs'][] = $this->title;
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
<div class="tour-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form-station', [
        'model' => $model,
    ]) ?>
</div>
</div>
