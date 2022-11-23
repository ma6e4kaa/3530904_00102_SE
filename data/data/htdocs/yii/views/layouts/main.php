<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => '/favicon.ico']);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="ru" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100" style="background-color: #e0d8f526">
<?php $this->beginBody() ?>

<header id="header">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => ['class' => 'navbar-expand-md navbar-light fixed-top', 'style' => 'background-color: #fff']
    ]);
    if (Yii::$app->user->isGuest) {
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav'],
            'items' => [
                ['label' => 'Регистрация', 'url' => ['/site/signup']],
                ['label' => 'Войти', 'url' => ['/site/login']],
            ]
        ]);
    }
    else {
        if (Yii::$app->user->identity->role == 3) {
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav'],
                'items' => [
                    ['label' => 'Туры', 'url' => ['/tour']],
                    ['label' => 'Билеты', 'url' => ['/tickets']],
                    ['label' => 'Продажи', 'url' => ['/sales']],
                    ['label' => 'Отзывы', 'url' => ['/feedback']],
                    [
                        'label' => 'Справочники',
                        'items' => [
                             ['label' => 'Города', 'url' => '/city'],
                             ['label' => 'Товары', 'url' => '/goods'],
                             ['label' => 'Достопримечательности', 'url' => '/showplace'],
                             ['label' => 'Тэги тура', 'url' => '/tags'],
                             ['label' => 'Статус тура', 'url' => '/tour-status'],
                             ['label' => 'Статус пользователя', 'url' => '/user-status'],
                             ['label' => 'Пользователи', 'url' => '/users'],

                        ],
                    ],
                    [
                        'label' => Yii::$app->user->identity->username,
                        'items' => [
                             ['label' => 'Личный кабинет', 'url' => '/lk?id='.Yii::$app->user->identity->id],
                             [
                                 'label' => 'Выйти', 
                                 'url' => ['/site/logout'],
                                 'linkOptions' => ['data-method' => 'post'],
                             ],
                        ],
                    ],
                ]
            ]);
        } else {
            if (Yii::$app->user->identity->role == 1) {
                echo Nav::widget([
                    'options' => ['class' => 'navbar-nav'],
                    'items' => [
                        ['label' => 'Туры', 'url' => ['/tour']],
                        ['label' => 'Мои туры', 'url' => ['/my-tickets?id='.Yii::$app->user->identity->id]],
                        ['label' => 'Мои покупки', 'url' => ['/my-sales?id='.Yii::$app->user->identity->id]],
                        [
                        'label' => Yii::$app->user->identity->username,
                            'items' => [
                                 ['label' => 'Личный кабинет', 'url' => '/lk?id='.Yii::$app->user->identity->id],
                                 [
                                     'label' => 'Выйти', 
                                     'url' => ['/site/logout'],
                                     'linkOptions' => ['data-method' => 'post'],
                                 ],
                            ],
                        ]
                    ]
                ]);
            } else {
                echo Nav::widget([
                    'options' => ['class' => 'navbar-nav'],
                    'items' => [
                        ['label' => 'Туры', 'url' => ['/tour']],
                        ['label' => 'Билеты', 'url' => ['/tickets']],
                        ['label' => 'Продажи', 'url' => ['/sales']],
                        ['label' => 'Отзывы', 'url' => ['/feedback']],
                        ['label' => 'Товары', 'url' => ['/goods']],
                        [
                            'label' => Yii::$app->user->identity->username,
                            'items' => [
                                 ['label' => 'Личный кабинет', 'url' => '/lk?id='.Yii::$app->user->identity->id],
                                 [
                                     'label' => 'Выйти', 
                                     'url' => ['/site/logout'],
                                     'linkOptions' => ['data-method' => 'post'],
                                 ],
                            ],
                        ],
                    ]
                ]);
            }
        }
    }
    NavBar::end();
    ?>
</header>

<main id="main" class="flex-shrink-0" role="main">
    <div class="container">
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs'],
                'itemTemplate' => "<li>{link}</li>&nbsp;➔&nbsp;"]) ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer id="footer" class="mt-auto py-3 bg-white">
    <div class="container">
        <div class="row text-muted">
            <div class="col-md-6 text-center text-md-start">&copy; FunTravel <?= date('Y') ?></div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
