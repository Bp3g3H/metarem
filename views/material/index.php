<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MaterialSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Материали';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="material-index">
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
            <?= Html::a('Създаване на материал', ['create'], ['class' => 'btn btn-success', 'style' => 'float:right']) ?>
        </div>
    </div>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
             [
                 'attribute' => 'name',
                 'label' => 'Материал',
             ],
            [
                'attribute' => 'price',
                'label' => 'Цена',
                'content' => function($data){
                    return $data->price . 'лв';
                }
            ],
            [
                'attribute' => 'created_at',
                'label' => 'Дата',
                'content' => function($data)
                {
                    $time = strtotime($data->created_at);
                    return date('d.m.Y',$time) . 'г';
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'contentOptions' => ['style' => 'width: 5%']
            ],
        ],
    ]); ?>
</div>
