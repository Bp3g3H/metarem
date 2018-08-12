<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FirmSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Фирми';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="firm-index">
    <?php if (Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            <?= Yii::$app->session->getFlash('success') ?>
        </div>
    <?php endif; ?>
    <div class="row">
        <div class="col-sm-10">
            <h1 style="margin-top: 0"><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-sm-2">
            <?= Html::a('Добави фирма', ['firm/create'], ['class' => 'btn btn-success', 'style' => 'float:right']) ?>
        </div>
    </div>

    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'name',
                'label' => 'Име',
            ],
            [
                'attribute' => 'city',
                'label' => 'Град',
            ],
            [
                'attribute' => 'address',
                'label' => 'Адрес',
            ],
            [
                'attribute' => 'owner_name',
                'label' => 'Собственик',
            ],
            [
                'attribute' => 'email',
                'label' => 'Емайл',
            ],
            [
                'attribute' => 'phone_number',
                'label' => 'Тел. номер',
            ],
            [
                'attribute' => 'created_at',
                'label' => 'Дата на добавяне',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['style' => 'width: 5%'],
                'template' => '{update} {delete}',
            ],
        ],
    ]); ?>
</div>
