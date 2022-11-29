<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Goods $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Товары'), 'url' => ['index']];
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
<div class="goods-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if (Yii::$app->user->identity->role == 3) { ?>
        <?= Html::a(Yii::t('app', 'Редактировать'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Удалить'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'id' => 'delete-btn',
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
            'cost',
            'quantity',
        ],
    ]) ?>
</div>
</div>
