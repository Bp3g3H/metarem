<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StatsForm*/
/* @var $dataProvider yii\data\ArrayDataProvider */

$this->title = 'Статистика';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">
    <div class="row">
        <div class="col-sm-10">
            <h1 style="margin-top: 0"><?= Html::encode($this->title) ?></h1>
        </div>
    </div>
    <?php  echo $this->render('stats_search', ['model' => $searchModel]); ?>
    <div>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                [
                    'header' => 'Продукт',
                    'attribute' => 'name',
                ],
                [
                    'header' => 'Използвано количество',
                    'attribute' => 'used_weight',
                    'content' => function($data){
                        return $data['used_weight'] . 'кг';
                    }
                ],
                [
                    'header' => 'Проходи',
                    'content' => function($data){
                        return $data['used_weight'] * $data['price'] . 'лв';
                    }
                ],
            ],
        ]); ?>
    </div>
</div>
