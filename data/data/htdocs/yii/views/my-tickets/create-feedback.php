<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Feedback $model */

$this->title = Yii::t('app', 'Отзыв к туру');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Мои билеты'), 'url' => ['/my-tickets?id='.Yii::$app->user->identity->id]];
$this->params['breadcrumbs'][] = ['label' => 'Билет на дату: '.date('d.m.Y',strtotime($ticket->tourDate->date_tour)), 'url' => ['view', 'id' => $ticket->id]];
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
<div class="feedback-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form-feedback', [
        'model' => $model,
    ]) ?>
</div>
</div>
