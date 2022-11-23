<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\City $model */

$this->title = Yii::t('app', 'Добавить город');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Города'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Добавить');
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
<div class="city-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>
