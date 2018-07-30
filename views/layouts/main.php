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
        'brandLabel' => 'Метарем',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            [
                'label' => 'Home',
                'url' => ['/site/index'],
                'visible' => Yii::$app->user->isGuest
            ],
            [
                'label' => 'About',
                'url' => ['/site/about'],
                'visible' => Yii::$app->user->isGuest
            ],
            [
                'label' => 'Contact',
                'url' => ['/site/contact'],
                'visible' => Yii::$app->user->isGuest
            ],
            [
                'label' => 'Потребители',
                'url' => ['/user'],
                'visible' => !Yii::$app->user->isGuest
            ],
            [
                'label' => 'Фирми',
                'url' => ['/firm'],
                'visible' => !Yii::$app->user->isGuest
            ],
            [
                'label' => 'Продукти',
                'url' => ['/product'],
                'visible' => !Yii::$app->user->isGuest
            ],
            [
                'label' => 'Материали',
                'url' => ['/material'],
                'visible' => !Yii::$app->user->isGuest
            ],
            [
                'label' => 'Поръчки',
                'url' => ['/order'],
                'visible' => !Yii::$app->user->isGuest
            ],
            [
                'label' =>  Yii::$app->user->isGuest ? 'Влизане' : 'Излизане (' . Yii::$app->user->identity->username . ')',
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

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
