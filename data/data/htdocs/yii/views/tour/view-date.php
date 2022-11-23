<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\TourDate $model */
$name = (\app\models\Tour::find()->where(['id' => $model->tour_id])->one())->name;
$this->title = 'Дата тура "' . $name . '" ' . date('d.m.Y',strtotime($model->date_tour));
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Туры'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $name, 'url' => 'view?id='.$model->tour_id];
$this->params['breadcrumbs'][] = 'Дата тура '.date('d.m.Y',strtotime($model->date_tour));
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
<div class="tour-date-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Редактировать'), ['update-date', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php if (Yii::$app->user->identity->role == 3) { ?>
        <?= Html::a(Yii::t('app', 'Удалить'), ['delete-date', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Вы действительно хотите удалить этот элемент?'),
                'method' => 'post',
            ],
        ]) ?>
        <?php }?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            ['attribute' => 'date_tour', 'value' => function($model) {
                return date('d.m.Y', strtotime($model->date_tour));
            }],
            'seats',
            'tour_status.tour_status',
            'user.fio',
        ],
    ]) ?>
</div>
</div>
