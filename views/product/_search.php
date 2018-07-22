<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProductSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <div class="row">
        <div class="col-sm-2">
            <?= $form->field($model, 'firm_id') ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($model, 'product_name') ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($model, 'quantity') ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($model, 'material') ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($model, 'created_at') ?>
        </div>
        <div class="col-sm-2">
            <div class="form-group" style="margin-top: 25px;">
                <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Reset', \yii\helpers\Url::to('/product/index'), ['class' => 'btn btn-default'])?>
            </div>
        </div>
    </div>











    <?php ActiveForm::end(); ?>

</div>
