<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Html::img( Yii::$app->request->baseUrl . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'metarem logo.png', ['style' => 'width: auto; height: 35px; marging-bot']),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-blue navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            [
                'label' => 'Потребители',
                'url' => ['/user'],
                'visible' => Yii::$app->user->inRole(\app\models\User::ROLE_ADMINISTRATOR)
            ],
            [
                'label' => 'Фирми',
                'url' => ['/firm'],
                'visible' => Yii::$app->user->inRole(\app\models\User::ROLE_ADMINISTRATOR)
            ],
            [
                'label' => 'Продукти',
                'url' => ['/product'],
                'visible' => !Yii::$app->user->isGuest
            ],
            [
                'label' => 'Материали',
                'url' => ['/material'],
                'visible' => Yii::$app->user->inRole(\app\models\User::ROLE_ADMINISTRATOR)
            ],
            [
                'label' => 'Поръчки',
                'url' => ['/order'],
                'visible' => !Yii::$app->user->isGuest
            ],
            [
                'label' => 'Статисика',
                'url' => ['/material/stats'],
                'visible' => !Yii::$app->user->isGuest
            ],
            [
                'label' =>  Yii::$app->user->isGuest ? 'Вписване' : 'Излизане (' . Yii::$app->user->identity->username . ')',
                'url' => Yii::$app->user->isGuest ? ['/site/login'] : ['/site/logout'],
                'linkOptions' => ['class' => 'btn btn-link logout']
            ],
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'homeLink' => ['url'=>'site/index','label'=>'Начална страница'],
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<!--<footer class="footer">-->
<!--    <div class="container">-->
<!--        <p class="pull-left">Metarem --><?//= date('Y') ?><!--</p>-->
<!--    </div>-->
<!--</footer>-->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
