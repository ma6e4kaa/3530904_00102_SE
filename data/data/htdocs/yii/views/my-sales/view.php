<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\SalesDetails;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\Sales $model */

$this->title = 'Покупка на сумму '.$model->summ.' руб., '.date('d.m.Y',strtotime($model->ticket->tourDate->date_tour));
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Мои покупки'), 'url' => ['/my-sales?id='.Yii::$app->user->identity->id]];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
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
<div class="sales-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ticket.tourDate.tour.name',
            'ticket.tourDate.date_tour',
            'summ',
        ],
    ]) ?>
</div>
</div>

<div class="content" style="margin-top: 10px;">
<div class="sales-details-view">

    <h1><?= Html::encode('Детали чека') ?></h1>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataDetailsProvider,
        'filterModel' => $searchDetailsModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'good.name',
            'quantity',
            'good.cost',
        ],
    ]); ?>

    <?php Pjax::end(); ?>
</div>
</div>
