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
                    'attribute' => 'firm.name',
                    'label' => 'Фирма',
                ],
                [
                    'attribute' => 'status',
                    'content' => function($data){
                        return $data->getStatusLabel();
                    }
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{export} {update} {delete}',
                    'buttons' => [
                        'export' => function ($url, $model, $key) {
                            return Html::a('<i class="fas fa-arrow-alt-circle-down"></i>', \yii\helpers\Url::to(['order/export-invoice', 'id' => $model->id]));
                        },
                    ],
                    'contentOptions' => ['style' => 'width: 6%']
                ],
            ],
        ]); ?>
    </div>
</div>
