<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrderSearch*/
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Поръчки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">
    <?php if (Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            <?= Yii::$app->session->getFlash('success') ?>
        </div>
    <?php endif; ?>

    <?php if (Yii::$app->session->hasFlash('error')): ?>
        <div class="alert alert-error alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            <?= Yii::$app->session->getFlash('error') ?>
        </div>
    <?php endif; ?>
    <div class="row">
        <div class="col-sm-10">
            <h1 style="margin-top: 0"><?= Html::encode($this->title) ?></h1>
        </div>
    </div>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
    <div>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                [
                    'attribute' => 'firm_name',
                    'value' => 'firm.name',
                    'label' => 'Фирма',
                ],
                [
                    'attribute' => 'status',
                    'content' => function($data){
                        return $data->getStatusLabel();
                    }
                ],
                [
                    'content' => function($data){
                        if($data->status == \app\models\Order::STATUS_PENDING)
                            return Html::a('<i class="fas fa-file-invoice-dollar"></i>', \yii\helpers\Url::to(['order/export', 'id' => $data->id, 'type' => \app\models\Order::EXPORT_PROTOCOL]));
                        else
                            return Html::a('<i class="far fa-file-alt"></i>', \yii\helpers\Url::to(['order/export', 'id' => $data->id, 'type' => \app\models\Order::EXPORT_OFFER]));
                    },
                    'contentOptions' => ['style' => 'width: 3%']
                ],
                [
                    'content' => function($data){
                            return Html::a('<i class="fas fa-history"></i>', \yii\helpers\Url::to(['order/finish-order', 'id' => $data->id]));
                    },
                    'contentOptions' => ['style' => 'width: 3%']
                ],
                [
                    'content' => function($data){

                        return Html::a('<i class="fas fa-trash-alt"></i>', \yii\helpers\Url::to(['order/delete', 'id' => $data->id]));
                    },
                    'contentOptions' => ['style' => 'width: 3%']
                ],
                [
                    'content' => function($data){
                        return Html::a('<i class="fas fa-pen"></i>', \yii\helpers\Url::to(['order/update', 'id' => $data->id]));
                    },
                    'contentOptions' => ['style' => 'width: 3%']
                ],
//                [
//                    'class' => 'yii\grid\ActionColumn',
//                    'template' => '{exportOffer}{exportProtocol} {update} {delete}',
//                    'buttons' => [
//                        'exportProtocol' => function ($url, $model, $key) {
//
//                        },
//                        'exportOffer' => function ($url, $model, $key) {
//
//                        },
//                    ],
//                    'contentOptions' => ['style' => 'width: 8%']
//                ],
            ],
        ]); ?>
    </div>
</div>
