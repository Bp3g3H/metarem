<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Продукти';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">
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
            <?= Html::a('Създаване на продукт', ['create'], ['class' => 'btn btn-success', 'style' => 'float:right']) ?>
        </div>
    </div>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
    <div style="position: absolute; left:2rem; right: 2rem; overflow: auto">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
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
                'label' => '№',
                'content' => function($data){
                    return $data->order->id;
                },
                'contentOptions' => ['style' => 'width: 3%']
            ],
            [
                'attribute' => 'firm_name',
                'value' => 'firm.name',
                'label' => 'Фирма',
            ],
            [
                'content' => function($data)
                {
                    return $data->displayServices();
                }
            ],
            [
                'attribute' => 'material_name',
                'value' => 'material.name',
                'label' => 'Материала'
            ],
            [
                'attribute' => 'product_name',
                'label' => 'Детайл'
            ],
            [
                'attribute' => 'quantity',
                'label' => 'Брой'
            ],
            [
                'attribute' => 'weight',
                'content' => function($data)
                {
                    return $data->weight . 'кг.';
                },
                'label' => 'Тегло',
            ],
            [
                'attribute' => 'price',
                'content' => function($data)
                {
                    return $data->price . 'лв.';
                },
                'label' => 'Ед цена'
            ],
            [
                'attribute' => 'price_for_cutting',
                'content' => function($data)
                {
                    return $data->price_for_cutting . 'лв.';
                },
                'label' => 'Общо цена'
            ],
            [
                'attribute' => 'full_weight',
                'content' => function($data)
                {
                    return $data->full_weight . 'кг.';
                },
                'label' => 'Общо тегло'
            ],
            [
                'attribute' => 'single_price_with_material',
                'content' => function($data)
                {
                    return $data->single_price_with_material . 'лв.';
                },
                'label' => 'Ед цена с материала'
            ],
            [
                'attribute' => 'full_price',
                'content' => function($data)
                {
                    return $data->full_price . 'лв.';
                },
                'label' => 'Цена без ДДС'
            ],
            [
                'attribute' => 'price_with_dds',
                'content' => function($data)
                {
                    return $data->price_with_dds . 'лв.';
                },
                'label' => 'Цена с ДДС'
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'buttons' => [
                    'delete' => function($url, $model){
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['delete', 'id' => $model->id], [
                            'class' => '',
                            'data' => [
                                'confirm' => 'Сигурни ли сте че искате да изтриете този продукт',
                                'method' => 'post',
                            ],
                        ]);
                    }
                ],
                'contentOptions' => ['style' => 'width: 3%; white-space: nowrap;']
            ],
        ],
    ]); ?>
    </div>
</div>
