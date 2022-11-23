<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\SalesDetails;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\models\Tickets $model */

$this->title = 'Билет на дату: '.date('d.m.Y',strtotime($model->tourDate->date_tour));
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Мои билеты'), 'url' => ['/my-tickets?id='.Yii::$app->user->identity->id]];
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
<div class="tickets-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Редактировать'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php if ($model->status == 3) {?>
        <?= Html::a(Yii::t('app', 'Добавить отзыв'), ['create-feedback', 'id' => $model->id], ['class' => 'btn btn-secondary']) ?>
        <?php }?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'tourDate.tour.name',
            'tourDate.date_tour',
            'status0.status',
        ],
    ]) ?>
</div>
</div>
<?php if ($dataSalesProvider->getCount() > 0) {?>
<div class="content" style="margin-top: 10px;">
<div class="tickets-view">

    <h1><?= Html::encode('Продажи к билету') ?></h1>
    
    <?= GridView::widget([
        'dataProvider' => $dataSalesProvider,
        'filterModel' => $searchSalesModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'good.name',
            'quantity',
        ],
    ]); 
?>
</div>
</div>
<?php }
