<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\SalesDetails $model */

$this->title = Yii::t('app', 'Добавить продажу');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Билеты'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Билет на дату: '.date('d.m.Y',strtotime($modelSales->ticket->tourDate->date_tour)), 'url' => ['view', 'id' => $modelSales->ticket_id]];
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
<div class="sales-details-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form-sale', [
        'modelSales' => $modelSales,
        'modelsSalesDetails' => $modelsSalesDetails,
    ]) ?>
</div>
</div>
