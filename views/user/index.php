<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Потребители';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">
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
            <?= Html::a('Създай потребител', ['create'], ['class' => 'btn btn-success', 'style' => 'float:right']) ?>
        </div>
    </div>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
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
            [
                'attribute' => 'username',
                'label' => 'Потребителско име',
            ],
            [
                'attribute' => 'name',
                'label' => 'Име',
            ],
            [
                'attribute' => 'role',
                'label' => 'Роля',
                'content' => function($data){
                    if($data->role == \app\models\User::ROLE_ADMINISTRATOR)
                        return \app\models\User::ROLE_ADMINISTRATOR_LABEL;
                    else
                        return \app\models\User::ROLE_EMPLOYEE_LABEL;
                }
            ],
            [
                'attribute' => 'email',
                'label' => 'Емайл',
            ],
            [
                'attribute' => 'created_at',
                'label' => 'Дата',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['style' => 'width: 5%'],
                'template' => '{update} {delete}',
                'visibleButtons' => [
                    'delete' => function($model){
                        return $model->id != Yii::$app->user->id;
                    },
                ]
            ],
        ],
    ]); ?>
</div>
