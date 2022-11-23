<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use kartik\date\DatePicker;
use \yii\widgets\Pjax;
use yii\grid\GridView;
use yii\grid\ActionColumn;

/** @var yii\web\View $this */
/** @var app\models\Tour $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Туры'), 'url' => ['index']];
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
<div class="tour-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if (Yii::$app->user->identity->role == 3) { ?>
        <?= Html::a(Yii::t('app', 'Редактировать'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Удалить'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Вы действительно хотите удалить этот элемент?'),
                'method' => 'post',
            ],
        ]) ?>
        <?php } ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'start_time',
            'end_time',
            'price',
        ],
    ]) ?>
</div>
</div>
<div class="content" style="margin-top: 10px;">
<div class="tour-station-view">
    <h1><?= Html::encode('Остановки тура') ?></h1>

    <p>
        <?php if (Yii::$app->user->identity->role == 3) { ?>
        <?= Html::a(Yii::t('app', 'Добавить остановку'), ['create-station', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
        <?php } ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataStationProvider,
        'filterModel' => $searchStationModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'time_stop',
            ['attribute' => 'showplace', 'label' => 'Достопримечательность', 'value' => function ($model) {
                return $model->showplace0->showplace;
            }],
            'station',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, \app\models\TourStation $model, $key, $index, $column) {
                    return Url::toRoute([$action.'-station', 'id' => $model->id]);
                 },
                'template' => Yii::$app->user->identity->role == 3 ? '{view} {update} {delete}' : '',
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>
</div>
</div>
<div class="content" style="margin-top: 10px;">
<div class="tour-date-view">
    <h1><?= Html::encode('Даты тура') ?></h1>

    <p>
        <?php if (Yii::$app->user->identity->role == 3) { ?>
        <?= Html::a(Yii::t('app', 'Добавить дату'), ['create-date', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
        <?php } ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataDateProvider,
        'filterModel' => $searchDateModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'date_tour', 'value' => function($model) {
                return date('d.m.Y', strtotime($model->date_tour));
            },
                'filter' => DatePicker::widget([
                    'model'=>$searchDateModel,
                    'attribute'=>'date_tour',
                    'language' => 'ru',
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd'
                    ],
                    'pickerIcon' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">   <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"/>   <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/> </svg>',
                    'removeIcon' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square" viewBox="0 0 16 16"> <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/><path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/> </svg>',
                ]),
            ],
            'seats',
            ['attribute' => 'tour_status', 'label' => 'Статус', 'value' => function ($model) {
                return $model->tour_status->tour_status;
            }],
            ['attribute' => 'fio', 'label' => 'Экскурсовод', 'value' => function ($model) {
                return $model->user->fio;
            }
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, \app\models\TourDate $model, $key, $index, $column) {
                    return Url::toRoute([$action.'-date', 'id' => $model->id]);
                 },
                'template' => Yii::$app->user->identity->role == 3 ? '{view} {update} {delete}' : (Yii::$app->user->identity->role == 2 ? '{view} {update}' : ''),
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>
</div>
</div>

<div class="content" style="margin-top: 10px;">
<div class="tour-date-view">
    <h1><?= Html::encode('Отзывы к туру') ?></h1>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataFeedbackProvider,
        'filterModel' => $searchFeedbackModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'date_tour', 'label' => 'Дата тура', 'value' => function($model) {
                return $model->tourDate->date_tour;
            },
                'filter' => DatePicker::widget([
                    'model'=>$searchFeedbackModel,
                    'attribute'=>'date_tour',
                    'language' => 'ru',
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd'
                    ],
                    'pickerIcon' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">   <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"/>   <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/> </svg>',
                    'removeIcon' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square" viewBox="0 0 16 16"> <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/><path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/> </svg>',
                ]),
            ],
            'ball',
            'feedback',
        ],
    ]); ?>

    <?php Pjax::end(); ?>
</div>
</div>
