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
                'label' => 'Количество'
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
                'label' => 'Общо цена с материала'
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
                'contentOptions' => ['style' => 'width: 3%; white-space: nowrap;']
            ],
        ],
    ]); ?>
    </div>
</div>
