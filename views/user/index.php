<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <div class="row">
        <div class="col-sm-10">
            <h1 style="margin-top: 0"><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-sm-2">
            <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success', 'style' => 'float:right']) ?>
        </div>
    </div>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            [
                'label' => false,
                'filter' => false,
                'attribute' => 'status',
                'content' => function($data){
                    $color = $data->status ? 'green' : 'black';
                    return '<i class="fas fa-circle" style="color: ' . $color . '">';
                },
                'contentOptions' => ['style' => 'width: 3%'],
            ],
            'username',
            'name',
            'email:email',
             'created_at',
            [
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['style' => 'width: 6%'],
                'template' => '{view} {update} {delete}',
                'visibleButtons' => [
                    'delete' => function($model){
                        return $model->id != Yii::$app->user->id;
       },
                ]
            ],
        ],
    ]); ?>
</div>
